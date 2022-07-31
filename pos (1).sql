-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 31, 2022 at 12:02 PM
-- Server version: 8.0.27
-- PHP Version: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pos`
--

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

DROP TABLE IF EXISTS `brands`;
CREATE TABLE IF NOT EXISTS `brands` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `business_id` int NOT NULL DEFAULT '0',
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `business_id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(4, 0, 'Jamuna Electronics', 'ddd', '2022-06-06 06:15:09', '2022-06-06 06:15:09'),
(6, 0, 'MARCEL', 'ddd', '2022-06-06 06:15:26', '2022-06-06 06:15:26'),
(7, 0, 'Singer', 'ddd', '2022-06-06 06:15:36', '2022-06-06 06:15:36');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `code`, `description`, `created_at`, `updated_at`) VALUES
(3, 'Computers', 'cm', NULL, '2022-06-06 06:16:26', '2022-06-06 06:16:26'),
(4, 'Wearable Technology', NULL, NULL, '2022-06-06 06:16:37', '2022-06-06 06:16:37'),
(5, 'TV & Video', NULL, NULL, '2022-06-06 06:16:49', '2022-06-06 06:16:49');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
CREATE TABLE IF NOT EXISTS `customers` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mobile_number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `national_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `credit_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `mobile_number`, `address`, `email`, `national_id`, `credit_number`, `created_at`, `updated_at`) VALUES
(1, 'cutomer 1', '3232', 'dwdsd', NULL, NULL, NULL, NULL, NULL),
(2, 'ab', '3232', 'sfdf', NULL, NULL, NULL, NULL, NULL),
(3, 'cscd', '0171244113', 'csdc', NULL, NULL, NULL, '2022-07-13 16:32:41', '2022-07-13 16:32:41'),
(4, 'cscd', '0171244113', 'csdc', 'admin@gmail.com', NULL, NULL, '2022-07-13 17:05:15', NULL),
(5, 'cscd', '0171244113', 'csdc', 'admin@gmail.com', NULL, NULL, '2022-07-13 17:06:43', NULL),
(6, 'mamun', '0171244113', 'csdc', 'new@gmail.com', NULL, NULL, '2022-07-14 17:07:08', NULL),
(7, 'mamun', '0171244113', 'csdc', 'new@gmail.com', NULL, NULL, '2022-07-14 17:09:49', NULL),
(8, 'mamun', '0171244113', 'cac', 'new@gmail.com', NULL, NULL, '2022-07-16 16:06:05', NULL),
(9, 'mamun', '0171244113', 'csdc', 'new@gmail.com', NULL, NULL, '2022-07-16 16:07:27', NULL),
(10, 'dewd', '0171244113', 'csdc', 'mhmamun29d404@gmail.com', NULL, NULL, '2022-07-16 16:08:07', NULL),
(11, 'mamun', '0171244113', 'csdc', 'new@gmail.com', NULL, NULL, '2022-07-16 16:15:22', NULL),
(12, 'mamun', '0171244113', 'csdc', 'new@gmail.com', NULL, NULL, '2022-07-16 20:54:04', NULL),
(13, 'mamun', '0171244113', 'csdc', 'new@gmail.com', NULL, NULL, '2022-07-16 20:54:19', NULL),
(14, 'mamun', '0171244113', 'csdc', 'new@gmail.com', NULL, NULL, '2022-07-16 20:54:26', NULL),
(15, 'cscd', '0171244113', 'csdc', 'admin@gmail.com', NULL, NULL, '2022-07-16 20:54:57', NULL),
(16, 'cscd', '0171244113', 'csdc', 'admin@gmail.com', NULL, NULL, '2022-07-16 20:55:27', NULL),
(17, 'dewd', '0171244113', 'csdc', 'mhmamun29d404@gmail.com', NULL, NULL, '2022-07-16 20:55:58', NULL),
(18, 'vdv', '434', 'dd', NULL, NULL, NULL, '2022-07-30 22:36:46', NULL),
(19, 'cds', '32', '32ds', NULL, NULL, NULL, '2022-07-31 03:46:42', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

DROP TABLE IF EXISTS `expenses`;
CREATE TABLE IF NOT EXISTS `expenses` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `expense_category_id` bigint UNSIGNED NOT NULL,
  `outlet_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `amount` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remark` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`id`, `expense_category_id`, `outlet_id`, `name`, `amount`, `remark`, `created_at`, `updated_at`) VALUES
