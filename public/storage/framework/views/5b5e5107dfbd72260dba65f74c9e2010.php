<?php echo $__env->make('layouts.user.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<?php echo $__env->make('layouts.user.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<main>
    <!-- Menu nhỏ start -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-wrap">
                        <nav aria-label="breadcrumb">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?php echo e(route('index')); ?>"><i class="fa fa-home"></i></a>
                                </li>
                                <li class="breadcrumb-item"><a href="shop.html">Cửa hàng</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Chi tiết sản phẩm</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Menu nhỏ end -->

    <!-- Trang chi tiết sản phẩm -->
    <div class="shop-main-wrapper section-padding pb-0">
        <div class="container">
            <div class="row">
                <!-- product details wrapper start -->
                <div class="col-lg-12 order-1 order-lg-2">
                    <!-- product details inner end -->
                    <div class="product-details-inner">
                        <div class="row">
                            <div class="col-lg-5">
                                <div class="product-large-slider">
                                    <div class="pro-large-img img-zoom img-long">
                                        <img id="mainImage" src="<?php echo e(asset('storage/' . $product->image)); ?>"
                                            alt="<?php echo e($product->name_sp); ?>" />
                                    </div>


                                </div>
                                <div class="pro-nav slick-row-10 slick-arrow-style">
                                    <?php if($product->productImages && $product->productImages->count() > 0): ?>
                                        <?php $__currentLoopData = $product->productImages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="pro-nav-thumb">
                                                <img src="<?php echo e(asset('storage/' . $image->image_path)); ?>"
                                                    alt="Variant Colour"
                                                    style="width: 150px; height: 150px; border: 1px solid #ccc;cursor: pointer;"
                                                    class="thumbnail-image"
                                                    onmouseenter="changeMainImage('<?php echo e(asset('storage/' . $image->image_path)); ?>')"
                                                    onclick="changeMainImage('<?php echo e(asset('storage/' . $image->image_path)); ?>')">
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php else: ?>
                                        <p>Không có hình ảnh nào.</p>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-lg-7">
                                <div class="product-details-des">
                                    <div class="manufacturer-name">
                                        <div class="product-category">
                                            <!-- Hiển thị tên danh mục của sản phẩm -->
                                            <span><?php echo e($product->category->name); ?></span>
                                        </div>
                                    </div>
                                    <h3 class="product-name"><?php echo e($product->name_sp); ?></h3>
                                    
                                    <div class="ratings d-flex align-items-center">
                                        <span class="rating-value"><?php echo e(number_format($averageRating, 1)); ?></span>
                                        <!-- Hiển thị rating trung bình -->

                                        <?php
                                            $fullStars = floor($averageRating);
                                            $halfStar = $averageRating - $fullStars >= 0.5 ? 1 : 0;
                                            $emptyStars = 5 - $fullStars - $halfStar;
                                        ?>

                                        <!-- Hiển thị sao đầy đủ -->
                                        <?php for($i = 0; $i < $fullStars; $i++): ?>
                                            <span><i class="fa fa-star star-icon"></i></span>
                                        <?php endfor; ?>

                                        <!-- Hiển thị nửa sao (nếu có) -->
                                        <?php if($halfStar): ?>
                                            <span><i class="fa fa-star-half-o star-icon"></i></span>
                                        <?php endif; ?>

                                        <!-- Hiển thị sao trống -->
                                        <?php for($i = 0; $i < $emptyStars; $i++): ?>
                                            <span><i class="fa fa-star-o star-icon"></i></span>
                                        <?php endfor; ?>

                                        <!-- Hiển thị thông tin đánh giá và số lượng bán -->
                                        <span class="review-info">
                                            | <?php echo e($product->totalReviews()); ?> Đánh Giá
                                            | <?php echo e($product->totalSold()); ?> Đã Bán
                                        </span>

                                    </div>
                                    <p class="pro-desc"><?php echo e($product->description); ?></p>
                                    <?php if($product->category->name == 'Điện thoại'): ?>
                                        <div class="mt-3">
                                            <strong>Dung lượng lưu trữ :</strong>
                                            <div class="d-flex flex-wrap">
                                                <?php $__currentLoopData = $variants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $variant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <div class="me-2">
                                                        <button class="btn2 btn-outline-primary variant-button"
                                                            data-price="<?php echo e($variant->price); ?>"
                                                            data-id="<?php echo e($variant->id); ?>">
                                                            <?php echo e($variant->ram_smartphone); ?>

                                                        </button>
                                                    </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <div class="mt-3" style="margin-bottom: 10px">
                                        <strong>Dung lượng pin:</strong>
                                        <div class="d-flex flex-wrap">
                                            <?php $__currentLoopData = $batterys; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $battery): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="me-2">
                                                    <button class="btn2 btn-outline-primary battery-button"
                                                        data-price="<?php echo e($battery->price); ?>"
                                                        data-id="<?php echo e($battery->id); ?>">
                                                        <?php echo e($battery->capacity); ?>

                                                    </button>
                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                    </div>
                                    
                                    <div class="color-option">
                                        <h6 class="option-title">Màu sắc:</h6>
                                        <!-- <ul class="color-categories">
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
                                        </ul> -->
                                        <?php if($product->productImages && $product->productImages->count() > 0): ?>
                                            <?php $__currentLoopData = $product->productImages->groupBy('colour_id'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $colour_id => $images): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php
                                                    $colour = \App\Models\Colour::find($colour_id);
                                                    $firstImage = $images->first();
                                                    // Get the stock quantity for the current colour
                                                    $stockQuantity = $product->getTotalColourQuantityById($colour_id);
                                                ?>

                                                <div class="me-2">
                                                    <button class="btn2 btn-outline-primary colour-button"
                                                        data-id="<?php echo e($colour_id); ?>"
                                                        data-stock="<?php echo e($stockQuantity); ?>"
                                                        data-price="<?php echo e($colour->price ?? 0); ?>"
                                                        onmouseenter="changeMainImage('<?php echo e(asset('storage/' . $firstImage->image_path)); ?>')"
                                                        onclick="selectColor('<?php echo e($colour->name ?? 'Unknown Colour'); ?>', '<?php echo e(asset('storage/' . $firstImage->image_path)); ?>', this)">
                                                        <?php echo e($colour->name ?? 'Unknown Colour'); ?>

                                                    </button>
                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php else: ?>
                                            <p>Không có màu nào.</p>
                                        <?php endif; ?>
                                    </div>
                                    
                                    <div class="quantity-cart-box d-flex align-items-center">
                                        <h6 class="option-title">Còn:</h6>
                                        <?php if($product->colours->count() > 0): ?>
                                            <span id="stockQuantity"
                                                style="color: red"><?php echo e($product->getTotalColourQuantityAttribute()); ?></span>
                                        <?php else: ?>
                                            <span id="stockQuantity">Hết hàng</span>
                                        <?php endif; ?>
                                    </div>
                                    <div class="price-box">Giá:
                                        <span class="price-regular"
                                            id="totalPrice"><?php echo e(number_format($product->price, 0, ',', '.')); ?>

                                            ₫</span>
                                    </div>
                                    <div class="quantity-cart-box d-flex align-items-center">
                                        <h6 class="option-title">Số lượng:</h6>
                                        <div class="quantity">
                                            <div class="diamond-container">
                                                <button id="decrease" class="btn btn-secondary">-</button>
                                                <input type="text" id="quantity" value="1" min="1"
                                                    max="<?php echo e($product->getTotalColourQuantityAttribute()); ?>"
                                                    style="width: 40px; text-align: center; border: none;">
                                                <button id="increase" class="btn btn-secondary">+</button>
                                            </div>
                                        </div>
                                        <div class="action_link">
                                            <a class="btn btn-cart2" id="addToCart" href="#">Thêm giỏ hàng</a>
                                        </div>
                                    </div>
                                    <div class="useful-links">
                                        <a href="#" data-bs-toggle="tooltip" title="Compare"><i
                                                class="pe-7s-refresh-2"></i>compare</a>
                                        <a href="#" data-bs-toggle="tooltip" title="Wishlist"><i
                                                class="pe-7s-like"></i>wishlist</a>
                                    </div>
                                    <div class="like-icon">
                                        <a class="facebook" href="#"><i class="fa fa-facebook"></i>like</a>
                                        <a class="twitter" href="#"><i class="fa fa-twitter"></i>tweet</a>
                                        <a class="pinterest" href="#"><i class="fa fa-pinterest"></i>save</a>
                                        <a class="google" href="#"><i class="fa fa-google-plus"></i>share</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- product details inner end -->

                    
                    <div class="product-details-reviews section-padding pb-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="product-review-info">
                                    <ul class="nav review-tab">
                                        <li>
                                            <a data-bs-toggle="tab" href="#tab_one">Miêu tả</a>
                                        </li>
                                        <li>
                                            <a data-bs-toggle="tab" href="#tab_two">Thông tin</a>
                                        </li>
                                        <li>
                                            <a class="active" data-bs-toggle="tab" href="#tab_three">Đánh giá
                                                (<?php echo e($totalReviews); ?>)</a>
                                        </li>
                                    </ul>
                                    
                                    <div class="tab-content reviews-tab">
                                        
                                        <div class="tab-pane fade show " id="tab_one">
                                            <div class="tab-one">
                                                <p><?php echo e($product->description); ?></p>
                                            </div>
                                        </div>
                                        
                                        <div class="tab-pane fade" id="tab_two">
                                            <table class="table table-bordered">
                                                <tbody>
                                                    <tr>
                                                        <td>color</td>
                                                        <td>black, blue, red</td>
                                                    </tr>
                                                    <tr>
                                                        <td>size</td>
                                                        <td>L, M, S</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        
                                        <div class="tab-pane fade active" id="tab_three">
                                            <a class="btn btn-sqr" data-bs-toggle="tab" href="#tab_three"
                                                id="show-review-form-btn">Đánh giá</a>

                                            <div id="review-form-container" style="display: none;">
                                                <form action="<?php echo e(route('reviews.store')); ?>" method="POST"
                                                    enctype="multipart/form-data" class="review-form">
                                                    <?php echo csrf_field(); ?>
                                                    <input type="hidden" name="product_id"
                                                        value="<?php echo e($product->id); ?>">

                                                    <!-- Phần chất lượng sản phẩm -->
                                                    <div class="form-group">
                                                        <label for="content">Chất lượng sản phẩm:</label>
                                                        <textarea name="content" id="content" rows="4" class="form-control"
                                                            placeholder="Chia sẻ cảm nhận của bạn về sản phẩm" required></textarea>
                                                    </div>

                                                    <!-- Phần upload ảnh và video -->
                                                    <div class="media-upload-container mb-3">
                                                        <div class="upload-icons">
                                                            <!-- Nhãn chọn hình ảnh -->
                                                            <label class="upload-icon" for="images">
                                                                <i class="fa fa-camera"></i> Thêm hình ảnh
                                                                <input type="file" name="images[]" id="images"
                                                                    accept="image/*" multiple style="display: none">

                                                            </label>
                                                            <!-- Nhãn chọn video -->
                                                            <label class="upload-icon" for="videos">
                                                                <i class="fa fa-video-camera"></i> Thêm video
                                                                <input type="file" name="videos[]" id="videos"
                                                                    accept="video/*" multiple style="display: none">
                                                            </label>

                                                        </div>

                                                        <!-- Preview ảnh/video -->
                                                        <div id="media-preview" class="preview-container"></div>
                                                    </div>

                                                    <!-- Phần đánh giá sao -->
                                                    <div class="form-group">
                                                        <label>Đánh giá chất lượng sản phẩm:</label><br>
                                                        <div class="star-rating">
                                                            <span class="star" data-value="1">&#9733;</span>
                                                            <span class="star" data-value="2">&#9733;</span>
                                                            <span class="star" data-value="3">&#9733;</span>
                                                            <span class="star" data-value="4">&#9733;</span>
                                                            <span class="star" data-value="5">&#9733;</span>
                                                        </div>
                                                        <div id="rating-description" class="mt-2"></div>
                                                    </div>

                                                    <input type="hidden" name="rating" id="rating"
                                                        value="1">

                                                    <button type="submit" class="btn btn-sqr" id="form-btn">Gửi
                                                        đánh giá</button>
                                                </form>

                                            </div>
                                            <!-- Hiển thị tất cả đánh giá -->
                                            <div class="reviews-list mt-4">
                                                <h5><strong>Đánh giá sản phẩm</strong></h5>
                                                <?php $__currentLoopData = $reviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <div class="review">
                                                        <div class="review-header">
                                                            <?php if($review->user->image): ?>
                                                                <img src="<?php echo e(asset($review->user->image)); ?>"
                                                                    alt="<?php echo e($review->user->name_user); ?>"
                                                                    class="review-avatar">
                                                            <?php else: ?>
                                                                <img src="<?php echo e(asset('asset-admin/img/profile.jpg')); ?>"
                                                                    alt="Avatar mặc định" class="review-avatar">
                                                            <?php endif; ?>

                                                            <strong><?php echo e($review->user->name_user); ?></strong>
                                                            
                                                            <div class="review-rating">
                                                                <?php for($i = 1; $i <= 5; $i++): ?>
                                                                    <i
                                                                        class="fa <?php echo e($i <= $review->rating ? 'fa-star' : 'fa-star-o'); ?>"></i>
                                                                <?php endfor; ?>
                                                            </div>
                                                            <span class="review-date">
                                                                <?php echo e(\Carbon\Carbon::parse($review->created_at)->format('Y-m-d H:i')); ?>

                                                            </span>
                                                            <br>
                                                            <span class="product-info">
                                                                
                                                                Phân loại hàng:
                                                                <?php echo e($review->product->category->name ?? 'Chưa phân loại'); ?>

                                                            </span>
                                                        </div>

                                                        <div class="review-content">
                                                            <!-- Nội dung đánh giá -->
                                                            <p><?php echo e($review->content); ?></p>

                                                            <!-- Kiểm tra và giải mã JSON từ trường images và videos -->
                                                            <?php
                                                                $images = is_string($review->images)
                                                                    ? json_decode($review->images, true)
                                                                    : [];
                                                                $videos = is_string($review->videos)
                                                                    ? json_decode($review->videos, true)
                                                                    : [];
                                                            ?>

                                                            <!-- Hiển thị tất cả ảnh nếu có -->
                                                            <?php if(!empty($images) && is_array($images)): ?>
                                                                <div class="review-images">
                                                                    <?php $__currentLoopData = $images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <img src="<?php echo e(asset('storage/' . $image)); ?>"
                                                                            alt="Review image" class="review-image"
                                                                            style="width: 100px; height: 100px; margin: 5px;">
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                </div>
                                                            <?php endif; ?>

                                                            <!-- Hiển thị tất cả video nếu có -->
                                                            <?php if(!empty($videos) && is_array($videos)): ?>
                                                                <div class="review-videos">
                                                                    <?php $__currentLoopData = $videos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $video): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <video class="review-video" controls
                                                                            style="width: 200px; height: 150px; margin: 5px;">
                                                                            <source
                                                                                src="<?php echo e(asset('storage/' . $video)); ?>"
                                                                                type="video/mp4">
                                                                            Trình duyệt của bạn không hỗ trợ video.
                                                                        </video>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                </div>
                                                            <?php endif; ?>
                                                        </div>

                                                        <hr>
                                                    </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Endd Cái dưới sản phẩm 1 -->
                </div>
                <!-- product details wrapper end -->
            </div>
        </div>
    </div>
    <!-- page main wrapper end -->

    <!-- Sản phẩm liên quan start -->
    <section class="related-products section-padding">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- section title start -->
                    <div class="section-title text-center">
                        <h2 class="title">Sản phẩm liên quan</h2>
                        <p class="sub-title">Thêm sản phẩm liên quan vào danh sách hàng tuần</p>
                    </div>
                    <!-- section title end -->
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="product-carousel-4 slick-row-10 slick-arrow-style">
                        <?php $__currentLoopData = $relatedProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $related): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <!-- product item start -->
                            <div class="product-item">
                                <figure class="product-thumb">
                                    <a href="<?php echo e(route('product.show', $related->id)); ?>">
                                        <img class="pri-img" src="<?php echo e(asset('storage/' . $related->image)); ?>"
                                            alt="product">
                                        <img class="sec-img" src="<?php echo e(asset('storage/' . $related->image)); ?>"
                                            alt="product">
                                    </a>
                                    <div class="product-badge">
                                        <div class="product-label new">
                                            <span>new</span>
                                        </div>
                                        <div class="product-label discount">
                                            <span>10%</span>
                                        </div>
                                    </div>
                                    <div class="button-group">
                                        <a href="wishlist.html" data-bs-toggle="tooltip" data-bs-placement="left"
                                            title="Add to wishlist"><i class="pe-7s-like"></i></a>
                                        <a href="compare.html" data-bs-toggle="tooltip" data-bs-placement="left"
                                            title="Add to Compare"><i class="pe-7s-refresh-2"></i></a>
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#quick_view"><span
                                                data-bs-toggle="tooltip" data-bs-placement="left"
                                                title="Quick View"><i class="pe-7s-search"></i></span></a>
                                    </div>
                                    <div class="cart-hover">
                                        <a href="<?php echo e(route('product.show', $related->id)); ?>">
                                            <button class="btn btn-cart">Thêm giỏ hàng</button>
                                        </a>
                                    </div>
                                </figure>
                                <div class="product-caption text-center">
                                    <div class="product-identity">
                                        <p class="manufacturer-name">
                                        <div class="product-category">
                                            <!-- Hiển thị tên danh mục của sản phẩm -->
                                            <span><?php echo e($related->category->name); ?></span>
                                        </div>
                                        </p>
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
                                    <h6 class="product-name">
                                        <a
                                            href="<?php echo e(route('product.show', $related->id)); ?>"><?php echo e($related->name_sp); ?></a>
                                    </h6>
                                    <div class="price-box">
                                        <span class="price-regular"><?php echo e(number_format($related->price, 0, ',', '.')); ?>

                                            ₫</span>
                                        
                                    </div>
                                </div>
                            </div>
                            <!-- product item end -->
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- related products area end -->
</main>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Thêm vào cuối <body> -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

