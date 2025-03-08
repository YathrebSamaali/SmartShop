@extends('layouts.app')

@section('content')
<div class="container">
    <h2>🔍 Produits recommandés</h2>
    <ul>
        @foreach ($recommended_products as $product)
            <li>Produit ID: {{ $product->product_id }} (Popularité: {{ $product->popularity }})</li>
        @endforeach
    </ul>
</div>
@endsection
