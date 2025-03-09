<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">
@extends('layouts.admin.master')
@section('content')
    <div class="container mt-4">
        <h1>Sản phẩm</h1>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <div class="row justify-content-center align-items-center">
            <div class="col-3">
                <a href="{{ route('products.create') }}" class="btn btn-primary btn-block">Thêm sản phẩm</a>
            </div>
            <div class="col-9">
                <form id="search-form" action="{{ route('products.index') }}" method="GET">
                    <div class="row justify-content-center align-items-center">
                        <div class="col-6">
                            <input type="text" class="form-control" value="{{ request()->input('keyword') }}"
                                name="keyword" id="keyword">
                        </div>
                        <div class="col-3">
                            <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                        </div>
                    </div>
                </form>
            </div>

            <div id="product-list">
                @include('admin.products.partials.product_list', ['products' => $products])
            </div>

            <div class="d-flex justify-content-center">
                {{ $products->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
@endsection
