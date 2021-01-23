-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 07, 2020 at 08:54 AM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spk_ahp_moora`
--

-- --------------------------------------------------------

--
-- Table structure for table `alternatif`
--

CREATE TABLE `alternatif` (
  `id_alternatif` int(5) NOT NULL,
  `kode` varchar(10) NOT NULL,
  `nama` varchar(20) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `pendidikan_terakhir` varchar(4) NOT NULL,
  `Berkas` varchar(150) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `alternatif`
--

INSERT INTO `alternatif` (`id_alternatif`, `kode`, `nama`, `alamat`, `tgl_lahir`, `pendidikan_terakhir`, `Berkas`, `username`, `password`) VALUES
(47, 'A01', 'chaerunisa', 'Cirebon', '1995-09-03', 'S1', 'chaerunisa, s.pd -COVER PROPOSAL REVISI.pdf', 'chaerunisa', '$2y$10$3QCr83lTVOuYDD8vTzrNDe3a0SIY.h7VUFR/n7FKSs0JbujfijlxS'),
(48, 'A02', 'sri rumidayanti ', 'cibogo, waled', '1995-06-16', 'S1', 'sri rumidayanti -COVER PROPOSAL REVISI.pdf', 'sri r', '$2y$10$Ghu4eHGsRRld22iNOZvlkuMA3.1DKWNIsLw6x/hRXSEPyDbAS40He'),
(49, 'A03', 'siti fatimah fauziah', 'sukadana, waled', '1996-09-07', 'S1', 'siti fatimah fauziah -COVER PROPOSAL REVISI.pdf', 'siti', '$2y$10$XT0/qH0jENxJ6q09wpA1AOBx56Vc2CmQA9mCw8aztK4zMeaL3pKkW'),
(50, 'A04', 'eka sikhatul maula ', 'kalimukti, pabedilan', '1994-01-12', 'S1', 'eka sikhatul maula -COVER PROPOSAL REVISI.pdf', 'eka', '$2y$10$iCrRatVLLT4iGLQT0f7jy.ESNQdX3N5wn0Ga8o4mDJN00CuTiOw7i'),
(51, 'A05', 'fahmi widya ningrum ', 'hulubanteng, pabuaran', '1997-03-18', 'S1', 'fahmi widya ningrum  -COVER PROPOSAL REVISI.pdf', 'fahmi', '$2y$10$2gIVaZE2T//2mt9Iste4zufBFp.fffyoG/cVT8X.NK8vFhMIRnG5C'),
(52, 'A06', 'eva hilyatul aulia ', 'tawangan, losari', '1997-09-14', 'S1', 'eva hilyatul aulia -COVER PROPOSAL REVISI.pdf', 'eva', '$2y$10$ze0jWqW2lYY8W5NQJgrAg.JEKZDx6LRWnwKzMrzw2Q3FchKWeWlum');

-- --------------------------------------------------------

--
-- Table structure for table `bobot_kriteria`
--

CREATE TABLE `bobot_kriteria` (
  `id_bobot` int(10) NOT NULL,
  `id_kriteria` int(11) NOT NULL,
  `nilai` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bobot_kriteria`
--

INSERT INTO `bobot_kriteria` (`id_bobot`, `id_kriteria`, `nilai`) VALUES
(1, 67, 0.221825),
(2, 68, 0.17247),
(3, 69, 0.0868295),
(4, 70, 0.0645438),
(5, 64, 0.454332);

-- --------------------------------------------------------

--
-- Table structure for table `hasil`
--