(2, 2, 7, 'salary', '10000', NULL, NULL, NULL),
(4, 1, 6, 'ee', '3232', NULL, '2022-07-06 17:37:57', '2022-07-06 17:37:57'),
(5, 1, 7, 'w', '1222', NULL, '2022-07-06 17:39:00', '2022-07-06 17:39:00');

-- --------------------------------------------------------

--
-- Table structure for table `expense_categories`
--

DROP TABLE IF EXISTS `expense_categories`;
CREATE TABLE IF NOT EXISTS `expense_categories` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `expense_categories`
--

INSERT INTO `expense_categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'current bill', NULL, NULL),
(2, 'cashier salary', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `connection` text COLLATE utf8_unicode_ci NOT NULL,
  `queue` text COLLATE utf8_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_05_27_173819_create_brands_table', 1),
(6, '2022_05_30_041531_create_categories_table', 1),
(7, '2022_05_30_181019_create_sub_categories_table', 1),
(8, '2022_05_30_181033_create_outlets_table', 1),
(9, '2022_05_31_171649_create_products_table', 1),
(10, '2022_06_05_065551_create_stock_transfers_table', 1),
(11, '2022_06_05_100409_create_transfer_products_table', 1),
(12, '2022_06_05_173633_create_temporary_stocks_table', 1),
(13, '2022_06_29_050613_create_customers_table', 1),
(14, '2022_07_04_091849_create_expense_categories_table', 1),
(15, '2022_07_04_092029_create_expenses_table', 1),
(16, '2022_07_07_062030_create_sales_table', 1),
(17, '2022_07_07_063141_create_sale_items_table', 1),
(18, '2022_07_31_095853_create_sale_dues_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `outlets`
--

DROP TABLE IF EXISTS `outlets`;
CREATE TABLE IF NOT EXISTS `outlets` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `location_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `division` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `district` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mobile` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `custom1` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `custom2` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `outlets`
--

INSERT INTO `outlets` (`id`, `name`, `location_id`, `division`, `district`, `city`, `mobile`, `phone`, `email`, `custom1`, `custom2`, `created_at`, `updated_at`) VALUES
(6, 'Outlet 1', NULL, 'Dhaka', 'Dhaka', 'Dhaka', '01712441133', '0171244113', 'outlet1@gmail.com', NULL, NULL, '2022-06-06 05:56:00', '2022-06-06 05:56:00'),
(7, 'Outlet 2', NULL, 'Dhaka', 'kolabagan', 'kolabagan', '01300847431', NULL, 'outlet2@gmail.com', NULL, NULL, '2022-06-06 05:56:35', '2022-06-06 05:56:35');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sku` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `outlet_id` bigint UNSIGNED NOT NULL,
  `brand_id` bigint UNSIGNED DEFAULT NULL,
  `category_id` bigint UNSIGNED DEFAULT NULL,
  `subcategory_id` bigint UNSIGNED DEFAULT NULL,
  `barcode_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `alert_quantity` int DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `brochure` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `custom1` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `custom2` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `quantity` int DEFAULT NULL,
  `applicable_tax` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `exc_purchase_price` decimal(10,2) NOT NULL,
  `inc_purchase_price` decimal(10,2) NOT NULL,
  `selling_price` decimal(10,2) NOT NULL,
  `margin` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `products_outlet_id_foreign` (`outlet_id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `sku`, `outlet_id`, `brand_id`, `category_id`, `subcategory_id`, `barcode_type`, `alert_quantity`, `description`, `image`, `brochure`, `custom1`, `custom2`, `quantity`, `applicable_tax`, `exc_purchase_price`, `inc_purchase_price`, `selling_price`, `margin`, `created_at`, `updated_at`) VALUES
