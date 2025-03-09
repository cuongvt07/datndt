<?php $__env->startSection('content'); ?>
    <div class="chat-container" style="display: flex;">
        <!-- Thanh bên trái (Danh sách người dùng) -->
        <div class="chat-sidebar"
            style="width: 300px; border-right: 1px solid #ddd; overflow-y: auto; padding: 10px; background-color: #f8f9fa;">
            <h5 style="margin-bottom: 20px;">Danh sách người dùng</h5>
            <div id="chat-user-list-container">
                <?php echo $__env->make('admin.chat.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> <!-- Tải lần đầu -->
            </div>
        </div>

        <!-- Phần khung chat bên phải -->
        <div class="chat-main" style="flex-grow: 1; display: flex; flex-direction: column;">

        </div>
    </div>

    <!-- JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Lưu trữ trạng thái active để áp dụng lại sau reload
            function reloadChatSidebar() {
                // Lấy ID và type của mục đang active
                var activeItem = $('.chat-user-item.active .chat-user-link');
                var activeId = activeItem.data('id');
                var activeType = activeItem.data('type');

                $.ajax({
                    url: "<?php echo e(route('admin.chat.sidebar')); ?>",
                    method: "GET",
                    success: function(data) {
                        // Cập nhật danh sách người dùng
                        $('#chat-user-list-container').html(data);

                        // Áp dụng lại trạng thái active nếu còn tồn tại
                        if (activeId && activeType) {
                            $('.chat-user-link').each(function() {
                                if ($(this).data('id') == activeId && $(this).data('type') ==
                                    activeType) {
                                    $(this).closest('.chat-user-item').addClass('active');
                                }
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Không thể tải danh sách người dùng:', error);
                    }
                });
            }

            // Gắn sự kiện click thông qua event delegation
            $('#chat-user-list-container').on('click', '.chat-user-link', function() {
                var id = $(this).data('id'); // ID người dùng hoặc session
                var type = $(this).data('type'); // Kiểu (user hoặc session)

                // Đảm bảo xóa trạng thái active của tất cả mục khác
                $('.chat-user-item').removeClass('active');
                $(this).closest('.chat-user-item').addClass('active');

                // Gọi AJAX chỉ cho ID và type hiện tại
                $.ajax({
                    url: '<?php echo e(route('admin.chat.view', ['id' => '__ID__', 'type' => '__TYPE__'])); ?>'
                        .replace('__ID__', id)
                        .replace('__TYPE__', type),
                    method: 'GET',
                    success: function(response) {
                        $('.chat-main').html(response); // Hiển thị nội dung
                    },
                    error: function() {
                        alert("Có lỗi xảy ra khi tải tin nhắn.");
                    }
                });
            });


        });

        function reloadChatSidebar() {
            var activeUserId = $('.chat-user-item.active .chat-user-link').data('id');
            var activeType = $('.chat-user-item.active .chat-user-link').data('type');

            $.ajax({
                url: "<?php echo e(route('admin.chat.sidebar')); ?>",
                method: "GET",
                success: function(data) {
                    $('#chat-user-list-container').html(data);

                    // Đặt lại trạng thái active
                    $('#chat-user-list-container .chat-user-link').each(function() {
                        if ($(this).data('id') === activeUserId && $(this).data('type') ===
                            activeType) {
                            $(this).closest('.chat-user-item').addClass('active');
                        }
                    });
                },
                error: function(xhr, status, error) {
                    console.error('Không thể tải danh sách người dùng:', error);
                }
            });

        }

        var isUserTyping = false;

        $('#chat-message').on('focus', function() {
            isUserTyping = true;
        }).on('blur', function() {
            isUserTyping = false;
        });

        setInterval(function() {
            if (!isUserTyping) {
                reloadChatSidebar();
            }
        }, 3000);
    </script>

   


    <style>
        .chat-user-link:hover {
            background-color: #e9ecef !important;
            border-color: #ccc !important;
            box-shadow: 5px 5px 5px;

        }

        .chat-user-item.active .chat-user-link {
            background-color: #007bff !important;
            color: #ffffff !important;
            border-color: #0056b3 !important;
            box-shadow: 5px 5px 5px
        }

        .chat-user-link {
            box-shadow: 5px 5px 5px
        }
    </style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\LARAGON-PHP2\laragon\www\datn\resources\views/admin/chat/index.blade.php ENDPATH**/ ?>