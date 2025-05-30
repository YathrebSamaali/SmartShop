-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 30 mai 2025 à 19:45
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `smart_shop_db`
--

-- --------------------------------------------------------

--
-- Structure de la table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `admins`
--

INSERT INTO `admins` (`id`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'admin@smart.com', '$2y$12$KC7v0D2K3EUBnEiVROe0JuGC5seMXW1ZxrMnYhl2nQPRFNGpqwH9G', '2025-03-29 23:50:30', '2025-03-30 00:08:17');

-- --------------------------------------------------------

--
-- Structure de la table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `subject` varchar(150) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

CREATE TABLE `messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `messages`
--

INSERT INTO `messages` (`id`, `name`, `email`, `phone`, `subject`, `message`, `created_at`, `updated_at`) VALUES
(1, 'Yathreb', 'yathreb@example.com', '+21612345678', 'Infos sur le projet', 'Je voudrais en savoir plus.', '2025-04-16 22:19:01', '2025-04-16 22:19:01'),
(2, 'yathreb samaali', 'admin@example.com', '99157801', 'general', ',jj', '2025-04-16 21:23:28', '2025-04-16 21:23:28'),
(3, 'test', 'test@example.com', '99157801', 'order', 'jszl', '2025-04-16 22:24:34', '2025-04-16 22:24:34'),
(4, 'chaima abidi', 'admin@example.com', '99157801', 'feedback', ',jbjjbjbzdjjl', '2025-04-17 12:40:30', '2025-04-17 12:40:30');

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_03_08_161103_create_products_table', 1),
(5, '2025_03_08_161113_create_customers_table', 1),
(6, '2025_03_08_161123_create_orders_table', 1),
(7, '2025_03_08_161129_create_order_items_table', 1),
(8, '2025_03_08_212506_add_role_to_users_table', 1),
(9, '2025_03_09_141253_add_image_to_products_table', 1),
(10, '2025_03_09_190204_add_category_to_products_table', 1);

-- --------------------------------------------------------

--
-- Structure de la table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `order_number` varchar(20) NOT NULL,
  `customer_first_name` varchar(50) NOT NULL,
  `customer_last_name` varchar(50) NOT NULL,
  `customer_email` varchar(100) NOT NULL,
  `customer_phone` varchar(20) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` enum('pending','processing','shipped','delivered','cancelled') NOT NULL DEFAULT 'pending',
  `subtotal` decimal(10,2) NOT NULL,
  `delivery_cost` decimal(10,2) NOT NULL,
  `tax_amount` decimal(10,2) DEFAULT 0.00,
  `payment_method` enum('cash','credit_card','bank_transfer') NOT NULL,
  `delivery_method` varchar(50) DEFAULT NULL,
  `delivery_street` text NOT NULL,
  `delivery_city` varchar(50) NOT NULL,
  `delivery_zip_code` varchar(20) NOT NULL,
  `delivery_country` varchar(50) NOT NULL,
  `notes` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `orders`
--

