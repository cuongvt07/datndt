<?php $__env->startSection('content'); ?>

<h1 class="">Sửa danh mục</h1>

<!-- Form để chỉnh sửa category -->
<form action="<?php echo e(route('categories.update', $category->id)); ?>" method="POST">
    <?php echo csrf_field(); ?>
    <?php echo method_field('PUT'); ?>

    <div class="form-group">
        <label for="name">Tên danh mục</label>
        <input type="text" name="name" id="name" class="form-control"
            value="<?php echo e($category->name); ?>" required>

        <?php if($errors->has('name')): ?>
            <span class="text-danger"><?php echo e($errors->first('name')); ?></span>
        <?php endif; ?>
    </div>
    <button type="submit" class="btn btn-success mt-3">Cập nhật</button>
</form>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\datn1\resources\views/admin/categories/edit.blade.php ENDPATH**/ ?>