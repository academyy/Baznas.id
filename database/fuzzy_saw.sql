-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 07, 2023 at 04:32 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fuzzy_saw`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_admin`
--

CREATE TABLE `tb_admin` (
  `user` varchar(16) DEFAULT NULL,
  `pass` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_admin`
--

INSERT INTO `tb_admin` (`user`, `pass`) VALUES
('admin', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Table structure for table `tb_alternatif`
--

CREATE TABLE `tb_alternatif` (
  `kode_alternatif` varchar(16) NOT NULL,
  `nama_alternatif` varchar(256) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `rank` int(11) DEFAULT NULL,
  `total` double DEFAULT NULL,
  `rekomendasi` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_alternatif`
--

INSERT INTO `tb_alternatif` (`kode_alternatif`, `nama_alternatif`, `keterangan`, `rank`, `total`, `rekomendasi`) VALUES
('A001', 'Avino Decosta Elvander', 'SD Semen Padang', 19, 0.3935, 'Tidak Direkomendasikan'),
('A002', 'Althair Pradipta Mulya', 'SD Yari School Padang', 18, 0.405, 'Tidak Direkomendasikan'),
('A003', 'Ali Nurhadi', 'SMPN 11 Padang', 13, 0.555, 'Tidak Direkomendasikan'),
('A004', 'Alifyo Alexander', 'SMPN 20 Padang', 8, 0.7125, 'Tidak Direkomendasikan'),
('A005', 'Dean Jufiga', 'SMAN 4 Padang', 4, 0.885, 'Rekomendasi'),
('A006', 'M Faiz Abdillah', 'SDN 09 Padang', 2, 1, 'Rekomendasi'),
('A007', 'Alifa Reski Putri', 'SDN 12 Padang', 15, 0.4845, 'Tidak Direkomendasikan'),
('A008', 'Faizha Izra Maharani', 'SMPN 31 Padang', 12, 0.59, 'Tidak Direkomendasikan'),
('A009', 'Taufik Ibnu Indarta', 'SDN 23 Padang', 14, 0.52, 'Tidak Direkomendasikan'),
('A010', 'Cello Alexander Ezuni', 'SMP Muhammaiyah 1 Padang', 6, 0.8125, 'Rekomendasi'),
('A011', 'M. Aqil Al Kahfi', 'SMPN 21 Padang', 1, 1, 'Rekomendasi'),
('A012', 'Danish Sany Nurachman', 'SMPN 30 Padang', 7, 0.7345, 'Tidak Direkomendasikan'),
('A013', 'Kazorla Abran Adhamas', 'SMPN 5 Padang', 17, 0.4345, 'Tidak Direkomendasikan'),
('A014', 'Zahra Sofia Izzatulya', 'SDN 32 Padang', 16, 0.438, 'Tidak Direkomendasikan'),
('A015', 'Mutiara Rahmadani', 'SMA Dian Andalas Padang', 5, 0.847, 'Rekomendasi'),
('A016', 'Zhahira Farzana', 'SMA Pembangunan Labor', 9, 0.682, 'Tidak Direkomendasikan'),
('A017', 'Raditya Bagastha ', 'SMPN 21 Padang', 11, 0.63, 'Tidak Direkomendasikan'),
('A018', 'Regan Arkana', 'SMA Adabiah Padang', 10, 0.635, 'Tidak Direkomendasikan'),
('A019', 'Fairuz Zahirah Atnadi', 'SMPN 24 Padang', 20, 0.3195, 'Tidak Direkomendasikan'),
('A020', 'Khirani Febri Saylendra', 'SMP Muhammadiyah 8 Padang', 3, 0.9625, 'Rekomendasi');

-- --------------------------------------------------------

--
-- Table structure for table `tb_crips`
--

CREATE TABLE `tb_crips` (
  `kode_crips` int(11) NOT NULL,
  `kode_kriteria` varchar(16) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `nilai_l` double DEFAULT NULL,
  `nilai_m` double DEFAULT NULL,
  `nilai_u` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_crips`
--

INSERT INTO `tb_crips` (`kode_crips`, `kode_kriteria`, `keterangan`, `nilai_l`, `nilai_m`, `nilai_u`) VALUES
(1, 'C01', '>5.000.000', 0.1, 0.1, 0.1),
(2, 'C01', '<4.000.000', 0.25, 0.25, 0.25),
(3, 'C01', '<3.000.000', 0.5, 0.5, 0.5),
(4, 'C01', '<1.500.000', 0.75, 0.75, 0.75),
(5, 'C01', '<1.000.000', 1, 1, 1),
(11, 'C06', 'Tidak Ada', 0.5, 0.5, 0.5),
(12, 'C06', 'Ada', 1, 1, 1),
(17, 'C05', 'Tidak Ada', 0.5, 0.5, 0.5),
(18, 'C05', 'Ada', 1, 1, 1),
(19, 'C04', '70 - 74', 0.1, 0.1, 0.1),
(20, 'C04', '75 - 79', 0.25, 0.25, 0.25),
(21, 'C04', '80 - 84', 0.5, 0.5, 0.5),
(22, 'C04', '85 - 89', 0.75, 0.75, 0.75),
(23, 'C04', '> 90', 1, 1, 1),
(24, 'C03', 'PNS', 0.1, 0.1, 0.1),
(25, 'C03', 'Swasta', 0.25, 0.25, 0.25),
(26, 'C03', 'Pedagang', 0.5, 0.5, 0.5),
(27, 'C03', 'Petani', 0.75, 0.75, 0.75),
(28, 'C03', 'Buruh Tani', 1, 1, 1),
(29, 'C02', '1 anak', 0.1, 0.1, 0.1),
(30, 'C02', '2 anak', 0.25, 0.25, 0.25),
(31, 'C02', '3 anak', 0.5, 0.5, 0.5),
(32, 'C02', '4 anak', 0.75, 0.75, 0.75),
(33, 'C02', '>5 anak', 1, 1, 1),
(36, 'C07', 'Tidak Ada', 0.5, 0.5, 0.5),
(37, 'C07', 'Ada', 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_kriteria`
--

CREATE TABLE `tb_kriteria` (
  `kode_kriteria` varchar(16) NOT NULL,
  `nama_kriteria` varchar(256) DEFAULT NULL,
  `atribut` varchar(16) DEFAULT NULL,
  `bobot` double DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_kriteria`
--

INSERT INTO `tb_kriteria` (`kode_kriteria`, `nama_kriteria`, `atribut`, `bobot`) VALUES
('C01', 'Gaji Orang Tua', 'benefit', 0.15),
('C02', 'Jumlah Tanggungan Orang Tua', 'benefit', 0.17),
('C03', 'Pekerjaan Orang Tua', 'benefit', 0.16),
('C04', 'Rata-Rata Rapor', 'benefit', 0.14),
('C05', 'Prestasi', 'benefit', 0.12),
('C06', 'Surat Rekomendasi', 'benefit', 0.11),
('C07', 'Surat Keterangan Tidak Mampu', 'benefit', 0.15);

-- --------------------------------------------------------

--
-- Table structure for table `tb_rel_alternatif`
--

CREATE TABLE `tb_rel_alternatif` (
  `ID` int(11) NOT NULL,
  `kode_alternatif` varchar(16) DEFAULT NULL,
  `kode_kriteria` varchar(16) DEFAULT NULL,
  `kode_crips` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_rel_alternatif`
--

INSERT INTO `tb_rel_alternatif` (`ID`, `kode_alternatif`, `kode_kriteria`, `kode_crips`) VALUES
(35, 'A001', 'C01', 1),
(36, 'A001', 'C02', 30),
(37, 'A001', 'C03', 24),
(38, 'A001', 'C04', 21),
(39, 'A001', 'C05', 18),
(40, 'A001', 'C06', 11),
(41, 'A002', 'C01', 2),
(42, 'A002', 'C02', 30),
(43, 'A002', 'C03', 25),
(44, 'A002', 'C04', 20),
(45, 'A002', 'C05', 18),
(46, 'A002', 'C06', 11),
(47, 'A003', 'C01', 3),
(48, 'A003', 'C02', 31),
(49, 'A003', 'C03', 26),
(50, 'A003', 'C04', 21),
(51, 'A003', 'C05', 17),
(52, 'A003', 'C06', 12),
(53, 'A004', 'C01', 4),
(54, 'A004', 'C02', 31),
(55, 'A004', 'C03', 27),
(56, 'A004', 'C04', 21),
(57, 'A004', 'C05', 18),
(58, 'A004', 'C06', 11),
(59, 'A005', 'C01', 5),
(60, 'A005', 'C02', 33),
(61, 'A005', 'C03', 28),
(62, 'A005', 'C04', 23),
(63, 'A005', 'C05', 17),
(64, 'A005', 'C06', 11),
(65, 'A006', 'C01', 5),
(66, 'A006', 'C02', 33),
(67, 'A006', 'C03', 28),
(68, 'A006', 'C04', 23),
(69, 'A006', 'C05', 18),
(70, 'A006', 'C06', 12),
(71, 'A007', 'C01', 2),
(72, 'A007', 'C02', 29),
(73, 'A007', 'C03', 25),
(74, 'A007', 'C04', 23),
(75, 'A007', 'C05', 18),
(76, 'A007', 'C06', 11),
(77, 'A008', 'C01', 2),
(78, 'A008', 'C02', 30),
(79, 'A008', 'C03', 28),
(80, 'A008', 'C04', 22),
(81, 'A008', 'C05', 17),
(82, 'A008', 'C06', 12),
(83, 'A009', 'C01', 3),
(84, 'A009', 'C02', 31),
(85, 'A009', 'C03', 25),
(86, 'A009', 'C04', 21),
(87, 'A009', 'C05', 18),
(88, 'A009', 'C06', 11),
(89, 'A010', 'C01', 4),
(90, 'A010', 'C02', 33),
(91, 'A010', 'C03', 26),
(92, 'A010', 'C04', 21),
(93, 'A010', 'C05', 18),
(94, 'A010', 'C06', 12),
(95, 'A011', 'C01', 5),
(96, 'A011', 'C02', 33),
(97, 'A011', 'C03', 28),
(98, 'A011', 'C04', 23),
(99, 'A011', 'C05', 18),
(100, 'A011', 'C06', 12),
(101, 'A012', 'C01', 4),
(102, 'A012', 'C02', 29),
(103, 'A012', 'C03', 27),
(104, 'A012', 'C04', 22),
(105, 'A012', 'C05', 18),
(106, 'A012', 'C06', 12),
(107, 'A013', 'C01', 2),
(108, 'A013', 'C02', 29),
(109, 'A013', 'C03', 25),
(110, 'A013', 'C04', 20),
(111, 'A013', 'C05', 18),
(112, 'A013', 'C06', 12),
(113, 'A014', 'C01', 1),
(114, 'A014', 'C02', 29),
(115, 'A014', 'C03', 24),
(116, 'A014', 'C04', 23),
(117, 'A014', 'C05', 18),
(118, 'A014', 'C06', 11),
(119, 'A015', 'C01', 5),
(120, 'A015', 'C02', 29),
(121, 'A015', 'C03', 28),
(122, 'A015', 'C04', 23),
(123, 'A015', 'C05', 18),
(124, 'A015', 'C06', 12),
(125, 'A016', 'C01', 5),
(126, 'A016', 'C02', 29),
(127, 'A016', 'C03', 28),
(128, 'A016', 'C04', 20),
(129, 'A016', 'C05', 17),
(130, 'A016', 'C06', 12),
(131, 'A017', 'C01', 3),
(132, 'A017', 'C02', 31),
(133, 'A017', 'C03', 26),
(134, 'A017', 'C04', 21),
(135, 'A017', 'C05', 17),
(136, 'A017', 'C06', 12),
(137, 'A018', 'C01', 2),
(138, 'A018', 'C02', 32),
(139, 'A018', 'C03', 26),
(140, 'A018', 'C04', 23),
(141, 'A018', 'C05', 18),
(142, 'A018', 'C06', 11),
(143, 'A019', 'C01', 2),
(144, 'A019', 'C02', 29),
(145, 'A019', 'C03', 25),
(146, 'A019', 'C04', 20),
(147, 'A019', 'C05', 17),
(148, 'A019', 'C06', 11),
(149, 'A020', 'C01', 4),
(150, 'A020', 'C02', 33),
(151, 'A020', 'C03', 28),
(152, 'A020', 'C04', 23),
(153, 'A020', 'C05', 18),
(154, 'A020', 'C06', 12),
(187, 'A006', 'C07', 37),
(186, 'A005', 'C07', 37),
(185, 'A004', 'C07', 37),
(184, 'A003', 'C07', 36),
(183, 'A002', 'C07', 36),
(182, 'A001', 'C07', 36),
(201, 'A020', 'C07', 37),
(200, 'A019', 'C07', 36),
(199, 'A018', 'C07', 36),
(198, 'A017', 'C07', 37),
(197, 'A016', 'C07', 37),
(196, 'A015', 'C07', 37),
(195, 'A014', 'C07', 36),
(194, 'A013', 'C07', 36),
(193, 'A012', 'C07', 37),
(192, 'A011', 'C07', 37),
(191, 'A010', 'C07', 37),
(190, 'A009', 'C07', 36),
(189, 'A008', 'C07', 36),
(188, 'A007', 'C07', 36);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_alternatif`
--
ALTER TABLE `tb_alternatif`
  ADD PRIMARY KEY (`kode_alternatif`);

--
-- Indexes for table `tb_crips`
--
ALTER TABLE `tb_crips`
  ADD PRIMARY KEY (`kode_crips`);

--
-- Indexes for table `tb_kriteria`
--
ALTER TABLE `tb_kriteria`
  ADD PRIMARY KEY (`kode_kriteria`);

--
-- Indexes for table `tb_rel_alternatif`
--
ALTER TABLE `tb_rel_alternatif`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_crips`
--
ALTER TABLE `tb_crips`
  MODIFY `kode_crips` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `tb_rel_alternatif`
--
ALTER TABLE `tb_rel_alternatif`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=202;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
