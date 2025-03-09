<?php $__env->startSection('content'); ?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap JS (và jQuery) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
    <?php if($errors->any()): ?>
        <div class="alert alert-danger">
            <ul>
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>
    <div class="container">
        <h5 style="margin-top: 40px">Tạo mã giảm giá mới</h5>

        <form action="<?php echo e(route('admin.discount_codes.store')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <div class="form-group">
                <label for="code">Mã giảm giá</label>
                <input type="text" name="code" id="code" class="form-control" value="<?php echo e(old('code')); ?>"
                    required>
            </div>

            <div class="form-group">
                <label for="discount_type">Loại giảm giá:</label>
                <select name="discount_type" id="discount_type" class="form-control" required>
                    <option value="percentage">Giảm theo %</option>
                    <option value="fixed">Giảm số tiền cố định</option>
                </select>
            </div>

            <div class="form-group" id="amount_field" style="display: none;">
                <label for="amount">Số tiền giảm:</label>
                <input type="number" name="amount" id="amount" class="form-control" placeholder="Nhập số tiền giảm">
            </div>

            <div class="form-group" id="percentage_field" style="display: none;">
                <label for="percentage">Phần trăm giảm:</label>
                <input type="number" name="percentage" id="percentage" class="form-control"
                    placeholder="Nhập phần trăm giảm">
            </div>

            <div class="form-group">
                <label for="usage_limit">Giới hạn sử dụng</label>
                <input type="number" name="usage_limit" id="usage_limit" class="form-control"
                    value="<?php echo e(old('usage_limit')); ?>">
            </div>

            <div class="form-group">
                <label for="start_date">Ngày bắt đầu</label>
                <input type="date" name="start_date" id="start_date" class="form-control" value="<?php echo e(old('start_date')); ?>"
                    required>
            </div>

            <div class="form-group">
                <label for="end_date">Ngày kết thúc</label>
                <input type="date" name="end_date" id="end_date" class="form-control" value="<?php echo e(old('end_date')); ?>"
                    required>
            </div>

            <div class="form-group">
                <label for="product_selection">Áp dụng cho:</label>
                <select name="product_selection" id="product_selection" class="form-control">
                    <option value="all">Tất cả sản phẩm</option>
                    <option value="specific">Chọn sản phẩm cụ thể</option>
                </select>
            </div>

            <!-- Nút thêm sản phẩm sẽ hiển thị khi chọn "Chọn sản phẩm cụ thể" -->
            <button type="button" class="btn btn-primary" id="add-products-button" style="display:none;">+
                Thêm sản
                phẩm</button>

            <input type="hidden" name="selected_products" id="selected_products" value="">

            <div id="selected-products" style="margin-top: 20px;">
                <h5>Sản phẩm đã chọn:</h5>
                <ul id="product-list"></ul>
            </div>

            <button type="submit" class="btn btn-success">Tạo mới</button>
        </form>

        <!-- Modal cho việc chọn sản phẩm -->
        <div class="modal fade" id="productModal" tabindex="-1" role="dialog" aria-labelledby="productModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="productModalLabel">Chọn sản phẩm</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <ul class="list-group">
                            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="list-group-item d-flex align-items-center justify-content-between">
                                    <div class="d-flex align-items-center">
                                        <img src="<?php echo e(asset('storage/' . $product->image)); ?>" alt="<?php echo e($product->name_sp); ?>"
                                            class="img-thumbnail" style="width: 50px; height: 50px; margin-right: 10px;">
                                        <span><?php echo e($product->name_sp); ?></span>
                                    </div>
                                    <input type="checkbox" class="product-checkbox" value="<?php echo e($product->id); ?>">
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                        <?php if($products->isEmpty()): ?>
                            <div class="alert alert-warning mt-3" role="alert">
                                Không có sản phẩm nào để chọn.
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                        <button type="button" class="btn btn-primary" id="confirm-selection">Xác
                            nhận</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const discountType = document.getElementById('discount_type');
            const amountField = document.getElementById('amount_field');
            const percentageField = document.getElementById('percentage_field');

            function toggleFields() {
                const selectedType = discountType.value;
                if (selectedType === 'fixed') {
                    amountField.style.display = 'block';
                    percentageField.style.display = 'none';
                    document.getElementById('percentage').value = ''; // Clear percentage value
                } else if (selectedType === 'percentage') {
                    percentageField.style.display = 'block';
                    amountField.style.display = 'none';
                    document.getElementById('amount').value = ''; // Clear amount value
                }
            }

            discountType.addEventListener('change', toggleFields);
            toggleFields();
        });

        document.getElementById('product_selection').addEventListener('change', function() {
            var selection = this.value;
            if (selection === 'specific') {
                document.getElementById('add-products-button').style.display = 'block';
            } else {
                document.getElementById('add-products-button').style.display = 'none';
                document.querySelectorAll('.product-checkbox').forEach(checkbox => {
                    checkbox.checked = false; // Bỏ chọn các sản phẩm khi chọn "Tất cả sản phẩm"
                });
            }
        });


        document.getElementById('add-products-button').addEventListener('click', function() {
            $('#productModal').modal('show');
        });

        document.getElementById('confirm-selection').addEventListener('click', function() {
            const selectedProducts = document.querySelectorAll('.product-checkbox:checked');
            const productList = document.getElementById('product-list');
            const selectedProductsInput = document.getElementById('selected_products');

            productList.innerHTML = ''; // Clear the product list display
            let selectedProductsArray = [];

            selectedProducts.forEach(function(checkbox) {
                const productId = checkbox.value;
                const productName = checkbox.parentElement.textContent.trim();

                // Add the product to the displayed list
                const li = document.createElement('li');
                li.textContent = productName;
                productList.appendChild(li);

                // Add the product ID to the hidden input
                selectedProductsArray.push(productId);
            });

            // Set the selected products input value as a comma-separated string
            selectedProductsInput.value = selectedProductsArray.join(',');

            // Close the modal
            $('#productModal').modal('hide');
        });
    </script>
