<?php echo $__env->make('layouts.user.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

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
                            <li class="breadcrumb-item active" aria-current="page">Đơn hàng đã hủy của tôi</li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container mt-5">
    <h2>Đơn hàng đã hoàn thành và đã hủy</h2>
    <a href="<?php echo e(route('order')); ?>" class="btn btn-primary btn-lg px-4 py-2 rounded-pill shadow-sm">
        Đơn Hàng
    </a>
    <a href="<?php echo e(route('orders.completed')); ?>" class="btn btn-primary btn-lg px-4 py-2 rounded-pill shadow-sm">
    Đơn Hàng đã hoàn thành
    </a>
    <?php if($completedAndCanceledOrders->count() > 0): ?>
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
                <th>Phí ship</th>
                <th>Tổng tiền</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $completedAndCanceledOrders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($order->id); ?></td>
                    <td>
                        <?php if($order->status == 'completed'): ?>
                            <span class="badge badge-success">Đã hoàn thành</span>
                        <?php elseif($order->status == 'canceled'): ?>
                            <span class="badge badge-danger">Đã hủy</span>
                        <?php endif; ?>
                    </td>

                    <td><?php echo e($order->province); ?></td>
                    <td><?php echo e($order->district); ?></td>
                    <td><?php echo e($order->ward); ?></td>
                    <td><?php echo e($order->detail_address); ?></td>
                    <td><?php echo e($order->phone); ?></td>
                    
                    <td>
                        <?php $__currentLoopData = $order->orderItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="d-flex align-items-center mb-2">
                                <img src="<?php echo e(asset('storage/' . $item->product->productImages->where('colour_id', $item->color_id)->first()->image_path)); ?>"
                                    alt="Product"
                                    style="max-width: 50px; max-height: 50px; object-fit: cover; margin-right: 10px;">
                                <div>
                                    <strong><?php echo e($item->product->name_sp); ?></strong> <br>
                                    <small><?php echo e($item->battery->capacity); ?> |
                                        <?php echo e($item->variant->ram_smartphone ?? 'Không có ram'); ?> |
                                        <?php echo e($item->color->name); ?></small><br>
                                    <small>Số lượng: <?php echo e($item->quantity); ?></small>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </td>
                    <td>
                        <strong><?php echo e(number_format($order->shipping_fee, 0, ',', '.')); ?> ₫</strong>
                    </td>
                    <td>
                        <strong><?php echo e(number_format($order->grand_total, 0, ',', '.')); ?> ₫</strong>
                         <br>
                        <s style="font-size: 10px"><?php echo e(number_format($order->total_after_discount, 0, ',', '.')); ?> ₫</s>
                    </td>
                    
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
    
<?php else: ?>
    <div class="alert alert-info text-center" role="alert">
        Bạn chưa có đơn hàng nào đã hoàn thành.
    </div>
<?php endif; ?>


</div>
<?php echo $__env->make('layouts.user.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\laragon\www\datn\resources\views/orders/test.blade.php ENDPATH**/ ?>