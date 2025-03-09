<?php echo $__env->make('layouts.user.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<?php echo $__env->make('layouts.user.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<main>

    <!-- breadcrumb area start -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-wrap">
                        <nav aria-label="breadcrumb">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?php echo e(route('index')); ?>"><i class="fa fa-home"></i></a>
                                </li>
                                <li class="breadcrumb-item"><a href="<?php echo e(route('shop')); ?>">Cửa hàng</a></li>
                                <li class="breadcrumb-item" aria-current="page"><a href="<?php echo e(route('cart.show')); ?>">Giỏ
                                        hàng</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Đặt hàng</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
   
    <div class="container mt-4">
        <?php if(  $selectedCartItems->count() > 0): ?>
        <h2 class="text-center mb-4 text-success">Thông tin giao hàng</h2>
        <form action="<?php echo e(route('checkout.handle')); ?>" method="POST" id="checkout-form">
            <?php echo csrf_field(); ?>

            <!-- Thông tin địa chỉ giao hàng -->
            <div class="row mb-3">
                <div class="col-md-12">
                    <input type="text" class="form-control" name="detail_address" placeholder="Địa chỉ chi tiết"
                        id="detail_address">
                    <div id="address-error" class="text-danger mt-2" style="display: none;">Địa chỉ không được bỏ trống.
                    </div>

                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4">
                    <select id="tinh" name="province" class="form-select" title="Chọn Tỉnh Thành" required>
                        <option value="0">Tỉnh Thành</option>
                    </select>
                    <div id="province-error" class="text-danger mt-2" style="display: none;">Vui lòng chọn tỉnh thành.
                    </div>
                </div>
                <div class="col-md-4">
                    <select id="quan" name="district" class="form-select" title="Chọn Quận Huyện" required>
                        <option value="0">Quận Huyện</option>
                    </select>
                    <div id="district-error" class="text-danger mt-2" style="display: none;">Vui lòng chọn quận huyện.
                    </div>
                </div>
                <div class="col-md-4">
                    <select id="phuong" name="ward" class="form-select" title="Chọn Phường Xã" required>
                        <option value="0">Phường Xã</option>
                    </select>
                    <div id="ward-error" class="text-danger mt-2" style="display: none;">Vui lòng chọn phường xã.</div>
                </div>
            </div>

            <div class="form-group">
                <label for="shipping_fee">Phí vận chuyển:</label>
                <input type="text" id="shipping_fee" class="form-control" readonly>
            </div>
            <!-- Số điện thoại -->
            <div class="row mb-3">
                <div class="col-md-12">
                    <label for="phone" class="form-label">Số điện thoại</label>
                    <input type="text" class="form-control" id="phone" name="phone" required>
                    <div id="phone-error" class="text-danger mt-2" style="display: none;">Vui lòng nhập đúng định dạng
                        số điện thoại.</div>
                </div>
            </div>

            <!-- Phương thức thanh toán -->
            <h3 class="mt-4">Phương thức thanh toán</h3>
            <br>
            <div class="form-check mb-3">
                <input class="form-check-input" type="radio" name="payment_method" id="cash" value="cash"
                    required>
                <label class="form-check-label" for="cash">Thanh toán tiền mặt</label>
            </div>

            <div class="form-check mb-3">
                <input class="form-check-input" type="radio" name="payment_method" id="online_payment" value="online"
                    required>
                <label class="form-check-label" for="online_payment">Thanh toán trực tuyến (VNPay)</label>
            </div>

            <!-- Nút submit -->
            <button type="submit" class="btn btn-sqr" id="checkout-button">Xác nhận thanh toán</button>
        </form>

        <!-- Cart Items Section -->
        <div class="cart-items mt-5">
            <h3 class="text-center">Sản phẩm trong giỏ hàng</h3>
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Hình ảnh</th>
                            <th>Tên sản phẩm</th>
                            <th>Màu sắc</th>
                            <th>Dung lượng pin</th>
                            <th>RAM</th>
                            <th>Số lượng</th>
                            <th>Tổng tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $totalAmount = 0;
                        ?>

                        <?php $__currentLoopData = $selectedCartItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $itemTotal =
                                    ($item->product->price +
                                        ($item->variant->price ?? 0) +
                                        ($item->color->price ?? 0)) *
                                    $item->quantity;
                                $totalAmount += $itemTotal + $shippingFee;
                            ?>
                            <tr>
                                <td>
                                    <img src="<?php echo e(asset('storage/' . $item->product->productImages->where('colour_id', $item->color_id)->first()->image_path)); ?>"
                                        alt="<?php echo e($item->product->name_sp); ?>" width="100">
                                </td>
                                <td><?php echo e($item->product->name_sp); ?></td>
                                <td><?php echo e($item->color->name); ?></td>

                                <td><?php echo e($item->product->battery->capacity); ?></td>
                                <td><?php echo e($item->variant ? $item->variant->ram_smartphone : 'Không có'); ?></td>
                                <td> <?php echo e($item->quantity); ?> </td>
                                <td><?php echo e(number_format($itemTotal, 0, ',', '.')); ?> VND</td>


                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php if(session('discount_code')): ?>
                            <tr>
                                <td colspan="6" class="text-end"><strong>Mã giảm giá:</strong></td>
                                <td><?php echo e(session('discount_code')); ?></td>
                            </tr>
                        <?php endif; ?>

                        <?php if(session('discount_percentage') > 0): ?>
                            <tr>
                                <td colspan="6" class="text-end"><strong>Số phần trăm giảm:</strong></td>
                                <td><?php echo e(session('discount_percentage')); ?>%</td>
                            </tr>
                        <?php endif; ?>

                        <?php if(session('discount_amount') > 0): ?>
                            <tr>
                                <td colspan="6" class="text-end"><strong>Số tiền giảm:</strong></td>
                                <td><?php echo e(number_format(session('discount_amount'), 0, ',', '.')); ?> ₫</td>
                            </tr>
                        <?php endif; ?>
                        <tr>

                            <td colspan="6" class="text-end"><strong>Tổng tiền của tất cả sản phẩm:</strong></td>
                            <td>
                                <?php if($totalAmount == $totalAfterDiscount): ?>
                                    <strong id="grand_total" style="font-size: 16px">
                                        <?php echo e(number_format($totalAfterDiscount + $shippingFee, 0, ',', '.')); ?> ₫
                                    </strong>
                                <?php else: ?>
                                    <strong id="grand_total" style="font-size: 16px;color:red">
                                        <?php echo e(number_format($totalAfterDiscount + $shippingFee, 0, ',', '.')); ?> ₫
                                    </strong>
                                    <br>
                                    <span style="text-decoration: line-through; font-size: 12px;">
                                        <?php echo e(number_format($total, 0, ',', '.')); ?> ₫
                                    </span>
                                    <br>
                                    <span style="font-size: 12px; color: green;">Bạn tiết kiệm:
                                        <?php echo e(number_format($totalAmount - $totalAfterDiscount, 0, ',', '.')); ?> ₫</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <?php else: ?>
       <p style="padding: 90px"> Bạn chưa chọn sản phẩm nào để thanh toán.</p>
    <?php endif; ?>
    </div>
    
    <!-- breadcrumb area end -->
    
</main>




<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
<script src="https://esgoo.net/scripts/jquery.js"></script>
<!-- Bootstrap JS -->
<script src="<?php echo e(asset('asset-user/js/vendor/bootstrap.bundle.min.js')); ?>"></script>
<!-- Countdown JS -->
<script src="<?php echo e(asset('asset-user/js/plugins/countdown.min.js')); ?>"></script>
<!-- Nice Select JS -->
<script src="<?php echo e(asset('asset-user/js/plugins/nice-select.min.js')); ?>"></script>
<!-- jquery UI JS -->
<script src="<?php echo e(asset('asset-user/js/plugins/jqueryui.min.js')); ?>"></script>
<!-- Image zoom JS -->
<script src="<?php echo e(asset('asset-user/js/plugins/image-zoom.min.js')); ?>"></script>
<!-- Images loaded JS -->
<script src="<?php echo e(asset('asset-user/js/plugins/imagesloaded.pkgd.min.js')); ?>"></script>
<!-- mail-chimp active js -->
<script src="<?php echo e(asset('asset-user/js/plugins/ajaxchimp.js')); ?>"></script>
<!-- contact form dynamic js -->
<script src="<?php echo e(asset('asset-user/js/plugins/ajax-mail.js')); ?>"></script>
<script src="<?php echo e(asset('asset-user/js/plugins/google-map.js')); ?>"></script>
<!-- Main JS -->
<script src="<?php echo e(asset('asset-user/js/main.js')); ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
    let provinces = {};
    let districts = {};
    let wards = {};

    $(document).ready(function() {
        $.getJSON('https://esgoo.net/api-tinhthanh/1/0.htm', function(data_tinh) {
            if (data_tinh.error == 0) {
                $.each(data_tinh.data, function(key_tinh, val_tinh) {
                    provinces[val_tinh.id] = val_tinh.full_name;

                    $("#tinh").append('<option value="' + val_tinh.id + '">' + val_tinh
                        .full_name + '</option>');
                });


                $("#tinh").change(function(e) {
                    var idtinh = $(this).val();

                    $.getJSON('https://esgoo.net/api-tinhthanh/2/' + idtinh + '.htm', function(
                        data_quan) {
                        if (data_quan.error == 0) {
                            $("#quan").html('<option value="0">Quận Huyện</option>');
                            $("#phuong").html('<option value="0">Phường Xã</option>');
                            $.each(data_quan.data, function(key_quan, val_quan) {
                                districts[val_quan.id] = val_quan.full_name;
                                $("#quan").append('<option value="' + val_quan
                                    .id + '">' + val_quan.full_name +
                                    '</option>');
                            });
                            $("#quan").change(function(e) {
                                var idquan = $(this).val();
                                $.getJSON('https://esgoo.net/api-tinhthanh/3/' +
                                    idquan + '.htm',
                                    function(data_phuong) {
                                        if (data_phuong.error == 0) {
                                            $("#phuong").html(
                                                '<option value="0">Phường Xã</option>'
                                            );
                                            $.each(data_phuong.data,
                                                function(key_phuong,
                                                    val_phuong) {
                                                    wards[val_phuong
                                                            .id] =
                                                        val_phuong
                                                        .full_name;
                                                    $("#phuong").append(
                                                        '<option value="' +
                                                        val_phuong
                                                        .id + '">' +
                                                        val_phuong
                                                        .full_name +
                                                        '</option>');
                                                });
                                        }
                                    });
                            });
                        }
                    });
                });
            }
        });
    });
    window.addEventListener('pageshow', function(event) {
        if (event.persisted) {
            window.location.reload();
        }
    });
</script>
<script>
    document.getElementById('checkout-form').addEventListener('submit', function (event) {
        let isValid = true;

        // Validate số điện thoại
        const phoneInput = document.getElementById('phone');
        const phoneError = document.getElementById('phone-error');
        const phoneRegex = /^0\d{9}$/;

        if (!phoneRegex.test(phoneInput.value)) {
            phoneError.style.display = 'block';
            isValid = false;
        } else {
            phoneError.style.display = 'none';
        }

        // Validate địa chỉ
        const addressInput = document.getElementById('detail_address');
        const addressError = document.getElementById('address-error');

        if (addressInput.value.trim() === '') {
            addressError.style.display = 'block';
            isValid = false;
        } else {
            addressError.style.display = 'none';
        }

        // Validate Tỉnh/Thành phố
        const provinceSelect = document.getElementById('tinh');
        const provinceError = document.getElementById('province-error');
        if (provinceSelect.value === '0') {
            provinceError.style.display = 'block';
            isValid = false;
        } else {
            provinceError.style.display = 'none';
        }

        // Validate Quận/Huyện
        const districtSelect = document.getElementById('quan');
        const districtError = document.getElementById('district-error');
        if (districtSelect.value === '0') {
            districtError.style.display = 'block';
            isValid = false;
        } else {
            districtError.style.display = 'none';
        }

        // Validate Phường/Xã
        const wardSelect = document.getElementById('phuong');
        const wardError = document.getElementById('ward-error');
        if (wardSelect.value === '0') {
            wardError.style.display = 'block';
            isValid = false;
        } else {
            wardError.style.display = 'none';
        }

        // Ngăn form submit nếu có lỗi
        if (!isValid) {
            event.preventDefault();
        }
    });
</script>
<script>
    function calculateShippingFee() {
        let province = document.getElementById('tinh').value;

        let shippingFee = 0;
        const nearHanoi = ['24', '27', '42', '30', '35', '33', '17', '36', '19', '37'];
        const nearQuangNinh = ['22'];
        const nearHoChiMinh = ['79', '77', '74', '75', '80', '82', '83', '84', '87', '70', '72', '96', '92', '93', '91',
            '94', '86'
        ];
        const phiabac = ['10', '20', '04', '02', '14', '08', '11'];

        // Logic tính phí vận chuyển
        if (province === '01') {
            shippingFee = 25000;
        } else if (nearHanoi.includes(province)) {
            shippingFee = 30000;
        } else if (nearQuangNinh.includes(province)) {
            shippingFee = 50000;
        } else if (phiabac.includes(province)) {
            shippingFee = 40000;
        } else if (nearHoChiMinh.includes(province)) {
            shippingFee = 80000;
        } else if (province === '0') {
            shippingFee = 0;
        } else {
            shippingFee = 55000;
        }

        // Cập nhật phí vận chuyển trên giao diện
        document.getElementById('shipping_fee').value = shippingFee.toLocaleString('vi-VN') + ' VND';

        // Tính lại tổng tiền
        let totalAfterDiscount = parseFloat('<?php echo e($totalAfterDiscount); ?>'); // Giá trị từ backend
        let grandTotal = totalAfterDiscount + shippingFee;

        // Cập nhật tổng tiền
        document.getElementById('grand_total').innerHTML = `
        ${grandTotal.toLocaleString('vi-VN')} ₫
    `;
    }


    document.getElementById('tinh').addEventListener('change', calculateShippingFee);
    document.getElementById('quan').addEventListener('change', calculateShippingFee);
    document.getElementById('phuong').addEventListener('change', calculateShippingFee);
</script>

<style>
    .form-select {
        position: relative;
        z-index: 10;
        /* Đảm bảo dropdown nằm trên các phần tử khác */
        border: 1px solid #ccc;
        border-radius: 4px;
        padding: 10px;
        background-color: #fff;
        width: 100%;
        font-size: 14px;
    }

    .form-select:focus {
        border-color: #ff5722;
        box-shadow: 0 0 5px rgba(255, 87, 34, 0.5);
    }

    /* Dropdown phần mở rộng */
    .select2-container .select2-dropdown {
        z-index: 1000;
        /* Đảm bảo dropdown không bị che */
        position: absolute;
        top: 100% !important;
        /* Dropdown sẽ xuất hiện ngay phía dưới */
        left: 0;
        width: 100%;
        max-height: 200px;
        overflow-y: auto;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
    }

    .text-danger {
        font-size: 13px;
        color: red;
    }

    .form-label {
        font-size: 14px;
        font-weight: bold;
    }
</style>

<footer class="footer-widget-area">
    <div class="footer-top section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="widget-item">
                        <div class="widget-title">
                            <div class="logo">
                                <a href="" style="text-decoration: none;">
                                    <h1 style="font-size: 24px; font-weight: bold; color: #ff5722;">PolyTech</h1>
                                </a>
                            </div>
                        </div>
                        <div class="widget-body">
                            <p>Coza Store là địa chỉ uy tín chuyên cung cấp các sản phẩm thời trang nam chất lượng cao,
                                phù hợp với mọi phong cách.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="widget-item">
                        <h6 class="widget-title">Liên hệ với chúng tôi</h6>
                        <div class="widget-body">
                            <address class="contact-block">
                                <ul>
                                    <li><i class="pe-7s-home"></i> Trịnh Văn Bô, Mỹ Đình, Hà Nội</li>
                                    <li><i class="pe-7s-mail"></i> <a
                                            href="mailto:demo@plazathemes.com">nhom1@gmail.com </a></li>
                                    <li><i class="pe-7s-call"></i> <a href="tel:(012)800456789987">09123456789</a>
                                    </li>
                                </ul>
                            </address>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="widget-item">
                        <h6 class="widget-title">Thông tin</h6>
                        <div class="widget-body">
                            <ul class="info-list">
                                <li><a href="#">Về chúng tôi</a></li>
                                <li><a href="#">Chính sách giao hàng</a></li>
                                <li><a href="#">Chính sách bảo mật</a></li>
                                <li><a href="#">Điều khoản và điều kiện</a></li>
                                <li><a href="#">Liên hệ</a></li>
                                <li><a href="#">Bản đồ trang web</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="widget-item">
                        <h6 class="widget-title">Theo dõi chúng tôi</h6>
                        <div class="widget-body social-link">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-instagram"></i></a>
                            <a href="#"><i class="fa fa-youtube"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row align-items-center mt-20">
                <div class="col-md-6">
                    <div class="newsletter-wrapper">
                        <h6 class="widget-title-text">Đăng ký nhận tin</h6>
                        <form class="newsletter-inner" id="mc-form">
                            <input type="email" class="news-field" id="mc-email" autocomplete="off"
                                placeholder="Enter your email address">
                            <button class="news-btn" id="mc-submit">Đăng ký</button>
                        </form>
                        <!-- mail-chimp-alerts Start -->
                        <div class="mailchimp-alerts">
                            <div class="mailchimp-submitting"></div><!-- mail-chimp-submitting end -->
                            <div class="mailchimp-success"></div><!-- mail-chimp-success end -->
                            <div class="mailchimp-error"></div><!-- mail-chimp-error end -->
                        </div>
                        <!-- mail-chimp-alerts end -->
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="footer-payment">
                        <img src="<?php echo e(asset('asset-user/img/payment.png')); ?>" alt="Phương thức thanh toán">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="copyright-text text-center">
                        <p>&copy; 2024 <b>PolyTech</b> Thiết kế với <i class="fa fa-heart text-danger"></i> bởi
                            NhomWD01.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<?php /**PATH E:\laragon\www\datn\resources\views/checkout/index.blade.php ENDPATH**/ ?>