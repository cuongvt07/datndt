<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Cart;
use App\Models\Wishlist;

class ShareInfoCart
{
    public function handle($request, Closure $next)
    {
        $cart = Cart::with('cartItems.product')->where('user_id', auth()->id())->first();
        $cartItemCount = $cart ? $cart->cartItems->count() : 0;
        $wishlists = Wishlist::where('user_id', auth()->id())
        ->with('product')
        ->paginate(6);
        $wishlistItemCount = $wishlists->count();

        view()->share('cartItemCount', $cartItemCount);
        view()->share('wishlistItemCount', $wishlistItemCount);

        return $next($request);
    }
}
