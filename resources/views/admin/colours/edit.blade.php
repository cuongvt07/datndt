

@extends('layouts.admin.master')

@section('content')
<h1>Sửa màu sắc</h1>
<form action="{{ route('colours.update', $colour) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="name" class="form-label">Tên màu</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ $colour->name }}" required>
    </div>
    <div class="mb-3">
      <label for="quantity" class="form-label">Số lượng</label>
      <input type="text" class="form-control" id="quantity" name="quantity" required>
  </div>
    <button style="margin-top: 20px" type="submit" class="btn btn-success">Sửa màu sắc</button>
</form>

@endsection