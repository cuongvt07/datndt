<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\Session;
use App\Models\Media;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ChatController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            // Người dùng đã đăng nhập, lấy tin nhắn theo user_id
            $messages = Message::where('user_id', Auth::id())
                ->orderBy('created_at', 'asc')
                ->get();
        } else {
            // Khách vãng lai, lấy tin nhắn theo session_id
            $session = $this->getSession();  // Lấy thông tin session của khách

            // Truy vấn tin nhắn theo session_id đã lưu trong bảng messages
            $messages = Message::where('session_id', $session->session_id)
                ->orderBy('created_at', 'asc')
                ->get();
        }

        // Lấy tên người dùng hoặc 'Khách' nếu là khách
        $userName = $this->getUserName();

        // Trả về view với thông tin tin nhắn và tên người dùng
        return view('user.chat.index', compact('messages', 'userName'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'message' => 'required|string',
            'media' => 'nullable|array', // Kiểm tra nếu có gửi media
            'media.*' => 'file|mimes:jpeg,png,jpg,gif,mp4,avi,mov|max:10240', // Kiểm tra định dạng tệp
        ]);

        $session = $this->getSession(); // Lấy thông tin session hiện tại

        // Khởi tạo giá trị mặc định cho media
        $mediaPath = null;
        $mediaType = null;

        // Kiểm tra nếu có tệp được gửi
        if ($request->hasFile('media')) {
            $file = $request->file('media')[0]; // Chỉ lấy file đầu tiên nếu có nhiều file
            $path = $file->store('images', 'public'); // Lưu trong thư mục storage/images
            $mediaPath = $path;
            $mediaType = $file->getMimeType(); // Lưu loại media (image/video)
        }

        // Lưu tin nhắn vào bảng Message
        Message::create([
            'user_id' => Auth::id() ?: null,
            'session_id' => $session->session_id,  // Sử dụng session_id của khách
            'message' => $request->message,
            'from_admin' => false, // Tin nhắn từ người dùng/khách
            'media_type' => $mediaType, // Lưu loại media
            'media_path' => $mediaPath, // Lưu đường dẫn media
        ]);

        return redirect()->back();
    }

    private function getClientIpFromApi()
    {
        $response = file_get_contents('https://api.ipify.org?format=json');
        $data = json_decode($response, true);

        return $data['ip'] ?? '0.0.0.0';
    }

    private $currentSession; // Biến lưu session hiện tại

    public function getSession()
    {
        if ($this->currentSession) {
            return $this->currentSession; // Trả về nếu đã được xử lý trước
        }

        $session_id = session()->getId(); // Lấy session ID hiện tại
        $ip_address = $this->getClientIpFromApi(); // Lấy IP từ API
        $user_agent = request()->header('User-Agent'); // Lấy User Agent từ request

        $sessionRecord = Session::where('session_id', $session_id)->first();

        if ($sessionRecord) {
            if (
                $sessionRecord->ip_address !== $ip_address ||
                $sessionRecord->user_agent !== $user_agent
            ) {
                $sessionRecord->update([
                    'ip_address' => $ip_address,
                    'user_agent' => $user_agent,
                    'updated_at' => now(),
                ]);
            }
        } else {
            $sessionRecord = Session::create([
                'session_id' => $session_id,
                'ip_address' => $ip_address,
                'user_agent' => $user_agent,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $this->currentSession = $sessionRecord; // Lưu lại để tái sử dụng trong request

        // Debug xem session hiện tại


        return $sessionRecord;
    }



    public function getMessages()
    {
        if (Auth::check()) {
            $messages = Message::where('user_id', Auth::id())
                ->orderBy('created_at', 'asc')
                ->get();
        } else {
            $session = $this->getSession();
            $sessionNumericId = Session::where('session_id', $session->session_id)->value('id');

            $messages = $sessionNumericId
                ? Message::where('session_id', $sessionNumericId)
                ->orderBy('created_at', 'asc')
                ->get()
                : collect();
        }

        $userName = $this->getUserName();

        // Kiểm tra nếu là yêu cầu AJAX
        if (request()->ajax()) {
            if (request()->query('format') === 'json') {
                // Trả về JSON khi yêu cầu format=json
                return response()->json(['messages' => $messages]);
            }

            // Trả về HTML khi không yêu cầu JSON
            return view('partials.chat-messages', compact('messages', 'userName'))->render();
        }

        // Trả về view mặc định khi không phải AJAX
        return view('user.chat.index', compact('messages', 'userName'));
    }




    public function chat()
    {
        // Lấy lịch sử tin nhắn
        $messages = $this->getChatHistory();

        return view('user.chat.index', compact('messages'));
    }

    public function sendMessage(Request $request)
    {
        $request->validate([
            'message' => 'nullable|string',
            'media' => 'nullable|array',
            'media.*' => 'mimes:jpg,jpeg,png,gif,mp4,mov,avi|max:10240',
        ]);

        $session = $this->getSession(); // Lấy session hiện tại

        // Kiểm tra ít nhất một trong hai: message hoặc media phải tồn tại
        if (!$request->filled('message') && !$request->hasFile('media')) {
            return back()->withErrors(['error' => 'Bạn cần nhập tin nhắn hoặc chọn ít nhất một file.']);
        }

        // Tạo tin nhắn nếu có nội dung hoặc media
        $message = null;
        if ($request->filled('message') || $request->hasFile('media')) {
            $message = Message::create([
                'user_id' => Auth::id() ?: null,
                'session_id' => $session->id,
                'message' => $request->message ?: null, // Gửi null nếu không có tin nhắn
                'type' => 'user',
            ]);
        }

        // Nếu có media, lưu từng file và liên kết với tin nhắn
        if ($request->hasFile('media')) {
            foreach ($request->file('media') as $mediaFile) {
                $path = $mediaFile->store('images', 'public'); // Lưu file vào thư mục public/storage/images

                // Sử dụng model Media để lưu thông tin về file
                Media::create([
                    'message_id' => $message ? $message->id : null, // Liên kết với tin nhắn (nếu có)
                    'media_path' => $path,
                    'media_type' => $mediaFile->getMimeType(),
                ]);
            }
        }

        return back()->with('success', 'Tin nhắn đã được gửi.');
    }





    public function getUserName()
    {
        // Kiểm tra xem người dùng đã đăng nhập chưa
        if (auth()->check()) {
            // Nếu là người dùng đã đăng nhập, lấy tên người dùng
            $userName = auth()->user()->name_user;
        } else {
            // Nếu là khách vãng lai, hiển thị "Khách"
            $userName = 'Khách';
        }

        return $userName;
    }

    public function markAdminMessagesAsRead()
    {
        if (Auth::check()) {
            // Người dùng đã đăng nhập
            Message::where('user_id', Auth::id())
                ->where('from_admin', 1) // Tin nhắn từ admin
                ->where('is_read', 0) // Chỉ cập nhật nếu chưa đọc
                ->update(['is_read' => 1]);
        } else {
            // Người dùng là khách
            $session = $this->getSession();
            $sessionNumericId = Session::where('session_id', $session->session_id)->value('id');

            if ($sessionNumericId) {
                Message::where('session_id', $sessionNumericId)
                    ->where('from_admin', 1) // Tin nhắn từ admin
                    ->where('is_read', 0) // Chỉ cập nhật nếu chưa đọc
                    ->update(['is_read' => 1]);
            }
        }

        return response()->json(['status' => 'success', 'message' => 'Messages marked as read.']);
    }
}
