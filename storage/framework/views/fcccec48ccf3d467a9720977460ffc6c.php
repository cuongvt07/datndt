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
                            <li class="breadcrumb-item active" aria-current="page">Tài khoản của tôi</li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container light-style flex-grow-1 container-p-y">
    <h4 class="font-weight-bold py-3 mb-4"></h4>
    <div class="card overflow-hidden">
        <div class="row no-gutters row-bordered row-border-light">
            <div class="col-md-3 pt-0">
                <div class="myaccount-tab-menu nav">
                    <a class="list-group-item list-group-item-action active" data-bs-toggle="list"
                        href="#account-general">Tổng quan</a>
                    <a class="list-group-item list-group-item-action" data-bs-toggle="list"
                        href="#account-change-password">Thay đổi mật khẩu</a>
                    <a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#account-info">Thông
                        tin</a>
                    <a class="list-group-item list-group-item-action" data-bs-toggle="list"
                        href="#account-social-links">Liên kết xã hội</a>
                    <a class="list-group-item list-group-item-action" data-bs-toggle="list"
                        href="#account-connections">Kết nối</a>
                    <a class="list-group-item list-group-item-action" data-bs-toggle="list"
                        href="#account-notifications">Thông báo</a>
                </div>
            </div>
            <div class="col-md-9">
                <div class="tab-content">
                    
                    <div class="tab-pane fade active show" id="account-general">
                        <form method="POST" action="<?php echo e(route('account.update')); ?>" enctype="multipart/form-data"
                            onsubmit="return handleFormSubmit(event)">
                            <?php echo csrf_field(); ?>
                            <div class="card-body media align-items-center">
                                <img src="<?php echo e(Auth::user()->image ? asset(Auth::user()->image) : asset('asset-admin/img/profile.jpg')); ?>"
                                    alt="Profile Image" style="width: 150px;" class="avatar-img rounded-circle" />
                                <div class="media-body ml-4">
                                    <label class="btn btn-outline-primary custom-upload-btn">
                                        Tải ảnh mới
                                        <input type="file" class="d-none" name="image" accept="image/*"
                                            onchange="updateImagePreview(event)">
                                    </label>
                                    &nbsp;
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label ">Tên</label>
                                <input type="text" class="form-control" value="<?php echo e(Auth::user()->name_user); ?>"
                                    name="name_user">
                            </div>
                            <div class="form-group">
                                <label class="">Email</label>
                                <input type="email" name="email" class="form-control"
                                    value="<?php echo e(Auth::user()->email); ?>">
                            </div>

                            <div class="form-group">
                                <label class="form-label ">Giới tính</label>
                                <div class="gender-selection">
                                    <input type="radio" id="male" name="sex" value="male"
                                        <?php echo e(Auth::user()->sex == 'male' ? 'checked' : ''); ?>>
                                    <label for="male" class="gender-label">Nam</label>

                                    <input type="radio" id="female" name="sex" value="female"
                                        <?php echo e(Auth::user()->sex == 'female' ? 'checked' : ''); ?>>
                                    <label for="female" class="gender-label">Nữ</label>

                                    <input type="radio" id="other" name="sex" value="other"
                                        <?php echo e(Auth::user()->sex == 'other' ? 'checked' : ''); ?>>
                                    <label for="other" class="gender-label">Khác</label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label ">Ngày sinh</label>
                                <input type="date" class="form-control mb-1" name="date_of_birth"
                                    value="<?php echo e(Auth::user()->date_of_birth); ?>">
                            </div>

                            <button type="submit" class="btn btn-sqr"
                                style="margin-bottom: 10px;">Lưu thay đổi</button>
                        </form>
                    </div>

                    
                    <div class="tab-pane fade" id="account-change-password">
                        <div class="card-body pb-2">
                            <form method="POST" action="<?php echo e(route('password.change')); ?>"
                                onsubmit="return handlePasswordChange(event)">
                                <?php echo csrf_field(); ?>
                                <div class="form-group">
                                    <label class="">Mật khẩu hiện tại</label>
                                    <input type="password" name="current_password" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label class="">Mật khẩu mới</label>
                                    <input type="password" name="new_password" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label class="">Nhập lại mật khẩu mới</label>
                                    <input type="password" name="new_password_confirmation" class="form-control"
                                        required>
                                </div>
                                <button type="submit" class="btn btn-sqr">Đổi mật
                                    khẩu</button>
                            </form>
                        </div>
                    </div>

                    
                    <div class="tab-pane fade" id="account-info">
                        <div class="card-body pb-2">
                            <div class="form-group">
                                <label class="form-label ">Tiểu sử</label>
                                <textarea class="form-control" rows="5" name="bio"></textarea>
                            </div>
                            <div class="form-group">
                                <label class="form-label ">Ngày sinh</label>
                                <input type="date" class="form-control" name="birthday">
                            </div>
                            <div class="form-group">
                                <label class="form-label ">Quốc gia</label>
                                <select class="custom-select" name="country">
                                    <option>USA</option>
                                    <option>Canada</option>
                                    <option>UK</option>
                                    <option>Germany</option>
                                    <option>France</option>
                                    <option selected>Vietnamese</option>
                                </select>
                            </div>
                        </div>
                        <hr class="border-light m-0">
                        <div class="card-body pb-2">
                            <h6 class="mb-4 ">Liên hệ</h6>
                            <div class="form-group">
                                <label class="form-label ">Điện thoại</label>
                                <input class="form-control" type="tel" id="phone" name="phone" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label ">Trang web</label>
                                <input type="text" class="form-control" name="website">
                            </div>
                        </div>
                    </div>

                    
                    <div class="tab-pane fade" id="account-social-links">
                        <div class="card-body pb-2">
                            <div class="form-group">
                                <label class="form-label ">Twitter</label>
                                <input type="text" class="form-control" value="https://twitter.com/user">
                            </div>
                            <div class="form-group">
                                <label class="form-label ">Facebook</label>
                                <input type="text" class="form-control" value="https://www.facebook.com/user">
                            </div>
                            <div class="form-group">
                                <label class="form-label ">Google+</label>
                                <input type="text" class="form-control" value>
                            </div>
                            <div class="form-group">
                                <label class="form-label ">LinkedIn</label>
                                <input type="text" class="form-control" value>
                            </div>
                            <div class="form-group">
                                <label class="form-label ">Instagram</label>
                                <input type="text" class="form-control" value="https://www.instagram.com/user">
                            </div>
                        </div>
                    </div>

                    
                    <div class="tab-pane fade" id="account-connections">
                        <div class="card-body">
                            <button type="button" class="btn btn-twitter ">Kết nối
                                <strong>Twitter</strong></button>
                        </div>
                        <hr class="border-light m-0">
                        <div class="card-body">
                            <h5 class="mb-2 ">
                                <a href="javascript:void(0)" class="float-right text-muted text-tiny"><i
                                        class="ion ion-md-close"></i> Remove</a>
                                <i class="ion ion-logo-google text-google "></i> Bạn đang kết nối Google:
                            </h5>
                            <a href="/cdn-cgi/l/email-protection" class="__cf_email__"
                                data-cfemail="f9979498818e9c9595b994989095d79a9694">[email&#160;protected]</a>
                        </div>
                        <hr class="border-light m-0">
                        <div class="card-body">
                            <button type="button" class="btn btn-facebook ">Kết nối
                                <strong>Facebook</strong></button>
                        </div>
                        <hr class="border-light m-0">
                        <div class="card-body">
                            <button type="button" class="btn btn-github ">Kết nối
                                <strong>Github</strong></button>
                        </div>
                    </div>

                    
                    <div class="tab-pane fade" id="account-notifications">
                        <div class="card-body">
                            <h5 class="mb-4 ">Thông báo</h5>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="notify1" checked>
                                <label class="form-check-label" for="notify1">Nhận thông báo qua email</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="notify2">
                                <label class="form-check-label" for="notify2">Nhận thông báo qua SMS</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .media {
        display: flex;
        /* Sử dụng Flexbox để sắp xếp các phần tử */
        align-items: center;
        /* Căn giữa theo chiều dọc */
    }

    .avatar-img {
        width: 150px;
        /* Kích thước ảnh đại diện */
        border-radius: 50%;
        /* Để tạo hình tròn cho ảnh */
        margin-right: 15px;
        /* Khoảng cách giữa ảnh và nút */
    }

    .custom-upload-btn {
        position: relative;
        display: inline-block;
        /* Để nút có thể được căn giữa và có padding */
        padding: 10px 20px;
        /* Padding cho nút */
        border: 1px solid #ffcc00;
        /* Màu viền */
        border-radius: 5px;
        /* Bo góc cho nút */
        color: #ffcc00;
        /* Màu chữ */
        background: transparent;
        /* Nền trong suốt */
        cursor: pointer;
        /* Con trỏ thay đổi khi hover */
        transition: background-color 0.3s, color 0.3s;
        /* Hiệu ứng chuyển động */
    }

    .custom-upload-btn:hover {
        background-color: #ff00b3;
        /* Nền khi hover */
        color: white;
        /* Màu chữ khi hover */
    }

    .custom-upload-btn input[type="file"] {
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        cursor: pointer;
        opacity: 0;
        /* Ẩn input file */
    }

    .custom-button1 {
        position: relative;
        display: inline-block;
        /* Để nút có thể được căn giữa và có padding */
        padding: 10px 20px;
        /* Padding cho nút */
        border: 1px solid #ffcc00;
        /* Màu viền */
        border-radius: 5px;
        /* Bo góc cho nút */
        color: #ffcc00;
        /* Màu chữ */
        background: transparent;
        /* Nền trong suốt */
        cursor: pointer;
        /* Con trỏ thay đổi khi hover */
        transition: background-color 0.3s, color 0.3s;
        /* Hiệu ứng chuyển động */
    }

    .btn-outline-primary:hover {
        background-color: #ffcc00;
        color: #ff0000;
        /* Chuyển sang đỏ khi hover */
        border-color: #ff6600;
    }
</style>

<link rel="stylesheet" href="<?php echo e(asset('asset-userr/css/fontawesome.min.css')); ?>">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // Cho tổng quan
    function handleFormSubmit(event) {
        event.preventDefault();
        const form = event.target;


        fetch(form.action, {
                method: 'POST',
                body: new FormData(form),
                headers: {
                    'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Thành công!',
                        text: data.message,
                    }).then(() => {
                        location.href = location.href;
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Lỗi!',
                        text: data.message,
                    });
                }
            })
            .catch(error => {
                Swal.fire({
                    icon: 'error',
                    title: 'Lỗi!',
                    text: 'Đã xảy ra lỗi không mong muốn. Vui lòng thử lại sau.',
                });
            });
    }
    // Cho mật khẩu
    function handlePasswordChange(event) {
        event.preventDefault();
        const form = event.target;


        fetch(form.action, {
                method: 'POST',
                body: new FormData(form),
                headers: {
                    'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Thành công!',
                        text: data.message,
                    }).then(() => {
                        location.reload();
                    });
                } else {
                    // Xử lý các lỗi cụ thể
                    if (data.error === 'current_password') {
                        Swal.fire({
                            icon: 'error',
                            title: 'Lỗi!',
                            text: 'Mật khẩu hiện tại không đúng.',
                        });
                    } else if (data.error === 'confirmation') {
                        Swal.fire({
                            icon: 'error',
                            title: 'Lỗi!',
                            text: 'Mật khẩu xác nhận không trùng khớp.',
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Lỗi!',
                            text: data.message,
                        });
                    }
                }
            })
            .catch(error => {
                Swal.fire({
                    icon: 'error',
                    title: 'Lỗi!',
                    text: 'Đã xảy ra lỗi không mong muốn. Vui lòng thử lại sau.',
                });
            });
    }
</script>

<style> </style>

<?php echo $__env->make('layouts.user.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH D:\laragon\www\datn1\resources\views/user/account/index.blade.php ENDPATH**/ ?>