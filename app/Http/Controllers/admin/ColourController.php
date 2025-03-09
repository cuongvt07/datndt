<?php

namespace App\Http\Controllers\admin;

use App\Models\Colour;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ColourController extends Controller
{

    public function index(Request $request)
    {
        $search = $request->get('search'); // Get search query


        $products = Product::with('colours')
            ->when($search, function ($query, $search) {
                return $query->where('name_sp', 'like', '%' . $search . '%');
            })
            ->paginate(8);

        $colours = Colour::all();
        return view('admin.colours.index', compact('products', 'colours'));
    }
    // public function search(Request $request)
    // {
    //     $query = $request->input('query');
    //     $colors = Colour::where('name', 'like', '%' . $query . '%')->take(1)->get();

    //     return response()->json($colors);
    // }




    public function create()
    {
        // Lấy tất cả sản phẩm để chọn khi tạo màu mới
        $products = Product::all();

        return view('admin.colours.create', compact('products'));
    }


    public function store(Request $request)
    {
        // Tạo mới màu sắc
        Colour::create($request->all());

        // Điều hướng về trang danh sách màu sắc với thông báo thành công
        return redirect()->route('colours.index')->with('success', 'Màu sắc đã được tạo thành công.');
    }


    public function edit(Colour $colour)
    {
        // Lấy tất cả sản phẩm để chọn khi chỉnh sửa màu sắc
        $products = Product::all();

        return view('admin.colours.edit', compact('colour', 'products'));
    }


    public function update(Request $request, Colour $colour)
    {
        // Cập nhật màu sắc
        $colour->update($request->all());

        // Điều hướng về trang danh sách màu sắc với thông báo thành công
        return redirect()->route('colours.index')->with('success', 'Màu sắc đã được cập nhật thành công.');
    }

    public function destroy(Colour $colour)
    {
        // Xóa màu sắc
        $colour->delete();

        // Điều hướng về trang danh sách màu sắc với thông báo thành công
        return redirect()->route('colours.index')->with('success', 'Màu sắc đã được xóa thành công.');
    }
}
