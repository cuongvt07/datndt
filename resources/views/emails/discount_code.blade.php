<!DOCTYPE html>
<html>
<head>
    <title>Mã giảm giá cho bạn</title>
</head>
<body>
    <h1>Chào {{ $user->name_user }},</h1>
    <p>Bạn đã nhận được mã giảm giá từ cửa hàng của chúng tôi!</p>
    <p><strong>Mã giảm giá: {{ $discountCode->code }}</strong></p>

    @if ($discountCode->amount)
        <p>Giảm theo số tiền: {{ number_format($discountCode->amount, 0, ',', '.') }} VNĐ</p>
    @else
        <p>Giảm theo phần trăm: {{ number_format($discountCode->percentage, 0) }}%</p>
    @endif

    <p>Ngày bắt đầu: {{ $discountCode->start_date }}</p>
    <p>Ngày kết thúc: {{ $discountCode->end_date }}</p>

    {{-- Hiển thị lượt sử dụng --}}
    <p>Lượt sử dụng: {{ $usageLimit }}</p> {{-- Thêm dòng này để hiển thị lượt sử dụng --}}

    {{-- Hiển thị danh sách sản phẩm --}}
    @if ($discountCode->products->count() > 0)
        <p>Mã giảm giá này chỉ áp dụng cho các sản phẩm sau:</p>
        <ul>
            @foreach ($discountCode->products as $product)
                <li>{{ $product->name_sp }}</li> {{-- Hiển thị tên sản phẩm --}}
            @endforeach
        </ul>
    @else
        <p>Mã giảm giá này áp dụng cho tất cả sản phẩm trên website của chúng tôi!</p>
    @endif
    
    <p>Sử dụng ngay để nhận ưu đãi tốt nhất!</p>
    <p>Xin cảm ơn!</p>
</body>
</html>
