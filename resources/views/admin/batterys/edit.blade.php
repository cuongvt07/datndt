
@extends('layouts.admin.master')

@section('content')

<h1>Sửa pin</h1>

@if ($errors->any())
    <div>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('batterys.update', $battery->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div>
        <label class="form-label" for="nme">Tên</label>
        <input class="form-control" type="text" name="name" value="{{ $battery->name }}">
    </div>
    <div>
      <label class="form-label" for="capacity">Dung tích</label>
      <input class="form-control" type="text" name="capacity" value="{{ $battery->capacity }}">
    </div>
    <div>
      <label class="form-label" for="price">Giá</label>
      <input class="form-control" type="number" name="price" value="{{ $battery->price }}" required>
    </div>

    <button style="margin-top: 20px" class="btn btn-primary" type="submit">Cập nhật</button>
</form>

@endsection