-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 16, 2020 at 12:02 PM
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
(10, 'Adetiya Burhasan Putra', '3', '2020-07-03', 'Perempuan', '3', '3', 3, 3, '3', '3@3.com', 'Defender / Libero', '3', '$2y$10$MZPQ38AtoZWf6D2jDGDTXeSuZfOvDzir5vzXV1Ykc2Wf2m/CU.bnu', 'b9bf6ab85a6c62b683ac689e33442433.jpg', 'Calon Anggota', 'adetiya-burhasan-putra'),
(11, 'Anggota 32', '32', '2020-07-03', 'Perempuan', '32', '32', 32, 32, '32', '32@32.com', 'Server', '32', '$2y$10$PQMycLFDqHryLGkHTWPlsehfSCSU36aSkQfmkHCzK0voCFmb7j456', 'fdce948d5b0fd9b67eac87c5b8e76bff.png', 'Calon Anggota', 'anggota-32'),
(12, '5', '5', '2020-07-15', 'Laki-Laki', '5', '5', 5, 5, '5', '5@5.com', 'Server', '5', '$2y$10$5rA1C5bEKHQftHkepkB8JOShhqz44ZBQPdjhs/dNOWPnX62/RSBqG', NULL, 'Calon Anggota', '5');

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
(1, 'TB VAS', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n', '<p>Sed tamen tempor magna labore dolore dolor sint tempor duis magna elit veniam aliqua esse amet veniam enim export quid quid veniam aliqua eram noster malis nulla duis fugiat culpa esse aute nulla ipsum velit export irure minim illum fore. hello adet\r\n</p>', '2d316cb8bb7938605f598fd648e8c777.jpg', 'nama-club');

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
(6, 3, '2020-07-25', '15:00:00', '17:00:00', 'Belum Selesai');

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
(3, 'Masrun', 'Pria', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'pelatih@pelatih.com', '08', 'Jalan', '$2y$10$KhCILWYtlRkOUDdP9c.UD.IRwhJYwhjXqSepTHHAEYHW/dE4QfV8O', 'gambar.jpg', 'andi-purnomo-spd'),
(4, 'Andi Purnomo, S.Pd', 'Pria', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'pelatih1@pelatih.com', '08', 'Jalan', '$2y$10$KhCILWYtlRkOUDdP9c.UD.IRwhJYwhjXqSepTHHAEYHW/dE4QfV8O', 'gambar1.jpg', 'andi-purnomo-spd'),
(5, 'Deny Firmansyah, S.Pd', 'Pria', ' Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 'pelatih2@pelatih.com', '08', 'Jalan', '$2y$10$jzQIK5d5NU275H5N6i0MCeZKUCFs20PA1QT0Unm/PLnUHHsLUEvUC', 'gambar2.jpg', 'deny-firmansyah-spd'),
(6, 'Sumantri, S.Pd', 'Wanita', ' Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 'pelatih3@pelatih.com', '08', 'Jalan', '$2y$10$Ug8CO9u89a2DYA5h0bcsWe6sK5oB4DjIb6Gz3gIJmvMI25wKk4cUK', 'gambar3.jpg', 'sumantri-spd');

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

-- --------------------------------------------------------

--
-- Table structure for table `tb_pengurus`
--

CREATE TABLE `tb_pengurus` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `posisi` enum('Pemilik Club','Penasehat','Ketua','Wakil Ketua','Pelatih Kepala','Bagian Umum','Sekretaris','Bendahara','Tim Pelatih') NOT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `slug` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_pengurus`
--

INSERT INTO `tb_pengurus` (`id`, `nama`, `posisi`, `gambar`, `slug`) VALUES
(3, 'Syahrul', 'Pemilik Club', '0d89d1bbf4b6925507a277ae99c9713e.png', ''),
(4, 'Ahlpiance', 'Penasehat', NULL, ''),
(5, 'Bagus Prastio, S.IP', 'Penasehat', NULL, ''),
(6, 'Alif Syaifudin. H, S.Pd, M.SI', 'Ketua', NULL, ''),
(7, 'Rustam', 'Wakil Ketua', NULL, ''),
(8, 'Faisal Sigit, S.Pd', 'Sekretaris', NULL, ''),
(9, 'Eko Sarjono, A.MA.Pd', 'Bendahara', NULL, ''),
(10, 'Sabandi', 'Bagian Umum', NULL, ''),
(11, 'Tonut', 'Bagian Umum', NULL, ''),
(12, 'Bahwan', 'Bagian Umum', NULL, ''),
(13, 'Sumardi', 'Bagian Umum', NULL, ''),
(14, 'Masrun', 'Pelatih Kepala', NULL, ''),
(15, 'Andi Purnomo, S.Pd', 'Tim Pelatih', NULL, ''),
(16, 'Deny Firmansyah, S.Pd', 'Tim Pelatih', NULL, ''),
(17, 'Sumantri, S.Pd', 'Tim Pelatih', NULL, '');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_kontak`
--
ALTER TABLE `tb_kontak`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_pelatih`
--
ALTER TABLE `tb_pelatih`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tb_pengumuman`
--
ALTER TABLE `tb_pengumuman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tb_pengurus`
--
ALTER TABLE `tb_pengurus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

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
