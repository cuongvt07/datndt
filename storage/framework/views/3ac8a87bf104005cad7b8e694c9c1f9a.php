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
                        <img src="<?php echo e(asset('storage/' . $item->product->image)); ?>" alt="<?php echo e($item->product->name_sp); ?>"
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
                                <?php echo e(number_format($order->total_after_discount, 0, ',', '.')); ?> ₫
                            <?php else: ?>
                                <strong style="color: red;">
                                    <?php echo e(number_format($order->total_after_discount, 0, ',', '.')); ?> ₫
                                </strong>
                                <br>
                                <span style="text-decoration: line-through; font-size: 16px;">
                                    <?php echo e(number_format($order->total_price, 0, ',', '.')); ?> ₫
                                </span>
                            <?php endif; ?>
                        <?php else: ?>
                            <strong style="color: red;">
                                <?php echo e(number_format($order->total_price, 0, ',', '.')); ?> ₫
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
                                <button type="submit" name="status" value="confirmed"
                                    class="btn btn-warning w-100 mb-2"> Đã xác nhận</button>
                                <button type="submit" name="status" value="delivering"
                                    class="btn btn-primary w-100 mb-2">Đang giao hàng</button>
                            <?php elseif($order->status == 'delivering'): ?>
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
        .card {
            border-radius: 8px;
            overflow: hidden;
        }

        .badge-status {
            padding: 0.4em 0.8em;
            border-radius: 20px;
            font-size: 0.9em;
            font-weight: bold;
            color: white;
        }

        .badge-status[data-status="pending"] {
            background-color: #ffc107;
        }

        .badge-status[data-status="confirmed"] {
            background-color: #ffc107;
        }

        .badge-status[data-status="delivering"] {
            background-color: #17a2b8;
        }

        .badge-status[data-status="completed"] {
            background-color: #28a745;
        }

        .badge-status[data-status="canceled"] {
            background-color: #dc3545;
        }

        .product-image {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 8px;
            margin-right: 10px;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\datn1\resources\views/admin/orders/show.blade.php ENDPATH**/ ?>