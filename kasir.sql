-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 19 Jan 2026 pada 07.15
-- Versi server: 8.0.30
-- Versi PHP: 8.3.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kasir`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `brands`
--

CREATE TABLE `brands` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `brands`
--

INSERT INTO `brands` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Scarlett', '2026-01-08 01:29:58', '2026-01-08 01:29:58'),
(2, 'Emina', '2026-01-08 01:29:58', '2026-01-12 03:45:47'),
(3, 'Hanasui', '2026-01-08 01:29:58', '2026-01-12 03:42:01'),
(4, 'Wardah', '2026-01-08 01:29:58', '2026-01-08 01:29:58'),
(6, 'Skintific', '2026-01-08 03:40:38', '2026-01-08 03:40:38'),
(7, 'Nyyo', '2026-01-12 03:28:30', '2026-01-12 03:28:30'),
(8, 'Gloglowing', '2026-01-19 03:03:08', '2026-01-19 03:03:08');

-- --------------------------------------------------------

--
-- Struktur dari tabel `brand_supplier`
--

CREATE TABLE `brand_supplier` (
  `id` bigint UNSIGNED NOT NULL,
  `brand_id` bigint UNSIGNED NOT NULL,
  `supplier_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `brand_supplier`
--

INSERT INTO `brand_supplier` (`id`, `brand_id`, `supplier_id`, `created_at`, `updated_at`) VALUES
(1, 4, 1, NULL, NULL),
(3, 2, 4, NULL, NULL),
(4, 4, 4, NULL, NULL),
(5, 4, 5, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel-cache-boost.roster.scan', 'a:2:{s:6:\"roster\";O:21:\"Laravel\\Roster\\Roster\":3:{s:13:\"\0*\0approaches\";O:29:\"Illuminate\\Support\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}s:11:\"\0*\0packages\";O:32:\"Laravel\\Roster\\PackageCollection\":2:{s:8:\"\0*\0items\";a:10:{i:0;O:22:\"Laravel\\Roster\\Package\":6:{s:9:\"\0*\0direct\";b:1;s:13:\"\0*\0constraint\";s:5:\"^12.0\";s:10:\"\0*\0package\";E:37:\"Laravel\\Roster\\Enums\\Packages:LARAVEL\";s:14:\"\0*\0packageName\";s:17:\"laravel/framework\";s:10:\"\0*\0version\";s:7:\"12.37.0\";s:6:\"\0*\0dev\";b:0;}i:1;O:22:\"Laravel\\Roster\\Package\":6:{s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:6:\"v0.3.7\";s:10:\"\0*\0package\";E:37:\"Laravel\\Roster\\Enums\\Packages:PROMPTS\";s:14:\"\0*\0packageName\";s:15:\"laravel/prompts\";s:10:\"\0*\0version\";s:5:\"0.3.7\";s:6:\"\0*\0dev\";b:0;}i:2;O:22:\"Laravel\\Roster\\Package\":6:{s:9:\"\0*\0direct\";b:1;s:13:\"\0*\0constraint\";s:4:\"^2.3\";s:10:\"\0*\0package\";E:36:\"Laravel\\Roster\\Enums\\Packages:BREEZE\";s:14:\"\0*\0packageName\";s:14:\"laravel/breeze\";s:10:\"\0*\0version\";s:5:\"2.3.8\";s:6:\"\0*\0dev\";b:1;}i:3;O:22:\"Laravel\\Roster\\Package\":6:{s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:6:\"v0.3.2\";s:10:\"\0*\0package\";E:33:\"Laravel\\Roster\\Enums\\Packages:MCP\";s:14:\"\0*\0packageName\";s:11:\"laravel/mcp\";s:10:\"\0*\0version\";s:5:\"0.3.2\";s:6:\"\0*\0dev\";b:1;}i:4;O:22:\"Laravel\\Roster\\Package\":6:{s:9:\"\0*\0direct\";b:1;s:13:\"\0*\0constraint\";s:5:\"^1.24\";s:10:\"\0*\0package\";E:34:\"Laravel\\Roster\\Enums\\Packages:PINT\";s:14:\"\0*\0packageName\";s:12:\"laravel/pint\";s:10:\"\0*\0version\";s:6:\"1.25.1\";s:6:\"\0*\0dev\";b:1;}i:5;O:22:\"Laravel\\Roster\\Package\":6:{s:9:\"\0*\0direct\";b:1;s:13:\"\0*\0constraint\";s:5:\"^1.41\";s:10:\"\0*\0package\";E:34:\"Laravel\\Roster\\Enums\\Packages:SAIL\";s:14:\"\0*\0packageName\";s:12:\"laravel/sail\";s:10:\"\0*\0version\";s:6:\"1.47.0\";s:6:\"\0*\0dev\";b:1;}i:6;O:22:\"Laravel\\Roster\\Package\":6:{s:9:\"\0*\0direct\";b:1;s:13:\"\0*\0constraint\";s:4:\"^4.1\";s:10:\"\0*\0package\";E:34:\"Laravel\\Roster\\Enums\\Packages:PEST\";s:14:\"\0*\0packageName\";s:12:\"pestphp/pest\";s:10:\"\0*\0version\";s:5:\"4.1.3\";s:6:\"\0*\0dev\";b:1;}i:7;O:22:\"Laravel\\Roster\\Package\":6:{s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:6:\"12.4.1\";s:10:\"\0*\0package\";E:37:\"Laravel\\Roster\\Enums\\Packages:PHPUNIT\";s:14:\"\0*\0packageName\";s:15:\"phpunit/phpunit\";s:10:\"\0*\0version\";s:6:\"12.4.1\";s:6:\"\0*\0dev\";b:1;}i:8;O:22:\"Laravel\\Roster\\Package\":6:{s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:10:\"\0*\0package\";E:38:\"Laravel\\Roster\\Enums\\Packages:ALPINEJS\";s:14:\"\0*\0packageName\";s:8:\"alpinejs\";s:10:\"\0*\0version\";s:6:\"3.15.1\";s:6:\"\0*\0dev\";b:1;}i:9;O:22:\"Laravel\\Roster\\Package\":6:{s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:10:\"\0*\0package\";E:41:\"Laravel\\Roster\\Enums\\Packages:TAILWINDCSS\";s:14:\"\0*\0packageName\";s:11:\"tailwindcss\";s:10:\"\0*\0version\";s:6:\"3.4.18\";s:6:\"\0*\0dev\";b:1;}}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}s:21:\"\0*\0nodePackageManager\";E:43:\"Laravel\\Roster\\Enums\\NodePackageManager:NPM\";}s:9:\"timestamp\";i:1767929069;}', 1768015469);

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `categories`
--

CREATE TABLE `categories` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(3, 'Serum', NULL, NULL),
(4, 'Moisturizer', NULL, NULL),
(5, 'Sunscreen', NULL, NULL),
(6, 'Face Mask', NULL, NULL),
(7, 'Lip Care', NULL, NULL),
(11, 'Body Serum', '2026-01-08 03:34:26', '2026-01-12 03:59:46'),
(12, 'Lip cream', '2026-01-08 03:38:53', '2026-01-08 03:38:53'),
(13, 'Lip Balm', '2026-01-09 02:16:26', '2026-01-09 02:16:26'),
(14, 'Toner', '2026-01-12 03:28:08', '2026-01-12 03:28:08'),
(15, 'facial wash', '2026-01-12 03:38:08', '2026-01-12 03:38:08');

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kasirs`
--

CREATE TABLE `kasirs` (
  `id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(8, '2025_12_11_011410_create_kasirs_table', 1),
(44, '0001_01_01_000000_create_users_table', 2),
(45, '0001_01_01_000001_create_cache_table', 2),
(46, '0001_01_01_000002_create_jobs_table', 2),
(47, '2025_11_11_054943_create_categories_table', 2),
(48, '2025_12_11_010905_create_brands_table', 2),
(49, '2025_12_11_010906_create_products_table', 2),
(50, '2025_12_11_011228_create_suppliers_table', 2),
(51, '2025_12_11_054903_add_unique_code_to_products_table', 2),
(52, '2025_12_11_120000_create_transactions_table', 2),
(53, '2025_12_12_043050_create_transaction_items_table', 2),
(54, '2025_12_12_100000_add_columns_to_transactions_table', 2),
(55, '2025_12_24_120000_drop_user_id_from_transactions_table', 2),
(56, '2025_12_24_130000_backfill_total_price_from_total', 2),
(57, '2025_12_24_140000_create_brand_supplier_table', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `products`
--

CREATE TABLE `products` (
  `id` bigint UNSIGNED NOT NULL,
  `unique_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_id` bigint UNSIGNED DEFAULT NULL,
  `brand_id` bigint UNSIGNED DEFAULT NULL,
  `price` int NOT NULL,
  `stock` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `products`
--

INSERT INTO `products` (`id`, `unique_code`, `name`, `photo`, `category_id`, `brand_id`, `price`, `stock`, `created_at`, `updated_at`) VALUES
(3, 'PRD-0003', 'Brightening Booster Serum', '1768188636.jpg', 3, 7, 100000, 0, '2026-01-08 01:29:59', '2026-01-19 03:06:14'),
(4, 'PRD-0004', 'UV Shield Acne Calming Sunscreen Serum  SPF 30 PA+++', '1768188989.png', 5, 4, 30000, 0, '2026-01-08 03:39:45', '2026-01-14 07:36:34'),
(5, 'PRD-0005', 'Nyyo Skinbarrier Booster Cooling Gel Moist', '1768187692.jpg', 4, 7, 60000, 9, '2026-01-09 02:38:55', '2026-01-19 03:11:41'),
(6, 'PRD-0006', 'NYYO FACIAL WASH DEEP CLEANSING WITH PETAL ROSE', '1768187973.jpg', 15, 7, 50000, 0, '2026-01-09 02:42:12', '2026-01-13 13:12:55'),
(7, 'PRD-0007', 'Hanasui Mattedorable Lip cream - Boba Edition', '1768189282.jpg', 12, 3, 23500, 26, '2026-01-12 03:41:22', '2026-01-19 03:11:41'),
(8, 'PRD-0008', 'Skintific 5X Ceramide Shooting Toner', '1768189515.jpg', 14, 6, 120000, 15, '2026-01-12 03:45:15', '2026-01-12 03:45:15'),
(9, 'PRD-0009', 'Scarlett 10% NIACINAMIDE Fragrance Brightening Body Serum Tube Velvet Rouge 170ml', '1768190372.png', 11, 1, 45000, 14, '2026-01-12 03:59:32', '2026-01-19 03:11:41');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `suppliers`
--

CREATE TABLE `suppliers` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `suppliers`
--

INSERT INTO `suppliers` (`id`, `name`, `phone`, `address`, `created_at`, `updated_at`) VALUES
(1, 'PT. Glow Beauty Indonesia', '081234567890', 'Jl. Melati No. 12, Jakarta Selatan', '2026-01-08 01:29:59', '2026-01-08 01:29:59'),
(2, 'CV. Skincare Natural', '081298765432', 'Jl. Kenanga No. 45, Bandung', '2026-01-08 01:29:59', '2026-01-08 01:29:59'),
(3, 'PT. Dermalab Nusantara', '081355667788', 'Jl. Sudirman No. 88, Surabaya', '2026-01-08 01:29:59', '2026-01-08 01:29:59'),
(4, 'PT. ARUNIKA', '0991876262', 'JL.Pulorejo', '2026-01-08 03:41:21', '2026-01-08 03:41:21'),
(5, 'Skintific', '00933', 'Prajurit kulon', '2026-01-19 03:02:32', '2026-01-19 03:02:32');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint UNSIGNED NOT NULL,
  `transaction_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total` bigint NOT NULL DEFAULT '0',
  `paid_amount` bigint DEFAULT NULL,
  `change_amount` bigint DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `total_price` bigint NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `transactions`
--

INSERT INTO `transactions` (`id`, `transaction_code`, `total`, `paid_amount`, `change_amount`, `created_at`, `updated_at`, `total_price`) VALUES
(1, 'TRX-0001', 180000, 200000, 20000, '2026-01-08 03:06:45', '2026-01-08 03:06:45', 180000),
(2, 'TRX-0002', 300000, 300000, 0, '2026-01-08 03:41:56', '2026-01-08 03:41:56', 300000),
(4, 'TRX-0004', 135000, 200000, 65000, '2026-01-09 02:20:46', '2026-01-09 02:20:46', 135000),
(5, 'TRX-0005', 60000, 100000, 40000, '2026-01-12 04:22:12', '2026-01-12 04:22:12', 60000),
(6, 'TRX-0006', 75000, 80000, 5000, '2026-01-13 07:25:53', '2026-01-13 07:25:53', 75000),
(7, 'TRX-0007', 105000, 200000, 95000, '2026-01-13 07:27:25', '2026-01-13 07:27:25', 105000),
(8, 'TRX-0008', 90000, 90000, 0, '2026-01-13 07:30:48', '2026-01-13 07:30:48', 90000),
(9, 'TRX-0009', 100000, 100000, 0, '2026-01-13 13:12:55', '2026-01-13 13:12:55', 100000),
(10, 'TRX-0010', 180000, 200000, 20000, '2026-01-14 07:36:34', '2026-01-14 07:36:34', 180000),
(11, 'TRX-0011', 75000, 80000, 5000, '2026-01-14 07:42:32', '2026-01-14 07:42:32', 75000),
(12, 'TRX-0012', 47000, 100000, 53000, '2026-01-16 03:15:58', '2026-01-19 03:03:48', 47000),
(13, 'TRX-0013', 420000, 500000, 80000, '2026-01-19 03:04:28', '2026-01-19 03:04:28', 420000),
(14, 'TRX-0014', 100000, 100000, 0, '2026-01-19 03:06:14', '2026-01-19 03:06:14', 100000),
(15, 'TRX-0015', 152000, 200000, 48000, '2026-01-19 03:11:41', '2026-01-19 03:11:41', 152000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaction_items`
--

CREATE TABLE `transaction_items` (
  `id` bigint UNSIGNED NOT NULL,
  `transaction_id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `qty` int NOT NULL,
  `price` bigint NOT NULL,
  `subtotal` bigint NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `transaction_items`
--

INSERT INTO `transaction_items` (`id`, `transaction_id`, `product_id`, `qty`, `price`, `subtotal`, `created_at`, `updated_at`) VALUES
(3, 2, 3, 4, 75000, 300000, '2026-01-08 03:41:56', '2026-01-08 03:41:56'),
(5, 4, 3, 1, 75000, 75000, '2026-01-09 02:20:46', '2026-01-09 02:20:46'),
(6, 4, 4, 2, 30000, 60000, '2026-01-09 02:20:46', '2026-01-09 02:20:46'),
(7, 5, 4, 2, 30000, 60000, '2026-01-12 04:22:12', '2026-01-12 04:22:12'),
(8, 6, 3, 1, 75000, 75000, '2026-01-13 07:25:53', '2026-01-13 07:25:53'),
(9, 7, 3, 1, 75000, 75000, '2026-01-13 07:27:25', '2026-01-13 07:27:25'),
(10, 7, 4, 1, 30000, 30000, '2026-01-13 07:27:25', '2026-01-13 07:27:25'),
(11, 8, 4, 3, 30000, 90000, '2026-01-13 07:30:48', '2026-01-13 07:30:48'),
(12, 9, 6, 2, 50000, 100000, '2026-01-13 13:12:55', '2026-01-13 13:12:55'),
(13, 10, 4, 6, 30000, 180000, '2026-01-14 07:36:34', '2026-01-14 07:36:34'),
(14, 11, 3, 1, 75000, 75000, '2026-01-14 07:42:32', '2026-01-14 07:42:32'),
(15, 12, 7, 2, 23500, 47000, '2026-01-16 03:15:58', '2026-01-16 03:15:58'),
(16, 13, 3, 1, 100000, 100000, '2026-01-19 03:04:28', '2026-01-19 03:04:28'),
(17, 13, 3, 1, 100000, 100000, '2026-01-19 03:04:28', '2026-01-19 03:04:28'),
(18, 13, 5, 1, 60000, 60000, '2026-01-19 03:04:28', '2026-01-19 03:04:28'),
(19, 13, 5, 1, 60000, 60000, '2026-01-19 03:04:28', '2026-01-19 03:04:28'),
(20, 13, 3, 1, 100000, 100000, '2026-01-19 03:04:28', '2026-01-19 03:04:28'),
(21, 14, 3, 1, 100000, 100000, '2026-01-19 03:06:14', '2026-01-19 03:06:14'),
(22, 15, 5, 1, 60000, 60000, '2026-01-19 03:11:41', '2026-01-19 03:11:41'),
(23, 15, 7, 2, 23500, 47000, '2026-01-19 03:11:41', '2026-01-19 03:11:41'),
(24, 15, 9, 1, 45000, 45000, '2026-01-19 03:11:41', '2026-01-19 03:11:41');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Kasir Toko', 'kasir@lovebeauty.com', NULL, '$2y$12$66InBDyDKraBGPcvNcPWX.tskrRRqeOny1bVLvcXLLWVJTGyEoZxS', NULL, '2026-01-08 01:29:58', '2026-01-08 01:29:58'),
(2, 'Admin Kasir', 'admin@kasir.com', NULL, '$2y$12$OT6OTCPFVTXdOGquZjaxk.CVeFGXmn2kFgv2H6FgX8K9e6mo/P826', NULL, '2026-01-08 01:29:59', '2026-01-08 01:29:59');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `brands_name_unique` (`name`);

--
-- Indeks untuk tabel `brand_supplier`
--
ALTER TABLE `brand_supplier`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `brand_supplier_brand_id_supplier_id_unique` (`brand_id`,`supplier_id`),
  ADD KEY `brand_supplier_supplier_id_foreign` (`supplier_id`);

--
-- Indeks untuk tabel `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_name_unique` (`name`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indeks untuk tabel `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kasirs`
--
ALTER TABLE `kasirs`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_unique_code_unique` (`unique_code`),
  ADD KEY `products_category_id_foreign` (`category_id`),
  ADD KEY `products_brand_id_foreign` (`brand_id`);

--
-- Indeks untuk tabel `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indeks untuk tabel `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `suppliers_name_unique` (`name`);

--
-- Indeks untuk tabel `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `transactions_transaction_code_unique` (`transaction_code`);

--
-- Indeks untuk tabel `transaction_items`
--
ALTER TABLE `transaction_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaction_items_transaction_id_foreign` (`transaction_id`),
  ADD KEY `transaction_items_product_id_foreign` (`product_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `brand_supplier`
--
ALTER TABLE `brand_supplier`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kasirs`
--
ALTER TABLE `kasirs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT untuk tabel `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `transaction_items`
--
ALTER TABLE `transaction_items`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `brand_supplier`
--
ALTER TABLE `brand_supplier`
  ADD CONSTRAINT `brand_supplier_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `brand_supplier_supplier_id_foreign` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL;

--
-- Ketidakleluasaan untuk tabel `transaction_items`
--
ALTER TABLE `transaction_items`
  ADD CONSTRAINT `transaction_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transaction_items_transaction_id_foreign` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
