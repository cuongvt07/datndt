<!-- Start Header Area -->
<!-- <link rel="stylesheet" href="{{ asset('asset-admin/css/kaiadmin.min.css') }}" /> -->

<header class="header-area header-wide">
    <!-- header middle area start -->
    <div class="header-main-area sticky">
        <div class="container">
            <div class="row align-items-center position-relative">

                <!-- start logo area -->
                <div class="col-lg-3">
                    <div class="logo">
                        <a href="{{ route('index') }}" style="text-decoration: none;">
                            <h1 class="logo-text">StorePhone</h1>
                        </a>
                    </div>
                </div>


                <!-- start logo area -->

                <!-- main menu area start -->
                <div class="col-lg-5 position-static">
                    <div class="main-menu-area">
                        <div class="main-menu">
                            <!-- main menu navbar start -->
                            <nav class="desktop-menu">
                                <ul>
                                    <li><a href="{{ route('index') }}">Trang chủ</a>
                                    </li>
                                    <li><a href="{{ route('shop') }}">Cửa hàng</a>
                                    </li>
                                    <li><a href="{{ route('post')}}">Bài viết</a></li>
                                    <li><a href="{{ route('contact') }}">Liên hệ</a></li>
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
                            <form class="header-search-box d-lg-none d-xl-block" action="{{ route('shop') }}">
                                <input type="search" id="search-keyword" value="{{ request()->input('keyword') }}"
                                    name="keyword" placeholder="Tìm kiếm trong cửa hàng" class="header-search-field">
                                @if (request()->input('category'))
                                    <input type="hidden" value="{{ request()->input('category') }}" name="category">
                                @endif
                                @if (request()->input('minPrice'))
                                    <input type="hidden" name="minPrice" value="{{ request()->input('minPrice') }}">
                                @endif

                                @if (request()->input('maxPrice'))
                                    <input type="hidden" name="maxPrice" value="{{ request()->input('maxPrice') }}">
                                @endif


                                <button class="header-search-btn"><i class="pe-7s-search"></i></button>
                            </form>
                        </div>
                        <div class="header-configure-area">
                            <ul class="nav justify-content-end">
                                <li class="user-hover">
                                    <a href="#">
                                        <i class="pe-7s-user"></i>
                                    </a>
                                    @auth
                                        <!-- Hiển thị tên người dùng khi đã đăng nhập -->
                                        <span class="ll profile-username">
                                            <span class="op-7">Hi,</span>
                                            <span class="fw-bold">{{ Auth::user()->name_user }}</span>
                                        </span>
                                    @endauth
                                    <ul class="dropdown-list">
                                        @if (Route::has('login'))
                                            @auth
                                                <!-- Hiển thị thông tin người dùng khi đã đăng nhập -->
                                                <li>
                                                    <div class="user-box">
                                                        <div class="avatar-lg">
                                                            <img src="{{ Auth::user()->image ? asset(Auth::user()->image) : asset('asset-admin/img/profile.jpg') }}"
                                                                alt="Profile Image" class="avatar-img rounded" />
                                                        </div>
                                                        <div class="u-text">
                                                            <h4 style="font-size: 18px;">{{ Auth::user()->name_user }}</h4>
                                                            <p style="font-size: 12px;">{{ Auth::user()->email }}</p>
                                                            <a style="color: #fff; hover: #007bff" href="{{route('profile')}}"
                                                                class="custom-button">Xem hồ sơ</a>
                                                        </div>
                                                    </div>
                                                </li>
                                                <hr>
                                                <li>
                                                    {{-- <div class="dropdown-divider"></div> --}}
                                                    <a href="{{ route('order') }}" class="dropdown-item">Đơn hàng của
                                                        tôi</a>
                                                        <a href="{{ route('orders.completed') }}" class="dropdown-item">Lịch sử đơn hàng</a>
                                        
                                                    <a href="{{ route('account') }}" class="dropdown-item">Thiết lập tài
                                                        khoản</a>

                                                    @if (Auth::user()->role_id == \App\Models\User::ADMIN_TYPE || Auth::user()->role_id == \App\Models\User::STAFF_TYPE)
                                                        <a href="{{ route('admin.dashboard') }}" class="dropdown-item">Vào
                                                            quản trị viên</a>
                                                    @endif
                                                    <hr>
                                                    <form method="POST" action="{{ route('logout') }}">
                                                        @csrf
                                                        <button style="text-align: center;" type="submit"
                                                            class="dropdown-item">Đăng xuất</button>
                                                    </form>
                                                </li>
                                            @else
                                                <!-- Tùy chọn đăng nhập/đăng ký khi chưa đăng nhập -->
                                                <li><a href="{{ route('login') }}" class="dropdown-item">Đăng nhập</a></li>
                                                @if (Route::has('register'))
                                                    <li><a href="{{ route('register') }}" class="dropdown-item">Đăng ký</a>
                                                    </li>
                                                @endif
                                            @endauth
                                        @endif
                                    </ul>
                                </li>
                                <li>
                                    <a href="{{ route('wishlist.index') }}">
                                        <i class="pe-7s-like"></i>
                                        <span class="notification">{{ session('wishlistItemCount', 0) }}</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="nav-icon position-relative text-decoration-none"
                                        href="{{ route('cart.show') }}">
                                        <i class="pe-7s-shopbag"></i>
                                        <span class="notification">
                                            {{ $cartItemCount ?? 0 }}
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
