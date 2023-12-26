-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 26, 2023 at 05:41 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `trackease`
--

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `brand_id` int(11) NOT NULL,
  `brand_name` varchar(255) NOT NULL,
  `brand_active` int(11) NOT NULL DEFAULT 0,
  `brand_status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`brand_id`, `brand_name`, `brand_active`, `brand_status`, `created_at`, `updated_at`) VALUES
(1, 'Maru', 1, 0, '2023-04-20 12:13:10', '2023-04-20 12:13:11'),
(2, 'GM', 1, 1, '2023-04-20 12:13:10', '2023-04-06 18:30:00'),
(3, 'V Gaurd', 1, 0, '2023-04-20 12:13:10', '2023-04-20 12:13:11'),
(4, 'test', 2, 0, '2023-04-20 12:13:10', '2023-04-20 12:13:11'),
(5, 'surya', 1, 1, '2023-04-20 12:13:10', '2023-04-20 12:13:11'),
(6, 'VELCO', 1, 1, '2023-04-20 12:13:10', '2023-04-20 12:13:11'),
(7, 'Maru', 1, 1, '2023-04-20 12:13:10', '2023-04-20 12:13:11'),
(8, 'MPCL', 1, 1, '2023-04-20 12:13:10', '2023-04-20 12:13:11'),
(9, 'Vgaurd', 1, 1, '2023-04-20 12:13:10', '2023-04-06 18:30:00'),
(10, 'ECO PLUS', 1, 1, '2023-04-20 12:13:10', '2023-04-20 12:13:11'),
(11, 'Crompton', 1, 1, '2023-04-20 12:13:10', '2023-04-20 12:13:11'),
(12, 'Oriental', 1, 1, '2023-04-20 12:13:10', '2023-04-20 12:13:11'),
(13, 'Anchor Penta', 1, 1, '2023-04-20 12:13:10', '2023-04-20 12:13:11'),
(14, 'Bajaj', 1, 1, '2023-04-07 17:03:03', '2023-04-07 17:03:03'),
(15, 'OnePLus', 1, 1, '2023-04-21 17:03:45', '2023-04-21 17:03:45');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `categories_id` int(11) NOT NULL,
  `categories_name` varchar(255) NOT NULL,
  `categories_active` int(11) NOT NULL DEFAULT 0,
  `categories_status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`categories_id`, `categories_name`, `categories_active`, `categories_status`, `created_at`, `updated_at`) VALUES
(1, '16A Switches', 1, 0, '2023-04-01 12:18:42', '2023-04-01 12:18:42'),
(2, 'Sockets', 1, 1, '2023-04-01 12:18:42', '2023-04-01 12:18:42'),
(3, 'Bulbs', 1, 1, '2023-04-01 12:18:42', '2023-04-01 12:18:42'),
(4, 'Tubelight', 1, 1, '2023-04-01 12:18:42', '2023-04-01 12:18:42'),
(5, 'Ac', 1, 1, '2023-04-01 12:18:42', '2023-04-01 12:18:42'),
(6, 'Capper', 1, 1, '2023-04-01 12:18:42', '2023-04-01 12:18:42'),
(7, 'Mixe', 1, 1, '2023-04-01 12:18:42', '2023-04-01 12:18:42'),
(8, 'Fan', 1, 1, '2023-04-01 12:18:42', '2023-04-01 12:18:42'),
(9, 'Deluxe Dimmer Step', 1, 1, '2023-04-01 12:18:42', '2023-04-01 12:18:42'),
(10, 'Plate', 1, 1, '2023-04-01 12:18:42', '2023-04-01 12:18:42'),
(11, 'Two way Switch', 1, 1, '2023-04-01 12:18:42', '2023-04-01 12:18:42'),
(12, 'Holder', 1, 1, '2023-04-01 12:18:42', '2023-04-01 12:18:42'),
(13, '3-PIN Top', 1, 1, '2023-04-01 12:18:42', '2023-04-01 12:18:42'),
(14, '2-Pin Top', 1, 1, '2023-04-01 12:18:42', '2023-04-01 12:18:42'),
(15, 'Flex Box', 1, 1, '2023-04-01 12:18:42', '2023-04-01 12:18:42'),
(16, 'Plate', 1, 1, '2023-04-01 12:18:42', '2023-04-01 12:18:42'),
(17, 'Dummy', 1, 1, '2023-04-01 12:18:42', '2023-04-01 12:18:42'),
(18, 'mini Step Dimmer', 1, 1, '2023-04-01 12:18:42', '2023-04-01 12:18:42');

