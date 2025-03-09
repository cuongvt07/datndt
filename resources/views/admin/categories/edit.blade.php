
@extends('layouts.admin.master')

@section('content')

<h1 class="">Sửa danh mục</h1>

<!-- Form để chỉnh sửa category -->
<form action="{{ route('categories.update', $category->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="form-group">
        <label for="name">Tên danh mục</label>
        <input type="text" name="name" id="name" class="form-control"
            value="{{ $category->name }}" required>

        @if ($errors->has('name'))
            <span class="text-danger">{{ $errors->first('name') }}</span>
        @endif
    </div>
    <button type="submit" class="btn btn-success mt-3">Cập nhật</button>
</form>

@endsection