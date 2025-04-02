@extends('layouts.app')

@section('content')
@include('layouts.header')

<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-900">Votre Panier</h1>
        <span class="text-gray-600">
            <span id="cart-count">{{ count($cartItems) }}</span> article(s)
        </span>
    </div>

    @if(count($cartItems) > 0)
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <!-- En-tête du tableau -->
        <div class="grid grid-cols-12 bg-gray-100 p-4 font-medium text-gray-700">
            <div class="col-span-6">Produit</div>
            <div class="col-span-2 text-center">Prix</div>
            <div class="col-span-2 text-center">Quantité</div>
            <div class="col-span-2 text-right">Total</div>
        </div>

        @foreach($cartItems as $item)
        <div class="grid grid-cols-12 p-4 border-b border-gray-200 items-center hover:bg-gray-50 transition duration-150">
            <!-- Produit -->
            <div class="col-span-6 flex items-center">
                <div class="w-16 h-16 bg-gray-200 rounded-md overflow-hidden mr-4">
                    @if($item->product->image)
                        <img src="{{ asset('storage/' . $item->product->image) }}" 
                             alt="{{ $item->product->name }}"
                             class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full bg-gray-300 flex items-center justify-center">
                            <i class="fas fa-image text-gray-400"></i>
                        </div>
                    @endif
                </div>

                <div class="ml-4">
                    <h3 class="text-lg font-medium text-gray-900">{{ $item->product->name }}</h3>
                    <div class="flex items-center mt-2 space-x-4">
                        <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700 flex items-center text-sm">
                                <i class="fas fa-trash mr-1"></i> Supprimer
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Prix -->
            <div class="col-span-2 text-center">
                <span class="font-medium text-gray-900">{{ number_format($item->price, 2) }}</span>
                <span class="text-gray-500"> DT</span>
            </div>

            <!-- Quantité -->
            <div class="col-span-2 flex justify-center">
                <form action="{{ route('cart.update', $item->id) }}" method="POST" class="flex items-center">
                    @csrf
                    @method('PATCH')
                    <button type="button" onclick="updateQuantity(this, -1)" 
                            class="bg-gray-200 px-3 py-1 rounded-l hover:bg-gray-300 transition">
                        <i class="fas fa-minus text-xs"></i>
                    </button>
                    <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" 
                           class="w-12 text-center border-t border-b border-gray-200 py-1 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <button type="button" onclick="updateQuantity(this, 1)" 
                            class="bg-gray-200 px-3 py-1 rounded-r hover:bg-gray-300 transition">
                        <i class="fas fa-plus text-xs"></i>
                    </button>
                </form>
            </div>

            <!-- Total -->
            <div class="col-span-2 text-right">
                <span class="font-bold text-blue-600">{{ number_format($item->price * $item->quantity, 2) }}</span>
                <span class="text-gray-500"> DT</span>
            </div>
        </div>
        @endforeach

        <!-- Section Code Promo et Résumé -->
        <div class="p-6 bg-gray-50 border-t border-gray-200">
            <!-- Champ Code Promo -->
            <div class="mb-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Code promotionnel</h3>
                <div class="flex">
                    <input type="text" placeholder="Entrez votre code promo" 
                           class="flex-grow border border-gray-300 rounded-l-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <button class="bg-blue-600 text-white px-4 py-2 rounded-r-md hover:bg-blue-700 transition">
                        Appliquer
                    </button>
                </div>
            </div>

            <!-- Résumé de commande -->
            <div class="border-t border-gray-200 pt-4">
                <div class="flex justify-between items-center mb-3">
                    <span class="text-gray-600">Sous-total</span>
                    <span class="font-medium">{{ number_format($total, 2) }} DT</span>
                </div>
                
                <div class="flex justify-between items-center mb-3 text-gray-600">
                    <span>Réduction</span>
                    <span>- 0.00 DT</span>
                </div>
                
                <div class="flex justify-between items-center mb-3 text-gray-600">
                    <span>Livraison</span>
                    <span>Calculée à l'étape suivante</span>
                </div>
                
                <div class="border-t border-gray-200 my-3"></div>
                
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-xl font-bold text-gray-900">Total</h3>
                    <div class="text-2xl font-bold text-blue-600">{{ number_format($total, 2) }} DT</div>
                </div>
            </div>

            <!-- Boutons d'action -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <a href="{{ route('products') }}" 
                   class="bg-white text-gray-800 border border-gray-300 py-3 px-6 rounded-md hover:bg-gray-100 transition duration-300 flex items-center justify-center">
                    <i class="fas fa-arrow-left mr-2"></i> Continuer mes achats
                </a>
                <a href="{{ route('checkout') }}" 
                   class="bg-blue-600 text-white py-3 px-6 rounded-md hover:bg-blue-700 transition duration-300 flex items-center justify-center font-medium">
                    Passer la commande <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
        </div>
    </div>
    @else
    <div class="bg-white shadow-md rounded-lg p-8 text-center max-w-md mx-auto">
        <div class="bg-gray-100 rounded-full w-24 h-24 flex items-center justify-center mx-auto mb-4">
            <i class="fas fa-shopping-cart text-4xl text-gray-400"></i>
        </div>
        <h2 class="text-xl font-medium text-gray-700 mb-2">Votre panier est vide</h2>
        <p class="text-gray-500 mb-6">Commencez par ajouter quelques articles à votre panier</p>
        <a href="{{ route('products') }}" class="bg-blue-600 text-white py-2 px-6 rounded-md hover:bg-blue-700 transition duration-300 inline-flex items-center">
            <i class="fas fa-store mr-2"></i> Voir nos produits
        </a>
    </div>
    @endif
