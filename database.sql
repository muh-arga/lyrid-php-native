-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: mysql
-- Generation Time: May 12, 2026 at 02:20 AM
-- Server version: 8.0.30
-- PHP Version: 8.3.30
SET
    SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";

START TRANSACTION;

SET
    time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;

/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;

/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;

/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lyrid`
--
-- --------------------------------------------------------
--
-- Table structure for table `employees`
--
CREATE TABLE
    `employees` (
        `id` int UNSIGNED NOT NULL,
        `name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
        `email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
        `phone` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
        `address` text COLLATE utf8mb4_general_ci NOT NULL,
        `photo` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
        `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
        `updated_at` datetime DEFAULT CURRENT_TIMESTAMP
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

-- --------------------------------------------------------
--
-- Table structure for table `users`
--
CREATE TABLE
    `users` (
        `id` int UNSIGNED NOT NULL,
        `name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
        `username` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
        `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
        `role` enum ('admin', 'user') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'user',
        `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
        `updated_at` datetime DEFAULT CURRENT_TIMESTAMP
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

--
-- Dumping data for table `users`
--
INSERT INTO
    `users` (
        `id`,
        `name`,
        `username`,
        `password`,
        `role`,
        `created_at`,
        `updated_at`
    )
VALUES
    (
        1,
        'Administrator',
        'admin',
        '$2y$10$uPadjSNqVMzcgQDqoBMN4Oneiet3eJSJ7PH5AZ6i9wdWRl8Viitiq',
        'admin',
        '2026-05-11 19:21:19',
        '2026-05-11 19:21:19'
    ),
    (
        2,
        'User',
        'user',
        '$2y$10$5wFTW9WbwCiYVWSDUPegR.DxjiuRafnczNbc/l3zWMxUpffKUhLQK',
        'user',
        '2026-05-11 19:21:19',
        '2026-05-11 19:21:19'
    );

--
-- Indexes for dumped tables
--
--
-- Indexes for table `employees`
--
ALTER TABLE `employees` ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users` ADD PRIMARY KEY (`id`),
ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--
--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees` MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users` MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
AUTO_INCREMENT = 3;

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;

/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;

/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;