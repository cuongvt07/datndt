
@extends('layouts.admin.master')

@section('content')

<h1>Danh sách màn hình</h1>
<a href="{{ route('screens.create') }}" class="btn btn-primary">Thêm mới màn hình</a>

<table style="margin-top: 20px" class="table">

    <thead>
      <tr>
        <th>ID</th>
      <th>Tên</th>
      <th>Hành động</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($screens as $screen)
     <tr>
      <td>{{ $screen->id }} </td>
      <td>{{ $screen->name }} </td>
      <td>
        <a href="{{ route('screens.edit', $screen) }}"  class="btn btn-warning">Sửa</a>
      <form action="{{ route('screens.destroy', $screen) }}" method="POST" style="display:inline;">
          @csrf
          @method('DELETE')
          <button  class="btn btn-danger" type="submit">Xóa</button>
      </form>
      </td>
     </tr>
      
  @endforeach

    </tbody>


</table>

@endsection