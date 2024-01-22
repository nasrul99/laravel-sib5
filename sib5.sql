-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 22, 2024 at 05:39 AM
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
-- Database: `sib5`
--

-- --------------------------------------------------------

--
-- Table structure for table `asset`
--

CREATE TABLE `asset` (
  `id` int(11) NOT NULL,
  `nama` varchar(45) NOT NULL,
  `kategori_id` int(11) NOT NULL,
  `thn_beli` int(11) NOT NULL,
  `harga` double NOT NULL,
  `masa_umur` float NOT NULL,
  `kondisi` enum('Baik','Sedang','Rusak') NOT NULL,
  `lokasi` varchar(45) NOT NULL,
  `foto` varchar(45) DEFAULT NULL,
  `barcode` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `asset`
--

INSERT INTO `asset` (`id`, `nama`, `kategori_id`, `thn_beli`, `harga`, `masa_umur`, `kondisi`, `lokasi`, `foto`, `barcode`) VALUES
(2, 'Gedung Kampus B1', 4, 2010, 3000000000, 25, 'Baik', 'Jl. Raya Lenteng Agung Jakarta Selatan', '', ''),
(5, 'Gedung Kampus A', 4, 2000, 7000000000, 25, 'Sedang', 'Jl. Situ Indah Kelapa Dua Depok Jawa Barat', '', NULL),
(6, 'Gedung Kampus B2', 4, 2000, 3000000000, 25, 'Sedang', 'Jl. Raya Lenteng Agung Jakarta Selatan', 'asset_20231110_02-46-09.jpg', NULL),
(7, 'Gedung Kampus B3', 4, 2000, 5000000000, 25, 'Baik', 'Jl. Raya Lenteng Agung Jakarta Selatan', '', NULL),
(8, 'Laptop HP', 5, 2020, 7000000, 10, 'Baik', '', NULL, NULL),
(9, 'Laptop Lenovo Thinkpad', 5, 2022, 8000000, 8, 'Baik', '', NULL, NULL),
(14, 'Laptop Acer', 5, 2020, 7500000, 5, 'Baik', '', NULL, NULL),
(15, 'Kursi Belajar', 6, 2023, 500000, 7, 'Sedang', 'Kampus B3', 'asset_20231110_02-17-07.jpg', NULL),
(16, 'Komputer 2', 5, 2022, 7000000, 10, 'Sedang', 'Kampus B1', NULL, NULL),
(23, 'Sofa', 6, 2022, 7000000, 10, 'Baik', 'Kampus B3', 'asset_20231113_02-15-52.png', NULL),
(24, 'Motor 1', 2, 2000, 15000000, 15, 'Sedang', 'Kampus B1', '', NULL),
(25, 'Mobil 1', 2, 2010, 150000000, 25, 'Sedang', 'Kampus A', '', NULL),
(26, 'Tanah 1', 1, 2000, 5000000000, 35, 'Baik', 'Bogor', '', NULL),
(32, 'tes', 2, 2010, 7000000, 15, 'Sedang', 'Kampus B3', '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `divisi`
--

CREATE TABLE `divisi` (
  `id` int(11) NOT NULL,
  `nama` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `divisi`
--

INSERT INTO `divisi` (`id`, `nama`) VALUES
(5, 'LKKI'),
(6, 'LPMI'),
(4, 'LPPM'),
(7, 'LTSI'),
(8, 'Marketing NF Computer'),
(9, 'Operasional NF Computer'),
(10, 'Risbang NF Computer'),
(1, 'Waket 1'),
(2, 'Waket 2'),
(3, 'Waket 3');

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
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `id` int(11) NOT NULL,
  `tgl` date NOT NULL,
  `asset_id` int(11) NOT NULL,
  `nama_kegiatan` varchar(45) NOT NULL,
  `foto` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id` int(11) NOT NULL,
  `nama` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id`, `nama`) VALUES
(7, 'ATK'),
(5, 'Elektronik'),
(6, 'Furniture'),
(4, 'Gedung'),
(2, 'Kendaraan'),
(1, 'Tanah');

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
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_11_03_032721_create_team_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `mutasi`
--

CREATE TABLE `mutasi` (
  `id` int(11) NOT NULL,
  `tgl` date NOT NULL,
  `asset_id` int(11) NOT NULL,
  `divisi_id` int(11) NOT NULL,
  `pic` varchar(45) DEFAULT NULL,
  `keterangan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

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

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\User', 8, 'token', '59a9623a39f0071839c71a87d990eccab6fb08a07c29d6dba9a60aca0d3d32b0', '[\"*\"]', '2023-12-12 02:45:38', NULL, '2023-12-05 04:18:53', '2023-12-12 02:45:38'),
(2, 'App\\Models\\User', 1, 'token', '125273883512d8827f34eb0151dcbee19655152223779b59c7a98e094a3d23e4', '[\"*\"]', '2023-12-12 02:36:44', NULL, '2023-12-05 04:27:44', '2023-12-12 02:36:44');

-- --------------------------------------------------------

--
-- Table structure for table `team`
--

CREATE TABLE `team` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(50) NOT NULL,
  `jabatan` enum('PM','PO','UI/UX','Analyst','Programmer') NOT NULL,
  `deskripsi` text NOT NULL,
  `foto` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `team`
--

INSERT INTO `team` (`id`, `nama`, `jabatan`, `deskripsi`, `foto`, `created_at`, `updated_at`) VALUES
(1, 'nama_654470dda8880', 'Programmer', 'Magni qui quod omnis unde et eos fuga et exercitationem. Odio veritatis perspiciatis quaerat qui aut aut aut', NULL, '2023-11-02 21:02:37', NULL),
(2, 'nama_654470ddbaec8', 'Programmer', 'Magni qui quod omnis unde et eos fuga et exercitationem. Odio veritatis perspiciatis quaerat qui aut aut aut', NULL, '2023-11-02 21:02:37', NULL),
(3, 'nama_654470ddc2b1a', 'Programmer', 'Magni qui quod omnis unde et eos fuga et exercitationem. Odio veritatis perspiciatis quaerat qui aut aut aut', NULL, '2023-11-02 21:02:37', NULL),
(4, 'nama_654470ddd0df2', 'Programmer', 'Magni qui quod omnis unde et eos fuga et exercitationem. Odio veritatis perspiciatis quaerat qui aut aut aut', NULL, '2023-11-02 21:02:37', NULL),
(5, 'nama_654470ddd8fa7', 'Programmer', 'Magni qui quod omnis unde et eos fuga et exercitationem. Odio veritatis perspiciatis quaerat qui aut aut aut', NULL, '2023-11-02 21:02:37', NULL),
(6, 'nama_654470dddcfbf', 'Programmer', 'Magni qui quod omnis unde et eos fuga et exercitationem. Odio veritatis perspiciatis quaerat qui aut aut aut', NULL, '2023-11-02 21:02:37', NULL),
(7, 'nama_654470dde4046', 'Programmer', 'Magni qui quod omnis unde et eos fuga et exercitationem. Odio veritatis perspiciatis quaerat qui aut aut aut', NULL, '2023-11-02 21:02:37', NULL),
(8, 'nama_654470dde92ab', 'Programmer', 'Magni qui quod omnis unde et eos fuga et exercitationem. Odio veritatis perspiciatis quaerat qui aut aut aut', NULL, '2023-11-02 21:02:37', NULL),
(9, 'nama_654470dded582', 'Programmer', 'Magni qui quod omnis unde et eos fuga et exercitationem. Odio veritatis perspiciatis quaerat qui aut aut aut', NULL, '2023-11-02 21:02:37', NULL),
(10, 'nama_654470de05991', 'Programmer', 'Magni qui quod omnis unde et eos fuga et exercitationem. Odio veritatis perspiciatis quaerat qui aut aut aut', NULL, '2023-11-02 21:02:38', NULL);

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
  `role` enum('admin','manager','staff') NOT NULL DEFAULT 'staff',
  `isactive` enum('yes','no','banned') NOT NULL DEFAULT 'no',
  `foto` varchar(30) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `isactive`, `foto`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 'Budi Santoso', 'budi@gmail.com', NULL, '$2y$10$O.c0iuHMVZjlqm9FHSgIT.zjYzuCbUPBjgrbxg5YLlqihMBeVlENm', 'manager', 'yes', 'budi.png', NULL, '2023-11-20 03:16:01', '2023-11-20 03:16:01'),
(3, 'Siti Aminah', 'siti@gmail.com', NULL, '$2y$10$PQScdP8wl20x2dSJx6llO.frdQ4uyzjNXJJc/ACjFAtvYFp28SuYm', 'staff', 'yes', NULL, NULL, '2023-11-20 04:15:10', '2023-11-20 04:15:10'),
(5, 'Sri Rezeki', 'sri@gmail.com', NULL, '$2y$10$0KCNdR68mAgm6QCCjz99Xu.ugjtfFoUV8aAp3Hi0kgHIg740AAM.m', 'staff', 'yes', NULL, NULL, '2023-11-21 02:00:24', '2023-11-21 02:00:24'),
(6, 'Dudi Fitriahadi', 'dudi@gmail.com', NULL, '$2y$10$puZzJlDpPHjD12y9wo6vrOW79rX1EmBiYgw5uBK/93QWrx5qdCxJ.', 'manager', 'yes', NULL, NULL, '2023-12-01 01:46:21', '2023-12-01 01:46:21'),
(8, 'Andriansyah', 'andriansyah@nurulfikri.ac.id', NULL, '$2y$10$s0DR5IF1p6EEqQhgAOWzxOhIMlRxIvnPXdRhRMVn2ebZ3bgruJSlO', 'manager', 'yes', NULL, NULL, '2023-12-05 04:15:52', '2024-01-22 04:17:47'),
(9, 'Daseh Hidayat', 'daseh_hidayat@gmail.com', NULL, '$2y$10$TTFQVisHYuSX4R1M18awe.rYoJXdM00eOfFsOd2VkGjryn7Ws/.3m', 'staff', 'banned', NULL, NULL, '2023-12-12 02:33:22', '2023-12-15 01:03:23'),
(13, 'Nasrul', 'nasrul99@gmail.com', NULL, '$2y$10$k8x3IrYbcOTNTdMswUvMOeiOZfylqDeQZBumLe4KSPNZWp42Zmptm', 'admin', 'yes', NULL, NULL, '2023-12-13 13:58:09', '2023-12-13 13:58:09');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `asset`
--
ALTER TABLE `asset`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_asset_kategori` (`kategori_id`);

--
-- Indexes for table `divisi`
--
ALTER TABLE `divisi`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nama_UNIQUE` (`nama`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nama_UNIQUE` (`nama_kegiatan`),
  ADD KEY `fk_history_asset1` (`asset_id`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nama_UNIQUE` (`nama`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mutasi`
--
ALTER TABLE `mutasi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_divisi_has_asset_divisi1` (`divisi_id`),
  ADD KEY `fk_divisi_has_asset_asset1` (`asset_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `team`
--
ALTER TABLE `team`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `asset`
--
ALTER TABLE `asset`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `divisi`
--
ALTER TABLE `divisi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `mutasi`
--
ALTER TABLE `mutasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `team`
--
ALTER TABLE `team`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `asset`
--
ALTER TABLE `asset`
  ADD CONSTRAINT `fk_asset_kategori` FOREIGN KEY (`kategori_id`) REFERENCES `kategori` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `history`
--
ALTER TABLE `history`
  ADD CONSTRAINT `fk_history_asset1` FOREIGN KEY (`asset_id`) REFERENCES `asset` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `mutasi`
--
ALTER TABLE `mutasi`
  ADD CONSTRAINT `fk_divisi_has_asset_asset1` FOREIGN KEY (`asset_id`) REFERENCES `asset` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_divisi_has_asset_divisi1` FOREIGN KEY (`divisi_id`) REFERENCES `divisi` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
