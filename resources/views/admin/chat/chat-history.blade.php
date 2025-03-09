
    @forelse ($messages as $message)
        <div class="chat-message {{ $message->from_admin ? 'from-admin' : 'from-user' }}">
            <p class="chat-sender">
                @if ($message->from_admin)
                    Admin
                @else
                    {{ $sessionName ?? 'User' }}
                @endif
            </p>
            @if ($message->message)
                <div class="chat-content">
                    <p class="chat-text">{{ $message->message }}</p>
                </div>
            @endif
            @foreach ($message->media as $media)
                <div class="chat-media-wrapper">
                    @if (strpos($media->media_type, 'image') !== false)
                        <img src="{{ asset('storage/' . $media->media_path) }}" alt="Image" class="chat-media">
                    @elseif (strpos($media->media_type, 'video') !== false)
                        <video controls class="chat-media">
                            <source src="{{ asset('storage/' . $media->media_path) }}" type="{{ $media->media_type }}">
                            Your browser does not support the video tag.
                        </video>
                    @endif
                </div>
            @endforeach
            <small class="chat-timestamp">{{ $message->created_at->format('Y-m-d H:i:s') }}</small>
        </div>
    @empty
        <p class="no-messages">Chưa có tin nhắn nào.</p>
    @endforelse

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

</style>