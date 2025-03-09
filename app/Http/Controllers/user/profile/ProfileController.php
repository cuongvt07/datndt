<?php

namespace App\Http\Controllers\User\profile;

use Auth;
use Hash;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    //
    public function index(){
        return view('user.profile.index');
    }
    public function update(Request $request)
    {
        $request->validate([
            'name_user' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'sex' => 'required|string',
            'date_of_birth' => 'required|date',
            'image' => 'nullable|image',
        ]);

        $user = Auth::user();

        // Cập nhật thông tin người dùng
        $user->name_user = $request->name_user;
        $user->email = $request->email;
        $user->sex = $request->sex;
        $user->date_of_birth = $request->date_of_birth;

        // Xử lý hình ảnh
        if ($request->hasFile('image')) {
            // Xóa hình ảnh cũ nếu có
            if ($user->image) {
                Storage::delete($user->image);
            }

            // Lưu hình ảnh mới
            $path = $request->file('image')->store('images', 'public');
            $user->image = 'storage/' . $path;
        }

        // Lưu thay đổi
        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'Cập nhật tài khoản thành công!'
        ]);
    }


    // Thay đổi mật khẩu 
    public function changePassword(Request $request)
    {
        // Xác thực mật khẩu hiện tại
        if (!Hash::check($request->current_password, Auth::user()->password)) {
            return response()->json([
                'success' => false,
                'error' => 'current_password',
                'message' => 'Mật khẩu hiện tại không đúng.'
            ]);
        }

        // Kiểm tra xem mật khẩu xác nhận có khớp không
        if ($request->new_password !== $request->new_password_confirmation) {
            return response()->json([
                'success' => false,
                'error' => 'confirmation',
                'message' => 'Mật khẩu xác nhận không trùng khớp.'
            ]);
        }

        // Thay đổi mật khẩu
        $user = Auth::user();
        $user->password = Hash::make($request->new_password);
        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'Mật khẩu đã được thay đổi thành công!'
        ]);
    }
}
