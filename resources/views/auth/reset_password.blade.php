@include('layouts.user.header')

{{-- Menu  --}}
@include('layouts.user.menu')

{{-- Content  --}}
<div class="breadcrumb-area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb-wrap">
                    <nav aria-label="breadcrumb">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href=""><i class="fa fa-home"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Đăng nhập</li>
                            <li class="breadcrumb-item active" aria-current="page">Quên mật khẩu</li>
                            <li class="breadcrumb-item active" aria-current="page">Lấy lại mật khẩu</li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>

<main>
    <div class="login-register-wrapper section-padding">
        <div class="container" style="max-width: 40vw;">
            <div class="member-area-from-wrap">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="login-reg-form-wrap">
                            @if (session('status'))
                                <p class="success-message alert alert-success">{{ session('status') }}</p>
                            @endif

                            <h1 class="text-center" style="margin-bottom: 30px;">Đặt lại mật khẩu</h1>
                            <p class="login-box-msg text-center" style="margin-bottom: 20px;">Vui lòng nhập thông tin
                                của bạn</p>

                            <form method="POST" action="{{ route('password.update') }}">
                                @csrf
                                <input type="hidden" name="token" value="{{ $token }}">

                                <!-- Email -->
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" name="email" id="email"
                                        placeholder="Nhập email" value="{{ $email ?? old('email') }}" required>
                                    @error('email')
                                        <p class="error-message text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- New Password -->
                                <!-- Email Field (No changes here) -->

                                <!-- New Password Field -->
                                <div class="form-group password-container">
                                    <label for="password1">Mật khẩu mới</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" id="password1" name="password"
                                            placeholder="Mật khẩu mới" required>
                                        <div class="input-group-append">
                                            <span class="input-group-text eye-icon-container">
                                                <i class="fa fa-eye" id="togglePassword1"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Confirm Password Field -->
                                <div class="form-group password-container">
                                    <label for="password2">Xác nhận mật khẩu mới</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" id="password2"
                                            name="password_confirmation" placeholder="Xác nhận mật khẩu mới" required>
                                        <div class="input-group-append">
                                            <span class="input-group-text eye-icon-container">
                                                <i class="fa fa-eye" id="togglePassword2"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>


                                <!-- Submit Button -->
                                <div class="text-center" style="margin-top: 20px;">
                                    <button type="submit" class="btn btn-danger btn-lg"
                                        style="padding: 10px 20px; font-size: 18px; font-weight: bold;">
                                        Đặt lại mật khẩu
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="text-center" style="margin-top: 20px;">
                    <a href="{{ route('password.email') }}">Quay lại</a>
                </div>
            </div>
        </div>
    </div>
</main>

<script type="text/javascript">
    window.onload = function() {
        document.getElementById("password1").onchange = validatePassword;
        document.getElementById("password2").onchange = validatePassword;
    }

    function validatePassword() {
        var pass1 = document.getElementById("password1").value;
        var pass2 = document.getElementById("password2").value;
        if (pass1 != pass2)
            document.getElementById("password2").setCustomValidity("Mật khẩu không khớp");
        else
            document.getElementById("password2").setCustomValidity('');
    }

    // Toggle Password Visibility
    const togglePassword1 = document.querySelector('#togglePassword1');
    const password1 = document.querySelector('#password1');

    togglePassword1.addEventListener('click', function() {
        const type = password1.getAttribute('type') === 'password' ? 'text' : 'password';
        password1.setAttribute('type', type);
        this.classList.toggle('fa-eye-slash');
    });

    const togglePassword2 = document.querySelector('#togglePassword2');
    const password2 = document.querySelector('#password2');

    togglePassword2.addEventListener('click', function() {
        const type = password2.getAttribute('type') === 'password' ? 'text' : 'password';
        password2.setAttribute('type', type);
        this.classList.toggle('fa-eye-slash');
    });
</script>
<style>
    /* CSS để căn chỉnh biểu tượng mắt */
.eye-icon-container {
    cursor: pointer;
    background-color: transparent; /* Không có màu nền để giữ nút trong suốt */
    border: none; /* Xóa viền */
    padding: 0 10px;
}

.eye-icon-container i {
    font-size: 18px; /* Điều chỉnh kích thước biểu tượng */
    color: #333; /* Đổi màu cho biểu tượng mắt */
}

.eye-icon-container:hover i {
    color: #007bff; /* Đổi màu khi hover */
}

.input-group-append {
    display: flex;
    align-items: center; /* Căn giữa biểu tượng mắt theo chiều dọc */
}

</style>
@include('layouts.user.footer')
