<?php $__env->startSection('content'); ?>

<h1>Chỉnh Sửa Màn Hình</h1>
<form action="<?php echo e(route('screens.update', $screen->id)); ?>" method="POST">
    <?php echo csrf_field(); ?>
    <?php echo method_field('PUT'); ?>
    <div class="form-group">
        <label class="form-label" for="name">Tên Màn Hình</label>
        <input class="form-control"  type="text" class="form-control" id="name" name="name" value="<?php echo e($screen->name); ?>" required>
    </div>
    <button type="submit" class="btn btn-primary">Cập Nhật</button>
</form>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\datn1\resources\views/admin/screens/edit.blade.php ENDPATH**/ ?>