
@extends('layouts.admin.master')

@section('content')
<div class="container">
    <div class="container mt-4">
        <h1>Sửa sản phẩm</h1>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        <form action="{{ route('products.update', $product->id) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div>
                <label class="form-label" for="name_sp">Tên sản phẩm</label>
                <input class="form-control" type="text" name="name_sp"
                    value="{{ old('name_sp', $product->name_sp) }}" required>
            </div>
            <div>
                <label class="form-label" for="image">Ảnh sản phẩm</label>
                <input class="form-control" type="file" name="image" accept="image/*">
                @if ($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name_sp }}"
                        width="100" style="margin-top: 10px;">
                @endif
            </div>
            <div>
                <label class="form-label" for="stock">Số lượng</label>
                <input class="form-control" type="number" name="stock"
                    value="{{ old('stock', $product->stock) }}" required>
            </div>


            <div>
                <label class="form-label" for="description">Mô tả</label>
                <textarea class="form-control" name="description" required>{{ old('description', $product->description) }}</textarea>
            </div>

            <div>
                <label class="form-label" for="price">Giá</label>
                <input class="form-control" type="number" name="price"
                    value="{{ old('price', $product->price) }}" step="0.01" required>
            </div>

            <div>
                <label class="form-label" for="category_id">Danh mục</label>
                <select class="form-control" name="category_id" required>
                    <option value="">Chọn một danh mục</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ $product->category_id == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>


            <div>
                <label class="form-label" for="supplier_filter">Tìm kiếm nhà cung cấp</label>
                <input class="form-control mb-2" type="text" id="supplier_filter" placeholder="Nhập tên nhà cung cấp">
            </div>
            
            <div>
                <label class="form-label" for="supplier_id">Nhà cung cấp</label>
                <select class="form-control" name="supplier_id" id="supplier_id" required>
                    <option value="">Chọn một nhà cung cấp</option>
                    @foreach ($suppliers as $supplier)
                        <option value="{{ $supplier->id }}" 
                            {{ $product->supplier_id == $supplier->id ? 'selected' : '' }}>
                            {{ $supplier->brand }}
                        </option>
                    @endforeach
                </select>
            </div>
            

            @if ($product->variant_id)
                <div>
                    <label class="form-label" for="variant_id">Dung Lượng</label>
                    <select class="form-control" name="variant_id" >
                        <option value="">Chọn dung lượng</option>
                        @foreach ($variants as $variant)
                            <option value="{{ $variant->id }}"
                                {{ $product->variant_id == $variant->id ? 'selected' : '' }}>
                                {{ $variant->ram_smartphone }}
                            </option>
                        @endforeach
                    </select>
                </div>
            @endif


            <button style="margin-top: 20px" class="btn btn-primary" type="submit">Cập nhật sản
                phẩm</button>
        </form>
    </div>
</div>
<script>
    document.getElementById('supplier_filter').addEventListener('input', function () {
        const filter = this.value.toLowerCase();
        const options = document.querySelectorAll('#supplier_id option');

        options.forEach(option => {
            const text = option.textContent.toLowerCase();
            if (text.includes(filter) || option.value === "") {
                option.style.display = "";
            } else {
                option.style.display = "none";
            }
        });
    });
</script>

@endsection
