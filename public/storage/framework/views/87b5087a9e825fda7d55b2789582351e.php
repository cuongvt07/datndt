<!DOCTYPE html>
<html>
<head>
    <title>Mã giảm giá cho bạn</title>
</head>
<body>
    <h1>Chào <?php echo e($user->name_user); ?>,</h1>
    <p>Bạn đã nhận được mã giảm giá từ cửa hàng của chúng tôi!</p>
    <p><strong>Mã giảm giá: <?php echo e($discountCode->code); ?></strong></p>

    <?php if($discountCode->amount): ?>
        <p>Giảm theo số tiền: <?php echo e(number_format($discountCode->amount, 0, ',', '.')); ?> VNĐ</p>
    <?php else: ?>
        <p>Giảm theo phần trăm: <?php echo e(number_format($discountCode->percentage, 0)); ?>%</p>
    <?php endif; ?>

    <p>Ngày bắt đầu: <?php echo e($discountCode->start_date); ?></p>
    <p>Ngày kết thúc: <?php echo e($discountCode->end_date); ?></p>

    
    <p>Lượt sử dụng: <?php echo e($usageLimit); ?></p> 

    
    <?php if($discountCode->products->count() > 0): ?>
        <p>Mã giảm giá này chỉ áp dụng cho các sản phẩm sau:</p>
        <ul>
            <?php $__currentLoopData = $discountCode->products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($product->name_sp); ?></li> 
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    <?php else: ?>
        <p>Mã giảm giá này áp dụng cho tất cả sản phẩm trên website của chúng tôi!</p>
    <?php endif; ?>
    
    <p>Sử dụng ngay để nhận ưu đãi tốt nhất!</p>
    <p>Xin cảm ơn!</p>
</body>
</html>
<?php /**PATH C:\laragon\www\datn\resources\views/emails/discount_code.blade.php ENDPATH**/ ?>