
@extends('layouts.admin.master')

@section('content')

  
<form action="{{ route('variants.update', $variant->id) }}" method="POST">
  @csrf
  @method('PUT')
  <div>
      <label class="form-label" for="ram_smartphone">RAM Smartphone</label>
      <input class="form-control" type="text" name="ram_smartphone" value="{{ old('ram_smartphone', $variant->ram_smartphone) }}" required>
  </div>
  <div>
    <label class="form-label" for="price"> Price RAM Smartphone</label>
    <input class="form-control" type="number" name="price" value="{{ old('price', $variant->price) }}" required>
</div>
  <button style="margin-top: 20px" class="btn btn-primary" type="submit">Cập nhật</button>
</form>
@endsection