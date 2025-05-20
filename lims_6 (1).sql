-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 18, 2025 at 12:12 PM
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
-- Database: `lims_6`
--

-- --------------------------------------------------------

--
-- Table structure for table `field_samples`
--

CREATE TABLE `field_samples` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2019_09_15_000010_create_tenants_table', 2),
(3, '2024_10_11_010813_create_roles_table', 3),
(4, '2024_10_11_010819_create_sections_table', 4),
(5, '2024_10_11_010828_create_permissions_table', 5),
(6, '2025_04_27_004945_create_subscriptions_table', 6),
(7, '2025_04_27_005132_create_test_methods_table', 7),
(8, '2025_04_27_005310_create_test_method_items_table', 8),
(9, '2025_05_05_192845_create_units_table', 9),
(10, '2025_05_05_192852_create_result_types_table', 9),
(11, '2025_05_08_103100_create_plants_table', 10),
(12, '2025_05_08_103255_create_plant_samples_table', 10),
(13, '2025_05_13_125527_create_samples_table', 11),
(14, '2025_05_13_130111_create_sample_test_methods_table', 11),
(15, '2025_05_13_130151_create_field_samples_table', 11);

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `section_id` bigint(20) UNSIGNED NOT NULL,
  `allow` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `role_id`, `section_id`, `allow`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 1, '2025-05-08 07:24:02', '2025-05-08 07:24:02'),
