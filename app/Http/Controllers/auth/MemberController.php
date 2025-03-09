<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Post;
use App\Models\Product;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    //
    public function dashboard(){
        $cart = Cart::with('cartItems.product')->where('user_id', auth()->id())->first();
        $cartItemCount = $cart ? $cart->cartItems->count() : 0;
        $products = Product::limit(6)->get();  
        $posts = Post::all();       
        $recentPosts = Post::latest()->take(3)->get();

        return view('user.index',compact('recentPosts','posts','cart','cartItemCount', 'products'));
    }
}
