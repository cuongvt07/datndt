<?php echo $__env->make('layouts.user.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<?php echo $__env->make('layouts.user.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<main>
    <!-- breadcrumb area start -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-wrap">
                        <nav aria-label="breadcrumb">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href=""><i class="fa fa-home"></i></a></li>
                                <li class="breadcrumb-item active" aria-current="page">Đăng nhập</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb area end -->

    <!-- login register wrapper start -->
    <div class="login-register-wrapper section-padding">
        <div class="container" style="max-width: 40vw;">
            <div class="member-area-from-wrap">
                <div class="row">
                    <!-- Login Content Start -->
                    <div class="col-lg-12">
                        <div class="login-reg-form-wrap">
                            <?php if(session('status')): ?>
                                <div class="alert alert-success">
                                    <?php echo e(session('status')); ?>

                                </div>
                            <?php endif; ?>
                            <h1 class="text-center">Đăng nhập</h1>

                            <p class="login-box-msg text-center">Vui lòng đăng nhập</p>

                            <!-- <p class="login-box-msg text-center">Vui lòng đăng nhập</p> -->
                            <form action="<?php echo e(route('login')); ?>" method="POST">
                                <?php echo csrf_field(); ?>

                                <div class="single-input-item">
                                    <input type="email" name="email" id="email" placeholder="Nhập email"
                                        required value="<?php echo e(old('email')); ?>">
                                    <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <p class="error-message"><?php echo e($message); ?></p>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="single-input-item">
                                    <div class="input-group">
                                        <input type="password" name="password" id="password1"
                                            placeholder="Nhập mật khẩu" required>
                                        <span class="input-group-text" id="togglePassword">
                                            <i class="fa fa-eye" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <p class="error-message"><?php echo e($message); ?></p>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>

                                <div class="single-input-item">
                                    <div class="login-reg-form-meta d-flex align-items-center justify-content-between">
                                        <a href="<?php echo e(route('password.email')); ?>" class="forget-pwd">Quên mật khẩu?</a>
                                    </div>
                                    <div class="login-reg-form-meta mt-2">
                                        <a href="<?php echo e(route('register')); ?>" class="forget-pwd">Bạn chưa có tài khoản?</a>
                                    </div>
                                </div>


                                <div class="single-input-item">
                                    <button type="submit" style="width: -webkit-fill-available;" class="login btn btn-sqr">Đăng nhập </button>

                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- Login Content End -->
                </div>
            </div>
        </div>
    </div>
    <!-- login register wrapper end -->
</main>
<script>
    const togglePassword = document.querySelector('#togglePassword');
    const password = document.querySelector('#password1');

    togglePassword.addEventListener('click', function(e) {
        // Toggle the type attribute
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);

        // Toggle the eye icon
        this.querySelector('i').classList.toggle('fa-eye-slash');
    });
</script>

<style>
    .error-message {
    color: red; /* Màu chữ đỏ cho thông báo lỗi */
    font-weight: bold; /* Đậm chữ */
    background-color: #f8d7da; /* Màu nền nhẹ nhàng cho thông báo lỗi */
    border: 1px solid #f5c6cb; /* Đường viền màu hồng nhạt */
    padding: 10px; /* Padding cho khoảng cách bên trong thông báo */
    border-radius: 5px; /* Bo góc cho thông báo */
    margin-top: 5px; /* Khoảng cách phía trên */
    text-align: center; /* Canh giữa chữ */
}

    .input-group {
        position: relative;
        display: flex;
        align-items: center;
        /* Căn giữa icon với input */
    }

    .input-group input {
        width: 100%;
        /* Đảm bảo input chiếm toàn bộ chiều rộng */
        padding-right: 40px;
        /* Thêm khoảng trống cho icon */
    }

    .input-group-text {
        position: absolute;
        /* Định vị icon mắt */
        right: 10px;
        /* Khoảng cách từ bên phải */
        cursor: pointer;
        /* Hiển thị con trỏ chuột khi hover */
        background: transparent;
        /* Không có nền */
        border: none;
        /* Không có viền */
        outline: none;
        /* Không có viền khi focus */
        color: #666;
        /* Màu sắc cho icon */
    }
</style>
<?php echo $__env->make('layouts.user.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH D:\ProjectDT\datn\datn\resources\views/auth/login.blade.php ENDPATH**/ ?>