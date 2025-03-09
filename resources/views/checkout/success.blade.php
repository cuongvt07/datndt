@include('layouts.user.header')

{{-- Menu  --}}
@include('layouts.user.menu')

{{-- Content  --}}
<main>
    <!-- breadcrumb area start -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-wrap">
                        <nav aria-label="breadcrumb">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('index') }}"><i class="fa fa-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="{{ route('shop') }}">Cửa hàng</a></li>
                                <li class="breadcrumb-item" aria-current="page"><a href="{{ route('cart.show') }}">Đơn
                                        hàng</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Đặt hàng</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb area end -->
    <div class="container mt-5">
        <div class="text-center mb-4">
            <h2 class="text-success">Đặt hàng thành công</h2>
            <p>Cảm ơn bạn đã đặt hàng. Mã đơn hàng của bạn là: <strong>{{ $order->id }}</strong></p>
        </div>

        <div class="order-details">
            <h4>Thông tin giao hàng</h4>
            <br>
            <ul class="list-group mb-4">
                <li class="list-group-item"><strong>Tỉnh/Thành:</strong> {{ $order->province }}</li>
                <li class="list-group-item"><strong>Quận/Huyện:</strong> {{ $order->district }}</li>
                <li class="list-group-item"><strong>Xã/Phường:</strong> {{ $order->ward }}</li>
                <li class="list-group-item"><strong>Địa chỉ chi tiết:</strong> {{ $order->detail_address }}</li>
            </ul>
        </div>

        <h4>Chi tiết đơn hàng</h4>

        <table class="table table-hover table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Hình ảnh</th>
                    <th scope="col">Tên sản phẩm</th>
                    <th scope="col">Màu</th>
                    <th scope="col">Pin</th>
                    <th scope="col">RAM</th>
                    <th scope="col">Số lượng</th>
                    <th scope="col">Tổng giá</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orderItems as $item)
                    <tr>
                        <td>
                            <img src="{{ asset('storage/' . $item->product->productImages->where('colour_id', $item->color_id)->first()->image_path) }}"
                                alt="{{ $item->product->name_sp }}" width="80" class="img-fluid img-thumbnail">
                        </td>
                        <td>{{ $item->product->name_sp }}</td>
                        <td>{{ $item->color ? $item->color->name : 'Không có màu' }}</td>
                        <td>{{ $item->product->battery->capacity }}</td> 
                        <td>{{ $item->variant ? $item->variant->ram_smartphone : 'Không có' }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ number_format(($item->product->price + ($item->variant->price ?? 0) + ($item->color->price ?? 0)) * $item->quantity, 0, ',', '.') }}
                            VND</td>
                        
                    </tr>
                @endforeach
                <tr>
                    <td colspan="6" class="text-end"><strong>Phí vận chuyển:</strong></td>
                    <td><strong style="font-size: 16px"> {{ number_format($shippingFee, 0, ',', '.') }} ₫</strong></td>
                </tr>
                    <td colspan="6" class="text-end"><strong>Tổng tiền của tất cả sản phẩm:</strong></td>
                    <td>
                        @if ($discountAmount == 0)
                            <strong style="font-size: 16px">{{ number_format($totalAfterDiscount + $shippingFee, 0, ',', '.') }}
                                ₫</strong>
                        @else
                            <strong
                                style="font-size: 16px; color: red;">{{ number_format($totalAfterDiscount + $shippingFee, 0, ',', '.') }}
                                ₫</strong>
                            <br>
                            <span
                                style="text-decoration: line-through; font-size: 12px;">{{ number_format($totalPrice, 0, ',', '.') }}
                                ₫</span>
                            <br>
                            <span style="font-size: 12px; color: green;">Bạn tiết kiệm:
                                {{ number_format($totalPrice - $totalAfterDiscount, 0, ',', '.') }} ₫</span>
                        @endif
                    </td>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="mt-4 d-flex justify-content-center gap-3">
            <a href="{{ route('shop') }}" class="btn btn-sqr" style="margin-bottom: 10px">Tiếp tục mua hàng</a>
        </div>
    </div>
</main>


{{-- End content  --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Thêm vào cuối <body> -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
{{-- Footer  --}}

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@include('layouts.user.footer')
