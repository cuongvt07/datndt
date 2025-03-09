<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PostClientController extends Controller
{
    public function index()
    {
        // $posts = Post::latest()->get();
        $categories = Category::withCount('posts')->get();
        $recentPosts = Post::latest()->take(3)->get();
        $posts = Post::latest()->paginate(6);

        $archives = Post::selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, COUNT(*) as count')
            ->groupBy('year', 'month')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->get();


        return view('user.post.index', compact('posts', 'categories', 'archives', 'recentPosts'));
    }

    public function show(Post $post)
    {
        $comments = $post->comments()->latest()->get();

        $categories = Category::withCount('posts')->get();
        $recentPosts = Post::latest()->take(3)->get();
        $archives = Post::selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, COUNT(*) as count')
                ->groupBy('year', 'month')
                ->orderBy('year', 'desc')
                ->orderBy('month', 'desc')
                ->get();

        return view('user.post.show', compact('archives', 'post', 'comments', 'categories', 'recentPosts'));
    }

    public function storeComment(Request $request, $postId)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email',
            'content' => 'required',
        ]);

        Comment::create([
            'post_id' => $postId,
            'user_id' => auth()->id(),
            'name' => $request->name,
            'email' => $request->email,
            'content' => $request->content,
        ]);

        return back()->with('success', 'Bình luận của bạn đã được gửi thành công!');
    }
    public function archive($year, $month)
    {
        $posts = Post::whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->get();

        // Lấy tất cả các tháng và năm có bài viết
        $archives = Post::selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, COUNT(*) as count')
            ->groupBy('year', 'month')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->get();


        return view('user.post.index', compact('posts', 'archives', 'year', 'month'));
    }

    public function filterByCategory($categoryId)
    {
        $category = Category::findOrFail($categoryId);

        $posts = Post::where('category_id', $categoryId)->get();

        $categories = Category::all();

        $recentPosts = Post::latest()->take(5)->get();

        $archives = Post::selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, COUNT(*) as count')
            ->groupBy('year', 'month')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->get();


        return view('user.post.index', compact('posts', 'categories', 'recentPosts', 'archives'));
    }
    public function filterByArchive($year, $month)
    {
        $posts = Post::whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->get();

        $categories = Category::all();

        $recentPosts = Post::latest()->take(5)->get();

        $archives = Post::selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, COUNT(*) as count')
            ->groupBy('year', 'month')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->get();


        return view('user.post.index', compact('posts', 'categories', 'recentPosts', 'archives'));
    }



}
