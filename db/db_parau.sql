-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versi server:                 10.4.19-MariaDB - mariadb.org binary distribution
-- OS Server:                    Win64
-- HeidiSQL Versi:               10.3.0.5771
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- membuang struktur untuk table db_parau.activity_log
CREATE TABLE IF NOT EXISTS `activity_log` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `log_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `event` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject_id` bigint(20) unsigned DEFAULT NULL,
  `causer_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `causer_id` bigint(20) unsigned DEFAULT NULL,
  `properties` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`properties`)),
  `batch_uuid` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `subject` (`subject_type`,`subject_id`),
  KEY `causer` (`causer_type`,`causer_id`),
  KEY `activity_log_log_name_index` (`log_name`)
) ENGINE=InnoDB AUTO_INCREMENT=366 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel db_parau.activity_log: ~359 rows (lebih kurang)
/*!40000 ALTER TABLE `activity_log` DISABLE KEYS */;
INSERT INTO `activity_log` (`id`, `log_name`, `description`, `subject_type`, `event`, `subject_id`, `causer_type`, `causer_id`, `properties`, `batch_uuid`, `created_at`, `updated_at`) VALUES
	(1, 'default', 'Log Out', NULL, NULL, NULL, 'App\\Models\\User', 482, '[]', NULL, '2021-10-29 10:30:24', '2021-10-29 10:30:24'),
	(2, 'default', 'Login', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2021-10-29 10:30:27', '2021-10-29 10:30:27'),
	(3, 'default', 'Ubah Data Pegawai dengan ID = 93', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2021-10-29 10:30:57', '2021-10-29 10:30:57'),
	(4, 'default', 'Log Out', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2021-10-29 10:31:03', '2021-10-29 10:31:03'),
	(5, 'default', 'Login', NULL, NULL, NULL, 'App\\Models\\User', 482, '[]', NULL, '2021-10-29 10:31:12', '2021-10-29 10:31:12'),
	(6, 'default', 'Login', NULL, NULL, NULL, 'App\\Models\\User', 482, '[]', NULL, '2021-10-29 10:32:48', '2021-10-29 10:32:48'),
	(7, 'default', 'Ubah Data Profil dengan ID = 482', NULL, NULL, NULL, 'App\\Models\\User', 482, '[]', NULL, '2021-10-29 10:33:32', '2021-10-29 10:33:32'),
	(8, 'default', 'Log Out', NULL, NULL, NULL, 'App\\Models\\User', 482, '[]', NULL, '2021-10-29 10:33:36', '2021-10-29 10:33:36'),
	(9, 'default', 'Login', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2021-10-29 10:33:38', '2021-10-29 10:33:38'),
	(10, 'default', 'Log Out', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2021-10-29 11:10:02', '2021-10-29 11:10:02'),
	(11, 'default', 'Login', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2021-10-29 11:12:09', '2021-10-29 11:12:09'),
	(12, 'default', 'Ubah Data Pengaturan', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2021-10-29 11:16:43', '2021-10-29 11:16:43'),
	(13, 'default', 'Ubah Data Pengaturan', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2021-10-29 11:16:50', '2021-10-29 11:16:50'),
	(14, 'default', 'Ubah Data Pengaturan', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2021-10-29 11:17:10', '2021-10-29 11:17:10'),
	(15, 'default', 'Ubah Data Pengaturan', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2021-10-29 11:23:12', '2021-10-29 11:23:12'),
	(16, 'default', 'Log Out', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2021-10-29 11:23:19', '2021-10-29 11:23:19'),
	(17, 'default', 'Login', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2021-10-29 11:23:25', '2021-10-29 11:23:25'),
	(18, 'default', 'Ubah Data Pengaturan', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2021-10-29 11:23:40', '2021-10-29 11:23:40'),
	(19, 'default', 'Ubah Data Pengaturan', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2021-10-29 11:23:45', '2021-10-29 11:23:45'),
	(20, 'default', 'Ubah Data Pengaturan', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2021-10-29 11:23:50', '2021-10-29 11:23:50'),
	(21, 'default', 'Ubah Data Pengaturan', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2021-10-29 11:23:55', '2021-10-29 11:23:55'),
	(22, 'default', 'Ubah Data Pengaturan', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2021-10-29 11:23:59', '2021-10-29 11:23:59'),
	(23, 'default', 'Ubah Data Pengaturan', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2021-10-29 11:24:03', '2021-10-29 11:24:03'),
	(24, 'default', 'Log Out', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2021-10-29 11:25:32', '2021-10-29 11:25:32'),
	(25, 'default', 'Login', NULL, NULL, NULL, 'App\\Models\\User', 482, '[]', NULL, '2021-10-29 11:25:39', '2021-10-29 11:25:39'),
	(26, 'default', 'Ubah Data Profil dengan ID = 482', NULL, NULL, NULL, 'App\\Models\\User', 482, '[]', NULL, '2021-10-29 11:26:56', '2021-10-29 11:26:56'),
	(27, 'default', 'Login', NULL, NULL, NULL, 'App\\Models\\User', 482, '[]', NULL, '2021-10-29 11:27:02', '2021-10-29 11:27:02'),
	(28, 'default', 'Log Out', NULL, NULL, NULL, 'App\\Models\\User', 482, '[]', NULL, '2021-10-29 11:46:26', '2021-10-29 11:46:26'),
	(29, 'default', 'Login', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2021-10-29 14:15:38', '2021-10-29 14:15:38'),
	(30, 'default', 'Ubah Data Pengaturan', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2021-10-29 14:18:08', '2021-10-29 14:18:08'),
	(31, 'default', 'Log Out', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2021-10-29 14:18:12', '2021-10-29 14:18:12'),
	(32, 'default', 'Login', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2021-10-29 14:29:41', '2021-10-29 14:29:41'),
	(33, 'default', 'Tambah Data Pegawai', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2021-10-29 14:30:33', '2021-10-29 14:30:33'),
	(34, 'default', 'Ubah Data Pegawai dengan ID = 97', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2021-10-29 14:30:48', '2021-10-29 14:30:48'),
	(35, 'default', 'Ubah Data Pegawai dengan ID = 97', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2021-10-29 14:33:39', '2021-10-29 14:33:39'),
	(36, 'default', 'Ubah Data Pegawai dengan ID = 97', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2021-10-29 14:35:31', '2021-10-29 14:35:31'),
	(37, 'default', 'Ubah Data Pegawai dengan ID = 97', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2021-10-29 14:35:48', '2021-10-29 14:35:48'),
	(38, 'default', 'Login', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2021-10-31 23:24:55', '2021-10-31 23:24:55'),
	(39, 'default', 'Login', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2021-11-01 07:55:21', '2021-11-01 07:55:21'),
	(40, 'default', 'Ubah Data Profil dengan ID = 1', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2021-11-01 07:57:18', '2021-11-01 07:57:18'),
	(41, 'default', 'Login', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2021-12-16 14:57:54', '2021-12-16 14:57:54'),
	(42, 'default', 'Log Out', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2021-12-16 14:58:01', '2021-12-16 14:58:01'),
	(43, 'default', 'Login', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-11 10:56:11', '2022-01-11 10:56:11'),
	(44, 'default', 'Ubah Data Profil dengan ID = 1', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-11 10:56:32', '2022-01-11 10:56:32'),
	(45, 'default', 'Tambah Data Group', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-11 12:59:37', '2022-01-11 12:59:37'),
	(46, 'default', 'Tambah Data Group', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-11 13:01:48', '2022-01-11 13:01:48'),
	(47, 'default', 'Tambah Data Group', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-11 13:01:57', '2022-01-11 13:01:57'),
	(48, 'default', 'Login', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-11 14:28:42', '2022-01-11 14:28:42'),
	(49, 'default', 'Log Out', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-11 14:56:59', '2022-01-11 14:56:59'),
	(50, 'default', 'Login', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-11 14:57:20', '2022-01-11 14:57:20'),
	(51, 'default', 'Ubah Data User dengan ID = 482', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-11 14:57:53', '2022-01-11 14:57:53'),
	(52, 'default', 'Log Out', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-11 14:57:56', '2022-01-11 14:57:56'),
	(53, 'default', 'Login', NULL, NULL, NULL, 'App\\Models\\User', 482, '[]', NULL, '2022-01-11 14:58:06', '2022-01-11 14:58:06'),
	(54, 'default', 'Log Out', NULL, NULL, NULL, 'App\\Models\\User', 482, '[]', NULL, '2022-01-11 15:32:51', '2022-01-11 15:32:51'),
	(55, 'default', 'Login', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-11 15:32:54', '2022-01-11 15:32:54'),
	(56, 'default', 'Login', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-12 10:01:34', '2022-01-12 10:01:34'),
	(57, 'default', 'Log Out', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-12 10:05:59', '2022-01-12 10:05:59'),
	(58, 'default', 'Login', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-12 10:06:01', '2022-01-12 10:06:01'),
	(59, 'default', 'Log Out', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-12 10:11:35', '2022-01-12 10:11:35'),
	(60, 'default', 'Login', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-12 10:11:53', '2022-01-12 10:11:53'),
	(61, 'default', 'Tambah Data Menu', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-12 10:51:15', '2022-01-12 10:51:15'),
	(62, 'default', 'Tambah Data Menu', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-12 10:52:26', '2022-01-12 10:52:26'),
	(63, 'default', 'Ubah Data Menu dengan ID = 4', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-12 11:02:21', '2022-01-12 11:02:21'),
	(64, 'default', 'Ubah Data Menu dengan ID = 4', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-12 11:02:25', '2022-01-12 11:02:25'),
	(65, 'default', 'Ubah Data Menu dengan ID = 4', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-12 11:02:30', '2022-01-12 11:02:30'),
	(66, 'default', 'Ubah Data Menu dengan ID = 4', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-12 11:02:41', '2022-01-12 11:02:41'),
	(67, 'default', 'Tambah Data Menu', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-12 11:04:48', '2022-01-12 11:04:48'),
	(68, 'default', 'Tambah Data Menu', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-12 11:05:31', '2022-01-12 11:05:31'),
	(69, 'default', 'Ubah Data Menu dengan ID = 4', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-12 11:11:39', '2022-01-12 11:11:39'),
	(70, 'default', 'Ubah Data Menu dengan ID = 4', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-12 11:11:44', '2022-01-12 11:11:44'),
	(71, 'default', 'Tambah Data Sub Menu', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-12 13:28:40', '2022-01-12 13:28:40'),
	(72, 'default', 'Tambah Data Sub Menu', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-12 13:29:55', '2022-01-12 13:29:55'),
	(73, 'default', 'Tambah Data Sub Menu', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-12 13:31:59', '2022-01-12 13:31:59'),
	(74, 'default', 'Ubah Data Sub Menu dengan ID = 1', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-12 13:39:50', '2022-01-12 13:39:50'),
	(75, 'default', 'Ubah Data Sub Menu dengan ID = 1', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-12 13:39:56', '2022-01-12 13:39:56'),
	(76, 'default', 'Ubah Data Sub Menu dengan ID = 1', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-12 13:40:07', '2022-01-12 13:40:07'),
	(77, 'default', 'Tambah Data Sub Menu', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-12 13:42:20', '2022-01-12 13:42:20'),
	(78, 'default', 'Tambah Data Sub Menu', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-12 13:43:01', '2022-01-12 13:43:01'),
	(79, 'default', 'Tambah Data Sub Menu', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-12 13:43:18', '2022-01-12 13:43:18'),
	(80, 'default', 'Login', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-13 10:13:03', '2022-01-13 10:13:03'),
	(81, 'default', 'Tambah Data Akses', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-13 11:00:18', '2022-01-13 11:00:18'),
	(82, 'default', 'Tambah Data Akses', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-13 11:00:23', '2022-01-13 11:00:23'),
	(83, 'default', 'Tambah Data Akses', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-13 11:02:25', '2022-01-13 11:02:25'),
	(84, 'default', 'Ubah Data Sub Menu dengan ID = 1', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-13 14:22:51', '2022-01-13 14:22:51'),
	(85, 'default', 'Ubah Data Sub Menu dengan ID = 1', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-13 14:23:00', '2022-01-13 14:23:00'),
	(86, 'default', 'Tambah Data Akses', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-13 14:35:05', '2022-01-13 14:35:05'),
	(87, 'default', 'Log Out', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-13 14:43:16', '2022-01-13 14:43:16'),
	(88, 'default', 'Login', NULL, NULL, NULL, 'App\\Models\\User', 482, '[]', NULL, '2022-01-13 14:43:27', '2022-01-13 14:43:27'),
	(89, 'default', 'Log Out', NULL, NULL, NULL, 'App\\Models\\User', 482, '[]', NULL, '2022-01-13 14:43:58', '2022-01-13 14:43:58'),
	(90, 'default', 'Login', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-13 14:44:02', '2022-01-13 14:44:02'),
	(91, 'default', 'Tambah Data Akses', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-13 14:44:29', '2022-01-13 14:44:29'),
	(92, 'default', 'Tambah Data Akses', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-13 14:44:57', '2022-01-13 14:44:57'),
	(93, 'default', 'Ubah Data Pengaturan', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-13 15:38:53', '2022-01-13 15:38:53'),
	(94, 'default', 'Login', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-14 09:56:30', '2022-01-14 09:56:30'),
	(95, 'default', 'Log Out', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-14 10:20:21', '2022-01-14 10:20:21'),
	(96, 'default', 'Login', NULL, NULL, NULL, 'App\\Models\\User', 482, '[]', NULL, '2022-01-14 10:20:30', '2022-01-14 10:20:30'),
	(97, 'default', 'Log Out', NULL, NULL, NULL, 'App\\Models\\User', 482, '[]', NULL, '2022-01-14 10:20:40', '2022-01-14 10:20:40'),
	(98, 'default', 'Login', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-14 10:20:43', '2022-01-14 10:20:43'),
	(99, 'default', 'Tambah Data Akses', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-14 10:21:01', '2022-01-14 10:21:01'),
	(100, 'default', 'Login', NULL, NULL, NULL, 'App\\Models\\User', 482, '[]', NULL, '2022-01-14 10:21:29', '2022-01-14 10:21:29'),
	(101, 'default', 'Ubah Data Menu dengan ID = 2', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-14 11:51:12', '2022-01-14 11:51:12'),
	(102, 'default', 'Ubah Data Menu dengan ID = 2', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-14 11:51:16', '2022-01-14 11:51:16'),
	(103, 'default', 'Login', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-14 14:57:06', '2022-01-14 14:57:06'),
	(104, 'default', 'Ubah Data Menu Akses dengan ID = 4', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-14 16:21:19', '2022-01-14 16:21:19'),
	(105, 'default', 'Ubah Data Menu Akses dengan ID = 4', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-14 16:21:43', '2022-01-14 16:21:43'),
	(106, 'default', 'Ubah Data Menu Akses dengan ID = 5', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-14 16:23:05', '2022-01-14 16:23:05'),
	(107, 'default', 'Ubah Data Menu Akses dengan ID = 4', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-14 16:23:23', '2022-01-14 16:23:23'),
	(108, 'default', 'Hapus Data Menu Akses dengan ID = 3', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-14 16:27:11', '2022-01-14 16:27:11'),
	(109, 'default', 'Tambah Data Menu Akses', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-14 16:27:55', '2022-01-14 16:27:55'),
	(110, 'default', 'Tambah Data Sub Menu Akses', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-14 17:23:31', '2022-01-14 17:23:31'),
	(111, 'default', 'Tambah Data Sub Menu Akses', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-14 17:26:16', '2022-01-14 17:26:16'),
	(112, 'default', 'Tambah Data Sub Menu Akses', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-14 17:26:47', '2022-01-14 17:26:47'),
	(113, 'default', 'Hapus Data Sub Menu Akses dengan ID = ', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-14 17:31:27', '2022-01-14 17:31:27'),
	(114, 'default', 'Hapus Data Sub Menu Akses dengan ID = ', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-14 17:32:28', '2022-01-14 17:32:28'),
	(115, 'default', 'Hapus Data Sub Menu Akses dengan ID = ', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-14 17:34:29', '2022-01-14 17:34:29'),
	(116, 'default', 'Hapus Data Sub Menu Akses dengan ID = 1', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-14 17:35:23', '2022-01-14 17:35:23'),
	(117, 'default', 'Ubah Data Sub Menu Akses dengan ID = 2', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-14 17:54:54', '2022-01-14 17:54:54'),
	(118, 'default', 'Ubah Data Sub Menu Akses dengan ID = 2', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-14 17:54:59', '2022-01-14 17:54:59'),
	(119, 'default', 'Ubah Data Sub Menu Akses dengan ID = 2', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-14 17:55:05', '2022-01-14 17:55:05'),
	(120, 'default', 'Hapus Data Menu dengan ID = 1', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-14 17:57:33', '2022-01-14 17:57:33'),
	(121, 'default', 'Hapus Data Menu dengan ID = 2', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-14 17:57:59', '2022-01-14 17:57:59'),
	(122, 'default', 'Hapus Data Menu dengan ID = 3', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-14 17:58:02', '2022-01-14 17:58:02'),
	(123, 'default', 'Tambah Data Menu', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-14 17:59:00', '2022-01-14 17:59:00'),
	(124, 'default', 'Tambah Data Menu Akses', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-14 17:59:17', '2022-01-14 17:59:17'),
	(125, 'default', 'Tambah Data Menu', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-14 18:22:35', '2022-01-14 18:22:35'),
	(126, 'default', 'Tambah Data Menu Akses', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-14 18:23:01', '2022-01-14 18:23:01'),
	(127, 'default', 'Ubah Data Menu dengan ID = 6', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-14 18:23:13', '2022-01-14 18:23:13'),
	(128, 'default', 'Ubah Data Pengaturan', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-14 19:11:47', '2022-01-14 19:11:47'),
	(129, 'default', 'Ubah Data Menu dengan ID = 5', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-14 19:12:19', '2022-01-14 19:12:19'),
	(130, 'default', 'Ubah Data Menu dengan ID = 5', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-14 19:12:32', '2022-01-14 19:12:32'),
	(131, 'default', 'Log Out', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-14 19:12:52', '2022-01-14 19:12:52'),
	(132, 'default', 'Login', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-14 19:54:24', '2022-01-14 19:54:24'),
	(133, 'default', 'Ubah Data Pengaturan', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-14 20:00:55', '2022-01-14 20:00:55'),
	(134, 'default', 'Ubah Data Sub Menu dengan ID = 6', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-14 20:01:35', '2022-01-14 20:01:35'),
	(135, 'default', 'Ubah Data Sub Menu dengan ID = 6', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-14 20:01:44', '2022-01-14 20:01:44'),
	(136, 'default', 'Login', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-15 17:29:42', '2022-01-15 17:29:42'),
	(137, 'default', 'Tambah Data Menu', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-15 17:31:03', '2022-01-15 17:31:03'),
	(138, 'default', 'Tambah Data Sub Menu', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-15 17:39:32', '2022-01-15 17:39:32'),
	(139, 'default', 'Tambah Data Menu Akses', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-15 17:46:20', '2022-01-15 17:46:20'),
	(140, 'default', 'Tambah Data Sub Menu Akses', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-15 18:02:06', '2022-01-15 18:02:06'),
	(141, 'default', 'Hapus Data Sub Menu Akses dengan ID = 3', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-15 18:07:48', '2022-01-15 18:07:48'),
	(142, 'default', 'Tambah Data Sub Menu Akses', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-15 19:29:04', '2022-01-15 19:29:04'),
	(143, 'default', 'Login', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-15 22:15:57', '2022-01-15 22:15:57'),
	(144, 'default', 'Ubah Data Sub Menu Akses dengan ID = 13', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-15 22:25:25', '2022-01-15 22:25:25'),
	(145, 'default', 'Ubah Data Sub Menu Akses dengan ID = 13', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-15 22:27:54', '2022-01-15 22:27:54'),
	(146, 'default', 'Ubah Data Sub Menu Akses dengan ID = 13', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-15 22:28:01', '2022-01-15 22:28:01'),
	(147, 'default', 'Ubah Data Sub Menu Akses dengan ID = 13', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-15 22:28:09', '2022-01-15 22:28:09'),
	(148, 'default', 'Ubah Data Sub Menu Akses dengan ID = 13', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-15 22:28:16', '2022-01-15 22:28:16'),
	(149, 'default', 'Ubah Data Sub Menu Akses dengan ID = 13', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-15 22:28:25', '2022-01-15 22:28:25'),
	(150, 'default', 'Ubah Data Sub Menu Akses dengan ID = 13', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-15 22:28:34', '2022-01-15 22:28:34'),
	(151, 'default', 'Ubah Data Sub Menu Akses dengan ID = 13', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-15 22:28:40', '2022-01-15 22:28:40'),
	(152, 'default', 'Tambah Data Sub Menu Akses', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-15 22:28:54', '2022-01-15 22:28:54'),
	(153, 'default', 'Tambah Data Sub Menu Akses', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-15 22:29:05', '2022-01-15 22:29:05'),
	(154, 'default', 'Login', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-16 00:29:15', '2022-01-16 00:29:15'),
	(155, 'default', 'Tambah Data Sub Menu Akses', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-16 00:34:34', '2022-01-16 00:34:34'),
	(156, 'default', 'Login', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-16 08:52:03', '2022-01-16 08:52:03'),
	(157, 'default', 'Log Out', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-16 08:52:34', '2022-01-16 08:52:34'),
	(158, 'default', 'Login', NULL, NULL, NULL, 'App\\Models\\User', 482, '[]', NULL, '2022-01-16 08:52:41', '2022-01-16 08:52:41'),
	(159, 'default', 'Login', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-16 11:39:18', '2022-01-16 11:39:18'),
	(160, 'default', 'Login', NULL, NULL, NULL, 'App\\Models\\User', 482, '[]', NULL, '2022-01-16 12:05:51', '2022-01-16 12:05:51'),
	(161, 'default', 'Login', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-16 18:13:45', '2022-01-16 18:13:45'),
	(162, 'default', 'Tambah Data Menu', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-16 18:43:46', '2022-01-16 18:43:46'),
	(163, 'default', 'Ubah Data Menu dengan ID = 4', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-16 18:44:21', '2022-01-16 18:44:21'),
	(164, 'default', 'Tambah Data Menu Akses', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-16 18:48:47', '2022-01-16 18:48:47'),
	(165, 'default', 'Hapus Data Menu dengan ID = 8', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-16 18:49:24', '2022-01-16 18:49:24'),
	(166, 'default', 'Ubah Data Menu dengan ID = 4', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-16 18:50:22', '2022-01-16 18:50:22'),
	(167, 'default', 'Login', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-17 10:48:51', '2022-01-17 10:48:51'),
	(168, 'default', 'Tambah Data Sub Menu Akses', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-17 10:50:06', '2022-01-17 10:50:06'),
	(169, 'default', 'Tambah Data Sub Menu Akses', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-17 10:50:22', '2022-01-17 10:50:22'),
	(170, 'default', 'Tambah Data Menu', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-17 10:50:48', '2022-01-17 10:50:48'),
	(171, 'default', 'Hapus Data Menu dengan ID = 9', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-17 10:51:16', '2022-01-17 10:51:16'),
	(172, 'default', 'Tambah Data Sub Menu Akses', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-17 10:51:55', '2022-01-17 10:51:55'),
	(173, 'default', 'Tambah Data Menu', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-17 10:53:20', '2022-01-17 10:53:20'),
	(174, 'default', 'Tambah Data Menu Akses', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-17 10:53:37', '2022-01-17 10:53:37'),
	(175, 'default', 'Hapus Data Menu dengan ID = 10', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-17 10:54:29', '2022-01-17 10:54:29'),
	(176, 'default', 'Tambah Data Menu', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-17 10:56:51', '2022-01-17 10:56:51'),
	(177, 'default', 'Tambah Data Sub Menu Akses', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-17 10:57:44', '2022-01-17 10:57:44'),
	(178, 'default', 'Tambah Data Sub Menu Akses', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-17 10:57:56', '2022-01-17 10:57:56'),
	(179, 'default', 'Tambah Data Sub Menu Akses', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-17 10:58:06', '2022-01-17 10:58:06'),
	(180, 'default', 'Tambah Data Menu Akses', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-17 10:58:18', '2022-01-17 10:58:18'),
	(181, 'default', 'Hapus Data Menu dengan ID = 11', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-17 10:59:12', '2022-01-17 10:59:12'),
	(182, 'default', 'Tambah Data Menu', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-17 10:59:32', '2022-01-17 10:59:32'),
	(183, 'default', 'Tambah Data Sub Menu', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-17 10:59:46', '2022-01-17 10:59:46'),
	(184, 'default', 'Tambah Data Menu Akses', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-17 11:00:28', '2022-01-17 11:00:28'),
	(185, 'default', 'Ubah Data Menu Akses dengan ID = 9', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-17 11:00:44', '2022-01-17 11:00:44'),
	(186, 'default', 'Tambah Data Sub Menu Akses', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-17 11:00:57', '2022-01-17 11:00:57'),
	(187, 'default', 'Hapus Data Sub Menu Akses dengan ID = 23', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-17 11:01:05', '2022-01-17 11:01:05'),
	(188, 'default', 'Tambah Data Sub Menu Akses', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-17 11:01:16', '2022-01-17 11:01:16'),
	(189, 'default', 'Ubah Data Sub Menu Akses dengan ID = 24', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-17 11:01:20', '2022-01-17 11:01:20'),
	(190, 'default', 'Hapus Data Menu Akses dengan ID = 9', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-17 11:02:06', '2022-01-17 11:02:06'),
	(191, 'default', 'Tambah Data Sub Menu Akses', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-17 11:07:17', '2022-01-17 11:07:17'),
	(192, 'default', 'Login', NULL, NULL, NULL, 'App\\Models\\User', 482, '[]', NULL, '2022-01-17 11:10:26', '2022-01-17 11:10:26'),
	(193, 'default', 'Tambah Data Menu Akses', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-17 11:11:56', '2022-01-17 11:11:56'),
	(194, 'default', 'Tambah Data Sub Menu Akses', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-17 11:12:16', '2022-01-17 11:12:16'),
	(195, 'default', 'Ubah Data Menu Akses dengan ID = 8', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-17 11:18:27', '2022-01-17 11:18:27'),
	(196, 'default', 'Ubah Data Menu Akses dengan ID = 8', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-17 11:18:37', '2022-01-17 11:18:37'),
	(197, 'default', 'Ubah Data Sub Menu Akses dengan ID = 21', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-17 11:30:08', '2022-01-17 11:30:08'),
	(198, 'default', 'Ubah Data Sub Menu Akses dengan ID = 21', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-17 11:30:19', '2022-01-17 11:30:19'),
	(199, 'default', 'Ubah Data Sub Menu Akses dengan ID = 21', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-17 11:30:29', '2022-01-17 11:30:29'),
	(200, 'default', 'Ubah Data Sub Menu Akses dengan ID = 21', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-17 11:30:40', '2022-01-17 11:30:40'),
	(201, 'default', 'Hapus Data Menu dengan ID = 12', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-17 11:31:16', '2022-01-17 11:31:16'),
	(202, 'default', 'Login', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-17 14:28:53', '2022-01-17 14:28:53'),
	(203, 'default', 'Log Out', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-17 14:52:02', '2022-01-17 14:52:02'),
	(204, 'default', 'Login', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-17 14:56:26', '2022-01-17 14:56:26'),
	(205, 'default', 'Ubah Data Pengaturan', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-17 15:08:50', '2022-01-17 15:08:50'),
	(206, 'default', 'Ubah Data Pengaturan', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-17 15:09:00', '2022-01-17 15:09:00'),
	(207, 'default', 'Log Out', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-17 15:09:13', '2022-01-17 15:09:13'),
	(208, 'default', 'Login', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-17 15:12:52', '2022-01-17 15:12:52'),
	(209, 'default', 'Ubah Data Pengaturan', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-17 15:14:42', '2022-01-17 15:14:42'),
	(210, 'default', 'Ubah Data Pengaturan', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-17 15:16:43', '2022-01-17 15:16:43'),
	(211, 'default', 'Log Out', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-17 15:17:02', '2022-01-17 15:17:02'),
	(212, 'default', 'Login', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-17 15:21:28', '2022-01-17 15:21:28'),
	(213, 'default', 'Login', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-17 16:01:54', '2022-01-17 16:01:54'),
	(214, 'default', 'Login', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-17 16:02:01', '2022-01-17 16:02:01'),
	(215, 'default', 'Login', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-17 22:29:54', '2022-01-17 22:29:54'),
	(216, 'default', 'Login', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-18 10:06:54', '2022-01-18 10:06:54'),
	(217, 'default', 'Ubah Data Pengaturan', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-18 10:09:53', '2022-01-18 10:09:53'),
	(218, 'default', 'Ubah Data Pengaturan', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-18 10:10:05', '2022-01-18 10:10:05'),
	(219, 'default', 'Log Out', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-18 10:10:20', '2022-01-18 10:10:20'),
	(220, 'default', 'Login', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-18 10:11:24', '2022-01-18 10:11:24'),
	(221, 'default', 'Log Out', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-18 10:59:26', '2022-01-18 10:59:26'),
	(222, 'default', 'Login', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-18 10:59:36', '2022-01-18 10:59:36'),
	(223, 'default', 'Ubah Data Pengaturan', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-18 11:19:18', '2022-01-18 11:19:18'),
	(224, 'default', 'Log Out', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-18 11:19:24', '2022-01-18 11:19:24'),
	(225, 'default', 'Login', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-18 11:19:31', '2022-01-18 11:19:31'),
	(226, 'default', 'Ubah Data User dengan ID = 482', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-18 13:09:18', '2022-01-18 13:09:18'),
	(227, 'default', 'Ubah Data User dengan ID = 482', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-18 13:09:23', '2022-01-18 13:09:23'),
	(228, 'default', 'Tambah Data Menu', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-18 13:24:06', '2022-01-18 13:24:06'),
	(229, 'default', 'Hapus Data Menu dengan ID = 7', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-18 13:24:19', '2022-01-18 13:24:19'),
	(230, 'default', 'Hapus Data Menu dengan ID = 6', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-18 13:24:22', '2022-01-18 13:24:22'),
	(231, 'default', 'Ubah Data Menu dengan ID = 13', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-18 13:28:01', '2022-01-18 13:28:01'),
	(232, 'default', 'Tambah Data Sub Menu', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-18 13:47:53', '2022-01-18 13:47:53'),
	(233, 'default', 'Tambah Data Sub Menu', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-18 13:49:21', '2022-01-18 13:49:21'),
	(234, 'default', 'Hapus Data Sub Menu dengan ID = 12', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-18 13:50:34', '2022-01-18 13:50:34'),
	(235, 'default', 'Ubah Data Sub Menu dengan ID = 11', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-18 13:51:41', '2022-01-18 13:51:41'),
	(236, 'default', 'Ubah Data Sub Menu dengan ID = 11', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-18 13:51:45', '2022-01-18 13:51:45'),
	(237, 'default', 'Tambah Data Sub Menu', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-18 13:52:01', '2022-01-18 13:52:01'),
	(238, 'default', 'Hapus Data Sub Menu dengan ID = 13', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-18 13:52:07', '2022-01-18 13:52:07'),
	(239, 'default', 'Tambah Data Sub Menu', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-18 13:52:55', '2022-01-18 13:52:55'),
	(240, 'default', 'Hapus Data Sub Menu dengan ID = 14', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-18 13:53:00', '2022-01-18 13:53:00'),
	(241, 'default', 'Tambah Data Group', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-18 13:59:37', '2022-01-18 13:59:37'),
	(242, 'default', 'Ubah Data Group dengan ID = 3', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-18 14:04:38', '2022-01-18 14:04:38'),
	(243, 'default', 'Ubah Data Group dengan ID = 3', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-18 14:04:43', '2022-01-18 14:04:43'),
	(244, 'default', 'Tambah Data Menu Akses', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-18 15:31:31', '2022-01-18 15:31:31'),
	(245, 'default', 'Ubah Data Menu Akses dengan ID = 15', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-18 15:37:02', '2022-01-18 15:37:02'),
	(246, 'default', 'Ubah Data Menu Akses dengan ID = 7', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-18 15:37:14', '2022-01-18 15:37:14'),
	(247, 'default', 'Ubah Data Menu Akses dengan ID = 7', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-18 15:37:21', '2022-01-18 15:37:21'),
	(248, 'default', 'Tambah Data Sub Menu Akses', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-18 15:44:16', '2022-01-18 15:44:16'),
	(249, 'default', 'Ubah Data Sub Menu Akses dengan ID = 27', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-18 15:49:09', '2022-01-18 15:49:09'),
	(250, 'default', 'Ubah Data Menu dengan ID = 13', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-18 15:49:42', '2022-01-18 15:49:42'),
	(251, 'default', 'Ubah Data Menu dengan ID = 5', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-18 15:49:52', '2022-01-18 15:49:52'),
	(252, 'default', 'Ubah Data Menu dengan ID = 13', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-18 15:50:16', '2022-01-18 15:50:16'),
	(253, 'default', 'Tambah Data Menu Akses', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-18 15:56:25', '2022-01-18 15:56:25'),
	(254, 'default', 'Tambah Data Sub Menu Akses', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-18 15:56:42', '2022-01-18 15:56:42'),
	(255, 'default', 'Tambah Data Sub Menu', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-18 16:00:15', '2022-01-18 16:00:15'),
	(256, 'default', 'Ubah Data Sub Menu dengan ID = 15', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-18 16:00:28', '2022-01-18 16:00:28'),
	(257, 'default', 'Hapus Data Group dengan ID = 3', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-18 16:00:49', '2022-01-18 16:00:49'),
	(258, 'default', 'Ubah Data Group dengan ID = 2', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-18 16:00:57', '2022-01-18 16:00:57'),
	(259, 'default', 'Ubah Data Group dengan ID = 1', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-18 16:01:05', '2022-01-18 16:01:05'),
	(260, 'default', 'Tambah Data Sub Menu Akses', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-18 16:01:57', '2022-01-18 16:01:57'),
	(261, 'default', 'Tambah Data Sub Menu Akses', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-18 16:02:15', '2022-01-18 16:02:15'),
	(262, 'default', 'Log Out', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-18 16:02:53', '2022-01-18 16:02:53'),
	(263, 'default', 'Login', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-18 16:03:00', '2022-01-18 16:03:00'),
	(264, 'default', 'Log Out', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-18 18:21:53', '2022-01-18 18:21:53'),
	(265, 'default', 'Login', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-18 19:43:58', '2022-01-18 19:43:58'),
	(266, 'default', 'Log Out', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-18 19:45:21', '2022-01-18 19:45:21'),
	(267, 'default', 'Login', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-18 19:50:18', '2022-01-18 19:50:18'),
	(268, 'default', 'Ubah Data Pengaturan', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-18 19:50:37', '2022-01-18 19:50:37'),
	(269, 'default', 'Ubah Data Pengaturan', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-18 20:00:31', '2022-01-18 20:00:31'),
	(270, 'default', 'Login', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-18 20:22:13', '2022-01-18 20:22:13'),
	(271, 'default', 'Log Out', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-18 20:22:18', '2022-01-18 20:22:18'),
	(272, 'default', 'Login', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-18 20:22:47', '2022-01-18 20:22:47'),
	(273, 'default', 'Log Out', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-18 20:26:40', '2022-01-18 20:26:40'),
	(274, 'default', 'Login', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-18 20:35:21', '2022-01-18 20:35:21'),
	(275, 'default', 'Log Out', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-18 20:35:24', '2022-01-18 20:35:24'),
	(276, 'default', 'Login', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-18 20:39:49', '2022-01-18 20:39:49'),
	(277, 'default', 'Log Out', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-18 20:39:52', '2022-01-18 20:39:52'),
	(278, 'default', 'Login', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-18 21:21:41', '2022-01-18 21:21:41'),
	(279, 'default', 'Log Out', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-18 21:21:45', '2022-01-18 21:21:45'),
	(280, 'default', 'Login', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-18 21:22:14', '2022-01-18 21:22:14'),
	(281, 'default', 'Log Out', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-18 21:22:17', '2022-01-18 21:22:17'),
	(282, 'default', 'Login', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-18 21:22:52', '2022-01-18 21:22:52'),
	(283, 'default', 'Log Out', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-18 21:22:54', '2022-01-18 21:22:54'),
	(284, 'default', 'Login', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-18 21:25:12', '2022-01-18 21:25:12'),
	(285, 'default', 'Log Out', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-18 21:25:14', '2022-01-18 21:25:14'),
	(286, 'default', 'Login', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-18 21:25:25', '2022-01-18 21:25:25'),
	(287, 'default', 'Log Out', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-18 21:25:27', '2022-01-18 21:25:27'),
	(288, 'default', 'Login', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-18 21:45:22', '2022-01-18 21:45:22'),
	(289, 'default', 'Log Out', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-18 21:45:25', '2022-01-18 21:45:25'),
	(290, 'default', 'Login', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-18 21:45:30', '2022-01-18 21:45:30'),
	(291, 'default', 'Log Out', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-18 21:45:32', '2022-01-18 21:45:32'),
	(292, 'default', 'Login', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-18 21:47:03', '2022-01-18 21:47:03'),
	(293, 'default', 'Log Out', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-18 21:47:06', '2022-01-18 21:47:06'),
	(294, 'default', 'Login', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-18 21:54:50', '2022-01-18 21:54:50'),
	(295, 'default', 'Login', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-18 21:56:41', '2022-01-18 21:56:41'),
	(296, 'default', 'Log Out', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-18 21:56:44', '2022-01-18 21:56:44'),
	(297, 'default', 'Login', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-18 22:00:08', '2022-01-18 22:00:08'),
	(298, 'default', 'Log Out', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-18 22:00:10', '2022-01-18 22:00:10'),
	(299, 'default', 'Login', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-18 22:00:41', '2022-01-18 22:00:41'),
	(300, 'default', 'Log Out', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-18 22:00:44', '2022-01-18 22:00:44'),
	(301, 'default', 'Login', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-18 22:04:15', '2022-01-18 22:04:15'),
	(302, 'default', 'Log Out', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-18 22:04:37', '2022-01-18 22:04:37'),
	(303, 'default', 'Login', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-18 22:08:15', '2022-01-18 22:08:15'),
	(304, 'default', 'Log Out', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-18 22:08:18', '2022-01-18 22:08:18'),
	(305, 'default', 'Login', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-18 22:14:02', '2022-01-18 22:14:02'),
	(306, 'default', 'Log Out', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-18 22:14:06', '2022-01-18 22:14:06'),
	(307, 'default', 'Login', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-18 22:14:12', '2022-01-18 22:14:12'),
	(308, 'default', 'Log Out', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-18 22:14:28', '2022-01-18 22:14:28'),
	(309, 'default', 'Log Out', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-18 22:14:32', '2022-01-18 22:14:32'),
	(310, 'default', 'Log Out', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-18 22:14:43', '2022-01-18 22:14:43'),
	(311, 'default', 'Login', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-18 22:17:00', '2022-01-18 22:17:00'),
	(312, 'default', 'Log Out', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-18 22:17:13', '2022-01-18 22:17:13'),
	(313, 'default', 'Login', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-18 22:17:18', '2022-01-18 22:17:18'),
	(314, 'default', 'Log Out', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-18 22:17:21', '2022-01-18 22:17:21'),
	(315, 'default', 'Login', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-18 22:18:05', '2022-01-18 22:18:05'),
	(316, 'default', 'Log Out', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-18 22:18:25', '2022-01-18 22:18:25'),
	(317, 'default', 'Login', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-18 22:22:26', '2022-01-18 22:22:26'),
	(318, 'default', 'Login', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-18 22:23:22', '2022-01-18 22:23:22'),
	(319, 'default', 'Log Out', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-18 22:23:40', '2022-01-18 22:23:40'),
	(320, 'default', 'Login', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-18 22:23:44', '2022-01-18 22:23:44'),
	(321, 'default', 'Log Out', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-18 22:23:52', '2022-01-18 22:23:52'),
	(322, 'default', 'Login', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-18 22:23:56', '2022-01-18 22:23:56'),
	(323, 'default', 'Login', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-18 22:25:13', '2022-01-18 22:25:13'),
	(324, 'default', 'Log Out', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-18 22:25:19', '2022-01-18 22:25:19'),
	(325, 'default', 'Login', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-18 22:25:24', '2022-01-18 22:25:24'),
	(326, 'default', 'Log Out', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-18 22:29:17', '2022-01-18 22:29:17'),
	(327, 'default', 'Log Out', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-18 22:29:25', '2022-01-18 22:29:25'),
	(328, 'default', 'Login', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-18 22:29:29', '2022-01-18 22:29:29'),
	(329, 'default', 'Log Out', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-18 22:29:35', '2022-01-18 22:29:35'),
	(330, 'default', 'Login', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-18 22:29:38', '2022-01-18 22:29:38'),
	(331, 'default', 'Log Out', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-18 22:46:28', '2022-01-18 22:46:28'),
	(332, 'default', 'Login', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-18 22:47:24', '2022-01-18 22:47:24'),
	(333, 'default', 'Log Out', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-18 22:47:33', '2022-01-18 22:47:33'),
	(334, 'default', 'Login', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-18 22:47:36', '2022-01-18 22:47:36'),
	(335, 'default', 'Log Out', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-18 22:58:07', '2022-01-18 22:58:07'),
	(336, 'default', 'Login', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-18 22:58:11', '2022-01-18 22:58:11'),
	(337, 'default', 'Log Out', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-18 23:01:25', '2022-01-18 23:01:25'),
	(338, 'default', 'Login', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-18 23:01:35', '2022-01-18 23:01:35'),
	(339, 'default', 'Login', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-19 08:10:20', '2022-01-19 08:10:20'),
	(340, 'default', 'Tambah Data Sub Menu', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-19 12:08:49', '2022-01-19 12:08:49'),
	(341, 'default', 'Ubah Data Sub Menu dengan ID = 15', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-19 12:09:04', '2022-01-19 12:09:04'),
	(342, 'default', 'Ubah Data Sub Menu dengan ID = 11', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-19 12:09:43', '2022-01-19 12:09:43'),
	(343, 'default', 'Ubah Data Sub Menu dengan ID = 16', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-19 12:09:56', '2022-01-19 12:09:56'),
	(344, 'default', 'Ubah Data Sub Menu dengan ID = 11', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-19 12:17:37', '2022-01-19 12:17:37'),
	(345, 'default', 'Ubah Data Sub Menu dengan ID = 15', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-19 12:18:18', '2022-01-19 12:18:18'),
	(346, 'default', 'Tambah Data Sub Menu Akses', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-19 12:19:38', '2022-01-19 12:19:38'),
	(347, 'default', 'Tambah Data Menu', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-19 12:20:35', '2022-01-19 12:20:35'),
	(348, 'default', 'Ubah Data Menu dengan ID = 14', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-19 12:21:35', '2022-01-19 12:21:35'),
	(349, 'default', 'Tambah Data Menu Akses', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-19 12:22:00', '2022-01-19 12:22:00'),
	(350, 'default', 'Tambah Data Sub Menu', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-19 12:22:43', '2022-01-19 12:22:43'),
	(351, 'default', 'Tambah Data Sub Menu', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-19 12:22:55', '2022-01-19 12:22:55'),
	(352, 'default', 'Tambah Data Sub Menu Akses', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-19 12:23:15', '2022-01-19 12:23:15'),
	(353, 'default', 'Tambah Data Sub Menu Akses', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-19 12:23:28', '2022-01-19 12:23:28'),
	(354, 'default', 'Ubah Data Menu dengan ID = 14', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-19 12:23:43', '2022-01-19 12:23:43'),
	(355, 'default', 'Tambah Data Sub Menu', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-19 12:29:50', '2022-01-19 12:29:50'),
	(356, 'default', 'Ubah Data Sub Menu dengan ID = 11', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-19 12:30:02', '2022-01-19 12:30:02'),
	(357, 'default', 'Ubah Data Sub Menu dengan ID = 15', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-19 12:30:09', '2022-01-19 12:30:09'),
	(358, 'default', 'Ubah Data Sub Menu dengan ID = 19', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-19 12:30:14', '2022-01-19 12:30:14'),
	(359, 'default', 'Tambah Data Sub Menu', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-19 12:31:13', '2022-01-19 12:31:13'),
	(360, 'default', 'Tambah Data Sub Menu', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-19 12:34:37', '2022-01-19 12:34:37'),
	(361, 'default', 'Tambah Data Sub Menu Akses', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-19 12:36:52', '2022-01-19 12:36:52'),
	(362, 'default', 'Tambah Data Sub Menu Akses', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-19 12:37:05', '2022-01-19 12:37:05'),
	(363, 'default', 'Tambah Data Sub Menu Akses', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-19 12:37:24', '2022-01-19 12:37:24'),
	(364, 'default', 'Tambah Data Sub Menu', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-19 12:56:35', '2022-01-19 12:56:35'),
	(365, 'default', 'Tambah Data Sub Menu Akses', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2022-01-19 12:57:01', '2022-01-19 12:57:01');
/*!40000 ALTER TABLE `activity_log` ENABLE KEYS */;

-- membuang struktur untuk table db_parau.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel db_parau.failed_jobs: ~0 rows (lebih kurang)
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;

-- membuang struktur untuk table db_parau.group_tbl
CREATE TABLE IF NOT EXISTS `group_tbl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_name` varchar(18) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `user_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- Membuang data untuk tabel db_parau.group_tbl: ~2 rows (lebih kurang)
/*!40000 ALTER TABLE `group_tbl` DISABLE KEYS */;
INSERT INTO `group_tbl` (`id`, `group_name`, `status`, `user_id`, `created_at`, `updated_at`) VALUES
	(1, 'Editor', 0, 1, '2022-01-11 13:01:48', '2022-01-18 16:01:05'),
	(2, 'Kasir', 0, 1, '2022-01-11 13:01:57', '2022-01-18 16:00:57');
