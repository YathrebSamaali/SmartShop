<!DOCTYPE html>
<html>
<head>
    <title>User Export with Products</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; font-weight: bold; }
        .user-row { background-color: #f9f9f9; }
        .product-row td { padding-left: 30px; }
        .no-products { color: #999; font-style: italic; }
    </style>
</head>
<body>
    <h1>User Export with Products</h1>

    <table>
        <thead>
            <tr>
                <th>User ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Address</th>
                <th>Postal Code</th>
                <th>Phone</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr class="user-row">
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->adresse }}</td>
                <td>{{ $user->code_postal }}</td>
                <td>{{ $user->numero }}</td>
            </tr>

            @if($user->products && $user->products->count() > 0)
                @foreach($user->products as $product)
                <tr class="product-row">
                    <td colspan="2"><strong>Product:</strong> {{ $product->name }}</td>
                    <td><strong>Price:</strong> {{ number_format($product->price, 2) }} DT</td>
                    <td><strong>Category:</strong> {{ $product->category }}</td>
                    <td><strong>Stock:</strong> {{ $product->stock }}</td>
                    <td><strong>Added:</strong> {{ $product->created_at->format('Y-m-d') }}</td>
                </tr>
                @endforeach
            @else
                <tr class="product-row no-products">
                    <td colspan="6">No products associated</td>
                </tr>
            @endif

            <tr><td colspan="6" style="border: none; height: 10px;"></td></tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
