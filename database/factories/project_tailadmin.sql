-- phpMyAdmin SQL Dump
-- version 5.2.2deb1+deb13u1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 06, 2026 at 12:47 PM
-- Server version: 11.8.6-MariaDB-0+deb13u1 from Debian
-- PHP Version: 8.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project_tailadmin`
--

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Dhanuka', 'dhanuka', '2026-03-27 09:39:09', '2026-03-27 09:39:09'),
(2, 'Bayer', 'bayer', '2026-03-27 09:39:09', '2026-03-27 09:39:09'),
(3, 'Iffco', 'iffco', '2026-03-27 09:39:09', '2026-03-27 09:39:09'),
(4, 'Aries', 'aries', '2026-03-27 09:39:09', '2026-03-27 09:39:09'),
(5, 'Sumitomo', 'sumitomo', '2026-03-27 09:39:09', '2026-03-27 09:39:09'),
(6, 'Syngenta', 'syngenta', '2026-03-27 09:39:09', '2026-03-27 09:39:09'),
(7, 'UPL', 'upl', '2026-03-27 09:39:09', '2026-03-27 09:39:09'),
(8, 'Yara', 'yara', '2026-03-27 09:39:09', '2026-03-27 09:39:09'),
(9, 'Adama', 'adama', '2026-03-27 09:39:09', '2026-03-27 09:39:09'),
(10, 'FMC', 'fmc', '2026-03-27 09:39:09', '2026-03-27 09:39:09'),
(11, 'Rallis', 'rallis', '2026-03-27 09:39:09', '2026-03-27 09:39:09'),
(12, 'BASF', 'basf', '2026-03-27 09:39:09', '2026-03-27 09:39:09');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Nutrients', NULL, NULL),
(2, 'Fungicides', NULL, NULL),
(3, 'Insecticides', NULL, NULL),
(4, 'Seeds', NULL, NULL),
(5, 'Weedicides', NULL, NULL),
(6, 'Tissue culture', NULL, NULL),
(7, 'Fertilizers', NULL, NULL),
(8, 'Hardware', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
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
-- Table structure for table `jobs`
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
-- Table structure for table `job_batches`
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
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_03_02_104450_create_orders_table', 1),
(5, '2026_03_02_105902_create_products_table', 1),
(6, '2026_03_02_110925_create_categories_table', 1),
(7, '2026_03_02_120351_create_order_product_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` varchar(50) NOT NULL,
  `seller_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_name` text DEFAULT NULL,
  `quantity` int(11) DEFAULT 1,
  `price` decimal(15,2) DEFAULT NULL,
  `total` decimal(15,2) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `shipping_id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `payment_status` varchar(50) DEFAULT 'pending',
  `payment_method` varchar(50) DEFAULT NULL,
  `status` varchar(50) DEFAULT 'ordered',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `stripe_payment_id` varchar(255) DEFAULT NULL,
  `phone` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order_id`, `seller_id`, `user_id`, `product_id`, `product_name`, `quantity`, `price`, `total`, `name`, `shipping_id`, `email`, `address`, `payment_status`, `payment_method`, `status`, `created_at`, `updated_at`, `stripe_payment_id`, `phone`) VALUES
