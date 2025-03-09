<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Post;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        
        $cart = Cart::with('cartItems.product')->where('user_id', auth()->id())->first();
        $cartItemCount = $cart ? $cart->cartItems->count() : 0;
        $posts = Post::all();
        $categories = Category::limit(6)->get();
        $products = Product::where('is_active', true)->limit(6)->get();
        $Hot = Product::where('is_active', true)
        ->withCount('orderItems')
        ->having('order_items_count', '>', 2) 
        ->orderByDesc('order_items_count') 
        ->take(6) 
        ->get();

        $recentPosts = Post::latest()->take(3)->get();
        $all = Product::where('is_active', true)->latest()->take(6)->get();

        return view('user.index', compact('recentPosts', 'posts', 'cart', 'cartItemCount', 'categories', 'products', 'all', 'Hot'));

    }
}
