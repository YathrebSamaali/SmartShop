<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Support\Collection;
use App\Http\Controllers\Controller; // ✅ Vérifie que cette ligne est bien là

class AnalyticsController extends Controller
{
    /**
     * 📌 Prédiction des ventes avec une régression linéaire simple (+10%)
     */
    public function predictSales()
    {
        // 1️⃣ Récupérer les ventes totales par produit
        $sales = OrderItem::selectRaw('product_id, SUM(quantity) as total_sales')
                          ->groupBy('product_id')
                          ->get();

        // 2️⃣ Appliquer une prévision simple (+10%)
        $predictions = $sales->map(function ($sale) {
            $sale->predicted_sales = $sale->total_sales * 1.1;  // Augmentation de 10%
            return $sale;
        });

        // 3️⃣ Passer les données à la vue 'analytics'
        return view('analytics', compact('sales', 'predictions'));
    }

    /**
     * 📌 Recommandation de produits basée sur le filtrage collaboratif
     */
    public function recommendProducts($customer_id)
    {
        // 1️⃣ Récupérer toutes les commandes du client
        $customer_orders = Order::where('customer_id', $customer_id)->pluck('id');

        // 2️⃣ Trouver les produits que le client a déjà achetés
        $purchased_products = OrderItem::whereIn('order_id', $customer_orders)
                                       ->pluck('product_id');

        // 3️⃣ Trouver les produits populaires que ce client n'a pas achetés
        $recommended_products = OrderItem::whereNotIn('product_id', $purchased_products)
                                         ->selectRaw('product_id, COUNT(*) as popularity')
                                         ->groupBy('product_id')
                                         ->orderByDesc('popularity')
                                         ->take(5) // On prend les 5 produits les plus populaires
                                         ->get();

        // 4️⃣ Passer les recommandations à la vue 'recommendations'
        return view('recommendations', compact('recommended_products'));
    }
}
