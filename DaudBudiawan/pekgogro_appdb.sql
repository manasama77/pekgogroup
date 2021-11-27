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

 Date: 28/11/2021 05:11:21
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
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of admins
-- ----------------------------
INSERT INTO `admins` VALUES (1, '082114578976', '$2y$10$wEoESyhVVXF2Et22AeejK.C3GlPrsnfvyR4046pTsm.gb1XiC9i0W', 'Adam PM', 'developer', 'aktif', '2021-10-22 20:57:51', '2021-11-28 05:10:55', NULL, 1, 1, NULL);
INSERT INTO `admins` VALUES (2, '085603355799', '$2y$10$kiMo3KzzWPZEnKcPoFJ2JOoro6I9de6HnxEg6trQmQfzFET5YaTrC', 'Nurul', 'order', 'aktif', '2021-10-25 22:48:17', '2021-10-25 22:48:17', NULL, 1, 1, NULL);
INSERT INTO `admins` VALUES (3, '081248892735', '$2y$10$8kPtP3F1sNMMIuUN.p7kXOl/nIcKMoFcKTvczlk2lNTVe6Uikodgu', 'Isanda', 'owner', 'aktif', '2021-10-30 05:10:38', '2021-11-01 17:09:21', NULL, 1, 3, NULL);
INSERT INTO `admins` VALUES (4, '081111111111', '$2y$10$LJM7vcllW5DDMcy8jjxEBe33PrrDduCriHxEJdbVGItKeJiqy2cn2', 'Admin CS', 'cs', 'aktif', '2021-10-30 08:53:16', '2021-10-30 08:53:16', NULL, 3, 3, NULL);
INSERT INTO `admins` VALUES (5, '082222222222', '$2y$10$x7NjiaR/zLJvXfBPupyydu00J2zrbyY9HtCzjXWAxsaX4BdlsZk.S', 'Admin Order', 'order', 'aktif', '2021-10-30 08:53:42', '2021-10-30 08:53:42', NULL, 3, 3, NULL);
INSERT INTO `admins` VALUES (6, '083333333333', '$2y$10$5QVSj.UXFezjgdgfnQW17uuv0vmBkU2J3.mYIk.cUXCZm4zwHMcF2', 'Admin Produksi', 'produksi', 'aktif', '2021-10-30 08:54:04', '2021-10-30 08:54:04', NULL, 3, 3, NULL);
INSERT INTO `admins` VALUES (7, '084444444444', '$2y$10$6wZdIeFMQtvq3tffagDcBuEnXQRdsbKjrOPV9oWzRJEnJwxk1exf2', 'Admin Finance', 'finance', 'aktif', '2021-10-30 08:57:09', '2021-11-13 22:01:12', NULL, 3, 7, NULL);
INSERT INTO `admins` VALUES (8, '123456789', '$2y$10$c0isU/CanbSzJl9toPPKhefHw0WtDNINAP/1LZ5f7kdXGUT0Ux5mu', 'test', 'cs', 'aktif', '2021-11-13 21:08:44', '2021-11-13 21:08:44', '2021-11-13 21:10:02', 1, 1, 1);

-- ----------------------------
-- Table structure for barangs
-- ----------------------------
DROP TABLE IF EXISTS `barangs`;
CREATE TABLE `barangs`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `kategori_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `merk_id` int(10) UNSIGNED NOT NULL,
  `color_id` int(10) UNSIGNED NOT NULL,
  `unit_id` int(11) NOT NULL,
  `stock` decimal(19, 4) NOT NULL DEFAULT 0.0000,
  `created_by` int(10) UNSIGNED NULL DEFAULT NULL,
  `updated_by` int(10) UNSIGNED NULL DEFAULT NULL,
  `deleted_by` int(10) UNSIGNED NULL DEFAULT NULL,
  `created_at` datetime NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  `deleted_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of barangs
-- ----------------------------
INSERT INTO `barangs` VALUES (1, 1, 'Test Barang', 1, 1, 1, 34.0000, 1, 1, NULL, '2021-11-26 19:38:44', '2021-11-28 04:38:05', NULL);
INSERT INTO `barangs` VALUES (2, 1, 'test2', 1, 2, 1, 5.0000, 1, 1, NULL, '2021-11-26 19:40:40', '2021-11-28 04:38:41', NULL);

-- ----------------------------
-- Table structure for categories
-- ----------------------------
DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_by` int(10) UNSIGNED NULL DEFAULT NULL,
  `updated_by` int(10) UNSIGNED NULL DEFAULT NULL,
  `deleted_by` int(10) UNSIGNED NULL DEFAULT NULL,
  `created_at` datetime NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  `deleted_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of categories
