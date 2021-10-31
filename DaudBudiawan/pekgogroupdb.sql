/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MariaDB
 Source Server Version : 100421
 Source Host           : localhost:3306
 Source Schema         : pekgogroupdb

 Target Server Type    : MariaDB
 Target Server Version : 100421
 File Encoding         : 65001

 Date: 01/11/2021 00:22:32
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for admins
-- ----------------------------
DROP TABLE IF EXISTS `admins`;
CREATE TABLE `admins`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `whatsapp` varchar(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `name` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `role` enum('cs','order','finance','produksi','owner','developer','komisaris') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status` enum('aktif','tidak aktif') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  `deleted_at` datetime NULL DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `updated_by` int(10) UNSIGNED NULL DEFAULT NULL,
  `deleted_by` int(10) UNSIGNED NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of admins
-- ----------------------------
INSERT INTO `admins` VALUES (1, '082114578976', '$2y$10$wEoESyhVVXF2Et22AeejK.C3GlPrsnfvyR4046pTsm.gb1XiC9i0W', 'Adam', 'developer', 'aktif', '2021-10-22 20:57:51', '2021-10-30 05:11:04', NULL, 1, 1, NULL);
INSERT INTO `admins` VALUES (2, '085603355799', '$2y$10$kiMo3KzzWPZEnKcPoFJ2JOoro6I9de6HnxEg6trQmQfzFET5YaTrC', 'Nurul', 'order', 'aktif', '2021-10-25 22:48:17', '2021-10-25 22:48:17', NULL, 1, 1, NULL);
INSERT INTO `admins` VALUES (3, '081248892735', '$2y$10$8kPtP3F1sNMMIuUN.p7kXOl/nIcKMoFcKTvczlk2lNTVe6Uikodgu', 'Isanda', 'owner', 'aktif', '2021-10-30 05:10:38', '2021-11-01 00:22:08', NULL, 1, 3, NULL);
INSERT INTO `admins` VALUES (4, '081111111111', '$2y$10$LJM7vcllW5DDMcy8jjxEBe33PrrDduCriHxEJdbVGItKeJiqy2cn2', 'Admin CS', 'cs', 'aktif', '2021-10-30 08:53:16', '2021-10-30 08:53:16', NULL, 3, 3, NULL);
INSERT INTO `admins` VALUES (5, '082222222222', '$2y$10$x7NjiaR/zLJvXfBPupyydu00J2zrbyY9HtCzjXWAxsaX4BdlsZk.S', 'Admin Order', 'order', 'aktif', '2021-10-30 08:53:42', '2021-10-30 08:53:42', NULL, 3, 3, NULL);
INSERT INTO `admins` VALUES (6, '083333333333', '$2y$10$5QVSj.UXFezjgdgfnQW17uuv0vmBkU2J3.mYIk.cUXCZm4zwHMcF2', 'Admin Produksi', 'produksi', 'aktif', '2021-10-30 08:54:04', '2021-10-30 08:54:04', NULL, 3, 3, NULL);
INSERT INTO `admins` VALUES (7, '084444444444', '$2y$10$x9sBLDBPARlSVMmi3atBie0/hqb7GquBs9Wv32QDcpCpgsPzftpRu', 'Admin Finance', 'finance', 'aktif', '2021-10-30 08:57:09', '2021-10-30 08:57:09', NULL, 3, 3, NULL);

-- ----------------------------
-- Table structure for colors
-- ----------------------------
DROP TABLE IF EXISTS `colors`;
CREATE TABLE `colors`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  `deleted_at` datetime NULL DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `updated_by` int(10) UNSIGNED NULL DEFAULT NULL,
  `deleted_by` int(10) UNSIGNED NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of colors
-- ----------------------------
INSERT INTO `colors` VALUES (1, 'Merah', '2021-10-24 22:52:04', '2021-10-24 22:52:04', NULL, 1, 1, NULL);
INSERT INTO `colors` VALUES (2, 'Kuning', '2021-10-24 22:52:12', '2021-10-24 22:52:12', NULL, 1, 1, NULL);
INSERT INTO `colors` VALUES (3, 'test', '2021-10-24 22:52:21', '2021-10-24 22:52:21', '2021-10-24 22:52:24', 1, 1, 1);
INSERT INTO `colors` VALUES (4, 'a', '2021-10-24 22:53:30', '2021-10-24 22:53:30', '2021-10-24 22:53:36', 1, 1, 1);

-- ----------------------------
-- Table structure for customers
-- ----------------------------
DROP TABLE IF EXISTS `customers`;
CREATE TABLE `customers`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `whatsapp` varchar(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `name` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `id_tokped` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `id_shopee` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `id_instagram` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `order_created` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `order_canceled` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `order_total` decimal(19, 4) UNSIGNED NOT NULL DEFAULT 0.0000,
  `status` enum('aktif','tidak aktif') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `reason_inactive` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  `deleted_at` datetime NULL DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `updated_by` int(10) UNSIGNED NULL DEFAULT NULL,
  `deleted_by` int(10) UNSIGNED NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of customers
-- ----------------------------
INSERT INTO `customers` VALUES (1, '082114578976', '$2y$10$q.w3lEA9LnkxHYkancZofOP5Xwsx/CtBUVIe8KZmtxLfALOuOjgB6', 'Adam', 'adampm77', 'adampm77', 'adampm77', 0, 0, 0.0000, 'aktif', NULL, '2021-10-25 05:41:57', '2021-10-25 20:30:49', NULL, 1, 1, NULL);

-- ----------------------------
-- Table structure for employees
-- ----------------------------
DROP TABLE IF EXISTS `employees`;
CREATE TABLE `employees`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `role` enum('potong kain','penjahit','qc','aksesoris') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `path_photo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  `deleted_at` datetime NULL DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `updated_by` int(10) UNSIGNED NULL DEFAULT NULL,
  `deleted_by` int(10) UNSIGNED NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of employees
-- ----------------------------
INSERT INTO `employees` VALUES (1, 'Udin', 'potong kain', '9fa8d88657da07f72fccd88efb5e009c.jpg', '2021-10-26 00:12:01', '2021-10-26 00:12:01', NULL, 1, 1, NULL);
INSERT INTO `employees` VALUES (2, 'Budi', 'penjahit', '47d5e5f2882cf9c944bc34ff633b98b0.jpg', '2021-10-30 10:54:41', '2021-10-30 10:54:41', NULL, 3, 3, NULL);
INSERT INTO `employees` VALUES (3, 'Ujang', 'qc', 'a5bab09a0295e9d49297d30e8577afbc.jpg', '2021-10-30 10:54:50', '2021-10-30 10:54:50', NULL, 3, 3, NULL);
INSERT INTO `employees` VALUES (4, 'Mamat', 'aksesoris', 'e8c914912907e953f59f0aabcc3832ad.jpg', '2021-10-30 10:55:14', '2021-10-30 10:55:14', NULL, 3, 3, NULL);

-- ----------------------------
-- Table structure for hpps
-- ----------------------------
DROP TABLE IF EXISTS `hpps`;
CREATE TABLE `hpps`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `cost` decimal(19, 4) NOT NULL,
  `unit_id` int(10) UNSIGNED NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  `deleted_at` datetime NULL DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `updated_by` int(10) UNSIGNED NULL DEFAULT NULL,
  `deleted_by` int(10) UNSIGNED NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of hpps
-- ----------------------------
INSERT INTO `hpps` VALUES (1, 'KAIN CERUTI', 20000.0000, 3, '2021-10-26 00:52:28', '2021-10-26 00:52:28', NULL, 1, 1, NULL);

-- ----------------------------
-- Table structure for order_payments
-- ----------------------------
DROP TABLE IF EXISTS `order_payments`;
CREATE TABLE `order_payments`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `order_id` int(10) UNSIGNED NOT NULL,
  `customer_id` int(10) UNSIGNED NOT NULL,
  `path_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status_pembayaran` enum('menunggu verifikasi','valid','ditolak') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `alasan_penolakan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `jenis_pembayaran` enum('dp','pelunasan') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  `deleted_at` datetime NULL DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `updated_by` int(10) UNSIGNED NULL DEFAULT NULL,
  `deleted_by` int(10) UNSIGNED NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of order_payments
-- ----------------------------
INSERT INTO `order_payments` VALUES (3, 233, 1, 'photo1.png', 'ditolak', 'test penolakan', 'dp', '2021-10-31 09:07:16', '2021-10-31 19:41:49', NULL, 1, 3, NULL);
INSERT INTO `order_payments` VALUES (5, 233, 1, '0d4d6ea95289e3cd26e1d91da44ef7e8.png', 'valid', NULL, 'dp', '2021-11-01 00:03:21', '2021-11-01 00:03:21', NULL, 3, 3, NULL);
INSERT INTO `order_payments` VALUES (6, 233, 1, '4df4afeeb384c83266cd7c16f0fdf1d5.png', 'valid', NULL, 'pelunasan', '2021-11-01 00:15:00', '2021-11-01 00:16:12', NULL, 3, 3, NULL);
INSERT INTO `order_payments` VALUES (7, 239, 1, 'ee7a710991656a5eb00c6d8d1c285b03.png', 'valid', NULL, 'dp', '2021-10-31 23:00:00', '2021-11-01 00:16:22', NULL, 3, 3, NULL);
INSERT INTO `order_payments` VALUES (8, 239, 1, '00b19bce2424f6c915ff9537396cbdda.png', 'valid', NULL, 'pelunasan', '2021-11-01 00:15:00', '2021-11-01 00:16:32', NULL, 3, 3, NULL);

-- ----------------------------
-- Table structure for order_productions
-- ----------------------------
DROP TABLE IF EXISTS `order_productions`;
CREATE TABLE `order_productions`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `order_id` int(10) UNSIGNED NOT NULL,
  `petugas_potong_kain` int(10) UNSIGNED NULL DEFAULT NULL,
  `tanggal_potong_kain` date NULL DEFAULT NULL,
  `petugas_qc_1` int(10) UNSIGNED NULL DEFAULT NULL,
  `tanggal_qc_1` date NULL DEFAULT NULL,
  `petugas_aksesoris` int(10) UNSIGNED NULL DEFAULT NULL,
  `tanggal_aksesoris` date NULL DEFAULT NULL,
  `petugas_qc_2` int(10) UNSIGNED NULL DEFAULT NULL,
  `tanggal_qc_2` date NULL DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  `deleted_at` datetime NULL DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `updated_by` int(10) UNSIGNED NULL DEFAULT NULL,
  `deleted_by` int(10) UNSIGNED NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of order_productions
-- ----------------------------

-- ----------------------------
-- Table structure for order_requests
-- ----------------------------
DROP TABLE IF EXISTS `order_requests`;
CREATE TABLE `order_requests`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `request_id` int(10) UNSIGNED NOT NULL,
  `cost` decimal(19, 4) UNSIGNED NOT NULL DEFAULT 0.0000,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  `deleted_at` datetime NULL DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `updated_by` int(10) UNSIGNED NULL DEFAULT NULL,
  `deleted_by` int(10) UNSIGNED NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 28 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of order_requests
-- ----------------------------
INSERT INTO `order_requests` VALUES (16, 206, 1, 10000.0000, '2021-10-30 05:02:19', NULL, NULL, 1, NULL, NULL);
INSERT INTO `order_requests` VALUES (24, 233, 1, 10000.0000, '2021-10-30 07:42:29', '2021-10-30 07:43:04', NULL, 3, 3, NULL);
INSERT INTO `order_requests` VALUES (27, 239, 7, 10000.0000, '2021-10-31 03:06:56', '2021-10-31 03:07:12', NULL, 3, 3, NULL);

-- ----------------------------
-- Table structure for orders
-- ----------------------------
DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders`  (
  `id` bigint(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `project_id` int(10) UNSIGNED NOT NULL,
  `sales_invoice` varchar(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `durasi_batas_transfer` enum('3','5','24') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `batas_waktu_transfer` datetime NOT NULL,
  `estimasi_selesai` date NULL DEFAULT NULL,
  `order_via` enum('web','wa','tokped','shopee','offline') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `color_id` int(10) UNSIGNED NOT NULL,
  `size_id` int(10) UNSIGNED NOT NULL,
  `pilih_jahitan` enum('standard','express','urgent','super urgent') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `catatan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `customer_id` int(10) UNSIGNED NOT NULL,
  `whatsapp` varchar(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `id_tokped` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `id_shopee` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `id_instagram` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `status_order` enum('order dibuat','naik produksi','pengiriman','selesai','order dibatalkan','retur pending','retur terkirim','refund') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status_pembayaran` enum('menunggu pembayaran','partial','lunas','melewati batas transfer','refund pending','refund selesai') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `sub_total` decimal(19, 4) UNSIGNED NOT NULL DEFAULT 0.0000,
  `kode_unik` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `grand_total` decimal(19, 5) UNSIGNED NOT NULL DEFAULT 0.00000,
  `jenis_dp` enum('30','50','100') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `dp_value` decimal(19, 4) UNSIGNED NOT NULL DEFAULT 0.0000,
  `pelunasan_value` decimal(19, 4) UNSIGNED NOT NULL DEFAULT 0.0000,
  `terbayarkan` decimal(19, 4) UNSIGNED NOT NULL DEFAULT 0.0000,
  `tanggal_pengiriman` datetime NULL DEFAULT NULL,
  `ekspedisi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `no_resi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `admin_order` int(11) NOT NULL,
  `alamat_pengiriman` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `admin_finance` int(11) NULL DEFAULT NULL,
  `admin_cs` int(11) NULL DEFAULT NULL,
  `admin_produksi` int(11) NULL DEFAULT NULL,
  `is_printed` enum('no','yes') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'no',
  `is_production` enum('no','yes') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'no',
  `is_paid_off` enum('no','yes') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'no',
  `status` enum('temp','active') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NOT NULL COMMENT 'berlaku sebagai tangga & jam order',
  `updated_at` datetime NULL DEFAULT NULL,
  `deleted_at` datetime NULL DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `updated_by` int(10) UNSIGNED NULL DEFAULT NULL,
  `deleted_by` int(10) UNSIGNED NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 241 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of orders
-- ----------------------------
INSERT INTO `orders` VALUES (206, 0, 'PKG.30.10.21011', '', '0000-00-00 00:00:00', NULL, '', 1, 1, 3, '', NULL, 0, '', NULL, NULL, NULL, '', '', 0.0000, 11, 0.00000, '', 0.0000, 0.0000, 0.0000, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 'no', 'no', 'no', 'temp', '2021-10-30 05:01:33', '2021-10-30 05:01:33', NULL, 1, 1, NULL);
INSERT INTO `orders` VALUES (233, 1, 'PKG.30.10.21038', '3', '2021-10-30 10:41:43', '2021-11-29', 'wa', 1, 1, 3, 'standard', 'test', 1, '082114578976', 'adampm77', 'adampm77', 'adampm77', 'order dibuat', 'lunas', 360000.0000, 38, 360038.00000, '30', 108011.4000, 252026.6000, 360038.0000, NULL, NULL, NULL, 3, NULL, 3, NULL, NULL, 'no', 'no', 'yes', 'active', '2021-10-30 07:41:43', '2021-11-01 00:16:12', NULL, 3, 3, NULL);
INSERT INTO `orders` VALUES (239, 1, 'PKG.31.10.21005', '3', '2021-10-31 06:06:40', '2021-11-14', 'wa', 8, 8, 12, 'express', 'test', 1, '082114578976', 'adampm77', 'adampm77', 'adampm77', 'order dibuat', 'lunas', 610000.0000, 5, 610005.00000, '30', 183001.5000, 427003.5000, 610005.0000, NULL, NULL, NULL, 3, NULL, 3, NULL, NULL, 'no', 'no', 'yes', 'active', '2021-10-31 03:06:40', '2021-11-01 00:16:32', NULL, 3, 3, NULL);
INSERT INTO `orders` VALUES (240, 0, 'PKG.31.10.21006', '', '0000-00-00 00:00:00', NULL, '', 0, 0, 0, '', NULL, 0, '', NULL, NULL, NULL, '', '', 0.0000, 6, 0.00000, '', 0.0000, 0.0000, 0.0000, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 'no', 'no', 'no', 'temp', '2021-10-31 03:07:12', '2021-10-31 03:07:12', NULL, 3, 3, NULL);

-- ----------------------------
-- Table structure for product_color_params
-- ----------------------------
DROP TABLE IF EXISTS `product_color_params`;
CREATE TABLE `product_color_params`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `product_id` int(10) UNSIGNED NOT NULL,
  `color_id` int(10) UNSIGNED NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  `deleted_at` datetime NULL DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `updated_by` int(10) UNSIGNED NULL DEFAULT NULL,
  `deleted_by` int(10) UNSIGNED NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of product_color_params
-- ----------------------------
INSERT INTO `product_color_params` VALUES (1, 1, 1, '2021-10-28 01:18:48', '2021-10-28 01:18:48', NULL, 1, 1, NULL);
INSERT INTO `product_color_params` VALUES (2, 1, 2, '2021-10-28 01:18:48', '2021-10-28 01:18:48', NULL, 1, 1, NULL);
INSERT INTO `product_color_params` VALUES (3, 2, 1, '2021-10-29 02:57:49', '2021-10-29 02:57:49', NULL, 1, 1, NULL);
INSERT INTO `product_color_params` VALUES (4, 2, 2, '2021-10-29 02:57:49', '2021-10-29 02:57:49', NULL, 1, 1, NULL);
INSERT INTO `product_color_params` VALUES (5, 5, 1, '2021-10-29 03:00:39', '2021-10-29 03:00:39', NULL, 1, 1, NULL);
INSERT INTO `product_color_params` VALUES (6, 5, 2, '2021-10-29 03:00:39', '2021-10-29 03:00:39', NULL, 1, 1, NULL);
INSERT INTO `product_color_params` VALUES (7, 8, 1, '2021-10-29 03:02:48', '2021-10-29 03:02:48', NULL, 1, 1, NULL);
INSERT INTO `product_color_params` VALUES (8, 8, 2, '2021-10-29 03:02:48', '2021-10-29 03:02:48', NULL, 1, 1, NULL);

-- ----------------------------
-- Table structure for product_hpp_params
-- ----------------------------
DROP TABLE IF EXISTS `product_hpp_params`;
CREATE TABLE `product_hpp_params`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `product_id` int(10) UNSIGNED NOT NULL,
  `hpp_id` int(10) UNSIGNED NOT NULL,
  `qty` decimal(19, 4) UNSIGNED NOT NULL,
  `basic_price` decimal(19, 4) UNSIGNED NOT NULL DEFAULT 0.0000,
  `total_price` decimal(19, 4) UNSIGNED NOT NULL DEFAULT 0.0000,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  `deleted_at` datetime NULL DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `updated_by` int(10) UNSIGNED NULL DEFAULT NULL,
  `deleted_by` int(10) UNSIGNED NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of product_hpp_params
-- ----------------------------
INSERT INTO `product_hpp_params` VALUES (1, 1, 1, 1.0000, 20000.0000, 20000.0000, '2021-10-28 01:18:45', '2021-10-28 01:18:48', NULL, 1, 1, NULL);
INSERT INTO `product_hpp_params` VALUES (6, 8, 1, 1.0000, 20000.0000, 20000.0000, '2021-10-29 03:02:44', '2021-10-29 03:02:48', NULL, 1, 1, NULL);

-- ----------------------------
-- Table structure for product_request_params
-- ----------------------------
DROP TABLE IF EXISTS `product_request_params`;
CREATE TABLE `product_request_params`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `product_id` int(10) UNSIGNED NOT NULL,
  `request_id` int(10) UNSIGNED NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  `deleted_at` datetime NULL DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `updated_by` int(10) UNSIGNED NULL DEFAULT NULL,
  `deleted_by` int(10) UNSIGNED NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of product_request_params
-- ----------------------------
INSERT INTO `product_request_params` VALUES (1, 1, 1, '2021-10-28 01:18:48', '2021-10-28 01:18:48', NULL, 1, 1, NULL);
INSERT INTO `product_request_params` VALUES (2, 1, 2, '2021-10-28 01:18:48', '2021-10-28 01:18:48', NULL, 1, 1, NULL);
INSERT INTO `product_request_params` VALUES (3, 2, 1, '2021-10-29 02:57:49', '2021-10-29 02:57:49', NULL, 1, 1, NULL);
INSERT INTO `product_request_params` VALUES (4, 2, 2, '2021-10-29 02:57:49', '2021-10-29 02:57:49', NULL, 1, 1, NULL);
INSERT INTO `product_request_params` VALUES (5, 5, 1, '2021-10-29 03:00:39', '2021-10-29 03:00:39', NULL, 1, 1, NULL);
INSERT INTO `product_request_params` VALUES (6, 5, 2, '2021-10-29 03:00:39', '2021-10-29 03:00:39', NULL, 1, 1, NULL);
INSERT INTO `product_request_params` VALUES (7, 8, 1, '2021-10-29 03:02:48', '2021-10-29 03:02:48', NULL, 1, 1, NULL);
INSERT INTO `product_request_params` VALUES (8, 8, 2, '2021-10-29 03:02:48', '2021-10-29 03:02:48', NULL, 1, 1, NULL);

-- ----------------------------
-- Table structure for product_size_params
-- ----------------------------
DROP TABLE IF EXISTS `product_size_params`;
CREATE TABLE `product_size_params`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `product_id` int(10) UNSIGNED NOT NULL,
  `size_id` int(10) UNSIGNED NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  `deleted_at` datetime NULL DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `updated_by` int(10) UNSIGNED NULL DEFAULT NULL,
  `deleted_by` int(10) UNSIGNED NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of product_size_params
-- ----------------------------
INSERT INTO `product_size_params` VALUES (1, 1, 1, '2021-10-28 01:18:48', '2021-10-28 01:18:48', NULL, 1, 1, NULL);
INSERT INTO `product_size_params` VALUES (2, 1, 2, '2021-10-28 01:18:48', '2021-10-28 01:18:48', NULL, 1, 1, NULL);
INSERT INTO `product_size_params` VALUES (3, 1, 3, '2021-10-28 01:18:48', '2021-10-28 01:18:48', NULL, 1, 1, NULL);
INSERT INTO `product_size_params` VALUES (4, 2, 1, '2021-10-29 02:57:49', '2021-10-29 02:57:49', NULL, 1, 1, NULL);
INSERT INTO `product_size_params` VALUES (5, 2, 2, '2021-10-29 02:57:49', '2021-10-29 02:57:49', NULL, 1, 1, NULL);
INSERT INTO `product_size_params` VALUES (6, 2, 3, '2021-10-29 02:57:49', '2021-10-29 02:57:49', NULL, 1, 1, NULL);
INSERT INTO `product_size_params` VALUES (7, 5, 1, '2021-10-29 03:00:39', '2021-10-29 03:00:39', NULL, 1, 1, NULL);
INSERT INTO `product_size_params` VALUES (8, 5, 2, '2021-10-29 03:00:39', '2021-10-29 03:00:39', NULL, 1, 1, NULL);
INSERT INTO `product_size_params` VALUES (9, 5, 3, '2021-10-29 03:00:39', '2021-10-29 03:00:39', NULL, 1, 1, NULL);
INSERT INTO `product_size_params` VALUES (10, 8, 1, '2021-10-29 03:02:48', '2021-10-29 03:02:48', NULL, 1, 1, NULL);
INSERT INTO `product_size_params` VALUES (11, 8, 2, '2021-10-29 03:02:48', '2021-10-29 03:02:48', NULL, 1, 1, NULL);
INSERT INTO `product_size_params` VALUES (12, 8, 3, '2021-10-29 03:02:48', '2021-10-29 03:02:48', NULL, 1, 1, NULL);

-- ----------------------------
-- Table structure for products
-- ----------------------------
DROP TABLE IF EXISTS `products`;
CREATE TABLE `products`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `code` varchar(14) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'P.31.12.21.001 | (P.tanggal.bulan.tahun.kode_urut)',
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `price` decimal(19, 4) UNSIGNED NOT NULL,
  `path_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `status` enum('temp','active') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  `deleted_at` datetime NULL DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `updated_by` int(10) UNSIGNED NULL DEFAULT NULL,
  `deleted_by` int(10) UNSIGNED NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of products
-- ----------------------------
INSERT INTO `products` VALUES (1, 'P.28.10.21001', 'TEST PRODUK', 300000.0000, '51194d5f49ed80fb7760f6a7b3d43fe8.jpg', 'active', '2021-10-28 01:18:11', '2021-10-28 01:18:48', NULL, 1, 1, NULL);
INSERT INTO `products` VALUES (8, 'P.29.10.21007', 'BAJU A', 500000.0000, '3e8e952aa0c9476fa590a899d14144ea.jpg', 'active', '2021-10-29 03:02:32', '2021-10-29 03:02:48', NULL, 1, 1, NULL);

-- ----------------------------
-- Table structure for projects
-- ----------------------------
DROP TABLE IF EXISTS `projects`;
CREATE TABLE `projects`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `abbr` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `path_logo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'size 512x512px',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  `deleted_at` datetime NULL DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `updated_by` int(10) UNSIGNED NULL DEFAULT NULL,
  `deleted_by` int(10) UNSIGNED NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of projects
-- ----------------------------
INSERT INTO `projects` VALUES (1, 'Pekgo Group', 'PKG', '295ddf47902c894678df8fdffddcb1c4.png', '2021-10-24 02:40:23', '2021-10-30 10:51:01', NULL, 1, 3, NULL);

-- ----------------------------
-- Table structure for requests
-- ----------------------------
DROP TABLE IF EXISTS `requests`;
CREATE TABLE `requests`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `cost` decimal(19, 4) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  `deleted_at` datetime NULL DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `updated_by` int(10) UNSIGNED NULL DEFAULT NULL,
  `deleted_by` int(10) UNSIGNED NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of requests
-- ----------------------------
INSERT INTO `requests` VALUES (1, 'REQUEST (-) PB', 10000.0000, '2021-10-24 23:11:16', '2021-10-24 23:11:16', NULL, 1, 1, NULL);
INSERT INTO `requests` VALUES (2, 'REQUEST (+) PB', 20000.0000, '2021-10-24 23:11:24', '2021-10-24 23:11:24', NULL, 1, 1, NULL);
INSERT INTO `requests` VALUES (3, 'test', 1.0000, '2021-10-24 23:16:32', '2021-10-24 23:16:32', '2021-10-24 23:16:35', 1, 1, 1);

-- ----------------------------
-- Table structure for sequence_orders
-- ----------------------------
DROP TABLE IF EXISTS `sequence_orders`;
CREATE TABLE `sequence_orders`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `sequence` int(10) UNSIGNED NOT NULL,
  `created_at` date NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of sequence_orders
-- ----------------------------
INSERT INTO `sequence_orders` VALUES (1, 1, '2021-10-28');
INSERT INTO `sequence_orders` VALUES (2, 194, '2021-10-29');
INSERT INTO `sequence_orders` VALUES (3, 39, '2021-10-30');
INSERT INTO `sequence_orders` VALUES (4, 6, '2021-10-31');

-- ----------------------------
-- Table structure for sequence_products
-- ----------------------------
DROP TABLE IF EXISTS `sequence_products`;
CREATE TABLE `sequence_products`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `sequence` int(10) UNSIGNED NOT NULL,
  `created_at` date NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of sequence_products
-- ----------------------------
INSERT INTO `sequence_products` VALUES (1, 1, '2021-10-28');
INSERT INTO `sequence_products` VALUES (2, 7, '2021-10-29');

-- ----------------------------
-- Table structure for sizes
-- ----------------------------
DROP TABLE IF EXISTS `sizes`;
CREATE TABLE `sizes`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `cost` decimal(19, 4) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  `deleted_at` datetime NULL DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `updated_by` int(10) UNSIGNED NULL DEFAULT NULL,
  `deleted_by` int(10) UNSIGNED NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of sizes
-- ----------------------------
INSERT INTO `sizes` VALUES (1, 'S', 0.0000, '2021-10-24 23:02:30', '2021-10-24 23:02:30', NULL, 1, 1, NULL);
INSERT INTO `sizes` VALUES (2, 'M', 0.0000, '2021-10-24 23:04:30', '2021-10-24 23:04:30', NULL, 1, 1, NULL);
INSERT INTO `sizes` VALUES (3, 'L', 50000.0000, '2021-10-24 23:06:01', '2021-10-24 23:06:01', NULL, 1, 1, NULL);

-- ----------------------------
-- Table structure for units
-- ----------------------------
DROP TABLE IF EXISTS `units`;
CREATE TABLE `units`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  `deleted_at` datetime NULL DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `updated_by` int(10) UNSIGNED NULL DEFAULT NULL,
  `deleted_by` int(10) UNSIGNED NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of units
-- ----------------------------
INSERT INTO `units` VALUES (1, 'Pcs', '2021-10-24 05:04:38', '2021-10-24 05:04:38', NULL, 1, 1, NULL);
INSERT INTO `units` VALUES (2, 'TSs', '2021-10-24 22:37:45', '2021-10-24 22:37:45', '2021-10-24 22:48:05', 1, 1, 1);
INSERT INTO `units` VALUES (3, 'Meter', '2021-10-26 00:52:16', '2021-10-26 00:52:16', NULL, 1, 1, NULL);

SET FOREIGN_KEY_CHECKS = 1;
