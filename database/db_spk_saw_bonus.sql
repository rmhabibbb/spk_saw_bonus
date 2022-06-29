-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 15, 2022 at 12:43 AM
-- Server version: 5.7.31
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_spk_saw_bonus`
--

-- --------------------------------------------------------

--
-- Table structure for table `absensi`
--

DROP TABLE IF EXISTS `absensi`;
CREATE TABLE IF NOT EXISTS `absensi` (
  `id_absensi` int(11) NOT NULL AUTO_INCREMENT,
  `bulan` int(2) NOT NULL,
  `tahun` int(4) NOT NULL,
  `tgl_buat` datetime(3) NOT NULL,
  PRIMARY KEY (`id_absensi`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `absensi`
--

INSERT INTO `absensi` (`id_absensi`, `bulan`, `tahun`, `tgl_buat`) VALUES
(1, 6, 2022, '2022-06-15 05:24:56.000'),
(2, 5, 2022, '2022-06-15 07:04:45.000');

-- --------------------------------------------------------

--
-- Table structure for table `bobot_kriteria`
--

DROP TABLE IF EXISTS `bobot_kriteria`;
CREATE TABLE IF NOT EXISTS `bobot_kriteria` (
  `id_bobot` int(11) NOT NULL AUTO_INCREMENT,
  `keterangan` text,
  `bobot` int(1) NOT NULL,
  `id_kriteria` int(11) NOT NULL,
  `min` double(11,2) DEFAULT NULL,
  `max` double(11,2) DEFAULT NULL,
  PRIMARY KEY (`id_bobot`),
  KEY `id_kriteria` (`id_kriteria`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bobot_kriteria`
--

INSERT INTO `bobot_kriteria` (`id_bobot`, `keterangan`, `bobot`, `id_kriteria`, `min`, `max`) VALUES
(21, NULL, 5, 1, 81.00, 100.00),
(22, NULL, 4, 1, 61.00, 80.00),
(23, NULL, 3, 1, 41.00, 60.00),
(24, NULL, 2, 1, 21.00, 40.00),
(28, NULL, 1, 3, 0.00, 20.00),
(29, NULL, 2, 3, 21.00, 40.00),
(30, NULL, 3, 3, 41.00, 60.00),
(31, NULL, 4, 3, 61.00, 80.00),
(35, NULL, 1, 2, 0.00, 20.00),
(36, NULL, 2, 2, 21.00, 40.00),
(37, NULL, 3, 2, 41.00, 60.00),
(38, NULL, 4, 2, 61.00, 80.00),
(39, NULL, 5, 2, 81.00, 100.00),
(40, NULL, 5, 3, 81.00, 100.00),
(41, NULL, 1, 1, 0.00, 20.00);

-- --------------------------------------------------------

--
-- Table structure for table `bonus`
--

