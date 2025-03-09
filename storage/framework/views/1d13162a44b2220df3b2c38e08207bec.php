<?php $__env->startSection('content'); ?>

<h1 class="">Thêm danh mục mới</h1>
<form action="<?php echo e(route('categories.store')); ?>" method="POST">
    <?php echo csrf_field(); ?>
    <div class="form-group">
        <label class="form-label" for="name">Tên danh mục</label>
        <input type="text" name="name" id="name" class="form-control" required>

        <?php if($errors->has('name')): ?>
            <span class="text-danger"><?php echo e($errors->first('name')); ?></span>
        <?php endif; ?>
    </div>
    <button style="margin-left: 10px;" type="submit" class="btn btn-success mt-3">Tạo danh mục</button>
</form>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\datn1\resources\views/admin/categories/create.blade.php ENDPATH**/ ?>