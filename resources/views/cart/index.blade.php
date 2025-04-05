@extends('layouts.app')

@section('content')
@include('layouts.header')

<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-900">Your Cart</h1>
        <span class="text-gray-600">
            <span id="cart-count">{{ count($cartItems) }}</span> item(s)
        </span>
    </div>

    @if(count($cartItems) > 0)
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <!-- Table Header -->
        <div class="grid grid-cols-12 bg-gray-100 p-4 font-medium text-gray-700">
            <div class="col-span-6">Product</div>
            <div class="col-span-2 text-center">Price</div>
            <div class="col-span-2 text-center">Quantity</div>
            <div class="col-span-2 text-right">Total</div>
        </div>

        @foreach($cartItems as $item)
        <div class="grid grid-cols-12 p-4 border-b border-gray-200 items-center hover:bg-gray-50 transition duration-150">
            <!-- Product -->
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
                            <button type="submit" class="delete-btn">
                                <i class="fas fa-trash mr-1"></i> Remove
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Price -->
            <div class="col-span-2 text-center">
                <span class="font-medium text-gray-900">{{ number_format($item->price, 2) }}</span>
                <span class="text-gray-500"> TND</span>
            </div>

            <!-- Quantity -->
            <div class="col-span-2 flex justify-center">
                <form action="{{ route('cart.update', $item->id) }}" method="POST" class="flex items-center">
                    @csrf
                    @method('PATCH')
                    <button type="button" onclick="updateQuantity(this, -1)"
                            class="quantity-btn minus">
                        <i class="fas fa-minus"></i>
                    </button>
                    <input type="number" name="quantity" value="{{ $item->quantity }}" min="1"
                           class="quantity-input">
                    <button type="button" onclick="updateQuantity(this, 1)"
                            class="quantity-btn plus">
                        <i class="fas fa-plus"></i>
                    </button>
                </form>
            </div>

            <!-- Total -->
            <div class="col-span-2 text-right">
                <span class="font-bold text-black">{{ number_format($item->price * $item->quantity, 2) }}</span>
                <span class="text-gray-500"> TND</span>
            </div>
        </div>
        @endforeach

        <!-- Promo Code and Summary Section -->
        <div class="p-6 bg-gray-50 border-t border-gray-200">
            <!-- Promo Code Field -->
            <div class="mb-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Promo Code</h3>
                <div class="flex">
                    <input type="text" placeholder="Enter your promo code"
                           class="flex-grow border border-gray-300 rounded-l-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-black">
                    <button class="bg-black text-white px-4 py-2 rounded-r-md hover:bg-gray-800 transition">
                        Apply
                    </button>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="border-t border-gray-200 pt-4">
                <div class="flex justify-between items-center mb-3">
                    <span class="text-gray-600">Subtotal</span>
                    <span class="font-medium">{{ number_format($total, 2) }} TND</span>
                </div>

                <div class="flex justify-between items-center mb-3 text-gray-600">
                    <span>Discount</span>
                    <span>- 0.00 TND</span>
                </div>

                <div class="flex justify-between items-center mb-3 text-gray-600">
                    <span>Shipping</span>
                    <span>Calculated at next step</span>
                </div>

                <div class="border-t border-gray-200 my-3"></div>

                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-xl font-bold text-gray-900">Total</h3>
                    <div class="text-2xl font-bold text-black">{{ number_format($total, 2) }} TND</div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <a href="{{ route('products') }}"
                   class="bg-white text-gray-800 border border-gray-300 py-3 px-6 rounded-md hover:bg-gray-100 transition duration-300 flex items-center justify-center">
                    <i class="fas fa-arrow-left mr-2"></i> Continue Shopping
                </a>
                <a href="{{ route('checkout') }}"
                   class="bg-black text-white py-3 px-6 rounded-md hover:bg-gray-800 transition duration-300 flex items-center justify-center font-medium">
                    Proceed to Checkout <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
        </div>
    </div>
    @else
    <div class="bg-white shadow-md rounded-lg p-8 text-center max-w-md mx-auto">
        <div class="bg-gray-100 rounded-full w-24 h-24 flex items-center justify-center mx-auto mb-4">
            <i class="fas fa-shopping-cart text-4xl text-gray-400"></i>
        </div>
        <h2 class="text-xl font-medium text-gray-700 mb-2">Your cart is empty</h2>
        <p class="text-gray-500 mb-6">Start by adding some items to your cart</p>
        <a href="{{ route('products') }}" class="bg-black text-white py-2 px-6 rounded-md hover:bg-gray-800 transition duration-300 inline-flex items-center">
            <i class="fas fa-store mr-2"></i> Browse Products
        </a>
    </div>
    @endif
