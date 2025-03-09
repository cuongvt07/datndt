<?php $__env->startSection('content'); ?>

<h1>Thêm mới màn hình</h1>
<form action="<?php echo e(route('screens.store')); ?>" method="POST">
    <?php echo csrf_field(); ?>
    <label class="form-label" for="name">Tên màn hình:</label>
    <input class="form-control"  type="text" name="name" id="name" required>
    <button  style="margin-top: 20px" type="submit" class="btn btn-primary">Thêm</button>
</form>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\ProjectDT\datn\datn\resources\views/admin/screens/create.blade.php ENDPATH**/ ?>