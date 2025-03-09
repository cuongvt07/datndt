@extends('layouts.admin.master')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap JS (và jQuery) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>

    <div class="container mt-5">
        <h5 style="margin-top: 40px">Sửa mã giảm giá</h5>
        <form action="{{ route('admin.discount_codes.update', $discountCode->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="code">Mã giảm giá</label>
                <input type="text" name="code" id="code" class="form-control" value="{{ $discountCode->code }}"
                    required>
            </div>

            <div class="form-group">
                <label for="discount_type">Loại giảm giá:</label>
                <select name="discount_type" id="discount_type" class="form-control" required>
                    <option value="percentage" {{ $discountCode->percentage ? 'selected' : '' }}>Giảm theo %</option>
                    <option value="fixed" {{ $discountCode->amount ? 'selected' : '' }}>Giảm số tiền cố định</option>
                </select>
            </div>

            <!-- Phần input giảm giá -->
            <div id="discount_fields">
                <div class="form-group" id="amount_field"
                    style="{{ $discountCode->amount ? 'display: block;' : 'display: none;' }}">
                    <label for="amount">Số tiền giảm:</label>
                    <input type="number" name="amount" id="amount" class="form-control"
                        value="{{ $discountCode->amount }}">
                </div>

                <div class="form-group" id="percentage_field"
                    style="{{ $discountCode->percentage ? 'display: block;' : 'display: none;' }}">
                    <label for="percentage">Phần trăm giảm:</label>
                    <input type="number" name="percentage" id="percentage" class="form-control"
                        value="{{ $discountCode->percentage }}" min="0" max="100">
                    <small class="form-text text-muted">Giá trị phải nằm trong khoảng từ 0 đến 100.</small>
                </div>
            </div>

            <div class="form-group">
                <label for="usage_limit">Giới hạn sử dụng</label>
                <input type="number" name="usage_limit" id="usage_limit" class="form-control"
                    value="{{ $discountCode->usage_limit }}">
            </div>

            <div class="form-group">
                <label for="start_date">Ngày bắt đầu</label>
                <input type="date" name="start_date" id="start_date" class="form-control"
                    value="{{ $discountCode->start_date }}" required>
            </div>

            <div class="form-group">
                <label for="end_date">Ngày kết thúc</label>
                <input type="date" name="end_date" id="end_date" class="form-control"
                    value="{{ $discountCode->end_date }}" required>
            </div>

            <div class="form-group">
                <label for="product_selection">Áp dụng cho:</label>
                <select name="product_selection" id="product_selection" class="form-control">
                    <option value="all" {{ $discountCode->products->isEmpty() ? 'selected' : '' }}>Tất cả sản phẩm
                    </option>
                    <option value="specific" {{ !$discountCode->products->isEmpty() ? 'selected' : '' }}>Chọn sản phẩm cụ
                        thể
                    </option>
                </select>
            </div>

            <!-- Hiển thị danh sách sản phẩm khi chọn "Chọn sản phẩm cụ thể" -->
            <div class="form-group" id="specific_products"
                style="{{ !$discountCode->products->isEmpty() ? 'display: block;' : 'display: none;' }}">
                <label for="selected_products">Chọn sản phẩm</label>
                <ul class="list-group">
                    @foreach ($products as $product)
                        <li class="list-group-item d-flex align-items-center">
                            <input class="form-check-input me-1" type="checkbox" name="selected_products[]"
                                value="{{ $product->id }}"
                                {{ $discountCode->products->contains($product->id) ? 'checked' : '' }}>
                            <img src="{{ asset('storage/' . $product->image) }}" class="img-thumbnail me-2"
                                alt="{{ $product->name_sp }}" style="width: 50px; height: 50px;">
                            <span>{{ $product->name_sp }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>



            <button type="submit" class="btn btn-success">Cập nhật</button>
        </form>
    </div>
    <script>
        document.getElementById('product_selection').addEventListener('change', function() {
            var selection = this.value;
            if (selection === 'specific') {
                document.getElementById('specific_products').style.display = 'block';
            } else {
                document.getElementById('specific_products').style.display = 'none';
                document.querySelectorAll('input[name="selected_products[]"]').forEach(function(checkbox) {
                    checkbox.checked = false;
                });
            }
        });

        document.getElementById('discount_type').addEventListener('change', function() {
            var discountType = this.value;
            if (discountType === 'fixed') {
                document.getElementById('amount_field').style.display = 'block';
                document.getElementById('percentage_field').style.display = 'none';
                document.getElementById('percentage').value = '';
            } else {
                document.getElementById('amount_field').style.display = 'none';
                document.getElementById('percentage_field').style.display = 'block';
                document.getElementById('amount').value = '';
            }
        });

        // Kiểm tra và cập nhật giá trị của các input khi submit form
        document.querySelector('form').addEventListener('submit', function(event) {
            var discountType = document.getElementById('discount_type').value;
            var amount = document.getElementById('amount').value;
            var percentage = document.getElementById('percentage').value;

            // Chỉ cho phép có 1 loại giảm giá được chọn (không thể có cả số tiền và % cùng lúc)
            if ((discountType === 'fixed' && amount === '') || (discountType === 'percentage' && percentage ===
                    '')) {
                alert('Bạn chỉ có thể chọn một loại giảm giá duy nhất (số tiền hoặc phần trăm).');
                event.preventDefault();
            }

            // Kiểm tra khoảng giá trị hợp lệ cho phần trăm
            if (discountType === 'percentage') {
                var percentageValue = parseFloat(percentage);
                if (percentageValue < 0 || percentageValue > 100) {
                    alert('Phần trăm giảm giá phải nằm trong khoảng từ 0 đến 100.');
                    event.preventDefault();
                }
            }
        });
    </script>
@endsection
