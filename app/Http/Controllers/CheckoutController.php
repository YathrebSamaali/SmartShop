<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function index()
    {
        $cartItems = $this->getCartItems();
        $total = $this->calculateCartTotal($cartItems);

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart')->with('error', 'Votre panier est vide');
        }

        return view('checkout.index', compact('cartItems', 'total'));
    }

    public function process(Request $request)
    {
        $validated = $request->validate([
            'customer_first_name' => 'required|string|max:255',
            'customer_last_name' => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'customer_phone' => 'required|string|max:20',
            'delivery_street' => 'required|string|max:255',
            'delivery_city' => 'required|string|max:255',
            'delivery_zip_code' => 'required|string|max:20',
            'delivery_country' => 'required|string|max:255',
            'delivery_method' => 'required|in:standard,express',
            'payment_method' => 'required|in:cash,credit_card,bank_transfer',
            'notes' => 'nullable|string'
        ]);

        DB::beginTransaction();

        try {
            $cartItems = $this->getCartItems();
            $subtotal = $this->calculateCartTotal($cartItems);
            $deliveryCost = $validated['delivery_method'] === 'express' ? 15.00 : 7.00;
            $total = $subtotal + $deliveryCost;

            $order = Order::create([
                'order_number' => 'ORD-' . Str::upper(Str::random(6)),
                'customer_first_name' => $validated['customer_first_name'],
                'customer_last_name' => $validated['customer_last_name'],
                'customer_email' => $validated['customer_email'],
                'customer_phone' => $validated['customer_phone'],
                'total' => $total,
                'subtotal' => $subtotal,
                'delivery_cost' => $deliveryCost,
                'tax_amount' => 0, // À adapter si vous avez des taxes
                'payment_method' => $validated['payment_method'],
                'delivery_method' => $validated['delivery_method'],
                'delivery_street' => $validated['delivery_street'],
                'delivery_city' => $validated['delivery_city'],
                'delivery_zip_code' => $validated['delivery_zip_code'],
                'delivery_country' => $validated['delivery_country'],
                'notes' => $validated['notes'] ?? null,
                'status' => 'pending'
            ]);

            foreach ($cartItems as $item) {
                $product = $item->product ?? Product::find($item['product_id']);

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'quantity' => $item['quantity'] ?? $item->quantity,
                    'price' => $item['price'] ?? $item->price ?? $product->price
                ]);
            }

            $this->clearCart();
            DB::commit();

            return redirect()->route('checkout.confirmation', $order->order_number)
                           ->with('success', 'Commande validée avec succès!');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Erreur lors du traitement de la commande: ' . $e->getMessage());
        }
    }

    public function confirmation($orderNumber)
    {
        $order = Order::with(['items.product'])
                     ->where('order_number', $orderNumber)
                     ->firstOrFail();

        return view('checkout.confirmation', compact('order'));
    }

    private function getCartItems()
{
    $items = auth()->check()
        ? $this->getAuthenticatedUserCartItems()
        : $this->getGuestCartItems();

    return $items->filter(function($item) {
        return $this->isValidCartItem($item);
    });
}

private function getAuthenticatedUserCartItems()
{
    return auth()->user()->cartItems()
        ->with(['product' => function($query) {
            $query->where('is_available', true);
        }])
        ->get();
}

private function getGuestCartItems()
{
    return collect(session('cart', []))->map(function ($item, $productId) {
        $product = Product::find($productId);

        return $product ? [
            'product_id' => $productId,
            'quantity' => $item['quantity'],
            'price' => $item['price'],
            'product' => $product
        ] : null;
    })->filter();
}

private function isValidCartItem($item)
{
    if (is_array($item)) {
        return isset($item['product']);
    }

    return $item->product !== null;
}
    private function calculateCartTotal($cartItems)
    {
        return $cartItems->sum(function($item) {
            $price = $item['price'] ?? $item->price ?? $item->product->price;
            $quantity = $item['quantity'] ?? $item->quantity;
            return $price * $quantity;
        });
    }

    private function clearCart()
    {
        if (auth()->check()) {
            auth()->user()->cartItems()->delete();
        } else {
            session()->forget('cart');
        }
    }
}