INSERT INTO `orders` (`id`, `order_number`, `customer_first_name`, `customer_last_name`, `customer_email`, `customer_phone`, `total`, `created_at`, `updated_at`, `status`, `subtotal`, `delivery_cost`, `tax_amount`, `payment_method`, `delivery_method`, `delivery_street`, `delivery_city`, `delivery_zip_code`, `delivery_country`, `notes`) VALUES
(25, 'ORD-BOAIPW', 'yathreb', 'samaali', 'yathreb22@gamil.com', '99157801', 406.00, '2025-04-04 20:08:18', '2025-04-04 21:09:16', 'pending', 399.00, 7.00, 0.00, 'cash', 'standard', 'kef', 'Le Kef', '7100', 'Tunisie', NULL),
(26, 'ORD-YRR0LI', 'aya', 'jbali', 'aya2002@gamil.com', '50250654', 406.00, '2025-04-04 20:11:17', '2025-04-04 20:11:17', 'pending', 399.00, 7.00, 0.00, 'cash', 'standard', 'ben arous', 'tunis', '7000', 'Tunisie', NULL),
(27, 'ORD-K8KNAO', 'yassine', 'abidi', 'yassineabidi@gmail.com', '99157801', 2037.00, '2025-04-04 20:38:21', '2025-04-04 20:38:21', 'pending', 2022.00, 15.00, 0.00, 'credit_card', 'express', 'souuse', 'sousse', '7410', 'Tunisie', NULL),
(28, 'ORD-TRHCSR', 'nour', 'klai', 'nourklai@gmail.com', '99632589', 337.00, '2025-04-04 20:40:05', '2025-04-04 20:40:05', 'pending', 330.00, 7.00, 0.00, 'bank_transfer', 'standard', 'kef', 'kef', '7100', 'Tunisie', NULL),
(29, 'ORD-H51IBK', 'youssef', 'khammessi', 'youssef@gmail.com', '25007415', 95.00, '2025-04-04 20:41:33', '2025-04-04 20:41:33', 'pending', 80.00, 15.00, 0.00, 'cash', 'express', 'tunis', 'tunis', '745', 'Tunisie', NULL),
(30, 'ORD-NJWNRH', 'nadhir', 'samaali', 'nadhir@gmail.com', '95203258', 1387.00, '2025-04-04 20:44:17', '2025-04-04 20:44:17', 'pending', 1380.00, 7.00, 0.00, 'cash', 'standard', 'kef', 'kef', '7100', 'Tunisie', NULL),
(31, 'ORD-YYTTIW', 'aziz', 'ben ali', 'azizaa@gamil.com', '90225844', 896.00, '2025-04-04 21:26:41', '2025-04-04 21:26:41', 'pending', 889.00, 7.00, 0.00, 'cash', 'standard', 'tunis', 'tunis', '7502', 'Tunisia', NULL),
(32, 'ORD-COXNKQ', 'ahmed', 'mohamed', 'ahmeeeed@gamil.com', '90225844', 7.00, '2025-04-04 21:27:31', '2025-04-04 22:29:38', 'pending', 0.00, 7.00, 0.00, 'cash', 'standard', 'tunis', 'tunis', '7502', 'Tunisia', NULL),
(33, 'ORD-MNN94R', 'chaima', 'abidi', 'chaimaa@gmail.com', '99157801', 32.00, '2025-04-04 21:35:50', '2025-04-04 21:35:50', 'pending', 25.00, 7.00, 0.00, 'cash', 'standard', 'kef', 'Le Kef', '7116', 'Tunisia', NULL),
(34, 'ORD-4I9DRL', 'sirine', 'matheli', 'siriine@gamil.com', '99157801', 885.00, '2025-04-04 21:38:50', '2025-04-04 21:38:50', 'pending', 878.00, 7.00, 0.00, 'cash', 'standard', 'tunis', 'Le Kef', '7116', 'Tunisia', NULL),
(35, 'ORD-QUGI9I', 'ghofran', 'samaali', 'ghoff@gamil.com', '99157801', 847.00, '2025-04-04 21:42:11', '2025-04-04 23:17:46', 'processing', 840.00, 7.00, 0.00, 'cash', 'standard', 'kef', 'Le Kef', '7116', 'Tunisia', NULL),
(36, 'ORD-TODIEA', 'asma', 'asma', 'sqqs@gamil.com', '99157801', 387.00, '2025-04-10 17:17:13', '2025-04-10 17:22:41', 'processing', 380.00, 7.00, 0.00, 'cash', 'standard', 'Bahra Kef Est', 'Le Kef', '7116', 'Tunisia', NULL),
(37, 'ORD-KHTENI', 'sssssssss', 'samaali', 'swws@gamil.com', '99157801', 32.00, '2025-04-10 17:19:09', '2025-04-10 17:19:09', 'pending', 25.00, 7.00, 0.00, 'cash', 'standard', 'Bahra Kef Est', 'Le Kef', '7116', 'Tunisia', NULL),
(38, 'ORD-WFGC5Z', 'sirine', 'mayassa', 'sqqs@gamil.com', '99157801', 127.00, '2025-04-10 21:23:03', '2025-04-13 13:42:51', 'cancelled', 120.00, 7.00, 0.00, 'cash', 'standard', 'Bahra Kef Est', 'Le Kef', '7116', 'Tunisia', NULL),
(39, 'ORD-YPX1SS', 'yathreb', 'samaali', 'swws@gamil.com', '99157801', 917.00, '2025-04-16 19:49:55', '2025-04-16 19:49:55', 'pending', 910.00, 7.00, 0.00, 'cash', 'standard', 'Bahra Kef Est', 'Le Kef', '7116', 'Tunisia', 'hbzil'),
(40, 'ORD-ARSBAR', 'chaimaabidi', 'samaali', 'swws@gamil.com', '99157801', 32.00, '2025-04-17 12:35:53', '2025-04-17 12:35:53', 'pending', 25.00, 7.00, 0.00, 'cash', 'standard', 'Bahra Kef Est', 'Le Kef', '7116', 'Tunisia', 'fibjle;, dq'),
(41, 'ORD-MQVDT6', 'marweeen', 'ss', 'swws@gamil.com', '99157801', 227.00, '2025-04-17 12:52:08', '2025-04-17 12:52:08', 'pending', 220.00, 7.00, 0.00, 'credit_card', 'standard', 'Bahra Kef Est', 'Le Kef', '7116', 'Tunisia', NULL),
(42, 'ORD-UUDOEG', 'sssssssszzzzzzzzz', 'sszxx', 'swws@gamil.com', '99157801', 805.00, '2025-05-30 15:54:43', '2025-05-30 15:54:43', 'pending', 798.00, 7.00, 0.00, 'cash', 'standard', 'Bahra Kef Est', 'Le Kef', '7116', 'Tunisia', NULL),
(43, 'ORD-W8I89D', 'sssssssszzzzzzzzz', 'sszxx', 'swws@gamil.com', '9915085', 7.00, '2025-05-30 15:55:10', '2025-05-30 15:55:10', 'pending', 0.00, 7.00, 0.00, 'cash', 'standard', 'kef', 'Le Kef', '7116', 'Tunisia', NULL),
(44, 'ORD-B3ZSVG', 'sssssssszzzzzzzzz', 'sszxx', 'swws@gamil.com', '99150857', 7.00, '2025-05-30 15:55:26', '2025-05-30 15:55:26', 'pending', 0.00, 7.00, 0.00, 'cash', 'standard', 'kef', 'Le Kef', '7100', 'Tunisia', NULL),
(45, 'ORD-QZX366', 'yathreeb', 'samaali', 'swws@gamil.com', '99150857', 7.00, '2025-05-30 15:55:37', '2025-05-30 15:55:37', 'pending', 0.00, 7.00, 0.00, 'cash', 'standard', 'kef', 'Le Kef', '7100', 'Tunisia', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `price`, `created_at`, `updated_at`) VALUES
(16, 25, 20, 1, 399.00, '2025-04-04 20:08:18', '2025-04-04 20:08:18'),
(17, 26, 20, 1, 399.00, '2025-04-04 20:11:17', '2025-04-04 20:11:17'),
(18, 27, 16, 3, 25.00, '2025-04-04 20:38:21', '2025-04-04 20:38:21'),
(19, 27, 21, 1, 350.00, '2025-04-04 20:38:21', '2025-04-04 20:38:21'),
(20, 27, 20, 2, 399.00, '2025-04-04 20:38:21', '2025-04-04 20:38:21'),
(21, 27, 24, 4, 120.00, '2025-04-04 20:38:21', '2025-04-04 20:38:21'),
(22, 27, 23, 1, 239.00, '2025-04-04 20:38:21', '2025-04-04 20:38:21'),
(23, 27, 22, 1, 80.00, '2025-04-04 20:38:21', '2025-04-04 20:38:21'),
(24, 28, 29, 1, 150.00, '2025-04-04 20:40:05', '2025-04-04 20:40:05'),
(25, 28, 31, 1, 180.00, '2025-04-04 20:40:05', '2025-04-04 20:40:05'),
(26, 29, 22, 1, 80.00, '2025-04-04 20:41:33', '2025-04-04 20:41:33'),
(27, 30, 26, 1, 380.00, '2025-04-04 20:44:17', '2025-04-04 20:44:17'),
(28, 30, 32, 1, 290.00, '2025-04-04 20:44:17', '2025-04-04 20:44:17'),
(29, 30, 35, 1, 350.00, '2025-04-04 20:44:17', '2025-04-04 20:44:17'),
(30, 30, 38, 1, 360.00, '2025-04-04 20:44:17', '2025-04-04 20:44:17'),
(31, 31, 32, 1, 290.00, '2025-04-04 21:26:42', '2025-04-04 21:26:42'),
(32, 31, 16, 2, 25.00, '2025-04-04 21:26:42', '2025-04-04 21:26:42'),
(33, 31, 29, 1, 150.00, '2025-04-04 21:26:42', '2025-04-04 21:26:42'),
(34, 31, 20, 1, 399.00, '2025-04-04 21:26:42', '2025-04-04 21:26:42'),
(35, 33, 16, 1, 25.00, '2025-04-04 21:35:50', '2025-04-04 21:35:50'),
(36, 34, 20, 2, 399.00, '2025-04-04 21:38:50', '2025-04-04 21:38:50'),
(37, 34, 22, 1, 80.00, '2025-04-04 21:38:50', '2025-04-04 21:38:50'),
(38, 35, 37, 1, 210.00, '2025-04-04 21:42:11', '2025-04-04 21:42:11'),
(39, 35, 26, 1, 380.00, '2025-04-04 21:42:11', '2025-04-04 21:42:11'),
(40, 35, 34, 1, 250.00, '2025-04-04 21:42:11', '2025-04-04 21:42:11'),
(41, 36, 26, 1, 380.00, '2025-04-10 17:17:13', '2025-04-10 17:17:13'),
(42, 37, 16, 1, 25.00, '2025-04-10 17:19:09', '2025-04-10 17:19:09'),
(43, 38, 24, 1, 120.00, '2025-04-10 21:23:03', '2025-04-10 21:23:03'),
(44, 39, 21, 1, 350.00, '2025-04-16 19:49:55', '2025-04-16 19:49:55'),
(45, 39, 26, 1, 380.00, '2025-04-16 19:49:55', '2025-04-16 19:49:55'),
(46, 39, 31, 1, 180.00, '2025-04-16 19:49:55', '2025-04-16 19:49:55'),
(47, 40, 16, 1, 25.00, '2025-04-17 12:35:53', '2025-04-17 12:35:53'),
(48, 41, 6, 1, 220.00, '2025-04-17 12:52:08', '2025-04-17 12:52:08'),
(49, 42, 20, 2, 399.00, '2025-05-30 15:54:43', '2025-05-30 15:54:43');