</div>

<!-- Notification Toast -->
<div id="cart-toast" class="fixed top-4 left-1/2 transform -translate-x-1/2 bg-green-500 text-white px-6 py-3 rounded-md shadow-lg z-50 hidden items-center space-x-2">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
    </svg>
    <span id="toast-message" class="font-medium">Produit ajouté au panier!</span>
</div>

<script>
// Fonction pour afficher la notification toast
function showToast(message, type = 'success') {
    const toast = document.getElementById('cart-toast');
    const toastMessage = document.getElementById('toast-message');
    
    // Changer la couleur selon le type
    const colors = {
        success: 'bg-green-500',
        error: 'bg-red-500',
        info: 'bg-blue-500'
    };
    toast.className = toast.className.replace(/bg-\w+-\d+/g, colors[type]);
    toastMessage.textContent = message;
    
    // Afficher
    toast.classList.remove('hidden');
    toast.classList.add('flex', 'opacity-100');
    
    // Masquer après délai
    setTimeout(() => {
        toast.classList.remove('opacity-100');
        toast.classList.add('opacity-0');
        setTimeout(() => {
            toast.classList.add('hidden');
            toast.classList.remove('flex', 'opacity-0');
        }, 300);
    }, 3000);
}

// Fonction pour mettre à jour la quantité
function updateQuantity(button, change) {
    const form = button.closest('form');
    const input = form.querySelector('input[name="quantity"]');
    const newValue = parseInt(input.value) + change;
    
    if (newValue >= input.min) {
        input.value = newValue;
        form.submit();
    }
}

// Gestion du code promo
document.addEventListener('DOMContentLoaded', function() {
    const promoInput = document.querySelector('input[placeholder="Entrez votre code promo"]');
    const promoButton = promoInput.nextElementSibling;
    
    promoButton.addEventListener('click', function() {
        const code = promoInput.value.trim();
        if (code) {
            // Ici vous pourriez faire une requête AJAX pour valider le code promo
            showToast('Code promo appliqué avec succès!', 'info');
        } else {
            showToast('Veuillez entrer un code promo', 'error');
        }
    });
    
    // Afficher un toast si présent dans l'URL
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.has('added')) {
        showToast('Produit ajouté au panier!');
    }
});
</script>

<style>
/* Animation pour le toast */
#cart-toast {
    transition: all 0.3s ease;
    top: 1rem;
    opacity: 0;
    transform: translate(-50%, -1rem);
}
#cart-toast.opacity-100 {
    opacity: 1;
    transform: translate(-50%, 0);
}
#cart-toast.opacity-0 {
    opacity: 0;
    transform: translate(-50%, -1rem);
}

/* Style pour les boutons bleus */
.bg-blue-600 {
    background-color: #2563eb;
}
.hover\:bg-blue-700:hover {
    background-color: #1d4ed8;
}
.text-blue-600 {
    color: #2563eb;
}
.focus\:ring-blue-500:focus {
    --tw-ring-color: #3b82f6;
}
</style>

@endsection