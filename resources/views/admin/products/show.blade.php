@extends('layouts.admin')

@section('content')
<div class="content">
    <div class="container-fluid px-0" style="margin-left: 120px;">
        <div class="bg-white rounded-lg shadow-md p-6 mx-auto" style="max-width: 85%;">
            <!-- Card Header -->
            <div class="flex justify-between items-center mb-6">
                <h1 class="h3 mb-1 text-gray-800">Product Details</h1>
                <a href="{{ route('admin.products.index') }}" class="text-gray-500 hover:text-gray-700 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </a>
            </div>

            <!-- Card Body -->
            <div class="p-6">
                <!-- Product Section - Compact layout -->
                <div class="flex flex-col md:flex-row gap-4 items-start mb-8">
                    <!-- Mini Product Image (Very small and left-aligned) -->
                    <div class="w-20 h-20 flex-shrink-0"> <!-- Fixed small size -->
                        @if($product->image)
                        <div class="relative group cursor-pointer" onclick="openLightbox('{{ Storage::url($product->image) }}')">
                            <img class="w-full h-full rounded border border-gray-200 object-cover shadow-xs hover:shadow-sm transition-all duration-200"
                                 src="{{ Storage::url($product->image) }}"
                                 alt="{{ $product->name }}">
                            <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-10 rounded transition-all duration-200"></div>
                        </div>
                        @else
                        <div class="w-full h-full rounded border border-gray-200 bg-gray-100 flex items-center justify-center">
                            <span class="text-gray-400 text-xs">No image</span>
                        </div>
                        @endif
                    </div>

                    <!-- Product Info (Takes remaining space) -->
                    <div class="flex-1">
                        <h2 class="text-xl font-bold text-gray-800 mb-1">{{ $product->name }}</h2>
                        <p class="text-md font-semibold text-blue-600 mb-2">{{ number_format($product->price, 2) }} DT</p>

                        <!-- Compact Badges -->
                        <div class="flex flex-wrap gap-1 mb-2">
                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                {{ $product->category }}
                            </span>
                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium
                                {{ $product->stock > 0 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $product->stock > 0 ? 'Stock: ' . $product->stock : 'Out of Stock' }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Details Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                    <!-- Product Info Card -->
                    <div class="bg-gray-50 rounded border border-gray-200 overflow-hidden">
                        <div class="bg-gray-100 px-3 py-2 border-b border-gray-200">
                            <h3 class="text-xs font-medium text-gray-700">
                                Product Information
                            </h3>
                        </div>
                        <div class="px-3 py-2 bg-white">
                            <dl class="space-y-2">
                                <div class="flex justify-between items-center py-1 text-sm">
                                    <dt class="text-gray-500">Reference</dt>
                                    <dd class="font-medium text-gray-900">#{{ $product->id }}</dd>
                                </div>
                                <div class="flex justify-between items-center py-1 text-sm">
                                    <dt class="text-gray-500">Created</dt>
                                    <dd class="font-medium text-gray-900">{{ $product->created_at->format('m/d/Y') }}</dd>
                                </div>
                                <div class="flex justify-between items-center py-1 text-sm">
                                    <dt class="text-gray-500">Updated</dt>
                                    <dd class="font-medium text-gray-900">{{ $product->updated_at->format('m/d/Y') }}</dd>
                                </div>
                            </dl>
                        </div>
                    </div>

                    <!-- Description Card -->
                    <div class="bg-gray-50 rounded border border-gray-200 overflow-hidden">
                        <div class="bg-gray-100 px-3 py-2 border-b border-gray-200">
                            <h3 class="text-xs font-medium text-gray-700">
                                Description
                            </h3>
                        </div>
                        <div class="px-3 py-2 bg-white">
                            <p class="text-sm text-gray-700 whitespace-pre-line">{{ $product->description ?: 'No description available.' }}</p>
                        </div>
                    </div>
                </div>

                <!-- Compact Action Buttons -->
                <div class="flex justify-end gap-2 pt-6">
                    <a href="{{ route('admin.products.index') }}"
                       class="px-4 py-2 border border-gray-300 rounded text-sm text-gray-700 hover:bg-gray-100 transition">
                        Cancel
                    </a>
                    <a href="{{ route('admin.products.edit', $product->id) }}"
                       class="px-4 py-2 rounded text-sm text-white hover:bg-green-600 transition"
                       style="background-color:rgb(19, 216, 118);">
                        Edit
                    </a>
                    <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="px-4 py-2 rounded text-sm text-white hover:bg-red-600 transition"
                                style="background-color:rgb(244, 18, 18);"
                                onclick="return confirm('Delete this product permanently?')">
                            Delete
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
        <button onclick="closeLightbox()" class="absolute -top-10 right-0 text-white hover:text-gray-300">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
        <img id="lightboxImage" src="{{ Storage::url($product->image) }}" 
             class="max-h-[90vh] max-w-[90vw] object-contain"
             alt="Enlarged product image">
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

    document.addEventListener('click', function(e) {
        if (e.target.id === 'lightboxModal') closeLightbox();
    });

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') closeLightbox();
    });
</script>

<style>
    .whitespace-pre-line { white-space: pre-line; }
    #lightboxModal { transition: opacity 0.2s ease; }
</style>
@endsection