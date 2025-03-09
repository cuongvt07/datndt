<?php $__env->startSection('content'); ?>
    <div class="container mt-5">
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-primary text-white">
                <h2 class="m-0">Chi tiết đơn hàng #<?php echo e($order->id); ?></h2>
            </div>
            <div class="card-body">
                <p><strong>Người đặt:</strong> <?php echo e($order->user->name_user ?? 'khách đặt online'); ?></p>
                <p><strong>Tỉnh/Thành:</strong> <?php echo e($order->province); ?></p>
                <p><strong>Quận/Huyện:</strong> <?php echo e($order->district); ?></p>
                <p><strong>Xã/Phường:</strong> <?php echo e($order->ward); ?></p>
                <p><strong>Địa chỉ:</strong> <?php echo e($order->detail_address); ?></p>
                <p><strong>Số điện thoại:</strong> <?php echo e($order->phone); ?></p>
                <p><strong>Trạng thái:</strong>
                    <span class="badge badge-status" data-status="<?php echo e($order->status); ?>">
                        <?php if($order->status == 'pending'): ?>
                            Chờ xác nhận
                        <?php elseif($order->status == 'confirmed'): ?>
                            Đã xác nhận
                        <?php elseif($order->status == 'delivering'): ?>
                            Đang giao hàng
                        <?php elseif($order->status == 'completed'): ?>
                            Đã hoàn thành
                        <?php elseif($order->status == 'canceled'): ?>
                            Đã hủy
                        <?php endif; ?>
                    </span>
                </p>
                <?php if($order->status == 'canceled'): ?>
                    <p><strong>Lý do hủy:</strong> <?php echo e($order->cancel_reason); ?></p>
                <?php endif; ?>
            </div>
        </div>

        <div class="card shadow-sm mb-4">
            <div class="card-header bg-secondary text-white">
                <h4 class="m-0">Chi tiết sản phẩm</h4>
            </div>
            <ul class="list-group list-group-flush">
                <?php $__currentLoopData = $order->orderItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                    $productPrice = $item->product->price ?? 0;
                    $variantPrice = $item->variant->price ?? 0;
                    $colorPrice = $item->color->price ?? 0;
                    $totalPricePerItem = $productPrice + $variantPrice + $colorPrice;
                    $totalPrice = $totalPricePerItem * $item->quantity;
                    ?>
                    <li class="list-group-item d-flex align-items-center">
                        <img src="<?php echo e(asset('storage/' . ($item->product->productImages->where('colour_id', $item->color_id)->first()->image_path ?? $item->product->productImages->first()->image_path ?? 'default-image.jpg'))); ?>"
                        class="product-image mr-3" />
                        <div class="flex-grow-1">
                            <strong class="large-text"><?php echo e($item->product->name_sp); ?></strong>

                            <div class="small text-muted">
                                <span class="large-text" style="color: #dc3545">Số lượng: <?php echo e($item->quantity); ?></span> |
                                <span class="large-text"
                                    style="color: green">Pin:<?php echo e($item->product->battery->capacity); ?></span> |

                                <span class="large-text" style="color: blue">Màu: <?php echo e($item->color->name); ?></span> |
                                <span class="large-text">Ram: <?php echo e($item->variant->ram_smartphone ?? 0); ?></span>


                            </div>
                        </div>
                        <span class="text-primary font-weight-bold large-text">
                            <?php if($order->user_id): ?>
                                <?php echo e(number_format($totalPrice, 0, ',', '.')); ?> VND
                            <?php else: ?>
                                <?php echo e(number_format($order->total_price - $shipping_fee, 0, ',', '.')); ?> ₫
                            <?php endif; ?>
                        </span>

                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <li>
                    <?php if($order->discount_code || $order->discount_percentage > 0 || $order->discount_amount > 0): ?>
                <li class="list-group-item bg-light">
                    <div class="">
                        <strong class="text-muted">Mã giảm giá: </strong>
                        <span class="text-primary">
                            <?php echo e($order->discount_code ?? 'Không có'); ?> |
                        </span>
                    </div>
                    <div class="">
                        <strong class="text-muted">Số tiền được giảm:</strong>
                        <span class="text-success">
                            <?php if($order->discount_percentage > 0): ?>
                                <?php echo e($order->discount_percentage); ?>%
                                (<?php echo e(number_format($order->total_price - $order->total_after_discount, 0, ',', '.')); ?>

                                ₫)
                            <?php elseif($order->discount_amount > 0): ?>
                                <?php echo e(number_format($order->discount_amount, 0, ',', '.')); ?> ₫
                            <?php else: ?>
                                0 ₫
                            <?php endif; ?>
                        </span>
                    </div>
                </li>
                <?php endif; ?>
                <li class="list-group-item d-flex justify-content-between">
                    <strong>Hình thức thanh toán:</strong>
                    <span><?php if($order->payment_method == 'cash'): ?>
                        Tiền mặt
                        <?php elseif($order->payment_method == 'online'): ?>
                        Chuyển khoản 
                    <?php endif; ?></span>
                </li>
                </li>
                <li class="list-group-item d-flex justify-content-between">
                    <strong>Phí vận chuyển:</strong>
                    <span><?php echo e(number_format($shipping_fee, 0, ',', '.')); ?> VND</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center bg-light">
                    <strong class="text-primary" style="font-size: 18px;">Tổng giá đơn hàng:</strong>
                    <span class="text-danger font-weight-bold" style="font-size: 18px;">
                        <?php if($order->user_id): ?>
                            <?php if($order->discount_amount == 0): ?>
                                <?php echo e(number_format($order->total_after_discount + $order->shipping_fee, 0, ',', '.')); ?> ₫
                            <?php else: ?>
                                <strong style="color: red;">
                                    <?php echo e(number_format($order->total_after_discount  + $order->shipping_fee, 0, ',', '.')); ?> ₫
                                </strong>
                                <br>
                                <span style="text-decoration: line-through; font-size: 16px;">
                                    <?php echo e(number_format($order->total_price , 0, ',', '.')); ?> ₫
                                </span>
                            <?php endif; ?>
                        <?php else: ?>
                            <strong style="color: red;">
                                <?php echo e(number_format($order->total_price  + $order->shipping_fee, 0, ',', '.')); ?> ₫
                            </strong>
                            <br>
                        <?php endif; ?>

                    </span>
                </li>

            </ul>

        </div>

        <div class="card shadow-sm">
            <div class="card-header bg-success text-white">
                <h4 class="m-0">Cập nhật trạng thái đơn hàng</h4>
            </div>
            <div class="card-body">
                <form action="<?php echo e(route('admin.orders.updateStatus', $order->id)); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="form-group mb-3">
                        <label class="form-label">Trạng thái đơn hàng</label>
                        <div class="btn-group w-100" role="group" aria-label="Order Status">
                            <?php if($order->status == 'pending'): ?>
                                <button type="submit" name="status" value="pending" class="btn btn-success w-100 mb-2">Chờ
                                    xác nhận</button>
                                <button type="submit" name="status" value="confirmed"
                                    class="btn btn-warning w-100 mb-2">Xác nhận</button>
                                <button type="submit" name="status" value="canceled" class="btn btn-danger w-100 mb-2">Hủy
                                    đơn</button>
                            <?php elseif($order->status == 'canceled'): ?>
                                <button type="submit" name="status" value="canceled" class="btn btn-danger w-100 mb-2">Đã
                                    hủy</button>
                            <?php elseif($order->status == 'confirmed'): ?>
                            <button type="submit" name="status" value="canceled" class="btn btn-danger w-100 mb-2">Hủy
                                đơn</button>
                                <button type="submit" name="status" value="confirmed"
                                    class="btn btn-warning w-100 mb-2"> Đã xác nhận</button>
                                  
                                <button type="submit" name="status" value="delivering"
                                    class="btn btn-primary w-100 mb-2">Đang giao hàng</button>
                                  
                            <?php elseif($order->status == 'delivering'): ?>
                            <button type="submit" name="status" value="canceled" class="btn btn-danger w-100 mb-2">Hủy
                                đơn</button>
                          
                                <button type="submit" name="status" value="delivering"
                                    class="btn btn-primary w-100 mb-2">Đang giao hàng</button>
                    
                                <button type="submit" name="status" value="completed"
                                    class="btn btn-success w-100 mb-2">Đã hoàn thành</button>
                            <?php elseif($order->status == 'completed'): ?>
                                <button type="submit" name="status" value="completed"
                                    class="btn btn-success w-100 mb-2">Đã hoàn thành</button>
                            <?php endif; ?>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <style>
        /* Cấu trúc nền tảng và bố cục */
        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f4f6f9;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 30px;
        }

        /* Thiết kế card nâng cao */
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            background-color: #fff;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 25px rgba(0, 0, 0, 0.2);
        }

        .card-header {
            background-color: #007bff;
            color: #fff;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
            padding: 20px;
        }

        .card-header h2,
        .card-header h4 {
            font-size: 1.5rem;
            font-weight: bold;
        }

        .card-body {
            padding: 20px;
            background-color: #f9f9f9;
            border-bottom-left-radius: 10px;
            border-bottom-right-radius: 10px;
        }

        /* Cải tiến typography */
        p,
        li {
            font-size: 16px;
            line-height: 1.8;
            margin-bottom: 10px;
        }

        strong {
            font-weight: bold;
            color: #333;
        }

        /* Cải tiến hiệu ứng hover */
        .hover-shadow:hover {
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
            transition: all 0.3s ease-in-out;
        }

        /* Thêm một số cải tiến cho phần thông tin sản phẩm */
        .product-image {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 8px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s ease;
        }

        .product-image:hover {
            transform: scale(1.05);
        }

        .large-text {
            font-size: 18px;
        }

        /* Badge trạng thái với màu sắc đẹp */
        .badge-status {
            padding: 6px 12px;
            border-radius: 20px;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 14px;
            display: inline-block;
            margin-top: 5px;
        }

        .badge-status[data-status="pending"] {
            background-color: #ffcc00;
            color: #333;
        }

        .badge-status[data-status="confirmed"] {
            background-color: #f39c12;
            color: #fff;
        }

        .badge-status[data-status="delivering"] {
            background-color: #17a2b8;
            color: #fff;
        }

        .badge-status[data-status="completed"] {
            background-color: #28a745;
            color: #fff;
        }

        .badge-status[data-status="canceled"] {
            background-color: #dc3545;
            color: #fff;
        }

        /* Các nút chức năng */
        .btn-group .btn {
            padding: 10px 15px;
            font-size: 16px;
            font-weight: 600;
            border-radius: 30px;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .btn-group .btn:hover {
            transform: translateY(-3px);
        }

        .btn-outline-success {
            border-color: #28a745;
            color: #28a745;
            background-color: transparent;
        }

        .btn-outline-warning {
            border-color: #ffc107;
            color: #ffc107;
            background-color: transparent;
        }

        .btn-outline-primary {
            border-color: #007bff;
            color: #007bff;
            background-color: transparent;
        }

        .btn-outline-danger {
            border-color: #dc3545;
            color: #dc3545;
            background-color: transparent;
        }

        /* Khi hover các nút */
        .btn-outline-success:hover {
            background-color: #28a745;
            color: #fff;
        }

        .btn-outline-warning:hover {
            background-color: #ffc107;
            color: #fff;
        }

        .btn-outline-primary:hover {
            background-color: #007bff;
            color: #fff;
        }

        .btn-outline-danger:hover {
            background-color: #dc3545;
            color: #fff;
        }

        /* Cải tiến hiển thị giá */
        .text-primary {
            font-size: 18px;
            font-weight: bold;
            color: #007bff;
        }

        .text-danger {
            color: #e74a3b;
            font-size: 18px;
        }

        .text-muted {
            font-size: 14px;
            color: #777;
        }

        /* Tổng giá */
        .text-danger.font-weight-bold {
            font-size: 22px;
            font-weight: bold;
        }

        /* Các phần tử khác */
        .list-group-item {
            padding: 15px;
            font-size: 16px;
            border: none;
            transition: background-color 0.3s ease;
        }

        .list-group-item:hover {
            background-color: #f1f1f1;
        }

        /* Card-footer */
        .card-footer {
            padding: 20px;
            background-color: #f1f1f1;
            border-bottom-left-radius: 10px;
            border-bottom-right-radius: 10px;
        }

        /* Cải tiến layout cho các mục đơn hàng */
        .list-group-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-radius: 10px;
        }

        .list-group-item img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 10px;
            margin-right: 20px;
        }

        .list-group-item .text-muted {
            font-size: 14px;
        }

        /* Cải tiến phần thông tin mã giảm giá */
        .bg-light {
            background-color: #f9f9f9 !important;
        }

        .card-footer {
            background-color: #f7f7f7;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .product-image {
                width: 60px;
                height: 60px;
            }

            .large-text {
                font-size: 16px;
            }

            .card-header h2,
            .card-header h4 {
                font-size: 1.3rem;
            }

            .btn-group .btn {
                font-size: 14px;
                padding: 8px 12px;
            }

            .text-danger.font-weight-bold {
                font-size: 20px;
            }
        }
    </style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\datn\resources\views/admin/orders/show.blade.php ENDPATH**/ ?>