CREATE TABLE `hasil` (
  `id_hasil` int(10) NOT NULL,
  `id_alternatif` int(11) NOT NULL,
  `nilai` float NOT NULL,
  `rank` varchar(5) NOT NULL,
  `tanggal` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hasil`
--

INSERT INTO `hasil` (`id_hasil`, `id_alternatif`, `nilai`, `rank`, `tanggal`) VALUES
(51, 52, 0.553161, '52', '2020-12-07 07:16:35'),
(52, 51, 0.531607, '51', '2020-12-07 07:16:35'),
(53, 48, 0.531481, '48', '2020-12-07 07:16:35'),
(54, 49, 0.527492, '49', '2020-12-07 07:16:35'),
(55, 50, 0.524182, '50', '2020-12-07 07:16:35'),
(56, 47, 0.522996, '47', '2020-12-07 07:16:35');

-- --------------------------------------------------------

--
-- Table structure for table `kriteria`
--

CREATE TABLE `kriteria` (
  `id_kriteria` int(5) NOT NULL,
  `id` int(3) NOT NULL,
  `kode` varchar(10) NOT NULL,
  `nama_kriteria` varchar(20) NOT NULL,
  `jenis_kriteria` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kriteria`
--

INSERT INTO `kriteria` (`id_kriteria`, `id`, `kode`, `nama_kriteria`, `jenis_kriteria`) VALUES
(64, 1, 'K1', 'Pendidikan terakhir', 'Benefit'),
(67, 1, 'K2', 'IPK', 'Benefit'),
(68, 1, 'K3', 'Usia', 'Cost'),
(69, 2, 'K4', 'Microteaching', 'Benefit'),
(70, 2, 'K5', 'Wawancara', 'Benefit');

-- --------------------------------------------------------

--
-- Table structure for table `nilai_alt`
--

CREATE TABLE `nilai_alt` (
  `id_nilai` int(5) NOT NULL,
  `id_kriteria` int(5) NOT NULL,
  `id_subkriteria` int(5) NOT NULL,
  `id_alternatif` int(5) NOT NULL,
  `nilai` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nilai_alt`
--

INSERT INTO `nilai_alt` (`id_nilai`, `id_kriteria`, `id_subkriteria`, `id_alternatif`, `nilai`) VALUES
(15, 64, 0, 47, 1),
(16, 67, 0, 47, 3.45),
(17, 68, 0, 47, 25),
(18, 69, 69, 47, 65),
(19, 69, 70, 47, 65),
(20, 69, 71, 47, 75),
(21, 69, 72, 47, 65),
(22, 69, 73, 47, 80),
(23, 69, 74, 47, 90),
(24, 69, 75, 47, 80),
(25, 70, 76, 47, 70),
(26, 70, 77, 47, 75),
(27, 70, 78, 47, 80),
(28, 64, 0, 48, 1),
(29, 67, 0, 48, 3.78),
(30, 68, 0, 48, 25),
(31, 69, 69, 48, 60),
(32, 69, 70, 48, 80),
(33, 69, 71, 48, 80),
(34, 69, 72, 48, 60),
(35, 69, 73, 48, 80),
(36, 69, 74, 48, 80),
(37, 69, 75, 48, 80),
(38, 70, 76, 48, 70),
(39, 70, 77, 48, 80),
(40, 70, 78, 48, 75),
(41, 64, 0, 49, 1),
(42, 67, 0, 49, 3),
(43, 68, 0, 49, 24),
(44, 69, 69, 49, 75),
(45, 69, 70, 49, 80),
(46, 69, 71, 49, 78),
(47, 69, 72, 49, 75),
(48, 69, 73, 49, 80),
(49, 69, 74, 49, 75),
(50, 69, 75, 49, 80),
(51, 70, 76, 49, 75),
(52, 70, 77, 49, 75),
(53, 70, 78, 49, 80),
(54, 64, 0, 50, 1),
(55, 67, 0, 50, 3.5),
(56, 68, 0, 50, 26),
(57, 69, 69, 50, 80),
(58, 69, 70, 50, 70),
(59, 69, 71, 50, 65),
(60, 69, 72, 50, 80),
(61, 69, 73, 50, 80),
(62, 69, 74, 50, 70),
(63, 69, 75, 50, 80),
(64, 70, 76, 50, 75),
(65, 70, 77, 50, 69),
(66, 70, 78, 50, 80),
(67, 64, 0, 51, 1),
(68, 67, 0, 51, 3.6),
(69, 68, 0, 51, 23),
(70, 69, 69, 51, 75),
(71, 69, 70, 51, 75),
(72, 69, 71, 51, 70),
(73, 69, 72, 51, 75),
(74, 69, 73, 51, 80),
(75, 69, 74, 51, 65),
(76, 69, 75, 51, 80),
(77, 70, 76, 51, 75),
(78, 70, 77, 51, 70),
(79, 70, 78, 51, 75),
(80, 64, 0, 52, 1),
(81, 67, 0, 52, 3.75),
(82, 68, 0, 52, 23),
(83, 69, 69, 52, 75),
(84, 69, 70, 52, 80),
(85, 69, 71, 52, 80),
(86, 69, 72, 52, 80),
(87, 69, 73, 52, 75),
(88, 69, 74, 52, 80),
(89, 69, 75, 52, 80),
(90, 69, 75, 52, 80),
(91, 70, 76, 52, 75),
(92, 70, 77, 52, 80),
(93, 70, 78, 52, 75);

-- --------------------------------------------------------

--
-- Table structure for table `nilai_ir`
--

CREATE TABLE `nilai_ir` (
  `id` int(5) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `nilai` float NOT NULL,
  `keterangan` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nilai_ir`
--

INSERT INTO `nilai_ir` (`id`, `jumlah`, `nilai`, `keterangan`) VALUES
(1, 1, 0, 'Kedua elemen sama penting'),
(1, 2, 0, 'nilai berada diantara dua nilai pertimbangan yang berdekatan'),
(1, 3, 0.58, 'elemen yang satu sedikit lebih penting dari elem lainnya'),
(1, 4, 0.9, 'nilai berada diantara dua nilai pertimbangan yang berdekatan'),
(1, 5, 1.12, 'elemen satu lebih penting dari elemen yang lain'),
(1, 6, 1.24, 'nilai diantara dua nilaipertimbangan yang berdekatan'),
(1, 7, 1.32, 'satu elemen jelas lebih mutlak penting dari pada elemen yang lainnya'),
(1, 8, 1.41, 'nilai berada diantara dua nilai pertimbangan yang berdekatan\r\n'),
(1, 9, 1.45, 'satu elemen mutlak lebih penting dari pada elemen yang lain'),
(0, 10, 1.49, ''),
(0, 11, 1.51, ''),
(0, 12, 1.48, ''),
(0, 13, 1.56, ''),
(0, 14, 1.57, ''),
(0, 15, 1.59, '');

-- --------------------------------------------------------

--
-- Table structure for table `perhitungan`
--

CREATE TABLE `perhitungan` (
  `id_perangkingan` int(5) NOT NULL,
  `kriteria1` int(5) NOT NULL,
  `kriteria2` int(5) NOT NULL,
  `nilai_perbandingan` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `perhitungan`
--

INSERT INTO `perhitungan` (`id_perangkingan`, `kriteria1`, `kriteria2`, `nilai_perbandingan`) VALUES
(5, 67, 68, 2),
(6, 67, 69, 3),
(7, 67, 70, 3),
(8, 68, 69, 3),
(9, 68, 70, 3),
(10, 69, 70, 2),
(11, 64, 67, 3),
(12, 64, 68, 3),
(13, 64, 69, 5),
(14, 64, 70, 5);

-- --------------------------------------------------------

--
-- Table structure for table `subkriteria`
--

CREATE TABLE `subkriteria` (
  `id_subkriteria` int(5) NOT NULL,
  `id_kriteria` int(5) NOT NULL,
  `kode` varchar(10) NOT NULL,
  `nama_subkriteria` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subkriteria`
--

INSERT INTO `subkriteria` (`id_subkriteria`, `id_kriteria`, `kode`, `nama_subkriteria`) VALUES
(69, 69, 'K4.1', 'rencana pembelajaran'),
(70, 69, 'K4.2', 'pembukaan pembelajaran '),
(71, 69, 'K4.3', 'inti proses pembelajaran'),
(72, 69, 'K4.4', 'integritas nilai nilai islam'),
(73, 69, 'K4.5', 'penutupan'),
(74, 69, 'K4.6', 'kesesuaian rencana dan praktek'),
(75, 69, 'K4.7', 'penampilan'),
(76, 70, 'K5.1', 'pendidikan'),
(77, 70, 'K5.2', 'keislaman'),
(78, 70, 'K5.3', 'motivasi');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_admin` int(5) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_admin`, `username`, `password`) VALUES
(80, 'admin1', '$2y$10$O3t91K4DcW0KekNoCqFwLeaPPKw.S9L8zJbaZvLHSUCCt88oqG2Mi'),
(111, 'admin2', '$2y$10$w7fBqk6OUHeqjKbN6o6Yl.AHOSakcrqnVdi2YZvG38.gVLEUEGLrW');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alternatif`
--
ALTER TABLE `alternatif`
  ADD PRIMARY KEY (`id_alternatif`);

--
-- Indexes for table `bobot_kriteria`
--
ALTER TABLE `bobot_kriteria`
  ADD PRIMARY KEY (`id_bobot`);

--
-- Indexes for table `hasil`
--
ALTER TABLE `hasil`
  ADD PRIMARY KEY (`id_hasil`);

--
-- Indexes for table `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`id_kriteria`);

--
-- Indexes for table `nilai_alt`
--
ALTER TABLE `nilai_alt`
  ADD PRIMARY KEY (`id_nilai`);

--
-- Indexes for table `nilai_ir`
--
ALTER TABLE `nilai_ir`
  ADD PRIMARY KEY (`jumlah`);

--
-- Indexes for table `perhitungan`
--
ALTER TABLE `perhitungan`
  ADD PRIMARY KEY (`id_perangkingan`);

--
-- Indexes for table `subkriteria`
--
ALTER TABLE `subkriteria`
  ADD PRIMARY KEY (`id_subkriteria`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_admin`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alternatif`
--
ALTER TABLE `alternatif`
  MODIFY `id_alternatif` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `bobot_kriteria`
--
ALTER TABLE `bobot_kriteria`
  MODIFY `id_bobot` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `hasil`
--
ALTER TABLE `hasil`
  MODIFY `id_hasil` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `kriteria`
--
ALTER TABLE `kriteria`
  MODIFY `id_kriteria` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `nilai_alt`
--
ALTER TABLE `nilai_alt`
  MODIFY `id_nilai` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT for table `perhitungan`
--
ALTER TABLE `perhitungan`
  MODIFY `id_perangkingan` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `subkriteria`
--
ALTER TABLE `subkriteria`
  MODIFY `id_subkriteria` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_admin` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
