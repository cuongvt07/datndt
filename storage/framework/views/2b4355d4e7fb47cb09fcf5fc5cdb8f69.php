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
                                <li class="breadcrumb-item"><a href="<?php echo e(route('index')); ?>"><i class="fa fa-home"></i></a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Liên hệ với chúng tôi</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb area end -->

    <!-- google map start -->
    <div class="map-area section-padding">
        <div id="google-map"></div>
    </div>
    <!-- google map end -->

    <!-- contact area start -->
    <div class="contact-area section-padding pt-0">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="contact-message" style="margin-right: 50px;">
                        <h4 class="contact-title">Chúng tôi lắng nghe lời khuyên của bạn</h4>
                        <form id="contact-form" action="https://whizthemes.com/mail-php/genger/mail.php" method="post"
                            class="contact-form">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <input name="first_name" placeholder="Tên *" type="text" required>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <input name="phone" placeholder="Số điện thoại *" type="text" required>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <input name="email_address" placeholder="Email *" type="text" required>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <input name="contact_subject" placeholder="Chủ thể *" type="text">
                                </div>
                                <div class="col-12">
                                    <div class="contact2-textarea text-center">
                                        <textarea placeholder="Tin nhắn *" name="message" class="form-control2" required=""></textarea>
                                    </div>
                                    <div class="contact-btn">
                                        <button class="btn btn-sqr" type="submit">Gửi tin nhắn</button>
                                    </div>
                                </div>
                                <div class="col-12 d-flex justify-content-center">
                                    <p class="form-messege"></p>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="contact-info">
                        <h5 class="contact-title">Chính sách bảo mật</h5>
                        <p>Chúng tôi cam kết bảo vệ quyền riêng tư và bảo mật thông tin của khách hàng. Chính sách bảo
                            mật của chúng tôi được thiết kế để bảo vệ các thông tin cá nhân mà bạn cung cấp khi sử dụng
                            dịch vụ của chúng tôi. Chúng tôi đảm bảo rằng thông tin của bạn sẽ được lưu trữ an toàn và
                            chỉ sử dụng cho mục đích cung cấp dịch vụ, không chia sẽ với bên thứ ba mà không có sự đồng
                            ý của bạn.
                        </p>
                        <h5 class="contact-title">Chính sách bảo hành</h5>
                        <p>
                            Chúng tôi cam kết bảo hành sản phẩm trong 12 tháng kể từ ngày mua hàng đối với các lỗi kỹ
                            thuật do nhà sản xuất. Chính sách bảo hành áp dụng khi sản phẩm còn trong thời gian bảo hành
                            và không bị hư hỏng do va đập, rơi vỡ hoặc sử dụng sai cách. Nếu sản phẩm gặp lỗi kỹ thuật,
                            khách hàng vui lòng liên hệ trung tâm bảo hành và cung cấp hóa đơn mua hàng để được kiểm
                            tra, sửa chữa hoặc thay thế miễn phí. Chúng tôi sẽ xử lý nhanh chóng và minh bạch mọi yêu
                            cầu bảo hành, đảm bảo quyền lợi của khách hàng.

                        </p>
                        <h5 class="contact-title">Thông tin liên hệ</h5>
                        <ul>
                            <li><i class="fa fa-fax"></i>Địa chỉ: Trịnh Văn Bô, Mỹ Đình, Hà Nội</li>
                            <li><i class="fa fa-phone"></i> E-mail: nhom1@gmail.com</li>
                            <li><i class="fa fa-envelope-o"></i> + 09123456789</li>
                        </ul>
                        <div class="working-time">
                            <h6>Giờ làm việc</h6>
                            <p><span>Thứ Hai – Thứ Bảy:</span>08AM – 22PM</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- contact area end -->
</main>

<!-- google map api -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCfmCVTjRI007pC1Yk2o2d_EhgkjTsFVN8"></script>
<!-- google map active js -->
<?php echo $__env->make('layouts.user.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH C:\laragon\www\datn\resources\views/user/contact.blade.php ENDPATH**/ ?>