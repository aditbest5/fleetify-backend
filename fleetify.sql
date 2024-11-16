-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 16, 2024 at 10:58 AM
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
-- Database: `fleetify`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendances`
--

CREATE TABLE `attendances` (
  `id` char(36) NOT NULL,
  `employee_id` char(36) NOT NULL,
  `clock_in` timestamp NULL DEFAULT NULL,
  `clock_out` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attendances`
--

INSERT INTO `attendances` (`id`, `employee_id`, `clock_in`, `clock_out`, `created_at`, `updated_at`) VALUES
('9d7ecfe4-6373-4822-bea8-d24c981513cf', '9d7ebcb7-05fb-476c-a584-2795b708b37a', '2024-11-15 01:40:00', '2024-11-15 10:40:00', '2024-11-15 07:09:52', '2024-11-15 07:34:01'),
('9d804b97-aa0c-4ee0-8fdf-31e583b79ef3', '9d7ebbab-f90f-4441-99fb-70b2d973682b', '2024-11-16 07:51:00', '2024-11-16 07:54:00', '2024-11-16 00:51:36', '2024-11-16 00:54:04'),
('9d80632b-cd56-4efa-b563-343ffbe87aba', '9d7ebcb7-05fb-476c-a584-2795b708b37a', '2024-11-16 08:57:00', '2024-11-16 08:57:00', '2024-11-16 01:57:31', '2024-11-16 01:57:37');

-- --------------------------------------------------------

--
-- Table structure for table `attendance_histories`
--

CREATE TABLE `attendance_histories` (
  `id` char(36) NOT NULL,
  `employee_id` char(36) NOT NULL,
  `attendance_id` char(36) NOT NULL,
  `date_attendance` timestamp NULL DEFAULT NULL,
  `attendance_type` tinyint(4) NOT NULL DEFAULT 1,
  `description` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attendance_histories`
--

INSERT INTO `attendance_histories` (`id`, `employee_id`, `attendance_id`, `date_attendance`, `attendance_type`, `description`, `created_at`, `updated_at`) VALUES
('9d7ecfe4-65b0-431a-8923-528a43ea88c9', '9d7ebcb7-05fb-476c-a584-2795b708b37a', '9d7ecfe4-6373-4822-bea8-d24c981513cf', '2024-11-15 01:40:00', 1, 'Terlambat', '2024-11-15 07:09:52', '2024-11-15 07:09:52'),
('9d7ed886-8035-4f16-9b3c-e9c43575f6d3', '9d7ebcb7-05fb-476c-a584-2795b708b37a', '9d7ecfe4-6373-4822-bea8-d24c981513cf', '2024-11-15 10:40:00', 0, 'Tepat Waktu', '2024-11-15 07:34:01', '2024-11-15 07:34:01'),
('9d804b97-acbc-4fe4-b6c6-e22ea5c2443b', '9d7ebbab-f90f-4441-99fb-70b2d973682b', '9d804b97-aa0c-4ee0-8fdf-31e583b79ef3', '2024-11-16 07:51:00', 1, 'Terlambat', '2024-11-16 00:51:36', '2024-11-16 00:51:36'),
('9d804c79-a24e-4ac2-8398-74547993cd89', '9d7ebbab-f90f-4441-99fb-70b2d973682b', '9d804b97-aa0c-4ee0-8fdf-31e583b79ef3', '2024-11-16 07:54:00', 0, 'Pulang Sebelum Waktunya', '2024-11-16 00:54:04', '2024-11-16 00:54:04'),
('9d80632b-d01d-436a-96b8-180a12e5fd8f', '9d7ebcb7-05fb-476c-a584-2795b708b37a', '9d80632b-cd56-4efa-b563-343ffbe87aba', '2024-11-16 08:57:00', 1, 'Terlambat', '2024-11-16 01:57:31', '2024-11-16 01:57:31'),
('9d806333-b964-4e9d-a763-56c668b4d88f', '9d7ebcb7-05fb-476c-a584-2795b708b37a', '9d80632b-cd56-4efa-b563-343ffbe87aba', '2024-11-16 08:57:00', 0, 'Pulang Sebelum Waktunya', '2024-11-16 01:57:37', '2024-11-16 01:57:37');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` char(36) NOT NULL,
  `department_name` varchar(255) NOT NULL,
  `max_clock_in_time` time NOT NULL,
  `max_clock_out_time` time NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `department_name`, `max_clock_in_time`, `max_clock_out_time`, `created_at`, `updated_at`) VALUES
