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
-- Database: `tenancy`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role_name` varchar(255) DEFAULT 'admin',
  `role_id` int(10) DEFAULT 2,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `user_name`, `password`, `role_name`, `role_id`, `created_at`, `updated_at`) VALUES
(1, 'Eslam', 'admin', '$2y$10$a0FoEEm.eocYWiB5a8Q9Z.rj6g/kuT1en3lobyp1UTmTfVXXs3zde', 'admin', 2, '2025-04-28 23:29:39', '2025-04-28 23:29:39');

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
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_09_15_000010_create_tenants_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2024_10_11_010813_create_roles_table', 1),
(7, '2024_10_11_010819_create_sections_table', 1),
(8, '2024_10_11_010828_create_permissions_table', 1),
(9, '2025_04_26_233249_create_admins_table', 1),
(10, '2025_04_27_004945_create_subscriptions_table', 1),
(11, '2025_04_27_005132_create_test_methods_table', 1),
(12, '2025_04_27_005310_create_test_method_items_table', 1),
(13, '2025_05_05_192845_create_units_table', 2),
(14, '2025_05_05_192852_create_result_types_table', 2),
(18, '2025_05_08_103100_create_plants_table', 3),
(19, '2025_05_08_103255_create_plant_samples_table', 3),
(20, '2025_05_13_125527_create_samples_table', 4),
(21, '2025_05_13_130111_create_sample_test_methods_table', 4),
(22, '2025_05_13_130151_create_field_samples_table', 4);

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
(1, 2, 1, 1, '2025-04-28 23:29:39', '2025-04-28 23:29:39'),
(2, 2, 2, 1, '2025-04-28 23:29:39', '2025-04-28 23:29:39'),
(3, 2, 3, 1, '2025-04-28 23:29:39', '2025-04-28 23:29:39'),
(4, 2, 4, 1, '2025-04-28 23:29:39', '2025-04-28 23:29:39'),
(5, 2, 5, 1, '2025-04-28 23:29:39', '2025-04-28 23:29:39'),
(6, 2, 6, 1, '2025-04-28 23:29:39', '2025-04-28 23:29:39'),
(7, 2, 7, 1, '2025-04-28 23:29:39', '2025-04-28 23:29:39'),
(8, 2, 8, 1, '2025-04-28 23:29:39', '2025-04-28 23:29:39'),
(9, 2, 9, 1, '2025-04-28 23:29:39', '2025-04-28 23:29:39'),
(10, 2, 10, 1, '2025-04-28 23:29:39', '2025-04-28 23:29:39'),
(11, 2, 11, 1, '2025-04-28 23:29:39', '2025-04-28 23:29:39'),
(12, 2, 12, 1, '2025-04-28 23:29:39', '2025-04-28 23:29:39'),
(13, 2, 13, 1, '2025-04-28 23:29:39', '2025-04-28 23:29:39'),
(14, 2, 14, 1, '2025-04-28 23:29:39', '2025-04-28 23:29:39'),
(15, 2, 15, 1, '2025-04-28 23:29:39', '2025-04-28 23:29:39'),
(16, 2, 16, 1, '2025-04-28 23:29:39', '2025-04-28 23:29:39'),
(17, 2, 17, 1, '2025-04-28 23:29:39', '2025-04-28 23:29:39'),
(18, 2, 18, 1, '2025-04-28 23:29:39', '2025-04-28 23:29:39'),
(19, 2, 19, 1, '2025-04-28 23:29:39', '2025-04-28 23:29:39'),
(20, 2, 20, 1, '2025-04-28 23:29:39', '2025-04-28 23:29:39'),
(21, 2, 21, 1, '2025-04-28 23:29:39', '2025-04-28 23:29:39'),
(22, 2, 22, 1, '2025-04-28 23:29:39', '2025-04-28 23:29:39'),
(23, 2, 23, 1, '2025-05-05 16:39:59', '2025-05-05 16:39:59'),
(24, 2, 24, 1, '2025-05-05 16:39:59', '2025-05-05 16:39:59'),
(25, 2, 25, 1, '2025-05-05 16:39:59', '2025-05-05 16:39:59'),
(26, 2, 26, 1, '2025-05-05 16:39:59', '2025-05-05 16:39:59'),
(27, 2, 27, 1, '2025-05-05 16:39:59', '2025-05-05 16:39:59'),
(28, 2, 28, 1, '2025-05-05 16:39:59', '2025-05-05 16:39:59'),
(29, 2, 29, 1, '2025-05-05 16:39:59', '2025-05-05 16:39:59'),
(30, 2, 30, 1, '2025-05-05 16:39:59', '2025-05-05 16:39:59'),
(31, 2, 31, 1, '2025-05-05 16:39:59', '2025-05-05 16:39:59'),
(32, 2, 32, 1, '2025-05-05 16:39:59', '2025-05-05 16:39:59'),
(33, 2, 33, 1, '2025-05-05 16:39:59', '2025-05-05 16:39:59'),
(34, 2, 34, 1, '2025-05-05 16:39:59', '2025-05-05 16:39:59'),
(35, 2, 35, 1, '2025-05-05 17:30:02', '2025-05-05 17:30:02'),
(36, 2, 36, 1, '2025-05-05 17:30:02', '2025-05-05 17:30:02'),
(37, 2, 37, 1, '2025-05-08 07:25:02', '2025-05-08 07:25:02'),
(38, 2, 38, 1, '2025-05-08 07:25:02', '2025-05-08 07:25:02'),
(39, 2, 39, 1, '2025-05-08 07:25:02', '2025-05-08 07:25:02'),
(40, 2, 40, 1, '2025-05-08 07:25:02', '2025-05-08 07:25:02'),
(41, 2, 41, 1, '2025-05-08 07:25:02', '2025-05-08 07:25:02'),
(42, 2, 42, 1, '2025-05-08 07:25:02', '2025-05-08 07:25:02'),
(43, 2, 43, 1, '2025-05-08 07:25:02', '2025-05-08 07:25:02'),
(44, 2, 44, 1, '2025-05-08 07:25:02', '2025-05-08 07:25:02'),
(45, 2, 45, 1, '2025-05-08 07:25:02', '2025-05-08 07:25:02'),
(46, 2, 46, 1, '2025-05-08 07:25:02', '2025-05-08 07:25:02'),
(47, 2, 47, 1, '2025-05-08 07:25:02', '2025-05-08 07:25:02'),
(48, 2, 48, 1, '2025-05-08 07:25:02', '2025-05-08 07:25:02');

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
-- Table structure for table `plants`
--

CREATE TABLE `plants` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `plant_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(1, 'user', 'User role', 0, 0, '2025-05-08 07:25:02', '2025-05-08 07:25:02'),
(2, 'admin', 'Admin role', 0, 1, '2025-05-08 07:25:02', '2025-05-08 07:25:02');

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
(16, 'test_method_management', NULL, 'test_method_management', '2025-04-28 23:29:39', '2025-05-01 16:53:35'),
(17, 'all_test_methods', 16, 'show_all_test_methods', '2025-04-28 23:29:39', '2025-05-01 16:53:35'),
(18, 'create_test_method', 16, 'create_test_method', '2025-04-28 23:29:39', '2025-05-05 17:30:02'),
(19, 'change_test_methods_role', 16, 'change_test_methods_role', '2025-04-28 23:29:39', '2025-05-05 17:30:02'),
(20, 'change_test_methods_status', 16, 'change_test_methods_status', '2025-04-28 23:29:39', '2025-05-05 17:30:02'),
(21, 'delete_test_method', 16, 'delete_test_method', '2025-04-28 23:29:39', '2025-05-05 17:30:02'),
(22, 'edit_test_method', 16, 'edit_test_method', '2025-04-28 23:29:39', '2025-05-05 17:30:02'),
(23, 'unit_management', 22, 'unit_management', '2025-05-05 16:39:59', '2025-05-05 17:30:02'),
(24, 'change_units_role', 23, 'change_units_role', '2025-05-05 16:39:59', '2025-05-05 17:30:02'),
(25, 'change_units_status', 23, 'change_units_status', '2025-05-05 16:39:59', '2025-05-05 17:30:02'),
(26, 'delete_unit', 23, 'delete_unit', '2025-05-05 16:39:59', '2025-05-05 17:30:02'),
(27, 'edit_unit', 23, 'edit_unit', '2025-05-05 16:39:59', '2025-05-05 17:30:02'),
(28, 'create_unit', 23, 'create_unit', '2025-05-05 16:39:59', '2025-05-05 17:30:02'),
(29, 'all_units', 23, 'show_all_units', '2025-05-05 16:39:59', '2025-05-05 17:30:02'),
(30, 'result_type_management', 28, 'result_type_management', '2025-05-05 16:39:59', '2025-05-05 17:30:02'),
(31, 'change_result_types_status', 30, 'change_result_types_status', '2025-05-05 16:39:59', '2025-05-05 17:30:02'),
(32, 'delete_result_type', 30, 'delete_result_type', '2025-05-05 16:39:59', '2025-05-05 17:30:02'),
(33, 'edit_result_type', 30, 'edit_result_type', '2025-05-05 16:39:59', '2025-05-05 17:30:02'),
(34, 'create_result_type', 30, 'create_result_type', '2025-05-05 16:39:59', '2025-05-05 17:30:02'),
(35, 'change_result_types_role', 30, 'change_result_types_role', '2025-05-05 17:30:02', '2025-05-05 17:30:02'),
(36, 'all_result_types', 30, 'show_all_result_types', '2025-05-05 17:30:02', '2025-05-05 17:30:02'),
(37, 'sample_management', NULL, 'sample_management', '2025-05-08 07:24:06', '2025-05-08 07:24:06'),
(38, 'change_samples_status', 37, 'change_samples_status', '2025-05-08 07:24:06', '2025-05-08 07:24:06'),
(39, 'delete_sample', 37, 'delete_sample', '2025-05-08 07:24:06', '2025-05-08 07:24:06'),
(40, 'edit_sample', 37, 'edit_sample', '2025-05-08 07:24:06', '2025-05-08 07:24:06'),
(41, 'create_sample', 37, 'create_sample', '2025-05-08 07:24:06', '2025-05-08 07:24:06'),
(42, 'all_samples', 37, 'show_all_samples', '2025-05-08 07:24:06', '2025-05-08 07:24:06'),
(43, 'plant_management', NULL, 'plant_management', '2025-05-08 07:24:06', '2025-05-08 07:24:06'),
(44, 'change_plants_status', 43, 'change_plants_status', '2025-05-08 07:24:06', '2025-05-08 07:24:06'),
(45, 'delete_plant', 43, 'delete_plant', '2025-05-08 07:24:06', '2025-05-08 07:24:06'),
(46, 'edit_plant', 43, 'edit_plant', '2025-05-08 07:24:06', '2025-05-08 07:24:06'),
(47, 'create_plant', 43, 'create_plant', '2025-05-08 07:24:06', '2025-05-08 07:24:06'),
(48, 'all_plants', 43, 'show_all_plants', '2025-05-08 07:24:06', '2025-05-08 07:24:06');

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
(6, 'eslam badawy', '115009801', NULL, '3.localhost', '{\"dbname\":\"lims_6\"}', NULL, '3', 5, '0', NULL, 'active', 'e@badawy.e', NULL, NULL, '2025-04-28 23:43:47', '2025-04-29 00:15:53'),
(7, 'Lab 1', '115009801', NULL, '4.localhost', '{\"dbname\":\"lims_7\"}', NULL, '4', 5, '100', NULL, 'active', 'hussen@gmail.com', '2025-04-30', '2025-05-01', '2025-05-01 15:00:40', '2025-05-01 15:00:40');

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

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `role_name` varchar(64) NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `my_name` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `user_name`, `role_name`, `role_id`, `phone`, `password`, `my_name`, `remember_token`, `created_at`, `updated_at`) VALUES
(6, 'eslam badawy', 'e@badawy.e', 'admin22', 'admin', 2, '115009801', '$2y$10$ftlzU0f6t3hfwXY1rwn/iOC3tm8Evz0jBJPnRjvmDER5Hq1BwOi1.', '12345', 'rHDpoXt0L1mrwbB0UTbHOWTzMhIwLRxpkGPlLaSwHVMnVY2oL9iOooqVI2Gr', '2025-04-28 20:43:48', '2025-04-29 00:53:03'),
(7, 'eslam badawy', 'e@badawy.er', 'eslamr', 'user', 1, '115009801', '$2y$10$W.cuHTUyMduT2cflAoHfyeADWoCq7H/ghUQjLKc9jwgIUKDufvIdO', NULL, NULL, '2025-04-29 01:51:34', '2025-04-29 01:51:34'),
(8, 'Lab 1', 'hussen@gmail.com', 'hussen', 'admin', 2, '115009801', '$2y$10$P1hieIYtjJkjyN3crS4vx.r5SYnvS6ulo2fqU.OqU4gmnGwc03gW2', '12345', NULL, '2025-05-01 15:00:40', '2025-05-01 15:00:40');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_user_name_unique` (`user_name`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

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
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `permissions_role_id_foreign` (`role_id`),
  ADD KEY `permissions_section_id_foreign` (`section_id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

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
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `field_samples`
--
ALTER TABLE `field_samples`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `plants`
--
ALTER TABLE `plants`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `plant_samples`
--
ALTER TABLE `plant_samples`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `result_types`
--
ALTER TABLE `result_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `test_methods`
--
ALTER TABLE `test_methods`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `test_method_items`
--
ALTER TABLE `test_method_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

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
