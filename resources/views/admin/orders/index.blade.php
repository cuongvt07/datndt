<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">
@extends('layouts.admin.master')
@section('content')
    <h2 style="margin-top: 100px;margin-left: 600px;">Quản lý đơn hàng</h2>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <a href="{{ route('admin.orders.create') }}" class="btn btn-primary">Tạo mới đơn hàng</a>

    {{-- resources/views/admin/orders/index.blade.php --}}
    <div class="col-12 mb-3 search-bar">
        <form id="search-form" action="{{ route('admin.orders') }}" method="GET" style="margin-top: 30px">
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
        {{-- Processing Orders --}}
        <h3 class="order-title" style="color: rgb(208, 208, 20)">Đơn hàng đang xử lý</h3>
        <a href="{{ route('admin.orders.completed') }}" class="btn btn-success">Đơn hàng đã hoàn thành</a>
        <a href="{{ route('admin.orders.canceled') }}" class="btn btn-primary">Đơn hàng đã hủy</a>
        <table class="table table-hover mt-3">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Người đặt</th>
                    <th>Số điện thoại</th>
                    <th>Địa chỉ</th>
                    <th>Sản phẩm</th>
                    <th>Tổng giá</th>
                    <th>Trạng thái</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    @if ($order->status == 'pending' || $order->status == 'confirmed' || $order->status == 'delivering')
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->user->name_user ?? 'Khách online' }}</td>
                            <td>{{ $order->phone }}</td>
                            <td>{{ $order->detail_address }}</td>
                            <td>
                                @foreach ($order->orderItems as $item)
                                    {{ $item->product->name_sp }}<br>
                                @endforeach
                            </td>
                            <td>
                                @if($order->user_id)
                                    <strong style="font-size: 12px">{{ number_format($order->total_after_discount + $order->shipping_fee, 0, ',', '.') }} ₫</strong>
                                @else
                                    <strong style="font-size: 12px">{{ number_format($order->total_price + $order->shipping_fee, 0, ',', '.') }} ₫</strong>
                                @endif
                            </td>
                            <td>
                                <span class="badge badge-warning">
                                    @if ($order->status == 'pending')
                                        Chờ xác nhận
                                    @elseif ($order->status == 'confirmed')
                                        Đã xác nhận
                                    @elseif ($order->status == 'delivering')
                                        Đang giao hàng
                                    @endif
                                </span>
                            </td>
                            <td><a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-info btn-sm">Chi
                                    tiết</a></td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>

  
        <div class="d-flex justify-content-center">
            {{ $orders->links('pagination::bootstrap-5') }}
        </div>
    </div>

    <style>
        .badge-warning {
            background-color: #ffc107;
            color: #212529;
        }

        .badge-success {
            background-color: #28a745;
            color: white;
        }
    </style>

    <script>
        $(document).ready(function() {
            $('.btn[data-bs-toggle="collapse"]').click(function() {
                $(this).find('i').toggleClass('bi-plus bi-dash');
            });
        });
    </script>

    <style>
        .order-container {
            border: 1px solid #c4c7cb;
            width: 1500px;
            margin-left: 50px;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            background-color: #ffffffe2;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .order-title {
            margin-bottom: 20px;
        }

        .card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .status-badge {
            padding: 0.5em 0.75em;
            border-radius: 20px;
            color: white;
        }

        .status-pending {
            background-color: #ffc107;
            /* Yellow */
        }

        .status-delivering {
            background-color: #17a2b8;
            /* Teal */
        }

        .status-completed {
            background-color: #28a745;
            /* Green */
        }

        .status-canceled {
            background-color: #dc3545;
            /* Red */
        }

        .search-bar {
            margin-bottom: 20px;
        }
    </style>
@endsection
