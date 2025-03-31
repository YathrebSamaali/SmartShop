<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Welcome - SmartShop</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">

    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.0/dist/tailwind.min.css" rel="stylesheet">

    </style>
</head>
<body class="bg-white text-gray-900">

    <!-- Header Section -->
    @include('layouts.header')

    <!-- Hero Section -->
    <div class="relative w-full h-screen bg-cover bg-center pt-12" style="background-image: url('{{ asset('images/bg.jpg') }}');">
        <div class="flex h-full items-center justify-between px-10 text-white">
            <div class="w-1/2 pl-24">
                <h1 class="text-6xl font-semibold mb-4 leading-tight" style="font-family: 'Playfair Display', serif; color: #543929;">
                    Discover Timeless Elegance and Luxury
                </h1>
                <p class="text-xl mb-6 leading-relaxed" style="font-family: 'Poppins', sans-serif; color: #1C2942;">
                    Explore a curated collection that blends sophistication and modern style. Experience an exclusive selection of designs to enhance your lifestyle.
                </p>
                <a href="#products" class="inline-block px-6 py-2 bg-gray-900 text-white font-semibold rounded-lg hover:bg-gray-800 transition-all">
                    See More
                </a>
            </div>
        </div>
    </div>
<!-- Products Section -->
<section id="products" class="py-12 bg-gray-100">
    <h2 class="text-5xl font-bold text-center mb-8" style="font-family: 'Playfair Display', serif; color: #543929;">
        Our Products
    </h2>

    <!-- Category Filter Buttons -->
    <div class="text-center mb-8">
    <div class="space-x-4">
        <!-- All Products Button: Maintient le fond et les effets de survol -->
        <button class="category-btn bg-gray-800 text-white px-6 py-2 rounded-lg" data-category="all">
            All Products
        </button>

        <!-- Men Button: Ajoute une bordure noire sans effet de survol, texte en noir -->
        <button class="category-btn border-2 border-black text-black px-6 py-2 rounded-lg" data-category="Men">
            Men
        </button>

        <!-- Women Button: Ajoute une bordure noire sans effet de survol, texte en noir -->
        <button class="category-btn border-2 border-black text-black px-6 py-2 rounded-lg" data-category="Women">
            Women
        </button>

        <!-- Shoes Button: Ajoute une bordure noire sans effet de survol, texte en noir -->
        <button class="category-btn border-2 border-black text-black px-6 py-2 rounded-lg" data-category="Shoes">
            Shoes
        </button>
    </div>
</div>


    <!-- Products Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 px-36" id="product-grid">
        @foreach ($products->take(8) as $product) <!-- Limite à 8 produits -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden transform transition duration-300 hover:scale-105 hover:shadow-2xl product-item" data-category="{{ $product->category }}">
                <div class="relative group">
                <img src="{{ $product->image ? asset('storage/'.$product->image) : asset('images/placeholder-product.jpg') }}"
                     alt="{{ $product->name }}"
                     class="w-full h-96 object-cover transition-transform duration-300 group-hover:scale-110"                  loading="lazy">
                    <span class="absolute top-4 left-4 bg-gray-900 text-white text-sm font-semibold px-3 py-1 rounded-full">
                        {{ number_format($product->price, 2) }} DT
                    </span>
                    <a href="#" class="quick-view-btn absolute inset-0 bg-black bg-opacity-30 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300"
   data-product-id="{{ $product->id }}">
    <span class="bg-white text-[#543929] font-semibold py-2 px-4 rounded-lg shadow-md hover:bg-[#543929] hover:text-white transition">
        Quick View
    </span>
</a>
                </div>
                <div class="p-4 flex flex-col">
                    <h3 class="text-xl font-semibold text-gray-900">{{ $product->name }}</h3>
                    <p class="text-gray-600 mt-2 line-clamp-2">{{ $product->description }}</p>
                </div>
            </div>
        @endforeach
    </div>



    <!-- View All Products Button -->
    <div class="text-center mt-12">
    <a href="/products" class="inline-block px-8 py-3 bg-gray-900 text-white font-semibold rounded-lg hover:bg-gray-800 transition-all text-lg">
    View All Products
