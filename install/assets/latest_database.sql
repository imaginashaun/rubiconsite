-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 12, 2022 at 10:55 PM
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
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `username`, `email_verified_at`, `image`, `password`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'admin@site.com', 'admin', NULL, '5ff1c3531ed3f1609679699.jpg', '$2y$10$x/7gNA5Q1jdbiPY5onEfeOxoKWIXVxRSoGQEzPkk5TSOSpd8bAHlC', NULL, '2022-04-12 15:35:46');

-- --------------------------------------------------------

--
-- Table structure for table `admin_password_resets`
--

CREATE TABLE `admin_password_resets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `member_id` int(10) UNSIGNED DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `service_id` int(10) UNSIGNED NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `budget` decimal(18,8) NOT NULL DEFAULT 0.00000000,
  `order_number` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delivery_date` date DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT 'Unpaid : 0\r\nRunning : 1\r\nPayable Journalist : 2\r\nPayable Member : 3\r\nPayable Both : 4\r\nPaid : 5\r\nRefund : 6',
  `working_status` tinyint(4) NOT NULL DEFAULT 0 COMMENT 'Pending:0, Complet:1, Delivered:2, In Progress:3 Cancel:4\r\ndispute : 5\r\n Delivery expired:6',
  `dispute_report` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `member_id`, `user_id`, `service_id`, `description`, `budget`, `order_number`, `delivery_date`, `status`, `working_status`, `dispute_report`, `created_at`, `updated_at`) VALUES
(1, 1, 0, 1, NULL, '0.40000000', '1', '2022-12-12', 0, 0, NULL, '2022-04-12 15:15:16', '2022-04-12 15:15:16'),
(2, 1, 0, 1, 'test', '45.00000000', '1', '2022-03-29', 0, 0, NULL, '2022-04-12 15:18:01', '2022-04-12 15:18:01'),
(3, 2, 0, 1, 'test', '200.00000000', '1', '2022-04-05', 0, 0, NULL, '2022-04-12 15:21:20', '2022-04-12 15:21:20'),
(4, 1, 0, 1, 'test', '1.00000000', '7VX5NHP7318C', '2022-04-14', 1, 0, NULL, '2022-04-12 15:52:45', '2022-04-12 15:52:45'),
(5, 1, 3, 1, 'test', '56.00000000', 'KZKGR4WOPDRA', '2022-04-12', 1, 0, NULL, '2022-04-12 16:58:43', '2022-04-12 16:58:43'),
(6, 1, 3, 1, 'test', '87.00000000', 'YE83XJWU1JS4', '2022-04-19', 0, 0, NULL, '2022-04-12 16:59:56', '2022-04-12 16:59:56'),
(7, 1, 3, 1, 'all', '56.00000000', '2GY2YGVFMFZ6', '2022-04-13', 0, 0, NULL, '2022-04-12 17:00:38', '2022-04-12 17:00:38'),
(8, 1, 3, 1, 'test', '568.00000000', 'KCHKJ8A6O69S', '2022-04-13', 0, 0, NULL, '2022-04-12 17:56:51', '2022-04-12 17:56:51'),
(9, 1, 0, 1, 'tesr', '342.00000000', 'Q77TX26DP6NO', '2022-04-14', 1, 0, NULL, '2022-04-12 18:50:16', '2022-04-12 18:50:16'),
(10, 1, 0, 1, '445', '454.00000000', 'PZBT7PVR17ZQ', '2022-04-15', 1, 0, NULL, '2022-04-12 18:50:44', '2022-04-12 18:50:44'),
(11, 1, 0, 1, 'fgfgf', '678.00000000', 'M7JPM4UF5ZTJ', '2022-04-15', 1, 0, NULL, '2022-04-12 18:51:01', '2022-04-12 18:51:01');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'dsd', '2021-04-12 00:08:44', '2021-04-12 00:08:44'),
(2, 'dsd', '2021-04-12 00:08:49', '2021-04-12 00:08:49');

-- --------------------------------------------------------

--
-- Table structure for table `conversations`
--

CREATE TABLE `conversations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sender_id` int(10) UNSIGNED NOT NULL,
  `receiver_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `deposits`
--

CREATE TABLE `deposits` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `method_code` int(10) UNSIGNED NOT NULL,
  `amount` decimal(18,8) NOT NULL,
  `method_currency` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `charge` decimal(18,8) NOT NULL,
  `rate` decimal(18,8) NOT NULL,
  `final_amo` decimal(18,8) DEFAULT 0.00000000,
  `detail` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `btc_amo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `btc_wallet` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trx` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `try` int(11) NOT NULL DEFAULT 0,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '1=>success, 2=>pending, 3=>cancel',
  `admin_feedback` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `deposits`
--

INSERT INTO `deposits` (`id`, `user_id`, `method_code`, `amount`, `method_currency`, `charge`, `rate`, `final_amo`, `detail`, `btc_amo`, `btc_wallet`, `trx`, `try`, `status`, `admin_feedback`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '1500.00000000', '$', '0.00000000', '1.00000000', '0.00000000', NULL, NULL, NULL, NULL, 0, 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `educations`
--

CREATE TABLE `educations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `school` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `from_year` date DEFAULT NULL,
  `to_year` date DEFAULT NULL,
  `subject` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `email_sms_templates`
--

