
@extends('layouts.admin.master')

@section('content')

<form action="{{ route('variants.store') }}" method="POST">
  @csrf
  <div>
      <label class="form-label" for="ram_smartphone" >RAM Smartphone</label>
      <input class="form-control" type="text" name="ram_smartphone" >
      @error('ram_smartphone')
      <div class="text-danger">{{ $message }}</div>
  @enderror
  </div>
  <div>
    <label class="form-label" for="price" >Price RAM Smartphone</label>
    <input class="form-control" type="number" name="price" >
    @error('price')
    <div class="text-danger">{{ $message }}</div>
@enderror
</div>
  <button style="margin-top: 20px" class="btn btn-primary" type="submit">Tạo mới ram</button>
</form>

@endsection