-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 10, 2023 at 07:34 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_pengaduan`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `call_petugas` (IN `id` INT, IN `username` VARCHAR(50), IN `name` VARCHAR(50))   BEGIN
    SELECT * FROM users WHERE 
    (id = IFNULL(id, id)) AND 
    (username LIKE CONCAT('%', IFNULL(username, ''), '%')) AND 
    (name LIKE CONCAT('%', IFNULL(name, ''), '%'));
END$$

--
-- Functions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `jml_pengaduan` (`year` INT) RETURNS INT(11)  BEGIN
  DECLARE jumlah_pengaduan INT;
  SELECT COUNT(*) INTO jumlah_pengaduan FROM pengaduan WHERE YEAR(tgl_pengaduan) = year;
  RETURN jumlah_pengaduan;
END$$

DELIMITER ;

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
-- Table structure for table `masyarakat`
--

CREATE TABLE `masyarakat` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nik` char(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `tlpn` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `masyarakat`
--

INSERT INTO `masyarakat` (`id`, `nik`, `name`, `username`, `password`, `tlpn`, `created_at`, `updated_at`) VALUES
(1, '12345678', 'nazriel rahman alfath', 'nazriel', '$2y$10$9m196mpr5iCCR7vhS2.jYuSaj4Nd/lt4dBicDZtuLw/m8faelPws.', '087810820414', '2023-03-07 17:31:22', '2023-03-07 17:31:22'),
(2, '123456789', 'ucup bin yusuf', 'ucup pakboy', '$2y$10$ah/Ot5tJ9JNwTkCgdqsgPetpgVtGDFTFqd/w/Eol.OL/2kbILcyc2', '101001010', '2023-03-07 17:46:23', '2023-03-07 17:46:23'),
(4, '089989', 'manukkk', 'sultampan', '$2y$10$rQOP0qgGXV845H729cxlvuXBEn.Vm4hV0oG/VxnrOa/BRkOVyXc26', '087810820414', '2023-03-08 21:50:24', '2023-03-08 21:52:23'),
(5, '09990', 'farah', 'farah', '$2y$10$LtdGxg4Vt.dxNdJa.5gB9ubJEaq52JmgsRlb9agFK2wattDAi8HK2', '07860880', '2023-03-08 21:54:57', '2023-03-08 21:54:57'),
(7, '122334', 'addaf', 'kaka', '$2y$10$rUccLYuAtYx1vDjpQPQkQ.eYCekfTFrab4M29GoQdUebrx7xqpFYC', '2445445', '2023-03-09 00:23:30', '2023-03-09 00:23:30');

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
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_03_08_005844_create_masyarakats_table', 1),
(6, '2023_03_08_015901_create_pengaduans_table', 2),
(7, '2023_03_08_015933_create_tanggapans_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pengaduan`
--

CREATE TABLE `pengaduan` (
  `id_pengaduan` bigint(20) UNSIGNED NOT NULL,
  `tgl_pengaduan` datetime NOT NULL,
  `id_masyarakat` bigint(20) UNSIGNED NOT NULL,
  `isi_pengaduan` text NOT NULL,
  `foto` varchar(255) NOT NULL,
  `status` enum('0','proses','selesai') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pengaduan`
--

INSERT INTO `pengaduan` (`id_pengaduan`, `tgl_pengaduan`, `id_masyarakat`, `isi_pengaduan`, `foto`, `status`, `created_at`, `updated_at`) VALUES
(1, '2023-02-08 02:25:29', 1, 'cddc', 'Activity diagram.PNG', 'selesai', '2023-03-07 18:25:29', '2023-03-08 19:39:24'),
(2, '2023-03-08 06:16:02', 1, 'aduhdudhdhhd', 'tampilan.png', 'selesai', '2023-03-07 22:16:02', '2023-03-07 23:23:26'),
(3, '2023-03-08 07:47:18', 1, 'scdacda', 'ss2.jpg', 'selesai', '2023-03-07 23:47:18', '2023-03-08 19:32:48'),
(4, '2023-03-09 05:55:38', 5, 'kembalii ke admin', 'logo-topi-koki-png-2.png', 'selesai', '2023-03-08 21:55:38', '2023-03-08 21:56:08'),
(5, '2023-03-09 06:34:09', 1, 'diagram saya', 'Activity diagram.PNG', 'proses', '2023-03-08 22:34:09', '2023-03-08 22:35:56'),
(6, '2023-03-09 08:18:10', 1, 'kefnjodaf', 'ssedit.jpg', 'selesai', '2023-03-09 00:18:10', '2023-03-09 00:18:42'),
(7, '2023-03-09 08:23:54', 7, 'kenefnfip', 'Use case2.PNG', 'selesai', '2023-03-09 00:23:54', '2023-03-09 00:24:35');

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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tanggapan`
--

CREATE TABLE `tanggapan` (
  `id_tanggapan` bigint(20) UNSIGNED NOT NULL,
  `id_pengaduan` bigint(20) UNSIGNED NOT NULL,
  `tgl_tanggapan` datetime NOT NULL,
  `tanggapan` text DEFAULT NULL,
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tanggapan`
--

INSERT INTO `tanggapan` (`id_tanggapan`, `id_pengaduan`, `tgl_tanggapan`, `tanggapan`, `id_user`, `created_at`, `updated_at`) VALUES
(2, 2, '2023-03-08 00:00:00', 'kembali', 1, '2023-03-07 23:17:56', '2023-03-07 23:23:26'),
(3, 3, '2023-03-09 00:00:00', NULL, 7, '2023-03-07 23:59:29', '2023-03-08 21:47:47'),
(4, 1, '2023-03-09 00:00:00', 'tanggapan', 1, '2023-03-08 19:37:06', '2023-03-08 19:40:22'),
(5, 4, '2023-03-09 00:00:00', 'data selesai', 1, '2023-03-08 21:56:09', '2023-03-08 21:56:18'),
(6, 5, '2023-03-09 00:00:00', NULL, 1, '2023-03-08 22:35:56', '2023-03-08 22:35:56'),
(7, 6, '2023-03-09 00:00:00', 'ccsc', 1, '2023-03-09 00:18:42', '2023-03-09 00:19:02'),
(8, 7, '2023-03-09 00:00:00', 'jkcvbljd', 1, '2023-03-09 00:24:35', '2023-03-09 00:24:49');

--
-- Triggers `tanggapan`
--
DELIMITER $$
CREATE TRIGGER `update_status` AFTER UPDATE ON `tanggapan` FOR EACH ROW BEGIN
  IF (NEW.tanggapan IS NOT NULL AND (SELECT status FROM pengaduan WHERE id_pengaduan = NEW.id_pengaduan) <> 'selesai') THEN
    UPDATE pengaduan SET status = 'selesai' WHERE id_pengaduan = NEW.id_pengaduan;
  END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `tlpn` varchar(255) NOT NULL,
  `level` enum('admin','petugas') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `tlpn`, `level`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin', '$2y$10$YhDSS45WlAU50CARZoXFTuNr5ubS51lChZeugAyTbq6zRWXhMah9e', '087810820414', 'admin', '2023-03-07 17:16:04', '2023-03-07 17:16:04'),
(2, 'petugas', 'petugas', '$2y$10$ML9YwN8A3ks8s0M4wX0xzuc17ScVU.R4aa17RNs9NWdb6xSpXPvyu', '087810820414', 'petugas', '2023-03-07 23:22:05', '2023-03-07 23:22:05'),
(3, 'farah', 'whiz', '$2y$10$t3gZPajjw348/KL6/c2ctOObvA7z1i3aDDBn0eDNZJGJd2L56huTG', '101001010', 'admin', '2023-03-08 16:08:37', '2023-03-08 16:08:37'),
(6, 'tes commit', 'commit', 'password', '12345', 'petugas', NULL, NULL),
(7, 'whizboy', 'sultampan21', '$2y$10$BSCNnPFOoTHkKDcf8EP7yeMhIOGd74FZdDGt951EIfqgfPeOQELtq', '12345678', 'petugas', '2023-03-08 21:43:50', '2023-03-08 21:43:50'),
(8, 'nazriel rahman alfath', 'nazriel', '$2y$10$soH0UmRgIRAVqCRYyJCJv.YgXs2WW8InLpeYxgYiy2gRcACu9gTVO', '087810820414', 'admin', '2023-03-08 21:52:11', '2023-03-08 21:52:11'),
(9, 'q', 'q', '$2y$10$6N9fi.wCQzv5IqXksldJg.HPMaeN6P/jOqxLWCoKpTmrCEBrG8nnq', '101001010', 'admin', '2023-03-08 23:51:25', '2023-03-08 23:51:25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `masyarakat`
--
ALTER TABLE `masyarakat`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `masyarakat_username_unique` (`username`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `pengaduan`
--
ALTER TABLE `pengaduan`
  ADD PRIMARY KEY (`id_pengaduan`),
  ADD KEY `pengaduan_id_masyarakat_foreign` (`id_masyarakat`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `tanggapan`
--
ALTER TABLE `tanggapan`
  ADD PRIMARY KEY (`id_tanggapan`),
  ADD KEY `tanggapan_id_pengaduan_foreign` (`id_pengaduan`),
  ADD KEY `tanggapan_id_user_foreign` (`id_user`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `masyarakat`
--
ALTER TABLE `masyarakat`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `pengaduan`
--
ALTER TABLE `pengaduan`
  MODIFY `id_pengaduan` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tanggapan`
--
ALTER TABLE `tanggapan`
  MODIFY `id_tanggapan` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pengaduan`
--
ALTER TABLE `pengaduan`
  ADD CONSTRAINT `pengaduan_id_masyarakat_foreign` FOREIGN KEY (`id_masyarakat`) REFERENCES `masyarakat` (`id`);

--
-- Constraints for table `tanggapan`
--
ALTER TABLE `tanggapan`
  ADD CONSTRAINT `tanggapan_id_pengaduan_foreign` FOREIGN KEY (`id_pengaduan`) REFERENCES `pengaduan` (`id_pengaduan`),
  ADD CONSTRAINT `tanggapan_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
