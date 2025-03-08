@extends('layouts.app')

@section('content')
<div class="container">
    <h2>🛒 Gestion des Produits</h2>
    
    <!-- Ajout d'un bouton pour ajouter un produit -->
    <a href="{{ route('admin.products.create') }}" class="btn btn-success mb-3">Ajouter un Produit</a>

    <!-- Filtrage des produits -->
    <form action="{{ route('admin.products.index') }}" method="GET" class="mb-4">
        <div class="row">
            <div class="col-md-4">
                <input type="text" name="name" class="form-control" placeholder="Nom du produit" value="{{ request()->get('name') }}">
            </div>
            <div class="col-md-4">
                <input type="number" name="price" class="form-control" placeholder="Prix" value="{{ request()->get('price') }}">
            </div>
            <div class="col-md-4">
                <button type="submit" class="btn btn-primary">Filtrer</button>
            </div>
        </div>
    </form>

    <!-- Table des produits -->
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Prix</th>
                <th>Stock</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->price }}€</td>
                <td>{{ $product->stock }}</td>
                <td>
                    <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                    <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Pagination -->
    <div class="d-flex justify-content-center">
        {{ $products->links() }}
    </div>
</div>
@endsection
