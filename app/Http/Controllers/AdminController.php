<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;

class AdminController extends Controller
{
    // Méthode pour afficher le tableau de bord admin
    public function dashboard()
    {
        // Récupère le nombre total de commandes et produits
        $totalOrders = Order::count();
        $totalProducts = Product::count();

        // Retourne la vue du tableau de bord avec les données
        return view('admin.dashboard', compact('totalOrders', 'totalProducts'));
    }

    // Méthode pour gérer les produits
    public function manageProducts()
    {
        // Récupère tous les produits
        $products = Product::all();

        // Retourne la vue de gestion des produits
        return view('admin.products', compact('products'));
    }

    // Méthode pour gérer les commandes
    public function manageOrders()
    {
        // Récupère toutes les commandes avec les informations des clients
        $orders = Order::with('customer')->get();

        // Retourne la vue de gestion des commandes
        return view('admin.orders', compact('orders'));
    }
}
