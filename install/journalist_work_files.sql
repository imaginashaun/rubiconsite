-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 18, 2022 at 04:50 PM
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
-- Table structure for table `journalist_work_files`
--

CREATE TABLE `journalist_work_files` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` tinyint(4) NOT NULL,
  `title` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `video_file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `background_image` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `audio_file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `blog_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `descripation` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT 'Active: 1 Inactive:0 Cancel : 2',
  `story_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `journalist_work_files`
--

INSERT INTO `journalist_work_files` (`id`, `user_id`, `title`, `video_file`, `background_image`, `audio_file`, `blog_link`, `image`, `descripation`, `status`, `story_id`, `created_at`, `updated_at`) VALUES
(1, 3, 'test', 'https://www.youtube.com/watch?v=YtmqU4J-5X8', '625d7563aba671650292067.jpeg', NULL, NULL, NULL, 'test', 0, 12, '2022-04-18 12:27:47', '2022-04-18 12:27:47'),
(2, 3, 'tets', NULL, NULL, '625d7911e1954.mp3', NULL, NULL, 'test', 0, 8, '2022-04-18 12:43:29', '2022-04-18 12:43:29'),
(3, 3, 'test', NULL, NULL, NULL, NULL, '625d79f2c94a41650293234.jpeg', 'test', 0, 5, '2022-04-18 12:47:14', '2022-04-18 12:47:14'),
(4, 3, 'test', NULL, NULL, NULL, 'http://jsfiddle.net/dgy3k95e/', NULL, 'test', 0, 7, '2022-04-18 12:48:52', '2022-04-18 12:48:52');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `journalist_work_files`
--
ALTER TABLE `journalist_work_files`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `journalist_work_files`
--
ALTER TABLE `journalist_work_files`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