CREATE TABLE `email_sms_templates` (
  `id` int(10) UNSIGNED NOT NULL,
  `act` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subj` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_body` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sms_body` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shortcodes` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_status` tinyint(4) NOT NULL DEFAULT 1,
  `sms_status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `email_sms_templates`
--

INSERT INTO `email_sms_templates` (`id`, `act`, `name`, `subj`, `email_body`, `sms_body`, `shortcodes`, `email_status`, `sms_status`, `created_at`, `updated_at`) VALUES
(1, 'PASS_RESET_CODE', 'Password Reset', 'Password Reset', '<div>We have received a request to reset the password for your account on <b>{{time}} .<br></b></div><div>Requested From IP: <b>{{ip}}</b> using <b>{{browser}}</b> on <b>{{operating_system}} </b>.</div><div><br></div><br><div><div><div>Your account recovery code is:&nbsp;&nbsp; <font size=\"6\"><b>{{code}}</b></font></div><div><br></div></div></div><div><br></div><div><font size=\"4\" color=\"#CC0000\">If you do not wish to reset your password, please disregard this message.&nbsp;</font><br></div><br>', 'Your account recovery code is: {{code}}', ' {\"code\":\"Password Reset Code\",\"ip\":\"IP of User\",\"browser\":\"Browser of User\",\"operating_system\":\"Operating System of User\",\"time\":\"Request Time\"}', 1, 1, '2019-09-24 23:04:05', '2021-01-06 00:49:06'),
(2, 'PASS_RESET_DONE', 'Password Reset Confirmation', 'You have Reset your password', '<div><p>\r\n    You have successfully reset your password.</p><p>You changed from&nbsp; IP: <b>{{ip}}</b> using <b>{{browser}}</b> on <b>{{operating_system}}&nbsp;</b> on <b>{{time}}</b></p><p><b><br></b></p><p><font color=\"#FF0000\"><b>If you did not changed that, Please contact with us as soon as possible.</b></font><br></p></div>', 'Your password has been changed successfully', '{\"ip\":\"IP of User\",\"browser\":\"Browser of User\",\"operating_system\":\"Operating System of User\",\"time\":\"Request Time\"}', 1, 1, '2019-09-24 23:04:05', '2020-03-07 10:23:47'),
(3, 'EVER_CODE', 'Email Verification', 'Please verify your email address', '<div><br></div><div>Thanks For join with us. <br></div><div>Please use below code to verify your email address.<br></div><div><br></div><div>Your email verification code is:<font size=\"6\"><b> {{code}}</b></font></div>', 'Your email verification code is: {{code}}', '{\"code\":\"Verification code\"}', 1, 1, '2019-09-24 23:04:05', '2021-01-03 23:35:10'),
(4, 'SVER_CODE', 'SMS Verification ', 'Please verify your phone', 'Your phone verification code is: {{code}}', 'Your phone verification code is: {{code}}', '{\"code\":\"Verification code\"}', 0, 1, '2019-09-24 23:04:05', '2020-03-08 01:28:52'),
(5, '2FA_ENABLE', 'Google Two Factor - Enable', 'Google Two Factor Authentication is now  Enabled for Your Account', '<div>You just enabled Google Two Factor Authentication for Your Account.</div><div><br></div><div>Enabled at <b>{{time}} </b>From IP: <b>{{ip}}</b> using <b>{{browser}}</b> on <b>{{operating_system}} </b>.</div>', 'Your verification code is: {{code}}', '{\"ip\":\"IP of User\",\"browser\":\"Browser of User\",\"operating_system\":\"Operating System of User\",\"time\":\"Request Time\"}', 1, 1, '2019-09-24 23:04:05', '2020-03-08 01:42:59'),
(6, '2FA_DISABLE', 'Google Two Factor Disable', 'Google Two Factor Authentication is now  Disabled for Your Account', '<div>You just Disabled Google Two Factor Authentication for Your Account.</div><div><br></div><div>Disabled at <b>{{time}} </b>From IP: <b>{{ip}}</b> using <b>{{browser}}</b> on <b>{{operating_system}} </b>.</div>', 'Google two factor verification is disabled', '{\"ip\":\"IP of User\",\"browser\":\"Browser of User\",\"operating_system\":\"Operating System of User\",\"time\":\"Request Time\"}', 1, 1, '2019-09-24 23:04:05', '2020-03-08 01:43:46'),
(16, 'ADMIN_SUPPORT_REPLY', 'Support Ticket Reply ', 'Reply Support Ticket', '<div><p><span style=\"font-size: 11pt;\" data-mce-style=\"font-size: 11pt;\"><strong>A member from our support team has replied to the following ticket:</strong></span></p><p><b><span style=\"font-size: 11pt;\" data-mce-style=\"font-size: 11pt;\"><strong><br></strong></span></b></p><p><b>[Ticket#{{ticket_id}}] {{ticket_subject}}<br><br>Click here to reply:&nbsp; {{link}}</b></p><p>----------------------------------------------</p><p>Here is the reply : <br></p><p> {{reply}}<br></p></div><div><br></div>', '{{subject}}\r\n\r\n{{reply}}\r\n\r\n\r\nClick here to reply:  {{link}}', '{\"ticket_id\":\"Support Ticket ID\", \"ticket_subject\":\"Subject Of Support Ticket\", \"reply\":\"Reply from Staff/Admin\",\"link\":\"Ticket URL For relpy\"}', 1, 1, '2020-06-08 18:00:00', '2020-05-04 02:24:40'),
(206, 'DEPOSIT_COMPLETE', 'Automated Deposit - Successful', 'Deposit Completed Successfully', '<div>Your deposit of <b>{{amount}} {{currency}}</b> is via&nbsp; <b>{{method_name}} </b>has been completed Successfully.<b><br></b></div><div><b><br></b></div><div><b>Details of your Deposit :<br></b></div><div><br></div><div>Amount : {{amount}} {{currency}}</div><div>Charge: <font color=\"#000000\">{{charge}} {{currency}}</font></div><div><br></div><div>Conversion Rate : 1 {{currency}} = {{rate}} {{method_currency}}</div><div>Payable : {{method_amount}} {{method_currency}} <br></div><div>Paid via :&nbsp; {{method_name}}</div><div><br></div><div>Transaction Number : {{trx}}</div><div><font size=\"5\"><b><br></b></font></div><div><font size=\"5\">Your current Balance is <b>{{post_balance}} {{currency}}</b></font></div><div><br></div><div><br><br><br></div>', '{{amount}} {{currrency}} Deposit successfully by {{gateway_name}}', '{\"trx\":\"Transaction Number\",\"amount\":\"Request Amount By user\",\"charge\":\"Gateway Charge\",\"currency\":\"Site Currency\",\"rate\":\"Conversion Rate\",\"method_name\":\"Deposit Method Name\",\"method_currency\":\"Deposit Method Currency\",\"method_amount\":\"Deposit Method Amount After Conversion\", \"post_balance\":\"Users Balance After this operation\"}', 1, 1, '2020-06-24 18:00:00', '2020-11-17 03:10:00'),
(207, 'DEPOSIT_REQUEST', 'Manual Deposit - User Requested', 'Deposit Request Submitted Successfully', '<div>Your deposit request of <b>{{amount}} {{currency}}</b> is via&nbsp; <b>{{method_name}} </b>submitted successfully<b> .<br></b></div><div><b><br></b></div><div><b>Details of your Deposit :<br></b></div><div><br></div><div>Amount : {{amount}} {{currency}}</div><div>Charge: <font color=\"#FF0000\">{{charge}} {{currency}}</font></div><div><br></div><div>Conversion Rate : 1 {{currency}} = {{rate}} {{method_currency}}</div><div>Payable : {{method_amount}} {{method_currency}} <br></div><div>Pay via :&nbsp; {{method_name}}</div><div><br></div><div>Transaction Number : {{trx}}</div><div><br></div><div><br></div>', '{{amount}} Deposit requested by {{method}}. Charge: {{charge}} . Trx: {{trx}}\r\n', '{\"trx\":\"Transaction Number\",\"amount\":\"Request Amount By user\",\"charge\":\"Gateway Charge\",\"currency\":\"Site Currency\",\"rate\":\"Conversion Rate\",\"method_name\":\"Deposit Method Name\",\"method_currency\":\"Deposit Method Currency\",\"method_amount\":\"Deposit Method Amount After Conversion\"}', 1, 1, '2020-05-31 18:00:00', '2020-06-01 18:00:00'),
(208, 'DEPOSIT_APPROVE', 'Manual Deposit - Admin Approved', 'Your Deposit is Approved', '<div>Your deposit request of <b>{{amount}} {{currency}}</b> is via&nbsp; <b>{{method_name}} </b>is Approved .<b><br></b></div><div><b><br></b></div><div><b>Details of your Deposit :<br></b></div><div><br></div><div>Amount : {{amount}} {{currency}}</div><div>Charge: <font color=\"#FF0000\">{{charge}} {{currency}}</font></div><div><br></div><div>Conversion Rate : 1 {{currency}} = {{rate}} {{method_currency}}</div><div>Payable : {{method_amount}} {{method_currency}} <br></div><div>Paid via :&nbsp; {{method_name}}</div><div><br></div><div>Transaction Number : {{trx}}</div><div><font size=\"5\"><b><br></b></font></div><div><font size=\"5\">Your current Balance is <b>{{post_balance}} {{currency}}</b></font></div><div><br></div><div><br><br></div>', 'Admin Approve Your {{amount}} {{gateway_currency}} payment request by {{gateway_name}} transaction : {{transaction}}', '{\"trx\":\"Transaction Number\",\"amount\":\"Request Amount By user\",\"charge\":\"Gateway Charge\",\"currency\":\"Site Currency\",\"rate\":\"Conversion Rate\",\"method_name\":\"Deposit Method Name\",\"method_currency\":\"Deposit Method Currency\",\"method_amount\":\"Deposit Method Amount After Conversion\", \"post_balance\":\"Users Balance After this operation\"}', 1, 1, '2020-06-16 18:00:00', '2020-06-14 18:00:00'),
(209, 'DEPOSIT_REJECT', 'Manual Deposit - Admin Rejected', 'Your Deposit Request is Rejected', '<div>Your deposit request of <b>{{amount}} {{currency}}</b> is via&nbsp; <b>{{method_name}} has been rejected</b>.<b><br></b></div><br><div>Transaction Number was : {{trx}}</div><div><br></div><div>if you have any query, feel free to contact us.<br></div><br><div><br><br></div>\r\n\r\n\r\n\r\n{{rejection_message}}', 'Admin Rejected Your {{amount}} {{gateway_currency}} payment request by {{gateway_name}}\r\n\r\n{{rejection_message}}', '{\"trx\":\"Transaction Number\",\"amount\":\"Request Amount By user\",\"charge\":\"Gateway Charge\",\"currency\":\"Site Currency\",\"rate\":\"Conversion Rate\",\"method_name\":\"Deposit Method Name\",\"method_currency\":\"Deposit Method Currency\",\"method_amount\":\"Deposit Method Amount After Conversion\",\"rejection_message\":\"Rejection message\"}', 1, 1, '2020-06-09 18:00:00', '2020-06-14 18:00:00'),
(210, 'WITHDRAW_REQUEST', 'Withdraw  - User Requested', 'Withdraw Request Submitted Successfully', '<div>Your withdraw request of <b>{{amount}} {{currency}}</b>&nbsp; via&nbsp; <b>{{method_name}} </b>has been submitted Successfully.<b><br></b></div><div><b><br></b></div><div><b>Details of your withdraw:<br></b></div><div><br></div><div>Amount : {{amount}} {{currency}}</div><div>Charge: <font color=\"#FF0000\">{{charge}} {{currency}}</font></div><div><br></div><div>Conversion Rate : 1 {{currency}} = {{rate}} {{method_currency}}</div><div>You will get: {{method_amount}} {{method_currency}} <br></div><div>Via :&nbsp; {{method_name}}</div><div><br></div><div>Transaction Number : {{trx}}</div><div><font size=\"4\" color=\"#FF0000\"><b><br></b></font></div><div><font size=\"4\" color=\"#FF0000\"><b>This may take {{delay}} to process the payment.</b></font><br></div><div><font size=\"5\"><b><br></b></font></div><div><font size=\"5\"><b><br></b></font></div><div><font size=\"5\">Your current Balance is <b>{{post_balance}} {{currency}}</b></font></div><div><br></div><div><br><br><br><br></div>', '{{amount}} {{currency}} withdraw requested by {{withdraw_method}}. You will get {{method_amount}} {{method_currency}} in {{duration}}. Trx: {{trx}}', '{\"trx\":\"Transaction Number\",\"amount\":\"Request Amount By user\",\"charge\":\"Gateway Charge\",\"currency\":\"Site Currency\",\"rate\":\"Conversion Rate\",\"method_name\":\"Deposit Method Name\",\"method_currency\":\"Deposit Method Currency\",\"method_amount\":\"Deposit Method Amount After Conversion\", \"post_balance\":\"Users Balance After this operation\", \"delay\":\"Delay time for processing\"}', 1, 1, '2020-06-07 18:00:00', '2020-06-14 18:00:00'),
(211, 'WITHDRAW_REJECT', 'Withdraw - Admin Rejected', 'Withdraw Request has been Rejected and your money is refunded to your account', '<div>Your withdraw request of <b>{{amount}} {{currency}}</b>&nbsp; via&nbsp; <b>{{method_name}} </b>has been Rejected.<b><br></b></div><div><b><br></b></div><div><b>Details of your withdraw:<br></b></div><div><br></div><div>Amount : {{amount}} {{currency}}</div><div>Charge: <font color=\"#FF0000\">{{charge}} {{currency}}</font></div><div><br></div><div>Conversion Rate : 1 {{currency}} = {{rate}} {{method_currency}}</div><div>You should get: {{method_amount}} {{method_currency}} <br></div><div>Via :&nbsp; {{method_name}}</div><div><br></div><div>Transaction Number : {{trx}}</div><div><br></div><div><br></div><div>----</div><div><font size=\"3\"><br></font></div><div><font size=\"3\"> {{amount}} {{currency}} has been <b>refunded </b>to your account and your current Balance is <b>{{post_balance}}</b><b> {{currency}}</b></font></div><div><br></div><div>-----</div><div><br></div><div><font size=\"4\">Details of Rejection :</font></div><div><font size=\"4\"><b>{{admin_details}}</b></font></div><div><br></div><div><br><br><br><br><br><br></div>', 'Admin Rejected Your {{amount}} {{currency}} withdraw request. Your Main Balance {{main_balance}}  {{method}} , Transaction {{transaction}}', '{\"trx\":\"Transaction Number\",\"amount\":\"Request Amount By user\",\"charge\":\"Gateway Charge\",\"currency\":\"Site Currency\",\"rate\":\"Conversion Rate\",\"method_name\":\"Deposit Method Name\",\"method_currency\":\"Deposit Method Currency\",\"method_amount\":\"Deposit Method Amount After Conversion\", \"post_balance\":\"Users Balance After this operation\", \"admin_details\":\"Details Provided By Admin\"}', 1, 1, '2020-06-09 18:00:00', '2020-06-14 18:00:00'),
(212, 'WITHDRAW_APPROVE', 'Withdraw - Admin  Approved', 'Withdraw Request has been Processed and your money is sent', '<div>Your withdraw request of <b>{{amount}} {{currency}}</b>&nbsp; via&nbsp; <b>{{method_name}} </b>has been Processed Successfully.<b><br></b></div><div><b><br></b></div><div><b>Details of your withdraw:<br></b></div><div><br></div><div>Amount : {{amount}} {{currency}}</div><div>Charge: <font color=\"#FF0000\">{{charge}} {{currency}}</font></div><div><br></div><div>Conversion Rate : 1 {{currency}} = {{rate}} {{method_currency}}</div><div>You will get: {{method_amount}} {{method_currency}} <br></div><div>Via :&nbsp; {{method_name}}</div><div><br></div><div>Transaction Number : {{trx}}</div><div><br></div><div>-----</div><div><br></div><div><font size=\"4\">Details of Processed Payment :</font></div><div><font size=\"4\"><b>{{admin_details}}</b></font></div><div><br></div><div><br><br><br><br><br></div>', 'Admin Approve Your {{amount}} {{currency}} withdraw request by {{method}}. Transaction {{transaction}}', '{\"trx\":\"Transaction Number\",\"amount\":\"Request Amount By user\",\"charge\":\"Gateway Charge\",\"currency\":\"Site Currency\",\"rate\":\"Conversion Rate\",\"method_name\":\"Deposit Method Name\",\"method_currency\":\"Deposit Method Currency\",\"method_amount\":\"Deposit Method Amount After Conversion\", \"admin_details\":\"Details Provided By Admin\"}', 1, 1, '2020-06-10 18:00:00', '2020-06-06 18:00:00'),
(215, 'BAL_ADD', 'Balance Add by Admin', 'Your Account has been Credited', '<div>{{amount}} {{currency}} has been added to your account .</div><div><br></div><div>Transaction Number : {{trx}}</div><div><br></div>Your Current Balance is : <font size=\"3\"><b>{{post_balance}}&nbsp; {{currency}}&nbsp;</b></font>', '{{amount}} {{currency}} credited in your account. Your Current Balance {{remaining_balance}} {{currency}} . Transaction: #{{trx}}', '{\"trx\":\"Transaction Number\",\"amount\":\"Request Amount By Admin\",\"currency\":\"Site Currency\", \"post_balance\":\"Users Balance After this operation\"}', 1, 1, '2019-09-14 19:14:22', '2021-01-06 00:46:18'),
(216, 'BAL_SUB', 'Balance Subtracted by Admin', 'Your Account has been Debited', '<div>{{amount}} {{currency}} has been subtracted from your account .</div><div><br></div><div>Transaction Number : {{trx}}</div><div><br></div>Your Current Balance is : <font size=\"3\"><b>{{post_balance}}&nbsp; {{currency}}</b></font>', '{{amount}} {{currency}} debited from your account. Your Current Balance {{remaining_balance}} {{currency}} . Transaction: #{{trx}}', '{\"trx\":\"Transaction Number\",\"amount\":\"Request Amount By Admin\",\"currency\":\"Site Currency\", \"post_balance\":\"Users Balance After this operation\"}', 1, 1, '2019-09-14 19:14:22', '2019-11-10 09:07:12'),
(217, 'BOOKING_PAYMENT', 'Booking Payment', 'Booking Payment', '<div>Your Booking Number&nbsp;{{order_number}}&nbsp;is via&nbsp; {{amount}}&nbsp;<span>{{currency}}</span><span>&nbsp;Booking Payment Confirm . Please Check Your Dashboard.</span></div>', '{{order_number}} {{amount}} And {{currency}} ', '{\"order_number\":\"Order Number\",\"amount\":\"Booking Budget \",\"currency\":\"Site Currency\"}', 1, 1, NULL, '2021-04-11 23:16:31'),
(218, 'JOURNALIST_BOOKED', 'Journalist Booked', 'Journalist Booked', '<div>Booking Number&nbsp;&nbsp;{{order_number}}&nbsp;Payment of&nbsp;{{amount}} {{currency}} Journalist Booked Now .<span>&nbsp;Please Check Your Dashboard.</span></div><div><span><br></span></div><div><span style=\"font-weight: bolder;\">Details of Booking:<br></span></div><div><br></div><div>Budget :&nbsp; {{amount}} {{currency}}</div><div><font>Order Number : {{order_number}}</font></div><div><br></div><div>Thank You</div><div><br></div><div><br></div>', '{{Order_number}} {{amount}} {{currency}}', '{\"order_number\":\"Order Number\",\"amount\":\"Payment Ammount\",\"currency\":\"Site Currency\"}', 1, 1, NULL, '2021-04-11 23:15:48'),
(219, 'SEND_MONEY', 'Journalist Send Money', 'Journalist Send Money', '<div>Thank You For Getting the Job Done . Your Work Money Has Been Credited To Your Account .&nbsp; Order Number&nbsp;<span style=\"font-weight: 700;\">{{order_number}}</span>&nbsp;Payment&nbsp; Amount&nbsp;&nbsp;<span style=\"font-weight: bolder;\">{{amount}} {{currency}}</span>&nbsp;.<span style=\"font-weight: bolder;\"><br></span></div><div><span style=\"font-weight: bolder;\"><br></span></div><div><span style=\"font-weight: bolder;\">Details of Payment:<br></span></div><div><br></div><div>Amount : {{amount}} {{currency}}</div><div><font>Order Number : {{order_number}}</font></div><div><br></div><div>Thank You</div><div><br><br></div><div><br></div><div><br></div>', '{{order_number}}{{amount}} {{currency}}', '{\"order_number\":\"Order Number\",\"amount\":\"Payment Ammount\",\"currency\":\"Site Currency\"}', 1, 1, NULL, '2021-03-14 23:18:40'),
(220, 'REFUND_MONEY', 'Member Refund Money', 'Member Refund Money', '<div>Booking Number&nbsp;&nbsp;{{order_number}}&nbsp;Payment of&nbsp;{{amount}} {{currency}}&nbsp; <span>Your Money Refund&nbsp; Please Check Your Dashboard.</span></div><div><span><br></span></div><div><span style=\"font-weight: bolder;\">Details of Booking:<br></span></div><div><br></div><div>Budget :&nbsp; {{amount}} {{currency}}</div><div><font>Order Number : {{order_number}}</font></div><div><br></div><div>Thank You</div><div><br></div><div><br></div>', '{{order_number}} {{amount}} {{currency}}', '{\"order_number\":\"Order Number\",\"amount\":\"Payment Ammount\",\"currency\":\"Site Currency\"}', 1, 1, NULL, '2021-04-11 22:50:48'),
(221, 'BOOKING_DATE_EXPIRED', 'Booking Date Expired', 'Booking Date Expired', '<div>Your Booking Expired&nbsp; Booking Number&nbsp;{{order_number}}&nbsp;is via&nbsp; {{amount}}&nbsp;<span>{{currency}}</span><span>&nbsp;</span>.</div><div><b><br></b></div><div><b>Details of your Deposit :<br></b></div><div><br></div><div>Amount : {{currency}}</div></font></div><div><font>Booking Number: {{order_number}}</font></div><div><br></div><div><br></div><div><br><br><br></div>', '{{order_number}} {{amount}} {{currency}}', '{\"order_number\":\"Order Number\",\"amount\":\"Payment Ammount\",\"currency\":\"Site Currency\"}', 1, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `employments`
--

CREATE TABLE `employments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `company` varchar(70) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(70) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `designation` varchar(70) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `status` tinyint(4) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `extensions`
--

CREATE TABLE `extensions` (
  `id` int(10) UNSIGNED NOT NULL,
  `act` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `script` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shortcode` text COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'object',
  `support` text COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'help section',
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `deleted_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `extensions`
--

INSERT INTO `extensions` (`id`, `act`, `name`, `description`, `image`, `script`, `shortcode`, `support`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'tawk-chat', 'Tawk.to', 'Key location is shown bellow', 'tawky_big.png', '<script>\r\n                        var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();\r\n                        (function(){\r\n                        var s1=document.createElement(\"script\"),s0=document.getElementsByTagName(\"script\")[0];\r\n                        s1.async=true;\r\n                        s1.src=\"https://embed.tawk.to/{{app_key}}\";\r\n                        s1.charset=\"UTF-8\";\r\n                        s1.setAttribute(\"crossorigin\",\"*\");\r\n                        s0.parentNode.insertBefore(s1,s0);\r\n                        })();\r\n                    </script>', '{\"app_key\":{\"title\":\"App Key\",\"value\":\"#####\"}}', 'twak.png', 0, NULL, '2019-10-18 23:16:05', '2021-04-10 02:39:14'),
(2, 'google-recaptcha2', 'Google Recaptcha 2', 'Key location is shown bellow', 'recaptcha3.png', '\r\n<script src=\"https://www.google.com/recaptcha/api.js\"></script>\r\n<div class=\"g-recaptcha\" data-sitekey=\"{{sitekey}}\" data-callback=\"verifyCaptcha\"></div>\r\n<div id=\"g-recaptcha-error\"></div>', '{\"sitekey\":{\"title\":\"Site Key\",\"value\":\"####\"}}', 'recaptcha.png', 0, NULL, '2019-10-18 23:16:05', '2021-04-10 02:39:07'),
(3, 'custom-captcha', 'Custom Captcha', 'Just Put Any Random String', 'customcaptcha.png', NULL, '{\"random_key\":{\"title\":\"Random String\",\"value\":\"SecureString\"}}', 'na', 0, NULL, '2019-10-18 23:16:05', '2021-04-10 02:38:33'),
(4, 'google-analytics', 'Google Analytics', 'Key location is shown bellow', 'google-analytics.png', '<script async src=\"https://www.googletagmanager.com/gtag/js?id={{app_key}}\"></script>\r\n                <script>\r\n                  window.dataLayer = window.dataLayer || [];\r\n                  function gtag(){dataLayer.push(arguments);}\r\n                  gtag(\"js\", new Date());\r\n                \r\n                  gtag(\"config\", \"{{app_key}}\");\r\n                </script>', '{\"app_key\":{\"title\":\"App Key\",\"value\":\"####\"}}', 'ganalytics.png', 0, NULL, NULL, '2021-04-10 02:38:53'),
(5, 'fb-comment', 'Facebook Comment ', 'Key location is shown bellow', 'Facebook.png', '<div id=\"fb-root\"></div><script async defer crossorigin=\"anonymous\" src=\"https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v4.0&appId={{app_key}}&autoLogAppEvents=1\"></script>', '{\"app_key\":{\"title\":\"App Key\",\"value\":\"####\"}}', 'fb_com.PNG', 0, NULL, NULL, '2021-04-10 02:38:45');

-- --------------------------------------------------------

--
-- Table structure for table `frontends`
--

CREATE TABLE `frontends` (
  `id` int(10) UNSIGNED NOT NULL,
  `data_keys` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `data_values` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `frontends`
--

INSERT INTO `frontends` (`id`, `data_keys`, `data_values`, `created_at`, `updated_at`) VALUES
(33, 'choose_us.content', '{\"heading\":\"Why Choose Us\",\"sub_heading\":\"JournalKhaoj is the platform where you can find the best journalist in the world and you can choose your preferable journalist here. Not only that, you can be a professional journalist by opening your own account as a journalist.\"}', '2020-11-23 03:53:23', '2020-12-23 16:41:41'),
(36, 'choose_us.element', '{\"id\":\"36\",\"choose_icon\":\"<i class=\\\"fas fa-history\\\"><\\/i>\",\"title\":\"Provide the truth\",\"description\":\"We drive positive cultural change by equipping and informing people with the truth.\"}', '2020-11-23 04:00:33', '2020-12-23 18:33:06'),
(37, 'choose_us.element', '{\"id\":\"37\",\"choose_icon\":\"<i class=\\\"fas fa-indent\\\"><\\/i>\",\"title\":\"Provide the latest news\",\"description\":\"We deliver the Top Latest World News and Headlines to the rest of the world.\"}', '2020-11-23 04:01:05', '2020-12-23 18:37:12'),
(38, 'choose_us.element', '{\"id\":\"38\",\"choose_icon\":\"<i class=\\\"fas fa-grip-vertical\\\"><\\/i>\",\"title\":\"We are Dedicated\",\"description\":\"We publish a range of original content including real news with leading reporters.\"}', '2020-11-23 04:01:18', '2020-12-23 18:28:36'),
(40, 'choose_us.element', '{\"id\":\"40\",\"choose_icon\":\"<i class=\\\"fas fa-hockey-puck\\\"><\\/i>\",\"title\":\"Provide knowledgeable support\",\"description\":\"We provide breaking news and information for major issues around the world.\"}', '2020-11-23 04:01:36', '2020-12-23 18:35:34'),
(41, 'choose_us.element', '{\"id\":\"41\",\"choose_icon\":\"<i class=\\\"fas fa-heartbeat\\\"><\\/i>\",\"title\":\"We are professional\",\"description\":\"We emphasize the people, the issues, the events, and the technologies that drive tomorrow\'s response.\"}', '2020-11-23 04:01:47', '2020-12-23 18:24:38'),
(42, 'client.content', '{\"heading\":\"Our Happy Client\",\"sub_heading\":\"Clients are always precious to us. We ensure the quality and best service to all the clients we work with.\"}', '2020-11-23 04:02:38', '2020-12-24 11:23:30'),
(43, 'hire.content', '{\"has_image\":\"1\",\"video_link\":\"https:\\/\\/www.youtube.com\\/embed\\/v7rSSy8CaYE\",\"heading\":\"Do you need a perfect journalist ???\",\"sub_heading\":\"Yes! you are in the right place. This is the world-famous journalist site. You can find your preferable journalist without any hassle. Just click the hire now button and get your journalist!\",\"background_image\":\"60475bd2c42111615289298.jpg\"}', '2020-11-23 04:05:12', '2021-03-09 05:28:19'),
(44, 'how_it_work.content', '{\"heading\":\"How It Work\",\"sub_heading\":\"Journal Khoj posts multiple news roundups, articles, published every day\"}', '2020-11-23 04:39:15', '2020-12-23 18:44:07'),
(45, 'how_it_work.element', '{\"id\":\"45\",\"work_icon\":\"<i class=\\\"fab fa-hire-a-helper\\\"><\\/i>\",\"title\":\"Book a Journalist\",\"description\":\"Choose your preferable journalist by just clicking their profile and book them.\"}', '2020-11-23 04:39:32', '2020-12-24 12:49:53'),
(46, 'how_it_work.element', '{\"id\":\"46\",\"work_icon\":\"<i class=\\\"fas fa-history\\\"><\\/i>\",\"title\":\"Find a Journalist\",\"description\":\"To get your preferable journalist just click the journalist button on the top.\"}', '2020-11-23 04:39:46', '2020-12-24 12:48:30'),
(47, 'how_it_work.element', '{\"id\":\"47\",\"work_icon\":\"<i class=\\\"far fa-grin-wink\\\"><\\/i>\",\"title\":\"Create an account\",\"description\":\"Select the Register button on the top right button and create an account.\"}', '2020-11-23 04:39:58', '2020-12-24 12:46:18'),
(48, 'journalist.content', '{\"heading\":\"Our Featured Journalist.\",\"sub_heading\":\"Let\'s meet with our journalist\"}', '2020-11-23 04:45:31', '2020-12-23 18:39:39'),
(52, 'testimonial.element', '{\"has_image\":\"1\",\"Name\":\"Ariss\",\"designation\":\"Today\'s World\",\"testimonial\":\"Today\'s World is the largest circulating daily English-language newspaper in America. Founded by Mohammed Ali on 14 January 1944, as America transitioned and restored parliamentary democracy,\",\"testimonial_image\":\"60475a6f7f16c1615288943.jpg\"}', '2020-11-23 05:15:36', '2021-03-09 05:22:23'),
(53, 'contact_us.content', '{\"has_image\":\"1\",\"title\":\"Contact. Get in touch\",\"short_details\":\"Leave us a message\",\"email_address\":\"demo@support.com\",\"contact_details\":\"Quick Support.\",\"contact_number\":\"+880124595546\",\"contact_address\":\"Medino, NY 10012, Kitaniya Road Nikamobo 45785 Libono USA\",\"latitude\":\"51.5074\",\"longitude\":\"0.1278\",\"background_image\":\"604d9ed1c703d1615699665.png\",\"image\":\"604d9ed9732821615699673.jpg\"}', '2020-11-23 05:57:16', '2021-03-13 23:27:53'),
(54, 'hero.content', '{\"has_image\":\"1\",\"heading\":\"Need a professional Journalist!\",\"sub_heading\":\"Search by your desire city name. And find the Journalist\",\"hero_background_image\":\"60474c6059d751615285344.jpg\"}', '2020-11-23 07:13:54', '2021-03-09 04:22:25'),
(55, 'seo.data', '{\"seo_image\":\"1\",\"keywords\":[\"admin\",\"blog\"],\"description\":\"Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit\",\"social_title\":\"JournLab\",\"social_description\":\"Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit\",\"image\":\"606990499cd901617530953.png\"}', '2020-11-28 22:37:42', '2021-04-12 00:11:44'),
(56, 'terms_conditions.content', '{\"Title\":\"By using paydesk you agree that you are bound by our terms and conditions.\",\"Description\":\"By using paydesk you agree that you are bound by our terms and conditions.\\n\\nThese Terms of Use constitute a legally binding agreement made between you, whether personally or on behalf of an entity (\\u201cyou\\u201d) and Paydesk, Ltd (\\\"Company\\\", \\u201cwe\\u201d, \\u201cus\\u201d, or \\u201cour\\u201d), concerning your access to and use of the https:\\/\\/paydesk.co\\/ website as well as any other media form, media channel, mobile website or mobile application related, linked, or otherwise connected thereto (collectively, the \\u201cSite\\u201d). The Site is an online database of media professionals. We use this database, acting on behalf of a corporate client, to find and assign media-related services. In order to help make the Site a secure environment, all users are required to accept and comply with these Terms of Use. You agree that by accessing the Site and, you have read, understood, and agree to be bound by all of these Terms of Use. IF YOU DO NOT AGREE WITH ALL OF THESE TERMS OF USE, THEN YOU ARE EXPRESSLY PROHIBITED FROM USING THE SITE AND YOU MUST DISCONTINUE USE IMMEDIATELY.\\n\\nSupplemental terms and conditions or documents that may be posted on the Site from time to time are hereby expressly incorporated herein by reference. We reserve the right, in our sole discretion, to make changes or modifications to these Terms of Use at any time and for any reason. We will alert you about any changes by updating the \\u201cLast updated\\u201d date of these Terms of Use, and you waive any right to receive specific notice of each such change. It is your responsibility to periodically review these Terms of Use to stay informed of updates. You will be subject to, and will be deemed to have been made aware of and to have accepted, the changes in any revised Terms of Use by your continued use of the Site after the date such revised Terms of Use are posted.\\n\\nThe information provided on the Site is not intended for distribution to or use by any person or entity in any jurisdiction or country where such distribution or use would be contrary to law or regulation or which would subject us to any registration requirement within such jurisdiction or country. Accordingly, those persons who choose to access the Site from other locations do so on their own initiative and are solely responsible for compliance with local laws, if and to the extent local laws are applicable.\\n\\nThe Site is not tailored to comply with industry-specific regulations (Health Insurance Portability and Accountability Act (HIPAA), Federal Information Security Management Act (FISMA), etc.), so if your interactions would be subjected to such laws, you may not use this Site. You may not use the Site in a way that would violate the Gramm-Leach-Bliley Act (GLBA).\\n\\nThe Site is intended for users who are at least 18 years old. Persons under the age of 18 are not permitted to use or register for the Site.\\n\\nHOW WE OPERATE\\nPaydesk is a commercial agent that helps corporate clients (\\u201dClients\\u201d) find appropriate journalists and\\/or other media professionals, in order to commission media\\/journalism-related tasks (\\u201cServices\\u201d)\\nMembership: To facilitate the search for journalists and\\/or other media professionals, we maintain a searchable database of journalists and other media professionals (\\u201cMembers\\u201d). In order to become a Member, you can register online, but will have to pass a vetting process and be assessed by our team. Membership is free.\\nHow we make money: Paydesk is a commercial agent acting on behalf of our Clients. Each Client has a rate that they are willing to pay for a specific Service, and when a Client books a Service from a Member through paydesk, we are acting as an agent on behalf of the client. The Member is paid the rate that the Client sets, and we charge the Client a commission over and above the rate.\\nPayment: We pay Members once per month, at the beginning of the month, for all work they undertook and was confirmed by the Client in the previous month. Some exceptions apply for small amounts, or where the member has deliberately requested not to be paid. We also guarantee payment to the Member for all jobs booked and confirmed by a Client on paydesk.\\n\\n\\nUSER REPRESENTATIONS\\nBy using the Site, you represent and warrant that:(1) all registration information you submit will be true, accurate, current, and complete; (2) you will maintain the accuracy of such information and promptly update such registration information as necessary; (3) you have the legal capacity and you agree to comply with these Terms of Use; (4) you are not a minor in the jurisdiction in which you reside; (5) you will not access the Site through automated or non-human means, whether through a bot, script or otherwise; (6) you will not use the Site for any illegal or unauthorized purpose; and (7) your use of the Site will not violate any applicable law or regulation.\\n\\nIf you provide any information that is untrue, inaccurate, not current, or incomplete, we have the right to suspend or terminate your account and refuse any and all current or future use of the Site (or any portion thereof).\\n\\nYou may not use the Site for any illegal or unauthorized purpose nor may you violate any laws. Postings of any unauthorized products or content may result in immediate termination of your account and a lifetime ban from use of the Site.\\n\\nWe are a service provider and make no representations as to the adequacy, accuracy or legality of any of the information contained on the Site displayed or offered through the Site. You understand and agree that the content of the Site does not contain or constitute representations to be reasonably relied upon, and you agree to hold us harmless from any errors, omissions, or misrepresentations contained within the Site\\u2019s content. We do not endorse or recommend any Marketplace Offerings and the Site is provided for informational and advertising purposes only.\\n\\nUSER REGISTRATION\\nYou are required to register with the Site in order to be added to our database of journalists and other media professionals. You agree to keep your password confidential and will be responsible for all use of your account and password. We reserve the right to remove, reclaim, or change a username you select if we determine, in our sole discretion, that such username is inappropriate, obscene, or otherwise objectionable.\\n\\nINTELLECTUAL PROPERTY RIGHTS\\nUnless otherwise indicated, the Site are our proprietary property and all source code, databases, functionality, software, website designs, audio, video, text, photographs, and graphics on the Site (collectively, the \\u201cContent\\u201d) and the trademarks, service marks, and logos contained therein (the \\u201cMarks\\u201d) are owned or controlled by us or licensed to us, and are protected by copyright and trademark laws and various other intellectual property rights and unfair competition laws of the United Kingdom, international copyright laws, and international conventions. The Content and the Marks are provided on the Site \\u201cAS IS\\u201d for your information and personal use only. Except as expressly provided in these Terms of Use, no part of the Site or the Marketplace Offerings and no Content or Marks may be copied, reproduced, aggregated, republished, uploaded, posted, publicly displayed, encoded, translated, transmitted, distributed, sold, licensed, or otherwise exploited for any commercial purpose whatsoever, without our express prior written permission.\"}', '2020-11-30 00:56:49', '2020-12-24 12:53:48'),
(57, 'privacy_policy.content', '{\"Title\":\"By using paydesk you agree that you are bound by our terms and conditions.\",\"Description\":\"By using paydesk you agree that you are bound by our terms and conditions.\\r\\n\\r\\nThese Terms of Use constitute a legally binding agreement made between you, whether personally or on behalf of an entity (\\u201cyou\\u201d) and Paydesk, Ltd (\\\"Company\\\", \\u201cwe\\u201d, \\u201cus\\u201d, or \\u201cour\\u201d), concerning your access to and use of the https:\\/\\/paydesk.co\\/ website as well as any other media form, media channel, mobile website or mobile application related, linked, or otherwise connected thereto (collectively, the \\u201cSite\\u201d). The Site is an online database of media professionals. We use this database, acting on behalf of a corporate client, to find and assign media-related services. In order to help make the Site a secure environment, all users are required to accept and comply with these Terms of Use. You agree that by accessing the Site and, you have read, understood, and agree to be bound by all of these Terms of Use. IF YOU DO NOT AGREE WITH ALL OF THESE TERMS OF USE, THEN YOU ARE EXPRESSLY PROHIBITED FROM USING THE SITE AND YOU MUST DISCONTINUE USE IMMEDIATELY.\\r\\n\\r\\nSupplemental terms and conditions or documents that may be posted on the Site from time to time are hereby expressly incorporated herein by reference. We reserve the right, in our sole discretion, to make changes or modifications to these Terms of Use at any time and for any reason. We will alert you about any changes by updating the \\u201cLast updated\\u201d date of these Terms of Use, and you waive any right to receive specific notice of each such change. It is your responsibility to periodically review these Terms of Use to stay informed of updates. You will be subject to, and will be deemed to have been made aware of and to have accepted, the changes in any revised Terms of Use by your continued use of the Site after the date such revised Terms of Use are posted.\\r\\n\\r\\nThe information provided on the Site is not intended for distribution to or use by any person or entity in any jurisdiction or country where such distribution or use would be contrary to law or regulation or which would subject us to any registration requirement within such jurisdiction or country. Accordingly, those persons who choose to access the Site from other locations do so on their own initiative and are solely responsible for compliance with local laws, if and to the extent local laws are applicable.\\r\\n\\r\\nThe Site is not tailored to comply with industry-specific regulations (Health Insurance Portability and Accountability Act (HIPAA), Federal Information Security Management Act (FISMA), etc.), so if your interactions would be subjected to such laws, you may not use this Site. You may not use the Site in a way that would violate the Gramm-Leach-Bliley Act (GLBA).\\r\\n\\r\\nThe Site is intended for users who are at least 18 years old. Persons under the age of 18 are not permitted to use or register for the Site.\\r\\n\\r\\nHOW WE OPERATE\\r\\nPaydesk is a commercial agent that helps corporate clients (\\u201dClients\\u201d) find appropriate journalists and\\/or other media professionals, in order to commission media\\/journalism-related tasks (\\u201cServices\\u201d)\\r\\nMembership: To facilitate the search for journalists and\\/or other media professionals, we maintain a searchable database of journalists and other media professionals (\\u201cMembers\\u201d). In order to become a Member, you can register online, but will have to pass a vetting process and be assessed by our team. Membership is free.\\r\\nHow we make money: Paydesk is a commercial agent acting on behalf of our Clients. Each Client has a rate that they are willing to pay for a specific Service, and when a Client books a Service from a Member through paydesk, we are acting as an agent on behalf of the client. The Member is paid the rate that the Client sets, and we charge the Client a commission over and above the rate.\\r\\nPayment: We pay Members once per month, at the beginning of the month, for all work they undertook and was confirmed by the Client in the previous month. Some exceptions apply for small amounts, or where the member has deliberately requested not to be paid. We also guarantee payment to the Member for all jobs booked and confirmed by a Client on paydesk.\\r\\n\\r\\n\\r\\nUSER REPRESENTATIONS\\r\\nBy using the Site, you represent and warrant that:(1) all registration information you submit will be true, accurate, current, and complete; (2) you will maintain the accuracy of such information and promptly update such registration information as necessary; (3) you have the legal capacity and you agree to comply with these Terms of Use; (4) you are not a minor in the jurisdiction in which you reside; (5) you will not access the Site through automated or non-human means, whether through a bot, script or otherwise; (6) you will not use the Site for any illegal or unauthorized purpose; and (7) your use of the Site will not violate any applicable law or regulation.\\r\\n\\r\\nIf you provide any information that is untrue, inaccurate, not current, or incomplete, we have the right to suspend or terminate your account and refuse any and all current or future use of the Site (or any portion thereof).\\r\\n\\r\\nYou may not use the Site for any illegal or unauthorized purpose nor may you violate any laws. Postings of any unauthorized products or content may result in immediate termination of your account and a lifetime ban from use of the Site.\\r\\n\\r\\nWe are a service provider and make no representations as to the adequacy, accuracy or legality of any of the information contained on the Site displayed or offered through the Site. You understand and agree that the content of the Site does not contain or constitute representations to be reasonably relied upon, and you agree to hold us harmless from any errors, omissions, or misrepresentations contained within the Site\\u2019s content. We do not endorse or recommend any Marketplace Offerings and the Site is provided for informational and advertising purposes only.\\r\\n\\r\\nUSER REGISTRATION\\r\\nYou are required to register with the Site in order to be added to our database of journalists and other media professionals. You agree to keep your password confidential and will be responsible for all use of your account and password. We reserve the right to remove, reclaim, or change a username you select if we determine, in our sole discretion, that such username is inappropriate, obscene, or otherwise objectionable.\\r\\n\\r\\nINTELLECTUAL PROPERTY RIGHTS\\r\\nUnless otherwise indicated, the Site are our proprietary property and all source code, databases, functionality, software, website designs, audio, video, text, photographs, and graphics on the Site (collectively, the \\u201cContent\\u201d) and the trademarks, service marks, and logos contained therein (the \\u201cMarks\\u201d) are owned or controlled by us or licensed to us, and are protected by copyright and trademark laws and various other intellectual property rights and unfair competition laws of the United Kingdom, international copyright laws, and international conventions. The Content and the Marks are provided on the Site \\u201cAS IS\\u201d for your information and personal use only. Except as expressly provided in these Terms of Use, no part of the Site or the Marketplace Offerings and no Content or Marks may be copied, reproduced, aggregated, republished, uploaded, posted, publicly displayed, encoded, translated, transmitted, distributed, sold, licensed, or otherwise exploited for any commercial purpose whatsoever, without our express prior written permission.\\r\\n\\r\\nProvided that you are eligible to use the Site, you are granted a limited license to access and use the Site and to download or print a copy of any portion of the Content to which you have properly gained access solely for your personal, non-commercial use. We reserve all rights not expressly granted to you in and to the Site, the Content and the Marks.\\r\\n\\r\\nTHIRD PARTY WEBSITES\\r\\nThis Website may contain links to other websites which are not under the control of paydesk. paydesk does not endorse or otherwise accept responsibility for the availability, operation or content of any website linked to this Website (whether directly or indirectly).\\r\\n\\r\\nPROHIBITED ACTIVITIES\\r\\nYou may not access or use the Site for any purpose other than that for which we make the Site available. The Site may not be used in connection with any commercial endeavors except those that are specifically endorsed or approved by us.\\r\\nSystematically retrieve data or other content from the Site to create or compile, directly or indirectly, a collection, compilation, database, or directory without written permission from us.\\r\\nMake any unauthorized use of the Site, including collecting usernames and\\/or email addresses of users by electronic or other means for the purpose of sending unsolicited email, or creating user accounts by automated means or under false pretenses.\\r\\nUse the Site to advertise or offer to sell goods and services.\\r\\nCircumvent, disable, or otherwise interfere with security-related features of the Site, including features that prevent or restrict the use or copying of any Content or enforce limitations on the use of the Site and\\/or the Content contained therein.\\r\\nEngage in unauthorized framing of or linking to the Site.\\r\\nTrick, defraud, or mislead us and other users, especially in any attempt to learn sensitive account information such as user passwords.\\r\\nMake improper use of our support services or submit false reports of abuse or misconduct.\\r\\nEngage in any automated use of the system, such as using scripts to send comments or messages, or using any data mining, robots, or similar data gathering and extraction tools.\\r\\nInterfere with, disrupt, or create an undue burden on the Site or the networks or services connected to the Site.\\r\\nAttempt to impersonate another user or person or use the username of another user.\\r\\nSell or otherwise transfer your profile.\\r\\nUse any information obtained from the Site in order to harass, abuse, or harm another person.\\r\\nUpload or transmit (or attempt to upload or to transmit) viruses, Trojan horses, or other material, including excessive use of capital letters and spamming (continuous posting of repetitive text), that interferes with any party\\u2019s uninterrupted use and enjoyment of the Site or modifies, impairs, disrupts, alters, or interferes with the use, features, functions, operation, or maintenance of the Marketplace Offerings.\\r\\nUpload or transmit (or attempt to upload or to transmit) any material that acts as a passive or active information collection or transmission mechanism, including without limitation, clear graphics interchange formats (\\u201cgifs\\u201d), 1\\u00d71 pixels, web bugs, cookies, or other similar devices (sometimes referred to as \\u201cspyware\\u201d or \\u201cpassive collection mechanisms\\u201d or \\u201cpcms\\u201d).\\r\\nExcept as may be the result of standard search engine or Internet browser usage, use, launch, develop, or distribute any automated system, including without limitation, any spider, robot, cheat utility, scraper, or offline reader that accesses the Site, or using or launching any unauthorized script or other software.\\r\\nDisparage, tarnish, or otherwise harm, in our opinion, us and\\/or the Site.\\r\\nUse the Site in a manner inconsistent with any applicable laws or regulations.\\r\\n\\r\\n\\r\\nLiability\\r\\nAs a commercial agent, Paydesk will make best endevours to find a suitable Member to perform the Service requested by the client, however, paydesk accepts no liability in relation to the accuracy or suitability of the Content which is provided by paydesk to Client on an \\\"as is\\\" basis. paydesk hereby excludes, to the fullest extent permitted by law, all implied warranties and conditions, whether implied by statute, common law or otherwise including, without limitation, the implied warranties of fitness for purpose and satisfactory quality. Each Broadcaster agrees that it shall use its best endeavours to ensure that the Content is accurate, lawful and error-free prior to use and acknowledges that it shall be solely liable for any damages or loss incurred or claims arising in relation to the Content.\\r\\n\\r\\nDue to the nature of the world wide web, paydesk makes no warranty that the availability of the Website or Content will be uninterrupted and paydesk accepts no liability for any inability to access, upload to, or download from the Website.\\r\\n\\r\\npaydesk shall not be liable for any loss of profits, business, opportunity, goodwill, data or any other consequential, indirect or special loss whether arising in contract, tort (including negligence), or otherwise. paydesk\\u2019s liability to any user whether arising in contract, tort (including negligence), or otherwise shall be limited to \\u00a3200.00 provided that nothing in these Terms and Conditions shall be deemed to exclude or limit paydesk\\u2019s liability for personal death or injury arising from its negligence.\\r\\n\\r\\nINDEMNIFICATION\\r\\nYou agree to defend, indemnify, and hold us harmless, including our subsidiaries, affiliates, and all of our respective officers, agents, partners, and employees, from and against any loss, damage, liability, claim, or demand, including reasonable attorneys\\u2019 fees and expenses, made by any third party due to or arising out of: (1) use of the Site; (2) breach of these Terms of Use; (3) any breach of your representations and warranties set forth in these Terms of Use; (4) your violation of the rights of a third party, including but not limited to intellectual property rights; or (5) any overt harmful act toward any other user of the Site with whom you connected via the Site. Notwithstanding the foregoing, we reserve the right, at your expense, to assume the exclusive defense and control of any matter for which you are required to indemnify us, and you agree to cooperate, at your expense, with our defense of such claims. We will use reasonable efforts to notify you of any such claim, action, or proceeding which is subject to this indemnification upon becoming aware of it.\\r\\n\\r\\nGeneral\\r\\nThese Terms and Conditions contain the entire agreement between paydesk and you in relation to your use of the Website. These Terms and Conditions shall be governed by English law and the English courts shall have exclusive jurisdiction over any disputes arising in relation to this Website.\\r\\n\\r\\nData Protection\\r\\nPaydesk will hold and use any personal data provided by you via this Website or in connection with this service for the sole purpose of administering your use of this Website and your account with paydesk. paydesk will include an acknowledgement of authorship of Content on this Website but will not otherwise disclose, sell or transfer any of your personal details to any third party (unless required to do so by law or any law enforcement body). paydesk will from time to time send you information in relation to products or services in which you might be interested. If you would prefer not to receive this information contact us at support@paydesk.co\"}', '2020-11-30 00:57:04', '2020-12-07 00:08:57'),
(58, 'testimonial.element', '{\"has_image\":\"1\",\"Name\":\"John\",\"designation\":\"The Daily Star\",\"testimonial\":\"The Daily Star is the largest circulating daily English-language newspaper in Bangladesh. Founded by Syed Mohammed Ali on 14 January 1991, as Bangladesh transitioned and restored parliamentary democracy.\",\"testimonial_image\":\"60475a7658ac81615288950.jpg\"}', '2020-12-04 22:45:58', '2021-03-09 05:22:30'),
(59, 'testimonial.element', '{\"has_image\":\"1\",\"Name\":\"Mino Vai\",\"designation\":\"Current world\",\"testimonial\":\"World news headlines. 9News brings you the latest world news headlines from around the globe. Latest World news news, comment and analysis from the Guardian, the world\'s leading liberal voice.\",\"testimonial_image\":\"60475a84769961615288964.jpg\"}', '2020-12-04 22:46:23', '2021-03-09 05:22:44'),
(60, 'testimonial.element', '{\"has_image\":\"1\",\"Name\":\"Boss\",\"designation\":\"The Live news\",\"testimonial\":\"A newspaper is a periodical publication containing written information about current events and is often typed in black ink with a white or gray background.\",\"testimonial_image\":\"60475a9d897221615288989.jpg\"}', '2020-12-04 22:46:39', '2021-03-09 05:23:09'),
(62, 'testimonial.element', '{\"has_image\":\"1\",\"Name\":\"Md Data\",\"designation\":\"The Daily Star\",\"testimonial\":\"The Daily Star is the largest circulating daily English-language newspaper in Bangladesh. Founded by Syed Mohammed Ali on 14 January 1991, as Bangladesh transitioned and restored parliamentary democracy.\",\"testimonial_image\":\"60475aa7553dc1615288999.jpg\"}', '2020-12-04 22:52:11', '2021-03-09 05:23:19'),
(63, 'how_it_work_journalist.element', '{\"id\":\"63\",\"work_icon\":\"<i class=\\\"fas fa-gift\\\"><\\/i>\",\"title\":\"Get your review\",\"description\":\"Post your stories and get the review from the clients.\"}', '2020-12-07 04:45:16', '2020-12-24 16:34:16'),
(64, 'how_it_work_journalist.element', '{\"id\":\"64\",\"work_icon\":\"<i class=\\\"far fa-heart\\\"><\\/i>\",\"title\":\"Get your profession as journalist\",\"description\":\"Confirming your account, you will get your Dashboard.\"}', '2020-12-07 04:45:51', '2020-12-24 14:52:04'),
(65, 'how_it_work_journalist.element', '{\"id\":\"65\",\"work_icon\":\"<i class=\\\"lab la-creative-commons-nc-eu\\\"><\\/i>\",\"title\":\"Create an account\",\"description\":\"Select the Register button on the top right button and create an account as Journalist\"}', '2020-12-07 04:47:18', '2020-12-24 13:29:06'),
(66, 'registration_type.content', '{\"has_image\":\"1\",\"member_heading\":\"I want to hire a journalist\",\"member_sub_heading\":\"Find, hire and pay a reputable journalist\",\"member_btn_name\":\"Create Account\",\"journalist_heading\":\"I am a journalist\",\"journalist_sub_heading\":\"Create a beautiful profile to promote your work\",\"journalist_btn_heading\":\"Create Account\",\"member_background_image\":\"607177f00ac3a1618049008.jpg\",\"journalist_background_image\":\"60476a3c0831e1615292988.jpg\"}', '2020-12-10 00:20:13', '2021-04-10 04:03:29'),
(69, 'login.content', '{\"heading\":\"Welcome\"}', '2020-12-10 00:39:57', '2021-04-11 06:16:19'),
(70, 'choose_us.element', '{\"id\":\"70\",\"choose_icon\":\"<i class=\\\"fas fa-globe-americas\\\"><\\/i>\",\"title\":\"We are global\",\"description\":\"We provide insights into global issues and we published that news worldwide.\"}', '2020-12-23 17:47:28', '2020-12-23 18:31:35'),
(71, 'about.content', '{\"has_image\":\"1\",\"text\":\"Years Experience\",\"image_number\":\"12\",\"heading\":\"We Are The Largest Journalist Platform In The World\",\"description\":\"<p style=\\\"margin-top:15px;margin-right:0px;margin-left:0px;color:rgb(111,111,111);font-family:Roboto, sans-serif;font-size:16px;\\\"><span style=\\\"color:rgb(111,111,111);font-family:Monda, sans-serif;background-color:rgb(249,249,250);\\\">JournalKhoj is a company that drives positive cultural change by equipping and informing people with the truth. It is committed to its founding principles, which are honesty, integrity, and meticulous work ethic. Stories that matter, contributed by you: JournalKhoj covers worldwide news in one frame.<\\/span><br \\/><\\/p><div class=\\\"row mt-4 mb-none-40\\\" style=\\\"color:rgb(111,111,111);font-family:Roboto, sans-serif;\\\"><div class=\\\"col-lg-12 mb-30\\\" style=\\\"width:680px;\\\"><div class=\\\"about-item\\\"><div class=\\\"about-item__icon\\\" style=\\\"font-size:52px;color:rgb(0,215,147);width:52px;line-height:1;\\\"><span class=\\\"las la-medal\\\"><\\/span><\\/div><div class=\\\"about-item__content\\\" style=\\\"padding-left:20px;\\\"><h4 class=\\\"title\\\" style=\\\"margin-bottom:15px;font-weight:600;line-height:1.3;font-size:22px;font-family:Monda, sans-serif;color:rgb(54,54,54);background-color:rgb(249,249,250);\\\">The most relevant research news are here....<\\/h4><p style=\\\"margin-right:0px;margin-left:0px;\\\"><span style=\\\"color:rgb(111,111,111);font-family:Monda, sans-serif;font-size:16px;background-color:rgb(249,249,250);\\\">You can find all news here. like: worldwide news, politics, pop culture, gender, human rights, LGBT issues, music, arts, and world events.<\\/span><br \\/><\\/p><\\/div><\\/div><\\/div><div class=\\\"col-lg-12 mb-30\\\" style=\\\"width:680px;\\\"><div class=\\\"about-item\\\"><div class=\\\"about-item__icon\\\" style=\\\"font-size:52px;color:rgb(0,215,147);width:52px;line-height:1;\\\"><span class=\\\"las la-headset\\\"><\\/span><\\/div><div class=\\\"about-item__content\\\" style=\\\"padding-left:20px;\\\"><h4 class=\\\"title\\\" style=\\\"margin-bottom:15px;font-weight:600;line-height:1.3;font-size:22px;font-family:Monda, sans-serif;color:rgb(54,54,54);background-color:rgb(249,249,250);\\\">The truth with JournalKhoj....<\\/h4><p style=\\\"margin-right:0px;margin-left:0px;\\\"><span style=\\\"color:rgb(111,111,111);font-family:Monda, sans-serif;font-size:16px;background-color:rgb(249,249,250);\\\">We always believe in the truth and JournalKhoj gives us that truth.<\\/span><br \\/><\\/p><\\/div><\\/div><\\/div><\\/div>\",\"about_image\":\"60475120852801615286560.jpg\"}', '2021-03-09 04:42:40', '2021-04-11 22:08:48'),
(72, 'counter.element', '{\"title\":\"Total Journalist\",\"digits\":\"12k\",\"icon\":\"<i class=\\\"las la-user-friends\\\"><\\/i>\"}', '2021-03-09 04:59:54', '2021-03-09 04:59:54'),
(73, 'counter.element', '{\"title\":\"Happy Clients\",\"digits\":\"10k\",\"icon\":\"<i class=\\\"las la-user-lock\\\"><\\/i>\"}', '2021-03-09 05:00:27', '2021-03-09 05:00:27'),
(74, 'counter.element', '{\"title\":\"Total Job Done\",\"digits\":\"5k\",\"icon\":\"<i class=\\\"las la-check\\\"><\\/i>\"}', '2021-03-09 05:00:53', '2021-03-09 05:00:53'),
(75, 'counter.element', '{\"title\":\"Total Award\",\"digits\":\"45k\",\"icon\":\"<i class=\\\"las la-award\\\"><\\/i>\"}', '2021-03-09 05:01:13', '2021-03-09 05:01:13'),
(76, 'testimonial.content', '{\"has_image\":\"1\",\"background_image\":\"604759bf29a001615288767.jpg\"}', '2021-03-09 05:19:27', '2021-03-09 05:19:27'),
(77, 'breadcrumb.content', '{\"has_image\":\"1\",\"image\":\"60476052c04d81615290450.jpg\"}', '2021-03-09 05:47:30', '2021-03-09 05:47:31'),
(78, 'footer.element', '{\"menu_name\":\"Privacy\",\"description\":\"<span class=\\\"aCOpRe\\\">\\u00a0 \\u00a0lipsum as it is sometimes known, is dummy \\r\\ntext used in laying out print, graphic or web designs. The passage is \\r\\nattributed to an unknown typesetter in the 15th century who is thought \\r\\nto have scrambled parts of Cicero\'s De Finibus Bonorum et Malorum for \\r\\nuse in a type specimen book.<\\/span><span class=\\\"aCOpRe\\\"> lipsum as it is sometimes known, is dummy \\r\\ntext used in laying out print, graphic or web designs. The passage is \\r\\nattributed to an unknown typesetter in the 15th century who is thought \\r\\nto have scrambled parts of\\u00a0<\\/span><div><span class=\\\"aCOpRe\\\"><br \\/><\\/span><\\/div><div><span class=\\\"aCOpRe\\\"><span style=\\\"font-size:1rem;\\\">lipsum as it is sometimes known, is dummy \\r\\ntext used in laying out print, graphic or web designs. The passage is \\r\\nattributed to an unknown typesetter in the 15th century who is thought \\r\\nto have scrambled parts of Cicero\'s De Finibus Bonorum et Malorum for \\r\\nuse in a type specimen book.<\\/span><\\/span><span style=\\\"font-size:1rem;\\\">lipsum as it is sometimes known, is dummy \\r\\ntext used in laying out print, graphic or web designs. The passage is \\r\\nattributed to an unknown typesetter in the 15th century who is thought \\r\\nto have scrambled parts of Cicero\'s De Finibus Bonorum et Malorum for \\r\\nuse in a type specimen book.<\\/span><span style=\\\"font-size:1rem;\\\">lipsum as it is sometimes known, is dummy \\r\\ntext used in laying out print, graphic or web designs. The passage is \\r\\nattributed to an unkno<\\/span><\\/div><div><span style=\\\"font-size:1rem;\\\"><br \\/><\\/span><\\/div><div><span style=\\\"font-size:1rem;\\\">lipsum as it is sometimes known, is dummy \\r\\ntext used in laying out print, graphic or web designs. The passage is \\r\\nattributed to an unknown typesetter in the 15th century who is thought \\r\\nto have scrambled parts of Cicero\'s De Finibus Bonorum et Malorum for \\r\\nuse in a type specimen book.<\\/span><span style=\\\"font-size:1rem;\\\">lipsum as it is sometimes known, is dummy \\r\\ntext used in laying out print, graphic or web designs. The passage is \\r\\nattributed to an unknown typesetter in the 15th century who is thought \\r\\nto have scrambled parts of Cicero\'s De Finibus Bonorum et Malorum for \\r\\nuse in a type specimen book.<\\/span><span style=\\\"font-size:1rem;\\\">lipsum as it is sometimes known, is dummy \\r\\ntext used in laying out print, graphic or web designs. The passage is \\r\\nattributed to an unknown typesetter in the 15th century who is thought \\r\\nto have scrambled parts of Cicero\'s De Finibus Bonorum et Malorum for \\r\\nuse in a type specimen book.<\\/span><span style=\\\"font-size:1rem;\\\">wn typesetter in the 15th century who is thought \\r\\nto have scrambled parts of Cicero\'s De Finibus Bonorum et Malorum for \\r\\nuse in a type specimen book.<\\/span><span style=\\\"font-size:1rem;\\\">Cicero\'s De Finibus Bonorum et Malorum for \\r\\nuse in a type specimen book.<\\/span><\\/div>\"}', '2021-03-09 05:48:40', '2021-03-09 05:49:46'),
(79, 'footer.element', '{\"menu_name\":\"Terms\",\"description\":\"<span class=\\\"aCOpRe\\\">\\u00a0lipsum as it is sometimes known, is dummy \\r\\ntext used in laying out print, graphic or web designs. The passage is \\r\\nattributed to an unknown typesetter in the 15th century who is thought \\r\\nto have scrambled parts of Cicero\'s De Finibus Bonorum et Malorum for \\r\\nuse in a type specimen book.<\\/span><span class=\\\"aCOpRe\\\"> lipsum as it is sometimes known, is dummy \\r\\ntext used in laying out print, graphic or web designs. The passage is \\r\\nattributed to an unknown typesetter in the 15th century who is thought \\r\\nto have scrambled parts of Cicero\'s De Finibus Bonorum et Malorum for \\r\\nuse in a type specimen book.<\\/span><span class=\\\"aCOpRe\\\"> lipsum as it is sometimes known, is dummy \\r\\ntext used in laying out print, graphic or w<\\/span><div><span class=\\\"aCOpRe\\\"><br \\/><\\/span><\\/div><div><span class=\\\"aCOpRe\\\"><br \\/><\\/span><\\/div><div><span class=\\\"aCOpRe\\\">eb designs. The passage is \\r\\nattributed to an unknown typesetter in the 15th century who is thought \\r\\nto have scrambled parts of Cicero\'s De Finibus Bonorum et Malorum for \\r\\nuse in a type specimen book.<\\/span><span class=\\\"aCOpRe\\\"> lipsum as it is sometimes known, is dummy \\r\\ntext used in laying out print, graphic or web designs. The passage is \\r\\nattributed to an unknown typesetter in the 15th century who is thought \\r\\nto have scrambled parts of Cicero\'s De Finibus Bonorum et Malorum for \\r\\nuse in a type specimen book.<\\/span><span class=\\\"aCOpRe\\\"> lipsum as it is sometimes known, is dummy \\r\\ntext used in laying out print, graphic or web designs. The passage is \\r\\nattributed to an unknown typesetter in the 15th century who is thought \\r\\nto have scrambled parts of Cicero\'s De Finibus Bonorum et Malorum for \\r\\nuse in a type specimen book.<\\/span><span style=\\\"font-size:1rem;\\\">lipsum as it is sometimes known, is dummy \\r\\ntext used in laying out print, graphic or web de<\\/span><\\/div><div><span style=\\\"font-size:1rem;\\\"><br \\/><\\/span><\\/div><div><span style=\\\"font-size:1rem;\\\">signs. The passage is \\r\\nattributed to an unknown typesetter in the 15th century who is thought \\r\\nto have scrambled parts of Cicero\'s De Finibus Bonorum et Malorum for \\r\\nuse in a type specimen book.<\\/span><span style=\\\"font-size:1rem;\\\">lipsum as it is sometimes known, is dummy \\r\\ntext used in laying out print, graphic or web designs. The passage is \\r\\nattributed to an unknown typesetter in the 15th century who is thought \\r\\nto have scrambled parts of Cicero\'s De Finibus Bonorum et Malorum for \\r\\nuse in a type specimen book.<\\/span><span style=\\\"font-size:1rem;\\\">lipsum as it is sometimes known, is dummy \\r\\ntext used in laying out print, graphic or web designs. The passage is \\r\\nattributed to an unknown typesetter in the 15th century who is thought \\r\\nto have scrambled parts of Cicero\'s De Finibus Bonorum et Malorum for \\r\\nuse in a type specimen book.<\\/span><span style=\\\"font-size:1rem;\\\">lipsum as it is sometimes known, is dummy \\r\\ntext used in laying out print, graphic or web designs. The passage is \\r\\nattributed to an unknown typesetter in the 15th century who is thought \\r\\nto have scrambled parts of Cicero\'s De Finibus Bonorum et Malorum for \\r\\nuse in a type specimen book.<\\/span><br \\/><\\/div>\"}', '2021-03-09 05:52:03', '2021-03-09 05:52:03'),
(80, 'social_icon.element', '{\"icon\":\"<i class=\\\"lab la-facebook-f\\\"><\\/i>\",\"url\":\"https:\\/\\/www.facebook.com\\/\"}', '2021-03-09 05:53:16', '2021-03-09 05:54:39'),
(81, 'social_icon.element', '{\"icon\":\"<i class=\\\"lab la-twitter\\\"><\\/i>\",\"url\":\"twitter.com\"}', '2021-03-09 05:53:27', '2021-03-09 05:53:27'),
(82, 'social_icon.element', '{\"icon\":\"<i class=\\\"lab la-linkedin-in\\\"><\\/i>\",\"url\":\"linkedin.com\"}', '2021-03-09 05:53:38', '2021-03-09 05:53:38'),
(83, 'social_icon.element', '{\"icon\":\"<i class=\\\"fab fa-youtube\\\"><\\/i>\",\"url\":\"youtube.com\"}', '2021-03-09 05:53:54', '2021-03-09 05:53:54'),
(84, 'footer.element', '{\"menu_name\":\"Insurance\",\"description\":\"<span class=\\\"aCOpRe\\\">\\u00a0lipsum as it is sometimes known, is dummy \\r\\ntext used in laying out print, graphic or web designs. The passage is \\r\\nattributed to an unknown typesetter in the 15th century who is thought \\r\\nto have scrambled parts of Cicero\'s De Finibus Bonorum et Malorum for \\r\\nuse in a type specimen book.<\\/span><span class=\\\"aCOpRe\\\"> lipsum as it is sometimes known, is dummy \\r\\ntext used in laying out print, graphic or web designs. The passage is \\r\\nattributed to an unknown typesetter in the 15th century who is thought \\r\\nto\\u00a0<\\/span><div><span class=\\\"aCOpRe\\\"><br \\/><\\/span><\\/div><div><span class=\\\"aCOpRe\\\">have scrambled parts of Cicero\'s De Finibus Bonorum et Malorum for \\r\\nuse in a type specimen book.<\\/span><span class=\\\"aCOpRe\\\"> lipsum as it is sometimes known, is dummy \\r\\ntext used in laying out print, graphic or web designs. The passage is \\r\\nattributed to an unknown typesetter in the 15th century who is thought \\r\\nto have scrambled parts of Cicero\'s De Finibus Bonorum et Malorum for \\r\\nuse in a type specimen book.<\\/span><span class=\\\"aCOpRe\\\"> lipsum as it is sometimes known, is dummy \\r\\ntext used in laying out print, graphic or web designs. The passage is \\r\\nattributed to an unknown typesetter in the 15th century who is thought \\r\\nto have scrambled parts of Cicero\'s De Finibus Bonorum et Malorum for \\r\\nuse in a type specimen book.<\\/span><span style=\\\"font-size:1rem;\\\">li<\\/span><\\/div><div><span style=\\\"font-size:1rem;\\\"><br \\/><\\/span><\\/div><div><span style=\\\"font-size:1rem;\\\">psum as it is sometimes known, is dummy \\r\\ntext used in laying out print, graphic or web designs. The passage is \\r\\nattributed to an unknown typesetter in the 15th century who is thought \\r\\nto have scrambled parts of Cicero\'s De Finibus Bonorum et Malorum for \\r\\nuse in a type specimen book.<\\/span><span style=\\\"font-size:1rem;\\\">lipsum as it is sometimes known, is dummy \\r\\ntext used in laying out print, graphic or web designs. The passage is \\r\\nattributed to an unknown typesetter in the 15th century who is thought \\r\\nto have scrambled parts of Cicero\'s De Finibus Bonorum et Malorum for \\r\\nuse in a type specimen book.<\\/span><span style=\\\"font-size:1rem;\\\">lipsum as it is sometimes known, is dummy \\r\\ntext used in laying out print, graphic or web designs. The passage is \\r\\nattributed to an unknown typesetter in the 15th century who is thought \\r\\nto have scrambled parts of Cicero\'s De Finibus Bonorum et Malorum for \\r\\nuse in a type specimen book.<\\/span><br \\/><\\/div>\"}', '2021-03-09 05:55:37', '2021-03-09 05:55:37'),
(85, 'footer.element', '{\"menu_name\":\"Directory\",\"description\":\"<span class=\\\"aCOpRe\\\">\\u00a0lipsum as it is sometimes known, is dummy \\r\\ntext used in laying out print, graphic or web designs. The passage is \\r\\nattributed to an unknown typesetter in the 15th century who is thought \\r\\nto have scrambled parts of Cicero\'s De Finibus Bonorum et Malorum for \\r\\nuse in a type specimen book.<\\/span><span class=\\\"aCOpRe\\\"> lipsum as it is sometimes known, is dummy \\r\\ntext used in laying out print, graphic or web designs. The passage is \\r\\nattributed to an unknown typesetter in the 15th century who is thought\\u00a0<\\/span><div><span class=\\\"aCOpRe\\\"><br \\/><\\/span><\\/div><div><span class=\\\"aCOpRe\\\">\\u00a0to have scrambled parts of Cicero\'s De Finibus Bonorum et Malorum for \\r\\nuse in a type specimen book.<\\/span><span class=\\\"aCOpRe\\\"> lipsum as it is sometimes known, is dummy \\r\\ntext used in laying out print, graphic or web designs. The passage is \\r\\nattributed to an unknown typesetter in the 15th century who is thought \\r\\nto have scrambled parts of Cicero\'s De Finibus Bonorum et Malorum for \\r\\nuse in a type specimen book.<\\/span><span class=\\\"aCOpRe\\\"> lipsum as it is sometimes known, is dummy \\r\\ntext used in laying out print, graphic or web designs. The passage is \\r\\nattributed to an unknown typesetter in the 15th century who is thought \\r\\nto have scrambled parts of Cicero\'s De Finibus Bonorum et Malorum for \\r\\nuse in a type specimen book.<\\/span><br \\/><\\/div>\"}', '2021-03-09 05:56:22', '2021-03-09 05:56:22'),
(86, 'journalist_register.content', '{\"heading\":\"Create a beautiful profile to promote your work\"}', '2021-03-09 22:34:50', '2021-04-11 06:16:36'),
(87, 'member_register.content', '{\"heading\":\"Find, hire and pay a reputable journalist\"}', '2021-03-09 22:35:02', '2021-04-11 06:16:10'),
(89, 'client.element', '{\"has_image\":\"1\",\"client_image\":\"604e022dbfc2b1615725101.png\"}', '2021-03-14 06:31:41', '2021-03-14 06:31:41'),
(90, 'client.element', '{\"has_image\":\"1\",\"client_image\":\"604e028c43f801615725196.png\"}', '2021-03-14 06:33:16', '2021-03-14 06:33:16'),
(91, 'client.element', '{\"has_image\":\"1\",\"client_image\":\"604e0291d33741615725201.png\"}', '2021-03-14 06:33:21', '2021-03-14 06:33:21'),
(92, 'client.element', '{\"has_image\":\"1\",\"client_image\":\"604e0297d48a31615725207.png\"}', '2021-03-14 06:33:27', '2021-03-14 06:33:27'),
(93, 'client.element', '{\"has_image\":\"1\",\"client_image\":\"604e029db6bc21615725213.png\"}', '2021-03-14 06:33:33', '2021-03-14 06:33:33'),
(94, 'client.element', '{\"has_image\":\"1\",\"client_image\":\"604e02a40b6e71615725220.png\"}', '2021-03-14 06:33:40', '2021-03-14 06:33:40'),
(95, 'client.element', '{\"has_image\":\"1\",\"client_image\":\"604e03550c6241615725397.png\"}', '2021-03-14 06:36:37', '2021-03-14 06:36:37');

-- --------------------------------------------------------

--
-- Table structure for table `gateways`
--

CREATE TABLE `gateways` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` int(11) DEFAULT NULL,
  `alias` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'NULL',
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `parameters` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `supported_currencies` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `crypto` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0: fiat currency, 1: crypto currency',
  `extra` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `input_form` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gateways`
--

INSERT INTO `gateways` (`id`, `code`, `alias`, `image`, `name`, `status`, `parameters`, `supported_currencies`, `crypto`, `extra`, `description`, `input_form`, `created_at`, `updated_at`) VALUES
(1, 101, 'paypal', '5f6f1bd8678601601117144.jpg', 'Paypal', 1, '{\"paypal_email\":{\"title\":\"PayPal Email\",\"global\":true,\"value\":\"sb-zlbi7986064@personal.example.com\"}}', '{\"AUD\":\"AUD\",\"BRL\":\"BRL\",\"CAD\":\"CAD\",\"CZK\":\"CZK\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"HKD\":\"HKD\",\"HUF\":\"HUF\",\"INR\":\"INR\",\"ILS\":\"ILS\",\"JPY\":\"JPY\",\"MYR\":\"MYR\",\"MXN\":\"MXN\",\"TWD\":\"TWD\",\"NZD\":\"NZD\",\"NOK\":\"NOK\",\"PHP\":\"PHP\",\"PLN\":\"PLN\",\"GBP\":\"GBP\",\"RUB\":\"RUB\",\"SGD\":\"SGD\",\"SEK\":\"SEK\",\"CHF\":\"CHF\",\"THB\":\"THB\",\"USD\":\"$\"}', 0, NULL, NULL, NULL, '2019-09-14 13:14:22', '2021-01-17 03:02:44'),
(2, 102, 'perfect_money', '5f6f1d2a742211601117482.jpg', 'Perfect Money', 1, '{\"passphrase\":{\"title\":\"ALTERNATE PASSPHRASE\",\"global\":true,\"value\":\"6451561651551\"},\"wallet_id\":{\"title\":\"PM Wallet\",\"global\":false,\"value\":\"\"}}', '{\"USD\":\"$\",\"EUR\":\"\\u20ac\"}', 0, NULL, NULL, NULL, '2019-09-14 13:14:22', '2020-12-28 01:26:46'),
(3, 103, 'stripe', '5f6f1d4bc69e71601117515.jpg', 'Stripe Hosted', 1, '{\"secret_key\":{\"title\":\"Secret Key\",\"global\":true,\"value\":\"sk_test_51HuxFUHyGzEKoTKAfIosswAQduMOGU4q4elcNr8OE6LoBZcp2MHKalOW835wjRiF6fxVTc7RmBgatKfAt1Qq0heb00rUaCOd2T\"},\"publishable_key\":{\"title\":\"PUBLISHABLE KEY\",\"global\":true,\"value\":\"pk_test_51HuxFUHyGzEKoTKAueAuF9BrMDA5boMcpJLLt0vu4q3QdPX5isaGudKNe6OyVjZP1UugpYd6JA7i7TczRWsbutaP004YmBiSp5\"}}', '{\"USD\":\"USD\",\"AUD\":\"AUD\",\"BRL\":\"BRL\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"HKD\":\"HKD\",\"INR\":\"INR\",\"JPY\":\"JPY\",\"MXN\":\"MXN\",\"MYR\":\"MYR\",\"NOK\":\"NOK\",\"NZD\":\"NZD\",\"PLN\":\"PLN\",\"SEK\":\"SEK\",\"SGD\":\"SGD\"}', 0, NULL, NULL, NULL, '2019-09-14 13:14:22', '2020-12-28 01:26:49'),
(4, 104, 'skrill', '5f6f1d41257181601117505.jpg', 'Skrill', 1, '{\"pay_to_email\":{\"title\":\"Skrill Email\",\"global\":true,\"value\":\"merchant@skrill.com\"},\"secret_key\":{\"title\":\"Secret Key\",\"global\":true,\"value\":\"---\"}}', '{\"AED\":\"AED\",\"AUD\":\"AUD\",\"BGN\":\"BGN\",\"BHD\":\"BHD\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"CZK\":\"CZK\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"HKD\":\"HKD\",\"HRK\":\"HRK\",\"HUF\":\"HUF\",\"ILS\":\"ILS\",\"INR\":\"INR\",\"ISK\":\"ISK\",\"JOD\":\"JOD\",\"JPY\":\"JPY\",\"KRW\":\"KRW\",\"KWD\":\"KWD\",\"MAD\":\"MAD\",\"MYR\":\"MYR\",\"NOK\":\"NOK\",\"NZD\":\"NZD\",\"OMR\":\"OMR\",\"PLN\":\"PLN\",\"QAR\":\"QAR\",\"RON\":\"RON\",\"RSD\":\"RSD\",\"SAR\":\"SAR\",\"SEK\":\"SEK\",\"SGD\":\"SGD\",\"THB\":\"THB\",\"TND\":\"TND\",\"TRY\":\"TRY\",\"TWD\":\"TWD\",\"USD\":\"USD\",\"ZAR\":\"ZAR\",\"COP\":\"COP\"}', 0, NULL, NULL, NULL, '2019-09-14 13:14:22', '2020-12-28 01:26:52'),
(5, 105, 'paytm', '5f6f1d1d3ec731601117469.jpg', 'PayTM', 1, '{\"MID\":{\"title\":\"Merchant ID\",\"global\":true,\"value\":\"DIY12386817555501617\"},\"merchant_key\":{\"title\":\"Merchant Key\",\"global\":true,\"value\":\"bKMfNxPPf_QdZppa\"},\"WEBSITE\":{\"title\":\"Paytm Website\",\"global\":true,\"value\":\"DIYtestingweb\"},\"INDUSTRY_TYPE_ID\":{\"title\":\"Industry Type\",\"global\":true,\"value\":\"Retail\"},\"CHANNEL_ID\":{\"title\":\"CHANNEL ID\",\"global\":true,\"value\":\"WEB\"},\"transaction_url\":{\"title\":\"Transaction URL\",\"global\":true,\"value\":\"https:\\/\\/pguat.paytm.com\\/oltp-web\\/processTransaction\"},\"transaction_status_url\":{\"title\":\"Transaction STATUS URL\",\"global\":true,\"value\":\"https:\\/\\/pguat.paytm.com\\/paytmchecksum\\/paytmCallback.jsp\"}}', '{\"AUD\":\"AUD\",\"ARS\":\"ARS\",\"BDT\":\"BDT\",\"BRL\":\"BRL\",\"BGN\":\"BGN\",\"CAD\":\"CAD\",\"CLP\":\"CLP\",\"CNY\":\"CNY\",\"COP\":\"COP\",\"HRK\":\"HRK\",\"CZK\":\"CZK\",\"DKK\":\"DKK\",\"EGP\":\"EGP\",\"EUR\":\"EUR\",\"GEL\":\"GEL\",\"GHS\":\"GHS\",\"HKD\":\"HKD\",\"HUF\":\"HUF\",\"INR\":\"INR\",\"IDR\":\"IDR\",\"ILS\":\"ILS\",\"JPY\":\"JPY\",\"KES\":\"KES\",\"MYR\":\"MYR\",\"MXN\":\"MXN\",\"MAD\":\"MAD\",\"NPR\":\"NPR\",\"NZD\":\"NZD\",\"NGN\":\"NGN\",\"NOK\":\"NOK\",\"PKR\":\"PKR\",\"PEN\":\"PEN\",\"PHP\":\"PHP\",\"PLN\":\"PLN\",\"RON\":\"RON\",\"RUB\":\"RUB\",\"SGD\":\"SGD\",\"ZAR\":\"ZAR\",\"KRW\":\"KRW\",\"LKR\":\"LKR\",\"SEK\":\"SEK\",\"CHF\":\"CHF\",\"THB\":\"THB\",\"TRY\":\"TRY\",\"UGX\":\"UGX\",\"UAH\":\"UAH\",\"AED\":\"AED\",\"GBP\":\"GBP\",\"USD\":\"USD\",\"VND\":\"VND\",\"XOF\":\"XOF\"}', 0, NULL, NULL, NULL, '2019-09-14 13:14:22', '2020-12-28 01:26:54'),
(6, 106, 'payeer', '5f6f1bc61518b1601117126.jpg', 'Payeer', 1, '{\"merchant_id\":{\"title\":\"Merchant ID\",\"global\":true,\"value\":\"866989763\"},\"secret_key\":{\"title\":\"Secret key\",\"global\":true,\"value\":\"7575\"}}', '{\"USD\":\"USD\",\"EUR\":\"EUR\",\"RUB\":\"RUB\"}', 0, '{\"status\":{\"title\": \"Status URL\",\"value\":\"ipn.payeer\"}}', NULL, NULL, '2019-09-14 13:14:22', '2020-12-28 01:26:58'),
(7, 107, 'paystack', '5f7096563dfb71601214038.jpg', 'PayStack', 1, '{\"public_key\":{\"title\":\"Public key\",\"global\":true,\"value\":\"pk_test_3c9c87f51b13c15d99eb367ca6ebc52cc9eb1f33\"},\"secret_key\":{\"title\":\"Secret key\",\"global\":true,\"value\":\"sk_test_2a3f97a146ab5694801f993b60fcb81cd7254f12\"}}', '{\"USD\":\"USD\",\"NGN\":\"NGN\"}', 0, '{\"callback\":{\"title\": \"Callback URL\",\"value\":\"ipn.paystack\"},\"webhook\":{\"title\": \"Webhook URL\",\"value\":\"ipn.paystack\"}}\r\n', NULL, NULL, '2019-09-14 13:14:22', '2020-12-28 01:25:38'),
(8, 108, 'voguepay', '5f6f1d5951a111601117529.jpg', 'VoguePay', 1, '{\"merchant_id\":{\"title\":\"MERCHANT ID\",\"global\":true,\"value\":\"demo\"}}', '{\"USD\":\"USD\",\"GBP\":\"GBP\",\"EUR\":\"EUR\",\"GHS\":\"GHS\",\"NGN\":\"NGN\",\"ZAR\":\"ZAR\"}', 0, NULL, NULL, NULL, '2019-09-14 13:14:22', '2020-09-26 04:52:09'),
(9, 109, 'flutterwave', '5f6f1b9e4bb961601117086.jpg', 'Flutterwave', 1, '{\"public_key\":{\"title\":\"Public Key\",\"global\":true,\"value\":\"demo_publisher_key\"},\"secret_key\":{\"title\":\"Secret Key\",\"global\":true,\"value\":\"demo_secret_key\"},\"encryption_key\":{\"title\":\"Encryption Key\",\"global\":true,\"value\":\"demo_encryption_key\"}}', '{\"BIF\":\"BIF\",\"CAD\":\"CAD\",\"CDF\":\"CDF\",\"CVE\":\"CVE\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"GHS\":\"GHS\",\"GMD\":\"GMD\",\"GNF\":\"GNF\",\"KES\":\"KES\",\"LRD\":\"LRD\",\"MWK\":\"MWK\",\"MZN\":\"MZN\",\"NGN\":\"NGN\",\"RWF\":\"RWF\",\"SLL\":\"SLL\",\"STD\":\"STD\",\"TZS\":\"TZS\",\"UGX\":\"UGX\",\"USD\":\"USD\",\"XAF\":\"XAF\",\"XOF\":\"XOF\",\"ZMK\":\"ZMK\",\"ZMW\":\"ZMW\",\"ZWD\":\"ZWD\"}', 0, NULL, NULL, NULL, '2019-09-14 13:14:22', '2021-01-04 03:29:50'),
(10, 110, 'razorpay', '5f6f1d3672dd61601117494.jpg', 'RazorPay', 1, '{\"key_id\":{\"title\":\"Key Id\",\"global\":true,\"value\":\"rzp_test_kiOtejPbRZU90E\"},\"key_secret\":{\"title\":\"Key Secret \",\"global\":true,\"value\":\"osRDebzEqbsE1kbyQJ4y0re7\"}}', '{\"INR\":\"INR\"}', 0, NULL, NULL, NULL, '2019-09-14 13:14:22', '2020-09-26 04:51:34'),
(11, 111, 'stripe_js', '5f7096a31ed9a1601214115.jpg', 'Stripe Storefront', 1, '{\"secret_key\":{\"title\":\"Secret Key\",\"global\":true,\"value\":\"sk_test_51HuxFUHyGzEKoTKAfIosswAQduMOGU4q4elcNr8OE6LoBZcp2MHKalOW835wjRiF6fxVTc7RmBgatKfAt1Qq0heb00rUaCOd2T\"},\"publishable_key\":{\"title\":\"PUBLISHABLE KEY\",\"global\":true,\"value\":\"pk_test_51HuxFUHyGzEKoTKAueAuF9BrMDA5boMcpJLLt0vu4q3QdPX5isaGudKNe6OyVjZP1UugpYd6JA7i7TczRWsbutaP004YmBiSp5\"}}', '{\"USD\":\"USD\",\"AUD\":\"AUD\",\"BRL\":\"BRL\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"HKD\":\"HKD\",\"INR\":\"INR\",\"JPY\":\"JPY\",\"MXN\":\"MXN\",\"MYR\":\"MYR\",\"NOK\":\"NOK\",\"NZD\":\"NZD\",\"PLN\":\"PLN\",\"SEK\":\"SEK\",\"SGD\":\"SGD\"}', 0, NULL, NULL, NULL, '2019-09-14 13:14:22', '2020-12-05 03:56:20'),
(12, 112, 'instamojo', '5f6f1babbdbb31601117099.jpg', 'Instamojo', 1, '{\"api_key\":{\"title\":\"API KEY\",\"global\":true,\"value\":\"test_2241633c3bc44a3de84a3b33969\"},\"auth_token\":{\"title\":\"Auth Token\",\"global\":true,\"value\":\"test_279f083f7bebefd35217feef22d\"},\"salt\":{\"title\":\"Salt\",\"global\":true,\"value\":\"19d38908eeff4f58b2ddda2c6d86ca25\"}}', '{\"INR\":\"INR\"}', 0, NULL, NULL, NULL, '2019-09-14 13:14:22', '2020-09-26 04:44:59'),
(13, 501, 'blockchain', '5f6f1b2b20c6f1601116971.jpg', 'Blockchain', 1, '{\"api_key\":{\"title\":\"API Key\",\"global\":true,\"value\":\"55529946-05ca-48ff-8710-f279d86b1cc5\"},\"xpub_code\":{\"title\":\"XPUB CODE\",\"global\":true,\"value\":\"xpub6CKQ3xxWyBoFAF83izZCSFUorptEU9AF8TezhtWeMU5oefjX3sFSBw62Lr9iHXPkXmDQJJiHZeTRtD9Vzt8grAYRhvbz4nEvBu3QKELVzFK\"}}', '{\"BTC\":\"BTC\"}', 1, NULL, NULL, NULL, '2019-09-14 13:14:22', '2021-01-31 06:55:45'),
(14, 502, 'blockio', '5f6f19432bedf1601116483.jpg', 'Block.io', 1, '{\"api_key\":{\"title\":\"API Key\",\"global\":false,\"value\":\"1658-8015-2e5e-9afb\"},\"api_pin\":{\"title\":\"API PIN\",\"global\":true,\"value\":\"covidvai2020\"}}', '{\"BTC\":\"BTC\",\"LTC\":\"LTC\",\"DOGE\":\"DOGE\"}', 1, '{\"cron\":{\"title\": \"Cron URL\",\"value\":\"ipn.blockio\"}}', NULL, NULL, '2019-09-14 13:14:22', '2021-01-03 23:19:59'),
(15, 503, 'coinpayments', '5f6f1b6c02ecd1601117036.jpg', 'CoinPayments', 1, '{\"public_key\":{\"title\":\"Public Key\",\"global\":true,\"value\":\"7638eebaf4061b7f7cdfceb14046318bbdabf7e2f64944773d6550bd59f70274\"},\"private_key\":{\"title\":\"Private Key\",\"global\":true,\"value\":\"Cb6dee7af8Eb9E0D4123543E690dA3673294147A5Dc8e7a621B5d484a3803207\"},\"merchant_id\":{\"title\":\"Merchant ID\",\"global\":true,\"value\":\"93a1e014c4ad60a7980b4a7239673cb4\"}}', '{\"BTC\":\"Bitcoin\",\"BTC.LN\":\"Bitcoin (Lightning Network)\",\"LTC\":\"Litecoin\",\"CPS\":\"CPS Coin\",\"VLX\":\"Velas\",\"APL\":\"Apollo\",\"AYA\":\"Aryacoin\",\"BAD\":\"Badcoin\",\"BCD\":\"Bitcoin Diamond\",\"BCH\":\"Bitcoin Cash\",\"BCN\":\"Bytecoin\",\"BEAM\":\"BEAM\",\"BITB\":\"Bean Cash\",\"BLK\":\"BlackCoin\",\"BSV\":\"Bitcoin SV\",\"BTAD\":\"Bitcoin Adult\",\"BTG\":\"Bitcoin Gold\",\"BTT\":\"BitTorrent\",\"CLOAK\":\"CloakCoin\",\"CLUB\":\"ClubCoin\",\"CRW\":\"Crown\",\"CRYP\":\"CrypticCoin\",\"CRYT\":\"CryTrExCoin\",\"CURE\":\"CureCoin\",\"DASH\":\"DASH\",\"DCR\":\"Decred\",\"DEV\":\"DeviantCoin\",\"DGB\":\"DigiByte\",\"DOGE\":\"Dogecoin\",\"EBST\":\"eBoost\",\"EOS\":\"EOS\",\"ETC\":\"Ether Classic\",\"ETH\":\"Ethereum\",\"ETN\":\"Electroneum\",\"EUNO\":\"EUNO\",\"EXP\":\"EXP\",\"Expanse\":\"Expanse\",\"FLASH\":\"FLASH\",\"GAME\":\"GameCredits\",\"GLC\":\"Goldcoin\",\"GRS\":\"Groestlcoin\",\"KMD\":\"Komodo\",\"LOKI\":\"LOKI\",\"LSK\":\"LSK\",\"MAID\":\"MaidSafeCoin\",\"MUE\":\"MonetaryUnit\",\"NAV\":\"NAV Coin\",\"NEO\":\"NEO\",\"NMC\":\"Namecoin\",\"NVST\":\"NVO Token\",\"NXT\":\"NXT\",\"OMNI\":\"OMNI\",\"PINK\":\"PinkCoin\",\"PIVX\":\"PIVX\",\"POT\":\"PotCoin\",\"PPC\":\"Peercoin\",\"PROC\":\"ProCurrency\",\"PURA\":\"PURA\",\"QTUM\":\"QTUM\",\"RES\":\"Resistance\",\"RVN\":\"Ravencoin\",\"RVR\":\"RevolutionVR\",\"SBD\":\"Steem Dollars\",\"SMART\":\"SmartCash\",\"SOXAX\":\"SOXAX\",\"STEEM\":\"STEEM\",\"STRAT\":\"STRAT\",\"SYS\":\"Syscoin\",\"TPAY\":\"TokenPay\",\"TRIGGERS\":\"Triggers\",\"TRX\":\" TRON\",\"UBQ\":\"Ubiq\",\"UNIT\":\"UniversalCurrency\",\"USDT\":\"Tether USD (Omni Layer)\",\"VTC\":\"Vertcoin\",\"WAVES\":\"Waves\",\"XCP\":\"Counterparty\",\"XEM\":\"NEM\",\"XMR\":\"Monero\",\"XSN\":\"Stakenet\",\"XSR\":\"SucreCoin\",\"XVG\":\"VERGE\",\"XZC\":\"ZCoin\",\"ZEC\":\"ZCash\",\"ZEN\":\"Horizen\"}', 1, NULL, NULL, NULL, '2019-09-14 13:14:22', '2020-09-26 04:43:56'),
(16, 504, 'coinpayments_fiat', '5f6f1b94e9b2b1601117076.jpg', 'CoinPayments Fiat', 1, '{\"merchant_id\":{\"title\":\"Merchant ID\",\"global\":true,\"value\":\"93a1e014c4ad60a7980b4a7239673cb4\"}}', '{\"USD\":\"USD\",\"AUD\":\"AUD\",\"BRL\":\"BRL\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"CLP\":\"CLP\",\"CNY\":\"CNY\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"HKD\":\"HKD\",\"INR\":\"INR\",\"ISK\":\"ISK\",\"JPY\":\"JPY\",\"KRW\":\"KRW\",\"NZD\":\"NZD\",\"PLN\":\"PLN\",\"RUB\":\"RUB\",\"SEK\":\"SEK\",\"SGD\":\"SGD\",\"THB\":\"THB\",\"TWD\":\"TWD\"}', 0, NULL, NULL, NULL, '2019-09-14 13:14:22', '2020-10-22 03:17:29'),
(17, 505, 'coingate', '5f6f1b5fe18ee1601117023.jpg', 'Coingate', 1, '{\"api_key\":{\"title\":\"API Key\",\"global\":true,\"value\":\"Ba1VgPx6d437xLXGKCBkmwVCEw5kHzRJ6thbGo-N\"}}', '{\"USD\":\"USD\",\"EUR\":\"EUR\"}', 0, NULL, NULL, NULL, '2019-09-14 13:14:22', '2020-09-26 04:43:44'),
(18, 506, 'coinbase_commerce', '5f6f1b4c774af1601117004.jpg', 'Coinbase Commerce', 1, '{\"api_key\":{\"title\":\"API Key\",\"global\":true,\"value\":\"c47cd7df-d8e8-424b-a20a\"},\"secret\":{\"title\":\"Webhook Shared Secret\",\"global\":true,\"value\":\"55871878-2c32-4f64-ab66\"}}', '{\"USD\":\"USD\",\"EUR\":\"EUR\",\"JPY\":\"JPY\",\"GBP\":\"GBP\",\"AUD\":\"AUD\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"CNY\":\"CNY\",\"SEK\":\"SEK\",\"NZD\":\"NZD\",\"MXN\":\"MXN\",\"SGD\":\"SGD\",\"HKD\":\"HKD\",\"NOK\":\"NOK\",\"KRW\":\"KRW\",\"TRY\":\"TRY\",\"RUB\":\"RUB\",\"INR\":\"INR\",\"BRL\":\"BRL\",\"ZAR\":\"ZAR\",\"AED\":\"AED\",\"AFN\":\"AFN\",\"ALL\":\"ALL\",\"AMD\":\"AMD\",\"ANG\":\"ANG\",\"AOA\":\"AOA\",\"ARS\":\"ARS\",\"AWG\":\"AWG\",\"AZN\":\"AZN\",\"BAM\":\"BAM\",\"BBD\":\"BBD\",\"BDT\":\"BDT\",\"BGN\":\"BGN\",\"BHD\":\"BHD\",\"BIF\":\"BIF\",\"BMD\":\"BMD\",\"BND\":\"BND\",\"BOB\":\"BOB\",\"BSD\":\"BSD\",\"BTN\":\"BTN\",\"BWP\":\"BWP\",\"BYN\":\"BYN\",\"BZD\":\"BZD\",\"CDF\":\"CDF\",\"CLF\":\"CLF\",\"CLP\":\"CLP\",\"COP\":\"COP\",\"CRC\":\"CRC\",\"CUC\":\"CUC\",\"CUP\":\"CUP\",\"CVE\":\"CVE\",\"CZK\":\"CZK\",\"DJF\":\"DJF\",\"DKK\":\"DKK\",\"DOP\":\"DOP\",\"DZD\":\"DZD\",\"EGP\":\"EGP\",\"ERN\":\"ERN\",\"ETB\":\"ETB\",\"FJD\":\"FJD\",\"FKP\":\"FKP\",\"GEL\":\"GEL\",\"GGP\":\"GGP\",\"GHS\":\"GHS\",\"GIP\":\"GIP\",\"GMD\":\"GMD\",\"GNF\":\"GNF\",\"GTQ\":\"GTQ\",\"GYD\":\"GYD\",\"HNL\":\"HNL\",\"HRK\":\"HRK\",\"HTG\":\"HTG\",\"HUF\":\"HUF\",\"IDR\":\"IDR\",\"ILS\":\"ILS\",\"IMP\":\"IMP\",\"IQD\":\"IQD\",\"IRR\":\"IRR\",\"ISK\":\"ISK\",\"JEP\":\"JEP\",\"JMD\":\"JMD\",\"JOD\":\"JOD\",\"KES\":\"KES\",\"KGS\":\"KGS\",\"KHR\":\"KHR\",\"KMF\":\"KMF\",\"KPW\":\"KPW\",\"KWD\":\"KWD\",\"KYD\":\"KYD\",\"KZT\":\"KZT\",\"LAK\":\"LAK\",\"LBP\":\"LBP\",\"LKR\":\"LKR\",\"LRD\":\"LRD\",\"LSL\":\"LSL\",\"LYD\":\"LYD\",\"MAD\":\"MAD\",\"MDL\":\"MDL\",\"MGA\":\"MGA\",\"MKD\":\"MKD\",\"MMK\":\"MMK\",\"MNT\":\"MNT\",\"MOP\":\"MOP\",\"MRO\":\"MRO\",\"MUR\":\"MUR\",\"MVR\":\"MVR\",\"MWK\":\"MWK\",\"MYR\":\"MYR\",\"MZN\":\"MZN\",\"NAD\":\"NAD\",\"NGN\":\"NGN\",\"NIO\":\"NIO\",\"NPR\":\"NPR\",\"OMR\":\"OMR\",\"PAB\":\"PAB\",\"PEN\":\"PEN\",\"PGK\":\"PGK\",\"PHP\":\"PHP\",\"PKR\":\"PKR\",\"PLN\":\"PLN\",\"PYG\":\"PYG\",\"QAR\":\"QAR\",\"RON\":\"RON\",\"RSD\":\"RSD\",\"RWF\":\"RWF\",\"SAR\":\"SAR\",\"SBD\":\"SBD\",\"SCR\":\"SCR\",\"SDG\":\"SDG\",\"SHP\":\"SHP\",\"SLL\":\"SLL\",\"SOS\":\"SOS\",\"SRD\":\"SRD\",\"SSP\":\"SSP\",\"STD\":\"STD\",\"SVC\":\"SVC\",\"SYP\":\"SYP\",\"SZL\":\"SZL\",\"THB\":\"THB\",\"TJS\":\"TJS\",\"TMT\":\"TMT\",\"TND\":\"TND\",\"TOP\":\"TOP\",\"TTD\":\"TTD\",\"TWD\":\"TWD\",\"TZS\":\"TZS\",\"UAH\":\"UAH\",\"UGX\":\"UGX\",\"UYU\":\"UYU\",\"UZS\":\"UZS\",\"VEF\":\"VEF\",\"VND\":\"VND\",\"VUV\":\"VUV\",\"WST\":\"WST\",\"XAF\":\"XAF\",\"XAG\":\"XAG\",\"XAU\":\"XAU\",\"XCD\":\"XCD\",\"XDR\":\"XDR\",\"XOF\":\"XOF\",\"XPD\":\"XPD\",\"XPF\":\"XPF\",\"XPT\":\"XPT\",\"YER\":\"YER\",\"ZMW\":\"ZMW\",\"ZWL\":\"ZWL\"}\r\n\r\n', 0, '{\"endpoint\":{\"title\": \"Webhook Endpoint\",\"value\":\"ipn.coinbase_commerce\"}}', NULL, NULL, '2019-09-14 13:14:22', '2020-09-26 04:43:24'),
(24, 113, 'paypal_sdk', '5f6f1bec255c61601117164.jpg', 'Paypal Express', 1, '{\"clientId\":{\"title\":\"Paypal Client ID\",\"global\":true,\"value\":\"Ae0-tixtSV7DvLwIh3Bmu7JvHrjh5EfGdXr_cEklKAVjjezRZ747BxKILiBdzlKKyp-W8W_T7CKH1Ken\"},\"clientSecret\":{\"title\":\"Client Secret\",\"global\":true,\"value\":\"EOhbvHZgFNO21soQJT1L9Q00M3rK6PIEsdiTgXRBt2gtGtxwRer5JvKnVUGNU5oE63fFnjnYY7hq3HBA\"}}', '{\"AUD\":\"AUD\",\"BRL\":\"BRL\",\"CAD\":\"CAD\",\"CZK\":\"CZK\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"HKD\":\"HKD\",\"HUF\":\"HUF\",\"INR\":\"INR\",\"ILS\":\"ILS\",\"JPY\":\"JPY\",\"MYR\":\"MYR\",\"MXN\":\"MXN\",\"TWD\":\"TWD\",\"NZD\":\"NZD\",\"NOK\":\"NOK\",\"PHP\":\"PHP\",\"PLN\":\"PLN\",\"GBP\":\"GBP\",\"RUB\":\"RUB\",\"SGD\":\"SGD\",\"SEK\":\"SEK\",\"CHF\":\"CHF\",\"THB\":\"THB\",\"USD\":\"$\"}', 0, NULL, NULL, NULL, '2019-09-14 13:14:22', '2020-10-31 23:50:27'),
(25, 114, 'stripe_v3', '5f709684736321601214084.jpg', 'Stripe Checkout', 1, '{\"secret_key\":{\"title\":\"Secret Key\",\"global\":true,\"value\":\"sk_test_51HuxFUHyGzEKoTKAfIosswAQduMOGU4q4elcNr8OE6LoBZcp2MHKalOW835wjRiF6fxVTc7RmBgatKfAt1Qq0heb00rUaCOd2T\"},\"publishable_key\":{\"title\":\"PUBLISHABLE KEY\",\"global\":true,\"value\":\"pk_test_51HuxFUHyGzEKoTKAueAuF9BrMDA5boMcpJLLt0vu4q3QdPX5isaGudKNe6OyVjZP1UugpYd6JA7i7TczRWsbutaP004YmBiSp5\"},\"end_point\":{\"title\":\"End Point Secret\",\"global\":true,\"value\":\"w5555\"}}', '{\"USD\":\"USD\",\"AUD\":\"AUD\",\"BRL\":\"BRL\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"HKD\":\"HKD\",\"INR\":\"INR\",\"JPY\":\"JPY\",\"MXN\":\"MXN\",\"MYR\":\"MYR\",\"NOK\":\"NOK\",\"NZD\":\"NZD\",\"PLN\":\"PLN\",\"SEK\":\"SEK\",\"SGD\":\"SGD\"}', 0, '{\"webhook\":{\"title\": \"Webhook Endpoint\",\"value\":\"ipn.stripe_v3\"}}', NULL, NULL, '2019-09-14 13:14:22', '2020-12-05 03:56:14'),
(27, 115, 'mollie', '5f6f1bb765ab11601117111.jpg', 'Mollie', 1, '{\"mollie_email\":{\"title\":\"Mollie Email \",\"global\":true,\"value\":\"ronniearea@gmail.com\"},\"api_key\":{\"title\":\"API KEY\",\"global\":true,\"value\":\"test_cucfwKTWfft9s337qsVfn5CC4vNkrn\"}}', '{\"AED\":\"AED\",\"AUD\":\"AUD\",\"BGN\":\"BGN\",\"BRL\":\"BRL\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"CZK\":\"CZK\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"HKD\":\"HKD\",\"HRK\":\"HRK\",\"HUF\":\"HUF\",\"ILS\":\"ILS\",\"ISK\":\"ISK\",\"JPY\":\"JPY\",\"MXN\":\"MXN\",\"MYR\":\"MYR\",\"NOK\":\"NOK\",\"NZD\":\"NZD\",\"PHP\":\"PHP\",\"PLN\":\"PLN\",\"RON\":\"RON\",\"RUB\":\"RUB\",\"SEK\":\"SEK\",\"SGD\":\"SGD\",\"THB\":\"THB\",\"TWD\":\"TWD\",\"USD\":\"USD\",\"ZAR\":\"ZAR\"}', 0, NULL, NULL, NULL, '2019-09-14 13:14:22', '2020-09-26 04:45:11'),
(30, 116, 'cashmaal', '5f9a8b62bb4dd1603963746.png', 'Cashmaal', 1, '{\"web_id\":{\"title\":\"Web Id\",\"global\":true,\"value\":\"3748\"},\"ipn_key\":{\"title\":\"IPN Key\",\"global\":true,\"value\":\"546254628759524554647987\"}}', '{\"PKR\":\"PKR\",\"USD\":\"USD\"}', 0, '{\"webhook\":{\"title\": \"IPN URL\",\"value\":\"ipn.cashmaal\"}}', NULL, NULL, NULL, '2020-10-29 03:29:06');

-- --------------------------------------------------------

--
-- Table structure for table `gateway_currencies`
--

CREATE TABLE `gateway_currencies` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `symbol` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `method_code` int(11) DEFAULT NULL,
  `gateway_alias` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `min_amount` decimal(18,8) NOT NULL,
  `max_amount` decimal(18,8) NOT NULL,
  `percent_charge` decimal(5,2) NOT NULL DEFAULT 0.00,
  `fixed_charge` decimal(18,8) NOT NULL DEFAULT 0.00000000,
  `rate` decimal(18,8) NOT NULL DEFAULT 0.00000000,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gateway_parameter` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `general_settings`
--

CREATE TABLE `general_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sitename` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cur_text` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'currency text',
  `cur_sym` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'currency symbol',
  `charge` double(18,8) DEFAULT NULL,
  `last_cron_run` datetime DEFAULT NULL,
  `email_from` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_template` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sms_api` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `base_color` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `secondary_color` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mail_config` text COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'email configuration',
  `ev` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'email verification, 0 - dont check, 1 - check',
  `en` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'email notification, 0 - dont send, 1 - send',
  `sv` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'sms verication, 0 - dont check, 1 - check',
  `sn` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'sms notification, 0 - dont send, 1 - send',
  `registration` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0: Off	, 1: On',
  `social_login` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'social login',
  `social_credential` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active_template` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sys_version` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `general_settings`
--

INSERT INTO `general_settings` (`id`, `sitename`, `cur_text`, `cur_sym`, `charge`, `last_cron_run`, `email_from`, `email_template`, `sms_api`, `base_color`, `secondary_color`, `mail_config`, `ev`, `en`, `sv`, `sn`, `registration`, `social_login`, `social_credential`, `active_template`, `sys_version`, `created_at`, `updated_at`) VALUES
(1, 'JournLab', 'USD', '$', 3.00000000, '2021-04-10 09:00:14', 'do-not-reply@viserlab.com', '<table style=\"color: rgb(0, 0, 0); font-family: &quot;Times New Roman&quot;; font-size: medium; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(0, 23, 54); text-decoration-style: initial; text-decoration-color: initial;\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" bgcolor=\"#001736\"><tbody><tr><td valign=\"top\" align=\"center\"><table class=\"mobile-shell\" width=\"650\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\"><tbody><tr><td class=\"td container\" style=\"width: 650px; min-width: 650px; font-size: 0pt; line-height: 0pt; margin: 0px; font-weight: normal; padding: 55px 0px;\"><div style=\"text-align: center;\"><img src=\"https://i.imgur.com/C9IS7Z1.png\" style=\"height: 240 !important;width: 338px;margin-bottom: 20px;\"></div><table style=\"width: 650px; margin: 0px auto;\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\"><tbody><tr><td style=\"padding-bottom: 10px;\"><table width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\"><tbody><tr><td class=\"tbrr p30-15\" style=\"padding: 60px 30px; border-radius: 26px 26px 0px 0px;\" bgcolor=\"#000036\"><table width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\"><tbody><tr><td style=\"color: rgb(255, 255, 255); font-family: Muli, Arial, sans-serif; font-size: 20px; line-height: 46px; padding-bottom: 25px; font-weight: bold;\">Hi {{name}} ,</td></tr><tr><td style=\"color: rgb(193, 205, 220); font-family: Muli, Arial, sans-serif; font-size: 20px; line-height: 30px; padding-bottom: 25px;\">{{message}}</td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table><table style=\"width: 650px; margin: 0px auto;\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\"><tbody><tr><td class=\"p30-15 bbrr\" style=\"padding: 50px 30px; border-radius: 0px 0px 26px 26px;\" bgcolor=\"#000036\"><table width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\"><tbody><tr><td class=\"text-footer1 pb10\" style=\"color: rgb(0, 153, 255); font-family: Muli, Arial, sans-serif; font-size: 18px; line-height: 30px; text-align: center; padding-bottom: 10px;\">© 2021 ViserLab. All Rights Reserved.</td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table>', 'https://api.infobip.com/api/v3/sendsms/plain?user=viserlab&password=26289099&sender=ViserLab&SMSText={{message}}&GSM={{number}}&type=longSMS', 'ff7300', '062c4e', '{\"name\":\"php\"}', 0, 1, 0, 0, 1, 0, '{\"google_client_id\":\"53929591142-l40gafo7efd9onfe6tj545sf9g7tv15t.apps.googleusercontent.com\",\"google_client_secret\":\"BRdB3np2IgYLiy4-bwMcmOwN\",\"fb_client_id\":\"277229062999748\",\"fb_client_secret\":\"1acfc850f73d1955d14b282938585122\"}', 'basic', NULL, NULL, '2021-04-12 00:38:05');

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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `text_align` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0: left to right text align, 1: right to left text align',
  `is_default` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0: not default language, 1: default language',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `name`, `code`, `icon`, `text_align`, `is_default`, `created_at`, `updated_at`) VALUES
(1, 'English', 'en', '5f15968db08911595250317.png', 0, 0, '2020-07-06 03:47:55', '2021-01-06 00:33:35'),
(4, 'bangla', 'bn', '5f1596a650cd11595250342.png', 0, 0, '2020-07-20 07:05:42', '2021-01-03 23:59:33'),
(5, 'Hindi', 'hn', NULL, 0, 0, '2020-12-29 02:20:07', '2020-12-29 02:20:16');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `conversion_id` int(10) UNSIGNED NOT NULL,
  `sender_id` int(10) UNSIGNED NOT NULL,
  `receiver_id` int(10) UNSIGNED NOT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tempname` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'template name',
  `secs` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_default` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `name`, `slug`, `tempname`, `secs`, `is_default`, `created_at`, `updated_at`) VALUES
(11, 'HOME', 'home', 'templates.basic.', '[\"about\",\"counter\",\"choose_us\",\"journalist\",\"how_it_work\",\"hire\",\"testimonial\",\"client\"]', 0, '2021-03-09 04:25:50', '2021-03-09 05:26:53'),
(12, 'About', 'about', 'templates.basic.', '[\"about\",\"choose_us\",\"hire\"]', 0, '2021-03-09 05:30:10', '2021-04-11 10:04:27'),
(13, 'How It Works', 'how-it-works', 'templates.basic.', '[\"how_it_work\"]', 0, '2021-03-09 05:30:29', '2021-03-13 07:03:51');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `member_id` int(10) UNSIGNED DEFAULT NULL,
  `journalist_id` tinyint(4) DEFAULT NULL,
  `rating` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'asa', 'sasa', '2021-04-12 00:09:05', '2021-04-12 00:09:05');

