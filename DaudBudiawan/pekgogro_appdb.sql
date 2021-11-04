-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 04, 2021 at 09:27 AM
-- Server version: 10.3.31-MariaDB-log-cll-lve
-- PHP Version: 7.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pekgogro_appdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(10) UNSIGNED NOT NULL,
  `whatsapp` varchar(16) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(20) NOT NULL,
  `role` enum('cs','order','finance','produksi','owner','developer','komisaris') NOT NULL,
  `status` enum('aktif','tidak aktif') NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL,
  `deleted_by` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `whatsapp`, `password`, `name`, `role`, `status`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`, `deleted_by`) VALUES
(1, '082114578976', '$2y$10$wEoESyhVVXF2Et22AeejK.C3GlPrsnfvyR4046pTsm.gb1XiC9i0W', 'Adam', 'developer', 'aktif', '2021-10-22 20:57:51', '2021-11-04 09:06:11', NULL, 1, 1, NULL),
(2, '085603355799', '$2y$10$kiMo3KzzWPZEnKcPoFJ2JOoro6I9de6HnxEg6trQmQfzFET5YaTrC', 'Nurul', 'order', 'aktif', '2021-10-25 22:48:17', '2021-10-25 22:48:17', NULL, 1, 1, NULL),
(3, '081248892735', '$2y$10$8kPtP3F1sNMMIuUN.p7kXOl/nIcKMoFcKTvczlk2lNTVe6Uikodgu', 'Isanda', 'owner', 'aktif', '2021-10-30 05:10:38', '2021-11-01 17:09:21', NULL, 1, 3, NULL),
(4, '081111111111', '$2y$10$LJM7vcllW5DDMcy8jjxEBe33PrrDduCriHxEJdbVGItKeJiqy2cn2', 'Admin CS', 'cs', 'aktif', '2021-10-30 08:53:16', '2021-10-30 08:53:16', NULL, 3, 3, NULL),
(5, '082222222222', '$2y$10$x7NjiaR/zLJvXfBPupyydu00J2zrbyY9HtCzjXWAxsaX4BdlsZk.S', 'Admin Order', 'order', 'aktif', '2021-10-30 08:53:42', '2021-10-30 08:53:42', NULL, 3, 3, NULL),
(6, '083333333333', '$2y$10$5QVSj.UXFezjgdgfnQW17uuv0vmBkU2J3.mYIk.cUXCZm4zwHMcF2', 'Admin Produksi', 'produksi', 'aktif', '2021-10-30 08:54:04', '2021-10-30 08:54:04', NULL, 3, 3, NULL),
(7, '084444444444', '$2y$10$x9sBLDBPARlSVMmi3atBie0/hqb7GquBs9Wv32QDcpCpgsPzftpRu', 'Admin Finance', 'finance', 'aktif', '2021-10-30 08:57:09', '2021-11-03 12:11:31', NULL, 3, 7, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `colors`
--

CREATE TABLE `colors` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL,
  `deleted_by` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `colors`
--

INSERT INTO `colors` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`, `deleted_by`) VALUES
(1, 'Putih', '2021-11-03 12:00:11', '2021-11-03 12:00:11', NULL, 1, 1, NULL),
(2, 'Hitam', '2021-11-03 12:00:15', '2021-11-03 12:00:15', NULL, 1, 1, NULL),
(3, 'Merah', '2021-11-03 12:00:18', '2021-11-03 12:00:18', NULL, 1, 1, NULL),
(4, 'Kuning', '2021-11-03 12:00:21', '2021-11-03 12:00:21', NULL, 1, 1, NULL),
(5, 'Hijau', '2021-11-03 12:00:25', '2021-11-03 12:00:25', NULL, 1, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(10) UNSIGNED NOT NULL,
  `whatsapp` varchar(16) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(100) NOT NULL,
  `id_tokped` varchar(255) DEFAULT NULL,
  `id_shopee` varchar(255) DEFAULT NULL,
  `id_instagram` varchar(255) DEFAULT NULL,
  `order_created` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `order_canceled` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `order_total` decimal(19,4) UNSIGNED NOT NULL DEFAULT 0.0000,
  `status` enum('aktif','tidak aktif') NOT NULL,
  `reason_inactive` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL,
  `deleted_by` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `whatsapp`, `password`, `name`, `id_tokped`, `id_shopee`, `id_instagram`, `order_created`, `order_canceled`, `order_total`, `status`, `reason_inactive`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`, `deleted_by`) VALUES
(1001, '082114578976', '$2y$10$hdjK7qrFAv0RzIlD6sJw1eMVLqnTnJEjOeg.Gbmv9beyh0lWlISXG', 'Adam PM', 'adampm77', 'adampm77', 'adampm77', 3, 8, 2100013.0000, 'aktif', NULL, '2021-11-03 08:43:41', '2021-11-04 09:09:46', NULL, 1, 1001, NULL),
(1002, '085603355799', '$2y$10$sKo.oXAqw4LzxsVJQzwdF.36nSaLiKOhd5xL9ijXlq.mf1ujL5Ay.', 'Nurul Aulia Latifah', '', '', '', 0, 0, 0.0000, 'aktif', NULL, '2021-11-03 08:51:26', '2021-11-03 08:51:26', NULL, 1, 1, NULL),
(1003, '081281139716', '$2y$10$o3agbyXSFWc6t3gaYlYg/eHn.jKWOzg2n9j63MpuDdoUlEZqok/4y', 'Reihan', '', '', '', 0, 0, 0.0000, 'aktif', NULL, '2021-11-03 11:49:31', '2021-11-03 15:50:08', NULL, 1, 1003, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(10) NOT NULL,
  `role` enum('potong kain','penjahit','qc','aksesoris') NOT NULL,
  `path_photo` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL,
  `deleted_by` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `name`, `role`, `path_photo`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`, `deleted_by`) VALUES