-- ----------------------------
INSERT INTO `categories` VALUES (1, 'test1', 1, 1, NULL, '2021-11-25 16:51:55', '2021-11-25 16:52:11', NULL);
INSERT INTO `categories` VALUES (2, 'test1', 1, 1, 1, '2021-11-25 16:56:17', '2021-11-25 16:56:56', '2021-11-25 16:57:00');

-- ----------------------------
-- Table structure for colors
-- ----------------------------
DROP TABLE IF EXISTS `colors`;
CREATE TABLE `colors`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `hex` varchar(7) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  `deleted_at` datetime NULL DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `updated_by` int(10) UNSIGNED NULL DEFAULT NULL,
  `deleted_by` int(10) UNSIGNED NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of colors
-- ----------------------------
INSERT INTO `colors` VALUES (1, 'Maroon', '#800000', '2021-11-07 08:53:11', '2021-11-13 16:32:20', NULL, 1001, 1, NULL);
INSERT INTO `colors` VALUES (2, 'Nutella', '#8A523E', '2021-11-07 08:58:21', '2021-11-07 08:58:21', NULL, 1001, 1001, NULL);
INSERT INTO `colors` VALUES (3, 'Harsey', '#252120', '2021-11-07 08:59:34', '2021-11-07 08:59:34', NULL, 1001, 1001, NULL);
INSERT INTO `colors` VALUES (4, 'Navy', '#000080', '2021-11-07 09:00:15', '2021-11-07 09:00:15', NULL, 1001, 1001, NULL);
INSERT INTO `colors` VALUES (5, 'test', '#631717', '2021-11-13 20:48:23', '2021-11-13 20:48:23', '2021-11-13 20:48:26', 1, 1, 1);

-- ----------------------------
-- Table structure for customers
-- ----------------------------
DROP TABLE IF EXISTS `customers`;
CREATE TABLE `customers`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `whatsapp` varchar(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
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
) ENGINE = InnoDB AUTO_INCREMENT = 1003 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of customers
-- ----------------------------
INSERT INTO `customers` VALUES (1001, '082114578976', '$2y$10$xTIXwPQNRmDTslXAvaCH2ONUQJjdVemluOgUWajEaZE3pdZeMryge', 'Adam PM', 'adampm77', 'adampm77', 'adampm77', 1, 0, 1000001.0000, 'aktif', NULL, '2021-11-09 11:24:30', '2021-11-19 21:21:13', NULL, 1, 1001, NULL);
INSERT INTO `customers` VALUES (1002, '085603355799', '$2y$10$B0PcAw697w72ip0TmrYxXeiM0G4PqCTlJWdfdKsMDoyap3R8hRJTC', 'Nurul AL', 'nurulal', 'nurulal', 'nurulal', 0, 0, 0.0000, 'aktif', NULL, '2021-11-13 15:56:00', '2021-11-18 19:48:39', NULL, 1, 1001, NULL);

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
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of employees
-- ----------------------------
INSERT INTO `employees` VALUES (1, 'Udin', 'potong kain', 'c2b8ce6fd78d192713a4dbbe2afbcb2a.jpg', '2021-11-03 11:52:54', '2021-11-13 16:20:45', NULL, 1, 1, NULL);
INSERT INTO `employees` VALUES (2, 'Budi', 'penjahit', '29c7d1fc1f152f7e5726edafdfd34bd0.jpg', '2021-11-03 11:53:06', '2021-11-07 08:44:46', NULL, 1, 1001, NULL);
INSERT INTO `employees` VALUES (3, 'Susi', 'qc', '95fd76920bae8199ec331b41a05914a9.jpg', '2021-11-03 11:53:26', '2021-11-07 08:44:55', NULL, 1, 1001, NULL);
INSERT INTO `employees` VALUES (4, 'Ujang', 'aksesoris', '977a83b45bb283fd0f7cbb1cdddf5ab2.jpg', '2021-11-03 11:53:37', '2021-11-07 08:45:05', NULL, 1, 1001, NULL);
INSERT INTO `employees` VALUES (5, 'test', 'potong kain', '35e20b2938b4bf1b6442c06780620f34.jpg', '2021-11-04 11:40:30', '2021-11-04 11:40:30', '2021-11-04 11:44:10', 1, 1, 1);

-- ----------------------------
-- Table structure for hpps
-- ----------------------------
DROP TABLE IF EXISTS `hpps`;
CREATE TABLE `hpps`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `cost` decimal(19, 4) NOT NULL,
  `unit_id` int(10) UNSIGNED NOT NULL,
  `supplier_id` int(10) UNSIGNED NULL DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  `deleted_at` datetime NULL DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `updated_by` int(10) UNSIGNED NULL DEFAULT NULL,
  `deleted_by` int(10) UNSIGNED NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of hpps
