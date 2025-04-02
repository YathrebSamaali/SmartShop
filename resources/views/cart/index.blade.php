@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h1 class="text-2xl font-bold mb-6">Votre Panier</h1>

    @if($cartItems->count() > 0)
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="hidden md:grid grid-cols-12 bg-gray-100 p-4 font-semibold">
                <div class="col-span-5">Produit</div>
                <div class="col-span-2 text-center">Prix</div>
                <div class="col-span-3 text-center">Quantité</div>
                <div class="col-span-2 text-center">Total</div>
            </div>

            @foreach($cartItems as $item)
                <div class="grid grid-cols-1 md:grid-cols-12 gap-4 p-4 border-b items-center">
                    <div class="col-span-5 flex items-center">
                        @if(Auth::check())
                            <img src="{{ asset('storage/'.$item->product->image) }}" alt="{{ $item->product->name }}" class="w-20 h-20 object-cover rounded">
                            <div class="ml-4">
                                <h3 class="font-medium">{{ $item->product->name }}</h3>
                                <form action="{{ route('cart.remove', $item->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 text-sm">Supprimer</button>
                                </form>
                            </div>
                        @else
                            <img src="{{ asset('storage/'.$item['image']) }}" alt="{{ $item['name'] }}" class="w-20 h-20 object-cover rounded">
                            <div class="ml-4">
                                <h3 class="font-medium">{{ $item['name'] }}</h3>
                                <form action="{{ route('cart.remove', $item['product_id']) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 text-sm">Supprimer</button>
                                </form>
                            </div>
                        @endif
                    </div>

                    <div class="col-span-2 text-center">
                        @if(Auth::check())
                            {{ number_format($item->product->price, 2) }} €
                        @else
                            {{ number_format($item['price'], 2) }} €
                        @endif
                    </div>

                    <div class="col-span-3">
                        <form action="{{ route('cart.update', Auth::check() ? $item->id : $item['product_id']) }}" method="POST" class="flex justify-center">
                            @csrf
                            @method('PUT')
                            <div class="flex border rounded">
                                <button type="button" class="px-3 py-1 bg-gray-100 decrement">-</button>
                                <input type="number" name="quantity" value="{{ Auth::check() ? $item->quantity : $item['quantity'] }}"
                                       class="w-12 text-center border-0" min="1">
                                <button type="button" class="px-3 py-1 bg-gray-100 increment">+</button>
                            </div>
                            <button type="submit" class="ml-2 text-sm text-blue-500">Mettre à jour</button>
                        </form>
                    </div>

                    <div class="col-span-2 text-center font-medium">
                        @if(Auth::check())
                            {{ number_format($item->product->price * $item->quantity, 2) }} €
                        @else
                            {{ number_format($item['price'] * $item['quantity'], 2) }} €
                        @endif
                    </div>
                </div>
            @endforeach

            <div class="p-4 border-t">
                <div class="flex justify-between items-center">
                    <form action="{{ route('cart.clear') }}" method="POST">
                        @csrf
                        <button type="submit" class="text-red-500">Vider le panier</button>
                    </form>
                    <div class="text-lg font-semibold">
                        Total : <span class="text-xl text-indigo-600">{{ number_format($total, 2) }} €</span>
                    </div>
                </div>
            </div>

            <div class="p-4 bg-gray-50 text-right">
                <a href="{{ route('checkout') }}" class="bg-indigo-600 text-white px-6 py-2 rounded hover:bg-indigo-700">
                    Passer la commande
                </a>
            </div>
        </div>
    @else
        <div class="text-center py-12">
            <i class="fas fa-shopping-cart text-5xl text-gray-300 mb-4"></i>
            <h3 class="text-xl font-medium text-gray-500">Votre panier est vide</h3>
            <p class="text-gray-400 mb-4">Commencez par ajouter des produits à votre panier</p>
            <a href="{{ route('products.index') }}" class="inline-block bg-indigo-600 text-white px-6 py-2 rounded hover:bg-indigo-700">
                Voir nos produits
            </a>
        </div>
    @endif
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Gestion des boutons +/-
    document.querySelectorAll('.increment').forEach(button => {
        button.addEventListener('click', function() {
            const input = this.previousElementSibling;
            input.value = parseInt(input.value) + 1;
        });
    });

    document.querySelectorAll('.decrement').forEach(button => {
        button.addEventListener('click', function() {
            const input = this.nextElementSibling;
            if (parseInt(input.value) > 1) {
                input.value = parseInt(input.value) - 1;
            }
        });
    });
});
</script>
@endsection