<script>
    $(document).ready(function() {
        let qtyInput = $('#quantity');
        let basePrice = <?php echo e($product->price); ?>;
        let totalPriceElement = $('#totalPrice');
        let selectedVariantPrice = 0;
        let selectedBatteryPrice = 0;
        let selectedColourPrice = 0;
        let selectedColourId = null;
        let selectedVariantId = null;
        let selectedBatteryId = null;
        let maxQuantity = <?php echo e($product->getTotalColourQuantityAttribute()); ?>;

        // Kiểm tra nếu sản phẩm là Điện thoại
        let isPhoneCategory = '<?php echo e($product->category->name); ?>' === 'Điện thoại';

        // Nếu không phải là Điện thoại, ẩn hoặc disable nút chọn dung lượng RAM
        if (!isPhoneCategory) {
            $('.variant-button').hide(); // Ẩn tất cả các nút dung lượng RAM
        }

        // Sự kiện chọn biến thể (RAM) chỉ nếu là Điện thoại
        if (isPhoneCategory) {
            $('.variant-button').click(function() {
                selectedVariantPrice = parseFloat($(this).data('price')) || 0;
                selectedVariantId = $(this).data('id');
                $('.variant-button').removeClass('active');
                $(this).addClass('active');
                updatePrice();
            });
        }

        // Sự kiện chọn màu sắc
        $('.colour-button').click(function() {
            selectedColourPrice = parseFloat($(this).data('price')) || 0;
            selectedColourId = $(this).data('id');
            maxQuantity = $(this).data('stock');
            qtyInput.attr('max', maxQuantity);
            qtyInput.val(1);
            $('.colour-button').removeClass('active');
            $(this).addClass('active');
            updatePrice();
            $('#stockQuantity').text(maxQuantity > 0 ? maxQuantity : 'Hết hàng');
        });

        // Sự kiện chọn dung lượng pin
        $('.battery-button').click(function() {
            selectedBatteryPrice = parseFloat($(this).data('price')) || 0;
            selectedBatteryId = $(this).data('id');
            $('.battery-button').removeClass('active');
            $(this).addClass('active');
            updatePrice();
        });

        function updatePrice() {
            let totalPrice = basePrice + selectedVariantPrice + selectedBatteryPrice + selectedColourPrice;
            totalPriceElement.text(totalPrice.toLocaleString('vi-VN') + ' ₫');
        }

        $('#increase').click(function() {
            let currentQty = parseInt(qtyInput.val());
            if (currentQty < maxQuantity) {
                qtyInput.val(currentQty + 1);
            }
        });

        $('#decrease').click(function() {
            let currentQty = parseInt(qtyInput.val());
            if (currentQty > 1) {
                qtyInput.val(currentQty - 1);
            }
        });

        // Cấu hình Toastr
        toastr.options = {
            "closeButton": false,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "3000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };

        // Hàm hiển thị thông báo Toastr
        function showToastr(icon, message) {
            if (icon === 'success') {
                toastr.success(message);
            } else if (icon === 'error') {
                toastr.error(message);
            } else if (icon === 'warning') {
                toastr.warning(message);
            }
        }


        // Sự kiện thêm sản phẩm vào giỏ hàng
        $('#addToCart').click(function(e) {
            e.preventDefault();

            let productId = <?php echo e($product->id); ?>;
            let qty = qtyInput.val();

            // Kiểm tra nếu chưa đăng nhập
            if (!<?php echo e(Auth::check() ? 'true' : 'false'); ?>) {
                Swal.fire({
                    title: "Yêu cầu đăng nhập",
                    text: "Vui lòng đăng nhập để thêm sản phẩm vào giỏ hàng.",
                    icon: "warning",
                    confirmButtonText: "Đăng nhập"
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Chuyển hướng người dùng đến trang đăng nhập
                        window.location.href = '/login';
                    }
                });
                return;
            }

            // If the product has a variant, require variant selection
            <?php if($product->is_phone): ?>
                if (!selectedVariantId) {
                    showToastr('error', 'Vui lòng chọn dung lượng máy!');
                    return;
                }
            <?php endif; ?>

            if (!selectedBatteryId) {
                showToastr('error', 'Vui lòng chọn dung lượng pin!');
                return;
            }

            if (!selectedColourId) {
                showToastr('error', 'Vui lòng chọn màu sắc!');
                return;
            }

            // Gửi yêu cầu Ajax để thêm sản phẩm vào giỏ hàng
            $.ajax({
                url: '<?php echo e(route('cart.add')); ?>',
                method: 'POST',
                data: {
                    _token: '<?php echo e(csrf_token()); ?>',
                    product_id: productId,
                    quantity: qty,
                    battery_id: selectedBatteryId,
                    variant_id: selectedVariantId || null, // If not a phone, variant_id is null
                    color_id: selectedColourId
                },
                success: function(response) {
                    showToastr('success', 'Sản phẩm đã được thêm vào giỏ hàng thành công!');
                    setTimeout(function() {
                        window.location.href = '<?php echo e(route('cart.show')); ?>';
                    }, 1000);
                },
                error: function(xhr) {
                    showToastr('error', 'Đã xảy ra lỗi khi thêm vào giỏ hàng: ' + xhr
                        .responseText);
                }
            });
        });

    });

    function changeMainImage(imageSrc) {
        document.getElementById('mainImage').src = imageSrc;
    }

    function selectColor(colourName, imageSrc, button) {
        $('.colour-button').removeClass('active');
        $(button).addClass('active');
        changeMainImage(imageSrc);

        const stockQuantity = $(button).data('stock');
        $('#stockQuantity').text(stockQuantity > 0 ? stockQuantity : 'Hết hàng');
        $('#quantity').attr('max', stockQuantity); // Update max for quantity input
        $('#quantity').val(1); // Reset quantity to 1 when color changes
    }
