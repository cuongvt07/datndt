<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Lấy tổng số lượng sản phẩm (stock)
        $totalProducts = Product::sum('stock');

        // 2. Lấy tổng số người dùng được tạo trong vòng 30 ngày gần đây
        $totalNewUsers = User::where('created_at', '>=', Carbon::now()->subDays(30))->count();

        // 3. Đếm số đơn hàng có status là 'completed'
        $completedOrders = Order::where('status', 'completed')->count();

        // 4. Tính tổng doanh thu của những đơn hàng 'completed'
        $totalRevenue = Order::where('status', 'completed')->sum('total_after_discount');

        // 5. Lấy danh sách nhà cung cấp và tổng số lượng sản phẩm của từng supplier
        $suppliers = Supplier::all()->map(function ($supplier) {
            // Tính tổng stock của từng nhà cung cấp
            $totalStock = Product::where('supplier_id', $supplier->id)->sum('stock');

            // Thêm thuộc tính 'total_stock' vào đối tượng supplier
            $supplier->total_stock = $totalStock;

            return $supplier;
        });

        // Truyền dữ liệu vào view
        return view('admin.dashboard', compact(
            'totalProducts', 'totalNewUsers', 'completedOrders', 'totalRevenue', 'suppliers'
        ));
    }
}