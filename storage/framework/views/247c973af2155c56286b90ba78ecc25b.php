<?php echo $__env->make('layouts.user.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<?php echo $__env->make('layouts.user.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<main>
    <!-- Menu nhỏ -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-wrap">
                        <nav aria-label="breadcrumb">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?php echo e(route('index')); ?>"><i class="fa fa-home"></i></a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Cửa hàng</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!--  end -->

    <!-- Lọc danh mục -->
    
    <div class="shop-main-wrapper section-padding">
        <div class="container">
            <div class="row">
                <!-- Bên trái -->
                <div class="col-lg-3 order-2 order-lg-1">
                    <aside class="sidebar-wrapper">
                        <!-- single sidebar start -->
                        <div class="sidebar-single">
                            <h5 class="sidebar-title">Loại sản phẩm</h5>
                            <div class="sidebar-body">
                                <ul class="shop-categories">
                                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php
                                            $minPrice = request()->input('minPrice');
                                            $maxPrice = request()->input('maxPrice');
                                            $query = request()->all();

                                            $query['category'] = $category->id;

                                            if (request()->input('keyword')) {
                                                $query['keyword'] = request()->input('keyword');
                                            } else {
                                                unset($query['keyword']);
                                            }

                                            if ($minPrice && $maxPrice) {
                                                $query['minPrice'] = request()->input('minPrice');
                                                $query['maxPrice'] = request()->input('maxPrice');
                                            }
                                            $url = '/shop?' . http_build_query($query);

                                        ?>

                                        <li><a href="<?php echo e($url); ?>">
                                                <?php echo e($category->name); ?>

                                                <span>(<?php echo e(count($category->products)); ?>)</span>
                                            </a></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>



                                </ul>
                            </div>
                        </div>
                        <div class="sidebar-single">
                            <h5 class="sidebar-title">Danh mục</h5>
                            <div class="sidebar-body">
                                <ul class="shop-categories">

                                    <?php $__currentLoopData = $suppliers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $supplier): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php
                                            $minPrice = request()->input('minPrice');
                                            $maxPrice = request()->input('maxPrice');
                                            $query = request()->all();

                                            $query['supplier'] = $supplier->id;

                                            if (request()->input('keyword')) {
                                                $query['keyword'] = request()->input('keyword');
                                            } else {
                                                unset($query['keyword']);
                                            }

                                            if ($minPrice && $maxPrice) {
                                                $query['minPrice'] = request()->input('minPrice');
                                                $query['maxPrice'] = request()->input('maxPrice');
                                            }
                                            $url = '/shop?' . http_build_query($query);

                                        ?>

                                        <li><a href="<?php echo e($url); ?>">
                                                <?php echo e($supplier->brand); ?>

                                                <span>(<?php echo e(count($supplier->products)); ?>)</span>
                                            </a></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                                </ul>
                            </div>
                        </div>
                        <!-- single sidebar end -->

                        <!-- Giá tiền -->
                        <div class="sidebar-single">
                            <h5 class="sidebar-title">Giá</h5>
                            <div class="sidebar-body">
                                <div class="price-range-wrap">
                                    <div class="price-range" data-min="1" data-max="100">
                                    </div>
                                    <div class="range-slider">
                                        <form action="<?php echo e(route('shop')); ?>"
                                            class="form-priced-flex align-items-center justify-content-between">
                                            <div class="price-input mb-4">
                                                <label for="amount">Price: </label>
                                                <input type="text" style="width:210px;max-width: 100%;"
                                                    id="amount">
                                                <input type="hidden"
                                                    value="<?php echo e(request()->input('minPrice') ? request()->input('minPrice') : '1000000'); ?>"
                                                    name="minPrice" id="minPrice">
                                                <input type="hidden" name="maxPrice"
                                                    value="<?php echo e(request()->input('maxPrice') ? request()->input('maxPrice') : '100000000'); ?>"
                                                    id="maxPrice">
                                                <?php if(request()->input('category')): ?>
                                                    <input type="hidden" value="<?php echo e(request()->input('category')); ?>"
                                                        name="category">
                                                <?php endif; ?>
                                                <?php if(request()->input('supplier')): ?>
                                                    <input type="hidden" value="<?php echo e(request()->input('supplier')); ?>"
                                                        name="supplier">
                                                <?php endif; ?>


                                                <?php if(request()->input('keyword')): ?>
                                                    <input type="hidden" value="<?php echo e(request()->input('keyword')); ?>"
                                                        name="keyword">
                                                <?php endif; ?>
                                            </div>
                                            <button class="filter-btn">Lọc</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    

                        <!-- Ảnh dưới phần lọc -->
                        <!-- <div class="sidebar-banner">
                            <div class="img-container">
                                <a href="#">
                                    <img src="<?php echo e(asset('asset-user/img/banner/lisa.jpg')); ?>" alt="">
                                </a>
                            </div>
                        </div> -->
                        <!-- -->
                    </aside>
                </div>
                <!-- Trái endd -->

                <!-- shop main wrapper start -->
                <div class="col-lg-9 order-1 order-lg-2">
                    <div class="shop-product-wrapper">
                        <!-- Lọc ở trên sản phẩm -->
                        <div class="shop-top-bar">
                            <div class="row align-items-center">
                                <div class="col-lg-7 col-md-6 order-2 order-md-1">
                                    <div class="top-bar-left">
                                        <div class="product-view-mode">
                                            <a class="active" href="#" data-target="grid-view"
                                                data-bs-toggle="tooltip" title="Grid View"><i class="fa fa-th"></i></a>
                                            <a href="#" data-target="list-view" data-bs-toggle="tooltip"
                                                title="List View"><i class="fa fa-list"></i></a>
                                        </div>
                                        <div class="product-amount">
                                            <?php if(request()->input('keyword')): ?>
                                                <p>Tìm kiếm với từ khoá:
                                                    <strong><?php echo e(request()->input('keyword')); ?></strong>
                                            <?php endif; ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <!-- Lọc ở trên sản phẩm -->

                        <!--  bao bọc danh sách mặt hàng sản phẩm start -->
                        <div class="shop-product-wrap grid-view row mbn-30">
                            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <!-- Tất cả các sản phẩm -->
                                <div class="col-md-4 col-sm-6" style="justify-items: center;">
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
                                                <a href="javascript:void(0);" data-bs-toggle="tooltip"
                                                    title="Wishlist" class="add-to-wishlist"
                                                    data-product-id="<?php echo e($product->id); ?>">
                                                    <i class="pe-7s-like"></i></a>

                                            </div>
                                            <div class="cart-hover"><a
                                                    href="<?php echo e(route('product.show', $product->id)); ?>">
                                                    <button class="btn btn-cart">Thêm giỏ hàng</button>
                                                </a>

                                            </div>
                                        </figure>
                                        <div class="product-caption text-center">
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

                        </div>
                        <!--  bao bọc danh sách mặt hàng sản phẩm end -->

                        <!-- start Phân trang -->
                        <!-- Phân trang -->
                        <div class="paginatoin-area text-center">
                            <ul class="pagination-box">
                                <!-- Hiển thị nút "Trang trước" -->
                                <?php if($products->onFirstPage()): ?>
                                    <li class="disabled"><a href="javascript:void(0);"><i
                                                class="pe-7s-angle-left"></i></a></li>
                                <?php else: ?>
                                    <li><a class="previous" href="<?php echo e($products->previousPageUrl()); ?>"><i
                                                class="pe-7s-angle-left"></i></a></li>
                                <?php endif; ?>

                                <!-- Hiển thị các số trang -->
                                <?php $__currentLoopData = $products->getUrlRange(1, $products->lastPage()); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page => $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li class="<?php echo e($page == $products->currentPage() ? 'active' : ''); ?>">
                                        <a href="<?php echo e($url); ?>"><?php echo e($page); ?></a>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                <!-- Hiển thị nút "Trang sau" -->
                                <?php if($products->hasMorePages()): ?>
                                    <li><a class="next" href="<?php echo e($products->nextPageUrl()); ?>"><i
                                                class="pe-7s-angle-right"></i></a></li>
                                <?php else: ?>
                                    <li class="disabled"><a href="javascript:void(0);"><i
                                                class="pe-7s-angle-right"></i></a></li>
                                <?php endif; ?>
                            </ul>
                        </div>
                        <!-- End Phân trang -->

                        <!-- end Phân trang -->
                    </div>
                </div>
                <!-- shop main wrapper end -->
            </div>
        </div>
    </div>
    <!-- page main wrapper end -->
