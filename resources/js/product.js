// resources/js/product.js

document.addEventListener("DOMContentLoaded", () => {
    // Filtrage par catégorie
    const categoryFilter = document.getElementById('categoryFilter');
    categoryFilter.addEventListener('change', () => {
        filterProducts();
    });

    // Filtrage par prix
    const priceFilter = document.getElementById('priceFilter');
    priceFilter.addEventListener('change', () => {
        filterProducts();
    });

    // Fonction de filtrage des produits
    function filterProducts() {
        const categoryValue = categoryFilter.value;
        const priceValue = priceFilter.value;
        const products = document.querySelectorAll('.product-item');

        products.forEach(product => {
            const productCategory = product.dataset.category;
            const productPrice = parseFloat(product.dataset.price);

            let isCategoryMatch = categoryValue ? productCategory === categoryValue : true;
            let isPriceMatch = true;

            if (priceValue === 'asc') {
                isPriceMatch = productPrice <= parseFloat(productPrice);
            } else if (priceValue === 'desc') {
                isPriceMatch = productPrice >= parseFloat(productPrice);
            }

            if (isCategoryMatch && isPriceMatch) {
                product.style.display = 'block';
            } else {
                product.style.display = 'none';
            }
        });
    }

    // Ajouter au panier
    const addToCartButtons = document.querySelectorAll('.add-to-cart');
    addToCartButtons.forEach(button => {
        button.addEventListener('click', (e) => {
            const productId = e.target.getAttribute('data-product-id');
            addToCart(productId);
        });
    });

    // Fonction d'ajout au panier
    function addToCart(productId) {
        // Vous pouvez ici envoyer une requête AJAX pour ajouter au panier dans la session ou la base de données
        console.log(`Produit avec l'ID ${productId} ajouté au panier.`);
    }
});
