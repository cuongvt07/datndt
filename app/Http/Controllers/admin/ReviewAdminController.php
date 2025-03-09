<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewAdminController extends Controller
{
    public function index(){
        $reviews = Review::all();
        return view('admin.review.index',compact('reviews'));
    }
    public function destroy($id)
    {
        try {
            $review = Review::findOrFail($id); 
            $review->delete(); 
            return redirect()->route('review.index')->with('success', 'Đánh giá đã được xóa thành công!');
        } catch (\Exception $e) {
            return redirect()->route('review.index')->with('error', 'Không thể xóa đánh giá, vui lòng thử lại.');
        }
    }
}