-- --------------------------------------------------------

--
-- Table structure for table `dealers`
--

CREATE TABLE `dealers` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `contact` bigint(20) NOT NULL,
  `registerd name` varchar(300) NOT NULL,
  `address` longtext NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` int(11) NOT NULL,
  `active` int(11) NOT NULL DEFAULT 1,
  `mail` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dealers`
--

INSERT INTO `dealers` (`id`, `name`, `contact`, `registerd name`, `address`, `created_by`, `created_at`, `updated_at`, `status`, `active`, `mail`) VALUES
(1, 'SS Enterprises', 9999999999, 'SS Enterprises LTD', 'near kukatpally', 1, '2023-03-10 13:41:23', '2023-03-10 13:41:23', 0, 1, 'ssentreprices@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `expense_id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `amount` float NOT NULL,
  `verified` int(11) NOT NULL DEFAULT 1,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`expense_id`, `name`, `amount`, `verified`, `status`, `created_at`, `updated_at`) VALUES
(1, 'rent', 165000, 1, 1, '2023-04-21 17:07:52', '2023-04-21 17:07:52');

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `order_date` date NOT NULL,
  `client_name` varchar(255) NOT NULL,
  `client_contact` varchar(255) NOT NULL,
  `sub_total` varchar(255) NOT NULL,
  `total_amount` varchar(255) NOT NULL,
  `discount` varchar(255) NOT NULL,
  `grand_total` varchar(255) NOT NULL,
  `paid` bigint(255) NOT NULL,
  `due` varchar(255) NOT NULL,
  `payment_type` int(11) NOT NULL,
  `payment_status` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `order_date`, `client_name`, `client_contact`, `sub_total`, `total_amount`, `discount`, `grand_total`, `paid`, `due`, `payment_type`, `payment_status`, `created_at`, `updated_at`, `status`) VALUES
