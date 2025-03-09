<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

<iframe id="chat-history-iframe" src="{{ route('admin.chat.refresh', ['id' => $id, 'type' => $type]) }}" frameborder="0"
    style="width: 100%; height: 500px;"></iframe>


<form class="chat-footer" id="chat-form" action="{{ route('admin.chat.send', ['id' => $id, 'type' => $type]) }}"
    method="POST" enctype="multipart/form-data">
    @csrf
    <label for="file-input" class="file-input-label">
        <i class="fas fa-paperclip"></i>
    </label>
    <input type="file" id="file-input" name="media[]" accept="image/*,video/*" multiple hidden>
    <textarea name="message" id="chat-message" class="chat-input" placeholder="Nhập tin nhắn..."></textarea>
    <button type="submit" class="btn-send">
        <i class="fas fa-paper-plane"></i>
    </button>
</form>
<div class="preview-container">
    <div id="preview-wrapper" class="preview-wrapper"></div>
    <div class="preview-add-wrapper visible">
        <div class="preview-add">+</div>
    </div>
</div>
<input type="file" id="file-input" name="media[]" accept="image/*" multiple hidden>




<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        const previewWrapper = $('#preview-wrapper');
        const fileInput = $('#file-input');
        const previewAddWrapper = $('.preview-add-wrapper');

        $('#chat-form').on('submit', function(e) {
            e.preventDefault(); // Ngăn form gửi theo cách thông thường

            let formData = new FormData(this);

            // Lấy các file từ vùng xem trước và thêm vào formData
            previewWrapper.find('.preview-item img').each(function() {
                const file = $(this).data('file');
                if (file) {
                    formData.append('media[]', file);
                }
            });

            let url = $(this).attr('action'); // Lấy URL từ action của form

            $.ajax({
                url: url,
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    // Xóa nội dung input và khu vực xem trước sau khi gửi thành công
                    $('#chat-message').val('');
                    fileInput.val('');
                    previewWrapper.empty();
                    togglePreviewAddVisibility();

                    // Thêm tin nhắn mới vào danh sách tin nhắn
                    if (response.message) {
                        $('#chat-history').append(`
                        <div class="chat-message from-admin">
                            <p class="chat-sender">Admin</p>
                            <div class="chat-content">
                                <p class="chat-text">${response.message}</p>
                            </div>
                            <small class="chat-timestamp">${response.timestamp}</small>
                        </div>
                    `);
                    }

                    if (response.media) {
                        response.media.forEach(media => {
                            $('#chat-history').append(`
                            <div class="chat-message from-admin">
                                <p class="chat-sender">Admin</p>
                                <div class="chat-content">
                                    ${
                                        media.type.startsWith('image')
                                            ? `<img src="${media.url}" class="chat-media" />`
                                            : `<video controls class="chat-media"><source src="${media.url}" type="${media.type}"></video>`
                                    }
                                </div>
                                <small class="chat-timestamp">${response.timestamp}</small>
                            </div>
                        `);
                        });
                    }

                    // Cuộn xuống cuối cùng
                    $('#chat-history').scrollTop($('#chat-history')[0].scrollHeight);
                },
                error: function(xhr) {
                    alert('Đã xảy ra lỗi khi gửi tin nhắn. Vui lòng thử lại.');
                },
            });
        });

        // Xử lý khi chọn file
        fileInput.on('change', function(event) {
            const files = Array.from(event.target.files);

            files.forEach(file => {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const previewItem = $(`
                    <div class="preview-item">
                        <img src="${e.target.result}" alt="Preview" class="preview-image" data-file="${file.name}">
                        <button class="preview-remove">&times;</button>
                    </div>
                `);

                    // Gắn file vào phần tử DOM
                    previewItem.find('.preview-image').data('file', file);

                    // Xóa ảnh khi nhấn nút xóa
                    previewItem.find('.preview-remove').on('click', function() {
                        previewItem.remove();
                        togglePreviewAddVisibility();
                    });

                    // Thêm ảnh vào danh sách
                    previewWrapper.append(previewItem);
                    togglePreviewAddVisibility();
                };

                reader.readAsDataURL(file);
            });

            // Reset input để chọn lại file
            fileInput.val('');
        });

        // Hiển thị hoặc ẩn nút [+] dựa trên số lượng ảnh/video trong danh sách xem trước
        function togglePreviewAddVisibility() {
            if (previewWrapper.find('.preview-item').length > 0) {
                previewAddWrapper.addClass('visible').removeClass('hidden');
            } else {
                previewAddWrapper.addClass('hidden').removeClass('visible');
            }
        }

        // Gọi hàm kiểm tra trạng thái khi trang tải xong
        togglePreviewAddVisibility();

        // Mở file input khi nhấn nút [+]
        previewAddWrapper.on('click', function() {
            fileInput.click();
        });
    });
</script>

