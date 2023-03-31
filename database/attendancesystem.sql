-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 07, 2020 at 04:42 AM
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
-- Database: `attendancesystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `guru`
--

CREATE TABLE `guru` (
  `idGuru` varchar(10) NOT NULL COMMENT 'guru yang berdaftar dan nombor unik',
  `nama` varchar(50) NOT NULL COMMENT 'nama bagi setiap guru',
  `alamat` varchar(50) NOT NULL DEFAULT 'Belum dinyatakan' COMMENT 'alamat rumah',
  `notelefon` varchar(15) DEFAULT NULL COMMENT 'nombor telefon guru',
  `user_type` varchar(10) NOT NULL,
  `idKelas` varchar(10) NOT NULL COMMENT 'kelas yang didaftar',
  `password` varchar(50) NOT NULL COMMENT 'kata laluan '
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `guru`
--

INSERT INTO `guru` (`idGuru`, `nama`, `alamat`, `notelefon`, `user_type`, `idKelas`, `password`) VALUES
('GG003', 'Farizul Azwan', '80. Kampung Parit Baru, Mukim 8, Parit Raja, 86400', '+60137489073', 'user', '5', '202cb962ac59075b964b07152d234b70'),
('GG005', 'Haji Ahmad Ali', '80. Kampung Parit Baru, Mukim 8, Parit Raja, 86400', '+60137489073', 'user', '4', '202cb962ac59075b964b07152d234b70'),
('GG008', 'farhan Anuar', 'parit baru', '0123456789', 'user', '3', '250cf8b51c773f3f8dc8b4be867a9a02'),
('GG009', 'Syahid Hani', 'Kampung Parit Raja', '0147852369', 'user', '1', '202cb962ac59075b964b07152d234b70');

-- --------------------------------------------------------

--
-- Table structure for table `kehadiran`
--

CREATE TABLE `kehadiran` (
  `idKehadiran` int(10) NOT NULL COMMENT 'Nombor yang unik',
  `Status` varchar(10) NOT NULL COMMENT 'Pelajar hadir atau tidak hadir',
  `Sebab` varchar(100) NOT NULL,
  `Tarikh` date NOT NULL COMMENT 'Tarikh pelajar tidak hadir',
  `idPelajar` varchar(10) NOT NULL COMMENT 'Pelajar yang berdaftar',
  `idKelas` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kehadiran`
--

INSERT INTO `kehadiran` (`idKehadiran`, `Status`, `Sebab`, `Tarikh`, `idPelajar`, `idKelas`) VALUES
(452, 'Present', '', '2020-01-02', 'AA001', '3'),
(464, 'Absent', 'Representating School', '2019-12-01', 'AA001', '3'),
(469, 'Present', '', '2019-12-08', 'AA916', '1'),
(471, 'Present', '', '2019-12-31', 'AA916', '1'),
(472, 'Present', '', '2019-12-03', 'AA001', '3'),
(473, 'Absent', 'Medical Certificate', '2019-12-16', 'AA001', '3'),
(474, 'Present', '', '2020-01-13', 'AA001', '3'),
(475, 'Absent', 'Medical Certificate', '2020-01-13', 'AA101', '3'),
(476, 'Absent', 'Representating School', '2020-01-13', 'AA111', '3');

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `idKelas` varchar(10) NOT NULL COMMENT 'kelas yang berdaftar',
  `namaKelas` varchar(10) NOT NULL COMMENT 'nama kelas'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`idKelas`, `namaKelas`) VALUES
('1', 'UTHM'),
('2', 'UTM'),
('3', 'UITM'),
('4', 'UPNM'),
('5', 'UIA');

-- --------------------------------------------------------

--
-- Table structure for table `multi_login`
--

CREATE TABLE `multi_login` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `user_type` varchar(10) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `multi_login`
--

INSERT INTO `multi_login` (`id`, `username`, `email`, `user_type`, `password`) VALUES
(15, 'halim123', 'xyz@gmail.com', 'admin', '202cb962ac59075b964b07152d234b70');

-- --------------------------------------------------------

--
-- Table structure for table `pelajar`
--

CREATE TABLE `pelajar` (
  `idPelajar` varchar(10) NOT NULL COMMENT 'pelajar yang berdaftar',
  `nama` varchar(50) NOT NULL COMMENT 'nama bagi setiap pelajar',
  `alamat` varchar(50) NOT NULL DEFAULT 'Belum dinyatakan' COMMENT 'alamat rumah pelajar',
  `notelefon` varchar(15) NOT NULL COMMENT 'nombor telefon pelajar',
  `idKelas` varchar(10) NOT NULL COMMENT 'kelas yang berdaftar'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pelajar`
--

INSERT INTO `pelajar` (`idPelajar`, `nama`, `alamat`, `notelefon`, `idKelas`) VALUES
('AA001', 'Azhari', '80. Kampung Parit Baru, Mukim 8, Parit Raja, 86400', '+60137489073', '3'),
('AA007', 'Farizzul Izzwan', 'NO72,Jalan Merpati 2,Taman Merpati,09000,Kulim,Ked', '0166794397', '5'),
('AA010', 'Syahid Hatta', 'No10,Jalan Taman 10,Taman 10,Messi, Argentina', '999', '5'),
('AA019', 'aku', 'Belum dinyatakan', '', '2'),
('AA088', 'Suraya', 'no7,Jalan Taman 7, Taman 7, 07070, Cristiano Ronal', '010', '4'),
('AA101', 'kau', 'Belum dinyatakan', '', '3'),
('AA111', 'kami', 'Belum dinyatakan', '', '3'),
('AA916', 'Amir Aniq', 'No99,Jalan Longkang ,Taman Loji,55555,Melbourne,Au', '991', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`idGuru`),
  ADD KEY `idKelas` (`idKelas`);

--
-- Indexes for table `kehadiran`
--
ALTER TABLE `kehadiran`
  ADD PRIMARY KEY (`idKehadiran`),
  ADD KEY `idPelajar` (`idPelajar`),
  ADD KEY `kehadiran_ibfk_1` (`idKelas`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`idKelas`);

--
-- Indexes for table `multi_login`
--
ALTER TABLE `multi_login`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `pelajar`
--
ALTER TABLE `pelajar`
  ADD PRIMARY KEY (`idPelajar`),
  ADD KEY `idKelas` (`idKelas`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kehadiran`
--
ALTER TABLE `kehadiran`
  MODIFY `idKehadiran` int(10) NOT NULL AUTO_INCREMENT COMMENT 'Nombor yang unik', AUTO_INCREMENT=477;

--
-- AUTO_INCREMENT for table `multi_login`
--
ALTER TABLE `multi_login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `guru`
--
ALTER TABLE `guru`
  ADD CONSTRAINT `kelas_ibfk_1` FOREIGN KEY (`idKelas`) REFERENCES `kelas` (`idKelas`);

--
-- Constraints for table `kehadiran`
--
ALTER TABLE `kehadiran`
  ADD CONSTRAINT `kehadiran_ibfk_1` FOREIGN KEY (`idKelas`) REFERENCES `kelas` (`idKelas`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `kehadiran_ibfk_2` FOREIGN KEY (`idPelajar`) REFERENCES `pelajar` (`idPelajar`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pelajar`
--
ALTER TABLE `pelajar`
  ADD CONSTRAINT `pelajar_ibfk_1` FOREIGN KEY (`idKelas`) REFERENCES `kelas` (`idKelas`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
