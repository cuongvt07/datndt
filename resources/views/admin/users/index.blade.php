<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">
@extends('layouts.admin.master')

@section('content')

  
<h1>Danh sách người dùng</h1>

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<a href="{{ route('users.create') }}" class="btn btn-primary mb-3">Thêm mới người dùng</a>
<form action="{{ route('users.index') }}" method="GET" class="mb-3">
    <div class="input-group">
        <input type="text" name="search" class="form-control" placeholder="Tìm kiếm người dùng..." value="{{ request('search') }}">
        <button class="btn btn-primary" type="submit">Tìm kiếm</button>
    </div>
</form>

<table class="table table-bordered">
    <thead>
        <tr>
          <th>Tên</th>
          <th>Email</th>
          <th>Vai Trò</th>
          <th>Hành Động</th>
        </tr>
    </thead>
    <tbody>
      @foreach ($users as $user)
      <tr>
          <td>{{ $user->name_user }}</td>
          <td>{{ $user->email }}</td>
          <td>{{ $user->role->name ?? '' }}</td>
          <td>
              <a href="{{ route('users.edit', $user) }}" class="btn btn-primary">Sửa</a>
              <form action="{{ route('users.destroy', $user) }}" method="POST" style="display:inline;">
                  @csrf
                  @method('DELETE')
                  <button  class="btn btn-danger" type="submit">Xóa</button>
              </form>
          </td>
      </tr>
      @endforeach
    </tbody>
</table>
<div class="d-flex justify-content-center">
    {{ $users->links('pagination::bootstrap-5') }}
</div>
@endsection