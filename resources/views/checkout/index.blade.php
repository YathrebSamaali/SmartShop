@extends('layouts.app')

@section('content')
@include('layouts.header')

<div class="container mx-auto px-4 py-8">
    <!-- Progress bar 
    <div class="mb-8">
        <div class="flex justify-between items-center mb-2">
            <div class="text-sm font-medium text-black">Cart</div>
            <div class="text-sm font-medium text-black">Shipping</div>
            <div class="text-sm font-medium text-gray-500">Payment</div>
            <div class="text-sm font-medium text-gray-500">Confirmation</div>
        </div>
        <div class="w-full bg-gray-200 rounded-full h-2">
            <div class="bg-black h-2 rounded-full" style="width: 75%"></div>
        </div>
    </div>-->

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-900">Checkout</h1>
        <span class="text-gray-600">
            <span id="cart-count">{{ count($cartItems) }}</span> item(s) -
            <span class="font-medium">{{ number_format($total, 2) }} TND</span>
        </span>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Order form -->
        <div class="lg:col-span-2">
            <!-- Contact Information Section -->
            <div class="bg-white shadow-md rounded-lg overflow-hidden mb-6">
                <div class="bg-gray-100 p-4 font-medium text-gray-700">
                    <h2 class="text-xl font-semibold">Your Information</h2>
                </div>
                <div class="p-6">
                    <form id="checkout-form" action="{{ route('checkout.process') }}" method="POST">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <label for="customer_first_name" class="block text-sm font-medium text-gray-700 mb-1">First Name*</label>
                                <input type="text" id="customer_first_name" name="customer_first_name" required
                                       class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-black"
                                       value="{{ auth()->user()->first_name ?? old('customer_first_name') }}">
                                @error('customer_first_name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="customer_last_name" class="block text-sm font-medium text-gray-700 mb-1">Last Name*</label>
                                <input type="text" id="customer_last_name" name="customer_last_name" required
                                       class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-black"
                                       value="{{ auth()->user()->last_name ?? old('customer_last_name') }}">
                                @error('customer_last_name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="customer_email" class="block text-sm font-medium text-gray-700 mb-1">Email*</label>
                            <input type="email" id="customer_email" name="customer_email" required
                                   class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-black"
                                   value="{{ auth()->user()->email ?? old('customer_email') }}">
                            @error('customer_email')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="customer_phone" class="block text-sm font-medium text-gray-700 mb-1">Phone*</label>
                            <input type="tel" id="customer_phone" name="customer_phone" required
                                   class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-black"
                                   value="{{ auth()->user()->phone ?? old('customer_phone') }}">
                            @error('customer_phone')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Shipping Address Section -->
                        <div class="mt-8">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Shipping Address</h3>

                            <div class="mb-4">
                                <label for="delivery_street" class="block text-sm font-medium text-gray-700 mb-1">Address*</label>
                                <input type="text" id="delivery_street" name="delivery_street" required
                                       class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-black"
                                       value="{{ auth()->user()->address ?? old('delivery_street') }}">
                                @error('delivery_street')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                                <div>
                                    <label for="delivery_city" class="block text-sm font-medium text-gray-700 mb-1">City*</label>
                                    <input type="text" id="delivery_city" name="delivery_city" required
                                           class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-black"
                                           value="{{ auth()->user()->city ?? old('delivery_city') }}">
                                    @error('delivery_city')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label for="delivery_zip_code" class="block text-sm font-medium text-gray-700 mb-1">Postal Code*</label>
                                    <input type="text" id="delivery_zip_code" name="delivery_zip_code" required
                                           class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-black"
                                           value="{{ auth()->user()->zip_code ?? old('delivery_zip_code') }}">
                                    @error('delivery_zip_code')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label for="delivery_country" class="block text-sm font-medium text-gray-700 mb-1">Country*</label>
                                    <select id="delivery_country" name="delivery_country" required
                                            class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-black">
                                        <option value="Tunisia" {{ (auth()->user()->country ?? old('delivery_country')) == 'Tunisia' ? 'selected' : '' }}>Tunisia</option>
                                        <option value="France" {{ (auth()->user()->country ?? old('delivery_country')) == 'France' ? 'selected' : '' }}>France</option>
                                        <option value="Algeria" {{ (auth()->user()->country ?? old('delivery_country')) == 'Algeria' ? 'selected' : '' }}>Algeria</option>
                                        <option value="Morocco" {{ (auth()->user()->country ?? old('delivery_country')) == 'Morocco' ? 'selected' : '' }}>Morocco</option>
                                    </select>
                                    @error('delivery_country')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Shipping Method Section -->
                        <div class="mt-8">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Shipping Method</h3>

                            <div class="space-y-3">
                                <div class="flex items-center p-3 border border-gray-200 rounded-md hover:border-black transition cursor-pointer">
                                    <input type="radio" id="delivery-standard" name="delivery_method" value="standard" checked
                                           class="h-4 w-4 text-black focus:ring-black border-gray-300">
                                    <label for="delivery-standard" class="ml-3 block">
                                        <span class="font-medium text-gray-700">Standard Shipping</span>
                                        <span class="block text-sm text-gray-500">3-5 business days - 7.00 TND</span>
                                    </label>
                                </div>

                                <div class="flex items-center p-3 border border-gray-200 rounded-md hover:border-black transition cursor-pointer">
                                    <input type="radio" id="delivery-express" name="delivery_method" value="express"
                                           class="h-4 w-4 text-black focus:ring-black border-gray-300">
                                    <label for="delivery-express" class="ml-3 block">
                                        <span class="font-medium text-gray-700">Express Shipping</span>
                                        <span class="block text-sm text-gray-500">24h - 15.00 TND</span>
                                    </label>
                                </div>
                            </div>
                            @error('delivery_method')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Payment Method Section -->
                        <div class="mt-8">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Payment Method</h3>

                            <div class="space-y-3">
                                <div class="flex items-center p-3 border border-gray-200 rounded-md hover:border-black transition cursor-pointer">
                                    <input type="radio" id="payment-cash" name="payment_method" value="cash" checked
                                           class="h-4 w-4 text-black focus:ring-black border-gray-300">
                                    <label for="payment-cash" class="ml-3 block">
                                        <span class="font-medium text-gray-700">Cash on Delivery</span>
                                        <span class="block text-sm text-gray-500">Pay with cash</span>
                                    </label>
                                </div>

                                <div class="flex items-center p-3 border border-gray-200 rounded-md hover:border-black transition cursor-pointer">
                                    <input type="radio" id="payment-credit-card" name="payment_method" value="credit_card"
                                           class="h-4 w-4 text-black focus:ring-black border-gray-300">
                                    <label for="payment-credit-card" class="ml-3 block">
                                        <span class="font-medium text-gray-700">Credit Card</span>
                                        <span class="block text-sm text-gray-500">Secure payment</span>
                                    </label>
                                </div>

                                <div class="flex items-center p-3 border border-gray-200 rounded-md hover:border-black transition cursor-pointer">
                                    <input type="radio" id="payment-bank-transfer" name="payment_method" value="bank_transfer"
                                           class="h-4 w-4 text-black focus:ring-black border-gray-300">
                                    <label for="payment-bank-transfer" class="ml-3 block">
                                        <span class="font-medium text-gray-700">Bank Transfer</span>
                                        <span class="block text-sm text-gray-500">Bank wire transfer</span>
                                    </label>
                                </div>
                            </div>
                            @error('payment_method')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Comments Section -->
                        <div class="mt-8">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Comments</h3>
                            <textarea id="notes" name="notes" rows="3"
                                      class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-black"
                                      placeholder="Additional notes (optional)">{{ old('notes') }}</textarea>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Back button -->
            <a href="{{ route('cart') }}" class="inline-flex items-center text-black hover:text-gray-700">
                <i class="fas fa-arrow-left mr-2"></i> Back to Cart
            </a>
        </div>

        <!-- Order Summary -->
        <div>
            <div class="bg-white shadow-md rounded-lg overflow-hidden sticky top-4">
                <div class="bg-gray-100 p-4 font-medium text-gray-700">
                    <h2 class="text-xl font-semibold">Your Order</h2>
                </div>
                <div class="p-6">
                    @foreach($cartItems as $item)
                    <div class="flex justify-between items-start mb-4 pb-4 border-b border-gray-100">
                        <div class="flex items-center">
                            <div class="w-12 h-12 bg-gray-200 rounded-md overflow-hidden mr-3">
                                @if(isset($item->product->image))
                                    <img src="{{ asset('storage/'.$item->product->image) }}" class="w-full h-full object-cover">
                                @elseif(isset($item['product']->image))
                                    <img src="{{ asset('storage/'.$item['product']->image) }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full bg-gray-300 flex items-center justify-center">
                                        <i class="fas fa-image text-gray-400 text-xs"></i>
                                    </div>
                                @endif
                            </div>
                            <div>
                                <h4 class="text-sm font-medium text-gray-900">
                                    @if(isset($item->product))
                                        {{ $item->product->name }}
                                    @elseif(isset($item['product']))
                                        {{ $item['product']->name }}
                                    @else
                                        Product unavailable
                                    @endif
                                </h4>
                                <p class="text-xs text-gray-500">
                                    {{ $item->quantity ?? $item['quantity'] }} ×
                                    {{ number_format($item->price ?? $item['price'] ?? $item['product']->price, 2) }} TND
                                </p>
                            </div>
                        </div>
                        <span class="text-sm font-medium">
                            {{ number_format(($item->price ?? $item['price'] ?? $item['product']->price) * ($item->quantity ?? $item['quantity']), 2) }} TND
                        </span>
                    </div>
                    @endforeach

                    <div class="border-t border-gray-200 my-4"></div>

                    <div class="space-y-2 mb-6">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Subtotal</span>
                            <span class="font-medium">{{ number_format($total, 2) }} TND</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Shipping</span>
                            <span class="font-medium" id="delivery-cost">7.00 TND</span>
                        </div>
                        <div class="border-t border-gray-200 my-2"></div>
                        <div class="flex justify-between">
                            <span class="text-lg font-bold">Total</span>
                            <span class="text-lg font-bold text-black" id="total-with-shipping">{{ number_format($total + 7, 2) }} TND</span>
                        </div>
                    </div>

                    <button type="submit" form="checkout-form" class="w-full bg-black text-white py-3 px-6 rounded-md hover:bg-gray-800 transition duration-300 font-medium flex items-center justify-center">
                        <i class="fas fa-lock mr-2"></i> Confirm Order
                    </button>

                    <p class="mt-3 text-xs text-gray-500">
                        By placing your order, you agree to our
                        <a href="#" class="text-black hover:underline">Terms and Conditions</a>.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Script to handle shipping fees -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const deliveryMethods = document.querySelectorAll('input[name="delivery_method"]');
    const deliveryCostElement = document.getElementById('delivery-cost');
    const totalWithShippingElement = document.getElementById('total-with-shipping');
    const subtotal = {{ $total }};

    function updateShippingCost() {
        const selectedMethod = document.querySelector('input[name="delivery_method"]:checked').value;
        let cost = 7.00; // Standard by default

        if (selectedMethod === 'express') {
            cost = 15.00;
        }

        deliveryCostElement.textContent = cost.toFixed(2) + ' TND';
        totalWithShippingElement.textContent = (subtotal + cost).toFixed(2) + ' TND';
    }

    deliveryMethods.forEach(method => {
        method.addEventListener('change', updateShippingCost);
    });
});
</script>

@endsection