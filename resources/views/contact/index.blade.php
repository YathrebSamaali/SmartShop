<!-- resources/views/contact.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - SmartShop</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Playfair+Display:wght@400;500;600&display=swap" rel="stylesheet">
    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Leaflet CSS for maps -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <style>
        body {
            padding-top: 80px;
            background-color: #f8fafc;
        }
    
        #map {
            height: 350px;
            width: 100%;
            border-radius: 0.75rem;
            z-index: 0;
            filter: grayscale(30%) sepia(10%) brightness(105%);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }
        #map:hover {
            filter: grayscale(0%) sepia(0%) brightness(100%);
        }
        .contact-info-card {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            border: 1px solid rgba(229, 231, 235, 0.8);
            height: 100%;
            background: linear-gradient(135deg, #ffffff 0%, #f9fafb 100%);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.02), 0 2px 4px -1px rgba(0, 0, 0, 0.02);
        }
        .contact-info-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.05), 0 10px 10px -5px rgba(0, 0, 0, 0.02);
            border-color: rgba(209, 213, 219, 0.5);
        }
        .icon-container {
            background: linear-gradient(135deg, #f3f4f6 0%, #e5e7eb 100%);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: inset 0 2px 4px 0 rgba(0, 0, 0, 0.02);
        }
        .contact-info-card:hover .icon-container {
            background: linear-gradient(135deg, #e5e7eb 0%, #d1d5db 100%);
        }
        .form-input:focus {
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
            border-color: rgba(59, 130, 246, 0.5);
        }
        .social-icon {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            background: linear-gradient(135deg, #ffffff 0%, #f9fafb 100%);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.02);
        }
        .social-icon:hover {
            transform: translateY(-3px) scale(1.05);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.03);
        }
        .contact-form-container {
            background: linear-gradient(135deg, #ffffff 0%, #f9fafb 100%);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.03), 0 4px 6px -2px rgba(0, 0, 0, 0.02);
        }
        .submit-btn {
            background: linear-gradient(135deg, #000000 0%, #333333 100%);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }
        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            background: linear-gradient(135deg, #333333 0%, #000000 100%);
        }
        .store-icon {
            filter: drop-shadow(0 2px 4px rgba(0,0,0,0.1));
        }
        .divider {
            height: 1px;
            background: linear-gradient(90deg, rgba(229,231,235,0) 0%, rgba(229,231,235,1) 50%, rgba(229,231,235,0) 100%);
        }
    </style>
</head>
<body>
    <!-- Inclusion du header -->
    @include('layouts.header')

    <!-- Contenu principal -->
    <main class="container mx-auto px-4 py-12">
        <!-- Page Header -->
        <div class="text-center mb-16">
            <span class="text-sm font-medium text-gray-500 uppercase tracking-wider mb-2 block">Contact Us</span>
            <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4 heading-font">Get In Touch</h1>
            <div class="divider w-24 h-px mx-auto my-6"></div>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">We're here to help and answer any questions you might have. Our team will get back to you within 24 hours.</p>
        </div>

        <!-- Formulaire en premier -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 mb-20">
            <!-- Contact Form -->
            <div class="order-1">
                <div class="contact-form-container p-8 rounded-xl border border-gray-100 mb-12 lg:mb-0">
                    <div class="flex items-center mb-6">
                        <div class="w-8 h-8 rounded-full bg-gray-100 flex items-center justify-center mr-4">
                            <i class="fas fa-envelope-open-text text-gray-600"></i>
                        </div>
                        <h2 class="text-2xl font-bold text-gray-800 heading-font">Send Us a Message</h2>
                    </div>
                    <form action="{{ route('contact.submit') }}" method="POST">
                        @csrf

                        <div class="mb-6">
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Full Name <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-user text-gray-400"></i>
                                </div>
                                <input type="text" id="name" name="name"
                                    class="pl-10 form-input w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-gray-300 focus:border-gray-300 transition duration-300"
                                    placeholder="Your name" required>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email <span class="text-red-500">*</span></label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-envelope text-gray-400"></i>
                                    </div>
                                    <input type="email" id="email" name="email"
                                        class="pl-10 form-input w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-gray-300 focus:border-gray-300 transition duration-300"
                                        placeholder="your.email@example.com" required>
                                </div>
                            </div>

                            <div>
                                <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Phone</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-phone text-gray-400"></i>
                                    </div>
                                    <input type="tel" id="phone" name="phone" pattern="\+?[0-9]{1,4}?[-.●]?[0-9]{1,3}[-.●]?[0-9]{3}[-.●]?[0-9]{4}"
                                        class="pl-10 form-input w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-gray-300 focus:border-gray-300 transition duration-300"
                                        placeholder="+1 (555) 123-4567">
                                </div>
                            </div>
                        </div>

                        <div class="mb-6">
                            <label for="subject" class="block text-sm font-medium text-gray-700 mb-2">Subject</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-tag text-gray-400"></i>
                                </div>
                                <select id="subject" name="subject"
                                        class="pl-10 form-input w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-gray-300 focus:border-gray-300 transition duration-300 appearance-none">
                                    <option value="">Select a subject</option>
                                    <option value="general">General Inquiry</option>
                                    <option value="order">Order Question</option>
                                    <option value="return">Return/Exchange</option>
                                    <option value="feedback">Feedback</option>
                                    <option value="wholesale">Wholesale Inquiry</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                    <i class="fas fa-chevron-down text-gray-400"></i>
                                </div>
                            </div>
                        </div>

                        <div class="mb-6">
                            <label for="message" class="block text-sm font-medium text-gray-700 mb-2">Your Message <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <div class="absolute top-3 left-3">
                                    <i class="fas fa-comment-dots text-gray-400"></i>
                                </div>
                                <textarea id="message" name="message" rows="5"
                                        class="pl-10 form-input w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-gray-300 focus:border-gray-300 transition duration-300"
                                        placeholder="How can we help you?" required></textarea>
                            </div>
                        </div>

                        <div class="pt-2">
                            <button type="submit"
                                    class="w-full submit-btn text-white px-6 py-4 rounded-lg font-medium">
                                <i class="fas fa-paper-plane mr-2"></i> Send Message
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Map Section -->
            <div class="order-2">
                <div class="bg-white p-8 rounded-xl shadow-sm border border-gray-100">
                    <div class="flex items-center mb-6">
                        <div class="w-8 h-8 rounded-full bg-gray-100 flex items-center justify-center mr-4">
                            <i class="fas fa-store text-gray-600"></i>
                        </div>
                        <h2 class="text-2xl font-bold text-gray-800 heading-font">Our Store Location</h2>
                    </div>
                    <div id="map"></div>
                    <div class="mt-6 space-y-3">
                        <div class="flex items-start">
                            <div class="flex-shrink-0 mt-1">
                                <i class="fas fa-clock text-gray-400 mr-3"></i>
                            </div>
                            <div>
                                <h4 class="text-sm font-medium text-gray-700">Opening Hours</h4>
                                <p class="text-sm text-gray-600">Monday to Friday: 9:00 AM - 6:00 PM</p>
                                <p class="text-sm text-gray-600">Saturday: 10:00 AM - 4:00 PM</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <div class="flex-shrink-0 mt-1">
                                <i class="fas fa-car text-gray-400 mr-3"></i>
                            </div>
                            <div>
                                <h4 class="text-sm font-medium text-gray-700">Parking Information</h4>
                                <p class="text-sm text-gray-600">Free parking available in front of the store</p>
                                <p class="text-sm text-gray-600">Underground parking with 2 hours free</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contact Cards - Après le formulaire -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-20">
            <!-- Address Card -->
            <div class="contact-info-card bg-white p-8 rounded-xl flex flex-col">
                <div class="flex items-center mb-5">
                    <div class="icon-container p-4 rounded-xl mr-5">
                        <i class="fas fa-map-marker-alt text-gray-700 text-xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800">Our Location</h3>
                </div>
                <div class="flex-grow">
                    <p class="text-gray-600 mb-1">123 Shop Street</p>
                    <p class="text-gray-600">Commerce City, CA 90210</p>
                    <a href="#" class="inline-block mt-4 text-sm font-medium text-gray-700 hover:text-black transition duration-300">
                        <i class="fas fa-directions mr-2"></i> Get Directions
                    </a>
                </div>
            </div>

            <!-- Phone Card -->
            <div class="contact-info-card bg-white p-8 rounded-xl flex flex-col">
                <div class="flex items-center mb-5">
                    <div class="icon-container p-4 rounded-xl mr-5">
                        <i class="fas fa-phone-alt text-gray-700 text-xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800">Phone Number</h3>
                </div>
                <div class="flex-grow">
                    <p class="text-gray-600">+1 (555) 123-4567</p>
                    <p class="text-gray-600 mt-2">Mon-Fri: 9am-6pm PST</p>
                    <a href="tel:+15551234567" class="inline-block mt-4 text-sm font-medium text-gray-700 hover:text-black transition duration-300">
                        <i class="fas fa-phone-volume mr-2"></i> Call Now
                    </a>
                </div>
            </div>

            <!-- Email Card -->
            <div class="contact-info-card bg-white p-8 rounded-xl flex flex-col">
                <div class="flex items-center mb-5">
                    <div class="icon-container p-4 rounded-xl mr-5">
                        <i class="fas fa-envelope text-gray-700 text-xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800">Email Address</h3>
                </div>
                <div class="flex-grow">
                    <p class="text-gray-600">contact@smartshop.com</p>
                    <p class="text-gray-600 mt-2">support@smartshop.com</p>
                    <a href="mailto:contact@smartshop.com" class="inline-block mt-4 text-sm font-medium text-gray-700 hover:text-black transition duration-300">
                        <i class="fas fa-paper-plane mr-2"></i> Email Us
                    </a>
                </div>
            </div>
        </div>

        <!-- Social Media Section -->
        <div class="text-center">
            <span class="text-sm font-medium text-gray-500 uppercase tracking-wider mb-2 block">Connect With Us</span>
            <h2 class="text-3xl font-bold text-gray-800 mb-4 heading-font">Follow SmartShop</h2>
            <div class="divider w-16 h-px mx-auto my-6"></div>
            <p class="text-gray-600 max-w-2xl mx-auto mb-10">Stay connected with us on social media for the latest updates, promotions and exclusive offers.</p>

            <div class="flex justify-center space-x-6">
                <a href="#" class="social-icon w-12 h-12 flex items-center justify-center rounded-xl text-gray-700 hover:text-blue-600">
                    <i class="fab fa-facebook-f text-xl"></i>
                </a>
                <a href="#" class="social-icon w-12 h-12 flex items-center justify-center rounded-xl text-gray-700 hover:text-pink-600">
                    <i class="fab fa-instagram text-xl"></i>
                </a>
                <a href="#" class="social-icon w-12 h-12 flex items-center justify-center rounded-xl text-gray-700 hover:text-blue-400">
                    <i class="fab fa-twitter text-xl"></i>
                </a>
                <a href="#" class="social-icon w-12 h-12 flex items-center justify-center rounded-xl text-gray-700 hover:text-red-600">
                    <i class="fab fa-youtube text-xl"></i>
                </a>
                <a href="#" class="social-icon w-12 h-12 flex items-center justify-center rounded-xl text-gray-700 hover:text-red-500">
                    <i class="fab fa-pinterest-p text-xl"></i>
                </a>
            </div>
        </div>
    </main>

    <!-- Inclusion du footer -->
    @include('layouts.footer')

    <!-- Leaflet JS for maps -->
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script>
        // Initialize the map
        document.addEventListener('DOMContentLoaded', function() {
            const map = L.map('map').setView([34.0522, -118.2437], 16);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            // Custom icon with better styling
            const storeIcon = L.divIcon({
                className: 'store-icon',
                html: '<div class="relative"><div class="absolute -inset-1 bg-black rounded-full opacity-20 blur"></div><div class="relative bg-white p-3 rounded-full shadow-lg"><i class="fas fa-store text-2xl text-gray-800"></i></div></div>',
                iconSize: [0, 0],
                iconAnchor: [20, 40],
                popupAnchor: [0, -40]
            });

            // Add a marker with custom icon
            const marker = L.marker([34.0522, -118.2437], {icon: storeIcon}).addTo(map)
                .bindPopup(`
                    <div class="font-semibold text-gray-800 text-lg">SmartShop Headquarters</div>
                    <div class="text-gray-600">123 Shop Street, Commerce City</div>
                    <div class="mt-2 flex space-x-2">
                        <a href="#" class="text-blue-500 hover:text-blue-700 text-sm"><i class="fas fa-directions mr-1"></i> Directions</a>
                        <a href="#" class="text-blue-500 hover:text-blue-700 text-sm"><i class="fas fa-info-circle mr-1"></i> Details</a>
                    </div>
                `);

            // Open popup by default
            marker.openPopup();

            // Add a subtle circle around the marker
            L.circle([34.0522, -118.2437], {
                color: 'rgba(0,0,0,0.1)',
                fillColor: 'rgba(0,0,0,0.05)',
                fillOpacity: 0.3,
                radius: 100
            }).addTo(map);

            // Mobile menu toggle
            document.getElementById('mobile-menu-button').addEventListener('click', function() {
                const menu = document.getElementById('mobile-menu');
                menu.classList.toggle('hidden');
            });
        });
    </script>
</body>
</html>