</a>
    </div>
</section>

<!-- JavaScript for Category Filter -->
<script>
    // Sélectionner tous les boutons de catégorie
    const categoryButtons = document.querySelectorAll('.category-btn');
    const productItems = document.querySelectorAll('.product-item');

    categoryButtons.forEach(button => {
        button.addEventListener('click', function() {
            const category = this.getAttribute('data-category'); // Récupérer la catégorie du bouton cliqué

            // Afficher ou masquer les produits selon la catégorie
            productItems.forEach(item => {
                const itemCategory = item.getAttribute('data-category').toLowerCase();

                if (category === 'all' || itemCategory === category.toLowerCase()) {
                    item.style.display = 'block'; // Afficher le produit
                } else {
                    item.style.display = 'none'; // Masquer le produit
                }
            });

            // Mettre à jour l'apparence des boutons (par exemple, ajouter une classe active)
            categoryButtons.forEach(btn => btn.classList.remove('bg-gray-100', 'font-semibold'));
            this.classList.add('bg-gray-100', 'font-semibold');
        });
    });
</script>

<section id="new-collection" class="py-16 bg-gray-100">
    <div class="container mx-auto px-4">


        <!-- Modern Carousel -->
        <div class="relative">
            <div class="flex space-x-6 overflow-x-auto pb-8 scrollbar-hide snap-x snap-mandatory">
                <!-- Item 1 -->
                <div class="flex-shrink-0 w-4/5 md:w-1/3 lg:w-1/5 snap-center">
                    <div class="group relative overflow-hidden rounded-2xl shadow-xl h-96 transition-all duration-500 hover:shadow-2xl">
                        <img src="{{ asset('images/collection1.jpg') }}" alt="Spring Collection"
                             class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent flex flex-col justify-end p-6">
                            <span class="text-sm text-white/80 mb-1">New Arrival</span>
                            <h3 class="text-2xl font-bold text-white">Spring Elegance</h3>
                            <a href="#" class="mt-3 inline-flex items-center text-white border-b border-transparent hover:border-white transition-all">
                                Discover
                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Item 2 -->
                <div class="flex-shrink-0 w-4/5 md:w-1/3 lg:w-1/5 snap-center">
                    <div class="group relative overflow-hidden rounded-2xl shadow-xl h-96 transition-all duration-500 hover:shadow-2xl">
                        <img src="{{ asset('images/collection2.png') }}" alt="Summer Collection"
                             class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent flex flex-col justify-end p-6">
                            <span class="text-sm text-white/80 mb-1">Bestseller</span>
                            <h3 class="text-2xl font-bold text-white">Summer Vibes</h3>
                            <a href="#" class="mt-3 inline-flex items-center text-white border-b border-transparent hover:border-white transition-all">
                                Discover
                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Item 3 -->
                <div class="flex-shrink-0 w-4/5 md:w-1/3 lg:w-1/5 snap-center">
                    <div class="group relative overflow-hidden rounded-2xl shadow-xl h-96 transition-all duration-500 hover:shadow-2xl">
                        <img src="{{ asset('images/collection3.png') }}" alt="Autumn Collection"
                             class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent flex flex-col justify-end p-6">
                            <span class="text-sm text-white/80 mb-1">New Arrival</span>
                            <h3 class="text-2xl font-bold text-white">Autumn Charm</h3>
                            <a href="#" class="mt-3 inline-flex items-center text-white border-b border-transparent hover:border-white transition-all">
                                Discover
                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Item 4 -->
                <div class="flex-shrink-0 w-4/5 md:w-1/3 lg:w-1/5 snap-center">
                    <div class="group relative overflow-hidden rounded-2xl shadow-xl h-96 transition-all duration-500 hover:shadow-2xl">
                        <img src="{{ asset('images/collection4.png') }}" alt="Winter Collection"
                             class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent flex flex-col justify-end p-6">
                            <span class="text-sm text-white/80 mb-1">Exclusive</span>
                            <h3 class="text-2xl font-bold text-white">Winter Glow</h3>
                            <a href="#" class="mt-3 inline-flex items-center text-white border-b border-transparent hover:border-white transition-all">
                                Discover
                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Item 5 -->
                <div class="flex-shrink-0 w-4/5 md:w-1/3 lg:w-1/5 snap-center">
                    <div class="group relative overflow-hidden rounded-2xl shadow-xl h-96 transition-all duration-500 hover:shadow-2xl">
                        <img src="{{ asset('images/collection5.png') }}" alt="Limited Edition"
                             class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent flex flex-col justify-end p-6">
                            <span class="text-sm text-white/80 mb-1">Limited Edition</span>
                            <h3 class="text-2xl font-bold text-white">Unique Pieces</h3>
                            <a href="#" class="mt-3 inline-flex items-center text-white border-b border-transparent hover:border-white transition-all">
                                Discover
                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Additional Collection Items -->

                <!-- Item 6 - Urban Streetwear -->
                <div class="flex-shrink-0 w-4/5 md:w-1/3 lg:w-1/5 snap-center">
                    <div class="group relative overflow-hidden rounded-2xl shadow-xl h-96 transition-all duration-500 hover:shadow-2xl">
                        <img src="{{ asset('images/collection5.jpg') }}" alt="Urban Streetwear"
                             class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent flex flex-col justify-end p-6">
                            <span class="text-sm text-white/80 mb-1">Trending Now</span>
                            <h3 class="text-2xl font-bold text-white">Urban Streetwear</h3>
                            <a href="#" class="mt-3 inline-flex items-center text-white border-b border-transparent hover:border-white transition-all">
                                Discover
                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Item 7 - Sustainable Fashion -->
                <div class="flex-shrink-0 w-4/5 md:w-1/3 lg:w-1/5 snap-center">
                    <div class="group relative overflow-hidden rounded-2xl shadow-xl h-96 transition-all duration-500 hover:shadow-2xl">
                        <img src="{{ asset('images/collection6.jpg') }}" alt="Sustainable Fashion"
                             class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent flex flex-col justify-end p-6">
                            <span class="text-sm text-white/80 mb-1">Eco-Friendly</span>
                            <h3 class="text-2xl font-bold text-white">Sustainable Fashion</h3>
                            <a href="#" class="mt-3 inline-flex items-center text-white border-b border-transparent hover:border-white transition-all">
                                Discover
                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Item 8 - Luxury Essentials -->
                <div class="flex-shrink-0 w-4/5 md:w-1/3 lg:w-1/5 snap-center">
                    <div class="group relative overflow-hidden rounded-2xl shadow-xl h-96 transition-all duration-500 hover:shadow-2xl">
                        <img src="{{ asset('images/collection7.jpg') }}" alt="Luxury Essentials"
                             class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent flex flex-col justify-end p-6">
                            <span class="text-sm text-white/80 mb-1">Premium</span>
                            <h3 class="text-2xl font-bold text-white">Luxury Essentials</h3>
                            <a href="#" class="mt-3 inline-flex items-center text-white border-b border-transparent hover:border-white transition-all">
                                Discover
                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Item 9 - Active Wear -->
                <div class="flex-shrink-0 w-4/5 md:w-1/3 lg:w-1/5 snap-center">
                    <div class="group relative overflow-hidden rounded-2xl shadow-xl h-96 transition-all duration-500 hover:shadow-2xl">
                        <img src="{{ asset('images/collection8.jpg') }}" alt="Active Wear"
                             class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent flex flex-col justify-end p-6">
                            <span class="text-sm text-white/80 mb-1">New Line</span>
                            <h3 class="text-2xl font-bold text-white">Active Wear</h3>
                            <a href="#" class="mt-3 inline-flex items-center text-white border-b border-transparent hover:border-white transition-all">
                                Discover
                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Navigation -->
        <div class="flex justify-center mt-8 space-x-3">
            <button class="collection-prev w-10 h-10 rounded-full bg-white shadow-md flex items-center justify-center hover:bg-gray-100 transition">
                ❮
            </button>
            <button class="collection-next w-10 h-10 rounded-full bg-white shadow-md flex items-center justify-center hover:bg-gray-100 transition">
                ❯
            </button>
        </div>
    </div>
