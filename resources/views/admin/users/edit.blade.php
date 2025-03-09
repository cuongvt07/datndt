
@extends('layouts.admin.master')

@section('content')

  
<h1>Sửa Người Dùng</h1>

    <form action="{{ route('users.update', $user) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label>Tên</label>
            <input type="text" name="name_user" class="form-control" value="{{ $user->name_user }}" required>
        </div>
        <div>
            <label>Email</label>
            <input type="email" name="email"class="form-control" value="{{ $user->email }}" required>
        </div>
        <div>
            <label>Vai Trò</label>
            <select name="role_id" id="role_id" class="form-control" required>
                <option value="1" {{ $user->role_id === 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="2" {{ $user->role_id === 'employee' ? 'selected' : '' }}>Employee</option>
                <option value="3" {{ $user->role_id === 'user' ? 'selected' : '' }}>User</option>
            </select>
        </div>
        <br>
        <button type="submit" class="btn btn-success">Cập Nhật Người Dùng</button>
    </form>
@endsection