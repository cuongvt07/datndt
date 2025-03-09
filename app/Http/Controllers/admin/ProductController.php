<?php

namespace App\Http\Controllers\admin;

use App\Models\Battery;
use App\Models\Category;
use App\Models\Colour;
use App\Models\Product;
use App\Models\Screen;
use App\Models\Supplier;
use App\Models\Variant;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->keyword;
        $supplierId = $request->supplier_id;
    
        $products = Product::query()
            ->when($keyword, function ($query, $keyword) {
                return $query->where('name_sp', 'like', '%' . $keyword . '%');
            })
            ->when($supplierId, function ($query, $supplierId) {
                return $query->where('supplier_id', $supplierId);
            })
            ->orderBy('id', 'desc')
            ->paginate(8);
    
        if ($request->ajax()) {
            return response()->json([
                'html' => view('admin.products.partials.product_list', compact('products'))->render()
            ]);
        }
    
        return view('admin.products.index', compact('products'));
    }
    
    
    public function show($id)
    {
        $variants = Variant::all();
        
        $product = Product::with(['productImages', 'variant'])->findOrFail($id);
        return view('admin.products.show', compact('variants', 'product'));
    }
    public function search(Request $request)
    {
        $query = $request->input('query');
        $products = Product::where('name_sp', 'LIKE', '%' . $query . '%')->get();

        return response()->json($products);
    }

    public function create()
    {
        $variants = Variant::all();
        $categories = Category::all();
        $suppliers = Supplier::all();
        $batterys = Battery::all();
        $colours = Colour::take(10)->get();
        $screens = Screen::all();
        return view('admin.products.create', compact('variants', 'categories', 'suppliers', 'batterys', 'colours', 'screens'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name_sp' => 'required',
            'image' => 'required|image',
            'description' => 'required',
            'price' => 'required|numeric',
            'category_id' => 'nullable|exists:categories,id',
            'supplier_id' => 'nullable|exists:suppliers,id',
            'battery_id' => 'nullable|exists:batterys,id',
            'screen_id' => 'nullable|exists:screens,id',
        ],[
            'name_sp.required' => 'Trường này bắt buộc phải nhập.',
            'description'=> 'Trường này bắt buộc phải nhập.',
            'image.required' => 'Vui lòng chọn một hình ảnh.',
            'price.required' => 'Giá không được bỏ trống.',
            'category_id.exists' => 'Danh mục không hợp lệ.',
            'supplier_id.exists' => 'Nhà cung cấp không hợp lệ.',
        ]);
    

        $data = $request->all();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('images', 'public');
        }

        Product::create($data);
        return redirect()->route('products.index')->with('success', 'Sản phẩm đã được tạo thành công.');
    }

    public function edit(Product $product)
    {
        $variants = Variant::all();
        $categories = Category::all();
        $suppliers = Supplier::all();
        $batterys = Battery::all();
        $colours = Colour::take(10)->get();
        $screens = Screen::all();
        return view('admin.products.edit', compact('product', 'variants', 'categories', 'suppliers', 'batterys', 'colours', 'screens'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name_sp' => 'required',
            'image' => 'nullable|image',
            'description' => 'nullable',
            'price' => 'required|numeric',
            'category_id' => 'nullable|exists:categories,id',
            'supplier_id' => 'nullable|exists:suppliers,id',
            'battery_id' => 'nullable|exists:batterys,id',
            'screen_id' => 'nullable|exists:screens,id',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            if ($product->image) {

                Storage::disk('public')->delete($product->image);
            }

            $data['image'] = $request->file('image')->store('images', 'public');
        }

        $product->update($data);

        return redirect()->route('products.index')->with('success', 'Sản phẩm đã được cập nhật thành công.');
    }

    public function destroy(Product $product)
    {
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();
        return redirect()->route('products.index')->with('success', 'Sản phẩm đã được xóa thành công.');
    }
    public function toggleActive(Product $product)
    {
        $product->is_active = !$product->is_active;
        $product->save();

        return redirect()->route('products.index')->with('success', 'Trạng thái sản phẩm đã được cập nhật.');
    }
}