</section>

<style>
    .scrollbar-hide::-webkit-scrollbar {
        display: none;
    }
    .scrollbar-hide {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
</style>

<script>
    // Simple carousel navigation
    document.querySelector('.collection-next').addEventListener('click', () => {
        const container = document.querySelector('.overflow-x-auto');
        container.scrollBy({ left: 300, behavior: 'smooth' });
    });

    document.querySelector('.collection-prev').addEventListener('click', () => {
        const container = document.querySelector('.overflow-x-auto');
        container.scrollBy({ left: -300, behavior: 'smooth' });
    });
</script>



<section class="services py-16 bg-gray-100">
    <div class="container mx-auto px-4">
    <h2 class="text-5xl font-bold text-center mb-8" style="font-family: 'Playfair Display', serif; color: #543929;">
            Why Choose Us
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- Fast Delivery -->
            <div class="service-card p-6 text-center border border-gray-100 rounded-lg hover:border-[#543929] transition-all duration-300">
                <div class="icon-container w-20 h-20 mx-auto mb-4 rounded-full bg-[#543929]/10 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#543929" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"></circle>
                        <polyline points="12 6 12 12 16 14"></polyline>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold mb-2">Fast Delivery</h3>
                <p class="text-gray-600">Get your order in 2-3 business days</p>
            </div>

            <!-- Quality Guarantee -->
            <div class="service-card p-6 text-center border border-gray-100 rounded-lg hover:border-[#543929] transition-all duration-300">
                <div class="icon-container w-20 h-20 mx-auto mb-4 rounded-full bg-[#543929]/10 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#543929" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                        <polyline points="22 4 12 14.01 9 11.01"></polyline>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold mb-2">Quality Guarantee</h3>
                <p class="text-gray-600">Premium materials and craftsmanship</p>
            </div>

            <!-- Secure Checkout -->
            <div class="service-card p-6 text-center border border-gray-100 rounded-lg hover:border-[#543929] transition-all duration-300">
                <div class="icon-container w-20 h-20 mx-auto mb-4 rounded-full bg-[#543929]/10 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#543929" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                        <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold mb-2">Secure Checkout</h3>
                <p class="text-gray-600">256-bit SSL encryption</p>
            </div>

            <!-- Loyalty Rewards -->
            <div class="service-card p-6 text-center border border-gray-100 rounded-lg hover:border-[#543929] transition-all duration-300">
                <div class="icon-container w-20 h-20 mx-auto mb-4 rounded-full bg-[#543929]/10 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#543929" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold mb-2">Loyalty Rewards</h3>
                <p class="text-gray-600">Earn points with every purchase</p>
            </div>
        </div>
    </div>
</section>

<!-- Quick View Modal -->
<!-- Quick View Modal -->
<div id="quickViewModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <!-- Background overlay -->
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>

        <!-- Modal content -->
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-4xl sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <button id="closeModal" class="absolute top-4 right-4 text-gray-500 hover:text-gray-700">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>

                    <div class="w-full sm:w-1/2">
                        <img id="modalProductImage" src="" alt="Product" class="w-full h-auto rounded-lg">
                    </div>

                    <div class="mt-4 sm:mt-0 sm:ml-4 sm:w-1/2">
                        <h3 id="modalProductName" class="text-2xl font-bold text-gray-900"></h3>

                        <!-- Price Section -->
                        <div class="mt-4 bg-gray-50 p-4 rounded-lg">
                            <div class="flex items-center justify-between">
                                <span class="text-lg font-medium text-gray-700">Prix:</span>
                                <div class="flex items-center">
                                    <span id="modalProductPrice" class="text-2xl font-bold text-[#543929]"></span>
                                    <span id="modalProductOldPrice" class="text-lg text-gray-500 line-through ml-3 hidden"></span>
                                </div>
                            </div>
                            <div class="mt-2 flex items-center justify-between">
                                <span class="text-sm text-gray-600">Disponibilité:</span>
                                <span id="modalProductStock" class="text-sm font-medium text-green-600"></span>
                            </div>
                        </div>

                        <!-- Description Section -->
                        <div class="mt-6">
                            <h4 class="text-lg font-semibold text-[#3a2a1d] mb-2">Description du produit</h4>
                            <div id="modalProductDescription" class="text-gray-600">
                                <!-- Description will be inserted here -->
                            </div>
                        </div>

                        <!-- Options (taille, couleur, etc.) - Ces sections seront masquées si non pertinentes -->
                        <div id="sizeOptionsContainer" class="mt-6 hidden">
                            <div class="mb-4">
                                <h4 class="text-md font-semibold text-[#3a2a1d] mb-2">Taille</h4>
                                <div id="sizeOptions" class="flex flex-wrap gap-2">
                                    <!-- Options de taille seront insérées ici si disponibles -->
                                </div>
                            </div>
                        </div>

                        <div id="colorOptionsContainer" class="mt-6 hidden">
                            <div class="mb-4">
                                <h4 class="text-md font-semibold text-[#3a2a1d] mb-2">Couleur</h4>
                                <div id="colorOptions" class="flex flex-wrap gap-2">
                                    <!-- Options de couleur seront insérées ici si disponibles -->
                                </div>
                            </div>
                        </div>

                        <!-- Add to cart button -->
                        <div class="mt-6">
                            <button id="addToCartBtn" class="w-full bg-white text-black py-3 px-6 rounded-lg border-2 border-black hover:bg-black hover:text-white transition flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z" />
                                </svg>
                                Ajouter au panier
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('quickViewModal');
    const closeModalBtn = document.getElementById('closeModal');
    const quickViewBtns = document.querySelectorAll('.quick-view-btn');
    const addToCartBtn = document.getElementById('addToCartBtn');
    const sizeOptionsContainer = document.getElementById('sizeOptionsContainer');
    const colorOptionsContainer = document.getElementById('colorOptionsContainer');

    // Fonction pour vérifier si l'utilisateur est connecté
    const isUserLoggedIn = () => {
        // Vous devez implémenter cette fonction selon votre système d'authentification
        // Par exemple, vérifier un token dans localStorage ou un cookie
        return localStorage.getItem('authToken') !== null;
    };

    // Fonction pour sauvegarder le produit qu'on veut ajouter au panier
    const saveProductForLater = (productId) => {
        localStorage.setItem('pendingCartProduct', productId);
    };

    // Fonction pour formater la description
    const formatDescription = (description) => {
        if (!description) return '<p class="text-gray-400">Aucune description disponible</p>';

        return description.split('\n')
            .filter(para => para.trim() !== '')
            .map(para => {
                if (para.startsWith('- ')) {
                    return `<li class="ml-4 list-disc">${para.substring(2)}</li>`;
                }
                return `<p class="mb-2">${para}</p>`;
            })
            .join('');
    };

    // Fonction pour charger les données du produit depuis l'API
    const loadProductData = async (productId) => {
        try {
            const response = await fetch(`/products/${productId}/quickview`);
            if (!response.ok) {
                throw new Error('Produit non trouvé');
            }
            return await response.json();
        } catch (error) {
            console.error('Erreur lors du chargement du produit:', error);
            return null;
        }
    };

    // Ouvrir le modal et charger les données depuis l'API
    quickViewBtns.forEach(btn => {
        btn.addEventListener('click', async function(e) {
            e.preventDefault();
            const productId = this.getAttribute('data-product-id');

            // Afficher un indicateur de chargement
            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
            document.getElementById('modalProductName').textContent = 'Chargement...';
            document.getElementById('modalProductDescription').innerHTML = '<p>Chargement des détails du produit...</p>';

            // Charger les données du produit
            const product = await loadProductData(productId);

            if (!product) {
                alert('Erreur lors du chargement du produit');
                modal.classList.add('hidden');
                document.body.style.overflow = 'auto';
                return;
            }

            // Stocker l'ID du produit dans le modal pour y accéder plus tard
            modal.dataset.productId = product.id;

            // Remplir les informations du produit
            document.getElementById('modalProductName').textContent = product.name;
            document.getElementById('modalProductPrice').textContent = `${product.price} DT`;
            document.getElementById('modalProductImage').src = product.image;
            document.getElementById('modalProductImage').alt = product.name;
            document.getElementById('modalProductDescription').innerHTML = formatDescription(product.description);

            // Gestion du stock
            const stockElement = document.getElementById('modalProductStock');
            if (product.stock > 0) {
                stockElement.textContent = `En stock (${product.stock})`;
                stockElement.className = 'text-sm font-medium text-green-600';
                addToCartBtn.disabled = false;
            } else {
                stockElement.textContent = 'Rupture de stock';
                stockElement.className = 'text-sm font-medium text-red-600';
                addToCartBtn.disabled = true;
            }

            // Masquer l'ancien prix car non inclus dans l'API
            document.getElementById('modalProductOldPrice').classList.add('hidden');

            // Masquer les options de taille et couleur par défaut
            sizeOptionsContainer.classList.add('hidden');
            colorOptionsContainer.classList.add('hidden');
        });
    });

    // Gestion du clic sur "Ajouter au panier"
    addToCartBtn.addEventListener('click', function() {
        const productId = modal.dataset.productId;

        if (!isUserLoggedIn()) {
            // Sauvegarder le produit pour après l'inscription
            saveProductForLater(productId);

            // Rediriger vers la page d'inscription avec un paramètre de retour
            const currentUrl = encodeURIComponent(window.location.href);
            window.location.href = `/register?redirect=${currentUrl}`;
            return;
        }

        // Si l'utilisateur est connecté, ajouter au panier normalement
        addToCart(productId);
    });

    // Fonction pour ajouter au panier (à implémenter selon votre backend)
    const addToCart = (productId) => {
        // Ici, vous devez implémenter l'appel API pour ajouter au panier
        fetch('/cart/add', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Authorization': `Bearer ${localStorage.getItem('authToken')}`
            },
            body: JSON.stringify({ product_id: productId, quantity: 1 })
        })
        .then(response => {
            if (response.ok) {
                // Rediriger vers la page de paiement
                window.location.href = '/checkout';
            } else {
                throw new Error('Erreur lors de l\'ajout au panier');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Une erreur est survenue lors de l\'ajout au panier');
        });
    };

    // Après retour de l'inscription, vérifier s'il y a un produit en attente
    const checkPendingProduct = () => {
        const pendingProductId = localStorage.getItem('pendingCartProduct');
        if (pendingProductId && isUserLoggedIn()) {
            // Ajouter le produit au panier
            addToCart(pendingProductId);
            // Nettoyer le stockage
            localStorage.removeItem('pendingCartProduct');
        }
    };

    // Vérifier au chargement de la page
    checkPendingProduct();

    // Fermer le modal
    closeModalBtn.addEventListener('click', function() {
        modal.classList.add('hidden');
        document.body.style.overflow = 'auto';
    });

    // Fermer quand on clique en dehors du modal
    modal.addEventListener('click', function(e) {
        if (e.target === modal) {
            modal.classList.add('hidden');
            document.body.style.overflow = 'auto';
        }
    });
});
</script>
    <!-- Footer Section -->
    @include('layouts.footer')

</body>
</html>


