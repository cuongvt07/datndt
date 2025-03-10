<div class="sidebar" data-background-color="dark">
    <div class="sidebar-logo">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="white">
            <a href="{{ route('admin.dashboard') }}" class="logo">
                <img src="https://th.bing.com/th/id/OIP.aJsHBdiH8uxOMvKnxI510AHaF7?rs=1&pid=ImgDetMain" width="50px" height="50px" alt="navbar brand" class="navbar-brand"
                    height="20" />
            </a>
            <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar">
                    <i class="gg-menu-right"></i>
                </button>
                <button class="btn btn-toggle sidenav-toggler">
                    <i class="gg-menu-left"></i>
                </button>
            </div>
            <button class="topbar-toggler more">
                <i class="gg-more-vertical-alt"></i>
            </button>
        </div>
        <!-- End Logo Header -->
    </div>
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-secondary">
                <li class="nav-item active">
                    <a href="{{ route('admin.dashboard') }}">
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">TÁC VỤ</h4>
                </li>
                <li class="nav-item">
                    <a href="{{ route('categories.index') }}">
                        <i class="fas fa-layer-group"></i>
                        <p>Danh Mục</p>
                    </a>


                </li>
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#sidebarLayouts">
                        <i class="fas fa-th-list"></i>
                        <p>Quản lý Sản phẩm</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="sidebarLayouts">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{ route('products.index') }}">
                                    <span class="sub-item">Kho | sản phẩm</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('suppliers.index') }}">
                                    <span class="sub-item">Nhà cung cấp</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('batterys.index') }}">
                                    <span class="sub-item">Pin</span>
                                </a>
                            </li>
                        
                            <li>
                                <a href="{{ route('variants.index') }}">
                                    <span class="sub-item">Dung Lượng</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('screens.index') }}">
                                    <span class="sub-item">Màn hình</span>
                                </a>
                            </li>

                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#tables">
                        <i class="fas fa-table"></i>
                        <p>Biến thể</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="tables">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{ route('product_image.index') }}">
                                    <span class="sub-item">Hỉnh ảnh</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('colours.index') }}">
                                    <span class="sub-item">Màu sắc</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('product_variants.index') }}">
                                    <span class="sub-item">Dung lượng</span>
                                </a>
                            </li>

                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a href="{{ route('users.index') }}">
                        <i class="bi bi-person-fill"></i>
                        <p>Người dùng</p>
                    </a>

                </li>
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#charts">
                        <i class="bi bi-bag-heart-fill"></i>
                        <p>Giỏ hàng</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="charts">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{ route('admin.orders') }}">
                                    <span class="sub-item">Hóa đơn</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#discountCodes">
                        <i class="bi bi-tags-fill"></i> 
                        <p>Mã giảm giá</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="discountCodes">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{ route('admin.discount_codes.index') }}">
                                    <span class="sub-item">Quản lý mã giảm giá</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#chat">
                        <i class="bi bi-chat-dots"></i>
                        <p>Chat với người dùng</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="chat">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{ route('admin.chat.index') }}">
                                    <span class="sub-item">Chat box</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a href="{{ route('review.index') }}">
                        <i class="fa fa-comment"></i>
                        <p>Quản lý đánh giá</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('posts.index') }}">
                        <i class="fa-solid fa-blog"></i>
                        <p>Bài viết</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.annalist') }}">
                        <i class="far fa-chart-bar"></i>
                        <p>Thống kê</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
