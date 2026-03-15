-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 13, 2026 at 03:19 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sdms_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_logs`
--

CREATE TABLE `activity_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `action` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `activity_logs`
--

INSERT INTO `activity_logs` (`id`, `user_id`, `action`, `description`, `ip_address`, `created_at`, `updated_at`) VALUES
(1, 1, 'register', 'New account created successfully.', '127.0.0.1', '2026-03-10 15:57:54', '2026-03-10 15:57:54'),
(2, 1, 'otp_sent', 'OTP was sent to the user email.', '127.0.0.1', '2026-03-10 16:36:46', '2026-03-10 16:36:46'),
(3, 1, 'login_success', 'User completed login with OTP successfully.', '127.0.0.1', '2026-03-10 16:37:06', '2026-03-10 16:37:06'),
(4, 1, 'logout', 'User logged out successfully.', '127.0.0.1', '2026-03-10 16:40:03', '2026-03-10 16:40:03'),
(5, 1, 'otp_sent', 'OTP was sent to the user email.', '127.0.0.1', '2026-03-10 16:40:17', '2026-03-10 16:40:17'),
(6, 1, 'login_success', 'User completed login with OTP successfully.', '127.0.0.1', '2026-03-10 16:40:57', '2026-03-10 16:40:57'),
(7, 1, 'logout', 'User logged out successfully.', '127.0.0.1', '2026-03-10 17:04:32', '2026-03-10 17:04:32'),
(8, 1, 'otp_sent', 'OTP was sent to the user email.', '127.0.0.1', '2026-03-11 10:22:48', '2026-03-11 10:22:48'),
(9, 1, 'otp_sent', 'OTP was sent to the user email.', '127.0.0.1', '2026-03-11 10:23:38', '2026-03-11 10:23:38'),
(10, 1, 'login_success', 'User completed login with OTP successfully.', '127.0.0.1', '2026-03-11 10:24:00', '2026-03-11 10:24:00'),
(11, 1, 'logout', 'User logged out successfully.', '127.0.0.1', '2026-03-11 10:27:55', '2026-03-11 10:27:55'),
(12, 2, 'register', 'New account created successfully.', '127.0.0.1', '2026-03-11 10:28:28', '2026-03-11 10:28:28'),
(13, 2, 'otp_sent', 'OTP was sent to the user email.', '127.0.0.1', '2026-03-11 10:28:52', '2026-03-11 10:28:52'),
(14, 2, 'login_success', 'User completed login with OTP successfully.', '127.0.0.1', '2026-03-11 10:29:03', '2026-03-11 10:29:03'),
(15, 2, 'logout', 'User logged out successfully.', '127.0.0.1', '2026-03-11 10:59:26', '2026-03-11 10:59:26'),
(16, 1, 'otp_sent', 'OTP was sent to the user email.', '127.0.0.1', '2026-03-11 11:27:11', '2026-03-11 11:27:11'),
(17, 1, 'login_success', 'User completed login with OTP successfully.', '127.0.0.1', '2026-03-11 11:27:30', '2026-03-11 11:27:30'),
(18, 1, 'upload_document', 'Document \"Test\" uploaded successfully.', '127.0.0.1', '2026-03-11 11:32:19', '2026-03-11 11:32:19'),
(19, 1, 'download_document', 'Document \"Test\" downloaded successfully.', '127.0.0.1', '2026-03-11 11:51:15', '2026-03-11 11:51:15'),
(20, 1, 'reserve_document', 'Document \"Bridge Design Specification\" reserved successfully.', '127.0.0.1', '2026-03-11 12:03:15', '2026-03-11 12:03:15'),
(21, 1, 'logout', 'User logged out successfully.', '127.0.0.1', '2026-03-11 12:03:38', '2026-03-11 12:03:38'),
(22, 2, 'otp_sent', 'OTP was sent to the user email.', '127.0.0.1', '2026-03-11 12:03:54', '2026-03-11 12:03:54'),
(23, 2, 'login_success', 'User completed login with OTP successfully.', '127.0.0.1', '2026-03-11 12:04:04', '2026-03-11 12:04:04'),
(24, 2, 'reserve_document', 'Document \"Concrete Mix Technical Note\" reserved successfully.', '127.0.0.1', '2026-03-11 12:04:37', '2026-03-11 12:04:37'),
(25, 2, 'release_document', 'Document \"Concrete Mix Technical Note\" reservation released successfully.', '127.0.0.1', '2026-03-11 12:04:41', '2026-03-11 12:04:41'),
(26, 2, 'reserve_document', 'Document \"Concrete Mix Technical Note\" reserved successfully.', '127.0.0.1', '2026-03-11 12:21:54', '2026-03-11 12:21:54'),
(27, 2, 'release_document', 'Document \"Concrete Mix Technical Note\" reservation released successfully.', '127.0.0.1', '2026-03-11 12:22:34', '2026-03-11 12:22:34'),
(28, 2, 'logout', 'User logged out successfully.', '127.0.0.1', '2026-03-11 12:38:42', '2026-03-11 12:38:42'),
(29, 3, 'register', 'New account created successfully.', '127.0.0.1', '2026-03-11 12:39:12', '2026-03-11 12:39:12'),
(30, 3, 'otp_sent', 'OTP was sent to the user email.', '127.0.0.1', '2026-03-11 12:39:58', '2026-03-11 12:39:58'),
(31, 3, 'login_success', 'User completed login with OTP successfully.', '127.0.0.1', '2026-03-11 12:40:11', '2026-03-11 12:40:11'),
(32, 3, 'logout', 'User logged out successfully.', '127.0.0.1', '2026-03-11 13:13:36', '2026-03-11 13:13:36'),
(33, 2, 'otp_sent', 'OTP was sent to the user email.', '127.0.0.1', '2026-03-11 13:14:07', '2026-03-11 13:14:07'),
(34, 2, 'login_success', 'User completed login with OTP successfully.', '127.0.0.1', '2026-03-11 13:14:21', '2026-03-11 13:14:21'),
(35, 2, 'logout', 'User logged out successfully.', '127.0.0.1', '2026-03-11 13:17:46', '2026-03-11 13:17:46'),
(36, 1, 'otp_sent', 'OTP was sent to the user email.', '127.0.0.1', '2026-03-11 13:18:02', '2026-03-11 13:18:02'),
(37, 1, 'login_success', 'User completed login with OTP successfully.', '127.0.0.1', '2026-03-11 13:18:20', '2026-03-11 13:18:20'),
(38, 1, 'reserve_document', 'Document \"Concrete Mix Technical Note\" reserved successfully.', '127.0.0.1', '2026-03-11 13:18:27', '2026-03-11 13:18:27'),
(39, 1, 'release_document', 'Document \"Concrete Mix Technical Note\" reservation released successfully.', '127.0.0.1', '2026-03-11 13:18:33', '2026-03-11 13:18:33'),
(40, 1, 'logout', 'User logged out successfully.', '127.0.0.1', '2026-03-11 13:23:27', '2026-03-11 13:23:27'),
(41, 2, 'otp_sent', 'OTP was sent to the user email.', '127.0.0.1', '2026-03-11 13:23:40', '2026-03-11 13:23:40'),
(42, 2, 'login_success', 'User completed login with OTP successfully.', '127.0.0.1', '2026-03-11 13:23:52', '2026-03-11 13:23:52'),
(43, 2, 'download_document', 'Document \"Test\" downloaded successfully.', '127.0.0.1', '2026-03-11 13:36:28', '2026-03-11 13:36:28'),
(44, 2, 'logout', 'User logged out successfully.', '127.0.0.1', '2026-03-11 13:37:10', '2026-03-11 13:37:10'),
(45, 1, 'otp_sent', 'OTP was sent to the user email.', '127.0.0.1', '2026-03-11 13:37:23', '2026-03-11 13:37:23'),
(46, 1, 'login_success', 'User completed login with OTP successfully.', '127.0.0.1', '2026-03-11 13:37:37', '2026-03-11 13:37:37'),
(47, 1, 'reserve_document', 'Document \"Test\" reserved successfully.', '127.0.0.1', '2026-03-11 13:38:34', '2026-03-11 13:38:34'),
(48, 1, 'release_document', 'Document \"Test\" reservation released successfully.', '127.0.0.1', '2026-03-11 13:38:37', '2026-03-11 13:38:37'),
(49, 1, 'logout', 'User logged out successfully.', '127.0.0.1', '2026-03-11 13:38:47', '2026-03-11 13:38:47'),
(50, 2, 'otp_sent', 'OTP was sent to the user email.', '127.0.0.1', '2026-03-11 13:39:00', '2026-03-11 13:39:00'),
(51, 2, 'login_success', 'User completed login with OTP successfully.', '127.0.0.1', '2026-03-11 13:39:12', '2026-03-11 13:39:12'),
(52, 2, 'otp_sent', 'OTP was sent to the user email.', '127.0.0.1', '2026-03-11 13:39:53', '2026-03-11 13:39:53'),
(53, 2, 'login_success', 'User completed login with OTP successfully.', '127.0.0.1', '2026-03-11 13:40:07', '2026-03-11 13:40:07'),
(54, 2, 'reserve_document', 'Document \"Test\" reserved successfully.', '127.0.0.1', '2026-03-11 13:52:49', '2026-03-11 13:52:49'),
(55, 2, 'release_document', 'Document \"Test\" reservation released successfully.', '127.0.0.1', '2026-03-11 13:52:56', '2026-03-11 13:52:56'),
(56, 2, 'download_document', 'Document \"Test\" downloaded successfully.', '127.0.0.1', '2026-03-11 13:53:05', '2026-03-11 13:53:05'),
(57, 1, 'otp_sent', 'OTP was sent to the user email.', '127.0.0.1', '2026-03-12 23:31:40', '2026-03-12 23:31:40'),
(58, 1, 'login_success', 'User completed login with OTP successfully.', '127.0.0.1', '2026-03-12 23:32:07', '2026-03-12 23:32:07'),
(59, 1, 'reserve_document', 'Document \"Test\" reserved successfully.', '127.0.0.1', '2026-03-12 23:33:44', '2026-03-12 23:33:44'),
(60, 1, 'edit_document', 'Document \"Test\" updated successfully.', '127.0.0.1', '2026-03-12 23:34:25', '2026-03-12 23:34:25'),
(61, 1, 'release_document', 'Document \"Test\" reservation released successfully.', '127.0.0.1', '2026-03-12 23:34:33', '2026-03-12 23:34:33'),
(62, 1, 'download_document', 'Document \"Test\" downloaded successfully.', '127.0.0.1', '2026-03-12 23:34:41', '2026-03-12 23:34:41'),
(63, 1, 'logout', 'User logged out successfully.', '127.0.0.1', '2026-03-12 23:34:53', '2026-03-12 23:34:53'),
(64, 2, 'otp_sent', 'OTP was sent to the user email.', '127.0.0.1', '2026-03-12 23:35:11', '2026-03-12 23:35:11'),
(65, 2, 'login_success', 'User completed login with OTP successfully.', '127.0.0.1', '2026-03-12 23:35:49', '2026-03-12 23:35:49'),
(66, 2, 'logout', 'User logged out successfully.', '127.0.0.1', '2026-03-12 23:36:28', '2026-03-12 23:36:28'),
(67, 3, 'otp_sent', 'OTP was sent to the user email.', '127.0.0.1', '2026-03-12 23:36:44', '2026-03-12 23:36:44'),
(68, 3, 'login_success', 'User completed login with OTP successfully.', '127.0.0.1', '2026-03-12 23:36:55', '2026-03-12 23:36:55'),
(69, 3, 'logout', 'User logged out successfully.', '127.0.0.1', '2026-03-12 23:42:02', '2026-03-12 23:42:02'),
(70, 3, 'otp_sent', 'OTP was sent to the user email.', '127.0.0.1', '2026-03-12 23:43:26', '2026-03-12 23:43:26'),
(71, 3, 'otp_failed', 'Incorrect OTP entered.', '127.0.0.1', '2026-03-12 23:43:39', '2026-03-12 23:43:39'),
(72, 3, 'login_success', 'User completed login with OTP successfully.', '127.0.0.1', '2026-03-12 23:43:44', '2026-03-12 23:43:44'),
(73, 3, 'logout', 'User logged out successfully.', '127.0.0.1', '2026-03-13 00:08:43', '2026-03-13 00:08:43'),
(74, 1, 'otp_sent', 'OTP was sent to the user email.', '127.0.0.1', '2026-03-13 00:08:58', '2026-03-13 00:08:58'),
(75, 1, 'otp_failed', 'Incorrect OTP entered.', '127.0.0.1', '2026-03-13 00:09:08', '2026-03-13 00:09:08'),
(76, 1, 'login_success', 'User completed login with OTP successfully.', '127.0.0.1', '2026-03-13 00:09:18', '2026-03-13 00:09:18'),
(77, NULL, 'login_failed', 'Invalid email or password.', '127.0.0.1', '2026-03-13 09:13:55', '2026-03-13 09:13:55'),
(78, NULL, 'login_failed', 'Invalid email or password.', '127.0.0.1', '2026-03-13 09:14:04', '2026-03-13 09:14:04'),
(79, 2, 'otp_sent', 'OTP was sent to the user email.', '127.0.0.1', '2026-03-13 09:14:20', '2026-03-13 09:14:20'),
(80, 2, 'login_success', 'User completed login with OTP successfully.', '127.0.0.1', '2026-03-13 09:14:28', '2026-03-13 09:14:28'),
(81, 2, 'reserve_document', 'Document \"Test\" reserved successfully.', '127.0.0.1', '2026-03-13 09:14:39', '2026-03-13 09:14:39'),
(82, 2, 'release_document', 'Document \"Test\" reservation released successfully.', '127.0.0.1', '2026-03-13 09:14:42', '2026-03-13 09:14:42'),
(83, 2, 'download_document', 'Document \"Test\" downloaded successfully.', '127.0.0.1', '2026-03-13 09:14:49', '2026-03-13 09:14:49'),
(84, 2, 'logout', 'User logged out successfully.', '127.0.0.1', '2026-03-13 09:15:24', '2026-03-13 09:15:24'),
(85, 3, 'otp_sent', 'OTP was sent to the user email.', '127.0.0.1', '2026-03-13 09:15:37', '2026-03-13 09:15:37'),
(86, 3, 'login_success', 'User completed login with OTP successfully.', '127.0.0.1', '2026-03-13 09:15:45', '2026-03-13 09:15:45'),
(87, 3, 'logout', 'User logged out successfully.', '127.0.0.1', '2026-03-13 09:18:25', '2026-03-13 09:18:25');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('sdms-project-cache-356a192b7913b04c54574d18c28d46e6395428ab', 'i:3;', 1773376484),
('sdms-project-cache-356a192b7913b04c54574d18c28d46e6395428ab:timer', 'i:1773376484;', 1773376484),
('sdms-project-cache-5c785c036466adea360111aa28563bfd556b5fba', 'i:2;', 1773411392),
('sdms-project-cache-5c785c036466adea360111aa28563bfd556b5fba:timer', 'i:1773411392;', 1773411392),
('sdms-project-cache-da4b9237bacccdf19c0760cab7aec4a8359010b0', 'i:2;', 1773411339),
('sdms-project-cache-da4b9237bacccdf19c0760cab7aec4a8359010b0:timer', 'i:1773411339;', 1773411339);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Design Documents', 'Engineering design drawings and specifications.', '2026-03-11 10:00:08', '2026-03-11 10:00:08'),
(2, 'Reports', 'Project reports, progress reports, and summaries.', '2026-03-11 10:00:08', '2026-03-11 10:00:08'),
(3, 'Technical Notes', 'Technical notes and reference documents.', '2026-03-11 10:00:08', '2026-03-11 10:00:08'),
(4, 'Contracts', 'Contract documents and legal agreements.', '2026-03-11 10:00:08', '2026-03-11 10:00:08');

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `file_size` bigint(20) UNSIGNED DEFAULT NULL,
  `file_type` varchar(255) DEFAULT NULL,
  `uploaded_by` bigint(20) UNSIGNED NOT NULL,
  `last_edited_by` bigint(20) UNSIGNED DEFAULT NULL,
  `is_reserved` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`id`, `title`, `description`, `category_id`, `file_name`, `file_path`, `file_size`, `file_type`, `uploaded_by`, `last_edited_by`, `is_reserved`, `created_at`, `updated_at`) VALUES
