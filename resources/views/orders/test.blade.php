@include('layouts.user.header')

@include('layouts.user.menu')
<div class="breadcrumb-area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb-wrap">
                    <nav aria-label="breadcrumb">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('index') }}"><i class="fa fa-home"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Đơn hàng đã hủy của tôi</li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container mt-5">
    <h2 class="text-center mb-4">Đơn hàng đã hủy</h2>
    <a href="{{ route('order') }}" class="btn btn-primary btn-lg px-4 py-2 rounded-pill shadow-sm">
        Đơn Hàng
    </a>
    <a href="{{ route('orders.completed') }}" class="btn btn-primary btn-lg px-4 py-2 rounded-pill shadow-sm">
        Đơn Hàng đã hoàn thành
    </a>
    @if ($completedAndCanceledOrders->count() > 0)
        <table class="table table-hover mt-4">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Trạng thái</th>
                    <th>Tỉnh/Thành</th>
                    <th>Quận/Huyện</th>
                    <th>Xã/Phường</th>
                    <th>Địa chỉ</th>
                    <th>Số điện thoại</th>
                    <th>Sản phẩm</th>
                    <th>Phí ship</th>
                    <th>Tổng tiền</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($completedAndCanceledOrders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>
                            @if ($order->status == 'completed')
                                <span class="badge badge-success">Đã hoàn thành</span>
                            @elseif ($order->status == 'canceled')
                                <span class="badge badge-danger">Đã hủy</span>
                            @endif
                        </td>

                        <td>{{ $order->province }}</td>
                        <td>{{ $order->district }}</td>
                        <td>{{ $order->ward }}</td>
                        <td>{{ $order->detail_address }}</td>
                        <td>{{ $order->phone }}</td>

                        <td>
                            @foreach ($order->orderItems as $item)
                                <div class="d-flex align-items-center mb-2">
                                    <img src="{{ asset('storage/' . $item->product->productImages->where('colour_id', $item->color_id)->first()->image_path) }}"
                                        alt="Product"
                                        style="max-width: 50px; max-height: 50px; object-fit: cover; margin-right: 10px;">
                                    <div>
                                        <strong>{{ $item->product->name_sp }}</strong> <br>
                                        <small>{{ $item->product->battery->capacity }}
                                            {{ $item->variant->ram_smartphone ?? 'Không có ram' }} |
                                            {{ $item->color->name }}</small><br>
                                        <small>Số lượng: {{ $item->quantity }}</small>
                                    </div>
                                </div>
                            @endforeach
                        </td>
                        <td>
                            <strong>{{ number_format($order->shipping_fee, 0, ',', '.') }} ₫</strong>
                        </td>
                        <td>
                            @if ($order->discount_amount == 0)
                                <strong
                                    style="font-size: 16px">{{ number_format($order->total_after_discount, 0, ',', '.') }}
                                    ₫</strong>
                            @else
                                <strong
                                    style="font-size: 16px; color: red;">{{ number_format($order->total_after_discount, 0, ',', '.') }}
                                    ₫</strong>
                                <br>
                                <span
                                    style="text-decoration: line-through; font-size: 12px;">{{ number_format($order->total_price, 0, ',', '.') }}
                                    ₫</span>
                                <br>
                                <span style="font-size: 12px; color: green;">Bạn tiết kiệm:
                                    {{ number_format($order->total_price - $order->total_after_discount, 0, ',', '.') }}
                                    ₫</span>
                            @endif
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="alert alert-info text-center" role="alert">
            Bạn chưa có đơn hàng nào đã hoàn thành.
        </div>
    @endif


</div>
@include('layouts.user.footer')
