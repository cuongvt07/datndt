<?php $__env->startSection('content'); ?>
<h1>Sửa nhà cung cấp</h1>

<form action="<?php echo e(route('suppliers.update', $supplier->id)); ?>" method="POST">
    <?php echo csrf_field(); ?>
    <?php echo method_field('PUT'); ?>

    <div>
        <label class="form-label" for="name">Tên nhà cung cấp</label>
        <input class="form-control" type="text" name="name"
            value="<?php echo e(old('name', $supplier->name)); ?>" required>
    </div>

    <div>
        <label class="form-label" for="brand">Thương hiệu</label>
        <input class="form-control" type="text" name="brand"
            value="<?php echo e(old('brand', $supplier->brand)); ?>" required>
    </div>

    <div>
        <label class="form-label" for="category_id">Danh mục</label>
        <select class="form-control" name="category_id" required>
            <option value="">Select a category</option>
            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($category->id); ?>"
                    <?php echo e($supplier->category_id == $category->id ? 'selected' : ''); ?>>
                    <?php echo e($category->name); ?>

                </option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>

    <button style="margin-top: 20px" class="btn btn-primary" type="submit">Cập nhật nhà cung
        cấp</button>

</form>
  

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\datn1\resources\views/admin/suppliers/edit.blade.php ENDPATH**/ ?>