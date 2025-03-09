@extends('layouts.admin.master')

@section('content')
    <h2 style="margin-top: 100px;margin-left: 600px;">Quản lý đơn hàng</h2>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="col-12 mb-3 search-bar">
        <form id="search-form" action="{{ route('admin.orders.completed') }}" method="GET" style="margin-top: 30px">
            <div class="row justify-content-center align-items-center">
                <div class="col-md-6">
                    <input type="text" class="form-control" value="{{ request()->input('keyword') }}" name="keyword"
                        id="keyword" placeholder="Tìm kiếm đơn hàng...">
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary w-100">Tìm kiếm</button>
                </div>
            </div>
        </form>
    </div>

    <div class="container mt-5">
        <h3 class="order-title" style="color: #28a745">Đơn hàng đã hoàn thành</h3>
        <a href="{{ route('admin.orders') }}" class="btn btn-primary">Đơn hàng đang xử lý</a>
        <a href="{{ route('admin.orders.canceled') }}" class="btn btn-danger">Đơn hàng đã hủy</a>

        <table class="table table-hover mt-3">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Người đặt</th>
                    <th>Số điện thoại</th>
                    <th>Địa chỉ</th>
                    <th>Sản phẩm</th>
                    <th>Phí ship</th>
                    <th>Tổng giá</th>

                    <th>Trạng thái</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($completedOrders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->user->name_user ?? 'khách online' }}</td>
                        <td>{{ $order->phone }}</td>
                        <td>{{ $order->detail_address }}</td>
                        <td>
                            @foreach ($order->orderItems as $item)
                                {{ $item->product->name_sp }}<br>
                            @endforeach
                        </td>

                        <td>
                            <strong>{{ number_format($order->shipping_fee, 0, ',', '.') }} ₫</strong>
                        </td>
                        <td>
                            @if($order->user_id)
                                <strong style="font-size: 12px">{{ number_format($order->total_after_discount + $order->shipping_fee, 0, ',', '.') }} ₫</strong>
                            @else
                                <strong style="font-size: 12px">{{ number_format($order->total_price + $order->shipping_fee, 0, ',', '.') }} ₫</strong>
                            @endif
                        </td>

                        <td><span class="badge badge-success">Đã hoàn thành</span></td>
                        <td><a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-info btn-sm">Chi tiết</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $completedOrders->links() }} {{-- Pagination links --}}
    </div>
@endsection