-- --------------------------------------------------------

--
-- Table structure for table `stories`
--

CREATE TABLE `stories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `title` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT 'Approved: 1, Pending: 0,',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `support_attachments`
--

CREATE TABLE `support_attachments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `support_message_id` int(11) NOT NULL,
  `attachment` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `support_messages`
--

CREATE TABLE `support_messages` (
  `id` int(10) UNSIGNED NOT NULL,
  `supportticket_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin_id` int(11) NOT NULL DEFAULT 0,
  `message` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `support_tickets`
--

CREATE TABLE `support_tickets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(91) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ticket` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL COMMENT '0: Open, 1: Answered, 2: Replied, 3: Closed',
  `last_reply` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `amount` decimal(18,8) NOT NULL DEFAULT 0.00000000,
  `charge` decimal(18,8) NOT NULL DEFAULT 0.00000000,
  `post_balance` decimal(18,8) NOT NULL DEFAULT 0.00000000,
  `trx_type` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trx` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `details` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `user_id`, `amount`, `charge`, `post_balance`, `trx_type`, `trx`, `details`, `created_at`, `updated_at`) VALUES
(1, 1, '1.00000000', '0.00000000', '5000.00000000', '-', 'BWUUEGUWZB8T', 'Payment For journalist Booking', '2022-04-12 15:52:45', '2022-04-12 15:52:45'),
(2, 1, '342.00000000', '0.00000000', '5000.00000000', '-', '4VOSHJ96VGMW', 'Payment For journalist Booking', '2022-04-12 18:50:16', '2022-04-12 18:50:16'),
(3, 1, '454.00000000', '0.00000000', '5000.00000000', '-', 'KFBFAXVCK8NF', 'Payment For journalist Booking', '2022-04-12 18:50:44', '2022-04-12 18:50:44'),
(4, 1, '678.00000000', '0.00000000', '5000.00000000', '-', '814S2W36YA5W', 'Payment For journalist Booking', '2022-04-12 18:51:01', '2022-04-12 18:51:01');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `featured` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'Include : 1\r\nNot Include : 0',
  `firstname` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lastname` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(90) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_type` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `website` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ref_by` int(11) DEFAULT NULL,
  `balance` decimal(18,8) NOT NULL DEFAULT 0.00000000,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(91) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'contains full address',
  `about_profession` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `designation` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `service_id` int(11) DEFAULT NULL,
  `language` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `skill` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0: banned, 1: active',
  `account_status` tinyint(1) DEFAULT 0 COMMENT 'Approved : 1\r\nBanned : 0',
  `rating` int(11) DEFAULT 0,
  `ev` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0: email unverified, 1: email verified',
  `sv` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0: sms unverified, 1: sms verified',
  `ver_code` varchar(91) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'stores verification code',
  `ver_code_send_at` datetime DEFAULT NULL COMMENT 'verification send time',
  `ts` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0: 2fa off, 1: 2fa on',
  `tv` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0: 2fa unverified, 1: 2fa verified',
  `tsc` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `featured`, `firstname`, `lastname`, `username`, `email`, `mobile`, `user_type`, `website`, `ref_by`, `balance`, `password`, `image`, `address`, `about_profession`, `designation`, `service_id`, `language`, `skill`, `status`, `account_status`, `rating`, `ev`, `sv`, `ver_code`, `ver_code_send_at`, `ts`, `tv`, `tsc`, `provider`, `provider_id`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 0, 'Rubicon', 'Rubicon', 'Rubicon', 'default@rubicon.com', '0', '1', 'www', 1, '5000.00000000', '12456667', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 0, 0, 0, NULL, NULL, 0, 1, NULL, NULL, NULL, NULL, '2022-04-12 22:00:00', '2022-04-13 22:00:00'),
