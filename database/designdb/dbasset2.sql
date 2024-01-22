-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 07, 2023 at 02:26 AM
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
-- Database: `dbasset2`
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
(6, 'Gedung Kampus B2', 4, 2000, 3000000000, 25, 'Sedang', 'Jl. Raya Lenteng Agung Jakarta Selatan', '', NULL),
(7, 'Gedung Kampus B3', 4, 2000, 5000000000, 25, 'Baik', 'Jl. Raya Lenteng Agung Jakarta Selatan', '', NULL),
(8, 'Laptop HP', 5, 2020, 7000000, 10, 'Baik', '', NULL, NULL),
(9, 'Laptop Lenovo Thinkpad', 5, 2022, 8000000, 8, 'Baik', '', NULL, NULL),
(10, 'Komputer 1', 5, 2022, 4000000, 8, 'Sedang', '', NULL, NULL),
(11, 'Komputer 2', 5, 2023, 6500000, 8, 'Baik', '', NULL, NULL),
(12, 'Bangku 1', 6, 2022, 500000, 3, 'Baik', '', NULL, NULL),
(13, 'Meja1', 6, 2022, 1000000, 5, 'Baik', '', NULL, NULL),
(14, 'Laptop Acer', 5, 2020, 7500000, 5, 'Baik', '', NULL, NULL);

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
(5, 'Elektronik'),
(6, 'Furniture'),
(4, 'Gedung'),
(2, 'Kendaraan'),
(1, 'Tanah');

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
-- Indexes for table `mutasi`
--
ALTER TABLE `mutasi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_divisi_has_asset_divisi1` (`divisi_id`),
  ADD KEY `fk_divisi_has_asset_asset1` (`asset_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `asset`
--
ALTER TABLE `asset`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `divisi`
--
ALTER TABLE `divisi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `mutasi`
--
ALTER TABLE `mutasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
