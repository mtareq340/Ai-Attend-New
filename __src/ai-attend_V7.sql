-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 28, 2022 at 02:38 PM
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
-- Table structure for table `attendance_settings`
--

CREATE TABLE `attendance_settings` (
  `id` bigint(20) NOT NULL,
  `allow_delay` tinyint(1) DEFAULT NULL,
  `automatic_leave` tinyint(1) DEFAULT NULL,
  `over_time_count` tinyint(1) DEFAULT NULL,
  `validate_finger` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attendance_settings`
--

INSERT INTO `attendance_settings` (`id`, `allow_delay`, `automatic_leave`, `over_time_count`, `validate_finger`, `created_at`, `updated_at`) VALUES
(1, 0, 1, NULL, NULL, NULL, NULL);

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
  `email` varchar(191) DEFAULT NULL,
  `registeration_num` int(11) DEFAULT NULL,
  `phone` varchar(191) DEFAULT NULL,
  `logo` varchar(250) DEFAULT NULL,
  `background` varchar(250) DEFAULT NULL,
  `ssid` varchar(191) CHARACTER SET utf8 DEFAULT NULL,
  `mac_address` varchar(191) CHARACTER SET utf8 DEFAULT NULL,
  `notes` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `company_settings`
--

INSERT INTO `company_settings` (`id`, `name`, `email`, `registeration_num`, `phone`, `logo`, `background`, `ssid`, `mac_address`, `notes`, `created_at`, `updated_at`) VALUES
(1, 'atis company', NULL, NULL, NULL, NULL, NULL, '12354dd', 'fvhhbf4fv4Gngjbjnbg5', 'atis', '2022-06-22 09:20:28', '2022-06-22 09:20:28');

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
  `Action` int(1) NOT NULL DEFAULT 0,
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
(8, 'show_roles', 'Show Roles', NULL, NULL, NULL),
(9, 'add_branch', 'Add Branch', NULL, NULL, NULL),
(10, 'edit_branch', 'Edit Branch', NULL, NULL, NULL),
(11, 'delete_branch', 'Delete Branch', NULL, NULL, NULL),
(12, 'show_branches', 'Show Branches', NULL, NULL, NULL),
(13, 'add_employee', 'Add Employee', NULL, NULL, NULL),
(14, 'edit_employee', 'Edit Employee', NULL, NULL, NULL),
(15, 'delete_employee', 'Delete Employee', NULL, NULL, NULL),
(16, 'show_employees', 'Show Employees', NULL, NULL, NULL),
(17, 'add_location', 'Add Location', NULL, NULL, NULL),
(18, 'edit_location', 'Edit Location', NULL, NULL, NULL),
(19, 'delete_location', 'Delete Location', NULL, NULL, NULL),
(20, 'show_locations', 'Show Locations', NULL, NULL, NULL),
(21, 'add_appointment', 'Add Appointment', NULL, NULL, NULL),
(22, 'edit_appointment', 'Edit Appointment', NULL, NULL, NULL),
(23, 'delete_appointment', 'Delete Appointment', NULL, NULL, NULL),
(24, 'show_appointments', 'Show Appointments', NULL, NULL, NULL),
(25, 'add_job', 'Add Job', NULL, NULL, NULL),
(26, 'edit_job', 'Edit Job', NULL, NULL, NULL),
(27, 'delete_job', 'Delete Job', NULL, NULL, NULL),
(28, 'show_jobs', 'Show Jobs', NULL, NULL, NULL),
(29, 'add_attend_method', 'Add Attend Method', NULL, NULL, NULL),
(30, 'edit_attend_method', 'Edit Attend Method', NULL, NULL, NULL),
(31, 'delete_attend_method', 'Delete Attend Method', NULL, NULL, NULL),
(32, 'show_attend_methods', 'Show Attend Methods', NULL, NULL, NULL),
(33, 'add_device', 'Add Device', NULL, NULL, NULL),
(34, 'edit_device', 'Edit Device', NULL, NULL, NULL),
(35, 'delete_device', 'Delete Device', NULL, NULL, NULL),
(36, 'show_devices', 'Show Devices', NULL, NULL, NULL),
(37, 'add_employee_attend_method', 'Add Employee Attend Method', NULL, NULL, NULL),
(38, 'edit_employee_attend_method', 'Edit Employee Attend Method', NULL, NULL, NULL),
(39, 'delete_employee_attend_method', 'Delete Employee Attend Method', NULL, NULL, NULL),
(40, 'show_employee_attend_methods', 'Show Employee Attend Methods', NULL, NULL, NULL),
(41, 'add_assign_appointment', 'Add Assign Appointment', NULL, NULL, NULL),
(42, 'edit_assign_appointment', 'Edit Assign Appointment', NULL, NULL, NULL),
(43, 'delete_assign_appointment', 'Delete Assign Appointment', NULL, NULL, NULL),
(44, 'show_assign_appointments', 'Show Assign Appointments', NULL, NULL, NULL),
(124, 'add_plan', 'Add Plan', NULL, NULL, NULL),
(125, 'edit_plan', 'Edit Plan', NULL, NULL, NULL),
(126, 'delete_plan', 'Delete Plan', NULL, NULL, NULL),
(127, 'show_plans', 'Show Plans', NULL, NULL, NULL);

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
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(22, 1),
(23, 1),
(24, 1),
(25, 1),
(26, 1),
(27, 1),
(28, 1),
(29, 1),
(30, 1),
(31, 1),
(32, 1),
(33, 1),
(34, 1),
(35, 1),
(36, 1),
(37, 1),
(38, 1),
(39, 1),
(40, 1),
(41, 1),
(42, 1),
(43, 1),
(44, 1);

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
-- Indexes for table `attendance_settings`
--
ALTER TABLE `attendance_settings`
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
-- AUTO_INCREMENT for table `attendance_settings`
--
ALTER TABLE `attendance_settings`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

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
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=128;

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
