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
                            @if (session('status'))
                                <div class="alert alert-success">
                                    {{ session('status') }}
                                </div>
                            @endif
                            <h1 class="text-center">Đăng nhập</h1>

                            <p class="login-box-msg text-center">Vui lòng đăng nhập</p>

                            <!-- <p class="login-box-msg text-center">Vui lòng đăng nhập</p> -->
                            <form action="{{ route('login') }}" method="POST">
                                @csrf

                                <div class="single-input-item">
                                    <input type="email" name="email" id="email" placeholder="Nhập email"
                                        required value="{{ old('email') }}">
                                    @error('email')
                                        <p class="error-message">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="single-input-item">
                                    <div class="input-group">
                                        <input type="password" name="password" id="password1"
                                            placeholder="Nhập mật khẩu" required>
                                        <span class="input-group-text" id="togglePassword">
                                            <i class="fa fa-eye" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    @error('password')
                                        <p class="error-message">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="single-input-item">
                                    <div class="login-reg-form-meta d-flex align-items-center justify-content-between">
                                        <a href="{{ route('password.email') }}" class="forget-pwd">Quên mật khẩu?</a>
                                    </div>
                                    <div class="login-reg-form-meta mt-2">
                                        <a href="{{ route('register') }}" class="forget-pwd">Bạn chưa có tài khoản?</a>
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
@include('layouts.user.footer')
