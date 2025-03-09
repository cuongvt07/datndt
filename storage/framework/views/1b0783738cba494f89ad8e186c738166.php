<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">


<div class="chat-header">

</div>

<!-- Hiển thị tin nhắn -->
<div id="chat-history" class="chat-body">
    <?php echo $__env->make('partials.chat-messages', ['messages' => $messages, 'userName' => $userName], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div>
<!-- Form gửi tin nhắn -->

<form action="<?php echo e(route('user.chat.send')); ?>" method="POST" enctype="multipart/form-data" class="chat-footer">
    <?php echo csrf_field(); ?>
    <!-- Nút chọn ảnh -->
    <label for="file-input" class="file-input-label">
        <i class="fas fa-image"></i>
    </label>
    <input type="file" id="file-input" name="media[]" accept="image/*,video/*" multiple hidden>

    <!-- Ô nhập tin nhắn -->
    <textarea name="message" class="form-control" rows="1" placeholder="Nhập tin nhắn..."></textarea>

    <!-- Nút gửi tin nhắn -->
    <button type="submit" class="btn-send">
        <i class="fas fa-paper-plane"></i>
    </button>
</form>

<div id="preview-container"> </div>



<style>
    /* Import font chữ Messenger */
    @import url('https://fonts.googleapis.com/css2?family=Helvetica+Neue:wght@300;400&family=Segoe+UI:wght@400&display=swap');

    /* Reset mặc định */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Segoe UI', sans-serif;
        background-color: #f7f7f7;
    }

    /* Tổng thể container */
    .chat-container {
        display: flex;
        flex-direction: column;
        max-width: 600px;
        margin: 20px auto;
        background-color: #fff;
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 20px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    /* Tiêu đề */
    .chat-header {
        text-align: center;
        font-size: 24px;
        font-weight: 600;
        color: #333;
        margin-bottom: 15px;
    }

    /* Danh sách tin nhắn */
    .chat-body {
        height: 450px;
        overflow-y: auto;
        padding: 10px;
        margin-bottom: 20px;
        border: 1px solid #ddd;
        border-radius: 8px;
        background-color: #f9f9f9;
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    .message-container {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
    }

    .message-container.sent {
        align-items: flex-end;
    }

    .message-header {
        font-size: 0.9rem;
        font-weight: 600;
        color: #333;
        margin-bottom: 5px;
    }

    .message-content {
        background-color: #e4e6eb;
        padding: 10px;
        border-radius: 15px;
        max-width: 70%;
        word-wrap: break-word;
        margin-bottom: 5px;
    }

    .message-container.sent .message-content {
        background-color: #0078ff;
        color: white;
    }

    .message-time {
        font-size: 0.7rem;
        color: #777;
        margin-top: 5px;
        white-space: nowrap;
    }

    .media-item {
        max-width: 200px;
        margin-top: 10px;
        border-radius: 8px;
    }

    /* Form gửi tin nhắn */
    .chat-footer {
        display: flex;
        align-items: center;
        /* Căn giữa các phần tử theo chiều dọc */
        gap: 10px;
        /* Khoảng cách giữa các phần tử */
        background-color: #f0f2f5;
        border-radius: 20px;
        padding: 10px 15px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }

    .file-input-label {
        cursor: pointer;
        font-size: 1.5rem;
        color: #0078ff;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    textarea.form-control {
        flex: 1;
        /* Ô nhập tin nhắn chiếm toàn bộ không gian còn lại */
        border: none;
        border-radius: 20px;
        padding: 10px 15px;
        font-size: 1rem;
        resize: none;
        outline: none;
        background-color: transparent;
        color: #333;
    }

    textarea.form-control::placeholder {
        color: #aaa;
    }

    /* Nút gửi */
    .btn-send {
        background: none;
        border: none;
        cursor: pointer;
        font-size: 1.5rem;
        color: #0078ff;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .btn-send:hover {
        color: #005bb5;
    }

    /* Xem trước ảnh */
    /* Container xem trước ảnh */
    #preview-container {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-top: -130px;
        max-height: 100px;
        overflow-y: auto;
        position: relative;
    }

    /* Nút thêm ảnh */
    #add-image-btn {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 60px;
        height: 60px;
        border-radius: 8px;
        border: 1px dashed #ddd;
        background-color: #f9f9f9;
        cursor: pointer;
    }

    #add-image-btn i {
        font-size: 24px;
        color: #0078ff;
    }

    /* Ảnh xem trước */
    #preview-container div {
        position: relative;
    }

    #preview-container img {
        width: 60px;
        height: 60px;
        object-fit: cover;
        border-radius: 8px;
        border: 1px solid #ddd;
    }

    /* Nút xóa ảnh */
    #preview-container .remove-btn {
        position: absolute;
        top: 0;
        right: 0;
        background: rgba(0, 0, 0, 0.7);
        color: white;
        font-size: 12px;
        border: none;
        border-radius: 50%;
        width: 20px;
        height: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
    }

    #add-image-btn {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 60px;
        height: 60px;
        border-radius: 8px;
        border: 1px dashed #ddd;
        background-color: #f9f9f9;
        cursor: pointer;
        order: 999;
    }

    #add-image-btn.hidden {
        display: none;
    }
</style>

<script>
    // Tự động cuộn đến tin nhắn mới nhất khi trang được tải hoặc khi có tin nhắn mới
    document.addEventListener('DOMContentLoaded', function() {
        const chatBody = document.getElementById('chat-history');
        chatBody.scrollTop = chatBody.scrollHeight; // Cuộn đến cuối cùng khi tải trang

        // Lắng nghe sự kiện gửi tin nhắn và cuộn xuống dưới
        const chatForm = document.querySelector('form');
        chatForm.addEventListener('submit', function() {
            setTimeout(() => {
                chatBody.scrollTop = chatBody.scrollHeight; // Cuộn xuống sau khi gửi tin
            }, 300); // Chờ chút để tin nhắn mới được hiển thị
        });
    });

