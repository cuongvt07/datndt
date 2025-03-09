<?php $__env->startSection('content'); ?>
    <h2 style="margin-top: 100px;margin-left: 600px;">Đơn hàng đã hủy</h2>

    <?php if(session('success')): ?>
        <div class="alert alert-success">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <div class="col-12 mb-3 search-bar">
        <form id="search-form" action="<?php echo e(route('admin.orders.canceled')); ?>" method="GET" style="margin-top: 30px">
            <div class="row justify-content-center align-items-center">
                <div class="col-md-6">
                    <input type="text" class="form-control" value="<?php echo e(request()->input('keyword')); ?>" name="keyword"
                        id="keyword" placeholder="Tìm kiếm đơn hàng...">
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary w-100">Tìm kiếm</button>
                </div>
            </div>
        </form>
    </div>

    <div class="container mt-5">
        <h3 class="order-title" style="color: #dc3545">Đơn hàng đã hủy</h3>
        <a href="<?php echo e(route('admin.orders')); ?>" class="btn btn-primary">Đơn hàng đang xử lý</a>
        <a href="<?php echo e(route('admin.orders.completed')); ?>" class="btn btn-success">Đơn hàng đã hoàn thành</a>

        <table class="table table-hover mt-3">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Người đặt</th>
                    <th>Số điện thoại</th>
                    <th>Địa chỉ</th>
                    <th>Sản phẩm</th>
                    <th>Phí ship</th>
                    <th>Tổng giá</th>
                    <th>Trạng thái</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $canceledOrders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($order->id); ?></td>
                        <td><?php echo e($order->user->name_user ?? 'khách online'); ?></td>
                        <td><?php echo e($order->phone); ?></td>
                        <td><?php echo e($order->detail_address); ?></td>
                        <td>
                            <?php $__currentLoopData = $order->orderItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php echo e($item->product->name_sp); ?><br>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </td>
                        <td>

                            <strong><?php echo e(number_format($order->shipping_fee, 0, ',', '.')); ?> ₫</strong>

                        </td>
                        <td>
                            <?php if($order->user_id): ?>
                                <strong style="font-size: 12px"><?php echo e(number_format($order->total_after_discount + $order->shipping_fee, 0, ',', '.')); ?> ₫</strong>
                            <?php else: ?>
                                <strong style="font-size: 12px"><?php echo e(number_format($order->total_price + $order->shipping_fee, 0, ',', '.')); ?> ₫</strong>
                            <?php endif; ?>
                        </td>
                        <td><span class="badge badge-danger">Đã hủy</span></td>
                        <td><a href="<?php echo e(route('admin.orders.show', $order->id)); ?>" class="btn btn-info btn-sm">Chi tiết</a>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>

        <?php echo e($canceledOrders->links()); ?> 
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\ProjectDT\datn\datn\resources\views/admin/orders/canceled.blade.php ENDPATH**/ ?>