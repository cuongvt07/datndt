<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderManagementController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');
    
     
        $orders = Order::with('user', 'orderItems.product')
            ->when($keyword, function ($query, $keyword) {
                return $query->where('id', 'like', "%{$keyword}%")
                    ->orWhereHas('user', function ($q) use ($keyword) {
                        $q->where('name_user', 'like', "%{$keyword}%");
                    });
            })
            ->orderBy('created_at', 'desc')
            ->paginate(11);
    
        return view('admin.orders.index', compact('orders'));
    }
    
    public function showCompletedOrders(Request $request)
    {
        $keyword = $request->input('keyword');

        $completedOrders = Order::with('user', 'orderItems.product')
            ->when($keyword, function ($query, $keyword) {
                return $query->where('id', 'like', "%{$keyword}%")
                    ->orWhereHas('user', function ($q) use ($keyword) {
                        $q->where('name_user', 'like', "%{$keyword}%");
                    });
            })
            ->where('status', 'completed')
            ->orderBy('created_at', 'desc')
            ->paginate(10);


        foreach ($completedOrders as $order) {
            $order->shipping_fee = $order->shipping_fee ?? 0;
        }

        return view('admin.orders.completed', compact('completedOrders'));
    }
    public function showCanceledOrders(Request $request)
    {
        $keyword = $request->input('keyword');

        $canceledOrders = Order::with('user', 'orderItems.product')
            ->when($keyword, function ($query, $keyword) {
                return $query->where('id', 'like', "%{$keyword}%")
                    ->orWhereHas('user', function ($q) use ($keyword) {
                        $q->where('name_user', 'like', "%{$keyword}%");
                    });
            })
            ->where('status', 'canceled')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        foreach ($canceledOrders as $order) {
            $order->shipping_fee = $order->shipping_fee ?? 0;
        }

        return view('admin.orders.canceled', compact('canceledOrders'));
    }







    public function show(Order $order)
    {

        $shipping_fee = $order->shipping_fee ?? 0;

        return view('admin.orders.show', compact('order', 'shipping_fee'));
    }


    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,delivering,completed,canceled',
        ]);

        if (in_array($order->status, ['completed', 'canceled'])) {
            return redirect()->route('admin.orders')->with('error', 'Không thể cập nhật trạng thái đơn hàng đã hoàn thành hoặc bị hủy.');
        }

        if ($request->status === 'canceled') {
            // if ($order->status !== 'completed') {
            //     return redirect()->route('admin.orders')->with('error', 'Chỉ có thể hủy đơn khi trạng thái đang không ở "Hoàn thành".');
            // }

            $order->update([
                'status' => 'canceled',
                'cancel_reason' => 'Hủy do admin: ' . auth()->user()->name,
            ]);

            return redirect()->route('admin.orders')->with('success', 'Đơn hàng đã được hủy thành công.');
        }

        $validTransitions = [
            'pending' => ['confirmed'],
            'confirmed' => ['delivering'],
            'delivering' => ['completed'],
        ];

        if (isset($validTransitions[$order->status]) && !in_array($request->status, $validTransitions[$order->status])) {
            return redirect()->route('admin.orders')->with('error', 'Trạng thái không hợp lệ.');
        }

        $order->update([
            'status' => $request->status,
        ]);

        return redirect()->route('admin.orders')->with('success', 'Cập nhật trạng thái đơn hàng thành công.');
    }
}
