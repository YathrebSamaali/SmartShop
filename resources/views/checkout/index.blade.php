@extends('layouts.app')

@section('content')
@include('layouts.header')

<div class="container mx-auto px-4 py-8">
    <!-- Barre de progression -->
    <div class="mb-8">
        <div class="flex justify-between items-center mb-2">
            <div class="text-sm font-medium text-blue-600">Panier</div>
            <div class="text-sm font-medium text-blue-600">Livraison</div>
            <div class="text-sm font-medium text-gray-500">Paiement</div>
            <div class="text-sm font-medium text-gray-500">Confirmation</div>
        </div>
        <div class="w-full bg-gray-200 rounded-full h-2">
            <div class="bg-blue-600 h-2 rounded-full" style="width: 75%"></div>
        </div>
    </div>

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-900">Finalisation de la commande</h1>
        <span class="text-gray-600">
            <span id="cart-count">{{ count($cartItems) }}</span> article(s) - 
            <span class="font-medium">{{ number_format($total, 2) }} DT</span>
        </span>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Formulaire de commande -->
        <div class="lg:col-span-2">
            <!-- Section Coordonnées -->
            <div class="bg-white shadow-md rounded-lg overflow-hidden mb-6">
                <div class="bg-gray-100 p-4 font-medium text-gray-700">
                    <h2 class="text-xl font-semibold">Vos coordonnées</h2>
                </div>
                <div class="p-6">
                    <form id="checkout-form" action="{{ route('checkout.process') }}" method="POST">
                        @csrf
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <label for="first_name" class="block text-sm font-medium text-gray-700 mb-1">Prénom*</label>
                                <input type="text" id="first_name" name="first_name" required
                                       class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                       value="{{ auth()->user()->first_name ?? old('first_name') }}">
                            </div>
                            <div>
                                <label for="last_name" class="block text-sm font-medium text-gray-700 mb-1">Nom*</label>
                                <input type="text" id="last_name" name="last_name" required
                                       class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                       value="{{ auth()->user()->last_name ?? old('last_name') }}">
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email*</label>
                            <input type="email" id="email" name="email" required
                                   class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                   value="{{ auth()->user()->email ?? old('email') }}">
                        </div>

                        <div class="mb-4">
                            <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Téléphone*</label>
                            <input type="tel" id="phone" name="phone" required
                                   class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                   value="{{ auth()->user()->phone ?? old('phone') }}">
                        </div>

                        <!-- Section Adresse -->
                        <div class="mt-8">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Adresse de livraison</h3>
                            
                            <div class="mb-4">
                                <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Adresse*</label>
                                <input type="text" id="address" name="address" required
                                       class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                       value="{{ auth()->user()->address ?? old('address') }}">
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                                <div>
                                    <label for="city" class="block text-sm font-medium text-gray-700 mb-1">Ville*</label>
                                    <input type="text" id="city" name="city" required
                                           class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                           value="{{ auth()->user()->city ?? old('city') }}">
                                </div>
                                <div>
                                    <label for="zip_code" class="block text-sm font-medium text-gray-700 mb-1">Code postal*</label>
                                    <input type="text" id="zip_code" name="zip_code" required
                                           class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                           value="{{ auth()->user()->zip_code ?? old('zip_code') }}">
                                </div>
                                <div>
                                    <label for="country" class="block text-sm font-medium text-gray-700 mb-1">Pays*</label>
                                    <select id="country" name="country" required
                                            class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                        <option value="Tunisie" selected>Tunisie</option>
                                        <option value="France">France</option>
                                        <option value="Algérie">Algérie</option>
                                        <option value="Maroc">Maroc</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Section Livraison -->
                        <div class="mt-8">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Méthode de livraison</h3>
                            
                            <div class="space-y-3">
                                <div class="flex items-center p-3 border border-gray-200 rounded-md hover:border-blue-500 transition cursor-pointer">
                                    <input type="radio" id="delivery-standard" name="delivery_method" value="standard" checked
                                           class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300">
                                    <label for="delivery-standard" class="ml-3 block">
                                        <span class="font-medium text-gray-700">Livraison standard</span>
                                        <span class="block text-sm text-gray-500">3-5 jours ouvrables - 7.00 DT</span>
                                    </label>
                                </div>
                                
                                <div class="flex items-center p-3 border border-gray-200 rounded-md hover:border-blue-500 transition cursor-pointer">
                                    <input type="radio" id="delivery-express" name="delivery_method" value="express"
                                           class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300">
                                    <label for="delivery-express" class="ml-3 block">
                                        <span class="font-medium text-gray-700">Livraison express</span>
                                        <span class="block text-sm text-gray-500">24h - 15.00 DT</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Section Commentaires -->
                        <div class="mt-8">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Commentaires</h3>
                            <textarea id="notes" name="notes" rows="3"
                                      class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                      placeholder="Notes supplémentaires (optionnel)"></textarea>
                        </div>
                    </form>
                </div>
            </div>
            
            <!-- Bouton de retour -->
            <a href="{{ route('cart') }}" class="inline-flex items-center text-blue-600 hover:text-blue-800">
                <i class="fas fa-arrow-left mr-2"></i> Retour au panier
            </a>
        </div>

        <!-- Récapitulatif de commande -->
        <div>
            <div class="bg-white shadow-md rounded-lg overflow-hidden sticky top-4">
                <div class="bg-gray-100 p-4 font-medium text-gray-700">
                    <h2 class="text-xl font-semibold">Votre commande</h2>
                </div>
                <div class="p-6">
                    @foreach($cartItems as $item)
                    <div class="flex justify-between items-start mb-4 pb-4 border-b border-gray-100">
                        <div class="flex items-center">
                            <div class="w-12 h-12 bg-gray-200 rounded-md overflow-hidden mr-3">
                                @if($item->product->image)
                                    <img src="{{ asset('storage/'.$item->product->image) }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full bg-gray-300 flex items-center justify-center">
                                        <i class="fas fa-image text-gray-400 text-xs"></i>
                                    </div>
                                @endif
                            </div>
                            <div>
                                <h4 class="text-sm font-medium text-gray-900">{{ $item->product->name }}</h4>
                                <p class="text-xs text-gray-500">{{ $item->quantity }} × {{ number_format($item->price, 2) }} DT</p>
                            </div>
                        </div>
                        <span class="text-sm font-medium">{{ number_format($item->price * $item->quantity, 2) }} DT</span>
                    </div>
                    @endforeach

                    <div class="border-t border-gray-200 my-4"></div>

                    <div class="space-y-2 mb-6">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Sous-total</span>
                            <span class="font-medium">{{ number_format($total, 2) }} DT</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Livraison</span>
                            <span class="font-medium" id="delivery-cost">7.00 DT</span>
                        </div>
                        <div class="border-t border-gray-200 my-2"></div>
                        <div class="flex justify-between">
                            <span class="text-lg font-bold">Total</span>
                            <span class="text-lg font-bold text-blue-600" id="total-with-shipping">{{ number_format($total + 7, 2) }} DT</span>
                        </div>
                    </div>

                    <!-- Section Paiement -->
                    <div class="mb-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-3">Méthode de paiement</h3>
                        
                        <div class="space-y-3">
                        <div class="flex items-center p-3 border border-gray-200 rounded-md hover:border-blue-500 transition cursor-pointer">
    <input type="radio" id="payment-cash" name="payment_method" value="cash" checked
           class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300">
    <label for="payment-cash" class="ml-3 block">
        <span class="font-medium text-gray-700">Paiement à la livraison</span>
        <span class="block text-sm text-gray-500">Espèces</span>
    </label>