</main>

<script>
    // yêu thích sp
    document.addEventListener("DOMContentLoaded", function() {
        const wishlistButtons = document.querySelectorAll(".add-to-wishlist");

        // Cấu hình Toastr
        toastr.options = {
            "closeButton": false,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300", // Thời gian hiện thông báo
            "hideDuration": "1000", // Thời gian tắt thông báo
            "timeOut": "2000", // Thời gian tự động đóng (5 giây)
            "extendedTimeOut": "1000", // Thời gian kéo dài khi hover
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };

        wishlistButtons.forEach(button => {
            button.addEventListener("click", function() {
                const productId = this.getAttribute("data-product-id");

                fetch('/wishlist/add', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector(
                                'meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({
                            product_id: productId
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Thông báo thành công sử dụng Toastr
                            toastr.success(
                                "Sản phẩm đã được thêm vào danh sách yêu thích!");
                        } else {
                            // Thông báo lỗi sử dụng Toastr
                            toastr.error(data.message || "Đã có lỗi xảy ra!");
                        }
                    })
                    .catch(error => {
                        console.error("Error:", error);
                        toastr.error("Đã xảy ra lỗi trong quá trình xử lý yêu cầu!");
                    });
            });
        });
    });

    // 
    var minPricePHP = <?php echo json_encode($minPrice, 15, 512) ?>,
        maxPricePHP = <?php echo json_encode($maxPrice, 15, 512) ?>;

    const formColor = document.querySelector(".form-color")
    const checkBoxElArr = document.querySelectorAll('.form-color input[type="checkbox"]')
    checkBoxElArr.forEach(checkBoxEl => {
        checkBoxEl.addEventListener('change', function() {
            formColor.submit();
        });
    });
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Thêm vào cuối <body> -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>




<?php echo $__env->make('layouts.user.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH D:\ProjectDT\datn\datn\resources\views/user/shop.blade.php ENDPATH**/ ?>