-- --------------------------------------------------------

--
-- Structure de la table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `stock` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `category` enum('Men','Women','Shoes') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `stock`, `created_at`, `updated_at`, `image`, `category`) VALUES
(6, 'Classic Trench Coat', 'A timeless knee-length coat crafted from water-resistant cotton-twill, featuring a double-breasted front, notched lapels, and a belted waist for a tailored silhouette', 220.00, 40, '2025-04-04 16:02:36', '2025-04-04 16:02:36', 'products/1743786156_4dbb9b60dcda3fad3c0a1202d42456a6.jpg', 'Women'),
(16, 'Leather Moto Jacket', 'A slim-fit biker jacket made from genuine or vegan leather, with an asymmetrical zipper, quilted shoulders, and zipped pockets for an edgy look.', 25.00, 150, '2025-04-04 16:05:22', '2025-04-04 16:57:23', 'products/1743788106_1cfef5ad7b246329e4d60aa76abf0f82.jpg', 'Men'),
(20, 'Puffer Jacket', 'A lightweight yet insulated jacket filled with down or synthetic feathers, featuring a quilted pattern and a high collar for warmth.', 399.00, 24, '2025-04-04 16:08:33', '2025-04-04 16:08:33', 'products/1743786513_f1e222cc1c053875cf548cb8fb1086af.jpg', 'Men'),
(21, 'Women’s Coats', 'Coats are outerwear staples designed for warmth and style, typically falling below the hips. They come in various weights.', 350.00, 53, '2025-04-04 16:13:16', '2025-04-04 16:39:26', 'products/1743788333_6dd25a0a603c90eed5aba2843673858f.jpg', 'Women'),
(22, 'T-Shirt', 'A distressed cotton T-shirt featuring strategic rips and frayed edges for an edgy, lived-in look. The short sleeves and relaxed fit make it a versatile piece.', 80.00, 50, '2025-04-04 16:21:33', '2025-04-04 16:22:04', 'products/1743787293_02819443800-w.jpg', 'Men'),
(23, 'women’s coat forms', 'Silhouette: Knee-length, structured, belted waist\r\nMaterials: Waterproof cotton-twill or gabardine\r\nBest For: Rainy days, office wear, timeless elegance', 239.00, 44, '2025-04-04 16:24:03', '2025-04-04 16:24:03', 'products/1743787443_8db8e081c79dfa3c79ce1d90afb97d40 (1).jpg', 'Women'),
(24, 'Denim Vest &  pants', 'A sleeveless, waist-length vest made from durable denim fabric, featuring a button-up or zip-front closure and classic patch pockets with your jeans pants.', 120.00, 55, '2025-04-04 16:26:25', '2025-04-04 16:26:25', 'products/1743787585_148ac6dd926266984b98cfcc98b8846c.jpg', 'Women'),
(25, 'Cuir Jacket', 'A lightweight yet insulated jacket filled with down or synthetic feathers, featuring a quilted pattern and a high collar for warmth.', 180.00, 24, '2025-04-04 16:28:04', '2025-04-04 16:28:04', 'products/1743787684_f5a028fbb46f6731033fb9488cd409aa.jpg', 'Women'),
(26, 'Nike Dunk High', 'Timeless low-top sneakers with minimalist design, featuring smooth leather or canvas uppers, rubber soles, and often a contrast logo detail.', 380.00, 28, '2025-04-04 16:41:11', '2025-04-04 16:41:11', 'products/1743788471_shoes4.jpg', 'Shoes'),
(27, 'Classic Black Sneakers', 'Timeless low-top sneakers with minimalist design, featuring smooth leather or canvas uppers, rubber soles, and often a contrast logo detail.', 420.00, 40, '2025-04-04 16:42:05', '2025-04-04 16:46:27', 'products/1743788787_shoes1.jpg', 'Shoes'),
(28, 'Air force 1', 'Classic low-top basketball-inspired sneaker with air cushioning, leather upper, and perforated toe box.', 190.00, 54, '2025-04-04 16:45:29', '2025-04-04 16:45:29', 'products/1743788729_a2c25532272b79b776be5e106833091f.jpg', 'Shoes'),
(29, 'Air Jordan 1', 'Classic low-top basketball-inspired sneaker with air cushioning, leather upper, and perforated toe box.', 150.00, 65, '2025-04-04 16:49:11', '2025-04-04 16:49:11', 'products/1743788951_shoes2.jpg', 'Shoes'),
(30, 'Jacket', 'Jackets are lighter than coats, often cropped or waist-length, and focus on style + functionality.', 120.00, 55, '2025-04-04 16:52:34', '2025-04-04 16:52:34', 'products/1743789154_3.jpg', 'Women'),
(31, 'Veste', 'Jackets are lighter than coats, often cropped or waist-length, and focus on style + functionality.', 180.00, 55, '2025-04-04 16:53:09', '2025-04-04 16:53:09', 'products/1743789189_1.jpg', 'Women'),
(32, 'coat men', 'coats are lighter than coats, often cropped or waist-length, and focus on style + functionality.', 290.00, 47, '2025-04-04 16:53:55', '2025-04-04 16:53:55', 'products/1743789235_9242a4787dd1290133afb1adbdd24a3f.jpg', 'Men'),
(33, 'Jacket', 'Jackets are lighter than coats, often cropped or waist-length, and focus on style + functionality.', 250.00, 88, '2025-04-04 16:54:36', '2025-04-04 16:54:36', 'products/1743789276_2.jpg', 'Women'),
(34, 'Doudone', 'doudones are lighter than coats, often cropped or waist-length, and focus on style + functionality.', 250.00, 25, '2025-04-04 16:55:08', '2025-04-04 16:55:08', 'products/1743789308_16c3d8c34e3c7c68e6e2bd71f8e99a82.jpg', 'Women'),
(35, 'Jacket men', 'Jackets are lighter than coats, often cropped or waist-length, and focus on style + functionality.', 350.00, 44, '2025-04-04 16:55:58', '2025-04-04 16:55:58', 'products/1743789358_45e282a1a24ad8fa8fb00a80031593c4.jpg', 'Men'),
(36, 'Veste', 'Jackets are lighter than coats, often cropped or waist-length, and focus on style + functionality.', 150.00, 44, '2025-04-04 16:56:42', '2025-04-04 16:56:42', 'products/1743789402_4.jpg', 'Women'),
(37, 'jacket', 'Jackets are lighter than coats, often cropped or waist-length, and focus on style + functionality.', 210.00, 77, '2025-04-04 16:58:16', '2025-04-04 16:58:16', 'products/1743789496_Double pocket varsity jacket green.jpg', 'Women'),
(38, 'samba', 'shoes samba color bleu  and focus on style + functionality.', 360.00, 44, '2025-04-04 16:59:12', '2025-04-04 16:59:12', 'products/1743789552_smba bleu.jpg', 'Shoes'),
(39, 'sweatwear', 'A pullover or zip-up hoodie made from heavyweight cotton fleece, featuring a adjustable drawstring hood, kangaroo pocket, and ribbed cuffs/hem.', 120.00, 45, '2025-04-04 17:00:34', '2025-04-04 17:00:34', 'products/1743789634_men4.jpg', 'Men'),
(40, 'pullover', 'A pullover or zip-up hoodie made from heavyweight cotton fleece, featuring a adjustable drawstring hood, kangaroo pocket, and ribbed cuffs/hem.', 44.00, 45, '2025-04-04 17:03:17', '2025-04-04 17:03:17', 'products/1743789797_man3.jpg', 'Men'),
(41, 'Samba', 'Leather or canvas, minimalist design (e.g., low-top with rubber sole).', 240.00, 55, '2025-04-04 17:05:27', '2025-04-04 17:05:27', 'products/1743789927_10869b3d9310b7b2450e8cc205650d02.jpg', 'Shoes'),
(42, 'samba black', 'Leather or canvas, minimalist design (e.g., low-top with rubber sole).', 290.00, 44, '2025-04-04 17:06:28', '2025-04-04 17:06:28', 'products/1743789988_7c82ab172313c2788e69ac4f094aeff2.jpg', 'Shoes'),
(43, 'Jacket', 'Style & Materials: Timeless knee-length coat in water-resistant cotton-twill, double-breasted with a belted waist.', 130.00, 43, '2025-04-04 17:07:35', '2025-04-04 17:07:35', 'products/1743790055_woman2.jpg', 'Women'),
(44, 'Jacket', 'Style & Materials: Timeless knee-length coat in water-resistant cotton-twill, double-breasted with a belted waist.', 130.00, 55, '2025-04-04 17:07:59', '2025-04-04 17:07:59', 'products/1743790079_woman4.jpg', 'Women'),
(45, 'Jacket', 'Style & Materials: Timeless knee-length coat in water-resistant cotton-twill, double-breasted with a belted waist.', 150.00, 17, '2025-04-04 17:08:30', '2025-04-04 17:09:51', 'products/1743790191_woman3.jpg', 'Women'),
(46, 'Jacket', 'Style & Materials: Timeless knee-length coat in water-resistant cotton-twill, double-breasted with a belted waist.', 120.00, 44, '2025-04-04 17:08:55', '2025-04-04 17:09:34', 'products/1743790174_a0a23bc84383349ac9967a20d6e04fa6.jpg', 'Women'),
(48, 'yathreb samaali', '888888', 8.00, 8, '2025-04-13 17:11:21', '2025-04-13 17:11:21', 'products/1744567881_555.PNG', 'Women');