(2, 2, 2, 1, '2025-05-08 07:24:02', '2025-05-08 07:24:02'),
(3, 2, 3, 1, '2025-05-08 07:24:02', '2025-05-08 07:24:02'),
(4, 2, 4, 1, '2025-05-08 07:24:02', '2025-05-08 07:24:02'),
(5, 2, 5, 1, '2025-05-08 07:24:02', '2025-05-08 07:24:02'),
(6, 2, 6, 1, '2025-05-08 07:24:02', '2025-05-08 07:24:02'),
(7, 2, 7, 1, '2025-05-08 07:24:02', '2025-05-08 07:24:02'),
(8, 2, 8, 1, '2025-05-08 07:24:02', '2025-05-08 07:24:02'),
(9, 2, 9, 1, '2025-05-08 07:24:02', '2025-05-08 07:24:02'),
(10, 2, 10, 1, '2025-05-08 07:24:02', '2025-05-08 07:24:02'),
(11, 2, 11, 1, '2025-05-08 07:24:02', '2025-05-08 07:24:02'),
(12, 2, 12, 1, '2025-05-08 07:24:02', '2025-05-08 07:24:02'),
(13, 2, 13, 1, '2025-05-08 07:24:02', '2025-05-08 07:24:02'),
(14, 2, 14, 1, '2025-05-08 07:24:02', '2025-05-08 07:24:02'),
(15, 2, 15, 1, '2025-05-08 07:24:02', '2025-05-08 07:24:02'),
(16, 2, 16, 1, '2025-05-08 07:24:02', '2025-05-08 07:24:02'),
(17, 2, 17, 1, '2025-05-08 07:24:02', '2025-05-08 07:24:02'),
(18, 2, 18, 1, '2025-05-08 07:24:02', '2025-05-08 07:24:02'),
(19, 2, 19, 1, '2025-05-08 07:24:02', '2025-05-08 07:24:02'),
(20, 2, 20, 1, '2025-05-08 07:24:02', '2025-05-08 07:24:02'),
(21, 2, 21, 1, '2025-05-08 07:24:02', '2025-05-08 07:24:02'),
(22, 2, 22, 1, '2025-05-08 07:24:02', '2025-05-08 07:24:02'),
(23, 2, 23, 1, '2025-05-08 07:24:02', '2025-05-08 07:24:02'),
(24, 2, 24, 1, '2025-05-08 07:24:02', '2025-05-08 07:24:02'),
(25, 2, 25, 1, '2025-05-08 07:24:02', '2025-05-08 07:24:02'),
(26, 2, 26, 1, '2025-05-08 07:24:02', '2025-05-08 07:24:02'),
(27, 2, 27, 1, '2025-05-08 07:24:02', '2025-05-08 07:24:02'),
(28, 2, 28, 1, '2025-05-08 07:24:02', '2025-05-08 07:24:02'),
(29, 2, 29, 1, '2025-05-08 07:24:02', '2025-05-08 07:24:02'),
(30, 2, 30, 1, '2025-05-08 07:24:02', '2025-05-08 07:24:02'),
(31, 2, 31, 1, '2025-05-08 07:24:02', '2025-05-08 07:24:02'),
(32, 2, 32, 1, '2025-05-08 07:24:02', '2025-05-08 07:24:02'),
(33, 2, 33, 1, '2025-05-08 07:24:02', '2025-05-08 07:24:02'),
(34, 2, 34, 1, '2025-05-08 07:24:02', '2025-05-08 07:24:02'),
(35, 2, 35, 1, '2025-05-08 07:24:02', '2025-05-08 07:24:02'),
(36, 2, 36, 1, '2025-05-08 07:24:02', '2025-05-08 07:24:02'),
(37, 2, 37, 1, '2025-05-08 07:25:03', '2025-05-08 07:25:03'),
(38, 2, 38, 1, '2025-05-08 07:25:03', '2025-05-08 07:25:03'),
(39, 2, 39, 1, '2025-05-08 07:25:03', '2025-05-08 07:25:03'),
(40, 2, 40, 1, '2025-05-08 07:25:03', '2025-05-08 07:25:03'),
(41, 2, 41, 1, '2025-05-08 07:25:03', '2025-05-08 07:25:03'),
(42, 2, 42, 1, '2025-05-08 07:25:03', '2025-05-08 07:25:03'),
(43, 2, 43, 1, '2025-05-08 07:25:03', '2025-05-08 07:25:03'),
(44, 2, 44, 1, '2025-05-08 07:25:03', '2025-05-08 07:25:03'),
(45, 2, 45, 1, '2025-05-08 07:25:03', '2025-05-08 07:25:03'),
(46, 2, 46, 1, '2025-05-08 07:25:03', '2025-05-08 07:25:03'),
(47, 2, 47, 1, '2025-05-08 07:25:03', '2025-05-08 07:25:03'),
(48, 2, 48, 1, '2025-05-08 07:25:03', '2025-05-08 07:25:03'),
(108, 2, 1, 1, NULL, NULL),
(109, 2, 2, 1, NULL, NULL),
(110, 2, 3, 1, NULL, NULL),
(111, 2, 4, 1, NULL, NULL),
(112, 2, 5, 1, NULL, NULL),
(113, 2, 6, 1, NULL, NULL),
(114, 2, 7, 1, NULL, NULL),
(115, 2, 8, 1, NULL, NULL),
(116, 2, 9, 1, NULL, NULL),
(117, 2, 10, 1, NULL, NULL),
(118, 2, 11, 1, NULL, NULL),
(119, 2, 12, 1, NULL, NULL),
(120, 2, 13, 1, NULL, NULL),
(121, 2, 14, 1, NULL, NULL),
(122, 2, 15, 1, NULL, NULL),
(123, 2, 16, 1, NULL, NULL),
(124, 2, 17, 1, NULL, NULL),
(125, 2, 18, 1, NULL, NULL),
(126, 2, 19, 1, NULL, NULL),
(127, 2, 20, 1, NULL, NULL),
(128, 2, 21, 1, NULL, NULL),
(129, 2, 22, 1, NULL, NULL),
(130, 2, 23, 1, NULL, NULL),
(131, 2, 24, 1, NULL, NULL),
(132, 2, 25, 1, NULL, NULL),
(133, 2, 26, 1, NULL, NULL),
(134, 2, 27, 1, NULL, NULL),
(135, 2, 28, 1, NULL, NULL),
(136, 2, 29, 1, NULL, NULL),
(137, 2, 30, 1, NULL, NULL),
(138, 2, 31, 1, NULL, NULL),
(139, 2, 32, 1, NULL, NULL),
(140, 2, 33, 1, NULL, NULL),
(141, 2, 34, 1, NULL, NULL),
(142, 2, 35, 1, NULL, NULL),
(143, 2, 36, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `plants`
--

CREATE TABLE `plants` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `plant_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `plants`
--

INSERT INTO `plants` (`id`, `name`, `plant_id`, `created_at`, `updated_at`) VALUES
(10, 'A', NULL, '2025-05-11 06:37:52', '2025-05-11 06:37:52'),
(16, 'B', 10, '2025-05-11 08:21:10', '2025-05-11 08:21:10'),
(17, 'Plant A', NULL, '2025-05-14 12:13:22', '2025-05-14 12:13:22'),
(18, 'Plant B', 17, '2025-05-14 12:13:22', '2025-05-14 12:13:22'),
(19, 'Plant C', 17, '2025-05-14 12:13:22', '2025-05-14 12:13:22');

-- --------------------------------------------------------

--
-- Table structure for table `plant_samples`
--

CREATE TABLE `plant_samples` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `plant_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `plant_samples`
--

INSERT INTO `plant_samples` (`id`, `name`, `plant_id`, `created_at`, `updated_at`) VALUES
(26, 'aa', 10, '2025-05-11 08:21:10', '2025-05-11 08:21:10'),
(27, 'ab', 10, '2025-05-11 08:21:10', '2025-05-11 08:21:10'),
(30, 'bb', 16, '2025-05-11 08:21:33', '2025-05-11 08:21:33'),
(31, 'ba', 16, '2025-05-11 08:21:33', '2025-05-11 08:21:33'),
(32, 'bc', 16, '2025-05-11 08:21:33', '2025-05-11 08:21:33'),
(33, 'aaa', 17, '2025-05-14 12:13:22', '2025-05-14 12:13:22'),
(34, 'abb', 17, '2025-05-14 12:13:22', '2025-05-14 12:13:22'),
(35, 'n', 18, '2025-05-14 12:13:22', '2025-05-14 12:13:22'),
(36, 'b', 18, '2025-05-14 12:13:22', '2025-05-14 12:13:22');

-- --------------------------------------------------------

--
-- Table structure for table `result_types`
--

CREATE TABLE `result_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `result_types`
--

INSERT INTO `result_types` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'number', '2025-05-05 17:12:47', '2025-05-05 17:12:47'),
(2, 'text', '2025-05-05 17:12:59', '2025-05-05 17:13:05');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(64) NOT NULL,
  `caption` varchar(64) NOT NULL,
  `users_count` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `caption`, `users_count`, `is_admin`, `created_at`, `updated_at`) VALUES
(1, 'user', 'User role', 0, 0, '2025-05-08 07:25:03', '2025-05-08 07:25:03'),
(2, 'admin', 'Admin role', 0, 1, '2025-05-08 07:25:03', '2025-05-08 07:25:03');

-- --------------------------------------------------------

--
-- Table structure for table `samples`
--

CREATE TABLE `samples` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `plant_id` bigint(20) UNSIGNED NOT NULL,
  `sub_plant_id` bigint(20) UNSIGNED DEFAULT NULL,
  `plant_sample_id` bigint(20) UNSIGNED DEFAULT NULL,
  `toxic` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sample_test_methods`
--

CREATE TABLE `sample_test_methods` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sample_id` bigint(20) UNSIGNED NOT NULL,
  `test_method_id` bigint(20) UNSIGNED NOT NULL,
  `warning_limit` varchar(255) DEFAULT NULL,
  `action_limit` varchar(255) DEFAULT NULL,
  `action_limit_type` varchar(255) DEFAULT NULL,
  `warning_limit_value` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(64) NOT NULL,
  `section_group_id` int(10) UNSIGNED DEFAULT NULL,
  `caption` varchar(128) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`id`, `name`, `section_group_id`, `caption`, `created_at`, `updated_at`) VALUES
(1, 'admin_general_dashboard', NULL, 'admin_general_dashboard', '2025-04-28 23:29:38', '2025-04-28 23:29:38'),
(2, 'admin_general_dashboard_show', 1, 'general_dashboard_page', '2025-04-28 23:29:38', '2025-04-28 23:29:38'),
(3, 'admin_roles', NULL, 'admin_roles', '2025-04-28 23:29:38', '2025-04-28 23:29:38'),
(4, 'show_admin_roles', 3, 'show_admin_roles', '2025-04-28 23:29:38', '2025-04-28 23:29:38'),
(5, 'create_admin_roles', 3, 'create_admin_roles', '2025-04-28 23:29:38', '2025-04-28 23:29:38'),
(6, 'edit_admin_roles', 3, 'edit_admin_roles', '2025-04-28 23:29:38', '2025-04-28 23:29:38'),
(7, 'update_admin_roles', 3, 'update_admin_roles', '2025-04-28 23:29:38', '2025-04-28 23:29:38'),
(8, 'delete_admin_roles', 3, 'delete_admin_roles', '2025-04-28 23:29:38', '2025-04-28 23:29:38'),
(9, 'user_management', NULL, 'user_management', '2025-04-28 23:29:39', '2025-04-28 23:29:39'),
(10, 'all_users', 9, 'show_all_users', '2025-04-28 23:29:39', '2025-04-28 23:29:39'),
(11, 'change_users_role', 9, 'change_users_role', '2025-04-28 23:29:39', '2025-04-28 23:29:39'),
(12, 'change_users_status', 9, 'change_users_status', '2025-04-28 23:29:39', '2025-04-28 23:29:39'),
(13, 'delete_user', 9, 'delete_user', '2025-04-28 23:29:39', '2025-04-28 23:29:39'),
(14, 'edit_user', 9, 'edit_user', '2025-04-28 23:29:39', '2025-04-28 23:29:39'),
(15, 'create_user', 9, 'create_user', '2025-04-28 23:29:39', '2025-04-28 23:29:39'),
(16, 'test_method_management', NULL, 'test_method_management', '2025-04-28 23:29:39', '2025-05-01 17:00:49'),
(17, 'all_test_methods', 16, 'show_all_test_methods', '2025-04-28 23:29:39', '2025-05-01 17:00:49'),
(18, 'create_test_method', 16, 'create_test_method', '2025-04-28 23:29:39', '2025-05-05 17:24:44'),
(19, 'change_test_methods_role', 16, 'change_test_methods_role', '2025-04-28 23:29:39', '2025-05-05 17:24:44'),
(20, 'change_test_methods_status', 16, 'change_test_methods_status', '2025-04-28 23:29:39', '2025-05-05 17:24:44'),
(21, 'delete_test_method', 16, 'delete_test_method', '2025-04-28 23:29:39', '2025-05-05 17:24:44'),
(22, 'edit_test_method', 16, 'edit_test_method', '2025-04-28 23:29:39', '2025-05-05 17:24:44'),
(23, 'unit_management', NULL, 'unit_management', '2025-05-05 16:40:34', '2025-05-05 16:46:31'),
(24, 'change_units_role', 23, 'change_units_role', '2025-05-05 16:40:34', '2025-05-05 16:46:31'),
(25, 'change_units_status', 23, 'change_units_status', '2025-05-05 16:40:34', '2025-05-05 16:46:31'),
(26, 'delete_unit', 23, 'delete_unit', '2025-05-05 16:40:34', '2025-05-05 16:46:31'),
(27, 'edit_unit', 23, 'edit_unit', '2025-05-05 16:40:34', '2025-05-05 16:46:31'),
(28, 'create_unit', 23, 'create_unit', '2025-05-05 16:40:34', '2025-05-05 16:46:31'),
(29, 'all_units', 23, 'show_all_units', '2025-05-05 16:40:34', '2025-05-05 16:46:31'),
(30, 'result_type_management', NULL, 'result_type_management', '2025-05-05 16:40:34', '2025-05-05 16:46:31'),
(31, 'change_result_types_status', 30, 'change_result_types_status', '2025-05-05 16:40:34', '2025-05-05 16:46:31'),
(32, 'delete_result_type', 30, 'delete_result_type', '2025-05-05 16:40:34', '2025-05-05 16:46:31'),
(33, 'edit_result_type', 30, 'edit_result_type', '2025-05-05 16:40:34', '2025-05-05 16:46:31'),
(34, 'create_result_type', 30, 'create_result_type', '2025-05-05 16:40:34', '2025-05-05 16:46:31'),
(35, 'change_result_types_role', 30, 'change_result_types_role', '2025-05-05 16:46:31', '2025-05-05 16:46:31'),
(36, 'all_result_types', 30, 'show_all_result_types', '2025-05-05 16:46:31', '2025-05-05 16:46:31'),
(37, 'sample_management', NULL, 'sample_management', '2025-05-08 07:24:02', '2025-05-08 07:24:02'),
(38, 'change_samples_status', 37, 'change_samples_status', '2025-05-08 07:24:02', '2025-05-08 07:24:02'),
(39, 'delete_sample', 37, 'delete_sample', '2025-05-08 07:24:02', '2025-05-08 07:24:02'),
(40, 'edit_sample', 37, 'edit_sample', '2025-05-08 07:24:02', '2025-05-08 07:24:02'),
(41, 'create_sample', 37, 'create_sample', '2025-05-08 07:24:02', '2025-05-08 07:24:02'),
(42, 'all_samples', 37, 'show_all_samples', '2025-05-08 07:24:02', '2025-05-08 07:24:02'),
(43, 'plant_management', NULL, 'plant_management', '2025-05-08 07:24:02', '2025-05-08 07:24:02'),
(44, 'change_plants_status', 43, 'change_plants_status', '2025-05-08 07:24:02', '2025-05-08 07:24:02'),
(45, 'delete_plant', 43, 'delete_plant', '2025-05-08 07:24:02', '2025-05-08 07:24:02'),
(46, 'edit_plant', 43, 'edit_plant', '2025-05-08 07:24:02', '2025-05-08 07:24:02'),
(47, 'create_plant', 43, 'create_plant', '2025-05-08 07:24:02', '2025-05-08 07:24:02'),
(48, 'all_plants', 43, 'show_all_plants', '2025-05-08 07:24:02', '2025-05-08 07:24:02');

-- --------------------------------------------------------

--
-- Table structure for table `subscriptions`
--

CREATE TABLE `subscriptions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tenants`
--

CREATE TABLE `tenants` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `domain` varchar(255) NOT NULL,
  `database_options` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`database_options`)),
  `my_name` varchar(255) DEFAULT NULL,
  `tenant_id` varchar(255) NOT NULL,
  `user_count` int(10) UNSIGNED NOT NULL DEFAULT 1,
  `setup_cost` varchar(255) DEFAULT NULL,
  `monthly_subscription_user` varchar(255) DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `email` varchar(255) DEFAULT NULL,
  `applicable_date` date DEFAULT NULL,
  `creation_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tenants`
--

INSERT INTO `tenants` (`id`, `name`, `phone`, `logo`, `domain`, `database_options`, `my_name`, `tenant_id`, `user_count`, `setup_cost`, `monthly_subscription_user`, `status`, `email`, `applicable_date`, `creation_date`, `created_at`, `updated_at`) VALUES
(6, 'eslam badawy', '115009801', NULL, '3.localhost', '{\"dbname\":\"lims_6\"}', NULL, '3', 5, '0', NULL, 'active', 'e@badawy.e', NULL, NULL, '2025-04-28 23:43:47', '2025-04-28 23:43:48');

-- --------------------------------------------------------

--
-- Table structure for table `test_methods`
--

CREATE TABLE `test_methods` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `status` enum('added','not_added') NOT NULL DEFAULT 'added',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `test_methods`
--

INSERT INTO `test_methods` (`id`, `name`, `description`, `status`, `created_at`, `updated_at`) VALUES
(8, 'ICP Analysis', 'ASTM D1976', 'added', '2025-05-01 19:18:35', '2025-05-01 19:48:10'),
(9, 'PH', 'any', 'added', '2025-05-04 18:24:45', '2025-05-04 18:24:45'),
(10, 'new', 'any', 'added', '2025-05-05 17:33:37', '2025-05-05 17:33:37');

-- --------------------------------------------------------

--
-- Table structure for table `test_method_items`
--

CREATE TABLE `test_method_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `test_method_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `unit` int(11) DEFAULT NULL,
  `result_type` int(11) DEFAULT NULL,
  `precision` varchar(255) DEFAULT NULL,
  `lower_range` varchar(255) DEFAULT NULL,
  `upper_range` varchar(255) DEFAULT NULL,
  `reportable` enum('0','1') DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `test_method_items`
--

INSERT INTO `test_method_items` (`id`, `test_method_id`, `name`, `unit`, `result_type`, `precision`, `lower_range`, `upper_range`, `reportable`, `created_at`, `updated_at`) VALUES
(4, 8, 'Soduim (Na)', 1, 1, '2', '0.1', '1000', '1', '2025-05-01 19:18:35', '2025-05-01 19:18:35'),
(5, 8, 'Potassium (K)', 1, 2, NULL, '0.1', '1000', NULL, '2025-05-01 19:18:35', '2025-05-01 19:18:35'),
(6, 8, 'Iron (Fe)', 1, 1, NULL, '0.1', '100', NULL, '2025-05-01 19:18:35', '2025-05-01 19:18:35'),
(7, 9, 'ph', 1, 1, '1', '0', '14', '1', '2025-05-04 18:24:45', '2025-05-04 18:24:45'),
(8, 10, 'n', 4, 1, '2', 'wr', '10', '1', '2025-05-05 17:33:37', '2025-05-05 17:33:37');

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`id`, `name`, `created_at`, `updated_at`) VALUES
(3, 'ppm', '2025-05-05 16:59:06', '2025-05-05 16:59:06'),
(4, 'ppb', '2025-05-05 16:59:47', '2025-05-05 16:59:47');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role_name` varchar(64) NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  `my_name` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `user_name`, `phone`, `password`, `role_name`, `role_id`, `my_name`, `remember_token`, `created_at`, `updated_at`) VALUES
(6, 'eslam badawy', 'e@badawy.e', 'admin22', '115009801', '$2y$10$ftlzU0f6t3hfwXY1rwn/iOC3tm8Evz0jBJPnRjvmDER5Hq1BwOi1.', 'admin', 2, '12345', 'dK7mVOS6ED5hcvP9pXYa2paosLn4kvIWcbxnfPgtUnerMlGHNotN2ZcrtHAp', '2025-04-28 23:43:48', '2025-04-28 23:43:48'),
(8, 'eslam badawy', 'e@badawy.eew', 'admin', '115009801', '$2y$10$nLRYUHvFJOPNBEkuqsextOJuNJ6sPJ3/MjlHgOU2xZkhZW7Ff5BOq', 'user', 1, NULL, 'MVx7AqTUKk5xr4V6YXZoHM9I1puvCihP8rBjTHx47f6vN6UaZTy95j7WOiQv', '2025-04-30 21:02:38', '2025-04-30 21:03:30');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `field_samples`
--
ALTER TABLE `field_samples`
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
  ADD PRIMARY KEY (`id`),
  ADD KEY `permissions_role_id_foreign` (`role_id`),
  ADD KEY `permissions_section_id_foreign` (`section_id`);

