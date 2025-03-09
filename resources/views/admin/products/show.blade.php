

@extends('layouts.admin.master')

@section('content')

<h1>{{ $product->name_sp }}</h1>

<div class="card">
    <div class="card-body">
        @if($product->image)
            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name_sp }}" class="img-fluid mb-3">
        @endif
        <p><strong>Description:</strong> {{ $product->description }}</p>
        <p><strong>Price:</strong> {{ number_format($product->price, 2) }} VNĐ</p>
        <p><strong>Colour:</strong> {{ $product->colour->name ?? 'Đen xám' }}</p>
        <p><strong>Screen:</strong> {{ $product->screen->name ?? 'N/A' }}</p>
        <p><strong>Ram:</strong> {{ $product->variant->ram_smartphone ?? 'N/A' }}</p>
        <p><strong>Battery:</strong> {{ $product->battery->capacity ?? 'N/A' }}</p>
        <p><strong>Category:</strong> {{ $product->category->name ?? 'N/A' }}</p>
        <p><strong>Supplier:</strong> {{ $product->supplier->brand ?? 'N/A' }}</p>
    </div>
    <div class="card-footer">
        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning">Edit Product</a>
        <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete Product</button>
        </form>
        <a href="{{ route('products.index') }}" class="btn btn-secondary">Back to Products</a>
    </div>
</div>

@endsection
