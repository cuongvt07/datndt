<?php $__env->startSection('content'); ?>
<h1>Sản phẩm và Màu sắc</h1>
                <a href="<?php echo e(route('colours.create')); ?>" class="btn btn-primary mb-4">Thêm màu sắc</a>

                <!-- Loop qua từng sản phẩm -->
                <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="card mb-3">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <!-- Hiển thị tên sản phẩm -->
                            <h4 class="mb-0"><?php echo e($product->name_sp); ?></h4>
                            <!-- Nút dấu cộng để mở rộng -->
                            <button class="btn btn-primary btn-sm" data-bs-toggle="collapse"
                                data-bs-target="#collapse-<?php echo e($product->id); ?>">
                                <i class="bi bi-plus"></i>
                            </button>
                        </div>

                        <!-- Vùng chi tiết của màu sắc thuộc sản phẩm này (collapse) -->
                        <div id="collapse-<?php echo e($product->id); ?>" class="collapse">
                            <div class="card-body">
                                <a href="<?php echo e(route('product_image.create')); ?>" class="btn btn-primary mb-3">Thêm mới hình
                                    ảnh</a>
                                <?php if($product->colours->isNotEmpty()): ?>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Màu sắc</th>
                                                <th>Số lượng</th>
                                                <th>Giá</th>
                                                <th>Hành động</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- Loop qua từng màu sắc của sản phẩm -->
                                            <?php $__currentLoopData = $product->colours; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $colour): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td><?php echo e($colour->id); ?></td>
                                                    <td><?php echo e($colour->name); ?></td>
                                                    <td><?php echo e($colour->quantity); ?></td>
                                                    <td><?php echo e(number_format($colour->price)); ?> VND</td>
                                                    <td>
                                                        <!-- Nút sửa -->
                                                        <a href="<?php echo e(route('colours.edit', $colour->id)); ?>"
                                                            class="btn btn-warning btn-sm">Sửa</a>
                                                        <!-- Nút xóa -->
                                                        <form action="<?php echo e(route('colours.destroy', $colour->id)); ?>"
                                                            method="POST" style="display:inline;">
                                                            <?php echo csrf_field(); ?>
                                                            <?php echo method_field('DELETE'); ?>
                                                            <button type="submit"
                                                                class="btn btn-danger btn-sm">Xóa</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table>
                                <?php else: ?>
                                    <p class="text-center">Chưa có màu sắc nào cho sản phẩm này.</p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\laragon\www\datn1\resources\views/admin/colours/index.blade.php ENDPATH**/ ?>