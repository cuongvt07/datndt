

@extends('layouts.admin.master')

@section('content')

<h1 class="">Thêm danh mục mới</h1>
<form action="{{ route('categories.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label class="form-label" for="name">Tên danh mục</label>
        <input type="text" name="name" id="name" class="form-control" required>

        @if ($errors->has('name'))
            <span class="text-danger">{{ $errors->first('name') }}</span>
        @endif
    </div>
    <button style="margin-left: 10px;" type="submit" class="btn btn-success mt-3">Tạo danh mục</button>
</form>

@endsection