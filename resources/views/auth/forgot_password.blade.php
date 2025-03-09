@include('layouts.user.header')

{{-- Menu --}}
@include('layouts.user.menu')

{{-- Content --}}
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
                            <h1 class="text-center">Quên mật khẩu</h1>
                            <p class="login-box-msg text-center">Vui lòng nhập thông tin</p>

                            <form action="{{ route('password.email') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="email" class="w3ls">Nhập email của bạn</label>
                                    <input type="email" name="email" id="email" class="form-control" placeholder="Nhập email" required value="{{ old('email') }}">
                                    @error('email')
                                        <p class="error-message" style="color: red;">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Hiển thị thông báo thành công -->
                                @if (session('status'))
                                    <p class="success-message" style="color: green; text-align: center;">{{ session('status') }}</p>
                                @endif

                                <div class="text-center" style="margin-top: 20px;">
                                    <button type="submit" class="reset-password btn btn-danger btn-lg" style="padding: 10px 20px; font-size: 18px; font-weight: bold; transition: background-color 0.3s;">
                                        Gửi liên kết nhập lại mật khẩu
                                    </button>
                                </div>
                                
                            </form>
                        </div>
                    </div>
                </div>
                <div class="form-control w3layouts forgot-password" style="text-align: center; margin-top: 20px;">
                    <a href="{{ route('login') }}" style="color: #007bff;">Quay lại Login</a>
                </div>
            </div>
        </div>
    </div>
</main>

@include('layouts.user.footer')
