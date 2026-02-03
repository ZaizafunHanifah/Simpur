-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 14, 2025 at 08:19 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_simpeldesa`
--

-- --------------------------------------------------------

--
-- Table structure for table `dusun`
--

CREATE TABLE `dusun` (
  `id_dusun` int(11) NOT NULL,
  `nama_dusun` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dusun`
--

INSERT INTO `dusun` (`id_dusun`, `nama_dusun`) VALUES
(1, 'Dusun Cengis'),
(2, 'Dusun Mrica'),
(3, 'Dusun Barong');

-- --------------------------------------------------------

--
-- Table structure for table `jenis_surat`
--

CREATE TABLE `jenis_surat` (
  `id_jenis_surat` int(11) NOT NULL,
  `nama_surat` varchar(150) NOT NULL,
  `deskripsi_surat` text DEFAULT NULL,
  `syarat_wajib` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jenis_surat`
--

INSERT INTO `jenis_surat` (`id_jenis_surat`, `nama_surat`, `deskripsi_surat`, `syarat_wajib`) VALUES
(1, 'Surat Keterangan Domisili', NULL, NULL),
(2, 'Surat Keterangan Usaha', NULL, NULL),
(3, 'Surat Pengantar SKCK', NULL, NULL),
(4, 'Surat Keterangan Tidak Mampu', NULL, NULL),
(5, 'Surat Keterangan Kehilangan', NULL, NULL),
(6, 'Surat Keterangan Kelahiran', NULL, NULL),
(7, 'Surat Keterangan Kematian', NULL, NULL),
(8, 'Surat Izin Keramaian', NULL, NULL),
(9, '', 'Surat yang menerangkan alamat domisili warga', 'Fotokopi KTP, KK'),
(10, '', 'Surat untuk keperluan usaha warga', 'Fotokopi KTP, KK, NPWP usaha jika ada'),
(11, '', 'Surat pengantar untuk pembuatan SKCK', 'Fotokopi KTP, KK'),
(12, '', 'Surat yang menerangkan status ekonomi warga', 'Fotokopi KTP, KK, surat pernyataan ekonomi'),
(13, '', 'Surat untuk melaporkan kehilangan barang', 'Fotokopi KTP, laporan polisi'),
(14, '', 'Surat yang menerangkan kelahiran anak', 'Fotokopi KTP orang tua, akta kelahiran jika ada'),
(15, '', 'Surat yang menerangkan kematian warga', 'Fotokopi KTP almarhum, KK'),
(16, '', 'Surat izin penyelenggaraan acara/keramaian', 'Fotokopi KTP, proposal acara');

-- --------------------------------------------------------

--
-- Table structure for table `log_pelayanan`
--

CREATE TABLE `log_pelayanan` (
  `id_log` int(11) NOT NULL,
  `id_pelayanan` int(11) NOT NULL,
  `aksi` varchar(200) NOT NULL,
  `waktu` timestamp NOT NULL DEFAULT current_timestamp(),
  `petugas` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pelayanan_surat`
--

CREATE TABLE `pelayanan_surat` (
  `id_pelayanan` int(11) NOT NULL,
  `nomor_permohonan` varchar(50) DEFAULT NULL,
  `nik` char(16) NOT NULL,
  `id_jenis_surat` int(11) NOT NULL,
  `keperluan` varchar(255) NOT NULL,
  `tanggal_permohonan` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `catatan` text DEFAULT NULL,
  `status` enum('Diajukan','Diproses','Selesai','Ditolak') DEFAULT 'Diajukan',
  `tanggal_selesai` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pelayanan_surat`
--

INSERT INTO `pelayanan_surat` (`id_pelayanan`, `nomor_permohonan`, `nik`, `id_jenis_surat`, `keperluan`, `tanggal_permohonan`, `catatan`, `status`, `tanggal_selesai`) VALUES
(2, NULL, '1111111111111111', 3, 'pekerjaan', '2025-12-11 17:00:00', NULL, 'Diajukan', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `penduduk`
--

CREATE TABLE `penduduk` (
  `nik` char(16) NOT NULL,
  `nama_lengkap` varchar(150) NOT NULL,
  `tempat_lahir` varchar(100) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `agama` varchar(50) DEFAULT NULL,
  `pendidikan` varchar(50) DEFAULT NULL,
  `pekerjaan` varchar(100) DEFAULT NULL,
  `id_rtrw` int(11) NOT NULL,
  `nomor_kk` char(16) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `penduduk`
--

INSERT INTO `penduduk` (`nik`, `nama_lengkap`, `tempat_lahir`, `tanggal_lahir`, `jenis_kelamin`, `agama`, `pendidikan`, `pekerjaan`, `id_rtrw`, `nomor_kk`) VALUES
('1111111111111111', 'andi', 'pemalang', '2000-12-06', 'L', 'sa', 'sd', 'ss', 1, '1111111111111111'),
('1234567891234567', 'coba', 'sss', '2025-12-10', 'L', 'islam', 'S1', 'buruh', 1, '1234567891234567');

-- --------------------------------------------------------

--
-- Table structure for table `rt_rw`
--

CREATE TABLE `rt_rw` (
  `id_rtrw` int(11) NOT NULL,
  `rt` varchar(5) NOT NULL,
  `rw` varchar(5) NOT NULL,
  `id_dusun` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rt_rw`
--

INSERT INTO `rt_rw` (`id_rtrw`, `rt`, `rw`, `id_dusun`) VALUES
(1, '01', '01', 1),
(2, '02', '01', 1),
(3, '03', '01', 1),
(4, '04', '01', 1),
(5, '05', '01', 1),
(6, '06', '01', 1),
(7, '07', '01', 1),
(8, '08', '01', 1),
(9, '09', '01', 1),
(10, '10', '01', 1),
(11, '11', '01', 1),
(12, '12', '01', 1),
(13, '13', '01', 1),
(14, '01', '02', 2),
(15, '02', '02', 2),
(16, '03', '02', 2),
(17, '04', '02', 2),
(18, '05', '02', 2),
(19, '06', '02', 2),
(20, '07', '02', 2),
(21, '08', '02', 2),
(22, '09', '02', 2),
(23, '10', '02', 2),
(24, '11', '02', 2),
(25, '01', '03', 3),
(26, '02', '03', 3),
(27, '03', '03', 3),
(28, '04', '03', 3),
(29, '05', '03', 3),
(30, '06', '03', 3),
(31, '07', '03', 3),
(32, '08', '03', 3),
(33, '09', '03', 3),
(34, '10', '03', 3);

-- --------------------------------------------------------

--
-- Table structure for table `sotk`
--

CREATE TABLE `sotk` (
  `id_pejabat` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jabatan` varchar(100) NOT NULL,
  `nip` varchar(30) DEFAULT NULL,
  `alamat` varchar(150) DEFAULT NULL,
  `no_hp` varchar(20) DEFAULT NULL,
  `tanggal_mulai` date DEFAULT NULL,
  `tanggal_selesai` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sotk`
--

INSERT INTO `sotk` (`id_pejabat`, `nama`, `jabatan`, `nip`, `alamat`, `no_hp`, `tanggal_mulai`, `tanggal_selesai`) VALUES
(1, 'PONIMAN', 'Kepala Desa', NULL, NULL, NULL, NULL, NULL),
(2, 'PUJI', 'Sekretaris Desa', NULL, NULL, NULL, NULL, NULL),
(3, 'DAROSI', 'Kasi Pelayanan', NULL, NULL, NULL, NULL, NULL),
(4, 'ABDUL ROHMAN', 'Kasi Pemerintahan', NULL, NULL, NULL, NULL, NULL),
(5, 'NURDIANTO', 'Kasi Kesejahteraan', NULL, NULL, NULL, NULL, NULL),
(6, 'KENI DAMAYANTI', 'Kaur Perencanaan', NULL, NULL, NULL, NULL, NULL),
(7, 'LILI SUHARSIH', 'Kaur TU dan Umum', NULL, NULL, NULL, NULL, NULL),
(8, 'TARJONO', 'Kaur Keuangan', NULL, NULL, NULL, NULL, NULL),
(9, 'ARIF MAULANA', 'Kepala Dusun Barong', NULL, NULL, NULL, NULL, NULL),
(10, 'LILI SUHARSIH', 'Kepala Dusun Mrica', NULL, NULL, NULL, NULL, NULL),
(11, 'KENI DAMAYANTI', 'Kepala Dusun Cengis', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `Username` varchar(30) NOT NULL,
  `Password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`Username`, `Password`) VALUES
('admin', '123456');

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_log_pelayanan`
-- (See below for the actual view)
--
CREATE TABLE `view_log_pelayanan` (
`id_log` int(11)
,`id_pelayanan` int(11)
,`nik` char(16)
,`nama_lengkap` varchar(150)
,`nama_surat` varchar(150)
,`aksi` varchar(200)
,`waktu` timestamp
,`petugas` varchar(100)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_pelayanan`
-- (See below for the actual view)
--
CREATE TABLE `view_pelayanan` (
`id_pelayanan` int(11)
,`nik` char(16)
,`nama_lengkap` varchar(150)
,`jenis_surat` varchar(150)
,`status` enum('Diajukan','Diproses','Selesai','Ditolak')
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_penduduk_lengkap`
-- (See below for the actual view)
--
CREATE TABLE `view_penduduk_lengkap` (
`nik` char(16)
,`nama_lengkap` varchar(150)
,`tempat_lahir` varchar(100)
,`tanggal_lahir` date
,`jenis_kelamin` enum('L','P')
,`agama` varchar(50)
,`pendidikan` varchar(50)
,`pekerjaan` varchar(100)
,`nomor_kk` char(16)
,`id_rtrw` int(11)
,`rt` varchar(5)
,`rw` varchar(5)
,`nama_dusun` varchar(100)
);

-- --------------------------------------------------------

--
-- Structure for view `view_log_pelayanan`
--
DROP TABLE IF EXISTS `view_log_pelayanan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_log_pelayanan`  AS SELECT `l`.`id_log` AS `id_log`, `l`.`id_pelayanan` AS `id_pelayanan`, `p`.`nik` AS `nik`, `p`.`nama_lengkap` AS `nama_lengkap`, `js`.`nama_surat` AS `nama_surat`, `l`.`aksi` AS `aksi`, `l`.`waktu` AS `waktu`, `l`.`petugas` AS `petugas` FROM (((`log_pelayanan` `l` join `pelayanan_surat` `ps` on(`l`.`id_pelayanan` = `ps`.`id_pelayanan`)) join `penduduk` `p` on(`ps`.`nik` = `p`.`nik`)) join `jenis_surat` `js` on(`js`.`id_jenis_surat` = `ps`.`id_jenis_surat`)) ORDER BY `l`.`waktu` DESC ;

-- --------------------------------------------------------

--
-- Structure for view `view_pelayanan`
--
DROP TABLE IF EXISTS `view_pelayanan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_pelayanan`  AS SELECT `p`.`id_pelayanan` AS `id_pelayanan`, `p`.`nik` AS `nik`, `pd`.`nama_lengkap` AS `nama_lengkap`, `js`.`nama_surat` AS `jenis_surat`, `p`.`status` AS `status` FROM ((`pelayanan_surat` `p` join `penduduk` `pd` on(`p`.`nik` = `pd`.`nik`)) join `jenis_surat` `js` on(`p`.`id_jenis_surat` = `js`.`id_jenis_surat`)) ;

-- --------------------------------------------------------

--
-- Structure for view `view_penduduk_lengkap`
--
DROP TABLE IF EXISTS `view_penduduk_lengkap`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_penduduk_lengkap`  AS SELECT `p`.`nik` AS `nik`, `p`.`nama_lengkap` AS `nama_lengkap`, `p`.`tempat_lahir` AS `tempat_lahir`, `p`.`tanggal_lahir` AS `tanggal_lahir`, `p`.`jenis_kelamin` AS `jenis_kelamin`, `p`.`agama` AS `agama`, `p`.`pendidikan` AS `pendidikan`, `p`.`pekerjaan` AS `pekerjaan`, `p`.`nomor_kk` AS `nomor_kk`, `r`.`id_rtrw` AS `id_rtrw`, `r`.`rt` AS `rt`, `r`.`rw` AS `rw`, `d`.`nama_dusun` AS `nama_dusun` FROM ((`penduduk` `p` join `rt_rw` `r` on(`p`.`id_rtrw` = `r`.`id_rtrw`)) join `dusun` `d` on(`r`.`id_dusun` = `d`.`id_dusun`)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dusun`
--
ALTER TABLE `dusun`
  ADD PRIMARY KEY (`id_dusun`);

--
-- Indexes for table `jenis_surat`
--
ALTER TABLE `jenis_surat`
  ADD PRIMARY KEY (`id_jenis_surat`);

--
-- Indexes for table `log_pelayanan`
--
ALTER TABLE `log_pelayanan`
  ADD PRIMARY KEY (`id_log`),
  ADD KEY `id_pelayanan` (`id_pelayanan`);

--
-- Indexes for table `pelayanan_surat`
--
ALTER TABLE `pelayanan_surat`
  ADD PRIMARY KEY (`id_pelayanan`),
  ADD UNIQUE KEY `nomor_permohonan` (`nomor_permohonan`),
  ADD KEY `nik` (`nik`),
  ADD KEY `id_jenis_surat` (`id_jenis_surat`);

--
-- Indexes for table `penduduk`
--
ALTER TABLE `penduduk`
  ADD PRIMARY KEY (`nik`),
  ADD KEY `id_rtrw` (`id_rtrw`);

--
-- Indexes for table `rt_rw`
--
ALTER TABLE `rt_rw`
  ADD PRIMARY KEY (`id_rtrw`),
  ADD KEY `id_dusun` (`id_dusun`);

--
-- Indexes for table `sotk`
--
ALTER TABLE `sotk`
  ADD PRIMARY KEY (`id_pejabat`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`Username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dusun`
--
ALTER TABLE `dusun`
  MODIFY `id_dusun` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `jenis_surat`
--
ALTER TABLE `jenis_surat`
  MODIFY `id_jenis_surat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `log_pelayanan`
--
ALTER TABLE `log_pelayanan`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pelayanan_surat`
--
ALTER TABLE `pelayanan_surat`
  MODIFY `id_pelayanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `rt_rw`
--
ALTER TABLE `rt_rw`
  MODIFY `id_rtrw` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `sotk`
--
ALTER TABLE `sotk`
  MODIFY `id_pejabat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `log_pelayanan`
--
ALTER TABLE `log_pelayanan`
  ADD CONSTRAINT `log_pelayanan_ibfk_1` FOREIGN KEY (`id_pelayanan`) REFERENCES `pelayanan_surat` (`id_pelayanan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pelayanan_surat`
--
ALTER TABLE `pelayanan_surat`
  ADD CONSTRAINT `pelayanan_surat_ibfk_1` FOREIGN KEY (`nik`) REFERENCES `penduduk` (`nik`) ON UPDATE CASCADE,
  ADD CONSTRAINT `pelayanan_surat_ibfk_2` FOREIGN KEY (`id_jenis_surat`) REFERENCES `jenis_surat` (`id_jenis_surat`) ON UPDATE CASCADE;

--
-- Constraints for table `penduduk`
--
ALTER TABLE `penduduk`
  ADD CONSTRAINT `penduduk_ibfk_1` FOREIGN KEY (`id_rtrw`) REFERENCES `rt_rw` (`id_rtrw`) ON UPDATE CASCADE;

--
-- Constraints for table `rt_rw`
--
ALTER TABLE `rt_rw`
  ADD CONSTRAINT `rt_rw_ibfk_1` FOREIGN KEY (`id_dusun`) REFERENCES `dusun` (`id_dusun`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