</div>

<!-- Notification Toast -->
<div id="cart-toast" class="fixed top-4 left-1/2 transform -translate-x-1/2 bg-black text-white px-6 py-3 rounded-md shadow-lg z-50 hidden items-center space-x-2">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
    </svg>
    <span id="toast-message" class="font-medium">Item added to cart!</span>
</div>

<script>
// Function to show toast notification
function showToast(message, type = 'success') {
    const toast = document.getElementById('cart-toast');
    const toastMessage = document.getElementById('toast-message');

    // Change color based on type
    const colors = {
        success: 'bg-black',
        error: 'bg-red-500',
        info: 'bg-gray-800'
    };
    toast.className = toast.className.replace(/bg-\w+/g, colors[type]);
    toastMessage.textContent = message;

    // Show
    toast.classList.remove('hidden');
    toast.classList.add('flex', 'opacity-100');

    // Hide after delay
    setTimeout(() => {
        toast.classList.remove('opacity-100');
        toast.classList.add('opacity-0');
        setTimeout(() => {
            toast.classList.add('hidden');
            toast.classList.remove('flex', 'opacity-0');
        }, 300);
    }, 3000);
}

// Function to update quantity
function updateQuantity(button, change) {
    const form = button.closest('form');
    const input = form.querySelector('input[name="quantity"]');
    const newValue = parseInt(input.value) + change;

    if (newValue >= input.min) {
        input.value = newValue;
        form.submit();
    }
}

// Promo code handling
document.addEventListener('DOMContentLoaded', function() {
    const promoInput = document.querySelector('input[placeholder="Enter your promo code"]');
    const promoButton = promoInput.nextElementSibling;

    promoButton.addEventListener('click', function() {
        const code = promoInput.value.trim();
        if (code) {
            // Here you could make an AJAX request to validate the promo code
            showToast('Promo code applied successfully!', 'info');
        } else {
            showToast('Please enter a promo code', 'error');
        }
    });

    // Show toast if present in URL
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.has('added')) {
        showToast('Item added to cart!');
    }
});
</script>

<style>
/* Style for delete button */
.delete-btn {
    color: #ef4444;
    background: none;
    border: none;
    cursor: pointer;
    font-size: 0.875rem;
    padding: 0.25rem 0.5rem;
    border-radius: 0.25rem;
    transition: all 0.2s ease;
    display: inline-flex;
    align-items: center;
}

.delete-btn:hover {
    background-color: #fee2e2;
}

/* Style for quantity buttons */
.quantity-btn {
    background-color: #f3f4f6;
    border: none;
    width: 2rem;
    height: 2rem;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.2s ease;
}

.quantity-btn.minus {
    border-radius: 0.25rem 0 0 0.25rem;
}

.quantity-btn.plus {
    border-radius: 0 0.25rem 0.25rem 0;
}

.quantity-btn:hover {
    background-color: #e5e7eb;
}

.quantity-input {
    width: 3rem;
    height: 2rem;
    text-align: center;
    border-top: 1px solid #e5e7eb;
    border-bottom: 1px solid #e5e7eb;
    border-left: none;
    border-right: none;
    -moz-appearance: textfield;
}

.quantity-input::-webkit-outer-spin-button,
.quantity-input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}

/* Animation for toast */
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
</style>

@endsection