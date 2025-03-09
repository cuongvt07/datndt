<?php $__env->startSection('content'); ?>

  
<h1>Sửa Người Dùng</h1>

    <form action="<?php echo e(route('users.update', $user)); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>
        <div>
            <label>Tên</label>
            <input type="text" name="name_user" class="form-control" value="<?php echo e($user->name_user); ?>" required>
        </div>
        <div>
            <label>Email</label>
            <input type="email" name="email"class="form-control" value="<?php echo e($user->email); ?>" required>
        </div>
        <div>
            <label>Vai Trò</label>
            <select name="role" class="form-control" required>
                <option value="admin" <?php echo e($user->role_id === 'admin' ? 'selected' : ''); ?>>Admin</option>
                <option value="employee" <?php echo e($user->role_id === 'employee' ? 'selected' : ''); ?>>Employee</option>
                <option value="user" <?php echo e($user->role_id === 'user' ? 'selected' : ''); ?>>User</option>
            </select>
        </div>
        <br>
        <button type="submit" class="btn btn-success">Cập Nhật Người Dùng</button>
    </form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\datn\resources\views/admin/users/edit.blade.php ENDPATH**/ ?>