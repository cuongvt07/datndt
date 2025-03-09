<?php $__env->startSection('content'); ?>
    <h1>Thêm sản phẩm</h1>

    <form action="<?php echo e(route('products.store')); ?>" method="POST" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <div class="form-group">
            <label for="name_sp">Tên sản phẩm</label>
            <input type="text" name="name_sp" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="image">Hình ảnh</label>
            <input type="file" name="image" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="price">Giá</label>
            <input type="number" name="price" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="description">Mô tả</label>
            <input type="text" name="description" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="stock">Số lượng</label>
            <input type="number" name="stock" class="form-control" required>
        </div>

        <div class="form-group">
            <label class="form-label" for="category_id">Danh mục</label>
            <select class="form-control" name="category_id" required>
                <option value="">Chọn danh mục</option>
                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        <div class="form-group">
            <label class="form-label" for="supplier_id">Nhà cung cấp</label>
            <select class="form-control" name="supplier_id" required>
                <option value="">Nhà một nhà cung cấp</option>
                <?php $__currentLoopData = $suppliers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $supplier): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($supplier->id); ?>"><?php echo e($supplier->brand); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        <div class="row">
            <div class="col">
                <label class="form-label" for="ram_variant">RAM</label>
                <select class="form-control" name="variant_id">
                    <option value="">Chọn RAM</option>
                    <?php $__currentLoopData = $variants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $variant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($variant->id); ?>"><?php echo e($variant->ram_smartphone); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div class="col">
                <label class="form-label" for="colours">Màu sắc</label>


                <input type="text" id="colourFilter" class="form-control mb-2" placeholder="Tìm kiếm màu sắc...">


                <select class="form-control" name="colour_id" id="colourDropdown">
                    <option value="">Chọn màu sắc</option>
                    <?php $__currentLoopData = $colours->take(10); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $colour): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                        <option value="<?php echo e($colour->id); ?>"><?php echo e($colour->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                
            </div>

            <div class="col">
                <label class="form-label" for="battery">Pin</label>
                <select class="form-control" name="battery_id">
                    <option value="">Chọn pin</option>
                    <?php $__currentLoopData = $batterys; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $battery): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($battery->id); ?>"><?php echo e($battery->capacity); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div class="col">
                <label class="form-label" for="screen_id">Màn hình</label>
                <select class="form-control" name="screen_id">
                    <option value="">Chọn màn hình</option>
                    <?php $__currentLoopData = $screens; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $screen): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($screen->id); ?>"><?php echo e($screen->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
        </div>

        <button style="margin-top: 20px" type="submit" class="btn btn-primary">Lưu</button>
    </form>
<?php $__env->stopSection(); ?>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const colourFilter = document.getElementById("colourFilter");
        const colourDropdown = document.getElementById("colourDropdown");

        colourFilter.addEventListener("input", function () {
            const filterText = colourFilter.value.toLowerCase();
            const options = colourDropdown.querySelectorAll("option");

            options.forEach(option => {
                if (option.textContent.toLowerCase().includes(filterText) || option.value === "") {
                    option.style.display = "block";
                } else {
                    option.style.display = "none";
                }
            });
        });
    });
</script>

<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\laragon\www\datn1\resources\views/admin/products/create.blade.php ENDPATH**/ ?>