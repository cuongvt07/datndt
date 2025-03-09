<?php

namespace App\Http\Controllers\User\account;

use App\Http\Controllers\Controller;
use Auth;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AccountController extends Controller
{
    public function index()
    {
        return view('user.account.index');
    }
    // Thay đổi thông tin 
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

        
        $user->name_user = $request->name_user;
        $user->email = $request->email;
        $user->sex = $request->sex;
        $user->date_of_birth = $request->date_of_birth;

        
        if ($request->hasFile('image')) {
            
            if ($user->image) {
                Storage::delete($user->image);
            }

           
            $path = $request->file('image')->store('images', 'public');
            $user->image = 'storage/' . $path;
        }

        
        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'Cập nhật tài khoản thành công!'
        ]);
    }


   
    public function changePassword(Request $request)
    {
       
        if (!Hash::check($request->current_password, Auth::user()->password)) {
            return response()->json([
                'success' => false,
                'error' => 'current_password',
                'message' => 'Mật khẩu hiện tại không đúng.'
            ]);
        }

      
        if ($request->new_password !== $request->new_password_confirmation) {
            return response()->json([
                'success' => false,
                'error' => 'confirmation',
                'message' => 'Mật khẩu xác nhận không trùng khớp.'
            ]);
        }

       
        $user = Auth::user();
        $user->password = Hash::make($request->new_password);
        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'Mật khẩu đã được thay đổi thành công!'
        ]);
    }




}
