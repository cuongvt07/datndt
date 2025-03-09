<?php $__env->startSection('content'); ?>
    <form action="<?php echo e(route('admin.orders.store')); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-6 ">
                    <div class="card shadow-lg" style="width: 1230px;">
                        <div class="card-header bg-primary text-white">
                            <h4 class="mb-0">Tạo Đơn Hàng</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group mb-3">
                                <label for="status">Trạng thái</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="pending">Chờ xử lý</option>
                                    <option value="confirmed">Đã xác nhận</option>
                                    <option value="delivering">Đang giao</option>
                                    <option value="completed">Đã hoàn thành</option>
                                    <option value="canceled">Đã hủy</option>
                                </select>
                            </div>
                    
                            <div class="form-group mb-3">
                                <label for="phone">Số điện thoại</label>
                                <input type="text" name="phone" id="phone" class="form-control">
                                <?php $__errorArgs = ['phone'];
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
                    
                            <div class="form-group mb-3">
                                <label for="detail_address">Địa chỉ chi tiết</label>
                                <input type="text" name="detail_address" id="detail_address" class="form-control">
                                <?php $__errorArgs = ['detail_address'];
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
                    
                            <div class="form-group row mb-3">
                                <div class="col-md-4">
                                    <label for="province">Tỉnh</label>
                                    <select id="tinh" name="province" class="form-select">
                                        <option value="">Chọn Tỉnh Thành</option>
                                    </select>
                                    <?php $__errorArgs = ['province'];
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
                    
                                <div class="col-md-4">
                                    <label for="district">Quận</label>
                                    <select id="quan" name="district" class="form-select">
                                        <option value="">Chọn Quận Huyện</option>
                                    </select>
                                    <?php $__errorArgs = ['district'];
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
                    
                                <div class="col-md-4">
                                    <label for="ward">Phường</label>
                                    <select id="phuong" name="ward" class="form-select">
                                        <option value="">Chọn Phường Xã</option>
                                    </select>
                                    <?php $__errorArgs = ['ward'];
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
                            </div>
                    
                            <div class="form-group mb-3">
                                <label for="product_search">Tìm sản phẩm</label>
                                <input type="text" id="product_search" class="form-control" placeholder="Enter product name">
                            </div>
                    
                            <div class="form-group mb-3">
                                <label for="product_id">Sản phẩm</label>
                                <select name="product_id" id="product_id" class="form-control">
                                    <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($product->id); ?>" data-price="<?php echo e($product->price); ?>"><?php echo e($product->name_sp); ?></option>
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
                    
                            <div class="form-group mb-3">
                                <label for="variant_id">Biến thể</label>
                                <select name="variant_id" id="variant_id" class="form-control">
                                    <option value="">Chọn biến thể</option>
                                    <?php $__currentLoopData = $variants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $variant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($variant->id); ?>" data-price="<?php echo e($variant->extra_price); ?>">
                                            <?php echo e($variant->ram_smartphone); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                    
                            
                            
                            <div class="form-group mb-3">
                                <label for="color_id">Màu sắc</label>
                                <select name="color_id" id="color_id" class="form-control">
                                    <option value="">Chọn màu sắc</option>
                                    <?php $__currentLoopData = $colours; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $color): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($color->id); ?>" data-price="<?php echo e($color->extra_price); ?>"><?php echo e($color->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <?php $__errorArgs = ['color_id'];
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
                            
                    
                    
                            <div class="form-group mb-3">
                                <label for="battery_id">Pin</label>
                                <select name="battery_id" id="battery_id" class="form-control">
                                    <option value="">Chọn pin</option>
                                    <?php $__currentLoopData = $batterys; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $battery): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($battery->id); ?>"><?php echo e($battery->capacity); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                    
                            <div class="form-group mb-3">
                                <label for="quantity">Số lượng</label>
                                <input type="number" name="quantity" id="quantity" class="form-control" value="1" min="1">
                                <?php $__errorArgs = ['quantity'];
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
                    
                            <div class="form-group mb-3">
                                <label for="shipping_fee">Phí vận chuyển</label>
                                <input type="number" name="shipping_fee" id="shipping_fee" class="form-control">
                            </div>
                    
                    
                            <div class="form-group mb-3">
                                <label for="price">Giá</label>
                                <input type="number" name="price" id="price" class="form-control" readonly>
                            </div>
                    
                            <div class="form-group mb-3">
                                <label for="total_price">Tổng giá</label>
                                <input type="number" name="total_price" id="total_price" class="form-control" readonly>
                            </div>
                    
                            <button type="submit" class="btn btn-success w-100">Lưu</button>
    
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </form>
<?php $__env->stopSection(); ?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Tìm kiếm sản phẩm
        $('#product_search').on('keyup', function() {
            let query = $(this).val();
            $.ajax({
                url: "<?php echo e(route('admin.products.search')); ?>",
                type: "GET",
                data: {
                    query: query
                },
                success: function(data) {
                    let options = '<option value="">Chọn sản phẩm</option>';
                    data.forEach(product => {
                        options +=
                            `<option value="${product.id}" data-price="${product.price}">${product.name_sp}</option>`;
                    });
                    $('#product_id').html(options);
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        });

        // Tải dữ liệu tỉnh, quận, phường
        let provinces = {},
            districts = {},
            wards = {};

        $.getJSON('https://esgoo.net/api-tinhthanh/1/0.htm', function(data_tinh) {
            if (data_tinh.error == 0) {
                $.each(data_tinh.data, function(key_tinh, val_tinh) {
                    provinces[val_tinh.id] = val_tinh.full_name;
                    $("#tinh").append('<option value="' + val_tinh.id + '">' + val_tinh
                        .full_name + '</option>');
                });

                // Tải quận khi tỉnh thay đổi
                $("#tinh").change(function() {
                    var idtinh = $(this).val();
                    $.getJSON('https://esgoo.net/api-tinhthanh/2/' + idtinh + '.htm', function(
                        data_quan) {
                        if (data_quan.error == 0) {
                            $("#quan").html(
                            '<option value="">Chọn Quận Huyện</option>');
                            $("#phuong").html(
                                '<option value="">Chọn Phường Xã</option>');
                            $.each(data_quan.data, function(key_quan, val_quan) {
                                districts[val_quan.id] = val_quan.full_name;
                                $("#quan").append('<option value="' + val_quan
                                    .id + '">' + val_quan.full_name +
                                    '</option>');
                            });
                        }
                    });
                });

                // Tải phường khi quận thay đổi
                $("#quan").change(function() {
                    var idquan = $(this).val();
                    $.getJSON('https://esgoo.net/api-tinhthanh/3/' + idquan + '.htm', function(
                        data_phuong) {
                        if (data_phuong.error == 0) {
                            $("#phuong").html(
                                '<option value="">Chọn Phường Xã</option>');
                            $.each(data_phuong.data, function(key_phuong, val_phuong) {
                                wards[val_phuong.id] = val_phuong.full_name;
                                $("#phuong").append('<option value="' +
                                    val_phuong.id + '">' + val_phuong
                                    .full_name + '</option>');
                            });
                        }
                    });
                });
            }
        });

        // Tính phí vận chuyển
        function calculateShippingFee() {
            let province = $('#tinh').val();
            let shippingFee = 0;


            if (province === '01') {
                shippingFee = 25000;
            } else if (['24', '27', '42', '30', '35', '33', '17', '36', '19', '37'].includes(province)) {
                shippingFee = 30000;
            } else {
                shippingFee = 40000;
            }

            $('#shipping_fee').val(shippingFee);
        }

        $('#tinh').on('change', function() {
            calculateShippingFee();
        });

        // Tính tổng giá
        $('#quantity, #product_id, #variant_id, #color_id').on('change', function() {
            let quantity = $('#quantity').val();
            let productPrice = $('#product_id option:selected').data('price') || 0;
            let variantPrice = $('#variant_id option:selected').data('price') || 0;
            let colorPrice = $('#color_id option:selected').data('price') || 0;
            let shippingFee = $('#shipping_fee').val();

            let totalPrice = (productPrice + variantPrice + colorPrice) * quantity + parseInt(
                shippingFee);
            $('#price').val(productPrice + variantPrice + colorPrice);
            $('#total_price').val(totalPrice);
        });
    });
</script>


<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\datn\resources\views/admin/orders/create.blade.php ENDPATH**/ ?>