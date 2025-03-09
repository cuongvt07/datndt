@forelse ($messages as $message)
    <div class="message-container {{ $message->from_admin ? 'received' : 'sent' }}">
        <div class="message-header">
            <strong>
                @if ($message->from_admin)
                    Nhân viên hỗ trợ
                @else
                    {{ $message->user_id ? $userName : 'Khách' }}
                @endif
            </strong>
        </div>
        @if (!empty($message->message))
            <div class="message-content">
                <p>{{ $message->message }}</p>
            </div>
        @endif
        @foreach ($message->media as $media)
            @if (strpos($media->media_type, 'image') !== false)
                <img src="{{ asset('storage/' . $media->media_path) }}" alt="Image" class="media-item">
            @elseif (strpos($media->media_type, 'video') !== false)
                <video width="320" height="240" controls class="media-item">
                    <source src="{{ asset('storage/' . $media->media_path) }}" type="{{ $media->media_type }}">
                    Your browser does not support the video tag.
                </video>
            @endif
        @endforeach
        <div class="message-time">
            <small>{{ $message->created_at->format('Y-m-d H:i:s') }}</small>
        </div>
    </div>
@empty
    <p>Chưa có tin nhắn nào.</p>
@endforelse
