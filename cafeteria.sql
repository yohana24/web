-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 18, 2026 at 10:15 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cafeteria`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `name`) VALUES
(1, 'Restaurant'),
(2, 'Cafe'),
(3, 'Desserts');

-- --------------------------------------------------------

--
-- Table structure for table `contact_messages`
--

CREATE TABLE `contact_messages` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_messages`
--

INSERT INTO `contact_messages` (`id`, `first_name`, `last_name`, `email`, `message`, `created_at`) VALUES
(1, 'user', '1', 'user@gmail.com', 'i just try this ', '2026-04-15 13:59:38');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `notification_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL,
  `message` text NOT NULL,
  `is_read` enum('0','1') DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `order_number` varchar(100) NOT NULL,
  `total_amount` decimal(10,2) DEFAULT NULL,
  `status` enum('Pending','Preparing','Ready','Completed') DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `table_id` int(11) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `order_item_id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `subtotal` decimal(10,2) DEFAULT NULL,
  `note` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `stock_quantity` int(11) DEFAULT 0,
  `category_id` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT 'default.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `name`, `description`, `price`, `stock_quantity`, `category_id`, `image`) VALUES
(1, 'Burger', 'Delicious beef burger', 100.00, 73, 1, 'burger.png'),
(2, 'French Fries', 'good potato', 20.00, 67, 1, 'potato.png'),
(3, 'Taameya Sandwich', 'Egyptian falafel sandwich', 10.00, 65, 1, 'taameya.png'),
(4, 'Foul Sandwich', 'Egyptian fava beans sandwich', 8.00, 90, 1, 'foul.png'),
(5, 'Hawawshi', 'Hawawshi with meat', 30.00, 90, 1, 'hawawshi.png'),
(6, 'Mint lemonade', 'Mint lemonade fresh', 45.00, 87, 2, 'Mint lemonade.png'),
(7, 'Black Coffee', 'Authentic Egyptian coffee, no milk', 10.00, 36, 2, 'black coffee.png'),
(8, 'French Coffee', 'Coffee with milk, light French flavor', 15.00, 47, 2, 'Frensh Coffee.png'),
(9, 'Cappuccino', 'Coffee with milk foam, rich flavor', 18.00, 44, 2, 'Cappuccino.png'),
(10, 'Latte', 'Coffee with milk, smooth and balanced taste', 18.00, 49, 2, 'Latte.png'),
(11, 'Mocha', 'Coffee with chocolate, sweet and delicious', 20.00, 48, 2, 'mocha coffee.png'),
(12, 'Iced Coffee', 'Refreshing cold coffee, with or without sugar', 20.00, 48, 2, 'Iced coffee.png'),
(13, 'Blueberry Smoothie', 'Blueberry Smoothie with ice', 40.00, 49, 2, 'blueberry Smoothie.png'),
(14, 'Mango Smoothie', 'Mango Smoothie with ice', 45.00, 46, 2, 'Mango Smoothie.png'),
(15, 'Strawberry Smoothie', 'Strawberry Smoothie with ice', 48.00, 46, 2, 'Strawberry Smoothie.png'),
(16, 'Mango Juice (Fresh)', 'Mango Juice (Fresh) with Small mango pieces', 50.00, 47, 2, 'Mango Juice (Fresh).png'),
(17, 'Orange Juice (Fresh)', 'Orange Juice (Fresh) delicious orange', 45.00, 49, 2, 'Orange Juice (Fresh).png'),
(18, 'Strawberry Juice (Fresh)', 'Strawberry Juice (Fresh) with Small strawberry pieces', 50.00, 48, 2, 'Strawberry Juice (Fresh).png'),
(19, 'V-Cola', 'Refreshing cola drink', 20.00, 34, 2, 'VSS.png'),
(20, 'BR-pizza', 'we have all flavors', 15.00, 94, 3, 'BR-Pizza.png');

-- --------------------------------------------------------

--
-- Table structure for table `product_flavors`
--

