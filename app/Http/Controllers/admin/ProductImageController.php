<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Colour;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductImageController extends Controller
{

    public function index(Request $request)
    {
        $search = $request->get('search');

        // Lấy tất cả sản phẩm kèm theo hình ảnh, áp dụng tìm kiếm và phân trang
        $products = Product::with('productImages')
            ->when($search, function ($query, $search) {
                return $query->where('name_sp', 'like', '%' . $search . '%');
            })
            ->paginate(8);

        return view('admin.product_image.index', compact('products'));
    }


    public function create()
    {
        // Lấy danh sách sản phẩm và màu sắc để chọn khi tạo hình ảnh
        $products = Product::all();
        $colours = Colour::all();
        return view('admin.product_image.create', compact('products', 'colours'));
    }


    public function store(Request $request)
    {
        // Validate dữ liệu đầu vào
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'colour_id' => 'required|exists:colours,id',
            'image' => 'required|image|max:2048',
        ], [
            'product_id.required' => 'Trường này bắt buộc phải nhập.',
            'colour_id.required' => 'Trường này bắt buộc phải nhập.',
            'image.required' => 'Trường này bắt buộc phải có ảnh.',
        ]);

        // Lưu file hình ảnh vào thư mục 'images' trong 'public'
        $imagePath = $request->file('image')->store('images', 'public');

        // Tạo mới hình ảnh trong cơ sở dữ liệu
        ProductImage::create([
            'product_id' => $request->product_id,
            'colour_id' => $request->colour_id,
            'image_path' => $imagePath,
        ]);

        // Điều hướng về trang danh sách hình ảnh với thông báo thành công
        return redirect()->route('product_image.index')->with('success', 'Hình ảnh đã được thêm thành công.');
    }


    public function edit($id)
    {
        $image = ProductImage::find($id);
        $products = Product::all();
        $colours = Colour::all();
        return view('admin.product_image.edit', compact('image', 'products', 'colours'));
    }


    public function getColours($productId)
    {
        $colours = Colour::where('product_id', $productId)->get();
        return response()->json($colours);
    }




    public function update(Request $request, $id)
    {
        // Validate dữ liệu đầu vào
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'colour_id' => 'required|exists:colours,id',
            'image' => 'image|max:2048',
        ]);

        // Lấy hình ảnh từ cơ sở dữ liệu
        $product_images = ProductImage::find($id);

        // Nếu có hình ảnh mới, cập nhật file ảnh
        if ($request->hasFile('image')) {

            Storage::delete('public/' . $product_images->image_path);
            $imagePath = $request->file('image')->store('images', 'public');
            $product_images->image_path = $imagePath;
        }

        // Cập nhật thông tin khác
        $product_images->product_id = $request->product_id;
        $product_images->colour_id = $request->colour_id;
        $product_images->save();

        // Điều hướng về trang danh sách hình ảnh với thông báo thành công
        return redirect()->route('product_image.index')->with('success', 'Hình ảnh đã được cập nhật thành công.');
    }

    /**
     * Xóa một hình ảnh cụ thể khỏi cơ sở dữ liệu.
     */
    public function destroy($id)
    {
        // Lấy hình ảnh từ cơ sở dữ liệu
        $product_images = ProductImage::find($id);

        // Xóa file ảnh khỏi thư mục lưu trữ
        Storage::delete('public/' . $product_images->image_path);

        // Xóa bản ghi hình ảnh khỏi cơ sở dữ liệu
        $product_images->delete();

        // Điều hướng về trang danh sách hình ảnh với thông báo thành công
        return redirect()->route('product_image.index')->with('success', 'Hình ảnh đã được xóa thành công.');
    }
}
