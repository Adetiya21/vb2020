-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 15, 2020 at 05:27 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_vb2020`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_admin`
--

CREATE TABLE `tb_admin` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_admin`
--

INSERT INTO `tb_admin` (`id`, `nama`, `username`, `password`) VALUES
(1, 'Adetiya', '0', '$2y$10$PtOAi5f39PQLfy4ePdJqB.XiVq/xT1HMfR19/o/Gl5LV1.Ygx35Z6');

-- --------------------------------------------------------

--
-- Table structure for table `tb_anggota`
--

CREATE TABLE `tb_anggota` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `tmp_lahir` varchar(20) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `jenkel` enum('Laki-Laki','Perempuan') NOT NULL,
  `alamat` text NOT NULL,
  `prestasi` text NOT NULL,
  `tinggi` int(11) NOT NULL,
  `berat` int(11) NOT NULL,
  `no_telp` varchar(13) NOT NULL,
  `email` varchar(50) NOT NULL,
  `posisi` enum('Server','Spiker / Smasher','Tosser / Set-Upper','Defender / Libero') NOT NULL,
  `motivasi` text NOT NULL,
  `password` varchar(255) NOT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `status` enum('Calon Anggota','Anggota') NOT NULL,
  `slug` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_anggota`
--

INSERT INTO `tb_anggota` (`id`, `nama`, `tmp_lahir`, `tgl_lahir`, `jenkel`, `alamat`, `prestasi`, `tinggi`, `berat`, `no_telp`, `email`, `posisi`, `motivasi`, `password`, `gambar`, `status`, `slug`) VALUES
(1, 'Putra', 'Pontianak', '1998-08-21', 'Laki-Laki', 'alamat', 'prestasi', 170, 65, '081234567890', 'email@email.com', 'Server', 'motivasi', '$2y$10$7VXeLyRJ1O.Vh0m0fxJ0/.EBL0Q3olevSiSHtb5RWyPkf/mdwB8oK', '397978f572f9fde5b925fdfdb0a7c003.jpg', 'Anggota', 'putra'),
(2, 'Putri', 'Pontianak', '1998-08-21', 'Perempuan', 'alamat', 'prestasi', 170, 65, '081234567890', 'email1@email1.com', 'Spiker / Smasher', 'motivasi', '$2y$10$7VXeLyRJ1O.Vh0m0fxJ0/.EBL0Q3olevSiSHtb5RWyPkf/mdwB8oK', NULL, 'Calon Anggota', 'putri'),
(8, 'dika', '1', '2020-07-12', 'Laki-Laki', '1', '1', 1, 1, '1', '1@1.com', 'Tosser / Set-Upper', '1', '$2y$10$7VXeLyRJ1O.Vh0m0fxJ0/.EBL0Q3olevSiSHtb5RWyPkf/mdwB8oK', NULL, 'Calon Anggota', 'dika'),
(9, 'wira', '2', '2020-02-14', 'Perempuan', '2', '2', 2, 2, '2', '2@2.com', 'Tosser / Set-Upper', '2', '$2y$10$b0.Be5tdWIR3lSvSB.3xi.ARNXgLU46YLRLXmmVjjF9TXcengSPpe', 'cb22255f0628cd2971220cf70fe5c1e7.png', 'Calon Anggota', 'wira'),
(10, 'Adetiya Burhasan Putra', '3', '2020-07-03', 'Perempuan', '3', '3', 3, 3, '3', '3@3.com', 'Defender / Libero', '3', '$2y$10$vpLR2R8gpQ7MzfIeuHza3u3UIoCieXb4vnaHa6q/cEryab1PlX.RO', 'b9bf6ab85a6c62b683ac689e33442433.jpg', 'Calon Anggota', 'adetiya-burhasan-putra'),
(11, 'Anggota 32', '32', '2020-07-03', 'Perempuan', '32', '32', 32, 32, '32', '32@32.com', 'Server', '32', '$2y$10$PQMycLFDqHryLGkHTWPlsehfSCSU36aSkQfmkHCzK0voCFmb7j456', 'fdce948d5b0fd9b67eac87c5b8e76bff.png', 'Calon Anggota', 'anggota-32');

-- --------------------------------------------------------

--
-- Table structure for table `tb_club`
--

