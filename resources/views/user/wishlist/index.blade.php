@include('layouts.user.header')

{{-- Menu  --}}
@include('layouts.user.menu')

{{-- Content  --}}
<main>
    <!-- breadcrumb area start -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-wrap">
                        <nav aria-label="breadcrumb">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html"><i class="fa fa-home"></i></a></li>
                                <li class="breadcrumb-item active" aria-current="page">Sản phẩm yêu thích</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb area end -->

    <!-- Lọc danh mục -->
    {{-- éo biết load danh mục ra à --}}
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
                                    @foreach ($categories as $category)
                                        @php
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

                                        @endphp

                                        <li><a href="{{ $url }}">
                                                {{ $category->name }}
                                                <span>({{ count($category->products) }})</span>
                                            </a></li>
                                    @endforeach



                                </ul>
                            </div>
                        </div>
                        <div class="sidebar-single">
                            <h5 class="sidebar-title">Danh mục</h5>
                            <div class="sidebar-body">
                                <ul class="shop-categories">

                                    @foreach ($suppliers as $supplier)
                                        @php
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

                                        @endphp

                                        <li><a href="{{ $url }}">
                                                {{ $supplier->brand }}
                                                <span>({{ count($supplier->products) }})</span>
                                            </a></li>
                                    @endforeach


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
                                        <form action="{{ route('shop') }}"
                                            class="form-priced-flex align-items-center justify-content-between">
                                            <div class="price-input mb-4">
                                                <label for="amount">Price: </label>
                                                <input type="text" style="width:210px;max-width: 100%;"
                                                    id="amount">
                                                <input type="hidden"
                                                    value="{{ request()->input('minPrice') ? request()->input('minPrice') : '1000000' }}"
                                                    name="minPrice" id="minPrice">
                                                <input type="hidden" name="maxPrice"
                                                    value="{{ request()->input('maxPrice') ? request()->input('maxPrice') : '100000000' }}"
                                                    id="maxPrice">
                                                @if (request()->input('category'))
                                                    <input type="hidden" value="{{ request()->input('category') }}"
                                                        name="category">
                                                @endif
                                                @if (request()->input('supplier'))
                                                    <input type="hidden" value="{{ request()->input('supplier') }}"
                                                        name="supplier">
                                                @endif


                                                @if (request()->input('keyword'))
                                                    <input type="hidden" value="{{ request()->input('keyword') }}"
                                                        name="keyword">
                                                @endif
                                            </div>
                                            <button class="filter-btn">Lọc</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- single sidebar end -->

                        <!-- Thương hiệu -->
                        {{-- <div class="sidebar-single">
                            <h5 class="sidebar-title">Thương hiệu</h5>
                            <div class="sidebar-body">
                                <ul class="checkbox-container categories-list">
                                    <li>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="customCheck2">
                                            <label class="custom-control-label" for="customCheck2">Phòng làm việc
                                                (3)</label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="customCheck3">
                                            <label class="custom-control-label" for="customCheck3">Công nghệ (4)</label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="customCheck4">
                                            <label class="custom-control-label" for="customCheck4">Nhanh chóng
                                                (15)</label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="customCheck1">
                                            <label class="custom-control-label" for="customCheck1">Góc đồ họa
                                                (10)</label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="customCheck5">
                                            <label class="custom-control-label" for="customCheck5">Mục phát triển
                                                (12)</label>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div> --}}
                        <!--  end -->

                        <!-- Màu sắc -->
                        <div class="sidebar-single">
                            <h5 class="sidebar-title">Màu sắc</h5>
                            <div class="sidebar-body">
                                <form action="" class="form-color">
                                    <ul class="checkbox-container categories-list">
                                        @php
                                            $colorIds = request('colour_id', []);
                                        @endphp
                                        @foreach ($colours as $key => $color)
                                            <li>

                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" name="colour_id[]"
                                                        value="{{ $color->id }}"
                                                        {{ in_array($color->id, $colorIds) ? 'checked' : '' }}
                                                        class="custom-control-input" id="{{ $color->id }}">
                                                    <label class="custom-control-label"
                                                        for="{{ $color->id }}">{{ $color->name }}
                                                    </label>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </form>
                            </div>
                        </div>
                        <!-- end -->


                        <!-- Ảnh dưới phần lọc -->
                        <!-- <div class="sidebar-banner">
                            <div class="img-container">
                                <a href="#">
                                    <img src="{{ asset('asset-user/img/banner/lisa.jpg') }}" alt="">
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
                                            @if (request()->input('keyword'))
                                                <p>Tìm kiếm với từ khoá:
                                                    <strong>{{ request()->input('keyword') }}</strong>
                                            @endif
                                            </p>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <!-- Lọc ở trên sản phẩm -->

                        <!-- Giao diện sản phẩm yêu thích start -->
                        <div class="shop-product-wrap grid-view row mbn-30">
                            @forelse ($products as $product)
                                <div class="col-md-4 col-sm-6" style="justify-items: center;">
                                    <div class="product-item">
                                        <figure class="product-thumb">
                                            <a href="{{ route('product.show', $product->id) }}">
                                                <img class="pri-img" src="{{ asset('storage/' . $product->image) }}"
                                                    alt="product">
                                                <img class="sec-img" src="{{ asset('storage/' . $product->image) }}"
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
                                                <a href="#" class="delete-wishlist"
                                                    data-id="{{ $product->id }}" data-bs-toggle="tooltip"
                                                    data-bs-placement="left" title="Xóa khỏi yêu thích">
                                                    <i class="pe-7s-close-circle"></i>
                                                </a>
                                            </div>
                                            <div class="cart-hover">
                                                <a href="{{ route('product.show', $product->id) }}">
                                                    <button class="btn btn-cart">Thêm giỏ hàng</button>
                                                </a>
                                            </div>
                                        </figure>
                                        <div class="product-caption text-center">
                                            <h6 class="product-name">
                                                <a
                                                    href="{{ route('product.show', $product->id) }}">{{ $product->name_sp }}</a>
                                            </h6>
                                            <div class="price-box">
                                                <span
                                                    class="price-regular">{{ number_format($product->price, 0, ',', '.') }}₫</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Sản phẩm theo Danh sách -->
                                <div class="product-list-item">
                                    <figure class="product-thumb">
                                        <a href="product-details.html">
                                            <img class="pri-img" src="{{ asset('storage/' . $product->image) }}"
                                                alt="product">
                                            <img class="sec-img" src="{{ asset('storage/' . $product->image) }}"
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
                                            <a href="wishlist.html" data-bs-toggle="tooltip" data-bs-placement="left"
                                                title="Add to wishlist"><i class="pe-7s-like"></i></a>

                                        </div>
                                        <div class="cart-hover">
                                            <button class="btn btn-cart">Thêm giỏ hàng </button>
                                        </div>
                                    </figure>
                                    <div class="product-content-list">
                                        <div class="manufacturer-name">
                                            <div class="product-category">
                                                <!-- Hiển thị tên danh mục của sản phẩm -->
                                                <span>{{ $product->category->name }}</span>
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
                                                href="product-details.html">{{ $product->name_sp }}</a></h5>
                                        <div class="price-box">
                                            <span
                                                class="price-regular">{{ number_format($product->price, 0, ',', '.') }}₫</span>
                                        </div>
                                        <p>{{ $product->description }}</p>
                                    </div>
                                </div>
                                <!-- Sản phẩm theo danh sách End -->
                            @empty
                                <p>Danh sách yêu thích của bạn đang trống!</p>
                            @endforelse
                        </div>
                        <!-- Phân trang -->
                        <div class="paginatoin-area text-center">
                            <ul class="pagination-box">
                                <!-- Nút "Trang trước" -->
                                @if ($wishlists->onFirstPage())
                                    <li class="disabled"><a href="javascript:void(0);"><i
                                                class="pe-7s-angle-left"></i></a></li>
                                @else
                                    <li><a class="previous" href="{{ $wishlists->previousPageUrl() }}"><i
                                                class="pe-7s-angle-left"></i></a></li>
                                @endif

                                <!-- Các số trang -->
                                @foreach ($wishlists->getUrlRange(1, $wishlists->lastPage()) as $page => $url)
                                    <li class="{{ $page == $wishlists->currentPage() ? 'active' : '' }}">
                                        <a href="{{ $url }}">{{ $page }}</a>
                                    </li>
                                @endforeach

                                <!-- Nút "Trang sau" -->
                                @if ($wishlists->hasMorePages())
                                    <li><a class="next" href="{{ $wishlists->nextPageUrl() }}"><i
                                                class="pe-7s-angle-right"></i></a></li>
                                @else
                                    <li class="disabled"><a href="javascript:void(0);"><i
                                                class="pe-7s-angle-right"></i></a></li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
    <!-- Giao diện sản phẩm yêu thích end -->