</script>
<script>
    // danh gia
    document.getElementById('form-btn').addEventListener('click', function(event) {
        // Kiểm tra xem người dùng đã đăng nhập chưa
        if (!<?php echo e(Auth::check() ? 'true' : 'false'); ?>) {
            Swal.fire({
                title: "Yêu cầu đăng nhập",
                text: "Vui lòng đăng nhập để đánh giá sản phẩm.",
                icon: "warning",
                confirmButtonText: "Đăng nhập"
            }).then((result) => {
                if (result.isConfirmed) {
                    // Chuyển hướng người dùng đến trang đăng nhập
                    window.location.href = '/login';
                }
            });
            event.preventDefault(); // Ngừng hành động mặc định của nút khi chưa đăng nhập
        } else {
            // Nếu đã đăng nhập, tiếp tục hiển thị form đánh giá
            document.getElementById('review-form-container').style.display = 'block';
        }
    });

    document.addEventListener('DOMContentLoaded', function() {
        // Lấy các phần tử cần thiết
        const showReviewFormBtn = document.getElementById('show-review-form-btn');
        const reviewFormContainer = document.getElementById('review-form-container');
        showReviewFormBtn.addEventListener('click', function(e) {
            e.preventDefault();

            // Kiểm tra xem form đã được hiển thị chưa
            if (reviewFormContainer.style.display === 'none' || reviewFormContainer.style.display ===
                '') {
                reviewFormContainer.style.display = 'block';
                showReviewFormBtn.textContent = 'Ẩn form đánh giá';
            } else {
                reviewFormContainer.style.display = 'none';
                showReviewFormBtn.textContent = 'Đánh giá';
            }
        });
    });

    $(document).ready(function() {
        // Hàm hiển thị thông điệp khi chọn sao
        function updateRatingDescription(rating) {
            var description = '';
            switch (rating) {
                case 1:
                    description = 'Tệ';
                    break;
                case 2:
                    description = 'Không hài lòng';
                    break;
                case 3:
                    description = 'Bình thường';
                    break;
                case 4:
                    description = 'Hài lòng';
                    break;
                case 5:
                    description = 'Tuyệt vời';
                    break;
                default:
                    description = '';
            }
            $('#rating-description').text('Chất lượng sản phẩm: ' + description);
        }

        // Khi người dùng chọn sao
        $('.star').on('click', function() {
            var ratingValue = $(this).data('value');
            $('.star').removeClass('selected'); // Xóa tất cả các sao đã chọn
            $(this).prevAll().addClass('selected'); // Làm sáng các sao từ sao hiện tại và sao trước đó
            $(this).addClass('selected'); // Làm sáng sao hiện tại
            updateRatingDescription(ratingValue); // Cập nhật thông điệp

            // Lưu giá trị vào trường ẩn (nếu cần thiết)
            $('#rating').val(ratingValue);
        });
    });

    // icon máy ảnh 
    const imageInput = document.getElementById('images');
    const videoInput = document.getElementById('videos');
    const previewContainer = document.getElementById('media-preview');

    // Mảng lưu trữ tên tệp đã được hiển thị để tránh trùng lặp
    let displayedFiles = [];

    // Hàm xử lý xem trước tệp ảnh/video
    function handleFilePreview(input, isImage) {
        Array.from(input.files).forEach((file) => {
            // Kiểm tra nếu tệp đã được hiển thị trước đó
            if (displayedFiles.includes(file.name)) return;

            // Thêm tên tệp vào mảng để kiểm tra các tệp đã hiển thị
            displayedFiles.push(file.name);

            const fileURL = URL.createObjectURL(file);

            // Tạo thẻ chứa ảnh/video và nút xóa
            const mediaItem = document.createElement('div');
            mediaItem.classList.add('media-item');
            mediaItem.dataset.fileName = file.name; // Lưu tên tệp để kiểm tra trùng lặp

            // Kiểm tra loại file để hiển thị đúng định dạng
            if (isImage) {
                const img = document.createElement('img');
                img.src = fileURL;
                img.alt = 'Preview image';
                mediaItem.appendChild(img);
            } else {
                const video = document.createElement('video');
                video.src = fileURL;
                video.controls = true;
                mediaItem.appendChild(video);
            }

            // Tạo nút xóa cho từng ảnh/video
            const deleteButton = document.createElement('button');
            deleteButton.innerText = 'X';
            deleteButton.classList.add('delete-button');
            deleteButton.onclick = () => {
                // Loại bỏ tệp khỏi danh sách đã hiển thị
                displayedFiles = displayedFiles.filter(f => f !== file.name);
                previewContainer.removeChild(mediaItem);
                URL.revokeObjectURL(fileURL); // Giải phóng bộ nhớ
            };

            mediaItem.appendChild(deleteButton);
            previewContainer.appendChild(mediaItem);
        });
    }

    // Lắng nghe sự kiện thay đổi (change) cho ảnh
    imageInput.addEventListener('change', () => {
        if (imageInput.files.length > 0) {
            handleFilePreview(imageInput, true); // true nghĩa là xử lý ảnh
        }
    });

    // Lắng nghe sự kiện thay đổi (change) cho video
    videoInput.addEventListener('change', () => {
        if (videoInput.files.length > 0) {
            handleFilePreview(videoInput, false); // false nghĩa là xử lý video
        }
    });
