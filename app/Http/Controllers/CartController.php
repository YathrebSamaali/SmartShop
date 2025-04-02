<?php

namespace App\Http\Controllers;

use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
                        'id' => $product->id, // Added ID for consistency
                        'product' => $product,
                        'quantity' => $sessionCart[$product->id]['quantity'],
                        'price' => $sessionCart[$product->id]['price'] ?? $product->price // Added price
                    ]);
                }
            }
        }

        $total = $cartItems->sum(function($item) {
            return ($item->price ?? $item->product->price) * $item->quantity;
        });

        return view('cart.index', compact('cartItems', 'total'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'nullable|integer|min:1'
        ]);

        $product = Product::findOrFail($request->product_id);
        $quantity = $request->quantity ?? 1;

        if (auth()->check()) {
            $cartItem = OrderItem::updateOrCreate(
                [
                    'user_id' => auth()->id(),
                    'product_id' => $product->id,
                    'order_id' => null
                ],
                [
                    'quantity' => DB::raw("quantity + $quantity"),
                    'price' => $product->price // Save price at time of addition
                ]
            );
        } else {
            $cart = session()->get('cart', []);

            if (isset($cart[$product->id])) {
                $cart[$product->id]['quantity'] += $quantity;
            } else {
                $cart[$product->id] = [
                    'product_id' => $product->id,
                    'quantity' => $quantity,
                    'price' => $product->price,
                    'name' => $product->name,
                    'image' => $product->image
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

    // app/Http/Controllers/CartController.php
    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);
    
        if (auth()->check()) {
            $cartItem = OrderItem::where('user_id', auth()->id())->findOrFail($id);
            $cartItem->update(['quantity' => $request->quantity]);
        } else {
            $cartItem = $this->updateSessionCart($id, $request->quantity);
        }
    
        return response()->json([
            'success' => true,
            'item_total' => $cartItem->price * $request->quantity,
            'cart_total' => $this->calculateCartTotal(),
            'cart_count' => self::getCartCount(),
            'message' => 'Quantité mise à jour avec succès'
        ]);
    }
    
    private function updateSessionCart($id, $quantity)
    {
        $cart = session()->get('cart', []);
        
        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = $quantity;
            session()->put('cart', $cart);
            
            // Retourne un objet avec une structure sécurisée
            return (object)[
                'id' => $id,
                'price' => $cart[$id]['price'] ?? 0,
                'quantity' => $quantity,
                'product' => (object)[
                    'name' => $cart[$id]['product_name'] ?? $cart[$id]['name'] ?? 'Produit inconnu',
                    'image' => $cart[$id]['image'] ?? $cart[$id]['product_image'] ?? null
                ]
            ];
        }
        
        abort(404, 'Produit non trouvé dans le panier');
    }    public function destroy($id)
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
        // Pour les utilisateurs connectés
        return OrderItem::where('user_id', auth()->id())->count();
    } else {
        // Pour les invités (panier en session)
        return count(session()->get('cart', []));
    }
}

    public function transferSessionCartToUser($userId)
    {
        $sessionCart = session('cart', []);
        $transferredItems = [];

        if (!empty($sessionCart)) {
            foreach ($sessionCart as $productId => $item) {
                try {
                    $cartItem = OrderItem::updateOrCreate(
                        [
                            'user_id' => $userId,
                            'product_id' => $productId,
                            'order_id' => null
                        ],
                        [
                            'quantity' => DB::raw("quantity + {$item['quantity']}"),
                            'price' => $item['price']
                        ]
                    );

                    $transferredItems[] = [
                        'product_id' => $productId,
                        'quantity' => $item['quantity']
                    ];

                } catch (\Exception $e) {
                    Log::error("Échec du transfert d'un article du panier", [
                        'user_id' => $userId,
                        'product_id' => $productId,
                        'error' => $e->getMessage()
                    ]);
                    continue;
                }
            }
            
            session()->forget('cart');
        }

        return $transferredItems;
 
    }
    protected function calculateCartTotal()
{
    if (auth()->check()) {
        // Pour les utilisateurs connectés
        return OrderItem::where('user_id', auth()->id())
            ->get()
            ->sum(function($item) {
                return $item->price * $item->quantity;
            });
    } else {
        // Pour les invités (panier en session)
        $total = 0;
        $cart = session()->get('cart', []);
        
        foreach ($cart as $item) {
            $total += ($item['price'] ?? 0) * ($item['quantity'] ?? 1);
        }
        
        return $total;
    }
}
}