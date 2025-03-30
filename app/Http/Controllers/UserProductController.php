<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class UserProductController extends Controller

{


    public function index()
{
    $products = Product::all();
    $categories = Product::distinct()->pluck('category'); // Récupère toutes les catégories distinctes

    return view('products.index', compact('products', 'categories'));
}

    public function welcome()
    {
        $products = Product::all();
        return view('welcome', compact('products'));
    }

    // ✅ Ajout de la méthode show
    public function show($id)
    {
        $product = Product::findOrFail($id);  // Récupère le produit par ID
        return view('product.show', compact('product'));  // Assure-toi que la vue 'product.show' existe
    }

}
