-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 21, 2021 at 02:03 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `btc_investments`
--

-- --------------------------------------------------------

--
-- Table structure for table `deposits`
--

CREATE TABLE `deposits` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `coin` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `usn` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `investment_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gain` double(8,2) DEFAULT NULL,
  `invoice` int(11) NOT NULL,
  `amount` double(8,2) NOT NULL,
  `currency` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_no` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `receipt` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `paid` tinyint(1) NOT NULL DEFAULT 0,
  `pop` varchar(2000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_for_payment` datetime DEFAULT NULL,
  `on_apr` tinyint(1) NOT NULL DEFAULT 0,
  `url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ipn` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `deposits`
--

INSERT INTO `deposits` (`id`, `user_id`, `coin`, `usn`, `investment_type`, `gain`, `invoice`, `amount`, `currency`, `account_name`, `account_no`, `receipt`, `bank`, `paid`, `pop`, `date_for_payment`, `on_apr`, `url`, `ipn`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 3, NULL, 'teckbot', NULL, NULL, 1629504000, 0.01, '$', 'DRT', 'bc1qukuu0gkzzjhwwd8fnnxj323kduym7s46lup3ml', 'teckbot_receipt_id_1.jpg', 'BTC', 0, '', NULL, 0, '', NULL, 1, NULL, '2021-08-21 09:04:59', '2021-08-21 10:04:06');

-- --------------------------------------------------------

--
-- Table structure for table `deposit_settings`
--

