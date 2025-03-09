<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Media;
use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\Session;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AdminChatController extends Controller
{
        public function index()
        {
            // Lấy danh sách tất cả session_id của khách vãng lai hiện tại
            $existingGuestSessions = DB::table('sessions')
                ->whereNull('session_id') // Chỉ lấy khách vãng lai
                ->pluck('id')
                ->toArray();
        
            // Lấy tất cả phiên chat
            $rawChats = DB::table('messages')
                ->leftJoin('sessions', 'messages.session_id', '=', 'sessions.id')
                ->leftJoin('users', 'messages.user_id', '=', 'users.id')
                ->select(
                    'messages.user_id',
                    'sessions.id as session_id',
                    'users.name_user as user_name',
                    'sessions.updated_at',
                    'sessions.created_at',
                    'sessions.ip_address',
                    DB::raw('SUM(CASE WHEN messages.from_admin = 0 AND messages.is_read = 0 THEN 1 ELSE 0 END) as unread_count'),
                    DB::raw('MAX(messages.created_at) as last_message_time') // Lấy thời gian tin nhắn mới nhất
                )
                ->groupBy('messages.user_id', 'sessions.id', 'users.name_user', 'sessions.updated_at', 'sessions.created_at', 'sessions.ip_address')
                ->orderBy('sessions.updated_at', 'desc')
                ->get();
        
            // Khởi tạo danh sách các session đã xử lý và map số thứ tự
            $uniqueUsers = [];
        
            $chats = $rawChats->map(function ($chat) use (&$uniqueUsers) {
                if ($chat->user_id) {
                    // Người dùng đăng nhập: Chỉ lấy user_id duy nhất
                    if (in_array($chat->user_id, $uniqueUsers)) {
                        return null; // Bỏ qua user_id trùng lặp
                    }
                    $uniqueUsers[] = $chat->user_id; // Đánh dấu user_id đã xử lý
                    $chat->display_name = $chat->user_name; // Hiển thị tên người dùng
                } elseif ($chat->session_id) {
                    // Khách vãng lai: Sử dụng session_id để hiển thị
                    $chat->display_name = 'Khách ' . $chat->session_id;
                } else {
                    $chat->display_name = 'Không xác định';
                }
        
                // Tính thời gian chênh lệch từ thời điểm tin nhắn mới nhất
                $chat->time_diff = \Carbon\Carbon::parse($chat->last_message_time)->diffForHumans();
        
                return $chat;
            })->filter(); // Loại bỏ các giá trị null (do bỏ qua trùng lặp)
        
            return view('admin.chat.index', compact('chats'));
        }

        public function getChatSidebar()
        {
            // Tái sử dụng logic từ index để lấy danh sách $chats
            $rawChats = DB::table('messages')
                ->leftJoin('sessions', 'messages.session_id', '=', 'sessions.id')
                ->leftJoin('users', 'messages.user_id', '=', 'users.id')
                ->select(
                    'messages.user_id',
                    'sessions.id as session_id',
                    'users.name_user as user_name',
                    'sessions.updated_at',
                    'sessions.created_at',
                    'sessions.ip_address',
                    DB::raw('SUM(CASE WHEN messages.from_admin = 0 AND messages.is_read = 0 THEN 1 ELSE 0 END) as unread_count'),
                    DB::raw('MAX(messages.created_at) as last_message_time')
                )
                ->groupBy('messages.user_id', 'sessions.id', 'users.name_user', 'sessions.updated_at', 'sessions.created_at', 'sessions.ip_address')
                ->orderBy('sessions.updated_at', 'desc')
                ->get();
    
            $uniqueUsers = [];
    
            $chats = $rawChats->map(function ($chat) use (&$uniqueUsers) {
                if ($chat->user_id) {
                    if (in_array($chat->user_id, $uniqueUsers)) {
                        return null;
                    }
                    $uniqueUsers[] = $chat->user_id;
                    $chat->display_name = $chat->user_name;
                } elseif ($chat->session_id) {
                    $chat->display_name = 'Khách ' . $chat->session_id;
                } else {
                    $chat->display_name = 'Không xác định';
                }
    
                $chat->time_diff = Carbon::parse($chat->last_message_time)->diffForHumans();
    
                return $chat;
            })->filter();
    
            return view('admin.chat.sidebar', compact('chats'))->render();
        }
    

    public function getMessages($id, $type)
    {
        if ($type === 'user') {
            // Lấy thông tin người dùng
            $user = DB::table('users')->where('id', $id)->first();

            if (!$user) {
                abort(404, 'Người dùng không tồn tại.');
            }

            // Lấy danh sách tin nhắn của người dùng
            $messages = Message::where('user_id', $id)
                ->with('media') // Lấy thông tin media liên quan đến tin nhắn
                ->orderBy('created_at', 'asc')
                ->get();

            // Đánh dấu tin nhắn chưa đọc là đã đọc
            Message::where('user_id', $id)
                ->where('from_admin', 0)
                ->where('is_read', 0)
                ->update(['is_read' => 1]);

            $sessionName = $user->name_user;
        } elseif ($type === 'session') {
            // Lấy thông tin session
            $session = Session::with(['messages', 'user'])->findOrFail($id);

            // Lấy danh sách tin nhắn của session
            $messages = $session->messages()->with('media') // Lấy thông tin media của tin nhắn
                ->orderBy('created_at', 'asc')
                ->get();

            // Đánh dấu tin nhắn chưa đọc là đã đọc
            $session->messages()
                ->where('from_admin', 0)
                ->where('is_read', 0)
                ->update(['is_read' => 1]);

            $sessionName = $session->user_id
                ? $session->user->name_user
                : 'Khách ' . $id;
        } else {
            abort(400, 'Tham số không hợp lệ.');
        }

        // Trả về view và truyền dữ liệu
        return view('admin.chat.messages', compact('messages', 'sessionName', 'id', 'type'));
    }



    public function refreshMessages($id, $type)
    {
        if ($type === 'user') {
            $user = DB::table('users')->where('id', $id)->first();
            if (!$user) {
                return response()->json(['error' => 'Người dùng không tồn tại.'], 404);
            }
            $messages = Message::where('user_id', $id)
                ->with('media')
                ->orderBy('created_at', 'asc')
                ->get();
            $sessionName = $user->name_user;
        } elseif ($type === 'session') {
            $session = Session::with(['messages', 'user'])->findOrFail($id);
            $messages = $session->messages()->with('media')
                ->orderBy('created_at', 'asc')
                ->get();
            $sessionName = $session->user_id
                ? $session->user->name_user
                : 'Khách ' . $id;
        } else {
            return response()->json(['error' => 'Tham số không hợp lệ.'], 400);
        }

        return view('admin.chat.chat-history', compact('messages', 'sessionName'))->render();
    }



    public function sendMessage(Request $request, $id, $type)
    {
        $request->validate([
            'message' => 'nullable|string',
            'media' => 'nullable|array',
            'media.*' => 'mimes:jpg,jpeg,png,gif,mp4,mov,avi|max:10240',
        ]);

        if ($type === 'user') {
            $message = Message::create([
                'user_id' => $id,
                'session_id' => null,
                'message' => $request->message,
                'from_admin' => true,
            ]);
        } elseif ($type === 'session') {
            $session = Session::findOrFail($id);

            $message = Message::create([
                'session_id' => $session->id,
                'user_id' => null,
                'message' => $request->message ?: null,
                'from_admin' => true,
            ]);
        } else {
            return response()->json(['error' => 'Tham số không hợp lệ.'], 400);
        }

        // Xử lý media nếu có
        $mediaUrls = [];
        if ($request->hasFile('media')) {
            foreach ($request->file('media') as $mediaFile) {
                $path = $mediaFile->store('images', 'public');
                $media = Media::create([
                    'message_id' => $message->id,
                    'media_path' => $path,
                    'media_type' => $mediaFile->getMimeType(),
                ]);

                $mediaUrls[] = [
                    'url' => asset('storage/' . $media->media_path),
                    'type' => $media->media_type,
                ];
            }
        }

        return response()->json([
            'message' => $message->message,
            'media' => $mediaUrls,
            'timestamp' => $message->created_at->format('Y-m-d H:i:s'),
        ]);
    }

    public function receiveMessages($id, Request $request)
    {
        $lastMessageId = $request->input('last_message_id', 0);

        // Lấy các tin nhắn mới hơn `lastMessageId`
        $newMessages = Message::where('chat_id', $id)
            ->where('id', '>', $lastMessageId)
            ->orderBy('created_at', 'asc')
            ->get();

        // Trả về dữ liệu JSON
        return response()->json([
            'messages' => $newMessages,
        ]);
    }


    public function countUnreadMessagesPerUser()
    {
        $unreadMessages = DB::table('messages')
            ->select('user_id', DB::raw('COUNT(*) as unread_count'))
            ->where('from_admin', 0) // Tin nhắn từ người dùng hoặc khách vãng lai
            ->where('is_read', 0)    // Tin nhắn chưa đọc
            ->groupBy('user_id')
            ->get();

        return $unreadMessages;
    }


    
}
