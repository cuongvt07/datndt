<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\Variant;
use Illuminate\Http\Request;

class ProductVariantController extends Controller
{

    public function index(Request $request)
    {
       
        $search = $request->get('search', '');
    
        
        $products = Product::where('name_sp', 'like', '%' . $search . '%')->paginate(8);
    
      
        $productVariants = ProductVariant::with(['product', 'variant'])
            ->when($search, function ($query, $search) {
                return $query->whereHas('product', function ($query) use ($search) {
                    $query->where('name_sp', 'like', '%' . $search . '%');
                })
                ->orWhereHas('variant', function ($query) use ($search) {
                    $query->where('ram_smartphone', 'like', '%' . $search . '%');
                });
            })
            ->get();
    
        
        return view('admin.product_variants.index', compact('productVariants', 'products'));
    }
    
    


    public function create(Request $request)
    {
        $query = Product::query();
    
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }
    
        if ($request->filled('name_sp')) {
            $query->where('name_sp', 'like', '%' . $request->name_sp . '%');
        }
    
        $products = $query->get();
    
        $variants = Variant::all(); 
    
        return view('admin.product_variants.create', compact('products', 'variants'));
    }
    
    

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'variant_id' => 'required|exists:variants,id',
          
        ],[
            'product_id.required' => 'Trường này bắt buộc phải nhập.',
            'variant_id.required'=> 'Trường này bắt buộc phải nhập.',
        ]);

        ProductVariant::create($request->all());

        return redirect()->route('product_variants.index')->with('success', 'Liên kết được tạo thành công!');
    }


    public function show($id)
    {
        $productVariant = ProductVariant::with(['product', 'variant'])->findOrFail($id);
        return view('admin.product_variants.show', compact('productVariant'));
    }


    public function edit($id)
    {
        $productVariant = ProductVariant::findOrFail($id);
        $products = Product::all();
        $variants = Variant::all();

        return view('admin.product_variants.edit', compact('productVariant', 'products', 'variants'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'variant_id' => 'required|exists:variants,id',
    
        ]);

        $productVariant = ProductVariant::findOrFail($id);
        $productVariant->update($request->all());

        return redirect()->route('product_variants.index')->with('success', 'Liên kết được cập nhật thành công!');
    }


    public function destroy($id)
    {
        $productVariant = ProductVariant::findOrFail($id);
        $productVariant->delete();

        return redirect()->route('product_variants.index')->with('success', 'Liên kết đã bị xóa!');
    }
}

