 <div class="scroll-top not-visible">
    <i class="fa fa-angle-up"></i>
</div>

<div id="chat-widget">
    <!-- Icon chat -->
    <div id="chat-icon">
        <img src="<?php echo e(asset('asset-user/img/chat/Facebook_messenger_pink_app_icon-removebg-preview.png')); ?>"
            alt="Chat Icon">
        <span id="unread-count" style="display: none;">0</span>
    </div>
    <div id="new-message-notification" style="display: none;">
        <a href="javascript:void(0)">Bạn có tin nhắn mới</a>
    </div>
    <!-- Popup chat -->
    <div id="chat-popup">
        <div id="chat-header">
            <span>Hỗ trợ trực tuyến <img class="iconcd" src="<?php echo e(asset('asset-user/img/chat/Animation - 1732688263923.gif')); ?>" alt=""></span>
            <button id="close-chat"><img class="iconcd" src="<?php echo e(asset('asset-user/img/chat/Animation - 1732689196344.gif')); ?>" alt=""></button>
        </div>
        <iframe id="chat-iframe" src="<?php echo e(route('user.chat')); ?>" frameborder="0"></iframe>
    </div>
</div>




<footer class="footer-widget-area">
    <div class="footer-top section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="widget-item">
                        <div class="widget-title">
                            <div class="logo">
                                <a href="" style="text-decoration: none;">
                                    <h1 style="font-size: 24px; font-weight: bold; color: #ff5722;">PolyTech</h1>
                                </a>
                            </div>
                        </div>
                        <div class="widget-body">
                            <p>Polytech là địa chỉ uy tín chuyên cung cấp các sản phẩm công nghệ chất lượng cao,
                                phù hợp với mọi người dùng.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="widget-item">
                        <h6 class="widget-title">Liên hệ với chúng tôi</h6>
                        <div class="widget-body">
                            <address class="contact-block">
                                <ul>
                                    <li><i class="pe-7s-home"></i> Trịnh Văn Bô, Mỹ Đình, Hà Nội</li>
                                    <li><i class="pe-7s-mail"></i> <a href="mailto:demo@plazathemes.com">nhom1@gmail.com
                                        </a></li>
                                    <li><i class="pe-7s-call"></i> <a href="tel:(012)800456789987">09123456789</a></li>
                                </ul>
                            </address>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="widget-item">
                        <h6 class="widget-title">Thông tin</h6>
                        <div class="widget-body">
                            <ul class="contact-block">
                                <li><a href="#">Về chúng tôi</a></li>
                                <li><a href="#">Chính sách giao hàng</a></li>
                                <li><a href="#">Chính sách bảo mật</a></li>
                                <li><a href="#">Điều khoản và điều kiện</a></li>
                                <li><a href="#">Liên hệ</a></li>
                              
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="widget-item">
                        <h6 class="widget-title">Theo dõi chúng tôi</h6>
                        <div class="widget-body social-link">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-instagram"></i></a>
                            <a href="#"><i class="fa fa-youtube"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row align-items-center mt-20">
                <div class="col-md-6">
                    <div class="newsletter-wrapper">
                        <h6 class="widget-title-text">Đăng ký nhận tin</h6>
                        <form class="newsletter-inner" id="mc-form">
                            <input type="email" class="news-field" id="mc-email" autocomplete="off"
                                placeholder="Enter your email address">
                            <button class="news-btn" id="mc-submit">Đăng ký</button>
                        </form>
                        <!-- mail-chimp-alerts Start -->
                        <div class="mailchimp-alerts">
                            <div class="mailchimp-submitting"></div><!-- mail-chimp-submitting end -->
                            <div class="mailchimp-success"></div><!-- mail-chimp-success end -->
                            <div class="mailchimp-error"></div><!-- mail-chimp-error end -->
                        </div>
                        <!-- mail-chimp-alerts end -->
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="footer-payment">
                        <img src="<?php echo e(asset('asset-user/img/payment.png')); ?>" alt="Phương thức thanh toán">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="copyright-text text-center">
                        <p>&copy; 2024 <b>PolyTech</b> Thiết kế với <i class="fa fa-heart text-danger"></i> bởi
                            NhomWD01.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- footer area end -->
<!-- offcanvas mini cart end -->

<!-- JS
============================================ -->

<!-- Modernizer JS -->
<script src="<?php echo e(asset('asset-user/js/vendor/modernizr-3.6.0.min.js')); ?>"></script>

<!-- jQuery JS -->
<script src="<?php echo e(asset('asset-user/js/vendor/jquery-3.6.0.min.js')); ?>"></script>

<!-- Bootstrap JS -->
<script src="<?php echo e(asset('asset-user/js/vendor/bootstrap.bundle.min.js')); ?>"></script>

<!-- slick Slider JS -->
<script src="<?php echo e(asset('asset-user/js/plugins/slick.min.js')); ?>"></script>

<!-- Countdown JS -->
<script src="<?php echo e(asset('asset-user/js/plugins/countdown.min.js')); ?>"></script>

