<?php $__env->startSection('content'); ?>
    <h1 style="margin-top: 60px;">Thêm sản phẩm</h1>

    <form action="<?php echo e(route('products.store')); ?>" method="POST" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-6 ">
                    <div class="card shadow-lg" style="width: 1230px;">
                        <div class="card-header bg-primary text-white">
                            <h4 class="mb-0">Tạo Đơn Hàng</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group  mb-3">
                                <label for="name_sp">Tên sản phẩm</label>
                                <input type="text" name="name_sp" class="form-control"  value="<?php echo e(old('name_sp')); ?>">
                                <?php $__errorArgs = ['name_sp'];
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
                    
                            <div class="form-group  mb-3">
                                <label for="image">Hình ảnh</label>
                                <input type="file" name="image" class="form-control" >
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
                    
                            <div class="form-group  mb-3" >
                                <label for="price">Giá</label>
                                <input type="number" name="price" class="form-control"  value="<?php echo e(old('price')); ?>">
                                <?php $__errorArgs = ['price'];
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
                    
                            <div class="form-group  mb-3">
                                <label for="description">Mô tả</label>
                                <input type="text" name="description" class="form-control"  value="<?php echo e(old('description')); ?>">
                                <?php $__errorArgs = ['description'];
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
                    
                    
                            <div class="form-group  mb-3">
                                <label class="form-label" for="category_id">Danh mục</label>
                                <select class="form-control" name="category_id" >
                                    <option value="">Chọn danh mục</option>
                                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($category->id); ?>" <?php echo e(old('category_id') == $category->id ? 'selected' : ''); ?>><?php echo e($category->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <?php $__errorArgs = ['category_id'];
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
                            <div class="form-group  mb-3">
                                <label class="form-label" for="supplier_id">Nhà cung cấp</label>
                            
                              
                                <input type="text" id="supplierFilter" class="form-control mb-2" placeholder="Tìm kiếm nhà cung cấp...">
                            
                               
                                <select class="form-control" name="supplier_id" id="supplierDropdown">
                                    <option value="">Chọn nhà cung cấp</option>
                                    <?php $__currentLoopData = $suppliers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $supplier): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($supplier->id); ?>" <?php echo e(old('supplier_id') == $supplier->id ? 'selected' : ''); ?>><?php echo e($supplier->brand); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            
                                <?php $__errorArgs = ['supplier_id'];
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
                    
                            <button style="margin-top: 20px" type="submit" class="btn btn-success w-100">Lưu</button>
    
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
       
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
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const supplierFilter = document.getElementById("supplierFilter");
        const supplierDropdown = document.getElementById("supplierDropdown");

        supplierFilter.addEventListener("input", function () {
            const filterText = supplierFilter.value.toLowerCase();
            const options = supplierDropdown.querySelectorAll("option");

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


<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\LARAGON-PHP2\laragon\www\datn\resources\views/admin/products/create.blade.php ENDPATH**/ ?>