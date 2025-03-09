<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Battery;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Colour;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\Review;
use App\Models\Supplier;
use App\Models\User;
use App\Models\Variant;
use Illuminate\Http\Request;

class ProductUserController extends Controller
{
    public function index(Request $request)
    {
        // Lọc các tham số từ request
        $selectedColours = $request->input('colour_id', []);
        $keyword = $request->keyword;
        $categoryId = $request->category;
        $supplierId = $request->supplier;
        $minPrice = $request->minPrice;
        $maxPrice = $request->maxPrice;
    
        // Khởi tạo query cho sản phẩm
        $products = Product::query();
    
        // Áp dụng các bộ lọc nếu có
        if ($keyword) {
            $products->where('name_sp', 'like', '%' . $keyword . '%');
        }
    
        if ($categoryId) {
            $products->where('category_id', $categoryId);
        }
    
        if ($supplierId) {
            $products->where('supplier_id', $supplierId);
        }
    
        if ($minPrice && $maxPrice) {
            $products->whereBetween('price', [$minPrice, $maxPrice]);
        }
    
        // Phân trang, mỗi trang có 12 sản phẩm
        // $products = $products->paginate(9);
        $products = Product::where('is_active', true) // Chỉ lấy sản phẩm đang hoạt động
        ->paginate(9);
    
        // Lấy dữ liệu cho danh mục, nhà cung cấp, màu sắc
        $categories = Category::all();
        $suppliers = Supplier::all();

        $variants=Variant::all();
    
        // Lấy giỏ hàng và số lượng sản phẩm trong giỏ hàng
        $cart = Cart::with('cartItems.product')->where('user_id', auth()->id())->first();
        $cartItemCount = $cart ? $cart->cartItems->count() : 0;
    
        // Trả về view với dữ liệu
        return view('user.shop', compact('products', 'cart', 'cartItemCount', 'categories', 'suppliers','variants'))
            ->with('query', $request->all());
    }
    
    
    

    public function show($id)
    {
        $cart = Cart::with('cartItems.product')->where('user_id', auth()->id())->first();
        $cartItemCount = $cart ? $cart->cartItems->count() : 0;
        $product = Product::findOrFail($id);

        $variants = Variant::all();
        $batterys = Battery::all();
        $reviews = Review::where('product_id', $id)->get();
        $productVariants = ProductVariant::with('variant')->where('product_id', $id)->get();


        // Tính tổng số đánh giá và điểm đánh giá trung bình
        $totalReviews = $reviews->count();
        $averageRating = $reviews->avg('rating');
        
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->take(4) 
            ->get();

        return view('user.shop-single', compact('reviews','productVariants','product', 'variants', 'batterys', 'relatedProducts', 'cart', 'cartItemCount','totalReviews', 'averageRating'));
    }
    public function getColourQuantity($id)
    {
        $colour = Colour::find($id);
        if ($colour) {
            return response()->json(['quantity' => $colour->quantity]);
        } else {
            return response()->json(['quantity' => 0]);
        }
       
    }

    // Review 
    public function storeReview(Request $request, $productId)
{
    $request->validate([
        'rating' => 'required|integer|min:1|max:5',
        'comment' => 'required|string|max:1000',
    ]);

    Review::create([
        'product_id' => $productId,
        'user_id' => auth()->id(),
        'rating' => $request->rating,
        'comment' => $request->comment,
    ]);

    return redirect()->back()->with('success', 'Review submitted successfully.');
}

}
