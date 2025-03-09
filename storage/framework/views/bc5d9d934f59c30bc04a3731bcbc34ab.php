<?php $__env->startSection('content'); ?>

<form action="<?php echo e(route('product_image.update', $image->id)); ?>" method="POST" enctype="multipart/form-data">
    <?php echo csrf_field(); ?>
    <?php echo method_field('PUT'); ?>

    <label class="form-label" for="product_id">Sản phẩm:</label>
    <select class="form-control" name="product_id" id="product_id" required>
        <option value="">Chọn sản phẩm</option>
        <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($product->id); ?>" <?php echo e($product->id == $image->product_id ? 'selected' : ''); ?>><?php echo e($product->name_sp); ?></option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>

    <label class="form-label" for="colour_id">Màu sắc:</label>
    <select class="form-control" name="colour_id" id="colour_id" required>
        <option value="">Chọn màu</option>
        <!-- Các màu hiện tại của sản phẩm đã được chọn -->
        <?php $__currentLoopData = $colours; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $colour): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($colour->id); ?>" <?php echo e($colour->id == $image->colour_id ? 'selected' : ''); ?>><?php echo e($colour->name); ?></option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>

    <label class="form-label" for="image">Hình ảnh:</label>
    <input class="form-control" type="file" name="image">

    <button type="submit" class="btn btn-primary">Cập nhật</button>
</form>

<script>
    // Khi thay đổi sản phẩm, tải màu sắc động
    document.getElementById('product_id').addEventListener('change', function() {
        let productId = this.value;
        let colourSelect = document.getElementById('colour_id');

        // Xóa danh sách màu hiện tại
        colourSelect.innerHTML = '<option value="">Chọn màu</option>';

        if (productId) {
            fetch(`/admin/products/${productId}/colours`)
                .then(response => response.json())
                .then(data => {
                    data.forEach(function(colour) {
                        let option = document.createElement('option');
                        option.value = colour.id;
                        option.text = colour.name;
                        colourSelect.appendChild(option);
                    });

                    // Nếu sản phẩm đang sửa có màu, chọn màu đó
                    let currentColourId = '<?php echo e($image->colour_id); ?>';
                    if (currentColourId) {
                        colourSelect.value = currentColourId;
                    }
                })
                .catch(error => console.error('Error:', error));
        }
    });

    // Kích hoạt sự kiện 'change' khi tải trang để hiển thị màu hiện tại
    document.getElementById('product_id').dispatchEvent(new Event('change'));
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\laragon\www\datn\resources\views/admin/product_image/edit.blade.php ENDPATH**/ ?>