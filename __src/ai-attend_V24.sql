-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 20, 2022 at 11:49 AM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `ai-attend-agaza`
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
  `over_time` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `assign_appointments`
--

INSERT INTO `assign_appointments` (`id`, `employee_id`, `work_appointment_id`, `job_id`, `branch_id`, `location_id`, `over_time`, `created_at`, `updated_at`) VALUES
(78, 33, 10, 1, 2, 36, '03:00', NULL, NULL),
(79, 33, 10, 1, 2, 36, '03:00', NULL, NULL),
(80, 31, 10, 1, 2, 36, '03:00', NULL, NULL),
(81, 33, 10, 1, 2, 36, '03:00', NULL, NULL),
(82, 31, 10, 1, 2, 36, '03:00', NULL, NULL),
(83, 33, 10, 1, 2, 36, '03:00', NULL, NULL),
(84, 30, 10, 1, 2, 36, '03:00', NULL, NULL),
(85, 31, 10, 1, 2, 36, '03:00', NULL, NULL),
(86, 32, 10, 1, 2, 36, '03:00', NULL, NULL),
(87, 33, 10, 1, 2, 36, '03:00', NULL, NULL),
(88, 30, 10, 1, 2, 36, '03:00', NULL, NULL),
(89, 31, 10, 1, 2, 36, '03:00', NULL, NULL),
(90, 32, 10, 1, 2, 36, '03:00', NULL, NULL),
(91, 33, 10, 1, 2, 36, '03:00', NULL, NULL),
(92, 30, 10, 1, 2, 36, '03:00', NULL, NULL),
(93, 31, 10, 1, 2, 36, '03:00', NULL, NULL),
(94, 32, 10, 1, 2, 36, '03:00', NULL, NULL),
(95, 33, 10, 1, 2, 36, '03:00', NULL, NULL),
(96, 30, 10, 1, 2, 36, '03:00', NULL, NULL),
(97, 31, 10, 1, 2, 36, '03:00', NULL, NULL),
(98, 32, 10, 1, 2, 36, '03:00', NULL, NULL),
(99, 33, 10, 1, 2, 36, '03:00', NULL, NULL),
(100, 30, 10, 1, 2, 36, '03:00', NULL, NULL),
(101, 31, 10, 1, 2, 36, '03:00', NULL, NULL),
(102, 32, 10, 1, 2, 36, '03:00', NULL, NULL),
(103, 33, 10, 1, 2, 36, '03:00', NULL, NULL),
(108, 6, 11, 3, 2, 36, '03:00', NULL, NULL),
(109, 8, 11, 3, 2, 36, '03:00', NULL, NULL),
(110, 34, 11, 3, 2, 36, '03:00', NULL, NULL),
(111, 35, 11, 3, 2, 36, '03:00', NULL, NULL),
(112, 36, 11, 3, 2, 36, '03:00', NULL, NULL),
(113, 37, 11, 3, 2, 36, '03:00', NULL, NULL),
(114, 38, 11, 3, 2, 36, '03:00', NULL, NULL),
(115, 39, 11, 3, 2, 36, '03:00', NULL, NULL),
(116, 40, 11, 3, 2, 36, '03:00', NULL, NULL),
(117, 41, 11, 3, 2, 36, '03:00', NULL, NULL),
(118, 42, 11, 3, 2, 36, '03:00', NULL, NULL),
(119, 43, 11, 3, 2, 36, '03:00', NULL, NULL),
(120, 44, 11, 3, 2, 36, '03:00', NULL, NULL),
(121, 45, 11, 3, 2, 36, '03:00', NULL, NULL),
(122, 46, 11, 3, 2, 36, '03:00', NULL, NULL),
(123, 47, 11, 3, 2, 36, '03:00', NULL, NULL),
(124, 48, 11, 3, 2, 36, '03:00', NULL, NULL),
(125, 49, 11, 3, 2, 36, '03:00', NULL, NULL),
(126, 50, 11, 3, 2, 36, '03:00', NULL, NULL),
(127, 51, 11, 3, 2, 36, '03:00', NULL, NULL),
(128, 52, 11, 3, 2, 36, '03:00', NULL, NULL),
(129, 53, 11, 3, 2, 36, '03:00', NULL, NULL),
(130, 54, 11, 3, 2, 36, '03:00', NULL, NULL),
(131, 55, 11, 3, 2, 36, '03:00', NULL, NULL),
(132, 56, 11, 3, 2, 36, '03:00', NULL, NULL),
(133, 57, 11, 3, 2, 36, '03:00', NULL, NULL),
(134, 58, 11, 3, 2, 36, '03:00', NULL, NULL),
(135, 59, 11, 3, 2, 36, '03:00', NULL, NULL),
(136, 60, 11, 3, 2, 36, '03:00', NULL, NULL),
(137, 61, 11, 3, 2, 36, '03:00', NULL, NULL),
(138, 62, 11, 3, 2, 36, '03:00', NULL, NULL),
(139, 63, 11, 3, 2, 36, '03:00', NULL, NULL),
(140, 74, 12, 4, 2, 36, '12:00', NULL, NULL),
(141, 75, 12, 4, 2, 36, '12:00', NULL, NULL),
(142, 76, 12, 4, 2, 36, '12:00', NULL, NULL),
(143, 77, 12, 4, 2, 36, '12:00', NULL, NULL),
(144, 78, 12, 4, 2, 36, '12:00', NULL, NULL),
(145, 79, 12, 4, 2, 36, '12:00', NULL, NULL),
(146, 80, 12, 4, 2, 36, '12:00', NULL, NULL),
(147, 81, 12, 4, 2, 36, '12:00', NULL, NULL),
(148, 82, 12, 4, 2, 36, '12:00', NULL, NULL),
(149, 83, 12, 4, 2, 36, '12:00', NULL, NULL),
(150, 33, 10, 1, 2, 36, NULL, NULL, NULL),
(151, 31, 10, 1, 2, 36, NULL, NULL, NULL),
(152, 30, 10, 1, 2, 36, NULL, NULL, NULL),
(153, 32, 10, 1, 2, 36, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `attendance_plan_details`
--

CREATE TABLE `attendance_plan_details` (
  `id` int(11) NOT NULL,
  `work_appointment_id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `update_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attendance_plan_details`
--

INSERT INTO `attendance_plan_details` (`id`, `work_appointment_id`, `start_date`, `end_date`, `created_at`, `update_at`) VALUES
(2, 4, '2022-07-16', '2022-07-16', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `attendance_plan_types`
--

CREATE TABLE `attendance_plan_types` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attendance_plan_types`
--

INSERT INTO `attendance_plan_types` (`id`, `name`) VALUES
(1, 'runtime'),
(2, 'schedule');

-- --------------------------------------------------------

--
-- Table structure for table `attendance_settings`
--

CREATE TABLE `attendance_settings` (
  `id` bigint(20) NOT NULL,
  `branch_id` int(11) DEFAULT NULL,
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

INSERT INTO `attendance_settings` (`id`, `branch_id`, `allow_delay`, `automatic_leave`, `over_time_count`, `validate_finger`, `created_at`, `updated_at`) VALUES
(1, 2, 0, 1, NULL, 1, NULL, '2022-07-12 14:22:16'),
(19, 12, NULL, NULL, NULL, NULL, '2022-07-11 17:16:59', '2022-07-11 17:16:59'),
(20, 10, NULL, NULL, NULL, NULL, '2022-07-14 11:48:54', '2022-07-14 11:48:54'),
(21, 11, NULL, NULL, NULL, NULL, '2022-07-15 10:17:02', '2022-07-15 10:17:02'),
(22, 12, NULL, NULL, NULL, NULL, '2022-07-16 08:58:49', '2022-07-16 08:58:49'),
(23, 13, NULL, NULL, NULL, NULL, '2022-07-16 09:06:02', '2022-07-16 09:06:02');

-- --------------------------------------------------------

--
-- Table structure for table `attend_methods`
--

CREATE TABLE `attend_methods` (
  `id` bigint(20) NOT NULL,
  `name` varchar(191) DEFAULT NULL,
  `active` tinyint(1) DEFAULT '1',
  `notes` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attend_methods`
--

INSERT INTO `attend_methods` (`id`, `name`, `active`, `notes`, `created_at`, `updated_at`) VALUES
(2, 'finger print', 1, NULL, '2022-06-29 08:37:35', '2022-07-05 18:26:51'),
(3, 'face recognition', 1, NULL, '2022-07-05 18:26:27', '2022-07-05 18:26:27'),
(4, 'voice recogntion', 1, NULL, '2022-07-05 18:27:12', '2022-07-10 15:35:44');

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE `branches` (
  `id` bigint(20) NOT NULL,
  `name` varchar(191) NOT NULL,
  `phone` varchar(191) DEFAULT NULL,
  `address` varchar(191) DEFAULT NULL,
  `latitude` decimal(9,6) DEFAULT NULL,
  `longituide` decimal(9,6) DEFAULT NULL,
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

INSERT INTO `branches` (`id`, `name`, `phone`, `address`, `latitude`, `longituide`, `notes`, `created_at`, `updated_at`, `_lft`, `_rgt`, `parent_id`) VALUES
(2, 'smart village', '01011305995', '6 october', NULL, NULL, 'no', '2022-06-22 10:27:14', '2022-06-22 10:27:14', 1, 2, NULL),
(5, 'Giza', '01215487555', 'Giza', NULL, NULL, NULL, '2022-06-28 18:27:38', '2022-06-28 18:27:38', 3, 4, NULL),
(6, 'October', '012365985', 'October', NULL, NULL, NULL, '2022-06-28 18:28:02', '2022-06-28 18:28:02', 5, 6, NULL),
(7, 'Cairo', '0123212324', 'Cairo', NULL, NULL, NULL, '2022-06-28 18:28:28', '2022-06-28 18:28:28', 7, 8, NULL),
(8, 'testbranch', '01033', NULL, NULL, NULL, NULL, '2022-07-04 08:05:09', '2022-07-04 08:05:09', 9, 10, NULL),
(9, 'test category', '457868', NULL, NULL, NULL, NULL, '2022-07-04 08:07:31', '2022-07-04 08:07:31', 11, 12, NULL),
(10, 'test123', '01066018340', 'cairo', '-0.109177', '-0.129089', NULL, '2022-07-14 11:48:54', '2022-07-16 09:37:37', 13, 14, NULL),
(12, 'test', '01066018340', 'cairo', '30.130549', '31.515851', NULL, '2022-07-16 08:58:49', '2022-07-16 09:04:31', 15, 16, NULL),
(13, 'test5', '01066018340', 'cairo', '30.044400', '31.235700', NULL, '2022-07-16 09:06:01', '2022-07-16 09:06:01', 17, 18, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `branch_setting`
--

CREATE TABLE `branch_setting` (
  `id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `over_time_count` int(11) NOT NULL,
  `vication_days` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `branch_setting`
--

INSERT INTO `branch_setting` (`id`, `branch_id`, `over_time_count`, `vication_days`, `created_at`, `updated_at`) VALUES
(1, 2, 10, NULL, '2022-07-04 10:00:25', '2022-07-04 17:49:28'),
(2, 5, 0, NULL, '2022-07-04 10:00:25', '2022-07-04 10:00:25'),
(3, 6, 0, NULL, '2022-07-04 10:01:03', '2022-07-04 10:01:03'),
(4, 7, 0, NULL, '2022-07-04 10:01:14', '2022-07-04 10:01:14'),
(5, 9, 0, NULL, '2022-07-04 08:07:31', '2022-07-04 08:07:31'),
(8, 10, 0, NULL, '2022-07-14 11:48:54', '2022-07-14 11:48:54'),
(9, 11, 0, NULL, '2022-07-15 10:17:02', '2022-07-15 10:17:02'),
(10, 12, 0, NULL, '2022-07-16 08:58:49', '2022-07-16 08:58:49'),
(11, 13, 0, NULL, '2022-07-16 09:06:02', '2022-07-16 09:06:02');

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
  `plan_id` bigint(20) DEFAULT NULL,
  `registeration_date` date DEFAULT NULL,
  `email` varchar(191) DEFAULT NULL,
  `registeration_num` varchar(50) DEFAULT NULL,
  `phone` varchar(191) DEFAULT NULL,
  `phone_num2` varchar(11) DEFAULT NULL,
  `vication_days` varchar(255) DEFAULT NULL,
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

INSERT INTO `company_settings` (`id`, `name`, `plan_id`, `registeration_date`, `email`, `registeration_num`, `phone`, `phone_num2`, `vication_days`, `logo`, `background`, `ssid`, `mac_address`, `notes`, `created_at`, `updated_at`) VALUES
(1, 'atis company', 1, '2022-06-20', NULL, '1656720795564', NULL, 'nu', '7', NULL, NULL, '12354dd', 'fvhhbf4fv4Gngjbjnbg5', 'atis', '2022-06-22 09:20:28', '2022-07-18 12:10:21');

-- --------------------------------------------------------

--
-- Table structure for table `devices`
--

CREATE TABLE `devices` (
  `id` bigint(20) NOT NULL,
  `type` enum('becon','wifi') NOT NULL,
  `code` varchar(100) DEFAULT NULL,
  `ssid` varchar(200) DEFAULT NULL,
  `bssid` varchar(200) DEFAULT NULL,
  `location_id` int(30) NOT NULL,
  `notes` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `devices`
--

INSERT INTO `devices` (`id`, `type`, `code`, `ssid`, `bssid`, `location_id`, `notes`, `created_at`, `updated_at`) VALUES
(53, 'becon', '24231s', '', '', 36, NULL, NULL, NULL),
(54, 'wifi', '', 'TP-Link_015040', 'dsa2q42-fasfasf-r42424fas', 36, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` bigint(20) NOT NULL,
  `name` varchar(191) NOT NULL,
  `job_number` varchar(100) DEFAULT NULL,
  `email` varchar(191) DEFAULT NULL,
  `password` varchar(191) DEFAULT NULL,
  `phone` varchar(191) NOT NULL,
  `phone_num2` varchar(11) DEFAULT NULL,
  `address` varchar(191) DEFAULT NULL,
  `gender` enum('male','female') NOT NULL DEFAULT 'male',
  `age` bigint(20) DEFAULT NULL,
  `branch_id` bigint(20) DEFAULT NULL,
  `job_id` bigint(20) DEFAULT NULL,
  `active` int(11) NOT NULL DEFAULT '1',
  `locked` int(11) NOT NULL DEFAULT '1',
  `otp` varchar(191) DEFAULT NULL,
  `avatar` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `name`, `job_number`, `email`, `password`, `phone`, `phone_num2`, `address`, `gender`, `age`, `branch_id`, `job_id`, `active`, `locked`, `otp`, `avatar`, `created_at`, `updated_at`) VALUES
(1, 'mohamed', '3600', 'mtareq340@gmail.com', '123456789', '01011305995', NULL, 'abo sleem', 'male', 25, 2, 1, 1, 1, NULL, '', NULL, '2022-06-25 12:07:36'),
(3, 'moahamed magdy', '226688', 'magdy@gmail.com', '$2y$10$42suyc0J5NCxYhnCQWmNnejLPFTzQOacxxgAswjC.XgM7ij0SvW36', '01066018340', NULL, '1234 main ST', 'male', 20, 7, 1, 1, 0, NULL, '', '2022-06-29 06:33:01', '2022-07-19 10:59:44'),
(4, 'moahamed salah', '777755', 'salah@gmail.com', '$2y$10$42suyc0J5NCxYhnCQWmNnejLPFTzQOacxxgAswjC.XgM7ij0SvW36', '012154785522222', NULL, '1234 main ST', 'male', 25, 7, 1, 1, 1, NULL, '', '2022-06-29 06:33:01', '2022-06-29 07:52:41'),
(5, 'john doe', '123456', 'ex@ex.com', NULL, '0106601834', NULL, '1234 main st', 'male', 15, 5, 1, 1, 1, NULL, '', '2022-07-03 07:37:11', '2022-07-04 07:05:12'),
(6, 'join doe', '7864521', 'ex@gmail.com', NULL, '05102', NULL, '1234 main st', 'male', 20, 5, 3, 1, 0, NULL, '', '2022-07-03 07:40:06', '2022-07-05 05:18:02'),
(7, 'moahmed', '63354', NULL, NULL, '01066018340', NULL, NULL, 'male', NULL, 2, 1, 1, 1, NULL, '', '2022-07-03 09:40:37', '2022-07-03 09:40:37'),
(8, 'oraby', '777889955', 'oraby@gmail.com', NULL, '01066018340', NULL, NULL, 'male', NULL, 8, 3, 0, 1, NULL, '', '2022-07-05 22:47:42', '2022-07-11 17:24:18'),
(9, 'Nour', '3335', 'nour@nour.com', NULL, '01066018340', NULL, '1234 mona', 'female', 25, 6, 1, 1, 1, NULL, '', '2022-07-10 16:52:24', '2022-07-10 16:52:24'),
(10, 'mohammed ahmed', '321421', 'mohammed18200118@gmail.com', '$2y$10$vZTVTNulAAaMV8A6sLkDB.3oXIMAjclPDWAXcmlo4fI5MDRuBujwi', '4214214', NULL, 'address', 'male', NULL, 2, 1, 1, 1, NULL, '', '2022-07-12 21:28:26', '2022-07-12 21:28:26'),
(11, 'employee test', '21421', 't@t.com', NULL, '32124512421', NULL, NULL, 'male', NULL, 2, 1, 1, 1, NULL, '', '2022-07-12 21:29:52', '2022-07-12 21:29:52'),
(12, 'brad', '69933', 'brand@gmail.com', NULL, '0106601122', NULL, NULL, 'male', 20, 2, 1, 1, 1, NULL, NULL, '2022-07-19 07:30:31', '2022-07-19 07:30:31'),
(13, '13jto3QVvz', '89984', 'rBnsyHehnd@gmail.com', NULL, '71685423026', NULL, NULL, 'male', NULL, 2, 1, 1, 1, NULL, NULL, '2022-07-20 07:57:01', '2022-07-20 07:57:01'),
(14, 'Mr. Will Wuckert', '16770', 'myrtis58@example.com', NULL, '29723558744', NULL, NULL, 'male', NULL, 2, 1, 1, 1, NULL, NULL, '2022-07-20 08:21:10', '2022-07-20 08:21:10'),
(15, 'Julius Russel', '88609', 'skozey@example.net', NULL, '91147583344', NULL, NULL, 'male', NULL, 2, 1, 1, 1, NULL, NULL, '2022-07-20 08:21:10', '2022-07-20 08:21:10'),
(16, 'Marlene Macejkovic', '11972', 'juana.mertz@example.org', NULL, '95631034577', NULL, NULL, 'male', NULL, 2, 1, 1, 1, NULL, NULL, '2022-07-20 08:21:10', '2022-07-20 08:21:10'),
(17, 'Osborne Moore', '86114', 'garrison52@example.com', NULL, '97863692181', NULL, NULL, 'male', NULL, 2, 1, 1, 1, NULL, NULL, '2022-07-20 08:21:10', '2022-07-20 08:21:10'),
(18, 'Jayne Purdy', '11789', 'sipes.nigel@example.com', NULL, '76780723434', NULL, NULL, 'male', NULL, 2, 1, 1, 1, NULL, NULL, '2022-07-20 08:21:10', '2022-07-20 08:21:10'),
(19, 'Stephany Bogisich', '95394', 'wilma00@example.com', NULL, '26275335558', NULL, NULL, 'male', NULL, 2, 1, 1, 1, NULL, NULL, '2022-07-20 08:21:10', '2022-07-20 08:21:10'),
(20, 'Corbin Wiegand', '32347', 'julio90@example.org', NULL, '85610397778', NULL, NULL, 'male', NULL, 2, 1, 1, 1, NULL, NULL, '2022-07-20 08:21:10', '2022-07-20 08:21:10'),
(21, 'Jarrell Blanda', '21688', 'wwhite@example.org', NULL, '55792022154', NULL, NULL, 'male', NULL, 2, 1, 1, 1, NULL, NULL, '2022-07-20 08:21:10', '2022-07-20 08:21:10'),
(22, 'Mr. Chase Torphy', '36746', 'damaris.ortiz@example.net', NULL, '32955278916', NULL, NULL, 'male', NULL, 2, 1, 1, 1, NULL, NULL, '2022-07-20 08:21:10', '2022-07-20 08:21:10'),
(23, 'Miss Josianne Mayer', '23605', 'qkulas@example.org', NULL, '30088047840', NULL, NULL, 'male', NULL, 2, 1, 1, 1, NULL, NULL, '2022-07-20 08:21:10', '2022-07-20 08:21:10'),
(24, 'Tom VonRueden', '23105', 'telly.cole@example.net', NULL, '67400086265', NULL, NULL, 'male', NULL, 2, 1, 1, 1, NULL, NULL, '2022-07-20 08:21:10', '2022-07-20 08:21:10'),
(25, 'Miss Cora Schiller I', '76608', 'kemmer.jaiden@example.net', NULL, '24238259452', NULL, NULL, 'male', NULL, 2, 1, 1, 1, NULL, NULL, '2022-07-20 08:21:11', '2022-07-20 08:21:11'),
(26, 'Miss Cathy Wisoky', '36384', 'mckenzie82@example.com', NULL, '35052734120', NULL, NULL, 'male', NULL, 2, 1, 1, 1, NULL, NULL, '2022-07-20 08:21:11', '2022-07-20 08:21:11'),
(27, 'Alisha Koch V', '23849', 'aufderhar.casimir@example.com', NULL, '53174377781', NULL, NULL, 'male', NULL, 2, 1, 1, 1, NULL, NULL, '2022-07-20 08:21:11', '2022-07-20 08:21:11'),
(28, 'Lea Gerlach', '29735', 'bpouros@example.org', NULL, '89332866424', NULL, NULL, 'male', NULL, 2, 1, 1, 1, NULL, NULL, '2022-07-20 08:21:11', '2022-07-20 08:21:11'),
(29, 'Michele Willms', '56480', 'pkreiger@example.net', NULL, '57519567058', NULL, NULL, 'male', NULL, 2, 1, 1, 1, NULL, NULL, '2022-07-20 08:21:11', '2022-07-20 08:21:11'),
(30, 'Daryl Hayes Jr.', '69495', 'hirthe.dominique@example.org', NULL, '78994516367', NULL, NULL, 'male', NULL, 2, 1, 1, 1, NULL, NULL, '2022-07-20 08:21:11', '2022-07-20 08:21:11'),
(31, 'Quinn Gulgowski', '96646', 'cwisoky@example.org', NULL, '46230423098', NULL, NULL, 'male', NULL, 2, 1, 1, 1, NULL, NULL, '2022-07-20 08:21:11', '2022-07-20 08:21:11'),
(32, 'Prof. Enrico Heathcote IV', '53651', 'mueller.anne@example.com', NULL, '28332345194', NULL, NULL, 'male', NULL, 2, 1, 1, 1, NULL, NULL, '2022-07-20 08:21:11', '2022-07-20 08:21:11'),
(33, 'Dr. Valentine Stiedemann DDS', '33616', 'gheaney@example.org', NULL, '25479464771', NULL, NULL, 'male', NULL, 2, 1, 1, 1, NULL, NULL, '2022-07-20 08:21:11', '2022-07-20 08:21:11'),
(34, 'Mr. Tracey Schimmel', '90521', 'bryana.stoltenberg@example.org', NULL, '60422354627', NULL, NULL, 'male', NULL, 5, 3, 1, 1, NULL, NULL, '2022-07-20 08:22:38', '2022-07-20 08:22:38'),
(35, 'Rene Brakus', '77841', 'skiles.zelda@example.com', NULL, '15476587045', NULL, NULL, 'male', NULL, 5, 3, 1, 1, NULL, NULL, '2022-07-20 08:22:39', '2022-07-20 08:22:39'),
(36, 'Leda Nolan', '73176', 'claudie41@example.com', NULL, '24868037652', NULL, NULL, 'male', NULL, 5, 3, 1, 1, NULL, NULL, '2022-07-20 08:22:39', '2022-07-20 08:22:39'),
(37, 'Jake Gorczany', '12525', 'welch.pat@example.org', NULL, '85267557070', NULL, NULL, 'male', NULL, 5, 3, 1, 1, NULL, NULL, '2022-07-20 08:22:39', '2022-07-20 08:22:39'),
(38, 'Marilyne Bartell', '41999', 'bobbie55@example.net', NULL, '54695041584', NULL, NULL, 'male', NULL, 5, 3, 1, 1, NULL, NULL, '2022-07-20 08:22:39', '2022-07-20 08:22:39'),
(39, 'Lucy Zieme', '68398', 'baumbach.margarete@example.com', NULL, '91349262060', NULL, NULL, 'male', NULL, 5, 3, 1, 1, NULL, NULL, '2022-07-20 08:22:39', '2022-07-20 08:22:39'),
(40, 'Darrin Dickinson', '71341', 'carleton79@example.com', NULL, '80263992529', NULL, NULL, 'male', NULL, 5, 3, 1, 1, NULL, NULL, '2022-07-20 08:22:39', '2022-07-20 08:22:39'),
(41, 'Prof. Josue Greenholt Sr.', '76700', 'timmothy12@example.net', NULL, '40557389484', NULL, NULL, 'male', NULL, 5, 3, 1, 1, NULL, NULL, '2022-07-20 08:22:39', '2022-07-20 08:22:39'),
(42, 'Kayleigh Johnson', '57145', 'sipes.jillian@example.net', NULL, '92530728268', NULL, NULL, 'male', NULL, 5, 3, 1, 1, NULL, NULL, '2022-07-20 08:22:39', '2022-07-20 08:22:39'),
(43, 'Bruce Pagac', '27112', 'grover89@example.com', NULL, '51798351834', NULL, NULL, 'male', NULL, 5, 3, 1, 1, NULL, NULL, '2022-07-20 08:22:39', '2022-07-20 08:22:39'),
(44, 'Cletus Pfeffer Jr.', '27269', 'jeromy.denesik@example.org', NULL, '88259348858', NULL, NULL, 'male', NULL, 6, 3, 1, 1, NULL, NULL, '2022-07-20 08:23:05', '2022-07-20 08:23:05'),
(45, 'Dr. Jaylon Jerde II', '31726', 'verda.little@example.com', NULL, '86069392804', NULL, NULL, 'male', NULL, 6, 3, 1, 1, NULL, NULL, '2022-07-20 08:23:07', '2022-07-20 08:23:07'),
(46, 'Ivah Baumbach', '62595', 'vlesch@example.com', NULL, '64906612054', NULL, NULL, 'male', NULL, 6, 3, 1, 1, NULL, NULL, '2022-07-20 08:23:07', '2022-07-20 08:23:07'),
(47, 'Jed Lakin', '33559', 'breana57@example.org', NULL, '72762320799', NULL, NULL, 'male', NULL, 6, 3, 1, 1, NULL, NULL, '2022-07-20 08:23:07', '2022-07-20 08:23:07'),
(48, 'Rosalind Gulgowski', '13294', 'cecelia.murphy@example.org', NULL, '34646726573', NULL, NULL, 'male', NULL, 6, 3, 1, 1, NULL, NULL, '2022-07-20 08:23:07', '2022-07-20 08:23:07'),
(49, 'Prof. Chase Pfannerstill I', '47399', 'lind.elnora@example.com', NULL, '78996913660', NULL, NULL, 'male', NULL, 6, 3, 1, 1, NULL, NULL, '2022-07-20 08:23:07', '2022-07-20 08:23:07'),
(50, 'Dr. Shanny Torphy', '75920', 'ugulgowski@example.org', NULL, '99844487305', NULL, NULL, 'male', NULL, 6, 3, 1, 1, NULL, NULL, '2022-07-20 08:23:07', '2022-07-20 08:23:07'),
(51, 'Terence Crona', '65617', 'maida.mertz@example.com', NULL, '37593609088', NULL, NULL, 'male', NULL, 6, 3, 1, 1, NULL, NULL, '2022-07-20 08:23:07', '2022-07-20 08:23:07'),
(52, 'Sandrine Armstrong', '48735', 'velva.ohara@example.net', NULL, '48277678866', NULL, NULL, 'male', NULL, 6, 3, 1, 1, NULL, NULL, '2022-07-20 08:23:07', '2022-07-20 08:23:07'),
(53, 'Pauline Lind', '13363', 'bradford.mitchell@example.com', NULL, '24566572990', NULL, NULL, 'male', NULL, 6, 3, 1, 1, NULL, NULL, '2022-07-20 08:23:07', '2022-07-20 08:23:07'),
(54, 'Frieda McKenzie MD', '80618', 'hellen35@example.org', NULL, '82887712320', NULL, NULL, 'male', NULL, 7, 3, 1, 1, NULL, NULL, '2022-07-20 08:23:28', '2022-07-20 08:23:28'),
(55, 'Shannon Botsford', '12019', 'effertz.krista@example.net', NULL, '57235260208', NULL, NULL, 'male', NULL, 7, 3, 1, 1, NULL, NULL, '2022-07-20 08:23:28', '2022-07-20 08:23:28'),
(56, 'Xander Mitchell', '42781', 'perdman@example.net', NULL, '49346463329', NULL, NULL, 'male', NULL, 7, 3, 1, 1, NULL, NULL, '2022-07-20 08:23:28', '2022-07-20 08:23:28'),
(57, 'Dr. Ulices Gerlach V', '68767', 'maxwell68@example.net', NULL, '60453867796', NULL, NULL, 'male', NULL, 7, 3, 1, 1, NULL, NULL, '2022-07-20 08:23:28', '2022-07-20 08:23:28'),
(58, 'Prof. Troy Prosacco DVM', '54403', 'rosetta.kris@example.org', NULL, '21617885638', NULL, NULL, 'male', NULL, 7, 3, 1, 1, NULL, NULL, '2022-07-20 08:23:28', '2022-07-20 08:23:28'),
(59, 'Odie Cronin', '34365', 'koelpin.alexa@example.org', NULL, '89049894013', NULL, NULL, 'male', NULL, 7, 3, 1, 1, NULL, NULL, '2022-07-20 08:23:28', '2022-07-20 08:23:28'),
(60, 'Naomie Kreiger', '86740', 'donnie.gusikowski@example.com', NULL, '58694121781', NULL, NULL, 'male', NULL, 7, 3, 1, 1, NULL, NULL, '2022-07-20 08:23:28', '2022-07-20 08:23:28'),
(61, 'Marilou Marvin', '26857', 'satterfield.chesley@example.net', NULL, '19707794068', NULL, NULL, 'male', NULL, 7, 3, 1, 1, NULL, NULL, '2022-07-20 08:23:28', '2022-07-20 08:23:28'),
(62, 'Prof. Johnnie Jacobson', '21420', 'ron19@example.org', NULL, '72852050647', NULL, NULL, 'male', NULL, 7, 3, 1, 1, NULL, NULL, '2022-07-20 08:23:28', '2022-07-20 08:23:28'),
(63, 'Virgie Nicolas', '43103', 'koconnell@example.com', NULL, '79415141153', NULL, NULL, 'male', NULL, 7, 3, 1, 1, NULL, NULL, '2022-07-20 08:23:28', '2022-07-20 08:23:28'),
(64, 'Nyah Considine', '48056', 'hintz.raymundo@example.org', NULL, '48261054353', NULL, NULL, 'male', NULL, 7, 3, 1, 1, NULL, NULL, '2022-07-20 09:39:09', '2022-07-20 09:39:09'),
(65, 'Miss Lessie Farrell Sr.', '28571', 'cbosco@example.net', NULL, '18775395599', NULL, NULL, 'male', NULL, 7, 3, 1, 1, NULL, NULL, '2022-07-20 09:39:09', '2022-07-20 09:39:09'),
(66, 'Lisa Kreiger', '74413', 'rreichel@example.com', NULL, '27121893879', NULL, NULL, 'male', NULL, 7, 3, 1, 1, NULL, NULL, '2022-07-20 09:39:09', '2022-07-20 09:39:09'),
(67, 'Miss Rosalind Davis PhD', '11850', 'aufderhar.maryam@example.org', NULL, '15409166313', NULL, NULL, 'male', NULL, 7, 3, 1, 1, NULL, NULL, '2022-07-20 09:39:09', '2022-07-20 09:39:09'),
(68, 'Aurore Wilderman III', '70118', 'winnifred75@example.net', NULL, '32876382792', NULL, NULL, 'male', NULL, 7, 3, 1, 1, NULL, NULL, '2022-07-20 09:39:10', '2022-07-20 09:39:10'),
(69, 'Nellie Kshlerin', '61296', 'padberg.allan@example.net', NULL, '93610785328', NULL, NULL, 'male', NULL, 7, 3, 1, 1, NULL, NULL, '2022-07-20 09:39:10', '2022-07-20 09:39:10'),
(70, 'Alanis Wilkinson', '45682', 'von.elisha@example.org', NULL, '32482364044', NULL, NULL, 'male', NULL, 7, 3, 1, 1, NULL, NULL, '2022-07-20 09:39:10', '2022-07-20 09:39:10'),
(71, 'Rosalind Robel', '68762', 'wilfred.grady@example.org', NULL, '56564883682', NULL, NULL, 'male', NULL, 7, 3, 1, 1, NULL, NULL, '2022-07-20 09:39:10', '2022-07-20 09:39:10'),
(72, 'Ms. Ines Hyatt', '53607', 'alejandra.swaniawski@example.com', NULL, '85294674617', NULL, NULL, 'male', NULL, 7, 3, 1, 1, NULL, NULL, '2022-07-20 09:39:10', '2022-07-20 09:39:10'),
(73, 'Terrence Flatley', '54423', 'nelson.casper@example.org', NULL, '91566124946', NULL, NULL, 'male', NULL, 7, 3, 1, 1, NULL, NULL, '2022-07-20 09:39:10', '2022-07-20 09:39:10'),
(74, 'Jasmin Nolan', '97144', 'bfeeney@example.net', NULL, '93863571250', NULL, NULL, 'male', NULL, 7, 4, 1, 1, NULL, NULL, '2022-07-20 09:40:42', '2022-07-20 09:40:42'),
(75, 'Alvena Dietrich', '31729', 'delores.kreiger@example.org', NULL, '93760824742', NULL, NULL, 'male', NULL, 7, 4, 1, 1, NULL, NULL, '2022-07-20 09:40:42', '2022-07-20 09:40:42'),
(76, 'Savion Little', '34976', 'lstoltenberg@example.org', NULL, '44056295717', NULL, NULL, 'male', NULL, 7, 4, 1, 1, NULL, NULL, '2022-07-20 09:40:42', '2022-07-20 09:40:42'),
(77, 'Alexa Kozey I', '83268', 'vspinka@example.com', NULL, '25946123325', NULL, NULL, 'male', NULL, 7, 4, 1, 1, NULL, NULL, '2022-07-20 09:40:42', '2022-07-20 09:40:42'),
(78, 'Triston Lowe', '50392', 'bernhard46@example.net', NULL, '54026935558', NULL, NULL, 'male', NULL, 7, 4, 1, 1, NULL, NULL, '2022-07-20 09:40:42', '2022-07-20 09:40:42'),
(79, 'Kari Bartell', '30068', 'julian12@example.net', NULL, '89838697761', NULL, NULL, 'male', NULL, 7, 4, 1, 1, NULL, NULL, '2022-07-20 09:40:42', '2022-07-20 09:40:42'),
(80, 'Ada Stiedemann', '95069', 'cremin.arvilla@example.org', NULL, '75072169194', NULL, NULL, 'male', NULL, 7, 4, 1, 1, NULL, NULL, '2022-07-20 09:40:42', '2022-07-20 09:40:42'),
(81, 'Myron Maggio IV', '30796', 'veda.rolfson@example.com', NULL, '83173632686', NULL, NULL, 'male', NULL, 7, 4, 1, 1, NULL, NULL, '2022-07-20 09:40:42', '2022-07-20 09:40:42'),
(82, 'Vernice Runolfsdottir', '52177', 'rath.petra@example.org', NULL, '13649851442', NULL, NULL, 'male', NULL, 7, 4, 1, 1, NULL, NULL, '2022-07-20 09:40:42', '2022-07-20 09:40:42'),
(83, 'Prof. Hardy Gutmann', '38199', 'roberts.rowan@example.org', NULL, '74994570297', NULL, NULL, 'male', NULL, 7, 4, 1, 1, NULL, NULL, '2022-07-20 09:40:42', '2022-07-20 09:40:42');

-- --------------------------------------------------------

--
-- Table structure for table `employees_departure`
--

CREATE TABLE `employees_departure` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `branch_id` int(11) DEFAULT NULL,
  `appointment_id` int(11) DEFAULT NULL,
  `state` tinyint(1) NOT NULL DEFAULT '1',
  `reason` varchar(255) DEFAULT NULL,
  `user_name` varchar(50) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `period` enum('1','2') NOT NULL,
  `overtime_minutes_diff` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `employee_attendance`
--

CREATE TABLE `employee_attendance` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `branch_id` int(11) NOT NULL,
  `appointment_id` int(11) DEFAULT NULL,
  `state` tinyint(1) DEFAULT '0',
  `reason` varchar(250) DEFAULT NULL,
  `period` enum('1','2') NOT NULL,
  `user_name` varchar(50) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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

--
-- Dumping data for table `employee_attend_methods`
--

INSERT INTO `employee_attend_methods` (`id`, `employee_id`, `attend_method_id`, `created_at`, `updated_at`) VALUES
(98, 1, 3, NULL, NULL),
(99, 3, 3, NULL, NULL),
(102, 6, 3, NULL, NULL),
(103, 7, 3, NULL, NULL),
(104, 8, 3, NULL, NULL),
(105, 9, 3, NULL, NULL),
(108, 4, 3, NULL, NULL),
(109, 4, 4, NULL, NULL),
(110, 4, 2, NULL, NULL),
(111, 5, 3, NULL, NULL),
(114, 10, 2, NULL, NULL),
(115, 10, 4, NULL, NULL),
(116, 11, 2, NULL, NULL),
(117, 11, 4, NULL, NULL),
(118, 54, 2, NULL, NULL),
(119, 54, 3, NULL, NULL),
(120, 54, 4, NULL, NULL),
(121, 61, 3, NULL, NULL),
(122, 61, 4, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `employee_requests`
--

CREATE TABLE `employee_requests` (
  `id` bigint(20) NOT NULL,
  `employee_id` bigint(20) NOT NULL,
  `user_id` int(11) NOT NULL,
  `request_type_id` int(11) NOT NULL,
  `request` varchar(191) NOT NULL,
  `date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employee_requests`
--

INSERT INTO `employee_requests` (`id`, `employee_id`, `user_id`, `request_type_id`, `request`, `date`, `created_at`, `updated_at`) VALUES
(1, 1, 30, 3, 'Your trusted resource for learning new technologies.\r\n\r\n', '2022-06-29', '2022-06-29 16:03:45', '2022-06-29 16:03:45'),
(2, 1, 30, 3, 'test', '2022-06-29', '2022-06-29 16:08:20', '2022-06-29 16:08:20'),
(3, 1, 30, 2, 'test 3', '2022-06-29', '2022-06-29 16:09:24', '2022-06-29 16:09:24'),
(4, 1, 30, 3, 'test4', '2022-06-29', '2022-06-29 16:12:22', '2022-06-29 16:12:22'),
(5, 1, 30, 3, 'test5', '2022-06-29', '2022-06-29 17:38:21', '2022-06-29 17:38:21'),
(6, 3, 30, 2, 'ldfjie dldoeok ', '2022-07-15', '2022-07-03 18:41:40', '2022-07-03 18:41:40'),
(7, 1, 30, 3, 'dkdld dkldkdld ', '2022-07-13', '2022-07-04 05:11:44', '2022-07-04 05:11:44'),
(8, 3, 30, 2, 'adkaflk adfdjk ', '2022-07-13', '2022-07-05 13:53:58', '2022-07-05 13:53:58'),
(9, 4, 30, 3, 'Need 2 Days Off', '2022-07-15', '2022-07-12 15:55:15', '2022-07-12 15:55:15'),
(10, 1, 30, 2, 'need bones', '2022-07-12', '2022-07-12 15:59:10', '2022-07-12 15:59:10'),
(11, 1, 30, 2, 'need bones', '2022-07-12', '2022-07-12 16:06:20', '2022-07-12 16:06:20'),
(12, 1, 30, 3, 'need bones', '2022-07-12', '2022-07-13 07:02:51', '2022-07-13 07:02:51');

-- --------------------------------------------------------

--
-- Table structure for table `employee_request_review`
--

CREATE TABLE `employee_request_review` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `request` varchar(255) NOT NULL,
  `attachment` varchar(255) DEFAULT NULL,
  `details` varchar(255) NOT NULL,
  `status` enum('1','2','3') NOT NULL DEFAULT '1',
  `date` datetime NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
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
(1, 'engineers', NULL, NULL, NULL),
(3, 'workers', NULL, '2022-07-05 05:17:42', '2022-07-05 05:17:42'),
(4, 'doctors', NULL, NULL, NULL),
(5, 'teachers', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `id` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `location_address` varchar(255) NOT NULL,
  `boundary_radius` varchar(255) NOT NULL,
  `location_latitude` decimal(8,6) NOT NULL,
  `location_longituide` decimal(9,6) NOT NULL,
  `branch_id` int(11) DEFAULT NULL,
  `notes` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`id`, `name`, `location_address`, `boundary_radius`, `location_latitude`, `location_longituide`, `branch_id`, `notes`, `created_at`, `updated_at`) VALUES
(36, 'sphinx-company', 'king faisal street', '500', '30.044521', '31.237245', 2, NULL, '2022-07-20 09:09:38', '2022-07-20 09:09:38');

-- --------------------------------------------------------

--
-- Table structure for table `login_histories`
--

CREATE TABLE `login_histories` (
  `id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `ip` varchar(191) NOT NULL,
  `datetime` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `details` varchar(191) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `login_histories`
--

INSERT INTO `login_histories` (`id`, `user_id`, `ip`, `datetime`, `created_at`, `updated_at`, `details`) VALUES
(1, 30, '127.0.0.1', '2022-07-05 05:27:07', '2022-07-05 05:27:07', '2022-07-05 05:27:07', '{\"device\":\"WebKit\",\"platform\":\"Windows\",\"browser\":\"Edge\"}'),
(2, 30, '127.0.0.1', '2022-07-05 18:24:48', '2022-07-05 18:24:48', '2022-07-05 18:24:48', '{\"device\":\"WebKit\",\"platform\":\"Windows\",\"browser\":\"Chrome\"}'),
(3, 30, '127.0.0.1', '2022-07-05 21:12:51', '2022-07-05 21:12:51', '2022-07-05 21:12:51', '{\"device\":\"WebKit\",\"platform\":\"Windows\",\"browser\":\"Chrome\"}'),
(4, 30, '127.0.0.1', '2022-07-05 23:16:41', '2022-07-05 23:16:41', '2022-07-05 23:16:41', '{\"device\":\"WebKit\",\"platform\":\"Windows\",\"browser\":\"Chrome\"}'),
(5, 33, '127.0.0.1', '2022-07-05 23:17:48', '2022-07-05 23:17:48', '2022-07-05 23:17:48', '{\"device\":\"WebKit\",\"platform\":\"Windows\",\"browser\":\"Chrome\"}'),
(6, 30, '127.0.0.1', '2022-07-06 00:21:39', '2022-07-06 00:21:39', '2022-07-06 00:21:39', '{\"device\":\"WebKit\",\"platform\":\"Windows\",\"browser\":\"Chrome\"}'),
(7, 30, '127.0.0.1', '2022-07-06 04:26:49', '2022-07-06 04:26:49', '2022-07-06 04:26:49', '{\"device\":\"WebKit\",\"platform\":\"Windows\",\"browser\":\"Chrome\"}'),
(8, 33, '127.0.0.1', '2022-07-06 07:38:56', '2022-07-06 07:38:56', '2022-07-06 07:38:56', '{\"device\":\"WebKit\",\"platform\":\"Windows\",\"browser\":\"Chrome\"}'),
(9, 30, '127.0.0.1', '2022-07-06 07:39:03', '2022-07-06 07:39:03', '2022-07-06 07:39:03', '{\"device\":\"WebKit\",\"platform\":\"Windows\",\"browser\":\"Chrome\"}'),
(10, 30, '127.0.0.1', '2022-07-06 07:52:54', '2022-07-06 07:52:54', '2022-07-06 07:52:54', '{\"device\":\"WebKit\",\"platform\":\"Windows\",\"browser\":\"Chrome\"}'),
(11, 34, '127.0.0.1', '2022-07-06 07:53:59', '2022-07-06 07:53:59', '2022-07-06 07:53:59', '{\"device\":\"WebKit\",\"platform\":\"Windows\",\"browser\":\"Chrome\"}'),
(12, 30, '127.0.0.1', '2022-07-06 08:08:32', '2022-07-06 08:08:32', '2022-07-06 08:08:32', '{\"device\":\"WebKit\",\"platform\":\"Windows\",\"browser\":\"Chrome\"}'),
(13, 30, '127.0.0.1', '2022-07-10 10:54:44', '2022-07-10 10:54:44', '2022-07-10 10:54:44', '{\"device\":\"WebKit\",\"platform\":\"Windows\",\"browser\":\"Chrome\"}'),
(14, 30, '127.0.0.1', '2022-07-10 22:50:07', '2022-07-10 22:50:07', '2022-07-10 22:50:07', '{\"device\":\"WebKit\",\"platform\":\"Windows\",\"browser\":\"Chrome\"}'),
(15, 30, '127.0.0.1', '2022-07-11 10:25:26', '2022-07-11 10:25:26', '2022-07-11 10:25:26', '{\"device\":\"WebKit\",\"platform\":\"Windows\",\"browser\":\"Chrome\"}'),
(16, 30, '127.0.0.1', '2022-07-11 13:36:21', '2022-07-11 13:36:21', '2022-07-11 13:36:21', '{\"device\":\"WebKit\",\"platform\":\"Windows\",\"browser\":\"Chrome\"}'),
(17, 30, '127.0.0.1', '2022-07-11 14:10:11', '2022-07-11 14:10:11', '2022-07-11 14:10:11', '{\"device\":\"WebKit\",\"platform\":\"Windows\",\"browser\":\"Chrome\"}'),
(18, 30, '127.0.0.1', '2022-07-11 14:11:28', '2022-07-11 14:11:28', '2022-07-11 14:11:28', '{\"device\":\"WebKit\",\"platform\":\"Windows\",\"browser\":\"Chrome\"}'),
(19, 30, '127.0.0.1', '2022-07-11 14:22:24', '2022-07-11 14:22:24', '2022-07-11 14:22:24', '{\"device\":\"WebKit\",\"platform\":\"Windows\",\"browser\":\"Chrome\"}'),
(20, 30, '127.0.0.1', '2022-07-11 14:36:08', '2022-07-11 14:36:08', '2022-07-11 14:36:08', '{\"device\":\"WebKit\",\"platform\":\"Windows\",\"browser\":\"Chrome\"}'),
(21, 30, '127.0.0.1', '2022-07-11 14:42:49', '2022-07-11 14:42:49', '2022-07-11 14:42:49', '{\"device\":\"WebKit\",\"platform\":\"Windows\",\"browser\":\"Chrome\"}'),
(22, 30, '127.0.0.1', '2022-07-11 14:47:21', '2022-07-11 14:47:21', '2022-07-11 14:47:21', '{\"device\":\"WebKit\",\"platform\":\"Windows\",\"browser\":\"Chrome\"}'),
(23, 30, '127.0.0.1', '2022-07-11 14:49:14', '2022-07-11 14:49:14', '2022-07-11 14:49:14', '{\"device\":\"WebKit\",\"platform\":\"Windows\",\"browser\":\"Chrome\"}'),
(24, 30, '127.0.0.1', '2022-07-11 15:05:11', '2022-07-11 15:05:11', '2022-07-11 15:05:11', '{\"device\":\"WebKit\",\"platform\":\"Windows\",\"browser\":\"Chrome\"}'),
(25, 30, '127.0.0.1', '2022-07-11 15:07:13', '2022-07-11 15:07:13', '2022-07-11 15:07:13', '{\"device\":\"WebKit\",\"platform\":\"Windows\",\"browser\":\"Chrome\"}'),
(26, 30, '127.0.0.1', '2022-07-11 15:10:34', '2022-07-11 15:10:34', '2022-07-11 15:10:34', '{\"device\":\"WebKit\",\"platform\":\"Windows\",\"browser\":\"Chrome\"}'),
(27, 30, '127.0.0.1', '2022-07-11 15:17:44', '2022-07-11 15:17:44', '2022-07-11 15:17:44', '{\"device\":\"WebKit\",\"platform\":\"Windows\",\"browser\":\"Chrome\"}'),
(28, 30, '127.0.0.1', '2022-07-11 15:18:56', '2022-07-11 15:18:56', '2022-07-11 15:18:56', '{\"device\":\"WebKit\",\"platform\":\"Windows\",\"browser\":\"Chrome\"}'),
(29, 30, '127.0.0.1', '2022-07-11 15:27:48', '2022-07-11 15:27:48', '2022-07-11 15:27:48', '{\"device\":\"WebKit\",\"platform\":\"Windows\",\"browser\":\"Chrome\"}'),
(30, 30, '127.0.0.1', '2022-07-11 15:28:47', '2022-07-11 15:28:47', '2022-07-11 15:28:47', '{\"device\":\"WebKit\",\"platform\":\"Windows\",\"browser\":\"Chrome\"}'),
(31, 30, '127.0.0.1', '2022-07-11 15:30:06', '2022-07-11 15:30:06', '2022-07-11 15:30:06', '{\"device\":\"WebKit\",\"platform\":\"Windows\",\"browser\":\"Chrome\"}'),
(32, 30, '127.0.0.1', '2022-07-11 15:58:42', '2022-07-11 15:58:42', '2022-07-11 15:58:42', '{\"device\":\"WebKit\",\"platform\":\"Windows\",\"browser\":\"Chrome\"}'),
(33, 30, '127.0.0.1', '2022-07-11 16:04:59', '2022-07-11 16:04:59', '2022-07-11 16:04:59', '{\"device\":\"WebKit\",\"platform\":\"Windows\",\"browser\":\"Chrome\"}'),
(34, 30, '127.0.0.1', '2022-07-12 07:43:05', '2022-07-12 07:43:05', '2022-07-12 07:43:05', '{\"device\":\"WebKit\",\"platform\":\"Windows\",\"browser\":\"Chrome\"}'),
(35, 30, '127.0.0.1', '2022-07-12 07:53:05', '2022-07-12 07:53:05', '2022-07-12 07:53:05', '{\"device\":\"WebKit\",\"platform\":\"Windows\",\"browser\":\"Chrome\"}'),
(36, 30, '127.0.0.1', '2022-07-12 07:56:03', '2022-07-12 07:56:03', '2022-07-12 07:56:03', '{\"device\":\"WebKit\",\"platform\":\"Windows\",\"browser\":\"Chrome\"}'),
(37, 30, '127.0.0.1', '2022-07-12 08:56:08', '2022-07-12 08:56:08', '2022-07-12 08:56:08', '{\"device\":\"WebKit\",\"platform\":\"Windows\",\"browser\":\"Chrome\"}'),
(38, 30, '127.0.0.1', '2022-07-12 08:56:53', '2022-07-12 08:56:53', '2022-07-12 08:56:53', '{\"device\":\"WebKit\",\"platform\":\"Windows\",\"browser\":\"Chrome\"}'),
(39, 30, '127.0.0.1', '2022-07-12 09:03:03', '2022-07-12 09:03:03', '2022-07-12 09:03:03', '{\"device\":\"WebKit\",\"platform\":\"Windows\",\"browser\":\"Chrome\"}'),
(40, 30, '127.0.0.1', '2022-07-12 09:09:41', '2022-07-12 09:09:41', '2022-07-12 09:09:41', '{\"device\":\"WebKit\",\"platform\":\"Windows\",\"browser\":\"Chrome\"}'),
(41, 30, '127.0.0.1', '2022-07-12 09:33:51', '2022-07-12 09:33:51', '2022-07-12 09:33:51', '{\"device\":\"WebKit\",\"platform\":\"Windows\",\"browser\":\"Chrome\"}'),
(42, 30, '127.0.0.1', '2022-07-12 09:47:39', '2022-07-12 09:47:39', '2022-07-12 09:47:39', '{\"device\":\"WebKit\",\"platform\":\"Windows\",\"browser\":\"Chrome\"}'),
(43, 30, '127.0.0.1', '2022-07-12 09:48:08', '2022-07-12 09:48:08', '2022-07-12 09:48:08', '{\"device\":\"WebKit\",\"platform\":\"Windows\",\"browser\":\"Chrome\"}'),
(44, 30, '127.0.0.1', '2022-07-12 09:48:25', '2022-07-12 09:48:25', '2022-07-12 09:48:25', '{\"device\":\"WebKit\",\"platform\":\"Windows\",\"browser\":\"Chrome\"}'),
(45, 30, '127.0.0.1', '2022-07-12 09:49:42', '2022-07-12 09:49:42', '2022-07-12 09:49:42', '{\"device\":\"WebKit\",\"platform\":\"Windows\",\"browser\":\"Chrome\"}'),
(46, 30, '127.0.0.1', '2022-07-12 09:50:31', '2022-07-12 09:50:31', '2022-07-12 09:50:31', '{\"device\":\"WebKit\",\"platform\":\"Windows\",\"browser\":\"Chrome\"}'),
(47, 30, '127.0.0.1', '2022-07-12 11:13:44', '2022-07-12 11:13:44', '2022-07-12 11:13:44', '{\"device\":\"WebKit\",\"platform\":\"Windows\",\"browser\":\"Chrome\"}'),
(48, 30, '127.0.0.1', '2022-07-12 11:32:20', '2022-07-12 11:32:20', '2022-07-12 11:32:20', '{\"device\":\"WebKit\",\"platform\":\"Windows\",\"browser\":\"Edge\"}'),
(49, 30, '127.0.0.1', '2022-07-12 22:56:03', '2022-07-12 22:56:03', '2022-07-12 22:56:03', '{\"device\":\"WebKit\",\"platform\":\"Windows\",\"browser\":\"Chrome\"}'),
(50, 30, '127.0.0.1', '2022-07-13 03:43:47', '2022-07-13 03:43:47', '2022-07-13 03:43:47', '{\"device\":\"WebKit\",\"platform\":\"Windows\",\"browser\":\"Chrome\"}'),
(51, 30, '127.0.0.1', '2022-07-13 06:48:39', '2022-07-13 06:48:39', '2022-07-13 06:48:39', '{\"device\":\"WebKit\",\"platform\":\"Windows\",\"browser\":\"Chrome\"}'),
(52, 30, '127.0.0.1', '2022-07-14 11:46:05', '2022-07-14 11:46:05', '2022-07-14 11:46:05', '{\"device\":\"WebKit\",\"platform\":\"Windows\",\"browser\":\"Chrome\"}'),
(53, 30, '127.0.0.1', '2022-07-14 15:26:12', '2022-07-14 15:26:12', '2022-07-14 15:26:12', '{\"device\":\"WebKit\",\"platform\":\"Windows\",\"browser\":\"Chrome\"}'),
(54, 33, '127.0.0.1', '2022-07-14 20:17:36', '2022-07-14 20:17:36', '2022-07-14 20:17:36', '{\"device\":\"WebKit\",\"platform\":\"Windows\",\"browser\":\"Chrome\"}'),
(55, 30, '127.0.0.1', '2022-07-14 20:26:32', '2022-07-14 20:26:32', '2022-07-14 20:26:32', '{\"device\":\"WebKit\",\"platform\":\"Windows\",\"browser\":\"Chrome\"}'),
(56, 30, '127.0.0.1', '2022-07-15 05:48:29', '2022-07-15 05:48:29', '2022-07-15 05:48:29', '{\"device\":\"WebKit\",\"platform\":\"Windows\",\"browser\":\"Chrome\"}'),
(57, 30, '127.0.0.1', '2022-07-15 13:48:09', '2022-07-15 13:48:09', '2022-07-15 13:48:09', '{\"device\":\"WebKit\",\"platform\":\"Windows\",\"browser\":\"Chrome\"}'),
(58, 30, '127.0.0.1', '2022-07-16 19:52:59', '2022-07-16 19:52:59', '2022-07-16 19:52:59', '{\"device\":\"WebKit\",\"platform\":\"Windows\",\"browser\":\"Chrome\"}'),
(59, 30, '127.0.0.1', '2022-07-17 02:47:45', '2022-07-17 02:47:45', '2022-07-17 02:47:45', '{\"device\":\"WebKit\",\"platform\":\"Windows\",\"browser\":\"Chrome\"}'),
(60, 30, '127.0.0.1', '2022-07-17 07:56:35', '2022-07-17 07:56:35', '2022-07-17 07:56:35', '{\"device\":\"WebKit\",\"platform\":\"Windows\",\"browser\":\"Chrome\"}'),
(61, 30, '127.0.0.1', '2022-07-18 22:36:35', '2022-07-18 22:36:35', '2022-07-18 22:36:35', '{\"device\":\"WebKit\",\"platform\":\"Windows\",\"browser\":\"Chrome\"}'),
(62, 30, '127.0.0.1', '2022-07-19 06:38:55', '2022-07-19 06:38:55', '2022-07-19 06:38:55', '{\"device\":\"WebKit\",\"platform\":\"Windows\",\"browser\":\"Chrome\"}'),
(63, 30, '127.0.0.1', '2022-07-20 08:25:36', '2022-07-20 08:25:36', '2022-07-20 08:25:36', '{\"device\":\"WebKit\",\"platform\":\"Windows\",\"browser\":\"Chrome\"}');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(127, 'show_plans', 'Show Plans', NULL, NULL, NULL),
(128, 'make_response', 'Make Response to Employees', NULL, NULL, NULL),
(129, 'active_employee', 'Active & Unlock Employees', NULL, NULL, NULL),
(130, 'show_employee_attendance_and_deartures', 'Show Employee Attendance & Departure', NULL, NULL, NULL);

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
(44, 1),
(1, 2),
(2, 2),
(3, 2),
(4, 2),
(8, 2),
(9, 2),
(10, 2),
(11, 2),
(12, 2),
(13, 2),
(14, 2),
(15, 2),
(16, 2),
(17, 2),
(18, 2),
(19, 2),
(20, 2),
(21, 2),
(22, 2),
(23, 2),
(24, 2),
(25, 2),
(26, 2),
(27, 2),
(28, 2),
(29, 2),
(30, 2),
(31, 2),
(32, 2),
(33, 2),
(34, 2),
(35, 2),
(36, 2),
(37, 2),
(38, 2),
(39, 2),
(40, 2),
(41, 2),
(42, 2),
(43, 2),
(44, 2),
(124, 2),
(125, 2),
(126, 2),
(127, 2),
(1, 3),
(2, 3),
(3, 3),
(4, 3),
(8, 3),
(9, 3),
(10, 3),
(11, 3),
(12, 3),
(13, 3),
(14, 3),
(15, 3),
(16, 3),
(17, 3),
(18, 3),
(19, 3),
(20, 3),
(21, 3),
(22, 3),
(23, 3),
(24, 3),
(25, 3),
(26, 3),
(27, 3),
(28, 3),
(29, 3),
(30, 3),
(31, 3),
(32, 3),
(33, 3),
(34, 3),
(35, 3),
(36, 3),
(37, 3),
(38, 3),
(39, 3),
(40, 3),
(41, 3),
(42, 3),
(43, 3),
(44, 3),
(124, 3),
(125, 3),
(126, 3),
(127, 3),
(127, 1),
(128, 1),
(129, 1),
(130, 1),
(131, 1),
(132, 1),
(133, 1);

-- --------------------------------------------------------

--
-- Table structure for table `plans`
--

CREATE TABLE `plans` (
  `id` bigint(20) NOT NULL,
  `name` varchar(191) NOT NULL,
  `count_employees` bigint(20) NOT NULL,
  `price` float NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `number_days` bigint(20) NOT NULL,
  `description` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `plans`
--

INSERT INTO `plans` (`id`, `name`, `count_employees`, `price`, `start_date`, `end_date`, `number_days`, `description`, `created_at`, `updated_at`) VALUES
(2, 'advanced plan', 400, 2000, '2022-07-11', '2022-08-11', 30, 'advanced plan', '2022-06-26 06:41:28', '2022-07-11 15:30:06');

-- --------------------------------------------------------

--
-- Table structure for table `registered_employees_attendance_methods`
--

CREATE TABLE `registered_employees_attendance_methods` (
  `id` int(30) NOT NULL,
  `employee_id` int(20) NOT NULL,
  `attend_mthod_id` int(20) NOT NULL,
  `plan_id` int(20) NOT NULL,
  `location_id` int(20) NOT NULL,
  `attendance_id` int(30) NOT NULL,
  `state` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `registered_employees_departure_methods`
--

CREATE TABLE `registered_employees_departure_methods` (
  `id` int(30) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `attend_mthod_id` int(11) NOT NULL,
  `plan_id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL,
  `departure_id` int(11) NOT NULL,
  `state` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `request_type`
--

CREATE TABLE `request_type` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `note` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `request_type`
--

INSERT INTO `request_type` (`id`, `name`, `note`, `created_at`, `updated_at`) VALUES
(1, 'pending', NULL, '2022-07-12 17:09:22', '2022-07-12 17:09:22'),
(2, 'reject', 'Reject Request', '2022-06-29 17:06:40', '2022-06-29 17:06:40'),
(3, 'accept', NULL, '2022-06-29 15:07:09', '2022-07-10 16:48:42');

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
(1, 'super_admin', NULL, '2022-06-25 10:35:06', '2022-06-25 10:35:06'),
(2, 'admin', NULL, '2022-06-28 18:24:07', '2022-06-28 18:24:07'),
(3, 'manager', NULL, '2022-06-28 18:24:42', '2022-06-28 18:24:42');

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
(31, 1, 'App\\User'),
(32, 2, 'App\\User'),
(33, 2, 'App\\User'),
(34, 2, 'App\\User');

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
  `active` int(11) NOT NULL DEFAULT '1',
  `locked` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `address`, `email`, `phone`, `password`, `role_id`, `branch_id`, `active`, `locked`, `created_at`, `updated_at`) VALUES
(30, 'superadmin', 'Giza', 'superadmin@admin.com', '012244455555', '$2y$10$FdqJLp.Gugyo9zSP7c.LaOAjfWoydGJ90YzI0Sl44GYrWsclwsPf2', 1, 2, 1, 1, '2022-06-25 13:22:13', '2022-06-25 13:22:13'),
(32, 'admin1', 'Giza', 'admin1@admin.com', '01212121232541', '$2y$10$m4rcTgRYFcjYRALvS2Ki7OElTXS3Hck9PApNz0xzPNRaR1aFbUVS6', 2, 5, 1, 1, '2022-06-28 18:27:09', '2022-06-28 18:35:00'),
(33, 'admin', '123 main St', 'admin@admin.com', '01066018340', '$2y$10$S2fyuh5zMoNcPw3OVLxAj.frwxVwmHnjbWbIJ8ign6DL98mi3fl.a', 2, 5, 1, 1, '2022-07-05 23:17:31', '2022-07-05 23:17:31'),
(34, 'admin2', '1234 main st', 'Admin2@admin.com', '01066018340', '$2y$10$8EZeV6ytTRr/Lwf6wrfSZOelw9iATSzkMBElkRoXQ9R0MiNAcHMrW', 2, 5, 1, 1, '2022-07-06 07:53:46', '2022-07-06 07:53:46');

-- --------------------------------------------------------

--
-- Table structure for table `vications`
--

CREATE TABLE `vications` (
  `id` int(11) NOT NULL,
  `week_day_id` int(11) NOT NULL,
  `attendance_setting_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vications`
--

INSERT INTO `vications` (`id`, `week_day_id`, `attendance_setting_id`) VALUES
(8, 1, 1),
(9, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `week_days`
--

CREATE TABLE `week_days` (
  `id` int(11) NOT NULL,
  `days` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_At` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `week_days`
--

INSERT INTO `week_days` (`id`, `days`, `created_at`, `updated_At`) VALUES
(1, 'Saturday', '2022-07-03 12:58:17', '2022-07-03 12:58:17'),
(2, 'Sunday', '2022-07-03 12:58:17', '2022-07-03 12:58:17'),
(3, 'Monday', '2022-07-03 12:59:53', '2022-07-03 12:59:53'),
(4, 'Tuesday ', '2022-07-03 12:59:53', '2022-07-03 12:59:53'),
(5, 'Wednesday', '2022-07-03 13:00:26', '2022-07-03 13:00:26'),
(6, 'Thursday', '2022-07-03 13:00:26', '2022-07-03 13:00:26'),
(7, 'Friday', '2022-07-03 13:00:40', '2022-07-03 13:00:40');

-- --------------------------------------------------------

--
-- Table structure for table `work_appointments`
--

CREATE TABLE `work_appointments` (
  `id` bigint(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `attendance_plan_type_id` int(11) DEFAULT NULL,
  `attendance_days` varchar(50) NOT NULL,
  `attendance_repeat` int(1) NOT NULL DEFAULT '1',
  `location_id` bigint(20) NOT NULL,
  `start_from_period_1` time DEFAULT NULL,
  `end_to_period_1` time DEFAULT NULL,
  `start_from_period_2` time DEFAULT NULL,
  `end_to_period_2` time DEFAULT NULL,
  `delay_period_1` time DEFAULT NULL,
  `delay_period_2` time DEFAULT NULL,
  `branch_id` bigint(20) NOT NULL,
  `overtime` varchar(50) DEFAULT NULL,
  `date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `work_appointments`
--

INSERT INTO `work_appointments` (`id`, `name`, `attendance_plan_type_id`, `attendance_days`, `attendance_repeat`, `location_id`, `start_from_period_1`, `end_to_period_1`, `start_from_period_2`, `end_to_period_2`, `delay_period_1`, `delay_period_2`, `branch_id`, `overtime`, `date`, `created_at`, `updated_at`) VALUES
(10, 'attendance plan for engineers', 1, '1,2,3,4,5,6', 1, 36, '09:00:00', '16:00:00', NULL, NULL, '00:20:00', NULL, 2, '03:00', '2022-07-20', '2022-07-20 09:25:12', '2022-07-20 09:43:27'),
(11, 'attendance plan for workers', 1, '1,2,3,4,5,6', 1, 36, '08:25:00', '13:30:00', NULL, NULL, '00:30:00', NULL, 2, '03:00', '2022-07-27', '2022-07-20 09:27:53', '2022-07-20 09:27:53'),
(12, 'attendance plan for doctors', 2, '1,2,3,4,5,6', 1, 36, '09:00:00', '16:00:00', NULL, NULL, '00:15:00', NULL, 2, '12:00', '2022-07-27', '2022-07-20 09:43:00', '2022-07-20 09:43:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assign_appointments`
--
ALTER TABLE `assign_appointments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendance_plan_details`
--
ALTER TABLE `attendance_plan_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendance_plan_types`
--
ALTER TABLE `attendance_plan_types`
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
-- Indexes for table `branch_setting`
--
ALTER TABLE `branch_setting`
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
-- Indexes for table `employees_departure`
--
ALTER TABLE `employees_departure`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee_attendance`
--
ALTER TABLE `employee_attendance`
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
-- Indexes for table `employee_request_review`
--
ALTER TABLE `employee_request_review`
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
-- Indexes for table `login_histories`
--
ALTER TABLE `login_histories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
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
-- Indexes for table `registered_employees_attendance_methods`
--
ALTER TABLE `registered_employees_attendance_methods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `registered_employees_departure_methods`
--
ALTER TABLE `registered_employees_departure_methods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `request_type`
--
ALTER TABLE `request_type`
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
-- Indexes for table `vications`
--
ALTER TABLE `vications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `week_days`
--
ALTER TABLE `week_days`
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
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=154;

--
-- AUTO_INCREMENT for table `attendance_plan_details`
--
ALTER TABLE `attendance_plan_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `attendance_plan_types`
--
ALTER TABLE `attendance_plan_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `attendance_settings`
--
ALTER TABLE `attendance_settings`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `attend_methods`
--
ALTER TABLE `attend_methods`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `branch_setting`
--
ALTER TABLE `branch_setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

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
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `employees_departure`
--
ALTER TABLE `employees_departure`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `employee_attendance`
--
ALTER TABLE `employee_attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `employee_attend_methods`
--
ALTER TABLE `employee_attend_methods`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123;

--
-- AUTO_INCREMENT for table `employee_requests`
--
ALTER TABLE `employee_requests`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `employee_request_review`
--
ALTER TABLE `employee_request_review`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `login_histories`
--
ALTER TABLE `login_histories`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;

--
-- AUTO_INCREMENT for table `plans`
--
ALTER TABLE `plans`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `registered_employees_attendance_methods`
--
ALTER TABLE `registered_employees_attendance_methods`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `registered_employees_departure_methods`
--
ALTER TABLE `registered_employees_departure_methods`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `request_type`
--
ALTER TABLE `request_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `vications`
--
ALTER TABLE `vications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `week_days`
--
ALTER TABLE `week_days`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `work_appointments`
--
ALTER TABLE `work_appointments`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;
