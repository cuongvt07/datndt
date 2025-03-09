<?php $__env->startSection('content'); ?>

  
<h1>Dung lượng</h1>
<a href="<?php echo e(route('variants.create')); ?>" class="btn btn-primary">Thêm mới ram</a>
<?php if($variants->count()): ?>
<table  style="margin-top: 20px" class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Dung lượng (Smartphone)</th>
            <th>Giá</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody>
        <?php $__currentLoopData = $variants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $variant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($variant->id); ?></td>
                <td><?php echo e($variant->ram_smartphone); ?></td>
                <td><?php echo e(number_format($variant->price)); ?> đ</td>
                <td>
                    <a href="<?php echo e(route('variants.edit', $variant->id)); ?>" class="btn btn-warning">Sửa</a>
                    <form action="<?php echo e(route('variants.destroy', $variant->id)); ?>" method="POST" style="display:inline-block;">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button  type="submit" class="btn btn-danger">Xóa</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>
<?php else: ?>
<p>No Variant.</p>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\ProjectDT\datn\datn\resources\views/admin/variants/index.blade.php ENDPATH**/ ?>