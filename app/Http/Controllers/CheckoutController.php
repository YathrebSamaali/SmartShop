<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        // Valider les données manuellement
        $requiredFields = [
            'first_name', 'last_name', 'email', 'phone', 
            'address', 'city', 'zip_code', 'country',
            'delivery_method', 'payment_method'
        ];
        
        foreach ($requiredFields as $field) {
            if (empty($request->$field)) {
                return back()->with('error', "Le champ $field est requis");
            }
        }
    
        DB::beginTransaction();
    
        try {
            // Calcul des montants
            $subtotal = 0;
            $cartItems = $this->getCartItems();
            
            foreach ($cartItems as $item) {
                $subtotal += ($item->price ?? $item->product->price) * $item->quantity;
            }
            
            $deliveryCost = $request->delivery_method === 'express' ? 15.00 : 7.00;
            $total = $subtotal + $deliveryCost;
    
            // Insertion directe en SQL
            $orderNumber = 'CMD-' . date('YmdHis') . rand(100, 999);
            
            DB::insert("
                INSERT INTO orders (
                    order_number, user_id, customer_first_name, customer_last_name,
                    customer_email, customer_phone, subtotal, delivery_cost, total,
                    status, payment_method, payment_status, delivery_method,
                    delivery_street, delivery_city, delivery_zip_code, delivery_country,
                    created_at, updated_at
                ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW())
            ", [
                $orderNumber,
                auth()->id(),
                $request->first_name,
                $request->last_name,
                $request->email,
                $request->phone,
                $subtotal,
                $deliveryCost,
                $total,
                'pending',
                $request->payment_method,
                'pending',
                $request->delivery_method,
                $request->address,
                $request->city,
                $request->zip_code,
                $request->country
            ]);
    
            $orderId = DB::getPdo()->lastInsertId();
    
            // Insertion des articles
            foreach ($cartItems as $item) {
                DB::insert("
                    INSERT INTO order_items (
                        order_id, product_id, user_id, quantity, price, total, created_at, updated_at
                    ) VALUES (?, ?, ?, ?, ?, ?, NOW(), NOW())
                ", [
                    $orderId,
                    $item->product_id ?? $item->product->id,
                    auth()->id(),
                    $item->quantity,
                    $item->price ?? $item->product->price,
                    ($item->price ?? $item->product->price) * $item->quantity
                ]);
            }
    
            // Vider le panier
            if (auth()->check()) {
                DB::delete("DELETE FROM order_items WHERE user_id = ? AND order_id IS NULL", [auth()->id()]);
            } else {
                session()->forget('cart');
            }
    
            DB::commit();
    
            return redirect()->route('checkout.confirmation', ['order' => $orderNumber])
                           ->with('success', 'Commande validée!');
    
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Erreur: ' . $e->getMessage());
        }
    }
    public function confirmation($orderNumber)
    {
        $order = Order::where('order_number', $orderNumber)
                    ->with('items.product')
                    ->firstOrFail();

        return view('checkout.confirmation', compact('order'));
    }

    private function getCartItems()
    {
        if (auth()->check()) {
            return OrderItem::with('product')
                ->where('user_id', auth()->id())
                ->whereNull('order_id')
                ->get();
        }

        $sessionItems = session('cart', []);
        $items = collect();

        if (!empty($sessionItems)) {
            $products = Product::whereIn('id', array_keys($sessionItems))->get();
            
            foreach ($products as $product) {
                $items->push((object)[
                    'product' => $product,
                    'product_id' => $product->id,
                    'quantity' => $sessionItems[$product->id]['quantity'],
                    'price' => $sessionItems[$product->id]['price'] ?? $product->price
                ]);
            }
        }

        return $items;
    }

    private function calculateCartTotal($cartItems)
    {
        return $cartItems->sum(function($item) {
            return ($item->price ?? $item->product->price) * $item->quantity;
        });
    }

    private function clearCart()
    {
        if (auth()->check()) {
            OrderItem::where('user_id', auth()->id())
                   ->whereNull('order_id')
                   ->delete();
        } else {
            session()->forget('cart');
        }
    }
}