<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\CartController;

class TransferCartMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Vérifie si l'utilisateur vient de se connecter et a un panier en session
        if (auth()->check() && session()->has('cart')) {
            try {
                $userId = auth()->id();
                $cartItemsCount = count(session('cart'));

                Log::info("Transfert du panier session vers l'utilisateur", [
                    'user_id' => $userId,
                    'items_count' => $cartItemsCount
                ]);

                // Transfert des articles du panier
                $transferred = app(CartController::class)->transferSessionCartToUser($userId);

                Log::info("Panier transféré avec succès", [
                    'user_id' => $userId,
                    'transferred_items' => $transferred
                ]);

                // Suppression du panier session seulement si le transfert a réussi
                session()->forget('cart');

            } catch (\Exception $e) {
                Log::error("Échec du transfert du panier", [
                    'user_id' => $userId ?? null,
                    'error' => $e->getMessage(),
                    'trace' => $e->getTraceAsString()
                ]);

                // On continue quand même la requête mais sans supprimer le panier session
            }
        }

        return $next($request);
    }
}
