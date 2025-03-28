<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller; // Assurez-vous d'étendre Controllerpace App\Http\Controllers;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::all();
        return view('admin.orders.index', compact('orders'));
    }

    public function create()
    {
        return view('admin.orders.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required',
            'product_name' => 'required',
            'amount' => 'required|numeric',
        ]);

        Order::create($request->all());

        return redirect()->route('admin.orders.index')->with('success', 'Order created successfully');
    }

    public function show(Order $order)
    {
        return view('admin.orders.show', compact('order'));
    }

    public function edit(Order $order)
    {
        return view('admin.orders.edit', compact('order'));
    }

    public function update(Request $request, Order $order)
    {
        $request->validate([
            'customer_name' => 'required',
            'product_name' => 'required',
            'amount' => 'required|numeric',
        ]);

        $order->update($request->all());

        return redirect()->route('admin.orders.index')->with('success', 'Order updated successfully');
    }

    public function destroy(Order $order)
    {
        $order->delete();

        return redirect()->route('admin.orders.index')->with('success', 'Order deleted successfully');
    }
}
