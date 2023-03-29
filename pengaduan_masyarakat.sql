-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 29, 2023 at 09:16 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pengaduan_masyarakat`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `UserWhereId` (IN `id` INT)   SELECT * FROM users WHERE users.id=id LIMIT 1$$

--
-- Functions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `jumlahLaporanDi` (`bulan` INT(11), `tahun` INT(11)) RETURNS VARCHAR(100) CHARSET utf8mb4 COLLATE utf8mb4_general_ci  BEGIN DECLARE jumlah INT; IF(bulan > 0 AND bulan < 13) THEN IF(bulan < 10) THEN SELECT count(id) INTO jumlah FROM laporan WHERE laporan.created_at BETWEEN CONCAT(tahun, "-0", bulan, "-01") AND LAST_DAY(CONCAT(tahun, "-0", bulan, "-01")) AND laporan.deleted_at IS NULL; ELSE SELECT count(id) INTO jumlah FROM laporan WHERE laporan.created_at BETWEEN CONCAT(tahun, "-", bulan, "-01") AND LAST_DAY(CONCAT(tahun, "-", bulan, "-01")) AND laporan.deleted_at IS NULL; END IF; RETURN CONCAT(jumlah); ELSE RETURN "Invalid month"; END IF; END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `jumlahLaporanDiWithStatus` (`bulan` INT(11), `tahun` INT(11), `status` VARCHAR(50)) RETURNS VARCHAR(100) CHARSET utf8mb4 COLLATE utf8mb4_general_ci  BEGIN DECLARE jumlah INT; 
IF(bulan > 0 AND bulan < 13) 
    THEN IF(bulan < 10) THEN SELECT count(id) INTO jumlah FROM laporan WHERE laporan.created_at BETWEEN CONCAT(tahun, "-0", bulan, "-01") AND LAST_DAY(CONCAT(tahun, "-0", bulan, "-01")) AND laporan.deleted_at IS NULL AND laporan.status=status; 
    ELSE SELECT count(id) INTO jumlah FROM laporan WHERE laporan.created_at BETWEEN CONCAT(tahun, "-", bulan, "-01") AND LAST_DAY(CONCAT(tahun, "-", bulan, "-01")) AND laporan.deleted_at IS NULL AND laporan.status=status; END IF; 
    RETURN CONCAT(jumlah); ELSE RETURN "Invalid month"; END IF; END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `laporan`
--

CREATE TABLE `laporan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `judul` varchar(50) NOT NULL,
  `tanggal_kejadian` date NOT NULL,
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `isi` text NOT NULL,
  `foto` varchar(255) NOT NULL,
  `status` enum('0','process','selesai','tolak') NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `laporan`
--

