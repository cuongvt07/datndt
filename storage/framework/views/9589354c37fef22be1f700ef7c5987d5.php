<?php $__env->startSection('content'); ?>

<form action="<?php echo e(route('variants.store')); ?>" method="POST">
  <?php echo csrf_field(); ?>
  <div>
      <label class="form-label" for="ram_smartphone" >RAM Smartphone</label>
      <input class="form-control" type="text" name="ram_smartphone" required>
  </div>
  <div>
    <label class="form-label" for="price" >Price RAM Smartphone</label>
    <input class="form-control" type="number" name="price" required>
</div>
  <button style="margin-top: 20px" class="btn btn-primary" type="submit">Tạo mới ram</button>
</form>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\datn1\resources\views/admin/variants/create.blade.php ENDPATH**/ ?>