/*!40000 ALTER TABLE `group_tbl` ENABLE KEYS */;

-- membuang struktur untuk table db_parau.menu_access_tbl
CREATE TABLE IF NOT EXISTS `menu_access_tbl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(11) NOT NULL DEFAULT 0,
  `menu_id` int(11) NOT NULL DEFAULT 0,
  `create` int(11) NOT NULL DEFAULT 0,
  `read` int(11) NOT NULL DEFAULT 0,
  `update` int(11) NOT NULL DEFAULT 0,
  `delete` int(11) NOT NULL DEFAULT 0,
  `print` int(11) NOT NULL DEFAULT 0,
  `user_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `group_id` (`group_id`),
  KEY `menu_id` (`menu_id`),
  CONSTRAINT `FK_access_tbl_group_tbl` FOREIGN KEY (`group_id`) REFERENCES `group_tbl` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_access_tbl_menu_tbl` FOREIGN KEY (`menu_id`) REFERENCES `menu_tbl` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- Membuang data untuk tabel db_parau.menu_access_tbl: ~5 rows (lebih kurang)
/*!40000 ALTER TABLE `menu_access_tbl` DISABLE KEYS */;
INSERT INTO `menu_access_tbl` (`id`, `group_id`, `menu_id`, `create`, `read`, `update`, `delete`, `print`, `user_id`, `created_at`, `updated_at`) VALUES
	(1, 1, 4, 1, 1, 1, 1, 1, 1, '2022-01-13 11:02:25', '2022-01-13 11:02:25'),
	(7, 1, 5, 1, 1, 1, 1, 1, 1, '2022-01-14 17:59:17', '2022-01-18 15:37:21'),
	(15, 1, 13, 1, 1, 1, 0, 0, 1, '2022-01-18 15:31:31', '2022-01-18 15:37:02'),
	(17, 1, 14, 1, 1, 1, 1, 1, 1, '2022-01-19 12:22:00', '2022-01-19 12:22:00');
/*!40000 ALTER TABLE `menu_access_tbl` ENABLE KEYS */;

-- membuang struktur untuk table db_parau.menu_tbl
CREATE TABLE IF NOT EXISTS `menu_tbl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_name` varchar(18) DEFAULT NULL,
  `link` varchar(50) DEFAULT NULL,
  `attribute` varchar(50) DEFAULT NULL,
  `position` int(11) NOT NULL DEFAULT 0,
  `desc` tinytext DEFAULT NULL,
  `category` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 0,
  `user_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- Membuang data untuk tabel db_parau.menu_tbl: ~4 rows (lebih kurang)
