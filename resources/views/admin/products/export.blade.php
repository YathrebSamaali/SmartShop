<!DOCTYPE html>
<html>
<head>
    <title>Export Produits</title>
    <style>
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 8px; }
        th { background-color: #f2f2f2; }
        .text-right { text-align: right; }
        .text-center { text-align: center; }
    </style>
</head>
<body>
    <h1>Liste des produits</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Catégorie</th>
                <th class="text-right">Prix</th>
                <th class="text-center">Stock</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->category }}</td>
                <td class="text-right">{{ number_format($product->price, 2) }} €</td>
                <td class="text-center">{{ $product->stock }}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="3">Total</th>
                <th class="text-right">{{ number_format($products->sum('price'), 2) }} €</th>
                <th class="text-center">{{ $products->sum('stock') }}</th>
            </tr>
        </tfoot>
    </table>
</body>
</html>
