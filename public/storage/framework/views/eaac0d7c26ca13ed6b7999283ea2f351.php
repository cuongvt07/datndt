<?php echo $__env->make('layouts.user.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<?php echo $__env->make('layouts.user.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<main>
    <!-- breadcrumb area start -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-wrap">
                        <nav aria-label="breadcrumb">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?php echo e(route('index')); ?>"><i class="fa fa-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="<?php echo e(route('shop')); ?>">Cửa hàng</a></li>
                                <li class="breadcrumb-item" aria-current="page"><a href="<?php echo e(route('cart.show')); ?>">Đơn
                                        hàng</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Đặt hàng</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb area end -->
    <div class="container mt-5">
        <div class="text-center mb-4">
            <h2 class="text-success">Đặt hàng thành công</h2>
            <p>Cảm ơn bạn đã đặt hàng. Mã đơn hàng của bạn là: <strong><?php echo e($order->id); ?></strong></p>
        </div>

        <div class="order-details">
            <h4>Thông tin giao hàng</h4>
            <br>
            <ul class="list-group mb-4">
                <li class="list-group-item"><strong>Tỉnh/Thành:</strong> <?php echo e($order->province); ?></li>
                <li class="list-group-item"><strong>Quận/Huyện:</strong> <?php echo e($order->district); ?></li>
                <li class="list-group-item"><strong>Xã/Phường:</strong> <?php echo e($order->ward); ?></li>
                <li class="list-group-item"><strong>Địa chỉ chi tiết:</strong> <?php echo e($order->detail_address); ?></li>
            </ul>
        </div>

        <h4>Chi tiết đơn hàng</h4>

        <table class="table table-hover table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Hình ảnh</th>
                    <th scope="col">Tên sản phẩm</th>
                    <th scope="col">Màu</th>
                    <th scope="col">Pin</th>
                    <th scope="col">RAM</th>
                    <th scope="col">Số lượng</th>
                    <th scope="col">Tổng giá</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $orderItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td>
                            <img src="<?php echo e(asset('storage/' . $item->product->productImages->where('colour_id', $item->color_id)->first()->image_path)); ?>"
                                alt="<?php echo e($item->product->name_sp); ?>" width="80" class="img-fluid img-thumbnail">
                        </td>
                        <td><?php echo e($item->product->name_sp); ?></td>
                        <td><?php echo e($item->color ? $item->color->name : 'Không có màu'); ?></td>
                        <td><?php echo e($item->battery ? $item->battery->capacity : 'Không có'); ?></td>
                        <td><?php echo e($item->variant ? $item->variant->ram_smartphone : 'Không có'); ?></td>
                        <td><?php echo e($item->quantity); ?></td>
                        <td><?php echo e(number_format(($item->product->price + ($item->variant->price ?? 0) + $item->battery->price + ($item->color->price ?? 0)) * $item->quantity, 0, ',', '.')); ?>

                            VND</td>
                        
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td colspan="6" class="text-end"><strong>Phí vận chuyển:</strong></td>
                    <td><strong style="font-size: 16px"> <?php echo e(number_format($shippingFee, 0, ',', '.')); ?> ₫</strong></td>
                </tr>
                <tr>
                    <td colspan="6" class="text-end"><strong>Tổng tiền của tất cả sản phẩm:</strong></td>
                    <td><strong style="font-size: 18px; color: #d9534f;"><?php echo e(number_format($grandTotal, 0, ',', '.')); ?> ₫</strong> <br>
                        <s style="font-size: 10px"><?php echo e(number_format($totalPrice, 0, ',', '.')); ?> ₫</s>
                    </td>

                </tr>
            </tbody>
        </table>
        <div class="mt-4 d-flex justify-content-center gap-3">
            <a href="<?php echo e(route('shop')); ?>" class="btn btn-sqr" style="margin-bottom: 10px">Tiếp tục mua hàng</a>
        </div>
    </div>
</main>



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Thêm vào cuối <body> -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php echo $__env->make('layouts.user.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH E:\laragon\www\datn\resources\views/checkout/success.blade.php ENDPATH**/ ?>