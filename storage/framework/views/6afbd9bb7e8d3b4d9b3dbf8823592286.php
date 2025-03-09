<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Admin - Hình Ảnh Sản Phẩm</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />

    <!-- Fonts and icons -->
    <script src="<?php echo e(asset('asset-admin/js/plugin/webfont/webfont.min.js')); ?>"></script>
    <script>
        WebFont.load({
            google: {
                families: ["Public Sans:300,400,500,600,700"]
            },
            custom: {
                families: [
                    "Font Awesome 5 Solid",
                    "Font Awesome 5 Regular",
                    "Font Awesome 5 Brands",
                    "simple-line-icons",
                ],
                urls: ["../../asset-admin/css/fonts.min.css"],
            },
            active: function() {
                sessionStorage.fonts = true;
            },
        });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="<?php echo e(asset('asset-admin/css/bootstrap.min.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset('asset-admin/css/plugins.min.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset('asset-admin/css/kaiadmin.min.css')); ?>" />

    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link rel="stylesheet" href="<?php echo e(asset('asset-admin/css/demo.css')); ?>" />
</head>
<body>

<div class="wrapper">
    <!-- Sidebar -->
    <?php echo $__env->make('layouts.admin.sitebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <!-- End Sidebar -->

    <div class="main-panel">
        <?php echo $__env->make('layouts.admin.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <div class="container mt-4">
            <h1>Danh sách hình ảnh sản phẩm</h1>
            <a href="<?php echo e(route('product_image.create')); ?>" class="btn btn-primary mb-3">Thêm mới hình ảnh</a>

            <!-- Loop qua từng sản phẩm -->
            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="card mb-3">
                <div class="card-header d-flex justify-content-between align-items-center">
                 
                    <h4 class="mb-0"><?php echo e($product->name_sp); ?></h4>
                   
                    <button class="btn btn-primary btn-sm" data-bs-toggle="collapse" data-bs-target="#collapse-<?php echo e($product->id); ?>">
                        <i class="bi bi-plus"></i>
                    </button>
                </div>

                <div id="collapse-<?php echo e($product->id); ?>" class="collapse">
                    <div class="card-body">
                        <?php if($product->productImages->isNotEmpty()): ?>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Màu sắc</th>
                                    <th>Hình ảnh</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $product->productImages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($image->colour->name ?? 'Không có'); ?></td>
                                    <td>
                                        <img src="<?php echo e(asset('storage/' . $image->image_path)); ?>" width="100" alt="Hình sản phẩm">
                                    </td>
                                    <td>
                                        <!-- Nút sửa -->
                                        <a href="<?php echo e(route('product_image.edit', $image->id)); ?>" class="btn btn-warning btn-sm">Sửa</a>
                                        <!-- Nút xóa -->
                                        <form action="<?php echo e(route('product_image.destroy', $image->id)); ?>" method="POST" style="display:inline;">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
                                        </form>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                        <?php else: ?>
                        <p class="text-center">Không có hình ảnh nào cho sản phẩm này.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <?php echo $__env->make('layouts.admin.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>

    
</div>

<!-- Core JS Files -->
<script src="<?php echo e(asset('asset-admin/js/core/jquery-3.7.1.min.js')); ?>"></script>
<script src="<?php echo e(asset('asset-admin/js/core/popper.min.js')); ?>"></script>
<script src="<?php echo e(asset('asset-admin/js/core/bootstrap.min.js')); ?>"></script>

<!-- Plugin JS -->
<script src="<?php echo e(asset('asset-admin/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js')); ?>"></script>
<script src="<?php echo e(asset('asset-admin/js/plugin/chart.js/chart.min.js')); ?>"></script>
<script src="<?php echo e(asset('asset-admin/js/plugin/datatables/datatables.min.js')); ?>"></script>

</body>
</html>
<?php /**PATH E:\laragon\www\datn1\resources\views/admin/product_image/index.blade.php ENDPATH**/ ?>