-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 26, 2022 at 08:06 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ai-attend`
--

-- --------------------------------------------------------

--
-- Table structure for table `assign_appointments`
--

CREATE TABLE `assign_appointments` (
  `id` bigint(20) NOT NULL,
  `employee_id` bigint(20) NOT NULL,
  `work_appointment_id` bigint(20) NOT NULL,
  `job_id` bigint(20) NOT NULL,
  `branch_id` bigint(20) NOT NULL,
  `location_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `attend_methods`
--

CREATE TABLE `attend_methods` (
  `id` bigint(20) NOT NULL,
  `name` varchar(191) DEFAULT NULL,
  `active` tinyint(1) DEFAULT 1,
  `notes` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE `branches` (
  `id` bigint(20) NOT NULL,
  `name` varchar(191) NOT NULL,
  `phone` varchar(191) DEFAULT NULL,
  `address` varchar(191) DEFAULT NULL,
  `notes` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `_lft` int(10) UNSIGNED DEFAULT NULL,
  `_rgt` int(10) UNSIGNED DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`id`, `name`, `phone`, `address`, `notes`, `created_at`, `updated_at`, `_lft`, `_rgt`, `parent_id`) VALUES
(2, 'smart village', '01011305995', '6 october', 'no', '2022-06-22 10:27:14', '2022-06-22 10:27:14', 1, 2, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `company_plans`
--

CREATE TABLE `company_plans` (
  `id` bigint(20) NOT NULL,
  `plan_id` bigint(20) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `company_settings`
--

CREATE TABLE `company_settings` (
  `id` bigint(20) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `ssid` varchar(191) CHARACTER SET utf8 DEFAULT NULL,
  `mac_address` varchar(191) CHARACTER SET utf8 DEFAULT NULL,
  `notes` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `company_settings`
--

INSERT INTO `company_settings` (`id`, `name`, `ssid`, `mac_address`, `notes`, `created_at`, `updated_at`) VALUES
(1, 'atis company', '12354dd', 'fvhhbf4fv4Gngjbjnbg5', 'atis', '2022-06-22 09:20:28', '2022-06-22 09:20:28');

-- --------------------------------------------------------

--
-- Table structure for table `devices`
--

CREATE TABLE `devices` (
  `id` bigint(20) NOT NULL,
  `name` varchar(191) NOT NULL,
  `notes` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `devices`
--

INSERT INTO `devices` (`id`, `name`, `notes`, `created_at`, `updated_at`) VALUES
(1, 'Mohamed Tarek', 'dfbgnhm', '2022-06-21 05:15:14', '2022-06-21 05:15:14');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` bigint(20) NOT NULL,
  `name` varchar(191) NOT NULL,
  `email` varchar(191) DEFAULT NULL,
  `password` varchar(191) NOT NULL,
  `phone` varchar(191) NOT NULL,
  `address` varchar(191) DEFAULT NULL,
  `gender` enum('male','female') NOT NULL DEFAULT 'male',
  `age` bigint(20) DEFAULT NULL,
  `branch_id` bigint(20) DEFAULT NULL,
  `job_id` bigint(20) DEFAULT NULL,
  `active` int(11) NOT NULL DEFAULT 1,
  `locked` int(11) NOT NULL DEFAULT 1,
  `otp` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `name`, `email`, `password`, `phone`, `address`, `gender`, `age`, `branch_id`, `job_id`, `active`, `locked`, `otp`, `created_at`, `updated_at`) VALUES
(1, 'mohamed', 'mtareq340@gmail.com', '123456789', '01011305995', 'abo sleem', 'male', 25, 2, 1, 1, 1, NULL, NULL, '2022-06-25 12:07:36');

-- --------------------------------------------------------

--
-- Table structure for table `employee_attend_methods`
--

CREATE TABLE `employee_attend_methods` (
  `id` bigint(20) NOT NULL,
  `employee_id` bigint(20) DEFAULT NULL,
  `attend_method_id` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `employee_requests`
--

CREATE TABLE `employee_requests` (
  `id` bigint(20) NOT NULL,
  `employee_id` bigint(20) NOT NULL,
  `request` varchar(191) NOT NULL,
  `date` date NOT NULL,
  `accepted` int(11) NOT NULL DEFAULT 0,
  `accept_date` date DEFAULT NULL,
  `attachment` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) NOT NULL,
  `name` varchar(191) NOT NULL,
  `notes` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `name`, `notes`, `created_at`, `updated_at`) VALUES
(1, 'engineers', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `id` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `location_address` varchar(255) NOT NULL,
  `distance` varchar(255) NOT NULL,
  `location_latitude` decimal(8,6) NOT NULL,
  `location_longituide` decimal(9,6) NOT NULL,
  `notes` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `device_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) NOT NULL,
  `name` varchar(191) NOT NULL,
  `display_name` varchar(191) DEFAULT NULL,
  `notes` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `display_name`, `notes`, `created_at`, `updated_at`) VALUES
(1, 'add_user', 'Add User', NULL, NULL, NULL),
(2, 'edit_user', 'Edit User', NULL, NULL, NULL),
(3, 'delete_user', 'Delete User', NULL, NULL, NULL),
(4, 'show_users', 'Show Users', NULL, NULL, NULL),
(5, 'add_role', 'Add Role', NULL, NULL, NULL),
(6, 'edit_role', 'Edit Role', NULL, NULL, NULL),
(7, 'delete_role', 'Delete Role', NULL, NULL, NULL),
(8, 'show_roles', 'Show Roles', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `permission_role`
--

CREATE TABLE `permission_role` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permission_role`
--

INSERT INTO `permission_role` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1);

-- --------------------------------------------------------

--
-- Table structure for table `plans`
--

CREATE TABLE `plans` (
  `id` bigint(20) NOT NULL,
  `name` varchar(191) NOT NULL,
  `count_employees` bigint(20) NOT NULL,
  `price` float NOT NULL,
  `number_days` bigint(20) NOT NULL,
  `description` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `plans`
--

INSERT INTO `plans` (`id`, `name`, `count_employees`, `price`, `number_days`, `description`, `created_at`, `updated_at`) VALUES
(1, 'beginner plan', 20, 1000, 30, 'Beginner plan', '2022-06-26 06:41:28', '2022-06-26 06:41:28'),
(2, 'advanced plan', 40, 2000, 30, 'advanced plan', '2022-06-26 06:41:28', '2022-06-26 06:41:28');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) NOT NULL,
  `name` varchar(191) NOT NULL,
  `notes` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `notes`, `created_at`, `updated_at`) VALUES
(1, 'super_admin', NULL, '2022-06-25 10:35:06', '2022-06-25 10:35:06');

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  `user_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`user_id`, `role_id`, `user_type`) VALUES
(29, 1, 'App\\User'),
(30, 1, 'App\\User'),
(31, 1, 'App\\User');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) NOT NULL,
  `name` varchar(191) DEFAULT NULL,
  `value` varchar(191) DEFAULT NULL,
  `notes` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `name`, `value`, `notes`, `created_at`, `updated_at`) VALUES
(1, 'company plan id', '1', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL,
  `name` varchar(191) NOT NULL,
  `address` varchar(191) DEFAULT NULL,
  `email` varchar(191) DEFAULT NULL,
  `phone` varchar(191) NOT NULL,
  `password` varchar(191) DEFAULT NULL,
  `role_id` bigint(20) DEFAULT NULL,
  `branch_id` bigint(20) DEFAULT NULL,
  `active` int(11) NOT NULL DEFAULT 1,
  `locked` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `address`, `email`, `phone`, `password`, `role_id`, `branch_id`, `active`, `locked`, `created_at`, `updated_at`) VALUES
(29, 'test user', 'Giza', 'test@test.com', '0121212123', '$2y$10$GlCEfmJtlNaGb7JSu/E3KOKzcxSZTOGPgFGlSLKftXydG2G9lMIza', 1, 1, 1, 1, '2022-06-25 13:18:15', '2022-06-25 13:18:15'),
(30, 'admin1', 'Giza', 'superadmin@admin.com', '012244455555', '$2y$10$FdqJLp.Gugyo9zSP7c.LaOAjfWoydGJ90YzI0Sl44GYrWsclwsPf2', 1, 2, 1, 1, '2022-06-25 13:22:13', '2022-06-25 13:22:13'),
(31, 'test user', 'Giza', 'user@user.com', '02212121211222', '$2y$10$FvCwKUDP9hFCYq.6l6LvWeblZ.BCGeuEX1yK6guOVEHQNKdsw0QYi', 1, 2, 1, 1, '2022-06-25 14:37:21', '2022-06-25 14:37:21');

-- --------------------------------------------------------

--
-- Table structure for table `work_appointments`
--

CREATE TABLE `work_appointments` (
  `id` bigint(20) NOT NULL,
  `location_id` bigint(20) NOT NULL,
  `start_from` timestamp NULL DEFAULT NULL,
  `end_to` timestamp NULL DEFAULT NULL,
  `delay_min` int(11) NOT NULL,
  `delay_hour` int(11) NOT NULL,
  `branch_id` bigint(20) NOT NULL,
  `overtime_hour` int(11) DEFAULT NULL,
  `overtime_min` int(11) DEFAULT NULL,
  `date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assign_appointments`
--
ALTER TABLE `assign_appointments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attend_methods`
--
ALTER TABLE `attend_methods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `branches`
--
ALTER TABLE `branches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company_plans`
--
ALTER TABLE `company_plans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company_settings`
--
ALTER TABLE `company_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `devices`
--
ALTER TABLE `devices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee_attend_methods`
--
ALTER TABLE `employee_attend_methods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee_requests`
--
ALTER TABLE `employee_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `plans`
--
ALTER TABLE `plans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`user_id`,`role_id`),
  ADD KEY `role_user_role_id_foreign` (`role_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `work_appointments`
--
ALTER TABLE `work_appointments`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assign_appointments`
--
ALTER TABLE `assign_appointments`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `attend_methods`
--
ALTER TABLE `attend_methods`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `company_plans`
--
ALTER TABLE `company_plans`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `company_settings`
--
ALTER TABLE `company_settings`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `devices`
--
ALTER TABLE `devices`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `employee_attend_methods`
--
ALTER TABLE `employee_attend_methods`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employee_requests`
--
ALTER TABLE `employee_requests`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `plans`
--
ALTER TABLE `plans`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `work_appointments`
--
ALTER TABLE `work_appointments`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