<?php $__env->stopSection(); ?>

<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Bootstrap JS (và jQuery) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const discountType = document.getElementById('discount_type');
        const amountField = document.getElementById('amount_field');
        const percentageField = document.getElementById('percentage_field');

        function toggleFields() {
            const selectedType = discountType.value;
            if (selectedType === 'fixed') {
                amountField.style.display = 'block';
                percentageField.style.display = 'none';
                document.getElementById('percentage').value = ''; // Clear percentage value
            } else if (selectedType === 'percentage') {
                percentageField.style.display = 'block';
                amountField.style.display = 'none';
                document.getElementById('amount').value = ''; // Clear amount value
            }
        }

        discountType.addEventListener('change', toggleFields);
        toggleFields();
    });

    document.getElementById('product_selection').addEventListener('change', function() {
        var selection = this.value;
        if (selection === 'specific') {
            document.getElementById('add-products-button').style.display = 'block';
        } else {
            document.getElementById('add-products-button').style.display = 'none';
            document.querySelectorAll('.product-checkbox').forEach(checkbox => {
                checkbox.checked = false; // Bỏ chọn các sản phẩm khi chọn "Tất cả sản phẩm"
            });
        }
    });


    document.getElementById('add-products-button').addEventListener('click', function() {
        $('#productModal').modal('show');
    });

    document.getElementById('confirm-selection').addEventListener('click', function() {
        const selectedProducts = document.querySelectorAll('.product-checkbox:checked');
        const productList = document.getElementById('product-list');
        const selectedProductsInput = document.getElementById('selected_products');

        productList.innerHTML = ''; // Clear the product list display
        let selectedProductsArray = [];

        selectedProducts.forEach(function(checkbox) {
            const productId = checkbox.value;
            const productName = checkbox.parentElement.textContent.trim();

            // Add the product to the displayed list
            const li = document.createElement('li');
            li.textContent = productName;
            productList.appendChild(li);

            // Add the product ID to the hidden input
            selectedProductsArray.push(productId);
        });

        // Set the selected products input value as a comma-separated string
        selectedProductsInput.value = selectedProductsArray.join(',');

        // Close the modal
        $('#productModal').modal('hide');
    });
</script>

<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\laragon\www\datn\resources\views/admin/discount_codes/create.blade.php ENDPATH**/ ?>