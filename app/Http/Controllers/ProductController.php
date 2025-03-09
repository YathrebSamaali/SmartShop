<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        // Charger uniquement les 2 premiers produits
        $products = Product::take(4)->get();
        return view('products.index', compact('products'));
    }

    public function store(Request $request)
{
    // Validation des données
    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'price' => 'required|numeric',
        'stock' => 'required|integer',
        'category' => 'required|in:Men,Women,Shoes', // Category validation
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    // Traitement de l'image
    $imagePath = $request->hasFile('image') ? $request->file('image')->store('products', 'public') : null;

    // Création du produit
    Product::create([
        'name' => $request->name,
        'description' => $request->description,
        'price' => $request->price,
        'stock' => $request->stock,
        'category' => $request->category, // Ajouter la catégorie au produit
        'image' => $imagePath,
    ]);

    return redirect()->route('products.index')->with('success', 'Produit ajouté avec succès.');
}
}
