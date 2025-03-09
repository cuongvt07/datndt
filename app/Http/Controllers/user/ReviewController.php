<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        $user = Auth::user();

        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Bạn cần đăng nhập để đánh giá sản phẩm.');
        }

        // Validate input
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'content' => 'nullable|string|max:1000',
            'product_id' => 'required|exists:products,id',
            'images.*' => 'image|max:2048', // Kiểm tra ảnh
            'videos.*' => 'mimetypes:video/mp4,video/avi,video/mpeg|max:10240' // Kiểm tra video
        ]);

        // Kiểm tra và lưu ảnh
        $imagePaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $path = $file->store('images', 'public');
                $imagePaths[] = $path; // Thêm đường dẫn vào mảng
            }
        }

        // Kiểm tra và lưu video
        $videoPaths = [];
        if ($request->hasFile('videos')) {
            foreach ($request->file('videos') as $file) {
                $path = $file->store('videos', 'public');
                $videoPaths[] = $path;
            }
        }

        // Lưu vào cơ sở dữ liệu
        Review::create([
            'product_id' => $request->input('product_id'),
            'user_id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'rating' => $request->input('rating'),
            'content' => $request->input('content', ''),
            'images' => json_encode($imagePaths),  // Lưu dưới dạng chuỗi JSON
            'videos' => json_encode($videoPaths),  // Lưu dưới dạng chuỗi JSON
        ]);

        return redirect()->back()->with('success', 'Cảm ơn bạn đã đánh giá!');
    }
}