DROP TABLE IF EXISTS `bonus`;
CREATE TABLE IF NOT EXISTS `bonus` (
  `kd_bonus` varchar(20) NOT NULL,
  `bulan` int(2) NOT NULL,
  `tahun` int(4) NOT NULL,
  `status` int(1) NOT NULL,
  `tgl_buat` datetime NOT NULL,
  PRIMARY KEY (`kd_bonus`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `detail_absensi`
--

DROP TABLE IF EXISTS `detail_absensi`;
CREATE TABLE IF NOT EXISTS `detail_absensi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_absensi` int(11) NOT NULL,
  `id_karyawan` int(11) NOT NULL,
  `izin` int(3) NOT NULL,
  `sakit` int(3) NOT NULL,
  `tanpa_ket` int(3) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_absensi` (`id_absensi`),
  KEY `id_karyawan` (`id_karyawan`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `detail_laporan`
--

DROP TABLE IF EXISTS `detail_laporan`;
CREATE TABLE IF NOT EXISTS `detail_laporan` (
  `id_detail` int(11) NOT NULL AUTO_INCREMENT,
  `id_laporan` int(11) NOT NULL,
  `kriteria` text NOT NULL,
  `presentase` decimal(13,2) NOT NULL,
  `nilai` decimal(11,2) NOT NULL,
  `keterangan` text,
  PRIMARY KEY (`id_detail`),
  KEY `id_laporan` (`id_laporan`)
) ENGINE=InnoDB AUTO_INCREMENT=991 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `indikator`
--

DROP TABLE IF EXISTS `indikator`;
CREATE TABLE IF NOT EXISTS `indikator` (
  `id_indikator` int(11) NOT NULL AUTO_INCREMENT,
  `id_jabatan` int(11) NOT NULL,
  `id_kriteria` int(11) NOT NULL,
  `nama_indikator` text NOT NULL,
  `nilai_indikator` double(13,2) NOT NULL,
  PRIMARY KEY (`id_indikator`),
  KEY `id_jabatan` (`id_jabatan`),
  KEY `id_kriteria` (`id_kriteria`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `indikator`
--

INSERT INTO `indikator` (`id_indikator`, `id_jabatan`, `id_kriteria`, `nama_indikator`, `nilai_indikator`) VALUES
(1, 1, 2, 'Membuat data keuangan', 10.00),
(2, 1, 2, 'Membuat data dan mendokumentasikan data karyawan', 10.00),
(3, 1, 2, 'Membuat rencana kerja perusahaan', 10.00),
(4, 1, 2, 'Mencatat kebutuhan karyawan', 10.00),
(5, 1, 2, 'mencatat dan mendokumentasikan data Ramsum', 10.00),
(6, 1, 2, 'Membuat BAP (Berita Acara Pembayaran)', 10.00),
(7, 1, 2, 'Membuat laporan data keuangan dan hasil kerja karyawan', 10.00),
(8, 2, 2, 'Mengawasi karyawan dilapangan', 10.00),
(9, 2, 2, 'Membeikan arahan kerja', 10.00),
(10, 2, 2, 'Memeriksa pekerjaan dilapangan', 10.00),
(11, 2, 2, 'Memberikan tugas sesuai dengan beban kerja', 10.00),
(12, 2, 2, 'Membuat laporan kerja lapangan', 10.00),
(13, 2, 3, 'Telah membuat laporan data lapangan 100% ', 10.00),
(14, 2, 3, 'Target terselesaikan sesuai dengan UVI yang telah ditentukan ', 10.00),
(15, 2, 3, 'Pekerjaan terselesaikan dengan baik', 10.00),
(16, 1, 3, 'Telah membuat laporan keuangan', 10.00),
(17, 1, 3, 'Telah membuat laporan kerja karyawan', 10.00),
(18, 1, 3, 'Tepat waktu dalam membuat BAP', 10.00);

-- --------------------------------------------------------

--
-- Table structure for table `jabatan`
--

DROP TABLE IF EXISTS `jabatan`;
CREATE TABLE IF NOT EXISTS `jabatan` (
  `id_jabatan` int(11) NOT NULL AUTO_INCREMENT,
  `nama_jabatan` varchar(40) NOT NULL,
  PRIMARY KEY (`id_jabatan`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jabatan`
--

INSERT INTO `jabatan` (`id_jabatan`, `nama_jabatan`) VALUES
(1, 'Karyawan  Kantor'),
(2, 'Karyawan Lapangan');

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

DROP TABLE IF EXISTS `karyawan`;
CREATE TABLE IF NOT EXISTS `karyawan` (
  `email` varchar(50) NOT NULL,
  `id_karyawan` int(11) NOT NULL AUTO_INCREMENT,
  `nama_karyawan` varchar(50) NOT NULL,
  `jk` varchar(20) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `no_hp` varchar(25) NOT NULL,
  `alamat` text NOT NULL,
  `id_jabatan` int(11) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_karyawan`),
  KEY `email` (`email`),
  KEY `id_jabatan` (`id_jabatan`),
  KEY `id_jabatan_2` (`id_jabatan`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`email`, `id_karyawan`, `nama_karyawan`, `jk`, `tanggal_lahir`, `no_hp`, `alamat`, `id_jabatan`, `status`) VALUES
('Agung@gmail.com', 1, 'Agung', 'Laki - Laki', '1974-01-01', '081216717920', 'Sumbawa NTB', 2, 1),
('DepanM@gmail.com', 2, 'Depan Mahendra', 'Laki - Laki', '1994-02-12', '082327552108', 'Tapus', 1, 1),
('Firmansyah@gmail.com', 3, 'Firmansyah', 'Laki - Laki', '1985-05-04', '082327552108', 'Tapus', 2, 1),
('Rohnaini@gmail.com', 4, 'Rohnaini', 'Perempuan', '1999-04-18', '082373635878', 'Tapus', 1, 1),
('Novaldo@gmail.com', 5, 'Novaldo', 'Laki - Laki', '1999-07-15', '082389034056', 'Tapus', 1, 1),
('DenisE@gmail.com', 6, 'Denis Erwin', 'Laki - Laki', '1995-10-15', '089687775893', 'Tapus', 2, 1),
('Marwa@gmail.com', 7, 'Marwa', 'Laki - Laki', '1979-01-27', '0895064526718', 'Serdang', 2, 1),
('Sartomi@gmail.com', 8, 'Sartomi', 'Laki - Laki', '1984-06-01', '081366961517', 'Sungai Setupak', 2, 1),
('AdesA@gmail.com', 9, 'Ades Astika', 'Perempuan', '2000-08-17', '082298054566', 'Tapus', 1, 1),
('AndraL@gmail.com', 10, 'Andra Lasmana', 'Laki - Laki', '2000-12-17', '081237451349', 'Ulak Depati', 1, 1),
('Paisal@gmail.com', 11, 'Paisal', 'Laki - Laki', '1998-06-06', '08975825124', 'Tapus', 1, 1),
('Sutra@gmail.com', 12, 'Sutra', 'Laki - Laki', '1983-12-10', '083167490851', 'Tapus', 2, 1),
('Ardianto@gmail.com', 13, 'Ardianto', 'Laki - Laki', '1993-12-11', '083869558909', 'Tapus', 1, 1),
('Burani@gmail.com', 14, 'Burani', 'Perempuan', '1980-12-30', '085308550216', 'Cengal', 1, 1),
('Nasrudin@gmail.com', 15, 'Nasrudin', 'Laki - Laki', '1979-01-07', '085302555309', 'Tanjung Kemang', 2, 1),
('Suryadi@gmail.com', 16, 'Suryadi', 'Laki - Laki', '1982-01-03', '082126733710', 'Tapus', 1, 1),
('DelpiS@gmail.com', 17, 'Delpi Selpia', 'Perempuan', '1999-02-02', '082377460274', 'Tapus', 1, 1),
('Rapita@gmail.com', 18, 'Rapita', 'Perempuan', '2001-08-04', '083171315842', 'Tapus', 1, 1),
('Edy@gmail.com', 19, 'Edy', 'Laki - Laki', '1973-06-21', '085928908290', 'Simpang Tiga', 2, 1),
('Tapid@gmail.com', 20, 'Tapid', 'Laki - Laki', '1993-01-12', '083190690002', 'Tapus', 2, 1),
('Joyo@gmail.com', 21, 'Joyo', 'Laki - Laki', '1989-05-10', '082280218821', 'Keman', 1, 1),
('M.Hadelil@gmail.com', 22, 'M.Hadelil', 'Laki - Laki', '1996-09-10', '082278459061', 'Tapus', 2, 1),
('TarmiziT@gmail.com', 23, 'Tarmizi Taher', 'Laki - Laki', '1995-01-09', '082129266142', 'Tapus', 2, 1),
('Kartiwan@gmail.com', 24, 'Kartiwan', 'Laki - Laki', '1976-04-01', '089603756925', 'Pampangan', 1, 1),
('Subanrio@gmail.com', 25, 'Subanrio', 'Laki - Laki', '1998-06-30', '083169418670', 'Pulau Layang', 1, 1),
('Masita@gmail.com', 26, 'Masita', 'Perempuan', '1985-05-04', '085669545336', 'Tapus', 1, 1),
('Rais@gmail.com', 27, 'Rais', 'Laki - Laki', '1964-02-02', '083169238044', 'Dusun II Kuro', 2, 1),
('Sanaah@gmail.com', 28, 'Sana\'ah', 'Perempuan', '1980-07-01', '082269626100', 'Dusun II Kuro', 1, 1),
('Tarsina@gmail.com', 29, 'Tarsina', 'Perempuan', '1977-11-21', '083836214156', 'Dusun II Kuro', 1, 1),
('Sukari@gmail.com', 30, 'Sukari', 'Laki - Laki', '1965-09-03', '085697003351', 'Dusun II Kuro', 1, 1),
('Nurhayati@gmail.com', 31, 'Nurhayati', 'Perempuan', '1965-11-29', '089668053494', 'Bengkulu', 1, 1),
('Joko@gmail.com', 32, 'Joko', 'Laki - Laki', '1975-01-01', '0821811965957', 'Dusun II Kuro', 2, 1),
('Bebet@gmail.com', 33, 'Bebet', 'Laki - Laki', '1991-11-11', '081367223209', 'Dusun II Kuro', 2, 1),
('Bay@gmail.com', 34, 'Bay', 'Laki - Laki', '1990-07-07', '081368891494', 'Dusun II Kuro', 2, 1),
('Yanto@gmail.com', 35, 'Yanto', 'Laki - Laki', '1997-12-28', '089624688124', 'Lampung', 2, 1),
('Samun@gmail.com', 36, 'Sam\'un', 'Laki - Laki', '1999-09-16', '083802411437', 'Pedamaran', 2, 1),
('Mersup@gmail.com', 37, 'Mersup', 'Laki - Laki', '1999-05-08', '082269998079', 'Banyuasin', 1, 1),
('Amsa@gmail.com', 38, 'Amsa', 'Laki - Laki', '1999-10-10', '085279945681', 'Pampangan', 1, 1),
('Tarisa@gmail.com', 39, 'Tarisa', 'Perempuan', '2000-03-24', '083184881204', 'Pedamaran', 1, 1),
('Kurnia@gmail.com', 40, 'Kurnia', 'Perempuan', '2000-09-28', '085368001389', 'Pampangan', 1, 1),
('Harjok@gmail.com', 41, 'Harjok', 'Laki - Laki', '1998-11-21', '083179026704', 'Tapus', 2, 1),
('Diron@gmail.com', 42, 'Diron', 'Laki - Laki', '1996-06-01', '085788611589', 'Dusun II Kuro', 2, 1),
('Sungep@gmail.com', 43, 'Sungep', 'Laki - Laki', '1997-08-28', '081367711719', 'Tapus', 1, 1),
('Darmat@gmail.com', 44, 'Darmat', 'Laki - Laki', '1970-03-12', '085273239360', 'Dusun II Kuro', 2, 1),
('Mulyati@gmail.com', 45, 'Mulyati', 'Perempuan', '1995-06-16', '081315090531', 'Sungai Lilin', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `kriteria`
--

DROP TABLE IF EXISTS `kriteria`;
CREATE TABLE IF NOT EXISTS `kriteria` (
  `id_kriteria` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kriteria` varchar(100) NOT NULL,
  `tipe` varchar(40) NOT NULL,
  `bobot_vektor` decimal(5,2) NOT NULL,
  `hasIndikator` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_kriteria`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kriteria`
--

INSERT INTO `kriteria` (`id_kriteria`, `nama_kriteria`, `tipe`, `bobot_vektor`, `hasIndikator`) VALUES
(1, 'Absensi', 'Cost', '40.00', 1),
(2, 'Tanggung Jawab', 'Benefit', '30.00', 1),
(3, 'Hasil Kerja', 'Benefit', '30.00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `laporan`
--

DROP TABLE IF EXISTS `laporan`;
CREATE TABLE IF NOT EXISTS `laporan` (
  `id_laporan` int(11) NOT NULL AUTO_INCREMENT,
  `id_karyawan` int(11) NOT NULL,
  `kd_bonus` varchar(20) NOT NULL,
  `nilai_akhir` decimal(13,2) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  `keterangan` text,
  PRIMARY KEY (`id_laporan`),
  KEY `kd_rekrutmen` (`kd_bonus`),
  KEY `id_calonguru` (`id_karyawan`)
) ENGINE=InnoDB AUTO_INCREMENT=316 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

DROP TABLE IF EXISTS `pengguna`;
CREATE TABLE IF NOT EXISTS `pengguna` (
  `id_pengguna` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `role` int(1) NOT NULL,
  PRIMARY KEY (`id_pengguna`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`id_pengguna`, `email`, `password`, `role`) VALUES
(0, 'adminsistem.spk@gmail.com', '25d55ad283aa400af464c76d713c07ad', 0),
(1, 'administrasi.spk@gmail.com', '25d55ad283aa400af464c76d713c07ad', 1),
(2, 'pimpinan.spk@gmail.com', '25d55ad283aa400af464c76d713c07ad', 2),
(3, 'Agung@gmail.com', '7815696ecbf1c96e6894b779456d330e', 3),
(4, 'DepanM@gmail.com', '25d55ad283aa400af464c76d713c07ad', 3),
(5, 'Firmansyah@gmail.com', '25d55ad283aa400af464c76d713c07ad', 3),
(6, 'Rohnaini@gmail.com', '25d55ad283aa400af464c76d713c07ad', 3),
(7, 'Novaldo@gmail.com', '25d55ad283aa400af464c76d713c07ad', 3),
(8, 'DenisE@gmail.com', '25d55ad283aa400af464c76d713c07ad', 3),
(9, 'Marwa@gmail.com', '25d55ad283aa400af464c76d713c07ad', 3),
(10, 'Sartomi@gmail.com', '25d55ad283aa400af464c76d713c07ad', 3),
(11, 'AdesA@gmail.com', '25d55ad283aa400af464c76d713c07ad', 3),
(12, 'AndraL@gmail.com', '25d55ad283aa400af464c76d713c07ad', 3),
(13, 'Paisal@gmail.com', '25d55ad283aa400af464c76d713c07ad', 3),
(14, 'Sutra@gmail.com', '25d55ad283aa400af464c76d713c07ad', 3),
(15, 'Ardianto@gmail.com', '25d55ad283aa400af464c76d713c07ad', 3),
(16, 'Burani@gmail.com', '25d55ad283aa400af464c76d713c07ad', 3),
(17, 'Nasrudin@gmail.com', '25d55ad283aa400af464c76d713c07ad', 3),
(18, 'Suryadi@gmail.com', '25d55ad283aa400af464c76d713c07ad', 3),
(19, 'DelpiS@gmail.com', '25d55ad283aa400af464c76d713c07ad', 3),
(20, 'Rapita@gmail.com', '25d55ad283aa400af464c76d713c07ad', 3),
(21, 'Edy@gmail.com', '25d55ad283aa400af464c76d713c07ad', 3),
(22, 'Tapid@gmail.com', '25d55ad283aa400af464c76d713c07ad', 3),
(23, 'Joyo@gmail.com', '25d55ad283aa400af464c76d713c07ad', 3),
(24, 'M.Hadelil@gmail.com', '25d55ad283aa400af464c76d713c07ad', 3),
(25, 'TarmiziT@gmail.com', '25d55ad283aa400af464c76d713c07ad', 3),
(26, 'Kartiwan@gmail.com', '25d55ad283aa400af464c76d713c07ad', 3),
(27, 'Subanrio@gmail.com', '25d55ad283aa400af464c76d713c07ad', 3),
(28, 'Masita@gmail.com', '25d55ad283aa400af464c76d713c07ad', 3),
(29, 'Rais@gmail.com', '25d55ad283aa400af464c76d713c07ad', 3),
(30, 'Sanaah@gmail.com', '25d55ad283aa400af464c76d713c07ad', 3),
(31, 'Tarsina@gmail.com', '25d55ad283aa400af464c76d713c07ad', 3),
(32, 'Sukari@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 3),
(33, 'Nurhayati@gmail.com', '25d55ad283aa400af464c76d713c07ad', 3),
(34, 'Joko@gmail.com', '25d55ad283aa400af464c76d713c07ad', 3),
(35, 'Bebet@gmail.com', '25d55ad283aa400af464c76d713c07ad', 3),
(36, 'Bay@gmail.com', '25d55ad283aa400af464c76d713c07ad', 3),
(37, 'Yanto@gmail.com', '25d55ad283aa400af464c76d713c07ad', 3),
(38, 'Samun@gmail.com', '25d55ad283aa400af464c76d713c07ad', 3),
(39, 'Mersup@gmail.com', '25f9e794323b453885f5181f1b624d0b', 3),
(40, 'Amsa@gmail.com', '25d55ad283aa400af464c76d713c07ad', 3),
(41, 'Tarisa@gmail.com', '25d55ad283aa400af464c76d713c07ad', 3),
(42, 'Kurnia@gmail.com', '25d55ad283aa400af464c76d713c07ad', 3),
(43, 'Harjok@gmail.com', '25d55ad283aa400af464c76d713c07ad', 3),
(44, 'Diron@gmail.com', '25d55ad283aa400af464c76d713c07ad', 3),
(45, 'Sungep@gmail.com', '25d55ad283aa400af464c76d713c07ad', 3),
(46, 'Darmat@gmail.com', '25d55ad283aa400af464c76d713c07ad', 3),
(47, 'Mulyati@gmail.com', 'fcea920f7412b5da7be0cf42b8c93759', 3);

-- --------------------------------------------------------

--
-- Table structure for table `penilaian`
--

DROP TABLE IF EXISTS `penilaian`;
CREATE TABLE IF NOT EXISTS `penilaian` (
  `id_penilaian` int(11) NOT NULL AUTO_INCREMENT,
  `id_karyawan` int(11) NOT NULL,
  `kd_bonus` varchar(20) NOT NULL,
  `id_kriteria` int(11) NOT NULL,
  `id_bobot` int(11) NOT NULL,
  `keterangan` text,
  PRIMARY KEY (`id_penilaian`),
  KEY `kd_rekrutmen` (`kd_bonus`),
  KEY `id_calonguru` (`id_karyawan`),
  KEY `id_kriteria` (`id_kriteria`),
  KEY `id_bobot` (`id_bobot`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `penilaian_karyawan`
--

DROP TABLE IF EXISTS `penilaian_karyawan`;
CREATE TABLE IF NOT EXISTS `penilaian_karyawan` (
  `id_penilaian` int(11) NOT NULL AUTO_INCREMENT,
  `id_karyawan` int(11) NOT NULL,
  `kd_bonus` varchar(20) NOT NULL,
  `id_indikator` int(11) NOT NULL,
  `nilai` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id_penilaian`),
  KEY `id_karyawan` (`id_karyawan`),
  KEY `id_indikator` (`id_indikator`),
  KEY `kd_bonus` (`kd_bonus`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bobot_kriteria`
--
ALTER TABLE `bobot_kriteria`
  ADD CONSTRAINT `bobot_kriteria_ibfk_1` FOREIGN KEY (`id_kriteria`) REFERENCES `kriteria` (`id_kriteria`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `detail_absensi`
--
ALTER TABLE `detail_absensi`
  ADD CONSTRAINT `detail_absensi_ibfk_1` FOREIGN KEY (`id_karyawan`) REFERENCES `karyawan` (`id_karyawan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detail_absensi_ibfk_2` FOREIGN KEY (`id_absensi`) REFERENCES `absensi` (`id_absensi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `detail_laporan`
--
ALTER TABLE `detail_laporan`
  ADD CONSTRAINT `detail_laporan_ibfk_1` FOREIGN KEY (`id_laporan`) REFERENCES `laporan` (`id_laporan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `indikator`
--
ALTER TABLE `indikator`
  ADD CONSTRAINT `indikator_ibfk_1` FOREIGN KEY (`id_kriteria`) REFERENCES `kriteria` (`id_kriteria`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD CONSTRAINT `karyawan_ibfk_1` FOREIGN KEY (`email`) REFERENCES `pengguna` (`email`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `karyawan_ibfk_2` FOREIGN KEY (`id_jabatan`) REFERENCES `jabatan` (`id_jabatan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `laporan`
--
ALTER TABLE `laporan`
  ADD CONSTRAINT `laporan_ibfk_1` FOREIGN KEY (`kd_bonus`) REFERENCES `bonus` (`kd_bonus`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `laporan_ibfk_2` FOREIGN KEY (`id_karyawan`) REFERENCES `karyawan` (`id_karyawan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `penilaian`
--
ALTER TABLE `penilaian`
  ADD CONSTRAINT `penilaian_ibfk_1` FOREIGN KEY (`id_karyawan`) REFERENCES `karyawan` (`id_karyawan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `penilaian_ibfk_2` FOREIGN KEY (`kd_bonus`) REFERENCES `bonus` (`kd_bonus`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `penilaian_ibfk_3` FOREIGN KEY (`id_kriteria`) REFERENCES `kriteria` (`id_kriteria`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `penilaian_ibfk_4` FOREIGN KEY (`id_bobot`) REFERENCES `bobot_kriteria` (`id_bobot`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `penilaian_karyawan`
--
ALTER TABLE `penilaian_karyawan`
  ADD CONSTRAINT `penilaian_karyawan_ibfk_1` FOREIGN KEY (`id_indikator`) REFERENCES `indikator` (`id_indikator`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `penilaian_karyawan_ibfk_2` FOREIGN KEY (`id_karyawan`) REFERENCES `karyawan` (`id_karyawan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `penilaian_karyawan_ibfk_3` FOREIGN KEY (`kd_bonus`) REFERENCES `bonus` (`kd_bonus`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
