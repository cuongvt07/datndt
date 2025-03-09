<?php $__env->startSection('content'); ?>
<div class="container mt-4">
    <table class="table ">
        <a href="<?php echo e(route('admin.discount_codes.create')); ?>" class="btn btn-primary btn-block mb-3">Tạo mã giảm
            giá</a>

        <thead >
            <tr>
                <th>ID</th>
                <th>Mã giảm giá</th>
                <th>Giảm theo</th>
                <th>Giới hạn sử dụng</th>
                <th>Ngày bắt đầu</th>
                <th>Ngày kết thúc</th>
                <th>Áp dụng cho</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $discountCodes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $discountCode): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($discountCode->id); ?></td>
                    <td><?php echo e($discountCode->code); ?></td>
                    <td>
                        <?php if($discountCode->amount): ?>
                            <?php echo e(number_format($discountCode->amount)); ?> VNĐ
                        <?php else: ?>
                            <?php echo e(number_format($discountCode->percentage, 0)); ?>%
                        <?php endif; ?>
                    </td>
                    <td><?php echo e($discountCode->usage_limit); ?></td>
                    <td><?php echo e($discountCode->start_date); ?></td>
                    <td><?php echo e($discountCode->end_date); ?></td>
                    <td>
                        <?php if($discountCode->products->isEmpty()): ?>
                            Tất cả sản phẩm
                        <?php else: ?>
                            Sản phẩm cụ thể
                        <?php endif; ?>
                    </td>
                    <td >
                        <!-- Nút để gửi mã giảm giá tới tất cả khách hàng -->
                        <form action="<?php echo e(route('admin.discount_codes.sendToAll')); ?>" method="POST" style="display:inline;">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="discount_code_id" value="<?php echo e($discountCode->id); ?>">
                            <button type="submit" class="btn btn-sm btn-primary">Gửi tới tất cả khách
                                hàng</button>
                        </form>

                        <!-- Nút để chọn khách hàng cụ thể và gửi mã giảm giá -->
                        <a href="<?php echo e(route('admin.discount_codes.selectUsers', $discountCode->id)); ?>"
                            class="btn btn-sm btn-info">Chọn khách hàng</a>

                        <!-- Sửa và Xóa mã giảm giá -->
                        <a href="<?php echo e(route('admin.discount_codes.edit', $discountCode->id)); ?>"
                            class="btn btn-sm btn-warning">Sửa</a>
                        <form action="<?php echo e(route('admin.discount_codes.destroy', $discountCode->id)); ?>" method="POST"
                            style="display:inline;">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="btn btn-sm btn-danger">Xóa</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\laragon\www\datn\resources\views/admin/discount_codes/index.blade.php ENDPATH**/ ?>