-- --------------------------------------------------------

--
-- Structure de la table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('72VA28ZBwDij4DT2ldoy85kCQiPB9GCUMQdtI2sR', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:139.0) Gecko/20100101 Firefox/139.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoic3FMUWxseFBNbU5xRXYydWZxQjRaVjlqWHZNNFRFV1BxQnVsamFpaCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1748623847),
('nMtFCn9m7tc6DO7hxU8Nlb5Z6QtH7ERHJ9agPTW6', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiMDF2TzZ6MjRXa1piVHk4S05yZWdHMFhneUtIc1dWM0xtNDVNRm9FTCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTI6ImxvZ2luX2FkbWluXzNkYzdhOTEzZWY1ZmQ0Yjg5MGVjYWJlMzQ4NzA4NTU3M2UxNmNmODIiO2k6MTt9', 1748624500);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `postal_code` varchar(10) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `postal_code`, `address`, `phone_number`) VALUES
(1002, 'Yassine Ben Ali', 'yassine.benali@example.com', '2025-04-04 18:17:30', 'hashed_password_1', 'token123', '2025-04-04 18:17:30', '2025-04-04 18:17:30', '1002', 'Rue Habib Bourguiba, Tunis', '21612345678'),
(1003, 'Ameni Trabelsi', 'ameni.trabelsi@example.com', '2025-04-04 18:17:30', 'hashed_password_2', 'token456', '2025-04-04 18:17:30', '2025-04-04 18:17:30', '3000', 'Rue 7 Novembre, Sfax', '21698765432'),
(1004, 'Mohamed Gharbi', 'mohamed.gharbi@example.com', '2025-04-04 18:17:30', 'hashed_password_3', 'token789', '2025-04-04 18:17:30', '2025-04-04 18:17:30', '4000', 'Rue de la Liberté, Kairouan', '21623456789'),
(1005, 'Ons Bouzid', 'ons.bouzid@example.com', '2025-04-04 18:17:30', 'hashed_password_4', 'token101', '2025-04-04 18:17:30', '2025-04-04 18:17:30', '8050', 'Rue de l’Indépendance, Hammamet', '21699887766'),
(1006, 'Rania Mejri', 'rania.mejri@example.com', '2025-04-04 18:17:30', 'hashed_password_5', 'token202', '2025-04-04 18:17:30', '2025-04-04 18:17:30', '5000', 'Avenue Bourguiba, Gabès', '21655667788'),
(1007, 'Sami Jelassi', 'sami.jelassi@example.com', '2025-04-04 18:18:17', 'hashed_password_6', 'tok101', '2025-04-04 18:18:17', '2025-04-04 18:18:17', '2080', 'Rue Ibn Khaldoun, Ariana', '21623456001'),
(1008, 'Hiba Krifa', 'hiba.krifa@example.com', '2025-04-04 18:18:17', 'hashed_password_7', 'tok102', '2025-04-04 18:18:17', '2025-04-04 18:18:17', '2090', 'Rue El Mourouj, Tunis', '21623456002'),
(1009, 'Chokri Messaoud', 'chokri.messaoud@example.com', '2025-04-04 18:18:17', 'hashed_password_8', 'tok103', '2025-04-04 18:18:17', '2025-04-04 18:18:17', '6000', 'Rue Tahar Haddad, Gabès', '21623456003'),
(1010, 'Ines Ferchichi', 'ines.ferchichi@example.com', '2025-04-04 18:18:17', 'hashed_password_9', 'tok104', '2025-04-04 18:18:17', '2025-04-04 18:18:17', '3000', 'Rue Ahmed Tlili, Sfax', '21623456004'),
(1011, 'Walid Baccouche', 'walid.baccouche@example.com', '2025-04-04 18:18:17', 'hashed_password_10', 'tok105', '2025-04-04 18:18:17', '2025-04-04 18:18:17', '1003', 'Rue Charles de Gaulle, Tunis', '21623456005'),
(1012, 'Sana Dhibi', 'sana.dhibi@example.com', '2025-04-04 18:18:17', 'hashed_password_11', 'tok106', '2025-04-04 18:18:17', '2025-04-04 18:18:17', '4000', 'Rue de l’Université, Kairouan', '21623456006'),
(1013, 'Nader Laabidi', 'nader.laabidi@example.com', '2025-04-04 18:18:17', 'hashed_password_12', 'tok107', '2025-04-04 18:18:17', '2025-04-04 18:18:17', '8056', 'Rue El Khadra, Hammamet', '21623456007'),
(1014, 'Nesrine Yahyaoui', 'nesrine.yahyaoui@example.com', '2025-04-04 18:18:17', 'hashed_password_13', 'tok108', '2025-04-04 18:18:17', '2025-04-04 18:18:17', '2100', 'Rue Mongi Slim, Ben Arous', '21623456008'),
(1015, 'Oussama Rekik', 'oussama.rekik@example.com', '2025-04-04 18:18:17', 'hashed_password_14', 'tok109', '2025-04-04 18:18:17', '2025-04-04 18:18:17', '5000', 'Rue Abdelaziz Thaalbi, Gabès', '21623456009'),
(1016, 'Marwa Hentati', 'marwa.hentati@example.com', '2025-04-04 18:18:17', 'hashed_password_15', 'tok110', '2025-04-04 18:18:17', '2025-04-04 18:18:17', '7000', 'Avenue Habib Thameur, Bizerte', '21623456010'),
(1017, 'Firas Mahjoub', 'firas.mahjoub@example.com', '2025-04-04 18:18:17', 'hashed_password_16', 'tok111', '2025-04-04 18:18:17', '2025-04-04 18:18:17', '3027', 'Cité El Ons, Sfax', '21623456011'),
(1018, 'Sirine Hammami', 'sirine.hammami@example.com', '2025-04-04 18:18:17', 'hashed_password_17', 'tok112', '2025-04-04 18:18:17', '2025-04-04 18:18:17', '1140', 'Rue El Feth, Zaghouan', '21623456012'),
(1019, 'Anis Guedria', 'anis.guedria@example.com', '2025-04-04 18:18:17', 'hashed_password_18', 'tok113', '2025-04-04 18:18:17', '2025-04-04 18:18:17', '2063', 'Rue de la République, Le Bardo', '21623456013'),
(1020, 'Najla Ben Romdhane', 'najla.benromdhane@example.com', '2025-04-04 18:18:17', 'hashed_password_19', 'tok114', '2025-04-04 18:18:17', '2025-04-04 18:18:17', '2013', 'Rue Farhat Hached, Menzah', '21623456014'),
(1021, 'Yasmine Triki', 'yasmine.triki@example.com', '2025-04-04 18:18:17', 'hashed_password_20', 'tok115', '2025-04-04 18:18:17', '2025-04-04 18:18:17', '4022', 'Rue Ennour, Kairouan', '21623456015'),
(1022, 'Malek Ayari', 'malek.ayari@example.com', '2025-04-04 18:20:05', 'hashed_pass_21', 'tok116', '2025-04-04 18:20:05', '2025-04-04 18:20:05', '2033', 'Rue Ibn Sina, El Menzah', '21623456016'),
(1023, 'Sarra Hachani', 'sarra.hachani@example.com', '2025-04-04 18:20:05', 'hashed_pass_22', 'tok117', '2025-04-04 18:20:05', '2025-04-04 18:20:05', '2086', 'Avenue de Carthage, La Marsa', '21623456017'),
(1024, 'Adem Bouslama', 'adem.bouslama@example.com', '2025-04-04 18:20:05', 'hashed_pass_23', 'tok118', '2025-04-04 18:20:05', '2025-04-04 18:20:05', '2050', 'Rue El Mourouj 2, Ben Arous', '21623456018'),
(1025, 'Rim Saidi', 'rim.saidi@example.com', '2025-04-04 18:20:05', 'hashed_pass_24', 'tok119', '2025-04-04 18:20:05', '2025-04-04 18:20:05', '4030', 'Cité Ezzouhour, Kairouan', '21623456019'),
(1026, 'Tarek Frikha', 'tarek.frikha@example.com', '2025-04-04 18:20:05', 'hashed_pass_25', 'tok120', '2025-04-04 18:20:05', '2025-04-04 18:20:05', '3021', 'Rue Mohamed Ali, Sfax', '21623456020'),
(1027, 'Houda Guesmi', 'houda.guesmi@example.com', '2025-04-04 18:20:05', 'hashed_pass_26', 'tok121', '2025-04-04 18:20:05', '2025-04-04 18:20:05', '3100', 'Avenue de la Liberté, Mahdia', '21623456021'),
(1028, 'Youssef Mabrouk', 'youssef.mabrouk@example.com', '2025-04-04 18:20:05', 'hashed_pass_27', 'tok122', '2025-04-04 18:20:05', '2025-04-04 18:20:05', '4100', 'Rue El Amal, Kasserine', '21623456022'),
(1029, 'Asma Khadhraoui', 'asma.khadhraoui@example.com', '2025-04-04 18:20:05', 'hashed_pass_28', 'tok123', '2025-04-04 18:20:05', '2025-04-04 18:20:05', '2000', 'Rue de Marseille, Tunis Centre', '21623456023'),
(1030, 'Nizar Oueslati', 'nizar.oueslati@example.com', '2025-04-04 18:20:05', 'hashed_pass_29', 'tok124', '2025-04-04 18:20:05', '2025-04-04 18:20:05', '6011', 'Rue Bir Ali, Gabès Sud', '21623456024'),
(1031, 'Lina Jendoubi', 'lina.jendoubi@example.com', '2025-04-04 18:20:05', 'hashed_pass_30', 'tok125', '2025-04-04 18:20:05', '2025-04-04 18:20:05', '7070', 'Cité Sidi Salem, Bizerte', '21623456025'),
(1032, 'Houssem Kallel', 'houssem.kallel@example.com', '2025-04-04 18:20:05', 'hashed_pass_31', 'tok126', '2025-04-04 18:20:05', '2025-04-04 18:20:05', '5121', 'Rue El Medina, Médenine', '21623456026'),
(1033, 'Amira Tlili', 'amira.tlili@example.com', '2025-04-04 18:20:05', 'hashed_pass_32', 'tok127', '2025-04-04 18:20:05', '2025-04-04 18:20:05', '2023', 'Avenue Hédi Chaker, Ariana', '21623456027'),
(1034, 'Iheb Zoghlami', 'iheb.zoghlami@example.com', '2025-04-04 18:20:05', 'hashed_pass_33', 'tok128', '2025-04-04 18:20:05', '2025-04-04 18:20:05', '2074', 'Rue Ibn El Jazzar, La Soukra', '21623456028'),
(1035, 'Henda Charef', 'henda.charef@example.com', '2025-04-04 18:20:05', 'hashed_pass_34', 'tok129', '2025-04-04 18:20:05', '2025-04-04 18:20:05', '4200', 'Rue El Kasbah, Gafsa', '21623456029'),
(1036, 'Mehdi Bouguerra', 'mehdi.bouguerra@example.com', '2025-04-04 18:20:05', 'hashed_pass_35', 'tok130', '2025-04-04 18:20:05', '2025-04-04 18:20:05', '7040', 'Rue 14 Janvier, Menzel Bourguiba', '21623456030');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Index pour la table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Index pour la table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Index pour la table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Index pour la table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Index pour la table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_order_number` (`order_number`),
  ADD KEY `idx_status` (`status`);

--
-- Index pour la table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_order_items_order` (`order_id`),
  ADD KEY `fk_order_items_product` (`product_id`);

--
-- Index pour la table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Index pour la table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT pour la table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT pour la table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1037;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `fk_order_items_order` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_order_items_product` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
