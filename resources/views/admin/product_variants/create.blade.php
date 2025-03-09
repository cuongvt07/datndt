@extends('layouts.admin.master')

@section('content')
<div class="container">
    <h1>Thêm Liên Kết Sản Phẩm - Biến Thể</h1>
    
    <form action="{{ route('product_variants.create') }}" method="GET">
       
        <div class="mb-3">
            <label for="name_sp" class="form-label">Tìm Kiếm Sản Phẩm</label>
            <input type="text" name="name_sp" id="name_sp" class="form-control" value="{{ request('name_sp') }}" placeholder="Tên sản phẩm">
        </div>
        <button type="submit" class="btn btn-secondary">Lọc</button>
    </form>
    
    <form action="{{ route('product_variants.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="product_id" class="form-label">Sản Phẩm</label>
            <select name="product_id" id="product_id" class="form-control">
                @foreach ($products as $product)
                    <option value="{{ $product->id }}">{{ $product->name_sp }}</option>
                @endforeach
            </select>
            @error('product_id')
      <div class="text-danger">{{ $message }}</div>
  @enderror
        </div>
        <div class="mb-3">
            <label for="variant_id" class="form-label">Biến Thể</label>
            <select name="variant_id" id="variant_id" class="form-control">
                @foreach ($variants as $variant)
                    <option value="{{ $variant->id }}">{{ $variant->ram_smartphone }}</option>
                @endforeach
            </select>
            @error('variant_id')
      <div class="text-danger">{{ $message }}</div>
  @enderror
        </div>
        <button type="submit" class="btn btn-primary">Thêm</button>
    </form>
</div>
@endsection
<script>
    public function create(Request $request)
{
    $query = Product::query();

    if ($request->filled('category_id')) {
        $query->where('category_id', $request->category_id);
    }

    if ($request->filled('name_sp')) {
        $query->where('name_sp', 'like', '%' . $request->name_sp . '%');
    }

    $products = $query->get();

    $variants = Variant::all(); 

    return view('admin.product_variants.create', compact('products', 'categories', 'variants'));
}

</script>