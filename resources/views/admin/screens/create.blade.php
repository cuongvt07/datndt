

@extends('layouts.admin.master')

@section('content')

<h1>Thêm mới màn hình</h1>
<form action="{{ route('screens.store') }}" method="POST">
    @csrf
    <label class="form-label" for="name">Tên màn hình:</label>
    <input class="form-control"  type="text" name="name" id="name" required>
    <button  style="margin-top: 20px" type="submit" class="btn btn-primary">Thêm</button>
</form>

@endsection