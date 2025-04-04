<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Calcul des statistiques clients
        $totalCustomers = User::where('role', 'customer')->count();
        $lastMonthCustomers = User::where('role', 'customer')
            ->where('created_at', '>=', Carbon::now()->subMonth())
            ->count();
        $customerGrowth = $lastMonthCustomers > 0
            ? round(($totalCustomers - $lastMonthCustomers) / $lastMonthCustomers * 100, 2)
            : 0;

        // Calcul des statistiques produits
        $totalProducts = Product::count();
        $inStockProducts = Product::where('stock', '>', 5)->count();
        $lowStockProducts = Product::where('stock', '<=', 5)->where('stock', '>', 0)->count();

        // Calcul des statistiques commandes
        $totalOrders = Order::count();
        $lastMonthOrders = Order::where('created_at', '>=', Carbon::now()->subMonth())->count();
        $orderGrowth = $lastMonthOrders > 0
            ? round(($totalOrders - $lastMonthOrders) / $lastMonthOrders * 100, 2)
            : 0;

        // Calcul des revenus
        $totalRevenue = Order::where('status', '!=', 'cancelled')->sum('total');
        $monthlyRevenue = Order::where('status', '!=', 'cancelled')
            ->where('created_at', '>=', Carbon::now()->startOfMonth())
            ->sum('total');
        $weeklyRevenue = Order::where('status', '!=', 'cancelled')
            ->where('created_at', '>=', Carbon::now()->startOfWeek())
            ->sum('total');

        // Répartition du revenu
        $revenueBreakdown = [
            'products' => Order::where('status', '!=', 'cancelled')->sum('subtotal'),
            'shipping' => Order::where('status', '!=', 'cancelled')->sum('delivery_cost'),
            'taxes' => Order::where('status', '!=', 'cancelled')->sum('tax_amount')
        ];

        // Données pour le graphique des ventes
        $salesData = Order::select(
                DB::raw('MONTH(created_at) as month'),
                DB::raw('YEAR(created_at) as year'),
                DB::raw('SUM(total) as total')
            )
            ->where('status', '!=', 'cancelled')
            ->where('created_at', '>=', Carbon::now()->subYear())
            ->groupBy('year', 'month')
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get();

        $salesChart = [
            'labels' => [],
            'data' => []
        ];

        foreach ($salesData as $sale) {
            $date = Carbon::createFromDate($sale->year, $sale->month, 1);
            $salesChart['labels'][] = $date->format('M Y');
            $salesChart['data'][] = $sale->total;
        }

        // Commandes récentes
        $recentOrders = Order::with('items')
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();

        // Produits les plus vendus
        $topProducts = Product::select('products.*', DB::raw('SUM(order_items.quantity) as total_sold'))
            ->join('order_items', 'products.id', '=', 'order_items.product_id')
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->where('orders.status', '!=', 'cancelled')
            ->groupBy('products.id')
            ->orderBy('total_sold', 'desc')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalCustomers',
            'customerGrowth',
            'totalProducts',
            'inStockProducts',
            'lowStockProducts',
            'totalOrders',
            'orderGrowth',
            'totalRevenue',
            'monthlyRevenue',
            'weeklyRevenue',
            'revenueBreakdown',
            'salesChart',
            'recentOrders',
            'topProducts'
        ));
    }
}
