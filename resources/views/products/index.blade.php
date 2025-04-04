<!-- resources/views/products/index.blade.php -->
@extends('layouts.app')

@section('content')
        @include('layouts.header')

<!-- Products Section -->
<section id="products" class="py-12 bg-gray-100">
    <!-- Category Filters - Aligné à droite -->
    <div class="container mx-auto px-4 mb-8">
    <div class="flex justify-end mr-32">  <!-- Ajout de mr-8 pour un décalage partiel -->
        <div class="relative w-64">
            <select id="category-filter" class="block appearance-none w-full bg-white border border-gray-300 text-gray-700 py-3 px-4 pr-8 rounded-lg leading-tight focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-transparent">
                <option value="all">All Products</option>
                <option value="men">Men</option>
                <option value="women">Women</option>
                <option value="shoes">Shoes</option>
                <!-- Ajoutez d'autres options selon vos besoins -->
            </select>
            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
                </svg>
            </div>
        </div>
    </div>
</div>

    <!-- Products Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 px-36" id="product-grid">
        @foreach ($products as $product)
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden transform transition duration-300 hover:scale-105 hover:shadow-2xl product-item" data-category="{{ strtolower($product->category) }}">
                <div class="relative group">
                    <img src="{{ $product->image ? asset('storage/'.$product->image) : asset('images/placeholder-product.jpg') }}"
                         alt="{{ $product->name }}"
                         class="w-full h-96 object-cover transition-transform duration-300 group-hover:scale-110" loading="lazy">
                    <span class="absolute top-4 left-4 bg-gray-900 text-white text-sm font-semibold px-3 py-1 rounded-full">
                        {{ number_format($product->price, 2) }} DT
                    </span>
                    <a href="#" class="quick-view-btn absolute inset-0 bg-black bg-opacity-30 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300"
                       data-product-id="{{ $product->id }}">
                        <span class="bg-white text-[#543929] font-semibold py-2 px-4 rounded-lg shadow-md transition">
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

    <!-- JavaScript for Category Filter -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const categoryFilter = document.getElementById('category-filter');
            const productItems = document.querySelectorAll('.product-item');

            function filterProducts(category) {
                productItems.forEach(item => {
                    const itemCategory = item.getAttribute('data-category');

                    if (category === 'all' || itemCategory === category.toLowerCase()) {
                        item.style.display = 'block';
                        item.style.animation = 'fadeIn 0.5s ease-in-out';
                    } else {
                        item.style.display = 'none';
                    }
                });
            }

            // Écouteur pour le changement de sélection
            categoryFilter.addEventListener('change', function() {
                filterProducts(this.value);
            });

            // Appliquer le filtre si paramètre dans l'URL
            const urlParams = new URLSearchParams(window.location.search);
            const categoryParam = urlParams.get('category');
            if (categoryParam) {
                categoryFilter.value = categoryParam;
                filterProducts(categoryParam);
            }
        });
    </script>

    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        /* Style supplémentaire pour le select */
        #category-filter {
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }
        #category-filter:hover {
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
    </style>
