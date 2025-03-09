<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Admin - Hình Ảnh Sản Phẩm</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />

    <!-- Fonts and icons -->
    <script src="{{ asset('asset-admin/js/plugin/webfont/webfont.min.js') }}"></script>
    <script>
        WebFont.load({
            google: {
                families: ["Public Sans:300,400,500,600,700"]
            },
            custom: {
                families: [
                    "Font Awesome 5 Solid",
                    "Font Awesome 5 Regular",
                    "Font Awesome 5 Brands",
                    "simple-line-icons",
                ],
                urls: ["../../asset-admin/css/fonts.min.css"],
            },
            active: function() {
                sessionStorage.fonts = true;
            },
        });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="{{ asset('asset-admin/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('asset-admin/css/plugins.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('asset-admin/css/kaiadmin.min.css') }}" />

    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link rel="stylesheet" href="{{ asset('asset-admin/css/demo.css') }}" />
</head>
<body>

<div class="wrapper">
    <!-- Sidebar -->
    @include('layouts.admin.sitebar')
    <!-- End Sidebar -->

    <div class="main-panel">
        @include('layouts.admin.header')

        <div class="container mt-4">
            <h1>Danh sách hình ảnh sản phẩm</h1>
            
            <!-- Form tìm kiếm sản phẩm theo từ khóa -->
            <form method="GET" action="{{ route('product_image.index') }}" class="mb-4" style="width:50%; margin-left: 400px;">
                <div class="input-group">
                    <input type="text" class="form-control" name="search" placeholder="Tìm kiếm sản phẩm"
                        value="{{ request()->get('search') }}">
                    <button class="btn btn-primary" type="submit">Tìm kiếm</button>
                </div>
            </form>
        
            <a href="{{ route('product_image.create') }}" class="btn btn-primary mb-3">Thêm mới hình ảnh</a>
        
            <!-- Loop qua từng sản phẩm -->
            @foreach ($products as $product)
                <div class="card mb-3">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <p class="mb-0">{{ $product->name_sp }}</p>
                        <button class="btn btn-primary btn-sm" data-bs-toggle="collapse" data-bs-target="#collapse-{{ $product->id }}">
                            <i class="bi bi-plus"></i>
                        </button>
                    </div>
        
                    <div id="collapse-{{ $product->id }}" class="collapse">
                        <div class="card-body">
                            @if ($product->productImages->isNotEmpty())
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Màu sắc</th>
                                        <th>Hình ảnh</th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($product->productImages as $image)
                                    <tr>
                                        <td>{{ $image->colour->name ?? 'Không có' }}</td>
                                        <td>
                                            <img src="{{ asset('storage/' . $image->image_path) }}" width="100" alt="Hình sản phẩm">
                                        </td>
                                        <td>
                                            <a href="{{ route('product_image.edit', $image->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                                            <form action="{{ route('product_image.destroy', $image->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @else
                            <p class="text-center">Không có hình ảnh nào cho sản phẩm này.</p>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        
          
            <div class="d-flex justify-content-center">
                {{ $products->links('pagination::bootstrap-5') }}
            </div>

        </div>      
    </div>

    
</div>

<!-- Core JS Files -->
<script src="{{ asset('asset-admin/js/core/jquery-3.7.1.min.js') }}"></script>
<script src="{{ asset('asset-admin/js/core/popper.min.js') }}"></script>
<script src="{{ asset('asset-admin/js/core/bootstrap.min.js') }}"></script>

<!-- Plugin JS -->
<script src="{{ asset('asset-admin/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>
<script src="{{ asset('asset-admin/js/plugin/chart.js/chart.min.js') }}"></script>
<script src="{{ asset('asset-admin/js/plugin/datatables/datatables.min.js') }}"></script>

</body>
</html>
