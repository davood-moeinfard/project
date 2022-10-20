-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 20, 2022 at 06:47 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `app`
--

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `image` text DEFAULT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `mobile_number` varchar(255) NOT NULL,
  `phone_number` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `first_name`, `last_name`, `image`, `user_id`, `mobile_number`, `phone_number`, `address`, `created_at`, `updated_at`) VALUES
(15, 'gggggg', 'dddddddd', 'contact_photo/2022-10-20-15-32-06.jpeg', 17, '456456', '464565', 'fhfhfghfgh', '2022-10-20 12:56:24', '2022-10-20 19:39:23'),
(18, 'hamid', 'rezaie', 'contact_photo/2022-10-20-15-13-01.png', 17, '34534535', '345345', 'esfahan', '2022-10-20 13:13:01', '2022-10-20 19:39:42'),
(26, 'nnnnnnn', 'kiani', 'contact_photo/2022-10-20-17-39-29.jpeg', 18, '12345456765', '12345678998', 'abadan', '2022-10-20 15:39:29', '2022-10-20 19:38:35'),
(28, 'mohammadreza', 'banaie', 'contact_photo/2022-10-20-18-39-00.jpeg', 17, '56745676789', '', '', '2022-10-20 16:26:23', '2022-10-20 20:09:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_photo` text DEFAULT NULL,
  `verify_token` varchar(255) DEFAULT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 => inactive,1 => active',
  `forgot_token` varchar(255) DEFAULT NULL,
  `forgot_token_expire` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `user_photo`, `verify_token`, `is_active`, `forgot_token`, `forgot_token_expire`, `created_at`, `updated_at`) VALUES
(17, 'iman', 'd.a0002000@gmail.com', '$2y$10$4R0Ty45d9yAzzTy21dYuOuS8ZyM3N7LTPJ9VyveFrFkqkN3hH0HiC', 'user_photo/2022-10-20-18-20-53.png', '61913e78cee21918a33fb211aca812c5c24c76b39a595ed4b785208ac6ff7f09', 1, '29390da97239debef23bb11709dc9111b8f63955b6f907136dc4a08014876fbf', '2022-10-20 07:50:16', '2022-10-16 14:57:46', '2022-10-20 19:51:26'),
(18, 'davood', 'davood.moeinfard@gmail.com', '$2y$10$U8UG.jQ4b7RtuD5qs1CwBeHkZ6v5rYgavnDPL8i399GIHNbt6u4sS', 'user_photo/2022-10-20-16-50-23.png', 'd54b0a5accad8c6eafb277fc4fa46196adfb8fafd64808ea4f1d73601390f1f0', 1, NULL, NULL, '2022-10-17 08:43:19', '2022-10-20 18:20:23');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `mobile_number` (`mobile_number`),
  ADD KEY `contacts_user_id_foreign` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `contacts`
--
ALTER TABLE `contacts`
  ADD CONSTRAINT `contacts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
