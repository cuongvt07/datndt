<?php $__env->startSection('content'); ?>
    <div class="container mt-4">
        <h1>Sản phẩm</h1>
        <?php if(session('success')): ?>
            <div class="alert alert-success"><?php echo e(session('success')); ?></div>
        <?php endif; ?>
        <div class="row justify-content-center align-items-center">
            <div class="col-3"> <a href="<?php echo e(route('products.create')); ?>" class="btn btn-primary btn-block">Thêm sản phẩm</a>
            </div>
            
            <div class="col-9">
                <form id="search-form" action="<?php echo e(route('products.index')); ?>" method="GET">
                    <div class="row justify-content-center align-items-center">
                        <div class="col-6">
                            <input type="text" class="form-control" value="<?php echo e(request()->input('keyword')); ?>"
                                name="keyword" id="keyword">
                        </div>
                        <div class="col-3">
                            <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                        </div>
                    </div>
                </form>
            </div>

            <div id="product-list">
                <?php echo $__env->make('admin.products.partials.product_list', ['products' => $products], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
        </div>

    </div>
   

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\datn1\resources\views/admin/products/index.blade.php ENDPATH**/ ?>