@extends('layouts.admin')

@section('content')
<div class="content">
    <div class="container-fluid px-4">
        <!-- Card Container -->
        <div class="bg-white rounded-xl shadow-sm overflow-hidden w-full mx-auto">
            <!-- Card Header -->
            <div class="flex justify-between items-center px-6 py-4 border-b border-gray-200 bg-gray-50">
                <h1 class="h3 mb-1 text-gray-800">Product Details</h1>
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
                        <div class="absolute inset-0 bg-gray-200 bg-opacity-0 group-hover:bg-opacity-10 rounded-lg transition-all duration-300 flex items-center justify-center">
                        </div>
                        <div class="absolute bottom-0 left-0 right-0 bg-red-500 text-white text-xs text-center py-1 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            Click to enlarge
                        </div>
                    </div>
                    @else
                    <div class="w-32 h-32 md:w-40 md:h-40 rounded-lg border-4 border-white shadow-lg bg-gray-100 flex items-center justify-center">
                        <span class="text-gray-400">No image</span>
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
                                {{ $product->stock > 0 ? 'In Stock (' . $product->stock . ' units)' : 'Out of Stock' }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Details Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <!-- Product Info Card -->
                    <div class="bg-gray-50 rounded-lg border border-gray-200 overflow-hidden">
                        <div class="bg-gray-100 px-4 py-3 border-b border-gray-200">
                            <h3 class="text-sm font-medium text-gray-700">
                                Product Information
                            </h3>
                        </div>
                        <div class="px-4 py-3 bg-white">
                            <dl class="space-y-3">
                                <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                    <dt class="text-sm text-gray-500">Reference</dt>
                                    <dd class="text-sm font-medium text-gray-900">#{{ $product->id }}</dd>
                                </div>
                                <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                    <dt class="text-sm text-gray-500">Creation Date</dt>
                                    <dd class="text-sm font-medium text-gray-900">{{ $product->created_at->format('m/d/Y H:i') }}</dd>
                                </div>
                                <div class="flex justify-between items-center py-2">
                                    <dt class="text-sm text-gray-500">Last Updated</dt>
                                    <dd class="text-sm font-medium text-gray-900">{{ $product->updated_at->format('m/d/Y H:i') }}</dd>
                                </div>
                            </dl>
                        </div>
                    </div>

                    <!-- Description Card -->
                    <div class="bg-gray-50 rounded-lg border border-gray-200 overflow-hidden">
                        <div class="bg-gray-100 px-4 py-3 border-b border-gray-200">
                            <h3 class="text-sm font-medium text-gray-700">
                                Description
                            </h3>
                        </div>
                        <div class="px-4 py-3 bg-white">
                            <p class="text-gray-700 whitespace-pre-line">{{ $product->description ?: 'No description available.' }}</p>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row justify-end gap-3 border-t border-gray-200 pt-6">
                    <a href="{{ route('admin.products.index') }}"
                       class="px-5 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-100 transition duration-200 flex items-center justify-center">
                        Back to List
                    </a>

                    <a href="{{ route('admin.products.edit', $product->id) }}"
                       class="px-5 py-2 rounded-lg text-white hover:bg-green-600 transition duration-200 flex items-center justify-center"
                       style="background-color:rgb(19, 216, 118);">
                        Edit
                    </a>

                    <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="w-full sm:w-auto">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="w-full px-5 py-2 rounded-lg text-white hover:bg-red-600 transition-colors duration-200 flex items-center justify-center"
                                style="background-color:rgb(244, 18, 18);"
                                onclick="return confirm('Are you sure you want to permanently delete this product? This action cannot be undone.')">
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
        <button onclick="closeLightbox()" class="absolute -top-12 right-0 text-white hover:text-gray-300 transition-colors">
            Close (X)
        </button>
        <img id="lightboxImage" src="{{ Storage::url($product->image) }}" alt="Enlarged image of {{ $product->name }}" class="max-h-screen w-full object-contain">
        <div class="text-white text-center mt-2 text-sm">
            Click outside image or press ESC to close
        </div>
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
