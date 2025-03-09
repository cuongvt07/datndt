<?php echo $__env->make('layouts.user.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<?php echo $__env->make('layouts.user.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<main>
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-wrap">
                        <nav aria-label="breadcrumb">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href=""><i class="fa fa-home"></i></a></li>
                                <li class="breadcrumb-item active" aria-current="page">Đăng ký</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="login-register-wrapper section-padding">
        <div class="container" style="max-width: 40vw;">
            <div class="member-area-from-wrap">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="login-reg-form-wrap sign-up-form">
                            <h5>Đăng ký</h5>
                            <?php if($errors->any()): ?>
                            <div class="alert alert-danger" style="color:red">
                                <ul>
                                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li><?php echo e($error); ?></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                        <?php endif; ?>
            
                        <?php if(session('success')): ?>
                            <div class="alert alert-success">
                                <?php echo e(session('success')); ?>

                            </div>
                        <?php endif; ?>
                            <form action="<?php echo e(route('register')); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <div class="single-input-item">
                                    <input type="text" placeholder="Họ tên đầy đủ" name="name_user" id="firstname" required />
                                </div>
                                <div class="single-input-item">
                                    <input type="email" name="email" id="email" placeholder="Nhập email của bạn" required />
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="single-input-item input-group"> 
                                            <input type="password" name="password" id="password1" placeholder="Nhập mật khẩu" required />
                                            <span class="input-group-text" id="togglePassword1">
                                                <i class="fa fa-eye" aria-hidden="true"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="single-input-item input-group"> 
                                            <input type="password" name="password_confirmation" id="password2" placeholder="Xác nhận mật khẩu" required />
                                            <span class="input-group-text" id="togglePassword2">
                                                <i class="fa fa-eye" aria-hidden="true"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="single-input-item">
                                    <div class="login-reg-form-meta d-flex align-items-center justify-content-between">
                                        <a href="<?php echo e(route('login')); ?>" class="forget-pwd">Bạn đã có tài khoản ?</a>
                                    </div>
                                </div>
                                <div class="single-input-item" >
                                    <button type="submit" style="width: -webkit-fill-available;" class="register btn btn-sqr">Đăng ký</button>
                                    
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
    // Chức năng hiển thị/ẩn mật khẩu cho password1
const togglePassword1 = document.querySelector('#togglePassword1');
const password1 = document.querySelector('#password1');

togglePassword1.addEventListener('click', function(e) {
    const type = password1.getAttribute('type') === 'password' ? 'text' : 'password';
    password1.setAttribute('type', type);
    this.querySelector('i').classList.toggle('fa-eye-slash');
});

// Chức năng hiển thị/ẩn mật khẩu cho password2
const togglePassword2 = document.querySelector('#togglePassword2');
const password2 = document.querySelector('#password2');

togglePassword2.addEventListener('click', function(e) {
    const type = password2.getAttribute('type') === 'password' ? 'text' : 'password';
    password2.setAttribute('type', type);
    this.querySelector('i').classList.toggle('fa-eye-slash');
});

</script>
<script type="text/javascript">
    window.onload = function() {
        document.getElementById("password1").onchange = validatePassword;
        document.getElementById("password2").onchange = validatePassword;
    }

    function validatePassword() {
        var pass2 = document.getElementById("password2").value;
        var pass1 = document.getElementById("password1").value;
        if (pass1 != pass2)
            document.getElementById("password2").setCustomValidity("Mật khẩu không khớp");
        else
            document.getElementById("password2").setCustomValidity('');
    }

    // Chức năng hiển thị/ẩn mật khẩu
    const togglePassword1 = document.querySelector('#togglePassword1');
    const password1 = document.querySelector('#password1');

    togglePassword1.addEventListener('click', function(e) {
        const type = password1.getAttribute('type') === 'password' ? 'text' : 'password';
        password1.setAttribute('type', type);
        this.classList.toggle('fa-eye-slash');
    });

    const togglePassword2 = document.querySelector('#togglePassword2');
    const password2 = document.querySelector('#password2');

    togglePassword2.addEventListener('click', function(e) {
        const type = password2.getAttribute('type') === 'password' ? 'text' : 'password';
        password2.setAttribute('type', type);
        this.classList.toggle('fa-eye-slash');
    });
</script>
<style>
   .input-group {
    position: relative;
    display: flex;
    align-items: center;
}

.input-group input {
    width: 100%;
    padding-right: 40px; /* Đảm bảo có không gian cho icon */
}

.input-group-text {
    position: absolute;
    right: 10px; /* Điều chỉnh khoảng cách từ bên phải */
    cursor: pointer;
    background: transparent;
    border: none;
    outline: none;
    color: #666; /* Màu sắc cho icon */
    padding: 0; /* Xóa padding để căn chỉnh đúng */
}

</style>
<?php echo $__env->make('layouts.user.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH D:\LARAGON-PHP2\laragon\www\datn\resources\views/auth/register.blade.php ENDPATH**/ ?>