</div>

<div class="flex items-center p-3 border border-gray-200 rounded-md hover:border-blue-500 transition cursor-pointer">
    <input type="radio" id="payment-credit-card" name="payment_method" value="credit_card"
           class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300">
    <label for="payment-credit-card" class="ml-3 block">
        <span class="font-medium text-gray-700">Carte bancaire</span>
        <span class="block text-sm text-gray-500">Paiement sécurisé</span>
    </label>
</div>

<div class="flex items-center p-3 border border-gray-200 rounded-md hover:border-blue-500 transition cursor-pointer">
    <input type="radio" id="payment-bank-transfer" name="payment_method" value="bank_transfer"
           class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300">
    <label for="payment-bank-transfer" class="ml-3 block">
        <span class="font-medium text-gray-700">Virement bancaire</span>
        <span class="block text-sm text-gray-500">Transfert bancaire</span>
    </label>
</div>
                        </div>
                    </div>

                    <button type="submit" form="checkout-form" class="w-full bg-blue-600 text-white py-3 px-6 rounded-md hover:bg-blue-700 transition duration-300 font-medium flex items-center justify-center">
                        <i class="fas fa-lock mr-2"></i> Confirmer la commande
                    </button>
                    
                    <p class="mt-3 text-xs text-gray-500">
                        En passant votre commande, vous acceptez nos 
                        <a href="#" class="text-blue-600 hover:underline">Conditions Générales de Vente</a>.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Script pour gérer les frais de livraison -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const deliveryMethods = document.querySelectorAll('input[name="delivery_method"]');
    const deliveryCostElement = document.getElementById('delivery-cost');
    const totalWithShippingElement = document.getElementById('total-with-shipping');
    const subtotal = {{ $total }};
    
    function updateShippingCost() {
        const selectedMethod = document.querySelector('input[name="delivery_method"]:checked').value;
        let cost = 7.00; // Standard par défaut
        
        if (selectedMethod === 'express') {
            cost = 15.00;
        }
        
        deliveryCostElement.textContent = cost.toFixed(2) + ' DT';
        totalWithShippingElement.textContent = (subtotal + cost).toFixed(2) + ' DT';
    }
    
    deliveryMethods.forEach(method => {
        method.addEventListener('change', updateShippingCost);
    });
});
</script>

@endsection