<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Password;

class AuthController extends Controller
{

    public function dashboard()
    {
        return view('admin.dashboard');
    }



    public function showLoginForm()
    {
        return view('auth.login');
    }



    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        $credentials = $request->only('email', 'password');
    
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
    
            if ($user->role_id === User::ADMIN_TYPE || $user->role_id === User::STAFF_TYPE) {
                return redirect()->route('admin.dashboard')->with('status', 'Đăng nhập thành công!');
            } else {
                return redirect()->route('user.index')->with('status', 'Đăng nhập thành công!');
            }
        } else {
            return back()->withErrors([
                'email' => 'Email hoặc mật khẩu không chính xác.',
            ])->withInput();
        }
    }


    public function showRegistrationForm()
    {
        return view('auth.register');
    }


    public function register(Request $request)
    {


        $request->validate([
            'name_user' => [
                'required',
                'string',
                'max:30',
                'min:8',
                'regex:/^[\p{L}\p{N}\s]+$/u', 
            ],
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ], [
            'name_user.regex' => 'Tên không được chứa ký tự đặc biệt.',
            'name_user.min'=>'Tên phải ít nhất 8 kí tự',
            'name_user.max'=>'Tên không quá 30 ký tự',
            'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự.',
            'password.confirmed' => 'Xác nhận mật khẩu không đúng.',
            'email.unique' => 'Email đã có người sử dụng.',
        ]);
        

        try {
            User::create([
                'name_user' => $request->name_user,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'role_id' => User::MEMBER_TYPE,
            ]);
            return redirect()->route('login')->with('success', 'Đăng ký tài khoản thành công. Vui lòng đăng nhập.');
        } catch (\Exception $e) {
            return back()->withErrors(['register' => 'Đã xảy ra lỗi. Vui lòng thử lại.']);
        }
    }

    public function ForgotForm()
    {
        return view('auth.forgot_password');
    }
    public function showResetForm(Request $request, $token = null)
    {
        return view('auth.reset_password')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }


    public function sendPasswordResetLink(Request $request)
    {

        $request->validate([
            'email' => 'required|email|exists:users,email',
        ], [
            'email.exists' => 'Không tìm thấy tài khoản với địa chỉ email này.',
        ]);


        $status = Password::sendResetLink($request->only('email'));


        if ($status === Password::RESET_LINK_SENT) {

            return back()->with('status', 'Liên kết đặt lại mật khẩu đã được gửi thành công.');
        } else {
            return back()->withErrors(['email' => __($status)]);
        }
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:8|confirmed',
        ]);


        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->password = bcrypt($password);
                $user->save();
            }
        );


        if ($status === Password::PASSWORD_RESET) {

            return redirect()->route('login')->with('status', 'Mật khẩu của bạn đã được đặt lại thành công. Vui lòng đăng nhập.');
        } else {

            return back()->withErrors(['email' => [__($status)]]);
        }
    }


    public function logout(Request $request)
    {

        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        // Chuyển hướng đến trang chủ
        return redirect()->route('index');
    }
}
