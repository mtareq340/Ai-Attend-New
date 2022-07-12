-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 12, 2022 at 03:01 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

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
-- Table structure for table `appointment_device`
--

CREATE TABLE `appointment_device` (
  `id` int(11) NOT NULL,
  `appointment_id` int(11) NOT NULL,
  `device_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `appointment_device`
--

INSERT INTO `appointment_device` (`id`, `appointment_id`, `device_id`) VALUES
(7, 1, 21),
(8, 1, 22),
(9, 1, 23),
(10, 1, 24),
(11, 1, 25),
(12, 34, 4);

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

--
-- Dumping data for table `assign_appointments`
--

INSERT INTO `assign_appointments` (`id`, `employee_id`, `work_appointment_id`, `job_id`, `branch_id`, `location_id`, `created_at`, `updated_at`) VALUES
(2, 1, 25, 1, 2, 3, NULL, NULL),
(3, 3, 25, 1, 2, 3, NULL, NULL),
(4, 4, 25, 1, 2, 3, NULL, NULL),
(5, 5, 25, 1, 2, 3, NULL, NULL),
(6, 7, 25, 1, 2, 3, NULL, NULL),
(7, 5, 34, 1, 5, 2, NULL, NULL),
(8, 6, 34, 3, 5, 2, NULL, NULL);

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
(1, 2, 0, 1, NULL, 1, NULL, '2022-07-04 10:57:06'),
(19, 12, NULL, NULL, NULL, NULL, '2022-07-11 17:16:59', '2022-07-11 17:16:59');

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
(2, 'smart village', '01011305995', '6 october', 'no', '2022-06-22 10:27:14', '2022-06-22 10:27:14', 1, 2, NULL),
(5, 'Giza', '01215487555', 'Giza', NULL, '2022-06-28 18:27:38', '2022-06-28 18:27:38', 3, 4, NULL),
(6, 'October', '012365985', 'October', NULL, '2022-06-28 18:28:02', '2022-06-28 18:28:02', 5, 6, NULL),
(7, 'Cairo', '0123212324', 'Cairo', NULL, '2022-06-28 18:28:28', '2022-06-28 18:28:28', 7, 8, NULL),
(8, 'testbranch', '01033', NULL, NULL, '2022-07-04 08:05:09', '2022-07-04 08:05:09', 9, 10, NULL),
(9, 'test category', '457868', NULL, NULL, '2022-07-04 08:07:31', '2022-07-04 08:07:31', 11, 12, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `branch_setting`
--

CREATE TABLE `branch_setting` (
  `id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `over_time_count` int(11) NOT NULL,
  `vication_days` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
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
(7, 11, 0, NULL, '2022-07-11 16:14:18', '2022-07-11 16:14:18');

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
(1, 'atis company', 1, '2022-06-20', NULL, '1656720795564', NULL, 'nu', '7', 'logo.jpg', NULL, '12354dd', 'fvhhbf4fv4Gngjbjnbg5', 'atis', '2022-06-22 09:20:28', '2022-07-11 14:22:24');

-- --------------------------------------------------------

--
-- Table structure for table `devices`
--

CREATE TABLE `devices` (
  `id` bigint(20) NOT NULL,
  `name` varchar(191) NOT NULL,
  `code` varchar(100) NOT NULL,
  `active` tinyint(1) DEFAULT NULL,
  `notes` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `devices`
--

INSERT INTO `devices` (`id`, `name`, `code`, `active`, `notes`, `created_at`, `updated_at`) VALUES
(1, 'Mohamed Tarek', 'IS668', 1, 'dfbgnhm', '2022-06-21 05:15:14', '2022-07-10 15:05:42'),
(4, 'becon', 'Cs22', 1, NULL, '2022-07-04 19:51:02', '2022-07-10 15:05:27');

-- --------------------------------------------------------

--
-- Table structure for table `devices_to_locations`
--

CREATE TABLE `devices_to_locations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `device_id` bigint(20) NOT NULL,
  `location_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `devices_to_locations`
--

INSERT INTO `devices_to_locations` (`id`, `device_id`, `location_id`) VALUES
(1, 1, 3),
(2, 1, 4),
(3, 3, 4),
(4, 4, 4),
(5, 1, 2),
(6, 4, 2),
(7, 4, 5);

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
  `active` int(11) NOT NULL DEFAULT 1,
  `locked` int(11) NOT NULL DEFAULT 1,
  `otp` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `name`, `job_number`, `email`, `password`, `phone`, `phone_num2`, `address`, `gender`, `age`, `branch_id`, `job_id`, `active`, `locked`, `otp`, `created_at`, `updated_at`) VALUES
(1, 'mohamed', '', 'mtareq340@gmail.com', '123456789', '01011305995', NULL, 'abo sleem', 'male', 25, 2, 1, 1, 1, NULL, NULL, '2022-06-25 12:07:36'),
(3, 'moahamed magdy', '', 'magdy@gmail.com', '$2y$10$42suyc0J5NCxYhnCQWmNnejLPFTzQOacxxgAswjC.XgM7ij0SvW36', '01066018340', NULL, '1234 main ST', 'male', 20, 7, 1, 1, 0, NULL, '2022-06-29 06:33:01', '2022-07-03 10:02:56'),
(4, 'moahamed salah', '', 'salah@gmail.com', '$2y$10$42suyc0J5NCxYhnCQWmNnejLPFTzQOacxxgAswjC.XgM7ij0SvW36', '012154785522222', NULL, '1234 main ST', 'male', 25, 7, 1, 1, 1, NULL, '2022-06-29 06:33:01', '2022-06-29 07:52:41'),
(5, 'john doe', '123456', 'ex@ex.com', NULL, '0106601834', NULL, '1234 main st', 'male', 15, 5, 1, 1, 1, NULL, '2022-07-03 07:37:11', '2022-07-04 07:05:12'),
(6, 'join doe', '7864521', 'ex@gmail.com', NULL, '05102', NULL, '1234 main st', 'male', 20, 5, 3, 1, 0, NULL, '2022-07-03 07:40:06', '2022-07-05 05:18:02'),
(7, 'moahmed', '', NULL, NULL, '01066018340', NULL, NULL, 'male', NULL, 2, 1, 1, 1, NULL, '2022-07-03 09:40:37', '2022-07-03 09:40:37'),
(8, 'oraby', '777889955', 'oraby@gmail.com', NULL, '01066018340', NULL, NULL, 'male', NULL, 8, 3, 0, 1, NULL, '2022-07-05 22:47:42', '2022-07-11 17:24:18'),
(9, 'Nour', '3335', 'nour@nour.com', NULL, '01066018340', NULL, '1234 mona', 'female', 25, 6, 1, 1, 1, NULL, '2022-07-10 16:52:24', '2022-07-10 16:52:24');

-- --------------------------------------------------------

--
-- Table structure for table `employee_attendance`
--

CREATE TABLE `employee_attendance` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `branch_id` int(11) NOT NULL,
  `attendance_method_id` int(11) NOT NULL,
  `states` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employee_attendance`
--

INSERT INTO `employee_attendance` (`id`, `employee_id`, `branch_id`, `attendance_method_id`, `states`, `created_at`, `updated_at`) VALUES
(12, 1, 2, 4, 1, '2022-07-11 01:13:56', '2022-07-11 01:13:56'),
(13, 3, 2, 4, 1, '2022-07-11 01:13:56', '2022-07-11 01:13:56'),
(14, 4, 2, 4, 1, '2022-07-11 01:13:56', '2022-07-11 01:13:56'),
(15, 5, 2, 4, 1, '2022-07-11 01:13:56', '2022-07-11 01:13:56'),
(16, 6, 2, 4, 1, '2022-07-11 01:13:56', '2022-07-11 01:13:56'),
(17, 7, 2, 4, 1, '2022-07-11 01:13:56', '2022-07-11 01:13:56'),
(18, 3, 2, 2, 1, '2022-07-11 01:14:21', '2022-07-11 01:14:21'),
(19, 4, 2, 2, 1, '2022-07-11 01:14:21', '2022-07-11 01:14:21'),
(20, 5, 2, 2, 1, '2022-07-11 01:14:21', '2022-07-11 01:14:21'),
(21, 6, 2, 2, 1, '2022-07-11 01:14:21', '2022-07-11 01:14:21'),
(22, 8, 2, 2, 1, '2022-07-11 01:14:21', '2022-07-11 01:14:21');

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
(110, 4, 2, NULL, NULL);

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
(8, 3, 30, 2, 'adkaflk adfdjk ', '2022-07-13', '2022-07-05 13:53:58', '2022-07-05 13:53:58');

-- --------------------------------------------------------

--
-- Table structure for table `employee_request_review`
--

CREATE TABLE `employee_request_review` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `request` varchar(255) NOT NULL,
  `date` datetime NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employee_request_review`
--

INSERT INTO `employee_request_review` (`id`, `employee_id`, `request`, `date`, `created_at`, `updated_at`) VALUES
(9, 4, 'Need 2 Days Off', '2022-07-15 08:05:43', '2022-07-03 06:08:25', '2022-07-03 06:08:25');

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
(3, 'job test', NULL, '2022-07-05 05:17:42', '2022-07-05 05:17:42');

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
  `branch_id` int(11) DEFAULT NULL,
  `notes` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`id`, `name`, `location_address`, `distance`, `location_latitude`, `location_longituide`, `branch_id`, `notes`, `created_at`, `updated_at`) VALUES
