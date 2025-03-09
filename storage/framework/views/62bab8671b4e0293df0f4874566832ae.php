<?php $__env->startSection('content'); ?>

<h1>Danh sách pin</h1>
<a href="<?php echo e(route('batterys.create')); ?>" class="btn btn-primary">Thêm mới pin</a>

<?php if($message = Session::get('success')): ?>
    <p><?php echo e($message); ?></p>
<?php endif; ?>

<table style="margin-top: 20px" class="table">
  <thead>
    <tr>
        <th>Id</th>
        <th>Tên </th>
        <th>Dung tích</th>                          
        <th>Hành động</th>
    </tr>
  </thead>
  <tbody>
    <?php $__currentLoopData = $batterys; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $battery): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
          <td><?php echo e($battery->id); ?></td>
          <td><?php echo e($battery->name); ?></td>
          <td><?php echo e($battery->capacity); ?></td>
            <td>
                <a href="<?php echo e(route('batterys.edit', $battery->id)); ?>" class="btn btn-warning">Sửa</a>
                <form action="<?php echo e(route('batterys.destroy', $battery->id)); ?>" method="POST"
                    style="display:inline;">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button class="btn btn-danger"   type="submit">Xóa</button>
                </form>
            </td>
        </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </tbody>
</table>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\ProjectDT\datn\datn\resources\views/admin/batterys/index.blade.php ENDPATH**/ ?>