-- ----------------------------
INSERT INTO `hpps` VALUES (1, 'Benang', 2000.0000, 1, 1, '2021-11-07 08:45:33', '2021-11-25 11:59:04', NULL, 1, 1, NULL);
INSERT INTO `hpps` VALUES (2, 'Kain', 300000.0000, 3, 1, '2021-11-07 08:45:44', '2021-11-25 11:59:07', NULL, 1, 1, NULL);
INSERT INTO `hpps` VALUES (3, 'Mute', 2000.0000, 1, 1, '2021-11-07 08:46:01', '2021-11-25 11:59:10', NULL, 1, 1, NULL);
INSERT INTO `hpps` VALUES (4, 'test \"', 1.0000, 1, 1, '2021-11-20 14:40:48', '2021-11-25 11:59:13', NULL, 1, 1, NULL);
INSERT INTO `hpps` VALUES (5, 'test', 1.0000, 1, 1, '2021-11-25 11:59:20', '2021-11-25 11:59:20', NULL, 1, 1, NULL);

-- ----------------------------
-- Table structure for merks
-- ----------------------------
DROP TABLE IF EXISTS `merks`;
CREATE TABLE `merks`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_by` int(10) UNSIGNED NULL DEFAULT NULL,
  `updated_by` int(10) UNSIGNED NULL DEFAULT NULL,
  `deleted_by` int(10) UNSIGNED NULL DEFAULT NULL,
  `created_at` datetime NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  `deleted_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of merks
-- ----------------------------
INSERT INTO `merks` VALUES (1, 'Armani', 1, 1, NULL, '2021-11-25 17:01:29', '2021-11-25 17:01:34', NULL);

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
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of order_payments
-- ----------------------------

