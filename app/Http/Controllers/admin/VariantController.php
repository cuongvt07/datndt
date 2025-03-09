<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Variant;
use Illuminate\Http\Request;

class VariantController extends Controller
{
    public function index()
    {
        $variants = Variant::all();
        return view('admin.variants.index', compact('variants'));
    }


    public function create()
    {
        return view('admin.variants.create');
    }


    public function store(Request $request)
    {

        $validated = $request->validate([
            'ram_smartphone' => 'required|string|max:255',
            'price' => 'required',
            
        ],[
            'ram_smartphone.required' => 'Trường này bắt buộc phải nhập.',
            'price.required'=> 'Trường này bắt buộc phải nhập.',
        ]);

        Variant::create($validated);


        return redirect()->route('variants.index')->with('success', 'Variant created successfully.');
    }

    public function edit(Variant $variant)
    {
        return view('admin.variants.edit', compact('variant'));
    }


    public function update(Request $request, Variant $variant)
    {

        $validated = $request->validate([
            'ram_smartphone' => 'required|string|max:255',
            'price' => 'required',
        ]);

        $variant->update($validated);

        return redirect()->route('variants.index')->with('success', 'Variant updated successfully.');
    }

    public function destroy(Variant $variant)
    {
       
        $variant->delete();


        return redirect()->route('variants.index')->with('success', 'Variant deleted successfully.');
    }
}
