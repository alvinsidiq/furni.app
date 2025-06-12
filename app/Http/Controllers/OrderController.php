<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('orderItems')->get();
        return view('orders.index', compact('orders'));
    }

    public function create()
    {
        return view('orders.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'nullable|exists:users,id',
            'total_amount' => 'required|numeric',
            'status' => 'required|string',
            'order_items' => 'required|array',
            'order_items.*.furnitures_id' => 'required|exists:furnitures,id',
            'order_items.*.quantity' => 'required|integer|min:1',
            'order_items.*.price' => 'required|numeric',
        ]);

        $order = Order::create([
            'user_id' => $request->user_id,
            'total_amount' => $request->total_amount,
            'status' => $request->status,
        ]);

        foreach ($request->order_items as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'furnitures_id' => $item['furnitures_id'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);
        }

        return redirect()->route('orders.index')->with('success', 'Order created successfully.');
    }

    public function show(Order $order)
    {
        $order->load('orderItems.furnitures');
        return view('orders.show', compact('order'));
    }

    public function edit(Order $order)
    {
        $order->load('orderItems.furnitures');
        return view('orders.edit', compact('order'));
    }

    public function update(Request $request, Order $order)
    {
        $request->validate([
            'user_id' => 'nullable|exists:users,id',
            'total_amount' => 'required|numeric',
            'status' => 'required|string',
            'order_items' => 'required|array',
            'order_items.*.id' => 'nullable|exists:order_items,id',
            'order_items.*.furnitures_id' => 'required|exists:furnitures,id',
            'order_items.*.quantity' => 'required|integer|min:1',
            'order_items.*.price' => 'required|numeric',
        ]);

        $order->update([
            'user_id' => $request->user_id,
            'total_amount' => $request->total_amount,
            'status' => $request->status,
        ]);

        $order->orderItems()->delete();
        foreach ($request->order_items as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'furnitures_id' => $item['furnitures_id'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);
        }

        return redirect()->route('orders.index')->with('success', 'Order updated successfully.');
    }

    public function destroy(Order $order)
    {
        $order->orderItems()->delete();
        $order->delete();
        return redirect()->route('orders.index')->with('success', 'Order deleted successfully.');
    }
}