<?php $__env->startSection('content'); ?>

<div class="container">
    <h1>Sửa Liên Kết Sản Phẩm - Biến Thể</h1>
    <form action="<?php echo e(route('product_variants.update', $productVariant->id)); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>
        <div class="mb-3">
            <label for="product_id" class="form-label">Sản Phẩm</label>
            <select name="product_id" id="product_id" class="form-control">
                <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($product->id); ?>" <?php echo e($product->id == $productVariant->product_id ? 'selected' : ''); ?>>
                        <?php echo e($product->name_sp); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="variant_id" class="form-label">Biến Thể</label>
            <select name="variant_id" id="variant_id" class="form-control">
                <?php $__currentLoopData = $variants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $variant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($variant->id); ?>" <?php echo e($variant->id == $productVariant->variant_id ? 'selected' : ''); ?>>
                        <?php echo e($variant->ram_smartphone); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Cập Nhật</button>
    </form>
</div>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\laragon\www\datn\resources\views/admin/product_variants/edit.blade.php ENDPATH**/ ?>