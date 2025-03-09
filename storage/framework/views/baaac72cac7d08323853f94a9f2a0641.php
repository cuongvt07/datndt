<?php echo $__env->make('layouts.user.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!-- Bootstrap CSS -->

<!-- Bootstrap JS (bao gồm cả Popper.js) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>


<?php echo $__env->make('layouts.user.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<div class="breadcrumb-area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb-wrap">
                    <nav aria-label="breadcrumb">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo e(route('index')); ?>"><i class="fa fa-home"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Đơn hàng của tôi</li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container mt-5">
    <h2 class="text-center mb-4">Đơn hàng của tôi</h2>
    <a href="<?php echo e(route('orders.completed')); ?>" class="btn btn-primary btn-lg px-4 py-2 rounded-pill shadow-sm">
        Đơn Hàng Đã Hoàn Thành
    </a>
    <a href="<?php echo e(route('orders.completed-canceled')); ?>" class="btn btn-primary btn-lg px-4 py-2 rounded-pill shadow-sm">
        Đơn Hàng Đã Hủy
    </a>

    <?php if(session('success')): ?>
        <div class="alert alert-success">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>
    <?php if(session('error')): ?>
        <div class="alert alert-danger">
            <?php echo e(session('error')); ?>

        </div>
    <?php endif; ?>
    <?php if($orders->count() > 0): ?>
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
                    <th>tiền ship</th>
                    <th>Tổng tiền</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($order->id); ?></td>
                        <td>
                            <?php if($order->status == 'pending'): ?>
                                <span class="badge badge-warning">Đang xử lý</span>
                            <?php elseif($order->status == 'confirmed'): ?>
                                <span class="badge badge-success">Đã xác nhận</span>
                            <?php elseif($order->status == 'delivering'): ?>
                                <span class="badge badge-info">Đang giao hàng</span>
                            <?php elseif($order->status == 'completed'): ?>
                                <span class="badge badge-success">Đã hoàn thành</span>
                            <?php elseif($order->status == 'canceled'): ?>
                                <span class="badge badge-danger">Đã hủy</span>
                            <?php endif; ?>
                        </td>
                        <div class="modal fade" id="cancelModal-<?php echo e($order->id); ?>" tabindex="-1"
                            aria-labelledby="cancelModalLabel-<?php echo e($order->id); ?>" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="cancelModalLabel-<?php echo e($order->id); ?>">Hủy đơn hàng
                                            #<?php echo e($order->id); ?></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="<?php echo e(route('orders.cancel', ['order' => $order->id])); ?>"
                                            method="POST">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('PATCH'); ?>

                                            <h5>Chọn lý do hủy đơn hàng:</h5>
                                            <div class="form-group">
                                                <input type="checkbox" name="reasons[]" value="Thay đổi ý định"> Thay
                                                đổi ý định<br>
                                                <input type="checkbox" name="reasons[]"
                                                    value="Tìm thấy sản phẩm giá rẻ hơn"> Tìm thấy sản phẩm giá rẻ
                                                hơn<br>
                                                <input type="checkbox" name="reasons[]"
                                                    value="Sản phẩm không cần thiết nữa"> Sản phẩm không cần thiết
                                                nữa<br>
                                                <input type="checkbox" name="reasons[]" value="Thời gian giao hàng lâu">
                                                Thời gian giao hàng lâu<br>
                                                <input type="checkbox" name="reasons[]"
                                                    value="Không hài lòng với dịch vụ"> Không hài lòng với dịch vụ<br>
                                                <input type="checkbox" name="reasons[]" value="Khác"
                                                    id="reason-other-<?php echo e($order->id); ?>"> Khác<br>
                                            </div>

                                            <!-- Ô nhập lý do khác -->
                                            <div class="form-group" id="other-reason-input-<?php echo e($order->id); ?>"
                                                style="display: none;">
                                                <label for="other_reason">Lý do khác:</label>
                                                <input type="text" name="other_reason" class="form-control">
                                            </div>

                                            <!-- Nút submit -->
                                            <button type="submit" class="btn btn-danger mt-3">Xác nhận hủy đơn</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <!-- Modal -->
                        <div class="modal fade" id="editAddressModal-<?php echo e($order->id); ?>" tabindex="-1"
                            aria-labelledby="editAddressModalLabel-<?php echo e($order->id); ?>" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editAddressModalLabel-<?php echo e($order->id); ?>">Cập nhật
                                            địa chỉ</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="<?php echo e(route('orders.updateAddress', ['order' => $order->id])); ?>"
                                            method="POST">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('PUT'); ?>

                                            <!-- Thông tin địa chỉ giao hàng -->
                                            <div class="row mb-3">
                                                <div class="col-md-12">
                                                    <input type="text" class="form-control" name="detail_address"
                                                        value="<?php echo e($order->detail_address); ?>"
                                                        placeholder="Địa chỉ chi tiết" required>
                                                    <div id="edit-address-error-<?php echo e($order->id); ?>"
                                                        class="text-danger mt-2" style="display: none;">Địa chỉ không
                                                        được bỏ trống.</div>
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <div class="col-md-4">
                                                    <select id="tinh-<?php echo e($order->id); ?>" name="province"
                                                        class="form-select" title="Chọn Tỉnh Thành" required>
                                                        <option value="0">Tỉnh Thành</option>
                                                        <!-- Đổ dữ liệu tỉnh thành từ API -->
                                                    </select>
                                                </div>
                                                <div class="col-md-4">
                                                    <select id="quan-<?php echo e($order->id); ?>" name="district"
                                                        class="form-select" title="Chọn Quận Huyện" required>
                                                        <option value="0">Quận Huyện</option>
                                                        <!-- Đổ dữ liệu quận huyện từ API -->
                                                    </select>
                                                </div>
                                                <div class="col-md-4">
                                                    <select id="phuong-<?php echo e($order->id); ?>" name="ward"
                                                        class="form-select" title="Chọn Phường Xã" required>
                                                        <option value="0">Phường Xã</option>
                                                        <!-- Đổ dữ liệu phường xã từ API -->
                                                    </select>
                                                </div>
                                            </div>

                                            <!-- Số điện thoại -->
                                            <div class="row mb-3">
                                                <div class="col-md-12">
                                                    <label for="phone" class="form-label">Số điện thoại</label>
                                                    <input type="text" class="form-control"
                                                        id="phone-<?php echo e($order->id); ?>" name="phone"
                                                        value="<?php echo e($order->phone); ?>" required>
                                                    <div id="edit-phone-error-<?php echo e($order->id); ?>"
                                                        class="text-danger mt-2" style="display: none;">Vui lòng nhập
                                                        đúng định dạng số điện thoại.</div>
                                                </div>
                                            </div>

                                            <!-- Nút submit -->
                                            <button type="submit" class="btn btn-sqr">Cập nhật địa chỉ</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <td><?php echo e($order->province); ?></td>
                        <td><?php echo e($order->district); ?></td>
                        <td><?php echo e($order->ward); ?></td>
                        <td><?php echo e($order->detail_address); ?></td>
                        <td><?php echo e($order->phone); ?></td>
                        <td>
                            <?php if($order->orderItems->count() > 0): ?>
                                <div class="align-items-center mb-2">
                                    <!-- Display the first product's image and name -->
                                    <img src="<?php echo e(asset('storage/' .$order->orderItems->first()->product->productImages->where('colour_id', $order->orderItems->first()->color_id)->first()->image_path ??'default-image.jpg')); ?>"
                                        alt="Product Image"
                                        style="max-width: 100px; max-height: 100px; object-fit: cover;"
                                        loading="lazy">

                                    <div>
                                        <strong><?php echo e($order->orderItems->first()->product->name_sp); ?></strong> <br>
                                        <!-- Display the total quantity of the first product -->
                                        <small>Số sản phẩm: <?php echo e($order->orderItems->sum('quantity')); ?></small>
                                    </div>

                                    <!-- Modal button to view all products in the order -->
                                    <button class="btn btn-info btn-sm mt-2" data-bs-toggle="modal"
                                        data-bs-target="#productDetailModal-<?php echo e($order->id); ?>">Xem chi tiết</button>
                                </div>
                            <?php endif; ?>

                            <!-- Modal for showing detailed information of all products -->
                            <div class="modal fade" id="productDetailModal-<?php echo e($order->id); ?>" tabindex="-1"
                                aria-labelledby="productDetailModalLabel-<?php echo e($order->id); ?>" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="productDetailModalLabel-<?php echo e($order->id); ?>">
                                                Các sản phẩm trong đơn hàng
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- Wrap all products in a flex container with proper space between them -->
                                            <div class="d-flex flex-wrap justify-content-start gap-4">
                                                <!-- Loop through all products in the order and show details -->
                                                <?php $__currentLoopData = $order->orderItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <div class="product-details card shadow-sm mb-4"
                                                        style="width: 250px; flex: 1 1 auto;">
                                                        <!-- Product Image -->
                                                        <div class="card-img-top text-center p-3">
                                                            <img src="<?php echo e(asset('storage/' . $item->product->productImages->where('colour_id', $item->color_id)->first()->image_path ?? 'default-image.jpg')); ?>"
                                                                alt="Product Image for <?php echo e($item->product->name_sp); ?>"
                                                                class="product-image"
                                                                style="max-width: 100%; height: auto;" loading="lazy">
                                                        </div>

                                                        <!-- Product Details -->
                                                        <div class="card-body">
                                                            <h6 class="card-title"><?php echo e($item->product->name_sp); ?></h6>

                                                            <button class="btn btn-link toggle-info" type="button">
                                                                Xem thêm
                                                            </button>

                                                            <!-- Product Info Section, initially hidden -->
                                                            <div class="product-info-collapse">
                                                                <div class="product-info">
                                                                    <strong>Pin:</strong>
                                                                    <span><?php echo e($item->product->battery->capacity); ?></span>
                                                                </div>
                                                                <div class="product-info">
                                                                    <strong>RAM:</strong>
                                                                    <span><?php echo e($item->variant->ram_smartphone ?? 'Không có'); ?></span>
                                                                </div>
                                                                <div class="product-info">
                                                                    <strong>Màu sắc:</strong>
                                                                    <span><?php echo e($item->color->name); ?></span>
                                                                </div>
                                                                <div class="product-info">
                                                                    <strong>Số lượng:</strong>
                                                                    <span><?php echo e($item->quantity); ?></span>
                                                                </div>
                                                                <div class="product-info">
                                                                    <strong>Giá:</strong>
                                                                    <span><?php echo e(number_format($item->product->price, 0, ',', '.')); ?>

                                                                        ₫</span>
                                                                </div>
                                                                <div class="product-info">
                                                                    <strong>Mô tả:</strong>
                                                                    <p><?php echo e(\Illuminate\Support\Str::limit($item->product->description, 80, '...')); ?>

                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Đóng</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>


                        <td>
                            <strong><?php echo e(number_format($order->shipping_fee, 0, ',', '.')); ?> ₫</strong>
                        </td>
                        <td>
                            <?php if($order->discount_amount == 0): ?>
                                <strong
                                    style="font-size: 16px"><?php echo e(number_format($order->total_after_discount, 0, ',', '.')); ?>

                                    ₫</strong>
                            <?php else: ?>
                                <strong
                                    style="font-size: 16px; color: red;"><?php echo e(number_format($order->total_after_discount, 0, ',', '.')); ?>

                                    ₫</strong>
                                <br>
                                <span
                                    style="text-decoration: line-through; font-size: 12px;"><?php echo e(number_format($order->total_price, 0, ',', '.')); ?>

                                    ₫</span>
                                <br>
                                <span style="font-size: 12px; color: green;">Bạn tiết kiệm:
                                    <?php echo e(number_format($order->total_price - $order->total_after_discount, 0, ',', '.')); ?>

                                    ₫</span>
                            <?php endif; ?>



                        </td>
                        <td>
                            <!-- Nút bấm để mở modal -->
                            <button type="button" class="mm btn btn-sqr mt-2" data-bs-toggle="modal"
                                data-bs-target="#editAddressModal-<?php echo e($order->id); ?>">
                                Chỉnh sửa địa chỉ
                            </button>
                            <button class="mm btn btn-sqr mt-2" data-bs-toggle="modal"
                                data-bs-target="#cancelModal-<?php echo e($order->id); ?>">Hủy đơn</button>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    <?php else: ?>
        <div class="alert alert-info text-center" role="alert">
            Bạn chưa có đơn hàng nào.
        </div>
    <?php endif; ?>
</div>

<style>
    /* View More button */
    .toggle-info {
        background: linear-gradient(45deg, #6a82fb, #fc5c7d);
        /* Gradient màu xanh và hồng */
        color: #ffffff;
        /* Màu chữ trắng */
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        padding: 12px 25px;
        /* Tăng kích thước nút */
        border: 2px solid transparent;
        /* Viền trong suốt */
        border-radius: 50px;
        /* Bo góc tròn */
        text-decoration: none;
        /* Xóa gạch chân */
        display: inline-block;
        text-align: center;
        transition: all 0.3s ease;
        /* Hiệu ứng chuyển động mượt mà */
    }

    /* Hover effect for "Xem thêm" */
    .toggle-info:hover {
        background: linear-gradient(45deg, #fc5c7d, #6a82fb);
        /* Đảo ngược gradient khi hover */
        transform: scale(1.05);
        /* Tăng kích thước nút */
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        /* Thêm bóng đổ lớn */
        border-color: #ffffff;
        /* Thêm viền trắng khi hover */
    }

    /* When the info is visible, change text to "Xem ít" and button style */
    .product-details.open .toggle-info {
        /* background: linear-gradient(45deg, #f6d365, #fda085); Gradient màu vàng nhạt và cam */
    }

    /* Hover effect for "Xem ít" */
    .product-details.open .toggle-info:hover {
        background: linear-gradient(45deg, #fda085, #f6d365);
        /* Đảo ngược gradient khi hover */
        transform: scale(1.05);
        /* Tăng kích thước nút */
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        /* Thêm bóng đổ lớn */
        border-color: #ffffff;
        /* Thêm viền trắng khi hover */
    }

    /* Product details container */
    .product-details {
        display: flex;
        flex-direction: column;
        /* align-items: flex-start; */
        gap: 20px;
        margin-top: 20px;
        position: relative;
    }

    /* Product image styles */
    .product-image {
        width: 200px;
        /* Tăng kích thước hình ảnh */
        height: 200px;
        /* Đảm bảo chiều cao bằng với chiều rộng */
        border-radius: 12px;
        object-fit: contain;
        /* Hiển thị hình ảnh đầy đủ mà không bị cắt */
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .product-image:hover {
        transform: scale(1.1);
        /* Tăng kích thước hình ảnh khi hover */
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
    }

    /* Initially hide product info */
    .product-info-collapse {
        display: none;
        margin-top: 10px;
        transition: all 0.3s ease;
    }

    /* View More button */
    .toggle-info {
        background: none;
        border: none;
        color: #007bff;
        font-size: 16px;
        cursor: pointer;
        padding: 0;
        text-align: left;
    }

    /* When the info is visible, change text to "Xem ít" */
    .product-details.open .product-info-collapse {
        display: block;
    }

    .product-details.open .toggle-info {
        color: #d9534f;
        /* Change button color when open */
    }

    /* Product Info Box Styles */
    .product-info {
        font-size: 15px;
        line-height: 1.6;
        margin-bottom: 15px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 12px 15px;
        background-color: #f9f9f9;
        border-radius: 10px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .product-info strong {
        font-weight: 600;
        color: #555;
    }

    .product-info span {
        font-size: 15px;
        color: #333;
        font-weight: 500;
    }

    .product-info p {
        font-size: 14px;
        color: #777;
        margin-top: 6px;
        word-wrap: break-word;
        line-height: 1.8;
    }



    th {
        width: 100px;
        text-align: center;
    }

    td {
        width: 100px;
        text-align: center;
    }


    .mm {
        width: 150px;
        padding: 5px 20px;

    }

    .badge {
        padding: 0.5em 1em;
        border-radius: 20px;
        font-size: 0.9em;
        font-weight: bold;
    }

    .badge-warning {
        background-color: #ffc107;
        color: #212529;
    }

    .badge-info {
        background-color: #17a2b8;
    }

    .badge-success {
        background-color: #28a745;
    }

    .badge-danger {
        background-color: #dc3545;
    }

    .table-hover tbody tr:hover {
        background-color: rgba(0, 0, 0, 0.05);
    }
</style>

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
    $(document).ready(function() {
        // Toggle visibility of product details when clicking the "Xem thêm" button
        $('.toggle-info').click(function() {
            var productDetails = $(this).closest('.product-details');
            productDetails.toggleClass('open'); // Toggle class to show/hide product info

            // Change button text based on visibility
            if (productDetails.hasClass('open')) {
                $(this).text('Ẩn bớt'); // Change text to "Xem ít"
            } else {
                $(this).text('Xem thêm'); // Change text to "Xem thêm"
            }
        });
    });

    function validateOrderForm(orderId) {
        let isValid = true;

        // Validate số điện thoại
        const phoneInput = document.getElementById(`phone-${orderId}`);
        const phoneError = document.getElementById(`edit-phone-error-${orderId}`);
        const phoneRegex = /^0\d{9}$/;

        if (!phoneRegex.test(phoneInput.value)) {
            phoneError.style.display = 'block';
            isValid = false;
        } else {
            phoneError.style.display = 'none';
        }

        // Validate địa chỉ
        const addressInput = document.querySelector(`#edit-address-form-${orderId} input[name="detail_address"]`);
        const addressError = document.getElementById(`edit-address-error-${orderId}`);

        if (addressInput.value.trim() === '') {
            addressError.style.display = 'block';
            isValid = false;
        } else {
            addressError.style.display = 'none';
        }

        return isValid;
    }

    // Hook vào tất cả form chỉnh sửa địa chỉ
    document.querySelectorAll('[id^="edit-address-form-"]').forEach(form => {
        form.addEventListener('submit', function(event) {
            const orderId = form.getAttribute('id').split('-').pop();
            if (!validateOrderForm(orderId)) {
                event.preventDefault(); // Ngăn form submit nếu có lỗi
            }
        });
    });
</script>
<script>
    var provinces = {};
    var districts = {};
    var wards = {};

    $(document).ready(function() {
        // Gọi API để lấy dữ liệu Tỉnh/Thành
        $.getJSON('https://esgoo.net/api-tinhthanh/1/0.htm', function(data_tinh) {
            if (data_tinh.error == 0) {
                // Lưu dữ liệu tỉnh vào biến provinces và thêm vào select box của từng đơn hàng
                <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    $.each(data_tinh.data, function(key_tinh, val_tinh) {
                        provinces[val_tinh.id] = val_tinh.full_name;
                        $("#tinh-<?php echo e($order->id); ?>").append('<option value="' + val_tinh.id +
                            '">' + val_tinh.full_name + '</option>');
                    });

                    // Xử lý sự kiện khi thay đổi tỉnh cho từng đơn hàng
                    $("#tinh-<?php echo e($order->id); ?>").change(function(e) {
                        var idtinh = $(this).val();

                        // Gọi API để lấy dữ liệu Quận/Huyện dựa trên tỉnh đã chọn
                        $.getJSON('https://esgoo.net/api-tinhthanh/2/' + idtinh + '.htm',
                            function(data_quan) {
                                if (data_quan.error == 0) {
                                    // Reset lại select box Quận/Huyện và Phường/Xã
                                    $("#quan-<?php echo e($order->id); ?>").html(
                                        '<option value="0">Quận Huyện</option>');
                                    $("#phuong-<?php echo e($order->id); ?>").html(
                                        '<option value="0">Phường Xã</option>');

                                    // Lưu dữ liệu quận vào biến districts và thêm vào select box
                                    $.each(data_quan.data, function(key_quan, val_quan) {
                                        districts[val_quan.id] = val_quan.full_name;
                                        $("#quan-<?php echo e($order->id); ?>").append(
                                            '<option value="' + val_quan.id +
                                            '">' + val_quan.full_name +
                                            '</option>');
                                    });

                                    // Xử lý sự kiện khi thay đổi Quận/Huyện
                                    $("#quan-<?php echo e($order->id); ?>").change(function(e) {
                                        var idquan = $(this).val();

                                        // Gọi API để lấy dữ liệu Phường/Xã dựa trên Quận/Huyện đã chọn
                                        $.getJSON(
                                            'https://esgoo.net/api-tinhthanh/3/' +
                                            idquan + '.htm',
                                            function(data_phuong) {
                                                if (data_phuong.error == 0) {
                                                    // Reset lại select box Phường/Xã
                                                    $("#phuong-<?php echo e($order->id); ?>")
                                                        .html(
                                                            '<option value="0">Phường Xã</option>'
                                                        );

                                                    // Lưu dữ liệu phường vào biến wards và thêm vào select box
                                                    $.each(data_phuong.data,
                                                        function(key_phuong,
                                                            val_phuong) {
                                                            wards[val_phuong
                                                                    .id] =
                                                                val_phuong
                                                                .full_name;
                                                            $("#phuong-<?php echo e($order->id); ?>")
                                                                .append(
                                                                    '<option value="' +
                                                                    val_phuong
                                                                    .id +
                                                                    '">' +
                                                                    val_phuong
                                                                    .full_name +
                                                                    '</option>'
                                                                );
                                                        });
                                                }
                                            });
                                    });
                                }
                            });
                    });
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            }
        });
    });

    function showEditForm(orderId) {
        // Ẩn hoặc hiện form chỉnh sửa địa chỉ
        var form = document.getElementById('edit-address-form-' + orderId);
        if (form.style.display === "none") {
            form.style.display = "block";
        } else {
            form.style.display = "none";
        }
    }

    function confirmCancelOrder(orderId) {
        if (confirm('Bạn có chắc chắn muốn hủy đơn hàng này không?')) {
            // Gửi yêu cầu hủy đơn hàng tới server
            fetch(`/orders/${orderId}/cancel`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
                    },
                    body: JSON.stringify({
                        _method: 'PATCH'
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Đã hủy đơn hàng!');
                        location.reload(); // Tải lại trang để cập nhật trạng thái
                    } else {
                        alert('Có lỗi xảy ra khi hủy đơn hàng. Vui lòng thử lại.');
                    }
                });
        }
    }


    function showCancelForm(orderId) {
        var form = document.getElementById('cancel-form-' + orderId);
        if (form.style.display === "none") {
            form.style.display = "block";
        } else {
            form.style.display = "none";
        }
    }


    $(document).ready(function() {
        <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            $('#reason-other-<?php echo e($order->id); ?>').change(function() {
                if ($(this).is(':checked')) {
                    $('#other-reason-input-<?php echo e($order->id); ?>').show();
                } else {
                    $('#other-reason-input-<?php echo e($order->id); ?>').hide();
                }
            });
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    });
</script>
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
                                            href="mailto:demo@plazathemes.com">nhom1@gmail.com
                                        </a></li>
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
<?php /**PATH E:\laragon\www\datn1\resources\views/orders/index.blade.php ENDPATH**/ ?>