/*!40000 ALTER TABLE `menu_tbl` DISABLE KEYS */;
INSERT INTO `menu_tbl` (`id`, `menu_name`, `link`, `attribute`, `position`, `desc`, `category`, `status`, `user_id`, `created_at`, `updated_at`) VALUES
	(4, 'Pengaturan', '#', 'fa fa-cogs', 4, NULL, 1, 1, 1, '2022-01-12 11:05:31', '2022-01-16 18:50:22'),
	(5, 'Log Activity', 'log', 'fa fa-clock', 3, NULL, 2, 1, 1, '2022-01-14 17:59:00', '2022-01-14 19:12:32'),
	(13, 'Manajemen Stok', '#', 'fa fa-list', 1, NULL, 2, 1, 1, '2022-01-18 13:24:06', '2022-01-18 15:50:16'),
	(14, 'Laporan', '#', 'fa fa-list', 2, NULL, 2, 1, 1, '2022-01-19 12:20:35', '2022-01-19 12:23:43');
/*!40000 ALTER TABLE `menu_tbl` ENABLE KEYS */;

-- membuang struktur untuk table db_parau.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel db_parau.migrations: ~10 rows (lebih kurang)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_resets_table', 1),
	(3, '2019_08_19_000000_create_failed_jobs_table', 1),
	(4, '2014_10_12_200000_add_two_factor_columns_to_users_table', 2),
	(5, '2019_12_14_000001_create_personal_access_tokens_table', 2),
	(6, '2021_04_05_060844_create_sessions_table', 2),
	(7, '2021_05_11_132318_create_events_table', 3),
	(8, '2021_10_28_132348_create_activity_log_table', 4),
	(9, '2021_10_28_132349_add_event_column_to_activity_log_table', 4),
	(10, '2021_10_28_132350_add_batch_uuid_column_to_activity_log_table', 4);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- membuang struktur untuk table db_parau.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel db_parau.password_resets: ~0 rows (lebih kurang)
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;