CREATE TABLE `deposit_settings` (
  `id` int(11) NOT NULL,
  `SWITCH_BTC` tinyint(1) NOT NULL,
  `SWITCH_ETH` tinyint(1) NOT NULL,
  `COINPAYMENTS_DB_PREFIX` varchar(500) NOT NULL,
  `COINPAYMENTS_MERCHANT_ID` varchar(500) NOT NULL,
  `COINPAYMENTS_PUBLIC_KEY` varchar(500) NOT NULL,
  `COINPAYMENTS_PRIVATE_KEY` varchar(500) NOT NULL,
  `COINPAYMENTS_IPN_SECRET` varchar(500) DEFAULT NULL,
  `COINPAYMENTS_IPN_URL` varchar(500) DEFAULT NULL,
  `COINPAYMENTS_API_FORMAT` varchar(500) NOT NULL,
  `COINPAYMENTS_IPN_ROUTE_ENABLED` varchar(500) NOT NULL,
  `COINPAYMENTS_IPN_ROUTE_PATH` varchar(500) NOT NULL,
  `COINBASE_SWITCH` tinyint(1) NOT NULL,
  `COINBASE_API_KEY` varchar(500) NOT NULL,
  `COINBASE_WEBHOOK_SECRETE` varchar(500) NOT NULL,
  `BCM_SWITCH` tinyint(1) NOT NULL,
  `Blockonomics_API` varchar(500) NOT NULL,
  `BCM_SECRETE` varchar(500) NOT NULL,
  `BC_SWITCH` tinyint(1) NOT NULL,
  `BC_MY_XPUB` varchar(500) NOT NULL,
  `BC_MY_API_KEY` varchar(500) NOT NULL,
  `BTC_SWITCH` tinyint(1) NOT NULL,
  `BTC_WALLET` varchar(500) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `deposit_settings`
--

INSERT INTO `deposit_settings` (`id`, `SWITCH_BTC`, `SWITCH_ETH`, `COINPAYMENTS_DB_PREFIX`, `COINPAYMENTS_MERCHANT_ID`, `COINPAYMENTS_PUBLIC_KEY`, `COINPAYMENTS_PRIVATE_KEY`, `COINPAYMENTS_IPN_SECRET`, `COINPAYMENTS_IPN_URL`, `COINPAYMENTS_API_FORMAT`, `COINPAYMENTS_IPN_ROUTE_ENABLED`, `COINPAYMENTS_IPN_ROUTE_PATH`, `COINBASE_SWITCH`, `COINBASE_API_KEY`, `COINBASE_WEBHOOK_SECRETE`, `BCM_SWITCH`, `Blockonomics_API`, `BCM_SECRETE`, `BC_SWITCH`, `BC_MY_XPUB`, `BC_MY_API_KEY`, `BTC_SWITCH`, `BTC_WALLET`, `created_at`, `updated_at`) VALUES
(1, 0, 0, 'cp_', 'f3e03555b8bebf67e333a4e763550255', 'e490dd138de0ed87c927e517afe41a6beedf8d1a65479d0a33337615817b85ec', '9cbd8d741f232CE048F7B2e719D0899E236bf94b09DBE5b76f6d32fee42d0C1f', NULL, NULL, 'json', 'true', '/api/ipn', 0, 'a8ba4ffb-2a1e-4267-a51a-10b709d64e11', 'b7e118ff-a37d-4228-91be-f53225e8a8cc', 1, 'MEYPKrBcVCaVBOVyrxRcN7XTixRvWRC8DBgQknzElpg', '12345678909890', 1, 'xpub6BouAmDjjuJDDPickTwmW3b28ouyFMJPFEygkkBBoEnd1sF3b6h9wtDyye6ccdpaFYgCrE1P6SUL3mACb6y5QRxpxoC88VygzVizbW6eAuX', 'f12ec4d6-8325-430e-b5b4-7205aed2e7ef', 1, 'bc1qukuu0gkzzjhwwd8fnnxj323kduym7s46lup3ml', '2021-08-12 08:29:29', '2021-08-13 08:29:42');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2021_07_26_203500_create_deposits_table', 1),
(5, '2021_07_26_203545_create_withdraws_table', 1),
(6, '2021_07_27_190159_create_referals_table', 1),
(7, '2021_08_19_135754_create_deposit_settings_table', 1);

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
-- Table structure for table `referal`
--

CREATE TABLE `referal` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `ref_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ref_by` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ref_count` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `referal`
--

INSERT INTO `referal` (`id`, `user_id`, `ref_code`, `ref_by`, `ref_count`, `created_at`, `updated_at`) VALUES
(1, 1, 'Admin-6224', '0', '0', NULL, NULL),
(2, 2, 'Super-37927', '0', '0', NULL, NULL),
(3, 3, 'Laura-5135', 'Admin-6224', '0', '2021-08-06 07:05:34', '2021-08-06 07:05:34'),
(4, 4, 'teckbot-48017', 'Super-37927', '0', '2021-08-10 22:16:40', '2021-08-10 22:16:40'),
(5, 5, 'staunch_man-28534', 'teckbot-48017', '0', '2021-08-13 09:43:20', '2021-08-13 09:43:20'),
(6, 6, 'Drex-48974', 'teckbot-48017', '0', '2021-08-13 15:18:37', '2021-08-13 15:18:37');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ref_code` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `wallet_address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zip` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` tinyint(1) NOT NULL DEFAULT 0,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `ref_code`, `email`, `address`, `wallet_address`, `city`, `state`, `zip`, `photo`, `role`, `email_verified_at`, `password`, `remember_token`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 265412, 'admin@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2021-08-21 08:43:55', '$2y$10$dIb.9Umoh6LMhNLBwvHqGecma4OjvsdyZ3n3p2s7AxN5m4U0/ihri', 'MCFSUF4PmR', NULL, NULL, NULL),
(2, 'Super Admin', 615538, 'super@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 2, '2021-08-21 08:43:55', '$2y$10$dIb.9Umoh6LMhNLBwvHqGecma4OjvsdyZ3n3p2s7AxN5m4U0/ihri', 'GVZC1NXY5v', NULL, NULL, NULL),
(3, 'teckbot', 177539, 'user@gmail.com', NULL, 'dtr5r6t55w7y43etg7t37gf7wtg972y3', NULL, NULL, NULL, NULL, 0, '2021-08-21 08:43:55', '$2y$10$qdxQYR3BCEkdqbpQEaZQoOQ5x.1IjNj6H49jW.JuQgIeWjazXRIDW', 'D23SXhNQB3', NULL, NULL, '2021-08-21 10:09:18');

-- --------------------------------------------------------

--
-- Table structure for table `withdraws`
--

CREATE TABLE `withdraws` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `coin` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `deposits`
--
ALTER TABLE `deposits`
  ADD PRIMARY KEY (`id`),
  ADD KEY `deposits_user_id_foreign` (`user_id`);

--
-- Indexes for table `deposit_settings`
--
ALTER TABLE `deposit_settings`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `referal`
--
ALTER TABLE `referal`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `referal_ref_code_unique` (`ref_code`),
  ADD KEY `referal_user_id_foreign` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_ref_code_unique` (`ref_code`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `withdraws`
--
ALTER TABLE `withdraws`
  ADD PRIMARY KEY (`id`),
  ADD KEY `withdraws_user_id_foreign` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `deposits`
--
ALTER TABLE `deposits`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `deposit_settings`
--
ALTER TABLE `deposit_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `referal`
--
ALTER TABLE `referal`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `withdraws`
--
ALTER TABLE `withdraws`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `deposits`
--
ALTER TABLE `deposits`
  ADD CONSTRAINT `deposits_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `withdraws`
--
ALTER TABLE `withdraws`
  ADD CONSTRAINT `withdraws_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
