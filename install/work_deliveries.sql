-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 17, 2022 at 07:56 AM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
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
-- Table structure for table `work_deliveries`
--

CREATE TABLE `work_deliveries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `journalist_id` int(10) UNSIGNED NOT NULL,
  `booking_id` int(10) UNSIGNED NOT NULL,
  `work_file` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `download_count` tinyint(4) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `approval_status` enum('Pending Approval','Has been approved','Has been rejected','Similar work has already been submitted') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `work_deliveries`
--

INSERT INTO `work_deliveries` (`id`, `journalist_id`, `booking_id`, `work_file`, `details`, `download_count`, `status`, `approval_status`, `created_at`, `updated_at`) VALUES
(1, 3, 5, '62572b4f4f73b.zip', 'hahaha', NULL, 0, 'Pending Approval', '2022-04-13 17:58:07', '2022-04-13 17:58:07'),
(2, 3, 14, '625b9d6fcb8ae.zip', 'test', NULL, 0, 'Pending Approval', '2022-04-17 02:54:07', '2022-04-17 02:54:07'),
(3, 3, 14, '625b9e2451734.zip', 'test', NULL, 0, 'Has been approved', '2022-04-17 02:57:08', '2022-04-17 03:56:21');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `work_deliveries`
--
ALTER TABLE `work_deliveries`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `work_deliveries`
--
ALTER TABLE `work_deliveries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
