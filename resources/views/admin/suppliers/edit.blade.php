
@extends('layouts.admin.master')

@section('content')
<h1>Sửa nhà cung cấp</h1>

<form action="{{ route('suppliers.update', $supplier->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div>
        <label class="form-label" for="name">Tên nhà cung cấp</label>
        <input class="form-control" type="text" name="name"
            value="{{ old('name', $supplier->name) }}" required>
    </div>

    <div>
        <label class="form-label" for="brand">Thương hiệu</label>
        <input class="form-control" type="text" name="brand"
            value="{{ old('brand', $supplier->brand) }}" required>
    </div>

    <div>
        <label class="form-label" for="category_id">Danh mục</label>
        <select class="form-control" name="category_id" required>
            <option value="">Select a category</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}"
                    {{ $supplier->category_id == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
    </div>

    <button style="margin-top: 20px" class="btn btn-primary" type="submit">Cập nhật nhà cung
        cấp</button>

</form>
  

@endsection