-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 02, 2025 at 07:33 AM
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
-- Table structure for table `audit`
--

CREATE TABLE `audit` (
  `id_audit` int(11) NOT NULL,
  `id_pengujian` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `score` int(11) NOT NULL,
  `level` varchar(10) NOT NULL,
  `exist` tinyint(1) DEFAULT NULL,
  `document_evidence` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `level_audit` int(11) NOT NULL,
  `pa_audit` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `cobit`
--

CREATE TABLE `cobit` (
  `id_cobit` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `auditor` varchar(255) NOT NULL,
  `audit_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cobit`
--

INSERT INTO `cobit` (`id_cobit`, `name`, `auditor`, `audit_at`, `deleted_at`) VALUES
(1, 'Anaa', 'admin', '2024-10-12 00:00:00', '2024-10-12 23:22:02'),
(2, 'ana2', 'admin', '2024-10-12 03:07:38', '2024-12-16 16:13:13'),
(3, 'tes2', 'admin', '2024-10-12 08:08:13', '2024-12-16 15:25:53'),
(4, 'halo', 'admin', '2024-10-12 23:24:27', '2025-01-02 01:41:23'),
(5, 'tes33', 'admin', '2024-10-12 23:24:49', NULL),
(6, 'a1', 'auditor', '2024-10-27 11:57:14', '2024-10-27 11:57:19'),
(7, 'Tes', 'admin', '2024-12-16 12:20:11', NULL),
(8, 'tes2', 'admin', '2024-12-16 16:13:09', NULL),
(9, 'a1', 'admin', '2024-12-17 11:46:10', NULL),
(10, 'a2', 'admin', '2024-12-18 21:41:09', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pa_table`
--

CREATE TABLE `pa_table` (
  `id` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `pa` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pa_table`
--

INSERT INTO `pa_table` (`id`, `level`, `pa`) VALUES
(1, 1, '1.1'),
(2, 2, '2.1'),
(3, 2, '2.2'),
(4, 3, '3.1'),
(5, 3, '3.2'),
(6, 4, '4.1'),
(7, 4, '4.2'),
(8, 5, '5.1'),
(9, 5, '5.2');

-- --------------------------------------------------------

--
-- Table structure for table `pengujian`
--

CREATE TABLE `pengujian` (
  `id_pengujian` int(11) NOT NULL,
  `id_cobit` int(11) NOT NULL,
  `audit_process` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `level` int(11) NOT NULL,
  `pa` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pengujian`
--

INSERT INTO `pengujian` (`id_pengujian`, `id_cobit`, `audit_process`, `description`, `level`, `pa`) VALUES
(1, 0, 'APO02', 'desc', 0, NULL),
(2, 3, 'DSS01', 'desc', 4, NULL),
(3, 3, 'EDM01', 'desc', 2, NULL),
(4, 5, 'EDM02', 'desc', 1, NULL),
(5, 5, 'APO03', 'desc', 1, NULL),
(6, 5, 'EDM02', 'desc', 1, NULL),
(7, 7, 'EDM01', '', 3, NULL),
(8, 7, 'EDM02', '', 5, '5.1'),
(9, 7, 'EDM03', '', 5, '5.1'),
(10, 7, 'EDM04', '', 4, '4.2'),
(11, 7, 'EDM05', '', 2, '2.2'),
(12, 7, 'APO01', '', 5, '5.2'),
(13, 7, 'APO02', '', 5, '5.1'),
(14, 7, 'BAI01', '', 1, '1.1'),
(15, 7, 'APO03', '', 5, '5.2'),
(16, 7, 'APO04', '', 1, '1.1'),
(17, 7, 'APO05', '', 1, '1.1'),
(18, 7, 'APO05', '', 1, '1.1'),
(19, 8, 'EDM01', '', 2, '2.2'),
(20, 8, 'EDM02', '', 1, '1.1'),
(21, 8, 'EDM03', '', 1, '1.1'),
(22, 8, 'EDM04', '', 1, '1.1'),
(23, 8, 'EDM05', '', 3, '3.1'),
(24, 8, 'APO01', '', 1, '1.1'),
(25, 8, 'APO02', '', 1, '1.1'),
(26, 8, 'APO03', '', 2, '2.1'),
(27, 8, 'APO04', '', 3, '3.2'),
(28, 8, 'APO05', '', 3, '3.2'),
(29, 8, 'APO06', '', 3, '2.2'),
(30, 8, 'APO07', '', 2, ''),
(31, 8, 'APO08', '', 3, '3.1'),
(32, 8, 'APO12', '', 4, '4.2'),
(33, 8, 'APO13', '', 3, '3.1'),
(34, 8, 'MEA01', '', 3, '3.2'),
(35, 8, 'MEA02', '', 3, '3.2'),
(36, 8, 'MEA03', '', 2, '2.1'),
(37, 7, 'MEA02', '', 1, '1.1'),
(38, 7, 'MEA01', '', 3, '3.2'),
(39, 8, 'DSS05', '', 1, '1.1'),
(40, 8, 'DSS06', '', 1, '1.1'),
(41, 8, 'DSS03', '', 2, '2.1'),
(42, 8, 'DSS04', '', 2, '2.1'),
(43, 9, 'EDM01', '', 3, '3.2'),
(44, 9, 'EDM02', '', 5, '5.2'),
(45, 10, 'EDM01', '', 5, 'stop'),
(46, 10, 'EDM02', '', 2, 'stop'),
(48, 10, 'EDM03 - Ensure Risk Optimization', '', 3, 'stop'),
(49, 10, 'APO12 - Manage Risk', '', 2, 'stop'),
(50, 10, 'MEA02 - Monitor, Evaluate, and Assess the System of Internal Control', '', 3, 'stop');

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
-- Table structure for table `question`
--

CREATE TABLE `question` (
  `id_question` int(11) NOT NULL,
  `process_code` varchar(255) NOT NULL,
  `level` int(11) NOT NULL,
  `pa` varchar(10) NOT NULL,
  `question` varchar(1024) NOT NULL,
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `question`
--

INSERT INTO `question` (`id_question`, `process_code`, `level`, `pa`, `question`, `description`) VALUES
(1, 'EDM03 - Ensure Risk Optimization', 1, '1.1', 'Apakah perusahaan memiliki dokumen terkait panduan keamanan manajemen risiko?', 'Panduan selera risiko'),
(2, 'EDM03 - Ensure Risk Optimization', 1, '1.1', 'Apakah perusahaan memiliki dokumen terkait dengan tingkat toleransi keamanan manajemen risiko ?', 'Tingkat toleransi risiko yang disetujui'),
(3, 'EDM03 - Ensure Risk Optimization', 1, '1.1', 'Apakah perusahaan memiliki dokumen terkait evaluasi kegiatan keamanan manajemen risiko?  ', 'Evaluasi kegiatan manajemen risiko'),
(4, 'EDM03 - Ensure Risk Optimization', 1, '1.1', 'Apakah perusahaan memiliki dokumen terkait kebijakan keamanan manajemen risiko? ', 'Kebijakan manajemen risiko'),
(5, 'EDM03 - Ensure Risk Optimization', 1, '1.1', 'Apakah perusahaan memiliki dokumen terkait pantauan keamanan manajemen risiko?', 'Tujuan utama yang harus dipantau untuk manajemen risiko'),
(6, 'EDM03 - Ensure Risk Optimization', 1, '1.1', 'Apakah perusahaan memiliki dokumen untuk mengukur keamanan manajemen risiko?', 'Menyetujui proses untuk mengukur manajemen risiko'),
(7, 'EDM03 - Ensure Risk Optimization', 1, '1.1', 'Apakah perusahaan memiliki dokumen terkait tindakan perbaikan dalam mengatasi penyimpangankeamanan manajemen risiko?', 'Tindakan perbaikan untuk mengatasi penyimpangan manajemen risiko'),
(8, 'EDM03 - Ensure Risk Optimization', 1, '1.1', 'Apakah perusahaan memiliki dokumen terkait peran aktif dalam mengatasi masalahkeamanan manajemen risiko?', 'Masalah manajemen risiko untuk dewan'),
(9, 'EDM03 - Ensure Risk Optimization', 2, '2.1', 'Apakah tujuan untuk memastikan optimalisasikeamanan manajemen risiko sudah identifikasikan?', ''),
(10, 'EDM03 - Ensure Risk Optimization', 2, '2.1', 'Apakah rencana dalam memastikan optimalisasikeamanan manajemen risiko sudah dibuat?', ''),
(11, 'EDM03 - Ensure Risk Optimization', 2, '2.1', 'Apakah penyesuaian dalam memastikan optimalisasikeamanan manajemenrisiko sudah dilakukan?', ''),
(12, 'EDM03 - Ensure Risk Optimization', 2, '2.1', 'Apakah tanggung jawab dalam memastikan optimalisasikeamanan manajemenrisiko sudah ditingkatkan?', ''),
(13, 'EDM03 - Ensure Risk Optimization', 2, '2.1', 'Apakah identifikasi dan menyediakan dalam memastikan optimalisasikeamanan manajemenrisiko sudah dilakukan?', ''),
(14, 'EDM03 - Ensure Risk Optimization', 2, '2.1', 'Apakah mengelola antarmuka dalam memastikan optimalisasikeamanan manajemenrisiko sudah dijalankan?', ''),
(15, 'EDM03 - Ensure Risk Optimization', 2, '2.2', 'Apakah kebutuhan dalam memastikan optimalisasikeamanan manajemenrisiko sudah ditetapkan?', ''),
(16, 'EDM03 - Ensure Risk Optimization', 2, '2.2', 'Apakah kebutuhan dari dokumentasi dan kontrol dalam memastikan optimalisasikeamanan manajemenrisiko sudah ditetapkan?', ''),
(17, 'EDM03 - Ensure Risk Optimization', 2, '2.2', 'Apakah identifikasi dokumentasi dan kontrol hasil kerja dalam memastikan optimalisasikeamanan manajemenrisiko sudah djalankan?', ''),
(18, 'EDM03 - Ensure Risk Optimization', 2, '2.2', 'Apakah evaluasi dan menyesuaikan hasil Kerja dalam memastikan optimalisasikeamanan manajemenrisiko sudah dijalankan?', ''),
(19, 'EDM03 - Ensure Risk Optimization', 3, '3.1', 'Apakah definisi standart dalam memastikan optimalisasikeamanan manajemenrisiko sudah dilakukan?', ''),
(20, 'EDM03 - Ensure Risk Optimization', 3, '3.1', 'Apakah penetapan urutan dan interaksi antar proses dalam memastikan optimalisasikeamanan manajemenrisiko sudah dilakukan?', ''),
(21, 'EDM03 - Ensure Risk Optimization', 3, '3.1', 'Apakah identifikasi peran dan kompetensi dalam memastikan optimalisasikeamanan manajemenrisiko sudah dijalankan?', ''),
(22, 'EDM03 - Ensure Risk Optimization', 3, '3.1', 'Apakah identifkasi infrastruktur yang dibutuhkan oleh dalam memastikan optimalisasikeamanan manajemenrisiko sudah dijalankan?', ''),
(23, 'EDM03 - Ensure Risk Optimization', 3, '3.1', 'Apakah penetapan metode yang sesuai dalam memastikan optimalisasikeamanan manajemenrisiko sudah dilakukan?', ''),
(24, 'EDM03 - Ensure Risk Optimization', 3, '3.2', 'Apakah proses yang telah didefinisikan dalam memastikan optimalisasikeamanan manajemenrisiko sudah dijalankan?', ''),
(25, 'EDM03 - Ensure Risk Optimization', 3, '3.2', 'Apakah peran, tanggung Jawab dan otoritas dalam memastikan optimalisasikeamanan manajemenrisiko sudah dijalankan?', ''),
(26, 'EDM03 - Ensure Risk Optimization', 3, '3.2', 'Apakah kompetensi yang dibutuhkan untuk dalam memastikan optimalisasikeamanan manajemenrisiko sudah dijalankan?', ''),
(27, 'EDM03 - Ensure Risk Optimization', 3, '3.2', 'Apakah penyediaan sumber daya dan informasi untuk mendukung dalam memastikan optimalisasikeamanan manajemenrisiko sudah dibuat?', ''),
(28, 'EDM03 - Ensure Risk Optimization', 3, '3.2', 'Apakah penyediaan proses infrastruktur yang layak untuk dalam memastikan optimalisasikeamanan manajemenrisiko sudah dibuat?', ''),
(29, 'EDM03 - Ensure Risk Optimization', 3, '3.2', 'Apakah data mengenai dalam memastikan optimalisasikeamanan manajemenrisiko sudah dibuat?', ''),
(30, 'EDM03 - Ensure Risk Optimization', 4, '4.1', 'Apakah identifikasi kebutuhan informasi dalam memastikan optimalisasikeamanan manajemenrisiko sudah dilakukan?', ''),
(31, 'EDM03 - Ensure Risk Optimization', 4, '4.1', 'Apakah tujuan pengukuran proses dari dalam memastikan optimalisasikeamanan manajemenrisiko sudah dilakukan?', ''),
(32, 'EDM03 - Ensure Risk Optimization', 4, '4.1', 'Apakah penetapan tujuan kuantitatif atas dalam memastikan optimalisasikeamanan manajemenrisiko sudah dilakukan?', ''),
(33, 'EDM03 - Ensure Risk Optimization', 4, '4.1', 'Apakah identifikasi pengukuran produk dan proses dalam memastikan optimalisasikeamanan manajemenrisiko sudah dilakukan?', ''),
(34, 'EDM03 - Ensure Risk Optimization', 4, '4.1', 'Apakah penggunaan hasil pengukuran dalam memastikan optimalisasikeamanan manajemenrisiko sudah dijalankan?', ''),
(35, 'EDM03 - Ensure Risk Optimization', 4, '4.2', 'Apakah penentuan teknik analisis dan kontrol dalam memastikan optimalisasikeamanan manajemenrisiko sudah dilakukan?', ''),
(36, 'EDM03 - Ensure Risk Optimization', 4, '4.2', 'Apakah penetapan parameter standart dalam memastikan optimalisasikeamanan manajemenrisiko sudah dibuat?', ''),
(37, 'EDM03 - Ensure Risk Optimization', 4, '4.2', 'Apakah analisis hasil pengukuran proses dalam memastikan optimalisasikeamanan manajemenrisiko sudah dilakukan?', ''),
(38, 'EDM03 - Ensure Risk Optimization', 4, '4.2', 'Apakah identifikasi tindakan koreksi untuk dalam memastikan optimalisasikeamanan manajemenrisiko sudah dijalankan?', ''),
(39, 'EDM03 - Ensure Risk Optimization', 4, '4.2', 'Apakah penetapan batasan kontrol setelah tindakan koreksi pada dalam memastikan optimalisasikeamanan manajemenrisiko sudah dilakukan kembali?', ''),
(40, 'EDM03 - Ensure Risk Optimization', 5, '5.1', 'Apakah definisi tujuan peningkatan proses dalam memastikan optimalisasikeamanan manajemenrisiko sudah dilakukan?', ''),
(41, 'EDM03 - Ensure Risk Optimization', 5, '5.1', 'Apakah analisis pengukuran data proses dalam memastikan optimalisasikeamanan manajemenrisiko sudah dijalankan?', ''),
(42, 'EDM03 - Ensure Risk Optimization', 5, '5.1', 'Apakah identifikasi peluang peningkatan proses dalam memastikan optimalisasikeamanan manajemenrisiko sudah dijalankan?', ''),
(43, 'EDM03 - Ensure Risk Optimization', 5, '5.1', 'Apakah peningkatan konsep berdasarkan peluang peningkatan proses dalam memastikan optimalisasikeamanan manajemenrisiko sudah dilakukan?', ''),
(44, 'EDM03 - Ensure Risk Optimization', 5, '5.1', 'Apakah definisi strategi implementasi konsep baru dalam memastikan optimalisasikeamanan manajemenrisiko sudah dilakukan?', ''),
(45, 'EDM03 - Ensure Risk Optimization', 5, '5.2', 'Apakah penilaian dampak dari perubahan dalam memastikan optimalisasikeamanan manajemenrisiko sudah dilakukan?', ''),
(46, 'EDM03 - Ensure Risk Optimization', 5, '5.2', 'Apakah pengelolaan implementasi perubahan dalam memastikan optimalisasikeamanan manajemenrisiko sudah dijalankan?', ''),
(47, 'EDM03 - Ensure Risk Optimization', 5, '5.2', 'Apakah evaluasi performa implementasi baru terhadap dalam memastikan optimalisasikeamanan manajemenrisiko sudah dilakukan?', ''),
(48, 'APO12 - Manage Risk', 1, '1.1', 'Apakah perusahaan memiliki dokumen keamanan data pada lingkungan terkait dengan risiko?', 'Data tentang lingkungan operasi yang berkaitan dengan risiko'),
(49, 'APO12 - Manage Risk', 1, '1.1', 'Apakah perusahaan memiliki dokumen keamanan data terkait kejadian risiko dan faktor penyebabnya?', 'Data kejadian risiko dan faktor penyebabnya'),
(50, 'APO12 - Manage Risk', 1, '1.1', 'Apakah perusahaaan memiliki dokumen terkait masalah dan faktor yang berpotensi menimbulkan risiko keamanan data?', 'Masalah dan faktor risiko yang muncul'),
(51, 'APO12 - Manage Risk', 1, '1.1', 'Apakah perusahaan memiliki dokumen terkait ruang lingkup upaya analisis risiko keamanan data?', 'Lingkup upaya analisis risiko'),
(52, 'APO12 - Manage Risk', 1, '1.1', 'Apakah perusahaan memiliki dokumen terkait skenario risiko keamanan data TI?', 'skenario risiko TI'),
(53, 'APO12 - Manage Risk', 1, '1.1', 'Apakah perusahaan memiliki dokumen hasil analisis risiko keamanan data?', 'Hasil analisis risiko'),
(54, 'APO12 - Manage Risk', 1, '1.1', 'Apakah perusahaan memiliki dokumen skenario risiko keamanan data terdokumentasi berdasarkan  lini bisnis dan fungsi?', 'Skenario risiko terdokumentasi berdasarkan lini bisnis dan fungsi'),
(55, 'APO12 - Manage Risk', 1, '1.1', 'Apakah perusahaan memiliki dokumen profil risiko keamanan data gabungan termasuk status tindakan manajemen risiko keamanan data?', 'Profil risiko gabungan, termasuk status tindakan manajemen risiko'),
(56, 'APO12 - Manage Risk', 1, '1.1', 'Apakah perusahaan memiliki dokumen analisis risiko keamanan data dan laporan profil risiko keamanan data untuk pemangku kepentingan?', 'Analisis risiko dan laporan profil risiko untuk pemangku kepentingan'),
(57, 'APO12 - Manage Risk', 1, '1.1', 'Apakah perusahaan memilliki dokumen kerjasama dengan pihak ketiga untuk meninjau hasil penilaian risiko keamanan data?', 'Meninjau hasil penilaian risiko pihak ketiga'),
(58, 'APO12 - Manage Risk', 1, '1.1', 'Apakah perusahaan memiliki dokumen peluang untuk menerima risiko keamanan data yang lebih besar?', 'Peluang untuk menerima risiko yang lebih besar'),
(59, 'APO12 - Manage Risk', 1, '1.1', 'Apakah perusahaan memiliki dokumen proposal proyek untuk mengurangi risiko keamanan data?', 'Proposal proyek untuk mengurangi risiko'),
(60, 'APO12 - Manage Risk', 1, '1.1', 'Apakah perusahaan memiliki dokumen rencana dalam menghadapi insiden terkait risiko keamanan data?', 'Rencana respons insiden terkait risiko'),
(61, 'APO12 - Manage Risk', 1, '1.1', 'Apakah perusahaan memiliki dokumen terkait komunikasi dampak resiko?', 'Komunikasi dampak risiko'),
(62, 'APO12 - Manage Risk', 1, '1.1', 'Apakah perusahaan memiliki dokumen terkait akar penyebab terjadinya risiko keamanan data?', 'Akar penyebab terkait risiko'),
(63, 'APO12 - Manage Risk', 2, '2.1', 'Apakah tujuan dalam mengelola risiko keamanan data sudah diidentifikasikan?', ''),
(64, 'APO12 - Manage Risk', 2, '2.1', 'Apakah rencana dalam mengelola risiko keamanan data sudah dibuat?', ''),
(65, 'APO12 - Manage Risk', 2, '2.1', 'Apakah penyesuaian dalam mengelola risiko keamanan data sudah dilakukan?', ''),
(66, 'APO12 - Manage Risk', 2, '2.1', 'Apakah tanggung Jawab dalam mengelola risiko keamanan data sudah ditingkatkan?', ''),
(67, 'APO12 - Manage Risk', 2, '2.1', 'Apakah identifikasi dan menyediakan dalam mengelola risiko keamanan data sudah dilakukan?', ''),
(68, 'APO12 - Manage Risk', 2, '2.1', 'Apakah mengelola antarmuka dalam mengelola risiko keamanan data sudah dilakukan?', ''),
(69, 'APO12 - Manage Risk', 2, '2.2', 'Apakah kebutuhan dalam mengelola risiko keamanan data sudah ditetapkan?', ''),
(70, 'APO12 - Manage Risk', 2, '2.2', 'Apakah kebutuhan dari dokumentasi, dan kontrol hasil kerja dalam mengelola risiko keamanan data sudah ditetapkan?', ''),
(71, 'APO12 - Manage Risk', 2, '2.2', 'Apakah identifikasi dokumentasi, dan kontrol hasil kerja dalam mengelola risiko keamanan data sudah dilakukan?', ''),
(72, 'APO12 - Manage Risk', 2, '2.2', 'Apakah evaluasi dan penyesuaian hasil kerja dalam mengelola risiko keamanan data sudah dilakukan?', ''),
(73, 'APO12 - Manage Risk', 3, '3.1', 'Apakah definisi standart dalam mengelola risiko keamanan data sudah dilakukan?', ''),
(74, 'APO12 - Manage Risk', 3, '3.1', 'Apakah urutan dan interaksi antar proses dalam mengelola risiko keamanan data sudah ditetapkan?', ''),
(75, 'APO12 - Manage Risk', 3, '3.1', 'Apakah identifikasi peran dan kompetensi dalam mengelola risiko keamanan data sudah dijalankan?', ''),
(76, 'APO12 - Manage Risk', 3, '3.1', 'Apakah identifikasi infrastruktur yang dibutuhkan oleh dalam mengelola risiko keamanan data sudah dijalankan?', ''),
(77, 'APO12 - Manage Risk', 3, '3.1', 'Apakah metode yang sesuai dalam mengelola risiko keamanan data sudah ditetapkan?', ''),
(78, 'APO12 - Manage Risk', 3, '3.2', 'Apakah proses yang telah didefinisikan dalam mengelola risiko keamanan data sudah dijalankan?', ''),
(79, 'APO12 - Manage Risk', 3, '3.2', 'Apakah menugaskan dan mengomunikasikan peran, tanggung jawab dan otoritas dalam mengelola risiko keamanan data sudah dilakukan?', ''),
(80, 'APO12 - Manage Risk', 3, '3.2', 'Apakah kompetensi yang dibutuhkan untuk dalam mengelola risiko keamanan data sudah dipastikan?', ''),
(81, 'APO12 - Manage Risk', 3, '3.2', 'Apakah penyediaan sumber daya dan informasi untuk mendukung dalam mengelola risiko keamanan data sudah dilakukan?', ''),
(82, 'APO12 - Manage Risk', 3, '3.2', 'Apakah penyediaan proses infrastruktur yang layak untuk dalam mengelola risiko keamanan data sudah dilakukan?', ''),
(83, 'APO12 - Manage Risk', 3, '3.2', 'Apakah mengumpulkan dan menganalisis keamanan data mengenai dalam mengelola risiko keamanan data?', ''),
(84, 'APO12 - Manage Risk', 4, '4.1', 'Apakah identifikasi kebutuhan informasi dalam mengelola risiko keamanan data sudah dilakukan?', ''),
(85, 'APO12 - Manage Risk', 4, '4.1', 'Apakah tujuan pengukuran proses dari dalam mengelola risiko keamanan data sudah dilakukan?', ''),
(86, 'APO12 - Manage Risk', 4, '4.1', 'Apakah penetapan tujuan kuantitatif atas dalam mengelola risiko keamanan data sudah dilakukan?', ''),
(87, 'APO12 - Manage Risk', 4, '4.1', 'Apakah identifikasi pengukuran produk dan proses dalam mengelola risiko keamanan data sudah dilakukan?', ''),
(88, 'APO12 - Manage Risk', 4, '4.1', 'Apakah penggunaan hasil pengukuran dalam mengelola risiko keamanan data sudah dijalankan?', ''),
(89, 'APO12 - Manage Risk', 4, '4.2', 'Apakah penentuan teknik analisis dan kontrol dalam mengelola risiko keamanan data sudah dilakukan?', ''),
(90, 'APO12 - Manage Risk', 4, '4.2', 'Apakah penetapan parameter standart dalam mengelola risiko keamanan data sudah dilakukan?', ''),
(91, 'APO12 - Manage Risk', 4, '4.2', 'Apakah analisis hasil pengukuran proses dalam mengelola risiko keamanan data sudah dijalankan?', ''),
(92, 'APO12 - Manage Risk', 4, '4.2', 'Apakah identifikasi dan implementasikan tindakan koreksi untuk dalam mengelola risiko keamanan data sudah dilakukan?', ''),
(93, 'APO12 - Manage Risk', 4, '4.2', 'Apakah penetapan batasan kontrol setelah tindakan koreksi pada dalam mengelola risiko keamanan data sudah dilakukan?', ''),
(94, 'APO12 - Manage Risk', 5, '5.1', 'Apakah definisi tujuan peningkatan proses dalam mengelola risiko keamanan data sudah dilakukan?', ''),
(95, 'APO12 - Manage Risk', 5, '5.1', 'Apakah analisis pengukuran keamanan data proses dalam mengelola risiko keamanan data sudah dijalankan?', ''),
(96, 'APO12 - Manage Risk', 5, '5.1', 'Apakah identifikasi peluang peningkatan proses dalam mengelola risiko keamanan data sudah dilakukan?', ''),
(97, 'APO12 - Manage Risk', 5, '5.1', 'Apakah peningkatan konsep berdasarkan peluang peningkatan proses dalam mengelola risiko keamanan data sudah dilakukan?', ''),
(98, 'APO12 - Manage Risk', 5, '5.1', 'Apakah definisi strategi implementasi konsep baru dalam mengelola risiko keamanan data sudah dilakukan?', ''),
(99, 'APO12 - Manage Risk', 5, '5.2', 'Apakah penilaian dampak dari perubahan dalam mengelola risiko keamanan data sudah dilakukan?', ''),
(100, 'APO12 - Manage Risk', 5, '5.2', 'Apakah pengelola implementasi perubahan dalam mengelola risiko keamanan data sudah dijalankan?', ''),
(101, 'APO12 - Manage Risk', 5, '5.2', 'Apakah evaluasi performa implementasi baru terhadap dalam mengelola risiko keamanan data sudah dilakukan?', ''),
(102, 'APO13 - Manage Security', 1, '1.1', 'Apakah Perusahaan memiliki dokumen kebijakan terkait Sistem Manajemen Keamanan Informasi?', 'Kebijakan Sistem Manajemen Keamanan Informasi'),
(103, 'APO13 - Manage Security', 1, '1.1', 'Apakah Perusahaan memiliki dokumen pernyataan terkait cakupan pada sistem manajemen keamanan informasi?', 'Pernyataan cakupan Sistem Manajemen Keamanan Informasi'),
(104, 'APO13 - Manage Security', 1, '1.1', 'Apakah Perusahaan memiliki dokumen rencana terkait penanganan risiko keamanan informasi?', 'Rencana penanganan risiko keamanan informasi'),
(105, 'APO13 - Manage Security', 1, '1.1', 'Apakah Perusahaan memiliki dokumen kasus terkait bisnis keamanan informasi?', 'Kasus bisnis keamanan informasi'),
(106, 'APO13 - Manage Security', 1, '1.1', 'Apakah Perusahaan memiliki dokumen laporan audit terkait sistem manajemen keamanan informasi?', 'Laporan audit Sistem Manajemen Keamanan Informasi '),
(107, 'APO13 - Manage Security', 1, '1.1', 'Apakah Perusahaan memiliki dokumen rekomendasi untuk peningkatan terkait Manajemen Keamanan Informasi?', 'Rekomendasi untuk peningkatan Manajemen Keamanan Informasi '),
(108, 'APO13 - Manage Security', 2, '2.1', 'Apakah identifikasi tujuan dalam mengelola layanan keamanan sistem perusahaan sudah dilakukan?', ''),
(109, 'APO13 - Manage Security', 2, '2.1', 'Apakah rencana dalam mengelola layanan keamanan sistem perusahaan sudah dibuat?', ''),
(110, 'APO13 - Manage Security', 2, '2.1', 'Apakah penyesuaian dalam mengelola layanan keamanan sistem perusahaan sudah dilakukan?', ''),
(111, 'APO13 - Manage Security', 2, '2.1', 'Apakah tanggung Jawab dalam mengelola layanan keamanan sistem perusahaan sudah dibuat?', ''),
(112, 'APO13 - Manage Security', 2, '2.1', 'Apakah identifikasi dan menyediakan dalam Mengelola Layanan Keamanan Sistem Perusahaan sudah dilakukan?', ''),
(113, 'APO13 - Manage Security', 2, '2.1', 'Apakah pengelolaan antarmuka dalam mengelola layanan keamanan sistem perusahaan sudah dilakukan?', ''),
(114, 'APO13 - Manage Security', 2, '2.2', 'Apakah kebutuhan yang diperlukan dalam mengelola layanan keamanan sistem perusahaan sudah ditetapkan?', ''),
(115, 'APO13 - Manage Security', 2, '2.2', 'Apakah kebutuhan yang diperlukan dari dokumentasi, dan kontrol dalam mengelola Layanan keamanan sistem perusahaan sudah ditetapkan?', ''),
(116, 'APO13 - Manage Security', 2, '2.2', 'Apakah identifikasi dokumentasi, dan kontrol hasil kerja dalam mengelola layanan keamanan sistem sudah dilakukan?', ''),
(117, 'APO13 - Manage Security', 2, '2.2', 'Apakah evaluasi dan penyesuaian hasil kerja dalam mengelola layanan keamanan sistem perusahaan sudah dijalankan?', ''),
(118, 'APO13 - Manage Security', 3, '3.1', 'Apakah standart dalam mengelola layanan keamanan sistem perusahaan sudah dibuat?', ''),
(119, 'APO13 - Manage Security', 3, '3.1', 'Apakah penetapan urutan dan interaksi antar proses dalam mengelola layanan keamanan sistem perusahaan? Sudah dibuat?', ''),
(120, 'APO13 - Manage Security', 3, '3.1', 'Apakah identifikasi peran dan kompetensi dalam mengelola layanan keamanan sistem perusahaan sudah dilakukan?', ''),
(121, 'APO13 - Manage Security', 3, '3.1', 'Apakah identifikasi infrastruktur yang dibutuhkan oleh dalam mengelola layanan keamanan sistem perusahaan sudah dibuat?', ''),
(122, 'APO13 - Manage Security', 3, '3.1', 'Apakah penetapan metode yang sesuai dalam mengelola layanan keamanan sistem perusahaan sudah dibuat?', ''),
(123, 'APO13 - Manage Security', 3, '3.2', 'Apakah proses yang telah didefinisikan dalam mengelola layanan keamanan sistem perusahaan sudah dijalankan?', ''),
(124, 'APO13 - Manage Security', 3, '3.2', 'Apakah penugasan dan mengomunikasikan Peran, Tanggung Jawab Dan Otoritas dalam Mengelola Layanan Keamanan Sistem Perusahaan sudah dibuat?', ''),
(125, 'APO13 - Manage Security', 3, '3.2', 'Apakah kompetensi Yang Dibutuhkan Untuk dalam Mengelola Layanan Keamanan Sistem Perusahaan sudah dijalankan?', ''),
(126, 'APO13 - Manage Security', 3, '3.2', 'Apakah penyedia Sumber Daya Dan Informasi Untuk Mendukung dalam Mengelola Layanan Keamanan Sistem Perusahaan sudah dibuat?', ''),
(127, 'APO13 - Manage Security', 3, '3.2', 'Apakah penyedia proses infrastruktur Yang Layak Untuk dalam Mengelola Layanan Keamanan Sistem Perusahaan sudah dibuat?', ''),
(128, 'APO13 - Manage Security', 3, '3.2', 'Apakah pengumpulan Dan Menganalisis Data Mengenai dalam Mengelola Layanan Keamanan Sistem Perusahaan sudah dilakukan?', ''),
(129, 'APO13 - Manage Security', 4, '4.1', 'Apakah identifikasi Kebutuhan Informasi dalam Mengelola Layanan Keamanan Sistem Perusahaan sudah dilakukan?', ''),
(130, 'APO13 - Manage Security', 4, '4.1', 'Apakah tujuan pengukuran Proses Dari dalam Mengelola Layanan Keamanan Sistem Perusahaan sudah dijalankan?', ''),
(131, 'APO13 - Manage Security', 4, '4.1', 'Apakah penetapan tujuan Kuantitatif Atas dalam Mengelola Layanan Keamanan Sistem Perusahaan sudah dilakukan?', ''),
(132, 'APO13 - Manage Security', 4, '4.1', 'Apakah identifikasi pengukuran Produk Dan Proses dalam Mengelola Layanan Keamanan Sistem Perusahaan sudah dilakukan?', ''),
(133, 'APO13 - Manage Security', 4, '4.1', 'Apakah hasil Pengukuran dalam Mengelola Layanan Keamanan Sistem Perusahaan sudah didapatkan?', ''),
(134, 'APO13 - Manage Security', 4, '4.2', 'Apakah teknik Analisis Dan Kontrol dalam Mengelola Layanan Keamanan Sistem Perusahaan sudah dijalankan?', ''),
(135, 'APO13 - Manage Security', 4, '4.2', 'Apakah penetapan Parameter Standart dalam Mengelola Layanan Keamanan Sistem Perusahaan sudah dibuat?', ''),
(136, 'APO13 - Manage Security', 4, '4.2', 'Apakah analisis Hasil Pengukuran Proses dalam Mengelola Layanan Keamanan Sistem Perusahaan sudah dibuat?', ''),
(137, 'APO13 - Manage Security', 4, '4.2', 'Apakah identifikasi Dan Implementasikan Tindakan Koreksi Untuk dalam Mengelola Layanan Keamanan Sistem Perusahaan sudah dilakukan?', ''),
(138, 'APO13 - Manage Security', 4, '4.2', 'Apakah penetapan Kembali Batasan Kontrol Setelah Tindakan Koreksi Pada dalam Mengelola Layanan Keamanan Sistem Perusahaan sudah dijalankan?', ''),
(139, 'APO13 - Manage Security', 5, '5.1', 'Apakah definisikan Tujuan Peningkatan Proses dalam Mengelola Layanan Keamanan Sistem Perusahaan sudah dilakukan?', ''),
(140, 'APO13 - Manage Security', 5, '5.1', 'Apakah analisis Pengukuran Data Proses dalam Mengelola Layanan Keamanan Sistem Perusahaan sudah dibuat?', ''),
(141, 'APO13 - Manage Security', 5, '5.1', 'Apakah identifikasi Peluang Peningkatan Proses dalam Mengelola Layanan Keamanan Sistem Perusahaan sudah dilakukan?', ''),
(142, 'APO13 - Manage Security', 5, '5.1', 'Apakah Konsep Berdasarkan Peluang Peningkatan Proses dalam Mengelola Layanan Keamanan Sistem Perusahaan sudah ditingkatkan?', ''),
(143, 'APO13 - Manage Security', 5, '5.1', 'Apakah definisi Strategi Implementasi Konsep Baru dalam Mengelola Layanan Keamanan Sistem Perusahaan sudah dibuat?', ''),
(144, 'APO13 - Manage Security', 5, '5.2', 'Apakah penilaian Dampak Dari Perubahan dalam Mengelola Layanan Keamanan Sistem Perusahaan sudah dibuat?', ''),
(145, 'APO13 - Manage Security', 5, '5.2', 'Apakah pengelolaan Implementasi Perubahan dalam Mengelola Layanan Keamanan Sistem Perusahaan sudah dijalankan?', ''),
(146, 'APO13 - Manage Security', 5, '5.2', 'Apakah evaluasi Performa Implementasi Baru Terhadap dalam Mengelola Layanan Keamanan Sistem Perusahaan sudah dijalankan?', ''),
(147, 'BAI09 - Manage Application Security', 1, '1.1', 'Apakah perusahaan memiliki daftar aset terkait aplikasi yang aman?', 'Daftar aset'),
(148, 'BAI09 - Manage Application Security', 1, '1.1', 'Apa hasil pemeriksaan keamanan aplikasi yang diterapkan?', 'Hasil pemeriksaan fisik persediaan'),
(149, 'BAI09 - Manage Application Security', 1, '1.1', 'Apakah aplikasi yang diulas sesuai dengan tujuan dan standar keamanan?', 'Hasil ulasan fit-for-purpose'),
(150, 'BAI09 - Manage Application Security', 1, '1.1', 'Bagaimana komunikasi mengenai downtime pemeliharaan aplikasi yang direncanakan untuk tujuan keamanan?', 'Komunikasi downtime pemeliharaan yang direncanakan'),
(151, 'BAI09 - Manage Application Security', 1, '1.1', 'Apakah ada perjanjian pemeliharaan terkait dengan keamanan aplikasi?', 'Perjanjian pemeliharaan'),
(152, 'BAI09 - Manage Application Security', 1, '1.1', 'Apakah permintaan pengadaan aset keamanan aplikasi yang disetujui telah ada?', 'Permintaan pengadaan aset yang disetujui'),
(153, 'BAI09 - Manage Application Security', 1, '1.1', 'Apakah daftar aset aplikasi yang diperbarui untuk menjaga keamanan sudah tersedia?', 'Daftar aset yang diperbarui'),
(154, 'BAI09 - Manage Application Security', 1, '1.1', 'Apa prosedur penghentian penggunaan aplikasi secara resmi untuk alasan keamanan?', 'Penghentian aset resmi'),
(155, 'BAI09 - Manage Application Security', 1, '1.1', 'Apa hasil tinjauan pengoptimalan biaya terkait pengelolaan aplikasi secara aman?', 'Hasil tinjauan pengoptimalan biaya'),
(156, 'BAI09 - Manage Application Security', 1, '1.1', 'Apakah ada peluang untuk mengurangi biaya aplikasi atau meningkatkan nilai dengan meningkatkan keamanan?', 'Peluang untuk mengurangi biaya aset atau meningkatkan nilai'),
(157, 'BAI09 - Manage Application Security', 1, '1.1', 'Apa daftar lisensi perangkat lunak yang mendukung keamanan aplikasi?', 'Daftar lisensi perangkat lunak'),
(158, 'BAI09 - Manage Application Security', 1, '1.1', 'Apa hasil audit lisensi perangkat lunak yang terpasang untuk aplikasi keamanan?', 'Hasil audit lisensi terpasang'),
(159, 'BAI09 - Manage Application Security', 1, '1.1', 'Apakah ada rencana aksi untuk menyesuaikan jumlah lisensi dan alokasi untuk aplikasi yang aman?', 'Rencana aksi untuk menyesuaikan nomor lisensi dan alokasi'),
(160, 'BAI09 - Manage Application Security', 2, '2.1', 'Apa tujuan yang telah diidentifikasi dalam mengelola keamanan aplikasi perusahaan?', ''),
(161, 'BAI09 - Manage Application Security', 2, '2.1', 'Bagaimana perusahaan merencanakan pendekatan dalam mengelola keamanan aplikasi perusahaan?', ''),
(162, 'BAI09 - Manage Application Security', 2, '2.1', 'Bagaimana perusahaan menyesuaikan kebijakan dan prosedur keamanan dalam pengelolaan aplikasi perusahaan?', ''),
(163, 'BAI09 - Manage Application Security', 2, '2.1', 'Apa tanggung jawab yang telah didefinisikan dalam mengelola keamanan aplikasi perusahaan?', ''),
(164, 'BAI09 - Manage Application Security', 2, '2.1', 'Apa saja sumber daya yang dibutuhkan untuk mengelola keamanan aplikasi dan bagaimana cara penyediaannya?', ''),
(165, 'BAI09 - Manage Application Security', 2, '2.1', 'Bagaimana perusahaan mengelola antarmuka aplikasi yang terkait dengan aspek keamanan perusahaan?', ''),
(166, 'BAI09 - Manage Application Security', 2, '2.2', 'Apa saja kebutuhan keamanan yang perlu ditetapkan dalam pengelolaan aplikasi perusahaan?', ''),
(167, 'BAI09 - Manage Application Security', 2, '2.2', 'Apa saja kebutuhan dokumentasi dan kontrol keamanan yang diperlukan dalam pengelolaan aplikasi perusahaan?', ''),
(168, 'BAI09 - Manage Application Security', 2, '2.2', 'Apa dokumentasi dan kontrol yang diperlukan untuk mengelola keamanan aplikasi perusahaan?', ''),
(169, 'BAI09 - Manage Application Security', 2, '2.2', 'Bagaimana perusahaan mengevaluasi dan menyesuaikan hasil kerja terkait keamanan aplikasi perusahaan?', ''),
(170, 'BAI09 - Manage Application Security', 3, '3.1', 'Apa standar keamanan yang telah didefinisikan dalam pengelolaan aplikasi perusahaan?', ''),
(171, 'BAI09 - Manage Application Security', 3, '3.1', 'Bagaimana perusahaan menetapkan urutan dan interaksi antar proses yang terkait dengan keamanan aplikasi perusahaan?', ''),
(172, 'BAI09 - Manage Application Security', 3, '3.1', 'Apa peran dan kompetensi yang dibutuhkan dalam mengelola keamanan aplikasi perusahaan?', ''),
(173, 'BAI09 - Manage Application Security', 3, '3.1', 'Infrastruktur apa saja yang dibutuhkan untuk mendukung keamanan aplikasi perusahaan?', ''),
(174, 'BAI09 - Manage Application Security', 3, '3.1', 'Apa metode yang sesuai untuk mengelola keamanan aplikasi perusahaan?', ''),
(175, 'BAI09 - Manage Application Security', 3, '3.2', 'Bagaimana perusahaan menjalankan proses yang telah didefinisikan untuk mengelola keamanan aplikasi perusahaan?', ''),
(176, 'BAI09 - Manage Application Security', 3, '3.2', 'Bagaimana perusahaan menugaskan dan mengomunikasikan peran, tanggung jawab, dan otoritas dalam mengelola keamanan aplikasi perusahaan?', ''),
(177, 'BAI09 - Manage Application Security', 3, '3.2', 'Bagaimana perusahaan memastikan kompetensi yang dibutuhkan untuk mengelola keamanan aplikasi perusahaan?', ''),
(178, 'BAI09 - Manage Application Security', 3, '3.2', 'Apa sumber daya dan informasi yang perlu disediakan untuk mendukung pengelolaan keamanan aplikasi perusahaan?', ''),
(179, 'BAI09 - Manage Application Security', 3, '3.2', 'Apa proses infrastruktur yang layak disediakan untuk mendukung pengelolaan keamanan aplikasi perusahaan?', ''),
(180, 'BAI09 - Manage Application Security', 3, '3.2', 'Bagaimana perusahaan mengumpulkan dan menganalisis data terkait pengelolaan keamanan aplikasi perusahaan?', ''),
(181, 'BAI09 - Manage Application Security', 4, '4.1', 'Apa kebutuhan informasi yang perlu diidentifikasi terkait pengelolaan keamanan aplikasi perusahaan?', ''),
(182, 'BAI09 - Manage Application Security', 4, '4.1', 'Apa tujuan pengukuran proses pengelolaan keamanan aplikasi perusahaan?', ''),
(183, 'BAI09 - Manage Application Security', 4, '4.1', 'Apa tujuan kuantitatif yang ditetapkan untuk pengelolaan keamanan aplikasi perusahaan?', ''),
(184, 'BAI09 - Manage Application Security', 4, '4.1', 'Bagaimana perusahaan mengidentifikasi pengukuran produk dan proses dalam pengelolaan keamanan aplikasi perusahaan?', ''),
(185, 'BAI09 - Manage Application Security', 4, '4.1', 'Bagaimana perusahaan menggunakan hasil pengukuran untuk meningkatkan keamanan aplikasi perusahaan?', ''),
(186, 'BAI09 - Manage Application Security', 4, '4.2', 'Apa teknik analisis dan kontrol yang perlu ditentukan dalam pengelolaan keamanan aplikasi perusahaan?', ''),
(187, 'BAI09 - Manage Application Security', 4, '4.2', 'Apa parameter standar yang perlu ditetapkan untuk pengelolaan keamanan aplikasi perusahaan?', ''),
(188, 'BAI09 - Manage Application Security', 4, '4.2', 'Bagaimana perusahaan menganalisis hasil pengukuran proses pengelolaan keamanan aplikasi perusahaan?', ''),
(189, 'BAI09 - Manage Application Security', 4, '4.2', 'Apa tindakan koreksi yang perlu diidentifikasi dan diterapkan untuk pengelolaan keamanan aplikasi perusahaan?', ''),
(190, 'BAI09 - Manage Application Security', 4, '4.2', 'Bagaimana perusahaan menetapkan kembali batasan kontrol setelah tindakan koreksi pada pengelolaan keamanan aplikasi perusahaan?', ''),
(191, 'BAI09 - Manage Application Security', 5, '5.1', 'Apa tujuan peningkatan proses yang didefinisikan dalam pengelolaan keamanan aplikasi perusahaan?', ''),
(192, 'BAI09 - Manage Application Security', 5, '5.1', 'Bagaimana perusahaan menganalisis pengukuran data proses dalam pengelolaan keamanan aplikasi perusahaan?', ''),
(193, 'BAI09 - Manage Application Security', 5, '5.1', 'Apa peluang peningkatan proses yang dapat diidentifikasi dalam pengelolaan keamanan aplikasi perusahaan?', ''),
(194, 'BAI09 - Manage Application Security', 5, '5.1', 'Bagaimana perusahaan meningkatkan konsep berdasarkan peluang peningkatan proses keamanan aplikasi perusahaan?', ''),
(195, 'BAI09 - Manage Application Security', 5, '5.1', 'Apa strategi implementasi konsep baru yang didefinisikan dalam pengelolaan keamanan aplikasi perusahaan?', ''),
(196, 'BAI09 - Manage Application Security', 5, '5.2', 'Bagaimana perusahaan menilai dampak dari perubahan dalam pengelolaan keamanan aplikasi perusahaan?', ''),
(197, 'BAI09 - Manage Application Security', 5, '5.2', 'Bagaimana perusahaan mengelola implementasi perubahan dalam pengelolaan keamanan aplikasi perusahaan?', ''),
(198, 'BAI09 - Manage Application Security', 5, '5.2', 'Bagaimana perusahaan mengevaluasi performa implementasi baru terkait pengelolaan keamanan aplikasi perusahaan?', ''),
(199, 'DSS01 - Manage Operations', 1, '1.1', 'Apakah perusahaan memiliki dokumen jadwal operasional keamanan TI?', 'Jadwal operasional'),
(200, 'DSS01 - Manage Operations', 1, '1.1', 'Apakah perusahaan memiliki dokumen log cadangan?', 'Log cadangan'),
(201, 'DSS01 - Manage Operations', 1, '1.1', 'Apakah perusahaan memiliki dokumen rencana layanan TI outsourcin?', 'Rencana penjaminan independen'),
(202, 'DSS01 - Manage Operations', 1, '1.1', 'Apakah perusahaan memiliki dokumen aturan pemantauan aset keamanan TI dan kondisi peristiwa?', 'Aturan pemantauan aset dan kondisi peristiwa'),
(203, 'DSS01 - Manage Operations', 1, '1.1', 'Apakah perusahaan memiliki dokumen log peristiwa?', 'Log peristiwa'),
(204, 'DSS01 - Manage Operations', 1, '1.1', 'Apakah perusahaan memiliki dokumen tiket insiden?', 'Tiket insiden'),
(205, 'DSS01 - Manage Operations', 1, '1.1', 'Apakah perusahaan memiliki dokumen kebijakan lingkungan?', 'Kebijakan lingkungan'),
(206, 'DSS01 - Manage Operations', 1, '1.1', 'Apakah perusahaan memiliki dokumen laporan polis asuransi?', 'Laporan polis asuransi'),
(207, 'DSS01 - Manage Operations', 1, '1.1', 'Apakah perusahaan memiliki dokumen laporan penilaian fasilitas?', 'Laporan penilaian fasilitas'),
(208, 'DSS01 - Manage Operations', 1, '1.1', 'Apakah perusahaan memiliki dokumen kesadaran kesehatan dan keselamatan?', 'Kesadaran kesehatan dan keselamatan'),
(209, 'DSS01 - Manage Operations', 2, '2.1', 'Apakah identifikasi tujuan dalam mengelola operasional perusahaan sudah dilakukan?', ''),
(210, 'DSS01 - Manage Operations', 2, '2.1', 'Apakah rencana dalam dalam mengelola operasional perusahaan sudah dibuat?', ''),
(211, 'DSS01 - Manage Operations', 2, '2.1', 'Apakah penyesuaikan dalam mengelola operasional perusahaan sudah dilakukan?', ''),
(212, 'DSS01 - Manage Operations', 2, '2.1', 'Apakah tanggung jawab dalam mengelola operasional perusahaan sudah ditingkatkan?', ''),
(213, 'DSS01 - Manage Operations', 2, '2.1', 'Apakah identifikasi dan Menyediakan dalam Mengelola Operasional Perusahaan sudah dilakukan?', ''),
(214, 'DSS01 - Manage Operations', 2, '2.1', 'Apakah identifikasi dalam mengelola operasional perusahaan sudah dilakukan?', ''),
(215, 'DSS01 - Manage Operations', 2, '2.2', 'Apakah kebutuhan dalam mengelola  operasional perusahaan sudah ditetapkan?', ''),
(216, 'DSS01 - Manage Operations', 2, '2.2', 'Apakah kebutuhan dari Dokumentasi, Dan Kontrol dalam mengelola operasional perusahaan sudah ditetapkan?', ''),
(217, 'DSS01 - Manage Operations', 2, '2.2', 'Apakah identifikasi Dokumentasi, Dan Kontrol Hasil Kerja dalam mengelola operasional perusahaan sudah dilakukan?', ''),
(218, 'DSS01 - Manage Operations', 2, '2.2', 'Apakah mengevaluasi dan menyesuaikan hasil kerja dalam mengelola operasional perusahaan sudah dilakukan?', ''),
(219, 'DSS01 - Manage Operations', 3, '3.1', 'Apakah standart dalam Mengelola Operasional Perusahaan sudah dilakukan?', ''),
(220, 'DSS01 - Manage Operations', 3, '3.1', 'Apakah penetapan Urutan Dan Interaksi Antar Proses dalam Mengelola Operasional Perusahaan sudah dijalankan?', ''),
(221, 'DSS01 - Manage Operations', 3, '3.1', 'Apakah identifikasi Peran Dan Kompetensi dalam Mengelola Operasional Perusahaan sudah dilakukan?', ''),
(222, 'DSS01 - Manage Operations', 3, '3.1', 'Apakah identifikasi Infrastruktur Yang Dibutuhkan Oleh dalam Mengelola Operasional Perusahaan sudah dijalankan?', ''),
(223, 'DSS01 - Manage Operations', 3, '3.1', 'Apakah penetapan Metode Yang Sesuai dalam Mengelola Operasional Perusahaan sudah dilakukan?', ''),
(224, 'DSS01 - Manage Operations', 3, '3.2', 'Apakah Proses Yang Telah Didefinisikan dalam Mengelola Operasional Perusahaan sudah dijalankan?', ''),
(225, 'DSS01 - Manage Operations', 3, '3.2', 'Apakah Menugaskan Dan Mengomunikasikan Peran, Tanggung Jawab Dan Otoritas dalam Mengelola Operasional Perusahaan sudah dilakukan?', ''),
(226, 'DSS01 - Manage Operations', 3, '3.2', 'Apakah Memastikan Kompetensi Yang Dibutuhkan Untuk dalam Mengelola Operasional Perusahaan sudah dilakukan?', ''),
(227, 'DSS01 - Manage Operations', 3, '3.2', 'Apakah Menyediakan Sumber Daya Dan Informasi Untuk Mendukung dalam Mengelola Operasional Perusahaan sudah dilakukan?', ''),
(228, 'DSS01 - Manage Operations', 3, '3.2', 'Apakah Menyediakan Proses Infrastruktur Yang Layak Untuk dalam Mengelola Operasional Perusahaan sudah dilakukan?', ''),
(229, 'DSS01 - Manage Operations', 3, '3.2', 'Apakah Mengumpulkan Dan Menganalisis Data Mengenai dalam Mengelola Operasional Perusahaan sudah dilakukan?', ''),
(230, 'DSS01 - Manage Operations', 4, '4.1', 'Apakah mengidentifikasi Kebutuhan Informasi dalam Mengelola Operasional Perusahaan sudah dilakukan?', ''),
(231, 'DSS01 - Manage Operations', 4, '4.1', 'Apakah Mendapatkan Tujuan Pengukuran Proses Dari dalam Mengelola Operasional Perusahaan sudah dilakukan?', ''),
(232, 'DSS01 - Manage Operations', 4, '4.1', 'Apakah menetapkan Tujuan Kuantitatif Atas dalam Mengelola Operasional Perusahaan sudah dilakukan?', ''),
(233, 'DSS01 - Manage Operations', 4, '4.1', 'Apakah mengidentifikasi Pengukuran Produk Dan Proses dalam Mengelola Operasional Perusahaan sudah dilakukan?', ''),
(234, 'DSS01 - Manage Operations', 4, '4.1', 'Apakah Menggunakan Hasil Pengukuran dalam Mengelola Operasional Perusahaan sudah dilakukan?', ''),
(235, 'DSS01 - Manage Operations', 4, '4.2', 'Apakah menentukan Teknik Analisis Dan Kontrol dalam Mengelola Operasional Perusahaan sudah dilakukan?', ''),
(236, 'DSS01 - Manage Operations', 4, '4.2', 'Apakah menetapkan Parameter Standart dalam Mengelola Operasional Perusahaan sudah dilakukan?', ''),
(237, 'DSS01 - Manage Operations', 4, '4.2', 'Apakah menganalisis Hasil Pengukuran Proses dalam Mengelola Operasional Perusahaan sudah dilakukan?', ''),
(238, 'DSS01 - Manage Operations', 4, '4.2', 'Apakah mengidentifikasi Dan Implementasikan Tindakan Koreksi Untuk dalam Mengelola Operasional Perusahaan sudah dilakukan?', ''),
(239, 'DSS01 - Manage Operations', 4, '4.2', 'Apakah menetapkan Kembali Batasan Kontrol Setelah Tindakan Koreksi Pada dalam Mengelola Operasional Perusahaan sudah dilakukan?', ''),
(240, 'DSS01 - Manage Operations', 5, '5.1', 'Apakah mendefinisikan Tujuan Peningkatan Proses dalam Mengelola Operasional Perusahaan sudah dilakukan?', ''),
(241, 'DSS01 - Manage Operations', 5, '5.1', 'Apakah menganalisis Pengukuran Data Proses dalam Mengelola Operasional Perusahaan sudah dilakukan?', ''),
(242, 'DSS01 - Manage Operations', 5, '5.1', 'Apakah mengidentifikasi Peluang Peningkatan Proses dalam Mengelola Operasional Perusahaan sudah dilakukan?', ''),
(243, 'DSS01 - Manage Operations', 5, '5.1', 'Apakah meningkatkan Konsep Berdasarkan Peluang Peningkatan Proses dalam Mengelola Operasional Perusahaan sudah dijalankan?', ''),
(244, 'DSS01 - Manage Operations', 5, '5.1', 'Apakah Mendefinisikan Strategi Implementasi Konsep Baru dalam Mengelola Operasional Perusahaan sudah dilakukan?', ''),
(245, 'DSS01 - Manage Operations', 5, '5.2', 'Apakah Menilai Dampak Dari Perubahan dalam Mengelola Operasional Perusahaan sudah dilakukan?', ''),
(246, 'DSS01 - Manage Operations', 5, '5.2', 'Apakah Mengelola Implementasi Perubahan dalam Mengelola Operasional Perusahaan sudah dilakukan?', ''),
(247, 'DSS01 - Manage Operations', 5, '5.2', 'Apakah mengevaluasi Performa Implementasi Baru Terhadap dalam Mengelola Operasional Perusahaan sudah dijalankan?', ''),
(248, 'DSS05 - Manage Security Services', 1, '1.1', 'Apakah perusahaan memiliki dokumen skema klasifikasi masalah?', 'Skema klasifikasi masalah'),
(249, 'DSS05 - Manage Security Services', 1, '1.1', 'Apakah perusahaan memiliki dokumen laporan status masalah?', 'Laporan status masalah'),
(250, 'DSS05 - Manage Security Services', 1, '1.1', 'Apakah perusahaan memiliki dokumen daftar masalah?', 'Daftar masalah'),
(251, 'DSS05 - Manage Security Services', 1, '1.1', 'Apakah perusahaan memiliki dokumen akar penyebab masalah?', 'Akar penyebab masalah'),
(252, 'DSS05 - Manage Security Services', 1, '1.1', 'Apakah perusahaan memiliki dokumen laporan penyelesaian masalah?', 'Laporan penyelesaian masalah'),
(253, 'DSS05 - Manage Security Services', 1, '1.1', 'Apakah perusahaan memiliki dokumen catatan kesalahan yang diketahui?', 'Catatan kesalahan yang diketahui'),
(254, 'DSS05 - Manage Security Services', 1, '1.1', 'Apakah perusahaan memiliki dokumen solusi yang diusulkan oleh perusahaan untuk kesalahan yang diketahui?', 'Solusi yang diusulkan untuk kesalahan yang diketahui'),
(255, 'DSS05 - Manage Security Services', 1, '1.1', 'Apakah perusahaan memiliki dokumen catatan masalah tertutup?', 'Catatan masalah tertutup'),
(256, 'DSS05 - Manage Security Services', 1, '1.1', 'Apakah perusahaan memiliki dokumen komunikasi pengetahuan yang dipelajari?', 'Komunikasi pengetahuan yang dipelajari'),
(257, 'DSS05 - Manage Security Services', 1, '1.1', 'Apakah perusahaan memiliki dokumen laporan pemantauan penyelesaian masalah?', 'Laporan pemantauan penyelesaian masalah'),
(258, 'DSS05 - Manage Security Services', 1, '1.1', 'Apakah perusahaan memiliki dokumen solusi berkelanjutan yang teridentifikasi?', 'Solusi berkelanjutan yang teridentifikasi'),
(259, 'DSS05 - Manage Security Services', 2, '2.1', 'Apakah identifikasi tujuan dalam mengelola keamanan layanan dan produk perusahaan sudah dilakukan?', ''),
(260, 'DSS05 - Manage Security Services', 2, '2.1', 'Apakah rencana dalam mengelola keamanan layanan dan produk perusahaan sudah dijalankan?', ''),
(261, 'DSS05 - Manage Security Services', 2, '2.1', 'Apakah menyesuaikan dalam mengelola keamanan layanan dan produk perusahaan sudah dilakukan?', ''),
(262, 'DSS05 - Manage Security Services', 2, '2.1', 'Apakah tanggung jawab dalam mengelola keamanan layanan dan produk perusahaan sudah ditingkatkan?', ''),
(263, 'DSS05 - Manage Security Services', 2, '2.1', 'Apakah identifikasi dan Menyediakan dalam Mengelola Keamanan Layanan dan Produk Perusahaan sudah dilakukan?', ''),
(264, 'DSS05 - Manage Security Services', 2, '2.1', 'Apakah mengelola antarmuka dalam mengelola keamanan layanan dan produk perusahaan sudah dilakukan?', ''),
(265, 'DSS05 - Manage Security Services', 2, '2.2', 'Apakah kebutuhan yang diperlukan dalam mengelola keamanan layanan dan produk perusahaan sudah ditetapkan?', ''),
(266, 'DSS05 - Manage Security Services', 2, '2.2', 'Apakah kebutuhan yang diperlukan dari Dokumentasi, Dan Kontrol dalam mengelola keamanan layanan dan produk perusahaan sudah ditetapkan?', ''),
(267, 'DSS05 - Manage Security Services', 2, '2.2', 'Apakah identifikasi Dokumentasi, Dan Kontrol Hasil Kerja dalam mengelola keamanan layanan dan produk perusahaan sudah dilakukan?', ''),
(268, 'DSS05 - Manage Security Services', 2, '2.2', 'Apakah evaluasi dan penyesuaian hasil kerja dalam mengelola keamanan layanan dan produk perusahaan sudah dijalankan?', ''),
(269, 'DSS05 - Manage Security Services', 3, '3.1', 'Apakah standart dalam Mengelola Keamanan Layanan dan Produk Perusahaan sudah dilakukan?', ''),
(270, 'DSS05 - Manage Security Services', 3, '3.1', 'Apakah Menetapkan Urutan Dan Interaksi Antar Proses dalam Mengelola Keamanan Layanan dan Produk Perusahaan sudah dilakukan?', ''),
(271, 'DSS05 - Manage Security Services', 3, '3.1', 'Apakah identifikasi Peran Dan Kompetensi dalam Mengelola Keamanan Layanan dan Produk Perusahaan sudah dilakukan?', ''),
(272, 'DSS05 - Manage Security Services', 3, '3.1', 'Apakah identifikasi Infrastruktur Yang Dibutuhkan Oleh dalam Mengelola Keamanan Layanan dan Produk Perusahaan sudah dilakukan?', ''),
(273, 'DSS05 - Manage Security Services', 3, '3.1', 'Apakah identifikasi Peran Dan Kompetensi dalam Mengelola Keamanan Layanan dan Produk Perusahaan suah dilakukan?', ''),
(274, 'DSS05 - Manage Security Services', 3, '3.2', 'Apakah identifikasi Infrastruktur Yang Dibutuhkan Oleh dalam Mengelola Keamanan Layanan dan Produk Perusahaan sudah dilakukan?', ''),
(275, 'DSS05 - Manage Security Services', 3, '3.2', 'Apakah Peran, Tanggung Jawab Dan Otoritas dalam Mengelola Keamanan Layanan dan Produk Perusahaan sudah ditugaskan dan dikomunikasikan?', ''),
(276, 'DSS05 - Manage Security Services', 3, '3.2', 'Apakah kompetensi yang dibutuhkan untuk dalam Mengelola Keamanan Layanan dan Produk Perusahaan sudah dilakukan?', ''),
(277, 'DSS05 - Manage Security Services', 3, '3.2', 'Apakah penyediaan Sumber Daya Dan Informasi Untuk Mendukung dalam Mengelola Keamanan Layanan dan Produk Perusahaan sudah dilakukan?', ''),
(278, 'DSS05 - Manage Security Services', 3, '3.2', 'Apakah penyediaan Proses Infrastruktur Yang Layak Untuk dalam Mengelola Keamanan Layanan dan Produk Perusahaan sudah dilakukan?', ''),
(279, 'DSS05 - Manage Security Services', 3, '3.2', 'Apakah identifikasi Infrastruktur Yang Dibutuhkan Oleh dalam Mengelola Keamanan Layanan dan Produk Perusahaan sudah dijalankan?', ''),
(280, 'DSS05 - Manage Security Services', 4, '4.1', 'Apakah identifikasi Kebutuhan Informasi dalam Mengelola Keamanan Layanan dan Produk Perusahaan sudah dijalankan?', ''),
(281, 'DSS05 - Manage Security Services', 4, '4.1', 'Apakah tujuan Pengukuran Proses Dari dalam Mengelola Keamanan Layanan dan Produk Perusahaan sudah dilakukan?', ''),
(282, 'DSS05 - Manage Security Services', 4, '4.1', 'Apakah menetapkan Tujuan Kuantitatif Atas dalam Mengelola Keamanan Layanan dan Produk Perusahaan sudah dilakukan?', ''),
(283, 'DSS05 - Manage Security Services', 4, '4.1', 'Apakah identifikasi Pengukuran Produk Dan Proses dalam Mengelola Keamanan Layanan dan Produk Perusahaan sudah dilakukan?', ''),
(284, 'DSS05 - Manage Security Services', 4, '4.1', 'Apakah Hasil Pengukuran dalam Mengelola Keamanan Layanan dan Produk Perusahaan sudah dilakukan?', ''),
(285, 'DSS05 - Manage Security Services', 4, '4.2', 'Apakah Teknik Analisis Dan Kontrol dalam Mengelola Keamanan Layanan dan Produk Perusahaan sudah dilakukan?', ''),
(286, 'DSS05 - Manage Security Services', 4, '4.2', 'Apakah identifikasi Kebutuhan Informasi dalam Mengelola Keamanan Layanan dan Produk Perusahaan sudah dijalankan?', ''),
(287, 'DSS05 - Manage Security Services', 4, '4.2', 'Apakah menganalisis Hasil Pengukuran Proses dalam Mengelola Keamanan Layanan dan Produk Perusahaan sudah dilakukan?', ''),
(288, 'DSS05 - Manage Security Services', 4, '4.2', 'Apakah identifikasi Dan Implementasikan Tindakan Koreksi Untuk dalam Mengelola Keamanan Layanan dan Produk Perusahaan sudah dilakukan?', ''),
(289, 'DSS05 - Manage Security Services', 4, '4.2', 'Apakah menetapkan Kembali Batasan Kontrol Setelah Tindakan Koreksi Pada dalam Mengelola Keamanan Layanan dan Produk Perusahaan sudah dilakukan?', ''),
(290, 'DSS05 - Manage Security Services', 5, '5.1', 'Apakah definisi Tujuan Peningkatan Proses dalam Mengelola Keamanan Layanan dan Produk Perusahaan sudah dilakukan?', ''),
(291, 'DSS05 - Manage Security Services', 5, '5.1', 'Apakah identifikasi Peran Dan Kompetensi dalam Mengelola Keamanan Layanan dan Produk Perusahaan sudah dilakukan?', ''),
(292, 'DSS05 - Manage Security Services', 5, '5.1', 'Apakah identifikasi Peran Dan Kompetensi dalam Mengelola Keamanan Layanan dan Produk Perusahaan sudah dilakukan?', ''),
(293, 'DSS05 - Manage Security Services', 5, '5.1', 'Apakah Meningkatkan Konsep Berdasarkan Peluang Peningkatan Proses dalam Mengelola Keamanan Layanan dan Produk Perusahaan sudah dilakukan?', ''),
(294, 'DSS05 - Manage Security Services', 5, '5.1', 'Apakah Mendefinisikan Strategi Implementasi Konsep Baru dalam Mengelola Keamanan Layanan dan Produk Perusahaan sudah dilakukan?', ''),
(295, 'DSS05 - Manage Security Services', 5, '5.2', 'Apakah Menilai Dampak Dari Perubahan dalam Mengelola Keamanan Layanan dan Produk Perusahaan sudah dijalankan?', ''),
(296, 'DSS05 - Manage Security Services', 5, '5.2', 'Apakah Mengelola Implementasi Perubahan dalam Mengelola Keamanan Layanan dan Produk Perusahaan sudah dilakukan?', ''),
(297, 'DSS05 - Manage Security Services', 5, '5.2', 'Apakah evaluasi Performa Implementasi Baru Terhadap dalam Mengelola Keamanan Layanan dan Produk Perusahaan sudah dijalankan?', ''),
(298, 'DSS06 - Manage Business Process Controls', 1, '1.1', 'Apakah perusahaan memiliki dokumen hasil tinjauan efektivitas penerapan kontrol keamanan informasi dalam proses bisnis?', 'Hasil tinjauan efektivitas pemrosesan'),
(299, 'DSS06 - Manage Business Process Controls', 1, '1.1', 'Apakah perusahaan memiliki dokumen analisis dan rekomendasi terkait akar penyebab ketidakpatuhan atau kelemahan dalam kontrol keamanan informasi?', 'Analisis dan rekomendasi akar penyebab'),
(300, 'DSS06 - Manage Business Process Controls', 1, '1.1', 'Apakah perusahaan memiliki dokumen laporan tentang pemrosesan kontrol keamanan informasi dalam proses bisnis?', 'Memproses laporan kontrol'),
(301, 'DSS06 - Manage Business Process Controls', 1, '1.1', 'Apakah perusahaan memiliki dokumen yang mengalokasikan peran dan tanggung jawab dalam pengelolaan kontrol keamanan informasi?', 'Peran dan tanggung jawab yang dialokasikan'),
(302, 'DSS06 - Manage Business Process Controls', 1, '1.1', 'Apakah perusahaan memiliki dokumen yang mengalokasikan tingkat otoritas dalam penerapan kontrol keamanan informasi?', 'Tingkat otoritas yang dialokasikan'),
(303, 'DSS06 - Manage Business Process Controls', 1, '1.1', 'Apakah perusahaan memiliki dokumen yang mengalokasikan hak akses terkait kontrol keamanan informasi dalam proses bisnis?', 'Hak akses yang dialokasikan'),
(304, 'DSS06 - Manage Business Process Controls', 1, '1.1', 'Apakah perusahaan memiliki dokumen bukti koreksi dan perbaikan terhadap kontrol keamanan informasi yang tidak efektif?', 'Bukti koreksi kesalahan dan perbaikan'),
(305, 'DSS06 - Manage Business Process Controls', 1, '1.1', 'Apakah perusahaan memiliki dokumen laporan kesalahan dalam pengelolaan kontrol keamanan informasi beserta analisis akar penyebabnya?', 'Laporan kesalahan dan analisis akar penyebab');
INSERT INTO `question` (`id_question`, `process_code`, `level`, `pa`, `question`, `description`) VALUES
(306, 'DSS06 - Manage Business Process Controls', 1, '1.1', 'Apakah perusahaan memiliki dokumen yang menetapkan persyaratan retensi data terkait kontrol keamanan informasi?', 'Persyaratan retensi'),
(307, 'DSS06 - Manage Business Process Controls', 1, '1.1', 'Apakah perusahaan memiliki dokumen catatan transaksi yang mendokumentasikan penerapan kontrol keamanan informasi dalam setiap transaksi?', 'Catatan transaksi'),
(308, 'DSS06 - Manage Business Process Controls', 1, '1.1', 'Apakah perusahaan memiliki dokumen laporan pelanggaran terhadap kebijakan kontrol keamanan informasi dalam proses bisnis?', 'Laporan pelanggaran'),
(309, 'DSS06 - Manage Business Process Controls', 2, '2.1', 'Apakah tujuan dalam mengelola kontrol proses bisnis terkait keamanan informasi sudah diidentifikasi?', ''),
(310, 'DSS06 - Manage Business Process Controls', 2, '2.1', 'Apakah rencana pengelolaan kontrol proses bisnis terkait keamanan informasi sudah dibuat dan diimplementasikan?', ''),
(311, 'DSS06 - Manage Business Process Controls', 2, '2.1', 'Apakah penyesuaian dalam pengelolaan kontrol proses bisnis terkait keamanan informasi telah disesuaikan dengan kebutuhan organisasi?', ''),
(312, 'DSS06 - Manage Business Process Controls', 2, '2.1', 'Apakah tanggung jawab dalam mengelola kontrol proses bisnis terkait keamanan informasi sudah ditingkatkan?', ''),
(313, 'DSS06 - Manage Business Process Controls', 2, '2.1', 'Apakah identifikasi dan penyediaan sumber daya untuk mengelola kontrol proses bisnis terkait keamanan informasi sudah dilakukan?', ''),
(314, 'DSS06 - Manage Business Process Controls', 2, '2.1', 'Apakah antarmuka antar proses yang terkait dengan kontrol keamanan informasi sudah dikelola dengan baik?', ''),
(315, 'DSS06 - Manage Business Process Controls', 2, '2.2', 'Apakah kebutuhan yang diperlukan dalam mengelola kontrol proses bisnis terkait keamanan informasi sudah ditetapkan dengan jelas?', ''),
(316, 'DSS06 - Manage Business Process Controls', 2, '2.2', 'Apakah kebutuhan dokumentasi dan kontrol dalam pengelolaan kontrol proses bisnis terkait keamanan informasi sudah ditetapkan?', ''),
(317, 'DSS06 - Manage Business Process Controls', 2, '2.2', 'Apakah dokumentasi dan kontrol hasil kerja dalam pengelolaan kontrol proses bisnis terkait keamanan informasi sudah diterapkan?', ''),
(318, 'DSS06 - Manage Business Process Controls', 2, '2.2', 'Apakah evaluasi dan penyesuaian hasil kerja dalam pengelolaan kontrol proses bisnis terkait keamanan informasi sudah dilakukan?', ''),
(319, 'DSS06 - Manage Business Process Controls', 3, '3.1', 'Apakah standar pengelolaan kontrol proses bisnis terkait keamanan informasi sudah didefinisikan?', ''),
(320, 'DSS06 - Manage Business Process Controls', 3, '3.1', 'Apakah urutan dan interaksi antar proses dalam pengelolaan kontrol proses bisnis terkait keamanan informasi sudah ditetapkan?', ''),
(321, 'DSS06 - Manage Business Process Controls', 3, '3.1', 'Apakah peran dan kompetensi yang diperlukan dalam pengelolaan kontrol proses bisnis terkait keamanan informasi sudah diidentifikasi?', ''),
(322, 'DSS06 - Manage Business Process Controls', 3, '3.1', 'Apakah infrastruktur yang dibutuhkan dalam pengelolaan kontrol proses bisnis terkait keamanan informasi sudah diidentifikasi dan dipersiapkan?', ''),
(323, 'DSS06 - Manage Business Process Controls', 3, '3.1', 'Apakah proses pengelolaan kontrol proses bisnis terkait keamanan informasi sudah didefinisikan dengan jelas dan dijalankan?', ''),
(324, 'DSS06 - Manage Business Process Controls', 3, '3.2', 'Apakah peran, tanggung jawab, dan otoritas dalam mengelola kontrol proses bisnis terkait keamanan informasi sudah ditugaskan dan dikomunikasikan dengan efektif?', ''),
(325, 'DSS06 - Manage Business Process Controls', 3, '3.2', 'Apakah kompetensi yang diperlukan untuk mengelola kontrol proses bisnis terkait keamanan informasi sudah dipastikan?', ''),
(326, 'DSS06 - Manage Business Process Controls', 3, '3.2', 'Apakah sumber daya dan informasi untuk mendukung pengelolaan kontrol proses bisnis terkait keamanan informasi sudah disediakan?', ''),
(327, 'DSS06 - Manage Business Process Controls', 3, '3.2', 'Apakah infrastruktur yang layak untuk mendukung pengelolaan kontrol proses bisnis terkait keamanan informasi sudah dipersiapkan?', ''),
(328, 'DSS06 - Manage Business Process Controls', 3, '3.2', 'Apakah data mengenai pengelolaan kontrol proses bisnis terkait keamanan informasi sudah dikumpulkan dan dianalisis secara rutin?', ''),
(329, 'DSS06 - Manage Business Process Controls', 3, '3.2', 'Apakah kebutuhan informasi dalam pengelolaan kontrol proses bisnis terkait keamanan informasi sudah diidentifikasi dengan jelas?', ''),
(330, 'DSS06 - Manage Business Process Controls', 4, '4.1', 'Apakah tujuan pengukuran proses dalam pengelolaan kontrol proses bisnis terkait keamanan informasi sudah ditetapkan?', ''),
(331, 'DSS06 - Manage Business Process Controls', 4, '4.1', 'Apakah tujuan kuantitatif dalam pengelolaan kontrol proses bisnis terkait keamanan informasi sudah ditetapkan?', ''),
(332, 'DSS06 - Manage Business Process Controls', 4, '4.1', 'Apakah pengukuran produk dan proses dalam pengelolaan kontrol proses bisnis terkait keamanan informasi sudah diidentifikasi dan diterapkan?', ''),
(333, 'DSS06 - Manage Business Process Controls', 4, '4.1', 'Apakah hasil pengukuran dalam pengelolaan kontrol proses bisnis terkait keamanan informasi sudah dilakukan?', ''),
(334, 'DSS06 - Manage Business Process Controls', 4, '4.1', 'Apakah teknik analisis dan kontrol yang digunakan dalam pengelolaan kontrol proses bisnis terkait keamanan informasi sudah dijalankan dengan baik?', ''),
(335, 'DSS06 - Manage Business Process Controls', 4, '4.2', 'Apakah parameter standar dalam pengelolaan kontrol proses bisnis terkait keamanan informasi sudah ditetapkan dan diterapkan?', ''),
(336, 'DSS06 - Manage Business Process Controls', 4, '4.2', 'Apakah analisis hasil pengukuran proses dalam pengelolaan kontrol proses bisnis terkait keamanan informasi sudah dilakukan secara menyeluruh?', ''),
(337, 'DSS06 - Manage Business Process Controls', 4, '4.2', 'Apakah perusahaan telah mengidentifikasi dan mengimplementasikan tindakan koreksi untuk mengatasi kekurangan dalam pengelolaan kontrol proses bisnis terkait keamanan informasi?', ''),
(338, 'DSS06 - Manage Business Process Controls', 4, '4.2', 'Apakah perusahaan telah menetapkan kembali batasan kontrol setelah tindakan koreksi diterapkan dalam pengelolaan kontrol proses bisnis terkait keamanan informasi?', ''),
(339, 'DSS06 - Manage Business Process Controls', 4, '4.2', 'Apakah perusahaan telah mendefinisikan tujuan peningkatan proses dalam pengelolaan kontrol proses bisnis terkait keamanan informasi?', ''),
(340, 'DSS06 - Manage Business Process Controls', 5, '5.1', 'Apakah analisis data pengukuran proses dalam pengelolaan kontrol proses bisnis terkait keamanan informasi sudah dilakukan dengan baik?', ''),
(341, 'DSS06 - Manage Business Process Controls', 5, '5.1', 'Apakah peluang peningkatan proses dalam pengelolaan kontrol proses bisnis terkait keamanan informasi sudah diidentifikasi?', ''),
(342, 'DSS06 - Manage Business Process Controls', 5, '5.1', 'Apakah perusahaan telah meningkatkan konsep pengelolaan kontrol berdasarkan peluang peningkatan proses yang ditemukan?', ''),
(343, 'DSS06 - Manage Business Process Controls', 5, '5.1', 'Apakah strategi implementasi konsep baru dalam pengelolaan kontrol proses bisnis terkait keamanan informasi sudah didefinisikan?', ''),
(344, 'DSS06 - Manage Business Process Controls', 5, '5.1', 'Apakah dampak dari perubahan dalam pengelolaan kontrol proses bisnis terkait keamanan informasi sudah dinilai?', ''),
(345, 'DSS06 - Manage Business Process Controls', 5, '5.2', 'Apakah perusahaan telah mengelola implementasi perubahan dalam pengelolaan kontrol proses bisnis terkait keamanan informasi dengan efektif?', ''),
(346, 'DSS06 - Manage Business Process Controls', 5, '5.2', 'Apakah evaluasi performa implementasi perubahan terhadap pengelolaan kontrol proses bisnis terkait keamanan informasi sudah dilakukan?', ''),
(347, 'DSS06 - Manage Business Process Controls', 5, '5.2', 'Apakah mengevaluasi Performa Implementasi Baru Terhadap dalam Mengelola Kontrol Proses Bisnis sudah dijalankan?', ''),
(348, 'MEA01 - Monitor, Evaluate, and Assess Performance and Conformance', 1, '1.1', 'Apa saja persyaratan pemantauan yang diperlukan untuk memastikan kepatuhan terhadap kebijakan dan prosedur keamanan informasi?', 'Persyaratan pemantauan'),
(349, 'MEA01 - Monitor, Evaluate, and Assess Performance and Conformance', 1, '1.1', 'Apa sasaran dan metrik pemantauan yang disetujui untuk menilai kinerja dan kepatuhan terhadap kebijakan dan prosedur keamanan informasi?', 'Sasaran dan metrik pemantauan yang disetujui'),
(350, 'MEA01 - Monitor, Evaluate, and Assess Performance and Conformance', 1, '1.1', 'Apa target pemantauan yang telah ditetapkan untuk memastikan efektivitas kebijakan dan prosedur keamanan informasi?', 'Target pemantauan'),
(351, 'MEA01 - Monitor, Evaluate, and Assess Performance and Conformance', 1, '1.1', 'Bagaimana data pemantauan diproses untuk menilai kinerja dan kepatuhan terhadap kebijakan dan prosedur keamanan informasi?', 'Data pemantauan yang diproses'),
(352, 'MEA01 - Monitor, Evaluate, and Assess Performance and Conformance', 1, '1.1', 'Bagaimana laporan kinerja disusun untuk mengevaluasi keberhasilan implementasi kebijakan dan prosedur keamanan informasi?', 'Laporan kinerja'),
(353, 'MEA01 - Monitor, Evaluate, and Assess Performance and Conformance', 1, '1.1', 'Apa tindakan perbaikan dan penugasan yang dilakukan berdasarkan hasil pemantauan kinerja dan kepatuhan terhadap kebijakan dan prosedur keamanan informasi?', 'Tindakan perbaikan dan penugasan'),
(354, 'MEA01 - Monitor, Evaluate, and Assess Performance and Conformance', 1, '1.1', 'Apa status dan hasil tindakan yang diambil untuk meningkatkan kinerja dan kepatuhan terhadap kebijakan dan prosedur keamanan informasi?', 'Status dan hasil tindakan'),
(355, 'MEA01 - Monitor, Evaluate, and Assess Performance and Conformance', 2, '2.1', 'Apa tujuan yang diidentifikasi dalam memantau, mengevaluasi, dan menilai kinerja serta kepatuhan terhadap kebijakan dan prosedur keamanan informasi?', ''),
(356, 'MEA01 - Monitor, Evaluate, and Assess Performance and Conformance', 2, '2.1', 'Bagaimana proses perencanaan dilakukan dalam memantau, mengevaluasi, dan menilai kinerja serta kepatuhan terhadap kebijakan dan prosedur keamanan informasi?', ''),
(357, 'MEA01 - Monitor, Evaluate, and Assess Performance and Conformance', 2, '2.1', 'Bagaimana perusahaan menyesuaikan pemantauan, evaluasi, dan penilaian kinerja serta kepatuhan terhadap kebijakan dan prosedur keamanan informasi?', ''),
(358, 'MEA01 - Monitor, Evaluate, and Assess Performance and Conformance', 2, '2.1', 'Bagaimana tanggung jawab dalam pemantauan, evaluasi, dan penilaian kinerja serta kepatuhan terhadap kebijakan dan prosedur keamanan informasi didefinisikan?', ''),
(359, 'MEA01 - Monitor, Evaluate, and Assess Performance and Conformance', 2, '2.1', 'Apa yang perlu diidentifikasi dan disediakan dalam pemantauan, evaluasi, dan penilaian kinerja serta kepatuhan terhadap kebijakan dan prosedur keamanan informasi?', ''),
(360, 'MEA01 - Monitor, Evaluate, and Assess Performance and Conformance', 2, '2.1', 'Bagaimana perusahaan mengelola antarmuka dalam pemantauan, evaluasi, dan penilaian kinerja serta kepatuhan terhadap kebijakan dan prosedur keamanan informasi?', ''),
(361, 'MEA01 - Monitor, Evaluate, and Assess Performance and Conformance', 2, '2.2', 'Apa kebutuhan yang harus dipenuhi dalam memantau, mengevaluasi, dan menilai kinerja serta kepatuhan terhadap kebijakan dan prosedur keamanan informasi?', ''),
(362, 'MEA01 - Monitor, Evaluate, and Assess Performance and Conformance', 2, '2.2', 'Bagaimana perusahaan menetapkan kebutuhan dari dokumentasi dan kontrol yang diperlukan dalam pemantauan, evaluasi, dan penilaian kinerja serta kepatuhan terhadap kebijakan dan prosedur keamanan informasi?', ''),
(363, 'MEA01 - Monitor, Evaluate, and Assess Performance and Conformance', 2, '2.2', 'Apa dokumentasi dan kontrol hasil kerja yang perlu diidentifikasi dalam pemantauan, evaluasi, dan penilaian kinerja serta kepatuhan terhadap kebijakan dan prosedur keamanan informasi?', ''),
(364, 'MEA01 - Monitor, Evaluate, and Assess Performance and Conformance', 2, '2.2', 'Bagaimana perusahaan mengevaluasi dan menyesuaikan hasil kerja dalam pemantauan, evaluasi, dan penilaian kinerja serta kepatuhan terhadap kebijakan dan prosedur keamanan informasi?', ''),
(365, 'MEA01 - Monitor, Evaluate, and Assess Performance and Conformance', 3, '3.1', 'Apa standar yang harus ditetapkan dalam memantau, mengevaluasi, dan menilai kinerja serta kepatuhan terhadap kebijakan dan prosedur keamanan informasi?', ''),
(366, 'MEA01 - Monitor, Evaluate, and Assess Performance and Conformance', 3, '3.1', 'Bagaimana urutan dan interaksi antar proses ditetapkan dalam pemantauan, evaluasi, dan penilaian kinerja serta kepatuhan terhadap kebijakan dan prosedur keamanan informasi?', ''),
(367, 'MEA01 - Monitor, Evaluate, and Assess Performance and Conformance', 3, '3.1', 'Apa peran dan kompetensi yang perlu diidentifikasi dalam memantau, mengevaluasi, dan menilai kinerja serta kepatuhan terhadap kebijakan dan prosedur keamanan informasi?', ''),
(368, 'MEA01 - Monitor, Evaluate, and Assess Performance and Conformance', 3, '3.1', 'Infrastruktur apa yang dibutuhkan untuk mendukung pemantauan, evaluasi, dan penilaian kinerja serta kepatuhan terhadap kebijakan dan prosedur keamanan informasi?', ''),
(369, 'MEA01 - Monitor, Evaluate, and Assess Performance and Conformance', 3, '3.1', 'Apa metode yang sesuai digunakan dalam pemantauan, evaluasi, dan penilaian kinerja serta kepatuhan terhadap kebijakan dan prosedur keamanan informasi?', ''),
(370, 'MEA01 - Monitor, Evaluate, and Assess Performance and Conformance', 3, '3.2', 'Bagaimana perusahaan menjalankan proses yang telah didefinisikan dalam pemantauan, evaluasi, dan penilaian kinerja serta kepatuhan terhadap kebijakan dan prosedur keamanan informasi?', ''),
(371, 'MEA01 - Monitor, Evaluate, and Assess Performance and Conformance', 3, '3.2', 'Bagaimana perusahaan menugaskan dan mengomunikasikan peran, tanggung jawab, dan otoritas dalam pemantauan, evaluasi, dan penilaian kinerja serta kepatuhan terhadap kebijakan dan prosedur keamanan informasi?', ''),
(372, 'MEA01 - Monitor, Evaluate, and Assess Performance and Conformance', 3, '3.2', 'Bagaimana perusahaan memastikan kompetensi yang dibutuhkan untuk memantau, mengevaluasi, dan menilai kinerja serta kepatuhan terhadap kebijakan dan prosedur keamanan informasi?', ''),
(373, 'MEA01 - Monitor, Evaluate, and Assess Performance and Conformance', 3, '3.2', 'Apa sumber daya dan informasi yang disediakan untuk mendukung pemantauan, evaluasi, dan penilaian kinerja serta kepatuhan terhadap kebijakan dan prosedur keamanan informasi?', ''),
(374, 'MEA01 - Monitor, Evaluate, and Assess Performance and Conformance', 3, '3.2', 'Infrastruktur apa yang layak disediakan untuk mendukung pemantauan, evaluasi, dan penilaian kinerja serta kepatuhan terhadap kebijakan dan prosedur keamanan informasi?', ''),
(375, 'MEA01 - Monitor, Evaluate, and Assess Performance and Conformance', 3, '3.2', 'Bagaimana perusahaan mengumpulkan dan menganalisis data yang relevan dalam pemantauan, evaluasi, dan penilaian kinerja serta kepatuhan terhadap kebijakan dan prosedur keamanan informasi?', ''),
(376, 'MEA01 - Monitor, Evaluate, and Assess Performance and Conformance', 4, '4.1', 'Apa kebutuhan informasi yang harus diidentifikasi dalam pemantauan, evaluasi, dan penilaian kinerja serta kepatuhan terhadap kebijakan dan prosedur keamanan informasi?', ''),
(377, 'MEA01 - Monitor, Evaluate, and Assess Performance and Conformance', 4, '4.1', 'Apa tujuan pengukuran proses yang perlu dicapai dalam pemantauan, evaluasi, dan penilaian kinerja serta kepatuhan terhadap kebijakan dan prosedur keamanan informasi?', ''),
(378, 'MEA01 - Monitor, Evaluate, and Assess Performance and Conformance', 4, '4.1', 'Bagaimana perusahaan menetapkan tujuan kuantitatif dalam pemantauan, evaluasi, dan penilaian kinerja serta kepatuhan terhadap kebijakan dan prosedur keamanan informasi?', ''),
(379, 'MEA01 - Monitor, Evaluate, and Assess Performance and Conformance', 4, '4.1', 'Apa pengukuran produk dan proses yang perlu diidentifikasi dalam pemantauan, evaluasi, dan penilaian kinerja serta kepatuhan terhadap kebijakan dan prosedur keamanan informasi?', ''),
(380, 'MEA01 - Monitor, Evaluate, and Assess Performance and Conformance', 4, '4.1', 'Bagaimana perusahaan menggunakan hasil pengukuran untuk mengevaluasi dan menilai kinerja serta kepatuhan terhadap kebijakan dan prosedur keamanan informasi?', ''),
(381, 'MEA01 - Monitor, Evaluate, and Assess Performance and Conformance', 4, '4.2', 'Apa teknik analisis dan kontrol yang harus ditetapkan dalam pemantauan, evaluasi, dan penilaian kinerja serta kepatuhan terhadap kebijakan dan prosedur keamanan informasi?', ''),
(382, 'MEA01 - Monitor, Evaluate, and Assess Performance and Conformance', 4, '4.2', 'Apa parameter standar yang harus dipatuhi dalam pemantauan, evaluasi, dan penilaian kinerja serta kepatuhan terhadap kebijakan dan prosedur keamanan informasi?', ''),
(383, 'MEA01 - Monitor, Evaluate, and Assess Performance and Conformance', 4, '4.2', 'Bagaimana perusahaan menganalisis hasil pengukuran proses dalam pemantauan, evaluasi, dan penilaian kinerja serta kepatuhan terhadap kebijakan dan prosedur keamanan informasi?', ''),
(384, 'MEA01 - Monitor, Evaluate, and Assess Performance and Conformance', 4, '4.2', 'Bagaimana perusahaan mengidentifikasi dan menerapkan tindakan koreksi untuk perbaikan dalam pemantauan, evaluasi, dan penilaian kinerja serta kepatuhan terhadap kebijakan dan prosedur keamanan informasi?', ''),
(385, 'MEA01 - Monitor, Evaluate, and Assess Performance and Conformance', 4, '4.2', 'Bagaimana batasan kontrol ditetapkan kembali setelah tindakan koreksi dalam pemantauan, evaluasi, dan penilaian kinerja serta kepatuhan terhadap kebijakan dan prosedur keamanan informasi?', ''),
(386, 'MEA01 - Monitor, Evaluate, and Assess Performance and Conformance', 5, '5.1', 'Apa tujuan peningkatan proses yang perlu didefinisikan dalam pemantauan, evaluasi, dan penilaian kinerja serta kepatuhan terhadap kebijakan dan prosedur keamanan informasi?', ''),
(387, 'MEA01 - Monitor, Evaluate, and Assess Performance and Conformance', 5, '5.1', 'Bagaimana perusahaan menganalisis pengukuran data proses untuk meningkatkan kinerja dan kepatuhan terhadap kebijakan dan prosedur keamanan informasi?', ''),
(388, 'MEA01 - Monitor, Evaluate, and Assess Performance and Conformance', 5, '5.1', 'Apa peluang peningkatan proses yang dapat diidentifikasi dalam pemantauan, evaluasi, dan penilaian kinerja serta kepatuhan terhadap kebijakan dan prosedur keamanan informasi?', ''),
(389, 'MEA01 - Monitor, Evaluate, and Assess Performance and Conformance', 5, '5.1', 'Bagaimana perusahaan meningkatkan konsep berdasarkan peluang peningkatan dalam pemantauan, evaluasi, dan penilaian kinerja serta kepatuhan terhadap kebijakan dan prosedur keamanan informasi?', ''),
(390, 'MEA01 - Monitor, Evaluate, and Assess Performance and Conformance', 5, '5.1', 'Apa strategi implementasi konsep baru yang perlu didefinisikan dalam pemantauan, evaluasi, dan penilaian kinerja serta kepatuhan terhadap kebijakan dan prosedur keamanan informasi?', ''),
(391, 'MEA01 - Monitor, Evaluate, and Assess Performance and Conformance', 5, '5.2', 'Bagaimana perusahaan menilai dampak perubahan terhadap kinerja dan kepatuhan setelah perubahan kebijakan atau prosedur keamanan informasi dilakukan?', ''),
(392, 'MEA01 - Monitor, Evaluate, and Assess Performance and Conformance', 5, '5.2', 'Bagaimana perusahaan mengelola implementasi perubahan dalam pemantauan, evaluasi, dan penilaian kinerja serta kepatuhan terhadap kebijakan dan prosedur keamanan informasi?', ''),
(393, 'MEA01 - Monitor, Evaluate, and Assess Performance and Conformance', 5, '5.2', 'Bagaimana perusahaan mengevaluasi performa implementasi baru terkait kebijakan dan prosedur keamanan informasi setelah perubahan diterapkan?', ''),
(394, 'MEA02 - Monitor, Evaluate, and Assess the System of Internal Control', 1, '1.1', 'Apakah perusahaan memiliki dokumen hasil pemantauan dan review sistem pengendalian internal terkait kontrol keamanan informasi?', 'Hasil pemantauan dan review pengendalian internal'),
(395, 'MEA02 - Monitor, Evaluate, and Assess the System of Internal Control', 1, '1.1', 'Apakah perusahaan memiliki dokumen hasil benchmarking dan evaluasi sistem pengendalian internal terkait kontrol keamanan informasi?', 'Hasil benchmarking dan evaluasi lainnya'),
(396, 'MEA02 - Monitor, Evaluate, and Assess the System of Internal Control', 1, '1.1', 'Apakah perusahaan memiliki dokumen bukti efektivitas sistem pengendalian internal terkait kontrol keamanan informasi?', 'Bukti efektivitas pengendalian'),
(397, 'MEA02 - Monitor, Evaluate, and Assess the System of Internal Control', 1, '1.1', 'Apakah perusahaan memiliki dokumen rencana dan kriteria penilaian diri untuk pengendalian internal terkait kontrol keamanan informasi?', 'Rencana dan kriteria penilaian diri'),
(398, 'MEA02 - Monitor, Evaluate, and Assess the System of Internal Control', 1, '1.1', 'Apakah perusahaan memiliki dokumen hasil penilaian diri terhadap pengendalian internal yang mencakup kontrol keamanan informasi?', 'Hasil penilaian diri'),
(399, 'MEA02 - Monitor, Evaluate, and Assess the System of Internal Control', 1, '1.1', 'Apakah perusahaan memiliki dokumen hasil review penilaian diri terkait pengendalian internal dan kontrol keamanan informasi?', 'Hasil review penilaian diri'),
(400, 'MEA02 - Monitor, Evaluate, and Assess the System of Internal Control', 1, '1.1', 'Apakah perusahaan memiliki dokumen terkait kendala yang dihadapi dalam pengendalian kekurangan pengendalian internal yang mencakup kontrol keamanan informasi?', 'Kendalikan kekurangan'),
(401, 'MEA02 - Monitor, Evaluate, and Assess the System of Internal Control', 1, '1.1', 'Apakah perusahaan memiliki dokumen tindakan perbaikan terkait pengendalian internal yang mencakup kontrol keamanan informasi?', 'Tindakan perbaikan'),
(402, 'MEA02 - Monitor, Evaluate, and Assess the System of Internal Control', 1, '1.1', 'Apakah perusahaan memiliki dokumen hasil evaluasi penyedia assurance untuk pengendalian internal yang mencakup kontrol keamanan informasi?', 'Hasil evaluasi penyedia assurance'),
(403, 'MEA02 - Monitor, Evaluate, and Assess the System of Internal Control', 1, '1.1', 'Apakah perusahaan memiliki dokumen penilaian tingkat tinggi terhadap sistem pengendalian internal terkait kontrol keamanan informasi?', 'Penilaian tingkat tinggi'),
(404, 'MEA02 - Monitor, Evaluate, and Assess the System of Internal Control', 1, '1.1', 'Apakah perusahaan memiliki dokumen rencana jaminan untuk pengendalian internal yang mencakup kontrol keamanan informasi?', 'Rencana jaminan'),
(405, 'MEA02 - Monitor, Evaluate, and Assess the System of Internal Control', 1, '1.1', 'Apakah perusahaan memiliki dokumen kriteria penilaian untuk pengendalian internal terkait kontrol keamanan informasi?', 'Kriteria penilaian'),
(406, 'MEA02 - Monitor, Evaluate, and Assess the System of Internal Control', 1, '1.1', 'Apakah perusahaan memiliki dokumen lingkup tinjauan jaminan untuk pengendalian internal terkait kontrol keamanan informasi?', 'Lingkup tinjauan jaminan'),
(407, 'MEA02 - Monitor, Evaluate, and Assess the System of Internal Control', 1, '1.1', 'Apakah perusahaan memiliki dokumen rencana keterlibatan dalam pengendalian internal yang mencakup kontrol keamanan informasi?', 'Rencana keterlibatan'),
(408, 'MEA02 - Monitor, Evaluate, and Assess the System of Internal Control', 1, '1.1', 'Apakah perusahaan memiliki dokumen praktik tinjauan jaminan terkait pengendalian internal yang mencakup kontrol keamanan informasi?', 'Praktik tinjauan jaminan'),
(409, 'MEA02 - Monitor, Evaluate, and Assess the System of Internal Control', 1, '1.1', 'Apakah perusahaan memiliki dokumen cakupan halus dalam tinjauan jaminan terkait pengendalian internal yang mencakup kontrol keamanan informasi?', 'Cakupan halus'),
(410, 'MEA02 - Monitor, Evaluate, and Assess the System of Internal Control', 1, '1.1', 'Apakah perusahaan memiliki dokumen hasil tinjauan jaminan terkait pengendalian internal yang mencakup kontrol keamanan informasi?', 'Hasil tinjauan jaminan'),
(411, 'MEA02 - Monitor, Evaluate, and Assess the System of Internal Control', 1, '1.1', 'Apakah perusahaan memiliki dokumen laporan tinjauan jaminan terkait pengendalian internal yang mencakup kontrol keamanan informasi?', 'Laporan tinjauan jaminan'),
(412, 'MEA02 - Monitor, Evaluate, and Assess the System of Internal Control', 2, '2.1', 'Apakah tujuan pemantauan, evaluasi, dan penilaian sistem pengendalian internal terkait kontrol keamanan informasi sudah diidentifikasi?', ''),
(413, 'MEA02 - Monitor, Evaluate, and Assess the System of Internal Control', 2, '2.1', 'Apakah rencana pemantauan, evaluasi, dan penilaian sistem pengendalian internal terkait kontrol keamanan informasi sudah disusun?', ''),
(414, 'MEA02 - Monitor, Evaluate, and Assess the System of Internal Control', 2, '2.1', 'Apakah penyesuaian dalam memantau, mengevaluasi, dan menilai sistem pengendalian internal terkait kontrol keamanan informasi sudah disesuaikan dengan kebutuhan organisasi?', ''),
(415, 'MEA02 - Monitor, Evaluate, and Assess the System of Internal Control', 2, '2.1', 'Apakah tanggung jawab dalam memantau, mengevaluasi, dan menilai sistem pengendalian internal terkait kontrol keamanan informasi sudah ditingkatkan?', ''),
(416, 'MEA02 - Monitor, Evaluate, and Assess the System of Internal Control', 2, '2.1', 'Apakah identifikasi dan penyediaan dalam memantau, mengevaluasi, dan menilai sistem pengendalian internal terkait kontrol keamanan informasi sudah dilakukan?', ''),
(417, 'MEA02 - Monitor, Evaluate, and Assess the System of Internal Control', 2, '2.1', 'Apakah pengelolaan antarmuka dalam memantau, mengevaluasi, dan menilai sistem pengendalian internal terkait kontrol keamanan informasi sudah dilakukan?', ''),
(418, 'MEA02 - Monitor, Evaluate, and Assess the System of Internal Control', 2, '2.2', 'Apakah kebutuhan yang diperlukan dalam memantau, mengevaluasi, dan menilai sistem pengendalian internal terkait kontrol keamanan informasi sudah ditetapkan?', ''),
(419, 'MEA02 - Monitor, Evaluate, and Assess the System of Internal Control', 2, '2.2', 'Apakah kebutuhan yang diperlukan dari dokumentasi dan kontrol dalam memantau, mengevaluasi, dan menilai sistem pengendalian internal terkait kontrol keamanan informasi sudah ditetapkan?', ''),
(420, 'MEA02 - Monitor, Evaluate, and Assess the System of Internal Control', 2, '2.2', 'Apakah identifikasi dokumentasi dan kontrol hasil kerja dalam memantau, mengevaluasi, dan menilai sistem pengendalian internal terkait kontrol keamanan informasi sudah dilakukan?', ''),
(421, 'MEA02 - Monitor, Evaluate, and Assess the System of Internal Control', 2, '2.2', 'Apakah evaluasi dan penyesuaian hasil kerja dalam memantau, mengevaluasi, dan menilai sistem pengendalian internal terkait kontrol keamanan informasi sudah dijalankan?', ''),
(422, 'MEA02 - Monitor, Evaluate, and Assess the System of Internal Control', 3, '3.1', 'Apakah perusahaan telah mendefinisikan standar dalam memantau, mengevaluasi, dan menilai sistem pengendalian internal terkait kontrol keamanan informasi?', ''),
(423, 'MEA02 - Monitor, Evaluate, and Assess the System of Internal Control', 3, '3.1', 'Apakah penetapan urutan dan interaksi antar proses dalam memantau, mengevaluasi, dan menilai sistem pengendalian internal terkait kontrol keamanan informasi sudah dilakukan?', ''),
(424, 'MEA02 - Monitor, Evaluate, and Assess the System of Internal Control', 3, '3.1', 'Apakah identifikasi peran dan kompetensi dalam memantau, mengevaluasi, dan menilai sistem pengendalian internal terkait kontrol keamanan informasi sudah dilakukan?', ''),
(425, 'MEA02 - Monitor, Evaluate, and Assess the System of Internal Control', 3, '3.1', 'Apakah identifikasi infrastruktur yang dibutuhkan dalam memantau, mengevaluasi, dan menilai sistem pengendalian internal terkait kontrol keamanan informasi sudah dilakukan?', ''),
(426, 'MEA02 - Monitor, Evaluate, and Assess the System of Internal Control', 3, '3.1', 'Apakah penetapan metode yang sesuai dalam memantau, mengevaluasi, dan menilai sistem pengendalian internal terkait kontrol keamanan informasi sudah dilakukan?', ''),
(427, 'MEA02 - Monitor, Evaluate, and Assess the System of Internal Control', 3, '3.2', 'Apakah proses yang telah didefinisikan dalam memantau, mengevaluasi, dan menilai sistem pengendalian internal terkait kontrol keamanan informasi sudah dijalankan?', ''),
(428, 'MEA02 - Monitor, Evaluate, and Assess the System of Internal Control', 3, '3.2', 'Apakah peran, tanggung jawab, dan otoritas dalam memantau, mengevaluasi, dan menilai sistem pengendalian internal terkait kontrol keamanan informasi sudah ditugaskan dan dikomunikasikan?', ''),
(429, 'MEA02 - Monitor, Evaluate, and Assess the System of Internal Control', 3, '3.2', 'Apakah kompetensi yang dibutuhkan dalam memantau, mengevaluasi, dan menilai sistem pengendalian internal terkait kontrol keamanan informasi sudah dipastikan?', ''),
(430, 'MEA02 - Monitor, Evaluate, and Assess the System of Internal Control', 3, '3.2', 'Apakah penyediaan sumber daya dan informasi untuk mendukung pemantauan, evaluasi, dan penilaian sistem pengendalian internal terkait kontrol keamanan informasi sudah dilakukan?', ''),
(431, 'MEA02 - Monitor, Evaluate, and Assess the System of Internal Control', 3, '3.2', 'Apakah penyediaan proses infrastruktur yang layak untuk pemantauan, evaluasi, dan penilaian sistem pengendalian internal terkait kontrol keamanan informasi sudah dilakukan?', ''),
(432, 'MEA02 - Monitor, Evaluate, and Assess the System of Internal Control', 3, '3.2', 'Apakah data mengenai pemantauan, evaluasi, dan penilaian sistem pengendalian internal terkait kontrol keamanan informasi sudah dikumpulkan dan dianalisis?', ''),
(433, 'MEA02 - Monitor, Evaluate, and Assess the System of Internal Control', 4, '4.1', 'Apakah identifikasi kebutuhan informasi dalam memantau, mengevaluasi, dan menilai sistem pengendalian internal terkait kontrol keamanan informasi sudah dilakukan?', ''),
(434, 'MEA02 - Monitor, Evaluate, and Assess the System of Internal Control', 4, '4.1', 'Apakah tujuan pengukuran proses dalam memantau, mengevaluasi, dan menilai sistem pengendalian internal terkait kontrol keamanan informasi sudah dilakukan?', ''),
(435, 'MEA02 - Monitor, Evaluate, and Assess the System of Internal Control', 4, '4.1', 'Apakah penetapan tujuan kuantitatif atas pemantauan, evaluasi, dan penilaian sistem pengendalian internal terkait kontrol keamanan informasi sudah dilakukan?', ''),
(436, 'MEA02 - Monitor, Evaluate, and Assess the System of Internal Control', 4, '4.1', 'Apakah identifikasi pengukuran produk dan proses dalam memantau, mengevaluasi, dan menilai sistem pengendalian internal terkait kontrol keamanan informasi sudah dilakukan?', ''),
(437, 'MEA02 - Monitor, Evaluate, and Assess the System of Internal Control', 4, '4.1', 'Apakah hasil pengukuran dalam memantau, mengevaluasi, dan menilai sistem pengendalian internal terkait kontrol keamanan informasi sudah dijalankan?', ''),
(438, 'MEA02 - Monitor, Evaluate, and Assess the System of Internal Control', 4, '4.2', 'Apakah teknik analisis dan kontrol dalam memantau, mengevaluasi, dan menilai sistem pengendalian internal terkait kontrol keamanan informasi sudah dilakukan?', ''),
(439, 'MEA02 - Monitor, Evaluate, and Assess the System of Internal Control', 4, '4.2', 'Apakah penetapan parameter standar dalam memantau, mengevaluasi, dan menilai sistem pengendalian internal terkait kontrol keamanan informasi sudah dilakukan?', ''),
(440, 'MEA02 - Monitor, Evaluate, and Assess the System of Internal Control', 4, '4.2', 'Apakah hasil pengukuran proses dalam memantau, mengevaluasi, dan menilai sistem pengendalian internal terkait kontrol keamanan informasi sudah dilakukan?', ''),
(441, 'MEA02 - Monitor, Evaluate, and Assess the System of Internal Control', 4, '4.2', 'Apakah identifikasi dan implementasi tindakan koreksi untuk memantau, mengevaluasi, dan menilai sistem pengendalian internal terkait kontrol keamanan informasi sudah dilakukan?', ''),
(442, 'MEA02 - Monitor, Evaluate, and Assess the System of Internal Control', 4, '4.2', 'Apakah penetapan kembali batasan kontrol setelah tindakan koreksi dalam memantau, mengevaluasi, dan menilai sistem pengendalian internal terkait kontrol keamanan informasi sudah dilakukan?', ''),
(443, 'MEA02 - Monitor, Evaluate, and Assess the System of Internal Control', 5, '5.1', 'Apakah definisi tujuan peningkatan proses dalam memantau, mengevaluasi, dan menilai sistem pengendalian internal terkait kontrol keamanan informasi sudah dilakukan?', ''),
(444, 'MEA02 - Monitor, Evaluate, and Assess the System of Internal Control', 5, '5.1', 'Apakah pengukuran data proses dalam memantau, mengevaluasi, dan menilai sistem pengendalian internal terkait kontrol keamanan informasi sudah dianalisis?', ''),
(445, 'MEA02 - Monitor, Evaluate, and Assess the System of Internal Control', 5, '5.1', 'Apakah identifikasi peluang peningkatan proses dalam memantau, mengevaluasi, dan menilai sistem pengendalian internal terkait kontrol keamanan informasi sudah dijalankan?', ''),
(446, 'MEA02 - Monitor, Evaluate, and Assess the System of Internal Control', 5, '5.1', 'Apakah peningkatan konsep berdasarkan peluang peningkatan proses dalam memantau, mengevaluasi, dan menilai sistem pengendalian internal terkait kontrol keamanan informasi sudah dilakukan?', ''),
(447, 'MEA02 - Monitor, Evaluate, and Assess the System of Internal Control', 5, '5.1', 'Apakah definisi strategi implementasi konsep baru dalam memantau, mengevaluasi, dan menilai sistem pengendalian internal terkait kontrol keamanan informasi sudah dilakukan?', ''),
(448, 'MEA02 - Monitor, Evaluate, and Assess the System of Internal Control', 5, '5.2', 'Apakah penilaian dampak dari perubahan dalam memantau, mengevaluasi, dan menilai sistem pengendalian internal terkait kontrol keamanan informasi sudah dilakukan?', ''),
(449, 'MEA02 - Monitor, Evaluate, and Assess the System of Internal Control', 5, '5.2', 'Apakah pengelolaan implementasi perubahan dalam memantau, mengevaluasi, dan menilai sistem pengendalian internal terkait kontrol keamanan informasi sudah dilakukan?', ''),
(450, 'MEA02 - Monitor, Evaluate, and Assess the System of Internal Control', 5, '5.2', 'Apakah evaluasi performa implementasi baru terhadap pemantauan, evaluasi, dan penilaian sistem pengendalian internal terkait kontrol keamanan informasi sudah dijalankan?', ''),
(451, 'MEA03 - Monitor, Evaluate, and Assess Compliance with External Requirements', 1, '1.1', 'Apakah perusahaan memiliki dokumen daftar persyaratan kepatuhan hukum, peraturan, dan standar keamanan informasi yang relevan?', 'Daftar persyaratan kepatuhan'),
(452, 'MEA03 - Monitor, Evaluate, and Assess Compliance with External Requirements', 1, '1.1', 'Apakah perusahaan memiliki dokumen log tindakan yang diperlukan untuk memastikan kepatuhan terhadap persyaratan eksternal?', 'Log tindakan kepatuhan yang diperlukan'),
(453, 'MEA03 - Monitor, Evaluate, and Assess Compliance with External Requirements', 1, '1.1', 'Apakah perusahaan memiliki dokumen kebijakan, prinsip, prosedur, dan standar yang telah diperbarui terkait dengan kepatuhan terhadap persyaratan eksternal?', 'Kebijakan, prinsip, prosedur, dan standar yang diperbarui'),
(454, 'MEA03 - Monitor, Evaluate, and Assess Compliance with External Requirements', 1, '1.1', 'Apakah perusahaan memiliki dokumen komunikasi mengenai perubahan persyaratan kepatuhan eksternal yang harus diikuti?', 'Komunikasi persyaratan kepatuhan yang diubah'),
(455, 'MEA03 - Monitor, Evaluate, and Assess Compliance with External Requirements', 1, '1.1', 'Apakah perusahaan memiliki dokumen yang mengidentifikasi kesenjangan dalam kepatuhan terhadap hukum dan peraturan yang berlaku?', 'Kesenjangan kepatuhan yang teridentifikasi'),
(456, 'MEA03 - Monitor, Evaluate, and Assess Compliance with External Requirements', 1, '1.1', 'Apakah perusahaan memiliki dokumen yang mengonfirmasi kepatuhan terhadap persyaratan eksternal yang relevan?', 'Konfirmasi kepatuhan'),
(457, 'MEA03 - Monitor, Evaluate, and Assess Compliance with External Requirements', 1, '1.1', 'Apakah perusahaan memiliki dokumen laporan jaminan yang membuktikan kepatuhan terhadap hukum, peraturan, dan standar keamanan?', 'Laporan jaminan kepatuhan'),
(458, 'MEA03 - Monitor, Evaluate, and Assess Compliance with External Requirements', 1, '1.1', 'Apakah perusahaan memiliki dokumen laporan masalah ketidakpatuhan dan analisis akar penyebabnya?', 'Laporan masalah ketidakpatuhan dan akar penyebab'),
(459, 'MEA03 - Monitor, Evaluate, and Assess Compliance with External Requirements', 2, '2.1', 'Apakah tujuan dalam memantau, mengevaluasi, dan menilai kepatuhan terhadap persyaratan eksternal telah diidentifikasi?', ''),
(460, 'MEA03 - Monitor, Evaluate, and Assess Compliance with External Requirements', 2, '2.1', 'Apakah rencana untuk memantau, mengevaluasi, dan menilai kepatuhan terhadap persyaratan eksternal sudah dibuat dan diimplementasikan?', ''),
(461, 'MEA03 - Monitor, Evaluate, and Assess Compliance with External Requirements', 2, '2.1', 'Apakah perusahaan telah menyesuaikan proses pemantauan dan penilaian kepatuhan eksternal dengan kebutuhan organisasi yang berkembang?', ''),
(462, 'MEA03 - Monitor, Evaluate, and Assess Compliance with External Requirements', 2, '2.1', 'Apakah tanggung jawab dalam memantau, mengevaluasi, dan menilai kepatuhan terhadap persyaratan eksternal telah ditingkatkan?', ''),
(463, 'MEA03 - Monitor, Evaluate, and Assess Compliance with External Requirements', 2, '2.1', 'Apakah identifikasi dan penyediaan sumber daya untuk memantau, mengevaluasi, dan menilai kepatuhan terhadap persyaratan eksternal sudah dilakukan?', ''),
(464, 'MEA03 - Monitor, Evaluate, and Assess Compliance with External Requirements', 2, '2.1', 'Apakah perusahaan telah mengelola antarmuka antar proses yang berhubungan dengan kepatuhan terhadap persyaratan eksternal?', ''),
(465, 'MEA03 - Monitor, Evaluate, and Assess Compliance with External Requirements', 2, '2.2', 'Apakah kebutuhan yang diperlukan untuk memantau, mengevaluasi, dan menilai kepatuhan terhadap persyaratan eksternal sudah ditetapkan dengan jelas?', ''),
(466, 'MEA03 - Monitor, Evaluate, and Assess Compliance with External Requirements', 2, '2.2', 'Apakah perusahaan telah menetapkan kebutuhan dokumentasi dan kontrol terkait dengan kepatuhan terhadap persyaratan eksternal?', ''),
(467, 'MEA03 - Monitor, Evaluate, and Assess Compliance with External Requirements', 2, '2.2', 'Apakah dokumentasi dan kontrol hasil kerja dalam memantau, mengevaluasi, dan menilai kepatuhan telah diidentifikasi?', ''),
(468, 'MEA03 - Monitor, Evaluate, and Assess Compliance with External Requirements', 2, '2.2', 'Apakah evaluasi dan penyesuaian hasil kerja dalam memastikan kepatuhan terhadap persyaratan eksternal sudah dilakukan?', ''),
(469, 'MEA03 - Monitor, Evaluate, and Assess Compliance with External Requirements', 3, '3.1', 'Apakah perusahaan telah mendefinisikan standar dalam memantau, mengevaluasi, dan menilai kepatuhan terhadap persyaratan eksternal?', ''),
(470, 'MEA03 - Monitor, Evaluate, and Assess Compliance with External Requirements', 3, '3.1', 'Apakah urutan dan interaksi antar proses dalam memantau kepatuhan terhadap persyaratan eksternal sudah ditetapkan dan diimplementasikan?', ''),
(471, 'MEA03 - Monitor, Evaluate, and Assess Compliance with External Requirements', 3, '3.1', 'Apakah identifikasi peran dan kompetensi yang diperlukan dalam pemantauan kepatuhan eksternal sudah dilakukan?', ''),
(472, 'MEA03 - Monitor, Evaluate, and Assess Compliance with External Requirements', 3, '3.1', 'Apakah perusahaan telah mengidentifikasi infrastruktur yang diperlukan untuk mendukung pemantauan dan penilaian kepatuhan eksternal?', ''),
(473, 'MEA03 - Monitor, Evaluate, and Assess Compliance with External Requirements', 3, '3.1', 'Apakah metode yang sesuai untuk memantau, mengevaluasi, dan menilai kepatuhan terhadap persyaratan eksternal sudah ditetapkan?', ''),
(474, 'MEA03 - Monitor, Evaluate, and Assess Compliance with External Requirements', 3, '3.2', 'Apakah proses pemantauan dan evaluasi kepatuhan terhadap persyaratan eksternal sudah didefinisikan dengan jelas?', ''),
(475, 'MEA03 - Monitor, Evaluate, and Assess Compliance with External Requirements', 3, '3.2', 'Apakah peran, tanggung jawab, dan otoritas dalam memantau dan menilai kepatuhan terhadap persyaratan eksternal sudah ditugaskan dan dikomunikasikan dengan baik?', ''),
(476, 'MEA03 - Monitor, Evaluate, and Assess Compliance with External Requirements', 3, '3.2', 'Apakah kompetensi yang diperlukan untuk memastikan kepatuhan terhadap persyaratan eksternal sudah dipastikan?', ''),
(477, 'MEA03 - Monitor, Evaluate, and Assess Compliance with External Requirements', 3, '3.2', 'Apakah sumber daya dan informasi yang diperlukan untuk mendukung kepatuhan terhadap persyaratan eksternal sudah disediakan?', ''),
(478, 'MEA03 - Monitor, Evaluate, and Assess Compliance with External Requirements', 3, '3.2', 'Apakah infrastruktur yang memadai untuk mendukung pemantauan kepatuhan terhadap persyaratan eksternal sudah disiapkan?', ''),
(479, 'MEA03 - Monitor, Evaluate, and Assess Compliance with External Requirements', 3, '3.2', 'Apakah data mengenai kepatuhan terhadap persyaratan eksternal sudah dikumpulkan dan dianalisis secara rutin?', ''),
(480, 'MEA03 - Monitor, Evaluate, and Assess Compliance with External Requirements', 4, '4.1', 'Apakah identifikasi kebutuhan informasi dalam memantau kepatuhan terhadap persyaratan eksternal sudah dilakukan dengan tepat?', ''),
(481, 'MEA03 - Monitor, Evaluate, and Assess Compliance with External Requirements', 4, '4.1', 'Apakah tujuan pengukuran proses kepatuhan terhadap persyaratan eksternal sudah ditetapkan?', ''),
(482, 'MEA03 - Monitor, Evaluate, and Assess Compliance with External Requirements', 4, '4.1', 'Apakah perusahaan telah menetapkan tujuan kuantitatif dalam memantau kepatuhan terhadap persyaratan eksternal?', ''),
(483, 'MEA03 - Monitor, Evaluate, and Assess Compliance with External Requirements', 4, '4.1', 'Apakah pengukuran produk dan proses yang terkait dengan kepatuhan terhadap persyaratan eksternal sudah diidentifikasi dengan jelas?', ''),
(484, 'MEA03 - Monitor, Evaluate, and Assess Compliance with External Requirements', 4, '4.1', 'Apakah hasil pengukuran dalam memantau kepatuhan terhadap persyaratan eksternal sudah dilakukan dan dianalisis?', ''),
(485, 'MEA03 - Monitor, Evaluate, and Assess Compliance with External Requirements', 4, '4.2', 'Apakah teknik analisis dan kontrol yang diperlukan untuk memastikan kepatuhan terhadap persyaratan eksternal sudah diterapkan?', ''),
(486, 'MEA03 - Monitor, Evaluate, and Assess Compliance with External Requirements', 4, '4.2', 'Apakah parameter standar dalam memantau kepatuhan terhadap persyaratan eksternal sudah ditetapkan dengan jelas?', ''),
(487, 'MEA03 - Monitor, Evaluate, and Assess Compliance with External Requirements', 4, '4.2', 'Apakah hasil pengukuran proses dalam memantau kepatuhan terhadap persyaratan eksternal sudah dievaluasi secara berkala?', ''),
(488, 'MEA03 - Monitor, Evaluate, and Assess Compliance with External Requirements', 4, '4.2', 'Apakah perusahaan telah mengidentifikasi dan mengimplementasikan tindakan koreksi untuk mengatasi ketidakpatuhan terhadap persyaratan eksternal?', ''),
(489, 'MEA03 - Monitor, Evaluate, and Assess Compliance with External Requirements', 4, '4.2', 'Apakah perusahaan telah menetapkan kembali batasan kontrol setelah tindakan koreksi diterapkan pada sistem kepatuhan eksternal?', ''),
(490, 'MEA03 - Monitor, Evaluate, and Assess Compliance with External Requirements', 5, '5.1', 'Apakah tujuan peningkatan proses dalam memantau kepatuhan terhadap persyaratan eksternal sudah didefinisikan dengan jelas?', ''),
(491, 'MEA03 - Monitor, Evaluate, and Assess Compliance with External Requirements', 5, '5.1', 'Apakah data pengukuran proses dalam memantau kepatuhan terhadap persyaratan eksternal sudah dianalisis secara menyeluruh?', ''),
(492, 'MEA03 - Monitor, Evaluate, and Assess Compliance with External Requirements', 5, '5.1', 'Apakah peluang peningkatan proses untuk memastikan kepatuhan terhadap persyaratan eksternal sudah diidentifikasi?', ''),
(493, 'MEA03 - Monitor, Evaluate, and Assess Compliance with External Requirements', 5, '5.1', 'Apakah perusahaan telah meningkatkan konsep pemantauan berdasarkan peluang peningkatan proses yang ditemukan?', ''),
(494, 'MEA03 - Monitor, Evaluate, and Assess Compliance with External Requirements', 5, '5.1', 'Apakah strategi implementasi konsep baru dalam memastikan kepatuhan terhadap persyaratan eksternal sudah didefinisikan?', ''),
(495, 'MEA03 - Monitor, Evaluate, and Assess Compliance with External Requirements', 5, '5.2', 'Apakah dampak dari perubahan dalam memantau dan menilai kepatuhan terhadap persyaratan eksternal sudah dinilai secara menyeluruh?', ''),
(496, 'MEA03 - Monitor, Evaluate, and Assess Compliance with External Requirements', 5, '5.2', 'Apakah perusahaan telah mengelola implementasi perubahan yang berhubungan dengan kepatuhan terhadap persyaratan eksternal dengan baik?', ''),
(497, 'MEA03 - Monitor, Evaluate, and Assess Compliance with External Requirements', 5, '5.2', 'Apakah evaluasi kinerja implementasi baru terhadap kepatuhan terhadap persyaratan eksternal sudah dilakukan?', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_users` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_users`, `nama`, `email`, `password`, `role`) VALUES
(1, 'admin', 'admin@gmail.com', '0192023a7bbd73250516f069df18b500', 'admin'),
(2, 'auditor', 'auditor@gmail.com', '5cb59fe845b83231b0e5aa95d96267e9', 'auditor');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `audit`
--
ALTER TABLE `audit`
  ADD PRIMARY KEY (`id_audit`);

--
-- Indexes for table `cobit`
--
ALTER TABLE `cobit`
  ADD PRIMARY KEY (`id_cobit`);

--
-- Indexes for table `pa_table`
--
ALTER TABLE `pa_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengujian`
--
ALTER TABLE `pengujian`
  ADD PRIMARY KEY (`id_pengujian`);

--
-- Indexes for table `perspektif`
--
ALTER TABLE `perspektif`
  ADD PRIMARY KEY (`id_perspektif`);

--
-- Indexes for table `question`
--
ALTER TABLE `question`
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
-- AUTO_INCREMENT for table `audit`
--
ALTER TABLE `audit`
  MODIFY `id_audit` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cobit`
--
ALTER TABLE `cobit`
  MODIFY `id_cobit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `pa_table`
--
ALTER TABLE `pa_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `pengujian`
--
ALTER TABLE `pengujian`
  MODIFY `id_pengujian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `perspektif`
--
ALTER TABLE `perspektif`
  MODIFY `id_perspektif` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `question`
--
ALTER TABLE `question`
  MODIFY `id_question` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=498;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_users` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
