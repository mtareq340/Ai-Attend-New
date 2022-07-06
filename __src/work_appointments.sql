-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 06, 2022 at 08:09 AM
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
-- Table structure for table `work_appointments`
--

CREATE TABLE `work_appointments` (
  `id` bigint(20) NOT NULL,
  `name` varchar(50) NOT NULL,
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

INSERT INTO `work_appointments` (`id`, `name`, `attendance_repeat`, `location_id`, `start_from_period_1`, `end_to_period_1`, `start_from_period_2`, `end_to_period_2`, `delay_period_1`, `delay_period_2`, `branch_id`, `overtime`, `date`, `created_at`, `updated_at`) VALUES
(31, 'appointment name test', 1, 3, '07:51:00', '19:51:00', NULL, NULL, '00:15:00', NULL, 2, '05:00', '2022-09-24', '2022-07-06 03:52:02', '2022-07-06 03:52:02'),
(32, 'appointment name', 1, 3, '08:05:00', '20:04:00', NULL, NULL, '00:15:00', NULL, 2, '05:00', '2022-08-13', '2022-07-06 04:05:13', '2022-07-06 04:05:13'),
(33, 'two periods test', 1, 3, '08:05:00', '20:05:00', NULL, NULL, '00:15:00', NULL, 2, '05:00', '2022-08-20', '2022-07-06 04:06:07', '2022-07-06 04:06:07');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `work_appointments`
--
ALTER TABLE `work_appointments`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `work_appointments`
--
ALTER TABLE `work_appointments`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
COMMIT;
