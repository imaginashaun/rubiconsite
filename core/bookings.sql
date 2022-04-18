-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Apr 18, 2022 at 07:24 PM
-- Server version: 5.7.34
-- PHP Version: 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rubicon`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'No Title',
  `member_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `service_id` int(10) UNSIGNED NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `budget` decimal(18,8) NOT NULL DEFAULT '0.00000000',
  `order_number` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delivery_date` date DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'Unpaid : 0\r\nRunning : 1\r\nPayable Journalist : 2\r\nPayable Member : 3\r\nPayable Both : 4\r\nPaid : 5\r\nRefund : 6',
  `working_status` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'Pending:0, Complet:1, Delivered:2, In Progress:3 Cancel:4\r\ndispute : 5\r\n Delivery expired:6',
  `dispute_report` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `title`, `member_id`, `user_id`, `service_id`, `description`, `budget`, `order_number`, `delivery_date`, `status`, `working_status`, `dispute_report`, `created_at`, `updated_at`) VALUES
(1, 'No Title', 1, 0, 1, 'Write about ABC', '50.00000000', 'CNPY9AEM5JYB', '2022-04-14', 1, 0, NULL, '2022-04-13 05:39:58', '2022-04-13 05:39:58'),
(2, 'No Title', 1, 2, 1, 'I need a new article', '500.00000000', 'U4XQSU8YNCV7', '2022-04-15', 5, 2, NULL, '2022-04-13 05:41:29', '2022-04-13 23:38:14'),
(3, 'No Title', 1, 0, 1, 'Testing', '100.00000000', 'F7277A8C9XVM', '2022-04-15', 1, 0, NULL, '2022-04-13 05:43:53', '2022-04-13 05:43:53'),
(4, 'No Title', 1, 2, 1, 'Hello', '500.00000000', 'TW7Y3RQGBZF9', '2022-04-16', 1, 2, NULL, '2022-04-13 23:02:55', '2022-04-13 23:43:24'),
(5, 'No Title', 1, 0, 1, 'test', '500.00000000', 'VW2SBFK2OQ19', '2022-04-16', 1, 0, NULL, '2022-04-13 23:13:16', '2022-04-13 23:13:16'),
(6, 'No Title', 1, 2, 1, 'test', '500.00000000', 'RP8NWMKH82EB', '2022-04-15', 7, 0, NULL, '2022-04-13 23:22:03', '2022-04-13 23:22:03'),
(7, 'No Title', 1, 2, 1, 'test', '200.00000000', 'JTV7SBTP2HCN', '2022-04-30', 5, 2, NULL, '2022-04-13 23:25:03', '2022-04-13 23:36:49'),
(8, 'No Title', 1, 0, 1, 'test', '1000.00000000', 'JGSFJJUPDC9G', '2022-04-29', 1, 0, NULL, '2022-04-13 23:42:36', '2022-04-13 23:42:36'),
(9, 'No Title', 1, 0, 1, 'test', '2000.00000000', 'B2BOPVDA1E2W', '2022-04-15', 1, 0, NULL, '2022-04-13 23:45:10', '2022-04-13 23:45:10'),
(10, 'No Title', 1, 2, 1, 'test', '100.00000000', 'DQ768MOKDNSC', '2022-04-22', 1, 3, NULL, '2022-04-13 23:51:49', '2022-04-13 23:52:28'),
(11, 'No Title', 1, 0, 1, 'test', '300.00000000', 'K67H1PKQ7X7K', '2022-04-23', 1, 0, NULL, '2022-04-13 23:53:32', '2022-04-13 23:53:32'),
(12, 'No Title', 1, 2, 1, 'Testing', '123.00000000', '2HZ8PFOM3HW3', '2022-04-17', 1, 3, NULL, '2022-04-13 23:54:32', '2022-04-13 23:56:12'),
(13, 'No Title', 1, 0, 1, 'test', '124.00000000', 'UM5U3KR416CH', '2022-04-15', 1, 0, NULL, '2022-04-13 23:56:45', '2022-04-13 23:56:45'),
(14, 'No Title', 1, 2, 1, 'aaa', '140.00000000', 'XK93OCKM1BG4', '2022-04-21', 1, 0, NULL, '2022-04-14 00:00:20', '2022-04-14 00:00:53'),
(15, 'No Title', 1, 2, 1, 'test', '126.00000000', 'RN3MY7J1DE9Q', '2022-04-29', 1, 3, NULL, '2022-04-14 00:03:52', '2022-04-14 00:04:32'),
(16, 'No Title', 1, 2, 1, 'test', '127.00000000', 'JRS5XKA98WPK', '2022-04-23', 1, 3, NULL, '2022-04-14 00:05:10', '2022-04-14 00:05:36'),
(17, 'No Title', 1, 2, 1, 'We need a story', '111.00000000', 'B6HY7BJRSF9H', '2022-04-16', 5, 1, NULL, '2022-04-14 00:10:17', '2022-04-14 00:16:21'),
(18, 'No Title', 1, 0, 1, 'Hello world', '1005.00000000', 'FX83UVNSRZJB', '2022-04-16', 1, 3, NULL, '2022-04-14 00:17:10', '2022-04-14 00:25:35'),
(19, 'No Title', 1, 2, 1, 'Hey there', '9999.00000000', '5CPCGPUOQY49', '2022-04-22', 1, 3, NULL, '2022-04-14 00:18:14', '2022-04-14 00:21:47'),
(20, 'No Title', 1, 2, 1, 'jjj', '129.00000000', 'ZTGBU85VEZVY', '2022-04-16', 5, 1, NULL, '2022-04-14 00:29:03', '2022-04-14 00:31:31'),
(21, 'No Title', 1, 2, 1, 'test', '131.00000000', 'NWVX9DNX8JTP', '2022-04-15', 1, 3, NULL, '2022-04-14 00:32:20', '2022-04-14 00:37:15'),
(22, 'No Title', 1, 2, 1, 'Welcome to the new world', '100.00000000', 'NG9F1HCD6UK7', '2022-04-16', 7, 0, NULL, '2022-04-14 01:30:03', '2022-04-14 01:30:03'),
(23, 'Sample Booking', 1, 2, 1, 'hello', '500.00000000', '8Y3CUXWAO5GJ', '2022-04-21', 7, 0, NULL, '2022-04-18 15:14:01', '2022-04-18 15:14:01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
