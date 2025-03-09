
@extends('layouts.admin.master')

@section('content')

<h1>Danh sách pin</h1>
<a href="{{ route('batterys.create') }}" class="btn btn-primary">Thêm mới pin</a>

@if ($message = Session::get('success'))
    <p>{{ $message }}</p>
@endif

<table style="margin-top: 20px" class="table">
  <thead>
    <tr>
        <th>Id</th>
        <th>Tên </th>
        <th>Dung tích</th>                          
        <th>Hành động</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($batterys as $battery)
        <tr>
          <td>{{ $battery->id }}</td>
          <td>{{ $battery->name }}</td>
          <td>{{ $battery->capacity }}</td>
            <td>
                <a href="{{ route('batterys.edit', $battery->id) }}" class="btn btn-warning">Sửa</a>
                <form action="{{ route('batterys.destroy', $battery->id) }}" method="POST"
                    style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger"   type="submit">Xóa</button>
                </form>
            </td>
        </tr>
    @endforeach
  </tbody>
</table>

@endsection