-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 17, 2018 at 02:54 AM
-- Server version: 5.7.22-0ubuntu0.16.04.1
-- PHP Version: 7.1.16-1+ubuntu16.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sample_ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `category` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT '1',
  `icon` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category`, `status`, `icon`, `created_at`, `updated_at`) VALUES
(1, 'category1', 1, '1524765932_sq-sample31.jpg', '2018-04-25 08:41:22', '2018-04-26 10:05:32'),
(2, 'category2', 1, '1524765987_sq-sample30.jpg', '2018-04-26 10:06:27', '2018-04-26 10:06:27'),
(3, 'category3', 1, '1524765998_sq-sample38.jpg', '2018-04-26 10:06:38', '2018-04-26 10:06:38'),
(4, 'category4', 1, '1524766010_sq-sample36.jpg', '2018-04-26 10:06:50', '2018-04-26 10:06:50'),
(5, 'category5', 1, '1524766026_sq-sample34.jpg', '2018-04-26 10:07:06', '2018-04-26 10:07:06'),
(6, 'category6', 1, '1524766039_sq-sample33.jpg', '2018-04-26 10:07:19', '2018-04-26 10:07:19'),
(7, 'category7', 1, '1524766116_sq-sample27.jpg', '2018-04-26 10:08:36', '2018-04-26 10:08:36'),
(8, 'category8', 1, '1524766128_sq-sample28.jpg', '2018-04-26 10:08:48', '2018-04-26 10:08:48');

-- --------------------------------------------------------

--
-- Table structure for table `colors`
--

CREATE TABLE `colors` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_menu` tinyint(4) NOT NULL DEFAULT '0',
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `colors`
--

INSERT INTO `colors` (`id`, `name`, `is_menu`, `status`, `created_at`, `updated_at`) VALUES
(1, '#3c1c1c', 0, 1, '2018-05-02 09:28:05', '2018-05-02 10:44:09'),
(2, '#f31fd2', 0, 1, '2018-05-02 09:42:27', '2018-05-02 10:38:23'),
(3, '#581111', 1, 1, '2018-05-14 09:39:15', '2018-05-14 09:39:15');

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `id` int(10) UNSIGNED NOT NULL,
  `type_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `entity_id` int(10) UNSIGNED DEFAULT NULL,
  `icon` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `class` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `text` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `assets` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `history_types`
--

CREATE TABLE `history_types` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `history_types`
--

INSERT INTO `history_types` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'User', '2018-04-22 04:23:28', '2018-04-22 04:23:28'),
(2, 'Role', '2018-04-22 04:23:28', '2018-04-22 04:23:28');

-- --------------------------------------------------------

--
-- Table structure for table `home_slider`
--

CREATE TABLE `home_slider` (
  `id` int(10) UNSIGNED NOT NULL,
  `type` enum('image','video','youtubevideo') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'image',
  `url` text COLLATE utf8mb4_unicode_ci,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `youtubevideo_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `home_slider`
--

INSERT INTO `home_slider` (`id`, `type`, `url`, `image`, `youtubevideo_id`, `created_at`, `updated_at`, `title`) VALUES
(6, 'image', 'products/1', '1525297647_ws_Bridge_1920x1080.jpg', '', '2018-04-29 17:40:24', '2018-05-02 14:53:46', 'Featured Image'),
(7, 'youtubevideo', NULL, '', 'yIIGQB6EMAM', '2018-05-02 13:47:39', '2018-05-02 13:47:39', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `materials`
--

CREATE TABLE `materials` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `materials`
--

INSERT INTO `materials` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Material1', 1, '2018-05-02 06:45:23', '2018-05-02 06:45:23');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2015_12_28_171741_create_social_logins_table', 1),
(4, '2015_12_29_015055_setup_access_tables', 1),
(5, '2016_07_03_062439_create_history_tables', 1),
(6, '2017_04_04_131153_create_sessions_table', 1),
(7, '2018_04_22_143840_create_products_table', 2),
(8, '2018_04_25_155718_create_table_category', 3),
(9, '2018_04_25_155737_create_table_subcategory', 3),
(10, '2018_04_25_163506_change_table_category', 4),
(11, '2018_04_29_024449_create_table_home_slider', 5),
(12, '2018_05_02_082832_create_table_styles', 6),
(13, '2018_05_02_104309_create_table_materials', 6),
(14, '2018_05_02_120137_create_table_weaves', 6),
(15, '2018_05_02_165742_colors', 7),
(16, '2018_05_02_221427_add_slider_title', 8),
(17, '2018_05_03_140406_add_fields_products', 9),
(18, '2018_05_04_101019_add_field_product_country_of_origin', 10),
(19, '2018_05_08_070613_create_table_product_sizes', 11),
(20, '2018_05_13_123134_add_field_is_menu', 12),
(21, '2018_05_16_151047_create_table_user_favourites', 13);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `display_name`, `created_at`, `updated_at`) VALUES
(1, 'view-backend', 'View Backend', '2018-04-22 04:23:27', '2018-04-22 04:23:27');

