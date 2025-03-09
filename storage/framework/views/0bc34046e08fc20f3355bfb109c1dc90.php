<?php $__env->startSection('content'); ?>

<h1>Sửa pin</h1>

<?php if($errors->any()): ?>
    <div>
        <ul>
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
<?php endif; ?>

<form action="<?php echo e(route('batterys.update', $battery->id)); ?>" method="POST">
    <?php echo csrf_field(); ?>
    <?php echo method_field('PUT'); ?>

    <div>
        <label class="form-label" for="nme">Tên</label>
        <input class="form-control" type="text" name="name" value="<?php echo e($battery->name); ?>">
    </div>
    <div>
      <label class="form-label" for="capacity">Dung tích</label>
      <input class="form-control" type="text" name="capacity" value="<?php echo e($battery->capacity); ?>">
    </div>
    <div>
      <label class="form-label" for="price">Giá</label>
      <input class="form-control" type="number" name="price" value="<?php echo e($battery->price); ?>" required>
    </div>

    <button style="margin-top: 20px" class="btn btn-primary" type="submit">Cập nhật</button>
</form>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\datn1\resources\views/admin/batterys/edit.blade.php ENDPATH**/ ?>