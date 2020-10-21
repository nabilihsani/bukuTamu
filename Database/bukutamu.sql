-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 28, 2020 at 09:56 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bukutamu`
--

-- --------------------------------------------------------

--
-- Table structure for table `grup`
--

CREATE TABLE `grup` (
  `grupId` varchar(4) NOT NULL,
  `grupName` varchar(100) NOT NULL,
  `Company` varchar(100) NOT NULL,
  `Lokasi` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `grup`
--

INSERT INTO `grup` (`grupId`, `grupName`, `Company`, `Lokasi`) VALUES
('G183', 'IPO', 'Schneider Electric', 'Batam'),
('G242', 'HR', 'Schneider Electric', 'Ventura'),
('G437', 'Teknik Informatika', 'Universitas Diponegoro', NULL),
('G644', 'Kimia', 'Universitas Diponegoto', NULL),
('G898', 'Marketing', 'Jatelindo', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `grupvisit`
--

CREATE TABLE `grupvisit` (
  `visitId` int(11) UNSIGNED NOT NULL,
  `grupId` varchar(4) NOT NULL,
  `Code` int(10) UNSIGNED DEFAULT NULL,
  `visitorName` varchar(100) NOT NULL,
  `visitPhone` varchar(20) DEFAULT NULL,
  `visitorEmail` varchar(100) NOT NULL,
  `visitCount` int(11) NOT NULL,
  `Tujuan` varchar(100) NOT NULL,
  `Keperluan` varchar(100) NOT NULL,
  `Masuk` datetime(6) NOT NULL,
  `Keluar` datetime(6) DEFAULT NULL,
  `Status` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `grupvisit`
--

INSERT INTO `grupvisit` (`visitId`, `grupId`, `Code`, `visitorName`, `visitPhone`, `visitorEmail`, `visitCount`, `Tujuan`, `Keperluan`, `Masuk`, `Keluar`, `Status`) VALUES
(2, 'G242', NULL, 'Nabil', NULL, 'nabil123@gmai.com', 2, 'Akrom', '-', '2020-02-10 14:35:41.000000', '2020-02-10 14:46:21.000000', 'Passive'),
(3, 'G437', NULL, 'Syahrul Wirawan', NULL, 'syahrulw1@gmail.com', 3, 'Iqbal Romadhon', '-', '2020-02-10 14:37:08.000000', '2020-02-10 14:47:17.000000', 'Passive'),
(9, 'G898', NULL, 'Muhamad nabil Ihsani', '081326950652', 'nabilihsani424@gmail.com', 5, 'Nabil', 'Play', '2020-02-28 14:24:07.000000', NULL, 'Active'),
(10, 'G644', NULL, 'Iqbal Bahtiar', '456456456', 'iqbal1@gmail.com', 3, 'Nabil', 'main', '2020-02-28 14:25:38.000000', NULL, 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `kartu`
--

CREATE TABLE `kartu` (
  `Code` int(10) UNSIGNED NOT NULL,
  `id` varchar(4) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kartu`
--

INSERT INTO `kartu` (`Code`, `id`, `status`) VALUES
(1, '-', 'Available'),
(2, '-', 'Available'),
(3, '-', 'Available'),
(4, '-', 'Available'),
(5, '-', 'Available'),
(6, '-', 'Available'),
(7, '-', 'Available'),
(8, '-', 'Available'),
(9, '-', 'Available'),
(10, '-', 'Available'),
(11, '-', 'Available'),
(12, '-', 'Available'),
(13, '-', 'Available'),
(14, '-', 'Available'),
(15, '-', 'Available'),
(16, '-', 'Available'),
(17, '-', 'Available'),
(18, '-', 'Available'),
(19, '-', 'Available'),
(20, '-', 'Available'),
(21, '-', 'Available'),
(22, '-', 'Available'),
(23, '-', 'Available'),
(24, '-', 'Available'),
(25, '-', 'Available');

-- --------------------------------------------------------

--
-- Table structure for table `kunjungan`
--