<!-- Nice Select JS -->
<script src="<?php echo e(asset('asset-user/js/plugins/nice-select.min.js')); ?>"></script>

<!-- jquery UI JS -->
<script src="<?php echo e(asset('asset-user/js/plugins/jqueryui.min.js')); ?>"></script>

<!-- Image zoom JS -->
<script src="<?php echo e(asset('asset-user/js/plugins/image-zoom.min.js')); ?>"></script>

<!-- Images loaded JS -->
<script src="<?php echo e(asset('asset-user/js/plugins/imagesloaded.pkgd.min.js')); ?>"></script>

<!-- mail-chimp active js -->
<script src="<?php echo e(asset('asset-user/js/plugins/ajaxchimp.js')); ?>"></script>

<!-- contact form dynamic js -->
<script src="<?php echo e(asset('asset-user/js/plugins/ajax-mail.js')); ?>"></script>


<script src="<?php echo e(asset('asset-user/js/plugins/google-map.js')); ?>"></script>

<!-- Main JS -->
<script src="<?php echo e(asset('asset-user/js/main.js')); ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>





</body>
<!-- Mirrored from htmldemo.net/corano/corano/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 29 Jun 2024 09:53:43 GMT -->

</html>
<script>
    $(window).scroll(function() {
        if ($(this).scrollTop() > 100) {
            $('.scroll-top').removeClass('not-visible');
        } else {
            $('.scroll-top').addClass('not-visible');
        }
    });

    $('.scroll-top').click(function() {
        $('html, body').animate({
            scrollTop: 0
        }, 600);
        return false;
    });

    $(document).ready(function() {
        const chatPopup = $('#chat-popup');
        const chatIcon = $('#chat-icon');
        const closeChat = $('#close-chat');

        // Hiển thị popup khi nhấn vào icon
        chatIcon.on('click', function() {
            chatPopup.show();
        });

        // Đóng popup khi nhấn vào nút đóng
        closeChat.on('click', function() {
            chatPopup.hide();
        });
    });
    $(document).ready(function() {
        const chatPopup = $('#chat-popup');
        const chatIcon = $('#chat-icon');
        const closeChat = $('#close-chat');
        const notification = $('#new-message-notification');
        const unreadCount = $('#unread-count');
        const chatMessagesContainer = $('#chat-messages-container'); // Thêm container tin nhắn nếu có

        // Kiểm tra xem người dùng có đang ở trang chủ không
        const isHomePage = window.location.pathname === '/' || window.location.pathname === '/member';

        if (!isHomePage) {
            // Nếu không phải trang chủ, ẩn widget và dừng mọi chức năng liên quan đến chat
            $('#chat-widget').hide();
            return; // Không thực hiện các hàm liên quan đến chat
        }

        // Hiển thị popup khi nhấn vào icon
        chatIcon.on('click', function() {
            chatPopup.show(); // Hiển thị popup

            // Gửi yêu cầu tải tin nhắn và luôn cuộn xuống cuối
            fetchUnreadMessages(() => {
                scrollToBottom(); // Tự động cuộn xuống cuối sau khi tin nhắn tải xong
            });

            // Đánh dấu tin nhắn từ admin là đã đọc
            markMessagesAsRead();
        });

        // Đóng popup khi nhấn vào nút đóng
        closeChat.on('click', function() {
            chatPopup.hide();
        });

        // Hàm đánh dấu tin nhắn từ admin là "đã đọc"
        function markMessagesAsRead() {
            $.ajax({
                url: '<?php echo e(route('chat.markRead')); ?>', // Gọi đúng route đã khai báo
                method: 'POST',
                data: {
                    _token: '<?php echo e(csrf_token()); ?>', // Bảo vệ CSRF
                },
                success: function(response) {
                    console.log(response.message);
                    unreadCount.hide(); // Ẩn đếm tin nhắn chưa đọc
                },
                error: function(xhr) {
                    console.error('Không thể đánh dấu tin nhắn là đã đọc.');
                },
            });
        }

        // Hàm fetch tin nhắn chưa đọc và thực thi callback sau khi tải xong
        function fetchUnreadMessages(callback = null) {
            $.ajax({
                url: '<?php echo e(route('user.chat')); ?>?format=json', // API lấy tin nhắn
                method: 'GET',
                success: function(response) {
                    const unreadMessages = response.messages.filter(
                        msg => msg.from_admin === 1 && msg.is_read ===
                        0 // Tin nhắn từ admin chưa đọc
                    );

                    if (unreadMessages.length > 0) {
                        unreadCount.text(unreadMessages.length).show(); // Hiển thị đếm

                        // Nếu popup đang mở, đánh dấu tin nhắn là đã đọc
                        if (chatPopup.is(':visible')) {
                            markMessagesAsRead();
                        } else {
                            showNewMessageNotification(); // Hiển thị thông báo nếu popup chưa mở
                            shakeChatIcon(); // Rung icon chat
                        }
                    } else {
                        unreadCount.hide(); // Ẩn đếm
                    }

                    // Cập nhật danh sách tin nhắn vào container
                    if (response.html) {
                        chatMessagesContainer.html(response.html);

                        // Thực thi callback nếu có (sau khi tải xong)
                        if (typeof callback === 'function') {
                            callback();
                        }
                    }
                },
                error: function() {
                    console.error('Lỗi khi tải tin nhắn.');
                },
            });
        }

        // Hiển thị thông báo tin nhắn mới
        function showNewMessageNotification() {
            notification.show();
            setTimeout(() => {
                notification.hide();
            }, 5000);
        }

        // Rung icon chat khi có tin nhắn mới
        function shakeChatIcon() {
            chatIcon.css('animation', 'shake 0.5s');
            setTimeout(() => {
                chatIcon.css('animation', 'none');
            }, 500);
        }

        // Cuộn đến cuối tin nhắn
        function scrollToBottom() {
            if (chatMessagesContainer.length) {
                chatMessagesContainer.scrollTop(chatMessagesContainer[0].scrollHeight);
            }
        }

        // Kiểm tra tin nhắn chưa đọc khi tải trang (chỉ trên trang chủ)
        fetchUnreadMessages();

        // Kiểm tra tin nhắn mới mỗi  giây (chỉ trên trang chủ)
        setInterval(fetchUnreadMessages, 3000);
    });

    
