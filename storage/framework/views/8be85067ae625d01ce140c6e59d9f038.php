<?php $__env->startSection('content'); ?>

<h1>Thêm mới pin</h1>

<?php if($errors->any()): ?>
    <div>
        <ul>
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
<?php endif; ?>

<form action="<?php echo e(route('batterys.store')); ?>" method="POST">
    <?php echo csrf_field(); ?>

    <div>
        <label class="form-label" for="name">Tên</label>
        <input class="form-control" type="text" name="name" placeholder="Name">
    </div>
    <div>
      <label class="form-label" for="capacity">Dung tích</label>
      <input class="form-control" type="text" name="capacity" placeholder="Capacity">
    </div>
    <div>
      <label class="form-label" for="price">Giá</label>
      <input class="form-control" type="number" name="price" placeholder="price" required>
    </div>

    <button style="margin-top: 20px" class="btn btn-primary"  type="submit">Thêm</button>
</form>
  

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\datn1\resources\views/admin/batterys/create.blade.php ENDPATH**/ ?>