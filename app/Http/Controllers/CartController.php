<?php

namespace App\Http\Controllers;

use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        if (auth()->check()) {
            $cartItems = OrderItem::with('product')
                ->where('user_id', auth()->id())
                ->whereNull('order_id')
                ->get();
        } else {
            $cartItems = collect();
            $sessionCart = session()->get('cart', []);

            if (!empty($sessionCart)) {
                $productIds = array_keys($sessionCart);
                $products = Product::whereIn('id', $productIds)->get();

                foreach ($products as $product) {
                    $cartItems->push((object)[
                        'product' => $product,
                        'quantity' => $sessionCart[$product->id]['quantity']
                    ]);
                }
            }
        }

        return view('cart.index', compact('cartItems'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'nullable|integer|min:1'
        ]);

        $productId = $request->product_id;
        $quantity = $request->quantity ?? 1;

        if (auth()->check()) {
            $cartItem = OrderItem::firstOrNew([
                'user_id' => auth()->id(),
                'product_id' => $productId,
                'order_id' => null
            ]);

            $cartItem->quantity = ($cartItem->quantity ?? 0) + $quantity;
            $cartItem->save();
        } else {
            $cart = session()->get('cart', []);

            if (isset($cart[$productId])) {
                $cart[$productId]['quantity'] += $quantity;
            } else {
                $cart[$productId] = [
                    'product_id' => $productId,
                    'quantity' => $quantity
                ];
            }

            session()->put('cart', $cart);
        }

        return response()->json([
            'success' => true,
            'cart_count' => self::getCartCount(),
            'message' => 'Produit ajouté au panier'
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        if (auth()->check()) {
            $cartItem = OrderItem::where('user_id', auth()->id())
                ->where('id', $id)
                ->firstOrFail();

            $cartItem->update(['quantity' => $request->quantity]);
        } else {
            $cart = session()->get('cart', []);

            if (isset($cart[$id])) {
                $cart[$id]['quantity'] = $request->quantity;
                session()->put('cart', $cart);
            }
        }

        return back()->with('success', 'Panier mis à jour');
    }

    public function destroy($id)
    {
        if (auth()->check()) {
            OrderItem::where('user_id', auth()->id())
                ->where('id', $id)
                ->delete();
        } else {
            $cart = session()->get('cart', []);
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return back()->with('success', 'Produit retiré du panier');
    }

    public static function getCartCount()
    {
        if (auth()->check()) {
            return OrderItem::where('user_id', auth()->id())
                ->whereNull('order_id')
                ->count();
        }

        return count(session()->get('cart', []));
    }
}