(2, 0, 'Lierance', 'Magwenzi', 'testuser', 'lee@gmail.com', '0824208001', '1', 'www', 1, '0.00000000', '12456667', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 0, 0, 0, NULL, NULL, 0, 1, NULL, NULL, NULL, NULL, '2022-04-12 22:00:00', '2022-04-13 22:00:00'),
(3, 0, 'Lierance', 'Magwenzi', 'adminman', 'magwenzilierance@gmail.com', '27824208001', 'journalist', NULL, NULL, '0.00000000', '$2y$10$3xrC/Yk36zsLxF/TSuyoy.tCa8eUcPCiNRzd/kIXMrFtvpmdM9phK', NULL, '{\"address\":\"\",\"state\":\"\",\"zip\":\"\",\"country\":\"South Africa\",\"city\":\"\"}', NULL, NULL, NULL, NULL, NULL, 1, 0, 0, 1, 1, NULL, NULL, 0, 1, NULL, NULL, NULL, NULL, '2022-04-12 16:05:28', '2022-04-12 16:05:28');

-- --------------------------------------------------------

--
-- Table structure for table `user_logins`
--

CREATE TABLE `user_logins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_ip` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` varchar(91) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `browser` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `os` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `longitude` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `latitude` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_code` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_logins`
--

INSERT INTO `user_logins` (`id`, `user_id`, `user_ip`, `location`, `browser`, `os`, `longitude`, `latitude`, `country`, `country_code`, `created_at`, `updated_at`) VALUES
(1, 3, '127.0.0.1', ' - -  -  ', 'Firefox', 'Mac OS X', '', '', '', '', '2022-04-12 16:05:28', '2022-04-12 16:05:28');

-- --------------------------------------------------------

--
-- Table structure for table `withdrawals`
--

CREATE TABLE `withdrawals` (
  `id` int(10) UNSIGNED NOT NULL,
  `method_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `amount` decimal(18,8) NOT NULL,
  `currency` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rate` decimal(18,8) NOT NULL,
  `charge` decimal(18,8) NOT NULL,
  `trx` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `final_amount` decimal(18,8) NOT NULL DEFAULT 0.00000000,
  `after_charge` decimal(18,8) NOT NULL,
  `withdraw_information` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '1=>success, 2=>pending, 3=>cancel,  ',
  `admin_feedback` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `withdraw_methods`
--

CREATE TABLE `withdraw_methods` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `min_limit` decimal(18,8) DEFAULT NULL,
  `max_limit` decimal(18,8) NOT NULL DEFAULT 0.00000000,
  `delay` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fixed_charge` decimal(18,8) DEFAULT NULL,
  `rate` decimal(18,8) DEFAULT NULL,
  `percent_charge` decimal(5,2) DEFAULT NULL,
  `currency` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_data` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_password_resets`