CREATE TABLE `product_flavors` (
  `flavor_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `flavor_name` varchar(50) NOT NULL,
  `image` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `stock_quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_flavors`
--

INSERT INTO `product_flavors` (`flavor_id`, `product_id`, `flavor_name`, `image`, `price`, `stock_quantity`) VALUES
(9, 19, 'Blueberry', 'vcola_Blueberry.png', 20.00, 20),
(10, 19, 'Lemon-Lime', 'vcola_Lemon-Lime.png', 20.00, 20),
(11, 19, 'Limon-Mint', 'vcola_Limon-Mint.png', 20.00, 20),
(12, 19, 'Malt', 'vcola_Malt.png', 20.00, 20),
(13, 19, 'Pinacolada', 'vcola_Pinacolada.png', 20.00, 20),
(14, 19, 'Pomegranate', 'vcola_Romaan.png', 20.00, 20),
(15, 19, 'VSS-Diet', 'vcola_VSS-Diet.png', 20.00, 20),
(16, 19, 'VSS', 'VSS.png', 20.00, 20),
(17, 20, 'BR-Olive', 'BR-Olive.png', 15.00, 100),
(18, 20, 'BR-Pizza', 'BR-Pizza.png', 15.00, 100),
(19, 20, 'BR-Ketchup', 'BR-Ketchup.png', 15.00, 100),
(20, 20, 'BR-Nacho-Cheese', 'BR-Nacho-Cheese.png', 15.00, 100);

-- --------------------------------------------------------

--
-- Table structure for table `tables`
--

CREATE TABLE `tables` (
  `table_id` int(11) NOT NULL,
  `table_number` int(11) NOT NULL,
  `status` varchar(20) DEFAULT 'available'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tables`
--

INSERT INTO `tables` (`table_id`, `table_number`, `status`) VALUES
(1, 1, 'available'),
(2, 2, 'available'),
(3, 3, 'available'),
(4, 4, 'available'),
(5, 5, 'available'),
(6, 6, 'available'),
(7, 7, 'available'),
(8, 8, 'available'),
(9, 9, 'available'),
(10, 10, 'available');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('admin','staff','customer') DEFAULT 'customer',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `gender` enum('male','female') DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `institute` varchar(50) DEFAULT NULL,
  `department` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `email`, `password`, `role`, `created_at`, `gender`, `age`, `institute`, `department`) VALUES
(1, 'admin', 'admin@gmail.com', '$2y$10$TfSoS8IzNIE439zeGZ0oHOjvtX2ijUOvSX7.qr84iI2od6gTOpwbW', 'admin', '2026-04-15 15:23:44', 'male', 34, 'engineering', 'electronics'),
(2, 'staff', 'staff@gmail.com', '$2y$10$ctfTczAofxL1X4RCHsbqg.Q5n8iAd6N.ghckcti58b5Bnkyh5p4ja', 'staff', '2026-04-15 15:24:33', 'male', 35, 'commerce', NULL),
(3, 'user', 'user@gmail.com', '$2y$10$b3dw6zbWtJ6zLKMK/pzPg.79HsIfxn9g07.JgzCbt02HsmbQkPGMy', 'customer', '2026-04-15 15:25:01', 'male', 22, 'engineering', 'civil'),
(4, 'user2', 'user2@gmail.com', '$2y$10$2TKuP7ylJ5Nh.ADeAFRyXO2SnHsgVFLWMew8fWHNZhsg3MJKWrf0S', 'customer', '2026-04-18 20:00:51', 'male', 23, 'engineering', 'electronics');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`notification_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD UNIQUE KEY `order_number` (`order_number`),
  ADD UNIQUE KEY `unique_order_number` (`order_number`),
  ADD UNIQUE KEY `order_number_2` (`order_number`),
  ADD KEY `idx_orders_user` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`order_item_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `idx_order_items_order` (`order_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `product_flavors`
--
ALTER TABLE `product_flavors`
  ADD PRIMARY KEY (`flavor_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `tables`
--
ALTER TABLE `tables`
  ADD PRIMARY KEY (`table_id`),
  ADD UNIQUE KEY `table_number` (`table_number`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_id` (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `notification_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `order_item_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `product_flavors`
--
ALTER TABLE `product_flavors`
  MODIFY `flavor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tables`
--
ALTER TABLE `tables`
  MODIFY `table_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `notifications_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`);

--
-- Constraints for table `product_flavors`
--
ALTER TABLE `product_flavors`
  ADD CONSTRAINT `product_flavors_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
