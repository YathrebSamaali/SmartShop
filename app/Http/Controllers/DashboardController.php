<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $products = Product::latest()->take(8)->get(); // Récupère les 8 derniers produits
        return view('dashboard', compact('products'));
    }
}