--
ALTER TABLE `admin_password_resets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `conversations`
--
ALTER TABLE `conversations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deposits`
--
ALTER TABLE `deposits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `educations`
--
ALTER TABLE `educations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_sms_templates`
--
ALTER TABLE `email_sms_templates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employments`
--
ALTER TABLE `employments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `extensions`
--
ALTER TABLE `extensions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `frontends`
--
ALTER TABLE `frontends`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gateways`
--
ALTER TABLE `gateways`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gateway_currencies`
--
ALTER TABLE `gateway_currencies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `general_settings`
--
ALTER TABLE `general_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `journalist_work_files`
--
ALTER TABLE `journalist_work_files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stories`
--
ALTER TABLE `stories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `support_attachments`
--
ALTER TABLE `support_attachments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `support_messages`
--
ALTER TABLE `support_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `support_tickets`
--
ALTER TABLE `support_tickets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`,`email`);

--
-- Indexes for table `user_logins`
--
ALTER TABLE `user_logins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `withdrawals`
--
ALTER TABLE `withdrawals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `withdraw_methods`
--
ALTER TABLE `withdraw_methods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `work_deliveries`
--
ALTER TABLE `work_deliveries`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `admin_password_resets`
--
ALTER TABLE `admin_password_resets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `conversations`
--
ALTER TABLE `conversations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `deposits`
--
ALTER TABLE `deposits`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `educations`
--
ALTER TABLE `educations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `email_sms_templates`
--
ALTER TABLE `email_sms_templates`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=222;

--
-- AUTO_INCREMENT for table `employments`
--
ALTER TABLE `employments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `extensions`
--
ALTER TABLE `extensions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `frontends`
--
ALTER TABLE `frontends`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT for table `gateways`
--
ALTER TABLE `gateways`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `gateway_currencies`
--
ALTER TABLE `gateway_currencies`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `general_settings`
--
ALTER TABLE `general_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `journalist_work_files`
--
ALTER TABLE `journalist_work_files`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `stories`
--
ALTER TABLE `stories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `support_attachments`
--
ALTER TABLE `support_attachments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `support_messages`
--
ALTER TABLE `support_messages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `support_tickets`
--
ALTER TABLE `support_tickets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_logins`
--
ALTER TABLE `user_logins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `withdrawals`
--
ALTER TABLE `withdrawals`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `withdraw_methods`
--
ALTER TABLE `withdraw_methods`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `work_deliveries`
--
ALTER TABLE `work_deliveries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
