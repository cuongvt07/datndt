<?php $__env->startSection('content'); ?>

<h1>Danh sách màn hình</h1>
<a href="<?php echo e(route('screens.create')); ?>" class="btn btn-primary">Thêm mới màn hình</a>

<table style="margin-top: 20px" class="table">

    <thead>
      <tr>
        <th>ID</th>
      <th>Tên</th>
      <th>Hành động</th>
      </tr>
    </thead>
    <tbody>
      <?php $__currentLoopData = $screens; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $screen): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
     <tr>
      <td><?php echo e($screen->id); ?> </td>
      <td><?php echo e($screen->name); ?> </td>
      <td>
        <a href="<?php echo e(route('screens.edit', $screen)); ?>"  class="btn btn-warning">Sửa</a>
      <form action="<?php echo e(route('screens.destroy', $screen)); ?>" method="POST" style="display:inline;">
          <?php echo csrf_field(); ?>
          <?php echo method_field('DELETE'); ?>
          <button  class="btn btn-danger" type="submit">Xóa</button>
      </form>
      </td>
     </tr>
      
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    </tbody>


</table>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\ProjectDT\datn\datn\resources\views/admin/screens/index.blade.php ENDPATH**/ ?>