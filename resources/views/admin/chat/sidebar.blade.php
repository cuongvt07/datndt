<ul class="chat-user-list" style="list-style: none; padding: 0; margin: 0;">
    @foreach ($chats as $chat)
        <li class="chat-user-item" style="margin-bottom: 10px;">
            <a href="javascript:void(0)" class="chat-user-link"
                data-id="{{ $chat->user_id ?: $chat->session_id }}"
                data-type="{{ $chat->user_id ? 'user' : 'session' }}"
                style="display: flex; align-items: center; text-decoration: none; color: #333; padding: 10px; border-radius: 5px; background-color: #ffffff; border: 1px solid #ddd; position: relative;">
                <div style="flex-grow: 1;">
                    <strong>{{ $chat->display_name }}</strong>
                    <br>
                    <small>IP: {{ $chat->ip_address ?? 'Không có' }}</small>
                </div>
                @if ($chat->unread_count > 0)
                    <div class="notification-badge" data-unread="{{ $chat->unread_count }}">
                        <h6>
                            <span class="badge bg-dark" style="border-radius:20px;">
                                <span>{{ $chat->unread_count }}</span>
                            </span>
                        </h6>
                    </div>
                @endif
                <small style="color: #999; margin-left: 10px;">
                    {{ $chat->time_diff }}
                </small>
            </a>
        </li>
    @endforeach
</ul>
