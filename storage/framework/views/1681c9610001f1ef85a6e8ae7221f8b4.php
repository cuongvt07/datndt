<?php $__env->startSection('content'); ?>

<h1>Thêm nhà cung cấp</h1>
<form action="<?php echo e(route('suppliers.store')); ?>" method="POST">
    <?php echo csrf_field(); ?>
    <div>
        <label class="form-label" for="name">Tên nhà cung cấp</label>
        <input  class="form-control"  type="text" name="name" required>
    </div>
    <div>
        <label  class="form-label" for="brand">Thương hiệu</label>
        <input  class="form-control" type="text" name="brand" required>
    </div>
    <div>
        <label class="form-label" for="category_id">Danh mục</label>
        <select  class="form-control" name="category_id" required>
            <option value="">Chọn một danh mục</option>
            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>
    <button style="margin-top: 20px" type="submit" class="btn btn-primary">Thêm nhà cung cấp</button>
</form>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\datn1\resources\views/admin/suppliers/create.blade.php ENDPATH**/ ?>