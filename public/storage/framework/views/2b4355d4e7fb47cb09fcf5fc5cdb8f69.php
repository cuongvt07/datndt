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
                                <li class="breadcrumb-item"><a href="<?php echo e(route('index')); ?>"><i class="fa fa-home"></i></a></li>
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
                    <div class="contact-message">
                        <h4 class="contact-title">Hãy cho chúng tôi biết dự án của bạn</h4>
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
                        <h4 class="contact-title">Liên hệ với chúng tôi</h4>
                        <p>Sự rõ ràng cũng là một quá trình năng động tuân theo những thói quen luôn thay đổi của người
                            đọc.
                            Thật đáng ngạc nhiên khi lưu ý rằng văn học Gothic,
                            thứ mà ngày nay chúng ta cho là ít rõ ràng, đã có trước các hình thức văn học của con người.
                        </p>
                        <ul>
                            <li><i class="fa fa-fax"></i>Địa chỉ: Số 40 Đường Baria 133/2 Thành phố NewYork</li>
                            <li><i class="fa fa-phone"></i> E-mail: info@yourdomain.com</li>
                            <li><i class="fa fa-envelope-o"></i> +88013245657</li>
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