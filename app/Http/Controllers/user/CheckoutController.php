<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\DiscountCode;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class CheckoutController extends Controller
{
    public function showCheckout(Request $request)
    {
        $cart = Auth::user()->cart;

        if (!$cart || $cart->cartItems->isEmpty()) {
            return redirect()->route('cart.show')->with('error', 'Giỏ hàng của bạn đang trống!');
        }

        $selectedItems = session('selected_items', []);

        if (empty($selectedItems)) {
            return redirect()->back()->with('error', 'Bạn chưa chọn sản phẩm nào để thanh toán.');
        }   

        $selectedCartItems = $cart->cartItems->whereIn('id', $selectedItems);

        $total = $selectedCartItems->sum(function ($item) {
            $productPrice = $item->product->price ?? 0;
            $variantPrice = $item->variant->price ?? 0;
            $colorPrice = $item->color->price ?? 0;
            return ($productPrice + $variantPrice + $colorPrice) * $item->quantity;
        });

        // Lấy lại `total_after_discount` từ session
        $totalAfterDiscount = session('total_after_discount', $total);

        // Phí vận chuyển được tính khi cần
        $shippingFee = 0;

        return view('checkout.index', compact('selectedCartItems', 'total', 'totalAfterDiscount', 'shippingFee'));
    }
    public function calculateShippingFee(Request $request)
    {
        $province = $request->input('province');
        $shippingFee = 0;

        if ($province === '01') {
            $shippingFee = 25000;
        } elseif (in_array($province, ['24', '27', '42', '30', '35', '33', '17', '36', '19', '37'])) {
            $shippingFee = 30000;
        } elseif ($province === '22') {
            $shippingFee = 50000;
        } elseif (in_array($province, ['10', '20', '04', '02', '14', '08', '11'])) {
            $shippingFee = 40000;
        } elseif (in_array($province, ['79', '77', '74', '75', '80', '82', '83', '84', '87', '70', '72', '96', '92', '93', '91', '94', '86'])) {
            $shippingFee = 80000;
        } else {
            $shippingFee = 55000;
        }

        return response()->json(['shipping_fee' => $shippingFee]);
    }

    // Hàm tính phí vận chuyển (tách riêng logic này để tái sử dụng)
    private function calculateShippingFeeForProvince($province)
    {
        if ($province === '01') {
            return 25000;
        } elseif (in_array($province, ['24', '27', '42', '30', '35', '33', '17', '36', '19', '37'])) {
            return 30000;
        } elseif ($province === '22') {
            return 50000;
        } elseif (in_array($province, ['10', '20', '04', '02', '14', '08', '11'])) {
            return 40000;
        } elseif (in_array($province, ['79', '77', '74', '75', '80', '82', '83', '84', '87', '70', '72', '96', '92', '93', '91', '94', '86','89'])) {
            return 80000;
        } else {
            return 55000;
        }
    }

    private function calculateTotalPrice($cart, $selectedItems)
    {
        return $cart->cartItems->whereIn('id', $selectedItems)->sum(function ($item) {
            $productPrice = $item->product->price ?? 0;
            $variantPrice = $item->variant->price ?? 0;
            $colorPrice = $item->color->price ?? 0;

            return ($productPrice + $variantPrice + $colorPrice) * $item->quantity;
        });
    }
    public function handleCheckout(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'detail_address' => 'required|string',
            'province' => 'required',
            'district' => 'required',
            'ward' => 'required',
            'phone' => 'required|string',
            'payment_method' => 'required|string',
        ]);
     


        try {
            $cart = Auth::user()->cart;
            $selectedItems = session('selected_items', []);

            if (empty($selectedItems)) {
                return response()->json(['success' => false, 'message' => 'Bạn chưa chọn sản phẩm nào để thanh toán.']);
            }

            // Tính tổng tiền sau giảm giá (không bao gồm phí ship)
            $totalAfterDiscount = session('total_after_discount', 0);

            if (session()->has('discount_code')) {
                if ($totalAfterDiscount <= 0) {
                    $totalPriceSelectedItems = $this->calculateTotalPrice($cart, $selectedItems);
                    $discountAmount = session('discount_amount', 0);
                    $totalAfterDiscount = max($totalPriceSelectedItems - $discountAmount, 0);
                }
            } else {
                $totalAfterDiscount = $this->calculateTotalPrice($cart, $selectedItems);
            }

            // Tính phí vận chuyển
            $shippingFee = $this->calculateShippingFeeForProvince($request->province);

            // Tổng tiền cuối cùng (chỉ dùng để thanh toán)
            $grandTotal = $totalAfterDiscount + $shippingFee;

            // Lưu thông tin checkout vào session
            session()->put('checkout_info', [
                'detail_address' => $request->input('detail_address'),
                'province' => $request->input('province'),
                'district' => $request->input('district'),
                'ward' => $request->input('ward'),
                'phone' => $request->input('phone'),
                'payment_method' => $request->input('payment_method'),
                'total_after_discount' => $totalAfterDiscount,
            ]);

            // Kiểm tra phương thức thanh toán
            if ($request->payment_method === 'online') {
                return $this->vnpay_payment($request, $grandTotal); // Gửi tổng tiền đã bao gồm phí ship
            }

            if ($request->payment_method === 'cash') {
                $order = $this->createOrder($request, false);
                return redirect()->route('checkout.success', ['order' => $order->id])
                    ->with('success', 'Đặt hàng thành công! Đơn hàng của bạn sẽ được xử lý.');
            }
        } catch (\Exception $e) {
            Log::error('Lỗi khi xử lý thanh toán: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Đã xảy ra lỗi khi xử lý thanh toán.']);
        }
    }

    public function checkoutSuccess(Order $order)
    {
        $orderItems = $order->orderItems;


        $totalPrice = $orderItems->sum(function ($item) {
            $productPrice = $item->product->price ?? 0;
            $variantPrice = $item->variant->price ?? 0;
            // $batteryPrice = $item->battery->price ?? 0;
            $colorPrice = $item->color->price ?? 0;

            return ($productPrice + $variantPrice  + $colorPrice) * $item->quantity;
        });

        $discountAmount = $order->discount_amount;
        $totalAfterDiscount = $order->total_after_discount;
        $shippingFee = $order->shipping_fee ?? 0;


        $grandTotal = $order->grand_total;

        return view('checkout.success', compact('order', 'orderItems', 'totalPrice', 'discountAmount', 'totalAfterDiscount', 'shippingFee', 'grandTotal'));
    }

    public function getQuantity()
    {
        $cart = Auth::user()->cart;
        $totalQuantity = $cart->cartItems->sum('quantity');

        return response()->json(['totalQuantity' => $totalQuantity]);
    }


    //	9704198526191432198
    //	NGUYEN VAN A
    //  07/15
    //  123456

    public function vnpay_payment(Request $request, $totalAmount)
    {
        if ($totalAmount <= 0) {
            return redirect()->back()->with('error', 'Số tiền thanh toán không hợp lệ.');
        }

        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_TmnCode = "QS1RZV9J";
        $vnp_HashSecret = "CZD6KQ2KZOPLA7DFSD69G87MX8SYS46R";
        $vnp_TxnRef = time();
        $vnp_OrderInfo = "Thanh toán đơn hàng";
        $vnp_OrderType = "billpayment";
        $vnp_Amount = $totalAmount * 100;
        $vnp_Locale = "vn";
        $vnp_BankCode = "NCB";
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];

        $inputData = [
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_TxnRef" => $vnp_TxnRef,
            "vnp_ReturnUrl" => route('vnpay.return'),
        ];


        if (!empty($vnp_BankCode)) {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }

        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";

        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }

        return redirect()->to($vnp_Url);
    }


    public function vnpayReturn(Request $request)
    {
        $vnp_ResponseCode = $request->input('vnp_ResponseCode');

        if ($vnp_ResponseCode == '00') { // Thanh toán thành công
            // Lấy thông tin checkout từ session
            $checkoutInfo = session('checkout_info');

            // Kiểm tra xem thông tin có tồn tại hay không
            if (!$checkoutInfo || !is_array($checkoutInfo)) {
                return redirect()->route('checkout')->with('error', 'Không thể xử lý thanh toán. Dữ liệu không hợp lệ.');
            }

            // Tạo đơn hàng
            $order = $this->createOrder(new Request($checkoutInfo), true);
            $order->transaction_id = $request->input('vnp_TransactionNo');
            $order->save();

            return redirect()->route('checkout.success', ['order' => $order->id])
                ->with('success', 'Thanh toán thành công!');
        } else { // Thanh toán thất bại hoặc bị hủy
            return redirect()->route('checkout')->with('error', 'Thanh toán thất bại hoặc bị hủy.');
        }
    }


    private function createOrder($request, $fromVnpay = false)
    {
        $cart = Auth::user()->cart;
        $selectedItems = session('selected_items', []);

        if (empty($selectedItems)) {
            return redirect()->back()->with('error', 'Không có sản phẩm nào được chọn để thanh toán.');
        }

        // Tính tổng tiền và phí vận chuyển
        $totalAfterDiscount = session('total_after_discount', 0);

        if ($totalAfterDiscount <= 0) {
            $totalAfterDiscount = $cart->cartItems->whereIn('id', $selectedItems)->sum(function ($item) {
                $productPrice = $item->product->price ?? 0;
                $variantPrice = $item->variant->price ?? 0;
                $colorPrice = $item->color->price ?? 0;
                return ($productPrice + $variantPrice + $colorPrice) * $item->quantity;
            });
        }


        $totalPrice = $cart->cartItems->whereIn('id', $selectedItems)->sum(function ($item) {
            $productPrice = $item->product->price ?? 0;
            $variantPrice = $item->variant->price ?? 0;
            $colorPrice = $item->color->price ?? 0;
            return ($productPrice + $variantPrice + $colorPrice) * $item->quantity;
        });


        $shippingFee = $this->calculateShippingFeeForProvince($request->province);

        // $totalAfterDiscount += $shippingFee;
        // Tạo đơn hàng
        $order = new Order();
        $order->user_id = Auth::id();
        $order->total_price = $totalPrice;
        $order->total_after_discount = $totalAfterDiscount; // Tổng tiền sau giảm giá
        $order->shipping_fee = $shippingFee;
        $order->province = $this->getLocationNameById('https://esgoo.net/api-tinhthanh/1/0.htm', $request->province);
        $order->district = $this->getLocationNameById('https://esgoo.net/api-tinhthanh/2/' . $request->province . '.htm', $request->district);
        $order->ward = $this->getLocationNameById('https://esgoo.net/api-tinhthanh/3/' . $request->district . '.htm', $request->ward);
        $order->detail_address = $request->detail_address;
        $order->phone = $request->phone;
        $order->payment_method = $request->payment_method;
        $order->discount_code = session('discount_code');
        $order->discount_amount = session('discount_amount');
        $order->discount_percentage = session('discount_percentage');

        if ($order->save()) {
            foreach ($cart->cartItems->whereIn('id', $selectedItems) as $item) {
                $color = $item->color;
                if ($color) {
                    $color->quantity -= $item->quantity;
                    $color->save();
                }
                if (session()->has('discount_code')) {
                    $discountCode = DiscountCode::where('code', session('discount_code'))->first();
                    if ($discountCode && $discountCode->usage_limit > 0) {
                        $discountCode->usage_limit -= 1; // Trừ số lượng sử dụng
                        $discountCode->save();
                    }
                }
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'variant_id' => $item->variant_id,
                    'color_id' => $item->color_id,
                    'quantity' => $item->quantity,
                    'price' => $item->product->price,
                ]);
            }

            $cart->cartItems()->whereIn('id', $selectedItems)->delete();
        }

        return $order;
    }

    public function selectItems(Request $request)
    {
        $selectedItems = $request->input('selected_items', []);

        if (empty($selectedItems)) {
            return response()->json(['success' => false, 'message' => 'Bạn chưa chọn sản phẩm nào.']);
        }

        session(['selected_items' => $selectedItems]);

        return response()->json(['success' => true]);
    }


    private function getLocationNameById($apiUrl, $id)
    {
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
}