(4, 'Test', 'xyz', 2, '5CM505 Software engineering_Handbook.docx', 'documents/ZlZMSQTH0rkl2JzyolghKidU6LrjD1IAvhdDrbYr.docx', 47219, 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 1, 2, 0, '2026-03-11 11:32:19', '2026-03-13 09:14:42');

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
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
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
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_03_10_195122_create_activity_logs_table', 1),
(5, '2026_03_10_195122_create_otp_records_table', 1),
(6, '2026_03_11_000001_create_categories_table', 2),
(7, '2026_03_11_000002_create_documents_table', 2),
(8, '2026_03_11_100000_create_reservations_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `otp_records`
--

CREATE TABLE `otp_records` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `otp_code` varchar(6) NOT NULL,
  `expires_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `is_used` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `otp_records`
--

INSERT INTO `otp_records` (`id`, `user_id`, `otp_code`, `expires_at`, `is_used`, `created_at`, `updated_at`) VALUES
(1, 1, '776835', '2026-03-10 21:04:53', 1, '2026-03-10 15:58:42', '2026-03-10 16:04:53'),
(2, 1, '274866', '2026-03-10 21:11:29', 1, '2026-03-10 16:04:53', '2026-03-10 16:11:29'),
(3, 1, '422958', '2026-03-10 21:21:11', 1, '2026-03-10 16:11:29', '2026-03-10 16:21:11'),
(4, 1, '951632', '2026-03-10 21:23:13', 1, '2026-03-10 16:21:11', '2026-03-10 16:23:13'),
(5, 1, '663455', '2026-03-10 21:27:33', 1, '2026-03-10 16:23:13', '2026-03-10 16:27:33'),
(6, 1, '992709', '2026-03-10 21:33:11', 1, '2026-03-10 16:27:33', '2026-03-10 16:33:11'),
(7, 1, '981492', '2026-03-10 21:34:37', 1, '2026-03-10 16:33:11', '2026-03-10 16:34:37'),
(8, 1, '123568', '2026-03-10 21:36:41', 1, '2026-03-10 16:34:37', '2026-03-10 16:36:41'),
(9, 1, '830109', '2026-03-10 21:37:06', 1, '2026-03-10 16:36:41', '2026-03-10 16:37:06'),
(10, 1, '994097', '2026-03-10 21:40:57', 1, '2026-03-10 16:40:12', '2026-03-10 16:40:57'),
(11, 1, '862846', '2026-03-11 15:22:49', 1, '2026-03-11 10:22:43', '2026-03-11 10:22:49'),
(12, 1, '171092', '2026-03-11 15:23:33', 1, '2026-03-11 10:22:49', '2026-03-11 10:23:33'),
(13, 1, '785524', '2026-03-11 15:24:00', 1, '2026-03-11 10:23:33', '2026-03-11 10:24:00'),
(14, 2, '802294', '2026-03-11 15:29:03', 1, '2026-03-11 10:28:48', '2026-03-11 10:29:03'),
(15, 1, '738724', '2026-03-11 16:27:30', 1, '2026-03-11 11:26:58', '2026-03-11 11:27:30'),
(16, 2, '129770', '2026-03-11 17:04:04', 1, '2026-03-11 12:03:48', '2026-03-11 12:04:04'),
(17, 3, '896015', '2026-03-11 17:40:11', 1, '2026-03-11 12:39:53', '2026-03-11 12:40:11'),
(18, 2, '933974', '2026-03-11 18:14:21', 1, '2026-03-11 13:14:02', '2026-03-11 13:14:21'),
(19, 1, '341674', '2026-03-11 18:18:20', 1, '2026-03-11 13:17:58', '2026-03-11 13:18:20'),
(20, 2, '386071', '2026-03-11 18:23:52', 1, '2026-03-11 13:23:36', '2026-03-11 13:23:52'),
(21, 1, '592404', '2026-03-11 18:37:37', 1, '2026-03-11 13:37:19', '2026-03-11 13:37:37'),
(22, 2, '780492', '2026-03-11 18:39:12', 1, '2026-03-11 13:38:55', '2026-03-11 13:39:12'),
(23, 2, '972043', '2026-03-11 18:40:07', 1, '2026-03-11 13:39:49', '2026-03-11 13:40:07'),
(24, 1, '764823', '2026-03-13 04:32:07', 1, '2026-03-12 23:31:33', '2026-03-12 23:32:07'),
(25, 2, '594341', '2026-03-13 04:35:49', 1, '2026-03-12 23:35:07', '2026-03-12 23:35:49'),
(26, 3, '559950', '2026-03-13 04:36:55', 1, '2026-03-12 23:36:39', '2026-03-12 23:36:55'),
(27, 3, '572124', '2026-03-13 04:43:44', 1, '2026-03-12 23:43:18', '2026-03-12 23:43:44'),
(28, 1, '171929', '2026-03-13 05:09:18', 1, '2026-03-13 00:08:53', '2026-03-13 00:09:18'),
(29, 2, '507036', '2026-03-13 14:14:28', 1, '2026-03-13 09:14:15', '2026-03-13 09:14:28'),
(30, 3, '510333', '2026-03-13 14:15:45', 1, '2026-03-13 09:15:33', '2026-03-13 09:15:45');

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
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `document_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `reserved_at` datetime NOT NULL,
  `released_at` datetime DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`id`, `document_id`, `user_id`, `reserved_at`, `released_at`, `status`, `created_at`, `updated_at`) VALUES
