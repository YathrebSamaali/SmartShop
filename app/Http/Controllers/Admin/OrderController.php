<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class OrderController extends Controller
{
    /**
     * Display a listing of orders with search and filters
     */
    public function index()
    {
        $orders = Order::query()
            ->when(request('search'), function($query) {
                $search = request('search');
                $query->where(function($q) use ($search) {
                    $q->where('order_number', 'like', '%'.$search.'%')
                      ->orWhere('customer_first_name', 'like', '%'.$search.'%')
                      ->orWhere('customer_last_name', 'like', '%'.$search.'%')
                      ->orWhere('customer_email', 'like', '%'.$search.'%')
                      ->orWhere('customer_phone', 'like', '%'.$search.'%');
                });
            })
            ->when(request('status'), function($query) {
                $query->where('status', request('status'));
            })
            ->when(request('payment_method'), function($query) {
                $query->where('payment_method', request('payment_method'));
            })
            ->with(['orderItems.product'])
            ->latest()
            ->paginate(5);

        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Display the specified order with details
     */
    public function show(Order $order)
    {
        $order->load(['orderItems.product']);
        return view('admin.orders.show', compact('order'));
    }

    /**
     * Remove the specified order from storage
     */
    public function destroy(Order $order)
    {
        try {
            $order->orderItems()->delete();
            $order->delete();

            return redirect()->route('admin.orders.index')
                   ->with('success', 'Order deleted successfully');
        } catch (\Exception $e) {
            return redirect()->back()
                   ->with('error', 'Error deleting order: '.$e->getMessage());
        }
    }

    /**
     * Update order status
     */
    public function updateStatus(Request $request, Order $order)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,processing,completed,cancelled'
        ]);

        try {
            $order->update(['status' => $validated['status']]);
            return back()->with('success', 'Order status updated successfully');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to update status: '.$e->getMessage());
        }
    }

    /**
     * Generate order invoice PDF
     */
    public function invoice(Order $order)
    {
        try {
            $order->load(['orderItems.product']);
            $pdf = PDF::loadView('admin.orders.invoice', compact('order'))
                    ->setPaper('a4', 'portrait');

            return $pdf->download('invoice_'.$order->order_number.'.pdf');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to generate invoice: '.$e->getMessage());
        }
    }
}