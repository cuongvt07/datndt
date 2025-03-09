@extends('layouts.admin.master')

@section('content')
<div class="container mt-4">
    <table class="table ">
        <a href="{{ route('admin.discount_codes.create') }}" class="btn btn-primary btn-block mb-3">Tạo mã giảm
            giá</a>

        <thead >
            <tr>
                <th>ID</th>
                <th>Mã giảm giá</th>
                <th>Giảm theo</th>
                <th>Giới hạn sử dụng</th>
                <th>Ngày bắt đầu</th>
                <th>Ngày kết thúc</th>
                <th>Áp dụng cho</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($discountCodes as $discountCode)
                <tr>
                    <td>{{ $discountCode->id }}</td>
                    <td>{{ $discountCode->code }}</td>
                    <td>
                        @if ($discountCode->amount)
                            {{ number_format($discountCode->amount) }} VNĐ
                        @else
                            {{ number_format($discountCode->percentage, 0) }}%
                        @endif
                    </td>
                    <td>{{ $discountCode->usage_limit }}</td>
                    <td>{{ $discountCode->start_date }}</td>
                    <td>{{ $discountCode->end_date }}</td>
                    <td>
                        @if ($discountCode->products->isEmpty())
                            Tất cả sản phẩm
                        @else
                            Sản phẩm cụ thể
                        @endif
                    </td>
                    <td >
                        <!-- Nút để gửi mã giảm giá tới tất cả khách hàng -->
                        <form action="{{ route('admin.discount_codes.sendToAll') }}" method="POST" style="display:inline;">
                            @csrf
                            <input type="hidden" name="discount_code_id" value="{{ $discountCode->id }}">
                            <button type="submit" class="btn btn-sm btn-primary">Gửi tới tất cả khách
                                hàng</button>
                        </form>

                        <!-- Nút để chọn khách hàng cụ thể và gửi mã giảm giá -->
                        <a href="{{ route('admin.discount_codes.selectUsers', $discountCode->id) }}"
                            class="btn btn-sm btn-info">Chọn khách hàng</a>

                        <!-- Sửa và Xóa mã giảm giá -->
                        <a href="{{ route('admin.discount_codes.edit', $discountCode->id) }}"
                            class="btn btn-sm btn-warning">Sửa</a>
                        <form action="{{ route('admin.discount_codes.destroy', $discountCode->id) }}" method="POST"
                            style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Xóa</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
