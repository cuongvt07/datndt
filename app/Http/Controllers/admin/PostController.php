<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Product;
use Illuminate\Http\Request;
use Storage;

class PostController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $posts = Post::with('category')->get();

        return view('admin.posts.index', compact('posts', 'categories'));

    }
    public function create()
    {
        $categories = Category::all();
        return view('admin.posts.create', compact('categories'));
    }
    public function show($id)
    {
        $post = Post::findOrFail($id);
        return view('admin.posts.show', compact('post'));
    }

    public function store(Request $request)
    {
        $categories = Category::all();
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'image' => 'nullable|image|max:2048',
            'video' => 'nullable|url',
            'category_id' => 'required|exists:categories,id',
        ], [
            'title.required' => 'Trường này bắt buộc phải nhập.',
            'content.required' => 'Trường này bắt buộc phải nhập.',
            'image.required' => 'Trường này bắt buộc phải nhập.',
            'category_id.required' => 'Trường này bắt buộc phải nhập.',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('posts', 'public');
        }


        Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'image' => $imagePath,
            'video' => $request->video,
            'category_id' => $request->category_id,
        ]);

        return redirect()->route('posts.index')->with('success', 'Bài viết đã được thêm!');
    }
    public function edit($id)
    {
        $categories = Category::all();
        $post = Post::findOrFail($id);
        return view('admin.posts.edit', compact('post', 'categories'));
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'image' => 'nullable|image|max:2048',
            'video' => 'nullable|url',
            'category_id' => 'required|exists:categories,id',
        ]);

        $imagePath = $post->image;
        $videoUrl = $post->video;

        // Xử lý xóa ảnh
        if ($request->has('delete_image') && $post->image) {
            Storage::disk('public')->delete($post->image);
            $imagePath = null;
        }

        // Xử lý xóa video
        if ($request->has('delete_video')) {
            $videoUrl = null;
        }

        // Xử lý ảnh mới
        if ($request->hasFile('image')) {
            if ($post->image) {
                Storage::disk('public')->delete($post->image);
            }
            $imagePath = $request->file('image')->store('posts', 'public');
        }

        // Cập nhật video mới nếu có
        if ($request->video) {
            $videoUrl = $request->video;
        }

        // Cập nhật bài viết
        $post->update([
            'title' => $request->title,
            'content' => $request->content,
            'image' => $imagePath,
            'video' => $videoUrl,
            'category_id' => $request->category_id,
        ]);

        return redirect()->route('posts.index')->with('success', 'Bài viết đã được cập nhật!');
    }

    public function destroy(Post $post)
    {
        // Xóa ảnh nếu có
        if ($post->image) {
            Storage::disk('public')->delete($post->image);
        }

        // Xóa bài viết
        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Bài viết đã được xóa!');
    }
    public function upload(Request $request)
    {
        if ($request->hasFile('upload')) {
            $file = $request->file('upload');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/posts'), $filename);

            // Tạo đường dẫn đầy đủ để gửi về cho CKEditor
            $url = asset('uploads/posts/' . $filename);
            return response()->json([
                'uploaded' => true,
                'url' => $url
            ]);

            // Kiểm tra loại tệp là video
            if (in_array($file->getClientOriginalExtension(), ['mp4', 'avi', 'mov', 'mkv'])) {
                $file->move(public_path('uploads/videos'), $filename);
                $url = asset('uploads/videos/' . $filename);
                return response()->json(['uploaded' => true, 'url' => $url]);
            } else {
                return response()->json(['uploaded' => false, 'error' => 'Tệp không hợp lệ.']);
            }
        }

        return response()->json([
            'uploaded' => false,
            'error' => 'Không thể tải lên hình ảnh.'
        ]);
    }
    private function extractYouTubeId($url)
    {
        $regExp = '/(?:youtube\.com\/(?:[^\/]+\/\S+\/|(?:v|e(?:mbed)?)\/|\S*?[?&]v=)|youtu\.be\/)([a-zA-Z0-9_-]{11})/';
        preg_match($regExp, $url, $match);
        return isset($match[1]) ? $match[1] : null;
    }


}
