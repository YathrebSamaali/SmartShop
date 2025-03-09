<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Affiche la page des produits
    public function index()
    {
        return view('products.index');  // Retourne la vue des produits
    }
}
