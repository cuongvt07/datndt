<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">
@extends('layouts.admin.master')
@section('content')

<h1>Nhà cung cấp</h1>
<a href="{{ route('suppliers.create') }}" class="btn btn-primary">Thêm nhà cung cấp</a>

<!-- Form tìm kiếm -->
<form method="GET" action="{{ route('suppliers.index') }}" class="mt-4" style="width:50%; margin-left: 400px;">
    <div class="input-group">
        <input type="text" name="search" id="search" class="form-control" value="{{ request('search') }}" placeholder="Nhập tên hoặc thương hiệu">
        <button type="submit" class="btn btn-info">Tìm kiếm</button>
    </div>
</form>

<!-- Bảng nhà cung cấp -->
<table style="margin-top: 20px" class="table">
    <thead>
        <tr>
            <th>Tên</th>
            <th>Thương hiệu</th>
            <th>Danh mục</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($suppliers as $supplier)
            <tr>
                <td>{{ $supplier->name }}</td>
                <td>{{ $supplier->brand }}</td>
                <td>{{ $supplier->category->name }}</td>
                <td>
                    <a href="{{ route('suppliers.edit', $supplier) }}" class="btn btn-sm btn-warning">Sửa</a>
                    <form action="{{ route('suppliers.destroy', $supplier) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Xóa</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<div class="d-flex justify-content-center">
    {{ $suppliers->links('pagination::bootstrap-5') }}
</div>

@endsection
