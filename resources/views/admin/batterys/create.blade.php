
@extends('layouts.admin.master')

@section('content')

<h1>Thêm mới pin</h1>

@if ($errors->any())
    <div>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('batterys.store') }}" method="POST">
    @csrf

    <div>
        <label class="form-label" for="name">Tên</label>
        <input class="form-control" type="text" name="name" placeholder="Name">
    </div>
    <div>
      <label class="form-label" for="capacity">Dung tích</label>
      <input class="form-control" type="text" name="capacity" placeholder="Capacity">
    </div>
    <div>
      <label class="form-label" for="price">Giá</label>
      <input class="form-control" type="number" name="price" placeholder="price" required>
    </div>

    <button style="margin-top: 20px" class="btn btn-primary"  type="submit">Thêm</button>
</form>
  

@endsection