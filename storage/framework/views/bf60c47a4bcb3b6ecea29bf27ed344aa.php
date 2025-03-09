
<table style="margin-top: 20px" class="table">
    <thead>
        <tr>
            <th></th>
            <th>ID</th>
            <th>Tên sản phẩm</th>
            <th>Hình ảnh</th>
            <th>Biến thể</th>
            <th>Giá</th>
            <th>Số lượng</th>
            <th>Trạng thái</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody>
        <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td>
                    <button class="btn btn-link" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseColors<?php echo e($product->id); ?>" aria-expanded="false"
                        aria-controls="collapseColors<?php echo e($product->id); ?>">
                        <i class="bi bi-plus-circle"></i>
                    </button>
                </td>
                <td><?php echo e($product->id); ?></td>
                <td><?php echo e($product->name_sp); ?></td>
                <td>
                    <?php if($product->image): ?>
                        <img src="<?php echo e(asset('storage/' . $product->image)); ?>" alt="<?php echo e($product->name_sp); ?>"
                            width="50" height="50">
                    <?php else: ?>
                        No Image
                    <?php endif; ?>
                </td>
                <td>
                    <?php echo e($product->variant ? $product->variant->ram_smartphone : 'Không có'); ?><br>
                    <?php echo e($product->battery ? $product->battery->capacity : 'Không có'); ?><br>
                    <?php echo e($product->screen ? $product->screen->name : 'Không có'); ?>

                </td>
                <td><?php echo e(number_format($product->price, 0, ',', '.')); ?>₫</td>
                <td><?php echo e($product->stock); ?></td>
                <td>
                    <?php if($product->stock >= 5): ?>
                        <span style="color: green; font-weight: bold;">Còn hàng</span>
                    <?php elseif($product->stock > 0 && $product->stock < 5): ?>
                        <span style="color: orange; font-weight: bold;">Sắp hết hàng</span>
                    <?php else: ?>
                        <span style="color: red; font-weight: bold;">Hết hàng</span>
                    <?php endif; ?>
                </td>
                <td>
                    <div style="display: flex; gap: 5px;">
                        <a href="<?php echo e(route('products.edit', $product)); ?>" class="btn btn-warning" style="height: 40px;">Sửa</a>
                        <a href="<?php echo e(route('products.show', $product)); ?>" class="btn btn-primary" style="height: 40px;">Xem</a>
                        <form action="<?php echo e(route('products.toggle', $product)); ?>" method="POST"
                            style="display:inline;">
                            <?php echo csrf_field(); ?>
                            <button type="submit"
                                class="btn <?php echo e($product->is_active ? 'btn-danger' : 'btn-success'); ?>">
                                <?php echo e($product->is_active ? 'Ẩn' : 'Hiện'); ?>

                            </button>
                        </form>
                    </div>
                </td>

            </tr>
            <tr>
                <td colspan="9" class="p-0">
                    <div id="collapseColors<?php echo e($product->id); ?>" class="collapse">
                        <div class="card card-body">
                            <h5>Màu sắc có sẵn cho <?php echo e($product->name_sp); ?> <button style="float: right"
                                    class="btn btn-primary"><a
                                        href="<?php echo e(route('colours.index')); ?>">Thêm</a></button></h5>

                            <?php if($product->colours->isEmpty()): ?>
                                <p>Không có màu nào có sẵn cho sản phẩm này.</p>
                            <?php else: ?>
                                <!-- Table to display color details -->
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Tên màu sắc</th>
                                            <th>Giá</th>
                                            <th>Số lượng</th>
                                            <th>Hành động</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $product->colours; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $colour): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e($colour->id); ?></td>
                                                <td><?php echo e($colour->name); ?></td>
                                                <td><?php echo e($colour->price); ?></td>
                                                <td><?php echo e($colour->quantity); ?></td>
                                                <td>
                                                    <?php if($colour->quantity >= 5): ?>
                                                        <span style="color: green; font-weight: bold;">Còn
                                                            hàng</span>
                                                    <?php elseif($colour->quantity > 0 && $colour->quantity < 5): ?>
                                                        <span style="color: orange; font-weight: bold;">Sắp
                                                            hết hàng</span>
                                                    <?php else: ?>
                                                        <span style="color: red; font-weight: bold;">Hết
                                                            hàng</span>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            <?php endif; ?>
                        </div>
                    </div>
                </td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>
<script>
    document.getElementById('search-form').addEventListener('submit', function(event) {
        event.preventDefault();

        let keyword = document.getElementById('keyword').value;
        let url = "<?php echo e(route('products.index')); ?>";

        fetch(url + '?keyword=' + keyword, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest' 
                }
            })
            .then(response => response.json())
            .then(data => {
                document.getElementById('product-list').innerHTML = data.html; 
            })
            .catch(error => console.error('Error:', error));
    });
</script><?php /**PATH D:\LARAGON-PHP2\laragon\www\datn\resources\views/admin/products/partials/product_list.blade.php ENDPATH**/ ?>