-- ----------------------------
-- Table structure for order_productions
-- ----------------------------
DROP TABLE IF EXISTS `order_productions`;
CREATE TABLE `order_productions`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `order_id` int(10) UNSIGNED NOT NULL,
  `petugas_potong_kain` int(10) UNSIGNED NULL DEFAULT NULL,
  `tanggal_potong_kain` date NULL DEFAULT NULL,
  `petugas_jahit` int(10) NULL DEFAULT NULL,
  `tanggal_jahit` date NULL DEFAULT NULL,
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
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of order_requests
-- ----------------------------

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
  `product_price` decimal(19, 4) NULL DEFAULT NULL,
  `color_id` int(10) UNSIGNED NOT NULL,
  `size_id` int(10) UNSIGNED NOT NULL,
  `size_price` decimal(19, 4) NULL DEFAULT NULL,
  `pilih_jahitan` enum('standard','express','urgent','super urgent') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `pilih_jahitan_price` decimal(19, 4) NULL DEFAULT NULL,
  `catatan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `customer_id` int(10) UNSIGNED NOT NULL,
  `whatsapp` varchar(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `id_tokped` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `id_shopee` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `id_instagram` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `status_order` enum('order dibuat','naik produksi','pengiriman','selesai','order dibatalkan','retur pending','retur terkirim','refund') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status_pembayaran` enum('menunggu pembayaran','partial','lunas','melewati batas transfer','refund pending','refund selesai') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status_pengiriman` enum('terkirim','proses pengiriman','antrian') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT 'antrian',
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
  `alamat_pengiriman` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `admin_order` int(11) NOT NULL,
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
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of orders
-- ----------------------------
INSERT INTO `orders` VALUES (1, 1, 'PKG.19.11.21001', '3', '2021-11-20 00:21:03', '2021-12-19', 'web', 1, 1000000.0000, 1, 1, 0.0000, 'standard', 0.0000, 'test catatan', 1001, '082114578976', 'adampm77', 'adampm77', 'adampm77', 'order dibuat', 'menunggu pembayaran', 'antrian', 1000000.0000, 1, 1000001.00000, '30', 300000.3000, 700000.7000, 0.0000, NULL, NULL, NULL, 'test alamat', 0, 0, 0, 0, 'no', 'no', 'no', 'active', '2021-11-19 21:21:03', '2021-11-19 21:21:13', NULL, 1001, 1001, NULL);

-- ----------------------------
-- Table structure for pembelian
-- ----------------------------
DROP TABLE IF EXISTS `pembelian`;
CREATE TABLE `pembelian`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tanggal_pembelian` date NOT NULL,
  `supplier_id` int(10) UNSIGNED NOT NULL,
  `no_invoice` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `total` decimal(19, 4) UNSIGNED NOT NULL,
  `created_by` int(10) UNSIGNED NULL DEFAULT NULL,
  `updated_by` int(10) UNSIGNED NULL DEFAULT NULL,
  `deleted_by` int(10) UNSIGNED NULL DEFAULT NULL,
  `created_at` datetime NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  `deleted_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of pembelian
-- ----------------------------
INSERT INTO `pembelian` VALUES (1, '2021-11-28', 1, '123', 0.0000, 1, 1, NULL, '2021-11-28 04:11:10', '2021-11-28 04:11:10', NULL);
INSERT INTO `pembelian` VALUES (2, '2021-11-28', 1, '123', 0.0000, 1, 1, NULL, '2021-11-28 04:14:40', '2021-11-28 04:14:40', NULL);
INSERT INTO `pembelian` VALUES (3, '2021-11-28', 1, '111', 0.0000, 1, 1, NULL, '2021-11-28 04:16:40', '2021-11-28 04:16:40', NULL);
INSERT INTO `pembelian` VALUES (4, '2021-11-28', 1, '123', 500000.0000, 1, 1, NULL, '2021-11-28 04:38:05', '2021-11-28 04:38:05', NULL);
INSERT INTO `pembelian` VALUES (5, '2021-11-28', 1, '333', 500000.0000, 1, 1, NULL, '2021-11-28 04:38:41', '2021-11-28 04:38:41', NULL);

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
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of product_color_params
-- ----------------------------
INSERT INTO `product_color_params` VALUES (2, 2, 2, '2021-11-07 09:04:54', '2021-11-07 09:04:54', NULL, 1, 1, NULL);
INSERT INTO `product_color_params` VALUES (3, 3, 4, '2021-11-07 10:19:18', '2021-11-07 10:19:18', NULL, 1, 1, NULL);
INSERT INTO `product_color_params` VALUES (7, 1, 1, '2021-11-15 10:36:42', '2021-11-15 10:36:42', NULL, 1, 1, NULL);
INSERT INTO `product_color_params` VALUES (8, 6, 1, '2021-11-16 01:01:03', '2021-11-16 01:01:03', NULL, 1, 1, NULL);
INSERT INTO `product_color_params` VALUES (9, 81, 1, '2021-11-20 21:25:10', '2021-11-20 21:25:10', NULL, 1, 1, NULL);
INSERT INTO `product_color_params` VALUES (10, 81, 2, '2021-11-20 21:25:10', '2021-11-20 21:25:10', NULL, 1, 1, NULL);
INSERT INTO `product_color_params` VALUES (11, 81, 3, '2021-11-20 21:25:10', '2021-11-20 21:25:10', NULL, 1, 1, NULL);
INSERT INTO `product_color_params` VALUES (12, 81, 4, '2021-11-20 21:25:10', '2021-11-20 21:25:10', NULL, 1, 1, NULL);

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
) ENGINE = InnoDB AUTO_INCREMENT = 52 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of product_hpp_params
-- ----------------------------
INSERT INTO `product_hpp_params` VALUES (1, 1, 1, 10.0000, 1000.0000, 10000.0000, '2021-11-07 09:02:48', '2021-11-15 10:36:42', NULL, 1001, 1, NULL);
INSERT INTO `product_hpp_params` VALUES (4, 1, 2, 2.0000, 300000.0000, 600000.0000, '2021-11-07 09:03:20', '2021-11-15 10:36:42', NULL, 1001, 1, NULL);
INSERT INTO `product_hpp_params` VALUES (5, 1, 3, 100.0000, 2000.0000, 200000.0000, '2021-11-07 09:03:30', '2021-11-15 10:36:42', NULL, 1001, 1, NULL);
INSERT INTO `product_hpp_params` VALUES (6, 2, 1, 100.0000, 1000.0000, 100000.0000, '2021-11-07 09:04:38', '2021-11-07 09:04:54', NULL, 1001, 1001, NULL);
INSERT INTO `product_hpp_params` VALUES (7, 2, 2, 2.0000, 300000.0000, 600000.0000, '2021-11-07 09:04:43', '2021-11-07 09:04:54', NULL, 1001, 1001, NULL);
INSERT INTO `product_hpp_params` VALUES (8, 3, 1, 10.0000, 1000.0000, 10000.0000, '2021-11-07 10:18:10', '2021-11-07 10:19:18', NULL, 1001, 1001, NULL);
INSERT INTO `product_hpp_params` VALUES (11, 3, 2, 3.0000, 300000.0000, 900000.0000, '2021-11-07 10:18:36', '2021-11-07 10:19:18', NULL, 1001, 1001, NULL);
INSERT INTO `product_hpp_params` VALUES (13, 3, 3, 20.0000, 2000.0000, 40000.0000, '2021-11-07 10:18:53', '2021-11-07 10:19:18', NULL, 1001, 1001, NULL);
INSERT INTO `product_hpp_params` VALUES (16, 6, 1, 1.0000, 2000.0000, 2000.0000, '2021-11-16 01:00:49', '2021-11-16 01:01:03', NULL, 1, 1, NULL);
INSERT INTO `product_hpp_params` VALUES (51, 81, 1, 1.0000, 2000.0000, 2000.0000, '2021-11-20 21:23:51', '2021-11-20 21:25:10', NULL, 1, 1, NULL);

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
) ENGINE = InnoDB AUTO_INCREMENT = 18 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of product_request_params
-- ----------------------------
INSERT INTO `product_request_params` VALUES (3, 2, 1, '2021-11-07 09:04:54', '2021-11-07 09:04:54', NULL, 1001, 1001, NULL);
INSERT INTO `product_request_params` VALUES (4, 2, 2, '2021-11-07 09:04:54', '2021-11-07 09:04:54', NULL, 1001, 1001, NULL);
INSERT INTO `product_request_params` VALUES (5, 3, 1, '2021-11-07 10:19:18', '2021-11-07 10:19:18', NULL, 1001, 1001, NULL);
INSERT INTO `product_request_params` VALUES (6, 3, 2, '2021-11-07 10:19:18', '2021-11-07 10:19:18', NULL, 1001, 1001, NULL);
INSERT INTO `product_request_params` VALUES (12, 1, 1, '2021-11-15 10:36:42', '2021-11-15 10:36:42', NULL, 1, 1, NULL);
INSERT INTO `product_request_params` VALUES (13, 1, 2, '2021-11-15 10:36:42', '2021-11-15 10:36:42', NULL, 1, 1, NULL);
INSERT INTO `product_request_params` VALUES (14, 6, 1, '2021-11-16 01:01:03', '2021-11-16 01:01:03', NULL, 1, 1, NULL);
INSERT INTO `product_request_params` VALUES (15, 6, 2, '2021-11-16 01:01:03', '2021-11-16 01:01:03', NULL, 1, 1, NULL);
INSERT INTO `product_request_params` VALUES (16, 81, 1, '2021-11-20 21:25:10', '2021-11-20 21:25:10', NULL, 1, 1, NULL);
INSERT INTO `product_request_params` VALUES (17, 81, 2, '2021-11-20 21:25:10', '2021-11-20 21:25:10', NULL, 1, 1, NULL);

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
) ENGINE = InnoDB AUTO_INCREMENT = 45 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of product_size_params
-- ----------------------------
INSERT INTO `product_size_params` VALUES (6, 2, 1, '2021-11-07 09:04:54', '2021-11-07 09:04:54', NULL, 1001, 1001, NULL);
INSERT INTO `product_size_params` VALUES (7, 2, 2, '2021-11-07 09:04:54', '2021-11-07 09:04:54', NULL, 1001, 1001, NULL);
INSERT INTO `product_size_params` VALUES (8, 2, 4, '2021-11-07 09:04:54', '2021-11-07 09:04:54', NULL, 1001, 1001, NULL);
INSERT INTO `product_size_params` VALUES (9, 2, 5, '2021-11-07 09:04:54', '2021-11-07 09:04:54', NULL, 1001, 1001, NULL);
INSERT INTO `product_size_params` VALUES (10, 3, 1, '2021-11-07 10:19:18', '2021-11-07 10:19:18', NULL, 1001, 1001, NULL);
INSERT INTO `product_size_params` VALUES (11, 3, 2, '2021-11-07 10:19:18', '2021-11-07 10:19:18', NULL, 1001, 1001, NULL);
INSERT INTO `product_size_params` VALUES (12, 3, 3, '2021-11-07 10:19:18', '2021-11-07 10:19:18', NULL, 1001, 1001, NULL);
INSERT INTO `product_size_params` VALUES (13, 3, 4, '2021-11-07 10:19:18', '2021-11-07 10:19:18', NULL, 1001, 1001, NULL);
INSERT INTO `product_size_params` VALUES (14, 3, 5, '2021-11-07 10:19:18', '2021-11-07 10:19:18', NULL, 1001, 1001, NULL);
INSERT INTO `product_size_params` VALUES (30, 1, 1, '2021-11-15 10:36:42', '2021-11-15 10:36:42', NULL, 1, 1, NULL);
INSERT INTO `product_size_params` VALUES (31, 1, 2, '2021-11-15 10:36:42', '2021-11-15 10:36:42', NULL, 1, 1, NULL);
INSERT INTO `product_size_params` VALUES (32, 1, 3, '2021-11-15 10:36:42', '2021-11-15 10:36:42', NULL, 1, 1, NULL);
INSERT INTO `product_size_params` VALUES (33, 1, 4, '2021-11-15 10:36:42', '2021-11-15 10:36:42', NULL, 1, 1, NULL);
INSERT INTO `product_size_params` VALUES (34, 1, 5, '2021-11-15 10:36:42', '2021-11-15 10:36:42', NULL, 1, 1, NULL);
INSERT INTO `product_size_params` VALUES (35, 6, 1, '2021-11-16 01:01:03', '2021-11-16 01:01:03', NULL, 1, 1, NULL);
INSERT INTO `product_size_params` VALUES (36, 6, 2, '2021-11-16 01:01:03', '2021-11-16 01:01:03', NULL, 1, 1, NULL);
INSERT INTO `product_size_params` VALUES (37, 6, 3, '2021-11-16 01:01:03', '2021-11-16 01:01:03', NULL, 1, 1, NULL);
INSERT INTO `product_size_params` VALUES (38, 6, 4, '2021-11-16 01:01:03', '2021-11-16 01:01:03', NULL, 1, 1, NULL);
INSERT INTO `product_size_params` VALUES (39, 6, 5, '2021-11-16 01:01:03', '2021-11-16 01:01:03', NULL, 1, 1, NULL);
INSERT INTO `product_size_params` VALUES (40, 81, 1, '2021-11-20 21:25:10', '2021-11-20 21:25:10', NULL, 1, 1, NULL);
INSERT INTO `product_size_params` VALUES (41, 81, 2, '2021-11-20 21:25:10', '2021-11-20 21:25:10', NULL, 1, 1, NULL);
INSERT INTO `product_size_params` VALUES (42, 81, 3, '2021-11-20 21:25:10', '2021-11-20 21:25:10', NULL, 1, 1, NULL);
INSERT INTO `product_size_params` VALUES (43, 81, 4, '2021-11-20 21:25:10', '2021-11-20 21:25:10', NULL, 1, 1, NULL);
INSERT INTO `product_size_params` VALUES (44, 81, 5, '2021-11-20 21:25:10', '2021-11-20 21:25:10', NULL, 1, 1, NULL);

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
  `path_image_2` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `path_image_3` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `status` enum('temp','active') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `sold` int(10) UNSIGNED NULL DEFAULT 0,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  `deleted_at` datetime NULL DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `updated_by` int(10) UNSIGNED NULL DEFAULT NULL,
  `deleted_by` int(10) UNSIGNED NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 84 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of products
-- ----------------------------
INSERT INTO `products` VALUES (1, 'P.07.11.21001', 'Sehati Dress', 1000000.0000, '9f722a06ed56e11bfe9fa27afa37d741.jpeg', '5a563e12afdd2afbb763321a831fe04e.jpeg', NULL, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur, vitae, explicabo? Incidunt facere, natus soluta dolores iusto! Molestiae expedita veritatis nesciunt doloremque sint asperiores fuga voluptas, distinctio, aperiam, ratione dolore.\r\n\r\nEx numquam veritatis debitis minima quo error quam eos dolorum quidem perferendis. Quos repellat dignissimos minus, eveniet nam voluptatibus molestias omnis reiciendis perspiciatis illum hic magni iste, velit aperiam quis.', 'active', 0, '2021-11-07 09:00:41', '2021-11-15 10:36:42', NULL, 1001, 1, NULL);
INSERT INTO `products` VALUES (2, 'P.07.11.21002', 'Yure Dress', 1000000.0000, '4fff38c8097298285417548a89293517.jpeg', NULL, 'cfa96dd92239cc620feed33121a9a74b.jpeg', NULL, 'active', 1, '2021-11-07 09:03:45', '2021-11-07 09:04:54', NULL, 1001, 1001, NULL);
INSERT INTO `products` VALUES (3, 'P.07.11.21003', 'Dian Reborn', 1200000.0000, '0e0adbabad871400806cd79a62149e20.jpg', '0e0adbabad871400806cd79a62149e20.jpg', '0e0adbabad871400806cd79a62149e20.jpg', NULL, 'active', 0, '2021-11-07 09:05:28', '2021-11-07 10:19:18', NULL, 1001, 1001, NULL);
INSERT INTO `products` VALUES (4, 'P.09.11.21001', '', 0.0000, NULL, NULL, NULL, NULL, 'temp', 0, '2021-11-09 09:43:37', '2021-11-09 09:43:37', NULL, 1001, 1001, NULL);
INSERT INTO `products` VALUES (6, 'P.16.11.21001', 'test', 1.0000, '7f9f3b4fcd2c70a6f179193d3150c171.jpg', '7f9f3b4fcd2c70a6f179193d3150c171.jpg', '7f9f3b4fcd2c70a6f179193d3150c171.jpg', NULL, 'active', 0, '2021-11-16 01:00:34', '2021-11-16 01:01:03', '2021-11-16 01:01:54', 1, 1, 1);
INSERT INTO `products` VALUES (81, 'P.20.11.21074', 'test', 1.0000, '9bf5f67d975949aa437f9d2b1f1ce79a.jpg', NULL, NULL, NULL, 'active', 0, '2021-11-20 21:23:43', '2021-11-20 21:25:10', NULL, 1, 1, NULL);
INSERT INTO `products` VALUES (83, 'P.25.11.21001', '', 0.0000, NULL, NULL, NULL, NULL, 'temp', 0, '2021-11-25 12:20:29', '2021-11-25 12:20:29', NULL, 1, 1, NULL);

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
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of projects
-- ----------------------------
INSERT INTO `projects` VALUES (1, 'Pekgo Apparel', 'PKG', 'logo_grey.png', '2021-10-24 02:40:23', '2021-11-04 11:07:43', NULL, 1, 1, NULL);
INSERT INTO `projects` VALUES (2, 'test', 'test', 'fc543dcb36d93b83d745c468e21261df.png', '2021-11-04 11:08:14', '2021-11-04 11:08:14', '2021-11-04 11:21:42', 1, 1, 1);

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
INSERT INTO `requests` VALUES (1, 'REQUEST (-) PB', 10000.0000, '2021-11-02 20:32:10', '2021-11-02 20:32:10', NULL, 1, 1, NULL);
INSERT INTO `requests` VALUES (2, 'REQUEST (+) PB', 20000.0000, '2021-11-02 20:32:17', '2021-11-02 20:32:17', NULL, 1, 1, NULL);
INSERT INTO `requests` VALUES (3, 'test1', 1.0000, '2021-11-13 20:49:03', '2021-11-13 20:49:03', '2021-11-13 20:49:11', 1, 1, 1);

-- ----------------------------
-- Table structure for sequence_orders
-- ----------------------------
DROP TABLE IF EXISTS `sequence_orders`;
CREATE TABLE `sequence_orders`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `sequence` int(10) UNSIGNED NOT NULL,
  `created_at` date NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of sequence_orders
-- ----------------------------
INSERT INTO `sequence_orders` VALUES (1, 1, '2021-11-19');

-- ----------------------------
-- Table structure for sequence_products
-- ----------------------------
DROP TABLE IF EXISTS `sequence_products`;
CREATE TABLE `sequence_products`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `sequence` int(10) UNSIGNED NOT NULL,
  `created_at` date NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of sequence_products
-- ----------------------------
INSERT INTO `sequence_products` VALUES (1, 3, '2021-11-07');
INSERT INTO `sequence_products` VALUES (2, 1, '2021-11-09');
INSERT INTO `sequence_products` VALUES (3, 1, '2021-11-13');
INSERT INTO `sequence_products` VALUES (4, 1, '2021-11-16');
INSERT INTO `sequence_products` VALUES (5, 1, '2021-11-18');
INSERT INTO `sequence_products` VALUES (6, 75, '2021-11-20');
INSERT INTO `sequence_products` VALUES (7, 1, '2021-11-25');

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
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of sizes
-- ----------------------------
INSERT INTO `sizes` VALUES (1, 'S', 0.0000, '2021-10-24 23:02:30', '2021-10-24 23:02:30', NULL, 1, 1, NULL);
INSERT INTO `sizes` VALUES (2, 'M', 0.0000, '2021-10-24 23:04:30', '2021-10-24 23:04:30', NULL, 1, 1, NULL);
INSERT INTO `sizes` VALUES (3, 'L', 0.0000, '2021-10-24 23:06:01', '2021-10-24 23:06:01', NULL, 1, 1, NULL);
INSERT INTO `sizes` VALUES (4, 'XL', 50000.0000, '2021-11-02 20:31:12', '2021-11-02 20:31:12', NULL, 1, 1, NULL);
INSERT INTO `sizes` VALUES (5, 'XXL', 100000.0000, '2021-11-02 20:31:18', '2021-11-02 20:31:18', NULL, 1, 1, NULL);
INSERT INTO `sizes` VALUES (6, 'test1', 1.0000, '2021-11-13 20:48:40', '2021-11-13 20:48:40', '2021-11-13 20:48:53', 1, 1, 1);

-- ----------------------------
-- Table structure for sub_barangs
-- ----------------------------
DROP TABLE IF EXISTS `sub_barangs`;
CREATE TABLE `sub_barangs`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `barang_id` int(10) UNSIGNED NULL DEFAULT NULL,
  `supplier_id` int(10) UNSIGNED NOT NULL,
  `kode` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `harga` decimal(19, 4) UNSIGNED NOT NULL,
  `stock` decimal(19, 4) NULL DEFAULT NULL,
  `temp_by` int(10) UNSIGNED NULL DEFAULT NULL,
  `created_by` int(10) UNSIGNED NULL DEFAULT NULL,
  `updated_by` int(10) UNSIGNED NULL DEFAULT NULL,
  `deleted_by` int(10) UNSIGNED NULL DEFAULT NULL,
  `created_at` datetime NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  `deleted_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 22 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of sub_barangs
