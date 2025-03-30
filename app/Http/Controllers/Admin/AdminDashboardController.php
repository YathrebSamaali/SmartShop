<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Order;    // Table orders
use App\Models\Product;  // Table products
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function dashboard()
    {
        // Statistiques de base
        $stats = [
            'usersCount' => User::count(),
            'ordersCount' => Order::count(),
            'productsCount' => Product::count(),
            'revenue' => Order::sum('total') // Utilisation du champ 'total' de la table orders
        ];

        // Calcul des tendances (simplifié)
        $growth = [
            'users' => $this->calculateGrowth(User::class),
            'orders' => $this->calculateGrowth(Order::class),
            'products' => $this->calculateGrowth(Product::class),
            'revenue' => $this->calculateRevenueGrowth()
        ];

        // Dernières commandes (remplace l'activité récente)
        $recentOrders = Order::with('user')
                          ->latest()
                          ->take(5)
                          ->get();

        // Produits avec stock faible
        $lowStockProducts = Product::where('stock', '<', 10)
                                 ->orderBy('stock')
                                 ->take(5)
                                 ->get();

        return view('admin.dashboard', array_merge($stats, $growth, [
            'recentOrders' => $recentOrders,
            'lowStockProducts' => $lowStockProducts
        ]));
    }

    private function calculateGrowth($model)
    {
        $current = $model::whereMonth('created_at', now()->month)->count();
        $previous = $model::whereMonth('created_at', now()->subMonth()->month)->count();

        return $previous > 0 ? round(($current - $previous) / $previous * 100, 2) : 0;
    }

    private function calculateRevenueGrowth()
    {
        $current = Order::whereMonth('created_at', now()->month)->sum('total');
        $previous = Order::whereMonth('created_at', now()->subMonth()->month)->sum('total');

        return $previous > 0 ? round(($current - $previous) / $previous * 100, 2) : 0;
    }
}
