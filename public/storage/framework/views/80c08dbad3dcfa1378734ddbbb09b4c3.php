<?php $__env->startSection('content'); ?>

  
<h1>User List</h1>

<?php if(session('success')): ?>
    <div class="alert alert-success">
        <?php echo e(session('success')); ?>

    </div>
<?php endif; ?>

<a href="<?php echo e(route('users.create')); ?>" class="btn btn-primary mb-3">Add New User</a>

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
          <td><?php echo e($user->role->name); ?></td>
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\datn\resources\views/admin/users/index.blade.php ENDPATH**/ ?>