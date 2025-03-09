<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Colour;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\Wishlist;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $wishlists = Wishlist::where('user_id', auth()->id())
        ->with('product')
        ->paginate(6); 
    
        $cart = Cart::with('cartItems.product')->where('user_id', auth()->id())->first();
        $cartItemCount = $cart ? $cart->cartItems->count() : 0;
        $categories = Category::all();
        $suppliers = Supplier::all();
        $colours = Colour::all();
        $user = auth()->user();

        // Lấy các tham số bộ lọc
        $supplierId = $request->supplier;
        $minPrice = $request->minPrice;
        $maxPrice = $request->maxPrice;
        $categoryId = $request->category;
        $keyword = $request->keyword;
        $selectedColours = $request->input('colour_id', []);

        // Lấy sản phẩm yêu thích của người dùng và áp dụng bộ lọc
        $productsQuery = $user->wishlist()->with(['category', 'supplier', 'colours']);

        if ($keyword) {
            $productsQuery->where('name_sp', 'like', '%' . $keyword . '%');
        }

        if ($categoryId) {
            $productsQuery->where('category_id', $categoryId);
        }

        if ($supplierId) {
            $productsQuery->where('supplier_id', $supplierId);
        }

        if ($minPrice && $maxPrice) {
            $productsQuery->whereBetween('price', [$minPrice, $maxPrice]);
        }

        if (!empty($selectedColours)) {
            $productsQuery->whereIn('colour_id', $selectedColours);
        }

        $products = $productsQuery->get();
        $wishlistItemCount = $wishlists->count();
        return view('user.wishlist.index', compact('wishlistItemCount', 'cartItemCount', 'suppliers', 'colours', 'categories', 'products', 'cart','wishlists'));
    }
    public function add(Request $request)
    {
        $userId = auth()->id();
        $productId = $request->product_id;

        if (!$userId) {
            return response()->json(['success' => false, 'message' => 'Bạn cần đăng nhập để yêu thích sản phẩm!']);
        }

        // Kiểm tra nếu sản phẩm đã được yêu thích
        $exists = Wishlist::where('user_id', $userId)->where('product_id', $productId)->exists();

        if ($exists) {
            return response()->json(['success' => false, 'message' => 'Sản phẩm này đã có trong danh sách yêu thích!']);
        }

        // Thêm sản phẩm vào wishlist
        Wishlist::create([
            'user_id' => $userId,
            'product_id' => $productId,
        ]);

        // Cập nhật số lượng sản phẩm trong wishlist vào session
        $wishlistItemCount = Wishlist::where('user_id', $userId)->count();
        session(['wishlistItemCount' => $wishlistItemCount]);

        return response()->json(['success' => true, 'message' => 'Đã thêm sản phẩm vào danh sách yêu thích!', 'wishlistItemCount' => $wishlistItemCount]);
    }




    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = auth()->user();
        $productId = $request->input('product_id');

        // Kiểm tra sản phẩm đã tồn tại trong danh sách yêu thích chưa
        if ($user->wishlist()->where('product_id', $productId)->exists()) {
            return response()->json(['message' => 'Sản phẩm đã có trong danh sách yêu thích'], 200);
        }

        // Thêm vào danh sách yêu thích
        $user->wishlist()->attach($productId);

        return response()->json(['message' => 'Đã thêm sản phẩm vào danh sách yêu thích'], 200);
    }

    public function destroy($id)
    {
        $userId = auth()->id();
        $wishlist = Wishlist::where('user_id', $userId)->where('product_id', $id)->first();

        if ($wishlist) {
            // Xóa sản phẩm khỏi wishlist
            $wishlist->delete();

            // Cập nhật lại số lượng wishlist trong session
            $wishlistItemCount = Wishlist::where('user_id', $userId)->count();
            session(['wishlistItemCount' => $wishlistItemCount]);

            return response()->json(['message' => 'Sản phẩm đã được xóa khỏi yêu thích', 'wishlistItemCount' => $wishlistItemCount], 200);
        }

        return response()->json(['message' => 'Không tìm thấy sản phẩm trong danh sách yêu thích'], 404);
    }
}