INSERT INTO `laporan` (`id`, `judul`, `tanggal_kejadian`, `id_user`, `isi`, `foto`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Penipuan Online', '2023-03-27', 40, '<div class=\"p\"><em>Yth. Petugas Laporin</em></div>\r\n<div class=\"p\"><em>Di Bandung, Jawa Barat</em></div>\r\n<div class=\"p\"><em>Hal: Laporan Penipuan Online</em></div>\r\n<div class=\"p\"><em>Lampiran: 1 (satu) halaman</em></div>\r\n<div class=\"p\"><em>Dengan hormat,</em></div>\r\n<div class=\"p\"><em>Saya yang bertanda tangan di bawah ini:</em></div>\r\n<div class=\"p\"><em>Nama : Conrad Carey</em></div>\r\n<div class=\"p\"><em>NIK : 5872053880264022</em></div>\r\n<div class=\"p\"><em>Alamat Email: conradcarey@gmail.com</em></div>\r\n<div class=\"p\"><em>Saudara Risma telah melakukan tindakan penipuan berupa penjualan barang secara online melalui Instagram senial Rp. 5.000.000,-. Barang yang diterima tidak sesuai pesanan, cacat dan tidak original. Pihak penjual menjanjikan untuk mengembalikan uang dalam waktu seminggu. Akan tetapi, uang tersebut belum juga dikembalikan hingga saat ini, terhitung 3 minggu dari barang diterima.</em></div>\r\n<div class=\"p\"><em>Pihak yang bersangkutan belum menunjukkan itikad baik mengembalikan uang tersebut.</em></div>\r\n<div class=\"p\"><em>Sebagai bukti, saya lampirkan nota pembelian barang dengan bukti chat kepada penjual. Di mana chat tersebut menjelaskan bahwa penjual akan mengembalikan uang paling lambat satu minggu setelah barang diterima.</em></div>\r\n<div class=\"p\"><em>Demikian pengaduan ini saya buat. Besar harapan saya agar pihak kepolisian dapat menyelesaikan perkara ini hingga tuntas. Atas perhatiannya, saya ucapkan terima kasih.</em></div>\r\n<div class=\"p\"><em>Bandung, 2023-03-27</em></div>\r\n<div class=\"p\"><em>Hormat saya,</em></div>\r\n<div class=\"p\"><em>Conrad Carey</em></div>\r\n<div class=\"p\"><em>Pelapor</em></div>', 'default.png', 'selesai', '2023-01-26 19:23:56', '2023-03-26 20:36:31', NULL),
(2, 'Penipuan Online', '2023-03-27', 41, '<div class=\"p\"><em>Yth. Petugas Laporin</em></div>\r\n<div class=\"p\"><em>Di Bandung, Jawa Barat</em></div>\r\n<div class=\"p\"><em>Hal: Laporan Penipuan Online</em></div>\r\n<div class=\"p\"><em>Lampiran: 1 (satu) halaman</em></div>\r\n<div class=\"p\"><em>Dengan hormat,</em></div>\r\n<div class=\"p\"><em>Saya yang bertanda tangan di bawah ini:</em></div>\r\n<div class=\"p\"><em>Nama : Aiden Mcmahon</em></div>\r\n<div class=\"p\"><em>NIK : 8717813291526196</em></div>\r\n<div class=\"p\"><em>Alamat Email: aidenmcmahon@gmail.com</em></div>\r\n<div class=\"p\"><em>Saudara Risma telah melakukan tindakan penipuan berupa penjualan barang secara online melalui Instagram senial Rp. 5.000.000,-. Barang yang diterima tidak sesuai pesanan, cacat dan tidak original. Pihak penjual menjanjikan untuk mengembalikan uang dalam waktu seminggu. Akan tetapi, uang tersebut belum juga dikembalikan hingga saat ini, terhitung 3 minggu dari barang diterima.</em></div>\r\n<div class=\"p\"><em>Pihak yang bersangkutan belum menunjukkan itikad baik mengembalikan uang tersebut.</em></div>\r\n<div class=\"p\"><em>Sebagai bukti, saya lampirkan nota pembelian barang dengan bukti chat kepada penjual. Di mana chat tersebut menjelaskan bahwa penjual akan mengembalikan uang paling lambat satu minggu setelah barang diterima.</em></div>\r\n<div class=\"p\"><em>Demikian pengaduan ini saya buat. Besar harapan saya agar pihak kepolisian dapat menyelesaikan perkara ini hingga tuntas. Atas perhatiannya, saya ucapkan terima kasih.</em></div>\r\n<div class=\"p\"><em>Bandung, 2023-03-27</em></div>\r\n<div class=\"p\"><em>Hormat saya,</em></div>\r\n<div class=\"p\"><em>Aiden Mcmahon</em></div>\r\n<div class=\"p\"><em>Pelapor</em></div>', 'default.png', 'tolak', '2023-03-26 19:23:57', '2023-03-26 20:44:04', NULL),
(3, 'Penipuan Online', '2023-03-27', 42, '<div class=\"p\"><em>Yth. Petugas Laporin</em></div>\r\n<div class=\"p\"><em>Di Bandung, Jawa Barat</em></div>\r\n<div class=\"p\"><em>Hal: Laporan Penipuan Online</em></div>\r\n<div class=\"p\"><em>Lampiran: 1 (satu) halaman</em></div>\r\n<div class=\"p\"><em>Dengan hormat,</em></div>\r\n<div class=\"p\"><em>Saya yang bertanda tangan di bawah ini:</em></div>\r\n<div class=\"p\"><em>Nama : Malik Wolf</em></div>\r\n<div class=\"p\"><em>NIK : 7545706016707264</em></div>\r\n<div class=\"p\"><em>Alamat Email: malikwolf@gmail.com</em></div>\r\n<div class=\"p\"><em>Saudara Risma telah melakukan tindakan penipuan berupa penjualan barang secara online melalui Instagram senial Rp. 5.000.000,-. Barang yang diterima tidak sesuai pesanan, cacat dan tidak original. Pihak penjual menjanjikan untuk mengembalikan uang dalam waktu seminggu. Akan tetapi, uang tersebut belum juga dikembalikan hingga saat ini, terhitung 3 minggu dari barang diterima.</em></div>\r\n<div class=\"p\"><em>Pihak yang bersangkutan belum menunjukkan itikad baik mengembalikan uang tersebut.</em></div>\r\n<div class=\"p\"><em>Sebagai bukti, saya lampirkan nota pembelian barang dengan bukti chat kepada penjual. Di mana chat tersebut menjelaskan bahwa penjual akan mengembalikan uang paling lambat satu minggu setelah barang diterima.</em></div>\r\n<div class=\"p\"><em>Demikian pengaduan ini saya buat. Besar harapan saya agar pihak kepolisian dapat menyelesaikan perkara ini hingga tuntas. Atas perhatiannya, saya ucapkan terima kasih.</em></div>\r\n<div class=\"p\"><em>Bandung, 2023-03-27</em></div>\r\n<div class=\"p\"><em>Hormat saya,</em></div>\r\n<div class=\"p\"><em>Malik Wolf</em></div>\r\n<div class=\"p\"><em>Pelapor</em></div>', 'default.png', '0', '2023-03-26 19:23:57', NULL, NULL),
(4, 'Penipuan Online', '2023-03-27', 43, '<div class=\"p\"><em>Yth. Petugas Laporin</em></div>\r\n<div class=\"p\"><em>Di Bandung, Jawa Barat</em></div>\r\n<div class=\"p\"><em>Hal: Laporan Penipuan Online</em></div>\r\n<div class=\"p\"><em>Lampiran: 1 (satu) halaman</em></div>\r\n<div class=\"p\"><em>Dengan hormat,</em></div>\r\n<div class=\"p\"><em>Saya yang bertanda tangan di bawah ini:</em></div>\r\n<div class=\"p\"><em>Nama : Izayah Steele</em></div>\r\n<div class=\"p\"><em>NIK : 3344792559385269</em></div>\r\n<div class=\"p\"><em>Alamat Email: izayahsteele@gmail.com</em></div>\r\n<div class=\"p\"><em>Saudara Risma telah melakukan tindakan penipuan berupa penjualan barang secara online melalui Instagram senial Rp. 5.000.000,-. Barang yang diterima tidak sesuai pesanan, cacat dan tidak original. Pihak penjual menjanjikan untuk mengembalikan uang dalam waktu seminggu. Akan tetapi, uang tersebut belum juga dikembalikan hingga saat ini, terhitung 3 minggu dari barang diterima.</em></div>\r\n<div class=\"p\"><em>Pihak yang bersangkutan belum menunjukkan itikad baik mengembalikan uang tersebut.</em></div>\r\n<div class=\"p\"><em>Sebagai bukti, saya lampirkan nota pembelian barang dengan bukti chat kepada penjual. Di mana chat tersebut menjelaskan bahwa penjual akan mengembalikan uang paling lambat satu minggu setelah barang diterima.</em></div>\r\n<div class=\"p\"><em>Demikian pengaduan ini saya buat. Besar harapan saya agar pihak kepolisian dapat menyelesaikan perkara ini hingga tuntas. Atas perhatiannya, saya ucapkan terima kasih.</em></div>\r\n<div class=\"p\"><em>Bandung, 2023-03-27</em></div>\r\n<div class=\"p\"><em>Hormat saya,</em></div>\r\n<div class=\"p\"><em>Izayah Steele</em></div>\r\n<div class=\"p\"><em>Pelapor</em></div>', 'default.png', 'tolak', '2023-02-26 19:23:59', '2023-03-26 20:44:17', NULL),
(5, 'Penipuan Online', '2023-03-27', 44, '<div class=\"p\"><em>Yth. Petugas Laporin</em></div>\r\n<div class=\"p\"><em>Di Bandung, Jawa Barat</em></div>\r\n<div class=\"p\"><em>Hal: Laporan Penipuan Online</em></div>\r\n<div class=\"p\"><em>Lampiran: 1 (satu) halaman</em></div>\r\n<div class=\"p\"><em>Dengan hormat,</em></div>\r\n<div class=\"p\"><em>Saya yang bertanda tangan di bawah ini:</em></div>\r\n<div class=\"p\"><em>Nama : Jax Gillespie</em></div>\r\n<div class=\"p\"><em>NIK : 9264051583212996</em></div>\r\n<div class=\"p\"><em>Alamat Email: jaxgillespie@gmail.com</em></div>\r\n<div class=\"p\"><em>Saudara Risma telah melakukan tindakan penipuan berupa penjualan barang secara online melalui Instagram senial Rp. 5.000.000,-. Barang yang diterima tidak sesuai pesanan, cacat dan tidak original. Pihak penjual menjanjikan untuk mengembalikan uang dalam waktu seminggu. Akan tetapi, uang tersebut belum juga dikembalikan hingga saat ini, terhitung 3 minggu dari barang diterima.</em></div>\r\n<div class=\"p\"><em>Pihak yang bersangkutan belum menunjukkan itikad baik mengembalikan uang tersebut.</em></div>\r\n<div class=\"p\"><em>Sebagai bukti, saya lampirkan nota pembelian barang dengan bukti chat kepada penjual. Di mana chat tersebut menjelaskan bahwa penjual akan mengembalikan uang paling lambat satu minggu setelah barang diterima.</em></div>\r\n<div class=\"p\"><em>Demikian pengaduan ini saya buat. Besar harapan saya agar pihak kepolisian dapat menyelesaikan perkara ini hingga tuntas. Atas perhatiannya, saya ucapkan terima kasih.</em></div>\r\n<div class=\"p\"><em>Bandung, 2023-03-27</em></div>\r\n<div class=\"p\"><em>Hormat saya,</em></div>\r\n<div class=\"p\"><em>Jax Gillespie</em></div>\r\n<div class=\"p\"><em>Pelapor</em></div>', 'default.png', '0', '2023-03-26 19:23:59', NULL, NULL),
(6, 'Penipuan Online', '2023-03-27', 45, '<div class=\"p\"><em>Yth. Petugas Laporin</em></div>\r\n<div class=\"p\"><em>Di Bandung, Jawa Barat</em></div>\r\n<div class=\"p\"><em>Hal: Laporan Penipuan Online</em></div>\r\n<div class=\"p\"><em>Lampiran: 1 (satu) halaman</em></div>\r\n<div class=\"p\"><em>Dengan hormat,</em></div>\r\n<div class=\"p\"><em>Saya yang bertanda tangan di bawah ini:</em></div>\r\n<div class=\"p\"><em>Nama : Taniya Horton</em></div>\r\n<div class=\"p\"><em>NIK : 6706478183322959</em></div>\r\n<div class=\"p\"><em>Alamat Email: taniyahorton@gmail.com</em></div>\r\n<div class=\"p\"><em>Saudara Risma telah melakukan tindakan penipuan berupa penjualan barang secara online melalui Instagram senial Rp. 5.000.000,-. Barang yang diterima tidak sesuai pesanan, cacat dan tidak original. Pihak penjual menjanjikan untuk mengembalikan uang dalam waktu seminggu. Akan tetapi, uang tersebut belum juga dikembalikan hingga saat ini, terhitung 3 minggu dari barang diterima.</em></div>\r\n<div class=\"p\"><em>Pihak yang bersangkutan belum menunjukkan itikad baik mengembalikan uang tersebut.</em></div>\r\n<div class=\"p\"><em>Sebagai bukti, saya lampirkan nota pembelian barang dengan bukti chat kepada penjual. Di mana chat tersebut menjelaskan bahwa penjual akan mengembalikan uang paling lambat satu minggu setelah barang diterima.</em></div>\r\n<div class=\"p\"><em>Demikian pengaduan ini saya buat. Besar harapan saya agar pihak kepolisian dapat menyelesaikan perkara ini hingga tuntas. Atas perhatiannya, saya ucapkan terima kasih.</em></div>\r\n<div class=\"p\"><em>Bandung, 2023-03-27</em></div>\r\n<div class=\"p\"><em>Hormat saya,</em></div>\r\n<div class=\"p\"><em>Taniya Horton</em></div>\r\n<div class=\"p\"><em>Pelapor</em></div>', 'default.png', 'process', '2023-03-26 19:23:59', '2023-03-26 23:02:36', NULL),
(7, 'Penipuan Online', '2023-03-27', 46, '<div class=\"p\"><em>Yth. Petugas Laporin</em></div>\r\n<div class=\"p\"><em>Di Bandung, Jawa Barat</em></div>\r\n<div class=\"p\"><em>Hal: Laporan Penipuan Online</em></div>\r\n<div class=\"p\"><em>Lampiran: 1 (satu) halaman</em></div>\r\n<div class=\"p\"><em>Dengan hormat,</em></div>\r\n<div class=\"p\"><em>Saya yang bertanda tangan di bawah ini:</em></div>\r\n<div class=\"p\"><em>Nama : Kamari Frost</em></div>\r\n<div class=\"p\"><em>NIK : 2423741569832421</em></div>\r\n<div class=\"p\"><em>Alamat Email: kamarifrost@gmail.com</em></div>\r\n<div class=\"p\"><em>Saudara Risma telah melakukan tindakan penipuan berupa penjualan barang secara online melalui Instagram senial Rp. 5.000.000,-. Barang yang diterima tidak sesuai pesanan, cacat dan tidak original. Pihak penjual menjanjikan untuk mengembalikan uang dalam waktu seminggu. Akan tetapi, uang tersebut belum juga dikembalikan hingga saat ini, terhitung 3 minggu dari barang diterima.</em></div>\r\n<div class=\"p\"><em>Pihak yang bersangkutan belum menunjukkan itikad baik mengembalikan uang tersebut.</em></div>\r\n<div class=\"p\"><em>Sebagai bukti, saya lampirkan nota pembelian barang dengan bukti chat kepada penjual. Di mana chat tersebut menjelaskan bahwa penjual akan mengembalikan uang paling lambat satu minggu setelah barang diterima.</em></div>\r\n<div class=\"p\"><em>Demikian pengaduan ini saya buat. Besar harapan saya agar pihak kepolisian dapat menyelesaikan perkara ini hingga tuntas. Atas perhatiannya, saya ucapkan terima kasih.</em></div>\r\n<div class=\"p\"><em>Bandung, 2023-03-27</em></div>\r\n<div class=\"p\"><em>Hormat saya,</em></div>\r\n<div class=\"p\"><em>Kamari Frost</em></div>\r\n<div class=\"p\"><em>Pelapor</em></div>', 'default.png', '0', '2023-03-26 19:23:59', NULL, NULL),
(8, 'Penipuan Online', '2023-03-27', 47, '<div class=\"p\"><em>Yth. Petugas Laporin</em></div>\r\n<div class=\"p\"><em>Di Bandung, Jawa Barat</em></div>\r\n<div class=\"p\"><em>Hal: Laporan Penipuan Online</em></div>\r\n<div class=\"p\"><em>Lampiran: 1 (satu) halaman</em></div>\r\n<div class=\"p\"><em>Dengan hormat,</em></div>\r\n<div class=\"p\"><em>Saya yang bertanda tangan di bawah ini:</em></div>\r\n<div class=\"p\"><em>Nama : Skylar Delacruz</em></div>\r\n<div class=\"p\"><em>NIK : 2769411531656391</em></div>\r\n<div class=\"p\"><em>Alamat Email: skylardelacruz@gmail.com</em></div>\r\n<div class=\"p\"><em>Saudara Risma telah melakukan tindakan penipuan berupa penjualan barang secara online melalui Instagram senial Rp. 5.000.000,-. Barang yang diterima tidak sesuai pesanan, cacat dan tidak original. Pihak penjual menjanjikan untuk mengembalikan uang dalam waktu seminggu. Akan tetapi, uang tersebut belum juga dikembalikan hingga saat ini, terhitung 3 minggu dari barang diterima.</em></div>\r\n<div class=\"p\"><em>Pihak yang bersangkutan belum menunjukkan itikad baik mengembalikan uang tersebut.</em></div>\r\n<div class=\"p\"><em>Sebagai bukti, saya lampirkan nota pembelian barang dengan bukti chat kepada penjual. Di mana chat tersebut menjelaskan bahwa penjual akan mengembalikan uang paling lambat satu minggu setelah barang diterima.</em></div>\r\n<div class=\"p\"><em>Demikian pengaduan ini saya buat. Besar harapan saya agar pihak kepolisian dapat menyelesaikan perkara ini hingga tuntas. Atas perhatiannya, saya ucapkan terima kasih.</em></div>\r\n<div class=\"p\"><em>Bandung, 2023-03-27</em></div>\r\n<div class=\"p\"><em>Hormat saya,</em></div>\r\n<div class=\"p\"><em>Skylar Delacruz</em></div>\r\n<div class=\"p\"><em>Pelapor</em></div>', 'default.png', '0', '2023-03-26 19:24:00', NULL, NULL),
(9, 'Penipuan Online', '2023-03-27', 48, '<div class=\"p\"><em>Yth. Petugas Laporin</em></div>\r\n<div class=\"p\"><em>Di Bandung, Jawa Barat</em></div>\r\n<div class=\"p\"><em>Hal: Laporan Penipuan Online</em></div>\r\n<div class=\"p\"><em>Lampiran: 1 (satu) halaman</em></div>\r\n<div class=\"p\"><em>Dengan hormat,</em></div>\r\n<div class=\"p\"><em>Saya yang bertanda tangan di bawah ini:</em></div>\r\n<div class=\"p\"><em>Nama : Moises Key</em></div>\r\n<div class=\"p\"><em>NIK : 2164212078049641</em></div>\r\n<div class=\"p\"><em>Alamat Email: moiseskey@gmail.com</em></div>\r\n<div class=\"p\"><em>Saudara Risma telah melakukan tindakan penipuan berupa penjualan barang secara online melalui Instagram senial Rp. 5.000.000,-. Barang yang diterima tidak sesuai pesanan, cacat dan tidak original. Pihak penjual menjanjikan untuk mengembalikan uang dalam waktu seminggu. Akan tetapi, uang tersebut belum juga dikembalikan hingga saat ini, terhitung 3 minggu dari barang diterima.</em></div>\r\n<div class=\"p\"><em>Pihak yang bersangkutan belum menunjukkan itikad baik mengembalikan uang tersebut.</em></div>\r\n<div class=\"p\"><em>Sebagai bukti, saya lampirkan nota pembelian barang dengan bukti chat kepada penjual. Di mana chat tersebut menjelaskan bahwa penjual akan mengembalikan uang paling lambat satu minggu setelah barang diterima.</em></div>\r\n<div class=\"p\"><em>Demikian pengaduan ini saya buat. Besar harapan saya agar pihak kepolisian dapat menyelesaikan perkara ini hingga tuntas. Atas perhatiannya, saya ucapkan terima kasih.</em></div>\r\n<div class=\"p\"><em>Bandung, 2023-03-27</em></div>\r\n<div class=\"p\"><em>Hormat saya,</em></div>\r\n<div class=\"p\"><em>Moises Key</em></div>\r\n<div class=\"p\"><em>Pelapor</em></div>', 'default.png', 'selesai', '2023-01-26 19:24:00', '2023-03-27 00:13:03', NULL),
(10, 'Penipuan Online', '2023-03-27', 49, '<div class=\"p\"><em>Yth. Petugas Laporin</em></div>\r\n<div class=\"p\"><em>Di Bandung, Jawa Barat</em></div>\r\n<div class=\"p\"><em>Hal: Laporan Penipuan Online</em></div>\r\n<div class=\"p\"><em>Lampiran: 1 (satu) halaman</em></div>\r\n<div class=\"p\"><em>Dengan hormat,</em></div>\r\n<div class=\"p\"><em>Saya yang bertanda tangan di bawah ini:</em></div>\r\n<div class=\"p\"><em>Nama : Heaven Vargas</em></div>\r\n<div class=\"p\"><em>NIK : 4523185947697234</em></div>\r\n<div class=\"p\"><em>Alamat Email: heavenvargas@gmail.com</em></div>\r\n<div class=\"p\"><em>Saudara Risma telah melakukan tindakan penipuan berupa penjualan barang secara online melalui Instagram senial Rp. 5.000.000,-. Barang yang diterima tidak sesuai pesanan, cacat dan tidak original. Pihak penjual menjanjikan untuk mengembalikan uang dalam waktu seminggu. Akan tetapi, uang tersebut belum juga dikembalikan hingga saat ini, terhitung 3 minggu dari barang diterima.</em></div>\r\n<div class=\"p\"><em>Pihak yang bersangkutan belum menunjukkan itikad baik mengembalikan uang tersebut.</em></div>\r\n<div class=\"p\"><em>Sebagai bukti, saya lampirkan nota pembelian barang dengan bukti chat kepada penjual. Di mana chat tersebut menjelaskan bahwa penjual akan mengembalikan uang paling lambat satu minggu setelah barang diterima.</em></div>\r\n<div class=\"p\"><em>Demikian pengaduan ini saya buat. Besar harapan saya agar pihak kepolisian dapat menyelesaikan perkara ini hingga tuntas. Atas perhatiannya, saya ucapkan terima kasih.</em></div>\r\n<div class=\"p\"><em>Bandung, 2023-03-27</em></div>\r\n<div class=\"p\"><em>Hormat saya,</em></div>\r\n<div class=\"p\"><em>Heaven Vargas</em></div>\r\n<div class=\"p\"><em>Pelapor</em></div>', 'default.png', 'selesai', '2023-03-26 19:24:01', '2023-03-27 00:12:58', NULL),
(11, 'Poison Waves', '2023-03-28', 49, '<p>Southern Pole</p>', '49230328023021.PNG', 'process', '2023-03-27 19:30:22', '2023-03-27 19:32:42', NULL),
(12, 'Arsil Nipu', '2023-02-28', 49, '<p>Arsil Congratulations menipu saya</p>', '49230328053817.jpg', 'tolak', '2023-03-27 22:38:17', '2023-03-27 22:39:17', NULL),
(13, 'Cuaca Extremee', '2023-03-28', 49, '<div>\r\n<div>\r\n<div>\r\n<div>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dignissimos officiis quo neque at cumque, eligendi incidunt consectetur. Repellendus enim harum fuga fugit sint dicta esse itaque dolore exercitationem, quasi saepe repellat quos minus, numquam pariatur voluptatibus veritatis suscipit maxime ullam. Omnis, provident sed consequuntur fugiat maxime officia laborum maiores impedit dolorum consectetur ipsum, iusto quo vel molestiae at, excepturi numquam assumenda odio odit? Neque, nesciunt natus. Suscipit saepe optio voluptas tenetur voluptatem a ullam architecto odio blanditiis rem aliquam explicabo nesciunt fuga soluta eveniet ab quo eius harum itaque, non dignissimos numquam aut. Ullam consequatur repellat, itaque illo ab iure harum tempora eum natus quos repellendus rerum nostrum quia esse autem aperiam. Cupiditate numquam ad quasi voluptatum nostrum soluta, qui beatae. Perferendis reiciendis quisquam iure odio ratione? Sit dolorum illo beatae id quo. Ipsa tempora consequuntur earum! Aut harum quia ipsum modi magni rerum, eveniet amet enim alias ut hic.</div>\r\n</div>\r\n</div>\r\n</div>', '49230328064520.jpg', 'selesai', '2023-03-27 23:45:21', '2023-03-27 23:50:15', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_100000_create_password_resets_table', 1),
(2, '2019_08_19_000000_create_failed_jobs_table', 1),
(3, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(4, '2023_02_14_065104_create_role_table', 1),
(5, '2023_02_14_065548_create_users_table', 1),
(6, '2023_02_14_065652_create_laporan_table', 1),
(7, '2023_02_14_065735_create_tanggapan_table', 1),
(8, '2023_03_07_011344_add_deleted_at_to_laporan_table', 1),
(9, '2023_03_09_052832_add_deleted_at_to_tanggapan', 1),
(10, '2023_03_14_040201_add_trigger', 1),
(11, '2023_03_16_054147_create_logs_table', 1),
(12, '2023_03_21_075202_add_jumlah_laporan_di_function', 1),
(13, '2023_03_26_084239_add_user_where_id_procedure', 1),
(14, '2023_03_27_031455_add_jumlah_laporan_di_with_status_function', 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'User', NULL, NULL),
(2, 'Petugas', NULL, NULL),
(3, 'Admin', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tanggapan`
--

CREATE TABLE `tanggapan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_laporan` bigint(20) UNSIGNED NOT NULL,
  `tanggapan` text NOT NULL,
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tanggapan`
--

INSERT INTO `tanggapan` (`id`, `id_laporan`, `tanggapan`, `id_user`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 10, 'Halo kami dari tim', 2, '2023-03-26 21:29:29', '2023-03-26 21:29:29', NULL),
(2, 11, 'Malas, kami ubah dulu ke diproses', 2, '2023-03-27 19:31:47', '2023-03-27 19:31:47', NULL),
(3, 11, 'Proses telah diubah menjadi dalam proses', 2, '2023-03-27 22:34:54', '2023-03-27 22:34:54', NULL),
(4, 12, 'Mana ada arsil nipu', 4, '2023-03-27 22:39:08', '2023-03-27 22:39:08', NULL),
(5, 12, 'Status laporan ini kami ubah menjadi ditolak karena tidak valid dan tidak sesuai fakta.', 3, '2023-03-27 22:46:58', '2023-03-27 22:46:58', NULL),
(6, 13, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dignissimos officiis quo neque at cumque, eligendi incidunt consectetur. Repellendus enim harum fuga fugit sint dicta esse itaque dolore exercitationem, quasi saepe repellat quos minus, numquam pariatur voluptatibus veritatis suscipit maxime ullam. Omnis, provident sed consequuntur fugiat maxime officia laborum maiores impedit dolorum consectetur ipsum, iusto quo vel molestiae at, excepturi numquam assumenda odio odit? Neque, nesciunt natus. Suscipit saepe optio voluptas tenetur voluptatem a ullam architecto odio blanditiis rem aliquam explicabo nesciunt fuga soluta eveniet ab quo eius harum itaque, non dignissimos numquam aut. Ullam consequatur repellat, itaque illo ab iure harum tempora eum natus quos repellendus rerum nostrum quia esse autem aperiam. Cupiditate numquam ad quasi voluptatum nostrum soluta, qui beatae. Perferendis reiciendis quisquam iure odio ratione? Sit dolorum illo beatae id quo. Ipsa tempora consequuntur earum! Aut harum quia ipsum modi magni rerum, eveniet amet enim alias ut hic.', 7, '2023-03-27 23:46:58', '2023-03-27 23:46:58', NULL),
(7, 13, 'Kami ubah statusnya jadi selesai.', 5, '2023-03-27 23:49:02', '2023-03-27 23:49:02', NULL);

--
-- Triggers `tanggapan`
--
DELIMITER $$
CREATE TRIGGER `delete_tanggapan` BEFORE DELETE ON `tanggapan` FOR EACH ROW DELETE FROM tanggapan WHERE tanggapan.id_laporan=OLD.id
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nik` char(16) NOT NULL,
  `email` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nik`, `email`, `nama`, `username`, `password`, `role_id`, `updated_at`, `created_at`) VALUES
(1, '5927974025573337', 'kemalfairuz@gmail.com', 'Kemal Fairuz', 'kemalfairuz', '$2y$10$JF3nzWXxcGCpW2Y1pJdwGeYYCh7QRTqy.1rskKVPKOJkfqata2aWy', 3, NULL, '2023-03-26 18:55:51'),
(2, '8199097352007954', 'kanahayaraditya@gmail.com', 'Kanahaya Raditya', 'kanahayaraditya', '$2y$10$YKYH2adK8nVIMqjkzjB/rOIE5bEvN0lDK72rnhJr4otZEDVj27rxi', 3, '2023-03-28 21:15:17', '2023-03-26 18:55:51'),
(3, '2935009028953129', 'zhahiranfajri@gmail.com', 'Zhahiran Fajri', 'zhahiranfajri', '$2y$10$xpktFVc0QOyd4fGxTfGHUemMQLWCpEUxICkWgR0DH/FmtCeIyyQxq', 3, NULL, '2023-03-26 18:55:51'),
(4, '3742685449616095', 'abdurrahmaniqbal@gmail.com', 'Abdurrahman Iqbal', 'abdurrahmaniqbal', '$2y$10$JEwz2VsrTO7e4ZybHefB..q.BYbcbAzO8jMTpwk3FiGqjZT8rirGG', 2, NULL, '2023-03-26 18:55:51'),
(5, '3301752851882878', 'qintharadhafin@gmail.com', 'Qinthara Dhafin', 'qintharadhafin', '$2y$10$BlLldDK4wXe0Cf3UZrsjqu/.JO5Qog4k0nGaBZFoNXCRlT/EDDNfW', 2, NULL, '2023-03-26 18:55:52'),
(6, '3716111900875718', 'fikrifarras@gmail.com', 'Fikri Farras', 'fikrifarras', '$2y$10$JktsSThqRuONmuxzdCG.Ae.rF3mCergExRwtXJv5xFsXwvcBrtxb6', 2, NULL, '2023-03-26 18:55:52'),
(7, '4097080971190613', 'jiwanifavian@gmail.com', 'Jiwani Favian', 'jiwanifavian', '$2y$10$QdfvlsD.nWaBq.H9UAHJ7e913noZAaXZ4fe7r5HJZrfk/L4wDoZPS', 2, NULL, '2023-03-26 18:55:52'),
(8, '1776096603267620', 'slametarsyl@gmail.com', 'Slamet Arsyl', 'slametarsyl', '$2y$10$kaM.VMvY1XZ5Mtj7etVLrulENJfSXn.qtsrVfIhbnHWd4aysVqYPO', 2, NULL, '2023-03-26 18:55:52'),
(9, '9285848734663159', 'bayuandhika@gmail.com', 'Bayu Andhika', 'bayuandhika', '$2y$10$c030OrE76QkjWwCarwXFyeSJIWs6SvKB248qyu7R7dt6Izhr3dm2u', 2, NULL, '2023-03-26 18:55:52'),
(10, '8740537970847518', 'lucianaellison@gmail.com', 'Luciana Ellison', 'lucianaellison', '$2y$10$cMFfENTMrcaCjlzhQR95v..xxbebTliq0Amzi6EbZtqP4.JHh0Wli', 1, NULL, '2023-03-26 18:56:03'),
(11, '7095482766748553', 'halliediaz@gmail.com', 'Hallie Diaz', 'halliediaz', '$2y$10$mD9FpSkO/iLhmD76ZxIYM.q1hcPCttHABs6sHa8kxb08qSi6Jo2mi', 1, NULL, '2023-03-26 18:56:03'),
(12, '7141874572259620', 'cherishsloan@gmail.com', 'Cherish Sloan', 'cherishsloan', '$2y$10$/CH8FvPastTgHIlPlwY6.OFOkGiWSmKmHANz3uQAKuv3553CXcQom', 1, NULL, '2023-03-26 18:56:03'),
(13, '4664110246651613', 'paytonnielsen@gmail.com', 'Payton Nielsen', 'paytonnielsen', '$2y$10$6S1CZlO92GNRbwqv4vt9juvHCi18TX5h8RG0sdIl4jn6Ru..5JnRO', 1, NULL, '2023-03-26 18:56:03'),
(14, '5648813611542247', 'sidneyarias@gmail.com', 'Sidney Arias', 'sidneyarias', '$2y$10$D7R4wlfs5XNsl6Z3Kfnlcufg2vnt2fPNaU/oUIR5YX3PDBdr0xhQG', 1, NULL, '2023-03-26 18:56:03'),
(15, '6497566136662118', 'hailietate@gmail.com', 'Hailie Tate', 'hailietate', '$2y$10$/O1z9jDEMXOFd0S31rCP1uJ16IeUgXQTVg9njIOWBH.2pyuQ.XcGW', 1, NULL, '2023-03-26 18:56:03'),
(16, '4103037298918779', 'evancallahan@gmail.com', 'Evan Callahan', 'evancallahan', '$2y$10$zK0SQ5KNRaNueo9jBobYLefNrFHB.oOjwBrgeeLHLaMMIjoASFoZW', 1, NULL, '2023-03-26 18:56:04'),
(17, '6029376785909575', 'raulalvarez@gmail.com', 'Raul Alvarez', 'raulalvarez', '$2y$10$BkADebdnvpylvvUNfiQMhuBWh6dICxQk0EUb2Xafe0b8dBgjZt3pq', 1, NULL, '2023-03-26 18:56:04'),
(18, '7535487841253735', 'christinecooke@gmail.com', 'Christine Cooke', 'christinecooke', '$2y$10$EPq/wJUEHownEi5TyOVpqe2kcW4yYKs8FsYzwdiEE1wXd8tkY33Hy', 1, NULL, '2023-03-26 18:56:04'),
(19, '9612510804147959', 'karengrant@gmail.com', 'Karen Grant', 'karengrant', '$2y$10$1RiXmna3lMD9z.tw7e83eeTl9YemxXf0rX.D10E.9CVRuA6d4ok1O', 1, NULL, '2023-03-26 18:56:04'),
(20, '2461279615322906', 'coreyklein@gmail.com', 'Corey Klein', 'coreyklein', '$2y$10$nev46aNCfN.mWIcrnJ0xSOmBWv1escV3B330hTde1xEUroyj40KBC', 1, NULL, '2023-03-26 18:56:04'),
(21, '7444010756626086', 'kieranmayo@gmail.com', 'Kieran Mayo', 'kieranmayo', '$2y$10$YX5/Oi8DhYrmcLL29h5lX.oscwbYOvcpO45GvvMcSpZ8iqrTf.cM.', 1, NULL, '2023-03-26 18:56:04'),
(22, '7531247008828954', 'mirawaters@gmail.com', 'Mira Waters', 'mirawaters', '$2y$10$OOyJShntNgBkQT7EOOcntOt.HwzVtQ2G526dMF/a2gMkyqjJgVqsO', 1, NULL, '2023-03-26 18:56:05'),
(23, '8792085542530485', 'thomasnash@gmail.com', 'Thomas Nash', 'thomasnash', '$2y$10$rvEJGsA1bKsCQ6RSe5hQCOkNNodQ4b7jKWxF8LBrL43n/LvT3/ksq', 1, NULL, '2023-03-26 18:56:05'),
(24, '5200495230166192', 'alainarusso@gmail.com', 'Alaina Russo', 'alainarusso', '$2y$10$bKHdl92S45rc8TGC2x5xiOLWq84I8kC5nOVrmFm8gsmj/d4SQEqTC', 1, NULL, '2023-03-26 18:56:05'),
(25, '3193340270958451', 'brysonwalter@gmail.com', 'Bryson Walter', 'brysonwalter', '$2y$10$qi06fxl22lyJxlnmVCQ4WOQWjwjV/uVrZGElB11hlNiZenAslWNLa', 1, NULL, '2023-03-26 18:56:05'),
(26, '1167385863312543', 'dillonhaney@gmail.com', 'Dillon Haney', 'dillonhaney', '$2y$10$pph9nX2P5v4ZGCVkBsXoA.nAUJkViST13WOguATc9RV1xHcHkKABS', 1, NULL, '2023-03-26 18:56:06'),
(27, '4608357815065832', 'josephinewatkins@gmail.com', 'Josephine Watkins', 'josephinewatkins', '$2y$10$dlGSrRSaKaGmfOi2Q2kFd.D7SztuOeMUidPHL6rSc8WbghDMR.b9.', 1, NULL, '2023-03-26 18:56:06'),
(28, '8389560931417200', 'levisuarez@gmail.com', 'Levi Suarez', 'levisuarez', '$2y$10$omnv9zfIBhoJ6Fh1YNDIkevSa0fLt/gDwuqbWsA8HYDFjm.DVFtmS', 1, NULL, '2023-03-26 18:56:06'),
(29, '5059286301779454', 'angelogomez@gmail.com', 'Angelo Gomez', 'angelogomez', '$2y$10$iUP/WRplOkBUPrvVaKFoJuF7SK1WIXS7nOcznKJz.EiXap11HFfXK', 1, NULL, '2023-03-26 18:56:06'),
(30, '6324029136255745', 'adysonrodgers@gmail.com', 'Adyson Rodgers', 'adysonrodgers', '$2y$10$FeyFrWZwhgudgWB2TYyoluj8LgjOBtc4gW02RgpDIg2ZDtBFFDobK', 1, NULL, '2023-03-26 18:56:06'),
(31, '8744825185417903', 'bobbyerickson@gmail.com', 'Bobby Erickson', 'bobbyerickson', '$2y$10$8/kCYvw/OImFP6dBNQgzHuRXt3DuvwguNMZGy/wajAdy0ujaGN2by', 1, NULL, '2023-03-26 18:56:06'),
(32, '4371150577239434', 'sethwilliams@gmail.com', 'Seth Williams', 'sethwilliams', '$2y$10$ICBffMd1Ym/Sl5iHdVrOOu8yjdPZEjAjA.GxJucGWwK6.7Enpocw6', 1, NULL, '2023-03-26 18:56:06'),
(33, '7680276654067787', 'jazmyncohen@gmail.com', 'Jazmyn Cohen', 'jazmyncohen', '$2y$10$ZuShkRNSQ8onuPoaELZgpu3x75zJMdc39HXJXp1ZD2mx.hnykDAu.', 1, NULL, '2023-03-26 18:56:07'),
(34, '5961666762704188', 'raphaelbenson@gmail.com', 'Raphael Benson', 'raphaelbenson', '$2y$10$LVxNyEfae3hHRUbJz1y4mOWuwgzqjueErBEekC318RcffHALMN316', 1, NULL, '2023-03-26 18:56:07'),
(35, '7391959316281532', 'corbinjarvis@gmail.com', 'Corbin Jarvis', 'corbinjarvis', '$2y$10$xmAhwxV1B4t8vShreISLOejm4qzvHGUXItRBQGj5UHeLaLSbwI27O', 1, NULL, '2023-03-26 18:56:07'),
(36, '6675910662610513', 'aliyahwoodward@gmail.com', 'Aliyah Woodward', 'aliyahwoodward', '$2y$10$ZUYIadf1afFefxTnXEE0Ru3YQnWjBSQ43F92uFGjJxq4djseYliJS', 1, NULL, '2023-03-26 18:56:07'),
(37, '7655032220916765', 'jaedenlester@gmail.com', 'Jaeden Lester', 'jaedenlester', '$2y$10$iYes0Uy8yBR7NrP5JDKwOe3LWs3clwTRkG3nrp/6pZm7WMj25gDge', 1, NULL, '2023-03-26 18:56:07'),
(38, '8467974073574311', 'kennedisalazar@gmail.com', 'Kennedi Salazar', 'kennedisalazar', '$2y$10$FApbp.UItuEjnKa9x9qyruQTShGuDQ1gvSLpfkSMCNH8xe4so9Fse', 1, NULL, '2023-03-26 18:56:07'),
(39, '8761523439898291', 'briellepace@gmail.com', 'Brielle Pace', 'briellepace', '$2y$10$bCy0Wul83cvRFXNZGZaRUu8JJVJsO9ubLsL2UdOcAlofddNsE7yLq', 1, NULL, '2023-03-26 18:56:08'),
(40, '5872053880264022', 'conradcarey@gmail.com', 'Conrad Carey', 'conradcarey', '$2y$10$DRk0.T0pYwdt2bJIJzCkhe8QGzl7iGOS6ZRu1Ure4xi/SDE/SLW5O', 1, NULL, '2023-03-26 18:56:08'),
(41, '8717813291526196', 'aidenmcmahon@gmail.com', 'Aiden Mcmahon', 'aidenmcmahon', '$2y$10$NBLnRMBygJuRJyeQx1QmK.InRIyZP5idNUNQYHu355mdQ8b.LHeuG', 1, NULL, '2023-03-26 18:56:08'),
(42, '7545706016707264', 'malikwolf@gmail.com', 'Malik Wolf', 'malikwolf', '$2y$10$WV5yaHTdkWRt4E/JM2muZeYJAlTsAwP9qgWXEyTLut9ng10BuR7by', 1, NULL, '2023-03-26 18:56:08'),
(43, '3344792559385269', 'izayahsteele@gmail.com', 'Izayah Steele', 'izayahsteele', '$2y$10$bfY7b6N/Q7uMjtN1qaUjT.8g1P7XZDRf5NXS31gxWwvDzbamM8mTi', 1, NULL, '2023-03-26 18:56:08'),
(44, '9264051583212996', 'jaxgillespie@gmail.com', 'Jax Gillespie', 'jaxgillespie', '$2y$10$yHMM/QS6BO0kSniTJPXC.u51ic8cyrY1i8l1ap7C0EKBIEjEDES/2', 1, NULL, '2023-03-26 18:56:08'),
(45, '6706478183322959', 'taniyahorton@gmail.com', 'Taniya Horton', 'taniyahorton', '$2y$10$HTuqmNodIWgpufpOu9ftJ.HdXDx9uVYR4RPomgTKlATVMmAh/nycW', 1, NULL, '2023-03-26 18:56:08'),
(46, '2423741569832421', 'kamarifrost@gmail.com', 'Kamari Frost', 'kamarifrost', '$2y$10$L3wtp2Bsl1J4BgH8gUJH8urvygTtAGMrfD7nnSk5iKcOE3llLrD7G', 1, NULL, '2023-03-26 18:56:08'),
(47, '2769411531656391', 'skylardelacruz@gmail.com', 'Skylar Delacruz', 'skylardelacruz', '$2y$10$QC5wENAzKJszB5oJm5n6G.y58w3S4SNfYormtMMkzk58.EvWNmP2m', 1, NULL, '2023-03-26 18:56:09'),
(48, '2164212078049641', 'moiseskey@gmail.com', 'Moises Key', 'moiseskey', '$2y$10$iLuMLgQIfO58yggeLAaZeunqkpVvciDe2Zodl4qC4PVdVydAYu1HK', 1, NULL, '2023-03-26 18:56:09'),
(49, '4523185947697234', 'heavenvargas@gmail.com', 'Heaven Vargas', 'heavenvargas', '$2y$10$eYlosLh0kMw0UTn8NjmVxeL5ssJnxtsVvBe0.IzLohIJ.SEE5bhES', 1, '2023-03-27 00:20:47', '2023-03-26 18:56:09');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `laporan`
--
ALTER TABLE `laporan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `laporan_id_user_foreign` (`id_user`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tanggapan`
--
ALTER TABLE `tanggapan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tanggapan_id_laporan_foreign` (`id_laporan`),
  ADD KEY `tanggapan_id_user_foreign` (`id_user`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_nik_unique` (`nik`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD KEY `users_role_id_foreign` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `laporan`
--
ALTER TABLE `laporan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tanggapan`
--
ALTER TABLE `tanggapan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `laporan`
--
ALTER TABLE `laporan`
  ADD CONSTRAINT `laporan_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tanggapan`
--
ALTER TABLE `tanggapan`
  ADD CONSTRAINT `tanggapan_id_laporan_foreign` FOREIGN KEY (`id_laporan`) REFERENCES `laporan` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tanggapan_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
