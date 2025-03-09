<?php $__env->startSection('content'); ?>

<h1>Thêm màu sắc</h1>
<form action="<?php echo e(route('colours.store')); ?>" method="POST">
    <?php echo csrf_field(); ?>
    <div class="form-group">
        <label class="form-label" for="filter_product">Tìm kiếm sản phẩm:</label>
        <input type="text" class="form-control" id="filter_product" placeholder="Nhập tên sản phẩm để tìm...">
    </div>

    <div class="form-group">
        <label class="form-label" for="product_id">Sản phẩm:</label>
        <select class="form-control" name="product_id" id="product_id" required>
            <option value="">Chọn sản phẩm</option>
            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($product->id); ?>"><?php echo e($product->name_sp); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>
    <div class="mb-3">
        <label for="name" class="form-label">Tên màu</label>
        <input type="text" class="form-control" id="name" name="name" required>
    </div>
    <div class="mb-3">
        <label for="price" class="form-label">Giá</label>
        <input type="number" class="form-control" id="price" name="price" required>
    </div>
    <div class="mb-3">
        <label for="quantity" class="form-label">Số lượng</label>
        <input type="number" class="form-control" id="quantity" name="quantity" required>
    </div>
    <button style="margin-top: 20px" type="submit" class="btn btn-success">Thêm màu sắc</button>
</form>

<script>
    // Lọc sản phẩm trong danh sách
    document.getElementById('filter_product').addEventListener('input', function() {
        const filterValue = this.value.toLowerCase();
        const productSelect = document.getElementById('product_id');
        const options = productSelect.options;

        for (let i = 1; i < options.length; i++) { // Bỏ qua "Chọn sản phẩm"
            const productName = options[i].text.toLowerCase();
            options[i].style.display = productName.includes(filterValue) ? 'block' : 'none';
        }
    });
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\LARAGON-PHP2\laragon\www\datn\resources\views/admin/colours/create.blade.php ENDPATH**/ ?>