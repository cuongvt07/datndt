@extends('layouts.admin.master')

@section('content')
    <form action="{{ route('admin.orders.store') }}" method="POST">
        @csrf
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-6 ">
                    <div class="card shadow-lg" style="width: 1230px;">
                        <div class="card-header bg-primary text-white">
                            <p class="mb-0">Tạo Đơn Hàng</p>
                        </div>
                        <div class="card-body">
                            <div class="form-group mb-3">
                                <label for="status">Trạng thái</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="pending">Chờ xử lý</option>
                                    <option value="confirmed">Đã xác nhận</option>
                                    <option value="delivering">Đang giao</option>
                                    <option value="completed">Đã hoàn thành</option>
                                    <option value="canceled">Đã hủy</option>
                                </select>
                            </div>
                    
                            <div class="form-group mb-3">
                                <label for="phone">Số điện thoại</label>
                                <input type="text" name="phone" id="phone" class="form-control">
                                @error('phone')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                    
                            <div class="form-group mb-3">
                                <label for="detail_address">Địa chỉ chi tiết</label>
                                <input type="text" name="detail_address" id="detail_address" class="form-control">
                                @error('detail_address')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                    
                            <div class="form-group row mb-3">
                                <div class="col-md-4">
                                    <label for="province">Tỉnh</label>
                                    <select id="tinh" name="province" class="form-select">
                                        <option value="">Chọn Tỉnh Thành</option>
                                    </select>
                                    @error('province')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                    
                                <div class="col-md-4">
                                    <label for="district">Quận</label>
                                    <select id="quan" name="district" class="form-select">
                                        <option value="">Chọn Quận Huyện</option>
                                    </select>
                                    @error('district')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                    
                                <div class="col-md-4">
                                    <label for="ward">Phường</label>
                                    <select id="phuong" name="ward" class="form-select">
                                        <option value="">Chọn Phường Xã</option>
                                    </select>
                                    @error('ward')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                    
                            <div class="form-group mb-3">
                                <label for="product_search">Tìm sản phẩm</label>
                                <input type="text" id="product_search" class="form-control" placeholder="Enter product name">
                            </div>
                    
                            <div class="form-group mb-3">
                                <label for="product_id">Sản phẩm</label>
                                <select name="product_id" id="product_id" class="form-control">
                                    @foreach ($products as $product)
                                        <option value="{{ $product->id }}" data-price="{{ $product->price }}">{{ $product->name_sp }}</option>
                                    @endforeach
                                </select>
                                @error('product_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                    
                            <div class="form-group mb-3">
                                <label for="variant_id">Biến thể</label>
                                <select name="variant_id" id="variant_id" class="form-control">
                                    <option value="">Chọn biến thể</option>
                                    @foreach ($variants as $variant)
                                        <option value="{{ $variant->id }}" data-price="{{ $variant->extra_price }}">
                                            {{ $variant->ram_smartphone }}</option>
                                    @endforeach
                                </select>
                            </div>
                    
                            {{-- <div class="form-group mb-3">
                                <label for="color_search">Tìm màu</label>
                                <input type="text" id="color_search" class="form-control" placeholder="Enter color name">
                            </div> --}}
                            
                            <div class="form-group mb-3">
                                <label for="color_id">Màu sắc</label>
                                <select name="color_id" id="color_id" class="form-control">
                                    <option value="">Chọn màu sắc</option>
                                    @foreach ($colours as $color)
                                        <option value="{{ $color->id }}" data-price="{{ $color->extra_price }}">{{ $color->name }}</option>
                                    @endforeach
                                </select>
                                @error('color_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            
                    
                    
                            <div class="form-group mb-3">
                                <label for="battery_id">Pin</label>
                                <select name="battery_id" id="battery_id" class="form-control">
                                    <option value="">Chọn pin</option>
                                    @foreach ($batterys as $battery)
                                        <option value="{{ $battery->id }}">{{ $battery->capacity }}</option>
                                    @endforeach
                                </select>
                            </div>
                    
                            <div class="form-group mb-3">
                                <label for="quantity">Số lượng</label>
                                <input type="number" name="quantity" id="quantity" class="form-control" value="1" min="1">
                                @error('quantity')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                    
                            <div class="form-group mb-3">
                                <label for="shipping_fee">Phí vận chuyển</label>
                                <input type="number" name="shipping_fee" id="shipping_fee" class="form-control">
                            </div>
                    
                    
                            <div class="form-group mb-3">
                                <label for="price">Giá</label>
                                <input type="number" name="price" id="price" class="form-control" readonly>
                            </div>
                    
                            <div class="form-group mb-3">
                                <label for="total_price">Tổng giá</label>
                                <input type="number" name="total_price" id="total_price" class="form-control" readonly>
                            </div>
                    
                            <button type="submit" class="btn btn-success w-100">Lưu</button>
    
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </form>
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Tìm kiếm sản phẩm
        $('#product_search').on('keyup', function() {
            let query = $(this).val();
            $.ajax({
                url: "{{ route('admin.products.search') }}",
                type: "GET",
                data: {
                    query: query
                },
                success: function(data) {
                    let options = '<option value="">Chọn sản phẩm</option>';
                    data.forEach(product => {
                        options +=
                            `<option value="${product.id}" data-price="${product.price}">${product.name_sp}</option>`;
                    });
                    $('#product_id').html(options);
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        });

        // Tải dữ liệu tỉnh, quận, phường
        let provinces = {},
            districts = {},
            wards = {};

        $.getJSON('https://esgoo.net/api-tinhthanh/1/0.htm', function(data_tinh) {
            if (data_tinh.error == 0) {
                $.each(data_tinh.data, function(key_tinh, val_tinh) {
                    provinces[val_tinh.id] = val_tinh.full_name;
                    $("#tinh").append('<option value="' + val_tinh.id + '">' + val_tinh
                        .full_name + '</option>');
                });

                // Tải quận khi tỉnh thay đổi
                $("#tinh").change(function() {
                    var idtinh = $(this).val();
                    $.getJSON('https://esgoo.net/api-tinhthanh/2/' + idtinh + '.htm', function(
                        data_quan) {
                        if (data_quan.error == 0) {
                            $("#quan").html(
                            '<option value="">Chọn Quận Huyện</option>');
                            $("#phuong").html(
                                '<option value="">Chọn Phường Xã</option>');
                            $.each(data_quan.data, function(key_quan, val_quan) {
                                districts[val_quan.id] = val_quan.full_name;
                                $("#quan").append('<option value="' + val_quan
                                    .id + '">' + val_quan.full_name +
                                    '</option>');
                            });
                        }
                    });
                });

                // Tải phường khi quận thay đổi
                $("#quan").change(function() {
                    var idquan = $(this).val();
                    $.getJSON('https://esgoo.net/api-tinhthanh/3/' + idquan + '.htm', function(
                        data_phuong) {
                        if (data_phuong.error == 0) {
                            $("#phuong").html(
                                '<option value="">Chọn Phường Xã</option>');
                            $.each(data_phuong.data, function(key_phuong, val_phuong) {
                                wards[val_phuong.id] = val_phuong.full_name;
                                $("#phuong").append('<option value="' +
                                    val_phuong.id + '">' + val_phuong
                                    .full_name + '</option>');
                            });
                        }
                    });
                });
            }
        });

        // Tính phí vận chuyển
        function calculateShippingFee() {
            let province = $('#tinh').val();
            let shippingFee = 0;


            if (province === '01') {
                shippingFee = 25000;
            } else if (['24', '27', '42', '30', '35', '33', '17', '36', '19', '37'].includes(province)) {
                shippingFee = 30000;
            } else {
                shippingFee = 40000;
            }

            $('#shipping_fee').val(shippingFee);
        }

        $('#tinh').on('change', function() {
            calculateShippingFee();
        });

        // Tính tổng giá
        $('#quantity, #product_id, #variant_id, #color_id').on('change', function() {
            let quantity = $('#quantity').val();
            let productPrice = $('#product_id option:selected').data('price') || 0;
            let variantPrice = $('#variant_id option:selected').data('price') || 0;
            let colorPrice = $('#color_id option:selected').data('price') || 0;
            let shippingFee = $('#shipping_fee').val();

            let totalPrice = (productPrice + variantPrice + colorPrice) * quantity + parseInt(
                shippingFee);
            $('#price').val(productPrice + variantPrice + colorPrice);
            $('#total_price').val(totalPrice);
        });
    });
</script>

{{-- <script>
   $(document).ready(function () {
   
    $('#color_search').on('keyup', function () {
        let query = $(this).val().toLowerCase();
        $.ajax({
            url: "{{ route('admin.colors.search') }}",
            type: "GET",
            data: { query: query },
            success: function (data) {
                let options = '<option value="">Chọn màu sắc</option>';
                data.forEach(color => {
                    options += `<option value="${color.id}" data-price="${color.extra_price}">${color.name}</option>`;
                });
                $('#color_id').html(options);
            },
            error: function (xhr, status, error) {
                console.error(error);
            }
        });
    });
});

</script> --}}