-- --------------------------------------------------------

--
-- Table structure for table `permission_role`
--

CREATE TABLE `permission_role` (
  `id` int(10) UNSIGNED NOT NULL,
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permission_role`
--

INSERT INTO `permission_role` (`id`, `permission_id`, `role_id`) VALUES
(1, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `detail` text COLLATE utf8mb4_unicode_ci,
  `brand` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shop` text COLLATE utf8mb4_unicode_ci,
  `country_origin` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `knote_per_sq` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foundation` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shape` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `border_color_id` int(11) DEFAULT NULL,
  `color_id` int(11) DEFAULT NULL,
  `weave_id` int(11) DEFAULT NULL,
  `material_id` int(11) DEFAULT NULL,
  `style_id` int(11) DEFAULT NULL,
  `width` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `length` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sku` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `subcategory_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `main_image` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `type`, `detail`, `brand`, `shop`, `country_origin`, `knote_per_sq`, `foundation`, `shape`, `border_color_id`, `color_id`, `weave_id`, `material_id`, `style_id`, `width`, `length`, `sku`, `category_id`, `subcategory_id`, `main_image`, `created_at`, `updated_at`) VALUES
(1, 'Product 1777', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '["1525295678_product2.jpg","1525295679_product4.jpg","1525295679_product5.jpg","1525295679_product7.jpg","1525295679_product8.jpg","1525295679_product9.jpg"]', '2018-04-21 16:00:00', '2018-04-29 08:25:44'),
(3, 'Product 2', 'rug', 'dfdfdfdfdfdf', 'sdsdsdsd', '[]', 'Aland Islands', '2', 'Foundation', 'Accent', 3, 2, 1, 1, 2, '11', '11', 'dsdsdsd', 2, NULL, '["1525295679_product7.jpg","1525295679_product4.jpg","1525295678_product2.jpg","1525295679_product5.jpg","1525295679_product8.jpg","1525295679_product9.jpg"]', '2018-04-22 09:28:35', '2018-05-15 08:13:05'),
(4, 'Product 3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '["1525295679_product5.jpg","1525295678_product2.jpg","1525295679_product4.jpg","1525295679_product7.jpg","1525295679_product8.jpg","1525295679_product9.jpg"]', '2018-04-21 16:00:00', '2018-04-22 09:36:44'),
(5, 'Product 4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '["1525295678_product2.jpg","1525295679_product4.jpg","1525295679_product5.jpg","1525295679_product7.jpg","1525295679_product8.jpg","1525295679_product9.jpg"]', '2018-04-22 09:28:35', '2018-04-22 09:36:32'),
(6, 'Product 5', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '["1525295678_product2.jpg","1525295679_product4.jpg","1525295679_product5.jpg","1525295679_product7.jpg","1525295679_product8.jpg","1525295679_product9.jpg"]', '2018-04-21 16:00:00', '2018-04-22 09:36:44'),
(7, 'Product 6', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '["1525295678_product2.jpg","1525295679_product4.jpg","1525295679_product5.jpg","1525295679_product7.jpg","1525295679_product8.jpg","1525295679_product9.jpg"]', '2018-04-22 09:28:35', '2018-04-22 09:36:32'),
(8, 'Product 7', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '["1525295678_product2.jpg","1525295679_product4.jpg","1525295679_product5.jpg","1525295679_product7.jpg","1525295679_product8.jpg","1525295679_product9.jpg"]', '2018-04-21 16:00:00', '2018-04-22 09:36:44'),
(9, 'Product 8', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '["1525295678_product2.jpg","1525295679_product4.jpg","1525295679_product5.jpg","1525295679_product7.jpg","1525295679_product8.jpg","1525295679_product9.jpg"]', '2018-04-22 09:28:35', '2018-04-22 09:36:32'),
(10, 'Product 9', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '["1525295678_product2.jpg","1525295679_product4.jpg","1525295679_product5.jpg","1525295679_product7.jpg","1525295679_product8.jpg","1525295679_product9.jpg"]', '2018-04-21 16:00:00', '2018-04-22 09:36:44'),
(11, 'Product 10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '["1525295678_product2.jpg","1525295679_product4.jpg","1525295679_product5.jpg","1525295679_product7.jpg","1525295679_product8.jpg","1525295679_product9.jpg"]', '2018-04-22 09:28:35', '2018-05-02 13:14:39'),
(12, 'Product 11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '["1525295678_product2.jpg","1525295679_product4.jpg","1525295679_product5.jpg","1525295679_product7.jpg","1525295679_product8.jpg","1525295679_product9.jpg"]', '2018-04-21 16:00:00', '2018-04-22 09:36:44'),
(13, 'Product 12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '["1525295678_product2.jpg","1525295679_product4.jpg","1525295679_product5.jpg","1525295679_product7.jpg","1525295679_product8.jpg","1525295679_product9.jpg"]', '2018-04-22 09:28:35', '2018-04-22 09:36:32'),
(14, 'New Product With detail', 'rug', 'Product Detail\r\nProduct Detail\r\nProduct Detail\r\nProduct Detail\r\nProduct Detail\r\nProduct Detail\r\nProduct Detail', 'New Brand', '<p>Shop Address Shop Address Shop Address Shop Address Shop Address Shop Address</p>\r\n\r\n<p><a href="http://www.google.com" target="_blank">Google Product Link</a></p>\r\n\r\n<p><a href="http://www.amazon.com" target="_blank">Amazon Link</a></p>', 'India', '15', 'Foundation', 'Accent', 2, 1, 1, 1, 1, '15', '10', 'sku001', 1, '1', '["1525363526_product9.jpg","1525363526_product8.jpg","1525363526_product3.jpg","1525363526_product4.jpg"]', '2018-05-03 08:05:27', '2018-05-07 09:09:26'),
(15, 'New FUrniture', 'furniture', 'erererererererererererererererererer', 'furniture brand', '{"amazon_link":"http:\\/\\/www.amazon.com","ebay_link":"http:\\/\\/www.ebay.com","other_link":"http:\\/\\/www.example.org"}', 'India', '12', 'foundation', 'Accent', 1, 1, 1, 1, 1, '12', '15', 'furniture sku', 1, '1', '["1525785228_product8.jpg","1525785228_product9.jpg"]', '2018-05-08 05:13:49', '2018-05-08 05:13:49'),
(16, 'Furniture 2', 'furniture', 'rddrtrdtrdtdrt', 'brand', '{"amazon_link":"http:\\/\\/www.amazon.com","ebay_link":"http:\\/\\/www.ebay.com","other_link":"http:\\/\\/www.example.org"}', 'India', '32', 'FOundation', 'Large Rectangle', 2, 2, 1, 1, 2, '16', '18', 'sku2', 1, '1', '["1525785558_product8.jpg","1525785558_product4.jpg"]', '2018-05-08 05:19:18', '2018-05-08 05:19:18'),
(17, 'Furniture 3', 'furniture', 'fdfdfzdfdzfdzfzdfdz', 'furniture brand', '{"amazon_link":"http:\\/\\/www.amazon.com","ebay_link":"http:\\/\\/www.ebay.com","other_link":"http:\\/\\/www.example.org"}', 'Iceland', '17', 'Foundation', 'Accent', 2, 1, 1, 1, 1, '12', '15', 'sku001', 1, '1', '["1525785743_product7.jpg","1525785743_product3.jpg"]', '2018-05-08 05:22:24', '2018-05-08 05:22:24'),
(18, 'Furniture 4', 'furniture', 'dfdfxdgfxgfxgfxgfxgxfgfxgfxgxfgxfgxfgxfgfxgxfgxfgxfgxfgxfgxfgxfgfxgfxgxfgfx', 'sdsdsdsdsds', '{"amazon_link":"http:\\/\\/www.amazon.com","ebay_link":"http:\\/\\/www.ebay.com","other_link":"http:\\/\\/www.example.org"}', 'American Samoa', '15', 'Foundation', 'Accent', 1, 1, 1, 1, 1, '21', '24', 'sds', 1, '1', '["1525785814_product3.jpg","1525785814_product5.jpg"]', '2018-05-08 05:23:34', '2018-05-08 05:23:34');

-- --------------------------------------------------------

--
-- Table structure for table `product_sizes`
--

CREATE TABLE `product_sizes` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `width` decimal(10,2) NOT NULL,
  `length` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `all` tinyint(1) NOT NULL DEFAULT '0',
  `sort` smallint(5) UNSIGNED NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `all`, `sort`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 1, 1, '2018-04-22 04:23:26', '2018-04-22 04:23:26'),
(2, 'Executive', 0, 2, '2018-04-22 04:23:26', '2018-04-22 04:23:26'),
(3, 'User', 0, 3, '2018-04-22 04:23:26', '2018-04-22 04:23:26');

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`id`, `user_id`, `role_id`) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 3, 3),
(4, 4, 3);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('4x4lsvGv4HVdG2tsaRaj9DoYIVfR9U01fSfzmtdu', NULL, '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/65.0.3325.181 Chrome/65.0.3325.181 Safari/537.36', 'ZXlKcGRpSTZJa1JWZW10T1pUbHdlVnd2Y2s5NlNXVmpTREpHWkd0QlBUMGlMQ0oyWVd4MVpTSTZJak53TTJKeVVXRkZWVnBXZUhobFlXZGhYQzlPZGxwTE5UTXpXblZyVm5GbGJVNDJOMHRWUmxFMWREVkVRV0k0S3l0aWVtTjBLM1JMUzNOVmExZFhYQzlhWWxCNFMwcGFWRGRDVmpCVVJsbG5TemhGWW01SFIwNXZZMGd6U1U1V1JFWkpRbk53Y21sNlkwRm9ha0pDUW1KQ1lVSkRNMFpqVDJVNFJIazVYQzlMZGtWSksyTndhRzVMVVhwdVZtZFhRWEJRYjFNeFoyZFFjSEo2ZVN0S2NqVmxOVTg0U1dFclkxd3ZORzVUV25WMGIwUjJOSEpZVTJ4cVZsd3ZaalZuZW1kVVdrUlVOM1p1YUdaUWVVeFdRWFZHV1RKVU5sZG9iVFkzYm01cFowODFaM1F5T1VaQmVFNXpPV0pqUzBKSGRIbGpRM1YxTWxSTU0xZDJSbk54TUVOWFVGWnVNRkpQVVhkck5VaDNPVXB5TVZ3dmNEVlVVVzFPVURGWVZVaExObHBFZVV4NE9EbGFaRlJhVDJ4VGNtWTRUVlZWVVRCS09YQlNYQzgxVTAxdlYzbzJZM2wxUWtWRk1YbE5abVJ3UVVGb2NuaHpTMXBpZDJ0S04wRTlQU0lzSW0xaFl5STZJamsyWVRnd016QmxOVFE0WlRVM00yUTJObUU0WlRWbU5qQXpabVF4WkRaaE9EY3pNMkUxT1RSbU0yRmxPR05rTXpoaE16RTNOVEZqTm1ObFl6azBZVEVpZlE9PQ==', 1525844533),
('DrLPiXQdTVAndcG9nFuIEd2oggYz8wfTeGxOXpbJ', NULL, '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:59.0) Gecko/20100101 Firefox/59.0', 'ZXlKcGRpSTZJbEkzZHpoMUswSm5Zemt4Y21veFMyaHlhbHB2YjJjOVBTSXNJblpoYkhWbElqb2lSSGhUYVZWdVFuTmpWMGN5U1hSU2FXRllPRE5yYTJWWVRXcEZiblpuYlhoQmJqTTNSVmxzUjFSck5EUkhOMnBCWkVwSWMyWmxTMEYyTlROcE5HaGNMMEoyT1VRek9VbFRTMlY2TjFwb2RtbDJOVEUzU3pSVGFVdEVVbEUwU0N0cVdsZEVYQzkwZUZGSmRrZHJVSFpjTDNWdk0yUlpRVnB5YVhOdVVGSkRObXBvTm5ack9ITjVUVk56YlhOdk1VcE1UbFZwTTBsVk1qQXhaa2xsTlN0aU5uTTJRMlUzWW5aTGNWQkdTME5STWxZeFJqVk9kWGsyZW1ocVJta3JNMXBsU2xNek1rVnBlbUl6YjBWSlJrUnNabFZYZGpORVdWRnBUMVJyUzJ4Y0wwVmFVM2xWYVhOVmFUaEZZVEJZV1VoRlZrSmNMMUp5TlhSTlR6aGtjMlpzVFRkdVRIaEljazVZWlVreFUxUk1aRlpXVDFCaFQxazBkSFo2YUdFeFVEWm9SV2cxTWtWaFVtUlBlRXc0T0hoS2JXOHJkMkZYVm1WWmFsZFJUM2RvWkcxUE1YaHFPRTFNT0dsWEswRnJWazFpY0dvNWNsaDVWV00xVFdoSU5FNXVWbEZyVDBvMlkyRXJWM2RoUW5CT1RtbFNOMjFjTDFORGRHbElORXQ1VFZWQllWYzFaRFZETTNwclkxRXhZVTVCTjJoRFdqbE5kbEowUzJKcU4wWjZRbFo2TlhCT05XMXVZbmxoVWpGRlNYVTBSSEJaTldKeFNWUTVjWFJzZDJGeWNYTkllblJPUTJkQ1VsUXJlWFJxWEM5c1lXRlhOMFpDV2pONVZGSjFRalpKUjFSV1drWTVjRmxGYXpkY0x6VnJUSEZDWlhZd1pWbE9ObFl5UWs4NFJGWXpibGxMVkdReWEzRm9SbWRGWEM5WUt6bENUak5FTkdoTWFVSkdUMDFDU1d4WlVERlhWalo1Vm1ORVExaG1aVVJYVFVNd1BTSXNJbTFoWXlJNklqaGxNREU1TUROallUUXhZVFJrWm1FM01XTTBOVEprTXpneE5qSmpPRFUzTVRNellXTTVNR05qWlRVMllqRXhNakF5WkRVNU1qRTFZelJpWm1VeU5XWWlmUT09', 1526401931),
('NpzlXZ5dNhnMFTztJqUpgzEWBsOF03uBueo1gW2b', 4, '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/65.0.3325.181 Chrome/65.0.3325.181 Safari/537.36', 'ZXlKcGRpSTZJa0ZtSzNwWlJUaFJibXRWVTI5ak9FdGtkRkZvVFdjOVBTSXNJblpoYkhWbElqb2lkbXczTWpKSlprTTFTVkJjTDB4WWJETjNNM295Y2t0Q2RGcHdkRkpKTXpOR2NYbEZlVUVyUkU1WlltVXpkbkZsTTJJNGREVldZVlp5UzBwMFVqWnZkbVJzUTNCY0x6QlFRWFl5T0dseGJYZ3JiR1YxU1dkWlJWSlphRXhXUkRCUVFsaEtiR05DTlN0R2QyRkdTVGgxY25Ka2RXeGNMM3B5VjNOYU5EWkVSVEJzY21RMVNHNVBXRGRwYlU4MlYzaG5kSFZjTDF3dlUzWk5SWEJhVlRScU5rVmlPWEZQTWs1dVJrTlpSMnhDVFhnNGFrcGpibEpTYjBsNlhDOTZRa1pVYjJsSlkxQldWM00yYW1WMU5qRkRLME0xU1RFeGF6VjVSWGRCYWpCY0x6bHFWMVYzVTFOVFVUSmpRV1JXYjFJMmNrZGNMMFE1ZVdabk9HNDNWME53VkdSTU5YQk1TMlJNUTFnellrMHJaelZPYldKY0wyd3daV2hEUkdOeU5EZ3lSazl4VGtkME5WbGhUVEV4V25kTllWcEpibE5CYlhOcVpGWkpWVVpyVFZkRVdubzJaMGxTT0RaTE5FSjVWbkZ2YjJoTFpIbDJWbU4wZWtoUVkyOTZWMGxzT1RaVlUwTk5ZVGxuWEM5M1lsbHRSR00xU1QwaUxDSnRZV01pT2lJeU1ERTJPRFF3TVRJellXWmhNMkZsWTJaa01qWTFNMkV4TmpneFlqZ3lOVGczWXpReU16azFZMkUwTUdFM1pUWXpOamt5TTJJeVlXTm1OV1JtWVRBd0luMD0=', 1526496682),
('O1JlRgdcBI5OHbmOYjM9kAWXok9XxmZXKUi1JKFJ', 1, '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/65.0.3325.181 Chrome/65.0.3325.181 Safari/537.36', 'ZXlKcGRpSTZJakJFSzB3M1JrcDVlRTljTDBKM1MxTnpVR2RhWlZsM1BUMGlMQ0oyWVd4MVpTSTZJbkU0ZDNobmRrRjZkRzgwYTNwTmFtdEVhazVTTUVoR2RYZFdiRkJUVm1KNmRuQklXblJNWW5CUlJuZEZXR1IwTlRWdk9UY3lhVXQ1ZUhScllXeDRha0Z6YjB0MGNVaHJZWFpWVWpGTWJWUTJkSFpYUXprM1kyRm1iRGh3ZGprNFEyaDJWM0ptVm1acWIxSlRVVnd2VVc5bU9YQTRZVXR6UW1abFVUTlFReXRzVEhOdWN6UlVURkJpVms5RlRYaExia1ZRZUVGSWRrVmNMME16V1hBMlZqZHNaVlUzV1d4VllTdHFPVUZtVTFVNVlVUk5WRTVjTDA0NGEyNTJLMUphVjJOTlZWUkRjbGhISzNaVkswSTVSVEZyYVRkVWNubzVaelZFVTBsMlNrbEtkSFphYlRSaVlsRk9hbmhoY1ZOMmFXbG1UV1ZEVEVoc2RHNXRkMmRCY2s5MGJ5dGpSMWhWUjNrclpsSXlhU3RQZDJwRFNtTlBhVGwwVEhCbmIyNVZObloxVjBNMmEyUlVaMWN5ZG1aR2IxcDVUSFlyWEM5RVVrMUxNMjloYUd0emR6RndNWGRUUzJ0VFpYbFlTbVpsYTB0cWVUVmNMMmhOTkhCNFVtdHNURnA1ZGtKcVoxd3ZXVU4zWW1wTU55dEZWSEZuVVVoeWFEbEtaVlZEUW1sWVRWYzNOV2w0VlVwTGIxWkhVWFpMZGxOY0wxTnlVVlJGWVZGY0x6aElUVGhKTlRneFdsbzJUeXRWVlZob1UwVXhTazExSzNOdk1WcEdNM1ZNUWpOcFdFRXhVWEZ0YUZsYWNsSlVTV05uYm10VloyZGlWMFJMZUVGUWJrOTBjMFJ0WW1WS01HRkJaR0pJZG14U1dFRlNiVTl4VERROUlpd2liV0ZqSWpvaVpqUTVaV013TURBd04yVm1OMlppWTJZNE4ySTJZV1F6T1dJd01Ea3lOVFZqWXpnMVlURmxPRGcwTXpnM056WXdOREZsTW1VMllqZzVPRFEyTkRZM1pTSjk=', 1526480179),
('pL6HyfdKGEZuCKA3LcpnXcoYZSCov9RPR0UCs8jb', NULL, '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/65.0.3325.181 Chrome/65.0.3325.181 Safari/537.36', 'ZXlKcGRpSTZJbkJCVVZKbk0yTmFORVVyVmxSQ2JIRlhTMXB1UW1jOVBTSXNJblpoYkhWbElqb2libFJxUVZFM1JtVkZSRXRFU2xWTFdIRlpOMHgwU0dsbGRIRmpiSGw2WlRWRFRqQTRUa2t3YjJSb1pIUTNTRmxzVUhwVFkxa3JlVzkxYlRSVFp6ZHBOMHhaYmpOaVMzZExXWEZqY0RCRFltczBiMlpwVDBsRmRYZG5jRXhjTDF3dlRFNXZSamN6WkVwV1VGQkhlVzhyVkZOR1NubG9WV2t5Y1RWSmVHeHdhRGx1UldodFJWbEJPRUZFWEM5WWFVVkdNME5uYUdoUlkxd3Zibk5DVWtaRlQyVm5aMUJvVWpCaGNtdEljVlZOU0U1U1lXVlpUSHB6VTNSeldqaFhjR2RTVkc1alYzVkJURFpDTjJ4amVGbFZUSGw2WlZGVVowWmpPVGhLYlV4TVVGZHFRblJMUm5aNmF6ZEhValpXTjNsVmIxY3pORGxxTWpVek5VMVVZbmxaUjJsRE0zaHlOMUZsVVhwUlpUaGpXRFo2TWpGRVMxaFJjWEUyWjJzellVa3lZMWR1VTFkclpWd3ZNV1Y1WjJkWWQwaENYQzkzUkdSSU5GVlhhbFJHZUdKdE1sbFdRMWhtTjBoRmEwOVpTMXd2WkZGY0wyeHVTazQwWVdwdllYYzlQU0lzSW0xaFl5STZJak15T1RJeE5ERTVabUZoTVRVMk9ETTJaakpoWmpCaU9UaGlNamxpWTJZMk1HSTJZVGN4WlRVd1pEQTFNakEzTkRZMllXVmlNalJoWWpRMU5EazBZV1lpZlE9PQ==', 1525844837),
('vQeLoL8m7BLlaHRetdNtOIGZ3F4Vrz5KF9ev4cl2', NULL, '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/65.0.3325.181 Chrome/65.0.3325.181 Safari/537.36', 'ZXlKcGRpSTZJaXMxVDBsamEwUm5NakEwU2pGVVpWWlZSVXA0ZVVFOVBTSXNJblpoYkhWbElqb2lSWGRrVHpaTlptOXpTVzV2Vld3eWFYcE5ka3BJWXl0TGIzbFVhVkpIYkdnMk9GaHdkakJ2U0ZjeU1tSkxObVpxVkRkemJucERla3A2ZVVKdloxYzNaM1k0YVhoc1MxTlNWMUI1TWtsY0wyOVZVekZZU1hjd1JGTldibUZDYmxobGIzSkxaamRsVERFeGRYSkpRbFZ0VmtkNVFWTTNRMHBqY2poUFZIWm9UVlJRVWxkVmFWSlNTak4xUmtkUFFuaG5ObFJwYTNGVE5FUnJXWGxqYjFvMFFqRnBhRUZjTDJGMFltNDJZMVZMVXpONmRrUTFlVkppVGtOaWMxbDFNRUpoTVhWNlVqZGxibFZDY2psbVZHNVFjR2xzUVU1MWNVWkdXR3N4Y1dSUmR6TlVkM2hJWkZkalhDOW1PWFEyWEM5RWJtVXJSbmR1TWs1WVozZFdaM2RJTW1wR0t6Vmhiekp2U2t3eWR6TTJhRlZGVGpOQ2FtZG9RMFl5UzJSRVVWZEpSMkp6VVVwNWExd3ZOWGhjTDJKbE5sazBYQzl4YW5FMFRHOXZWVmdyUXl0TlRHWldSRkZTY201SU0ycFhlRkpIT0VWTVIzQlFObWhSTkU5bVFUMDlJaXdpYldGaklqb2lZMlJsTXpVME9ESTVNbUZpT1RsaE9EUTNOR0ppWmpFM1pUYzBNalV6TjJOa01EVTJZV1E0WTJaaFlqazJOelEyTVdRek5UUmlNelJpTURBM05qY3lNeUo5', 1525294018);

-- --------------------------------------------------------

--
-- Table structure for table `social_logins`
--

CREATE TABLE `social_logins` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `provider` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `provider_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `styles`
--

CREATE TABLE `styles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `styles`
--

INSERT INTO `styles` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Style 1', 1, '2018-05-02 11:46:50', '2018-05-02 11:46:50'),
(2, 'Style 2', 1, '2018-05-02 11:47:00', '2018-05-02 11:47:00');

-- --------------------------------------------------------

--
-- Table structure for table `subcategories`
--

CREATE TABLE `subcategories` (
  `id` int(10) UNSIGNED NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `subcategory` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT '1',
  `icon` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subcategories`
--

INSERT INTO `subcategories` (`id`, `category_id`, `subcategory`, `status`, `icon`, `created_at`, `updated_at`) VALUES
(1, 1, 'Collection', 1, '1525297983_ws_Bridge_1920x1080.jpg', '2018-04-25 10:12:51', '2018-05-02 13:53:03'),
(2, 2, 'Collection 2', 1, '1525298409_Clevenger+Camel+Back+Sofa.jpg', '2018-05-02 14:00:09', '2018-05-02 14:00:09'),
(3, 3, 'Collection 3', 1, '1525298462_sofa.jpg', '2018-05-02 14:01:02', '2018-05-02 14:01:02');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT '1',
  `confirmation_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `confirmed` tinyint(1) NOT NULL DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `status`, `confirmation_code`, `confirmed`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Admin', 'Istrator', 'admin@admin.com', '$2y$10$iWkbhRSbO6juGrPhjoeNN.dRz9QkT5rUHb6KB7FttLoNejOSoO3EC', 1, 'c850b895444768662eb7eba96d3dffc1', 1, 'wLmqHKwUpmTQQ6A2HaDmi5BLVGQuxkZs3DKwqUhSxu5THL0X5vsQkgNjFX0N', '2018-04-22 04:23:26', '2018-04-22 04:23:26', NULL),
(2, 'Backend', 'User', 'executive@executive.com', '$2y$10$gCXWFzWJH5am5baYZ4W3iuTK9JSaK3kl6F/JVWP6.R4eYHNj1SEFO', 1, 'f861e0f0c7654cdc544ac5b6651a51be', 1, NULL, '2018-04-22 04:23:26', '2018-04-22 04:23:26', NULL),
(3, 'Default', 'User', 'user@user.com', '$2y$10$qZTlUWL.hD7v5UwfgHnsHOXVPjxr/dvJwYXXM4e56FSDzT3Ozrbpm', 1, '7633753dcdc00187001e23742bb52b5f', 1, NULL, '2018-04-22 04:23:26', '2018-04-22 04:23:26', NULL),
(4, 'Niraj', 'Jani', 'niraj@outlook.com', '$2y$10$Gya9TIaCCSAUznAVPKGhG.0WPTh.1ghwW5N9mM5iDFYOIxv5VszVa', 1, 'a0449e0d6199a726f684ca49e2a9dd67', 1, 'p5uKs3tNnWg67zzFLKgm8K02XhLG01KPSF2yYSdnAFxY9SYGsOCByPJXIYHt', '2018-05-16 06:28:07', '2018-05-16 06:28:07', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_favourites`
--

CREATE TABLE `user_favourites` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_favourites`
--

INSERT INTO `user_favourites` (`id`, `user_id`, `product_id`, `created_at`, `updated_at`) VALUES
(4, 4, 1, '2018-05-16 10:00:30', '2018-05-16 10:00:30');

-- --------------------------------------------------------

--
-- Table structure for table `weaves`
--

CREATE TABLE `weaves` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `weaves`
--

INSERT INTO `weaves` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'weave1', 1, '2018-05-02 06:45:56', '2018-05-02 06:45:56');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `colors`
--
ALTER TABLE `colors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `history_type_id_foreign` (`type_id`),
  ADD KEY `history_user_id_foreign` (`user_id`);

--
-- Indexes for table `history_types`
--
ALTER TABLE `history_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `home_slider`
--
ALTER TABLE `home_slider`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `materials`
--
ALTER TABLE `materials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_unique` (`name`);

--
-- Indexes for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`id`),
  ADD KEY `permission_role_permission_id_foreign` (`permission_id`),
  ADD KEY `permission_role_role_id_foreign` (`role_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_sizes`
--
ALTER TABLE `product_sizes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_user_user_id_foreign` (`user_id`),
  ADD KEY `role_user_role_id_foreign` (`role_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD UNIQUE KEY `sessions_id_unique` (`id`);

--
-- Indexes for table `social_logins`
--
ALTER TABLE `social_logins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `social_logins_user_id_foreign` (`user_id`);

--
-- Indexes for table `styles`
--
ALTER TABLE `styles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subcategories_category_id_index` (`category_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_favourites`
--
ALTER TABLE `user_favourites`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `weaves`
--
ALTER TABLE `weaves`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `colors`
--
ALTER TABLE `colors`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `history_types`
--
ALTER TABLE `history_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `home_slider`
--
ALTER TABLE `home_slider`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `materials`
--
ALTER TABLE `materials`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `permission_role`
--
ALTER TABLE `permission_role`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `product_sizes`
--
ALTER TABLE `product_sizes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `role_user`
--
ALTER TABLE `role_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `social_logins`
--
ALTER TABLE `social_logins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `styles`
--
ALTER TABLE `styles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `subcategories`
--
ALTER TABLE `subcategories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `user_favourites`
--
ALTER TABLE `user_favourites`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `weaves`
--
ALTER TABLE `weaves`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `history`
--
ALTER TABLE `history`
  ADD CONSTRAINT `history_type_id_foreign` FOREIGN KEY (`type_id`) REFERENCES `history_types` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `history_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `social_logins`
--
ALTER TABLE `social_logins`
  ADD CONSTRAINT `social_logins_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