--
-- Indexes for table `plants`
--
ALTER TABLE `plants`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `plants_name_unique` (`name`);

--
-- Indexes for table `plant_samples`
--
ALTER TABLE `plant_samples`
  ADD PRIMARY KEY (`id`),
  ADD KEY `plant_samples_plant_id_foreign` (`plant_id`);

--
-- Indexes for table `result_types`
--
ALTER TABLE `result_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `result_types_name_unique` (`name`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `samples`
--
ALTER TABLE `samples`
  ADD PRIMARY KEY (`id`),
  ADD KEY `samples_plant_id_foreign` (`plant_id`),
  ADD KEY `samples_sub_plant_id_foreign` (`sub_plant_id`),
  ADD KEY `samples_plant_sample_id_foreign` (`plant_sample_id`);

--
-- Indexes for table `sample_test_methods`
--
ALTER TABLE `sample_test_methods`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sample_test_methods_sample_id_foreign` (`sample_id`),
  ADD KEY `sample_test_methods_test_method_id_foreign` (`test_method_id`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tenants`
--
ALTER TABLE `tenants`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tenants_domain_unique` (`domain`),
  ADD UNIQUE KEY `tenants_tenant_id_unique` (`tenant_id`),
  ADD UNIQUE KEY `tenants_email_unique` (`email`);

--
-- Indexes for table `test_methods`
--
ALTER TABLE `test_methods`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `test_methods_name_unique` (`name`);

--
-- Indexes for table `test_method_items`
--
ALTER TABLE `test_method_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `test_method_items_test_method_id_foreign` (`test_method_id`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `units_name_unique` (`name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_user_name_unique` (`user_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `field_samples`
--
ALTER TABLE `field_samples`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=144;

--
-- AUTO_INCREMENT for table `plants`
--
ALTER TABLE `plants`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `plant_samples`
--
ALTER TABLE `plant_samples`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `result_types`
--
ALTER TABLE `result_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `samples`
--
ALTER TABLE `samples`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sample_test_methods`
--
ALTER TABLE `sample_test_methods`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `subscriptions`
--
ALTER TABLE `subscriptions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tenants`
--
ALTER TABLE `tenants`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `test_methods`
--
ALTER TABLE `test_methods`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `test_method_items`
--
ALTER TABLE `test_method_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `permissions`
--
ALTER TABLE `permissions`
  ADD CONSTRAINT `permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `permissions_section_id_foreign` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `plant_samples`
--
ALTER TABLE `plant_samples`
  ADD CONSTRAINT `plant_samples_plant_id_foreign` FOREIGN KEY (`plant_id`) REFERENCES `plants` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `samples`
--
ALTER TABLE `samples`
  ADD CONSTRAINT `samples_plant_id_foreign` FOREIGN KEY (`plant_id`) REFERENCES `plants` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `samples_plant_sample_id_foreign` FOREIGN KEY (`plant_sample_id`) REFERENCES `plant_samples` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `samples_sub_plant_id_foreign` FOREIGN KEY (`sub_plant_id`) REFERENCES `plants` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sample_test_methods`
--
ALTER TABLE `sample_test_methods`
  ADD CONSTRAINT `sample_test_methods_sample_id_foreign` FOREIGN KEY (`sample_id`) REFERENCES `samples` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sample_test_methods_test_method_id_foreign` FOREIGN KEY (`test_method_id`) REFERENCES `test_methods` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `test_method_items`
--
ALTER TABLE `test_method_items`
  ADD CONSTRAINT `test_method_items_test_method_id_foreign` FOREIGN KEY (`test_method_id`) REFERENCES `test_methods` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
