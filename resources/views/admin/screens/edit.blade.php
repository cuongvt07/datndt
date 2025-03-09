

@extends('layouts.admin.master')

@section('content')

<h1>Chỉnh Sửa Màn Hình</h1>
<form action="{{ route('screens.update', $screen->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label class="form-label" for="name">Tên Màn Hình</label>
        <input class="form-control"  type="text" class="form-control" id="name" name="name" value="{{ $screen->name }}" required>
    </div>
    <button type="submit" class="btn btn-primary">Cập Nhật</button>
</form>

@endsection