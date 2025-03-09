@include('layouts.user.header')

{{-- Menu  --}}
@include('layouts.user.menu')

{{-- Content  --}}
<main>
    <!-- BANNER -->
    <section class="slider-area">
        <div class="hero-slider-active slick-arrow-style slick-arrow-style_hero slick-dot-style">
            <!-- Slide 1: Video -->
            <div class="hero-single-slide hero-overlay">
                <video class="hero-slider-item" autoplay muted loop
                    style="width: 100%; height: 100%; object-fit: cover;">
                    <source src="{{ asset('asset-user/img/banner/HOME_Q6_Main-KV_1440x640_pc.web.webm') }}"
                        type="video/webm">
                </video>
                <div class="hero-content">
                    <h2 class="slide-title">Galaxy Z Fold6</h2>
                    <h4 class="slide-desc">Tặng Galaxy Watch7 & Buds FE giới hạn khi mua màu độc quyền phiên bản
                        256GB</h4>
                </div>
            </div>

            <!-- Slide 2: Image -->
            <div class="hero-single-slide hero-overlay">
                <div class="hero-slider-item bg-img"
                    data-bg="{{ asset('asset-user/img/slider/pexels-photo-4526478.webp') }}">
                </div>
                <div class="hero-content">
                    <h2 class="slide-title">Khuyến mãi đặc biệt</h2>
                    <h4 class="slide-desc">Giảm giá 20% khi mua sạc dự phòng</h4>
                </div>
            </div>

            <!-- Slide 3: Image -->
            <div class="hero-single-slide hero-overlay">
                <div class="hero-slider-item bg-img"
                    data-bg="{{ asset('asset-user/img/slider/pexels-photo-4032364.webp') }}">
                </div>
                <div class="hero-content">
                    <h2 class="slide-title">Phụ kiện độc quyền</h2>
                    <h4 class="slide-desc">Tai nghe và phụ kiện dành riêng cho bạn</h4>
                </div>
            </div>
        </div>
    </section>

    <!-- ENDD BANNNER -->

    <!-- ICON hayy -->
    <div class="service-policy section-padding">
        <div class="container">
            <div class="row mtn-30">
                <div class="col-sm-6 col-lg-3">
                    <div class="policy-item">
                        <div class="policy-icon">
                            <i class="pe-7s-plane"></i>
                        </div>
                        <div class="policy-content">
                            <h6>
                                Miễn phí vận chuyển</h6>
                            <p>Miễn phí vận chuyển tất cả các đơn hàng</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="policy-item">
                        <div class="policy-icon">
                            <i class="pe-7s-help2"></i>
                        </div>
                        <div class="policy-content">
                            <h6>Hỗ trợ 24/7</h6>
                            <p>Hỗ trợ 24 giờ một ngày</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="policy-item">
                        <div class="policy-icon">
                            <i class="pe-7s-back"></i>
                        </div>
                        <div class="policy-content">
                            <h6>Trả lại tiền</h6>
                            <p>30 ngày trả hàng miễn phí</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="policy-item">
                        <div class="policy-icon">
                            <i class="pe-7s-credit"></i>
                        </div>
                        <div class="policy-content">
                            <h6>Thanh toán an toàn 100%</h6>
                            <p>Chúng tôi đảm bảo thanh toán an toànt</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- service policy area end -->

    <!-- banner sản phẩm -->
    <div class="banner-statistics-area">
        <div class="container">
            <div class="row1 row-20 mtn-20">
                <div class="col-sm-6">
                    <figure class="banner-statistics mt-20">
                        <a href="{{ route('shop') }}">
                            <img src="{{ asset('asset-user/img/banner/banner.png') }}" alt="product banner">
                        </a>
                        <div class="banner-content text-center">
                            <!-- <h5 class="banner-text1">NEW ARRIVALLS</h5> -->
                            <h2 class="banner-text2" style="color: white">TAI NGHE<span
                                    style="color: #0cc0df;">GAMING</span></h2>
                            <a href="{{ route('shop') }}" class="btn1 btn-text">Shop Now</a>
                        </div>
                    </figure>
                </div>
                <div class="col-sm-6">
                    <figure class="banner-statistics mt-20">
                        <a href="{{ route('shop') }}">
                            <img src="{{ asset('asset-user/img/banner/banner2.png') }}" alt="product banner">
                        </a>
                        <div class="banner-content text-center">
                            <!-- <h5 class="banner-text1">NEW ARRIVALLS</h5> -->
                            <h2 class="banner-text2" style="color: white">SAMSUNG<span style="color: #0cc0df;">THỜI
                                    THƯỢNG</span></h2>
                            <a href="{{ route('shop') }}" class="btn1 btn-text">Shop Now</a>
                        </div>
                    </figure>
                </div>
                <div class="col-sm-6">
                    <figure class="banner-statistics mt-20">
                        <a href="{{ route('shop') }}">
                            <img src="{{ asset('asset-user/img/banner/banner3.png') }}" alt="product banner">
                        </a>
                        <div class="banner-content text-center">
                            <!-- <h5 class="banner-text1">NEW ARRIVALLS</h5> -->
                            <h2 class="banner-text2" style="color: white">IPHONE<span style="color: #0cc0df;">TRẺ
                                    TRUNG</span></h2>
                            <a href="{{ route('shop') }}" class="btn1 btn-text">Shop Now</a>
                        </div>
                    </figure>
                </div>
                <div class="col-sm-6">
                    <figure class="banner-statistics mt-20">
                        <a href="{{ route('shop') }}">
                            <img src="{{ asset('asset-user/img/banner/aa.jpg') }}" alt="product banner">
                        </a>
                        <div class="banner-content text-center">
                            <!-- <h5 class="banner-text1">NEW ARRIVALLS</h5> -->
                            <h2 class="banner-text2" style="color: white">PHỤ KIỆN<span style="color: #0cc0df;">ĐA
                                    DẠNG</span></h2>
                            <a href="{{ route('shop') }}" class="btn1 btn-text">Shop Now</a>
                        </div>
                    </figure>
                </div>
            </div>
        </div>
    </div>
    <!-- banner statistics area end -->
    <!-- Hiển thị ảnh sp nổi bật -->

    @if (isset($all))

        <section class="product-area section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <!-- section title start -->
                        <div class="section-title text-center">
                            <h2 class="title">Sản phẩm Mới</h2>
                            <p class="sub-title">Thêm sản phẩm của chúng tôi vào danh sách hàng tuần</p>
                        </div>
                        <!-- section title start -->
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="product-container">
                            <!-- product tab menu start -->
                            <div class="product-tab-menu">
                                <ul class="nav justify-content-center">
                                    <li><a href="#tab1" class="active" data-bs-toggle="tab">Một số sản phẩm
                                            Mới</a>
                                    </li>
                                </ul>
                            </div>
                            <!-- product tab menu end -->

                            <!-- product tab content start -->
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="tab1">
                                    <div class="product-carousel-4 slick-row-10 slick-arrow-style">
                                        <!-- product item start -->
                                        @foreach ($all as $product)
                                            <!-- Product item start -->
                                            <div class="product-item">
                                                <figure class="product-thumb">


                                                    <a href="{{ route('product.show', $product->id) }}">

                                                        <img src="{{ asset('storage/' . $product->image) }}"
                                                            alt="{{ $product->name_sp }}">
                                                    </a>

                                                    <div class="product-badge">
                                                        @if ($product->is_new)
                                                            <div class="product-label new">
                                                                <span>Mới</span>
                                                            </div>
                                                        @endif
                                                        @if ($product->discount > 0)
                                                            <div class="product-label discount">
                                                                <span>{{ $product->discount }}%</span>
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div class="button-group">
                                                        <a href="wishlist.html" data-bs-toggle="tooltip"
                                                            data-bs-placement="left" title="Add to wishlist">
                                                            <i class="pe-7s-like"></i>
                                                        </a>
                                                    </div>
                                                    <div class="cart-hover">
                                                        <button class="btn btn-cart"><a
                                                                href="{{ route('product.show', $product->id) }}">Chi
                                                                tiết sản phẩm</a></button>
                                                    </div>
                                                </figure>
                                                <div class="product-caption text-center">
                                                    <div class="product-identity">
                                                        <p class="manufacturer-name">
                                                            <a href="#">{{ $product->category->name }}</a>
                                                        </p>
                                                    </div>
                                                    <h6 class="product-name">
                                                        <a
                                                            href="{{ route('product.show', $product->id) }}">{{ $product->name_sp }}</a>
                                                    </h6>
                                                    <div class="price-box">
                                                        <span
                                                            class="price-regular">{{ number_format($product->price, 0, ',', '.') }}
                                                            VND</span>
                                                        @if ($product->old_price)
                                                            <span class="price-old">
                                                                <del>{{ number_format($product->old_price, 0, ',', '.') }}
                                                                    VND</del>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Product item end -->
                                        @endforeach

                                    </div>
                                </div>
                            </div>
                            <!-- product tab content end -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @else
    @endif

    <!-- Danh sách sản phẩm bán chạy -->
    <!-- Danh sách sản phẩm bán chạy -->

    @if (isset($Hot))

        <section class="product-area section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <!-- Tiêu đề -->
                        <div class="section-title text-center">
                            <h2 class="title">Sản phẩm bán chạy</h2>
                            <p class="sub-title">Những sản phẩm được mua nhiều nhất</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="product-container">
                            <div class="product-tab-menu">
                                <ul class="nav justify-content-center">
                                    <li><a href="#tab1" class="active" data-bs-toggle="tab">Sản phẩm bán
                                            chạy</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="tab1">
                                    <div class="product-carousel-4 slick-row-10 slick-arrow-style">
                                        @foreach ($Hot as $product)
                                            <!-- Sản phẩm -->
                                            <div class="product-item">
                                                <figure class="product-thumb">
                                                    <a href="{{ route('product.show', $product->id) }}">
                                                        <img src="{{ asset('storage/' . $product->image) }}"
                                                            alt="{{ $product->name_sp }}">
                                                    </a>
                                                    <div class="product-badge">
                                                        @if ($product->is_new)
                                                            <div class="product-label new">
                                                                <span>Mới</span>
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div class="cart-hover">
                                                        <button class="btn btn-cart"><a
                                                                href="{{ route('product.show', $product->id) }}">Chi
                                                                tiết</a></button>
                                                    </div>
                                                </figure>
                                                <div class="product-caption text-center">
                                                    <h6 class="product-name">
                                                        <a
                                                            href="{{ route('product.show', $product->id) }}">{{ $product->name_sp }}</a>
                                                    </h6>
                                                    <div class="price-box">
                                                        <span
                                                            class="price-regular">{{ number_format($product->price, 0, ',', '.') }}
                                                            VND</span>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @else
    @endif


    <!-- Hiển thị danh mục -->
    <section class="product-area section-padding">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- section title start -->
                    <div class="section-title text-center">
                        <h2 class="title">Sản phẩm của chúng tôi</h2>
                        <p class="sub-title">Thêm sản phẩm của chúng tôi vào danh sách hàng tuần</p>
                    </div>
                    <!-- section title start -->
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="product-container">
                        <!-- product tab menu start -->
                        <div class="product-tab-menu">
                            <ul class="nav justify-content-center">
                                <li><a href="#tab1" class="active" data-bs-toggle="tab">Một số sản phẩm</a>
                                </li>
                            </ul>
                        </div>
                        <!-- product tab menu end -->

                        <!-- product tab content start -->
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="tab1">
                                <div class="product-carousel-4 slick-row-10 slick-arrow-style">
                                    <!-- product item start -->
                                    @foreach ($products as $product)
                                        <div class="product-item">
                                            <figure class="product-thumb">
                                                <a href="{{ route('product.show', $product->id) }}">
                                                    <img class="pri-img"
                                                        src="{{ asset('storage/' . $product->image) }}"
                                                        alt="{{ $product->name_sp }}">
                                                    <img class="sec-img"
                                                        src="{{ asset('storage/' . $product->image) }}"
                                                        alt="{{ $product->name_sp }}">
                                                </a>
                                                <div class="product-badge">
                                                    @if ($product->is_new)
                                                        <div class="product-label new">
                                                            <span>New</span>
                                                        </div>
                                                    @endif
                                                    @if ($product->discount > 0)
                                                        <div class="product-label discount">
                                                            <span>{{ $product->discount }}%</span>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="button-group">
                                                    <a href="wishlist.html" data-bs-toggle="tooltip"
                                                        data-bs-placement="left" title="Add to wishlist">
                                                        <i class="pe-7s-like"></i>
                                                    </a>

                                                </div>
                                                <div class="cart-hover">
                                                    <button class="btn btn-cart"><a
                                                            href="{{ route('product.show', $product->id) }}">Chi
                                                            tiết sản phẩm</a></button>
                                                </div>
                                            </figure>
                                            <div class="product-caption text-center">
                                                <div class="product-identity">
                                                    <p class="manufacturer-name"><a
                                                            href="product-details.html">{{ $product->category->name }}</a>
                                                    </p>
                                                </div>
                                                <h6 class="product-name">
                                                    <a
                                                        href="{{ route('product.show', $product->id) }}">{{ $product->name_sp }}</a>
                                                </h6>
                                                <div class="price-box">
                                                    <span
                                                        class="price-regular">{{ number_format($product->price, 0, ',', '.') }}
                                                        VND</span>
                                                    @if ($product->old_price)
                                                        <span class="price-old"><del>{{ number_format($product->old_price, 0, ',', '.') }}
                                                                VND</del></span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <!-- product item end -->
                                    @endforeach

                                </div>
                            </div>
                        </div>
                        <!-- product tab content end -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Hết danh mục -->


    <!-- Cái Blog -->
    <section class="latest-blog-area section-padding pt-0">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- section title start -->
                    <div class="section-title text-center">
                        <h2 class="title">Bài viết mới nhất</h2>
                        <p class="sub-title">Có những bài đăng blog mới nhất</p>
                    </div>
                    <!-- section title start -->
                </div>
            </div>
            <div class="row">
                <!-- Bài viết start -->
                @foreach ($recentPosts as $recentPost)
                    <div class="blog-post-item" style="display: flex; margin-left: 10px;">
                        <div class="al">
                            <figure class="blog-thumb">
                                <a href="{{ route('user.posts.show', $recentPost->id) }}">
                                    @if ($recentPost->video)
                                        <!-- Nếu có video, hiển thị video -->
                                        <div class="video-container">
                                            <iframe
                                                src="https://www.youtube.com/embed/{{ \Illuminate\Support\Str::after($recentPost->video, 'v=') }}"
                                                frameborder="0" allowfullscreen width="350px"
                                                height="257px"></iframe>
                                        </div>
                                    @elseif ($recentPost->image)
                                        <!-- Nếu không có video, hiển thị ảnh -->
                                        <img src="{{ asset('storage/' . $recentPost->image) }}" alt="Post Image">
                                    @else
                                        Không có ảnh hoặc video
                                    @endif
                                </a>
                            </figure>
                            <div class="blog-content">
                                <div class="blog-meta">
                                    <p>{{ $recentPost->created_at->format('F d, Y') }} | <a
                                            href="#">StorePhone</a>
                                    </p>
                                </div>
                                <h4 class="blog-title">
                                    <a href="{{ route('user.posts.show', $recentPost->id) }}">
                                        {{ \Illuminate\Support\Str::limit($recentPost->title, 20, '...') }}
                                    </a>
                                </h4>

                            </div>
                        </div>

                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Hết Blog -->