</script>

<script>
    const fileInput = document.getElementById('file-input');
const previewContainer = document.getElementById('preview-container');

let selectedFiles = []; // Mảng lưu trữ các file đã chọn

fileInput.addEventListener('change', (event) => {
    const files = Array.from(event.target.files);

    // Cập nhật lại danh sách file (thay vì chỉ push, ta sẽ thay thế hoàn toàn mảng)
    selectedFiles = files;

    // Cập nhật giao diện xem trước
    updatePreview();

    // Hiển thị nút "Thêm ảnh" nếu có ít nhất một file
    toggleAddImageButton();
});

function updatePreview() {
    // Xóa toàn bộ ảnh xem trước cũ
    previewContainer.innerHTML = '';

    // Hiển thị ảnh và video xem trước từ selectedFiles
    selectedFiles.forEach((file, index) => {
        const reader = new FileReader();
        reader.onload = (e) => {
            const wrapper = document.createElement('div');
            wrapper.style.position = 'relative';

            // Tạo phần tử hiển thị (ảnh hoặc video)
            if (file.type.startsWith('image/')) {
                const img = document.createElement('img');
                img.src = e.target.result;
                img.alt = file.name;
                wrapper.appendChild(img);
            } else if (file.type.startsWith('video/')) {
                const video = document.createElement('video');
                video.src = e.target.result;
                video.controls = true;
                video.style.width = '60px';
                video.style.height = '60px';
                wrapper.appendChild(video);
            }

            // Nút xóa file
            const removeBtn = document.createElement('button');
            removeBtn.innerText = '×';
            removeBtn.classList.add('remove-btn');
            removeBtn.addEventListener('click', () => {
                removeFile(index);
                updatePreview();
                toggleAddImageButton();
            });

            wrapper.appendChild(removeBtn);
            previewContainer.appendChild(wrapper);
        };
        reader.readAsDataURL(file);
    });
}

function toggleAddImageButton() {
    // Hiển thị nút "Thêm ảnh" nếu có ít nhất một file
    if (selectedFiles.length > 0) {
        const addImageBtn = document.createElement('div');
        addImageBtn.id = 'add-image-btn';
        addImageBtn.innerHTML =
            '<label for="file-input" class="file-input-label"><i class="fas fa-plus-circle"></i></label>';
        previewContainer.appendChild(addImageBtn);
    }
}

function removeFile(index) {
    // Xóa file khỏi danh sách selectedFiles
    selectedFiles.splice(index, 1);

    // Reset input file để tránh trùng lặp khi chọn lại
    const dataTransfer = new DataTransfer();
    selectedFiles.forEach((file) => dataTransfer.items.add(file));
    fileInput.files = dataTransfer.files;
}
document.getElementById('chat-form').addEventListener('submit', function(event) {
    event.preventDefault();

    const formData = new FormData(this);
    const messageInput = document.getElementById('message-input');
    const chatHistory = document.getElementById('chat-history');

    // Thêm các file đã chọn vào formData
    selectedFiles.forEach((file) => {
        formData.append('media[]', file); // media[] là tên của trường file trong form
    });

    fetch("<?php echo e(route('user.chat.send')); ?>", {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            const newMessage = document.createElement('div');
            newMessage.className = 'message-container sent';
            newMessage.innerHTML = `
                <div class="message-header">Bạn</div>
                <div class="message-content">${data.message}</div>
                <div class="message-time">${new Date().toLocaleTimeString()}</div>
            `;
            chatHistory.appendChild(newMessage);
            chatHistory.scrollTop = chatHistory.scrollHeight; // Scroll to bottom
            messageInput.value = ''; // Clear the input
            selectedFiles = []; // Reset selected files after sending
            updatePreview(); // Clear preview
        } else {
            alert('Gửi tin nhắn thất bại.');
        }
    })
    .catch(error => console.error('Error:', error));
});

</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        let lastMessageCount = 0; // Biến để lưu số lượng tin nhắn trước đó

        // Hàm tải lại tin nhắn
        function refreshMessages() {
            $.ajax({
                url: "<?php echo e(route('user.chat')); ?>",
                type: "GET",
                data: {
                    iframe: true // Tham số để xác định request lấy tin nhắn
                },
                success: function(response) {
                    const chatHistory = $('#chat-history');
                    const scrollPosition = chatHistory.scrollTop() + chatHistory.innerHeight();
                    const isAtBottom = scrollPosition >= chatHistory[0].scrollHeight -
                    20; // Kiểm tra nếu đang ở cuối

                    // Thay thế nội dung chat-history bằng dữ liệu mới
                    chatHistory.html(response);

                    const currentMessageCount = chatHistory.find('.message-container').length;

                    // Tự động cuộn xuống cuối nếu có tin nhắn mới hoặc người dùng đang ở cuối danh sách
                    if (currentMessageCount > lastMessageCount || isAtBottom) {
                        setTimeout(() => {
                            chatHistory.scrollTop(chatHistory[0].scrollHeight);
                        }, 50); // Trì hoãn để đảm bảo nội dung đã được hiển thị
                    }

                    // Cập nhật số lượng tin nhắn hiện tại
                    lastMessageCount = currentMessageCount;
                },
                error: function() {
                    console.error("Không thể tải tin nhắn mới.");
                }
            });
        }

        // Gọi hàm refreshMessages mỗi 3 giây
        setInterval(refreshMessages, 3000);
    });
</script>
<?php /**PATH D:\LARAGON-PHP2\laragon\www\datn\resources\views/user/chat/index.blade.php ENDPATH**/ ?>