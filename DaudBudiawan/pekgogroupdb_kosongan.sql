-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 20, 2021 at 09:35 PM
-- Server version: 10.3.31-MariaDB-log-cll-lve
-- PHP Version: 7.3.32

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
(1, '082114578976', '$2y$10$wEoESyhVVXF2Et22AeejK.C3GlPrsnfvyR4046pTsm.gb1XiC9i0W', 'Adam PM', 'developer', 'aktif', '2021-10-22 20:57:51', '2021-11-20 21:34:49', NULL, 1, 1, NULL),
(2, '085603355799', '$2y$10$kiMo3KzzWPZEnKcPoFJ2JOoro6I9de6HnxEg6trQmQfzFET5YaTrC', 'Nurul', 'order', 'aktif', '2021-10-25 22:48:17', '2021-10-25 22:48:17', NULL, 1, 1, NULL),
(3, '081248892735', '$2y$10$8kPtP3F1sNMMIuUN.p7kXOl/nIcKMoFcKTvczlk2lNTVe6Uikodgu', 'Isanda', 'owner', 'aktif', '2021-10-30 05:10:38', '2021-11-20 21:34:54', NULL, 1, 3, NULL),
(4, '081111111111', '$2y$10$LJM7vcllW5DDMcy8jjxEBe33PrrDduCriHxEJdbVGItKeJiqy2cn2', 'Admin CS', 'cs', 'aktif', '2021-10-30 08:53:16', '2021-10-30 08:53:16', NULL, 3, 3, NULL),
(5, '082222222222', '$2y$10$x7NjiaR/zLJvXfBPupyydu00J2zrbyY9HtCzjXWAxsaX4BdlsZk.S', 'Admin Order', 'order', 'aktif', '2021-10-30 08:53:42', '2021-10-30 08:53:42', NULL, 3, 3, NULL),
(6, '083333333333', '$2y$10$5QVSj.UXFezjgdgfnQW17uuv0vmBkU2J3.mYIk.cUXCZm4zwHMcF2', 'Admin Produksi', 'produksi', 'aktif', '2021-10-30 08:54:04', '2021-10-30 08:54:04', NULL, 3, 3, NULL),
(7, '084444444444', '$2y$10$6wZdIeFMQtvq3tffagDcBuEnXQRdsbKjrOPV9oWzRJEnJwxk1exf2', 'Admin Finance', 'finance', 'aktif', '2021-10-30 08:57:09', '2021-11-13 22:01:12', NULL, 3, 7, NULL),
(8, '123456789', '$2y$10$c0isU/CanbSzJl9toPPKhefHw0WtDNINAP/1LZ5f7kdXGUT0Ux5mu', 'test', 'cs', 'aktif', '2021-11-13 21:08:44', '2021-11-13 21:08:44', '2021-11-13 21:10:02', 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `colors`
--

CREATE TABLE `colors` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `hex` varchar(7) DEFAULT NULL,
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

INSERT INTO `colors` (`id`, `name`, `hex`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`, `deleted_by`) VALUES
(1, 'Maroon', '#800000', '2021-11-07 08:53:11', '2021-11-13 16:32:20', NULL, 1001, 1, NULL),
(2, 'Nutella', '#8A523E', '2021-11-07 08:58:21', '2021-11-07 08:58:21', '2021-11-20 12:21:28', 1001, 1001, 3),
(3, 'Harsey', '#252120', '2021-11-07 08:59:34', '2021-11-07 08:59:34', NULL, 1001, 1001, NULL),
(4, 'Navy', '#000080', '2021-11-07 09:00:15', '2021-11-07 09:00:15', NULL, 1001, 1001, NULL),
(5, 'test', '#631717', '2021-11-13 20:48:23', '2021-11-13 20:48:23', '2021-11-13 20:48:26', 1, 1, 1),
(6, 'Black', '#0E0C0C', '2021-11-20 12:22:23', '2021-11-20 12:22:23', NULL, 3, 3, NULL),
(7, 'Cokmud', '#842727', '2021-11-20 12:22:40', '2021-11-20 12:22:40', NULL, 3, 3, NULL),
(8, 'Soft Lavender', '#000000', '2021-11-20 12:23:54', '2021-11-20 12:23:54', NULL, 3, 3, NULL),
(9, 'Lavender', '#843030', '2021-11-20 12:24:06', '2021-11-20 12:24:06', NULL, 3, 3, NULL),
(10, 'Dusty Pink', '#C42588', '2021-11-20 12:24:30', '2021-11-20 12:24:30', NULL, 3, 3, NULL),
(11, 'Grey', '#928585', '2021-11-20 12:24:52', '2021-11-20 12:24:52', NULL, 3, 3, NULL),
(12, 'Silver', '#9C8989', '2021-11-20 12:25:15', '2021-11-20 12:25:15', NULL, 3, 3, NULL),
(13, 'Broken White', '#F3F3F3', '2021-11-20 12:25:41', '2021-11-20 12:25:41', NULL, 3, 3, NULL),
(14, 'Milo ', '#B26B6B', '2021-11-20 12:25:55', '2021-11-20 12:25:55', NULL, 3, 3, NULL),
(15, 'Wardah', '#518C51', '2021-11-20 12:26:08', '2021-11-20 12:26:08', NULL, 3, 3, NULL),
(16, 'Sage', '#6C9C6E', '2021-11-20 12:26:20', '2021-11-20 12:26:20', NULL, 3, 3, NULL);

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
(1001, '082114578976', '$2y$10$xTIXwPQNRmDTslXAvaCH2ONUQJjdVemluOgUWajEaZE3pdZeMryge', 'Adam PM', 'adampm77', 'adampm77', 'adampm77', 1, 0, 1000002.0000, 'aktif', NULL, '2021-11-09 11:24:30', '2021-11-19 22:45:04', NULL, 1, 1001, NULL),
(1002, '085603355799', '$2y$10$B0PcAw697w72ip0TmrYxXeiM0G4PqCTlJWdfdKsMDoyap3R8hRJTC', 'Nurul AL', 'nurulal', 'nurulal', 'nurulal', 0, 0, 0.0000, 'aktif', NULL, '2021-11-13 15:56:00', '2021-11-18 19:48:39', NULL, 1, 1001, NULL),
(1003, '081281139716', '$2y$10$Om7GgHn4eGeXmi8aFH12n.AUmmhrnLQ.njCzv9arxectOaQTGNgFa', 'Reihan', '', '', '', 1, 0, 1010001.0000, 'aktif', NULL, '2021-11-19 21:36:14', '2021-11-19 22:26:06', NULL, 1, 1003, NULL),
(1004, '081248892735', '$2y$10$1uiJqdDxIgD3I4HMXFyYsuFhprxmxEE/sB56.UB7sfufLvCMoDYgq', 'Isanda', '', '', '', 1, 0, 1010001.0000, 'aktif', NULL, '2021-11-20 08:35:45', '2021-11-20 09:10:43', NULL, 1, 1004, NULL);

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
(1, 'Test', 'potong kain', '926ef8188c2dc4ab656810b273520b0b.jpg', '2021-11-20 21:34:33', '2021-11-20 21:34:33', NULL, 1, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `hpps`
--

CREATE TABLE `hpps` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `cost` decimal(19,4) NOT NULL,
  `unit_id` int(10) UNSIGNED NOT NULL,
  `supplier` varchar(255) NOT NULL,
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

INSERT INTO `hpps` (`id`, `name`, `cost`, `unit_id`, `supplier`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`, `deleted_by`) VALUES
(1, 'Benang', 2000.0000, 1, '', '2021-11-07 08:45:33', '2021-11-13 16:17:25', '2021-11-20 10:29:50', 1, 1, 3),
(2, 'Kain', 300000.0000, 3, '', '2021-11-07 08:45:44', '2021-11-07 08:45:44', '2021-11-20 10:29:53', 1, 1, 3),
(3, 'Mute', 2000.0000, 1, '', '2021-11-07 08:46:01', '2021-11-07 08:46:01', '2021-11-20 10:29:59', 1, 1, 3),
(4, 'Lady Zara @KMI', 19800.0000, 3, 'KMI', '2021-11-20 10:30:41', '2021-11-20 15:52:43', '2021-11-20 18:20:32', 3, 3, 3),
(5, 'Lady Zara @AKR', 25000.0000, 3, 'AKR', '2021-11-20 10:34:36', '2021-11-20 18:00:09', '2021-11-20 18:20:36', 3, 3, 3),
(6, 'Lady Zara ', 28500.0000, 3, 'TIGA KAIN', '2021-11-20 10:35:05', '2021-11-20 14:10:55', '2021-11-20 18:20:40', 3, 3, 3),
(7, 'Ceruti Armani @KMI', 14850.0000, 3, 'KMI', '2021-11-20 10:37:04', '2021-11-20 15:52:55', '2021-11-20 18:20:45', 3, 3, 3),
(8, 'Ceruti Armani @AKR', 19000.0000, 3, 'AKR', '2021-11-20 10:38:17', '2021-11-20 18:00:25', '2021-11-20 18:20:50', 3, 3, 3),
(9, 'Roberto ', 24000.0000, 3, 'AKR', '2021-11-20 10:39:00', '2021-11-20 14:11:35', '2021-11-20 18:20:55', 3, 3, 3),
(10, 'Maxmara ', 26000.0000, 3, 'AKR', '2021-11-20 10:39:21', '2021-11-20 14:11:45', '2021-11-20 18:21:00', 3, 3, 3),
(11, 'Tile Dott', 15500.0000, 3, 'AKR', '2021-11-20 10:40:30', '2021-11-20 14:11:58', '2021-11-20 18:21:04', 3, 3, 3),
(12, 'Maxmara', 26000.0000, 3, 'TONICO', '2021-11-20 10:41:01', '2021-11-20 14:12:09', '2021-11-20 18:21:07', 3, 3, 3),
(13, 'Ceruti Armani', 25000.0000, 3, 'TONICO', '2021-11-20 10:52:07', '2021-11-20 14:12:21', '2021-11-20 18:21:11', 3, 3, 3),
(14, 'Payet Bambu Abu Doff', 6250.0000, 1, 'Pusacho', '2021-11-20 10:53:20', '2021-11-20 15:58:39', '2021-11-20 18:21:14', 3, 3, 3),
(15, 'Velvet ', 14500.0000, 3, 'AKR', '2021-11-20 10:57:43', '2021-11-20 14:28:42', '2021-11-20 18:21:19', 3, 3, 3),
(16, 'DIAMOND GEORGATE', 15000.0000, 3, 'AKR', '2021-11-20 10:58:12', '2021-11-20 14:28:58', '2021-11-20 18:21:22', 3, 3, 3),
(17, 'MOSSCRAPE ', 18000.0000, 3, 'AKR', '2021-11-20 10:58:39', '2021-11-20 14:29:08', '2021-11-20 18:21:26', 3, 3, 3),
(18, 'TILE HALUS ', 10000.0000, 3, 'AKR', '2021-11-20 10:58:57', '2021-11-20 14:34:31', '2021-11-20 18:21:30', 3, 3, 3),
(19, 'BRUKAT CORD ', 24000.0000, 3, 'AKR', '2021-11-20 10:59:30', '2021-11-20 14:34:50', '2021-11-20 18:21:34', 3, 3, 3),
(20, 'ARMANI SILK ', 25300.0000, 3, 'KMI', '2021-11-20 11:01:35', '2021-11-20 14:37:14', '2021-11-20 18:21:37', 3, 3, 3),
(21, 'ZARA MOSSCRAPE', 13200.0000, 3, 'KMI', '2021-11-20 11:03:58', '2021-11-20 14:37:24', '2021-11-20 18:21:41', 3, 3, 3),
(22, 'SENORITA ', 20900.0000, 3, 'KMI', '2021-11-20 11:06:04', '2021-11-20 14:37:35', '2021-11-20 18:21:44', 3, 3, 3),
(23, 'DIAMOND GGR ', 11550.0000, 3, 'KMI', '2021-11-20 11:07:31', '2021-11-20 14:37:46', '2021-11-20 18:21:48', 3, 3, 3),
(24, 'Sleting 50cm Maroon ', 1583.0000, 1, 'JAHITMART', '2021-11-20 11:20:40', '2021-11-20 14:42:53', '2021-11-20 18:21:52', 3, 3, 3),
(25, 'Sleting 25cm-Maroon', 1250.0000, 1, 'JAHITMART', '2021-11-20 11:22:52', '2021-11-20 14:43:33', '2021-11-20 18:21:56', 3, 3, 3),
(26, 'Benang Extra - Maroon - 201 @500m', 2000.0000, 1, 'JAHITMART', '2021-11-20 11:24:30', '2021-11-20 15:02:28', '2021-11-20 18:22:00', 3, 3, 3),
(27, 'Benang Obras Merk Biola - Merah Hati - 7807 ', 700.0000, 1, 'Surya Alat Jahit', '2021-11-20 11:25:15', '2021-11-20 15:24:17', '2021-11-20 18:22:04', 3, 3, 3),
(28, 'Cangkang diamond 20 SS ', 76.0000, 1, 'PATRIC', '2021-11-20 11:26:49', '2021-11-20 15:03:20', NULL, 3, 3, NULL),
(29, 'Cangkang diamond 16 SS', 42.0000, 1, 'PATRIC', '2021-11-20 11:27:16', '2021-11-20 15:04:35', NULL, 3, 3, NULL),
(30, 'Cangkang diamond 25 SS ', 150.0000, 1, 'PATRIC', '2021-11-20 11:27:29', '2021-11-20 15:05:14', NULL, 3, 3, NULL),
(31, 'Cangkang diamond 30 SS ', 167.0000, 1, 'PATRIC', '2021-11-20 11:27:42', '2021-11-20 15:05:42', NULL, 3, 3, NULL),
(32, 'Cangkang diamond 35 SS', 167.0000, 1, 'PATRIC', '2021-11-20 11:28:02', '2021-11-20 15:06:06', NULL, 3, 3, NULL),
(33, 'MUTIARA 3MM', 23.0000, 1, '', '2021-11-20 11:28:29', '2021-11-20 11:28:44', '2021-11-20 15:06:23', 3, 3, 3),
(34, 'MUTIARA 4MM', 23.0000, 1, '', '2021-11-20 11:28:51', '2021-11-20 11:28:51', '2021-11-20 15:06:29', 3, 3, 3),
(35, 'MUTIARA 6MM', 39.0000, 1, '', '2021-11-20 11:29:06', '2021-11-20 11:29:06', '2021-11-20 15:06:34', 3, 3, 3),
(36, 'MUTIARA 8MM', 63.0000, 1, '', '2021-11-20 11:29:16', '2021-11-20 11:29:16', '2021-11-20 15:06:40', 3, 3, 3),
(37, 'Mutiara 6mm light gold kode 141 ', 19.0000, 1, 'PATRIC', '2021-11-20 15:10:20', '2021-11-20 15:10:20', NULL, 3, 3, NULL),
(38, 'Mutiara 4mm maroon kode 51', 19.0000, 1, 'PATRIC', '2021-11-20 15:10:47', '2021-11-20 15:10:47', NULL, 3, 3, NULL),
(39, 'Mutiara 6mm Dusty kode 49 ', 19.0000, 1, 'PATRIC', '2021-11-20 15:11:07', '2021-11-20 15:11:07', NULL, 3, 3, NULL),
(40, 'Mutiara 4mm pink muda kode 61', 19.0000, 1, 'PATRIC', '2021-11-20 15:13:01', '2021-11-20 15:13:01', NULL, 3, 3, NULL),
(41, 'Mutiara 6mm Coklat tua kode 55 ', 19.0000, 1, 'PATRIC', '2021-11-20 15:13:32', '2021-11-20 15:13:32', NULL, 3, 3, NULL),
(42, 'Mutiara 4mm beige kode 9', 19.0000, 1, 'PATRIC', '2021-11-20 15:13:48', '2021-11-20 15:13:48', NULL, 3, 3, NULL),
(43, 'Mutiara 6mm Lavender Kode 52', 19.0000, 1, 'PATRIC', '2021-11-20 15:14:33', '2021-11-20 15:14:33', NULL, 3, 3, NULL),
(44, 'Mutiara 4mm RoseGold Kode 249', 19.0000, 1, 'PATRIC', '2021-11-20 15:15:02', '2021-11-20 15:15:02', NULL, 3, 3, NULL),
(45, 'JASA PAYET RACHEL', 15000.0000, 1, 'HANDMADE', '2021-11-20 15:18:04', '2021-11-20 15:18:04', '2021-11-20 15:18:12', 3, 3, 3),
(46, 'Jasa Payet Rachel', 15000.0000, 1, 'HANDMADE', '2021-11-20 15:18:31', '2021-11-20 15:18:31', '2021-11-20 18:22:15', 3, 3, 3),
(47, 'Jasa Jahit Rachel', 70000.0000, 1, 'In House', '2021-11-20 15:29:21', '2021-11-20 15:29:21', '2021-11-20 18:22:23', 3, 3, 3),
(48, 'Jasa Jahit Hanna', 70000.0000, 1, 'In house', '2021-11-20 15:30:28', '2021-11-20 15:30:57', '2021-11-20 18:23:38', 3, 3, 3),
(49, 'Jasa Jahit Hanna', 35000.0000, 1, 'In House', '2021-11-20 15:30:28', '2021-11-20 15:30:28', '2021-11-20 15:30:35', 3, 3, 3),
(50, 'Biaya Admin', 15000.0000, 1, 'In House', '2021-11-20 16:03:39', '2021-11-20 16:03:39', '2021-11-20 18:23:44', 3, 3, 3),
(51, 'Biaya Foto ', 15000.0000, 1, 'In House', '2021-11-20 16:03:53', '2021-11-20 16:03:53', '2021-11-20 18:23:50', 3, 3, 3),
(52, 'Benang Jahit', 2000.0000, 1, 'CAMPUR', '2021-11-20 16:04:16', '2021-11-20 16:04:16', '2021-11-20 18:23:30', 3, 3, 3),
(53, 'Sleting 50 cm', 2000.0000, 1, 'CAMPUR', '2021-11-20 16:04:41', '2021-11-20 16:04:41', '2021-11-20 20:45:52', 3, 3, 3),
(54, 'Sleting 25 cm', 1500.0000, 1, 'In House', '2021-11-20 16:04:56', '2021-11-20 16:04:56', '2021-11-20 20:56:54', 3, 3, 3),
(55, 'PLASTIK PACKING 35X50', 600.0000, 1, 'AAN', '2021-11-20 16:06:33', '2021-11-20 16:06:33', '2021-11-20 18:23:06', 3, 3, 3),
(56, 'LISTRIK DRESS', 3000.0000, 1, 'In house', '2021-11-20 16:06:56', '2021-11-20 16:11:48', '2021-11-20 18:23:12', 3, 3, 3),
(57, 'KAIN KERAS ', 1000.0000, 1, 'YUSUFSAMSUL', '2021-11-20 16:08:06', '2021-11-20 16:08:06', '2021-11-20 18:01:43', 3, 3, 3),
(58, 'Kain keras Kerah', 1000.0000, 1, 'YUSUFSAMSUL', '2021-11-20 16:13:03', '2021-11-20 16:13:03', '2021-11-20 18:23:01', 3, 3, 3),
(59, 'Kain keras Manset', 1000.0000, 1, 'YUSUFSAMSUL', '2021-11-20 16:13:18', '2021-11-20 16:13:18', '2021-11-20 18:23:17', 3, 3, 3),
(60, 'Kain keras Belt', 1000.0000, 1, 'YUSUFSAMSUL', '2021-11-20 16:13:36', '2021-11-20 16:13:36', '2021-11-20 18:22:55', 3, 3, 3),
(61, 'Hak Jahit \"MASSAG', 500.0000, 1, 'JAHITMART', '2021-11-20 16:14:02', '2021-11-20 16:14:02', NULL, 3, 3, NULL),
(62, 'Jasa potong Rachel', 3500.0000, 1, 'In House', '2021-11-20 18:02:08', '2021-11-20 18:02:08', '2021-11-20 18:22:33', 3, 3, 3),
(63, 'Loop Pin', 100.0000, 1, 'CAMPUR', '2021-11-20 18:02:43', '2021-11-20 18:02:43', '2021-11-20 18:22:28', 3, 3, 3),
(64, 'Plastik Tanpa Plong 35X50', 500.0000, 1, 'CAMPUR', '2021-11-20 18:03:23', '2021-11-20 18:03:23', '2021-11-20 18:20:23', 3, 3, 3),
(65, 'Print Alamat', 500.0000, 1, 'CAMPUR', '2021-11-20 18:03:47', '2021-11-20 18:03:47', '2021-11-20 18:20:14', 3, 3, 3),
(66, 'Label Print Unboxing', 500.0000, 1, 'CAMPUR', '2021-11-20 18:04:11', '2021-11-20 18:04:11', '2021-11-20 18:20:07', 3, 3, 3),
(67, 'Label size', 50.0000, 1, 'CAMPUR', '2021-11-20 18:09:17', '2021-11-20 18:09:17', '2021-11-20 18:19:54', 3, 3, 3),
(68, 'Label Angka', 50.0000, 1, 'CAMPUR', '2021-11-20 18:09:28', '2021-11-20 18:09:28', '2021-11-20 18:20:00', 3, 3, 3),
(69, 'Label Leher Brand', 500.0000, 1, 'CIPTA', '2021-11-20 18:09:46', '2021-11-20 18:09:46', '2021-11-20 18:19:47', 3, 3, 3),
(70, 'LADY ZARA - KMI ', 19800.0000, 3, 'KMI', '2021-11-20 18:24:26', '2021-11-20 18:24:26', NULL, 3, 3, NULL),
(71, 'CERUTI ARMANI - KMI', 15960.0000, 3, 'KMI', '2021-11-20 18:24:55', '2021-11-20 18:24:55', NULL, 3, 3, NULL),
(72, 'TULE MUTIARA @D\'FASHION', 30000.0000, 3, 'D\'FASHION', '2021-11-20 18:27:51', '2021-11-20 18:27:51', NULL, 3, 3, NULL),
(73, 'BIAYA PACKING-FOTO-ADM ', 35000.0000, 1, 'In House', '2021-11-20 18:28:52', '2021-11-20 18:28:52', '2021-11-20 21:16:25', 3, 3, 3),
(74, 'BIAYA JAHIT RACHEL ', 70000.0000, 1, 'In House', '2021-11-20 18:29:18', '2021-11-20 18:29:18', '2021-11-20 21:20:23', 3, 3, 3),
(75, 'BIAYA PAYET RACHEL', 15000.0000, 1, 'In House', '2021-11-20 18:29:29', '2021-11-20 18:29:29', '2021-11-20 21:20:51', 3, 3, 3),
(76, 'LISTRIK', 3000.0000, 1, 'In House', '2021-11-20 18:29:59', '2021-11-20 18:29:59', NULL, 3, 3, NULL),
(77, 'KAIN KERAS KERAH', 1000.0000, 1, 'In House', '2021-11-20 18:30:20', '2021-11-20 18:30:20', '2021-11-20 20:57:19', 3, 3, 3),
(78, 'KAIN KERAS MANSET', 1000.0000, 1, 'In House', '2021-11-20 18:30:35', '2021-11-20 18:30:35', '2021-11-20 21:20:43', 3, 3, 3),
(79, 'KAIN KERAS BELT', 1000.0000, 1, 'In House', '2021-11-20 18:30:49', '2021-11-20 18:30:49', '2021-11-20 21:17:10', 3, 3, 3),
(80, 'HAK JAHIT \"MASSAG', 500.0000, 1, 'CAMPUR', '2021-11-20 18:33:33', '2021-11-20 18:33:33', NULL, 3, 3, NULL),
(81, 'LABEL LEHER BRAND', 500.0000, 1, 'In House', '2021-11-20 18:34:17', '2021-11-20 18:34:17', '2021-11-20 21:16:43', 3, 3, 3),
(82, 'LABEL SIZE', 50.0000, 1, 'In House', '2021-11-20 18:34:33', '2021-11-20 18:34:33', '2021-11-20 21:17:03', 3, 3, 3),
(83, 'LABEL ANGKA', 50.0000, 1, 'In House', '2021-11-20 18:34:46', '2021-11-20 18:34:46', '2021-11-20 20:56:40', 3, 3, 3),
(84, 'BENANG JAHIT', 2000.0000, 1, 'CAMPUR', '2021-11-20 18:35:04', '2021-11-20 18:35:04', '2021-11-20 21:16:34', 3, 3, 3),
(85, 'BENANG OBRAS', 4000.0000, 1, 'CAMPUR', '2021-11-20 18:35:16', '2021-11-20 18:35:16', '2021-11-20 21:16:57', 3, 3, 3),
(86, 'BIAYA POTONG RACHEL', 3500.0000, 1, 'In House', '2021-11-20 18:35:33', '2021-11-20 18:35:33', '2021-11-20 21:20:58', 3, 3, 3),
(87, 'PAYET PATAH ABU DOFF @PUSACHO', 5000.0000, 1, 'PUSACHO', '2021-11-20 18:37:14', '2021-11-20 18:37:14', NULL, 3, 3, NULL),
(88, 'JASA JAHIT BUNA', 35000.0000, 1, 'In House', '2021-11-20 21:18:00', '2021-11-20 21:18:00', '2021-11-20 21:22:42', 3, 3, 3),
(89, 'JASA PAYET BUNA', 20000.0000, 1, 'In House', '2021-11-20 21:18:31', '2021-11-20 21:18:31', '2021-11-20 21:20:12', 3, 3, 3),
(90, 'JASA JAHIT SOFIA', 60000.0000, 1, 'In house', '2021-11-20 21:20:04', '2021-11-20 21:23:19', NULL, 3, 3, NULL),
(91, 'JASA JAHIT RACHEL', 70000.0000, 1, 'In house', '2021-11-20 21:21:24', '2021-11-20 21:23:33', NULL, 3, 3, NULL),
(92, 'JASA JAHIT SALMA', 60000.0000, 1, 'In house', '2021-11-20 21:22:23', '2021-11-20 21:23:44', NULL, 3, 3, NULL),
(93, 'JASA JAHIT BUNA', 60000.0000, 1, 'In House', '2021-11-20 21:23:02', '2021-11-20 21:23:02', NULL, 3, 3, NULL),
(94, 'JASA JAHIT ASYA', 60000.0000, 1, 'In House', '2021-11-20 21:24:13', '2021-11-20 21:24:13', NULL, 3, 3, NULL),
(95, 'JASA JAHIT HANNA', 60000.0000, 1, 'In House', '2021-11-20 21:25:10', '2021-11-20 21:25:10', NULL, 3, 3, NULL),
(96, 'JASA JAHIT WILONA', 50000.0000, 1, 'In House', '2021-11-20 21:25:37', '2021-11-20 21:25:37', NULL, 3, 3, NULL),
(97, 'JASA JAHIT VANESA', 60000.0000, 1, 'In House', '2021-11-20 21:26:20', '2021-11-20 21:26:20', NULL, 3, 3, NULL),
(98, 'JASA JAHIT WIDURI', 55000.0000, 1, 'In House', '2021-11-20 21:27:40', '2021-11-20 21:27:40', NULL, 3, 3, NULL),
(99, 'JASA JAHIT INTAN', 55000.0000, 1, 'In House', '2021-11-20 21:27:55', '2021-11-20 21:27:55', NULL, 3, 3, NULL),
(100, 'JASA JAHIT ANJELI', 50000.0000, 1, 'In house', '2021-11-20 21:28:19', '2021-11-20 21:28:51', NULL, 3, 3, NULL),
(101, 'JASA JAHIT JOANA', 50000.0000, 1, 'In House', '2021-11-20 21:28:39', '2021-11-20 21:28:39', NULL, 3, 3, NULL),
(102, 'JASA JAHIT PINKAN', 60000.0000, 1, 'In House', '2021-11-20 21:29:26', '2021-11-20 21:29:26', NULL, 3, 3, NULL),
(103, 'JASA JAHIT MAWAR', 70000.0000, 1, 'In House', '2021-11-20 21:29:52', '2021-11-20 21:29:52', NULL, 3, 3, NULL),
(104, 'JASA JAHIT ASYA', 55000.0000, 1, 'In House', '2021-11-20 21:30:52', '2021-11-20 21:30:52', NULL, 3, 3, NULL),
(105, 'JASA JAHIT SANSAN', 50000.0000, 1, 'In House', '2021-11-20 21:31:31', '2021-11-20 21:31:31', NULL, 3, 3, NULL),
(106, 'JASA JAHIT RAHMA', 50000.0000, 1, 'In House', '2021-11-20 21:31:47', '2021-11-20 21:31:47', NULL, 3, 3, NULL),
(107, 'JASA JAHIT SALSA', 50000.0000, 1, 'In House', '2021-11-20 21:32:19', '2021-11-20 21:32:19', NULL, 3, 3, NULL),
(108, 'JASA JAHIT DESTI', 50000.0000, 1, 'In House', '2021-11-20 21:32:43', '2021-11-20 21:32:43', NULL, 3, 3, NULL),
(109, 'JASA JAHIT BINA SLIM', 50000.0000, 1, 'In House', '2021-11-20 21:33:46', '2021-11-20 21:33:46', NULL, 3, 3, NULL),
(110, 'JASA JAHIT BINA DRESS', 50000.0000, 1, 'In House', '2021-11-20 21:34:54', '2021-11-20 21:34:54', NULL, 3, 3, NULL),
(111, 'JASA JAHIT KANKAN DRESS', 50000.0000, 1, 'In House', '2021-11-20 21:35:35', '2021-11-20 21:35:35', NULL, 3, 3, NULL);

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
  `product_price` decimal(19,4) DEFAULT NULL,
  `color_id` int(10) UNSIGNED NOT NULL,
  `size_id` int(10) UNSIGNED NOT NULL,
  `size_price` decimal(19,4) DEFAULT NULL,
  `pilih_jahitan` enum('standard','express','urgent','super urgent') NOT NULL,
  `pilih_jahitan_price` decimal(19,4) DEFAULT NULL,
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
  `path_image_2` varchar(255) DEFAULT NULL,
  `path_image_3` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `status` enum('temp','active') DEFAULT NULL,
  `sold` int(10) UNSIGNED DEFAULT 0,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL,
  `deleted_by` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

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
(1, 'Pekgo Apparel', 'PKG', 'logo_grey.png', '2021-10-24 02:40:23', '2021-11-04 11:07:43', NULL, 1, 1, NULL),
(2, 'test', 'test', 'fc543dcb36d93b83d745c468e21261df.png', '2021-11-04 11:08:14', '2021-11-04 11:08:14', '2021-11-04 11:21:42', 1, 1, 1);

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
(2, 'REQUEST (+) PB', 20000.0000, '2021-11-02 20:32:17', '2021-11-02 20:32:17', NULL, 1, 1, NULL),
(3, 'test1', 1.0000, '2021-11-13 20:49:03', '2021-11-13 20:49:03', '2021-11-13 20:49:11', 1, 1, 1),
(4, 'Potong Panjang Baju', 20000.0000, '2021-11-20 12:27:32', '2021-11-20 12:27:32', NULL, 1, 1, NULL),
(5, 'Tambah Panjang Baju', 25000.0000, '2021-11-20 12:27:41', '2021-11-20 12:27:41', NULL, 1, 1, NULL),
(6, 'Busui', 25000.0000, '2021-11-20 12:28:11', '2021-11-20 12:28:11', NULL, 1, 1, NULL),
(7, 'Wudhu', 25000.0000, '2021-11-20 12:28:39', '2021-11-20 12:28:39', NULL, 1, 1, NULL),
(8, 'Bumil (pinggang naikan 3 cm)', 30000.0000, '2021-11-20 12:28:54', '2021-11-20 12:28:54', NULL, 1, 1, NULL),
(9, 'Request Size (LD)', 35000.0000, '2021-11-20 12:29:08', '2021-11-20 12:29:08', NULL, 1, 1, NULL),
(10, 'Request Size Custom', 100000.0000, '2021-11-20 12:29:21', '2021-11-20 12:29:21', NULL, 1, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sequence_orders`
--

CREATE TABLE `sequence_orders` (
  `id` int(10) UNSIGNED NOT NULL,
  `sequence` int(10) UNSIGNED NOT NULL,
  `created_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `sequence_products`
--

CREATE TABLE `sequence_products` (
  `id` int(10) UNSIGNED NOT NULL,
  `sequence` int(10) UNSIGNED NOT NULL,
  `created_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

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
(1, 'S', 0.0000, '2021-10-24 23:02:30', '2021-10-24 23:02:30', '2021-11-20 12:29:58', 1, 1, 3),
(2, 'M', 0.0000, '2021-10-24 23:04:30', '2021-10-24 23:04:30', '2021-11-20 12:30:03', 1, 1, 3),
(3, 'L', 0.0000, '2021-10-24 23:06:01', '2021-10-24 23:06:01', '2021-11-20 12:30:08', 1, 1, 3),
(4, 'XL', 50000.0000, '2021-11-02 20:31:12', '2021-11-02 20:31:12', '2021-11-20 12:30:11', 1, 1, 3),
(5, 'XXL', 50000.0000, '2021-11-02 20:31:18', '2021-11-02 20:31:18', '2021-11-20 12:30:15', 1, 1, 3),
(6, 'test1', 1.0000, '2021-11-13 20:48:40', '2021-11-13 20:48:40', '2021-11-13 20:48:53', 1, 1, 1),
(7, 'XS', 0.0000, '2021-11-20 12:27:39', '2021-11-20 12:27:39', '2021-11-20 12:30:18', 3, 3, 3),
(8, 'CUSTOM ', 100000.0000, '2021-11-20 12:29:10', '2021-11-20 12:29:10', '2021-11-20 12:29:18', 3, 3, 3),
(9, 'XS', 0.0000, '2021-11-20 12:30:26', '2021-11-20 12:30:26', NULL, 3, 3, NULL),
(10, 'S', 0.0000, '2021-11-20 12:30:31', '2021-11-20 12:30:31', NULL, 3, 3, NULL),
(11, 'M', 0.0000, '2021-11-20 12:30:35', '2021-11-20 12:30:35', NULL, 3, 3, NULL),
(12, 'L', 0.0000, '2021-11-20 12:30:42', '2021-11-20 12:30:42', NULL, 3, 3, NULL),
(13, 'XL', 50000.0000, '2021-11-20 12:30:48', '2021-11-20 12:30:48', NULL, 3, 3, NULL),
(14, 'XXL', 50000.0000, '2021-11-20 12:30:54', '2021-11-20 12:30:54', NULL, 3, 3, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

CREATE TABLE `test` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
(3, 'Meter', '2021-10-26 00:52:16', '2021-10-26 00:52:16', NULL, 1, 1, NULL),
(4, 'test', '2021-11-13 16:21:12', '2021-11-13 16:21:12', '2021-11-13 16:21:17', 1, 1, 1),
(5, 'Gram', '2021-11-20 12:26:40', '2021-11-20 12:26:40', NULL, 3, 3, NULL),
(6, 'Cm', '2021-11-20 12:45:43', '2021-11-20 12:45:43', NULL, 3, 3, NULL);

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
-- Indexes for table `test`
--
ALTER TABLE `test`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `colors`
--
ALTER TABLE `colors`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1005;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `hpps`
--
ALTER TABLE `hpps`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(10) UNSIGNED NOT NULL AUTO_INCREMENT;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_color_params`
--
ALTER TABLE `product_color_params`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_hpp_params`
--
ALTER TABLE `product_hpp_params`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_request_params`
--
ALTER TABLE `product_request_params`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_size_params`
--
ALTER TABLE `product_size_params`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `sequence_orders`
--
ALTER TABLE `sequence_orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sequence_products`
--
ALTER TABLE `sequence_products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sizes`
--
ALTER TABLE `sizes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `test`
--
ALTER TABLE `test`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