CREATE TABLE `tb_club` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `sejarah` text NOT NULL,
  `arti_logo` text NOT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `slug` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_club`
--

INSERT INTO `tb_club` (`id`, `nama`, `sejarah`, `arti_logo`, `gambar`, `slug`) VALUES
(1, 'TB VAS', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n', '<p>Sed tamen tempor magna labore dolore dolor sint tempor duis magna elit veniam aliqua esse amet veniam enim export quid quid veniam aliqua eram noster malis nulla duis fugiat culpa esse aute nulla ipsum velit export irure minim illum fore</p>\r\n', '2d316cb8bb7938605f598fd648e8c777.jpg', 'nama-club');

-- --------------------------------------------------------

--
-- Table structure for table `tb_jadwal_latihan`
--

CREATE TABLE `tb_jadwal_latihan` (
  `id` int(11) NOT NULL,
  `id_pelatih` int(11) NOT NULL,
  `hari` varchar(10) NOT NULL,
  `jam_mulai` time NOT NULL,
  `jam_selesai` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_jadwal_latihan`
--

INSERT INTO `tb_jadwal_latihan` (`id`, `id_pelatih`, `hari`, `jam_mulai`, `jam_selesai`) VALUES
(1, 1, 'Senin', '16:00:00', '18:00:00'),
(3, 1, 'Selasa', '15:00:00', '18:00:00'),
(4, 3, 'Rabu', '14:00:00', '20:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tb_jadwal_tes`
--

CREATE TABLE `tb_jadwal_tes` (
  `id` int(11) NOT NULL,
  `id_pelatih` int(11) NOT NULL,
  `tgl` date NOT NULL,
  `jam_mulai` time NOT NULL,
  `jam_selesai` time NOT NULL,
  `status` enum('Belum Selesai','Selesai') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_jadwal_tes`
--

INSERT INTO `tb_jadwal_tes` (`id`, `id_pelatih`, `tgl`, `jam_mulai`, `jam_selesai`, `status`) VALUES
(1, 3, '2020-07-13', '16:00:00', '20:00:00', 'Belum Selesai'),
(2, 1, '2020-07-31', '15:00:00', '16:00:00', 'Selesai'),
(5, 1, '2020-07-03', '11:11:00', '11:11:00', 'Belum Selesai');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kontak`
--

CREATE TABLE `tb_kontak` (
  `id` int(11) NOT NULL,
  `alamat` text NOT NULL,
  `email` varchar(50) NOT NULL,
  `facebook` varchar(50) NOT NULL,
  `instagram` varchar(50) NOT NULL,
  `no_telp` varchar(13) NOT NULL,
  `tmp_latihan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_kontak`
--

INSERT INTO `tb_kontak` (`id`, `alamat`, `email`, `facebook`, `instagram`, `no_telp`, `tmp_latihan`) VALUES
(1, 'Jalan cikarang', 'email@email.com', 'facebook', 'instagram', '081234567890', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pelatih`
--

CREATE TABLE `tb_pelatih` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `melatih` enum('Pria','Wanita') NOT NULL,
  `pengalaman` text NOT NULL,
  `email` varchar(50) NOT NULL,
  `no_telp` varchar(13) NOT NULL,
  `alamat` text NOT NULL,
  `password` varchar(255) NOT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `slug` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_pelatih`
--

INSERT INTO `tb_pelatih` (`id`, `nama`, `melatih`, `pengalaman`, `email`, `no_telp`, `alamat`, `password`, `gambar`, `slug`) VALUES
(1, 'Adetiya', 'Pria', 'banyakw                        ', '0@0.com', '081234567890', 'Jalan Jalan                        ', '$2y$10$1bOGZjiBBIQ45i4/frM7UuzHiwuMjzTU4H6wHR6hs3xA7.BahQJ4a', 'cb7df40e2890c3474f993aaf56f9ce98.jpg', 'adetiya'),
(3, 'Burhasan', 'Pria', '2', '1@1.com', '1', '1', '$2y$10$jQ/aRvEPcAZSkNJCRFF4n.znwx1gLIECGkTA1IcqoC2tvAZa3Xvx2', 'e5e408b59d2bc3d5ac7e4211c2e42149.jpg', 'burhasan');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pengumuman`
--

CREATE TABLE `tb_pengumuman` (
  `id` int(11) NOT NULL,
  `id_jadwal_tes` int(11) NOT NULL,
  `id_anggota` int(11) NOT NULL,
  `keterangan` enum('Belum Lulus','Lulus') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_pengumuman`
--

INSERT INTO `tb_pengumuman` (`id`, `id_jadwal_tes`, `id_anggota`, `keterangan`) VALUES
(14, 5, 1, 'Lulus'),
(15, 5, 2, 'Lulus'),
(16, 1, 10, 'Belum Lulus'),
(17, 2, 10, 'Belum Lulus'),
(18, 5, 10, 'Belum Lulus'),
(19, 2, 9, 'Belum Lulus');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pengurus`
--

CREATE TABLE `tb_pengurus` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `posisi` varchar(50) NOT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `slug` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_pengurus`
--

INSERT INTO `tb_pengurus` (`id`, `nama`, `posisi`, `gambar`, `slug`) VALUES
(3, 'Adetiya', 'Direktur', '0d89d1bbf4b6925507a277ae99c9713e.png', '');

-- --------------------------------------------------------

--
-- Table structure for table `tb_prestasi`
--

CREATE TABLE `tb_prestasi` (
  `id` int(11) NOT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `tim` enum('Pria','Wanita') NOT NULL,
  `tgl` date NOT NULL,
  `hasil` varchar(100) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_prestasi`
--

INSERT INTO `tb_prestasi` (`id`, `gambar`, `tim`, `tgl`, `hasil`, `keterangan`) VALUES
(3, 'b5299ca483a08fabfff4688125fa5641.png', 'Wanita', '2020-07-24', 'Juara 1', 'lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem '),
(4, '842da091ab1de887d2d4b3ed48ac3883.png', 'Wanita', '2020-07-25', 'Juara 2', 'lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem ');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_anggota`
--
ALTER TABLE `tb_anggota`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_club`
--
ALTER TABLE `tb_club`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_jadwal_latihan`
--
ALTER TABLE `tb_jadwal_latihan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pelatih` (`id_pelatih`);

--
-- Indexes for table `tb_jadwal_tes`
--
ALTER TABLE `tb_jadwal_tes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pelatih` (`id_pelatih`);

--
-- Indexes for table `tb_kontak`
--
ALTER TABLE `tb_kontak`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_pelatih`
--
ALTER TABLE `tb_pelatih`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_pengumuman`
--
ALTER TABLE `tb_pengumuman`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_jadwal_tes` (`id_jadwal_tes`),
  ADD KEY `id_anggota` (`id_anggota`);

--
-- Indexes for table `tb_pengurus`
--
ALTER TABLE `tb_pengurus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_prestasi`
--
ALTER TABLE `tb_prestasi`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_admin`
--
ALTER TABLE `tb_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_anggota`
--
ALTER TABLE `tb_anggota`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tb_club`
--
ALTER TABLE `tb_club`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_jadwal_latihan`
--
ALTER TABLE `tb_jadwal_latihan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_jadwal_tes`
--
ALTER TABLE `tb_jadwal_tes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_kontak`
--
ALTER TABLE `tb_kontak`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_pelatih`
--
ALTER TABLE `tb_pelatih`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_pengumuman`
--
ALTER TABLE `tb_pengumuman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tb_pengurus`
--
ALTER TABLE `tb_pengurus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_prestasi`
--
ALTER TABLE `tb_prestasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_jadwal_latihan`
--
ALTER TABLE `tb_jadwal_latihan`
  ADD CONSTRAINT `tb_jadwal_latihan_ibfk_1` FOREIGN KEY (`id_pelatih`) REFERENCES `tb_pelatih` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tb_jadwal_tes`
--
ALTER TABLE `tb_jadwal_tes`
  ADD CONSTRAINT `tb_jadwal_tes_ibfk_1` FOREIGN KEY (`id_pelatih`) REFERENCES `tb_pelatih` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tb_pengumuman`
--
ALTER TABLE `tb_pengumuman`
  ADD CONSTRAINT `tb_pengumuman_ibfk_1` FOREIGN KEY (`id_anggota`) REFERENCES `tb_anggota` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tb_pengumuman_ibfk_2` FOREIGN KEY (`id_jadwal_tes`) REFERENCES `tb_jadwal_tes` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
