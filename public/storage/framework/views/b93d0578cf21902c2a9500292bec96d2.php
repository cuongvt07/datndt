<?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<!-- Tất cả các sản phẩm -->
<div class="col-md-4 col-sm-6">
    <!-- Sản phẩm theo lưới -->
    <div class="product-item">
        <figure class="product-thumb">
            <a href="<?php echo e(route('product.show', $product->id)); ?>">
                <img class="pri-img" src="<?php echo e(asset('storage/' . $product->image)); ?>"
                    alt="product">
                <img class="sec-img" src="<?php echo e(asset('storage/' . $product->image)); ?>"
                    alt="product">
            </a>
            <div class="product-badge">
                <div class="product-label new">
                    <span>Mới</span>
                </div>
                <div class="product-label discount">
                    <span>10%</span>
                </div>
            </div>
            <div class="button-group">
                <a href="wishlist.html" data-bs-toggle="tooltip"
                    data-bs-placement="left" title="Add to wishlist"><i
                        class="pe-7s-like"></i></a>
                <a href="compare.html" data-bs-toggle="tooltip"
                    data-bs-placement="left" title="Add to Compare"><i
                        class="pe-7s-refresh-2"></i></a>
                <a href="#" data-bs-toggle="modal"
                    data-bs-target="#quick_view"><span data-bs-toggle="tooltip"
                        data-bs-placement="left" title="Quick View"><i
                            class="pe-7s-search"></i></span></a>
            </div>
            <div class="cart-hover"><a
                    href="<?php echo e(route('product.show', $product->id)); ?>">
                    <button class="btn btn-cart">Thêm giỏ hàng</button>
                </a>

            </div>
        </figure>
        <div class="product-caption text-center">
            <div class="product-identity">
                <p class="manufacturer-name"><a href="product-details.html">
                        <div class="product-category">
                            <!-- Hiển thị tên danh mục của sản phẩm -->
                            <span><?php echo e($product->category->name); ?></span>
                        </div>
            </div>
            
            <h6 class="product-name">
                <a href="product-details.html"><?php echo e($product->name_sp); ?></a>
            </h6>
            <div class="price-box">
                <span
                    class="price-regular"><?php echo e(number_format($product->price, 0, ',', '.')); ?>₫</span>
                
            </div>
        </div>
    </div>
    <!-- Sản phẩm theo lưới End -->

    <!-- Sản phẩm theo Danh sách -->
    <div class="product-list-item">
        <figure class="product-thumb">
            <a href="product-details.html">
                <img class="pri-img" src="<?php echo e(asset('storage/' . $product->image)); ?>"
                    alt="product">
                <img class="sec-img" src="<?php echo e(asset('storage/' . $product->image)); ?>"
                    alt="product">
            </a>
            <div class="product-badge">
                <div class="product-label new">
                    <span>Mới</span>
                </div>
                <div class="product-label discount">
                    <span>10%</span>
                </div>
            </div>
            <div class="button-group">
                <a href="wishlist.html" data-bs-toggle="tooltip"
                    data-bs-placement="left" title="Add to wishlist"><i
                        class="pe-7s-like"></i></a>
                <a href="compare.html" data-bs-toggle="tooltip"
                    data-bs-placement="left" title="Add to Compare"><i
                        class="pe-7s-refresh-2"></i></a>
                <a href="#" data-bs-toggle="modal"
                    data-bs-target="#quick_view"><span data-bs-toggle="tooltip"
                        data-bs-placement="left" title="Quick View"><i
                            class="pe-7s-search"></i></span></a>
            </div>
            <div class="cart-hover">
                <button class="btn btn-cart">Thêm giỏ hàng </button>
            </div>
        </figure>
        <div class="product-content-list">
            <div class="manufacturer-name">
                <div class="product-category">
                    <!-- Hiển thị tên danh mục của sản phẩm -->
                    <span><?php echo e($product->category->name); ?></span>
                </div>
            </div>
            <ul class="color-categories">
                <li>
                    <a class="c-lightblue" href="#" title="LightSteelblue"></a>
                </li>
                <li>
                    <a class="c-darktan" href="#" title="Darktan"></a>
                </li>
                <li>
                    <a class="c-grey" href="#" title="Grey"></a>
                </li>
                <li>
                    <a class="c-brown" href="#" title="Brown"></a>
                </li>
            </ul>

            <h5 class="product-name"><a
                    href="product-details.html"><?php echo e($product->name_sp); ?></a></h5>
            <div class="price-box">
                <span
                    class="price-regular"><?php echo e(number_format($product->price, 0, ',', '.')); ?>₫</span>
            </div>
            <p><?php echo e($product->description); ?></p>
        </div>
    </div>
    <!-- Sản phẩm theo danh sách End -->
</div>
<!-- Tất cả các sản phẩm -->
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php /**PATH C:\laragon\www\datn\resources\views/user/partials/product_list.blade.php ENDPATH**/ ?>