</main>
@include('layouts.user.footer')
<!-- Thêm SweetAlert2 CDN vào trong file HTML của bạn -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    var minPricePHP = @json($minPrice),
        maxPricePHP = @json($maxPrice);

    const formColor = document.querySelector(".form-color")
    const checkBoxElArr = document.querySelectorAll('.form-color input[type="checkbox"]')
    checkBoxElArr.forEach(checkBoxEl => {
        checkBoxEl.addEventListener('change', function() {
            formColor.submit();
        });
    });
    //  Js của yêu thích

    document.addEventListener('DOMContentLoaded', function() {
        // Lấy CSRF token từ meta tag
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

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
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };

        // Bắt sự kiện click cho tất cả các liên kết xóa
        document.querySelectorAll('.delete-wishlist').forEach(button => {
            button.addEventListener('click', function(event) {
                event.preventDefault(); // Ngăn chặn hành động mặc định của thẻ <a>

                const productId = this.getAttribute('data-id'); // Lấy ID sản phẩm

                // Sử dụng SweetAlert2 để hỏi người dùng có chắc chắn xóa không
                Swal.fire({
                    title: 'Bạn có chắc chắn muốn xóa sản phẩm này khỏi yêu thích?',
                    text: 'Bạn sẽ không thể hoàn tác hành động này!',
                    icon: 'warning', // Biểu tượng cảnh báo
                    showCancelButton: true, // Hiển thị nút hủy
                    confirmButtonColor: '#3085d6', // Màu cho nút xác nhận
                    cancelButtonColor: '#d33', // Màu cho nút hủy
                    confirmButtonText: 'Có, xóa nó!',
                    cancelButtonText: 'Không, hủy bỏ'
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch(`/wishlist/${productId}`, {
                                method: 'DELETE',
                                headers: {
                                    'X-CSRF-TOKEN': csrfToken,
                                    'Content-Type': 'application/json',
                                }
                            })
                            .then(response => {
                                if (response.ok) {
                                    toastr.success(
                                        'Sản phẩm đã được xóa khỏi yêu thích');
                                    location
                                        .reload();
                                } else {
                                    toastr.error(
                                        'Không thể xóa sản phẩm. Vui lòng thử lại.'
                                    );
                                }
                            })
                            .catch(error => {
                                console.error('Lỗi:', error);
                                toastr.error('Đã xảy ra lỗi. Vui lòng thử lại.');
                            });
                    } else {
                        Swal.fire(
                            'Đã hủy',
                            'Sản phẩm vẫn còn trong danh sách yêu thích.',
                            'info'
                        );
                    }
                });
            });
        });
    });



    // 
</script>
