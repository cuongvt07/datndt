<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">
@extends('layouts.admin.master')
@section('content')
<h1>Sản phẩm và Màu sắc</h1>

<!-- Form tìm kiếm sản phẩm theo từ khóa -->
<form method="GET" action="{{ route('colours.index') }}" class="mb-4" style="width:50%; margin-left: 400px;">
    <div class="input-group">
        <input type="text" class="form-control" name="search" placeholder="Tìm kiếm sản phẩm"
            value="{{ request()->get('search') }}">
        <button class="btn btn-primary" type="submit">Tìm kiếm</button>
    </div>
</form>

<a href="{{ route('colours.create') }}" class="btn btn-primary mb-4">Thêm màu sắc</a>

<!-- Loop qua từng sản phẩm -->
@foreach ($products as $product)
    <div class="card mb-3">
        <div class="card-header d-flex justify-content-between align-items-center">
            <p class="mb-0">{{ $product->name_sp }}</p>
            <button class="btn btn-primary btn-sm" data-bs-toggle="collapse"
                data-bs-target="#collapse-{{ $product->id }}">
                <i class="bi bi-plus"></i>
            </button>
        </div>

        <div id="collapse-{{ $product->id }}" class="collapse">
            <div class="card-body">
                <a href="{{ route('product_image.create') }}" class="btn btn-primary mb-3">Thêm mới hình ảnh</a>
                @if ($product->colours->isNotEmpty())
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Màu sắc</th>
                                <th>Số lượng</th>
                                <th>Giá</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($product->colours as $colour)
                                <tr>
                                    <td>{{ $colour->id }}</td>
                                    <td>{{ $colour->name }}</td>
                                    <td>{{ $colour->quantity }}</td>
                                    <td>{{ number_format($colour->price) }} VND</td>
                                    <td>
                                        <a href="{{ route('colours.edit', $colour->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                                        <form action="{{ route('colours.destroy', $colour->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="text-center">Chưa có màu sắc nào cho sản phẩm này.</p>
                @endif
            </div>
        </div>
    </div>
@endforeach

<div class="d-flex justify-content-center">
    {{ $products->links('pagination::bootstrap-5') }}
</div>

@endsection