</script>
<style>
    .iconcd{
        width: 31px;
    }
    .scroll-top {
        bottom: 50px;
        cursor: pointer;
        height: 50px;
        position: fixed;
        right: 20px;
        text-align: center;
        width: 50px;
        z-index: 9999;
        -webkit-transition: 0.4s;
        -o-transition: 0.4s;
        transition: 0.4s;
        border-radius: 50%;
        background-color: #c29958;
        -webkit-box-shadow: 0 0 1px rgba(255, 255, 255, 0.5);
        box-shadow: 0 0 1px rgba(255, 255, 255, 0.5);
    }

    @media only screen and (max-width: 767.98px) {
        .scroll-top {
            display: none;
        }
    }

    .scroll-top i {
        line-height: 50px;
        color: #fff;
        font-size: 25px;
    }

    .scroll-top.not-visible {
        bottom: -50px;
        visibility: hidden;
        opacity: 0;
    }

    .scroll-top:hover {
        background-color: #222222;
    }


    /* Icon chat */
    #chat-icon {
        position: fixed;
        bottom: 118px;
        right: 20px;
        width: 60px;
        height: 60px;
        background-color: #007bff;
        border-radius: 50%;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        z-index: 1000;
    }

    #chat-icon img {
        width: 60px;
        height: 60px;
    }

    /* Popup chat */
    #chat-popup {
        position: fixed;
        bottom: 90px;
        right: 20px;
        width: 400px;
        height: 600px;
        background: #fff;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        display: none;
        /* Ẩn mặc định */
        flex-direction: column;
        overflow: hidden;
        z-index: 1001;
    }

    /* Header của popup */
    #chat-header {
        background: #007bff;
        color: white;
        padding: 10px;
        font-size: 16px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    #chat-header button {
        background: none;
        border: none;
        color: white;
        font-size: 20px;
        cursor: pointer;
    }

    /* iFrame */
    #chat-iframe {
        width: 100%;
        height: calc(100% - 40px);
        /* Trừ chiều cao của header */
        border: none;
    }

    #unread-count {
        position: absolute;
        top: 5px;
        right: 5px;
        background: red;
        color: white;
        font-size: 12px;
        border-radius: 1000px;
        padding: 2px 6px;
        display: none;
        width: 20px;
        height: 20px;
    }

    /* Notification */
    #new-message-notification {
        position: fixed;
        bottom: 128px;
        right: 80px;
        background: #f0ad4e;
        color: white;
        padding: 10px;
        border-radius: 5px;
        z-index: 1001;
        animation: slideIn 0.5s forwards, slideOut 3s 5s forwards;
    }

    /* Popup chat */
    #chat-popup {
        position: fixed;
        bottom: 90px;
        right: 20px;
        width: 400px;
        height: 600px;
        background: #fff;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        display: none;
        flex-direction: column;
        overflow: hidden;
        z-index: 1001;
        animation: none;
    }

    /* Animations */
    @keyframes slideIn {
        from {
            transform: translateX(100%);
        }

        to {
            transform: translateX(0);
        }
    }

    @keyframes slideOut {
        from {
            transform: translateX(0);
        }

        to {
            transform: translateX(100%);
        }
    }

    @keyframes shake {

        0%,
        100% {
            transform: translateX(0);
        }

        25%,
        75% {
            transform: translateX(-5px);
        }

        50% {
            transform: translateX(5px);
        }
    }
</style>
<?php /**PATH C:\laragon\www\datn\resources\views/layouts/user/footer.blade.php ENDPATH**/ ?>