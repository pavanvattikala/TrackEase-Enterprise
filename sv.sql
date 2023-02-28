-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 28, 2023 at 03:52 PM
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
-- Database: `sv`
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
  `created_at` date DEFAULT current_timestamp(),
  `updated_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`brand_id`, `brand_name`, `brand_active`, `brand_status`, `created_at`, `updated_at`) VALUES
(1, 'Maru', 1, 1, '2023-02-27', '2023-02-28'),
(2, 'GM', 1, 1, '2023-02-27', '2023-02-28'),
(3, 'V Gaurd', 1, 1, '2023-02-28', '2023-02-28');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `categories_id` int(11) NOT NULL,
  `categories_name` varchar(255) NOT NULL,
  `categories_active` int(11) NOT NULL DEFAULT 0,
  `categories_status` int(11) NOT NULL DEFAULT 1,
  `created_at` date NOT NULL DEFAULT current_timestamp(),
  `updated_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`categories_id`, `categories_name`, `categories_active`, `categories_status`, `created_at`, `updated_at`) VALUES
(1, '16A Switches', 1, 1, '2023-02-27', '2023-02-28'),
(2, '6A Sockets', 1, 1, '2023-02-27', '2023-02-27'),
(3, '20A Switch', 1, 1, '2023-02-27', '2023-02-27');

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
  `paid` varchar(255) NOT NULL,
  `due` varchar(255) NOT NULL,
  `payment_type` int(11) NOT NULL,
  `payment_status` int(11) NOT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp(),
  `updated_at` date NOT NULL DEFAULT current_timestamp(),
  `status` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `order_date`, `client_name`, `client_contact`, `sub_total`, `total_amount`, `discount`, `grand_total`, `paid`, `due`, `payment_type`, `payment_status`, `created_at`, `updated_at`, `status`) VALUES
(8, '2023-02-27', 'Pavan', '8341837776', '240.00', '240', '0', '240.00', '240', '0.00', 1, 1, '2023-02-27', '2023-02-27', 1),
(9, '2023-02-27', 'Ramana', '9963979930', '1020.00', '1020', '0', '1020.00', '1020', '0.00', 1, 1, '2023-02-27', '2023-02-27', 1),
(10, '2023-02-27', 'pavan', '8341837776', '351.00', '351', '0', '351.00', '351', '0.00', 1, 1, '2023-02-27', '2023-02-27', 1),
(11, '2023-02-27', 'pavan', '8341837776', '351.00', '351', '0', '351.00', '351', '0.00', 1, 1, '2023-02-27', '2023-02-27', 1),
(12, '2023-02-27', 'Ramana', '9963979930', '585.00', '585', '0', '585.00', '580', '5.00', 1, 1, '2023-02-27', '2023-02-27', 1),
(14, '2023-02-27', 'dfasdf', '8465132', '810.00', '810', '0', '810.00', '810', '0.00', 1, 1, '2023-02-27', '2023-02-27', 1);

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
  `created_at` date NOT NULL DEFAULT current_timestamp(),
  `updated_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`order_item_id`, `order_id`, `product_id`, `quantity`, `rate`, `total`, `status`, `created_at`, `updated_at`) VALUES
(12, 8, 1, '5', '48', '240', 1, '2023-02-27', '2023-02-27'),
(13, 9, 1, '10', '48', '480', 1, '2023-02-27', '2023-02-27'),
(14, 9, 2, '10', '54', '540', 1, '2023-02-27', '2023-02-27'),
(15, 10, 3, '9', '39', '351', 1, '2023-02-27', '2023-02-27'),
(16, 11, 3, '9', '39', '351', 1, '2023-02-27', '2023-02-27'),
(17, 12, 3, '15', '39', '585', 1, '2023-02-27', '2023-02-27'),
(19, 14, 2, '15', '54', '810', 1, '2023-02-27', '2023-02-27');

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
  `created_at` date NOT NULL DEFAULT current_timestamp(),
  `updated_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_name`, `product_image`, `brand_id`, `categories_id`, `quantity`, `got_rate`, `selling_price`, `active`, `status`, `created_at`, `updated_at`) VALUES
(1, '16A Switch', NULL, 1, 1, '9', '35', 48, 1, 1, '2023-02-27', '2023-02-27'),
(2, '20 A Magic Switch', NULL, 1, 3, '5', '40', 54, 1, 1, '2023-02-01', '2023-02-27');

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
  `created_at` date NOT NULL DEFAULT current_timestamp(),
  `updated_at` date NOT NULL DEFAULT current_timestamp(),
  `status` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `service_data`
--

INSERT INTO `service_data` (`service_id`, `service_date`, `client_name`, `client_contact`, `subtotal`, `service_charge`, `total_amt`, `discount`, `grandtotal`, `paid_amt`, `due_amt`, `payment_type`, `payment_status`, `created_at`, `updated_at`, `status`) VALUES
(2, '2023-02-27', 'Pavan', 8341837776, 5000, 200, 5200, 0, 5200, 5000, 200, 2, 2, '2023-02-27', '2023-02-27', 1);

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
  `created_at` date NOT NULL DEFAULT current_timestamp(),
  `updated_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `service_taken_data`
--

INSERT INTO `service_taken_data` (`service_taken_id`, `service_id`, `service_type`, `rate`, `quantity`, `amount`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 5000, 1, 5000, '2023-02-27', '2023-02-27');

-- --------------------------------------------------------

--
-- Table structure for table `service_types`
--

CREATE TABLE `service_types` (
  `service_type_id` int(11) NOT NULL,
  `service_type_name` varchar(100) NOT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp(),
  `updated_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `service_types`
--

INSERT INTO `service_types` (`service_type_id`, `service_type_name`, `created_at`, `updated_at`) VALUES
(1, 'Washing Machine Repair', '2023-02-27', '2023-02-27'),
(2, 'Fridge Repair', '2023-02-27', '2023-02-27'),
(3, 'Mixi Repair', '2023-02-27', '2023-02-27');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp(),
  `updated_at` date NOT NULL DEFAULT current_timestamp(),
  `status` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `email`, `created_at`, `updated_at`, `status`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', '', '2023-02-27', '2023-02-27', 1);

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
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `brand_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `categories_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `order_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `service_data`
--
ALTER TABLE `service_data`
  MODIFY `service_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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
