@extends('layouts.app')

@section('content')
@include('layouts.header')

<div class="min-h-screen bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-6xl mx-auto"> <!-- Augmentation à max-w-6xl -->
        <!-- Carte principale avec ombre plus prononcée -->
        <div class="bg-white shadow-2xl rounded-xl overflow-hidden">
            <!-- En-tête succès avec dégradé professionnel -->
            <div class="bg-gradient-to-r from-green-600 to-green-700 p-8 sm:p-10 text-white">
                <div class="flex flex-col sm:flex-row items-center">
                    <div class="flex-shrink-0 mb-6 sm:mb-0 sm:mr-8">
                        <svg class="h-20 w-20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="text-center sm:text-left">
                        <h1 class="text-3xl sm:text-4xl font-bold tracking-tight">Commande confirmée avec succès</h1>
                        <div class="mt-4 space-y-2">
                            <p class="text-lg font-medium opacity-90 flex items-center justify-center sm:justify-start">
                                <svg class="w-6 h-6 mr-2 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                                Référence : <span class="font-semibold ml-1">#{{ $order->order_number }}</span>
                            </p>
                            <p class="text-base opacity-80 flex items-center justify-center sm:justify-start">
                                <svg class="w-5 h-5 mr-2 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                                Confirmation envoyée à : <span class="font-medium ml-1">{{ $order->customer_email }}</span>
                            </p>
                            @if($order->payment_method == 'cash')
                            <p class="text-base opacity-80 flex items-center justify-center sm:justify-start">
                                <svg class="w-5 h-5 mr-2 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                                Préparez le montant exact pour le paiement à la livraison
                            </p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contenu avec espacement accru -->
            <div class="p-8 sm:p-10 lg:p-12">
                <!-- Grille d'informations améliorée -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 mb-14">
                    <!-- Carte Détails de commande -->
                    <div class="bg-gray-50 p-7 rounded-xl border border-gray-200 shadow-sm">
                        <h2 class="text-xl font-semibold text-gray-800 mb-6 pb-3 border-b border-gray-200 flex items-center">
                            <svg class="w-7 h-7 mr-3 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                            <span>Détails de la commande</span>
                        </h2>
                        <div class="space-y-5">
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600 flex items-center">
                                    <svg class="w-5 h-5 mr-3 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                    Référence
                                </span>
                                <span class="font-medium text-gray-900">{{ $order->order_number }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600 flex items-center">
                                    <svg class="w-5 h-5 mr-3 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    Date et heure
                                </span>
                                <span class="font-medium text-gray-900">{{ $order->created_at->translatedFormat('d F Y \à H\hi') }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600 flex items-center">
                                    <svg class="w-5 h-5 mr-3 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                    Montant total
                                </span>
                                <span class="text-2xl font-bold text-green-600">{{ number_format($order->total, 2) }} DT</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600 flex items-center">
                                    <svg class="w-5 h-5 mr-3 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                                    </svg>
                                    Mode de paiement
                                </span>
                                <span class="font-medium text-gray-900 capitalize">
                                    @switch($order->payment_method)
                                        @case('cash') Paiement à la livraison @break
                                        @case('credit_card') Carte bancaire @break
                                        @case('bank_transfer') Virement bancaire @break
                                        @default {{ $order->payment_method }}
                                    @endswitch
                                </span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600 flex items-center">
                                    <svg class="w-5 h-5 mr-3 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                                    </svg>
                                    Mode de livraison
                                </span>
                                <span class="font-medium text-gray-900 capitalize">
                                    {{ $order->delivery_method === 'express' ? 'Express (24h)' : 'Standard (3-5 jours ouvrés)' }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Carte Adresse de livraison -->
                    <div class="bg-gray-50 p-7 rounded-xl border border-gray-200 shadow-sm">
                        <h2 class="text-xl font-semibold text-gray-800 mb-6 pb-3 border-b border-gray-200 flex items-center">
                            <svg class="w-7 h-7 mr-3 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <span>Adresse de livraison</span>
                        </h2>
                        <div class="space-y-4 text-gray-700">
                            <div class="font-medium flex items-center text-gray-900">
                                <svg class="w-5 h-5 mr-3 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                {{ $order->customer_first_name }} {{ $order->customer_last_name }}
                            </div>
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-3 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                </svg>
                                {{ $order->delivery_street }}
                            </div>
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-3 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                </svg>
                                {{ $order->delivery_zip_code }} {{ $order->delivery_city }}
                            </div>
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-3 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                {{ $order->delivery_country }}
                            </div>
                            <div class="pt-4 mt-4 border-t border-gray-100 flex items-center">
                                <svg class="w-5 h-5 mr-3 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                                <span class="font-medium text-gray-900">Contact :</span>
                                <span class="ml-2">{{ $order->customer_phone }}</span>
                            </div>
                            @if($order->customer_email)
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-3 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                                <span class="font-medium text-gray-900">Email :</span>
                                <span class="ml-2">{{ $order->customer_email }}</span>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Liste des articles avec style amélioré -->
                <div class="mb-14">
                    <h2 class="text-xl font-semibold text-gray-800 mb-7 flex items-center">
                        <svg class="w-7 h-7 mr-3 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                        <span>Détail des articles ({{ count($order->items) }})</span>
                    </h2>
                    <div class="border border-gray-200 rounded-xl overflow-hidden shadow-sm">
                        @foreach($order->items as $item)
                        <div class="flex items-center p-6 hover:bg-gray-50 transition duration-150 border-b border-gray-200 last:border-b-0">
                            <div class="w-24 h-24 flex-shrink-0 bg-gray-100 rounded-lg overflow-hidden mr-6 shadow-inner">
                                @if($item->product->image)
                                    <img src="{{ asset('storage/'.$item->product->image) }}" alt="{{ $item->product->name }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                                        <svg class="h-10 w-10 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                @endif
                            </div>
                            <div class="flex-1 min-w-0">
                                <h3 class="text-lg font-medium text-gray-900 mb-1">{{ $item->product->name }}</h3>
                                <div class="flex flex-wrap gap-x-4 gap-y-2 mt-3">
                                    <p class="text-sm text-gray-600 flex items-center">
                                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        Quantité : {{ $item->quantity }}
                                    </p>
                                    <p class="text-sm text-gray-600 flex items-center">
                                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        Prix unitaire : {{ number_format($item->price, 2) }} DT
                                    </p>
                                </div>
                            </div>
                            <div class="ml-6 text-right">
                                <p class="text-lg font-bold text-gray-900">{{ number_format($item->price * $item->quantity, 2) }} DT</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Section Total et Actions -->
                <div class="flex flex-col lg:flex-row justify-between items-center border-t border-gray-200 pt-10">
                    <div class="mb-6 lg:mb-0">
                        <p class="text-xl text-gray-600 mb-2">Montant total de la commande</p>
                        <p class="text-3xl font-bold text-green-600">{{ number_format($order->total, 2) }} DT</p>
                    </div>
                    <div class="flex flex-col sm:flex-row gap-4 w-full lg:w-auto">

                        <a href="{{ url('/') }}" class="px-8 py-3.5 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition duration-150 flex items-center justify-center text-lg font-medium shadow-md hover:shadow-lg">
                            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                            Retour à l'accueil
                        </a>
                    </div>
                </div>

              <!-- Section Contact - Version améliorée -->
<hr class="my-12 border-gray-200">

<div class="text-center px-4">

    <div class="max-w-md mx-auto">
        <p class="text-gray-600 mb-4">
            Pour toute question concernant votre commande, notre équipe est disponible :
        </p>

        <div class="mt-4 flex flex-col sm:flex-row justify-center gap-4">
            <a href="mailto:contact@smartshop.com"
               class="inline-flex items-center text-blue-600 hover:text-blue-800 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
                contact@smartshop.com
            </a>

            <a href="tel:+21612345678"
               class="inline-flex items-center text-blue-600 hover:text-blue-800 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                </svg>
                +216 52 345 678
            </a>
        </div>
    </div>
</div>
            </div>
        </div>
    </div>
</div>

<style>
    address {
        font-style: normal;
    }
    .shadow-inner {
        box-shadow: inset 0 2px 4px 0 rgba(0, 0, 0, 0.05);
    }
</style>
@endsection