(1, 'ORD-1774350499', 3, 2, 14, 'Ridomil', 1, 840.00, 840.00, 'Guest', 21, 'guest@mail.com', '', 'pending', 'cod', 'ordered', '2026-03-24 05:38:19', '2026-03-27 13:24:10', NULL, ''),
(2, 'ORD-WACDCU0TLZ', 3, 2, 11, 'Splash', 1, 750.00, 750.00, 'karan kumar', 27, 'root@gmail.com', '#56 sec 89 mohali, mohali', 'pending', 'cod', 'ordered', '2026-03-24 06:38:25', '2026-03-27 13:24:10', NULL, ''),
(6, 'ORD-PS1WCRJUBG', 3, 2, 11, 'Splash', 1, 750.00, 750.00, 'karan kumar', 27, 'root@gmail.com', '#56 sec 89 mohali, mohali', 'pending', 'cod', 'ordered', '2026-03-24 06:41:55', '2026-03-27 13:24:10', NULL, ''),
(7, 'ORD-PS1WCRJUBG', 3, 2, 29, 'Rice Seeds Deluxe', 1, 130.00, 130.00, 'karan kumar', 27, 'root@gmail.com', '#56 sec 89 mohali, mohali', 'pending', 'cod', 'ordered', '2026-03-24 06:41:55', '2026-03-27 13:24:10', NULL, ''),
(8, 'ORD-PS1WCRJUBG', 3, 2, 3, 'Sumitomo Taboli Plant Growth Regulator', 1, 790.00, 790.00, 'karan kumar', 27, 'root@gmail.com', '#56 sec 89 mohali, mohali', 'pending', 'cod', 'ordered', '2026-03-24 06:41:55', '2026-03-27 13:24:10', NULL, ''),
(9, 'ORD-4XW056KNQ7', 3, 2, 2, 'Fantac Plus Plant Growth Promoter', 1, 656.00, 656.00, 'karan', 28, 'karan@yopmail.com', '#86 sec 11 panchkula, PANCHKULA', 'pending', 'cod', 'ordered', '2026-03-24 06:46:21', '2026-03-27 13:24:10', NULL, ''),
(10, 'ORD-PQPUSADL5F', 3, 2, 28, 'Pearl Millet Seeds Premium (Bajra)', 1, 100.00, 100.00, 'kamal', 30, 'root@gmail.com', '#56 sec 89 mohali, mohali', 'pending', 'cod', 'ordered', '2026-03-24 07:01:53', '2026-03-27 13:24:10', NULL, ''),
(11, 'ORD-TQIBQUJQGV', 3, 2, 2, 'Fantac Plus Plant Growth Promoter', 1, 656.00, 656.00, 'manish', 31, 'root@gmail.com', '#56 sec 89 mohali, mohali', 'pending', 'cod', 'ordered', '2026-03-24 07:11:19', '2026-03-27 13:24:10', NULL, ''),
(12, 'ORD-YVNUHJNP2L', 3, 2, 59, '2-in-1 Sprayer (Battery + Manual)', 1, 3650.00, 3650.00, 'karan shrama', 35, 'root@gmail.com', '#56 sec 89 mohali, mohali', 'pending', 'cod', 'ordered', '2026-03-24 07:40:25', '2026-03-27 13:24:10', NULL, ''),
(13, 'ORD-YVNUHJNP2L', 3, 2, 1, 'Aries Agripro Micronutrient', 1, 578.00, 578.00, 'karan shrama', 35, 'root@gmail.com', '#56 sec 89 mohali, mohali', 'pending', 'cod', 'ordered', '2026-03-24 07:40:25', '2026-03-27 13:24:10', NULL, ''),
(14, 'ORD-NRAUHH35WY', 3, 2, 6, 'Fantac Plus Plant Growth Promoter', 1, 656.00, 656.00, 'karan', 1, 'root@gmail.com', 'bnhvgbhngfhfdghf, mohali', 'paid', 'stripe', 'ordered', '2026-03-24 23:53:49', '2026-03-27 13:24:10', NULL, ''),
(15, 'ORD-TTVLCUJ2HQ', 3, 2, 58, 'Sprayer 25L Portable Power Sprayer', 1, 8400.00, 8400.00, 'karan', 1, 'root@gmail.com', 'bnhvgbhngfhfdghf, mohali', 'paid', 'stripe', 'ordered', '2026-03-25 00:02:42', '2026-03-27 13:24:10', NULL, ''),
(16, 'ORD-TTVLCUJ2HQ', 3, 2, 60, 'Sprayer 20L Battery Operated Models', 1, 3200.00, 3200.00, 'karan', 1, 'root@gmail.com', 'bnhvgbhngfhfdghf, mohali', 'paid', 'stripe', 'ordered', '2026-03-25 00:02:42', '2026-03-27 13:24:10', NULL, ''),
(17, 'ORD-LUP4HSUTJD', 3, 2, 3, 'Sumitomo Taboli Plant Growth Regulator', 1, 790.00, 790.00, 'karan', 1, 'root@gmail.com', 'bnhvgbhngfhfdghf, mohali', 'pending', 'cod', 'ordered', '2026-03-25 00:12:37', '2026-03-27 13:24:10', NULL, ''),
(18, 'ORD-KHIU9SCYPY', 3, 2, 10, 'Abic', 1, 240.00, 240.00, 'karan', 1, 'root@gmail.com', 'bnhvgbhngfhfdghf, mohali', 'paid', 'stripe', 'ordered', '2026-03-25 00:22:42', '2026-03-27 13:24:10', NULL, ''),
(19, 'ORD-Z5NC0EQLNU', 3, 2, 3, 'Sumitomo Taboli Plant Growth Regulator', 1, 790.00, 790.00, 'karan', 1, 'root@gmail.com', 'bnhvgbhngfhfdghf, mohali', 'paid', 'stripe', 'ordered', '2026-03-25 00:39:39', '2026-03-27 13:24:10', NULL, ''),
(20, 'ORD-NLERY5IF0V', 3, 2, 19, 'Blitz 30% FS', 1, 220.00, 220.00, 'karan', 1, 'root@gmail.com', 'bnhvgbhngfhfdghf, mohali', 'pending', 'cod', 'ordered', '2026-03-26 00:17:28', '2026-03-27 13:24:10', NULL, ''),
(21, 'ORD-69C4E8831C6AF', 3, 2, NULL, NULL, 1, NULL, 656.00, NULL, 58, NULL, NULL, 'paid', 'stripe', 'ordered', '2026-03-26 02:34:19', '2026-03-27 13:24:10', NULL, ''),
(22, 'ORD-69C4E9014D581', 3, 2, NULL, NULL, 1, NULL, 13800.00, NULL, 59, NULL, NULL, 'paid', 'stripe', 'ordered', '2026-03-26 02:36:25', '2026-03-27 13:24:10', NULL, ''),
(23, 'ORD-69C4FAAC71C0D', 3, 2, NULL, NULL, 1, NULL, 840.00, NULL, 60, NULL, NULL, 'paid', 'stripe', 'ordered', '2026-03-26 03:51:48', '2026-03-27 13:24:10', NULL, ''),
(24, 'ORD-69C4FB21AF6EA', 3, 2, NULL, NULL, 1, NULL, 790.00, NULL, 61, NULL, NULL, 'paid', 'stripe', 'ordered', '2026-03-26 03:53:45', '2026-03-27 13:24:10', NULL, ''),
(25, 'ORD-69C4FBD3C019F', 3, 2, NULL, NULL, 1, NULL, 790.00, NULL, 62, NULL, NULL, 'paid', 'stripe', 'ordered', '2026-03-26 03:56:43', '2026-03-27 13:24:10', NULL, ''),
(26, 'ORD-69C5013C5634B', 3, 2, NULL, NULL, 1, NULL, 656.00, NULL, 65, NULL, NULL, 'paid', 'stripe', 'ordered', '2026-03-26 04:19:48', '2026-03-27 13:24:10', NULL, ''),
(27, 'ORD-69C5033C9DF40', 3, 2, NULL, NULL, 1, NULL, 790.00, NULL, 66, NULL, NULL, 'paid', 'stripe', 'ordered', '2026-03-26 04:28:20', '2026-03-27 13:24:10', NULL, ''),
(28, 'ORD-OHORNHV8PX', 3, 2, 11, 'Splash', 1, 750.00, 750.00, 'karan kumar', 67, 'root@gmail.com', '#56 sec 89 mohali, mohali', 'pending', 'cod', 'ordered', '2026-03-26 04:30:19', '2026-03-27 13:24:10', NULL, ''),
(29, 'ORD-H6NKU2ICQE', 3, 2, 2, 'Fantac Plus Plant Growth Promoter', 1, 656.00, 656.00, 'karan kumar', 68, 'root@gmail.com', '#56 sec 89 mohali, mohali', 'pending', 'cod', 'ordered', '2026-03-26 04:31:33', '2026-03-27 13:24:10', NULL, ''),
(30, 'ORD-1774949547', NULL, 2, 2, 'Fantac Plus Plant Growth Promoter', 2, 656.00, 1312.00, 'Guest', 70, 'guest@mail.com', '', 'pending', 'cod', 'ordered', '2026-03-31 04:02:27', '2026-03-31 04:02:27', NULL, ''),
(31, 'ORD-1774949547', NULL, 2, 3, 'Sumitomo Taboli Plant Growth Regulator', 1, 790.00, 790.00, 'Guest', 70, 'guest@mail.com', '', 'pending', 'cod', 'ordered', '2026-03-31 04:02:27', '2026-03-31 04:02:27', NULL, ''),
(32, 'ORD-1774949547', NULL, 2, 11, 'Splash', 1, 750.00, 750.00, 'Guest', 70, 'guest@mail.com', '', 'pending', 'cod', 'ordered', '2026-03-31 04:02:27', '2026-03-31 04:02:27', NULL, ''),
(33, 'ORD-1774950376', NULL, 2, 7, 'Sumitomo Taboli Plant Growth Regulator', 1, 890.00, 890.00, 'Guest', 71, 'guest@mail.com', '', 'pending', 'cod', 'ordered', '2026-03-31 04:16:16', '2026-03-31 04:16:16', NULL, ''),
(34, 'ORD-1774951862', NULL, 2, 3, 'Sumitomo Taboli Plant Growth Regulator', 1, 790.00, 790.00, 'Guest', 77, 'guest@mail.com', '', 'pending', 'cod', 'ordered', '2026-03-31 04:41:02', '2026-03-31 04:41:02', NULL, ''),
(35, 'ORD-1774951862', NULL, 2, 51, 'Urea (IFFCO Brand)', 1, 370.00, 370.00, 'Guest', 77, 'guest@mail.com', '', 'pending', 'cod', 'ordered', '2026-03-31 04:41:02', '2026-03-31 04:41:02', NULL, ''),
(36, 'ORD-1774951862', NULL, 2, 6, 'Fantac Plus Plant Growth Promoter', 1, 656.00, 656.00, 'Guest', 77, 'guest@mail.com', '', 'pending', 'cod', 'ordered', '2026-03-31 04:41:02', '2026-03-31 04:41:02', NULL, ''),
(37, 'ORD-1774951862', NULL, 2, 1, 'Aries Agripro Micronutrient', 1, 578.00, 578.00, 'Guest', 77, 'guest@mail.com', '', 'pending', 'cod', 'ordered', '2026-03-31 04:41:02', '2026-03-31 04:41:02', NULL, ''),
(38, 'ORD-1774953125', NULL, 2, 52, 'DAP (IFFCO Brand)', 1, 1350.00, 1350.00, 'Guest', 81, 'guest@mail.com', '', 'pending', 'cod', 'ordered', '2026-03-31 05:02:05', '2026-03-31 05:02:05', NULL, ''),
(39, 'ORD-1774953125', NULL, 2, 4, 'Aries Agromin Gold Micronutrient', 1, 650.00, 650.00, 'Guest', 81, 'guest@mail.com', '', 'pending', 'cod', 'ordered', '2026-03-31 05:02:05', '2026-03-31 05:02:05', NULL, ''),
(40, 'ORD-1774953125', NULL, 2, 2, 'Fantac Plus Plant Growth Promoter', 1, 656.00, 656.00, 'Guest', 81, 'guest@mail.com', '', 'pending', 'cod', 'ordered', '2026-03-31 05:02:05', '2026-03-31 05:02:05', NULL, ''),
(41, 'ORD-1774954336', NULL, 2, 41, 'Contaf Plus (Tata Rallis)', 1, 1700.00, 1700.00, 'Guest', 82, 'guest@mail.com', '', 'pending', 'cod', 'ordered', '2026-03-31 05:22:16', '2026-03-31 05:22:16', NULL, ''),
(42, 'ORD-1774956030', NULL, 2, 6, 'Fantac Plus Plant Growth Promoter', 1, 656.00, 656.00, 'Guest', 85, 'guest@mail.com', '', 'pending', 'cod', 'ordered', '2026-03-31 05:50:30', '2026-03-31 05:50:30', NULL, ''),
(43, 'ORD-1774956030', NULL, 2, 3, 'Sumitomo Taboli Plant Growth Regulator', 1, 790.00, 790.00, 'Guest', 85, 'guest@mail.com', '', 'pending', 'cod', 'ordered', '2026-03-31 05:50:30', '2026-03-31 05:50:30', NULL, ''),
(44, 'ORD-PRZ28M41UX', 3, 2, NULL, 'Sumitomo Taboli Plant Growth Regulator (x1)', 1, NULL, 790.00, 'michel march', 88, 'karan@yopmail.com', '', 'paid', 'stripe', 'ordered', '2026-03-31 06:15:53', '2026-03-31 06:15:53', 'cs_test_a1ZVsM4KXEThMdcH4R1gQCcEt2SGnOs148tdeB9vg3ZVPwApcPe401cFcH', ''),
(45, 'ORD-1774957724', NULL, 2, 11, 'Splash', 1, 750.00, 750.00, 'Guest', 89, 'guest@mail.com', '', 'pending', 'cod', 'ordered', '2026-03-31 06:18:44', '2026-03-31 06:18:44', NULL, ''),
(46, 'ORD-SO34A7NPLO', 3, 2, NULL, 'Blitz 30% FS (x1)', 1, NULL, 220.00, 'michel march', 90, 'root@gmail.com', '', 'paid', 'stripe', 'ordered', '2026-03-31 06:20:05', '2026-03-31 06:20:05', 'cs_test_a1FPHlng9yCd6yqFDPdPHI7kkF1rUKsz5KjnFRQTIffLwvNX1pQWbvAHK5', ''),
(47, 'ORD-40U95VAQUC', 3, 2, NULL, 'DAP (IFFCO Brand) (x1)', 1, NULL, 1350.00, 'michel march', 91, 'karan@yopmail.com', '', 'paid', 'stripe', 'ordered', '2026-03-31 06:27:57', '2026-03-31 06:27:57', 'cs_test_a1YmcD3pUxuGg9wKWFbgEV3oPQZTjFRyw86Z21R1cAM3KypIQHl1DZ5aPe', ''),
(48, 'ORD-1775018868', NULL, 2, 28, 'Pearl Millet Seeds Premium (Bajra)', 1, 100.00, 100.00, 'Guest', 94, 'guest@mail.com', '', 'pending', 'cod', 'ordered', '2026-03-31 23:17:48', '2026-03-31 23:17:48', NULL, '0000000000'),
(49, 'ORD-ULEEAITSTZ', 3, 2, NULL, 'Sumitomo Taboli Plant Growth Regulator (x1)', 1, NULL, 790.00, 'michel march', 95, 'karan@yopmail.com', '', 'paid', 'stripe', 'ordered', '2026-03-31 23:19:11', '2026-03-31 23:19:11', 'cs_test_a1QQCoIYHVDv4ZRdDGR2ZkMIyD77JocFWT9Tq5WFnhPANMfhGMJDZyVc2R', ''),
(50, 'ORD-1775025283', NULL, 2, 11, 'Splash', 1, 750.00, 750.00, 'Guest', 96, 'guest@mail.com', '', 'pending', 'cod', 'ordered', '2026-04-01 01:04:43', '2026-04-01 01:04:43', NULL, '0000000000'),
(51, 'ORD-QHJABX0IEP', 3, 2, NULL, 'Splash (x1)', 1, NULL, 750.00, 'michel march', 97, 'karan@yopmail.com', '', 'paid', 'stripe', 'ordered', '2026-04-01 01:06:32', '2026-04-01 01:06:32', 'cs_test_a1vHuaZ3zwJANUMy7ym9SxXYjF3C8uHUVr2YOoAQ0Qm3yR0jppie3LFLxj', ''),
(52, 'ORD-1775048291', NULL, 3, 34, 'Roundup (Glyphosate)', 1, 600.00, 600.00, 'Guest', 98, 'guest@mail.com', '', 'pending', 'cod', 'ordered', '2026-04-01 07:28:11', '2026-04-01 07:28:11', NULL, '0000000000'),
(53, 'ORD-IDPJATFPI0', 3, 3, NULL, 'Sumitomo Taboli Plant Growth Regulator (x1)', 1, NULL, 790.00, 'michel march', 99, 'root@gmail.com', '', 'paid', 'stripe', 'ordered', '2026-04-01 07:28:53', '2026-04-01 07:28:53', 'cs_test_a1eoyF47J553kivfv1T9tW3vTQRTuWFg9G8rPR15pJ2dPcUM57VJazWa2l', ''),
(54, 'ORD-J2H99XVHVS', 3, 2, NULL, 'Urea (IFFCO Brand) (x2)', 2, NULL, 740.00, 'michel march', 100, 'root@gmail.com', '', 'paid', 'stripe', 'ordered', '2026-04-01 23:23:33', '2026-04-01 23:23:33', 'cs_test_a1lnVQLSQt3p6wsjTY2klO19xvDEkKYbR4Hnv0L0XTohKwU6yE8hGB1oUm', ''),
(55, 'ORD-1775105675', NULL, 2, 35, 'Syngenta Dual Gold', 1, 960.00, 960.00, 'Guest', 101, 'guest@mail.com', '', 'pending', 'cod', 'ordered', '2026-04-01 23:24:35', '2026-04-01 23:24:35', NULL, '0000000000'),
(56, 'ORD-1775203885', NULL, 1, 7, 'Sumitomo Taboli Plant Growth Regulator', 1, 890.00, 890.00, 'Guest', 102, 'guest@mail.com', '', 'pending', 'cod', 'ordered', '2026-04-03 02:41:25', '2026-04-03 02:41:25', NULL, '0000000000'),
(57, 'ORD-JKSGVJ7GOX', 3, 2, NULL, 'Sumitomo Taboli Plant Growth Regulator (x1)', 1, NULL, 790.00, 'michel march', 103, 'karan@yopmail.com', '', 'paid', 'stripe', 'ordered', '2026-04-05 23:20:49', '2026-04-05 23:20:49', 'cs_test_a1gcNc4PhPEuIMj8DjIcBXYIcnGlpefvYczeXiUISijEKD7mLNf3bAa0Cv', ''),
(58, 'ORD-VBYFEBWHR2', 3, 2, NULL, 'Aries Agripro Micronutrient original (x1)', 1, 12000.00, 12000.00, 'michel march', 104, 'karan@yopmail.com', '', 'paid', 'stripe', 'ordered', '2026-04-05 23:48:14', '2026-04-05 23:48:14', 'cs_test_a16XZYzx9Xglv6y8EnnOtLlzF6zHk8ADodx6484FnWUxnd5cI5SufESiLI', ''),
(59, 'ORD-V5TNUPILKP', 3, 2, NULL, 'Aries Agripro Micronutrient  new second (x1)', 1, 1320.00, 1320.00, 'michel march', 105, 'karan@yopmail.com', '', 'paid', 'stripe', 'ordered', '2026-04-05 23:52:56', '2026-04-05 23:52:56', 'cs_test_a16iikidAqr1mtn4Em3rL25OfgRJjB4Oe7QHfn0IUArbTCSlcQuUeXTPdP', ''),
(60, 'ORD-EDUQ1JFTEZ', 3, 2, NULL, 'Aries Agripro Micronutrient original (x1)', 1, 12000.00, 12000.00, 'michel march', 106, 'karan@yopmail.com', '', 'paid', 'stripe', 'ordered', '2026-04-05 23:58:05', '2026-04-05 23:58:05', 'cs_test_a1ekez2UrpjJ68eWOWvk9be7s9AmfUk3y4bWrKiIRqpSNoadE8SHb0wR5L', ''),
(61, 'ORD-SK9KX0IKHN', 3, 2, 1, 'DAP (IFFCO Brand) (x1)', 1, 1350.00, 1350.00, 'michel march', 108, 'karan@yopmail.com', '', 'paid', 'stripe', 'ordered', '2026-04-06 00:01:30', '2026-04-06 05:32:17', 'cs_test_a1q02HmNOLAWe7AC6gz5LuRm0tgbNfqIW1TXHPhQuUzVSLlaBgJQnuEJgc', '8708110886'),
(62, 'ORD-EJPTQCXFDF', 3, 2, NULL, 'Aries Agripro Micronutrient (x1), FungiKill Max (x1)', 2, 5450.00, 5450.00, 'michel march', 110, 'karan@yopmail.com', '', 'paid', 'stripe', 'ordered', '2026-04-06 00:08:35', '2026-04-06 00:08:35', 'cs_test_b12eAUFpvC1iy50nSfJq6gMMcx26BOAtMrqNRSHn99xPiJO4TcdEHCgSY9', ''),
(63, 'ORD-VQ8EXT3QAR', 3, 2, NULL, 'Aries Agripro Micronutrient  new second third (x1)', 1, 13200.00, 13200.00, 'michel march', 113, 'karan@yopmail.com', '', 'paid', 'stripe', 'ordered', '2026-04-06 00:15:04', '2026-04-06 00:15:04', 'cs_test_a1RZOTsSwi7h6jUnqceDMjJufc9xPzqRlksjSzgK5Wm9Af0su20uRDn4Wr', ''),
(64, 'ORD-UKXLVB0WL6', 3, 2, 7359, 'Aries Agripro Micronutrient (x1)', 1, 5000.00, 5000.00, 'michel march', 114, 'karan@yopmail.com', '', 'paid', 'stripe', 'ordered', '2026-04-06 00:17:44', '2026-04-06 00:17:44', 'cs_test_a1gReCvFMzHmodW1aBLjiDBEdrDdPR9hG5o8znlOxHQpxA21QWXStHPJZF', ''),
(65, 'ORD-TEFHPTMNSK', 3, 2, 7360, 'Aries Agripro Micronutrient original (x1)', 1, 12000.00, 12000.00, 'michel march', 115, 'root@gmail.com', '', 'paid', 'stripe', 'ordered', '2026-04-06 00:21:15', '2026-04-06 00:21:15', 'cs_test_a1mpLzw1loyrNRu4goP77vJB368z6fYlnfKncs6CqZPH2C2UKos5qFO671', '+449896940144'),
(66, 'ORD-1775454712', NULL, 2, 7363, 'Aries Agripro Micronutrient  new second', 1, 1320.00, 1320.00, 'Guest', 116, 'guest@mail.com', '', 'pending', 'cod', 'ordered', '2026-04-06 00:21:52', '2026-04-06 00:21:52', NULL, '0000000000'),
(67, 'ORD-XOBD2RGHCY', 3, 2, 7360, 'Aries Agripro Micronutrient original (x1)', 1, 12000.00, 12000.00, 'michel march', 120, 'root@gmail.com', '', 'paid', 'stripe', 'ordered', '2026-04-06 00:34:15', '2026-04-06 00:34:15', 'cs_test_a1l19hwPkYPkoDtQ0H3BMAMwuGQlYd7YwVLKW8BZsIn444lJvjb11o1KpX', ''),
(68, 'ORD-IYEM2XEEOB', 3, 2, 7363, 'Aries Agripro Micronutrient  new second (x1)', 1, 1320.00, 1320.00, 'michel march', 121, 'root@gmail.com', '', 'paid', 'stripe', 'ordered', '2026-04-06 00:35:35', '2026-04-06 00:35:35', 'cs_test_a1pT0zeS74QpV7cM7JMHZAmy07EBOpCFQ0OnHmSJb5EHVtchdD5JL4aIdy', '+449896940144'),
(69, 'ORD-1775455641', NULL, 2, 7359, 'Aries Agripro Micronutrient', 1, 5000.00, 5000.00, 'Guest', 122, 'guest@mail.com', '', 'pending', 'cod', 'ordered', '2026-04-06 00:37:21', '2026-04-06 00:37:21', NULL, '0000000000'),
(70, 'ORD-1775456234', NULL, 2, 7360, 'Aries Agripro Micronutrient original', 1, 12000.00, 12000.00, 'Guest', 123, 'guest@mail.com', '', 'pending', 'cod', 'ordered', '2026-04-06 00:47:14', '2026-04-06 00:47:14', NULL, '0000000000'),
(71, 'ORD-1775456500', NULL, 2, 18, 'Coledina 18.5% SC', 1, 490.00, 490.00, 'Guest', 124, 'guest@mail.com', '', 'pending', 'cod', 'ordered', '2026-04-06 00:51:40', '2026-04-06 00:51:40', NULL, '0000000000'),
(72, 'ORD-1775456784', NULL, 2, 7363, 'Aries Agripro Micronutrient  new second', 1, 1320.00, 1320.00, 'karan singh', 125, 'root1@yopmail.com', '', 'pending', 'cod', 'ordered', '2026-04-06 00:56:24', '2026-04-06 00:56:24', NULL, '0000000000'),
(73, 'ORD-1775456928', NULL, 2, 7360, 'Aries Agripro Micronutrient original', 1, 12000.00, 12000.00, 'karan singh', 126, 'root1@yopmail.com', '', 'pending', 'cod', 'ordered', '2026-04-06 00:58:48', '2026-04-06 00:58:48', NULL, '0000000000'),
(74, 'ORD-1775457187', NULL, 2, 7364, 'Aries Agripro Micronutrient  new second third', 1, 13200.00, 13200.00, 'karan singh', 127, 'root1@yopmail.com', '', 'pending', 'cod', 'ordered', '2026-04-06 01:03:07', '2026-04-06 01:03:07', NULL, '0000000000'),
(75, 'ORD-1775457336', NULL, 2, 7360, 'Aries Agripro Micronutrient original', 1, 12000.00, 12000.00, 'karan singh', 128, 'root1@yopmail.com', '', 'pending', 'cod', 'ordered', '2026-04-06 01:05:36', '2026-04-06 01:05:36', NULL, '0000000000'),
(76, 'ORD-1775457451', NULL, 2, 7362, 'Aries Agripro Micronutrient', 1, 1200.00, 1200.00, 'karan singh', 129, 'root1@yopmail.com', '', 'pending', 'cod', 'ordered', '2026-04-06 01:07:31', '2026-04-06 01:07:31', NULL, '0000000000'),
(77, 'ORD-1775460245', 3, 2, 2, 'Fantac Plus Plant Growth Promoter', 1, 656.00, 656.00, 'karan singh', 131, 'root1@yopmail.com', '', 'pending', 'cod', 'ordered', '2026-04-06 01:54:05', '2026-04-06 01:54:05', NULL, '0000000000'),
(78, 'ORD-1775460694', 3, 2, 12, 'Adama', 1, 740.00, 740.00, 'karan singh', 132, 'root1@yopmail.com', '', 'pending', 'cod', 'ordered', '2026-04-06 02:01:34', '2026-04-06 02:01:34', NULL, '0000000000'),
(79, 'ORD-1775460694', 3, 2, 11, 'Splash', 2, 750.00, 1500.00, 'karan singh', 132, 'root1@yopmail.com', '', 'pending', 'cod', 'ordered', '2026-04-06 02:01:34', '2026-04-06 02:01:34', NULL, '0000000000'),
(80, 'ORD-HHVUGUIZYZ', 3, 2, NULL, 'Coledina 18.5% SC (x1), Blitz 30% FS (x2), Sumitomo Taboli Plant Growth Regulator (x1)', 4, 1820.00, 1820.00, 'michel march', 135, 'root@gmail.com', '', 'paid', 'stripe', 'ordered', '2026-04-06 04:11:34', '2026-04-06 04:11:34', 'cs_test_b1Ueovt3KnPkD8Z8JBLscRXivG6OsD0f9tsb2ONZCtgh1Y0LVKxdCbYLoP', ''),
(81, 'ORD-WSYHZF5RTD', 3, 2, NULL, 'Corn Seeds Premium (x1)', 1, NULL, 100.00, 'michel march', 136, 'karan@yopmail.com', '', 'paid', 'stripe', 'ordered', '2026-04-06 04:13:31', '2026-04-06 04:13:31', 'cs_test_a1nNLFlbxSECFCBtemXMyw5i4JTjD9tvfRBwBLSgALAj66OaCqRaozHIQc', ''),
(82, 'ORD-O6W6AIHLQS', 3, 2, 17, 'Zoy Insecticide (x1)', 1, 440.00, 440.00, 'michel march', 137, 'karan@yopmail.com', '', 'paid', 'stripe', 'ordered', '2026-04-06 04:14:57', '2026-04-06 04:14:57', 'cs_test_a1hdZBtWiMDxqCMEdmVlWBZgr1Kd8BplB6jASKH5wUh1VAn9uAR2Ew5VSB', ''),
(83, 'ORD-EY98ZXRMYX', 3, 2, 34, 'Roundup (Glyphosate) (x1)', 1, 600.00, 600.00, 'michel march', 138, 'root@gmail.com', '', 'paid', 'stripe', 'ordered', '2026-04-06 04:15:57', '2026-04-06 04:15:57', 'cs_test_a1K8h4yO835XjnKsbOtR8EQbau3zIBFnovYmM44AnmdsldptOilE9i4RMW', '+449896940144'),
(84, 'ORD-1775468787', NULL, 2, 44, 'Tissue Culture Banana', 1, 900.00, 900.00, 'karan singh', 139, 'root1@yopmail.com', '', 'pending', 'cod', 'ordered', '2026-04-06 04:16:27', '2026-04-06 04:16:27', NULL, '0000000000'),
(85, 'ORD-1775476899', NULL, 6, 2, 'Fantac Plus Plant Growth Promoter', 1, 656.00, 656.00, 'Amit kumar', 140, 'root3@yopmail.com', '', 'pending', 'cod', 'ordered', '2026-04-06 06:31:39', '2026-04-06 06:31:39', NULL, '0000000000');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(10) UNSIGNED NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_product`
--

CREATE TABLE `order_product` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `brand_id` int(10) UNSIGNED DEFAULT NULL,
  `seller_id` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `category` varchar(255) DEFAULT NULL,
  `brand_name` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `sale_price` decimal(10,2) NOT NULL,
  `regular_price` decimal(10,2) DEFAULT NULL,
  `stock` int(11) NOT NULL DEFAULT 0,
  `images` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `brand_id`, `seller_id`, `category`, `brand_name`, `name`, `slug`, `description`, `sale_price`, `regular_price`, `stock`, `images`, `created_at`, `updated_at`) VALUES
(1, 1, 4, 3, 'Nutrients', 'aries', 'Aries Agripro Micronutrient', 'aries-agripro-micronutrient', 'ewrewdsrfdesfdsfdsf', 578.00, 650.00, 50, '[\"/one.jpeg\"]', '2026-03-18 10:09:19', '2026-03-27 05:08:04'),
(2, 1, 4, 3, 'Nutrients', 'dhanuka', 'Fantac Plus Plant Growth Promoter', 'fantac-plus-plant-growth-promoter', 'new brands', 656.00, 720.00, 50, '[\"/nut2.jpg\"]', '2026-03-18 10:09:19', '2026-04-01 05:47:15'),
(3, 1, 4, 3, 'Nutrients', 'sumitomo', 'Sumitomo Taboli Plant Growth Regulator', 'sumitomo-taboli-plant-growth-regulator', '', 790.00, 899.00, 50, '[\"/nut3.jpg\"]', '2026-03-18 10:09:19', '2026-03-18 10:09:19'),
(4, 1, 5, 3, 'Nutrients', 'aries', 'Aries Agromin Gold Micronutrient', 'aries-agromin-gold-micronutrient', '', 650.00, 700.00, 50, '[\"/nut4.jpg\"]', '2026-03-18 10:09:19', '2026-03-18 10:09:19'),
(5, 1, 6, 3, 'Nutrients', 'aries', 'Aries Agripro Micronutrient', 'aries-agripro-micronutrient-2', '', 878.00, 900.00, 50, '[\"/nut5.jpg\"]', '2026-03-18 10:09:19', '2026-03-18 10:09:19'),
(6, 1, 6, 3, 'Nutrients', 'iffco', 'Fantac Plus Plant Growth Promoter', 'fantac-plus-plant-growth-promoter', NULL, 656.00, 750.00, 50, '\"[\\\"1775476391_65a8a38d-fc5d-5f0a-aca3-e44d0035da1a.jpg\\\"]\"', '2026-03-18 10:09:19', '2026-04-06 06:23:11'),
(7, 1, 7, 3, 'Nutrients', 'sumitomo', 'Sumitomo Taboli Plant Growth Regulator', 'sumitomo-taboli-plant-growth-regulator-2', '', 890.00, 999.00, 50, '[\"/nut7.jpg\"]', '2026-03-18 10:09:19', '2026-03-18 10:09:19'),
(8, 1, 9, 3, 'Nutrients', 'aries', 'Aries Agromin Gold Micronutrient', 'aries-agromin-gold-micronutrient-2', '', 850.00, 1000.00, 50, '[\"/nut8.jpg\"]', '2026-03-18 10:09:19', '2026-03-18 10:09:19'),
(9, 2, 1, 3, 'Fungicides', 'sumitomo', 'FungiKill Max', 'fungikill-max', '', 450.00, 500.00, 50, '[\"/fungicides.jpg\"]', '2026-03-18 10:09:19', '2026-03-18 10:09:19'),
(11, 2, 2, 3, 'Fungicides', 'upl', 'Splash', 'splash', '', 750.00, 800.00, 50, '[\"/splash.jpg\"]', '2026-03-18 10:09:19', '2026-03-18 10:09:19'),
(12, 2, 3, 3, 'Fungicides', 'adama', 'Adama', 'adama', '', 740.00, 800.00, 50, '[\"/adama.jpg\"]', '2026-03-18 10:09:19', '2026-03-18 10:09:19'),
(13, 2, 1, 3, 'Fungicides', 'adama', 'Metman', 'metman', '', 450.00, 500.00, 50, '[\"/metman.jpg\"]', '2026-03-18 10:09:19', '2026-03-18 10:09:19'),
(14, 2, 1, 3, 'Fungicides', 'fmc', 'Ridomil', 'ridomil', '', 840.00, 1000.00, 50, '[\"/ridomil.jpg\"]', '2026-03-18 10:09:19', '2026-03-18 10:09:19'),
(15, 2, 1, 3, 'Fungicides', 'rallis', 'FungiKill Max', 'fungikill-max-2', '', 750.00, 800.00, 50, '[\"/fungicides.jpg\"]', '2026-03-18 10:09:19', '2026-03-18 10:09:19'),
(16, 2, 4, 3, 'Fungicides', 'bayer', 'FungiStop nativo bayer', 'fungistop-nativo-bayer', '', 2640.00, 2900.00, 50, '[\"/nativo.jpg\"]', '2026-03-18 10:09:19', '2026-03-18 10:09:19'),
(17, 3, 4, 3, 'Insecticides', NULL, 'Zoy Insecticide', 'zoy-insecticide', '', 440.00, 490.00, 50, '[\"/solomon.jpg\"]', '2026-03-18 10:09:19', '2026-03-18 10:09:19'),
(18, 3, 4, 3, 'Insecticides', NULL, 'Coledina 18.5% SC', 'coledina-18-5-sc', '', 490.00, 750.00, 50, '[\"/karate.jpg\"]', '2026-03-18 10:09:19', '2026-03-18 10:09:19'),
(19, 3, 7, 3, 'Insecticides', NULL, 'Blitz 30% FS', 'blitz-30-fs', '', 220.00, 520.00, 50, '[\"/coragen.jpg\"]', '2026-03-18 10:09:19', '2026-03-18 10:09:19'),
(20, 3, 7, 3, 'Insecticides', NULL, 'Zoy Insecticide', 'zoy-insecticide-2', '', 440.00, 490.00, 50, '[\"/alika.jpg\"]', '2026-03-18 10:09:19', '2026-03-18 10:09:19'),
(21, 3, 4, 3, 'Insecticides', NULL, 'Coledina 18.5% SC', 'coledina-18-5-sc-2', '', 490.00, 750.00, 50, '[\"/ulala.jpg\"]', '2026-03-18 10:09:19', '2026-03-18 10:09:19'),
(22, 3, 5, 3, 'Insecticides', NULL, 'Blitz 30% FS', 'blitz-30-fs-2', '', 220.00, 520.00, 50, '[\"/confidor.jpg\"]', '2026-03-18 10:09:19', '2026-03-18 10:09:19'),
(23, 3, 5, 3, 'Insecticides', NULL, 'Zoy Insecticide', 'zoy-insecticide-3', '', 440.00, 490.00, 50, '[\"/matador.jpg\"]', '2026-03-18 10:09:19', '2026-03-18 10:09:19'),
(24, 3, 5, 3, 'Insecticides', NULL, 'Coledina 18.5% SC', 'coledina-18-5-sc-3', '', 490.00, 750.00, 50, '[\"/custodia.jpg\"]', '2026-03-18 10:09:19', '2026-03-18 10:09:19'),
(25, 3, 5, 3, 'Insecticides', NULL, 'Blitz 30% FS', 'blitz-30-fs-3', '', 220.00, 520.00, 50, '[\"/police.jpg\"]', '2026-03-18 10:09:19', '2026-03-18 10:09:19'),
(26, 4, 7, 3, 'Seeds', NULL, 'Corn Seeds Premium', 'corn-seeds-premium', '', 100.00, 120.00, 50, '[\"/maize.jpg\"]', '2026-03-18 10:09:19', '2026-03-18 10:09:19'),
(27, 4, 2, 3, 'Seeds', NULL, 'Wheat Seeds Deluxe', 'wheat-seeds-deluxe', '', 130.00, 150.00, 50, '[\"/wheat.jpg\"]', '2026-03-18 10:09:19', '2026-03-18 10:09:19'),
(28, 4, 7, 3, 'Seeds', NULL, 'Pearl Millet Seeds Premium (Bajra)', 'pearl-millet-seeds-premium-bajra', '', 100.00, 120.00, 50, '[\"/bajra.jpg\"]', '2026-03-18 10:09:19', '2026-03-18 10:09:19'),
(29, 4, 7, 3, 'Seeds', NULL, 'Rice Seeds Deluxe', 'rice-seeds-deluxe', '', 130.00, 150.00, 50, '[\"/rice.jpg\"]', '2026-03-18 10:09:19', '2026-03-18 10:09:19'),
(30, 4, 7, 3, 'Seeds', NULL, 'Couliflower Seeds Premium', 'couliflower-seeds-premium', '', 100.00, 120.00, 50, '[\"/cauiflower.jpg\"]', '2026-03-18 10:09:19', '2026-03-18 10:09:19'),
(31, 4, 3, 3, 'Seeds', NULL, 'Rice Seeds Deluxe Arize', 'rice-seeds-deluxe-arize', '', 130.00, 150.00, 50, '[\"/paddy.jpg\"]', '2026-03-18 10:09:19', '2026-03-18 10:09:19'),
(32, 4, 7, 3, 'Seeds', NULL, 'Corn Seeds Premium', 'corn-seeds-premium-2', '', 100.00, 120.00, 50, '[\"/seeds.jpg\"]', '2026-03-18 10:09:19', '2026-03-18 10:09:19'),
(33, 4, 2, 3, 'Seeds', NULL, 'poineer Mustard Seeds Deluxe', 'poineer-mustard-seeds-deluxe', '', 130.00, 150.00, 50, '[\"/mustard.jpg\"]', '2026-03-18 10:09:19', '2026-03-18 10:09:19'),
(34, 5, 7, 3, 'Weedicides', NULL, 'Roundup (Glyphosate)', 'roundup-glyphosate', '', 600.00, 850.00, 50, '[\"/roundup.jpg\"]', '2026-03-18 10:09:19', '2026-03-18 10:09:19'),
(35, 5, 3, 3, 'Weedicides', 'syngenta', 'Syngenta Dual Gold', 'syngenta-dual-gold', '', 960.00, 1050.00, 50, '[\"/dualgold.jpg\"]', '2026-03-18 10:09:19', '2026-03-18 10:09:19'),
(36, 5, 7, 3, 'Weedicides', 'bayer', 'Bayer Council Active', 'bayer-council-active', '', 1756.00, 2000.00, 50, '[\"/council.jpg\"]', '2026-03-18 10:09:19', '2026-03-18 10:09:19'),
(37, 5, 4, 3, 'Weedicides', 'upl', 'UPL Sweep Power', 'upl-sweep-power', '', 1320.00, 1500.00, 50, '[\"/sweep.jpg\"]', '2026-03-18 10:09:19', '2026-03-18 10:09:19'),
(38, 5, 4, 3, 'Weedicides', 'adama', 'Adama Shaked', 'adama-shaked', '', 3000.00, 3500.00, 50, '[\"/shaked.jpg\"]', '2026-03-18 10:09:19', '2026-03-18 10:09:19'),
(39, 5, 4, 3, 'Weedicides', NULL, 'Nominee Gold (PI Industries)', 'nominee-gold-pi-industries', '', 1300.00, 1350.00, 50, '[\"/nominee.jpg\"]', '2026-03-18 10:09:19', '2026-03-18 10:09:19'),
(40, 5, 3, 3, 'Weedicides', NULL, 'WeedBeGone', 'weedbegone', '', 1390.00, 1450.00, 50, '[\"/weedicides.jpg\"]', '2026-03-18 10:09:19', '2026-03-18 10:09:19'),
(41, 5, 1, 3, 'Weedicides', 'rallis', 'Contaf Plus (Tata Rallis)', 'contaf-plus-tata-rallis', '', 1700.00, 1850.00, 50, '[\"/tatarallis.jpg\"]', '2026-03-18 10:09:19', '2026-03-18 10:09:19'),
(42, 6, 3, 3, 'Tissue Culture', NULL, 'Tissue Culture Banana (G9 Variety)', 'tissue-culture-banana-g9-variety', '', 900.00, 1000.00, 50, '[\"/banana.jpg\"]', '2026-03-18 10:09:19', '2026-03-18 10:09:19'),
(43, 6, 3, 3, 'Tissue Culture', NULL, 'Potato (Aloo) - Mini Tubers', 'potato-aloo-mini-tubers', '', 900.00, 1000.00, 50, '[\"/potato.jpg\"]', '2026-03-18 10:09:19', '2026-03-18 10:09:19'),
(44, 6, 3, 3, 'Tissue Culture', NULL, 'Tissue Culture Banana', 'tissue-culture-banana', '', 900.00, 1000.00, 50, '[\"/tissue.jpg\"]', '2026-03-18 10:09:19', '2026-03-18 10:09:19'),
(45, 6, 7, 3, 'Tissue Culture', NULL, 'Sugarcane (Ganna) - Plantlets', 'sugarcane-ganna-plantlets', '', 900.00, 1000.00, 50, '[\"/sugercane.jpg\"]', '2026-03-18 10:09:19', '2026-03-18 10:09:19'),
(46, 6, 3, 3, 'Tissue Culture', NULL, 'Bamboo (Baans) - In Vitro Culture', 'bamboo-baans-in-vitro-culture', '', 900.00, 1000.00, 50, '[\"/banboo.jpg\"]', '2026-03-18 10:09:19', '2026-03-18 10:09:19'),
(47, 6, 7, 3, 'Tissue Culture', NULL, 'Tissue Culture Orchid Flowers', 'tissue-culture-orchid-flowers', '', 900.00, 1000.00, 50, '[\"/orchid.jpg\"]', '2026-03-18 10:09:19', '2026-03-18 10:09:19'),
(48, 6, 3, 3, 'Tissue Culture', NULL, 'Gerbera Flowers (Tissue Culture)', 'gerbera-flowers-tissue-culture', '', 900.00, 1000.00, 50, '[\"/gerbera.jpg\"]', '2026-03-18 10:09:19', '2026-03-18 10:09:19'),
(49, 6, 7, 3, 'Tissue Culture', NULL, 'Tissue Culture Teak (Sagwan)', 'tissue-culture-teak-sagwan', '', 900.00, 1000.00, 50, '[\"/sangwan.jpg\"]', '2026-03-18 10:09:19', '2026-03-18 10:09:19'),
(50, 7, 3, 3, 'Fertilizers', NULL, 'NitroBoost', 'nitroboost', '', 650.00, 700.00, 50, '[\"images/categories/fertilizers.jpg\"]', '2026-03-18 10:09:19', '2026-03-18 10:09:19'),
(51, 7, 7, 3, 'Fertilizers', 'iffco', 'Urea (IFFCO Brand)', 'urea-iffco-brand', NULL, 370.00, 410.00, 50, '[\"/urea.jpg\"]', '2026-03-18 10:09:19', '2026-03-31 07:06:28'),
(52, 7, 4, 3, 'Fertilizers', 'iffco', 'DAP (IFFCO Brand)', 'dap-iffco-brand', '', 1350.00, 2250.00, 50, '[\"/dap.jpg\"]', '2026-03-18 10:09:19', '2026-03-18 10:09:19'),
(53, 7, 4, 3, 'Fertilizers', NULL, 'NPK 19:19:19 (Water Soluble)', 'npk-19-19-19-water-soluble', '', 680.00, 700.00, 50, '[\"/npk.jpg\"]', '2026-03-18 10:09:19', '2026-03-18 10:09:19'),
(54, 7, 4, 3, 'Fertilizers', NULL, 'MOP (Muriate of Potash)', 'mop-muriate-of-potash', '', 1580.00, 1700.00, 50, '[\"/mop.jpg\"]', '2026-03-18 10:09:19', '2026-03-18 10:09:19'),
(55, 7, 3, 3, 'Fertilizers', NULL, 'Calcium Nitrate (Secondary Nutrient)', 'calcium-nitrate-secondary-nutrient', '', 1950.00, 2000.00, 50, '[\"/nitrate.jpg\"]', '2026-03-18 10:09:19', '2026-03-18 10:09:19'),
(56, 7, 4, 3, 'Fertilizers', NULL, 'Magnesium Sulphate', 'magnesium-sulphate', '', 950.00, 980.00, 50, '[\"/sulphate.jpg\"]', '2026-03-18 10:09:19', '2026-03-18 10:09:19'),
(57, 7, 4, 3, 'Fertilizers', NULL, 'Potassium Sulphate (SOP 0:0:50)', 'potassium-sulphate-sop-0-0-50', '', 1650.00, 1700.00, 50, '[\"/potasium.jpg\"]', '2026-03-18 10:09:19', '2026-03-18 10:09:19'),
(58, 8, 3, 3, 'Hardware', NULL, 'Sprayer 25L Portable Power Sprayer', 'sprayer-25l-portable-power-sprayer', '', 8400.00, 9500.00, 50, '[\"/petrol.jpg\"]', '2026-03-18 10:09:19', '2026-03-18 10:09:19'),
(59, 8, 1, 3, 'Hardware', NULL, '2-in-1 Sprayer (Battery + Manual)', '2-in-1-sprayer-battery-manual', '', 3650.00, 3800.00, 50, '[\"/dual.jpg\"]', '2026-03-18 10:09:19', '2026-03-18 10:09:19'),
(60, 8, 3, 3, 'Hardware', NULL, 'Sprayer 20L Battery Operated Models', 'sprayer-20l-battery-operated-models', '', 3200.00, 3600.00, 50, '[\"/battery.jpg\"]', '2026-03-18 10:09:19', '2026-03-18 10:09:19'),
(61, 8, 4, 3, 'Hardware', NULL, 'Manual Seed Drill (Beej Bone ki Machine)', 'manual-seed-drill-beej-bone-ki-machine', '', 9800.00, 10500.00, 50, '[\"/seeddril.jpg\"]', '2026-03-18 10:09:19', '2026-03-18 10:09:19'),
(62, 8, 3, 3, 'Hardware', NULL, 'Earth Auger (Gadda Khodne ki Machine)', 'earth-auger-gadda-khodne-ki-machine', 'kldgfjgkldfvgndfv.kldnsklgjdsgnd,mflvkfg.dhfjklgfjklfdgkldfjskldfjskldfjsklgdfjklfd', 13800.00, 18000.00, 50, '[\"/earthauger.jpg\"]', '2026-03-18 10:09:19', '2026-03-27 05:00:54'),
(7341, NULL, 4, 1, 'fertilizers', NULL, 'iffco urea', NULL, '\"Urea fertilizer is a high-nitrogen nutrient source that promotes rapid plant growth, improves crop yield, and strengthens green foliage.\"', 366.00, 370.00, 1000, NULL, '2026-03-27 04:13:05', '2026-03-27 04:13:05'),
(7342, NULL, 7, 1, 'fertilizers', NULL, 'Urea', NULL, 'fresh urea', 370.00, 380.00, 100, NULL, '2026-03-31 06:55:23', '2026-03-31 06:55:23'),
(7343, NULL, 8, 1, 'fertilizers', NULL, 'Urea', NULL, 'fresh urea', 370.00, 380.00, 100, NULL, '2026-03-31 06:59:35', '2026-03-31 06:59:35'),
(7344, NULL, 8, 1, 'fertilizers', NULL, 'Urea', NULL, 'fresh urea', 370.00, 380.00, 100, NULL, '2026-03-31 07:00:53', '2026-03-31 07:00:53'),
(7345, NULL, 5, 1, 'fertilizers', NULL, 'DAP', NULL, 'new dap', 1350.00, 2200.00, 12, NULL, '2026-03-31 07:02:33', '2026-03-31 07:02:33'),
(7346, NULL, 5, 1, 'fertilizers', NULL, 'npk', NULL, 'new stock urea', 370.00, 400.00, 100, NULL, '2026-04-01 06:00:34', '2026-04-01 06:00:34'),
(7347, NULL, 3, 1, NULL, NULL, 'Aries Agripro Micronutrient', NULL, 'new item', 450.00, 500.00, 12, NULL, '2026-04-02 01:56:43', '2026-04-02 01:56:43'),
(7348, NULL, 3, 3, NULL, NULL, 'Aries Agripro Micronutrient  new', NULL, 'new products', 1320.00, 1500.00, 12, NULL, '2026-04-02 02:05:57', '2026-04-02 02:05:57'),
(7349, NULL, 2, 3, NULL, NULL, 'Aries Agripro Micronutrient  new second', NULL, 'new products second new', 1320.00, 1600.00, 12, NULL, '2026-04-02 02:11:31', '2026-04-02 02:11:31'),
(7353, 1, 4, 3, NULL, NULL, 'Aries Agripro Micronutrient', 'aries-agripro-micronutrient', 'new fifth', 1520.00, 1600.00, 30, NULL, '2026-04-02 03:53:42', '2026-04-02 03:53:42'),
(7354, 1, 4, 3, NULL, NULL, 'Aries Agripro Micronutrient', 'aries-agripro-micronutrient', 'new sixth', 1320.00, 1500.00, 20, NULL, '2026-04-02 04:01:50', '2026-04-02 04:01:50'),
(7355, 3, 4, 3, NULL, NULL, 'fame', 'fame', 'new seven insecticides', 2300.00, 2300.00, 10, '\"[\\\"1775474541_potasium.jpg\\\"]\"', '2026-04-02 04:15:18', '2026-04-06 05:52:21'),
(7356, 1, 7, 3, NULL, NULL, 'Aries Agripro Micronutrient', 'aries-agripro-micronutrient', 'new eight', 1200.00, 1600.00, 30, '\"[\\\"1775472731_Tissu_Culture_1.webp\\\"]\"', '2026-04-02 04:20:13', '2026-04-06 05:22:11'),
(7357, 1, 6, 3, NULL, NULL, 'Aries Agripro Micronutrient', 'aries-agripro-micronutrient', 'new nine', 1200.00, 1800.00, 12, '\"[\\\"1775472710_syngenta.jpg\\\"]\"', '2026-04-02 04:21:38', '2026-04-06 05:21:50'),
(7358, 1, 4, 3, NULL, NULL, 'Aries Agripro Micronutrient', 'aries-agripro-micronutrient', 'new ten', 1200.00, 1800.00, 120, '\"[\\\"1775472696_ulala.jpg\\\"]\"', '2026-04-02 04:23:06', '2026-04-06 05:21:36'),
(7359, 1, 4, 3, NULL, NULL, 'Aries Agripro Micronutrient', 'aries-agripro-micronutrient', 'new eleven', 5000.00, 9000.00, 120, '\"[\\\"1775124012_69ce3e2c4e5dc.jpg\\\"]\"', '2026-04-02 04:30:12', '2026-04-02 04:30:12'),
(7360, 1, 4, 3, NULL, NULL, 'Aries Agripro Micronutrient original', 'aries-agripro-micronutrient-original', 'new twelve', 12000.00, 18000.00, 1500, '\"[\\\"1775124341_wheat.jpg\\\"]\"', '2026-04-02 04:35:41', '2026-04-02 04:35:41'),
(7361, 3, 5, 3, NULL, NULL, 'Abic new', 'abic-new', 'new thirteen', 540.00, 560.00, 200, '\"[\\\"1775124500_abic.jpg\\\"]\"', '2026-04-02 04:38:20', '2026-04-02 05:09:30'),
(7362, 2, 3, 1, NULL, NULL, 'Aries Agripro Micronutrient', 'aries-agripro-micronutrient', 'new 16', 1200.00, 1500.00, 12, '\"[\\\"1775200448_wheat.jpg\\\"]\"', '2026-04-03 01:44:08', '2026-04-03 01:44:08'),
(7363, 1, 9, 1, NULL, NULL, 'Aries Agripro Micronutrient  new second', 'aries-agripro-micronutrient-new-second', 'new products second new', 1320.00, 1600.00, 12, '\"[\\\"1775201339_wheat.jpg\\\"]\"', '2026-04-03 01:58:59', '2026-04-03 01:58:59'),
(7365, 7, 3, 1, NULL, NULL, 'Urea (IFFCO Brand) new', 'urea-iffco-brand-new', 'new bag', 350.00, 450.00, 100, '\"[\\\"1775211973_urea.jpg\\\"]\"', '2026-04-03 04:56:13', '2026-04-03 04:56:13'),
(7366, 4, 2, 3, NULL, NULL, 'seeds', 'seeds', 'new seeds', 5200.00, 5600.00, 100, '\"[\\\"1775472376_wheat.jpg\\\"]\"', '2026-04-06 05:16:03', '2026-04-06 05:16:16'),
(7367, 4, 2, 3, NULL, NULL, 'seeds', 'seeds', 'new seeds', 1200.00, 1200.00, 20, '\"[\\\"1775473682_ulala.jpg\\\"]\"', '2026-04-06 05:32:11', '2026-04-06 05:38:02'),
(7368, 3, 10, 3, NULL, NULL, 'Coragen branded', 'coragen-branded', 'new insecticides', 1150.00, 1350.00, 220, '\"[\\\"1775474615_syngenta.jpg\\\",\\\"1775474615_sweep.jpg\\\"]\"', '2026-04-06 05:53:35', '2026-04-06 06:22:04'),
(7369, 3, 10, 1, NULL, NULL, 'coragen new', 'coragen-new', 'new insecticides', 1100.00, 1500.00, 20, '\"[\\\"1775475077_sweep.jpg\\\",\\\"1775475077_sulphate.jpg\\\"]\"', '2026-04-06 06:01:17', '2026-04-06 06:01:17'),
(7370, 3, 10, 1, NULL, NULL, 'coragen second', 'coragen-second', 'new insecticides', 1100.00, 1500.00, 20, '\"[\\\"1775475107_ulala.jpg\\\"]\"', '2026-04-06 06:01:47', '2026-04-06 06:01:47'),
(7371, 1, 9, 1, NULL, NULL, 'Aries Agripro Micronutrient  new second third', 'aries-agripro-micronutrient-new-second-third', 'new products second new', 13200.00, 16000.00, 12, '\"[\\\"1775475286_splash.jpg\\\"]\"', '2026-04-06 06:04:46', '2026-04-06 06:04:46'),
(7373, 2, 7, 7, NULL, NULL, 'Tilt mida', 'tilt-mida', 'new fungicide', 200.00, 450.00, 250, '\"[\\\"1775477086_tatarallis.jpg\\\"]\"', '2026-04-06 06:34:30', '2026-04-06 06:34:46');

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `image_path`, `product_id`, `created_at`, `updated_at`) VALUES
(25, 'products/lDTAJbk6WWTZkT2zJHCCnFgB8XxHfBcItfcLCEoR.jpg', 7341, '2026-03-27 04:13:05', '2026-03-27 04:13:05'),
(27, 'products/3nmTDzbXSaLD3bJWUngRPryIp3Zw8Oa2DsOp79yj.jpg', 62, '2026-03-27 05:01:26', '2026-03-27 05:01:26'),
(28, 'products/jSKYVG0Wk4r1IRUBUcMQ105ptOhCA7KcjqfvUHOz.jpg', 1, '2026-03-27 05:08:04', '2026-03-27 05:08:04'),
(30, 'products/F4NpacXYT0FrZ2ur8zL32LZPOW1Av49lg0fKx1SM.jpg', 1, '2026-03-27 06:30:38', '2026-03-27 06:30:38'),
(31, NULL, 7344, '2026-03-31 07:00:53', '2026-03-31 07:00:53'),
(32, NULL, 7345, '2026-03-31 07:02:33', '2026-03-31 07:02:33'),
(33, NULL, 51, '2026-03-31 07:06:28', '2026-03-31 07:06:28'),
(34, NULL, 1, '2026-04-01 05:46:40', '2026-04-01 05:46:40'),
(35, NULL, 2, '2026-04-01 05:47:15', '2026-04-01 05:47:15'),
(36, NULL, 7346, '2026-04-01 06:00:34', '2026-04-01 06:00:34'),
(37, 'products/f7DsAJbHDMiKQ45PBh18R8dbDhApfhhkk23fa6N5.jpg', 7348, '2026-04-02 02:05:57', '2026-04-02 02:05:57'),
(38, 'products/F2WwWRdcPLWuaaafa6idxEHl4gN5Ulc1qhV8WWTV.jpg', 7349, '2026-04-02 02:11:31', '2026-04-02 02:11:31'),
(39, NULL, 7354, '2026-04-02 04:01:50', '2026-04-02 04:01:50'),
(40, NULL, 7355, '2026-04-02 04:15:18', '2026-04-02 04:15:18'),
(41, NULL, 7358, '2026-04-02 04:23:06', '2026-04-02 04:23:06');

-- --------------------------------------------------------

--
-- Table structure for table `product_reviews`
--

CREATE TABLE `product_reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `rating` tinyint(3) UNSIGNED DEFAULT 5,
  `review` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
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
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('v0Skms199FFWNhu1nw611GdFOTIfHD1AdDxJPYTj', 7, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiVnN5VWdmT0d4dTRXWVZiRXFrb0VocnB3VkV0eVFFU1Y1YkJJZ0NCNiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzU6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9zZWxsZXIvb3JkZXJzIjtzOjU6InJvdXRlIjtzOjE5OiJzZWxsZXIub3JkZXJzLmluZGV4Ijt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6NztzOjQ6ImNhcnQiO2E6MDp7fX0=', 1775477149);

-- --------------------------------------------------------

--
-- Table structure for table `shipping_addresses`
--

CREATE TABLE `shipping_addresses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `pincode` varchar(10) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Dumping data for table `shipping_addresses`
--

INSERT INTO `shipping_addresses` (`id`, `user_id`, `full_name`, `phone`, `email`, `address`, `city`, `state`, `pincode`, `created_at`, `updated_at`) VALUES
(1, 2, 'karan', '9896940144', 'root@gmail.com', 'bnhvgbhngfhfdghf', 'mohali', 'mohali', '125555', NULL, '2026-03-24 09:06:02'),
(2, 2, 'karan', '9896940144', 'root@gmail.com', 'bnhvgbhngfhfdghf', 'mohali', 'punjab', '125555', NULL, '2026-03-24 09:06:08'),
(3, 2, 'karan', '8708110886', 'karan@yopmail.com', '#86 sec 11 panchkula', 'PANCHKULA', 'haryana', '134118', NULL, '2026-03-24 09:06:13'),
(4, 2, 'karan', '8708110886', 'karan@yopmail.com', '#86 sec 11 panchkula', 'PANCHKULA', 'haryana', '134118', '2026-03-23 23:51:34', '2026-03-24 09:06:15'),
(5, 2, 'karan kumar', '8708110886', 'root@gmail.com', '#56 sec 89 mohali', 'mohali', 'punjab', '125555', '2026-03-23 23:51:55', '2026-03-24 09:06:35'),
(6, 2, 'karan', '9896940144', 'root@gmail.com', '#56 sec 89 mohali', 'mohali', 'mohali', '125555', '2026-03-23 23:57:40', '2026-03-24 09:06:18'),
(7, 2, 'karan', '8708110886', 'karan@yopmail.com', '#86 sec 11 panchkula', 'PANCHKULA', 'haryana', '134118', '2026-03-23 23:57:49', '2026-03-24 09:06:22'),
(8, 2, 'karan', '8708110886', 'karan@yopmail.com', '#86 sec 11 panchkula', 'PANCHKULA', 'haryana', '134118', '2026-03-23 23:58:05', '2026-03-24 09:06:24'),
(9, 2, 'karan', '8708110886', 'karan@yopmail.com', '#86 sec 11 panchkula', 'PANCHKULA', 'haryana', '134118', '2026-03-24 00:01:14', '2026-03-24 09:06:27'),
(10, 2, 'karan', '9896940144', 'root@gmail.com', 'bnhvgbhngfhfdghf', 'mohali', 'mohali', '125555', '2026-03-24 00:19:46', '2026-03-24 09:06:30'),
(11, 2, 'raman', '09896940144', 'root@gmail.com', '#56 sec 89 mohali', 'mohali', 'punjab', '125555', '2026-03-24 00:29:20', '2026-03-24 09:06:41'),
(12, 2, 'karan kumar', '08708110886', 'root@gmail.com', '#56 sec 89 mohali', 'mohali', 'mohali', '125555', '2026-03-24 01:19:51', '2026-03-24 09:06:38'),
(13, 2, 'karan', '08708110886', 'karan@yopmail.com', '#86 sec 11 panchkula', 'PANCHKULA', 'haryana', '134118', '2026-03-24 01:24:14', '2026-03-24 09:06:33'),
(14, 2, 'karan singh', '08708110886', 'karan@yopmail.com', '#86 sec 11 panchkula', 'PANCHKULA', 'haryana', '134118', '2026-03-24 01:57:26', '2026-03-24 01:57:26'),
(15, 2, 'Saran kumar', '8708110886', 'root@gmail.com', '#56 sec 89 mohali', 'mohali', 'mohali', '125555', '2026-03-24 03:29:52', '2026-03-24 03:29:52'),
(16, 2, 'karan', '8708110886', 'karan@yopmail.com', '#86 sec 11 panchkula', 'PANCHKULA', 'haryana', '134118', '2026-03-24 04:29:55', '2026-03-24 04:29:55'),
(17, 2, 'Saran kumar', '+448708110886', 'root@gmail.com', '#56 sec 89 mohali', 'mohali', 'mohali', '125555', '2026-03-24 04:37:30', '2026-03-24 04:37:30'),
(18, 2, 'Saran kumar', '+448708110886', 'root@gmail.com', '#56 sec 89 mohali', 'mohali', 'mohali', '125555', '2026-03-24 04:49:38', '2026-03-24 04:49:38'),
(19, 2, 'karan kumar', '+448708110886', 'root@gmail.com', '#56 sec 89 mohali', 'mohali', 'mohali', '125555', '2026-03-24 04:57:47', '2026-03-24 04:57:47'),
(20, 2, 'karan kumar', '+448708110886', 'root@gmail.com', '#56 sec 89 mohali', 'mohali', 'punjab', '171011', '2026-03-24 05:19:36', '2026-03-24 05:19:36'),
(21, 2, 'Saran kumar', '+448708110886', 'root@gmail.com', '#56 sec 89 mohali', 'mohali', 'mohali', '125555', '2026-03-24 05:35:18', '2026-03-24 05:35:18'),
(22, 2, 'karan', '+448708110886', 'karan@yopmail.com', '#86 sec 11 panchkula', 'PANCHKULA', 'haryana', '134118', '2026-03-24 05:40:23', '2026-03-24 05:40:23'),
(23, 2, 'karan', '+448708110886', 'karan@yopmail.com', '#86 sec 11 panchkula', 'PANCHKULA', 'haryana', '134118', '2026-03-24 05:46:02', '2026-03-24 05:46:02'),
(24, 2, 'karan kumar', '+448708110886', 'root@gmail.com', '#56 sec 89 mohali', 'mohali', 'mohali', '125555', '2026-03-24 05:51:17', '2026-03-24 05:51:17'),
(25, 2, 'karan kumar', '+448708110886', 'root@gmail.com', '#56 sec 89 mohali', 'mohali', 'punjab', '171011', '2026-03-24 05:52:43', '2026-03-24 05:52:43'),
(26, 2, 'karan kumar', '+448708110886', 'root@gmail.com', '#56 sec 89 mohali', 'mohali', 'mohali', '125555', '2026-03-24 05:54:39', '2026-03-24 05:54:39'),
(27, 2, 'karan kumar', '+448708110886', 'root@gmail.com', '#56 sec 89 mohali', 'mohali', 'mohali', '125555', '2026-03-24 06:27:37', '2026-03-24 06:27:37'),
(28, 2, 'karan', '+448708110886', 'karan@yopmail.com', '#86 sec 11 panchkula', 'PANCHKULA', 'haryana', '134118', '2026-03-24 06:46:18', '2026-03-24 06:46:18'),
(29, 2, 'sam', '+448708110886', 'karan@yopmail.com', '#86 sec 11 panchkula', 'PANCHKULA', 'haryana', '134118', '2026-03-24 06:58:47', '2026-03-24 06:58:47'),
(30, 2, 'kamal', '+448708110886', 'root@gmail.com', '#56 sec 89 mohali', 'mohali', 'mohali', '125555', '2026-03-24 07:01:51', '2026-03-24 07:01:51'),
(31, 2, 'manish', '+448708110886', 'root@gmail.com', '#56 sec 89 mohali', 'mohali', 'mohali', '125555', '2026-03-24 07:05:21', '2026-03-24 07:05:21'),
(32, 2, 'tarun', '+448708110886', 'karan@yopmail.com', '#86 sec 11 panchkula', 'PANCHKULA', 'haryana', '134118', '2026-03-24 07:11:39', '2026-03-24 07:11:39'),
(33, 2, 'tom deckut', '+448708110886', 'karan@yopmail.com', '#86 sec 11 panchkula', 'PANCHKULA', 'haryana', '134118', '2026-03-24 07:33:43', '2026-03-24 07:33:43'),
(34, 2, 'karan kumari', '+448708110886', 'root@gmail.com', '#56 sec 89 mohali', 'mohali', 'punjab', '171011', '2026-03-24 07:36:38', '2026-03-24 07:36:38'),
(35, 2, 'karan shrama', '+448708110886', 'root@gmail.com', '#56 sec 89 mohali', 'mohali', 'punjab', '171011', '2026-03-24 07:40:22', '2026-03-24 07:40:22'),
(36, 2, 'karan kumar', '+448708110886', 'root@gmail.com', '#56 sec 89 mohali', 'mohali', 'punjab', '171011', '2026-03-24 07:42:43', '2026-03-24 07:42:43'),
(37, 2, 'john deo', '+448708110886', 'root@gmail.com', '#56 sec 89 mohali', 'mohali', 'punjab', '171011', '2026-03-24 07:51:02', '2026-03-24 07:51:02'),
(38, 2, 'karan kumar', '+448708110886', 'root@gmail.com', '#56 sec 89 mohali', 'mohali', 'mohali', '125555', '2026-03-24 07:58:54', '2026-03-24 07:58:54'),
(39, 2, 'samar', '+448708110886', 'root@gmail.com', '#56 sec 89 mohali', 'mohali', 'punjab', '171011', '2026-03-24 23:33:12', '2026-03-24 23:33:12'),
(40, 2, 'karan kumar', '+448708110886', 'root@gmail.com', '#56 sec 89 mohali', 'mohali', 'punjab', '171011', '2026-03-24 23:55:49', '2026-03-24 23:55:49'),
(41, 2, 'sumit', '+448708110886', 'dddd@gmail.com', '#456 vill manaktabra distt panchkula', 'PANCHKULA', 'haryana', '134204', '2026-03-24 23:58:32', '2026-03-24 23:58:32'),
(42, 2, 'sumit', '+448708110886', 'root@gmail.com', '#56 sec 89 mohali', 'mohali', 'mohali', '125555', '2026-03-25 00:01:50', '2026-03-25 00:01:50'),
(43, 2, 'rahul kumar', '+448708110886', 'root@gmail.com', '#56 sec 89 mohali', 'mohali', 'punjab', '171011', '2026-03-25 00:09:08', '2026-03-25 00:09:08'),
(44, 2, 'Saran kumar', '+448708110886', 'root@gmail.com', '#56 sec 89 mohali', 'mohali', 'mohali', '125555', '2026-03-25 00:19:44', '2026-03-25 00:19:44'),
(45, 2, 'karan kumar', '+448708110886', 'root@gmail.com', '#56 sec 89 mohali', 'mohali', 'punjab', '171011', '2026-03-25 00:31:42', '2026-03-25 00:31:42'),
(46, 2, 'malkeet', '+449896940144', 'root@gmail.com', '#56 sec 89 mohali', 'mohali', 'mohali', '125555', '2026-03-25 00:38:13', '2026-03-25 00:38:13'),
(47, 2, 'karan222 kumar', '+448708110886', 'root@gmail.com', '#56 sec 89 mohali', 'mohali', 'punjab', '171011', '2026-03-25 23:52:11', '2026-03-25 23:52:11'),
(48, 2, 'vikram', '+449896940144', 'root@gmail.com', 'pkl', 'mohali', 'punjab', '125555', '2026-03-26 00:18:18', '2026-03-26 00:18:18'),
(49, 2, 'karan', '+448708110886', 'karan@yopmail.com', '#86 sec 11 panchkula', 'PANCHKULA', 'haryana', '134118', '2026-03-26 00:23:57', '2026-03-26 00:23:57'),
(50, 2, 'taran kumar', '+448708110886', 'root@gmail.com', '#56 sec 89 mohali', 'mohali', 'punjab', '171011', '2026-03-26 00:40:29', '2026-03-26 00:40:29'),
(51, 2, 'karan kumar', '+448708110886', 'root@gmail.com', '#56 sec 89 mohali', 'mohali', 'mohali', '125555', '2026-03-26 00:46:31', '2026-03-26 00:46:31'),
(52, 2, 'karan', '+449896940144', 'root@gmail.com', '#56 sec 89 mohali', 'mohali', 'mohali', '125555', '2026-03-26 00:59:59', '2026-03-26 00:59:59'),
(53, 2, 'karan', '+449896940144', 'root@gmail.com', 'bnhvgbhngfhfdghf', 'mohali', 'punjab', '125555', '2026-03-26 01:09:29', '2026-03-26 01:09:29'),
(54, 2, 'karan singh', '+448708110886', 'karan@yopmail.com', '#86 sec 11 panchkula', 'PANCHKULA', 'haryana', '134118', '2026-03-26 01:37:21', '2026-03-26 01:37:21'),
(55, 2, 'karan kumar', '+448708110886', 'root@gmail.com', '#56 sec 89 mohali', 'mohali', 'mohali', '125555', '2026-03-26 01:38:22', '2026-03-26 01:38:22'),
(56, 2, 'karan', '+449896940144', 'root@gmail.com', 'bnhvgbhngfhfdghf', 'mohali', 'punjab', '125555', '2026-03-26 01:45:16', '2026-03-26 01:45:16'),
(57, 2, 'karan kumar', '+448708110886', 'root@gmail.com', '#56 sec 89 mohali', 'mohali', 'punjab', '171011', '2026-03-26 02:00:51', '2026-03-26 02:00:51'),
(58, 2, 'karan kumar', '+448708110886', 'root@gmail.com', '#56 sec 89 mohali', 'mohali', 'punjab', '171011', '2026-03-26 02:33:53', '2026-03-26 02:33:53'),
(59, 2, 'kamal kumar', '+448708110886', 'root@gmail.com', '#56 sec 89 mohali', 'mohali', 'punjab', '171011', '2026-03-26 02:35:58', '2026-03-26 02:35:58'),
(60, 2, 'karan kumar', '+448708110886', 'root@gmail.com', '#56 sec 89 mohali', 'mohali', 'punjab', '171011', '2026-03-26 03:51:23', '2026-03-26 03:51:23'),
(61, 2, 'karan kumar', '+448708110886', 'root@gmail.com', '#56 sec 89 mohali', 'mohali', 'mohali', '125555', '2026-03-26 03:53:19', '2026-03-26 03:53:19'),
(62, 2, 'karan', '+449896940144', 'root@gmail.com', 'bnhvgbhngfhfdghf', 'mohali', 'punjab', '125555', '2026-03-26 03:56:19', '2026-03-26 03:56:19'),
(63, 2, 'karan kumar', '+448708110886', 'root@gmail.com', '#56 sec 89 mohali', 'mohali', 'punjab', '171011', '2026-03-26 04:14:56', '2026-03-26 04:14:56'),
(64, 2, 'karan kumar', '+448708110886', 'root@gmail.com', '#56 sec 89 mohali', 'mohali', 'mohali', '125555', '2026-03-26 04:18:24', '2026-03-26 04:18:24'),
(65, 2, 'karan kumar', '+448708110886', 'root@gmail.com', '#56 sec 89 mohali', 'mohali', 'punjab', '171011', '2026-03-26 04:19:23', '2026-03-26 04:19:23'),
(66, 2, 'karan kumar', '+448708110886', 'root@gmail.com', '#56 sec 89 mohali', 'mohali', 'mohali', '125555', '2026-03-26 04:27:56', '2026-03-26 04:27:56'),
(67, 2, 'karan kumar', '+448708110886', 'root@gmail.com', '#56 sec 89 mohali', 'mohali', 'punjab', '171011', '2026-03-26 04:30:17', '2026-03-26 04:30:17'),
(68, 2, 'karan kumar', '+448708110886', 'root@gmail.com', '#56 sec 89 mohali', 'mohali', 'punjab', '171011', '2026-03-26 04:31:31', '2026-03-26 04:31:31'),
(69, 2, 'karan kumar', '+448708110886', 'root@gmail.com', '#56 sec 89 mohali', 'mohali', 'punjab', '171011', '2026-03-31 03:55:50', '2026-03-31 03:55:50'),
(70, 2, 'karan kumar', '+448708110886', 'root@gmail.com', '#56 sec 89 mohali', 'mohali', 'punjab', '171011', '2026-03-31 03:58:34', '2026-03-31 03:58:34'),
(71, 2, 'Saran kumar', '+448708110886', 'root@gmail.com', '#56 sec 89 mohali', 'mohali', 'mohali', '125555', '2026-03-31 04:15:24', '2026-03-31 04:15:24'),
(72, 2, 'Saran kumar', '+448708110886', 'root@gmail.com', '#56 sec 89 mohali', 'mohali', 'mohali', '125555', '2026-03-31 04:17:21', '2026-03-31 04:17:21'),
(73, 2, 'Saran kumar', '+448708110886', 'root@gmail.com', '#56 sec 89 mohali', 'mohali', 'mohali', '125555', '2026-03-31 04:18:59', '2026-03-31 04:18:59'),
(74, 2, 'karan', '+448708110886', 'karan@yopmail.com', '#86 sec 11 panchkula', 'PANCHKULA', 'haryana', '134118', '2026-03-31 04:23:14', '2026-03-31 04:23:14'),
(75, 2, 'Saran kumar', '+448708110886', 'root@gmail.com', '#56 sec 89 mohali', 'mohali', 'mohali', '125555', '2026-03-31 04:31:06', '2026-03-31 04:31:06'),
(76, 2, 'karan', '+449896940144', 'root@gmail.com', '#56 sec 89 mohali', 'mohali', 'mohali', '125555', '2026-03-31 04:37:47', '2026-03-31 04:37:47'),
(77, 2, 'karan', '+449896940144', 'root@gmail.com', 'bnhvgbhngfhfdghf', 'mohali', 'punjab', '125555', '2026-03-31 04:40:59', '2026-03-31 04:40:59'),
(78, 2, 'karan', '+449896940144', 'root@gmail.com', 'bnhvgbhngfhfdghf', 'mohali', 'punjab', '125555', '2026-03-31 04:48:02', '2026-03-31 04:48:02'),
(79, 2, 'karan', '+448708110886', 'karan@yopmail.com', '#86 sec 11 panchkula', 'PANCHKULA', 'haryana', '134118', '2026-03-31 04:49:50', '2026-03-31 04:49:50'),
(80, 2, 'karan', '+449896940144', 'root@gmail.com', 'bnhvgbhngfhfdghf', 'mohali', 'mohali', '125555', '2026-03-31 04:58:13', '2026-03-31 04:58:13'),
(81, 2, 'karan', '+448708110886', 'karan@yopmail.com', '#86 sec 11 panchkula', 'PANCHKULA', 'haryana', '134118', '2026-03-31 05:02:03', '2026-03-31 05:02:03'),
(82, 2, 'karan kumar', '+448708110886', 'root@gmail.com', '#56 sec 89 mohali', 'mohali', 'punjab', '171011', '2026-03-31 05:22:03', '2026-03-31 05:22:03'),
(83, 2, 'Saran kumar', '+448708110886', 'root@gmail.com', '#56 sec 89 mohali', 'mohali', 'mohali', '125555', '2026-03-31 05:28:26', '2026-03-31 05:28:26'),
(84, 2, 'karan gupta', '+448708110886', 'karan@yopmail.com', '#86 sec 11 panchkula', 'PANCHKULA', 'haryana', '134118', '2026-03-31 05:40:09', '2026-03-31 05:40:09'),
(85, 2, 'karan mittal', '+449896940144', 'root@gmail.com', '#56 sec 89 mohali', 'mohali', 'mohali', '125555', '2026-03-31 05:50:06', '2026-03-31 05:50:06'),
(86, 2, 'Saran goyal', '+448708110886', 'root@gmail.com', '#56 sec 89 mohali', 'mohali', 'mohali', '125555', '2026-03-31 05:56:03', '2026-03-31 05:56:03'),
(87, 2, 'Saran saran', '+448708110886', 'root@gmail.com', '#56 sec 89 mohali', 'mohali', 'mohali', '125555', '2026-03-31 05:58:08', '2026-03-31 05:58:08'),
(88, 2, 'Saran kumar goutam', '+448708110886', 'root@gmail.com', '#56 sec 89 mohali', 'mohali', 'mohali', '125555', '2026-03-31 06:14:28', '2026-03-31 06:14:28'),
(89, 2, 'karan', '+449896940144', 'root@gmail.com', '#56 sec 89 mohali', 'mohali', 'mohali', '125555', '2026-03-31 06:18:41', '2026-03-31 06:18:41'),
(90, 2, 'karan karan', '+449896940144', 'root@gmail.com', '#56 sec 89 mohali', 'mohali', 'mohali', '125555', '2026-03-31 06:19:40', '2026-03-31 06:19:40'),
(91, 2, 'john deo', '+449896940144', 'root@gmail.com', '#56 sec 89 mohali', 'mohali', 'mohali', '125555', '2026-03-31 06:26:47', '2026-03-31 06:26:47'),
(92, 2, 'john deo', '+448708110886', 'john@gmail.com', '#56 sec 89 mohali', 'mohali', 'punjab', '171011', '2026-03-31 23:13:47', '2026-03-31 23:13:47'),
(93, 2, 'karan', '+449896940144', 'root@gmail.com', '#56 sec 89 mohali', 'mohali', 'mohali', '125555', '2026-03-31 23:15:28', '2026-03-31 23:15:28'),
(94, 2, 'karan', '+449896940144', 'root@gmail.com', '#56 sec 89 mohali', 'mohali', 'mohali', '125555', '2026-03-31 23:16:42', '2026-03-31 23:16:42'),
(95, 2, 'ram', '+448708110886', 'karan@yopmail.com', '#86 sec 11 panchkula', 'PANCHKULA', 'haryana', '134118', '2026-03-31 23:18:46', '2026-03-31 23:18:46'),
(96, 2, 'karan kumar', '+448708110886', 'root@gmail.com', '#56 sec 89 mohali', 'mohali', 'punjab', '171011', '2026-04-01 01:01:11', '2026-04-01 01:01:11'),
(97, 2, 'karan', '+448708110886', 'karan@yopmail.com', '#86 sec 11 panchkula', 'PANCHKULA', 'haryana', '134118', '2026-04-01 01:06:02', '2026-04-01 01:06:02'),
(98, 3, 'karan kumar', '+448708110886', 'root@gmail.com', '#56 sec 89 mohali', 'mohali', 'punjab', '171011', '2026-04-01 07:26:19', '2026-04-01 07:26:19'),
(99, 3, 'Saran kumar', '+448708110886', 'root@gmail.com', '#56 sec 89 mohali', 'mohali', 'mohali', '125555', '2026-04-01 07:28:27', '2026-04-01 07:28:27'),
(100, 2, 'karan kumar', '+448708110886', 'root@gmail.com', '#56 sec 89 mohali', 'mohali', 'punjab', '171011', '2026-04-01 23:23:06', '2026-04-01 23:23:06'),
(101, 2, 'karan', '+449896940144', 'root@gmail.com', 'bnhvgbhngfhfdghf', 'mohali', 'punjab', '125555', '2026-04-01 23:24:32', '2026-04-01 23:24:32'),
(102, 1, 'karan', '+449896940144', 'root@gmail.com', 'bnhvgbhngfhfdghf', 'mohali', 'mohali', '125555', '2026-04-03 02:41:23', '2026-04-03 02:41:23'),
(103, 2, 'raman', '+448708110886', 'karan@yopmail.com', '#86 sec 11 panchkula', 'PANCHKULA', 'haryana', '134118', '2026-04-05 23:20:32', '2026-04-05 23:20:32'),
(104, 2, 'raman', '+448708110886', 'root@gmail.com', '#56 sec 89 mohali', 'mohali', 'punjab', '171011', '2026-04-05 23:47:57', '2026-04-05 23:47:57'),
(105, 2, 'karan kumar', '+448708110886', 'root@gmail.com', '#56 sec 89 mohali', 'mohali', 'punjab', '171011', '2026-04-05 23:52:42', '2026-04-05 23:52:42'),
(106, 2, 'Saran kumar', '+448708110886', 'root@gmail.com', '#56 sec 89 mohali', 'mohali', 'mohali', '125555', '2026-04-05 23:57:49', '2026-04-05 23:57:49'),
(107, 2, 'karan', '+449896940144', 'root@gmail.com', '#56 sec 89 mohali', 'mohali', 'mohali', '125555', '2026-04-06 00:00:09', '2026-04-06 00:00:09'),
(108, 2, 'karan', '+449896940144', 'root@gmail.com', '#56 sec 89 mohali', 'mohali', 'mohali', '125555', '2026-04-06 00:01:03', '2026-04-06 00:01:03'),
(109, 2, 'karan', '+449896940144', 'root@gmail.com', '#56 sec 89 mohali', 'mohali', 'mohali', '125555', '2026-04-06 00:06:48', '2026-04-06 00:06:48'),
(110, 2, 'Saran kumar', '+448708110886', 'root@gmail.com', '#56 sec 89 mohali', 'mohali', 'mohali', '125555', '2026-04-06 00:08:20', '2026-04-06 00:08:20'),
(111, 2, 'karan', '+449896940144', 'root@gmail.com', '#56 sec 89 mohali', 'mohali', 'mohali', '125555', '2026-04-06 00:12:16', '2026-04-06 00:12:16'),
(112, 2, 'karan', '+449896940144', 'root@gmail.com', '#56 sec 89 mohali', 'mohali', 'mohali', '125555', '2026-04-06 00:13:05', '2026-04-06 00:13:05'),
(113, 2, 'karan', '+448708110886', 'karan@yopmail.com', '#86 sec 11 panchkula', 'PANCHKULA', 'haryana', '134118', '2026-04-06 00:14:40', '2026-04-06 00:14:40'),
(114, 2, 'Saran kumar', '+448708110886', 'root@gmail.com', '#56 sec 89 mohali', 'mohali', 'mohali', '125555', '2026-04-06 00:17:28', '2026-04-06 00:17:28'),
(115, 2, 'karan kumar', '+448708110886', 'root@gmail.com', '#56 sec 89 mohali', 'mohali', 'punjab', '171011', '2026-04-06 00:21:00', '2026-04-06 00:21:00'),
(116, 2, 'Saran kumar', '+448708110886', 'root@gmail.com', '#56 sec 89 mohali', 'mohali', 'mohali', '125555', '2026-04-06 00:21:50', '2026-04-06 00:21:50'),
(117, 2, 'karan', '+448708110886', 'karan@yopmail.com', '#86 sec 11 panchkula', 'PANCHKULA', 'haryana', '134118', '2026-04-06 00:31:40', '2026-04-06 00:31:40'),
(118, 2, 'karan', '+449896940144', 'root@gmail.com', '#56 sec 89 mohali', 'mohali', 'mohali', '125555', '2026-04-06 00:32:30', '2026-04-06 00:32:30'),
(119, 2, 'karan', '+449896940144', 'root@gmail.com', '#56 sec 89 mohali', 'mohali', 'mohali', '125555', '2026-04-06 00:33:10', '2026-04-06 00:33:10'),
(120, 2, 'karan', '+449896940144', 'root@gmail.com', '#56 sec 89 mohali', 'mohali', 'mohali', '125555', '2026-04-06 00:34:02', '2026-04-06 00:34:02'),
(121, 2, 'karan', '+449896940144', 'root@gmail.com', '#56 sec 89 mohali', 'mohali', 'mohali', '125555', '2026-04-06 00:35:20', '2026-04-06 00:35:20'),
(122, 2, 'karan', '+448708110886', 'karan@yopmail.com', '#86 sec 11 panchkula', 'PANCHKULA', 'haryana', '134118', '2026-04-06 00:36:07', '2026-04-06 00:36:07'),
(123, 2, 'karan', '+448708110886', 'karan@yopmail.com', '#86 sec 11 panchkula', 'PANCHKULA', 'haryana', '134118', '2026-04-06 00:47:11', '2026-04-06 00:47:11'),
(124, 2, 'karan', '+449896940144', 'root@gmail.com', '#56 sec 89 mohali', 'mohali', 'mohali', '125555', '2026-04-06 00:51:37', '2026-04-06 00:51:37'),
(125, 2, 'karan', '+448708110886', 'karan@yopmail.com', '#86 sec 11 panchkula', 'PANCHKULA', 'haryana', '134118', '2026-04-06 00:54:56', '2026-04-06 00:54:56'),
(126, 2, 'karan', '+449896940144', 'root@gmail.com', '#56 sec 89 mohali', 'mohali', 'mohali', '125555', '2026-04-06 00:58:46', '2026-04-06 00:58:46'),
(127, 2, 'karan', '+449896940144', 'root@gmail.com', 'bnhvgbhngfhfdghf', 'mohali', 'punjab', '125555', '2026-04-06 01:03:05', '2026-04-06 01:03:05'),
(128, 2, 'karan kumar', '+448708110886', 'root@gmail.com', '#56 sec 89 mohali', 'mohali', 'punjab', '171011', '2026-04-06 01:05:34', '2026-04-06 01:05:34'),
(129, 2, 'Saran kumar', '+448708110886', 'root@gmail.com', '#56 sec 89 mohali', 'mohali', 'mohali', '125555', '2026-04-06 01:07:29', '2026-04-06 01:07:29'),
(130, 2, 'karan', '+449896940144', 'root@gmail.com', '#56 sec 89 mohali', 'mohali', 'mohali', '125555', '2026-04-06 01:18:38', '2026-04-06 01:18:38'),
(131, 2, 'karan', '+449896940144', 'root@gmail.com', '#56 sec 89 mohali', 'mohali', 'mohali', '125555', '2026-04-06 01:54:03', '2026-04-06 01:54:03'),
(132, 2, 'karan', '+448708110886', 'karan@yopmail.com', '#86 sec 11 panchkula', 'PANCHKULA', 'haryana', '134118', '2026-04-06 02:01:32', '2026-04-06 02:01:32'),
(133, 2, 'karan kumar', '+448708110886', 'root@gmail.com', '#56 sec 89 mohali', 'mohali', 'punjab', '171011', '2026-04-06 04:06:14', '2026-04-06 04:06:14'),
(134, 2, 'raman', '+449896940144', 'root@gmail.com', '#56 sec 89 mohali', 'mohali', 'punjab', '125555', '2026-04-06 04:08:54', '2026-04-06 04:08:54'),
(135, 2, 'karan', '+449896940144', 'root@gmail.com', '#56 sec 89 mohali', 'mohali', 'mohali', '125555', '2026-04-06 04:11:17', '2026-04-06 04:11:17'),
(136, 2, 'karan kumar', '+448708110886', 'root@gmail.com', '#56 sec 89 mohali', 'mohali', 'punjab', '171011', '2026-04-06 04:13:18', '2026-04-06 04:13:18'),
(137, 2, 'karan kumar', '+448708110886', 'root@gmail.com', '#56 sec 89 mohali', 'mohali', 'punjab', '171011', '2026-04-06 04:14:43', '2026-04-06 04:14:43'),
(138, 2, 'karan kumar', '+448708110886', 'root@gmail.com', '#56 sec 89 mohali', 'mohali', 'punjab', '171011', '2026-04-06 04:15:42', '2026-04-06 04:15:42'),
(139, 2, 'karan', '+448708110886', 'karan@yopmail.com', '#86 sec 11 panchkula', 'PANCHKULA', 'haryana', '134118', '2026-04-06 04:16:25', '2026-04-06 04:16:25'),
(140, 6, 'karan', '+449896940144', 'root@gmail.com', '#56 sec 89 mohali', 'mohali', 'mohali', '125555', '2026-04-06 06:31:37', '2026-04-06 06:31:37');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` varchar(20) NOT NULL DEFAULT 'users',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `role`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Bittu Kumar', 'root@yopmail.com', 'admin', NULL, '$2y$12$5pM8JVRjoZJhtUKKX8wX7eoiuQuWdn.JJxK/fAg7eQ00NgNFH9hyq', NULL, '2026-03-12 04:54:05', '2026-03-12 04:54:05'),
(2, 'karan singh maan', 'root1@yopmail.com', 'buyer', NULL, '$2y$12$.TlE8PFZGr2k4efKo1xY9.Qc5Ya1urIBVL.9bOqOGO/kV42Fr1V4y', NULL, '2026-03-12 04:56:11', '2026-04-06 04:56:10'),
(3, 'ramesh kumar', 'root2@yopmail.com', 'seller', NULL, '$2y$12$.0tGG34xXxf58z5/dqwpzOiqJu3BJNC5D8KlpRpv2/4VaGRHgYMEa', NULL, '2026-03-12 04:57:13', '2026-03-12 04:57:13'),
(6, 'Amit kumar', 'root3@yopmail.com', 'buyer', NULL, '$2y$12$UUe5ws5mWvCl.zdA9YO./e0L3o5yw9rpmeYK3JYTxtg6UbSncFpAy', NULL, '2026-04-06 06:29:59', '2026-04-06 06:29:59'),
(7, 'sumit', 'root4@yopmail.com', 'seller', NULL, '$2y$12$.arDePylmygtVawS/aLA5.rWPkv2Lddz.b4yNvKJSsgPo2OyP4M5O', NULL, '2026-04-06 06:32:33', '2026-04-06 06:32:33');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_order_id` (`order_id`),
  ADD KEY `idx_user_id` (`user_id`),
  ADD KEY `idx_shipping_id` (`shipping_id`),
  ADD KEY `fk_orders_seller` (`seller_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `order_product`
--
ALTER TABLE `order_product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_product_order_id_foreign` (`order_id`),
  ADD KEY `order_product_product_id_foreign` (`product_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_seller_id_foreign` (`seller_id`),
  ADD KEY `products_category_id_foreign` (`category_id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `product_reviews`
--
ALTER TABLE `product_reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `shipping_addresses`
--
ALTER TABLE `shipping_addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_shipping_user` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_product`
--
ALTER TABLE `order_product`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7374;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `product_reviews`
--
ALTER TABLE `product_reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shipping_addresses`
--
ALTER TABLE `shipping_addresses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=141;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk_orders_seller` FOREIGN KEY (`seller_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_orders_shipping` FOREIGN KEY (`shipping_id`) REFERENCES `shipping_addresses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `order_product`
--
ALTER TABLE `order_product`
  ADD CONSTRAINT `order_product_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_product_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `products_seller_id_foreign` FOREIGN KEY (`seller_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `product_images_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_reviews`
--
ALTER TABLE `product_reviews`
  ADD CONSTRAINT `product_reviews_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_reviews_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `shipping_addresses`
--
ALTER TABLE `shipping_addresses`
  ADD CONSTRAINT `fk_shipping_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `shipping_addresses` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `shipping_addresses_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `shipping_addresses` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
