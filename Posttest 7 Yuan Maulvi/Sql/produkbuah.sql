-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 01, 2023 at 02:19 PM
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
-- Database: `tokobuah`
--

-- --------------------------------------------------------

--
-- Table structure for table `produkbuah`
--

CREATE TABLE `produkbuah` (
  `id_buah` int(11) NOT NULL,
  `nama_pemesan` text NOT NULL,
  `alamat_pengiriman` text NOT NULL,
  `buah_yang_dipesan` text NOT NULL,
  `jumlah_buah` int(11) NOT NULL,
  `no_whatsapp` varchar(100) NOT NULL,
  `metode_bayar` varchar(100) NOT NULL,
  `bukti_bayar` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produkbuah`
--

INSERT INTO `produkbuah` (`id_buah`, `nama_pemesan`, `alamat_pengiriman`, `buah_yang_dipesan`, `jumlah_buah`, `no_whatsapp`, `metode_bayar`, `bukti_bayar`) VALUES
(56, 'Yuan', 'Jl Sawo', 'Apel', 23, '081525936993', 'COD', '2023-11-01 dfd 0 dipa.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `produkbuah`
--
ALTER TABLE `produkbuah`
  ADD PRIMARY KEY (`id_buah`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `produkbuah`
--
ALTER TABLE `produkbuah`
  MODIFY `id_buah` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
