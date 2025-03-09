-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 17, 2024 at 01:27 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `datn`
--

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `banner_img` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `batterys`
--

CREATE TABLE `batterys` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `capacity` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `batterys`
--

INSERT INTO `batterys` (`id`, `name`, `price`, `capacity`, `created_at`, `updated_at`) VALUES
(1, 'Pin chính hãng Apple', '0.00', '4.422mAh', '2024-09-23 19:45:46', '2024-12-08 08:54:05'),
(3, 'Pin Pisen', '0.00', '3380.mAh', '2024-12-08 08:52:36', '2024-12-08 08:53:07'),
(4, 'Pin Remax', '0.00', '3510.mAh', '2024-12-08 08:53:39', '2024-12-08 08:54:18'),
(5, 'M34', '0.00', '6000.mAh', '2024-12-08 08:55:47', '2024-12-08 08:55:47'),
(6, 'Pin A24', '0.00', '5000.mAh', '2024-12-08 08:57:02', '2024-12-08 08:57:02');

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `created_at`, `updated_at`, `user_id`) VALUES
(11, '2024-10-04 11:15:03', '2024-10-20 11:15:03', 11),
(13, '2024-10-01 20:09:18', '2024-11-13 09:26:31', 12),
(15, '2024-10-24 01:23:21', '2024-10-24 01:23:21', 15),
(16, '2024-10-29 01:23:24', '2024-10-29 01:23:34', 16),
(17, '2024-11-20 04:32:58', '2024-11-20 04:32:58', 17),
(18, '2024-12-16 02:33:44', '2024-12-16 02:33:44', 27);

-- --------------------------------------------------------

--
-- Table structure for table `cart_items`
--

