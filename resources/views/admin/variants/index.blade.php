
@extends('layouts.admin.master')

@section('content')

  
<h1>Dung lượng</h1>
<a href="{{ route('variants.create') }}" class="btn btn-primary">Thêm mới ram</a>
@if ($variants->count())
<table  style="margin-top: 20px" class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Dung lượng (Smartphone)</th>
            <th>Giá</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody>
        @foreach($variants as $variant)
            <tr>
                <td>{{ $variant->id }}</td>
                <td>{{ $variant->ram_smartphone }}</td>
                <td>{{ number_format($variant->price) }} đ</td>
                <td>
                    <a href="{{ route('variants.edit', $variant->id) }}" class="btn btn-warning">Sửa</a>
                    <form action="{{ route('variants.destroy', $variant->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button  type="submit" class="btn btn-danger">Xóa</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@else
<p>No Variant.</p>
@endif
@endsection