</script>

<?php echo $__env->make('layouts.user.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!-- CSS -->
<style>
    .review-date,
    .product-info {
        font-size: 0.8rem;
        /* Đặt kích thước font nhỏ */
        color: #6c757d;
        /* Màu xám nhạt */
        font-weight: normal;
        /* Font chữ mảnh */
    }

    .review-date {
        margin-top: 5px;
        /* Khoảng cách trên */
    }

    .product-info {
        margin-top: 5px;
        /* Khoảng cách trên */
    }

    /* Hiển thị ảnh và video cùng một hàng */
    .review-images,
    .review-videos {
        display: flex;
        gap: 10px;
        /* Khoảng cách giữa các ảnh/video */
        justify-content: flex-start;
        /* Căn các phần tử vào đầu dòng */
        flex-wrap: nowrap;
        /* Ngăn ảnh/video xuống dòng */
        overflow-x: auto;
        /* Cho phép cuộn ngang nếu cần */
    }

    .review-image,
    .review-video {
        max-width: 150px;
        /* Chiều rộng tối đa của ảnh/video */
        height: auto;
        /* Giữ tỷ lệ ảnh/video */
        object-fit: cover;
        /* Đảm bảo không bị méo hình */
        border-radius: 5px;
        /* Bo góc */
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        /* Thêm bóng đổ */
        transition: transform 0.3s ease;
        /* Hiệu ứng hover */
    }

    .review-image:hover,
    .review-video:hover {
        transform: scale(1.05);
        /* Phóng to khi hover */
    }

    /*  */
    .review-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        object-fit: cover;
        margin-right: 10px;
    }

    /* Chỉnh sửa phần review-form */
    .review-form {
        background-color: #f9f9f9;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        margin-bottom: 30px;
    }

    .review-form .form-group {
        margin-bottom: 15px;
    }

    .review-form label {
        font-weight: bold;
    }

    .review-form textarea {
        height: 120px;
    }

    .star-rating {
        font-size: 20px;
        color: #ff9800;
        cursor: pointer;
    }

    .star-rating .star {
        margin-right: 5px;
    }

    .star-rating .star:hover,
    .star-rating .star.active {
        color: #f39c12;
    }

    /* Chỉnh sửa phần reviews-list */
    .reviews-list h5 {
        font-size: 18px;
        font-weight: bold;
        color: #333;
        margin-bottom: 20px;
    }

    .review {
        background-color: #fff;
        padding: 15px;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        margin-bottom: 20px;
    }

    .review-header {
        font-size: 16px;
        font-weight: bold;
        color: #333;
    }

    .review-email {
        font-size: 14px;
        color: #777;
    }

    .review-rating i {
        margin-right: 3px;
        color: #ff9800;
    }

    .review-content {
        font-size: 14px;
        color: #555;
        margin-top: 10px;
    }

    .review-content p {
        margin: 0;
    }

    hr {
        border: 1px solid #ddd;
        margin-top: 15px;
        margin-bottom: 0;
    }


    /*  */
    .star-rating {
        display: inline-block;
        font-size: 30px;
        cursor: pointer;
    }

    .star {
        color: #ccc;
        cursor: pointer;
    }

    .star.selected {
        color: #ffd700;
        /* Màu vàng khi sao được chọn */
    }

    .star:hover {
        color: #ffd700;
    }

    #rating-description {
        margin-top: 10px;
        font-weight: bold;
    }
