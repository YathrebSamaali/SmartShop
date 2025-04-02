<!-- resources/views/products/index.blade.php -->
@extends('layouts.app')

@section('content')
        @include('layouts.header')

        <!-- Header de la page -->
        <div class="flex justify-between items-center mb-8" >
            <h1 class="text-3xl font-bold">Liste des produits</h1>
            <div class="flex items-center space-x-4">
                <!-- Filtrage par catégorie -->
                <select id="categoryFilter" class="px-4 py-2 border rounded">
                    <option value="">Toutes les catégories</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category }}">{{ $category }}</option>
                    @endforeach
                </select>

                <!-- Filtrage par prix -->
                <select id="priceFilter" class="px-4 py-2 border rounded">
                    <option value="">Filtrer par prix</option>
                    <option value="asc">Prix croissant</option>
                    <option value="desc">Prix décroissant</option>
                </select>
            </div>
        </div>

        <!-- Total des produits -->
        <div class="mb-6">
            <p class="text-lg">Total des produits : {{ $products->count() }}</p>
        </div>

        <!-- Liste des produits -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8" id="product-list">
            @foreach ($products as $product)
                <div class="product-item bg-white rounded-lg shadow-lg p-4" data-category="{{ $product->category }}" data-price="{{ $product->price }}">
                    <h2 class="text-xl font-semibold text-gray-900">{{ $product->name }}</h2>
                    <p class="text-gray-700 mt-2">{{ $product->description }}</p>
                    <p class="text-lg font-semibold text-gray-800 mt-4">{{ number_format($product->price, 2) }} DT</p>
                    <p class="text-sm text-gray-500">Stock: {{ $product->stock }}</p>

                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-56 object-cover mt-4 rounded-lg">
                    <p class="text-sm text-gray-600 mt-2">Catégorie : {{ $product->category }}</p>

                    <!-- Bouton Ajouter au panier -->
                    <button class="mt-4 px-4 py-2 bg-blue-500 text-white rounded-lg add-to-cart" data-product-id="{{ $product->id }}">Ajouter au panier</button>
                </div>
            @endforeach
        </div>
    </div>


    <!-- Inclusion du fichier JS -->
    <script src="{{ asset('js/product.js') }}"></script> <!-- Lien vers le fichier product.js -->
@endsection
