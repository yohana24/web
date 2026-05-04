-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 16, 2026 at 11:58 PM
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
(1, '', '', 'yohanashraffayz@gmail.com', 'hola i want to try message here to see admin page', '2026-03-11 19:33:55'),
(2, 'yohana', 'Ashraf', 'yohanashraffayz@gmail.com', '12312313131231', '2026-03-11 19:36:45'),
(3, 'shaco', 'ola', 'shaco@gmail.com', 'shaco now try this ', '2026-03-11 19:37:25');

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
(21, 1, 30, 'Order placed! Order Number: ORD1772918322', '0', '2026-03-07 21:18:56'),
(22, 1, 31, 'Order placed! Order Number: ORD_20260309_0356', '0', '2026-03-09 02:56:53'),
(23, 2, 33, 'Order placed! Order Number: ORD_2026/03/09_04:00', '0', '2026-03-09 03:00:15'),
(24, 2, 32, 'Order placed! Order Number: ORD_20260309_0359', '0', '2026-03-09 03:00:16'),
(25, 2, 35, 'Order placed! Order Number: ORD_2026/03/09_05:02', '0', '2026-03-09 03:02:42'),
(26, 2, 34, 'Order placed! Order Number: ORD_2026/03/09_05:01', '0', '2026-03-09 03:02:43'),
(27, 2, 46, 'Order placed! Order Number: ORD_2026-03-09_05-27', '0', '2026-03-09 03:27:19'),
(28, 2, 44, 'Order placed! Order Number: ORD_2026/03/09_05:19', '0', '2026-03-09 03:27:21'),
(29, 2, 45, 'Order placed! Order Number: ORD_2026-03-09_05-20', '0', '2026-03-09 03:27:21'),
(30, 2, 43, 'Order placed! Order Number: ORD_2026-03-09_05-16', '0', '2026-03-09 03:27:22'),
(31, 2, 42, 'Order placed! Order Number: ORD_2026_03_09_05:11', '0', '2026-03-09 03:27:23'),
(32, 2, 41, 'Order placed! Order Number: ORD_2026-03-09_05:11', '0', '2026-03-09 03:27:24'),
(33, 2, 39, 'Order placed! Order Number: ORD_2026/03/09_05:09', '0', '2026-03-09 03:27:24'),
(34, 2, 38, 'Order placed! Order Number: ORD_2026/03/09_05:08', '0', '2026-03-09 03:27:26'),
(35, 2, 37, 'Order placed! Order Number: ORD_2026/03/09_05:04', '0', '2026-03-09 03:27:27'),
(36, 6, 47, 'Order placed! Order Number: ORD_2026-03-09_12-59', '0', '2026-03-09 11:00:59'),
(37, 7, 49, 'Order placed! Order Number: ORD_2026-03-09_13-15', '0', '2026-03-09 11:17:00'),
(38, 6, 48, 'Order placed! Order Number: ORD1773054097', '', '2026-03-09 11:17:02'),
(39, 1, 50, 'Order placed! Order Number: ORD_2026-03-10_12-10', '0', '2026-03-10 22:10:19'),
(40, 1, 51, 'Order placed! Order Number: ORD_2026-03-11_00-47', '0', '2026-03-10 22:58:56'),
(41, 1, 52, 'Order placed! Order Number: ORD_2026-03-11_00-55', '0', '2026-03-10 22:58:57'),
(42, 1, 53, 'Order placed! Order Number: ORD_2026-03-11_00-58', '0', '2026-03-10 22:58:58'),
(43, 1, 54, 'Order placed! Order Number: ORD_2026-03-11_01-11', '0', '2026-03-10 23:11:59'),
(44, 1, 56, 'Order placed! Order Number: ORD_2026-03-11_01-12', '0', '2026-03-10 23:16:17'),
(45, 1, 61, 'Order placed! Order Number: ORD_2026-03-11_01-27', '0', '2026-03-10 23:27:34'),
(46, 1, 63, 'Order placed! Order Number: ORD_2026-03-11_15-07', '0', '2026-03-11 13:12:13'),
(47, 1, 64, 'Order placed! Order Number: ORD_2026-03-11_15-12', '0', '2026-03-11 13:12:13'),
(48, 1, 62, 'Order placed! Order Number: ORD_2026-03-11_15-05', '0', '2026-03-11 13:12:15'),
(49, 1, 65, 'Order placed! Order Number: ORD_2026-03-11_15-15', '0', '2026-03-11 13:15:14'),
(50, 1, 66, 'Order placed! Order Number: ORD_2026-03-11_16-23', '0', '2026-03-11 14:24:09'),
(51, 4, 67, 'Order placed! Order Number: ORD_2026-03-12_16-31', '0', '2026-03-12 14:32:23'),
(52, 4, 68, 'Order placed! Order Number: ORD_2026-03-13_14-23', '0', '2026-03-13 12:24:28');

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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `table_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `order_number`, `total_amount`, `status`, `created_at`, `table_id`) VALUES
(1, 2, 'ORD1772216692', 140.00, 'Completed', '2026-02-27 18:24:52', NULL),
(2, 2, 'ORD1772216712', 100.00, 'Completed', '2026-02-27 18:25:12', NULL),
(3, 1, 'ORD1772294787', 100.00, 'Completed', '2026-02-28 16:06:27', NULL),
(4, 2, 'ORD1772294808', 120.00, 'Completed', '2026-02-28 16:06:48', NULL),
(5, 2, 'ORD1772295059', 120.00, 'Completed', '2026-02-28 16:10:59', NULL),
(6, 2, 'ORD1772295160', 100.00, 'Completed', '2026-02-28 16:12:40', NULL),
(7, 2, 'ORD1772295573', 200.00, 'Completed', '2026-02-28 16:19:33', NULL),
(8, 2, 'ORD1772295681', 40.00, 'Completed', '2026-02-28 16:21:21', NULL),
(9, 2, 'ORD1772295694', 20.00, 'Completed', '2026-02-28 16:21:34', NULL),
(10, 2, 'ORD1772296044', 220.00, 'Completed', '2026-02-28 16:27:24', NULL),
(11, 2, 'ORD1772296255', 320.00, 'Completed', '2026-02-28 16:30:55', NULL),
(12, 2, 'ORD1772297195', 200.00, 'Completed', '2026-02-28 16:46:35', NULL),
(13, 2, 'ORD1772297241', 100.00, 'Completed', '2026-02-28 16:47:21', NULL),
(14, 2, 'ORD1772468848', 280.00, 'Completed', '2026-03-02 16:27:28', NULL),
(15, 1, 'ORD1772481895', 100.00, 'Completed', '2026-03-02 20:04:55', NULL),
(16, 1, 'ORD1772481974', 120.00, 'Completed', '2026-03-02 20:06:14', NULL),
(17, 1, 'ORD1772482439', 120.00, 'Completed', '2026-03-02 20:13:59', NULL),
(18, 1, 'ORD1772485866', 300.00, 'Completed', '2026-03-02 21:11:06', NULL),
(19, 1, 'ORD1772486083', 120.00, 'Completed', '2026-03-02 21:14:43', NULL),
(20, 1, 'ORD1772486473', 100.00, 'Completed', '2026-03-02 21:21:13', NULL),
(21, 1, 'ORD1772486628', 100.00, 'Completed', '2026-03-02 21:23:48', NULL),
(22, 1, 'ORD1772487773', 100.00, 'Completed', '2026-03-02 21:42:53', NULL),
(23, 1, 'ORD1772554243', 120.00, 'Completed', '2026-03-03 16:10:43', NULL),
(24, 3, 'ORD1772631990', 260.00, 'Completed', '2026-03-04 13:46:30', NULL),
(25, 4, 'ORD1772653927', 100.00, 'Completed', '2026-03-04 19:52:07', NULL),
(26, 1, 'ORD1772712332', 100.00, 'Completed', '2026-03-05 12:05:32', NULL),
(27, 1, 'ORD1772895563', 100.00, 'Completed', '2026-03-07 14:59:23', NULL),
(28, 1, 'ORD1772895700', 120.00, 'Completed', '2026-03-07 15:01:40', NULL),
(29, 1, 'ORD1772896872', 10.00, 'Completed', '2026-03-07 15:21:12', NULL),
(30, 1, 'ORD1772918322', 308.00, 'Completed', '2026-03-07 21:18:42', NULL),
(31, 1, 'ORD_20260309_0356', 65.00, 'Completed', '2026-03-09 02:56:16', NULL),
(32, 2, 'ORD_20260309_0359', 38.00, 'Completed', '2026-03-09 02:59:31', NULL),
(33, 2, 'ORD_2026/03/09_04:00', 120.00, 'Completed', '2026-03-09 03:00:00', NULL),
(34, 2, 'ORD_2026/03/09_05:01', 130.00, 'Completed', '2026-03-09 03:01:57', NULL),
(35, 2, 'ORD_2026/03/09_05:02', 20.00, 'Completed', '2026-03-09 03:02:04', NULL),
(37, 2, 'ORD_2026/03/09_05:04', 100.00, 'Completed', '2026-03-09 03:04:08', NULL),
(38, 2, 'ORD_2026/03/09_05:08', 100.00, 'Completed', '2026-03-09 03:08:04', NULL),
(39, 2, 'ORD_2026/03/09_05:09', 155.00, 'Completed', '2026-03-09 03:09:34', NULL),
(41, 2, 'ORD_2026-03-09_05:11', 10.00, 'Completed', '2026-03-09 03:11:29', NULL),
(42, 2, 'ORD_2026_03_09_05:11', 20.00, 'Completed', '2026-03-09 03:11:52', NULL),
(43, 2, 'ORD_2026-03-09_05-16', 20.00, 'Completed', '2026-03-09 03:16:03', NULL),
(44, 2, 'ORD_2026/03/09_05:19', 20.00, 'Completed', '2026-03-09 03:19:19', NULL),
(45, 2, 'ORD_2026-03-09_05-20', 48.00, 'Completed', '2026-03-09 03:20:55', NULL),
(46, 2, 'ORD_2026-03-09_05-27', 93.00, 'Completed', '2026-03-09 03:27:00', NULL),
(47, 6, 'ORD_2026-03-09_12-59', 114.00, 'Completed', '2026-03-09 10:59:43', NULL),
(48, 6, 'ORD1773054097', 114.00, 'Completed', '2026-03-09 11:01:37', NULL),
(49, 7, 'ORD_2026-03-09_13-15', 125.00, 'Completed', '2026-03-09 11:15:36', NULL),
(50, 1, 'ORD_2026-03-10_12-10', 100.00, 'Completed', '2026-03-10 10:10:26', NULL),
(51, 1, 'ORD_2026-03-11_00-47', 20.00, 'Completed', '2026-03-10 22:47:51', 1),
(52, 1, 'ORD_2026-03-11_00-55', 20.00, 'Completed', '2026-03-10 22:55:07', 1),
(53, 1, 'ORD_2026-03-11_00-58', 20.00, 'Completed', '2026-03-10 22:58:38', 1),
(54, 1, 'ORD_2026-03-11_01-11', 30.00, 'Completed', '2026-03-10 23:11:43', 1),
(56, 1, 'ORD_2026-03-11_01-12', 20.00, 'Completed', '2026-03-10 23:12:10', 1),
(61, 1, 'ORD_2026-03-11_01-27', 0.00, 'Completed', '2026-03-10 23:27:25', 1),
(62, 1, 'ORD_2026-03-11_15-05', 0.00, 'Completed', '2026-03-11 13:05:27', 1),
(63, 1, 'ORD_2026-03-11_15-07', 0.00, 'Completed', '2026-03-11 13:07:46', 1),
(64, 1, 'ORD_2026-03-11_15-12', 115.00, 'Completed', '2026-03-11 13:12:07', 1),
(65, 1, 'ORD_2026-03-11_15-15', 145.00, 'Completed', '2026-03-11 13:15:04', 1),
(66, 1, 'ORD_2026-03-11_16-23', 65.00, 'Completed', '2026-03-11 14:23:58', 7),
(67, 4, 'ORD_2026-03-12_16-31', 10.00, 'Completed', '2026-03-12 14:31:51', 2),
(68, 4, 'ORD_2026-03-13_14-23', 478.00, 'Completed', '2026-03-13 12:23:46', 4);

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
(105, 30, 2, 3, 20.00, 60.00, ''),
(106, 31, 3, 1, 10.00, 10.00, ''),
(107, 31, 6, 1, 45.00, 45.00, ''),
(108, 31, 7, 1, 10.00, 10.00, 'زيادة'),
(109, 32, 2, 1, 20.00, 20.00, ''),
(110, 32, 3, 1, 10.00, 10.00, ''),
(111, 32, 4, 1, 8.00, 8.00, ''),
(112, 33, 1, 1, 100.00, 100.00, ''),
(113, 33, 2, 1, 20.00, 20.00, ''),
(114, 34, 2, 1, 20.00, 20.00, ''),
(115, 34, 3, 1, 10.00, 10.00, ''),
(116, 34, 1, 1, 100.00, 100.00, ''),
(117, 35, 2, 1, 20.00, 20.00, ''),
(118, 37, 1, 1, 100.00, 100.00, ''),
(119, 38, 1, 1, 100.00, 100.00, ''),
(120, 39, 1, 1, 100.00, 100.00, ''),
(121, 39, 3, 1, 10.00, 10.00, ''),
(122, 39, 6, 1, 45.00, 45.00, ''),
(123, 41, 3, 1, 10.00, 10.00, ''),
(124, 42, 2, 1, 20.00, 20.00, ''),
(125, 43, 2, 1, 20.00, 20.00, ''),
(126, 44, 2, 1, 20.00, 20.00, ''),
(127, 45, 15, 1, 48.00, 48.00, ''),
(128, 46, 15, 1, 48.00, 48.00, ''),
(129, 46, 14, 1, 45.00, 45.00, ''),
(130, 47, 3, 4, 10.00, 40.00, ''),
(131, 47, 9, 3, 18.00, 54.00, ''),
(132, 47, 19, 1, 20.00, 20.00, ''),
(133, 48, 3, 4, 10.00, NULL, ''),
(134, 48, 9, 3, 18.00, NULL, ''),
(135, 48, 19, 1, 20.00, NULL, ''),
(136, 49, 7, 2, 10.00, 20.00, ''),
(137, 49, 11, 2, 20.00, 40.00, ''),
(138, 49, 14, 1, 45.00, 45.00, ''),
(139, 49, 19, 1, 20.00, 20.00, ''),
(140, 50, 1, 1, 100.00, 100.00, ''),
(141, 51, 2, 1, 20.00, 20.00, ''),
(142, 52, 2, 1, 20.00, 20.00, ''),
(143, 53, 2, 1, 20.00, 20.00, ''),
(144, 54, 2, 1, 20.00, 20.00, ''),
(145, 54, 3, 1, 10.00, 10.00, ''),
(146, 56, 2, 1, 20.00, 20.00, ''),
(147, 61, 1, 1, 100.00, 100.00, ''),
(148, 62, 1, 3, 100.00, 300.00, ''),
(149, 62, 5, 1, 30.00, 30.00, ''),
(150, 62, 6, 2, 45.00, 90.00, ''),
(151, 62, 7, 1, 10.00, 10.00, 'زيادة'),
(152, 62, 19, 3, 20.00, 60.00, ''),
(153, 64, 17, 1, 45.00, 45.00, ''),
(154, 64, 16, 1, 50.00, 50.00, ''),
(155, 64, 19, 1, 20.00, 20.00, ''),
(156, 65, 5, 2, 30.00, 60.00, ''),
(157, 65, 7, 1, 10.00, 10.00, ''),
(158, 65, 8, 1, 15.00, 15.00, ''),
(159, 65, 19, 1, 20.00, 20.00, ''),
(160, 65, 19, 1, 20.00, 20.00, ''),
(161, 65, 19, 1, 20.00, 20.00, ''),
(162, 66, 2, 1, 20.00, 20.00, ''),
(163, 66, 6, 1, 45.00, 45.00, ''),
(164, 67, 3, 1, 10.00, 10.00, ''),
(165, 68, 1, 2, 100.00, 200.00, ''),
(166, 68, 3, 1, 10.00, 10.00, ''),
(167, 68, 2, 2, 20.00, 40.00, ''),
(168, 68, 5, 1, 30.00, 30.00, ''),
(169, 68, 7, 3, 10.00, 30.00, '2-زيادة 1 سادة'),
(170, 68, 15, 1, 48.00, 48.00, ''),
(171, 68, 16, 1, 50.00, 50.00, ''),
(172, 68, 20, 1, 15.00, 15.00, ''),
(173, 68, 19, 1, 20.00, 20.00, ''),
(174, 68, 20, 1, 15.00, 15.00, ''),
(175, 68, 19, 1, 20.00, 20.00, '');

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
(1, 'Burger', 'Delicious beef burger', 100.00, 88, 1, 'burger.png'),
(2, 'French Fries', 'good potato', 20.00, 82, 1, 'potato.png'),
(3, 'Taameya Sandwich', 'Egyptian falafel sandwich', 10.00, 81, 1, 'taameya.png'),
(4, 'Foul Sandwich', 'Egyptian fava beans sandwich', 8.00, 93, 1, 'foul.png'),
(5, 'Hawawshi', 'Hawawshi with meat', 30.00, 96, 1, 'hawawshi.png'),
(6, 'Mint lemonade', 'Mint lemonade fresh', 45.00, 95, 2, 'Mint lemonade.png'),
(7, 'Black Coffee', 'Authentic Egyptian coffee, no milk', 10.00, 41, 2, 'black coffee.png'),
(8, 'French Coffee', 'Coffee with milk, light French flavor', 15.00, 49, 2, 'Frensh Coffee.png'),
(9, 'Cappuccino', 'Coffee with milk foam, rich flavor', 18.00, 47, 2, 'Cappuccino.png'),
(10, 'Latte', 'Coffee with milk, smooth and balanced taste', 18.00, 50, 2, 'Latte.png'),
(11, 'Mocha', 'Coffee with chocolate, sweet and delicious', 20.00, 48, 2, 'mocha coffee.png'),
(12, 'Iced Coffee', 'Refreshing cold coffee, with or without sugar', 20.00, 50, 2, 'Iced coffee.png'),
(13, 'Blueberry Smoothie', 'Blueberry Smoothie with ice', 40.00, 49, 2, 'blueberry Smoothie.png'),
(14, 'Mango Smoothie', 'Mango Smoothie with ice', 45.00, 48, 2, 'Mango Smoothie.png'),
(15, 'Strawberry Smoothie', 'Strawberry Smoothie with ice', 48.00, 47, 2, 'Strawberry Smoothie.png'),
(16, 'Mango Juice (Fresh)', 'Mango Juice (Fresh) with Small mango pieces', 50.00, 48, 2, 'Mango Juice (Fresh).png'),
(17, 'Orange Juice (Fresh)', 'Orange Juice (Fresh) delicious orange', 45.00, 49, 2, 'Orange Juice (Fresh).png'),
(18, 'Strawberry Juice (Fresh)', 'Strawberry Juice (Fresh) with Small strawberry pieces', 50.00, 49, 2, 'Strawberry Juice (Fresh).png'),
(19, 'V-Cola', 'Refreshing cola drink', 20.00, 37, 2, 'VSS.png'),
(20, 'BR-pizza', 'we have all flavors', 15.00, 98, 3, 'BR-Pizza.png');

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
(1, 'Yohana', 'yohanashraffayz@gmail.com', '$2y$10$/6DfkY6EATcUrVsgyoNewO5XbsLyfUhjIT8Rlmck.eyOPUWxa/Ide', 'admin', '2026-02-27 18:24:05', NULL, NULL, NULL, NULL),
(2, 'staff', 'whywork2421@gmail.com', '$2y$10$Mvdl.hEIl7yDKwbum/QrsOEwfmAeDmoGfm3eA8YDwrW7d35u8hvHq', 'staff', '2026-02-27 18:24:23', NULL, NULL, NULL, NULL),
(3, 'mo alaa', 'mo@gmail.com', '$2y$10$NkCLTBa2k3Jqvde7ejrYdeRB3MgaOXJkpVFR5g8c1np/IiNOG6zM6', 'customer', '2026-03-04 13:45:34', NULL, NULL, NULL, NULL),
(4, 'Demiana', 'demianaashraf32@gmail.com', '$2y$10$5H/xuQvPAYfARBzMcg4USeqQj/z/ED1lPs0gHg.0oDTViamqzOK2.', 'customer', '2026-03-04 19:49:17', NULL, NULL, NULL, NULL),
(6, 'salma', 'salma@gmail.com', '$2y$10$Bj9wOQpGcd6yZe/Z6UoqT.GUGtFJmc3dldwtU/Vs6EOq0lDfHfTWG', 'customer', '2026-03-09 10:58:15', NULL, NULL, NULL, NULL),
(7, 'ENG:RANA', 'ENGRANA@gmail.com', '$2y$10$/HBiOatGPhL.HHXHfcqT/OTz.fNx.msky8j.hjQtY2rCM1Ud3drEy', 'customer', '2026-03-09 11:13:11', NULL, NULL, NULL, NULL),
(10, 'shaco', 'shaco@gmail.com', '$2y$10$2XIMwM.6G8v8BtmK4CggGOpkpIxniip72qkLe9Gvm9tvMUxtpbOIu', 'staff', '2026-03-11 17:33:45', NULL, NULL, NULL, NULL),
(11, 'admin', 'admin@gmail.com', '$2y$10$ighRTBrW//DDFIu5FKdzBeL0tmvzSyPXn0.iYPpX2J772Gqe0x0gG', 'admin', '2026-03-11 18:06:01', NULL, NULL, NULL, NULL),
(12, 'hamada', 'hamo@gmail.com', '$2y$10$maeQ3ZVb40Q6gSX9qavSb.2dRMLwuhitcK9a3ucUxTmwRCTrImjcu', 'customer', '2026-03-11 18:21:35', NULL, NULL, NULL, NULL),
(13, 'wegz', 'wegz@gmail.com', '$2y$10$ry98ytzQgP1puydBbOZcdOrii/vILfIQLDacFEURPtiYmnl7lI6ZC', 'staff', '2026-03-11 18:46:22', NULL, NULL, NULL, NULL),
(14, 'TRY', 'try@gmail.com', '$2y$10$V3QPA8ju7Xww7Y1G2bAs6.8VikcgZNQz37mfTNWx6LFz.fsU7rZL6', 'customer', '2026-03-16 22:28:34', '', 23, 'engineering', 'electronics'),
(15, 'try2', 'try2@gmail.com', '$2y$10$MLvT9/tm.02JKT.foVgmr.RbHgF3CSzdCK3bXiAjo5ZPS6Xp7Myuu', 'customer', '2026-03-16 22:32:09', '', 24, 'engineering', 'electronics'),
(16, 'try3', 'try3@gmail.com', '$2y$10$h98LZI4CsY5wrWnkoamM0.yjkQwzptLOYD8x4EuU3wXglgP7bNH1u', 'customer', '2026-03-16 22:40:47', 'female', 22, 'engineering', 'architecture'),
(17, 'try4', 'try4@gmail.com', '$2y$10$LOQp8tK4ynD1NlGtBWNtpuR0B918Gv/wcAtWOuF.9388q/cF0iUve', 'customer', '2026-03-16 22:43:08', 'female', 21, 'commerce', NULL);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `notification_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `order_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=176;

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
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

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
