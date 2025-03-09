<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\Variant;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        

        $keyword = $request->keyword;
        $variants = Variant::with('products')->get();

       
        $products = Product::where('name_sp', 'like', '%' . $keyword . '%')->get();

        return view('user.shop', compact('products','variants'));
    }
}