(12, 'Acer Aspire E 15', 'sku55', 6, 4, 3, 3, 'C128', 10, NULL, 'uploads/product/1654540949.png', NULL, NULL, NULL, 6, '10', '100.00', '110.00', '120.00', '9.09', '2022-06-06 06:42:29', '2022-07-31 03:46:43'),
(13, 'Apple iPhone 8', 'sku96', 6, 4, 3, NULL, 'C128', 12, NULL, NULL, NULL, NULL, NULL, 12, 'none', '233.00', '233.00', '245.00', '5.15', '2022-06-06 06:44:39', '2022-07-31 03:46:43'),
(14, 'led tv', 'sku85', 7, 4, 5, NULL, 'EAN8', 23, 'dddddd', 'uploads/product/1654542693.png', NULL, NULL, NULL, 34, '10', '23.00', '25.30', '45.00', '80.00', '2022-06-06 07:11:33', '2022-06-06 07:11:33'),
(15, 'Panasonic Home Theatre', 'sku91', 7, 6, 5, NULL, 'EAN8', 12, NULL, NULL, NULL, NULL, NULL, 7, '8', '23.00', '24.84', '34.00', '41.67', '2022-06-15 07:13:02', '2022-06-15 07:13:02'),
(16, 'product 5', 'sku76', 6, 4, 3, 3, 'C128', NULL, NULL, NULL, NULL, NULL, NULL, 23, '10', '333.00', '366.30', '3333.00', '810.66', '2022-06-12 08:12:24', '2022-07-31 03:46:43');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

DROP TABLE IF EXISTS `sales`;
CREATE TABLE IF NOT EXISTS `sales` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `customer_id` bigint UNSIGNED NOT NULL,
  `outlet_id` bigint UNSIGNED NOT NULL,
  `invoice_no` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `md_discount` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `special_discount` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `parcent_discount` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `vat` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `pay_amount` decimal(10,2) DEFAULT NULL,
  `due_amount` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `installment_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `payment_method` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `total` decimal(8,2) NOT NULL,
  `remarks` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `customer_id`, `outlet_id`, `invoice_no`, `md_discount`, `special_discount`, `parcent_discount`, `vat`, `status`, `pay_amount`, `due_amount`, `installment_type`, `payment_method`, `total`, `remarks`, `created_at`, `updated_at`) VALUES
(1, 18, 6, 'RE310722', NULL, NULL, NULL, NULL, 'Paid', '8000.00', '-3', NULL, 'Cash', '7891.00', NULL, '2022-07-30 22:36:46', '2022-07-31 04:16:33'),
(2, 19, 6, 'RE310722', NULL, NULL, NULL, NULL, 'Due', '100.00', '3594', NULL, 'Cash', '3698.00', NULL, '2022-07-31 03:46:43', '2022-07-31 04:08:18');

-- --------------------------------------------------------

--
-- Table structure for table `sale_dues`
--

DROP TABLE IF EXISTS `sale_dues`;
CREATE TABLE IF NOT EXISTS `sale_dues` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `order_id` bigint UNSIGNED NOT NULL,
  `payment_dat` date DEFAULT NULL,
  `note` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sale_dues`
--

INSERT INTO `sale_dues` (`id`, `order_id`, `payment_dat`, `note`, `created_at`, `updated_at`) VALUES
(1, 2, '2022-07-31', NULL, '2022-07-31 04:08:18', '2022-07-31 04:08:18'),
(2, 2, '2022-08-01', NULL, '2022-07-31 04:16:33', '2022-07-31 04:16:33');

-- --------------------------------------------------------

--
-- Table structure for table `sale_items`
--