(1, 'Giza location', '123 main AT', '100', '30.014082', '31.482892', 2, NULL, '2022-06-29 06:56:21', '2022-06-29 06:56:21'),
(2, 'water fall', '1234 main ST', '150', '29.934973', '30.921903', 5, NULL, '2022-06-29 06:57:08', '2022-06-29 06:57:08'),
(5, 'test', '123 main AT', '100', '30.042022', '30.963788', 7, NULL, '2022-07-06 09:22:01', '2022-07-06 09:22:01');

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
(33, 30, '127.0.0.1', '2022-07-11 16:04:59', '2022-07-11 16:04:59', '2022-07-11 16:04:59', '{\"device\":\"WebKit\",\"platform\":\"Windows\",\"browser\":\"Chrome\"}');

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
(130, 'show_employee_attendance', 'Show Employee Attendance', NULL, NULL, NULL),
(131, 'add_employee_attendance', 'Add Employee Attendance', NULL, NULL, NULL),
(132, 'edit_employee_attendance', 'Edit Employee Attendance', NULL, NULL, NULL),
(133, 'delete_employee_attendance', 'Delete Employee Attendance', NULL, NULL, NULL);

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
-- Table structure for table `request_type`
--

CREATE TABLE `request_type` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `note` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `request_type`
--

