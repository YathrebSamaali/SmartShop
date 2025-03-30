@extends('layouts.admin')

@section('content')
<div class="content">
    <div class="container-fluid px-4">
        <!-- Card Container -->
        <div class="bg-white rounded-xl shadow-sm overflow-hidden w-full mx-auto">
            <!-- Card Header -->
            <div class="flex justify-between items-center px-6 py-4 border-b border-gray-200 bg-gray-50">
                <h1 class="text-xl font-bold text-gray-800">Détails du Produit</h1>
                <a href="{{ route('admin.products.index') }}" class="text-gray-500 hover:text-gray-700 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </a>
            </div>

            <!-- Card Body -->
            <div class="p-6">
                <!-- Product Section -->
                <div class="flex flex-col md:flex-row items-start md:items-center gap-8 mb-8">
                    <!-- Product Image with Lightbox -->
                    @if($product->image)
                    <div class="relative group cursor-pointer" onclick="openLightbox('{{ Storage::url($product->image) }}')">
                        <img class="w-32 h-32 md:w-40 md:h-40 rounded-lg border-4 border-white shadow-lg object-cover transition-transform duration-300 group-hover:scale-105"
                             src="{{ Storage::url($product->image) }}"
                             alt="{{ $product->name }}">
                        <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-10 rounded-lg transition-all duration-300 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white opacity-0 group-hover:opacity-100 transition-opacity duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7" />
                            </svg>
                        </div>
                    </div>
                    @else
                    <div class="w-32 h-32 md:w-40 md:h-40 rounded-lg border-4 border-white shadow-lg bg-gray-100 flex items-center justify-center">
                        <span class="text-gray-400">Pas d'image</span>
                    </div>
                    @endif

                    <!-- Product Info -->
                    <div class="flex-1">
                        <h2 class="text-2xl font-bold text-gray-800 mb-2">{{ $product->name }}</h2>
                        <p class="text-lg font-semibold text-blue-600 mb-3">{{ number_format($product->price, 2) }} DT</p>

                        <!-- Badges -->
                        <div class="flex flex-wrap gap-2 mb-4">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                {{ $product->category }}
                            </span>

                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                                {{ $product->stock > 0 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                {{ $product->stock > 0 ? 'En Stock (' . $product->stock . ' unités)' : 'En Rupture' }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Details Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <!-- Product Info Card -->
                    <div class="bg-gray-50 rounded-lg border border-gray-200 overflow-hidden">
                        <div class="bg-gray-100 px-4 py-3 border-b border-gray-200">
                            <h3 class="text-sm font-medium text-gray-700 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-gray-500" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z" />
                                </svg>
                                Informations Produit
                            </h3>
                        </div>
                        <div class="px-4 py-3 bg-white">
                            <dl class="space-y-3">
                                <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                    <dt class="text-sm text-gray-500">Référence</dt>
                                    <dd class="text-sm font-medium text-gray-900">#{{ $product->id }}</dd>
                                </div>
                                <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                    <dt class="text-sm text-gray-500">Date création</dt>
                                    <dd class="text-sm font-medium text-gray-900">{{ $product->created_at->format('d/m/Y H:i') }}</dd>
                                </div>
                                <div class="flex justify-between items-center py-2">
                                    <dt class="text-sm text-gray-500">Dernière modification</dt>
                                    <dd class="text-sm font-medium text-gray-900">{{ $product->updated_at->format('d/m/Y H:i') }}</dd>
                                </div>
                            </dl>
                        </div>
                    </div>

                    <!-- Description Card -->
                    <div class="bg-gray-50 rounded-lg border border-gray-200 overflow-hidden">
                        <div class="bg-gray-100 px-4 py-3 border-b border-gray-200">
                            <h3 class="text-sm font-medium text-gray-700 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-gray-500" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2h-1V9z" clip-rule="evenodd" />
                                </svg>
                                Description
                            </h3>
                        </div>
                        <div class="px-4 py-3 bg-white">
                            <p class="text-gray-700 whitespace-pre-line">{{ $product->description ?: 'Aucune description disponible.' }}</p>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row justify-end gap-3 border-t border-gray-200 pt-6">
                    <a href="{{ route('admin.products.index') }}"
                       class="px-5 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-100 transition duration-200 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                        </svg>
                        Retour à la liste
                    </a>

                    <a href="{{ route('admin.products.edit', $product->id) }}"
                       class="px-5 py-2 rounded-lg text-white hover:bg-green-600 transition duration-200 flex items-center justify-center"
                       style="background-color:rgb(19, 216, 118);">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                        </svg>
                        Modifier
                    </a>

                    <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="w-full sm:w-auto">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="w-full px-5 py-2 rounded-lg text-white hover:bg-red-600 transition-colors duration-200 flex items-center justify-center"
                                style="background-color:rgb(244, 18, 18);"
                                onclick="return confirm('Êtes-vous sûr de vouloir supprimer définitivement ce produit ? Cette action est irréversible.')">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                            </svg>
                            Supprimer
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Lightbox Modal -->
@if($product->image)
<div id="lightboxModal" class="fixed inset-0 bg-black bg-opacity-90 z-50 hidden flex items-center justify-center p-4">
    <div class="relative max-w-4xl w-full">
        <button onclick="closeLightbox()" class="absolute -top-12 right-0 text-white hover:text-gray-300 transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
            <span class="sr-only">Fermer</span>
        </button>
        <div class="flex justify-between items-center absolute top-1/2 left-0 right-0 transform -translate-y-1/2 px-4">
            <button onclick="navigateLightbox(-1)" class="text-white hover:text-gray-300 bg-black bg-opacity-50 rounded-full p-2 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                <span class="sr-only">Précédent</span>
            </button>
            <button onclick="navigateLightbox(1)" class="text-white hover:text-gray-300 bg-black bg-opacity-50 rounded-full p-2 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
                <span class="sr-only">Suivant</span>
            </button>
        </div>
        <img id="lightboxImage" src="{{ Storage::url($product->image) }}" alt="Image agrandie de {{ $product->name }}" class="max-h-screen w-full object-contain">
    </div>
</div>
@endif

<script>
    function openLightbox(imageSrc) {
        document.getElementById('lightboxImage').src = imageSrc;
        document.getElementById('lightboxModal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeLightbox() {
        document.getElementById('lightboxModal').classList.add('hidden');
        document.body.style.overflow = 'auto';
    }

    function navigateLightbox(direction) {
        // Pour une future implémentation si vous avez plusieurs images
        closeLightbox();
    }

    // Close lightbox when clicking outside the image
    document.addEventListener('click', function(e) {
        if (e.target.id === 'lightboxModal') {
            closeLightbox();
        }
    });

    // Close lightbox with ESC key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && !document.getElementById('lightboxModal').classList.contains('hidden')) {
            closeLightbox();
        }
    });
</script>

<style>
    .whitespace-pre-line {
        white-space: pre-line;
    }
    #lightboxModal {
        transition: opacity 0.3s ease;
    }
</style>
@endsection
