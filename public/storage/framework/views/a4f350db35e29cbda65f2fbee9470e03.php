<!-- Start Header Area -->
<!-- <link rel="stylesheet" href="<?php echo e(asset('asset-admin/css/kaiadmin.min.css')); ?>" /> -->

<header class="header-area header-wide">
    <!-- header middle area start -->
    <div class="header-main-area sticky">
        <div class="container">
            <div class="row align-items-center position-relative">

                <!-- start logo area -->
                <div class="col-lg-2">
                    <div class="logo">
                        <a href="<?php echo e(route('index')); ?>" style="text-decoration: none;">
                            <h1 class="logo-text">PolyTech</h1>
                        </a>
                    </div>
                </div>


                <!-- start logo area -->

                <!-- main menu area start -->
                <div class="col-lg-6 position-static">
                    <div class="main-menu-area">
                        <div class="main-menu">
                            <!-- main menu navbar start -->
                            <nav class="desktop-menu">
                                <ul>
                                    <li><a href="<?php echo e(route('index')); ?>">Trang chủ</a>
                                    </li>
                                    <li><a href="<?php echo e(route('shop')); ?>">Sản phẩm</a>
                                    </li>
                                    <li><a href="<?php echo e(route('post')); ?>">Bài viết</a></li>
                                    <li><a href="<?php echo e(route('contact')); ?>">Liên hệ</a></li>
                                </ul>
                            </nav>
                            <!-- main menu navbar end -->
                        </div>
                    </div>
                </div>
                <!-- main menu area end -->

                <!-- mini cart area start -->
                <div class="col-lg-4">
                    <div
                        class="header-right d-flex align-items-center justify-content-xl-between justify-content-lg-end">
                        <div class="header-search-container">
                            <form class="header-search-box d-lg-none d-xl-block" action="<?php echo e(route('shop')); ?>">
                                <input type="search" id="search-keyword" value="<?php echo e(request()->input('keyword')); ?>"
                                    name="keyword" placeholder="Tìm kiếm trong cửa hàng" class="header-search-field">
                                <?php if(request()->input('category')): ?>
                                    <input type="hidden" value="<?php echo e(request()->input('category')); ?>" name="category">
                                <?php endif; ?>
                                <?php if(request()->input('minPrice')): ?>
                                    <input type="hidden" name="minPrice" value="<?php echo e(request()->input('minPrice')); ?>">
                                <?php endif; ?>

                                <?php if(request()->input('maxPrice')): ?>
                                    <input type="hidden" name="maxPrice" value="<?php echo e(request()->input('maxPrice')); ?>">
                                <?php endif; ?>


                                <button class="header-search-btn"><i class="pe-7s-search"></i></button>
                            </form>
                        </div>
                        <div class="header-configure-area">
                            <ul class="nav justify-content-end">
                                <li class="user-hover">
                                    <a href="#">
                                        <i class="pe-7s-user"></i>
                                    </a>
                                    <?php if(auth()->guard()->check()): ?>
                                        <!-- Hiển thị tên người dùng khi đã đăng nhập -->
                                        <span class="ll profile-username">
                                            <span class="op-7">Hi,</span>
                                            <span class="fw-bold"><?php echo e(Auth::user()->name_user); ?></span>
                                        </span>
                                    <?php endif; ?>
                                    <ul class="dropdown-list">
                                        <?php if(Route::has('login')): ?>
                                            <?php if(auth()->guard()->check()): ?>
                                                <!-- Hiển thị thông tin người dùng khi đã đăng nhập -->
                                                <li>
                                                    <div class="user-box">
                                                        <div class="avatar-lg">
                                                            <img src="<?php echo e(Auth::user()->image ? asset(Auth::user()->image) : asset('asset-admin/img/profile.jpg')); ?>"
                                                                alt="Profile Image" class="avatar-img rounded" />
                                                        </div>
                                                        <div class="u-text">
                                                            <h4 style="font-size: 18px;"><?php echo e(Auth::user()->name_user); ?></h4>
                                                            <p style="font-size: 12px;"><?php echo e(Auth::user()->email); ?></p>
                                                            <a style="color: #fff; hover: #007bff" href="<?php echo e(route('profile')); ?>"
                                                                class="custom-button">Xem hồ sơ</a>
                                                        </div>
                                                    </div>
                                                </li>
                                                <hr>
                                                <li>
                                                    
                                                    <a href="<?php echo e(route('order')); ?>" class="dropdown-item">Đơn hàng của
                                                        tôi</a>
                                                        <a href="<?php echo e(route('orders.completed')); ?>" class="dropdown-item">Lịch sử đơn hàng</a>
                                        
                                                    <a href="<?php echo e(route('account')); ?>" class="dropdown-item">Thiết lập tài
                                                        khoản</a>

                                                    <?php if(Auth::user()->role_id == \App\Models\User::ADMIN_TYPE || Auth::user()->role_id == \App\Models\User::STAFF_TYPE): ?>
                                                        <a href="<?php echo e(route('admin.dashboard')); ?>" class="dropdown-item">Vào
                                                            quản trị viên</a>
                                                    <?php endif; ?>
                                                    <hr>
                                                    <form method="POST" action="<?php echo e(route('logout')); ?>">
                                                        <?php echo csrf_field(); ?>
                                                        <button style="text-align: center;" type="submit"
                                                            class="dropdown-item">Đăng xuất</button>
                                                    </form>
                                                </li>
                                            <?php else: ?>
                                                <!-- Tùy chọn đăng nhập/đăng ký khi chưa đăng nhập -->
                                                <li><a href="<?php echo e(route('login')); ?>" class="dropdown-item">Đăng nhập</a></li>
                                                <?php if(Route::has('register')): ?>
                                                    <li><a href="<?php echo e(route('register')); ?>" class="dropdown-item">Đăng ký</a>
                                                    </li>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </ul>
                                </li>
                                <li>
                                    <a class="nav-icon position-relative text-decoration-none"
                                        href="<?php echo e(route('cart.show')); ?>">
                                        <i class="pe-7s-shopbag"></i>
                                        <span class="notification">
                                            <?php echo e($cartItemCount ?? 0); ?>

                                        </span>
                                    </a>
                                </li>

                            </ul>
                        </div>

                    </div>
                </div>
                <!-- mini cart area end -->

            </div>
        </div>
    </div>
    <!-- header middle area end -->
    </div>
    <!-- main header start -->
</header>
<!-- end Header Area -->
<style>
    .logo-text {
        font-size: 36px;
        font-weight: bold;
        color: #ff5722;
        text-transform: uppercase;
        letter-spacing: 2px;
        text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.3);
        transition: transform 0.3s ease-in-out, color 0.3s ease-in-out;
    }

    .logo-text:hover {
        transform: scale(1.1);
        /* Tăng kích thước khi hover */
        color: #ff9800;
        /* Thay đổi màu khi hover */
        text-shadow: 3px 3px 12px rgba(0, 0, 0, 0.5);
    }
</style>
<?php /**PATH C:\laragon\www\datn\resources\views/layouts/user/menu.blade.php ENDPATH**/ ?>