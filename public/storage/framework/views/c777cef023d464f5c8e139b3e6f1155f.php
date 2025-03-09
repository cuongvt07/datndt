<?php $__env->startSection('content'); ?>
<div class="container mt-5">
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-primary text-white">
            <h2 class="m-0">Chi tiết đơn hàng #<?php echo e($order->id); ?></h2>
        </div>
        <div class="card-body">
            <p><strong>Người đặt:</strong> <?php echo e($order->user->name_user); ?></p>
            <p><strong>Tỉnh/Thành:</strong> <?php echo e($order->province); ?></p>
            <p><strong>Quận/Huyện:</strong> <?php echo e($order->district); ?></p>
            <p><strong>Xã/Phường:</strong> <?php echo e($order->ward); ?></p>
            <p><strong>Địa chỉ:</strong> <?php echo e($order->detail_address); ?></p>
            <p><strong>Số điện thoại:</strong> <?php echo e($order->phone); ?></p>
            <p><strong>Trạng thái:</strong> <span class="badge badge-status" data-status="<?php echo e($order->status); ?>"><?php echo e(ucfirst($order->status)); ?></span></p>
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
                $batteryPrice = $item->battery->price ?? 0;
                $colorPrice = $item->color->price ?? 0;
                $totalPricePerItem = $productPrice + $variantPrice + $batteryPrice + $colorPrice;
                $totalPrice = $totalPricePerItem * $item->quantity;
                ?>
                <li class="list-group-item d-flex align-items-center">
                    <img src="<?php echo e(asset('storage/' . $item->product->image)); ?>" alt="<?php echo e($item->product->name_sp); ?>" class="product-image mr-3" />
                    <div class="flex-grow-1">
                        <strong class="large-text"><?php echo e($item->product->name_sp); ?></strong>
                        <div class="small text-muted">
                            <span class="large-text" style="color: #dc3545">Số lượng: <?php echo e($item->quantity); ?></span> |
                            <span class="large-text" style="color: blue">Màu: <?php echo e($item->color->name); ?></span>
                        </div>
                    </div>
                    <span class="text-primary font-weight-bold large-text">
                        <?php echo e(number_format($totalPrice, 0, ',', '.')); ?> VND
                    </span>
                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <li class="list-group-item d-flex justify-content-between">
                <strong>Phí vận chuyển:</strong>
                <span><?php echo e(number_format($shipping_fee, 0, ',', '.')); ?> VND</span>
            </li>
            <li class="list-group-item d-flex justify-content-between">
                <strong>Tổng cộng:</strong>
                <span><?php echo e(number_format($order->total_price + $shipping_fee, 0, ',', '.')); ?> VND</span>
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
                    <label for="status" class="form-label">Trạng thái đơn hàng</label>
                    <select id="status" name="status" class="form-select" required>
                        <option value="pending" <?php echo e($order->status == 'pending' ? 'selected' : ''); ?>>Đang xử lý</option>
                        <option value="delivering" <?php echo e($order->status == 'delivering' ? 'selected' : ''); ?>>Đang giao</option>
                        <option value="completed" <?php echo e($order->status == 'completed' ? 'selected' : ''); ?>>Đã hoàn thành</option>
                        <option value="canceled" <?php echo e($order->status == 'canceled' ? 'selected' : ''); ?>>Đã hủy</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary w-100 mt-2">Cập nhật trạng thái</button>
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

<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\laragon\www\datn\resources\views/admin/orders/show.blade.php ENDPATH**/ ?>