DROP TABLE IF EXISTS `sale_items`;
CREATE TABLE IF NOT EXISTS `sale_items` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `order_id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `product_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `qty` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `price` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sale_items`
--

INSERT INTO `sale_items` (`id`, `order_id`, `product_id`, `product_name`, `qty`, `price`, `created_at`, `updated_at`) VALUES
(1, 1, 13, 'Apple iPhone 8', '5', 245.00, '2022-07-30 22:36:46', NULL),
(2, 1, 16, 'product 5', '2', 3333.00, '2022-07-30 22:36:46', NULL),
(3, 2, 12, 'Acer Aspire E 15', '1', 120.00, '2022-07-31 03:46:43', NULL),
(4, 2, 13, 'Apple iPhone 8', '1', 245.00, '2022-07-31 03:46:43', NULL),
(5, 2, 16, 'product 5', '1', 3333.00, '2022-07-31 03:46:43', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `stock_transfers`
--

DROP TABLE IF EXISTS `stock_transfers`;
CREATE TABLE IF NOT EXISTS `stock_transfers` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `reference` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `loc_from` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `loc_to` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `note` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `total_amount` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `stock_transfers`
--

INSERT INTO `stock_transfers` (`id`, `date`, `reference`, `loc_from`, `loc_to`, `note`, `total_amount`, `status`, `created_at`, `updated_at`) VALUES
(24, '2022-06-10', 'dcsc', '7', '6', '3323', '723', '2', NULL, '2022-06-28 05:29:53'),
(25, '2022-06-11', NULL, '7', '6', NULL, '3333', '2', NULL, '2022-07-03 16:45:42');

-- --------------------------------------------------------

--
-- Table structure for table `sub_categories`
--

DROP TABLE IF EXISTS `sub_categories`;
CREATE TABLE IF NOT EXISTS `sub_categories` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `category_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sub_categories_category_id_foreign` (`category_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sub_categories`
--

INSERT INTO `sub_categories` (`id`, `category_id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(3, 3, 'laptop', NULL, '2022-06-06 06:18:03', '2022-06-06 06:18:03'),
(4, 5, 'home tv', NULL, '2022-06-06 06:18:16', '2022-06-06 06:18:16'),
(5, 5, 'Office Tv', NULL, '2022-06-06 06:18:23', '2022-06-06 06:18:23');

-- --------------------------------------------------------

--
-- Table structure for table `temporary_stocks`
--

DROP TABLE IF EXISTS `temporary_stocks`;
CREATE TABLE IF NOT EXISTS `temporary_stocks` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `product_id` bigint UNSIGNED NOT NULL,
  `quantity` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transfer_products`
--

DROP TABLE IF EXISTS `transfer_products`;
CREATE TABLE IF NOT EXISTS `transfer_products` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `stock_transfer_id` bigint UNSIGNED NOT NULL,
  `product_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `qty` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `subtotal` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `transfer_products`
--

INSERT INTO `transfer_products` (`id`, `stock_transfer_id`, `product_id`, `qty`, `subtotal`, `created_at`, `updated_at`) VALUES
(16, 24, '14', '1', '45', '2022-06-28 04:40:02', '2022-06-28 04:40:02'),
(17, 24, '15', '2', '68', '2022-06-28 04:40:02', '2022-06-28 04:40:02'),
(18, 24, '12', '1', '120', '2022-06-28 04:40:02', '2022-06-28 04:40:02'),
(19, 24, '13', '2', '490', '2022-06-28 04:40:02', '2022-06-28 04:40:02'),
(20, 25, '16', '1', '3333', '2022-06-28 16:05:26', '2022-06-28 16:05:26');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `role_id` int NOT NULL,
  `busineess_id` int NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nid` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gender` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `busineess_id`, `name`, `email`, `phone`, `nid`, `email_verified_at`, `password`, `photo`, `gender`, `dob`, `address`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Mamuns', 'superadmin@gmail.com', '01300847431', '31431433', NULL, '$2y$10$XSU97dYFXpjzCa95ct5ARepSmEANu9/q4Heim4qesWzy7FR/yyppO', 'uploads/user/1654256164.PNG', 'male', '2012-04-12', 'dhakas', NULL, NULL, '2022-06-04 07:48:07'),
(5, 2, 6, 'cashier 1', 'cashier1@gmail.com', '01300847431', NULL, NULL, '$2y$10$XSU97dYFXpjzCa95ct5ARepSmEANu9/q4Heim4qesWzy7FR/yyppO', NULL, NULL, NULL, NULL, NULL, '2022-06-06 06:03:44', '2022-06-06 06:05:40'),
(6, 2, 7, 'cashier 2', 'cashier2@gmail.com', '01712441131', NULL, NULL, '$2y$10$N5mGKxhYeiLXqF1Vo2Ku.OCytlSKA4QntOYFk/dt4gagDxveHFWa.', NULL, NULL, NULL, NULL, NULL, '2022-06-06 06:04:14', '2022-06-06 06:06:01');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
