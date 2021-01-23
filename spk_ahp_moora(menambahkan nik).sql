-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 23 Jan 2021 pada 06.52
-- Versi server: 10.4.17-MariaDB
-- Versi PHP: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
-- Struktur dari tabel `alternatif`
--

CREATE TABLE `alternatif` (
  `id_alternatif` int(5) NOT NULL,
  `kode` varchar(10) NOT NULL,
  `nik` varchar(16) NOT NULL,
  `nama` varchar(20) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `Usia` int(5) NOT NULL,
  `pendidikan_terakhir` varchar(4) NOT NULL,
  `IPK` float NOT NULL,
  `no_HP` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `Berkas` varchar(150) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `size` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `alternatif`
--

INSERT INTO `alternatif` (`id_alternatif`, `kode`, `nik`, `nama`, `alamat`, `tgl_lahir`, `Usia`, `pendidikan_terakhir`, `IPK`, `no_HP`, `email`, `Berkas`, `username`, `password`, `size`) VALUES
(12, 'A01', '1234', 'choerunnisa ', 'Cirebon', '1995-09-03', 25, 'S1', 3.45, '085xxxxxxx', 'choerunnisa@gmail.com', 'choerunnisa -REKRUTMEN Guru taman kanak kanak.pdf', 'nisa', '$2y$10$h221YwNhE40mMXpNtQGRt.UZQcALV64RMwSp9p74IP.wl6yCLBpqe', ''),
(13, 'A02', '567', 'sri ', 'Cibogo, Waled', '1995-06-16', 25, 'S1', 3.78, '0858xxxxxxx', 'sri@gmail.com', 'sri -2602-5550-1-SM.pdf', 'sri', '$2y$10$Vu0qbqk.XWxCIgCDACeCcuPzOP83NM8xQxJxK9367mSVCziIFGmYu', ''),
(14, 'A03', '89', 'fatimah ', 'sukadana, waled', '1996-09-07', 24, 'S1', 3, '089xxxxxxxx', 'sffauziah@gmail.com', 'fatimah -SISTEM PENUNJANG KEPUTUSAN penerimaan guru.pdf', 'fatimah', '$2y$10$3.Bol6QJ/pWqJjRIgHWxduh98oCIQv7sKf4L800BzyE3gSFcFtUYq', ''),
(15, 'A04', '1011', 'eka ', 'kalimukti, pabedilan', '1994-12-01', 26, 'S1', 3.5, '0812xxxxxxxx', 'eka@gmail.com', 'eka -sistem pendukung keputusan penerimaan guru PAUD.pdf', 'eka1', '$2y$10$DDx.3Hh5knpVvSNrGhAzMOwxuW03gjSPMliGQ4lRRboZ6EJZ7PrVO', ''),
(16, 'A05', '1213', 'fahmi ', 'hulubanteng, cirebon', '1997-03-18', 23, 'S1', 3.6, '0831xxxxxx', 'fahmi@gmail.com', 'fahmi -RANCANGAN PENELITIAN SISTEM PENDUKUNG KEPUTUSAN PENERIMAAN GURU HONORER DI SEKOLAH MENENGAH ATAS DENGAN METODE ANALYTICAL HIERARCHY PROCESS.pdf', 'fahmi', '$2y$10$5YYnH3ga5bxLiRRGdUpT8u/mqyEcz/lW/M/Ud6vyl.43h0Ld7RXse', ''),
(17, 'A06', '1415', 'eva ', 'losari', '1997-09-14', 23, 'S1', 3.75, '084xxxxxx', 'eva@gmail.com', 'eva -SISTEM PENUNJANG KEPUTUSAN penerimaan guru.pdf', 'eva', '$2y$10$zl53N67BveNTcHsnCBA9oeNBPofRUbo1BR.PZnsipx3xUJPPt1chS', ''),
(18, 'A07', '1617', 'siti ', '26', '1996-12-26', 24, 'S1', 3.8, '087xxxxxxxx', 'siti@gmail.com', 'siti -Permendiknas No 16 Tahun 2007.pdf', 'siti', '$2y$10$P95pU9xi6Q99o55iNFy2buec1CHsZ0C37Q/ERAk6rO1fyjNFLMxra', ''),
(23, 'A09', '1819', 'muklis', '', '0000-00-00', 0, '', 0, '', '', '', 'muklis', '$2y$10$c8quAtE1rUmHo1YfrtQjs.woKIEXdMW5L1SsDgjpXdH3znQcnHuda', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `bobot_kriteria`
--

CREATE TABLE `bobot_kriteria` (
  `id_bobot` int(10) NOT NULL,
  `id_kriteria` int(11) NOT NULL,
  `nilai` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `bobot_kriteria`
--

INSERT INTO `bobot_kriteria` (`id_bobot`, `id_kriteria`, `nilai`) VALUES
(1, 1, 0.454332),
(2, 2, 0.221825),
(3, 4, 0.17247),
(4, 5, 0.0868295),
(6, 7, 0.0645438);

-- --------------------------------------------------------

--
-- Struktur dari tabel `hasil`
--

CREATE TABLE `hasil` (
  `id_hasil` int(10) NOT NULL,
  `id_alternatif` int(11) NOT NULL,
  `nilai` float NOT NULL,
  `tanggal` datetime NOT NULL,
  `ket` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `hasil`
--

INSERT INTO `hasil` (`id_hasil`, `id_alternatif`, `nilai`, `tanggal`, `ket`) VALUES
(1, 17, 0.512046, '2021-01-13 04:34:07', 'lulus'),
(2, 18, 0.50443, '2021-01-13 04:34:07', 'tidak lulus'),
(3, 13, 0.4922, '2021-01-13 04:34:07', 'tidak lulus'),
(4, 16, 0.491832, '2021-01-13 04:34:07', 'tidak lulus'),
(5, 14, 0.488406, '2021-01-13 04:34:07', 'tidak lulus'),
(6, 15, 0.485007, '2021-01-13 04:34:07', 'tidak lulus'),
(7, 12, 0.473364, '2021-01-13 04:34:07', 'tidak lulus');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kriteria`
--

CREATE TABLE `kriteria` (
  `id_kriteria` int(5) NOT NULL,
  `id` int(3) NOT NULL,
  `kode` varchar(10) NOT NULL,
  `nama_kriteria` varchar(20) NOT NULL,
  `jenis_kriteria` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kriteria`
--

INSERT INTO `kriteria` (`id_kriteria`, `id`, `kode`, `nama_kriteria`, `jenis_kriteria`) VALUES
(1, 1, 'K1', 'pendidikan terakhir', 'Benefit'),
(2, 1, 'K2', 'IPK', 'Benefit'),
(4, 1, 'K3', 'usia', 'Cost'),
(5, 2, 'K4', 'microteaching', 'Benefit'),
(7, 2, 'K5', 'wawancara', 'Benefit');

-- --------------------------------------------------------

--
-- Struktur dari tabel `nilai_alt`
--

CREATE TABLE `nilai_alt` (
  `id_nilai` int(5) NOT NULL,
  `id_kriteria` int(5) NOT NULL,
  `id_subkriteria` int(5) NOT NULL,
  `id_alternatif` int(5) NOT NULL,
  `nilai` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `nilai_alt`
--

INSERT INTO `nilai_alt` (`id_nilai`, `id_kriteria`, `id_subkriteria`, `id_alternatif`, `nilai`) VALUES
(160, 1, 0, 12, 80),
(161, 2, 0, 12, 3.45),
(162, 4, 0, 12, 25),
(163, 5, 1, 12, 65),
(164, 5, 2, 12, 65),
(165, 5, 3, 12, 75),
(166, 5, 4, 12, 65),
(167, 5, 5, 12, 80),
(168, 5, 6, 12, 65),
(169, 5, 7, 12, 80),
(170, 7, 18, 12, 70),
(171, 7, 19, 12, 75),
(172, 7, 20, 12, 80),
(173, 1, 0, 13, 80),
(174, 2, 0, 13, 3.78),
(175, 4, 0, 13, 25),
(176, 5, 1, 13, 60),
(177, 5, 2, 13, 80),
(178, 5, 3, 13, 80),
(179, 5, 4, 13, 60),
(180, 5, 5, 13, 80),
(181, 5, 6, 13, 80),
(182, 5, 7, 13, 80),
(183, 7, 18, 13, 70),
(184, 7, 19, 13, 80),
(185, 7, 20, 13, 75),
(186, 1, 0, 14, 80),
(187, 2, 0, 14, 3),
(188, 4, 0, 14, 24),
(189, 5, 1, 14, 75),
(190, 5, 2, 14, 80),
(191, 5, 3, 14, 78),
(192, 5, 4, 14, 75),
(193, 5, 5, 14, 80),
(194, 5, 6, 14, 75),
(195, 5, 7, 14, 80),
(196, 7, 18, 14, 75),
(197, 7, 19, 14, 75),
(198, 7, 20, 14, 80),
(199, 1, 0, 15, 80),
(200, 2, 0, 15, 3.5),
(201, 4, 0, 15, 26),
(202, 5, 1, 15, 80),
(203, 5, 2, 15, 70),
(204, 5, 3, 15, 65),
(205, 5, 4, 15, 80),
(206, 5, 5, 15, 80),
(207, 5, 6, 15, 70),
(208, 5, 7, 15, 80),
(209, 7, 18, 15, 75),
(210, 7, 19, 15, 69),
(211, 7, 20, 15, 80),
(212, 1, 0, 16, 80),
(213, 2, 0, 16, 3.6),
(214, 4, 0, 16, 23),
(215, 5, 1, 16, 75),
(216, 5, 2, 16, 75),
(217, 5, 3, 16, 70),
(218, 5, 4, 16, 75),
(219, 5, 5, 16, 80),
(220, 5, 6, 16, 65),
(221, 5, 7, 16, 80),
(222, 7, 18, 16, 75),
(223, 7, 19, 16, 70),
(224, 7, 20, 16, 75),
(225, 1, 0, 17, 80),
(226, 2, 0, 17, 3.75),
(227, 4, 0, 17, 23),
(228, 5, 1, 17, 75),
(229, 5, 2, 17, 80),
(230, 5, 3, 17, 80),
(231, 5, 4, 17, 80),
(232, 5, 5, 17, 75),
(233, 5, 6, 17, 80),
(234, 5, 7, 17, 80),
(235, 7, 18, 17, 75),
(236, 7, 19, 17, 80),
(237, 7, 20, 17, 75),
(238, 1, 0, 18, 80),
(239, 2, 0, 18, 3.8),
(240, 4, 0, 18, 24),
(241, 5, 1, 18, 80),
(242, 5, 2, 18, 75),
(243, 5, 3, 18, 75),
(244, 5, 4, 18, 80),
(245, 5, 5, 18, 75),
(246, 5, 6, 18, 75),
(247, 5, 7, 18, 80),
(248, 7, 18, 18, 70),
(249, 7, 19, 18, 75),
(250, 7, 20, 18, 80),
(285, 1, 0, 23, 100),
(286, 2, 0, 23, 0),
(287, 4, 0, 23, 0),
(288, 5, 1, 23, 12),
(289, 5, 2, 23, 1),
(290, 5, 3, 23, 2),
(291, 5, 4, 23, 12),
(292, 5, 5, 23, 12),
(293, 5, 6, 23, 12),
(294, 5, 7, 23, 12),
(295, 7, 18, 23, 12),
(296, 7, 19, 23, 12),
(297, 7, 20, 23, 12);

-- --------------------------------------------------------

--
-- Struktur dari tabel `nilai_ir`
--

CREATE TABLE `nilai_ir` (
  `id` int(5) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `nilai` float NOT NULL,
  `keterangan` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `nilai_ir`
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
-- Struktur dari tabel `perhitungan`
--

CREATE TABLE `perhitungan` (
  `id_perangkingan` int(5) NOT NULL,
  `kriteria1` int(5) NOT NULL,
  `kriteria2` int(5) NOT NULL,
  `nilai_perbandingan` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `perhitungan`
--

INSERT INTO `perhitungan` (`id_perangkingan`, `kriteria1`, `kriteria2`, `nilai_perbandingan`) VALUES
(1, 1, 2, 3),
(2, 1, 4, 3),
(3, 1, 5, 5),
(5, 2, 4, 2),
(6, 2, 5, 3),
(8, 4, 5, 3),
(11, 1, 7, 5),
(12, 2, 7, 3),
(13, 4, 7, 3),
(14, 5, 7, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `reset_password`
--

CREATE TABLE `reset_password` (
  `id` int(5) NOT NULL,
  `code` varchar(255) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `reset_password`
--

INSERT INTO `reset_password` (`id`, `code`, `email`) VALUES
(17, '15ff497abaac5c', 'lili@gmail.com'),
(18, '15ff51f01c05db', 'aayhumairoh29@gmail.com');

-- --------------------------------------------------------

--
-- Struktur dari tabel `subkriteria`
--

CREATE TABLE `subkriteria` (
  `id_subkriteria` int(5) NOT NULL,
  `id_kriteria` int(5) NOT NULL,
  `kode` varchar(10) NOT NULL,
  `nama_subkriteria` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `subkriteria`
--

INSERT INTO `subkriteria` (`id_subkriteria`, `id_kriteria`, `kode`, `nama_subkriteria`) VALUES
(1, 5, 'K4.1', 'rencana pembelajaran'),
(2, 5, 'K4.2', 'pembukaan pembelajaran '),
(3, 5, 'K4.3', 'inti (proses pembelajaran)'),
(4, 5, 'K4.4', 'Integritas nilai nilai islam'),
(5, 5, 'K4.5', 'penutupan'),
(6, 5, 'K4.6', 'kesesuaian rencana dan praktek'),
(7, 5, 'K4.7', 'penampilan'),
(18, 7, 'K5.1', 'pendidikan'),
(19, 7, 'K5.2', 'keislaman'),
(20, 7, 'K5.3', 'motivasi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_admin` int(5) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_admin`, `username`, `password`, `level`) VALUES
(119, 'admin', '$2y$10$q0iZSsse/YPMGwJHqH3aUu6S/QsnRCTsbDtYw/Yf15XG86f3CCdO2', 'admin'),
(121, 'op1', '$2y$10$C8hobW9aKfYeZrwTiLGfRukzovQfzMFVoAs3xqY8euIrv3RkvED8G', 'operator');

-- --------------------------------------------------------

--
-- Struktur dari tabel `web_set`
--

CREATE TABLE `web_set` (
  `id_set` int(11) NOT NULL,
  `status_web` varchar(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `web_set`
--

INSERT INTO `web_set` (`id_set`, `status_web`) VALUES
(1, '1');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `alternatif`
--
ALTER TABLE `alternatif`
  ADD PRIMARY KEY (`id_alternatif`);

--
-- Indeks untuk tabel `bobot_kriteria`
--
ALTER TABLE `bobot_kriteria`
  ADD PRIMARY KEY (`id_bobot`);

--
-- Indeks untuk tabel `hasil`
--
ALTER TABLE `hasil`
  ADD PRIMARY KEY (`id_hasil`);

--
-- Indeks untuk tabel `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`id_kriteria`);

--
-- Indeks untuk tabel `nilai_alt`
--
ALTER TABLE `nilai_alt`
  ADD PRIMARY KEY (`id_nilai`);

--
-- Indeks untuk tabel `nilai_ir`
--
ALTER TABLE `nilai_ir`
  ADD PRIMARY KEY (`jumlah`);

--
-- Indeks untuk tabel `perhitungan`
--
ALTER TABLE `perhitungan`
  ADD PRIMARY KEY (`id_perangkingan`);

--
-- Indeks untuk tabel `reset_password`
--
ALTER TABLE `reset_password`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `subkriteria`
--
ALTER TABLE `subkriteria`
  ADD PRIMARY KEY (`id_subkriteria`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indeks untuk tabel `web_set`
--
ALTER TABLE `web_set`
  ADD PRIMARY KEY (`id_set`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `alternatif`
--
ALTER TABLE `alternatif`
  MODIFY `id_alternatif` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT untuk tabel `bobot_kriteria`
--
ALTER TABLE `bobot_kriteria`
  MODIFY `id_bobot` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `hasil`
--
ALTER TABLE `hasil`
  MODIFY `id_hasil` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `kriteria`
--
ALTER TABLE `kriteria`
  MODIFY `id_kriteria` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `nilai_alt`
--
ALTER TABLE `nilai_alt`
  MODIFY `id_nilai` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=306;

--
-- AUTO_INCREMENT untuk tabel `perhitungan`
--
ALTER TABLE `perhitungan`
  MODIFY `id_perangkingan` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `reset_password`
--
ALTER TABLE `reset_password`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `subkriteria`
--
ALTER TABLE `subkriteria`
  MODIFY `id_subkriteria` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_admin` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;

--
-- AUTO_INCREMENT untuk tabel `web_set`
--
ALTER TABLE `web_set`
  MODIFY `id_set` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
