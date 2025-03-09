
@extends('layouts.admin.master')

@section('content')

<h1>Thêm nhà cung cấp</h1>
<form action="{{ route('suppliers.store') }}" method="POST">
    @csrf
    <div>
        <label class="form-label" for="name">Tên nhà cung cấp</label>
        <input  class="form-control"  type="text" name="name" >
        @error('name')
        <div class="text-danger">{{ $message }}</div>
    @enderror
    </div>
    
    <div>
        <label  class="form-label" for="brand">Thương hiệu</label>
        <input  class="form-control" type="text" name="brand" >
        @error('brand')
        <div class="text-danger">{{ $message }}</div>
    @enderror
    </div>
    <div>
        <label class="form-label" for="category_id">Danh mục</label>
        <select  class="form-control" name="category_id" >
            <option value="">Chọn một danh mục</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
        @error('category_id')
        <div class="text-danger">{{ $message }}</div>
    @enderror
        
    </div>
    <button style="margin-top: 20px" type="submit" class="btn btn-primary">Thêm nhà cung cấp</button>
</form>

@endsection