</style>

<style>
    /* Căn chỉnh bố cục cho đánh giá */
    .ratings {
        font-size: 1rem;
        color: #ff9900;
    }

    .rating-value {
        font-weight: bold;
        margin-right: 5px;
        color: #ff5722;
        /* Màu số rating */
    }

    .star-icon {
        color: #ff9900;
        /* Màu sao vàng */
        margin-left: 2px;
    }

    .review-info {
        font-size: 0.9rem;
        color: #555;
        margin-left: 10px;
    }

    .review-box {
        background-color: #f9f9f9;
        padding: 10px;
        margin-bottom: 10px;
        border-radius: 5px;
    }

    .ratings .good i {
        color: #f5a623;
    }

    #mainImage {
        width: 600px;
        height: 500px;
    }

    .diamond-container {
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: #f8f9fa;
        border: 2px solid #ccc;
        border-radius: 15px;
        padding: 5px;
        position: relative;
        width: 100px;
        height: 40px;
        margin: 0 auto;
        overflow: hidden;
    }

    .diamond-container:before,
    .diamond-container:after {
        content: '';
        position: absolute;
        border-left: 15px solid transparent;
        border-right: 15px solid transparent;
        z-index: -1;
    }

    .diamond-container:before {
        bottom: 100%;
        border-bottom: 15px solid #f8f9fa;
        left: 50%;
        transform: translateX(-50%);
    }

    .diamond-container:after {
        top: 100%;
        border-top: 15px solid #f8f9fa;
        left: 50%;
        transform: translateX(-50%);
    }

    .diamond-container button {
        padding: 5px;
        /* Padding for buttons */
        border-radius: 0;
        /* No rounding on buttons */
        height: 30px;
        /* Match button height to container */
    }

    .diamond-container input {
        height: 30px;
        /* Match input height to container */
    }

    /* Css cho form đánh giá  */
    .media-upload-container {
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 15px;
        background-color: #f9f9f9;
    }

    .upload-icons {
        display: flex;
        gap: 20px;
        margin-bottom: 10px;
    }

    .upload-icon {
        cursor: pointer;
        display: flex;
        align-items: center;
        font-size: 14px;
        color: #555;
        border: 1px solid #ccc;
        padding: 8px 12px;
        border-radius: 5px;
        transition: background-color 0.3s;
        text-decoration: none;
    }

    .upload-icon:hover {
        background-color: #e0e0e0;
    }

    .upload-icon i {
        margin-right: 5px;
        font-size: 18px;
    }

    .preview-container {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-top: 10px;
    }

    .media-item {
        position: relative;
        width: 80px;
        height: 80px;
        border-radius: 5px;
        overflow: hidden;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .media-item img,
    .media-item video {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .delete-button {
        position: absolute;
        top: 5px;
        right: 5px;
        background: rgba(0, 0, 0, 0.6);
        color: #fff;
        border: none;
        cursor: pointer;
        padding: 3px 6px;
        font-size: 12px;
        border-radius: 50%;
    }
</style>
<?php /**PATH C:\laragon\www\datn\resources\views/user/shop-single.blade.php ENDPATH**/ ?>