(1, 'Udin', 'potong kain', 'd3e2e47a66bbe3975af075a78cd5f66f.png', '2021-11-03 11:52:54', '2021-11-03 11:52:54', NULL, 1, 1, NULL),
(2, 'Budi', 'penjahit', '103b35aef05e7481f290173790e15f37.png', '2021-11-03 11:53:06', '2021-11-03 11:53:06', NULL, 1, 1, NULL),
(3, 'Susi', 'qc', '43438ed9555c374c98a9cfb37cff19d1.png', '2021-11-03 11:53:26', '2021-11-03 11:53:26', NULL, 1, 1, NULL),
(4, 'Ujang', 'aksesoris', '5c514b5bcd4b1344a37b23844cd9a78e.png', '2021-11-03 11:53:37', '2021-11-03 11:53:37', NULL, 1, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `hpps`
--

CREATE TABLE `hpps` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `cost` decimal(19,4) NOT NULL,
  `unit_id` int(10) UNSIGNED NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL,
  `deleted_by` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `hpps`
--

INSERT INTO `hpps` (`id`, `name`, `cost`, `unit_id`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`, `deleted_by`) VALUES
(1, 'Kain A', 10000.0000, 1, '2021-11-03 11:53:50', '2021-11-03 11:53:50', NULL, 1, 1, NULL),
(2, 'Aksesoris A', 5000.0000, 1, '2021-11-03 11:54:14', '2021-11-03 11:54:14', NULL, 1, 1, NULL),
(3, 'Benang A', 1000.0000, 1, '2021-11-03 11:54:40', '2021-11-03 11:54:40', NULL, 1, 1, NULL),
(4, 'Kain B', 11000.0000, 3, '2021-11-03 11:54:54', '2021-11-03 11:54:54', NULL, 1, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(10) UNSIGNED NOT NULL,
  `project_id` int(10) UNSIGNED NOT NULL,
  `sales_invoice` varchar(16) NOT NULL,
  `durasi_batas_transfer` enum('3','5','24') NOT NULL,
  `batas_waktu_transfer` datetime NOT NULL,
  `estimasi_selesai` date DEFAULT NULL,
  `order_via` enum('web','wa','tokped','shopee','offline') NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `color_id` int(10) UNSIGNED NOT NULL,
  `size_id` int(10) UNSIGNED NOT NULL,
  `pilih_jahitan` enum('standard','express','urgent','super urgent') NOT NULL,
  `catatan` text DEFAULT NULL,
  `customer_id` int(10) UNSIGNED NOT NULL,
  `whatsapp` varchar(16) NOT NULL,
  `id_tokped` varchar(255) DEFAULT NULL,
  `id_shopee` varchar(255) DEFAULT NULL,
  `id_instagram` varchar(255) DEFAULT NULL,
  `status_order` enum('order dibuat','naik produksi','pengiriman','selesai','order dibatalkan','retur pending','retur terkirim','refund') NOT NULL,
  `status_pembayaran` enum('menunggu pembayaran','partial','lunas','melewati batas transfer','refund pending','refund selesai') NOT NULL,
  `status_pengiriman` enum('terkirim','proses pengiriman','antrian') DEFAULT 'antrian',
  `sub_total` decimal(19,4) UNSIGNED NOT NULL DEFAULT 0.0000,
  `kode_unik` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `grand_total` decimal(19,5) UNSIGNED NOT NULL DEFAULT 0.00000,
  `jenis_dp` enum('30','50','100') NOT NULL,
  `dp_value` decimal(19,4) UNSIGNED NOT NULL DEFAULT 0.0000,
  `pelunasan_value` decimal(19,4) UNSIGNED NOT NULL DEFAULT 0.0000,
  `terbayarkan` decimal(19,4) UNSIGNED NOT NULL DEFAULT 0.0000,
  `tanggal_pengiriman` datetime DEFAULT NULL,
  `ekspedisi` varchar(255) DEFAULT NULL,
  `no_resi` varchar(255) DEFAULT NULL,
  `alamat_pengiriman` text DEFAULT NULL,
  `admin_order` int(11) NOT NULL,
  `admin_finance` int(11) DEFAULT NULL,
  `admin_cs` int(11) DEFAULT NULL,
  `admin_produksi` int(11) DEFAULT NULL,
  `is_printed` enum('no','yes') NOT NULL DEFAULT 'no',
  `is_production` enum('no','yes') NOT NULL DEFAULT 'no',
  `is_paid_off` enum('no','yes') NOT NULL DEFAULT 'no',
  `status` enum('temp','active') NOT NULL,
  `created_at` datetime NOT NULL COMMENT 'berlaku sebagai tangga & jam order',
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL,
  `deleted_by` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `project_id`, `sales_invoice`, `durasi_batas_transfer`, `batas_waktu_transfer`, `estimasi_selesai`, `order_via`, `product_id`, `color_id`, `size_id`, `pilih_jahitan`, `catatan`, `customer_id`, `whatsapp`, `id_tokped`, `id_shopee`, `id_instagram`, `status_order`, `status_pembayaran`, `status_pengiriman`, `sub_total`, `kode_unik`, `grand_total`, `jenis_dp`, `dp_value`, `pelunasan_value`, `terbayarkan`, `tanggal_pengiriman`, `ekspedisi`, `no_resi`, `alamat_pengiriman`, `admin_order`, `admin_finance`, `admin_cs`, `admin_produksi`, `is_printed`, `is_production`, `is_paid_off`, `status`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`, `deleted_by`) VALUES
(5, 1, 'PKG.03.11.21005', '3', '2021-11-03 18:48:25', '2021-12-03', 'web', 1, 1, 5, 'standard', '', 1001, '082114578976', 'adampm77', 'adampm77', 'adampm77', 'order dibatalkan', 'menunggu pembayaran', 'antrian', 800000.0000, 5, 800005.00000, '30', 240001.5000, 560003.5000, 0.0000, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 'no', 'no', 'no', 'active', '2021-11-03 15:48:25', '2021-11-03 15:48:25', NULL, 1001, 1001, NULL),
(7, 1, 'PKG.03.11.21007', '3', '2021-11-03 18:49:47', '2021-12-03', 'web', 3, 6, 6, 'standard', '', 1001, '082114578976', 'adampm77', 'adampm77', 'adampm77', 'order dibatalkan', 'menunggu pembayaran', 'antrian', 500000.0000, 7, 500007.00000, '100', 500007.0000, 0.0000, 0.0000, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 'no', 'no', 'no', 'active', '2021-11-03 15:49:47', '2021-11-03 15:49:47', NULL, 1001, 1001, NULL),
(8, 0, 'PKG.03.11.21008', '', '0000-00-00 00:00:00', NULL, '', 0, 0, 0, '', NULL, 0, '', NULL, NULL, NULL, '', '', 'antrian', 0.0000, 8, 0.00000, '', 0.0000, 0.0000, 0.0000, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 'no', 'no', 'no', 'temp', '2021-11-03 15:49:58', '2021-11-03 15:49:58', NULL, 1003, 1003, NULL),
(9, 1, 'PKG.04.11.21001', '3', '2021-11-04 12:07:34', '2021-12-04', 'web', 1, 1, 5, 'standard', 'test', 1001, '082114578976', 'adampm77', 'adampm77', 'adampm77', 'order dibuat', 'menunggu pembayaran', 'antrian', 800000.0000, 1, 800001.00000, '100', 800001.0000, 0.0000, 0.0000, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 'no', 'no', 'no', 'active', '2021-11-04 09:07:34', '2021-11-04 09:07:34', NULL, 1001, 1001, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_payments`
--

CREATE TABLE `order_payments` (
  `id` int(10) UNSIGNED NOT NULL,
  `order_id` int(10) UNSIGNED NOT NULL,
  `customer_id` int(10) UNSIGNED NOT NULL,
  `path_image` varchar(255) NOT NULL,
  `status_pembayaran` enum('menunggu verifikasi','valid','ditolak') NOT NULL,
  `alasan_penolakan` text DEFAULT NULL,
  `jenis_pembayaran` enum('dp','pelunasan') DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL,
  `deleted_by` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `order_productions`
--

CREATE TABLE `order_productions` (
  `id` int(10) UNSIGNED NOT NULL,
  `order_id` int(10) UNSIGNED NOT NULL,
  `petugas_potong_kain` int(10) UNSIGNED DEFAULT NULL,
  `tanggal_potong_kain` date DEFAULT NULL,
  `petugas_jahit` int(10) DEFAULT NULL,
  `tanggal_jahit` date DEFAULT NULL,
  `petugas_qc_1` int(10) UNSIGNED DEFAULT NULL,
  `tanggal_qc_1` date DEFAULT NULL,
  `petugas_aksesoris` int(10) UNSIGNED DEFAULT NULL,
  `tanggal_aksesoris` date DEFAULT NULL,
  `petugas_qc_2` int(10) UNSIGNED DEFAULT NULL,
  `tanggal_qc_2` date DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL,
  `deleted_by` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `order_requests`
--

CREATE TABLE `order_requests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `request_id` int(10) UNSIGNED NOT NULL,
  `cost` decimal(19,4) UNSIGNED NOT NULL DEFAULT 0.0000,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL,
  `deleted_by` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(14) NOT NULL COMMENT 'P.31.12.21.001 | (P.tanggal.bulan.tahun.kode_urut)',
  `name` varchar(50) NOT NULL,
  `price` decimal(19,4) UNSIGNED NOT NULL,
  `path_image` varchar(255) DEFAULT NULL,
  `status` enum('temp','active') DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL,
  `deleted_by` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `code`, `name`, `price`, `path_image`, `status`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`, `deleted_by`) VALUES
(1, 'P.03.11.21001', 'Baju AHHA', 700000.0000, '67adc352c5a134b70549c36bf5549917.jpg', 'active', '2021-11-03 12:00:56', '2021-11-03 12:02:25', NULL, 1, 1, NULL),
(3, 'P.03.11.21003', 'BAJU TUKANG MOLOR', 500000.0000, '8eef74ca4d3e30c2b587e815170e4852.jpg', 'active', '2021-11-03 12:06:54', '2021-11-03 12:07:43', NULL, 1, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_color_params`
--

CREATE TABLE `product_color_params` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `color_id` int(10) UNSIGNED NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL,
  `deleted_by` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `product_color_params`
--

INSERT INTO `product_color_params` (`id`, `product_id`, `color_id`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`, `deleted_by`) VALUES
(1, 1, 1, '2021-11-03 12:02:25', '2021-11-03 12:02:25', NULL, 1, 1, NULL),
(2, 1, 2, '2021-11-03 12:02:25', '2021-11-03 12:02:25', NULL, 1, 1, NULL),
(3, 1, 3, '2021-11-03 12:02:25', '2021-11-03 12:02:25', NULL, 1, 1, NULL),
(4, 1, 4, '2021-11-03 12:02:25', '2021-11-03 12:02:25', NULL, 1, 1, NULL),
(5, 1, 5, '2021-11-03 12:02:25', '2021-11-03 12:02:25', NULL, 1, 1, NULL),
(6, 3, 2, '2021-11-03 12:07:43', '2021-11-03 12:07:43', NULL, 1, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_hpp_params`
--

CREATE TABLE `product_hpp_params` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `hpp_id` int(10) UNSIGNED NOT NULL,
  `qty` decimal(19,4) UNSIGNED NOT NULL,
  `basic_price` decimal(19,4) UNSIGNED NOT NULL DEFAULT 0.0000,
  `total_price` decimal(19,4) UNSIGNED NOT NULL DEFAULT 0.0000,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL,
  `deleted_by` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `product_hpp_params`
--

INSERT INTO `product_hpp_params` (`id`, `product_id`, `hpp_id`, `qty`, `basic_price`, `total_price`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`, `deleted_by`) VALUES
(1, 1, 1, 1.0000, 10000.0000, 10000.0000, '2021-11-03 12:02:05', '2021-11-03 12:02:25', NULL, 1, 1, NULL),
(2, 1, 2, 1.0000, 5000.0000, 5000.0000, '2021-11-03 12:02:10', '2021-11-03 12:02:25', NULL, 1, 1, NULL),
(3, 1, 3, 1.0000, 1000.0000, 1000.0000, '2021-11-03 12:02:14', '2021-11-03 12:02:25', NULL, 1, 1, NULL),
(4, 1, 4, 1.0000, 11000.0000, 11000.0000, '2021-11-03 12:02:18', '2021-11-03 12:02:25', NULL, 1, 1, NULL),
(5, 3, 1, 1.0000, 10000.0000, 10000.0000, '2021-11-03 12:07:23', '2021-11-03 12:07:43', NULL, 1, 1, NULL),
(6, 3, 2, 1.0000, 5000.0000, 5000.0000, '2021-11-03 12:07:28', '2021-11-03 12:07:43', NULL, 1, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_request_params`
--

CREATE TABLE `product_request_params` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `request_id` int(10) UNSIGNED NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL,
  `deleted_by` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `product_request_params`
--

INSERT INTO `product_request_params` (`id`, `product_id`, `request_id`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`, `deleted_by`) VALUES
(1, 1, 1, '2021-11-03 12:02:25', '2021-11-03 12:02:25', NULL, 1, 1, NULL),
(2, 1, 2, '2021-11-03 12:02:25', '2021-11-03 12:02:25', NULL, 1, 1, NULL),
(3, 3, 1, '2021-11-03 12:07:43', '2021-11-03 12:07:43', NULL, 1, 1, NULL),
(4, 3, 2, '2021-11-03 12:07:43', '2021-11-03 12:07:43', NULL, 1, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_size_params`
--

CREATE TABLE `product_size_params` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `size_id` int(10) UNSIGNED NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL,
  `deleted_by` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `product_size_params`
--

INSERT INTO `product_size_params` (`id`, `product_id`, `size_id`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`, `deleted_by`) VALUES
(1, 1, 1, '2021-11-03 12:02:25', '2021-11-03 12:02:25', NULL, 1, 1, NULL),
(2, 1, 2, '2021-11-03 12:02:25', '2021-11-03 12:02:25', NULL, 1, 1, NULL),
(3, 1, 3, '2021-11-03 12:02:25', '2021-11-03 12:02:25', NULL, 1, 1, NULL),
(4, 1, 4, '2021-11-03 12:02:25', '2021-11-03 12:02:25', NULL, 1, 1, NULL),
(5, 1, 5, '2021-11-03 12:02:25', '2021-11-03 12:02:25', NULL, 1, 1, NULL),
(6, 3, 2, '2021-11-03 12:07:43', '2021-11-03 12:07:43', NULL, 1, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(16) NOT NULL,
  `abbr` varchar(5) NOT NULL,
  `path_logo` varchar(255) NOT NULL COMMENT 'size 512x512px',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL,
  `deleted_by` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `name`, `abbr`, `path_logo`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`, `deleted_by`) VALUES
(1, 'Pekgo Group', 'PKG', 'logo_white.png', '2021-10-24 02:40:23', '2021-10-30 10:51:01', NULL, 1, 3, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `cost` decimal(19,4) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL,
  `deleted_by` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `requests`
--

INSERT INTO `requests` (`id`, `name`, `cost`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`, `deleted_by`) VALUES
(1, 'REQUEST (-) PB', 10000.0000, '2021-11-02 20:32:10', '2021-11-02 20:32:10', NULL, 1, 1, NULL),
(2, 'REQUEST (+) PB', 20000.0000, '2021-11-02 20:32:17', '2021-11-02 20:32:17', NULL, 1, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sequence_orders`
--

CREATE TABLE `sequence_orders` (
  `id` int(10) UNSIGNED NOT NULL,
  `sequence` int(10) UNSIGNED NOT NULL,
  `created_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `sequence_orders`
--

INSERT INTO `sequence_orders` (`id`, `sequence`, `created_at`) VALUES
(1, 8, '2021-11-03'),
(2, 1, '2021-11-04');

-- --------------------------------------------------------

--
-- Table structure for table `sequence_products`
--

CREATE TABLE `sequence_products` (
  `id` int(10) UNSIGNED NOT NULL,
  `sequence` int(10) UNSIGNED NOT NULL,
  `created_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `sequence_products`
--

INSERT INTO `sequence_products` (`id`, `sequence`, `created_at`) VALUES
(1, 3, '2021-11-03');

-- --------------------------------------------------------

--
-- Table structure for table `sizes`
--

CREATE TABLE `sizes` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(10) NOT NULL,
  `cost` decimal(19,4) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL,
  `deleted_by` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `sizes`
--

INSERT INTO `sizes` (`id`, `name`, `cost`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`, `deleted_by`) VALUES
(1, 'S', 0.0000, '2021-10-24 23:02:30', '2021-10-24 23:02:30', NULL, 1, 1, NULL),
(2, 'M', 0.0000, '2021-10-24 23:04:30', '2021-10-24 23:04:30', NULL, 1, 1, NULL),
(3, 'L', 0.0000, '2021-10-24 23:06:01', '2021-10-24 23:06:01', NULL, 1, 1, NULL),
(4, 'XL', 50000.0000, '2021-11-02 20:31:12', '2021-11-02 20:31:12', NULL, 1, 1, NULL),
(5, 'XXL', 100000.0000, '2021-11-02 20:31:18', '2021-11-02 20:31:18', NULL, 1, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(10) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL,
  `deleted_by` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`, `deleted_by`) VALUES
(1, 'Pcs', '2021-10-24 05:04:38', '2021-10-24 05:04:38', NULL, 1, 1, NULL),
(2, 'TSs', '2021-10-24 22:37:45', '2021-10-24 22:37:45', '2021-10-24 22:48:05', 1, 1, 1),
(3, 'Meter', '2021-10-26 00:52:16', '2021-10-26 00:52:16', NULL, 1, 1, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `colors`
--
ALTER TABLE `colors`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `hpps`
--
ALTER TABLE `hpps`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `order_payments`
--
ALTER TABLE `order_payments`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `order_productions`
--
ALTER TABLE `order_productions`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `order_requests`
--
ALTER TABLE `order_requests`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `product_color_params`
--
ALTER TABLE `product_color_params`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `product_hpp_params`
--
ALTER TABLE `product_hpp_params`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `product_request_params`
--
ALTER TABLE `product_request_params`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `product_size_params`
--
ALTER TABLE `product_size_params`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `sequence_orders`
--
ALTER TABLE `sequence_orders`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `sequence_products`
--
ALTER TABLE `sequence_products`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `sizes`
--
ALTER TABLE `sizes`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `colors`
--
ALTER TABLE `colors`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1004;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `hpps`
--
ALTER TABLE `hpps`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `order_payments`
--
ALTER TABLE `order_payments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_productions`
--
ALTER TABLE `order_productions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_requests`
--
ALTER TABLE `order_requests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `product_color_params`
--
ALTER TABLE `product_color_params`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `product_hpp_params`
--
ALTER TABLE `product_hpp_params`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `product_request_params`
--
ALTER TABLE `product_request_params`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `product_size_params`
--
ALTER TABLE `product_size_params`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sequence_orders`
--
ALTER TABLE `sequence_orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sequence_products`
--
ALTER TABLE `sequence_products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sizes`
--
ALTER TABLE `sizes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
