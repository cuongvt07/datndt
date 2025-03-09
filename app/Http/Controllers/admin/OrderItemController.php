<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Battery;
use App\Models\Colour;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Screen;
use App\Models\Variant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class OrderItemController extends Controller
{

    public function create(Request $request)
    {
        $variants = Variant::all();
        $batterys = Battery::all();
        $colours = Colour::take(10)->get();
        $screens = Screen::all();
        $orderId = $request->input('order_id');
        $products = Product::all();
        
        return view('admin.orders.create', compact('orderId', 'products','variants','colours','batterys'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'total_price' => 'required|numeric|min:0',
            'shipping_fee' => 'required|numeric|min:0',
            'status' => 'required|in:pending,confirmed,delivering,completed,canceled',
            'phone' => 'required|string',
            'province' => 'nullable|string',
            'district' => 'nullable|string',
            'ward' => 'nullable|string',
            'detail_address' => 'nullable|string',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'variant_id' => 'nullable|exists:variants,id',
            'battery_id' => 'nullable|exists:batterys,id',
            'color_id' => 'nullable|exists:colours,id',
        ],[
            'phone.required' => 'Trường này bắt buộc phải nhập.',
            'province.required'=> 'Trường này bắt buộc phải nhập.',
            'district.required' => 'Trường này bắt buộc phải nhập.',
            'ward.nullable' => 'Trường này bắt buộc phải nhập.',
            'detail_address.nullable' => 'Trường này bắt buộc phải nhập.',
            'product_id.required' => 'Trường này bắt buộc phải nhập.',
            'quantity.required' => 'Trường này bắt buộc phải nhập.',
            'color_id.nullable' => 'Trường này bắt buộc phải nhập.',
            
        ]);
    
        $order = Order::create([
            'total_price' => $validated['total_price'],
            'shipping_fee'=>$validated['shipping_fee'],
            'status' => $validated['status'],
            'phone' => $validated['phone'],
            'province' => $validated['province'],
            'district' => $validated['district'],
            'ward' => $validated['ward'],
            'detail_address' => $validated['detail_address'],
        ]);
    
    
        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $validated['product_id'],
            'quantity' => $validated['quantity'],
            'price' => $validated['price'],
            'variant_id' => $validated['variant_id'] ?? null,
            'battery_id' => $validated['battery_id'] ?? null,
            'color_id' => $validated['color_id'] ?? null,
        ]);
    
        return redirect()->route('admin.orders.index')->with('success', 'Order and Order item created successfully.');
    }
    
}