-- ----------------------------
INSERT INTO `sub_barangs` VALUES (13, 1, 1, '111', 100000.0000, 29.0000, NULL, 1, 1, NULL, '2021-11-26 19:38:44', '2021-11-28 04:38:05', NULL);
INSERT INTO `sub_barangs` VALUES (16, 2, 1, '222', 100000.0000, 5.0000, NULL, 1, 1, NULL, '2021-11-26 19:40:41', '2021-11-28 04:38:41', NULL);
INSERT INTO `sub_barangs` VALUES (17, 2, 1, '333', 50000.0000, 0.0000, NULL, 1, 1, NULL, '2021-11-26 19:40:41', '2021-11-26 19:40:41', NULL);
INSERT INTO `sub_barangs` VALUES (21, 1, 1, '555', 50000.0000, 5.0000, NULL, 1, 1, NULL, '2021-11-27 22:12:56', '2021-11-28 04:18:27', NULL);

-- ----------------------------
-- Table structure for sub_pembelian
-- ----------------------------
DROP TABLE IF EXISTS `sub_pembelian`;
CREATE TABLE `sub_pembelian`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `pembelian_id` int(11) NULL DEFAULT NULL,
  `barang_id` int(11) NULL DEFAULT NULL,
  `sub_barang_id` int(11) NULL DEFAULT NULL,
  `harga` decimal(19, 4) NULL DEFAULT NULL,
  `qty` int(11) NULL DEFAULT NULL,
  `total` decimal(19, 4) NULL DEFAULT NULL,
  `temp_by` int(11) UNSIGNED NULL DEFAULT NULL,
  `created_by` int(10) UNSIGNED NULL DEFAULT NULL,
  `updated_by` int(10) UNSIGNED NULL DEFAULT NULL,
  `deleted_by` int(10) UNSIGNED NULL DEFAULT NULL,
  `created_at` datetime NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  `deleted_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 17 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of sub_pembelian
-- ----------------------------
INSERT INTO `sub_pembelian` VALUES (8, 1, 1, 13, 100000.0000, 1, 100000.0000, NULL, 1, 1, NULL, '2021-11-28 04:11:10', '2021-11-28 04:11:10', NULL);
INSERT INTO `sub_pembelian` VALUES (9, 2, 1, 13, 100000.0000, 1, 100000.0000, NULL, 1, 1, NULL, '2021-11-28 04:14:40', '2021-11-28 04:14:40', NULL);
INSERT INTO `sub_pembelian` VALUES (10, 3, 1, 21, 50000.0000, 1, 50000.0000, NULL, 1, 1, NULL, '2021-11-28 04:16:40', '2021-11-28 04:16:40', NULL);
INSERT INTO `sub_pembelian` VALUES (15, 4, 1, 13, 100000.0000, 5, 500000.0000, NULL, 1, 1, NULL, '2021-11-28 04:38:05', '2021-11-28 04:38:05', NULL);
INSERT INTO `sub_pembelian` VALUES (16, 5, 2, 16, 100000.0000, 5, 500000.0000, NULL, 1, 1, NULL, '2021-11-28 04:38:41', '2021-11-28 04:38:41', NULL);

-- ----------------------------
-- Table structure for supplier
-- ----------------------------
DROP TABLE IF EXISTS `supplier`;
CREATE TABLE `supplier`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `location` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created_by` int(10) UNSIGNED NULL DEFAULT NULL,
  `updated_by` int(10) UNSIGNED NULL DEFAULT NULL,
  `deleted_by` int(10) UNSIGNED NULL DEFAULT NULL,
  `created_at` datetime NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  `deleted_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of supplier
-- ----------------------------
INSERT INTO `supplier` VALUES (1, 'Test1', 'test1', 1, 1, NULL, '2021-11-25 11:51:43', '2021-11-25 11:52:42', NULL);

-- ----------------------------
-- Table structure for test
-- ----------------------------
DROP TABLE IF EXISTS `test`;
CREATE TABLE `test`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of test
-- ----------------------------
INSERT INTO `test` VALUES (1, 'test2021-11-20 22:19:48');

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
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of units
-- ----------------------------
INSERT INTO `units` VALUES (1, 'Pcs', '2021-10-24 05:04:38', '2021-10-24 05:04:38', NULL, 1, 1, NULL);
INSERT INTO `units` VALUES (2, 'TSs', '2021-10-24 22:37:45', '2021-10-24 22:37:45', '2021-10-24 22:48:05', 1, 1, 1);
INSERT INTO `units` VALUES (3, 'Meter', '2021-10-26 00:52:16', '2021-10-26 00:52:16', NULL, 1, 1, NULL);
INSERT INTO `units` VALUES (4, 'test', '2021-11-13 16:21:12', '2021-11-13 16:21:12', '2021-11-13 16:21:17', 1, 1, 1);

SET FOREIGN_KEY_CHECKS = 1;