CREATE TABLE `cart_items` (
  `id` bigint UNSIGNED NOT NULL,
  `cart_id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `battery_id` bigint UNSIGNED DEFAULT NULL,
  `variant_id` bigint UNSIGNED DEFAULT NULL,
  `color_id` bigint UNSIGNED NOT NULL,
  `quantity` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cart_items`
--

INSERT INTO `cart_items` (`id`, `cart_id`, `product_id`, `battery_id`, `variant_id`, `color_id`, `quantity`, `created_at`, `updated_at`) VALUES
(109, 18, 8, NULL, 6, 2, 2, '2024-12-16 02:38:30', '2024-12-16 02:38:30'),
(111, 13, 18, NULL, NULL, 13, 3, '2024-12-17 09:27:44', '2024-12-17 09:28:24');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(4, 'Điện thoại', '2024-09-22 20:07:27', '2024-09-22 20:07:27'),
(5, 'Tai nghe', '2024-09-22 20:07:46', '2024-09-22 20:07:46'),
(7, 'Sạc dự phòng', '2024-12-08 06:55:43', '2024-12-08 06:55:43');

-- --------------------------------------------------------

--
-- Table structure for table `colours`
--

CREATE TABLE `colours` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `quantity` int NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `colours`
--

INSERT INTO `colours` (`id`, `name`, `price`, `created_at`, `updated_at`, `quantity`, `product_id`) VALUES
(1, 'Xanh lá cây', '1500000.00', '2024-09-23 19:52:23', '2024-10-07 04:05:20', 12, 8),
(2, 'Xanh Dương', '1000000.00', '2024-10-01 19:49:08', '2024-12-17 09:47:27', 5, 8),
(3, 'Ánh Sao', '5000000.00', '2024-10-01 19:49:19', '2024-10-01 19:49:19', 0, 8),
(4, 'Đêm Xanh Thẳm', '3000000.00', '2024-10-01 19:49:29', '2024-10-01 19:49:29', 0, 8),
(5, 'Đen tím', '2500000.00', '2024-10-01 19:49:50', '2024-10-01 19:49:50', 0, 8),
(6, 'Đen', '0.00', '2024-10-02 20:55:09', '2024-12-06 12:35:26', 19, 8),
(7, 'Vàng', '2000000.00', '2024-10-02 20:55:14', '2024-10-02 20:55:14', 0, 8),
(8, 'Hồng', '100000.00', '2024-10-02 20:55:24', '2024-12-06 03:48:37', 31, 8),
(9, 'Xanh lam', '15000.00', '2024-10-07 04:36:16', '2024-10-07 04:36:16', 25, 8),
(12, 'Trắng', '120000.00', '2024-10-19 21:04:39', '2024-12-06 03:46:09', 8, 18),
(13, 'Đen', '0.00', '2024-10-19 21:05:02', '2024-12-06 12:38:42', 3, 18),
(14, 'Vàng', '120000.00', '2024-10-22 06:58:07', '2024-10-22 06:58:07', 11, 18),
(15, 'Màu xanh', '120000.00', '2024-12-06 05:17:40', '2024-12-08 06:10:19', 9, 19),
(16, 'màu đen', '120000.00', '2024-12-06 05:19:13', '2024-12-06 05:19:13', 11, 19),
(17, 'màu đen', '120000.00', '2024-12-08 07:00:59', '2024-12-12 08:04:14', 10, 20),
(18, 'trắng', '120000.00', '2024-12-08 07:01:15', '2024-12-08 07:01:15', 12, 20),
(19, 'màu đen', '0.00', '2024-12-08 14:13:06', '2024-12-08 14:13:06', 20, 21),
(20, 'màu hồng', '100000.00', '2024-12-08 14:14:05', '2024-12-08 14:14:05', 100, 21),
(22, 'màu trắng', '0.00', '2024-12-08 14:22:13', '2024-12-08 14:22:13', 20, 22),
(23, 'màu trắng', '0.00', '2024-12-08 14:41:56', '2024-12-08 14:41:56', 20, 23),
(24, 'màu đen', '0.00', '2024-12-08 14:44:08', '2024-12-08 14:44:08', 23, 24),
(25, 'màu trắng', '0.00', '2024-12-08 14:46:25', '2024-12-08 14:46:25', 20, 25),
(26, 'màu đen', '0.00', '2024-12-08 14:51:57', '2024-12-08 14:51:57', 20, 26),
(27, 'màu đen', '0.00', '2024-12-10 12:56:34', '2024-12-10 12:56:34', 13, 27),
(28, 'màu trắng', '0.00', '2024-12-10 12:57:06', '2024-12-10 12:57:06', 21, 27),
(29, 'màu xanh', '0.00', '2024-12-10 13:00:59', '2024-12-10 13:00:59', 50, 28),
(30, 'màu xanh', '0.00', '2024-12-10 13:28:51', '2024-12-10 13:28:51', 10, 29),
(31, 'màu đen', '0.00', '2024-12-10 13:34:29', '2024-12-10 13:34:29', 10, 30),
(32, 'màu đen', '0.00', '2024-12-10 13:34:41', '2024-12-10 13:34:41', 10, 31),
(34, 'màu đen', '0.00', '2024-12-10 13:41:47', '2024-12-10 13:41:47', 10, 32),
(35, 'màu trắng', '0.00', '2024-12-10 13:42:00', '2024-12-10 13:42:00', 20, 33),
(36, 'màu đen', '0.00', '2024-12-10 13:59:09', '2024-12-10 13:59:09', 10, 32),
(37, 'màu trắng', '0.00', '2024-12-10 14:01:08', '2024-12-10 14:01:08', 10, 34),
(38, 'màu đen', '0.00', '2024-12-10 14:01:19', '2024-12-10 14:01:19', 10, 35),
(39, 'màu đen', '0.00', '2024-12-10 14:18:25', '2024-12-10 14:18:25', 10, 36),
(40, 'màu trắng', '0.00', '2024-12-10 14:18:35', '2024-12-10 14:18:35', 10, 37),
(41, 'màu đỏ', '0.00', '2024-12-10 14:18:48', '2024-12-10 14:18:48', 20, 38),
(42, 'màu trắng', '0.00', '2024-12-10 14:30:30', '2024-12-10 14:30:30', 10, 39),
(43, 'màu trắng', '0.00', '2024-12-10 14:30:47', '2024-12-10 14:30:47', 10, 40),
(44, 'màu trắng', '0.00', '2024-12-10 14:31:03', '2024-12-10 14:31:03', 10, 41),
(45, 'màu trắng', '0.00', '2024-12-10 14:31:21', '2024-12-10 14:31:21', 10, 42),
(46, 'màu trắng', '0.00', '2024-12-10 14:42:52', '2024-12-10 14:42:52', 10, 43),
(47, 'màu đen', '0.00', '2024-12-10 14:43:07', '2024-12-10 14:43:07', 10, 44),
(48, 'màu trắng', '0.00', '2024-12-10 14:48:10', '2024-12-10 14:48:10', 2, 10),
(49, 'màu xanh', '100000.00', '2024-12-10 14:49:10', '2024-12-10 14:49:10', 2, 10),
(50, 'màu đỏ', '200000.00', '2024-12-10 14:49:23', '2024-12-10 14:49:23', 3, 10),
(51, 'màu đen', '0.00', '2024-12-10 14:51:10', '2024-12-10 14:51:10', 10, 10),
(52, 'Đen', '120000.00', '2024-12-12 08:01:58', '2024-12-12 08:12:19', 16, 45),
(53, 'Vàng', '250000.00', '2024-12-12 08:02:11', '2024-12-12 08:04:55', 19, 45),
(55, 'Đen', '0.00', '2024-12-17 12:59:01', '2024-12-17 12:59:01', 20, 12),
(56, 'Trắng', '100000.00', '2024-12-17 12:59:17', '2024-12-17 12:59:17', 20, 12);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` bigint UNSIGNED NOT NULL,
  `post_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `discount_codes`
--

CREATE TABLE `discount_codes` (
  `id` bigint UNSIGNED NOT NULL,
  `code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `percentage` decimal(5,2) DEFAULT NULL,
  `product_id` bigint UNSIGNED DEFAULT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `usage_limit` int DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `discount_codes`
--

INSERT INTO `discount_codes` (`id`, `code`, `amount`, `percentage`, `product_id`, `user_id`, `usage_limit`, `start_date`, `end_date`, `created_at`, `updated_at`) VALUES
(27, 'polytechsale50k', '50000.00', NULL, NULL, NULL, 27, '2024-12-17', '2025-01-05', '2024-10-22 20:45:35', '2024-12-17 09:29:20'),
(28, 'EWI98NE', NULL, '5.00', NULL, NULL, 84, '2024-10-22', '2026-01-31', '2024-10-22 23:00:12', '2024-12-06 04:00:36'),
(29, '12345', NULL, '20.00', NULL, NULL, 20, '2024-12-19', '2024-12-15', '2024-12-12 08:06:50', '2024-12-12 08:06:50'),
(30, '123456', NULL, '19.00', NULL, NULL, 20, '2024-12-16', '2024-12-28', '2024-12-12 08:07:15', '2024-12-12 08:07:15');

-- --------------------------------------------------------

--
-- Table structure for table `discount_code_product`
--

CREATE TABLE `discount_code_product` (
  `id` bigint UNSIGNED NOT NULL,
  `discount_code_id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `discount_code_product`
--

INSERT INTO `discount_code_product` (`id`, `discount_code_id`, `product_id`, `created_at`, `updated_at`) VALUES
(19, 29, 22, NULL, NULL),
(20, 30, 45, NULL, NULL),
(23, 27, 8, NULL, NULL),
(24, 27, 10, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `type` enum('import','export') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `session_id` bigint UNSIGNED DEFAULT NULL,
  `message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `from_admin` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `user_id`, `session_id`, `message`, `from_admin`, `created_at`, `updated_at`, `is_read`) VALUES
(838, 12, 242, '1234', 0, '2024-12-17 09:36:09', '2024-12-17 09:36:40', 1),
(839, NULL, 243, 'hi', 0, '2024-12-17 09:36:17', '2024-12-17 09:36:42', 1);

-- --------------------------------------------------------

--
-- Table structure for table `message_media`
--

CREATE TABLE `message_media` (
  `id` bigint UNSIGNED NOT NULL,
  `message_id` bigint UNSIGNED NOT NULL,
  `media_path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `media_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(2, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2024_09_09_025729_create_roles_table', 1),
(5, '2024_09_09_031354_create_users_table', 1),
(6, '2024_09_09_031740_create_orders_table', 1),
(7, '2024_09_18_020234_create_suppliers_table', 2),
(8, '2024_09_18_030624_create_variants_table', 2),
(9, '2024_09_18_044846_create_banners_table', 2),
(10, '2024_09_18_055321_create_categories_table', 3),
(11, '2024_09_18_055421_create_products_table', 3),
(12, '2024_09_18_055519_create_order_items_table', 3),
(13, '2024_09_18_055632_create_inventory_table', 3),
(20, '2024_11_06_161153_create_ratings_table', 7),
(21, '2024_11_06_161200_create_comments_table', 7),
(22, '2024_11_06_164956_reviews', 8),
(39, '2019_12_14_000001_create_personal_access_tokens_table', 9),
(40, '2024_11_06_170618_create_reviews_table', 10),
(50, '2024_11_06_172347_create_cart_items_table', 11),
(51, '2024_11_06_172525_add_total_after_discount_to_carts_table', 11),
(52, '2024_11_06_181733_add_total_after_discount_to_orders_table', 11),
(53, '2024_11_06_192927_create_reviews_table', 12),
(54, '2024_11_27_180650_add_shipping_fee_and_grand_total_to_orders_table', 13),
(59, '2024_11_27_224121_create_posts_table', 14),
(60, '2024_11_28_050713_create_comments_table', 14),
(61, '2024_11_28_230711_create_wishlists_table', 15);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `total_price` decimal(20,0) NOT NULL,
  `province` varchar(255) NOT NULL,
  `district` varchar(255) NOT NULL,
  `ward` varchar(255) NOT NULL,
  `detail_address` varchar(255) NOT NULL,
  `status` enum('pending','confirmed','completed','canceled','delivering') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'pending',
  `cancel_reason` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `phone` varchar(15) NOT NULL,
  `payment_method` enum('cash','online') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'cash',
  `transaction_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `total_after_discount` decimal(20,2) DEFAULT NULL,
  `shipping_fee` int NOT NULL DEFAULT '0',
  `discount_code` varchar(255) DEFAULT NULL,
  `discount_amount` decimal(10,2) DEFAULT '0.00',
  `discount_percentage` decimal(5,2) DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `total_price`, `province`, `district`, `ward`, `detail_address`, `status`, `cancel_reason`, `created_at`, `updated_at`, `phone`, `payment_method`, `transaction_id`, `total_after_discount`, `shipping_fee`, `discount_code`, `discount_amount`, `discount_percentage`) VALUES
(111, 12, '42999000', 'Tỉnh Thái Bình', 'Huyện Quỳnh Phụ', 'Xã An Vinh', 'An vinh', 'completed', NULL, '2024-12-03 13:53:10', '2024-12-03 13:54:17', '0921599602', 'cash', NULL, '43054000.00', 55000, NULL, NULL, NULL),
(112, 12, '42999000', 'Tỉnh Hà Nam', 'Huyện Bình Lục', 'Xã Đồng Du', 'aaaaa', 'confirmed', NULL, '2024-12-04 15:38:24', '2024-12-05 07:29:05', '0123466987', 'cash', NULL, '43029000.00', 30000, NULL, NULL, NULL),
(113, 12, '42999000', 'Tỉnh Hà Nam', 'Huyện Bình Lục', 'Xã Đồn Xá', 'aaaaaa', 'canceled', 'Thay đổi ý định', '2024-12-04 15:40:49', '2024-12-05 07:28:20', '0988144480', 'cash', NULL, '43029000.00', 30000, NULL, NULL, NULL),
(114, 12, '42999000', 'Tỉnh An Giang', 'Huyện Châu Phú', 'Xã Bình Chánh', 'Thái bình', 'canceled', 'Thay đổi ý định', '2024-12-04 15:41:46', '2024-12-04 15:44:22', '0123466987', 'cash', NULL, '43054000.00', 55000, NULL, NULL, NULL),
(115, 12, '42999000', 'Tỉnh An Giang', 'Huyện Châu Phú', 'Xã Bình Long', 'Thái bình', 'pending', NULL, '2024-12-05 08:24:07', '2024-12-05 08:24:07', '0123466987', 'cash', NULL, '43054000.00', 55000, NULL, NULL, NULL),
(116, 12, '48119000', 'Tỉnh Hà Nam', 'Huyện Bình Lục', 'Xã Đồng Du', 'fsfsfs', 'canceled', 'Thay đổi ý định', '2024-12-05 08:25:51', '2024-12-05 08:26:20', '0123466987', 'cash', NULL, '45713050.00', 30000, 'EWI98NE', '2405950.00', '5.00'),
(117, 12, '42999000', 'Tỉnh Thái Bình', 'Huyện Quỳnh Phụ', 'Xã An Ấp', 'long aaaaaa', 'pending', NULL, '2024-12-05 08:36:15', '2024-12-05 09:58:35', '0988144480', 'cash', NULL, '40849050.00', 55000, 'EWI98NE', '2149950.00', '5.00'),
(118, 12, '42999000', 'Tỉnh Hà Nam', 'Huyện Bình Lục', 'Xã Đồn Xá', 'aaaaa', 'canceled', 'Thay đổi ý định', '2024-12-05 08:36:51', '2024-12-05 08:37:19', '0988144480', 'cash', NULL, '43029000.00', 30000, NULL, NULL, NULL),
(119, 12, '90998000', 'Tỉnh Gia Lai', 'Huyện Đăk Pơ', 'Xã An Thành', 'Thái bình', 'canceled', 'Thay đổi ý định', '2024-12-05 09:57:54', '2024-12-05 09:58:22', '0822086666', 'cash', NULL, '86448100.00', 55000, 'EWI98NE', '4549900.00', '5.00'),
(120, 12, '42999000', 'Tỉnh Gia Lai', 'Huyện Đăk Đoa', 'Xã Trang', 'Thái bình', 'canceled', NULL, '2024-12-05 10:19:32', '2024-12-05 10:26:17', '0822086666', 'cash', NULL, '40849050.00', 55000, 'EWI98NE', '2149950.00', '5.00'),
(121, NULL, '12040000', '02', '028', '00820', 'Thái bình', 'confirmed', NULL, '2024-12-05 10:25:04', '2024-12-05 10:25:04', '0123466987', 'cash', NULL, NULL, 40000, NULL, '0.00', '0.00'),
(122, NULL, '24040000', '02', '028', '00823', 'Thái bình', 'confirmed', NULL, '2024-12-05 10:25:27', '2024-12-05 10:25:27', '0123466987', 'cash', NULL, NULL, 40000, NULL, '0.00', '0.00'),
(124, 12, '42999000', 'Tỉnh Gia Lai', 'Huyện Đăk Đoa', 'Thị trấn Đăk Đoa', 'fsfsfs', 'completed', NULL, '2024-12-05 11:06:05', '2024-12-05 11:08:08', '0123466987', 'cash', NULL, '40849050.00', 55000, 'EWI98NE', '2149950.00', '5.00'),
(126, 12, '42999000', 'Tỉnh Bà Rịa - Vũng Tàu', 'Thành phố Bà Rịa', 'Xã Hoà Long', 'fsfsfs', 'completed', NULL, '2024-12-05 11:10:10', '2024-12-05 11:10:37', '0123466987', 'cash', NULL, '43079000.00', 80000, NULL, NULL, NULL),
(127, 12, '42999000', 'Tỉnh Hà Nam', 'Huyện Bình Lục', 'Xã Đồng Du', 'fsfsfs', 'pending', NULL, '2024-12-05 11:14:45', '2024-12-05 11:14:45', '0822086666', 'cash', NULL, '43029000.00', 30000, NULL, NULL, NULL),
(128, 12, '5000000', 'Tỉnh Bắc Kạn', 'Huyện Ba Bể', 'Xã Bành Trạch', 'aaaa', 'pending', NULL, '2024-12-05 11:15:12', '2024-12-05 11:24:32', '0988144480', 'cash', NULL, '5030000.00', 55000, NULL, NULL, NULL),
(129, 12, '42999000', 'Tỉnh Thái Bình', 'Huyện Quỳnh Phụ', 'Xã An Ấp', 'long dz', 'pending', NULL, '2024-12-05 11:27:37', '2024-12-05 11:28:18', '0988144480', 'cash', NULL, '43054000.00', 55000, NULL, NULL, NULL),
(130, 12, '90998000', 'Tỉnh An Giang', 'Huyện An Phú', 'Thị trấn An Phú', 'fsfsfs', 'delivering', NULL, '2024-12-05 11:58:47', '2024-12-05 15:20:43', '0988144480', 'cash', NULL, '91053000.00', 55000, NULL, NULL, NULL),
(131, 12, '85998000', 'Tỉnh Bà Rịa - Vũng Tàu', 'Huyện Châu Đức', 'Xã Bàu Chinh', 'fsfsfs', 'completed', NULL, '2024-12-05 15:11:24', '2024-12-05 15:11:55', '0988144480', 'cash', NULL, '86078000.00', 80000, NULL, NULL, NULL),
(132, 12, '42999000', 'Tỉnh An Giang', 'Huyện An Phú', 'Thị trấn An Phú', 'Thái bình', 'completed', NULL, '2024-12-05 15:21:30', '2024-12-05 15:22:31', '0123466987', 'cash', NULL, '43054000.00', 55000, NULL, NULL, NULL),
(133, 12, '5000000', 'Tỉnh An Giang', 'Huyện An Phú', 'Thị trấn An Phú', 'Thái bình', 'pending', NULL, '2024-12-05 15:50:16', '2024-12-05 15:50:16', '0988144480', 'cash', NULL, '4750000.00', 55000, 'EWI98NE', '250000.00', '5.00'),
(134, 12, '42999000', 'Tỉnh An Giang', 'Huyện An Phú', 'Thị trấn An Phú', 'Thái bình', 'pending', NULL, '2024-12-05 15:55:53', '2024-12-05 15:55:53', '0123466987', 'cash', NULL, '43054000.00', 55000, NULL, NULL, NULL),
(135, 12, '42999000', 'Thành phố Hải Phòng', 'Quận Đồ Sơn', 'Phường Bàng La', 'Thái bình', 'pending', NULL, '2024-12-05 15:58:09', '2024-12-05 15:58:09', '0822086992', 'cash', NULL, '43054000.00', 55000, NULL, NULL, NULL),
(136, 12, '48119000', 'Tỉnh An Giang', 'Huyện Châu Phú', 'Xã Bình Long', 'Thái bình', 'pending', NULL, '2024-12-05 16:22:55', '2024-12-05 16:22:55', '0123466987', 'cash', NULL, '48174000.00', 55000, NULL, NULL, NULL),
(137, 12, '85998000', 'Tỉnh An Giang', 'Huyện An Phú', 'Thị trấn An Phú', 'Thái bình', 'pending', NULL, '2024-12-05 16:27:30', '2024-12-05 16:27:30', '0123466987', 'cash', NULL, '86053000.00', 55000, NULL, NULL, NULL),
(138, 12, '48119000', 'Tỉnh An Giang', 'Huyện An Phú', 'Thị trấn An Phú', 'Thái bình', 'pending', NULL, '2024-12-05 16:28:58', '2024-12-05 16:28:58', '0988144480', 'cash', NULL, '45713050.00', 55000, 'EWI98NE', '2405950.00', '5.00'),
(139, 12, '42999000', 'Tỉnh Bà Rịa - Vũng Tàu', 'Huyện Châu Đức', 'Xã Bình Giã', '213', 'pending', NULL, '2024-12-06 03:01:27', '2024-12-06 03:01:27', '0822086992', 'online', '14724178', '40929050.00', 80000, 'EWI98NE', '2149950.00', '5.00'),
(140, 12, '42999000', 'Tỉnh Bà Rịa - Vũng Tàu', 'Huyện Châu Đức', 'Xã Bình Ba', '213', 'pending', NULL, '2024-12-06 03:03:49', '2024-12-06 03:03:49', '0822086992', 'cash', NULL, '40929050.00', 80000, 'EWI98NE', '2149950.00', '5.00'),
(141, 12, '42999000', 'Tỉnh Bà Rịa - Vũng Tàu', 'Huyện Châu Đức', 'Xã Bình Ba', '123123', 'pending', NULL, '2024-12-06 03:08:04', '2024-12-06 03:08:04', '0822086992', 'cash', NULL, '41009050.00', 80000, 'EWI98NE', '2149950.00', '5.00'),
(142, 12, '42999000', 'Tỉnh Bà Rịa - Vũng Tàu', 'Thị xã Phú Mỹ', 'Phường Phú Mỹ', '123123', 'pending', NULL, '2024-12-06 03:09:14', '2024-12-06 03:09:14', '0822086992', 'cash', NULL, '41009050.00', 80000, 'EWI98NE', '2149950.00', '5.00'),
(143, 12, '42999000', 'Tỉnh Bà Rịa - Vũng Tàu', 'Huyện Long Điền', 'Thị trấn Long Hải', '213', 'pending', NULL, '2024-12-06 03:18:14', '2024-12-06 03:18:14', '0822086992', 'cash', NULL, '40929050.00', 80000, 'EWI98NE', '2149950.00', '5.00'),
(144, 12, '42999000', 'Tỉnh Bà Rịa - Vũng Tàu', 'Huyện Châu Đức', 'Xã Quảng Thành', '123', 'pending', NULL, '2024-12-06 03:26:48', '2024-12-06 03:26:48', '0822086992', 'cash', NULL, '41009050.00', 80000, 'EWI98NE', '2149950.00', '5.00'),
(145, 12, '42999000', 'Tỉnh Bà Rịa - Vũng Tàu', 'Huyện Châu Đức', 'Xã Bình Trung', 'đâsdasdas', 'pending', NULL, '2024-12-06 03:27:44', '2024-12-06 03:27:44', '0822086992', 'cash', NULL, '40929050.00', 80000, 'EWI98NE', '2149950.00', '5.00'),
(146, 12, '42999000', 'Tỉnh Bà Rịa - Vũng Tàu', 'Huyện Long Điền', 'Thị trấn Long Hải', 'đâsdasdas', 'pending', NULL, '2024-12-06 03:31:31', '2024-12-06 03:31:31', '0822086992', 'cash', NULL, '43079000.00', 80000, NULL, NULL, NULL),
(147, 12, '42999000', 'Tỉnh Bà Rịa - Vũng Tàu', 'Huyện Long Điền', 'Thị trấn Long Hải', 'đâsdasdas', 'pending', NULL, '2024-12-06 03:39:31', '2024-12-06 03:39:31', '0822086992', 'cash', NULL, '40929050.00', 80000, 'EWI98NE', '2149950.00', '5.00'),
(148, 12, '42999000', 'Tỉnh Bà Rịa - Vũng Tàu', 'Huyện Châu Đức', 'Xã Bình Giã', '213', 'pending', NULL, '2024-12-06 03:42:05', '2024-12-06 03:42:05', '0822086992', 'cash', NULL, '43079000.00', 80000, NULL, NULL, NULL),
(149, 12, '53119000', 'Tỉnh Bà Rịa - Vũng Tàu', 'Huyện Châu Đức', 'Xã Bình Giã', 'đâsdasdas', 'pending', NULL, '2024-12-06 03:46:09', '2024-12-06 03:46:09', '0822086992', 'cash', NULL, '50623050.00', 80000, 'EWI98NE', '2655950.00', '5.00'),
(150, 12, '89098000', 'Tỉnh Bà Rịa - Vũng Tàu', 'Huyện Long Điền', 'Thị trấn Long Hải', '213', 'pending', NULL, '2024-12-06 03:48:37', '2024-12-06 03:48:37', '0822086992', 'cash', NULL, '89178000.00', 80000, NULL, NULL, NULL),
(151, 12, '89998000', 'Tỉnh Bà Rịa - Vũng Tàu', 'Thành phố Bà Rịa', 'Phường Kim Dinh', '213', 'pending', NULL, '2024-12-06 03:49:17', '2024-12-06 03:49:17', '0336264047', 'cash', NULL, '90078000.00', 80000, NULL, NULL, NULL),
(152, 12, '42999000', 'Tỉnh Bà Rịa - Vũng Tàu', 'Huyện Châu Đức', 'Xã Bình Giã', 'đâsdasdas', 'pending', NULL, '2024-12-06 03:57:22', '2024-12-06 03:57:22', '0822086992', 'cash', NULL, '43079000.00', 80000, NULL, NULL, NULL),
(153, 12, '42999000', 'Tỉnh An Giang', 'Huyện Châu Phú', 'Xã Bình Mỹ', '213', 'pending', NULL, '2024-12-06 04:00:36', '2024-12-06 04:00:36', '0822086992', 'cash', NULL, '40904050.00', 55000, 'EWI98NE', '2149950.00', '5.00'),
(154, 12, '90998000', 'Tỉnh Bà Rịa - Vũng Tàu', 'Huyện Châu Đức', 'Xã Bình Trung', 'hà nội', 'pending', NULL, '2024-12-06 12:26:05', '2024-12-06 12:26:05', '0336264047', 'cash', NULL, '91078000.00', 80000, NULL, NULL, NULL),
(155, 12, '108119000', 'Tỉnh Bạc Liêu', 'Huyện Hoà Bình', 'Xã Vĩnh Bình', 'hà nội', 'pending', NULL, '2024-12-06 12:34:22', '2024-12-06 12:34:22', '0336264047', 'cash', NULL, '108174000.00', 55000, NULL, NULL, NULL),
(156, 12, '41999000', 'Tỉnh Bạc Liêu', 'Thị xã Giá Rai', 'Phường Hộ Phòng', 'hà nội', 'pending', NULL, '2024-12-06 12:35:26', '2024-12-06 12:35:26', '0336264047', 'cash', NULL, '42054000.00', 55000, NULL, NULL, NULL),
(157, 12, '42999000', 'Tỉnh Bạc Liêu', 'Thị xã Giá Rai', 'Phường Hộ Phòng', 'hà nội', 'pending', NULL, '2024-12-06 12:35:52', '2024-12-06 12:35:52', '0336264047', 'cash', NULL, '43054000.00', 55000, NULL, NULL, NULL),
(158, 12, '47999000', 'Tỉnh Bạc Liêu', 'Thị xã Giá Rai', 'Phường 1', 'hà nội', 'pending', NULL, '2024-12-06 12:36:26', '2024-12-06 12:36:26', '0336264047', 'cash', NULL, '48054000.00', 55000, NULL, NULL, NULL),
(159, 12, '42999000', 'Tỉnh Bạc Liêu', 'Thành phố Bạc Liêu', 'Phường 1', 'hà nội', 'pending', NULL, '2024-12-06 12:37:17', '2024-12-06 12:37:17', '0336264047', 'cash', NULL, '43054000.00', 55000, NULL, NULL, NULL),
(160, 12, '47999000', 'Tỉnh An Giang', 'Huyện Châu Phú', 'Xã Bình Chánh', 'hà nội', 'pending', NULL, '2024-12-06 12:38:42', '2024-12-06 12:38:42', '0336264047', 'cash', NULL, '48054000.00', 55000, NULL, NULL, NULL),
(161, 12, '42999000', 'Tỉnh An Giang', 'Huyện Châu Phú', 'Xã Bình Long', 'hà nội', 'confirmed', NULL, '2024-12-06 12:45:58', '2024-12-12 07:49:42', '0336264047', 'cash', NULL, '43054000.00', 55000, NULL, NULL, NULL),
(162, NULL, '1292245', '89', '886', '30346', 'hà nội', 'confirmed', NULL, '2024-12-06 14:19:46', '2024-12-06 14:19:46', '0336264047', 'cash', NULL, NULL, 40000, NULL, '0.00', '0.00'),
(163, NULL, '12040000', '89', '886', '30364', 'hà nội', 'delivering', NULL, '2024-12-06 14:21:13', '2024-12-12 07:50:21', '0336264047', 'cash', NULL, NULL, 40000, NULL, '0.00', '0.00'),
(164, 12, '103119000', 'Tỉnh Bến Tre', 'Thành phố Bến Tre', 'Phường 6', 'hà nội', 'canceled', NULL, '2024-12-08 06:10:19', '2024-12-12 07:40:02', '0336264047', 'cash', NULL, '103199000.00', 80000, NULL, NULL, NULL),
(165, 12, '42999000', 'Tỉnh Bến Tre', 'Huyện Ba Tri', 'Xã An Hiệp', 'hà nội', 'delivering', NULL, '2024-12-08 06:17:14', '2024-12-11 15:46:08', '0336264047', 'cash', NULL, '43079000.00', 80000, NULL, NULL, NULL),
(167, NULL, '12025000', '01', '008', '00340', 'hà nội', 'completed', NULL, '2024-12-12 07:22:32', '2024-12-12 07:35:55', '0336264047', 'cash', NULL, NULL, 25000, NULL, '0.00', '0.00'),
(168, NULL, '132025000', '01', '282', '10453', 'hà nội', 'completed', NULL, '2024-12-12 07:30:16', '2024-12-12 07:35:12', '0336264047', 'cash', NULL, NULL, 25000, NULL, '0.00', '0.00'),
(169, NULL, '25040000', '04', '049', '01627', 'hà nội', 'canceled', NULL, '2024-12-12 07:38:10', '2024-12-12 07:48:22', '0336264047', 'cash', NULL, NULL, 40000, NULL, '0.00', '0.00'),
(170, 12, '66229000', 'Tỉnh Bình Thuận', 'Huyện Bắc Bình', 'Xã Bình Tân', 'bà rịa', 'pending', NULL, '2024-12-12 08:04:14', '2024-12-12 08:04:14', '0336264047', 'cash', NULL, '66284000.00', 55000, NULL, NULL, NULL),
(171, 12, '27740000', 'Thành phố Hồ Chí Minh', 'Quận 3', 'Phường 03', 'bà rịa', 'completed', NULL, '2024-12-12 08:04:55', '2024-12-12 08:16:41', '0336264047', 'cash', NULL, '27820000.00', 80000, NULL, NULL, NULL),
(172, 12, '67830000', 'Thành phố Hồ Chí Minh', 'Quận 10', 'Phường 02', 'bà rịa', 'completed', NULL, '2024-12-12 08:12:19', '2024-12-12 08:16:16', '0336264047', 'online', '14739109', '67910000.00', 80000, NULL, NULL, NULL),
(173, NULL, '12040000', '06', '063', '01981', 'test', 'canceled', NULL, '2024-12-17 09:22:29', '2024-12-17 09:24:16', '0357543424', 'cash', NULL, NULL, 40000, NULL, '0.00', '0.00'),
(174, 12, '128997000', 'Tỉnh Cà Mau', 'Huyện Năm Căn', 'Thị trấn Năm Căn', 'còn lâu mới nói', 'completed', NULL, '2024-12-17 09:47:27', '2024-12-17 09:47:54', '0357543424', 'cash', NULL, '128997000.00', 80000, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint UNSIGNED NOT NULL,
  `order_id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `quantity` int NOT NULL,
  `price` decimal(50,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `variant_id` bigint UNSIGNED DEFAULT NULL,
  `battery_id` bigint UNSIGNED DEFAULT NULL,
  `color_id` bigint UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `price`, `created_at`, `updated_at`, `variant_id`, `battery_id`, `color_id`) VALUES
(63, 111, 8, 1, '31999000.00', '2024-12-03 13:53:10', '2024-12-03 13:53:10', 5, NULL, 2),
(64, 112, 8, 1, '31999000.00', '2024-12-04 15:38:24', '2024-12-04 15:38:24', 5, NULL, 2),
(65, 113, 8, 1, '31999000.00', '2024-12-04 15:40:49', '2024-12-04 15:40:49', 5, NULL, 2),
(66, 114, 8, 1, '31999000.00', '2024-12-04 15:41:46', '2024-12-04 15:41:46', 5, NULL, 2),
(67, 115, 8, 1, '31999000.00', '2024-12-05 08:24:07', '2024-12-05 08:24:07', 5, NULL, 2),
(68, 116, 8, 1, '31999000.00', '2024-12-05 08:25:51', '2024-12-05 08:25:51', 5, NULL, 2),
(69, 116, 18, 1, '5000000.00', '2024-12-05 08:25:51', '2024-12-05 08:25:51', NULL, NULL, 12),
(70, 117, 8, 1, '31999000.00', '2024-12-05 08:36:15', '2024-12-05 08:36:15', 5, NULL, 2),
(71, 118, 8, 1, '31999000.00', '2024-12-05 08:36:51', '2024-12-05 08:36:51', 5, NULL, 2),
(72, 119, 8, 2, '31999000.00', '2024-12-05 09:57:54', '2024-12-05 09:57:54', 5, NULL, 2),
(73, 119, 18, 1, '5000000.00', '2024-12-05 09:57:54', '2024-12-05 09:57:54', NULL, NULL, 13),
(74, 120, 8, 1, '31999000.00', '2024-12-05 10:19:32', '2024-12-05 10:19:32', 5, NULL, 2),
(75, 121, 10, 1, '12000000.00', '2024-12-05 10:25:04', '2024-12-05 10:25:04', 5, 1, 12),
(76, 122, 10, 2, '12000000.00', '2024-12-05 10:25:27', '2024-12-05 10:25:27', 4, 1, 13),
(77, 123, 8, 1, '31999000.00', '2024-12-05 10:30:00', '2024-12-05 10:30:00', 5, NULL, 2),
(78, 123, 18, 1, '5000000.00', '2024-12-05 10:30:00', '2024-12-05 10:30:00', NULL, NULL, 13),
(79, 124, 8, 1, '31999000.00', '2024-12-05 11:06:05', '2024-12-05 11:06:05', 5, NULL, 2),
(80, 126, 8, 1, '31999000.00', '2024-12-05 11:10:10', '2024-12-05 11:10:10', 5, NULL, 2),
(81, 127, 8, 1, '31999000.00', '2024-12-05 11:14:45', '2024-12-05 11:14:45', 5, NULL, 2),
(82, 128, 18, 1, '5000000.00', '2024-12-05 11:15:12', '2024-12-05 11:15:12', NULL, NULL, 13),
(83, 129, 8, 1, '31999000.00', '2024-12-05 11:27:37', '2024-12-05 11:27:37', 5, NULL, 2),
(84, 130, 8, 2, '31999000.00', '2024-12-05 11:58:47', '2024-12-05 11:58:47', 5, NULL, 2),
(85, 130, 18, 1, '5000000.00', '2024-12-05 11:58:47', '2024-12-05 11:58:47', NULL, NULL, 13),
(86, 131, 8, 2, '31999000.00', '2024-12-05 15:11:24', '2024-12-05 15:11:24', 5, NULL, 2),
(87, 132, 8, 1, '31999000.00', '2024-12-05 15:21:30', '2024-12-05 15:21:30', 5, NULL, 2),
(88, 133, 18, 1, '5000000.00', '2024-12-05 15:50:16', '2024-12-05 15:50:16', NULL, NULL, 13),
(89, 134, 8, 1, '31999000.00', '2024-12-05 15:55:53', '2024-12-05 15:55:53', 5, NULL, 2),
(90, 135, 8, 1, '31999000.00', '2024-12-05 15:58:09', '2024-12-05 15:58:09', 5, NULL, 2),
(91, 136, 8, 1, '31999000.00', '2024-12-05 16:22:55', '2024-12-05 16:22:55', 5, NULL, 2),
(92, 136, 18, 1, '5000000.00', '2024-12-05 16:22:55', '2024-12-05 16:22:55', NULL, NULL, 12),
(93, 137, 8, 2, '31999000.00', '2024-12-05 16:27:30', '2024-12-05 16:27:30', 5, NULL, 2),
(94, 138, 8, 1, '31999000.00', '2024-12-05 16:28:58', '2024-12-05 16:28:58', 5, NULL, 2),
(95, 138, 18, 1, '5000000.00', '2024-12-05 16:28:58', '2024-12-05 16:28:58', NULL, NULL, 12),
(96, 139, 8, 1, '31999000.00', '2024-12-06 03:01:27', '2024-12-06 03:01:27', 5, NULL, 2),
(97, 140, 8, 1, '31999000.00', '2024-12-06 03:03:49', '2024-12-06 03:03:49', 5, NULL, 2),
(98, 141, 8, 1, '31999000.00', '2024-12-06 03:08:04', '2024-12-06 03:08:04', 5, NULL, 2),
(99, 142, 8, 1, '31999000.00', '2024-12-06 03:09:14', '2024-12-06 03:09:14', 5, NULL, 2),
(100, 143, 8, 1, '31999000.00', '2024-12-06 03:18:14', '2024-12-06 03:18:14', 5, NULL, 2),
(101, 144, 8, 1, '31999000.00', '2024-12-06 03:26:49', '2024-12-06 03:26:49', 5, NULL, 2),
(102, 145, 8, 1, '31999000.00', '2024-12-06 03:27:44', '2024-12-06 03:27:44', 5, NULL, 2),
(103, 146, 8, 1, '31999000.00', '2024-12-06 03:31:31', '2024-12-06 03:31:31', 5, NULL, 2),
(104, 147, 8, 1, '31999000.00', '2024-12-06 03:39:31', '2024-12-06 03:39:31', 5, NULL, 2),
(105, 148, 8, 1, '31999000.00', '2024-12-06 03:42:05', '2024-12-06 03:42:05', 5, NULL, 2),
(106, 149, 8, 1, '31999000.00', '2024-12-06 03:46:09', '2024-12-06 03:46:09', 6, NULL, 2),
(107, 149, 18, 1, '5000000.00', '2024-12-06 03:46:09', '2024-12-06 03:46:09', NULL, NULL, 12),
(108, 150, 8, 1, '31999000.00', '2024-12-06 03:48:37', '2024-12-06 03:48:37', 6, NULL, 6),
(109, 150, 8, 1, '31999000.00', '2024-12-06 03:48:37', '2024-12-06 03:48:37', 5, NULL, 8),
(110, 151, 8, 1, '31999000.00', '2024-12-06 03:49:17', '2024-12-06 03:49:17', 5, NULL, 2),
(111, 151, 8, 1, '31999000.00', '2024-12-06 03:49:17', '2024-12-06 03:49:17', 6, NULL, 6),
(112, 152, 8, 1, '31999000.00', '2024-12-06 03:57:22', '2024-12-06 03:57:22', 5, NULL, 2),
(113, 153, 8, 1, '31999000.00', '2024-12-06 04:00:36', '2024-12-06 04:00:36', 5, NULL, 2),
(114, 154, 8, 2, '31999000.00', '2024-12-06 12:26:05', '2024-12-06 12:26:05', 5, NULL, 2),
(115, 154, 18, 1, '5000000.00', '2024-12-06 12:26:05', '2024-12-06 12:26:05', NULL, NULL, 13),
(116, 155, 8, 1, '31999000.00', '2024-12-06 12:34:22', '2024-12-06 12:34:22', 5, NULL, 2),
(117, 155, 18, 1, '5000000.00', '2024-12-06 12:34:22', '2024-12-06 12:34:22', NULL, NULL, 13),
(118, 155, 19, 1, '50000000.00', '2024-12-06 12:34:22', '2024-12-06 12:34:22', 5, NULL, 15),
(119, 156, 8, 1, '31999000.00', '2024-12-06 12:35:26', '2024-12-06 12:35:26', 5, NULL, 6),
(120, 157, 8, 1, '31999000.00', '2024-12-06 12:35:52', '2024-12-06 12:35:52', 5, NULL, 2),
(121, 158, 8, 1, '31999000.00', '2024-12-06 12:36:26', '2024-12-06 12:36:26', 5, NULL, 2),
(122, 158, 18, 1, '5000000.00', '2024-12-06 12:36:26', '2024-12-06 12:36:26', NULL, NULL, 13),
(123, 159, 8, 1, '31999000.00', '2024-12-06 12:37:17', '2024-12-06 12:37:17', 5, NULL, 2),
(124, 160, 8, 1, '31999000.00', '2024-12-06 12:38:42', '2024-12-06 12:38:42', 5, NULL, 2),
(125, 160, 18, 1, '5000000.00', '2024-12-06 12:38:42', '2024-12-06 12:38:42', NULL, NULL, 13),
(126, 161, 8, 1, '31999000.00', '2024-12-06 12:45:58', '2024-12-06 12:45:58', 5, NULL, 2),
(127, 162, 12, 1, '1252245.00', '2024-12-06 14:19:46', '2024-12-06 14:19:46', 5, 1, 4),
(128, 163, 10, 1, '12000000.00', '2024-12-06 14:21:13', '2024-12-06 14:21:13', 4, 1, 9),
(129, 164, 19, 1, '50000000.00', '2024-12-08 06:10:19', '2024-12-08 06:10:19', 5, NULL, 15),
(130, 164, 8, 1, '31999000.00', '2024-12-08 06:10:19', '2024-12-08 06:10:19', 5, NULL, 2),
(131, 165, 8, 1, '31999000.00', '2024-12-08 06:17:14', '2024-12-08 06:17:14', 5, NULL, 2),
(132, 166, 10, 11, '12000000.00', '2024-12-12 07:19:20', '2024-12-12 07:19:20', 4, 1, NULL),
(133, 167, 10, 1, '12000000.00', '2024-12-12 07:22:32', '2024-12-12 07:22:32', 5, 1, 14),
(134, 168, 10, 11, '12000000.00', '2024-12-12 07:30:16', '2024-12-12 07:30:16', 4, 1, 7),
(135, 169, 38, 1, '25000000.00', '2024-12-12 07:38:10', '2024-12-12 07:38:10', 5, 1, 15),
(136, 170, 8, 1, '31999000.00', '2024-12-12 08:04:14', '2024-12-12 08:04:14', 5, NULL, 2),
(137, 170, 20, 1, '500000.00', '2024-12-12 08:04:14', '2024-12-12 08:04:14', NULL, NULL, 17),
(138, 170, 45, 1, '17490000.00', '2024-12-12 08:04:14', '2024-12-12 08:04:14', 4, NULL, 52),
(139, 171, 45, 1, '17490000.00', '2024-12-12 08:04:55', '2024-12-12 08:04:55', 5, NULL, 53),
(140, 172, 45, 3, '17490000.00', '2024-12-12 08:12:19', '2024-12-12 08:12:19', 4, NULL, 52),
(141, 173, 10, 1, '12000000.00', '2024-12-17 09:22:29', '2024-12-17 09:22:29', 5, 1, 12),
(142, 174, 8, 3, '31999000.00', '2024-12-17 09:47:27', '2024-12-17 09:47:27', 5, NULL, 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `video` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `content`, `image`, `category_id`, `created_at`, `updated_at`, `video`) VALUES
(17, 'Tất tần tật hướng dẫn sử dụng AirPods, AirPods Pro mà bạn nên biết', '<p><strong>Tai nghe AirPods là thiết bị tai nghe không dây đến từ nhà Táo, tích hợp nhiều ưu điểm tuyệt vời, rất đáng để sở hữu. Ở bài viết này, Sforum sẽ hướng dẫn sử dụng AirPods chi tiết từ A đến Z.</strong></p><p>Nếu bạn vừa mua chiếc <a href=\"https://cellphones.com.vn/apple\">Apple</a> AirPods và vẫn còn bối rối trong việc sử dụng thì hãy cùng Sforum tham khảo bài viết dưới đây. Một cẩm nang hướng dẫn <a href=\"https://dienthoaivui.com.vn/cach-su-dung-tai-nghe-airpods-pro-cho-siri-cam-ung-khi-cuoc-goi-den/\"><strong>sử dụng AirPods Pro</strong></a> đầy đủ, chi tiết, từ A đến Z.</p><figure class=\"image\"><img style=\"aspect-ratio:1162/652;\" src=\"http://datn.test/uploads/posts/1733040934_BsXacKTJER9tmu64pWpUaeCESZLrrsI3RhQaDvSS.jpg\" width=\"1162\" height=\"652\"></figure><p>Để hiểu rõ hơn về em AirPods này, trước hết chúng ta hãy điểm qua một vài thông tin cơ bản nhé.</p><h2><strong>AirPods là gì</strong></h2><p>AirPods là thiết bị tai nghe không dây kết nối với các thiết bị khác thông qua Bluetooth. Đặc điểm của AirPods là gọn nhẹ và được Apple thiết kế hộp đựng cũng là công cụ sạc pin cho tai nghe.</p><p>Trên tai nghe AirPods sẽ có cảm biến hồng ngoại để giúp ngừng nhạc khi bạn tháo tai nghe ra và nhạc sẽ phát tiếp tục khi bạn gắn tai nghe vào lại tai của bạn. 1 cảm biến chuyển động để kết nối với Siri (hoặc tác vụ do bạn đặt) bằng cách kích đúp 2 lần phía sau AirPods . Ngoài ra còn có 2 cảm biến âm thanh để nhận biết âm thanh phát ra ngoài và góp phần chống nhiễu âm khi bạn đàm thoại.</p><figure class=\"image\"><img style=\"aspect-ratio:980/783;\" src=\"http://datn.test/uploads/posts/1733035976_Apple-AirPods-Pro-2nd-gen-hero-220907_big.jpg.large.jpg\" width=\"980\" height=\"783\"></figure><h2><strong>AirPods tương thích với các thiết bị nào</strong></h2><p>Chiếc tai nghe này có thể tương thích với hầu hết tất cả thiết bị iOS (iPhone, <a href=\"https://cellphones.com.vn/tablet/ipad.html\">iPad</a>, <a href=\"https://cellphones.com.vn/laptop/mac.html\">Macbook</a>, iPod,…) và cả các thiết bị không thuộc Apple như Android, Windows...</p><p>Tuy nhiên để sử dụng được hết tất cả mọi tính năng của AirPods mà chip Apple W1 mang lại thì bạn cần sử dụng các thiết bị có hệ điều hành <a href=\"https://cellphones.com.vn/sforum/tag/ios-10\">iOS 10</a>, Watch OS3 hoặc Mac OS Sierra trở lên.</p>', 'posts/Kam9caP39ufbNOdIL67JKL76T2qnaqrnWbSjlFrE.jpg', 5, '2024-11-30 23:53:20', '2024-12-01 03:39:25', ''),
(29, 'Dòng Galaxy S24 Mới: Tất Cả Những Gì Bạn Cần Biết', '<p>Dòng Samsung Galaxy S24 đã ra mắt, tạo tiền đề cho một kỷ nguyên mới về đổi mới điện thoại thông minh. Mỗi chiếc điện thoại Samsung Galaxy S24 đều được thiết kế để vượt qua các ranh giới công nghệ mà chúng ta biết. Với AI tích hợp được phát triển cùng với các đối tác như Google, dòng Galaxy S24 mới nhất khiến cuộc sống trở nên thú vị hơn. Sử dụng sức mạnh của Trí tuệ nhân tạo để hỗ trợ các tính năng như Circle to Search, Chat Assist và Note Assist, dòng Galaxy S24 đang dẫn thế giới đến một vùng đất mới về kết nối và sáng tạo.</p><p><img src=\"https://images.samsung.com/is/image/samsung/assets/vn/mobile/mobile-phone-buying-guide/the-new-samsung-galaxy-s24-series/s24_group_PC1.jpg?$ORIGIN_JPG$\" alt=\"Dòng Samsung Galaxy S24 đã ra mắt\" width=\"1156\" height=\"450\"></p><h2><strong>Tại sao nên mua dòng Samsung Galaxy S24?</strong></h2><p>Dòng Galaxy S24 mang đến cho bạn khả năng tiếp cận vô tận. Mua điện thoại <a href=\"https://www.samsung.com/vn/smartphones/galaxy-s24/buy/\">Galaxy S24</a> từ dòng sản phẩm mới nhất của chúng tôi để trải nghiệm các tính năng nâng cao, được thiết kế để theo kịp mọi nhịp sống.</p><h3>1. Công nghệ tiên tiến</h3><p>Dòng Samsung Galaxy S24 được thiết kế bởi các chuyên gia công nghệ giỏi nhất để mang đến cho bạn trải nghiệm điện thoại thông minh liền mạch nhất. Bạn chọn Galaxy S24 vì màn hình cực sáng, hay Galaxy S24+ với độ phân giải cao nhất trên mọi điện thoại thông minh Galaxy hay <a href=\"https://www.samsung.com/vn/smartphones/galaxy-s24-ultra/buy/\">Galaxy S24 Ultra</a> với camera hàng đầu? Cho dù lí do là gì, dòng điện thoại thông minh của chúng tôi đều được thiết kế để giúp cuộc sống của bạn đơn giản hơn.</p><h3>2. Độ bền và khả năng kết nối</h3><p>Cấu trúc Armor Armor chắc chắn và khả năng chống nước được xếp hạng IP đảm bảo dòng Galaxy S24 có thể chịu được mọi chuyến phiêu lưu của bạn. Tích hợp hệ sinh thái liền mạch giúp tăng cường khả năng kết nối và bảo mật trên tất cả các thiết bị của bạn, giúp mọi tương tác trở nên mượt mà và an toàn.</p><h3>3. Điện thoại thông minh đón đầu tương lai</h3><p>Galaxy S24 chính là công nghệ tương lai. Được trang bị tốc độ 5G, pin bền bỉ và bộ sạc nhanh, dòng sản phẩm này được thiết kế để đáp ứng các nhu cầu đa dạng của mọi người dùng, từ công việc hàng ngày cho đến chụp ảnh chuyên nghiệp.</p><h2><strong>Dòng Galaxy S24 có gì đặc biệt?</strong></h2><p><img src=\"https://images.samsung.com/is/image/samsung/assets/vn/mobile/mobile-phone-buying-guide/the-new-samsung-galaxy-s24-series/Galaxy-S24-Series-Edit-Suggestion-Recovered.jpg?$ORIGIN_JPG$\" alt=\"Điện thoại hỗ trợ AI đầu tiên\" width=\"1156\" height=\"817\"></p><p>Dòng Samsung Galaxy S24 mang đến sự kết hợp giữa sự đổi mới, hiệu suất và phong cách nổi bật. Đặt ra các tiêu chuẩn mới để Trí tuệ nhân tạo trở thành một phần của cuộc sống hàng ngày, điện thoại thông minh thuộc dòng Galaxy S24 là thế hệ tiên phong trong công nghệ di động. Mỗi model, từ Samsung Galaxy S24 đến Galaxy S24 Ultra, đều mang một nét đặc trưng của Galaxy Edge, nổi bật với sự tích hợp đột phá giữa công nghệ và thiết kế lấy người dùng làm trung tâm.<br><br>Giới thiệu màn hình sáng nhất trong lịch sử Galaxy, dòng Galaxy S24 đảm bảo khả năng hiển thị rõ nét trong mọi điều kiện ánh sáng. Dòng điện thoại thông minh này được trang bị camera chuyên nghiệp hoạt động vượt trội trong điều kiện ánh sáng yếu và tận dụng AI tiên tiến để cải thiện chất lượng ảnh để bạn có thể ghi lại cuộc sống khi đang di chuyển.<br><br>Người dùng không còn phải nghi ngờ với độ bền của sản phẩm này, với chất lượng kết cấu chắc chắn và khả năng chống nước được xếp hạng chuẩn IP68 trên toàn bộ dòng sản phẩm. Dòng sản phẩm Galaxy S24 cũng được trang bị kết nối 5G và các tính năng AI nâng cao trên nhiều ứng dụng, biến mỗi thiết bị trở thành một công cụ mạnh mẽ, cho cả bầu trời tính năng vào lòng bàn tay bạn.</p><h2><strong>Có những lựa chọn màu sắc nào cho dòng Galaxy S24?</strong></h2><p>Màu sắc của dòng Galaxy S24 đặt nền tảng cho thiết kế trực quan, được xây dựng để thể hiện cá tính và phong cách độc đáo của bạn.<br>Samsung Galaxy S24 và S24+ có các màu Tím Coban, Vàng Amber, Đen Onyx và Xám Marble. Để đưa khả năng cá nhân hóa lên một tầm cao mới, các màu sắc độc quyền trực tuyến bao gồm Xanh Jade, Xanh Sapphire và Cam Cát Sandstone. Lấy cảm hứng từ các khoáng chất quý giá, màu sắc của Galaxy S24 và S24+ mang đến cho thiết bị của bạn vẻ quyến rũ tinh tế.<br><br>Màu sắc của Samsung Galaxy S24 Ultra được nâng lên một tầm cao mới, pha trộn giữa chất đất của khoáng chất và một chút sang trọng. Galaxy S24 Ultra có các màu Đen Titan, Xám Titan, Tím Titan và Vàng Titan. Các màu độc quyền trực tuyến bao gồm Xanh Titan, Xanh Titan và Cam Titan.<br><br>Hãy lựa chọn trong số các <a href=\"https://www.samsung.com/vn/mobile/mobile-phone-buying-guide/galaxy-s24-colors/\">màu sắc Galaxy S24</a> của chúng tôi để vượt lên trên những điều bình thường và khoác lên chiếc Galaxy của bạn bằng những sắc thái đặc trưng cho bạn.</p><p>&nbsp;</p>', 'posts/BJoqHmdIHCpDIF4MlROFNZIizn3jt1CB6icXsywI.jpg', 4, '2024-12-01 00:59:15', '2024-12-17 12:51:03', NULL),
(42, 'iPhone 16 Pro | Camera Control | Apple', '<h2><strong>Review iPhone 16 Pro: Nút \"camera control\" có thực sự cần thiết hay không?</strong></h2><p><strong>iệu nút \"</strong><a href=\"https://cellphones.com.vn/phu-kien/camera.html\"><strong>Camera</strong></a><strong> Control\" trên </strong><a href=\"https://cellphones.com.vn/mobile/apple/iphone-16.html\"><strong>iPhone 16</strong></a><strong> Pro có phải là một cải tiến đáng giá hay chỉ là một tính năng không cần thiết? Câu trả lời sẽ có trong bài viết “Review </strong><a href=\"https://cellphones.com.vn/iphone-16-pro.html\"><strong>iPhone 16 Pro</strong></a><strong>: Nút \"Camera Control\" có thực sự cần thiết không, hay chỉ là một cải tiến vô dụng?” này!</strong></p><p>Với những thay đổi mà <a href=\"https://cellphones.com.vn/apple\">Apple</a> mang lại, câu hỏi “Nút \"Camera Control\" có thực sự cần thiết không, hay chỉ là một cải tiến vô dụng?” khiến không ít người dùng băn khoăn về sự tiện ích thực sự của nút này trong việc chụp ảnh và quay phim hàng ngày. Để có câu trả lời cho câu hỏi này, mời bạn cùng Sforum tham khảo bài viết phía dưới đây.</p><figure class=\"image\"><img style=\"aspect-ratio:1200/529;\" src=\"https://cdn-media.sforum.vn/storage/app/media/krayza/co-nen-mua-iphone-16-pro/co-nen-mua-iphone-16-pro-%20(3).jpg\" alt=\"Review iPhone 16 Pro\" width=\"1200\" height=\"529\"><figcaption>Review <a href=\"https://cellphones.com.vn/mobile/apple.html\">iPhone</a> 16 Pro: Nút \"Camera Control\" có thực sự cần thiết hay không?</figcaption></figure><p><strong>Mục lục</strong>Ẩn</p><ul><li><a href=\"https://cellphones.com.vn/sforum/review-iphone-16-pro#review-iphone-16-pro-nut-camera-control-co-thuc-su-can-thiet-khong-hay-chi-la-mot-cai-tien-vo-dung\">1. Review iPhone 16 Pro: Nút \"Camera Control\" có thực sự cần thiết không, hay chỉ là một cải tiến vô dụng?</a></li><li><a href=\"https://cellphones.com.vn/sforum/review-iphone-16-pro#chuc-nang-va-cach-su-dung-cua-nut-camera-control-tren-iphone-16-pro\">2. Chức năng và cách sử dụng của nút \"Camera Control\" trên iPhone 16 Pro</a></li><li><a href=\"https://cellphones.com.vn/sforum/review-iphone-16-pro#chuc-nang-cua-nut-camera-control\">2.1. Chức năng của nút \"Camera Control\"</a></li><li><a href=\"https://cellphones.com.vn/sforum/review-iphone-16-pro#cach-su-dung-nut-camera-control\">2.2. Cách sử dụng nút \"Camera Control\"</a></li><li><a href=\"https://cellphones.com.vn/sforum/review-iphone-16-pro#nhung-cau-hoi-ve-chuc-nang-camera-control\">3. Những câu hỏi về chức năng \"Camera Control\"</a></li><li><a href=\"https://cellphones.com.vn/sforum/review-iphone-16-pro#nut-camera-control-se-phu-hop-voi-nhung-ai\">3.1. Nút \"Camera Control\" sẽ phù hợp với những ai?</a></li><li><a href=\"https://cellphones.com.vn/sforum/review-iphone-16-pro#nut-camera-control-co-tien-loi-hon-thao-tac-cham-tren-man-hinh-khong\">3.2. Nút \"Camera Control\" có tiện lợi hơn thao tác chạm trên màn hình không?</a></li><li><a href=\"https://cellphones.com.vn/sforum/review-iphone-16-pro#nut-nay-co-de-su-dung-khong-dac-biet-khi-dung-mot-tay\">3.3. Nút này có dễ sử dụng không, đặc biệt khi dùng một tay?</a></li><li><a href=\"https://cellphones.com.vn/sforum/review-iphone-16-pro#op-lung-co-anh-huong-den-kha-nang-su-dung-nut-camera-control-hay-khong\">3.4. Ốp lưng có ảnh hưởng đến khả năng sử dụng nút \"Camera Control\" hay không?</a></li></ul><h2><strong>Review iPhone 16 Pro: Nút \"Camera Control\" có thực sự cần thiết không, hay chỉ là một cải tiến vô dụng?</strong></h2><p>Nút \"Camera Control\" trên iPhone 16 Pro không đơn thuần là một nút chụp hình thông thường mà nó tích hợp nhiều chức năng giúp người dùng thao tác nhanh hơn khi sử dụng camera. Tuy nhiên, câu hỏi về tính cần thiết của nó vẫn còn phụ thuộc vào cách bạn sử dụng <a href=\"https://cellphones.com.vn/mobile.html\">điện thoại</a>. Với những người thường xuyên sử dụng camera cho công việc hoặc giải trí, sự tiện lợi của nút này có thể đáng giá.</p><figure class=\"image\"><img style=\"aspect-ratio:1200/674;\" src=\"https://cdn-media.sforum.vn/storage/app/media/adminsforum/nhung-diem-gay-an-tuong-nhat-tai-su-kien-apple-glowtime/nhung-diem-gay-an-tuong-apple-glowtime-iphone-16-6.jpg\" alt=\"Review iPhone 16 Pro\" width=\"1200\" height=\"674\"><figcaption>Nút Camera Control trên iPhone 16 Pro</figcaption></figure><p>Mặt khác, đối với người dùng không quá quan tâm đến việc sử dụng camera chuyên nghiệp, nút này có thể chỉ là một bổ sung không quá quan trọng. Điều đó khiến nút \"Camera Control\" trở thành một tính năng hữu ích cho một nhóm người dùng nhất định, nhưng chưa chắc cần thiết cho tất cả mọi người.</p><h2><strong>Chức năng và cách sử dụng của nút \"Camera Control\" trên iPhone 16 Pro</strong></h2><p>Dưới đây là chức năng và cách sử dụng của nút \"Camera Control\", mời bạn tham khảo:</p><h3><strong>Chức năng của nút \"Camera Control\"</strong></h3><p>Nút \"Camera Control\" trên iPhone 16 Pro được thiết kế để mang lại trải nghiệm chụp ảnh và quay phim tiện lợi hơn. Nó cho phép người dùng không chỉ bấm chụp ảnh, mà còn điều chỉnh các thông số camera như phơi sáng, zoom và bộ lọc màu mà không cần phải thao tác trực tiếp trên <a href=\"https://cellphones.com.vn/man-hinh.html\">màn hình</a>. Nút này tích hợp khả năng cảm ứng lực, giúp người dùng có thể sử dụng bằng cách nhấn, vuốt hoặc chạm nhẹ để điều khiển camera.</p><p>Với ba chức năng chính là bấm, vuốt và chạm, nút này cho phép người dùng tùy chỉnh các chế độ chụp hoặc quay phim một cách nhanh chóng và tiện lợi. Đây là một tính năng được đánh giá cao, đặc biệt đối với những ai thường xuyên sử dụng camera trên iPhone.</p><h3><strong>Cách sử dụng nút \"Camera Control\"</strong></h3><p>Cách sử dụng nút \"Camera Control\" khá đơn giản và tiện lợi. Khi muốn mở camera, bạn chỉ cần bấm giữ nút để kích hoạt nhanh ứng dụng camera mà không cần vuốt màn hình. Nếu muốn chụp ảnh, bạn chỉ cần bấm mạnh một lần, và để quay video, hãy bấm giữ. Điều này giúp rút ngắn thời gian thao tác và mang lại sự thuận tiện khi chụp ảnh hoặc quay video nhanh.</p><p>Ngoài ra, bạn có thể vuốt trên bề mặt nút để điều chỉnh zoom, chọn bộ lọc màu hoặc thay đổi các thông số khác. Chức năng này cho phép người dùng điều chỉnh mọi thứ mà không cần phải chuyển tay lên màn hình, giữ cho trải nghiệm chụp ảnh linh hoạt và tiện lợi hơn.</p><figure class=\"image\"><img style=\"aspect-ratio:1200/1200;\" src=\"https://cdn-media.sforum.vn/storage/app/media/chibao/Chi-bao-chat-luong-cao/iphone-16-pro-co-gi-moi/iPhone-16-pro-co-gi-moi-5-3.jpg\" alt=\"Review iPhone 16 Pro\" width=\"1200\" height=\"1200\"><figcaption>Người dùng có thể sử dụng nút Camera Control để thay đổi tiêu cự zoom</figcaption></figure><h2><strong>Những câu hỏi về chức năng \"Camera Control\"</strong></h2><p>Khi Apple giới thiệu nút \"Camera Control\" trên iPhone 16 Pro, đã có rất nhiều thắc mắc xoay quanh tính năng này, hãy cùng tìm hiểu những câu hỏi thường gặp nhất về chức năng đặc biệt này nhé.</p><p>&nbsp;</p><h3>&nbsp;</h3><p>&nbsp;</p><p>&nbsp;</p>', NULL, 4, '2024-12-07 07:44:39', '2024-12-11 02:23:20', '2dI9ql8KSH4');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint UNSIGNED NOT NULL,
  `name_sp` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `price` decimal(65,2) NOT NULL,
  `stock` int NOT NULL DEFAULT '0',
  `variant_id` bigint UNSIGNED DEFAULT NULL,
  `category_id` bigint UNSIGNED NOT NULL,
  `supplier_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `colour_id` bigint UNSIGNED DEFAULT NULL,
  `battery_id` bigint UNSIGNED NOT NULL,
  `screen_id` bigint UNSIGNED DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name_sp`, `image`, `description`, `price`, `stock`, `variant_id`, `category_id`, `supplier_id`, `created_at`, `updated_at`, `colour_id`, `battery_id`, `screen_id`, `is_active`) VALUES
(8, 'Iphone 16', 'images/YY0I93dkB4vmw82nxjGUkNyOdj0fQdg59AcGbOZp.jpg', 'Màn hình Super Retina XDR Màn hình toàn phần OLED 6,1 inch (theo đường chéo) Độ phân giải 2556x1179 pixel với mật độ điểm ảnh 460 ppi Màn hình iPhone 15 có các góc bo tròn theo đường cong tuyệt đẹp và nằm gọn theo một hình chữ nhật chuẩn. Khi tính theo hình chữ nhật chuẩn, kích thước màn hình theo đường chéo là 6,12 inch (diện tích hiển thị thực tế nhỏ hơn).', '31999000.00', 92, 4, 4, 1, '2024-10-01 19:14:00', '2024-12-17 13:10:50', 1, 1, 1, 1),
(10, 'Iphone 12', 'images/JgcPlHFcyuy7yrIYX26rdEdPyaWMTldvV5g2gFdQ.jpg', 'Màn hình Super Retina XDR Màn hình toàn phần OLED 6,1 inch (theo đường chéo) Độ phân giải 2556x1179 pixel với mật độ điểm ảnh 460 ppi Màn hình iPhone 15 có các góc bo tròn theo đường cong tuyệt đẹp và nằm gọn theo một hình chữ nhật chuẩn. Khi tính theo hình chữ nhật chuẩn, kích thước màn hình theo đường chéo là 6,12 inch (diện tích hiển thị thực tế nhỏ hơn).', '12000000.00', 17, 4, 4, 1, '2024-10-04 01:05:37', '2024-12-17 12:58:12', 6, 1, 3, 1),
(12, 'Iphone x', 'images/Ee3WXHTJENuUGbaqUWaAy19klrVvUapqSvrInbnU.jpg', 'Màn hình Super Retina XDR Màn hình toàn phần OLED 6,1 inch (theo đường chéo) Độ phân giải 2556x1179 pixel với mật độ điểm ảnh 460 ppi Màn hình iPhone 15 có các góc bo tròn theo đường cong tuyệt đẹp và nằm gọn theo một hình chữ nhật chuẩn. Khi tính theo hình chữ nhật chuẩn, kích thước màn hình theo đường chéo là 6,12 inch (diện tích hiển thị thực tế nhỏ hơn).', '33333333.00', 40, 5, 4, 1, '2024-10-04 06:34:20', '2024-12-17 12:59:17', 3, 1, 1, 1),
(18, 'AirPod Pro 2', 'images/BsXacKTJER9tmu64pWpUaeCESZLrrsI3RhQaDvSS.jpg', 'Apple đã tạo ra 5 màu sắc khác nhau cho AirPods tương ứng với màu của iPhone 7, nhưng cuối cùng công bố mắt bản màu trắng. Theo Kosutami, nhà sưu tập nổi tiếng chuyên thu thập nguyên mẫu sản phẩm, Apple đã phát triển 5 nguyên mẫu AirPods với màu trắng, đen, vàng, hồng và đỏ tương ứng với màu của iPhone 7 ra mắt năm 2016.', '5000000.00', 22, NULL, 5, 3, '2024-10-19 20:43:27', '2024-12-06 12:38:42', 6, 1, NULL, 1),
(19, 'iphone15', 'images/e0Ylr2tCP70MG7iKVh9r1yCGYdNHncW6Mw9krtQK.png', 'Màn hình Super Retina XDR Màn hình toàn phần OLED 6,7 inch (theo đường chéo) Độ phân giải 2778x1284 pixel với mật độ điểm ảnh 458 ppi Màn hình iPhone 14 Plus có các góc bo tròn theo đường cong tuyệt đẹp và nằm gọn theo một hình chữ nhật chuẩn. Khi tính theo hình chữ nhật chuẩn, kích thước màn hình theo đường chéo là 6,68 inch (diện tích hiển thị thực tế nhỏ hơn).', '50000000.00', 20, 4, 4, 1, '2024-12-06 05:16:58', '2024-12-08 06:10:19', 4, 1, 1, 1),
(20, 'Pin dự phòng samsung', 'images/uqPVKbz9C03WmYRecJ6Cw21sIVQh9gUkN9DsWt4g.jpg', 'Pin rất trâu', '500000.00', 22, NULL, 7, 2, '2024-12-08 07:00:03', '2024-12-12 08:04:14', NULL, 1, NULL, 1),
(21, 'Sam Sung S23 ultra', 'images/9cBsVY9pp3veET0gZSFcZYW6NEqBWpD3C9g4e4QW.webp', 'Galaxy AI tiện ích - Khoanh vùng search đa năng, là trợ lý chỉnh ảnh, note thông minh, phiên dịch trực tiếp Thoả sức chụp ảnh, quay video chuyên nghiệp - Camera đến 200MP, chế độ chụp đêm cải tiến, bộ xử lí ảnh thông minh Chiến game bùng nổ - chip Snapdragon 8 Gen 2 8 nhân tăng tốc độ xử lí, màn hình 120Hz, pin 5.000mAh Nâng cao hiệu suất làm việc với Siêu bút S Pen tích hợp, dễ dàng đánh dấu sự kiện từ hình ảnh hoặc video Thiết kế bền bỉ, thân thiện - Màu sắc lấy cảm hứng từ thiên nhiên, chất liệu kính và lớp phim phủ PET tái chế', '20000000.00', 120, 4, 4, 2, '2024-12-08 14:11:54', '2024-12-08 14:14:59', 6, 1, 1, 1),
(22, 'Tai nghe Bluetooth True Wireless Xiaomi Redmi Buds 6 Active', 'images/CSWqadQ1AHX3WZ2GN7OWmEi1Japb62SJuvTTnbPs.jpg', 'Âm thanh mạnh mẽ: Màng loa 14.2mm mang đến âm thanh sống động và chi tiết Chống ồn đàm thoại ENC: Hỗ trợ loại bỏ tiếng ồn hiệu quả, cho cuộc gọi rõ ràng Kết nối ổn định: Bluetooth 5.4 đảm bảo kết nối nhanh, ổn định với thiết bị của bạn Thời lượng pin dài: Nghe nhạc liên tục 30 giờ với hộp sạc, đáp ứng nghe cả ngày', '1500000.00', 20, NULL, 5, 5, '2024-12-08 14:21:34', '2024-12-08 14:26:42', 12, 1, NULL, 1),
(23, 'tai nghe có dây cực kì đẹp', 'images/Goc21GfrDv52xOTNiDgazUu6LZOXJQjTVVraYwg7.webp', 'tai nghe có dây tiện lợi sinh hoạt', '299000.00', 20, NULL, 5, 7, '2024-12-08 14:41:40', '2024-12-08 14:41:56', 18, 1, NULL, 1),
(24, 'Pin sạc dự phòng Energizer', 'images/YIbvU6xGr4MLbtPGgmLEkbyep8S3E76nnkRJpe5W.jpg', 'Mới, đầy đủ phụ kiện từ nhà sản xuất Sạc dự phòng Cáp sạc Sách hướng dẫn Bảo hành 24 tháng chính hãng, 1 đổi 1. (xem chi tiết) Giá sản phẩm đã bao gồm VAT', '399000.00', 23, NULL, 7, 4, '2024-12-08 14:43:42', '2024-12-08 14:44:08', 6, 5, NULL, 1),
(25, 'Pin sạc dự phòng Aukey PB-N83S', 'images/w9OOeddM3NKXO61kUxmD6RQYJGMC4UA6wH1OOcOL.jpg', 'Mới, đầy đủ phụ kiện từ nhà sản xuất Sạc dự phòng Cáp sạc Sách hướng dẫn Bảo hành 24 tháng chính hãng, 1 đổi 1. (xem chi tiết) Giá sản phẩm đã bao gồm VAT', '399000.00', 20, NULL, 7, 9, '2024-12-08 14:45:43', '2024-12-08 14:46:25', 23, 5, NULL, 1),
(26, 'Nokia 110 4G Pro', 'images/lLxECDfK3l7MVjtYizvL8afAXwqvxhNuCZpJ8cIU.jpg', 'Mới, đầy đủ phụ kiện từ nhà sản xuất Nokia 110 4G Pro Pin Sạc Sách HDSD nhanh Bảo hành 12 tháng tại trung tâm bảo hành Chính hãng. 1 đổi 1 trong 30 ngày nếu có lỗi phần cứng từ nhà sản xuất. (xem chi tiết) Giá sản phẩm đã bao gồm VAT', '199000.00', 20, 4, 4, 10, '2024-12-08 14:51:28', '2024-12-08 14:51:57', 6, 1, NULL, 1),
(27, 'Samsung Galaxy S24 FE', 'images/degAFZwpsMPFuWkB192YuSzg8oyQrZ4XhgrBr4EQ.jpg', 'Mới, đầy đủ phụ kiện từ nhà sản xuất Điện thoại thông minh Cáp truyền dữ liệu Que lấy sim Bảo hành 12 tháng tại trung tâm bảo hành Chính hãng. 1 đổi 1 trong 30 ngày nếu có lỗi phần cứng từ nhà sản xuất. (xem chi tiết) Giá sản phẩm đã bao gồm VAT', '20000000.00', 34, 4, 4, 2, '2024-12-10 12:55:57', '2024-12-10 12:57:06', 16, 5, NULL, 1),
(28, 'Samsung Galaxy A15', 'images/eMa6MqnqN2NQmnj91JyTBeVJz4bh3kO1JqjcuO8q.jpg', 'Mới, đầy đủ phụ kiện từ nhà sản xuất Hộp, Sách hướng dẫn, Cây lấy sim, Cáp Type C Bảo hành 12 tháng tại trung tâm bảo hành Chính hãng. 1 đổi 1 trong 30 ngày nếu có lỗi phần cứng từ nhà sản xuất. (xem chi tiết) Giá sản phẩm đã bao gồm VAT', '45000000.00', 50, 5, 4, 2, '2024-12-10 13:00:25', '2024-12-10 13:00:59', 15, 5, NULL, 1),
(29, 'Nokia G50', 'images/rGYzij4iRKCp4dFqJeHrCwnSNwVvu9Gdle48bvHC.jpg', 'Nokia G50, Sách HDSD nhanh, Cáp USB Type-C, Sạc 5V2A, Miếng dán màn hình, Ốp silicon, Tai nghe Bảo hành 12 tháng tại trung tâm bảo hành Chính hãng. 1 đổi 1 trong 30 ngày nếu có lỗi phần cứng từ nhà sản xuất. (xem chi tiết) Giá sản phẩm đã bao gồm VAT', '45000000.00', 10, 4, 4, 10, '2024-12-10 13:28:36', '2024-12-10 13:28:36', 15, 1, NULL, 1),
(30, 'OPPO A79 5G', 'images/lzdpAlDOW7znnqs1rb8WUx1TXtIQzJJBh182KXaM.jpg', 'Mới, đầy đủ phụ kiện từ nhà sản xuất Điện thoại x 1 Cáp dữ liệu USB x 1 Bộ sạc x 1 Công cụ đẩy SIM x 1 Vỏ bảo vệ x1 Hướng dẫn sử dụng x1 Thẻ bảo hành x1 Bảo hành 12 tháng tại trung tâm bảo hành Chính hãng. 1 đổi 1 trong 30 ngày nếu có lỗi phần cứng từ nhà sản xuất. (xem chi tiết) Giá sản phẩm đã bao gồm VAT', '20000000.00', 10, 4, 4, 5, '2024-12-10 13:32:13', '2024-12-10 13:34:29', 19, 5, NULL, 1),
(31, 'OPPO A78', 'images/i2GXq8jXRxYuwJqdWN4GaixaefRjZYJLbviwKQnU.jpg', 'Mới, đầy đủ phụ kiện từ nhà sản xuất Hộp, Sách hướng dẫn, Cây lấy sim, Ốp lưng, Cáp Type C, Củ sạc nhanh rời đầu Type A Bảo hành 12 tháng tại trung tâm bảo hành Chính hãng. 1 đổi 1 trong 30 ngày nếu có lỗi phần cứng từ nhà sản xuất. (xem chi tiết) Giá sản phẩm đã bao gồm VAT', '20000000.00', 10, 4, 4, 5, '2024-12-10 13:33:57', '2024-12-10 13:35:19', 16, 4, NULL, 1),
(32, 'Samsung Galaxy Z Fold6', 'images/elrSEXkKgP0NhKgMfd7YUDV5snw4pmWGQ3azcd72.jpg', 'Mới, đầy đủ phụ kiện từ nhà sản xuất Bảo hành 12 tháng tại trung tâm bảo hành Chính hãng. 1 đổi 1 trong 30 ngày nếu có lỗi phần cứng từ nhà sản xuất. (xem chi tiết) Giá sản phẩm đã bao gồm VAT', '39000000.00', 20, 5, 4, 2, '2024-12-10 13:40:32', '2024-12-10 13:59:09', 16, 5, NULL, 1),
(33, 'iPhone 15 Pro Max 256GB', 'images/54tJFwvmlxiyhvXyufIk3wHzLsJOyz5OTG5hWjwX.jpg', 'Máy mới 100% , chính hãng Apple Việt Nam. CellphoneS hiện là đại lý bán lẻ uỷ quyền iPhone chính hãng VN/A của Apple Việt Nam Hộp, Sách hướng dẫn, Cây lấy sim, Cáp Type C 1 ĐỔI 1 trong 30 ngày nếu có lỗi phần cứng nhà sản xuất. Bảo hành 12 tháng tại trung tâm bảo hành chính hãng Apple: CareS.vn(xem chi tiết) Giá sản phẩm đã bao gồm VAT', '39000000.00', 20, 5, 4, 1, '2024-12-10 13:41:31', '2024-12-10 13:42:00', 12, 5, NULL, 1),
(34, 'iPhone 11', 'images/2bjKcUXs4wHkHbzGSfwLzc3jQnKefpDhRXJYcW60.jpg', 'Mới, đầy đủ phụ kiện từ nhà sản xuất Hộp, Sách hướng dẫn, Cây lấy sim, Cáp Lightning - Type C 1 ĐỔI 1 trong 30 ngày nếu có lỗi phần cứng nhà sản xuất. Bảo hành 12 tháng tại trung tâm bảo hành chính hãng Apple: CareS.vn(xem chi tiết) Giá sản phẩm đã bao gồm VAT', '12000000.00', 10, 4, 4, 1, '2024-12-10 13:57:47', '2024-12-10 14:01:08', 12, 1, NULL, 1),
(35, 'Samsung Galaxy Z Flip6', 'images/JeHSWnrjLPbsqqRnSbbO6ifk05y44icUpuvYIW54.jpg', 'Mới, đầy đủ phụ kiện từ nhà sản xuất Bảo hành 12 tháng tại trung tâm bảo hành Chính hãng. 1 đổi 1 trong 30 ngày nếu có lỗi phần cứng từ nhà sản xuất. (xem chi tiết) Giá sản phẩm đã bao gồm VAT', '15000000.00', 10, 4, 4, 2, '2024-12-10 13:58:34', '2024-12-10 13:58:34', 16, 5, NULL, 1),
(36, 'iPhone XR', 'images/qgokbXC6W3gWoTQKVf5UZcgCvz0VII1POZC7LbgP.jpg', 'Sản phẩm thu lại từ khách hàng không còn nhu cầu sử dụng, ngoại hình đẹp như máy mới (Một số sản phẩm có thể đã qua bảo hành hãng hoặc sửa chữa thay thế linh kiện) Có nguồn gốc rõ ràng, xuất hoá đơn eVAT. Bảo hành 6 tháng tại CellphoneS không loại trừ linh kiện, bảo hành cả nguồn, màn hình. 1 đổi 1 trong 30 ngày nếu có lỗi phần cứng từ nhà sản xuất(xem chi tiết) Giá sản phẩm đã bao gồm VAT', '11000000.00', 10, 4, 4, 1, '2024-12-10 14:16:13', '2024-12-10 14:18:25', 6, 1, NULL, 1),
(37, 'iPhone 8 Plus', 'images/feEtJKRo6ElR0NnzxRM6fRgPgpeLNri6Ef0ekeQK.jpg', 'Sản phẩm thu lại từ khách hàng không còn nhu cầu sử dụng, ngoại hình đẹp như máy mới (Một số sản phẩm có thể đã qua bảo hành hãng hoặc sửa chữa thay thế linh kiện) Có nguồn gốc rõ ràng, xuất hoá đơn eVAT. Bảo hành 6 tháng tại CellphoneS không loại trừ linh kiện, bảo hành cả nguồn, màn hình. 1 đổi 1 trong 30 ngày nếu có lỗi phần cứng từ nhà sản xuất(xem chi tiết) Giá sản phẩm đã bao gồm VAT', '8000000.00', 10, 4, 4, 1, '2024-12-10 14:16:50', '2024-12-10 14:18:35', 12, 1, NULL, 1),
(38, 'iPhone 14 Plus', 'images/nQlZvRs0okdxUtTb2X0dNIbaxZY3rZYIyCY6JJD6.jpg', 'Máy mới 100% , chính hãng Apple Việt Nam. CellphoneS hiện là đại lý bán lẻ uỷ quyền iPhone chính hãng VN/A của Apple Việt Nam Hộp, Sách hướng dẫn, Cây lấy sim, Cáp Lightning - Type C 1 ĐỔI 1 trong 30 ngày nếu có lỗi phần cứng nhà sản xuất. Bảo hành 12 tháng tại trung tâm bảo hành chính hãng Apple: CareS.vn(xem chi tiết) Giá sản phẩm đã bao gồm VAT', '25000000.00', 20, 4, 4, 1, '2024-12-10 14:18:11', '2024-12-10 14:18:48', NULL, 5, NULL, 1),
(39, 'Sạc dự phòng iphone đẹp', 'images/eVMiIv9Y6ZICUnVW1c0P8IVt0QqyvEQZvGv2ErsM.jpg', 'Mới, đầy đủ phụ kiện từ nhà sản xuất Pin dự phòng, Cáp sạc, Sách HDSD Bảo hành 12 tháng chính hãng, 1 đổi 1(xem chi tiết) Giá sản phẩm đã bao gồm VAT', '1200000.00', 10, NULL, 7, 1, '2024-12-10 14:25:52', '2024-12-10 14:30:30', NULL, 5, NULL, 1),
(40, 'Pin sạc dự phòng Samsung', 'images/xbf5Nyc4J0G0P73XYz7LxUmdbC9xP8c33TzkXtwP.jpg', 'Mới, đầy đủ phụ kiện từ nhà sản xuất Sạc dự phòng, Cáp sạc Type-C to C, Sách hướng dẫn Bảo hành 12 tháng chính hãng, 1 đổi 1(xem chi tiết) Giá sản phẩm đã bao gồm VAT', '1400000.00', 10, NULL, 7, 8, '2024-12-10 14:26:25', '2024-12-10 14:38:22', NULL, 5, NULL, 1),
(41, 'Pin sạc dự phòng Samsung ATB', 'images/emqazhCVAFAUOtsIIkgG14nrXkxxBEhbxKbQBix8.jpg', 'Mới, đầy đủ phụ kiện từ nhà sản xuất Sạc dự phòng, Cáp sạc Type-C to C, Sách hướng dẫn Bảo hành 12 tháng chính hãng, 1 đổi 1(xem chi tiết) Giá sản phẩm đã bao gồm VAT', '13900000.00', 10, NULL, 7, 7, '2024-12-10 14:26:25', '2024-12-10 14:35:18', NULL, 5, NULL, 1),
(42, 'Tai nghe Bluetooth True Wireless OPPO Enco Air3i', 'images/oVqaluNAZyJBj2taI2pXbs551PEnemR4BMVJzifr.jpg', 'Mới, đầy đủ phụ kiện từ nhà sản xuất Tai nghe và Hộp sạc, Sách hướng dẫn Bảo hành 18 tháng chính hãng 1 đổi 1 trong 15 ngày nếu có lỗi phần cứng từ NSX.(xem chi tiết) Giá sản phẩm đã bao gồm VAT', '400000.00', 10, NULL, 5, 6, '2024-12-10 14:27:12', '2024-12-10 14:37:37', 22, 5, NULL, 1),
(43, 'iphone 6s', 'images/uNnEyWno1depHum76HhU2n4VCLFYCotrw5wrbHx4.jpg', 'SP được thu lại từ khách bán lại-thu cũ, ngoại hình trầy nhẹ thân máy, mặt kính màn hình. Sản phẩm có thể đã qua bảo hành hãng hoặc sửa chữa thay thế linh kiện để đảm bảo sự ổn định khi dùng. Có nguồn gốc rõ ràng, xuất hoá đơn eVAT. Không bao gồm phụ kiện Bảo hành 6 tháng tại CellphoneS không loại trừ linh kiện, bảo hành cả nguồn, màn hình. 1 đổi 1 trong 30 ngày nếu có lỗi phần cứng từ nhà sản xuất(xem chi tiết) Giá sản phẩm đã bao gồm VAT', '600000.00', 10, 4, 4, 1, '2024-12-10 14:41:40', '2024-12-10 14:41:40', 12, 1, NULL, 1),
(44, 'Tai nghe Bluetooth', 'images/SN9zHwTJDVcKVlnLo2uxFjAEfrmN3Kk1YmlEAow4.jpg', 'Mới, đầy đủ phụ kiện từ nhà sản xuất Tai nghe, Cáp sạc USB-C, Sách hướng dẫn Bảo hành 12 tháng chính hãng 1 đổi 1 trong 15 ngày nếu có lỗi phần cứng từ NSX. (xem chi tiết) Giá sản phẩm đã bao gồm VAT', '20000000.00', 10, NULL, 5, 6, '2024-12-10 14:42:28', '2024-12-10 14:42:28', 13, 1, NULL, 1),
(45, 'OPPO Find N3 Flip 5G', 'images/2lxNsMlChJMWrCtoTtZiaxrtjyByK9BoBDbAEWyd.jpg', 'Trọng lượng sản phẩm  198 g Chất liệu  Khung máy: Kim loại, Mặt lưng máy: Kính cường lực Gorilla Glass 7 Phiên bản CPU  Mediatek Dimensity 9200 5G Số nhân  RAM  Kích thước màn hình  Chuẩn màn hình  Độ phân giải  Dung lượng (ROM)  256 GB iPhone 16 128GB iPhone 16 128GB 21.990.000 ₫ 22.990.000 ₫  So sánh chi tiết 170 g Mặt lưng máy: Kính, Khung máy: Nhôm nguyên khối Apple A18 6 8 GB 6.1 inch Super Retina XDR 2556 x 1179 Pixels 128 GB iPhone 14 Plus 128GB iPhone 14 Plus 128GB 20.190.000 ₫ 24.990.000 ₫  So sánh chi tiết 203 g Apple A15 Bionic 6 6 GB 6.7 inch Super Retina XDR 2778 x 1284 Pixels 128 GB iPhone 14 128GB iPhone 14 128GB 17.290.000 ₫ 21.990.000 ₫  So sánh chi tiết 172 g Apple A15 Bionic 6 6 GB 6.1 inch Super Retina XDR 2532 x 1170 Pixels 128 GB Samsung Galaxy Z Flip4 5G 128GB Samsung Galaxy Z Flip4 5G 128GB 9.990.000 ₫ 23.990.000 ₫  So sánh chi tiết 183 g Khung máy: Kim loại, Mặt lưng máy: Kính cường lực Snapdragon 8+ Gen 1 8 8 GB 6.7 inch', '17490000.00', 35, NULL, 4, 5, '2024-12-12 08:00:40', '2024-12-12 08:12:19', NULL, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `variant_id` bigint UNSIGNED DEFAULT NULL,
  `colour_id` bigint UNSIGNED NOT NULL,
  `image_path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `variant_id`, `colour_id`, `image_path`, `updated_at`, `created_at`) VALUES
(1, 8, NULL, 2, 'images/p2E2lLOUNYeU0IUUahYzqEItX6suIRUlawLbynBF.jpg', '2024-10-02 20:53:03', '2024-10-02 20:53:03'),
(2, 8, NULL, 8, 'images/zOb52nntSShaY6tPnXpOH4FJvgyl6LOOxpjdTLl4.jpg', '2024-10-02 20:55:39', '2024-10-02 20:55:39'),
(3, 8, NULL, 7, 'images/d5vHYLZrG1PzmQXWGYYlPCJjgk8wzoSn6CH9dBma.jpg', '2024-10-02 20:56:03', '2024-10-02 20:56:03'),
(4, 8, NULL, 6, 'images/468ttyluiauSbJcVtmfiK6u7bhrgu5PN7y4Kwv8Y.jpg', '2024-10-02 20:56:34', '2024-10-02 20:56:34'),
(6, 18, NULL, 13, 'images/FjqoVp9fJ3vmaI3AQxPAc4VjKnHs7bGaJvUWjiu5.jpg', '2024-10-21 19:34:16', '2024-10-19 21:05:43'),
(7, 18, NULL, 12, 'images/WTQwgN9g0eULXcu3ZLBWqtShlXGb4UDdWF4SZREQ.jpg', '2024-10-21 19:34:32', '2024-10-19 21:05:54'),
(8, 19, NULL, 15, 'images/N4At2z1fiZziHx6ZIU565sa2bFsjWLjPmt8zkjO5.jpg', '2024-12-06 05:18:00', '2024-12-06 05:18:00'),
(9, 19, NULL, 16, 'images/C420DIs3DpCumiKVHsQPqD3Y2iLjhz4YxkNdpOLb.jpg', '2024-12-06 05:19:38', '2024-12-06 05:19:38'),
(10, 20, NULL, 17, 'images/vqLP4PgexVcLSVjQBS6tCQfGcQKoZL1EydGHNXLY.jpg', '2024-12-08 07:01:58', '2024-12-08 07:01:58'),
(11, 20, NULL, 18, 'images/TixUX90mDVpzkR7IsiFneqgzI23KYKB14q5Z0Bh5.jpg', '2024-12-08 07:02:12', '2024-12-08 07:02:12'),
(12, 21, NULL, 19, 'images/Hn3gcSVNkuPayE3O08o7HBefeFLeydzeTCiGsImW.webp', '2024-12-08 14:15:13', '2024-12-08 14:15:13'),
(13, 21, NULL, 20, 'images/GlitI6KW9gygG2powYTU8RnHIHsmXktCq74JYLvO.webp', '2024-12-08 14:15:45', '2024-12-08 14:15:45'),
(14, 22, NULL, 22, 'images/tQFNE0SGsRaJ4P1dNrbDqAzcz76jK6omw1mNDHXv.jpg', '2024-12-08 14:22:28', '2024-12-08 14:22:28'),
(16, 23, NULL, 23, 'images/Is00gTNyBDs24VYLgyucFKNX34b1GBNPZb55OEpJ.webp', '2024-12-08 14:42:14', '2024-12-08 14:42:14'),
(17, 24, NULL, 24, 'images/Qh1CvQbszi5JvFyInTT9nT72hrx5Wk2egUK8vabB.jpg', '2024-12-08 14:44:21', '2024-12-08 14:44:21'),
(18, 25, NULL, 25, 'images/LSjg8XYGRtdyxRWwOdSHyrhLloTkfCOIZ8dwWU2U.jpg', '2024-12-08 14:46:36', '2024-12-08 14:46:36'),
(19, 26, NULL, 26, 'images/lqgIliVEQuG62ng5EyfFOXrZnGhijxJOnGjmSle4.jpg', '2024-12-08 14:52:09', '2024-12-08 14:52:09'),
(20, 27, NULL, 27, 'images/biwpp4K18Gr6BwduItmbX3SlB8qBowA6KPPwv3pP.jpg', '2024-12-10 12:56:47', '2024-12-10 12:56:47'),
(21, 27, NULL, 28, 'images/QZmgWEKVqqX9UswNFFGfkMXyVmygU07QeLlWsVNR.jpg', '2024-12-10 12:57:24', '2024-12-10 12:57:24'),
(22, 28, NULL, 29, 'images/EnUVItezl1q9lt0cMMEvdV2lvd9ODmQyTMADFI4U.jpg', '2024-12-10 13:01:09', '2024-12-10 13:01:09'),
(23, 29, NULL, 30, 'images/xpRSP9XSLkSRqTdCbmx4gCXHW4eDVrHgWnz1Ttl3.jpg', '2024-12-10 13:29:05', '2024-12-10 13:29:05'),
(24, 30, NULL, 31, 'images/FEk9mIfp6WrTQ8In0QeVdrNXD8X7rTQnxlV577AP.jpg', '2024-12-10 13:34:55', '2024-12-10 13:34:55'),
(25, 31, NULL, 32, 'images/k4koAmElkoagg1l9S7XcMyB9Ff5V9tHIratvtv30.jpg', '2024-12-10 13:35:29', '2024-12-10 13:35:29'),
(26, 32, NULL, 34, 'images/YpYqQaD9htTbmpMQBPz3dyIfhetZWq2vtmUZTS54.jpg', '2024-12-10 13:42:11', '2024-12-10 13:42:11'),
(27, 33, NULL, 35, 'images/ZAv79umeswbKeaG9yGQxApExxuE9KrQuLqZXsp0G.jpg', '2024-12-10 13:42:28', '2024-12-10 13:42:28'),
(28, 34, NULL, 37, 'images/ppzmORcqrOlZBPetKgbjWieBzugYTgWSFVfltGSx.jpg', '2024-12-10 14:01:36', '2024-12-10 14:01:36'),
(29, 35, NULL, 38, 'images/jF6DLr8qAY5XA8EFv5npp0BQAf8SbGaohPELtFVp.jpg', '2024-12-10 14:01:43', '2024-12-10 14:01:43'),
(30, 36, NULL, 39, 'images/S5z67ECvhVzai0eUemvBkycwCYeJrNvc3WP33eCs.jpg', '2024-12-10 14:19:06', '2024-12-10 14:19:06'),
(31, 37, NULL, 40, 'images/ItCSOAdPQB1soJtZTrZmtQUgTfuQbj8bfZRjeBY1.jpg', '2024-12-10 14:19:15', '2024-12-10 14:19:15'),
(32, 38, NULL, 41, 'images/6H3dKJtdAtEnQxKt1ZyT94hy8di4kOdcn2lwuHmx.jpg', '2024-12-10 14:19:26', '2024-12-10 14:19:26'),
(33, 39, NULL, 42, 'images/epuqVzTyd6I28mtDTlU5tXP00VX9kBHEcpfJ1mD1.jpg', '2024-12-10 14:31:41', '2024-12-10 14:31:41'),
(34, 40, NULL, 43, 'images/zHA3WDIzWQFTXVbS28paDqJ2HiBEtKRFBXKZmuH9.jpg', '2024-12-10 14:31:52', '2024-12-10 14:31:52'),
(35, 41, NULL, 44, 'images/4TBA0VkBUNf9rIlcLnsZzGLPNk9kWe2UPDabW9Qh.jpg', '2024-12-10 14:32:01', '2024-12-10 14:32:01'),
(36, 42, NULL, 45, 'images/falENoRlVB1PDGIorJKHYgJHD0vRUHBdC4HIsym4.jpg', '2024-12-10 14:32:11', '2024-12-10 14:32:11'),
(37, 43, NULL, 46, 'images/rDO9ynTRVLwzIbfnGBtEEnJtZ8jM8Rub2zFGkekx.jpg', '2024-12-10 14:43:19', '2024-12-10 14:43:19'),
(38, 44, NULL, 47, 'images/sPXtTTtNZGdDrX26llMne0RLdKhCsQDLenq1a94F.jpg', '2024-12-10 14:43:27', '2024-12-10 14:43:27'),
(39, 10, NULL, 24, 'images/n0rHPI8FYur5Gvkmx9i4KP9MGaw3bfsvI41aikmP.jpg', '2024-12-10 14:53:17', '2024-12-10 14:48:31'),
(40, 10, NULL, 49, 'images/KFX8eZp7WYqXK0olsA2mOQVgDYsnZz9KOfD6xluu.jpg', '2024-12-10 14:49:43', '2024-12-10 14:49:43'),
(41, 10, NULL, 50, 'images/NbsIc9Kc1265a4xAFWcoBRtr6R3efKmy6OHNSTAh.jpg', '2024-12-10 14:49:59', '2024-12-10 14:49:59'),
(42, 10, NULL, 35, 'images/EomvV05NA3Tw7j3TwU50F3GrDrJcMU3G8ChofCll.jpg', '2024-12-10 14:52:56', '2024-12-10 14:51:30'),
(43, 45, NULL, 52, 'images/wHB4PO25A0XLu32v5GuR8bmvguNKXhH7eNgIOGrk.jpg', '2024-12-12 08:02:34', '2024-12-12 08:02:34'),
(44, 45, NULL, 53, 'images/tpE9vw0ZFi9IxeFLMv5fQYp9N92MGsgQtRIXx081.jpg', '2024-12-12 08:02:49', '2024-12-12 08:02:49'),
(45, 12, NULL, 55, 'images/EO2cXNh046MHkxxoMbUNLVbSb0GEYe1CxApDs9te.jpg', '2024-12-17 13:00:21', '2024-12-17 13:00:21'),
(46, 12, NULL, 56, 'images/GozPuyVUAVrikZkH2czbud5v7KXh0oH2l5Fmo1Xq.jpg', '2024-12-17 13:00:37', '2024-12-17 13:00:37');

-- --------------------------------------------------------

--
-- Table structure for table `product_variant`
--

CREATE TABLE `product_variant` (
  `id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `variant_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_variant`
--

INSERT INTO `product_variant` (`id`, `product_id`, `variant_id`, `created_at`, `updated_at`) VALUES
(2, 8, 5, '2024-12-01 09:20:21', '2024-12-01 09:20:21'),
(3, 8, 6, '2024-12-01 09:20:27', '2024-12-01 09:20:27'),
(4, 8, 4, '2024-12-01 09:20:41', '2024-12-01 09:20:41'),
(5, 10, 4, '2024-12-01 09:27:51', '2024-12-01 09:27:51'),
(6, 19, 5, '2024-12-06 05:18:14', '2024-12-06 05:18:14'),
(7, 19, 6, '2024-12-06 05:19:49', '2024-12-06 05:19:49'),
(8, 19, 4, '2024-12-06 05:19:57', '2024-12-06 05:19:57'),
(9, 21, 5, '2024-12-08 14:16:13', '2024-12-08 14:16:13'),
(10, 21, 6, '2024-12-08 14:16:24', '2024-12-08 14:16:39'),
(11, 21, 4, '2024-12-08 14:16:33', '2024-12-08 14:16:33'),
(12, 29, 4, '2024-12-10 13:42:57', '2024-12-10 13:42:57'),
(13, 30, 5, '2024-12-10 13:43:03', '2024-12-10 13:43:03'),
(14, 31, 4, '2024-12-10 13:43:11', '2024-12-10 13:43:11'),
(15, 32, 5, '2024-12-10 13:43:18', '2024-12-10 13:43:18'),
(16, 33, 5, '2024-12-10 13:43:25', '2024-12-10 13:43:25'),
(17, 27, 5, '2024-12-10 14:00:17', '2024-12-10 14:00:17'),
(18, 34, 4, '2024-12-10 14:01:54', '2024-12-10 14:01:54'),
(19, 35, 5, '2024-12-10 14:02:01', '2024-12-10 14:02:01'),
(20, 36, 4, '2024-12-10 14:19:50', '2024-12-10 14:19:50'),
(21, 37, 5, '2024-12-10 14:19:56', '2024-12-10 14:19:56'),
(22, 38, 4, '2024-12-10 14:20:02', '2024-12-10 14:20:02'),
(23, 43, 4, '2024-12-10 14:43:50', '2024-12-10 14:43:50'),
(24, 10, 5, '2024-12-11 15:49:05', '2024-12-11 15:49:25'),
(25, 10, 6, '2024-12-11 15:49:12', '2024-12-11 15:49:34'),
(26, 45, 4, '2024-12-12 08:03:36', '2024-12-12 08:03:36'),
(27, 45, 5, '2024-12-12 08:03:46', '2024-12-12 08:03:46');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `user_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `rating` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `images` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `videos` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `order_item_id` bigint UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `product_id`, `user_id`, `user_image`, `name`, `email`, `content`, `rating`, `created_at`, `updated_at`, `images`, `videos`, `order_item_id`) VALUES
(179, 8, 12, NULL, NULL, 'Nguyenhiep21222@example.com', 'eee', 4, '2024-12-01 19:53:01', '2024-12-01 19:53:01', '\"[\\\"images\\\\\\/eaBDmIdaRFbSqdKjv1vq7US22pHyHMkOow7RgpGT.png\\\"]\"', '\"[]\"', NULL),
(180, 8, 12, NULL, NULL, 'Nguyenhiep21222@example.com', 'ffff', 4, '2024-12-03 14:20:06', '2024-12-03 14:20:06', '\"[\\\"images\\\\\\/RE3LuXspgClpBtgbl4xQr7nu9QGuShYeRn2Qg2Cu.jpg\\\"]\"', '\"[]\"', NULL),
(181, 8, 12, NULL, NULL, 'Nguyenhiep21222@example.com', 'đâs', 4, '2024-12-03 14:20:21', '2024-12-03 14:20:21', '\"[\\\"images\\\\\\/GYcdgwps3fItDwmIGPwuqBWNGptJo0pTVyVaxD2E.webp\\\"]\"', '\"[]\"', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'admin', NULL, NULL),
(2, 'employee', NULL, NULL),
(3, 'user', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `screens`
--

CREATE TABLE `screens` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `screens`
--

INSERT INTO `screens` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Màn hình toàn phần OLED 6,1 inch', '2024-09-23 19:08:58', '2024-09-23 19:08:58'),
(3, 'Màn hình toàn phần OLED 6,7 inch', '2024-10-01 19:48:42', '2024-10-01 19:48:42');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` bigint UNSIGNED NOT NULL,
  `session_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ip_address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `session_id`, `ip_address`, `user_agent`, `created_at`, `updated_at`) VALUES
(242, 'iqXzHFtMzkW2PrRDbPSbi3SP6tkTEpkCj5si9Vxt', '171.253.240.48', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', '2024-12-17 09:36:09', '2024-12-17 09:36:09'),
(243, 'tTRyP9S6ddpRsJ1HZBhfd7mQAk92Oy1dU0miN6R7', '171.253.240.48', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', '2024-12-17 09:36:13', '2024-12-17 09:36:13'),
(244, 'QCcyVwqbB8yJ4rUcE3Ipk5ewT6I8FyMbulPVz7Zt', '171.224.178.44', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36 Edg/131.0.0.0', '2024-12-17 12:44:35', '2024-12-17 12:44:35'),
(245, '9QyOFYuSk0AUxj6VgLx1dfBJ102hvdkM9kbvdW79', '171.224.178.44', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36 Edg/131.0.0.0', '2024-12-17 12:49:26', '2024-12-17 12:49:26'),
(246, 'RZonUnJsow6liplaL2HDReAHqQZ0PHw3V4rU68fc', '171.224.178.44', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36 Edg/131.0.0.0', '2024-12-17 12:56:47', '2024-12-17 12:56:47');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `brand` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `category_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `name`, `brand`, `created_at`, `updated_at`, `category_id`) VALUES
(1, 'Apple', 'IPhone', '2024-09-22 20:24:14', '2024-09-22 20:26:23', 4),
(2, 'Sumsung', 'Samsung Galaxy', '2024-10-16 07:18:20', '2024-10-16 07:18:20', 4),
(3, 'Apple', 'AirPods', '2024-10-16 07:19:30', '2024-10-16 07:19:30', 5),
(4, 'Oppo', 'Sạc dự phòng Oppo', '2024-12-08 08:44:45', '2024-12-08 08:46:41', 7),
(5, 'Oppo', 'Oppo', '2024-12-08 08:46:54', '2024-12-08 08:46:54', 4),
(6, 'Oppo', 'Tai nghe Oppo', '2024-12-08 08:47:37', '2024-12-08 08:47:37', 5),
(7, 'Sumsung', 'Tai nghe Sumsung', '2024-12-08 08:49:07', '2024-12-08 08:49:07', 5),
(8, 'Sumsung', 'Sạc dự phòng Sumsung', '2024-12-08 08:49:29', '2024-12-08 08:49:29', 7),
(9, 'Apple', 'Sạc dự phong Iphone', '2024-12-08 08:49:52', '2024-12-08 08:49:52', 7),
(10, 'Nokia', 'Nokia', '2024-12-08 14:49:19', '2024-12-08 14:49:19', 4);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name_user` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_id` bigint UNSIGNED DEFAULT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `sex` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name_user`, `image`, `email`, `password`, `role_id`, `remember_token`, `created_at`, `updated_at`, `sex`, `date_of_birth`) VALUES
(11, 'tung', NULL, 'tungdzpro2@gmail.com', '$2y$12$SVOnKEDLTCPE41iMHQQsVOiHkYGsnd2j0WbszvDYlsWuU1UVLNj/e', 3, NULL, '2024-10-01 04:14:12', '2024-10-01 04:14:12', NULL, NULL),
(12, 'Hiep', NULL, 'Nguyenhiep21222@example.com', '$2y$12$o1AaniaRb60Hxg6Xpf05yedYhLIZpAqi9fSWenrreuJAek0X1jtb6', 1, NULL, NULL, '2024-12-08 08:22:28', 'male', '2024-10-01'),
(15, 'Cương', 'storage/images/wL9Opv0rRkTUwKNcPTkDtKN1GuE24pojJDs1Xkxq.jpg', 'biintrinh@gmail.com', '$2y$12$w/4yUbtwFVYPX3hMqgRFgePuN734/Bo/CcNzdniIX8Lw0ZLuhQUFm', 3, NULL, '2024-10-15 04:43:57', '2024-11-06 12:08:45', 'male', '2024-11-06'),
(16, 'minh vu', NULL, 'minh@gmail.com', '$2y$12$1lAumeLXJuSFUV0PiTNBqeolrXCeddoKYjFzAC2lYtztdl71V44Rm', 3, NULL, '2024-10-29 01:23:10', '2024-10-29 01:23:10', NULL, NULL),
(17, 'Nguyễn Phương Hoàng Hiệp', NULL, 'nguyen21222@gmail.com', '$2y$12$QEeqmMAMEZDyynjjLx/Qp.2b1G3LCPA0TcN5ZNo/nNwdKkSWJ/LtS', 3, NULL, '2024-11-20 04:32:31', '2024-11-20 04:32:31', NULL, NULL),
(21, 'đức lê', NULL, 'levanduc@gmail.com', '$2y$12$5jK3UJRT1XlI.Qfw5AWX1eajn3JqsTwX.DQJ.JKIHYZVD/pbZFt9G', 1, NULL, '2024-12-06 06:07:41', '2024-12-06 06:07:41', NULL, NULL),
(23, 'Dương Thế Duy', NULL, 'duyanh@gmail.com', '$2y$12$u7eiLwyB1PSiZ2emWjTxeuK8pO00gUilIH4po3JGfEu4EJjEEdXda', 2, NULL, '2024-12-06 06:10:43', '2024-12-06 06:10:50', NULL, NULL),
(24, 'Hong Hai Nhi', NULL, 'hhn@gmail.com', '$2y$12$68urG0onAbqX/2U1IozfmeTzg/7fOq6cgS.0tqQz0sht6dRD0pNCe', 3, NULL, '2024-12-06 06:20:40', '2024-12-06 06:20:40', NULL, NULL),
(27, 'Ly Thanh Tung', NULL, 'muahang123@gmail.com', '$2y$12$.ykbq3EcVuEIG6bT2CC6vuvBdugGvQVRly9yjsMW6qFASZl9dMG32', 3, NULL, '2024-12-16 02:32:45', '2024-12-16 02:32:45', NULL, NULL),
(28, 'Người Mua Hàng', NULL, 'muahang133@gmail.com', '$2y$12$xhyVA0GlPafUxZnV.xU/O.Nv0j6D7P6u5cDg9XXB5/VN3LOV9sba6', 3, NULL, '2024-12-16 06:38:56', '2024-12-16 06:38:56', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `variants`
--

CREATE TABLE `variants` (
  `id` bigint UNSIGNED NOT NULL,
  `ram_smartphone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `variants`
--

INSERT INTO `variants` (`id`, `ram_smartphone`, `price`, `created_at`, `updated_at`) VALUES
(4, '128GB', '5000000.00', '2024-10-01 19:53:33', '2024-10-01 19:53:33'),
(5, '256GB', '10000000.00', '2024-10-01 19:53:43', '2024-10-01 19:53:43'),
(6, '512GB', '15000000.00', '2024-10-01 19:53:55', '2024-10-01 19:53:55'),
(8, '64GB', '250000.00', '2024-12-08 08:57:46', '2024-12-08 08:57:56');

-- --------------------------------------------------------

--
-- Table structure for table `wishlists`
--

CREATE TABLE `wishlists` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wishlists`
--

INSERT INTO `wishlists` (`id`, `user_id`, `product_id`, `created_at`, `updated_at`) VALUES
(36, 12, 10, '2024-12-05 15:57:29', '2024-12-05 15:57:29'),
(38, 12, 18, '2024-12-05 16:06:24', '2024-12-05 16:06:24');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `batterys`
--
ALTER TABLE `batterys`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_cart` (`user_id`);

--
-- Indexes for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cart_items_product_id_foreign` (`product_id`),
  ADD KEY `cart_items_battery_id_foreign` (`battery_id`),
  ADD KEY `cart_items_variant_id_foreign` (`variant_id`),
  ADD KEY `cart_items_color_id_foreign` (`color_id`),
  ADD KEY `cart_items_cart_id_foreign` (`cart_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `colours`
--
ALTER TABLE `colours`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comments_post_id_foreign` (`post_id`),
  ADD KEY `comments_user_id_foreign` (`user_id`);

--
-- Indexes for table `discount_codes`
--
ALTER TABLE `discount_codes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `discount_codes_code_unique` (`code`),
  ADD KEY `discount_codes_product_id_foreign` (`product_id`),
  ADD KEY `discount_codes_user_id_foreign` (`user_id`);

--
-- Indexes for table `discount_code_product`
--
ALTER TABLE `discount_code_product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `discount_code_product_discount_code_id_foreign` (`discount_code_id`),
  ADD KEY `discount_code_product_product_id_foreign` (`product_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`id`),
  ADD KEY `inventory_product_id_foreign` (`product_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `messages_user_id_foreign` (`user_id`),
  ADD KEY `messages_session_id_foreign` (`session_id`);

--
-- Indexes for table `message_media`
--
ALTER TABLE `message_media`
  ADD PRIMARY KEY (`id`),
  ADD KEY `message_media_message_id_foreign` (`message_id`);

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
  ADD KEY `orders_user_id_foreign` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`),
  ADD KEY `order_items_product_id_foreign` (`product_id`),
  ADD KEY `fk_order_items_battery_id` (`battery_id`),
  ADD KEY `fk_order_items_color_id` (`color_id`),
  ADD KEY `fk_variant_id` (`variant_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `posts_category_id_foreign` (`category_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_variant_id_foreign` (`variant_id`),
  ADD KEY `products_category_id_foreign` (`category_id`),
  ADD KEY `products_suppliers_id_foreign` (`supplier_id`),
  ADD KEY `products_colour_id_foreign` (`colour_id`),
  ADD KEY `products_battery_id_foreign` (`battery_id`),
  ADD KEY `products_creen_id_foreign` (`screen_id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `variant_id` (`variant_id`),
  ADD KEY `colour_id` (`colour_id`);

--
-- Indexes for table `product_variant`
--
ALTER TABLE `product_variant`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `variant_id` (`variant_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reviews_product_id_foreign` (`product_id`),
  ADD KEY `reviews_user_id_foreign` (`user_id`),
  ADD KEY `reviews_order_item_id_foreign` (`order_item_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Indexes for table `screens`
--
ALTER TABLE `screens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sessions_session_id_unique` (`session_id`),
  ADD UNIQUE KEY `session_id` (`session_id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `suppliers_category_id_foreign` (`category_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_role_id_foreign` (`role_id`);

--
-- Indexes for table `variants`
--
ALTER TABLE `variants`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `wishlists_user_id_foreign` (`user_id`),
  ADD KEY `wishlists_product_id_foreign` (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `batterys`
--
ALTER TABLE `batterys`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `cart_items`
--
ALTER TABLE `cart_items`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `colours`
--
ALTER TABLE `colours`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `discount_codes`
--
ALTER TABLE `discount_codes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `discount_code_product`
--
ALTER TABLE `discount_code_product`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=840;

--
-- AUTO_INCREMENT for table `message_media`
--
ALTER TABLE `message_media`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=314;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=175;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=143;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `product_variant`
--
ALTER TABLE `product_variant`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=182;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `screens`
--
ALTER TABLE `screens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sessions`
--
ALTER TABLE `sessions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=247;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `variants`
--
ALTER TABLE `variants`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `wishlists`
--
ALTER TABLE `wishlists`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `fk_user_cart` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD CONSTRAINT `cart_items_battery_id_foreign` FOREIGN KEY (`battery_id`) REFERENCES `batterys` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_items_cart_id_foreign` FOREIGN KEY (`cart_id`) REFERENCES `carts` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `cart_items_color_id_foreign` FOREIGN KEY (`color_id`) REFERENCES `colours` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_items_variant_id_foreign` FOREIGN KEY (`variant_id`) REFERENCES `variants` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `colours`
--
ALTER TABLE `colours`
  ADD CONSTRAINT `colours_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `discount_codes`
--
ALTER TABLE `discount_codes`
  ADD CONSTRAINT `discount_codes_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `discount_codes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `discount_code_product`
--
ALTER TABLE `discount_code_product`
  ADD CONSTRAINT `discount_code_product_discount_code_id_foreign` FOREIGN KEY (`discount_code_id`) REFERENCES `discount_codes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `discount_code_product_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `inventory`
--
ALTER TABLE `inventory`
  ADD CONSTRAINT `inventory_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `fk_order_items_battery_id` FOREIGN KEY (`battery_id`) REFERENCES `batterys` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_order_items_color_id` FOREIGN KEY (`color_id`) REFERENCES `colours` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_variant_id` FOREIGN KEY (`variant_id`) REFERENCES `variants` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_battery_id_foreign` FOREIGN KEY (`battery_id`) REFERENCES `batterys` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `products_colour_id_foreign` FOREIGN KEY (`colour_id`) REFERENCES `colours` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `products_creen_id_foreign` FOREIGN KEY (`screen_id`) REFERENCES `screens` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `products_supplier_id_foreign` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `products_variant_id_foreign` FOREIGN KEY (`variant_id`) REFERENCES `variants` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `product_images_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_images_ibfk_2` FOREIGN KEY (`variant_id`) REFERENCES `variants` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `product_images_ibfk_3` FOREIGN KEY (`colour_id`) REFERENCES `colours` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_variant`
--
ALTER TABLE `product_variant`
  ADD CONSTRAINT `product_variant_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_variant_ibfk_2` FOREIGN KEY (`variant_id`) REFERENCES `variants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_order_item_id_foreign` FOREIGN KEY (`order_item_id`) REFERENCES `order_items` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `reviews_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD CONSTRAINT `suppliers_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD CONSTRAINT `wishlists_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `wishlists_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