CREATE TABLE `kunjungan` (
  `idKunjungan` int(11) UNSIGNED NOT NULL,
  `idTamu` varchar(4) NOT NULL,
  `Code` int(10) UNSIGNED DEFAULT NULL,
  `Tujuan` varchar(100) NOT NULL,
  `Keperluan` varchar(100) NOT NULL,
  `Masuk` datetime(6) NOT NULL,
  `Keluar` datetime(6) DEFAULT NULL,
  `Status` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kunjungan`
--

INSERT INTO `kunjungan` (`idKunjungan`, `idTamu`, `Code`, `Tujuan`, `Keperluan`, `Masuk`, `Keluar`, `Status`) VALUES
(1, 'G123', NULL, 'Febi Gunawan', 'Internship', '2020-02-10 13:36:03.000000', '2020-02-10 14:03:49.000000', 'Passive'),
(2, 'G774', NULL, 'Akrom Naufal', 'Meeting', '2020-02-10 13:37:22.000000', '2020-02-11 14:00:57.000000', 'Passive'),
(3, 'G551', NULL, 'Yoga', 'Meeting', '2020-02-10 13:40:30.000000', '2020-02-11 14:01:03.000000', 'Passive'),
(7, 'G463', NULL, 'Rizky Ramadhan', 'Meeting', '2020-02-10 14:51:03.000000', '2020-02-11 14:03:54.000000', 'Passive'),
(8, 'G743', NULL, 'Juan', 'Internship', '2020-02-10 14:54:14.000000', '2020-02-11 14:04:00.000000', 'Passive'),
(13, 'G709', NULL, 'Zanuar Galang', 'Internship', '2020-02-11 14:20:06.000000', '2020-02-12 11:19:09.000000', 'Passive'),
(15, 'G895', NULL, 'Muhamad Nabil Ihsani', 'Meeting', '2020-02-11 14:22:51.000000', '2020-02-12 11:19:03.000000', 'Passive'),
(16, 'G271', NULL, 'Syahrul Wirawan', 'Meeting', '2020-02-11 14:51:55.000000', '2020-02-12 11:19:13.000000', 'Passive'),
(17, 'G021', NULL, 'Rayhan Akrom Naufal', 'Meeting', '2020-02-12 11:18:38.000000', '2020-02-13 09:55:31.000000', 'Passive'),
(33, 'G135', NULL, 'Zanuar Galang', 'Internship', '2020-02-28 15:55:25.000000', NULL, 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `tamu`
--

CREATE TABLE `tamu` (
  `idTamu` varchar(4) NOT NULL,
  `Nama` varchar(100) NOT NULL,
  `Phone` varchar(20) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `Company` varchar(100) NOT NULL,
  `Lokasi` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tamu`
--

INSERT INTO `tamu` (`idTamu`, `Nama`, `Phone`, `Email`, `Company`, `Lokasi`) VALUES
('G021', 'Nabil Ihsani', NULL, 'nabilihsani424@students.undip.ac.id\r\n', 'Universitas Diponegoro', NULL),
('G054', 'Rayhan Akrom Naufal', NULL, 'rayhanakn@gmail.com', 'Telkom Indonesia', NULL),
('G123', 'Muhamad Nabil Ihsani', NULL, 'nabilihsani424@gmail.com', 'Universitas Diponegoro', NULL),
('G135', 'Muhamad Nabil Ihsani', '091326950652', 'nabilihsani424@students.undip.ac.id', 'Universitas Diponegoro', ''),
('G212', 'Muhamad Nabil Ihsani', NULL, 'nabilihsani424@gmail.com', 'Universitas Diponegoro', NULL),
('G271', 'Iqbal Bahtiar', NULL, 'iqbalb3@gmail.com', 'Jatelindo', NULL),
('G463', 'Iqbal Bahtiar', NULL, 'iqbalb1@gmail.com', 'PLN', NULL),
('G551', 'Axel Christopher', NULL, 'axelchris@gmail.com', 'Schneider', NULL),
('G709', 'Muhamad Nabil Ihsani', NULL, 'nabilihsani424@gmail.com', 'Schneider', NULL),
('G743', 'Wahyu Nugroho', NULL, 'wahyuN@gmail.com', 'Pertamina', NULL),
('G774', 'Ikhsan Nurrahman', NULL, 'ikhsannur@gmail.com', 'Schneider', NULL),
('G895', 'Dicky Firmansyah', NULL, 'dickydf@gmail.com', 'Jatelindo', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `NIP` int(11) NOT NULL,
  `Nama` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`NIP`, `Nama`, `username`, `password`) VALUES
(2, 'Resepsionis', 'admin', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `grup`
--
ALTER TABLE `grup`
  ADD PRIMARY KEY (`grupId`);

--
-- Indexes for table `grupvisit`
--
ALTER TABLE `grupvisit`
  ADD PRIMARY KEY (`visitId`),
  ADD KEY `Code` (`Code`),
  ADD KEY `grupId` (`grupId`);

--
-- Indexes for table `kartu`
--
ALTER TABLE `kartu`
  ADD PRIMARY KEY (`Code`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `kunjungan`
--
ALTER TABLE `kunjungan`
  ADD PRIMARY KEY (`idKunjungan`),
  ADD KEY `idTamu` (`idTamu`),
  ADD KEY `Code` (`Code`);

--
-- Indexes for table `tamu`
--
ALTER TABLE `tamu`
  ADD PRIMARY KEY (`idTamu`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`NIP`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `grupvisit`
--
ALTER TABLE `grupvisit`
  MODIFY `visitId` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `kartu`
--
ALTER TABLE `kartu`
  MODIFY `Code` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `kunjungan`
--
ALTER TABLE `kunjungan`
  MODIFY `idKunjungan` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `grupvisit`
--
ALTER TABLE `grupvisit`
  ADD CONSTRAINT `grupvisit_ibfk_1` FOREIGN KEY (`Code`) REFERENCES `kartu` (`Code`),
  ADD CONSTRAINT `grupvisit_ibfk_2` FOREIGN KEY (`grupId`) REFERENCES `grup` (`grupId`);

--
-- Constraints for table `kunjungan`
--
ALTER TABLE `kunjungan`
  ADD CONSTRAINT `kunjungan_ibfk_2` FOREIGN KEY (`idTamu`) REFERENCES `tamu` (`idTamu`),
  ADD CONSTRAINT `kunjungan_ibfk_3` FOREIGN KEY (`Code`) REFERENCES `kartu` (`Code`) ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
