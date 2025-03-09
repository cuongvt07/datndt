<?php $__env->startSection('content'); ?>
<h1>Sửa màu sắc</h1>
<form action="<?php echo e(route('colours.update', $colour)); ?>" method="POST">
    <?php echo csrf_field(); ?>
    <?php echo method_field('PUT'); ?>
    <div class="mb-3">
        <label for="name" class="form-label">Tên màu</label>
        <input type="text" class="form-control" id="name" name="name" value="<?php echo e($colour->name); ?>" required>
    </div>
    <div class="mb-3">
      <label for="quantity" class="form-label">Số lượng</label>
      <input type="text" class="form-control" id="quantity" name="quantity" required>
  </div>
    <button style="margin-top: 20px" type="submit" class="btn btn-success">Sửa màu sắc</button>
</form>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\laragon\www\datn\resources\views/admin/colours/edit.blade.php ENDPATH**/ ?>