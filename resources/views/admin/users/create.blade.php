
@extends('layouts.admin.master')

@section('content')

<h1>Thêm Người Dùng</h1>
        
<form action="{{ route('users.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="name" class="form-label">Tên</label>
        <input type="text" name="name_user" class="form-control" id="name_user" >
        @error('name_user')
      <div class="text-danger">{{ $message }}</div>
  @enderror
    </div>
  
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" name="email" class="form-control" id="email" >
        @error('email')
        <div class="text-danger">{{ $message }}</div>
    @enderror
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Mật Khẩu</label>
        <input type="password" name="password" class="form-control" id="password" >
        @error('password')
        <div class="text-danger">{{ $message }}</div>
    @enderror
    </div>
    <div class="mb-3">
        <label for="password_confirmation" class="form-label">Xác Nhận Mật Khẩu</label>
        <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" required >
    </div>
    <div class="mb-3">
        <label for="role_id" class="form-label">Vai Trò</label>
        <select name="role_id" class="form-select" id="role_id" >
            <option value="1">Admin</option>
            <option value="2">Employee</option>
            <option value="3">User</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Thêm Người Dùng</button>
</form>

@endsection