-- membuang struktur untuk table db_parau.pegawai_tbl
CREATE TABLE IF NOT EXISTS `pegawai_tbl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nip` varchar(18) DEFAULT NULL,
  `nama_pegawai` varchar(100) DEFAULT NULL,
  `tempat_lahir` varchar(50) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `jenis_kelamin` varchar(50) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `agama` varchar(300) DEFAULT NULL,
  `gol_darah` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `foto_formal` varchar(50) DEFAULT NULL,
  `foto_kedinasan` varchar(50) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `status_hapus` int(11) DEFAULT 0,
  `user_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=98 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- Membuang data untuk tabel db_parau.pegawai_tbl: ~94 rows (lebih kurang)
/*!40000 ALTER TABLE `pegawai_tbl` DISABLE KEYS */;
INSERT INTO `pegawai_tbl` (`id`, `nip`, `nama_pegawai`, `tempat_lahir`, `tanggal_lahir`, `jenis_kelamin`, `alamat`, `agama`, `gol_darah`, `email`, `foto_formal`, `foto_kedinasan`, `status`, `status_hapus`, `user_id`, `created_at`, `updated_at`) VALUES
	(1, '196406211985032009', 'Hj. Sitti Saleha, SE, M.Si', 'sasa', '1964-06-21', 'Wanita', 'ssa', 'Islam', NULL, 'a@gmail.com', '1635393285.jpg', '1635393266.jpg', 'PNS', 0, 1, '2021-05-03 14:20:18', '2021-10-28 11:54:45'),
	(2, '196412311998011000', 'Ir. Laode Hamalin, M.Si', NULL, '1970-01-01', 'Pria', NULL, NULL, NULL, NULL, NULL, NULL, 'PNS', 0, NULL, '2021-05-03 14:20:18', '2021-06-21 01:18:44'),
	(3, '196312301986072000', 'Wa Ode Nuryani, SE', NULL, '1963-12-30', 'Wanita', NULL, NULL, NULL, NULL, NULL, NULL, 'PNS', 0, NULL, '2021-05-03 14:20:18', '2021-05-03 14:20:18'),
	(4, '196602011984111000', 'Sutomo, SP, M. Si', NULL, '1966-02-01', 'Pria', NULL, NULL, NULL, NULL, NULL, NULL, 'PNS', 0, NULL, '2021-05-03 14:20:18', '2021-05-03 14:20:18'),
	(5, '196302081993031000', 'Ir. Irmanuddin', NULL, '1963-02-08', 'Pria', NULL, NULL, NULL, NULL, NULL, NULL, 'PNS', 0, NULL, '2021-05-03 14:20:18', '2021-05-03 14:20:18'),
	(6, '196412301994031000', 'Ir. Sapoan, M.Si', NULL, '1970-01-01', 'Pria', NULL, NULL, NULL, NULL, NULL, NULL, 'PNS', 0, NULL, '2021-05-03 14:20:18', '2021-06-21 02:34:09'),
	(7, '196207171983022000', 'Rukmini, SE', NULL, '1962-07-17', 'Wanita', NULL, NULL, NULL, NULL, NULL, NULL, 'PNS', 0, NULL, '2021-05-03 14:20:18', '2021-05-03 14:20:18'),
	(8, '196504101985031000', 'Najamuddin Pidani,S.Sos', NULL, '1965-04-10', 'Pria', NULL, NULL, NULL, NULL, NULL, NULL, 'PNS', 0, NULL, '2021-05-03 14:20:18', '2021-05-03 14:20:18'),
	(9, '198005222006041000', 'La Ode. Muh. Rusdin Jaya, S.IP, M.Si', NULL, '1980-05-22', 'Pria', NULL, NULL, NULL, NULL, NULL, NULL, 'PNS', 0, NULL, '2021-05-03 14:20:18', '2021-05-03 14:20:18'),
	(10, '196608121994041000', 'Drs. Muslimin', NULL, '1966-08-12', 'Pria', NULL, NULL, NULL, NULL, NULL, NULL, 'PNS', 0, NULL, '2021-05-03 14:20:18', '2021-05-03 14:20:18'),
	(11, '196605291995031000', 'Sulkifli Saleh,ST.M.Si', NULL, '1966-05-29', 'Pria', NULL, NULL, NULL, NULL, NULL, NULL, 'PNS', 0, NULL, '2021-05-03 14:20:18', '2021-05-03 14:20:18'),
	(12, '196603071994032000', 'Hasnawati, SE', NULL, '1966-03-07', 'Wanita', NULL, NULL, NULL, NULL, NULL, NULL, 'PNS', 0, NULL, '2021-05-03 14:20:18', '2021-05-03 14:20:18'),
	(13, '196605101995032000', 'Andi Indriani P.U, SH', NULL, '1966-11-10', 'Wanita', NULL, NULL, NULL, NULL, NULL, NULL, 'PNS', 0, NULL, '2021-05-03 14:20:18', '2021-05-03 14:20:18'),
	(14, '197102211991032000', 'Darmawati Gamma, SH', NULL, '1971-02-21', 'Wanita', NULL, NULL, NULL, NULL, NULL, NULL, 'PNS', 0, NULL, '2021-05-03 14:20:18', '2021-05-03 14:20:18'),
	(15, '196303021985032000', 'Nursan, S.Sos', NULL, '1963-02-03', 'Wanita', NULL, NULL, NULL, NULL, NULL, NULL, 'PNS', 0, NULL, '2021-05-03 14:20:18', '2021-05-03 14:20:18'),
	(16, '196412311985031000', 'Kasman,S.Pd', NULL, '1964-12-12', 'Pria', NULL, NULL, NULL, NULL, NULL, NULL, 'PNS', 0, NULL, '2021-05-03 14:20:19', '2021-05-03 14:20:19'),
	(17, '196712311993111000', 'Abdul Latif, S.Sos', NULL, '1967-12-12', 'Pria', NULL, NULL, NULL, NULL, NULL, NULL, 'PNS', 0, NULL, '2021-05-03 14:20:19', '2021-05-03 14:20:19'),
	(18, '197312262001121000', 'Monasman, ST', 'uuu', '1973-12-26', 'Pria', 'uuu', 'Islam', 'A', NULL, NULL, NULL, 'PNS', 0, 1, '2021-05-03 14:20:19', '2021-10-28 12:02:52'),
	(19, '197605252001122000', 'Nahrida, ST', NULL, '1976-05-25', 'Wanita', NULL, NULL, NULL, NULL, NULL, NULL, 'PNS', 0, NULL, '2021-05-03 14:20:19', '2021-05-03 14:20:19'),
	(20, '196508081994032000', 'Tina Sidupa, S.E', NULL, '1965-08-08', 'Wanita', NULL, NULL, NULL, NULL, NULL, NULL, 'PNS', 0, NULL, '2021-05-03 14:20:19', '2021-05-03 14:20:19'),
	(21, '196705271994031000', 'La Ode Amirul Mukminin, A.Md', NULL, '1967-05-27', 'Pria', NULL, NULL, NULL, NULL, NULL, NULL, 'PNS', 0, NULL, '2021-05-03 14:20:19', '2021-05-03 14:20:19'),
	(22, '196602182007012000', 'Sachiko Isamu, SE', NULL, '1966-02-18', 'Wanita', NULL, NULL, NULL, NULL, NULL, NULL, 'PNS', 0, NULL, '2021-05-03 14:20:19', '2021-05-03 14:20:19'),
	(23, '197301012006041000', 'Akra Sipa,ST', NULL, '1973-01-01', 'Pria', NULL, NULL, NULL, NULL, NULL, NULL, 'PNS', 0, NULL, '2021-05-03 14:20:19', '2021-05-03 14:20:19'),
	(24, '198011212005022000', 'Veradela Nandha Tiara, ST', NULL, '1980-11-21', 'Wanita', NULL, NULL, NULL, NULL, NULL, NULL, 'PNS', 0, NULL, '2021-05-03 14:20:19', '2021-05-03 14:20:19'),
	(25, '197006062005022000', 'Halimah Saleh Putri,SH', NULL, '1970-06-03', 'Wanita', NULL, NULL, NULL, NULL, NULL, NULL, 'PNS', 0, NULL, '2021-05-03 14:20:19', '2021-05-03 14:20:19'),
	(26, '197809272002121000', 'Adyanto Halyawan, S.E', NULL, '1978-09-27', 'Pria', NULL, NULL, NULL, NULL, NULL, NULL, 'PNS', 0, NULL, '2021-05-03 14:20:19', '2021-05-03 14:20:19'),
	(27, '197709102006042000', 'Wahyuni, S.Si', NULL, '1977-09-10', 'Wanita', NULL, NULL, NULL, NULL, NULL, NULL, 'PNS', 0, NULL, '2021-05-03 14:20:19', '2021-05-03 14:20:19'),
	(28, '198305062011011000', 'Muh. Yasser Tuwu, SE., M.Sc', NULL, '1983-05-06', 'Pria', NULL, NULL, NULL, NULL, NULL, NULL, 'PNS', 0, NULL, '2021-05-03 14:20:19', '2021-05-03 14:20:19'),
	(29, '198404062011011000', 'La Ode Muh. Fitrah Arsyad, SE. M. Si', NULL, '1984-04-06', 'Pria', NULL, NULL, NULL, NULL, NULL, NULL, 'PNS', 0, NULL, '2021-05-03 14:20:19', '2021-05-03 14:20:19'),
	(30, '196410101988011000', 'Haryanto', NULL, '1964-10-10', 'Pria', NULL, NULL, NULL, NULL, NULL, NULL, 'PNS', 0, NULL, '2021-05-03 14:20:19', '2021-05-03 14:20:19'),
	(31, '197009181996031000', 'Moh. Iskandar Azis, A.Md', NULL, '1970-09-18', 'Pria', NULL, NULL, NULL, NULL, NULL, NULL, 'PNS', 0, NULL, '2021-05-03 14:20:20', '2021-05-03 14:20:20'),
	(32, '198205212006041000', 'Kemal Jusra, S.Si, M.Si', NULL, '1982-05-21', 'Pria', NULL, NULL, NULL, NULL, NULL, NULL, 'PNS', 0, NULL, '2021-05-03 14:20:20', '2021-05-03 14:20:20'),
	(33, '196812311994031000', 'Khaidir, S.Si', NULL, '1968-12-31', 'Pria', NULL, NULL, NULL, NULL, NULL, NULL, 'PNS', 0, NULL, '2021-05-03 14:20:20', '2021-05-03 14:20:20'),
	(34, '198011112010012000', 'Rosmaidar HS S.Sos', NULL, '1980-11-14', 'Wanita', NULL, NULL, NULL, NULL, NULL, NULL, 'PNS', 0, NULL, '2021-05-03 14:20:20', '2021-05-03 14:20:20'),
	(35, '197809212010011000', 'Oon Sulfikar,SH.MM', NULL, '1978-09-21', 'Pria', NULL, NULL, NULL, NULL, NULL, NULL, 'PNS', 0, NULL, '2021-05-03 14:20:20', '2021-05-03 14:20:20'),
	(36, '197810052008012000', 'Siti Nurhanti, S.Pi', NULL, '1978-10-05', 'Wanita', NULL, NULL, NULL, NULL, NULL, NULL, 'PNS', 0, NULL, '2021-05-03 14:20:20', '2021-05-03 14:20:20'),
	(37, '198408112010012000', 'Andi Zakiah Wahidah, ST. M.Si', NULL, '1984-08-11', 'Wanita', NULL, NULL, NULL, NULL, NULL, NULL, 'PNS', 0, NULL, '2021-05-03 14:20:20', '2021-05-03 14:20:20'),
	(38, '198411072008032000', 'Anisyah Ringgasa, S.Si', NULL, '1984-11-07', 'Wanita', NULL, NULL, NULL, NULL, NULL, NULL, 'PNS', 0, NULL, '2021-05-03 14:20:20', '2021-05-03 14:20:20'),
	(39, '197803162008011000', 'Hasmindar, S.P', NULL, '1978-03-16', 'Pria', NULL, NULL, NULL, NULL, NULL, NULL, 'PNS', 0, NULL, '2021-05-03 14:20:20', '2021-05-03 14:20:20'),
	(40, '198106202010011000', 'Andi Puhu, S.Pd', NULL, '1981-06-20', 'Pria', NULL, NULL, NULL, NULL, NULL, NULL, 'PNS', 0, NULL, '2021-05-03 14:20:20', '2021-05-03 14:20:20'),
	(41, '19857142006021000', 'La Ode Muh. Qamal Jogugu S, STP, ME', NULL, '1985-07-14', 'Pria', NULL, NULL, NULL, NULL, NULL, NULL, 'PNS', 0, NULL, '2021-05-03 14:20:20', '2021-05-03 14:20:20'),
	(42, '197312152009011000', 'Bachar, ST', NULL, '1973-12-15', 'Pria', NULL, NULL, NULL, NULL, NULL, NULL, 'PNS', 0, NULL, '2021-05-03 14:20:20', '2021-05-03 14:20:20'),
	(43, '197902222009012000', 'Ariskha Sazriany HS, ST', NULL, '1979-02-22', 'Wanita', NULL, NULL, NULL, NULL, NULL, NULL, 'PNS', 0, NULL, '2021-05-03 14:20:20', '2021-05-03 14:20:20'),
	(44, '198111022009012000', 'Indri, S. Pi', NULL, '1981-11-02', 'Wanita', NULL, NULL, NULL, NULL, NULL, NULL, 'PNS', 0, NULL, '2021-05-03 14:20:20', '2021-05-03 14:20:20'),
	(45, '197905022009042000', 'Wa Ode Hardiana, SE', NULL, '1979-05-02', 'Wanita', NULL, NULL, NULL, NULL, NULL, NULL, 'PNS', 0, NULL, '2021-05-03 14:20:20', '2021-05-03 14:20:20'),
	(46, '198304182009042000', 'Wa Ode Hasniati, S. Si', NULL, '1983-04-18', 'Wanita', NULL, NULL, NULL, NULL, NULL, NULL, 'PNS', 0, NULL, '2021-05-03 14:20:20', '2021-05-03 14:20:20'),
	(47, '198510222010012000', 'Henny Savitri Oktaviana, S. Si, M.Si', NULL, '1985-10-22', 'Wanita', NULL, NULL, NULL, NULL, NULL, NULL, 'PNS', 0, NULL, '2021-05-03 14:20:21', '2021-05-03 14:20:21'),
	(48, '197805152010011000', 'Mardan, SE', NULL, '1978-05-15', 'Pria', NULL, NULL, NULL, NULL, NULL, NULL, 'PNS', 0, NULL, '2021-05-03 14:20:21', '2021-05-03 14:20:21'),
	(49, '198301122011011000', 'Ikbal Hidayat, S.T', NULL, '1983-01-12', 'Pria', NULL, NULL, NULL, NULL, NULL, NULL, 'PNS', 0, NULL, '2021-05-03 14:20:21', '2021-05-03 14:20:21'),
	(50, '198203102010012000', 'Jumarlian Santi Rafiun,SP', NULL, '1982-03-10', 'Wanita', NULL, NULL, NULL, NULL, NULL, NULL, 'PNS', 0, NULL, '2021-05-03 14:20:21', '2021-05-03 14:20:21'),
	(51, '198402152011012000', 'Febriani Arumi, ST', NULL, '1984-02-15', 'Wanita', NULL, NULL, NULL, NULL, NULL, NULL, 'PNS', 0, NULL, '2021-05-03 14:20:21', '2021-05-03 14:20:21'),
	(52, '198209222011012000', 'Sitti Aisyah, SE', NULL, '1982-09-22', 'Wanita', NULL, NULL, NULL, NULL, NULL, NULL, 'PNS', 0, NULL, '2021-05-03 14:20:21', '2021-05-03 14:20:21'),
	(53, '196411021986032000', 'Suryamin', NULL, '1964-11-02', 'Wanita', NULL, NULL, NULL, NULL, NULL, NULL, 'PNS', 0, NULL, '2021-05-03 14:20:21', '2021-05-03 14:20:21'),
	(54, '196310111985031000', 'Hamzah', NULL, '1963-10-11', 'Pria', NULL, NULL, NULL, NULL, NULL, NULL, 'PNS', 0, NULL, '2021-05-03 14:20:21', '2021-05-03 14:20:21'),
	(55, '197212122007012000', 'Indriyani Sudibyo,S.Sos', NULL, '1972-12-12', 'Wanita', NULL, NULL, NULL, NULL, NULL, NULL, 'PNS', 0, NULL, '2021-05-03 14:20:21', '2021-05-03 14:20:21'),
	(56, '198103172010012000', 'Windi Dianovita, ST', NULL, '1981-03-17', 'Wanita', NULL, NULL, NULL, NULL, NULL, NULL, 'PNS', 0, NULL, '2021-05-03 14:20:21', '2021-05-03 14:20:21'),
	(57, '198304192010012000', 'Sulistiany Tamrin, ST', NULL, '1983-04-19', 'Wanita', NULL, NULL, NULL, NULL, NULL, NULL, 'PNS', 0, NULL, '2021-05-03 14:20:21', '2021-05-03 14:20:21'),
	(58, '198705132011012000', 'Dian Sulistyowati,S.Kom,M.E', NULL, '1987-05-13', 'Wanita', NULL, NULL, NULL, NULL, NULL, NULL, 'PNS', 0, NULL, '2021-05-03 14:20:21', '2021-05-03 14:20:21'),
	(59, '198503262011012000', 'Imayanti Suhardin, SE', NULL, '1985-03-26', 'Wanita', NULL, NULL, NULL, NULL, NULL, NULL, 'PNS', 0, NULL, '2021-05-03 14:20:21', '2021-05-03 14:20:21'),
	(60, '198010132009011000', 'Dian Hidayah S,Sos', NULL, '1980-10-13', 'Pria', NULL, NULL, NULL, NULL, NULL, NULL, 'PNS', 0, NULL, '2021-05-03 14:20:21', '2021-05-03 14:20:21'),
	(61, '197911112009011000', 'La Ode Muhammad Ihsan Abdi, SP', NULL, '1979-11-11', 'Pria', NULL, NULL, NULL, NULL, NULL, NULL, 'PNS', 0, NULL, '2021-05-03 14:20:21', '2021-05-03 14:20:21'),
	(62, '196608192006042000', 'Sitti Salma, ST, M.Si', NULL, '1966-08-19', 'Wanita', NULL, NULL, NULL, NULL, NULL, NULL, 'PNS', 0, NULL, '2021-05-03 14:20:22', '2021-05-03 14:20:22'),
	(63, '196306101994031000', 'Asrul Suaeb', NULL, '1963-06-10', 'Pria', NULL, NULL, NULL, NULL, NULL, NULL, 'PNS', 0, NULL, '2021-05-03 14:20:22', '2021-05-03 14:20:22'),
	(64, '198509252009012000', 'Sitti Wahyuni, S.TP', NULL, '1985-09-24', 'Wanita', NULL, NULL, NULL, NULL, NULL, NULL, 'PNS', 0, NULL, '2021-05-03 14:20:22', '2021-05-03 14:20:22'),
	(65, '197806032005021000', 'Mauliddun, SH', NULL, '1978-06-03', 'Pria', NULL, NULL, NULL, NULL, NULL, NULL, 'PNS', 0, NULL, '2021-05-03 14:20:22', '2021-05-03 14:20:22'),
	(66, '197512082007012000', 'Jusanti, S.Sos', NULL, '1975-12-08', 'Wanita', NULL, NULL, NULL, NULL, NULL, NULL, 'PNS', 0, NULL, '2021-05-03 14:20:22', '2021-05-03 14:20:22'),
	(67, '198412062014032000', 'Wa Ode Kasmila, S. Si, M.Si', NULL, '1984-12-06', 'Wanita', NULL, NULL, NULL, NULL, NULL, NULL, 'PNS', 0, NULL, '2021-05-03 14:20:22', '2021-05-03 14:20:22'),
	(68, '198702202010012000', 'Sufiati, A. Md,SE', NULL, '1987-02-20', 'Wanita', NULL, NULL, NULL, NULL, NULL, NULL, 'PNS', 0, NULL, '2021-05-03 14:20:22', '2021-05-03 14:20:22'),
	(69, '197710262007122000', 'Reniati, S. Sos', NULL, '1977-10-26', 'Wanita', NULL, NULL, NULL, NULL, NULL, NULL, 'PNS', 0, NULL, '2021-05-03 14:20:22', '2021-05-03 14:20:22'),
	(70, '196707072014082000', 'Sitti Asniah, SE', NULL, '1967-07-07', 'Wanita', NULL, NULL, NULL, NULL, NULL, NULL, 'PNS', 0, NULL, '2021-05-03 14:20:22', '2021-05-03 14:20:22'),
	(71, '197912212014082000', 'Mulyani Abuhari, SE', NULL, '1979-12-21', 'Wanita', NULL, NULL, NULL, NULL, NULL, NULL, 'PNS', 0, NULL, '2021-05-03 14:20:22', '2021-05-03 14:20:22'),
	(72, '198510032010011000', 'Amir Pae, A.Md,SE', NULL, '1985-10-03', 'Pria', NULL, NULL, NULL, NULL, NULL, NULL, 'PNS', 0, NULL, '2021-05-03 14:20:22', '2021-05-03 14:20:22'),
	(73, '197906112007011000', 'E m i, S.Si', NULL, '1979-06-11', 'Pria', NULL, NULL, NULL, NULL, NULL, NULL, 'PNS', 0, NULL, '2021-05-03 14:20:22', '2021-05-03 14:20:22'),
	(74, '196904012008011000', 'Basri, SH', NULL, '1969-04-01', 'Pria', NULL, NULL, NULL, NULL, NULL, NULL, 'PNS', 0, NULL, '2021-05-03 14:20:22', '2021-05-03 14:20:22'),
	(75, '198003112009011000', 'Agus, S.Si', NULL, '1980-03-11', 'Pria', NULL, NULL, NULL, NULL, NULL, NULL, 'PNS', 0, NULL, '2021-05-03 14:20:22', '2021-05-03 14:20:22'),
	(76, '196708261989032000', 'Nurlina Malik', NULL, '1967-12-12', 'Wanita', NULL, NULL, NULL, NULL, NULL, NULL, 'PNS', 0, NULL, '2021-05-03 14:20:22', '2021-05-03 14:20:22'),
	(77, '196601101991031000', 'Sapiuddin', NULL, '1966-01-10', 'Pria', NULL, NULL, NULL, NULL, NULL, NULL, 'PNS', 0, NULL, '2021-05-03 14:20:22', '2021-05-03 14:20:22'),
	(78, '197503072008012000', 'Bahrain, SE', NULL, '1975-03-07', 'Wanita', NULL, NULL, NULL, NULL, NULL, NULL, 'PNS', 0, NULL, '2021-05-03 14:20:23', '2021-05-03 14:20:23'),
	(79, '198504262008011000', 'La Ode Muh. Ikbal Beau,S.Sos', NULL, '1985-04-06', 'Pria', NULL, NULL, NULL, NULL, NULL, NULL, 'PNS', 0, NULL, '2021-05-03 14:20:23', '2021-05-03 14:20:23'),
	(80, '197909172009011000', 'Muhammad Zailani Sanusi, S.E', NULL, '1979-09-17', 'Pria', NULL, NULL, NULL, NULL, NULL, NULL, 'PNS', 0, NULL, '2021-05-03 14:20:23', '2021-05-03 14:20:23'),
	(81, '198407022014081000', 'Samsuddin,SH', NULL, '1984-07-02', 'Pria', NULL, NULL, NULL, NULL, NULL, NULL, 'PNS', 0, NULL, '2021-05-03 14:20:23', '2021-05-03 14:20:23'),
	(82, '198910182015022000', 'Erika Ayu Christanti, A.Md', NULL, '1989-10-18', 'Wanita', NULL, NULL, NULL, NULL, NULL, NULL, 'PNS', 0, NULL, '2021-05-03 14:20:23', '2021-05-03 14:20:23'),
	(83, '197809022014071000', 'Asjan Husain,ST', NULL, '1978-09-02', 'Pria', NULL, NULL, NULL, NULL, NULL, NULL, 'PNS', 0, NULL, '2021-05-03 14:20:23', '2021-05-03 14:20:23'),
	(84, '198301052009012000', 'Hamira, A. Md. Kom', NULL, '1983-01-05', 'Wanita', NULL, NULL, NULL, NULL, NULL, NULL, 'PNS', 0, NULL, '2021-05-03 14:20:23', '2021-05-03 14:20:23'),
	(85, '197409042014062000', 'Riny astuti, S. Sos', NULL, '1974-09-04', 'Wanita', NULL, NULL, NULL, NULL, NULL, NULL, 'PNS', 0, NULL, '2021-05-03 14:20:23', '2021-05-03 14:20:23'),
	(86, '198912272015021000', 'Mardiono, A.Md', NULL, '1989-12-27', 'Pria', NULL, NULL, NULL, NULL, NULL, NULL, 'PNS', 0, NULL, '2021-05-03 14:20:23', '2021-05-03 14:20:23'),
	(87, '196412312006041000', 'Asikin Jamal', NULL, '1964-12-12', 'Pria', NULL, NULL, NULL, NULL, NULL, NULL, 'PNS', 0, NULL, '2021-05-03 14:20:23', '2021-05-03 14:20:23'),
	(88, '196312312007011000', 'La Ode Hafilu', NULL, '1963-12-12', 'Pria', NULL, NULL, NULL, NULL, NULL, NULL, 'PNS', 0, NULL, '2021-05-03 14:20:23', '2021-05-03 14:20:23'),
	(89, '198302142008011000', 'Wahyuddin Amir Manab', NULL, '1983-02-14', 'Pria', NULL, NULL, NULL, NULL, NULL, NULL, 'PNS', 0, NULL, '2021-05-03 14:20:23', '2021-05-03 14:20:23'),
	(90, '198201102009012000', 'Misna Haseng', NULL, '1982-01-10', 'Wanita', NULL, NULL, NULL, NULL, NULL, NULL, 'PNS', 0, NULL, '2021-05-03 14:20:23', '2021-05-03 14:20:23'),
	(91, '197908272011011000', 'Agus Herdianto, A.Md', NULL, '1979-08-27', 'Pria', NULL, NULL, NULL, NULL, NULL, NULL, 'PNS', 0, NULL, '2021-05-03 14:20:23', '2021-05-03 14:20:23'),
	(92, '198306192010011000', 'Munandar ', NULL, '1983-06-19', 'Pria', NULL, NULL, NULL, NULL, NULL, NULL, 'PNS', 0, NULL, '2021-05-03 14:20:23', '2021-05-03 14:20:23'),
	(93, '197412022014081000', 'Faisal', 'xxx', '1974-12-02', 'Pria', 'xx', 'Islam', NULL, NULL, NULL, NULL, 'PNS', 0, 1, '2021-05-03 14:20:24', '2021-10-29 10:30:57'),
	(97, '197412022014081002', 'ADRI SAPUTRA IBRAHIM', 'KENDARI', '1991-10-16', 'Pria', 'KENDARI', 'Islam', NULL, NULL, NULL, NULL, 'PNS', 0, 1, '2021-10-29 14:30:33', '2021-10-29 14:35:48');
/*!40000 ALTER TABLE `pegawai_tbl` ENABLE KEYS */;

-- membuang struktur untuk table db_parau.pengaturan_tbl
CREATE TABLE IF NOT EXISTS `pengaturan_tbl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_aplikasi` varchar(200) DEFAULT NULL,
  `singkatan_nama_aplikasi` varchar(200) DEFAULT NULL,
  `nama_kepala_dinas` varchar(100) DEFAULT NULL,
  `tentang_dinas` varchar(500) DEFAULT NULL,
  `tentang_aplikasi` varchar(500) DEFAULT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  `no_hp` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `text_pegawai` varchar(100) DEFAULT NULL,
  `logo_kecil` varchar(100) DEFAULT NULL,
  `logo_besar` varchar(100) DEFAULT NULL,
  `foto_kepala_dinas` varchar(100) DEFAULT NULL,
  `instagram` varchar(100) DEFAULT NULL,
  `facebook` varchar(100) DEFAULT NULL,
  `twitter` varchar(100) DEFAULT NULL,
  `background_login` varchar(100) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- Membuang data untuk tabel db_parau.pengaturan_tbl: ~0 rows (lebih kurang)
/*!40000 ALTER TABLE `pengaturan_tbl` DISABLE KEYS */;
INSERT INTO `pengaturan_tbl` (`id`, `nama_aplikasi`, `singkatan_nama_aplikasi`, `nama_kepala_dinas`, `tentang_dinas`, `tentang_aplikasi`, `alamat`, `no_hp`, `email`, `text_pegawai`, `logo_kecil`, `logo_besar`, `foto_kepala_dinas`, `instagram`, `facebook`, `twitter`, `background_login`, `user_id`, `created_at`, `updated_at`) VALUES
	(1, 'PARAU', 'PARAU', 'ILHAM JAYA, ST., MM', 'Badan Kepegawaian dan Pengembangan Sumber Daya Manusia Kabupaten Konawe', 'Sistem Informasi Manajemen ASN Daerah atau bisa disebut dengan SIMANDARA adalah sistem yang mengelola data kepegawaian ASN Kabupaten Konawe yang terintegrasi dengan data MySAPK Badan Kepegawaian Nasional', 'Konawe, Jl. Konggoasa', '082188980782', 'simpeg@gmail.com', NULL, '16424717931.jpg', '16424759582.png', '16387574644.png', 'instagram.com', 'facebook.com', 'twitter.com', '16425072313.jpg', 1, '2021-10-29 10:58:27', '2022-01-18 20:00:31');
/*!40000 ALTER TABLE `pengaturan_tbl` ENABLE KEYS */;

-- membuang struktur untuk table db_parau.personal_access_tokens
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel db_parau.personal_access_tokens: ~0 rows (lebih kurang)
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;

-- membuang struktur untuk table db_parau.sessions
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel db_parau.sessions: ~2 rows (lebih kurang)
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
	('A4SrnDIwT5TfZsJpflSU6zrLEoKSn8bKXPKU9aFn', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.71 Safari/537.36 Edg/97.0.1072.62', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiM1dWT050amhXYWJqcjcxb3pVVG1aN29UcDA2bjdSa3FhOFVqT1E3WiI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czoyNjoiaHR0cDovL2xvY2FsaG9zdC9wYXJhdS9sb2ciO31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czoyODoiaHR0cDovL2xvY2FsaG9zdC9wYXJhdS9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1642564340),
	('TM9gOozJ9919wE1oMFlUnbDJhYkkGNKtnyiGMa0P', 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.71 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiWktzSGsxSmdxUWVFZ29haTg5UWY0dUkzbnR3TjNrOFlSRFg3N1gxQiI7czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjE3OiJwYXNzd29yZF9oYXNoX3dlYiI7czo2MDoiJDJ5JDEwJFJjLmVDdWQ1SVlnYUpBZUZJYWVUMk9RTTlMNE1pcWRWa1YuLnAxd2JRdm5QeHhHNkw2N215IjtzOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czozMjoiaHR0cDovL2xvY2FsaG9zdC9wYXJhdS9kYXNoYm9hcmQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1642568658);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;

-- membuang struktur untuk table db_parau.sub_menu_access_tbl
CREATE TABLE IF NOT EXISTS `sub_menu_access_tbl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(11) NOT NULL DEFAULT 0,
  `menu_id` int(11) NOT NULL DEFAULT 0,
  `sub_menu_id` int(11) NOT NULL DEFAULT 0,
  `create` int(11) NOT NULL DEFAULT 0,
  `read` int(11) NOT NULL DEFAULT 0,
  `update` int(11) NOT NULL DEFAULT 0,
  `delete` int(11) NOT NULL DEFAULT 0,
  `print` int(11) NOT NULL DEFAULT 0,
  `user_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `menu_id` (`menu_id`),
  KEY `group_id` (`group_id`),
  KEY `sub_menu_id` (`sub_menu_id`),
  CONSTRAINT `FK_sub_menu_access_tbl_group_tbl` FOREIGN KEY (`group_id`) REFERENCES `group_tbl` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_sub_menu_access_tbl_menu_access_tbl_2` FOREIGN KEY (`menu_id`) REFERENCES `menu_access_tbl` (`menu_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_sub_menu_access_tbl_sub_menu_tbl` FOREIGN KEY (`sub_menu_id`) REFERENCES `sub_menu_tbl` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- Membuang data untuk tabel db_parau.sub_menu_access_tbl: ~12 rows (lebih kurang)
/*!40000 ALTER TABLE `sub_menu_access_tbl` DISABLE KEYS */;
INSERT INTO `sub_menu_access_tbl` (`id`, `group_id`, `menu_id`, `sub_menu_id`, `create`, `read`, `update`, `delete`, `print`, `user_id`, `created_at`, `updated_at`) VALUES
	(20, 1, 4, 6, 1, 1, 1, 1, 1, 1, '2022-01-17 10:57:44', '2022-01-17 10:57:44'),
	(21, 1, 4, 7, 1, 1, 1, 1, 1, 1, '2022-01-17 10:57:56', '2022-01-17 11:30:40'),
	(22, 1, 4, 8, 1, 1, 1, 1, 1, 1, '2022-01-17 10:58:06', '2022-01-17 10:58:06'),
	(29, 1, 13, 11, 1, 1, 1, 1, 1, 1, '2022-01-18 16:01:57', '2022-01-18 16:01:57'),
	(30, 1, 13, 15, 1, 1, 1, 1, 1, 1, '2022-01-18 16:02:15', '2022-01-18 16:02:15'),
	(31, 1, 13, 16, 1, 1, 1, 1, 1, 1, '2022-01-19 12:19:38', '2022-01-19 12:19:38'),
	(32, 1, 14, 17, 1, 1, 1, 1, 1, 1, '2022-01-19 12:23:15', '2022-01-19 12:23:15'),
	(33, 1, 14, 18, 1, 1, 1, 1, 1, 1, '2022-01-19 12:23:28', '2022-01-19 12:23:28'),
	(34, 1, 14, 20, 1, 1, 1, 1, 1, 1, '2022-01-19 12:36:52', '2022-01-19 12:36:52'),
	(35, 1, 14, 21, 1, 1, 1, 1, 1, 1, '2022-01-19 12:37:05', '2022-01-19 12:37:05'),
	(36, 1, 13, 19, 1, 1, 1, 1, 1, 1, '2022-01-19 12:37:24', '2022-01-19 12:37:24'),
	(37, 1, 13, 22, 1, 1, 1, 1, 1, 1, '2022-01-19 12:57:01', '2022-01-19 12:57:01');
/*!40000 ALTER TABLE `sub_menu_access_tbl` ENABLE KEYS */;

-- membuang struktur untuk table db_parau.sub_menu_tbl
CREATE TABLE IF NOT EXISTS `sub_menu_tbl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_id` int(11) NOT NULL,
  `sub_menu_name` varchar(18) DEFAULT NULL,
  `link` varchar(50) DEFAULT NULL,
  `attribute` varchar(50) DEFAULT NULL,
  `position` int(11) NOT NULL DEFAULT 0,
  `desc` tinytext DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `user_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `menu_id` (`menu_id`),
  CONSTRAINT `FK_sub_menu_tbl_group_tbl` FOREIGN KEY (`menu_id`) REFERENCES `menu_tbl` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- Membuang data untuk tabel db_parau.sub_menu_tbl: ~12 rows (lebih kurang)
/*!40000 ALTER TABLE `sub_menu_tbl` DISABLE KEYS */;
INSERT INTO `sub_menu_tbl` (`id`, `menu_id`, `sub_menu_name`, `link`, `attribute`, `position`, `desc`, `status`, `user_id`, `created_at`, `updated_at`) VALUES
	(6, 4, 'User', 'user', 'fa-circle-notch', 1, NULL, 1, 1, '2022-01-12 13:42:20', '2022-01-14 20:01:44'),
	(7, 4, 'Menu', 'menu', 'fa-circle-notch', 3, NULL, 1, 1, '2022-01-12 13:43:01', '2022-01-12 13:43:01'),
	(8, 4, 'Group', 'group', 'fa-circle-notch', 2, NULL, 1, 1, '2022-01-12 13:43:18', '2022-01-12 13:43:18'),
	(11, 13, 'Gudang', 'inventory', NULL, 3, NULL, 1, 1, '2022-01-18 13:47:53', '2022-01-19 12:30:02'),
	(15, 13, 'Pre Order (PO)', 'pre_order', NULL, 4, NULL, 1, 1, '2022-01-18 16:00:15', '2022-01-19 12:30:09'),
	(16, 13, 'Produk', 'product', NULL, 1, NULL, 1, 1, '2022-01-19 12:08:49', '2022-01-19 12:09:56'),
	(17, 14, 'Pembelian', 'purchase', NULL, 1, NULL, 1, 1, '2022-01-19 12:22:43', '2022-01-19 12:22:43'),
	(18, 14, 'Penjualan', 'selling', NULL, 2, NULL, 1, 1, '2022-01-19 12:22:55', '2022-01-19 12:22:55'),
	(19, 13, 'Kategori Produk', 'product_category', NULL, 2, NULL, 1, 1, '2022-01-19 12:29:50', '2022-01-19 12:30:14'),
	(20, 14, 'Keuangan', 'finance', NULL, 3, NULL, 1, 1, '2022-01-19 12:31:13', '2022-01-19 12:31:13'),
	(21, 14, 'Gaji', 'salary', NULL, 4, NULL, 1, 1, '2022-01-19 12:34:37', '2022-01-19 12:34:37'),
	(22, 13, 'Supplier', 'supplier', NULL, 5, NULL, 1, 1, '2022-01-19 12:56:35', '2022-01-19 12:56:35');
/*!40000 ALTER TABLE `sub_menu_tbl` ENABLE KEYS */;

-- membuang struktur untuk table db_parau.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `two_factor_secret` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `two_factor_recovery_codes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL,
  `foto` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=483 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel db_parau.users: ~2 rows (lebih kurang)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `remember_token`, `group_id`, `foto`, `status`, `created_at`, `updated_at`) VALUES
	(1, 'administrator', 'administrator@gmail.com', NULL, '$2y$10$Rc.eCud5IYgaJAeFIaeT2OQM9L4MiqdVkV..p1wbQvnPxxG6L67my', NULL, NULL, 'ywZkHRO5jDIV0EX7ehFaBNkYqb1GeyaqF33AaLt1X2iFnPAlUYtWP5hCww6z', 1, '1641869792.jpg', 1, '2021-04-05 14:20:00', '2022-01-11 10:56:32'),
	(482, 'operator', 'operator@gmail.com', NULL, '$2y$10$RFfcHMYYV/VNaeZZXsZiBuYURin.uYGD9BMBDfhpbxxI./GOWqf3.', NULL, NULL, NULL, 2, '1635474811.jpg', 1, '2021-10-28 12:09:14', '2022-01-18 13:09:23');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
