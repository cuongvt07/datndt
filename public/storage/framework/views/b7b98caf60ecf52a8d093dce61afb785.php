<?php echo $__env->make('layouts.user.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<?php echo $__env->make('layouts.user.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<div class="breadcrumb-area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb-wrap">
                    <nav aria-label="breadcrumb">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo e(route('index')); ?>"><i class="fa fa-home"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Lịch sử đơn hàng của tôi</li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container mt-5">
    <h2 class="text-center mb-4">Lịch sử đơn hàng của tôi</h2>
    <a href="<?php echo e(route('order')); ?>" class="btn btn-primary btn-lg px-4 py-2 rounded-pill shadow-sm">
        Đơn Hàng
    </a>
    <a href="<?php echo e(route('orders.completed-canceled')); ?>" class="btn btn-primary btn-lg px-4 py-2 rounded-pill shadow-sm">
        Đơn Hàng Đã Hủy
      </a>

    <?php if($completedOrders->count() > 0): ?>
        <table class="table table-hover mt-4">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Trạng thái</th>
                    <th>Tỉnh/Thành</th>
                    <th>Quận/Huyện</th>
                    <th>Xã/Phường</th>
                    <th>Địa chỉ</th>
                    <th>Số điện thoại</th>
                    <th>Sản phẩm</th>
                    <th>Phí ship</th>
                    <th>Tổng tiền</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $completedOrders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($order->id); ?></td>

                        <td>
                            <?php if($order->status == 'completed'): ?>
                                <span class="badge badge-success">Đã hoàn thành</span>
                            <?php elseif($order->status == 'canceled'): ?>
                                <span class="badge badge-danger">Đã hủy</span>
                            <?php endif; ?>
                        </td>

                        <td><?php echo e($order->province); ?></td>
                        <td><?php echo e($order->district); ?></td>
                        <td><?php echo e($order->ward); ?></td>
                        <td><?php echo e($order->detail_address); ?></td>
                        <td><?php echo e($order->phone); ?></td>
                        <td>
                            <?php $__currentLoopData = $order->orderItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="d-flex align-items-center mb-2">
                                    <img src="<?php echo e(asset('storage/' . $item->product->productImages->where('colour_id', $item->color_id)->first()->image_path)); ?>"
                                        alt="Product"
                                        style="max-width: 50px; max-height: 50px; object-fit: cover; margin-right: 10px;">
                                    <div>
                                        <strong><?php echo e($item->product->name_sp); ?></strong> <br>
                                        <small><?php echo e($item->battery->capacity); ?> |
                                            <?php echo e($item->variant->ram_smartphone ?? 'Không có ram'); ?> |
                                            <?php echo e($item->color->name); ?></small><br>
                                        <small>Số lượng: <?php echo e($item->quantity); ?></small>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php $__currentLoopData = $order->orderItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    
                            <?php if(!$item->review): ?>
                                <button class="btn btn-sqr mt-2" data-bs-toggle="modal"
                                        data-bs-target="#reviewModal" data-product-id="<?php echo e($item->product->id); ?>">
                                    Đánh giá
                                </button>
                            <?php else: ?>
                                <span class="badge badge-success mt-2">Đã đánh giá</span>
                            <?php endif; ?>
                        
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        
                        
                            <!-- Nút Mua lại sản phẩm -->
                            <a href="<?php echo e(route('product.show', ['product' => $item->product->id])); ?>"
                                class="btn btn-sqr mt-2">
                                Mua lại
                            </a>
                        </td>
                        <td>
                            <strong><?php echo e(number_format($order->shipping_fee, 0, ',', '.')); ?> ₫</strong>
                        </td>
                        <td>
                            <strong><?php echo e(number_format($order->grand_total, 0, ',', '.')); ?> ₫</strong>
                             <br>
                            <s style="font-size: 10px"><?php echo e(number_format($order->total_after_discount, 0, ',', '.')); ?> ₫</s>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    <?php else: ?>
        <div class="alert alert-info text-center" role="alert">
            Bạn chưa có đơn hàng nào đã hoàn thành.
        </div>
    <?php endif; ?>
    <!-- Modal đánh giá -->
    <div class="modal fade" id="reviewModal" tabindex="-1" aria-labelledby="reviewModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <h2 class="text-center mb-4">Đánh Giá Sản Phẩm</h2>
                <?php $__currentLoopData = $order->orderItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="sanpham">
                        <img src="<?php echo e(asset('storage/' . $item->product->productImages->where('colour_id', $item->color_id)->first()->image_path)); ?>"
                            alt="Product" class="product-image">
                        <div class="product-info">
                            <strong><?php echo e($item->product->name_sp); ?></strong> <br>
                            <span class="category-info">Phân loại hàng:
                                <?php echo e($item->product->category->name ?? 'Chưa phân loại'); ?></span>
                        </div>
                    </div>
                    <form action="<?php echo e(route('reviews.store')); ?>" method="POST" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <div class="form1">
                            <!-- Input ẩn cho product_id -->
                            <input type="hidden" name="product_id" value="<?php echo e($item->product->id); ?>">
                            <!-- Phần chất lượng sản phẩm -->
                            <div class="form-group">
                                <label for="content" style="margin-bottom: 10px">Chất lượng sản phẩm:</label>
                                <textarea name="content" id="content" rows="4" class="form-control"
                                    placeholder="Chia sẻ cảm nhận của bạn về sản phẩm" required></textarea>
                            </div>

                            <!-- Phần upload ảnh và video -->
                            <div class="media-upload-container mb-3">
                                <div class="upload-icons">
                                    <label class="upload-icon" for="images">
                                        <i class="fa fa-camera"></i> Thêm hình ảnh
                                        <input type="file" name="images[]" id="images" accept="image/*" multiple
                                            style="display: none">
                                    </label>
                                    <label class="upload-icon" for="videos">
                                        <i class="fa fa-video-camera"></i> Thêm video
                                        <input type="file" name="videos[]" id="videos" accept="video/*" multiple
                                            style="display: none">
                                    </label>
                                </div>
                                <div id="media-preview" class="preview-container"></div>
                            </div>
                        </div>


                        <!-- Phần đánh giá sao -->
                        <div class="form-group1">
                            <label>Đánh giá chất lượng sản phẩm:</label>
                            <div class="star-rating">
                                <svg class="star" data-value="1" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 24 24" width="30" height="30">
                                    <polygon points="12,2 15,8 22,8 17,12 19,19 12,15 5,19 7,12 2,8 9,8" />
                                </svg>
                                <svg class="star" data-value="2" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 24 24" width="30" height="30">
                                    <polygon points="12,2 15,8 22,8 17,12 19,19 12,15 5,19 7,12 2,8 9,8" />
                                </svg>
                                <svg class="star" data-value="3" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 24 24" width="30" height="30">
                                    <polygon points="12,2 15,8 22,8 17,12 19,19 12,15 5,19 7,12 2,8 9,8" />
                                </svg>
                                <svg class="star" data-value="4" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 24 24" width="30" height="30">
                                    <polygon points="12,2 15,8 22,8 17,12 19,19 12,15 5,19 7,12 2,8 9,8" />
                                </svg>
                                <svg class="star" data-value="5" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 24 24" width="30" height="30">
                                    <polygon points="12,2 15,8 22,8 17,12 19,19 12,15 5,19 7,12 2,8 9,8" />
                                </svg>
                            </div>
                            <div id="rating-description" class="mt-2" style="margin-bottom: 10px;"></div>
                        </div>

                        <input type="hidden" name="rating" id="rating" value="1">
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" id="form-btn1" data-bs-dismiss="modal">Hủy</button>
                            <button type="submit" class="btn btn-sqr" id="form-btn" onclick="showSuccessMessage()">Gửi đánh giá</button>
                        </div>
                    </form>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>

</div>

<style>
    .toast-center-center {
        top: 50%;
        /* Căn giữa theo chiều dọc */
        left: 50%;
        /* Căn giữa theo chiều ngang */
        transform: translate(-50%, -50%);
        /* Căn chỉnh chính xác */
        position: fixed;
        z-index: 9999;
    }

    /* Container chứa các nút, sử dụng Flexbox để căn phải */
    .modal-footer {
        display: flex;
        justify-content: flex-end;
        /* Căn các phần tử con sang phía bên phải */
        gap: 10px;
        /* Khoảng cách giữa các nút */
    }

    /* Để căn giữa các nút và giữ đúng kích thước */
    .btn {
        font-size: 14px;
        padding: 8px 20px;
        /* Đảm bảo các nút có kích thước tương tự nhau */
    }

    .badge {
        padding: 0.5em 1em;
        border-radius: 20px;
        font-size: 0.9em;
        font-weight: bold;
    }

    .badge-danger {
        background-color: #dc3545;
    }

    .badge-success {
        background-color: #28a745;
    }

    .table-hover tbody tr:hover {
        background-color: rgba(0, 0, 0, 0.05);
    }
</style>

<!-- Các link CSS đầu tiên -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.css">

<!-- Nội dung trang -->

<?php echo $__env->make('layouts.user.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!-- Các link JS và script ở cuối để không làm gián đoạn việc tải trang -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
   function showSuccessMessage() {
    <?php if(session('status')): ?>
      
        toastr.success('<?php echo e(session('status')); ?>', '', {
            "timeOut": 20000,  
        });
    <?php else: ?>
       
        toastr.success('Đánh giá của bạn đã được gửi thành công!', '', {
            "timeOut": 200000, 
        });
    <?php endif; ?>
}

    // Modal
    document.addEventListener('DOMContentLoaded', function() {
        const reviewModal = document.getElementById('reviewModal');
        reviewModal.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget; // Nút kích hoạt modal
            const productId = button.getAttribute('data-product-id'); // Lấy product_id
            const productIdInput = reviewModal.querySelector('#modal-product-id');
            productIdInput.value = productId; // Gán vào input hidden
        });
    });
    // Ngôi sao
    $(document).ready(function() {
        function updateRatingDescription(rating) {
            var description = ['Tệ', 'Không hài lòng', 'Bình thường', 'Hài lòng', 'Tuyệt vời'][rating - 1];
            $('#rating-description').text(description);
        }

        $('.star').on('click', function() {
            var ratingValue = $(this).data('value');
            $('.star').removeClass('selected');
            $(this).prevAll().addClass('selected');
            $(this).addClass('selected');
            updateRatingDescription(ratingValue);
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

    imageInput.addEventListener('change', function() {
        handleFilePreview(this, true); // Gọi hàm với tham số `true` cho hình ảnh
    });

    videoInput.addEventListener('change', function() {
        handleFilePreview(this, false); // Gọi hàm với tham số `false` cho video
    });
</script>
<style>
    .sanpham {
        display: flex;
        align-items: flex-start;
        /* Aligns image at the top with the text */
    }

    .product-image {
        max-width: 150px;
        max-height: 150px;
        object-fit: cover;
        margin-right: 10px;
    }

    /* Đảm bảo form group có thể căn chỉnh các phần tử con theo chiều ngang */
    .form-group1 {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 15px
    }

    /* Căn chỉnh phần label và star rating */
    .star-rating {
        display: flex;
        gap: 5px;
        font-size: 20px;
    }

    /*  */
    /* Đặt background cho modal */
    .modal-content {
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        padding: 20px;
    }

    /* Tùy chỉnh tiêu đề modal */
    .modal-header h2 {
        font-size: 24px;
        color: #333;
        text-align: center;
        flex-grow: 1;
    }

    /* Tùy chỉnh nút đóng khi hover */
    .btn-close:hover {
        background: #e63946;
    }

    /* Phần form đánh giá */
    .form-group label {
        font-size: 16px;
        color: #333;
    }

    .form-control {
        border: 1px solid #ddd;
        padding: 10px;
        font-size: 14px;
        border-radius: 4px;
    }

    textarea.form-control {
        resize: vertical;
    }

    /* Star rating */
    .star-rating {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 8px;
        /* Khoảng cách giữa các ngôi sao */
    }

    .star-rating .star {
        cursor: pointer;
        fill: #ccc;
        /* Màu xám cho ngôi sao chưa chọn */
        transition: fill 0.3s ease, transform 0.3s ease, stroke 0.3s ease;
        stroke-width: 1.5;
        /* Viền mỏng hơn */
        stroke: #ccc;
        /* Viền xám cho sao chưa chọn */
    }

    /* Khi ngôi sao được chọn */
    .star-rating .star.selected {
        fill: #f1c40f;
        /* Màu vàng cho ngôi sao đã chọn */
        stroke: #f1c40f;
        /* Viền vàng cho ngôi sao đã chọn */
    }

    /* Khi di chuột qua sao */
    .star-rating .star:hover {
        fill: #f1c40f;
        /* Màu vàng khi hover */
        stroke: #f1c40f;
        /* Viền vàng khi hover */
        transform: scale(1.3);
        /* Tăng kích thước sao khi hover */
    }

    #rating-description {
        color: #ffcc00;
        /* Sử dụng màu vàng của sao */
        font-size: 16px;
        /* Điều chỉnh kích thước chữ */
        font-weight: 500;
        /* Chỉnh độ đậm của chữ */
        margin-top: 5px;
    }

    /* Nút gửi đánh giá */
    #form-btn {
        background-color: #28a745;
        color: white;
        padding: 10px 20px;
        border-radius: 5px;
        font-size: 16px;
        border: none;
        cursor: pointer;
    }

    #form-btn1 {
        background-color: #ff0000;
        color: white;
        padding: 10px 20px;
        border-radius: 5px;
        font-size: 16px;
        border: none;
        cursor: pointer;
    }

    #form-btn:hover {
        background-color: #218838;
    }

    /* Thùng chứa media (ảnh và video) */
    #media-preview {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-top: 15px;
    }

    /* Căn chỉnh nút xóa vào góc trên bên phải của ảnh/video */
    .media-item {
        position: relative;
        display: inline-block;
        margin-right: 10px;
        margin-bottom: 10px;
    }

    /* Vị trí nút xóa */
    .delete-button {
        position: absolute;
        top: 5px;
        right: 5px;
        background-color: rgba(0, 0, 0, 0.5);
        color: white;
        border: none;
        border-radius: 50%;
        padding: 5px;
        font-size: 14px;
        cursor: pointer;
        z-index: 10;
        /* Đảm bảo nút luôn ở trên cùng */
    }

    /* Khi hover vào nút xóa, thay đổi màu sắc */
    .delete-button:hover {
        background-color: rgba(0, 0, 0, 0.7);
    }

    /* Đảm bảo ảnh/video có kích thước cố định */
    .media-item img,
    .media-item video {
        max-width: 100px;
        max-height: 100px;
        object-fit: cover;
    }

    /* icon  */
    /* Đặt màu sắc nền sáng cho phần container */
    .form1 {
        background-color: #f5f5f5;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        margin-bottom: 15px;
    }

    /* Khung chứa các icon upload với border và kích thước bình thường */
    .upload-icons {
        justify-content: space-between;
        gap: 20px;
        margin-bottom: 20px;
    }

    .upload-icon {
        display: inline-block;
        padding: 6px 12px;
        /* Giảm padding để kích thước nhỏ hơn */
        background-color: transparent;
        color: #007bff;
        /* Màu chữ là màu xanh của nút */
        font-size: 14px;
        /* Giảm kích thước font chữ để giống button */
        font-weight: 600;
        border: 1px solid #007bff;
        /* Viền màu xanh giống btn */
        border-radius: 5px;
        /* Bo góc nhẹ */
        cursor: pointer;
        transition: all 0.3s ease;
        /* Chuyển động nhẹ khi hover */
    }

    .upload-icon i {
        margin-right: 5px;
        /* Giảm khoảng cách giữa icon và chữ */
    }

    /* Kiểu dáng cho phần preview media */
    .preview-container {
        display: flex;
        gap: 15px;
        flex-wrap: wrap;
    }

    .preview-container img,
    .preview-container video {
        width: 120px;
        height: 120px;
        object-fit: cover;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    /* Định dạng thêm cho icon và thẻ label */
    .upload-icon span {
        display: block;
        margin-top: 5px;
        /* Giảm khoảng cách trên giữa icon và text */
        font-size: 12px;
        /* Giảm kích thước font chữ để giống button */
        font-weight: 500;
        color: #007bff;
        /* Giữ màu chữ là màu xanh */
    }

    /* Để giữ thẻ "label" có kiểu dáng giống button */
    .upload-icon:hover {
        background-color: #f0f8ff;
        /* Màu nền sáng khi hover */
        border-color: #0056b3;
        /* Màu viền đậm khi hover */
        color: #0056b3;
        /* Màu chữ đậm khi hover */
    }

    .upload-icon:hover i {
        color: #0056b3;
        /* Màu biểu tượng thay đổi khi hover */
    }
</style>
<?php /**PATH D:\laragon\www\datn\resources\views/orders/show.blade.php ENDPATH**/ ?>