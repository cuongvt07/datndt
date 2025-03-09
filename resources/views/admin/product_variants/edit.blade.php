

@extends('layouts.admin.master')

@section('content')

<div class="container">
    <h1>Sửa Liên Kết Sản Phẩm - Biến Thể</h1>
    <form action="{{ route('product_variants.update', $productVariant->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="product_id" class="form-label">Sản Phẩm</label>
            <select name="product_id" id="product_id" class="form-control">
                @foreach ($products as $product)
                    <option value="{{ $product->id }}" {{ $product->id == $productVariant->product_id ? 'selected' : '' }}>
                        {{ $product->name_sp }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="variant_id" class="form-label">Biến Thể</label>
            <select name="variant_id" id="variant_id" class="form-control">
                @foreach ($variants as $variant)
                    <option value="{{ $variant->id }}" {{ $variant->id == $productVariant->variant_id ? 'selected' : '' }}>
                        {{ $variant->ram_smartphone }}
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Cập Nhật</button>
    </form>
</div>
@endsection


