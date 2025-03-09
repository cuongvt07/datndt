<?php

namespace App\Http\Controllers;

use App\Models\DiscountCode;
use App\Models\Order;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    public function index()
    {

        $orders = Order::where('user_id', Auth::id())
            ->where('status', '!=', 'completed')
            ->where('status', '!=', 'canceled')
            ->with('orderItems.product')
            ->orderBy('created_at', 'desc')
            ->paginate(8);

        return view('orders.index', compact('orders'));
    }
    
    public function showCompleted()
    {
        $completedOrders = Order::where('user_id', Auth::id())
            ->whereIn('status', ['completed',])
            ->with(['orderItems.product.productImages', 'orderItems.color', 'orderItems.battery', 'orderItems.variant', 'orderItems.review'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('orders.show', compact('completedOrders'));
    }
    public function showCompletedAndCanceled()
    {
        $completedAndCanceledOrders = Order::where('user_id', Auth::id())
            ->whereIn('status', [ 'canceled']) 
            ->with(['orderItems.product.productImages', 'orderItems.color', 'orderItems.battery', 'orderItems.variant', 'orderItems.review'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('orders.test', compact('completedAndCanceledOrders'));
    }






    public function cancel(Request $request, $orderId)
    {
        
        $order = Order::where('id', $orderId)->where('user_id', Auth::id())->first();

        if ($order->status === 'canceled') {
            return redirect()->back()->with('error', 'Đơn hàng này đã bị hủy trước đó.');
        }

        if (!$order || $order->status != 'pending') {
            return redirect()->back()->with('error', 'Không thể hủy đơn hàng này.');
        }

        $reasons = $request->input('reasons', []);
        $otherReason = $request->input('other_reason', null);

        $cancelReasons = implode(', ', $reasons);
        if ($otherReason) {
            $cancelReasons .= ($cancelReasons ? ', ' : '') . $otherReason;
        }
        $orderItems = $order->orderItems;

        foreach ($orderItems as $orderItem) {
            $color = $orderItem->color;
            if ($color) {
                $color->quantity += $orderItem->quantity;
                $color->save();
            }
        }

        if ($order->discount_code) {
            $discountCode = DiscountCode::where('code', $order->discount_code)->first();
            if ($discountCode) {
                $discountCode->usage_limit += 1;
                $discountCode->save();
            }
        }

        $order->status = 'canceled';
        $order->cancel_reason = $cancelReasons;
        $order->save();


        return redirect()->route('order')->with('success', 'Đã hủy đơn hàng thành công.');
    }
    public function cancelOrder(Order $order)
    {
        // Kiểm tra trạng thái đơn hàng
        

        // Tăng lại số lượng sản phẩm trong kho
        

        // Khôi phục mã giảm giá nếu có
        

        // Cập nhật trạng thái đơn hàng
        $order->status = 'cancelled';
        $order->save();

        return redirect()->route('orders.index')->with('success', 'Đơn hàng đã được hủy thành công.');
    }


public function updateAddress(Request $request, Order $order)
{
    $request->validate([
        'phone' => ['required', 'regex:/^0[0-9]{9}$/'],
        'detail_address' => 'required',
        'province' => 'required',
        'district' => 'required',
        'ward' => 'required',
    ]);

    session([
        'checkout_info' => $request->only('phone', 'province', 'district', 'ward', 'detail_address')
    ]);
    if ($order->status === 'canceled') {
        return redirect()->back()->with('error', 'Đơn hàng này đã bị hủy trước đó.');
    }
    // Cập nhật tên tỉnh/thành
    if ($request->province != '0' && $order->province != $request->province) {
        $provinceName = $this->getLocationNameById('https://esgoo.net/api-tinhthanh/1/0.htm', $request->province);
        if ($provinceName) {
            $order->province = $provinceName;
        } else {
            return redirect()->back()->with('error', 'Không tìm thấy tỉnh/thành bạn đã chọn.');
        }
    }

    // Cập nhật tên quận/huyện
    if ($request->district != '0' && $order->district != $request->district) {
        $districtName = $this->getLocationNameById('https://esgoo.net/api-tinhthanh/2/' . $request->province . '.htm', $request->district);
        if ($districtName) {
            $order->district = $districtName;
        } else {
            return redirect()->back()->with('error', 'Không tìm thấy quận/huyện bạn đã chọn.');
        }
    }

    // Cập nhật tên xã/phường
    if ($request->ward != '0' && $order->ward != $request->ward) {
        $wardName = $this->getLocationNameById('https://esgoo.net/api-tinhthanh/3/' . $request->district . '.htm', $request->ward);
        if ($wardName) {
            $order->ward = $wardName;
        } else {
            return redirect()->back()->with('error', 'Không tìm thấy phường/xã bạn đã chọn.');
        }
    }

    // Cập nhật địa chỉ chi tiết
    if ($order->detail_address != $request->detail_address) {
        $order->detail_address = $request->detail_address;
    }

    // Cập nhật số điện thoại
    if ($order->phone != $request->phone) {
        $order->phone = $request->phone;
    }

    // **Tính lại phí vận chuyển**
    $shippingFee = $this->calculateShippingFeeByProvince($request->province);

    // **Cập nhật phí vận chuyển và tổng giá đơn hàng**
    $order->shipping_fee = $shippingFee;
    // $order->total_after_discount = $order->total_after_discount + $shippingFee;

    // Lưu thay đổi
    if ($order->save()) {
        return redirect()->back()->with('success', 'Địa chỉ và phí vận chuyển đã được cập nhật thành công!');
    } else {
        return redirect()->back()->with('error', 'Cập nhật địa chỉ thất bại. Vui lòng thử lại.');
    }
}

// Hàm tính phí vận chuyển theo tỉnh/thành phố
private function calculateShippingFeeByProvince($province)
{
    if ($province === '01') {
        return 25000;
    } elseif (in_array($province, ['24', '27', '42', '30', '35', '33', '17', '36', '19', '37'])) {
        return 30000;
    } elseif ($province === '22') {
        return 50000;
    } elseif (in_array($province, ['10', '20', '04', '02', '14', '08', '11'])) {
        return 40000;
    } elseif (in_array($province, ['79', '77', '74', '75', '80', '82', '83', '84', '87', '70', '72', '96', '92', '93', '91', '94', '86'])) {
        return 80000;
    } else {
        return 55000;
    }
}


    private function getLocationNameById($apiUrl, $id)
    {
        // Lấy dữ liệu từ API và trả về tên của khu vực dựa trên ID
        $response = Http::get($apiUrl);
        if ($response->successful()) {
            $locations = $response->json()['data'];
            foreach ($locations as $location) {
                if ($location['id'] == $id) {
                    return $location['full_name'];
                }
            }
        }
        return null;
    }
    /// Đánh Giá
    public function store(Request $request)
    {
        $user = Auth::user();

        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Bạn cần đăng nhập để đánh giá sản phẩm.');
        }

        // Validate input
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'content' => 'nullable|string|max:1000',
            'product_id' => 'required|exists:products,id',
            'images.*' => 'image|max:2048', // Kiểm tra ảnh
            'videos.*' => 'mimetypes:video/mp4,video/avi,video/mpeg|max:10240' // Kiểm tra video
        ]);

        // Kiểm tra và lưu ảnh
        $imagePaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $path = $file->store('images', 'public');
                $imagePaths[] = $path; // Thêm đường dẫn vào mảng
            }
        }

        // Kiểm tra và lưu video
        $videoPaths = [];
        if ($request->hasFile('videos')) {
            foreach ($request->file('videos') as $file) {
                $path = $file->store('videos', 'public');
                $videoPaths[] = $path;
            }
        }
        // Lưu vào cơ sở dữ liệu
        Review::create([
            'product_id' => $request->input('product_id'),
            'user_id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'rating' => $request->input('rating'),
            'content' => $request->input('content', ''),
            'images' => json_encode($imagePaths),  // Lưu dưới dạng chuỗi JSON
            'videos' => json_encode($videoPaths),  // Lưu dưới dạng chuỗi JSON
        ]);

        // session()->flash('status', 'Đánh giá thành công!');

        return redirect()->back()->with('status', 'Đánh giá thành công!');
    }
    // Mua lại sp
    public function show($orderId)
    {
        // Lấy đơn hàng với các chi tiết sản phẩm liên quan
        $order = Order::with('orderItems.product.productImages', 'orderItems.color', 'orderItems.battery', 'orderItems.variant')
            ->findOrFail($orderId);

        // Truyền dữ liệu vào view
        return view('orders.show', compact('order'));
    }
}
