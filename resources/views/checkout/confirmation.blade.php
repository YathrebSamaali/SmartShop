@extends('layouts.app')

@section('content')
@include('layouts.header')

<div class="container mx-auto px-4 py-12">
    <div class="max-w-3xl mx-auto bg-white shadow-md rounded-lg overflow-hidden">
        <div class="bg-green-100 p-6 border-b border-green-200">
            <div class="flex items-center">
                <svg class="h-8 w-8 text-green-600 mr-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                <div>
                    <h1 class="text-2xl font-bold text-green-800">Merci pour votre commande!</h1>
                    <p class="text-green-600">Votre commande #{{ $order->order_number }} a été passée avec succès.</p>
                </div>
            </div>
        </div>

        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                <div>
                    <h2 class="text-lg font-medium text-gray-900 mb-4">Récapitulatif de la commande</h2>
                    <div class="space-y-4">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Numéro de commande</span>
                            <span class="font-medium">{{ $order->order_number }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Date</span>
                            <span class="font-medium">{{ $order->created_at->format('d/m/Y H:i') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Total</span>
                            <span class="font-medium text-blue-600">{{ number_format($order->total, 2) }} DT</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Méthode de paiement</span>
                            <span class="font-medium">
                                @if($order->payment_method == 'cash')
                                    Paiement à la livraison
                                @else
                                    Carte bancaire
                                @endif
                            </span>
                        </div>
                    </div>
                </div>

                <div>
                    <h2 class="text-lg font-medium text-gray-900 mb-4">Adresse de livraison</h2>
                    <address class="not-italic">
                        <div class="text-gray-700">{{ $order->customer_first_name }} {{ $order->customer_last_name }}</div>
                        <div class="text-gray-700">{{ $order->delivery_street }}</div>
                        <div class="text-gray-700">{{ $order->delivery_zip_code }} {{ $order->delivery_city }}</div>
                        <div class="text-gray-700">{{ $order->delivery_country }}</div>
                        <div class="text-gray-700 mt-2">Téléphone: {{ $order->customer_phone }}</div>
                    </address>
                </div>
            </div>

            <h2 class="text-lg font-medium text-gray-900 mb-4">Articles commandés</h2>
            <div class="border border-gray-200 rounded-lg overflow-hidden">
                @foreach($order->items as $item)
                <div class="flex items-center p-4 border-b border-gray-200 last:border-b-0">
                    <div class="w-16 h-16 bg-gray-100 rounded-md overflow-hidden mr-4">
                        @if($item->product->image)
                            <img src="{{ asset('storage/'.$item->product->image) }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                                <svg class="h-6 w-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                        @endif
                    </div>
                    <div class="flex-1">
                        <h3 class="text-sm font-medium text-gray-900">{{ $item->product->name }}</h3>
                        <p class="text-sm text-gray-500">Quantité: {{ $item->quantity }}</p>
                    </div>
                    <div class="text-sm font-medium">{{ number_format($item->total, 2) }} DT</div>
                </div>
                @endforeach
            </div>

            <div class="mt-8 flex justify-end">
                <a href="{{ route('home') }}" class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition">
                    Retour à l'accueil
                </a>
            </div>
        </div>
    </div>
</div>
@endsection