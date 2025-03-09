<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function store(Request $request)
    {
        // Validation de l'image
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validation pour l'image
        ]);

        // Téléchargement de l'image
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public'); // Sauvegarde de l'image dans le dossier 'storage/app/public/products'
        } else {
            $imagePath = null; // Si aucune image n'est téléchargée
        }

        // Création du produit avec l'image
        Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'image' => $imagePath, // Ajoutez l'image dans la base de données
        ]);

        return redirect()->route('products.index')->with('success', 'Produit ajouté avec succès.');
    }
}
