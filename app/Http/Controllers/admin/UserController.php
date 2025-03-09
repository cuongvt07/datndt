<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $roles = Role::all();
    
        $search = $request->input('search');
    
        $users = User::when($search, function ($query, $search) {
            $query->where('name_user', 'LIKE', "%{$search}%")
                  ->orWhere('email', 'LIKE', "%{$search}%");
        })->paginate(9);

        return view('admin.users.index', compact('users', 'roles'));
    }
    

    public function create()
    {
        $users = User::all();
        $roles=Role::all();
        return view('admin.users.create', compact('roles','users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name_user' => 'required',
            'email' => 'required',
            'password' => 'required',
            'role_id' => 'nullable|in:1,2,3',
        ],[
            'name_user.required' => 'Trường này bắt buộc phải nhập.',
            'email.required'=> 'Trường này bắt buộc phải nhập.',
            'password.required' => 'Trường này bắt buộc phải nhập.',
        ]);

        User::create([
            'name_user' => $request->name_user,
            'email' => $request->email,
            'password' => $request->password,
            'role_id' => $request->role_id,
        ]);

        return redirect()->route('users.index')->with('success', 'Người dùng đã được thêm.');
    }

    public function edit(User $user)
    {
        $roles=Role::all();
        return view('admin.users.edit', compact('user','roles'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name_user' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'role_id' => 'required|in:1,2,3',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $data = [
            'name_user' => $request->name_user,
            'email' => $request->email,
            'role_id' => $request->role_id,
        ];

        if ($request->filled('password')) {
            $data['password'] = $request->password;

        }

        $user->update($data);

        return redirect()->route('users.index')->with('success', 'Người dùng đã được cập nhật.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'Người dùng đã được xóa.');
    }
}