</section>
<!-- Quick View Modal -->
<!-- Quick View Modal -->
<div id="quickViewModal" class="fixed inset-0 z-50 hidden overflow-y-auto" data-redirect-url="{{ route('cart') }}">
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
    // Éléments DOM
    const elements = {
        modal: document.getElementById('quickViewModal'),
        closeModalBtn: document.getElementById('closeModal'),
        quickViewBtns: document.querySelectorAll('.quick-view-btn'),
        addToCartBtn: document.getElementById('addToCartBtn'),
        modalProductName: document.getElementById('modalProductName'),
        modalProductPrice: document.getElementById('modalProductPrice'),
        modalProductImage: document.getElementById('modalProductImage'),
        modalProductDescription: document.getElementById('modalProductDescription'),
        modalProductStock: document.getElementById('modalProductStock'),
        cartCount: document.getElementById('cart-count')
    };

    // Constantes
    const API_ENDPOINTS = {
        productDetails: '/products/{id}/quickview',
        addToCart: '/cart/add'
    };

    // Configuration
    const config = {
        toastDuration: 3000,
        redirectDelay: 1500,
        animationDuration: 1000
    };

    // ==============================================
    // FONCTIONS UTILITAIRES
    // ==============================================

    /**
     * Formate la description du produit pour l'affichage HTML
     */
    const formatDescription = (description) => {
        if (!description) {
            return '<p class="text-gray-400">Aucune description disponible</p>';
        }

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

    /**
     * Affiche une notification toast
     */
        const showToast = (message, type = 'success') => {
        const toast = document.createElement('div');
        toast.className = `fixed top-4 left-1/2 transform -translate-x-1/2 px-6 py-3 rounded-md text-white ${
            type === 'error' ? 'bg-red-500' :
            type === 'warning' ? 'bg-yellow-500' : 'bg-green-500'
        } z-50 shadow-lg flex items-center`;

        // Ajout d'une icône de validation
        toast.innerHTML = `
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
            </svg>
            ${message}
        `;

        document.body.appendChild(toast);

        // Animation d'entrée
        setTimeout(() => {
            toast.classList.add('opacity-100', 'translate-y-0');
        }, 10);

        // Disparition après délai
        setTimeout(() => {
            toast.classList.remove('opacity-100', 'translate-y-0');
            toast.classList.add('opacity-0', '-translate-y-2');
            setTimeout(() => toast.remove(), 300);
        }, config.toastDuration);
    };


    /**
     * Met à jour le compteur du panier avec animation
     */
    const updateCartCounter = (count) => {
        if (elements.cartCount) {
            elements.cartCount.textContent = count;

            // Animation
            elements.cartCount.classList.add('animate-ping');
            setTimeout(() => {
                elements.cartCount.classList.remove('animate-ping');
            }, config.animationDuration / 2);
        }
    };

    // ==============================================
    // GESTION DU MODAL
    // ==============================================

    /**
     * Charge les données du produit depuis l'API
     */
    const loadProductData = async (productId) => {
        try {
            const response = await fetch(
                API_ENDPOINTS.productDetails.replace('{id}', productId),
                {
                    headers: {
                        'Accept': 'application/json'
                    }
                }
            );

            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }

            return await response.json();
        } catch (error) {
            console.error('Erreur lors du chargement du produit:', error);
            showToast('Erreur lors du chargement du produit', 'error');
            return null;
        }
    };

    /**
     * Ouvre le modal et charge les données du produit
     */
    const openProductModal = async (productId) => {
        // Afficher le modal avec état de chargement
        elements.modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
        elements.modalProductName.textContent = 'Chargement...';
        elements.modalProductDescription.innerHTML = '<p>Chargement des détails du produit...</p>';

        // Charger les données
        const product = await loadProductData(productId);
        if (!product) {
            closeModal();
            return;
        }

        // Remplir les données du produit
        elements.modal.dataset.productId = product.id;
        elements.modalProductName.textContent = product.name;
        elements.modalProductPrice.textContent = `${product.price} DT`;
        elements.modalProductImage.src = product.image;
        elements.modalProductImage.alt = product.name;
        elements.modalProductDescription.innerHTML = formatDescription(product.description);

        // Gérer l'état du stock
        if (product.stock > 0) {
            elements.modalProductStock.textContent = `En stock (${product.stock})`;
            elements.modalProductStock.className = 'text-sm font-medium text-green-600';
            elements.addToCartBtn.disabled = false;
        } else {
            elements.modalProductStock.textContent = 'Rupture de stock';
            elements.modalProductStock.className = 'text-sm font-medium text-red-600';
            elements.addToCartBtn.disabled = true;
        }
    };

    /**
     * Ferme le modal
     */
    const closeModal = () => {
        elements.modal.classList.add('hidden');
        document.body.style.overflow = 'auto';
    };

    // ==============================================
    // GESTION DU PANIER
    // ==============================================

    /**
     * Ajoute un produit au panier
     */
    const addToCart = async (productId) => {
        try {
            const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

            const response = await fetch(API_ENDPOINTS.addToCart, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    product_id: productId,
                    quantity: 1
                })
            });

            const data = await response.json();

            if (!response.ok) {
                throw new Error(data.message || 'Erreur lors de l\'ajout au panier');
            }

            if (data.success) {
                updateCartCounter(data.cart_count);
                showToast('Produit ajouté au panier!');
                closeModal();

                // Émettre un événement personnalisé
                document.dispatchEvent(new CustomEvent('cartUpdated', {
                    detail: { count: data.cart_count }
                }));
            } else {
                showToast(data.message || 'Erreur', 'error');
            }
        } catch (error) {
            console.error('Error:', error);

            if (error.message.includes('Unauthenticated')) {
                handleUnauthenticatedUser(productId);
            } else {
                showToast(error.message || 'Une erreur est survenue', 'error');
            }
        }
    };

    /**
     * Gère les utilisateurs non authentifiés
     */
    const handleUnauthenticatedUser = (productId) => {
        // Sauvegarder le produit pour après connexion
        localStorage.setItem('pendingCartProduct', productId);

        showToast('Veuillez vous connecter pour ajouter au panier', 'warning');

        // Rediriger vers la page de connexion
        setTimeout(() => {
            const currentPath = encodeURIComponent(window.location.pathname);
            window.location.href = `/login?redirect=${currentPath}`;
        }, config.redirectDelay);
    };

    /**
     * Vérifie s'il y a un produit en attente après connexion
     */
    const checkPendingCartItem = () => {
        const pendingProductId = localStorage.getItem('pendingCartProduct');
        if (pendingProductId) {
            addToCart(pendingProductId);
            localStorage.removeItem('pendingCartProduct');
        }
    };

    // ==============================================
    // ÉCOUTEURS D'ÉVÉNEMENTS
    // ==============================================

    // Ouvrir le modal au clic sur "Quick View"
    elements.quickViewBtns.forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.preventDefault();
            openProductModal(btn.dataset.productId);
        });
    });

    // Ajouter au panier
    elements.addToCartBtn.addEventListener('click', () => {
        const productId = elements.modal.dataset.productId;
        if (productId) {
            addToCart(productId);
        }
    });

    // Fermer le modal
    elements.closeModalBtn.addEventListener('click', closeModal);
    elements.modal.addEventListener('click', (e) => {
        if (e.target === elements.modal) {
            closeModal();
        }
    });

    // Gestion des touches clavier
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && !elements.modal.classList.contains('hidden')) {
            closeModal();
        }
    });

    // ==============================================
    // INITIALISATION
    // ==============================================

    // Vérifier les produits en attente au chargement
    checkPendingCartItem();

    // Écouter les mises à jour du panier depuis d'autres composants
    document.addEventListener('cartUpdated', (e) => {
        updateCartCounter(e.detail.count);
    });
});
</script>




@endsection