(5, 4, 1, '2026-03-11 18:38:34', '2026-03-11 18:38:37', 'released', '2026-03-11 13:38:34', '2026-03-11 13:38:37'),
(6, 4, 2, '2026-03-11 18:52:49', '2026-03-11 18:52:56', 'released', '2026-03-11 13:52:49', '2026-03-11 13:52:56'),
(7, 4, 1, '2026-03-13 04:33:44', '2026-03-13 04:34:33', 'released', '2026-03-12 23:33:44', '2026-03-12 23:34:33'),
(8, 4, 2, '2026-03-13 14:14:39', '2026-03-13 14:14:42', 'released', '2026-03-13 09:14:39', '2026-03-13 09:14:42');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'engineer', 'Engineer role', '2026-03-10 15:55:27', '2026-03-10 15:55:27'),
(2, 'manager', 'Manager role', '2026-03-10 15:55:27', '2026-03-10 15:55:27'),
(3, 'supervisor', 'Supervisor role', '2026-03-10 15:55:27', '2026-03-10 15:55:27');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('AwJXK1Ns7yWyiiui0KtrF488CJ5thUxySmFDoXAQ', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiN3JBTlJxS0lyNGNKMm5GS0dEY3g0ZlVadzRPaWpyQnpxeHl5VWVwTiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fX0=', 1773411505);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `last_login_at` timestamp NULL DEFAULT NULL,
  `current_session_id` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role_id`, `is_active`, `last_login_at`, `current_session_id`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'eng', 'engineer@gmail.com', NULL, '$2y$12$QrueZpkDSiHFh5sNZJKvxufmdx59T/UGwHvx4LEiol313OgoBjszW', 1, 1, '2026-03-13 00:09:18', 'LWUwIuQjpE9wtU0eU4NQttsVew1umhWNGjcM8Cmk', NULL, '2026-03-10 15:57:54', '2026-03-13 00:09:18'),
(2, 'mng', 'manager@gmail.com', NULL, '$2y$12$UJ/AJZMoGQfm22tn49ObAuLlXSrNnjU9ZEe/aliq8gRXOrb.pVciu', 2, 1, '2026-03-13 09:14:28', NULL, NULL, '2026-03-11 10:28:28', '2026-03-13 09:15:24'),
(3, 'sup', 'supervisor@gmail.com', NULL, '$2y$12$dzWceSj6d/zaNDaGEeXUGeXOeYMatUaNKRQEAgG.ZtDrpcyc/.UI.', 3, 1, '2026-03-13 09:15:45', NULL, NULL, '2026-03-11 12:39:12', '2026-03-13 09:18:25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `activity_logs_user_id_foreign` (`user_id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `documents_category_id_foreign` (`category_id`),
  ADD KEY `documents_uploaded_by_foreign` (`uploaded_by`),
  ADD KEY `documents_last_edited_by_foreign` (`last_edited_by`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_reserved_at_available_at_index` (`queue`,`reserved_at`,`available_at`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `otp_records`
--
ALTER TABLE `otp_records`
  ADD PRIMARY KEY (`id`),
  ADD KEY `otp_records_user_id_foreign` (`user_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reservations_document_id_foreign` (`document_id`),
  ADD KEY `reservations_user_id_foreign` (`user_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_foreign` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

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
-- AUTO_INCREMENT for table `activity_logs`
--
ALTER TABLE `activity_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `otp_records`
--
ALTER TABLE `otp_records`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD CONSTRAINT `activity_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `documents`
--
ALTER TABLE `documents`
  ADD CONSTRAINT `documents_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `documents_last_edited_by_foreign` FOREIGN KEY (`last_edited_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `documents_uploaded_by_foreign` FOREIGN KEY (`uploaded_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `otp_records`
--
ALTER TABLE `otp_records`
  ADD CONSTRAINT `otp_records_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `reservations_document_id_foreign` FOREIGN KEY (`document_id`) REFERENCES `documents` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reservations_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sessions`
--
ALTER TABLE `sessions`
  ADD CONSTRAINT `sessions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
