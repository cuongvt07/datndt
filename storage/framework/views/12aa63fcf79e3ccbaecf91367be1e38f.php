<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="container mt-4">
        <h1>Sửa sản phẩm</h1>
        <?php if($errors->any()): ?>
            <div class="alert alert-danger">
                <ul>
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>


        <form action="<?php echo e(route('products.update', $product->id)); ?>" method="POST"
            enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <div>
                <label class="form-label" for="name_sp">Tên sản phẩm</label>
                <input class="form-control" type="text" name="name_sp"
                    value="<?php echo e(old('name_sp', $product->name_sp)); ?>" required>
            </div>
            <div>
                <label class="form-label" for="image">Ảnh sản phẩm</label>
                <input class="form-control" type="file" name="image" accept="image/*">
                <?php if($product->image): ?>
                    <img src="<?php echo e(asset('storage/' . $product->image)); ?>" alt="<?php echo e($product->name_sp); ?>"
                        width="100" style="margin-top: 10px;">
                <?php endif; ?>
            </div>
            <div>
                <label class="form-label" for="stock">Số lượng</label>
                <input class="form-control" type="number" name="stock"
                    value="<?php echo e(old('stock', $product->stock)); ?>" required>
            </div>


            <div>
                <label class="form-label" for="description">Mô tả</label>
                <textarea class="form-control" name="description" required><?php echo e(old('description', $product->description)); ?></textarea>
            </div>

            <div>
                <label class="form-label" for="price">Giá</label>
                <input class="form-control" type="number" name="price"
                    value="<?php echo e(old('price', $product->price)); ?>" step="0.01" required>
            </div>

            <div>
                <label class="form-label" for="category_id">Danh mục</label>
                <select class="form-control" name="category_id" required>
                    <option value="">Chọn một danh mục</option>
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($category->id); ?>"
                            <?php echo e($product->category_id == $category->id ? 'selected' : ''); ?>>
                            <?php echo e($category->name); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>


            <div>
                <label class="form-label" for="supplier_id">Nhà cung cấp</label>
                <select class="form-control" name="supplier_id" required>
                    <option value="">Chọn một nhà cung cấp</option>
                    <?php $__currentLoopData = $suppliers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $supplier): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($supplier->id); ?>"
                            <?php echo e($product->supplier_id == $supplier->id ? 'selected' : ''); ?>>
                            <?php echo e($supplier->name); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>

            <?php if($product->variant_id): ?>
                <div>
                    <label class="form-label" for="variant_id">Ram</label>
                    <select class="form-control" name="variant_id" >
                        <option value="">Chọn một Ram</option>
                        <?php $__currentLoopData = $variants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $variant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($variant->id); ?>"
                                <?php echo e($product->variant_id == $variant->id ? 'selected' : ''); ?>>
                                <?php echo e($variant->ram_smartphone); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            <?php endif; ?>


            <button style="margin-top: 20px" class="btn btn-primary" type="submit">Cập nhật sản
                phẩm</button>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\datn1\resources\views/admin/products/edit.blade.php ENDPATH**/ ?>