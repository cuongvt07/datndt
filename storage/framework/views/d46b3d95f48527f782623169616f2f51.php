<?php $__env->startSection('content'); ?>

<h1>Nhà cung cấp</h1>
<a href="<?php echo e(route('suppliers.create')); ?>" class="btn btn-primary">Thêm nhà cung cấp</a>

    <table  style="margin-top: 20px" class="table">
        <thead>
            <tr>
                <th>Tên</th>
                <th>Thương hiệu</th>
                <th>Danh mục</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $suppliers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $supplier): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($supplier->name); ?></td>
                    <td><?php echo e($supplier->brand); ?></td>
                    <td><?php echo e($supplier->category->name); ?></td>
                    <td>
                        <a href="<?php echo e(route('suppliers.edit', $supplier)); ?>" class="btn btn-sm btn-warning">Sửa</a>
                        <form action="<?php echo e(route('suppliers.destroy', $supplier)); ?>" method="POST" style="display:inline-block;">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button  type="submit" class="btn btn-sm btn-danger">Xóa</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\laragon\www\datn1\resources\views/admin/suppliers/index.blade.php ENDPATH**/ ?>