<script>
    setInterval(function() {
        const iframe = document.getElementById('chat-history-iframe');
        const iframeDoc = iframe.contentDocument || iframe.contentWindow.document;

        // Lấy URL hiện tại của iframe
        const currentUrl = iframe.src;

        // Sử dụng AJAX để tải nội dung mới
        $.ajax({
            url: currentUrl,
            type: 'GET',
            success: function(data) {
                // Cập nhật nội dung iframe mà không tải lại toàn bộ
                iframeDoc.open();
                iframeDoc.write(data);
                iframeDoc.close();

                // Cuộn xuống cuối iframe sau khi nội dung được tải lại
                const iframeWindow = iframe.contentWindow || iframe.contentDocument.defaultView;
                iframeWindow.scrollTo(0, iframeWindow.document.body.scrollHeight);
            },
            error: function(xhr) {
                console.error('Lỗi khi tải nội dung iframe:', xhr);
            }
        });
    }, 3000);
</script>

<style>
    /* Giao diện tổng thể */
    .chat-history {
        height: 520px;
        background: white;
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 15px;
        overflow-y: auto;
        width: 954px;
    }

    .chat-message {
        margin-bottom: 20px;
        display: flex;
        flex-direction: column;
        align-items: flex-start;
    }

    .chat-message.from-admin {
        align-items: flex-end;
        /* Đẩy tin nhắn của admin sang phải */
    }

    /* Tên người gửi */
    .chat-sender {
        font-size: 0.9rem;
        font-weight: bold;
        color: #555;
        margin-bottom: 5px;
    }

    .chat-message.from-admin .chat-sender {
        text-align: right;
        /* Tên người gửi căn phải cho admin */
    }

    /* Nội dung tin nhắn */
    .chat-content {
        display: inline-block;
        max-width: 70%;
        padding: 0.5px 6px;
        border-radius: 12px;
        /* Viền thon hơn */
        border: 1px solid #ddd;
        background: #e4e6eb;
        color: #333;
        word-wrap: break-word;
        box-shadow: 0px 3px 6px rgba(0, 0, 0, 0.1);
        /* Độ bóng */
    }

    .chat-message.from-admin .chat-content {
        background: #0078ff;
        color: white;
        border: 1px solid #005bb5;
        /* Viền tin nhắn admin */
        text-align: left;
    }

    /* Media không viền màu */
    .chat-media-wrapper {
        margin-top: 10px;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .chat-media {
        width: 600px;
        border-radius: 16px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        /* Bóng nhẹ */
    }

    /* Thời gian gửi */
    .chat-timestamp {
        font-size: 0.8rem;
        color: #aaa;
        margin-top: 5px;
    }

    .chat-message.from-admin .chat-timestamp {
        text-align: right;
        /* Thời gian căn phải cho admin */
    }

    /* Form gửi tin nhắn */
    .chat-footer {
        margin-top: 10px;
        display: flex;
        align-items: center;
        gap: 10px;
        background-color: white;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 8px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }

    .chat-input {
        flex: 1;
        border: 1px solid #ddd;
        border-radius: 20px;
        align-content: center;
        resize: none;
        font-size: 1rem;
        outline: none;
    }

    .btn-send {
        background: none;
        border: none;
        font-size: 1.5rem;
        color: #0078ff;
        cursor: pointer;
    }

    .btn-send:hover {
        color: #005bb5;
    }

    .file-input-label {
        font-size: 1.5rem;
        color: #0078ff;
        cursor: pointer;
    }

    .file-input-label:hover {
        color: #005bb5;
    }

    p {
        position: relative;
        top: 5px;
    }

    .fa,
    .fas {
        font-size: 24px;
    }

    /* Container chính */
    .preview-container {
        display: flex;
        flex-wrap: wrap;
        /* Tự xuống dòng nếu vượt chiều rộng */
        gap: 10px;
        /* Khoảng cách giữa các phần tử */
        margin-top: 10px;
        align-items: flex-start;
    }

    /* Wrapper chứa ảnh */
    .preview-wrapper {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
        /* Đảm bảo xuống dòng khi quá nhiều ảnh */
    }

    /* Ảnh xem trước */
    .preview-item {
        width: 100px;
        height: 100px;
        position: relative;
        border-radius: 8px;
        display: flex;
        justify-content: center;
        align-items: center;
        overflow: hidden;
    }

    .preview-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border: 1px solid #ddd;
        border-radius: 8px;
    }

    /* Nút xóa ảnh */
    .preview-remove {
        position: absolute;
        top: -2px;
        right: -1px;
        width: 20px;
        height: 20px;
        background: #ff4d4d;
        color: white;
        font-size: 14px;
        border-radius: 50%;
        border: 2px solid white;
        cursor: pointer;
        display: flex;
        justify-content: center;
        align-items: center;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        z-index: 10;
        /* Đảm bảo luôn nằm trên ảnh */
    }

    /* Nút [+] */
    .preview-add-wrapper {
        width: 100px;
        height: 100px;
        display: flex;
        justify-content: center;
        align-items: center;
        border: 2px dashed #0078ff;
        border-radius: 8px;
        cursor: pointer;
        position: relative;
        /* Để nút + nằm giữa */
    }

    .preview-add-wrapper.visible {
        display: flex;
    }

    .preview-add-wrapper.hidden {
        display: none;
        /* Ẩn nút [+] nếu không có ảnh */
    }

    .preview-add {
        font-size: 24px;
        color: #0078ff;
        pointer-events: none;
        /* Đảm bảo nút + không ảnh hưởng đến vùng bấm */
    }


    .preview-add-wrapper:hover {
        background: #f0f8ff;
    }
</style>