</main>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Thêm vào cuối <body> -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
@if (session('status'))
    <script>
        $(document).ready(function() {
            toastr.options = {
                "closeButton": false,
                "debug": false,
                "newestOnTop": false,
                "progressBar": true,
                "positionClass": "toast-top-right", // Vị trí thông báo
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "1000", // Thời gian tự động đóng
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            };
            toastr.success('{{ session('status') }}');
        });
    </script>
@endif
<script>
    var imageUrl = undefined;

    $('.bg-img').each(function() {
        var bg = $(this).data('bg');
        if (bg) {
            $(this).css('background-image', 'url(' + bg + ')');
        } else {
            console.error('URL không hợp lệ cho phần tử: ', $(this));
        }
    });
    // 
    $('.hero-slider-active').slick({
        dots: true,
        arrows: true,
        autoplay: true,
        autoplaySpeed: 5000,
        fade: true,
        cssEase: 'linear'
    });
    // 
    $('.hero-slider-active').slick({
        dots: true, // Hiển thị các chấm điều hướng
        arrows: true, // Hiển thị mũi tên chuyển slide (nếu muốn)
        autoplay: true,
        autoplaySpeed: 5000, // Thời gian giữa các slide
        fade: true, // Hiệu ứng mờ giữa các slide
        cssEase: 'linear', // Hiệu ứng chuyển động mượt mà
        customPaging: function(slider, i) {
            // Tùy chỉnh nội dung của mỗi chấm
            return '<button>' + (i + 1) + '</button>';
        }
    });
