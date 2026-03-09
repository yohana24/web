-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 08, 2026 at 12:06 AM
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

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`notification_id`, `user_id`, `order_id`, `message`, `is_read`, `created_at`) VALUES
(1, 2, 10, 'Order placed! Order Number: ORD1772296044', '0', '2026-02-28 16:27:31'),
(2, 2, 11, 'Order placed! Order Number: ORD1772296255', '0', '2026-02-28 16:31:06'),
(3, 2, 12, 'Order placed! Order Number: ORD1772297195', '0', '2026-02-28 16:46:40'),
(4, 2, 13, 'Order placed! Order Number: ORD1772297241', '0', '2026-02-28 16:47:24'),
(5, 2, 14, 'Order placed! Order Number: ORD1772468848', '0', '2026-03-02 16:27:32'),
(6, 1, 15, 'Order placed! Order Number: ORD1772481895', '0', '2026-03-02 20:05:00'),
(7, 1, 16, 'Order placed! Order Number: ORD1772481974', '0', '2026-03-02 20:06:16'),
(8, 1, 17, 'Order placed! Order Number: ORD1772482439', '0', '2026-03-02 20:19:48'),
(9, 1, 18, 'Order placed! Order Number: ORD1772485866', '0', '2026-03-02 21:11:19'),
(10, 1, 19, 'Order placed! Order Number: ORD1772486083', '0', '2026-03-02 21:14:52'),
(11, 1, 20, 'Order placed! Order Number: ORD1772486473', '0', '2026-03-02 21:21:16'),
(12, 1, 21, 'Order placed! Order Number: ORD1772486628', '0', '2026-03-02 21:29:49'),
(13, 1, 22, 'Order placed! Order Number: ORD1772487773', '0', '2026-03-02 21:43:00'),
(14, 1, 23, 'Order placed! Order Number: ORD1772554243', '0', '2026-03-03 16:12:54'),
(15, 3, 24, 'Order placed! Order Number: ORD1772631990', '0', '2026-03-04 13:46:51'),
(16, 4, 25, 'Order placed! Order Number: ORD1772653927', '0', '2026-03-04 19:52:32'),
(17, 1, 26, 'Order placed! Order Number: ORD1772712332', '0', '2026-03-05 12:05:44'),
(18, 1, 27, 'Order placed! Order Number: ORD1772895563', '0', '2026-03-07 14:59:46'),
(19, 1, 28, 'Order placed! Order Number: ORD1772895700', '0', '2026-03-07 15:01:53'),
(20, 1, 29, 'Order placed! Order Number: ORD1772896872', '0', '2026-03-07 15:21:21'),
(21, 1, 30, 'Order placed! Order Number: ORD1772918322', '0', '2026-03-07 21:18:56');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `order_number` varchar(20) DEFAULT NULL,
  `total_amount` decimal(10,2) DEFAULT NULL,
  `status` enum('Pending','Preparing','Ready','Completed') DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `order_number`, `total_amount`, `status`, `created_at`) VALUES