(1, '2023-04-21', 'walk_in', '0', '100.00', '100', '0', '100.00', 100, '0.00', 1, 1, '2023-04-21 17:05:34', '2023-04-21 17:05:34', 1);

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `order_item_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL DEFAULT 0,
  `product_id` int(11) NOT NULL DEFAULT 0,
  `quantity` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `rate` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `total` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`order_item_id`, `order_id`, `product_id`, `quantity`, `rate`, `total`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 22, '2', '50', '100', 1, '2023-04-21 17:05:34', '2023-04-21 17:05:34');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_image` text DEFAULT NULL,
  `brand_id` int(11) NOT NULL,
  `categories_id` int(11) NOT NULL,
  `quantity` varchar(255) NOT NULL,
  `got_rate` varchar(255) NOT NULL,
  `selling_price` mediumint(10) NOT NULL,
  `active` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_name`, `product_image`, `brand_id`, `categories_id`, `quantity`, `got_rate`, `selling_price`, `active`, `status`, `created_at`, `updated_at`) VALUES
(1, '16Am Socket 016', NULL, 7, 3, '38.5', '35', 70, 1, 1, '2023-04-07 12:22:28', '2023-04-08 18:30:00'),
(2, '20 A Magic Switch', NULL, 1, 3, '0', '40', 54, 1, 1, '2023-04-07 12:22:28', '2023-04-07 12:22:28'),
(3, '0w led', NULL, 5, 6, '50', '50', 90, 1, 1, '2023-04-07 12:22:28', '2023-04-07 12:22:28'),
(4, 'Ac stand', NULL, 6, 8, '45', '280', 350, 1, 1, '2023-04-07 12:22:28', '2023-04-07 12:22:28'),
(5, '20am Switch 285', NULL, 7, 2, '40', '39.4', 55, 2, 1, '2023-04-07 12:22:28', '2023-04-07 12:22:28'),
(6, '6am Socket 085', NULL, 7, 2, '50', '34', 46, 1, 1, '2023-04-07 12:22:28', '2023-04-07 12:22:28'),
(7, 'Pendant Holder AB-12', NULL, 7, 16, '30', '14.4', 20, 1, 1, '2023-04-07 12:22:28', '2023-04-07 12:22:28'),
(8, '2-Pin Top MF-11', NULL, 7, 18, '40', '8.4', 15, 1, 1, '2023-04-07 12:22:28', '2023-04-07 12:22:28'),
(9, '16 am Top PT-04', NULL, 7, 17, '50', '47.4', 65, 1, 1, '2023-04-07 12:22:28', '2023-04-07 12:22:28'),
(10, '6 Am Top PT-01', NULL, 7, 17, '40', '28.8', 45, 1, 1, '2023-04-07 12:22:28', '2023-04-07 12:22:28'),
(11, 'Deluxe Flex Box 420 A', NULL, 7, 19, '5', '67.2', 200, 1, 1, '2023-04-07 12:22:28', '2023-04-07 12:22:28'),
(12, '6 Am switch 65001', NULL, 13, 3, '40', '19', 26, 1, 1, '2023-04-07 12:22:28', '2023-04-07 12:22:28'),
(13, '6 Socket 65208', NULL, 13, 2, '10', '61', 86, 1, 1, '2023-04-07 12:22:28', '2023-04-07 12:22:28'),
(14, '16 Am Socket 65205', NULL, 13, 2, '20', '95', 133, 1, 1, '2023-04-07 12:22:28', '2023-04-07 12:22:28'),
(15, '16 Am switch 65007', NULL, 13, 3, '20', '55.1', 76, 1, 1, '2023-04-07 12:22:28', '2023-04-07 12:22:28'),
(16, '2 Way Switch 65002', NULL, 13, 3, '20', '46', 64, 1, 1, '2023-04-07 12:22:28', '2023-04-07 12:22:28'),
(17, 'Blank Plate', NULL, 13, 21, '50', '14', 54, 1, 1, '2023-04-07 12:22:28', '2023-04-07 12:22:28'),
(18, 'Dx Dimmer 65302', NULL, 13, 13, '10', '208', 248, 1, 1, '2023-04-07 12:22:28', '2023-04-07 12:22:28'),
(19, 'Mini Step Dimmer 65301', NULL, 13, 22, '10', '176', 216, 1, 1, '2023-04-07 12:22:28', '2023-04-07 12:22:28'),
(20, 'Bell Push 65003', NULL, 13, 3, '20', '47', 66, 1, 1, '2023-04-07 12:22:28', '2023-04-07 12:22:28'),
(22, 'one plus band', NULL, 15, 3, '18', '25', 50, 1, 1, '2023-04-21 17:04:40', '2023-04-20 18:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `service_data`
--

CREATE TABLE `service_data` (
  `service_id` int(11) NOT NULL,
  `service_date` date NOT NULL,
  `client_name` varchar(150) NOT NULL,
  `client_contact` bigint(20) NOT NULL,
  `subtotal` float NOT NULL,
  `service_charge` float NOT NULL,
  `total_amt` float NOT NULL,
  `discount` float NOT NULL,
  `grandtotal` float NOT NULL,
  `paid_amt` float NOT NULL,
  `due_amt` float NOT NULL,
  `payment_type` int(11) NOT NULL,
  `payment_status` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `service_data`
--

INSERT INTO `service_data` (`service_id`, `service_date`, `client_name`, `client_contact`, `subtotal`, `service_charge`, `total_amt`, `discount`, `grandtotal`, `paid_amt`, `due_amt`, `payment_type`, `payment_status`, `created_at`, `updated_at`, `status`) VALUES
(1, '2023-04-21', 'prasad', 963979930, 2500, 150, 2650, 0, 2650, 2000, 650, 1, 2, '2023-04-21 17:07:10', '2023-04-20 18:30:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `service_taken_data`
--

CREATE TABLE `service_taken_data` (
  `service_taken_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `service_type` int(11) NOT NULL,
  `rate` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `service_taken_data`
