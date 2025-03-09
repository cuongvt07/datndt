@extends('layouts.user.header')

@section('content')
<div class="container mt-5">
    <div class="text-center">
        <h2 class="text-danger">Thanh toán thất bại</h2>
        <p>Đã xảy ra lỗi trong quá trình thanh toán. Vui lòng thử lại.</p>
        <a href="{{ route('shop') }}" class="btn btn-sqr">Tiếp tục mua hàng</a>
    </div>
</div>
@endsection

@include('layouts.user.footer')