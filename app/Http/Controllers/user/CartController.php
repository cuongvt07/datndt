<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\DiscountCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('share.cart');
    }

    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|integer|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'color_id' => 'required|integer|exists:colours,id',
            'variant_id' => 'nullable|integer|exists:variants,id',
        ]);

        $cart = Cart::firstOrCreate(['user_id' => auth()->id()]);

        $cartItem = CartItem::where('cart_id', $cart->id)
            ->where('product_id', $request->product_id)
            ->where('color_id', $request->color_id)
            ->where('variant_id', $request->variant_id)
            ->first();

        if ($cartItem) {

            $cartItem->quantity += $request->quantity;
            $cartItem->save();
        } else {
            CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $request->product_id,
                'variant_id' => $request->variant_id,
                'color_id' => $request->color_id,
                'quantity' => $request->quantity,
            ]);
        }

        return response()->json(['message' => 'Sản phẩm được thêm vào giỏ hàng thành công!']);
    }

    public function showCart()
    {  
        $cart = Cart::with([
            'cartItems.product',
            'cartItems.color',
            'cartItems.battery',
            'cartItems.variant'
        ])->where('user_id', auth()->id())->first();


        if ($cart) {
            session()->forget('total_after_discount');
        }

        session()->forget('discount_amount');
        session()->forget('discount_percentage');
        session()->forget('discount_code');
        session()->forget('selected_items');

        return view('user.Cart', compact('cart'));
    }

    public function getCartData()
    {
        $cart = Cart::with('cartItems.product')->where('user_id', auth()->id())->first();
        return response()->json([
            'html' => view('cart.partials.cart_items', compact('cart'))->render()
        ]);
    }

    public function updateCartItem(Request $request, $id)
    {
        $cartItem = CartItem::findOrFail($id);
        $cartItem->quantity = $request->quantity;
        $cartItem->save();

        return response()->json(['message' => 'Giỏ hàng được cập nhật thành công!']);
    }

    public function removeCartItem(Request $request)
    {
        $request->validate([
            'item_id' => 'required|integer|exists:cart_items,id',
        ]);

        $cartItem = CartItem::findOrFail($request->item_id);
        $cartItem->delete();

        return response()->json(['message' => 'Sản phẩm đã bị xóa khỏi giỏ hàng!']);
    }

    public function removeAll(Request $request)
    {
        $cart = Cart::where('user_id', auth()->id())->first();

        if ($cart) {
            $cart->cartItems()->delete();
        }

        return response()->json(['message' => 'Tất cả sản phẩm đã được xóa khỏi giỏ hàng']);
    }

    public function updateQuantity(Request $request)
    {
        $cartItem = CartItem::find($request->item_id);

        if (!$cartItem) {
            return response()->json(['success' => false, 'message' => 'Sản phẩm không tồn tại trong giỏ hàng']);
        }

        $color = $cartItem->color; // Lấy thông tin màu sắc từ quan hệ
        if (!$color) {
            return response()->json(['success' => false, 'message' => 'Không tìm thấy thông tin màu sắc']);
        }

        // Kiểm tra nếu hết hàng
        if ($color->quantity === 0) {
            return response()->json([
                'success' => false,
                'message' => 'Sản phẩm này đã hết hàng',
                'max_quantity' => 0 // Đánh dấu hết hàng
            ]);
        }

        // Kiểm tra số lượng tồn kho
        if ($color->quantity < $request->quantity) {
            return response()->json([
                'success' => false,
                'message' => 'Số lượng sản phẩm không đủ trong kho',
                'max_quantity' => $color->quantity, // Trả về số lượng tối đa còn lại
            ]);
        }

        // Cập nhật số lượng giỏ hàng
        $cartItem->quantity = $request->quantity;
        $cartItem->save();

        // Tính lại tổng giá trị giỏ hàng (giữ nguyên logic cũ)
        $cart = Cart::find($cartItem->cart_id);
        $totalPrice = 0;

        foreach ($cart->cartItems as $item) {
            $productPrice = $item->product->price ?? 0;
            $variantPrice = $item->variant->price ?? 0;
            $batteryPrice = $item->battery->price ?? 0;
            $colorPrice = $item->color->price ?? 0;

            $totalPrice += ($productPrice + $variantPrice + $batteryPrice + $colorPrice) * $item->quantity;
        }

        session()->put('total_after_discount', $totalPrice);

        if (session()->has('discount_code') && session()->has('selected_items')) {
            $discountCode = DiscountCode::where('code', session('discount_code'))->first();
            if ($discountCode) {
                return $this->applyDiscountLogic($cart, $discountCode, session('selected_items'));
            }
        }

        return response()->json(['success' => true, 'message' => 'Số lượng đã được cập nhật']);
    }


    public function checkStock(Request $request)
    {
        $selectedItems = $request->input('selected_items');
        $outOfStockItems = [];

        foreach ($selectedItems as $itemId) {
            $cartItem = CartItem::find($itemId);
            if (!$cartItem || $cartItem->color->quantity < $cartItem->quantity) {
                $outOfStockItems[] = $cartItem->product->name_sp ?? 'Sản phẩm không xác định';
            }
        }

        if (count($outOfStockItems) > 0) {
            return response()->json([
                'success' => false,
                'message' => 'Một trong những sản phẩm bạn chọn đã hết hàng: ' . implode(', ', $outOfStockItems),
            ]);
        }

        return response()->json(['success' => true]);
    }


    public function selectItems(Request $request)
    {

        $request->validate([
            'selected_items' => 'required|array',
            'selected_items.*' => 'integer|exists:cart_items,id',
        ]);

        session()->put('selected_items', $request->selected_items);

        return response()->json([
            'success' => true,
            'message' => 'Sản phẩm đã được chọn cho thanh toán.',
        ]);
    }

    private function calculateTotalPrice($cart, $selectedItems)
    {
        $totalPrice = 0;

        foreach ($cart->cartItems as $item) {
            if (in_array($item->id, $selectedItems)) {
                $productPrice = $item->product->price ?? 0;
                $variantPrice = $item->variant->price ?? 0;
                // $batteryPrice = $item->battery->price ?? 0;
                $colorPrice = $item->color->price ?? 0;

                $totalPrice += ($productPrice + $variantPrice  + $colorPrice) * $item->quantity;
            }
        }

        return $totalPrice;
    }

    public function applyDiscount(Request $request)
    {
        $request->validate([
            'discount_code' => 'required|string|exists:discount_codes,code',
            'selected_items' => 'required|array',
            'selected_items.*' => 'integer|exists:cart_items,id',
        ]);

        $cart = Cart::where('user_id', auth()->id())->first();
        if (!$cart) {
            return response()->json(['success' => false, 'message' => 'Giỏ hàng trống.']);
        }

        $discountCode = DiscountCode::where('code', $request->discount_code)->first();
        if (!$discountCode) {
            return response()->json(['success' => false, 'message' => 'Mã giảm giá không hợp lệ.']);
        }

        if ($discountCode->usage_limit !== null && $discountCode->usage_limit <= 0) {
            return response()->json(['success' => false, 'message' => 'Mã giảm giá đã hết lượt sử dụng.']);
        }

        $today = now()->toDateString();
        if ($discountCode->start_date && $discountCode->start_date > $today) {
            return response()->json(['success' => false, 'message' => 'Mã giảm giá chưa có hiệu lực.']);
        }
        if ($discountCode->end_date && $discountCode->end_date < $today) {
            return response()->json(['success' => false, 'message' => 'Mã giảm giá đã hết hạn.']);
        }

        // Kiểm tra xem mã giảm giá có áp dụng cho toàn bộ giỏ hàng hay không bằng cách kiểm tra discount_code_product
        $hasSpecificProduct = DB::table('discount_code_product')
            ->where('discount_code_id', $discountCode->id)
            ->exists();

        if (!$hasSpecificProduct) {
            // Áp dụng cho toàn bộ giỏ hàng
            $validCartItems = $cart->cartItems;
        } else {
            // Lấy danh sách sản phẩm áp dụng mã giảm giá
            $applicableProductIds = DB::table('discount_code_product')
                ->where('discount_code_id', $discountCode->id)
                ->pluck('product_id')
                ->toArray();

            // Lọc sản phẩm hợp lệ
            $validCartItems = $cart->cartItems->whereIn('product_id', $applicableProductIds)
                ->whereIn('id', $request->selected_items);
        }

        // Lọc sản phẩm không hợp lệ
        $invalidCartItems = $cart->cartItems->whereNotIn('product_id', $validCartItems->pluck('product_id'))
            ->whereIn('id', $request->selected_items);

        if ($invalidCartItems->isNotEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'Một số sản phẩm không áp dụng được mã giảm giá.',
            ]);
        }

        if ($validCartItems->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'Mã giảm giá không áp dụng cho các sản phẩm đã chọn.',
            ]);
        }

        // Tính tổng giá trị
        $totalPriceSelectedItems = $this->calculateTotalPrice($cart, $request->selected_items);

        if ($totalPriceSelectedItems <= 0) {
            return response()->json(['success' => false, 'message' => 'Tổng giá trị sản phẩm không hợp lệ.']);
        }

        // Tính giảm giá
        $discountAmount = 0;
        $discountPercentage = 0;
        if ($discountCode->amount) {
            $discountAmount = min($discountCode->amount, $totalPriceSelectedItems);
        } elseif ($discountCode->percentage) {
            $discountPercentage = $discountCode->percentage;
            $discountAmount = $totalPriceSelectedItems * ($discountPercentage / 100);
        }

        $totalAfterDiscount = max($totalPriceSelectedItems - $discountAmount, 0);

        session()->put('total_after_discount', $totalAfterDiscount);
        session()->put('discount_amount', $discountAmount);
        session()->put('discount_code', $discountCode->code);
        session()->put('discount_percentage', $discountPercentage);

        return response()->json([
            'success' => true,
            'message' => 'Mã giảm giá đã được áp dụng thành công!',
            'total_price' => $totalPriceSelectedItems,
            'discount_amount' => $discountAmount,
            'discount_percentage' => $discountPercentage,
            'total_after_discount' => $totalAfterDiscount,
        ]);
    }



    private function applyDiscountLogic($cart, $discountCode = null, $selectedItems)
    {
        if (empty($selectedItems)) {
            return response()->json([
                'success' => false,
                'message' => 'Không có sản phẩm nào được chọn!',
            ]);
        }

        $totalPriceSelectedItems = 0;

        foreach ($cart->cartItems as $item) {
            if (in_array($item->id, $selectedItems)) {
                $productPrice = $item->product->price ?? 0;
                $variantPrice = $item->variant->price ?? 0;
                // $batteryPrice = $item->battery->price ?? 0;
                $colorPrice = $item->color->price ?? 0;

                $itemTotal = ($productPrice + $variantPrice  + $colorPrice) * $item->quantity;
                $totalPriceSelectedItems += $itemTotal;
            }
        }

        if (!$discountCode) {
            $cart->total_after_discount = $totalPriceSelectedItems;
            $cart->save();

            session(['total_after_discount' => $totalPriceSelectedItems]);

            return response()->json([
                'success' => true,
                'message' => 'Không áp dụng mã giảm giá!',
                'total_price' => $totalPriceSelectedItems,
                'discount_amount' => 0,
                'discount_percentage' => 0,
                'total_after_discount' => $totalPriceSelectedItems,
            ]);
        }

        $discountAmount = 0;
        if ($discountCode->amount) {
            $discountAmount = min($discountCode->amount, $totalPriceSelectedItems);
        } elseif ($discountCode->percentage) {
            $discountAmount = $totalPriceSelectedItems * ($discountCode->percentage / 100);
        }
        $totalAfterDiscount = max($totalPriceSelectedItems - $discountAmount, 0);

        $cart->total_after_discount = $totalAfterDiscount;
        $cart->save();

        session(['total_after_discount' => $totalAfterDiscount]);

        return response()->json([
            'success' => true,
            'message' => 'Mã giảm giá đã được áp dụng!',
            'total_price' => $totalPriceSelectedItems,
            'discount_amount' => $discountAmount,
            'total_after_discount' => $totalAfterDiscount,
        ]);
    }
}
