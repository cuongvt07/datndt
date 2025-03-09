<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Supplier;

class SupplierController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();
    
 
        $search = $request->get('search', '');
    
        $suppliers = Supplier::when($search, function ($query, $search) {
            return $query->where('name', 'like', '%' . $search . '%')
                         ->orWhere('brand', 'like', '%' . $search . '%');
        })->paginate(8); 
    
        return view('admin.suppliers.index', compact('categories', 'suppliers'));
    }
    

    public function create()
    {
        $categories = Category::all(); 
        return view('admin.suppliers.create', compact('categories')); 
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
        ],[
            'name.required' => 'Trường này bắt buộc phải nhập.',
            'brand.required'=> 'Trường này bắt buộc phải nhập.',
            'category_id.required' => 'Trường này bắt buộc phải nhập.',
        ]);

        Supplier::create($validated);

        return redirect()->route('suppliers.index')->with('success', 'Supplier created successfully.');
    }

    public function edit(Supplier $supplier)
    {
        $categories = Category::all(); 
        return view('admin.suppliers.edit', compact('supplier', 'categories'));
    }

    public function update(Request $request, Supplier $supplier)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
        ]);

        $supplier->update($validated);

        return redirect()->route('suppliers.index')->with('success', 'Supplier updated successfully.');
    }

    public function destroy(Supplier $supplier)
    {
        $supplier->delete();

        return redirect()->route('suppliers.index')->with('success', 'Supplier deleted successfully.');
    }
}