</script>
<style>
    .slick-dots li {
        margin: 0 10px;
        /* Khoảng cách giữa các chấm */
    }

    .slick-dots li button {
        background-color: transparent;
        /* Không có nền */
        border: none;
        width: 15px;
        /* Đường kính của vòng tròn */
        height: 15px;
        border-radius: 50%;
        /* Vòng tròn */
        background-color: #ccc;
        /* Màu nền khi chưa chọn */
        transition: background-color 0.3s ease, transform 0.3s ease;
    }

    .slick-dots li.slick-active button {
        background-color: #fff;
        /* Màu nền khi chọn */
        transform: scale(1.2);
        /* Tăng kích thước khi được chọn */
    }

    .slick-dots li button:hover {
        background-color: #888;
        /* Màu nền khi hover */
    }

    /*  */
    .hero-single-slide {
        position: relative;
        width: 100%;
        height: 550px;
        overflow: hidden;
    }

    .hero-slider-item {
        background-size: contain;
        background-position: center center;
        width: 2000px;
        height: 550px;
        object-fit: cover;
    }

    .hero-content {
        position: absolute;
        top: 50%;
        left: 50px;
        transform: translateY(-50%);
        z-index: 1;
        color: white;
        padding: 20px;
        max-width: 600px;
    }

    .slide-title {
        font-size: 36px;
        font-weight: bold;
        text-transform: uppercase;
        margin-bottom: 10px;
        letter-spacing: 2px;
    }

    .slide-desc {
        font-size: 20px;
        font-weight: 300;
        line-height: 1.5;
    }

</style>
{{-- Footer  --}}
@include('layouts.user.footer')
