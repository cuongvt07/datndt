<?php $__env->startSection('content'); ?>

<h1><?php echo e($product->name_sp); ?></h1>

<div class="card">
    <div class="card-body">
        <?php if($product->image): ?>
            <img src="<?php echo e(asset('storage/' . $product->image)); ?>" alt="<?php echo e($product->name_sp); ?>" class="img-fluid mb-3">
        <?php endif; ?>
        <p><strong>Description:</strong> <?php echo e($product->description); ?></p>
        <p><strong>Price:</strong> <?php echo e(number_format($product->price, 2)); ?> VNĐ</p>
        <p><strong>Colour:</strong> <?php echo e($product->colour->name ?? 'N/A'); ?></p>
        <p><strong>Screen:</strong> <?php echo e($product->screen->name ?? 'N/A'); ?></p>
        <p><strong>Ram:</strong> <?php echo e($product->variant->ram_smartphone ?? 'N/A'); ?></p>
        <p><strong>Battery:</strong> <?php echo e($product->battery->capacity ?? 'N/A'); ?></p>
        <p><strong>Category:</strong> <?php echo e($product->category->name ?? 'N/A'); ?></p>
        <p><strong>Supplier:</strong> <?php echo e($product->supplier->brand ?? 'N/A'); ?></p>
    </div>
    <div class="card-footer">
        <a href="<?php echo e(route('products.edit', $product->id)); ?>" class="btn btn-warning">Edit Product</a>
        <form action="<?php echo e(route('products.destroy', $product->id)); ?>" method="POST" style="display:inline;">
            <?php echo csrf_field(); ?>
            <?php echo method_field('DELETE'); ?>
            <button type="submit" class="btn btn-danger">Delete Product</button>
        </form>
        <a href="<?php echo e(route('products.index')); ?>" class="btn btn-secondary">Back to Products</a>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\datn1\resources\views/admin/products/show.blade.php ENDPATH**/ ?>