(1, 2, 'ORD1772216692', 140.00, 'Completed', '2026-02-27 18:24:52'),
(2, 2, 'ORD1772216712', 100.00, 'Completed', '2026-02-27 18:25:12'),
(3, 1, 'ORD1772294787', 100.00, 'Completed', '2026-02-28 16:06:27'),
(4, 2, 'ORD1772294808', 120.00, 'Completed', '2026-02-28 16:06:48'),
(5, 2, 'ORD1772295059', 120.00, 'Completed', '2026-02-28 16:10:59'),
(6, 2, 'ORD1772295160', 100.00, 'Completed', '2026-02-28 16:12:40'),
(7, 2, 'ORD1772295573', 200.00, 'Completed', '2026-02-28 16:19:33'),
(8, 2, 'ORD1772295681', 40.00, 'Completed', '2026-02-28 16:21:21'),
(9, 2, 'ORD1772295694', 20.00, 'Completed', '2026-02-28 16:21:34'),
(10, 2, 'ORD1772296044', 220.00, 'Completed', '2026-02-28 16:27:24'),
(11, 2, 'ORD1772296255', 320.00, 'Completed', '2026-02-28 16:30:55'),
(12, 2, 'ORD1772297195', 200.00, 'Completed', '2026-02-28 16:46:35'),
(13, 2, 'ORD1772297241', 100.00, 'Completed', '2026-02-28 16:47:21'),
(14, 2, 'ORD1772468848', 280.00, 'Completed', '2026-03-02 16:27:28'),
(15, 1, 'ORD1772481895', 100.00, 'Completed', '2026-03-02 20:04:55'),
(16, 1, 'ORD1772481974', 120.00, 'Completed', '2026-03-02 20:06:14'),
(17, 1, 'ORD1772482439', 120.00, 'Completed', '2026-03-02 20:13:59'),
(18, 1, 'ORD1772485866', 300.00, 'Completed', '2026-03-02 21:11:06'),
(19, 1, 'ORD1772486083', 120.00, 'Completed', '2026-03-02 21:14:43'),
(20, 1, 'ORD1772486473', 100.00, 'Completed', '2026-03-02 21:21:13'),
(21, 1, 'ORD1772486628', 100.00, 'Completed', '2026-03-02 21:23:48'),
(22, 1, 'ORD1772487773', 100.00, 'Completed', '2026-03-02 21:42:53'),
(23, 1, 'ORD1772554243', 120.00, 'Completed', '2026-03-03 16:10:43'),
(24, 3, 'ORD1772631990', 260.00, 'Completed', '2026-03-04 13:46:30'),
(25, 4, 'ORD1772653927', 100.00, 'Completed', '2026-03-04 19:52:07'),
(26, 1, 'ORD1772712332', 100.00, 'Completed', '2026-03-05 12:05:32'),
(27, 1, 'ORD1772895563', 100.00, 'Completed', '2026-03-07 14:59:23'),
(28, 1, 'ORD1772895700', 120.00, 'Completed', '2026-03-07 15:01:40'),
(29, 1, 'ORD1772896872', 10.00, 'Completed', '2026-03-07 15:21:12'),
(30, 1, 'ORD1772918322', 308.00, 'Completed', '2026-03-07 21:18:42');

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

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`order_item_id`, `order_id`, `product_id`, `quantity`, `price`, `subtotal`, `note`) VALUES
(57, 1, 1, 1, 100.00, 100.00, NULL),
(58, 1, 2, 2, 20.00, 40.00, NULL),
(59, 2, 1, 1, 100.00, 100.00, NULL),
(60, 3, 1, 1, 100.00, 100.00, NULL),
(61, 4, 1, 1, 100.00, 100.00, NULL),
(62, 4, 2, 1, 20.00, 20.00, NULL),
(63, 5, 1, 1, 100.00, 100.00, NULL),
(64, 5, 2, 1, 20.00, 20.00, NULL),
(65, 6, 1, 1, 100.00, 100.00, NULL),
(66, 7, 1, 2, 100.00, 200.00, NULL),
(67, 8, 2, 2, 20.00, 40.00, NULL),
(68, 9, 2, 1, 20.00, 20.00, NULL),
(69, 10, 1, 2, 100.00, 200.00, NULL),
(70, 10, 2, 1, 20.00, 20.00, NULL),
(71, 11, 1, 3, 100.00, 300.00, NULL),
(72, 11, 2, 1, 20.00, 20.00, NULL),
(73, 12, 1, 2, 100.00, 200.00, NULL),
(74, 13, 1, 1, 100.00, 100.00, NULL),
(75, 14, 2, 4, 20.00, 80.00, NULL),
(76, 14, 1, 2, 100.00, 200.00, NULL),
(77, 15, 1, 1, 100.00, 100.00, NULL),
(78, 16, 1, 1, 100.00, 100.00, ''),
(79, 16, 2, 1, 20.00, 20.00, ''),
(80, 17, 2, 1, 20.00, 20.00, 'من غير كاتشب'),
(81, 17, 1, 1, 100.00, 100.00, 'مش عايز بصل والله'),
(82, 18, 1, 3, 100.00, 300.00, 'no tomato'),
(83, 19, 2, 1, 20.00, 20.00, ''),
(84, 19, 1, 1, 100.00, 100.00, ''),
(85, 20, 1, 1, 100.00, 100.00, 'بدون كاتشب'),
(86, 21, 1, 1, 100.00, 100.00, 'try '),
(87, 22, 1, 1, 100.00, 100.00, ''),
(88, 23, 1, 1, 100.00, 100.00, 'dasda'),
(89, 23, 2, 1, 20.00, 20.00, 'weqweqwe'),
(90, 24, 1, 2, 100.00, 200.00, 'مش عايز بصل'),
(91, 24, 2, 3, 20.00, 60.00, 'بدون اضافات '),
(92, 25, 2, 5, 20.00, 100.00, 'منغير كاتشب'),
(93, 26, 1, 1, 100.00, 100.00, 'منغير يصل'),
(94, 27, 1, 1, 100.00, NULL, 'منغير يصل'),
(95, 28, 2, 1, 20.00, NULL, 'من غير كاتشب'),
(96, 28, 1, 1, 100.00, NULL, 'مش عايز بصل والله'),
(97, 29, 3, 1, 10.00, 10.00, ''),
(98, 30, 19, 1, 20.00, 20.00, ''),
(99, 30, 19, 1, 20.00, 20.00, ''),
(100, 30, 18, 1, 50.00, 50.00, ''),
(101, 30, 13, 1, 40.00, 40.00, ''),
(102, 30, 7, 1, 10.00, 10.00, 'زيادة'),
(103, 30, 3, 6, 10.00, 60.00, ''),
(104, 30, 4, 6, 8.00, 48.00, ''),
(105, 30, 2, 3, 20.00, 60.00, '');

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
(1, 'Burger', 'Delicious beef burger', 100.00, 100, 1, 'burger.png'),
(2, 'French Fries', 'good potato', 20.00, 97, 1, 'potato.png'),
(3, 'Taameya Sandwich', 'Egyptian falafel sandwich', 10.00, 93, 1, 'taameya.png'),
(4, 'Foul Sandwich', 'Egyptian fava beans sandwich', 8.00, 94, 1, 'foul.png'),
(5, 'Hawawshi', 'Hawawshi with meat', 30.00, 100, 1, 'hawawshi.png'),
(6, 'Mint lemonade', 'Mint lemonade fresh', 45.00, 100, 2, 'Mint lemonade.png'),
(7, 'Black Coffee', 'Authentic Egyptian coffee, no milk', 10.00, 49, 2, 'black coffee.png'),
(8, 'French Coffee', 'Coffee with milk, light French flavor', 15.00, 50, 2, 'Frensh Coffee.png'),
(9, 'Cappuccino', 'Coffee with milk foam, rich flavor', 18.00, 50, 2, 'Cappuccino.png'),
(10, 'Latte', 'Coffee with milk, smooth and balanced taste', 18.00, 50, 2, 'Latte.png'),
(11, 'Mocha', 'Coffee with chocolate, sweet and delicious', 20.00, 50, 2, 'mocha coffee.png'),
(12, 'Iced Coffee', 'Refreshing cold coffee, with or without sugar', 20.00, 50, 2, 'Iced coffee.png'),
(13, 'Blueberry Smoothie', 'Blueberry Smoothie with ice', 40.00, 49, 2, 'blueberry Smoothie.png'),
(14, 'Mango Smoothie', 'Mango Smoothie with ice', 45.00, 50, 2, 'Mango Smoothie.png'),
(15, 'Strawberry Smoothie', 'Strawberry Smoothie with ice', 48.00, 50, 2, 'Strawberry Smoothie.png'),
(16, 'Mango Juice (Fresh)', 'Mango Juice (Fresh) with Small mango pieces', 50.00, 50, 2, 'Mango Juice (Fresh).png'),
(17, 'Orange Juice (Fresh)', 'Orange Juice (Fresh) delicious orange', 45.00, 50, 2, 'Orange Juice (Fresh).png'),
(18, 'Strawberry Juice (Fresh)', 'Strawberry Juice (Fresh) with Small strawberry pieces', 50.00, 49, 2, 'Strawberry Juice (Fresh).png'),
(19, 'V-Cola', 'Refreshing cola drink', 20.00, 48, 2, 'VSS.png');

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
(16, 19, 'VSS', 'VSS.png', 20.00, 20);

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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `email`, `password`, `role`, `created_at`) VALUES
(1, 'Yohana', 'yohanashraffayz@gmail.com', '$2y$10$/6DfkY6EATcUrVsgyoNewO5XbsLyfUhjIT8Rlmck.eyOPUWxa/Ide', 'customer', '2026-02-27 18:24:05'),
(2, 'staff', 'whywork2421@gmail.com', '$2y$10$Mvdl.hEIl7yDKwbum/QrsOEwfmAeDmoGfm3eA8YDwrW7d35u8hvHq', 'staff', '2026-02-27 18:24:23'),
(3, 'mo alaa', 'mo@gmail.com', '$2y$10$za0/bDBiij0fbBW9w8Xs/.uhzFn3xtRRNgI2VisbRnYUk41preMJy', 'customer', '2026-03-04 13:45:34'),
(4, 'Demiana', 'demianaashraf32@gmail.com', '$2y$10$enVhVb.Tvt0dCZ6QOuApNObAoJlxI60lRO0T.4kpHnXgSWcsJA53K', 'customer', '2026-03-04 19:49:17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

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
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`order_item_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

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
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
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
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `notification_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `order_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `product_flavors`
--
ALTER TABLE `product_flavors`
  MODIFY `flavor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

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
