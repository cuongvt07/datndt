<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">


<?php $__env->startSection('content'); ?>

  
<h1>Danh sách người dùng</h1>

<?php if(session('success')): ?>
    <div class="alert alert-success">
        <?php echo e(session('success')); ?>

    </div>
<?php endif; ?>

<a href="<?php echo e(route('users.create')); ?>" class="btn btn-primary mb-3">Thêm mới người dùng</a>
<form action="<?php echo e(route('users.index')); ?>" method="GET" class="mb-3">
    <div class="input-group">
        <input type="text" name="search" class="form-control" placeholder="Tìm kiếm người dùng..." value="<?php echo e(request('search')); ?>">
        <button class="btn btn-primary" type="submit">Tìm kiếm</button>
    </div>
</form>

<table class="table table-bordered">
    <thead>
        <tr>
          <th>Tên</th>
          <th>Email</th>
          <th>Vai Trò</th>
          <th>Hành Động</th>
        </tr>
    </thead>
    <tbody>
      <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <tr>
          <td><?php echo e($user->name_user); ?></td>
          <td><?php echo e($user->email); ?></td>
          <td><?php echo e($user->role->name ?? ''); ?></td>
          <td>
              <a href="<?php echo e(route('users.edit', $user)); ?>" class="btn btn-primary">Sửa</a>
              <form action="<?php echo e(route('users.destroy', $user)); ?>" method="POST" style="display:inline;">
                  <?php echo csrf_field(); ?>
                  <?php echo method_field('DELETE'); ?>
                  <button  class="btn btn-danger" type="submit">Xóa</button>
              </form>
          </td>
      </tr>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>
<div class="d-flex justify-content-center">
    <?php echo e($users->links('pagination::bootstrap-5')); ?>

</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\ProjectDT\datn\datn\resources\views/admin/users/index.blade.php ENDPATH**/ ?>