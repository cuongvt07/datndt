<?php $__env->startSection('content'); ?>

<form action="<?php echo e(route('product_image.store')); ?>" method="POST" enctype="multipart/form-data">
    <?php echo csrf_field(); ?>
    <div class="form-group">
        <label class="form-label" for="filter_product">Tìm kiếm sản phẩm:</label>
        <input type="text" class="form-control" id="filter_product" placeholder="Nhập tên sản phẩm để tìm...">
    </div>

    <div class="form-group">
        <label class="form-label" for="product_id">Sản phẩm:</label>
        <select class="form-control" name="product_id" id="product_id" >
            <option value="">Chọn sản phẩm</option>
            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($product->id); ?>"><?php echo e($product->name_sp); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
        <?php $__errorArgs = ['product_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
      <div class="text-danger"><?php echo e($message); ?></div>
  <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>

    <div class="form-group">
        <label class="form-label" for="colour_id">Màu sắc:</label>
        <select class="form-control" name="colour_id" id="colour_id" >
            <option value="">Chọn màu</option>
        </select>
        <?php $__errorArgs = ['colour_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
      <div class="text-danger"><?php echo e($message); ?></div>
  <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>

    <div class="form-group">
        <label class="form-label" for="image">Hình ảnh:</label>
        <input class="form-control" type="file" name="image" >
        <?php $__errorArgs = ['image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
      <div class="text-danger"><?php echo e($message); ?></div>
  <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>
    <button style="margin-top: 20px" type="submit" class="btn btn-primary">Tải lên</button>
</form>

<script>
    // Lọc sản phẩm trong danh sách
    document.getElementById('filter_product').addEventListener('input', function() {
        const filterValue = this.value.toLowerCase();
        const productSelect = document.getElementById('product_id');
        const options = productSelect.options;

        for (let i = 1; i < options.length; i++) { // Bắt đầu từ 1 để bỏ qua "Chọn sản phẩm"
            const productName = options[i].text.toLowerCase();
            options[i].style.display = productName.includes(filterValue) ? 'block' : 'none';
        }
    });

    // Load màu sắc khi chọn sản phẩm
    document.getElementById('product_id').addEventListener('change', function() {
        let productId = this.value;
        let colourSelect = document.getElementById('colour_id');

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
                })
                .catch(error => console.error('Error:', error));
        }
    });
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\LARAGON-PHP2\laragon\www\datn\resources\views/admin/product_image/create.blade.php ENDPATH**/ ?>