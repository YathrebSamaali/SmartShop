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
                     class="w-full h-full object-cover transition-transform duration-500 hover:scale-105"
                     loading="lazy">
                    <span class="absolute top-4 left-4 bg-gray-900 text-white text-sm font-semibold px-3 py-1 rounded-full">
                        {{ number_format($product->price, 2) }} DT
                    </span>
                    <a href="{{ route('products.show', $product->id) }}" class="absolute inset-0 bg-black bg-opacity-30 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <span class="bg-white text-[#543929] font-semibold py-2 px-4 rounded-lg shadow-md hover:bg-[#543929] hover:text-black transition">
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
                        <img src="{{ asset('images/urban-collection.jpg') }}" alt="Urban Streetwear"
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
                        <img src="{{ asset('images/eco-collection.jpg') }}" alt="Sustainable Fashion"
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
                        <img src="{{ asset('images/luxury-collection.jpg') }}" alt="Luxury Essentials"
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
                        <img src="{{ asset('images/active-collection.jpg') }}" alt="Active Wear"
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
    <!-- Footer Section -->
    @include('layouts.footer')

</body>
</html>
