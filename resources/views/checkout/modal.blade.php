<!-- Nút để mở Modal -->
<button id="openModalBtn">Chọn ảnh/video</button>

<!-- Modal -->
<div id="fileModal" class="modal">
    <div class="modal-content">
        <span id="closeModalBtn" class="close">&times;</span>
        <h2>Chọn ảnh/video</h2>
        <input type="file" id="fileInput" accept="image/*,video/*" multiple />
        <button id="addFilesBtn">Thêm vào</button>
        <div id="modalPreviewContainer"></div>
    </div>
</div>

<!-- Preview ảnh/video sau khi chọn -->
<div id="media-preview" class="preview-container"></div>
<script>
    const openModalBtn = document.getElementById('openModalBtn');
const closeModalBtn = document.getElementById('closeModalBtn');
const fileModal = document.getElementById('fileModal');
const fileInput = document.getElementById('fileInput');
const addFilesBtn = document.getElementById('addFilesBtn');
const modalPreviewContainer = document.getElementById('modalPreviewContainer');
const previewContainer = document.getElementById('media-preview');
let selectedFiles = [];

// Mở modal khi nhấn nút "Chọn ảnh/video"
openModalBtn.addEventListener('click', () => {
    fileModal.style.display = 'block';
});

// Đóng modal khi nhấn dấu "X"
closeModalBtn.addEventListener('click', () => {
    fileModal.style.display = 'none';
});

// Xử lý xem trước ảnh/video trong modal
fileInput.addEventListener('change', () => {
    const files = fileInput.files;
    modalPreviewContainer.innerHTML = ''; // Clear preview container
    Array.from(files).forEach(file => {
        const fileURL = URL.createObjectURL(file);
        const previewItem = document.createElement('div');
        previewItem.classList.add('preview-item');

        // Hiển thị hình ảnh hoặc video
        if (file.type.startsWith('image/')) {
            const img = document.createElement('img');
            img.src = fileURL;
            img.alt = 'Preview image';
            previewItem.appendChild(img);
        } else if (file.type.startsWith('video/')) {
            const video = document.createElement('video');
            video.src = fileURL;
            video.controls = true;
            previewItem.appendChild(video);
        }

        modalPreviewContainer.appendChild(previewItem);
    });
});

// Thêm tệp đã chọn vào giao diện khi nhấn "Thêm vào"
addFilesBtn.addEventListener('click', () => {
    const files = fileInput.files;
    Array.from(files).forEach(file => {
        if (!selectedFiles.includes(file.name)) {
            selectedFiles.push(file.name);
            const fileURL = URL.createObjectURL(file);

            const mediaItem = document.createElement('div');
            mediaItem.classList.add('media-item');
            mediaItem.dataset.fileName = file.name;

            if (file.type.startsWith('image/')) {
                const img = document.createElement('img');
                img.src = fileURL;
                img.alt = 'Preview image';
                mediaItem.appendChild(img);
            } else if (file.type.startsWith('video/')) {
                const video = document.createElement('video');
                video.src = fileURL;
                video.controls = true;
                mediaItem.appendChild(video);
            }

            // Thêm nút xóa
            const deleteButton = document.createElement('button');
            deleteButton.innerText = 'X';
            deleteButton.classList.add('delete-button');
            deleteButton.onclick = () => {
                selectedFiles = selectedFiles.filter(f => f !== file.name);
                previewContainer.removeChild(mediaItem);
                URL.revokeObjectURL(fileURL); // Giải phóng bộ nhớ
            };

            mediaItem.appendChild(deleteButton);
            previewContainer.appendChild(mediaItem);
        }
    });

    // Đóng modal sau khi thêm tệp
    fileModal.style.display = 'none';
});

</script>
<style>
    /* Modal styles */
.modal {
    display: none; /* Ẩn modal */
    position: fixed;
    z-index: 1;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0, 0, 0, 0.4);
    padding-top: 60px;
}

.modal-content {
    background-color: #fff;
    margin: 5% auto;
    padding: 20px;
    border: 1px solid #888;
    width: 80%;
}

.close {
    color: #aaa;
    font-size: 28px;
    font-weight: bold;
    position: absolute;
    top: 10px;
    right: 25px;
}

.close:hover,
.close:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
}

</style>