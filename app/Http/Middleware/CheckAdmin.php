<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Route;
use Symfony\Component\HttpFoundation\Response;

class CheckAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
{
    if (Auth::check()) {
        // Nếu là admin
        if (Auth::user()->role_id == User::ADMIN_TYPE || Auth::user()->role_id == User::STAFF_TYPE) {
            return $next($request);
        }
        // Nếu là member, chuyển hướng đến trang người dùng
        elseif (Auth::user()->role_id == User::MEMBER_TYPE) {
            return redirect()->route('user.index'); // Trang user
        }
    }

    // Nếu chưa đăng nhập hoặc không có quyền admin
    return redirect()->route('login');
}

}