--

INSERT INTO `service_taken_data` (`service_taken_id`, `service_id`, `service_type`, `rate`, `quantity`, `amount`, `created_at`, `updated_at`, `status`) VALUES
(1, 1, 1, 2500, 1, 2500, '2023-04-21 17:07:10', '2023-04-20 18:30:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `service_types`
--

CREATE TABLE `service_types` (
  `service_type_id` int(11) NOT NULL,
  `service_type_name` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `service_types`
--

INSERT INTO `service_types` (`service_type_id`, `service_type_name`, `created_at`, `updated_at`) VALUES
(1, 'Washing Machine Repair', '2023-02-26 18:30:00', '2023-02-26 18:30:00'),
(2, 'Fridge Repair', '2023-02-26 18:30:00', '2023-02-26 18:30:00'),
(3, 'Mixi Repair', '2023-02-26 18:30:00', '2023-02-26 18:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `id` bigint(20) NOT NULL,
  `stock_name` varchar(100) DEFAULT NULL,
  `stock_type` varchar(10) NOT NULL,
  `dealer` int(11) NOT NULL,
  `amount` float NOT NULL,
  `active` int(11) NOT NULL DEFAULT 1,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stock_data`
--

CREATE TABLE `stock_data` (
  `stock_data_id` int(11) NOT NULL,
  `stock_id` int(11) NOT NULL,
  `products` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`products`)),
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` int(11) NOT NULL DEFAULT 1,
  `active` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_role` int(11) NOT NULL DEFAULT 3,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_role`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(4, 1, 'admin', 'admin@svelectrical.com', NULL, '$2y$10$0I.QDnhZcQWbHKUVomNB9.SAs3RREyZ2f0WT4se85tLCLTPbdQRu.', NULL, '2023-08-17 12:01:38', '2023-08-17 12:01:38');

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` int(11) NOT NULL DEFAULT 1,
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`id`, `name`, `created_at`, `updated_at`, `status`, `created_by`) VALUES
(1, 'super-admin', '2023-04-07 06:35:12', '2023-04-07 06:35:12', 1, 1),
(2, 'admin', '2023-04-07 06:56:07', '2023-04-07 06:56:07', 1, 1),
(3, 'seller', '2023-04-07 06:56:56', '2023-04-07 06:56:56', 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`brand_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`categories_id`);

--
-- Indexes for table `dealers`
--
ALTER TABLE `dealers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`expense_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`order_item_id`),
  ADD KEY `order_id_fr` (`order_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `service_data`
--
ALTER TABLE `service_data`
  ADD PRIMARY KEY (`service_id`);

--
-- Indexes for table `service_taken_data`
--
ALTER TABLE `service_taken_data`
  ADD PRIMARY KEY (`service_taken_id`),
  ADD KEY `service_id_fr` (`service_id`);

--
-- Indexes for table `service_types`
--
ALTER TABLE `service_types`
  ADD PRIMARY KEY (`service_type_id`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock_data`
--
ALTER TABLE `stock_data`
  ADD PRIMARY KEY (`stock_data_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `brand_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `categories_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `dealers`
--
ALTER TABLE `dealers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `expense_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `order_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `service_data`
--
ALTER TABLE `service_data`
  MODIFY `service_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `service_taken_data`
--
ALTER TABLE `service_taken_data`
  MODIFY `service_taken_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `service_types`
--
ALTER TABLE `service_types`
  MODIFY `service_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stock_data`
--
ALTER TABLE `stock_data`
  MODIFY `stock_data_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_id_fr` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`);

--
-- Constraints for table `service_taken_data`
--
ALTER TABLE `service_taken_data`
  ADD CONSTRAINT `service_id_fr` FOREIGN KEY (`service_id`) REFERENCES `service_data` (`service_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