INSERT INTO `request_type` (`id`, `name`, `note`, `created_at`, `updated_at`) VALUES
(2, 'Reject', 'Reject Request', '2022-06-29 17:06:40', '2022-06-29 17:06:40'),
(3, 'Accept', NULL, '2022-06-29 15:07:09', '2022-07-10 16:48:42');

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
  `active` int(11) NOT NULL DEFAULT 1,
  `locked` int(11) NOT NULL DEFAULT 1,
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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_At` timestamp NOT NULL DEFAULT current_timestamp()
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
  `attendance_repeat` int(1) NOT NULL DEFAULT 1,
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

INSERT INTO `work_appointments` (`id`, `name`, `attendance_repeat`, `location_id`, `start_from_period_1`, `end_to_period_1`, `start_from_period_2`, `end_to_period_2`, `delay_period_1`, `delay_period_2`, `branch_id`, `overtime`, `date`, `created_at`, `updated_at`) VALUES
(31, 'appointment name test', 1, 3, '07:51:00', '19:51:00', NULL, NULL, '00:15:00', NULL, 2, '05:00', '2022-09-24', '2022-07-06 03:52:02', '2022-07-06 03:52:02'),
(32, 'appointment name', 1, 3, '08:05:00', '20:04:00', NULL, NULL, '00:15:00', NULL, 2, '05:00', '2022-08-13', '2022-07-06 04:05:13', '2022-07-06 04:05:13'),
(33, 'two periods test', 1, 3, '08:05:00', '20:05:00', NULL, NULL, '00:15:00', NULL, 2, '05:00', '2022-08-20', '2022-07-06 04:06:07', '2022-07-06 04:06:07'),
(34, 'Sphinks Appointment', 1, 2, '12:09:00', '15:08:00', NULL, NULL, '12:00:00', NULL, 5, '12:00', '2022-07-21', '2022-07-06 08:04:46', '2022-07-06 08:04:46');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointment_device`
--
ALTER TABLE `appointment_device`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `devices_to_locations`
--
ALTER TABLE `devices_to_locations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
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
-- AUTO_INCREMENT for table `appointment_device`
--
ALTER TABLE `appointment_device`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `assign_appointments`
--
ALTER TABLE `assign_appointments`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `attendance_settings`
--
ALTER TABLE `attendance_settings`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `attend_methods`
--
ALTER TABLE `attend_methods`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `branch_setting`
--
ALTER TABLE `branch_setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

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
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `devices_to_locations`
--
ALTER TABLE `devices_to_locations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `employee_attendance`
--
ALTER TABLE `employee_attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `employee_attend_methods`
--
ALTER TABLE `employee_attend_methods`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT for table `employee_requests`
--
ALTER TABLE `employee_requests`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `employee_request_review`
--
ALTER TABLE `employee_request_review`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `login_histories`
--
ALTER TABLE `login_histories`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=134;

--
-- AUTO_INCREMENT for table `plans`
--
ALTER TABLE `plans`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `request_type`
--
ALTER TABLE `request_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