('9d7ebbc1-5358-486e-b15b-f03bafbf0fff', 'Financial Department', '08:30:00', '18:00:00', '2024-11-15 06:13:34', '2024-11-15 06:14:47'),
('9d7ebbce-920e-4a9e-b131-82b1851e3dcf', 'Administration Department', '08:30:00', '17:30:00', '2024-11-15 06:13:43', '2024-11-16 00:18:58'),
('9d7ebbd6-a04a-4bf5-ad76-7b2495986ee4', 'IT Department', '08:00:00', '17:00:00', '2024-11-15 06:13:48', '2024-11-15 06:13:48'),
('9d7ebbdc-fcfa-4c3d-8e78-3ed0745c8301', 'Engineering Department', '08:00:00', '17:00:00', '2024-11-15 06:13:52', '2024-11-15 06:13:52');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` char(36) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `department_id` char(36) DEFAULT NULL,
  `user_id` char(36) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `name`, `address`, `department_id`, `user_id`, `created_at`, `updated_at`) VALUES
('9d7ebbab-f90f-4441-99fb-70b2d973682b', 'Aditya Aprianto', 'Dasana Indah Blok UC 18 No. 6', '9d7ebbce-920e-4a9e-b131-82b1851e3dcf', '9d7ebbab-f6e5-4a01-94c6-c07d8c3b2c06', '2024-11-15 06:13:20', '2024-11-15 06:17:46'),
('9d7ebcb7-05fb-476c-a584-2795b708b37a', 'Nicolaus Daru Putra', 'Dasana Indah Blok UC 16 no. 10', '9d7ebbc1-5358-486e-b15b-f03bafbf0fff', '9d7ebcb7-0328-4668-96fc-2af2ac356d7d', '2024-11-15 06:16:15', '2024-11-16 02:30:39'),
('9d8062e6-b7af-4bee-924e-ea878e891a47', 'Aji Arman Dwianto', 'Dasana Indah Blok UC 18 No. 6', '9d7ebbce-920e-4a9e-b131-82b1851e3dcf', '9d8062e6-b521-44f8-a565-f4632888ec16', '2024-11-16 01:56:46', '2024-11-16 02:31:26');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(2, '2019_08_19_000000_create_failed_jobs_table', 1),
(3, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(4, '2024_09_08_073342_create_roles_table', 1),
(5, '2024_10_12_000000_create_users_table', 1),
(6, '2024_11_15_111007_create_departments_table', 1),
(7, '2024_11_15_111104_create_employees_table', 1),
(8, '2024_11_15_112033_create_attendances_table', 1),
(9, '2024_11_15_114231_create_attendance_histories_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` char(36) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
('9d7ebba1-ea35-46d6-8928-a0975382b07a', 'user', '2024-11-15 06:13:13', '2024-11-15 06:13:13'),
('9d7ebba7-f421-451e-9b9a-c22873dfaba3', 'admin', '2024-11-15 06:13:17', '2024-11-15 06:13:17');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` char(36) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` char(36) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role_id`, `remember_token`, `created_at`, `updated_at`) VALUES
('9d7ebbab-f6e5-4a01-94c6-c07d8c3b2c06', 'Aditya Aprianto', 'aditbest5@gmail.com', NULL, '$2y$10$KVHSNSu81SP0y2ijpFto.eSjX2cEPrQFjVXZo1qE.8pCakaBlf9b6', '9d7ebba7-f421-451e-9b9a-c22873dfaba3', NULL, '2024-11-15 06:13:20', '2024-11-15 06:13:20'),
('9d7ebcb7-0328-4668-96fc-2af2ac356d7d', 'Nicolaus Daru Putra', 'nicolausdaru@gmail.com', NULL, '$2y$10$xuhq1ifKzn7erMZENEY7SeNqmnPskNySts1COZzK5jYHBPHdcM7li', '9d7ebba1-ea35-46d6-8928-a0975382b07a', NULL, '2024-11-15 06:16:15', '2024-11-16 02:50:40'),
('9d8062e6-b521-44f8-a565-f4632888ec16', 'Aji Arman Dwianto', 'ajiarman12@gmail.com', NULL, '$2y$10$b2ahoRRt6QqHGi4hiiz2T.XVcD/OfutnkhZpQHzxFvCnyVv5Kqdbe', '9d7ebba7-f421-451e-9b9a-c22873dfaba3', NULL, '2024-11-16 01:56:46', '2024-11-16 01:56:46');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendances`
--
ALTER TABLE `attendances`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attendances_employee_id_foreign` (`employee_id`);

--
-- Indexes for table `attendance_histories`
--
ALTER TABLE `attendance_histories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attendance_histories_employee_id_foreign` (`employee_id`),
  ADD KEY `attendance_histories_attendance_id_foreign` (`attendance_id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employees_department_id_foreign` (`department_id`),
  ADD KEY `employees_user_id_foreign` (`user_id`);

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
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_role_id_foreign` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendances`
--
ALTER TABLE `attendances`
  ADD CONSTRAINT `attendances_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `attendance_histories`
--
ALTER TABLE `attendance_histories`
  ADD CONSTRAINT `attendance_histories_attendance_id_foreign` FOREIGN KEY (`attendance_id`) REFERENCES `attendances` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `attendance_histories_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `employees_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `employees_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
