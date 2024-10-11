-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 02, 2024 at 06:40 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cobit5`
--

-- --------------------------------------------------------

--
-- Table structure for table `perspektif`
--

CREATE TABLE `perspektif` (
  `id_perspektif` int(11) NOT NULL,
  `kode_perspektif` varchar(10) NOT NULL,
  `nama_perspektif` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `perspektif`
--

INSERT INTO `perspektif` (`id_perspektif`, `kode_perspektif`, `nama_perspektif`) VALUES
(1, 'EDM03', 'Ensure Risk Optimization'),
(2, 'APO13', 'Manage Security'),
(3, 'DSS05', 'Manage Security Services');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id_question` int(11) NOT NULL,
  `perspektif_id` int(11) NOT NULL,
  `level` varchar(15) NOT NULL,
  `praktik_dasar` varchar(255) DEFAULT NULL,
  `praktik_umum` varchar(255) NOT NULL,
  `exist` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id_question`, `perspektif_id`, `level`, `praktik_dasar`, `praktik_umum`, `exist`) VALUES
(1, 1, '1', 'EDM03.01 Mengevaluasi manajemen risiko keamanan TI', 'Panduan selera risiko keamanan TI', 0),
(2, 1, '1', 'EDM03.01 Mengevaluasi manajemen risiko keamanan TI', 'Tingkat toleransi risiko keamanan TI yang disetujui ', 0),
(3, 1, '1', 'EDM03.01 Mengevaluasi manajemen risiko keamanan TI', 'Evaluasi kegiatan manajemen risiko keamanan TI ', 0),
(4, 1, '1', 'EDM03.02 Manajemen risiko langsung keamanan TI', 'Kebijakan manajemen risiko keamanan TI ', 0),
(5, 1, '1', 'EDM03.02 Manajemen risiko langsung keamanan TI', 'Tujuan utama yang harus dipantau untuk manajemen risiko keamanan T', 0),
(6, 1, '1', 'EDM03.02 Manajemen risiko langsung keamanan TI', 'Menyetujui proses untuk mengukur manajemen risiko keamanan TI', 0),
(7, 1, '1', 'EDM03.03 Memantau manajemen risiko keamanan TI', 'Tindakan perbaikan untuk mengatasi penyimpangan manajemen risiko keamanan TI', 0),
(8, 1, '1', 'EDM03.03 Memantau manajemen risiko keamanan TI', 'Masalah manajemen risiko untuk dewan keamanan TI', 0),
(9, 1, '2.1', NULL, 'Mengidentifikasikan Tujuan dalam memastikan Optimalisasi Risiko Keamanan TI', 100),
(10, 1, '2.1', NULL, 'Merencanakan dalam Memastikan Optimalisasi Risiko Keamanan TI', 100),
(11, 1, '2.1', NULL, 'Menyesuaikan dalam Memastikan Optimalisasi Risiko Keamanan TI ', 100),
(12, 1, '2.1', NULL, 'Mendefinisikan Tanggung Jawab dalam Memastikan Optimalisasi Risiko Keamanan TI', 100),
(13, 1, '2.1', NULL, 'Identifikasi dan Menyediakan dalam Memastikan Optimalisasi Risiko Keamanan TI ', 100),
(14, 1, '2.1', NULL, 'Mengelola Antarmuka dalam Memastikan Optimalisasi Risiko Keamanan TI', 0),
(15, 1, '2.2', NULL, 'Menetapkan Kebutuhan dalam Memastikan Optimalisasi Risiko ', 100),
(16, 1, '2.2', NULL, 'Menetapkan Kebutuhan Dari Dokumentasi Dan Kontrol dalam Memastikan Optimalisasi Risiko', 100),
(17, 1, '2.2', NULL, 'Identifikasi Dokumentasi, Dan Kontrol Hasil Kerja dalam Memastikan Optimalisasi Risiko', 100),
(18, 1, '2.2', NULL, 'Mengevaluasi Dan Menyesuaikan Hasil Kerja dalam Memastikan Optimalisasi Risiko Keamanan TI?', 0),
(19, 2, '1', 'APO13.01 Menetapkan dan memelihara sistem manajemen keamanan informasi (ISMS)', 'Kebijakan Sistem Manajemen Keamanan Informasi', NULL),
(20, 2, '1', 'APO13.01 Menetapkan dan memelihara sistem manajemen keamanan informasi (ISMS)', 'Pernyataan cakupan Sistem Manajemen Keamanan Informasi', NULL),
(21, 2, '1', 'APO13.02 Menentukan dan mengelola rencana penanganan risiko keamanan informasi.', 'Rencana penanganan risiko keamanan informasi ', NULL),
(22, 2, '1', 'APO13.02 Menentukan dan mengelola rencana penanganan risiko keamanan informasi.', 'Kasus bisnis keamanan informasi ', NULL),
(23, 2, '1', '', 'Laporan audit Sistem Manajemen Keamanan Informasi ', NULL),
(24, 2, '1', 'APO13.03 Pantau dan tinjau SMKI.', 'Rekomendasi untuk peningkatan Manajemen Keamanan Informasi', NULL),
(25, 2, '2.1', NULL, 'Mengidentifikasikan Tujuan dalam Mengelola\r\nLayanan Keamanan Sistem Perusahaan ', NULL),
(26, 2, '2.1', NULL, 'Merencanakan dalam Mengelola Layanan Keamanan Sistem Perusahaan', NULL),
(27, 2, '2.1', '', 'Menyesuaikan dalam Mengelola Layanan Keamanan Sistem Perusahaan', NULL),
(28, 2, '2.1', '', 'Mendefinisikan Tanggung Jawab dalam Mengelola Layanan Keamanan Sistem Perusahaan', NULL),
(29, 2, '2.1', '', 'Identifikasi dan Menyediakan dalam Mengelola\r\nLayanan Keamanan Sistem Perusahaan', NULL),
(30, 2, '2.1', '', 'Mengelola Antarmuka dalam Mengelola Layanan Keamanan Sistem Perusahaan', NULL),
(31, 2, '2.2', NULL, 'Menetapkan Kebutuhan dalam Mengelola Layanan Keamanan Sistem Perusahaan ', NULL),
(32, 2, '2.2', NULL, 'Menetapkan Kebutuhan Dari Dokumentasi Dan Kontrol dalam Mengelola Layanan Keamanan Sistem Perusahaan', NULL),
(33, 2, '2.2', NULL, 'Identifikasi Dokumentasi, Dan Kontrol Hasil Kerja dalam Mengelola Layanan Keamanan Sistem Perusahaan', NULL),
(34, 2, '2.2', NULL, 'Mengevaluasi Dan Menyesuaikan Hasil Kerja dalam Mengelola Layanan Keamanan Sistem Perusahaan', NULL),
(35, 3, '1', 'DSS05.01 Mengidentifikasi dan mengklasifikasikan masalah keamanan', 'Skema klasifikasi masalah pada keamanan informasi', 100),
(36, 3, '1', 'DSS05.01 Mengidentifikasi dan mengklasifikasikan masalah keamanan', 'Laporan status masalah pada keamanan informasi ', 100),
(37, 3, '1', 'DSS05.01 Mengidentifikasi dan mengklasifikasikan masalah keamanan', 'Daftar masalah pada keamanan informasi', 100),
(38, 3, '1', 'DSS05.02 Menyelidiki dan\r\nmendiagnosis masalah keamanan', 'Akar penyebab masalah pada keamanan informasi ', 100),
(39, 3, '1', 'DSS05.02 Menyelidiki dan\r\nmendiagnosis masalah keamanan', 'Laporan penyelesaian masalah pada keamanan informasi', 100),
(40, 3, '1', 'DSS05.03 Menaikkan kesalahan yang diketahui keamanan', 'Catatan kesalahan yang diketahui pada keamanan informasi', 100),
(41, 3, '1', 'DSS05.03 Menaikkan kesalahan yang diketahui keamanan', 'Solusi yang diusulkan untuk kesalahan yang diketahui pada keamanan informasi', 100),
(42, 3, '1', 'DSS05.04 Menyelesaikan\r\ndan menutup masalah keamanan', 'Catatan masalah tertutup pada keamanan informasi ', 100),
(43, 3, '1', 'DSS05.04 Menyelesaikan\r\ndan menutup masalah keamanan', 'Komunikasi pengetahuan yang dipelajari pada keamanan informasi ', 100),
(44, 3, '1', 'DSS05.05 Melakukan\r\nmanajemen keamanan masalah secara proaktif', 'Laporan pemantauan penyelesaian masalah pada keamanan informasi', 100),
(45, 3, '1', 'DSS05.05 Melakukan\r\nmanajemen keamanan masalah secara proaktif', 'Solusi berkelanjutan yang teridentifikasi pada keamanan informasi ', 100),
(46, 3, '2.1', NULL, 'Mengidentifikasikan Tujuan dalam Mengelola Keamanan Layanan dan Produk Perusahaan ', 100),
(47, 3, '2.1', NULL, 'Merencanakan dalam Mengelola Keamanan Layanan dan Produk Perusahaan', 100),
(48, 3, '2.1', NULL, 'Menyesuaikan dalam Mengelola Keamanan Layanan dan Produk Perusahaan ', 100),
(49, 3, '2.1', NULL, 'Mendefinisikan Tanggung Jawab dalam Mengelola Keamanan Layanan dan Produk Perusahaan', 100),
(50, 3, '2.1', NULL, 'Identifikasi dan Menyediakan dalam\r\nMengelola Keamanan Layanan dan Produk Perusahaan', 100),
(51, 3, '2.1', NULL, 'Mengelola Antarmuka dalam Mengelola Keamanan Layanan dan Produk Perusahaan ', 100),
(52, 3, '2.2', NULL, 'Menetapkan Kebutuhan dalam Mengelola Keamanan Layanan dan Produk Perusahaan', 100),
(53, 3, '2.2', NULL, 'Menetapkan Kebutuhan Dari Dokumentasi Dan Kontrol dalam Mengelola Keamanan Layanan dan Produk Perusahaan', 100),
(54, 3, '2.2', NULL, 'Identifikasi Dokumentasi, Dan Kontrol Hasil Kerja dalam Mengelola Keamanan Layanan dan Produk Perusahaan', 100),
(55, 3, '2.2', NULL, 'Mengevaluasi Dan Menyesuaikan Hasil Kerja dalam Mengelola Keamanan Layanan dan Produk Perusahaan', 100);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_users` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_users`, `nama`, `username`, `password`, `role`) VALUES
(1, 'admin', 'admin', '0192023a7bbd73250516f069df18b500', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `perspektif`
--
ALTER TABLE `perspektif`
  ADD PRIMARY KEY (`id_perspektif`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id_question`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_users`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `perspektif`
--
ALTER TABLE `perspektif`
  MODIFY `id_perspektif` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id_question` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_users` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
