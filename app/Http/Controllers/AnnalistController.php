<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnnalistController extends Controller
{
    public function index(Request $request)
    {
        // 1. Lấy dữ liệu ngày bắt đầu và ngày kết thúc từ request hoặc gán mặc định
        $earliestDate = Product::min('created_at');
        $startDate = $request->input('start_date') ?: Carbon::parse($earliestDate)->toDateString();
        $endDate = $request->input('end_date') ?: Carbon::now()->toDateString();

        // 2. Thống kê sản phẩm nhập theo ngày
        $productData = Product::selectRaw('DATE(created_at) as date, SUM(stock) as total_stock')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->pluck('total_stock', 'date')
            ->toArray();

        // 3. Thống kê tài khoản mới theo ngày
        // Truy vấn số lượng tài khoản mới trong khoảng thời gian
        $userData = User::selectRaw('DATE(created_at) as date, COUNT(*) as total_users')
            ->where('role_id', 3)
            ->whereBetween('created_at', [$startDate, $endDate]) // Sử dụng start_date và end_date
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->pluck('total_users', 'date')
            ->toArray();

        // Tạo danh sách đầy đủ các ngày trong khoảng thời gian, lấp đầy dữ liệu còn thiếu
        $allDates = [];
        $userCounts = [];
        $currentDay = Carbon::parse($startDate);
        $endDay = Carbon::parse($endDate);

        while ($currentDay <= $endDay) {
            $date = $currentDay->format('Y-m-d');
            $allDates[] = $date;
            $userCounts[] = $userData[$date] ?? 0; // Số lượng tài khoản mới hoặc 0 nếu không có
            $currentDay->addDay();
        }


        // 4. Thống kê doanh thu theo ngày
        $revenueData = Order::selectRaw('DATE(created_at) as date, SUM(total_after_discount) as daily_revenue')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->whereNotNull('total_after_discount')
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->pluck('daily_revenue', 'date')
            ->toArray();

        // 5. Xử lý chuỗi ngày đầy đủ và tổng hợp dữ liệu cho biểu đồ
        $allDates = [];
        $data = [];
        $userCounts = [];
        $revenueCounts = [];
        $start = Carbon::parse($startDate);
        $end = Carbon::parse($endDate);

        while ($start <= $end) {
            $date = $start->format('Y-m-d');
            $allDates[] = $date;
            $data[] = $productData[$date] ?? 0;
            $userCounts[] = $userData[$date] ?? 0;
            $revenueCounts[] = $revenueData[$date] ?? 0;
            $start->addDay();
        }

        // 6. Lấy dữ liệu thống kê khác
        // 2. Tổng số sản phẩm trong kho (dựa vào created_at và updated_at)
        $totalProducts = Product::where(function ($query) use ($startDate, $endDate) {
            $query->whereBetween('created_at', [$startDate, $endDate])
                ->orWhereBetween('updated_at', [$startDate, $endDate]);
        })->sum('stock');

        $totalNewUsers = User::where('role_id', 3)
            ->whereBetween('created_at', [$startDate, $endDate])
            ->count();
        $completedOrders = Order::where('status', 'completed')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->count();

        $totalRevenue = Order::where('status', 'completed')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->sum('total_after_discount');

        // 7. Thống kê nhà cung cấp và loại sản phẩm
        $suppliers = Supplier::all()->map(function ($supplier) {
            $totalStock = Product::where('supplier_id', $supplier->id)->sum('stock');
            $supplier->total_stock = $totalStock; // Thêm thuộc tính `total_stock` vào đối tượng supplier
            return $supplier;
        });

        $supplierData = Product::select('suppliers.name as supplier_name', DB::raw('SUM(products.stock) as total_stock'))
            ->join('suppliers', 'products.supplier_id', '=', 'suppliers.id')
            ->groupBy('suppliers.name')
            ->get()
            ->pluck('total_stock', 'supplier_name')
            ->toArray();

        $categoryData = Product::select('categories.name as category_name', DB::raw('SUM(products.stock) as total_stock'))
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->groupBy('categories.name')
            ->get()
            ->pluck('total_stock', 'category_name')
            ->toArray();

        // 8. Top 3 sản phẩm bán chạy
        $topProducts = Product::select('products.id', 'products.name_sp', DB::raw('SUM(order_items.quantity) as total_sold'))
            ->join('order_items', 'products.id', '=', 'order_items.product_id')
            ->join('orders', 'orders.id', '=', 'order_items.order_id')
            ->where('orders.status', 'completed') // Chỉ tính đơn hàng đã hoàn tất
            ->whereBetween('orders.created_at', [$startDate, $endDate]) // Lọc theo thời gian
            ->groupBy('products.id', 'products.name_sp')
            ->orderByDesc('total_sold')
            ->limit(3)
            ->get();

        // 9. Sản phẩm ít được quan tâm
        $unpopularProducts = Product::select('products.id', 'products.name_sp')
            ->leftJoin('order_items', 'products.id', '=', 'order_items.product_id')
            ->leftJoin('orders', 'orders.id', '=', 'order_items.order_id')
            ->selectRaw('products.id, products.name_sp, COALESCE(SUM(order_items.quantity), 0) AS total_quantity')
            ->groupBy('products.id', 'products.name_sp')
            ->having('total_quantity', '<', 1)
            ->get();

        // 10. Trả về view với tất cả dữ liệu
        return view('admin.annalist', compact(
            'totalProducts',
            'totalNewUsers',
            'completedOrders',
            'totalRevenue',
            'data',
            'allDates',
            'startDate',
            'endDate',
            'supplierData',
            'suppliers',
            'categoryData',
            'topProducts',
            'unpopularProducts',
            'userCounts', // Thêm userCounts
            'revenueCounts'
        ));
    }
}

