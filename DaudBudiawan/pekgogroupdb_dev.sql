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

 Date: 29/12/2021 15:22:18
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for account_groups
-- ----------------------------
DROP TABLE IF EXISTS `account_groups`;
CREATE TABLE `account_groups`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  `deleted_at` datetime NULL DEFAULT NULL,
  `created_by` int(10) UNSIGNED NULL DEFAULT NULL,
  `updated_by` int(10) UNSIGNED NULL DEFAULT NULL,
  `deleted_by` int(10) UNSIGNED NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of account_groups
-- ----------------------------
INSERT INTO `account_groups` VALUES (1, 'ASSETS', '2021-12-13 15:49:01', '2021-12-13 15:49:36', NULL, 1, 1, NULL);
INSERT INTO `account_groups` VALUES (2, 'LIABILITY', '2021-12-13 15:49:12', '2021-12-13 15:49:12', NULL, 1, 1, NULL);
INSERT INTO `account_groups` VALUES (3, 'EQUITY', '2021-12-13 15:49:17', '2021-12-13 15:49:17', NULL, 1, 1, NULL);
INSERT INTO `account_groups` VALUES (4, 'EXPENSE', '2021-12-13 15:49:22', '2021-12-13 15:49:22', NULL, 1, 1, NULL);
INSERT INTO `account_groups` VALUES (5, 'REVENUE', '2021-12-13 15:49:26', '2021-12-13 15:49:26', NULL, 1, 1, NULL);

-- ----------------------------
-- Table structure for accounts
-- ----------------------------
DROP TABLE IF EXISTS `accounts`;
CREATE TABLE `accounts`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `no_akun` varchar(4) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `nama_akun` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `account_group_id` int(11) NULL DEFAULT NULL,
  `created_by` int(10) UNSIGNED NULL DEFAULT NULL,
  `updated_by` int(10) UNSIGNED NULL DEFAULT NULL,
  `deleted_by` int(10) UNSIGNED NULL DEFAULT NULL,
  `created_at` datetime NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  `deleted_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of accounts
-- ----------------------------
INSERT INTO `accounts` VALUES (1, '2001', 'Pendapatan Iklan', 1, 1, 1, NULL, '2021-12-13 15:57:46', '2021-12-14 01:15:36', NULL);
INSERT INTO `accounts` VALUES (2, '3000', 'Biaya Cetak Majalah', 4, 1, 1, NULL, '2021-12-14 01:15:28', '2021-12-14 03:45:37', NULL);
INSERT INTO `accounts` VALUES (3, '3002', 'Biaya operasional Iklan', 4, 1, 1, NULL, '2021-12-14 03:45:32', '2021-12-14 03:45:32', NULL);

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
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of admins
-- ----------------------------
INSERT INTO `admins` VALUES (1, '082114578976', '$2y$10$wEoESyhVVXF2Et22AeejK.C3GlPrsnfvyR4046pTsm.gb1XiC9i0W', 'Adam PM', 'developer', 'aktif', '2021-10-22 20:57:51', '2021-12-29 15:21:12', NULL, 1, 1, NULL);
INSERT INTO `admins` VALUES (2, '085603355799', '$2y$10$kiMo3KzzWPZEnKcPoFJ2JOoro6I9de6HnxEg6trQmQfzFET5YaTrC', 'Nurul', 'order', 'aktif', '2021-10-25 22:48:17', '2021-10-25 22:48:17', '2021-11-29 08:22:00', 1, 1, 3);
INSERT INTO `admins` VALUES (3, '081248892735', '$2y$10$8kPtP3F1sNMMIuUN.p7kXOl/nIcKMoFcKTvczlk2lNTVe6Uikodgu', 'ISANDA', 'owner', 'aktif', '2021-10-30 05:10:38', '2021-11-30 21:14:01', NULL, 1, 3, NULL);
INSERT INTO `admins` VALUES (4, '081111111111', '$2y$10$LJM7vcllW5DDMcy8jjxEBe33PrrDduCriHxEJdbVGItKeJiqy2cn2', 'Admin CS', 'cs', 'aktif', '2021-10-30 08:53:16', '2021-10-30 08:53:16', '2021-11-29 08:22:12', 3, 3, 3);
INSERT INTO `admins` VALUES (5, '082222222222', '$2y$10$x7NjiaR/zLJvXfBPupyydu00J2zrbyY9HtCzjXWAxsaX4BdlsZk.S', 'Admin Order', 'order', 'aktif', '2021-10-30 08:53:42', '2021-10-30 08:53:42', '2021-11-29 08:22:20', 3, 3, 3);
INSERT INTO `admins` VALUES (6, '083333333333', '$2y$10$5QVSj.UXFezjgdgfnQW17uuv0vmBkU2J3.mYIk.cUXCZm4zwHMcF2', 'Admin Produksi', 'produksi', 'aktif', '2021-10-30 08:54:04', '2021-10-30 08:54:04', '2021-11-29 08:23:16', 3, 3, 3);
INSERT INTO `admins` VALUES (7, '084444444444', '$2y$10$6wZdIeFMQtvq3tffagDcBuEnXQRdsbKjrOPV9oWzRJEnJwxk1exf2', 'Admin Finance', 'finance', 'aktif', '2021-10-30 08:57:09', '2021-11-13 22:01:12', '2021-11-29 08:23:45', 3, 7, 3);
INSERT INTO `admins` VALUES (8, '123456789', '$2y$10$c0isU/CanbSzJl9toPPKhefHw0WtDNINAP/1LZ5f7kdXGUT0Ux5mu', 'test', 'cs', 'aktif', '2021-11-13 21:08:44', '2021-11-13 21:08:44', '2021-11-13 21:10:02', 1, 1, 1);
INSERT INTO `admins` VALUES (9, '085695667068', '$2y$10$S5a/moJTxU6JnChz9zMtF.ZrC2ueXAfqEBwxNFK670UAY35FiX5Pq', 'RAHMA ', 'produksi', 'aktif', '2021-11-29 08:21:48', '2021-11-29 22:59:59', NULL, 3, 9, NULL);

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
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of barangs
-- ----------------------------

-- ----------------------------
-- Table structure for cashflow
-- ----------------------------
DROP TABLE IF EXISTS `cashflow`;
CREATE TABLE `cashflow`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tanggal` date NULL DEFAULT NULL,
  `account_id` int(10) UNSIGNED NULL DEFAULT NULL,
  `no_voucher` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `dari_untuk` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `keterangan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `debet` decimal(19, 4) UNSIGNED NULL DEFAULT NULL,
  `kredit` decimal(19, 4) UNSIGNED NULL DEFAULT NULL,
  `jenis_cashflow` enum('kas cash','bca','mandiri') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  `deleted_at` datetime NULL DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `updated_by` int(10) UNSIGNED NULL DEFAULT NULL,
  `deleted_by` int(10) UNSIGNED NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cashflow
-- ----------------------------
INSERT INTO `cashflow` VALUES (1, '2021-01-14', 1, 'test', 'test', 'test', 100000.0000, 0.0000, 'kas cash', '2021-12-14 03:16:15', '2021-12-14 03:16:15', NULL, 1, 1, NULL);
INSERT INTO `cashflow` VALUES (2, '2021-12-14', 2, 'test', 'test', 'test', 0.0000, 10000.0000, 'kas cash', '2021-12-14 03:36:06', '2021-12-14 03:36:06', NULL, 1, 1, NULL);
INSERT INTO `cashflow` VALUES (3, '2021-12-14', 3, 'test', 'test', 'test', 0.0000, 20000.0000, 'kas cash', '2021-12-14 03:46:04', '2021-12-14 03:46:04', NULL, 1, 1, NULL);
INSERT INTO `cashflow` VALUES (4, '2021-12-14', 2, 'test', 'test', 'test', 0.0000, 10000.1000, 'kas cash', '2021-12-14 04:01:17', '2021-12-14 04:01:17', NULL, 1, 1, NULL);
INSERT INTO `cashflow` VALUES (5, '2021-12-14', 1, 'test bca', 'test bca', 'test bca', 1000000.0000, 0.0000, 'bca', '2021-12-14 15:44:36', '2021-12-14 15:44:36', NULL, 1, 1, NULL);
INSERT INTO `cashflow` VALUES (6, '2021-12-14', 1, 'test mandiri', 'test mandiri', 'test bank\nmandiri', 500000.0000, 0.0000, 'mandiri', '2021-12-14 15:48:55', '2021-12-14 15:48:55', NULL, 1, 1, NULL);

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
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of categories
-- ----------------------------
INSERT INTO `categories` VALUES (1, 'Kategori A', 1, 1, NULL, '2021-12-11 01:03:52', '2021-12-11 01:03:52', NULL);
INSERT INTO `categories` VALUES (2, 'Kategori B', 1, 1, NULL, '2021-12-11 01:03:56', '2021-12-11 01:03:56', NULL);
INSERT INTO `categories` VALUES (3, 'Kategori C', 1, 1, NULL, '2021-12-11 01:03:59', '2021-12-11 01:03:59', NULL);

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
INSERT INTO `colors` VALUES (1, 'Merah', '#FB0000', '2021-12-11 01:02:00', '2021-12-11 01:02:00', NULL, 1, 1, NULL);
INSERT INTO `colors` VALUES (2, 'Kuning', '#F9ED02', '2021-12-11 01:02:11', '2021-12-11 01:02:11', NULL, 1, 1, NULL);
INSERT INTO `colors` VALUES (3, 'Hijau', '#00F523', '2021-12-11 01:02:20', '2021-12-11 01:02:20', NULL, 1, 1, NULL);
INSERT INTO `colors` VALUES (4, 'Putih', '#FFFFFF', '2021-12-11 01:02:27', '2021-12-11 01:02:27', NULL, 1, 1, NULL);
INSERT INTO `colors` VALUES (5, 'Hitam', '#000000', '2021-12-11 01:02:34', '2021-12-11 01:02:34', NULL, 1, 1, NULL);

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
) ENGINE = InnoDB AUTO_INCREMENT = 1002 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of customers
-- ----------------------------
INSERT INTO `customers` VALUES (1001, '082114578976', '$2y$10$XX11ggL8dWtgx0THh86j1eWvgXfMPX4qFK5rzR7t3aETSz7nQBNbK', 'Adam', '', '', '', 1, 0, 110001.0000, 'aktif', NULL, '2021-12-11 01:19:55', '2021-12-11 01:26:04', NULL, 1, 1001, NULL);

-- ----------------------------
-- Table structure for employees
-- ----------------------------
DROP TABLE IF EXISTS `employees`;
CREATE TABLE `employees`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
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
INSERT INTO `employees` VALUES (1, 'Petugas Potong Kain', 'potong kain', '83dc3772c8b858693ec4c9715a90e37d.png', '2021-12-11 01:00:20', '2021-12-11 01:00:20', NULL, 1, 1, NULL);
INSERT INTO `employees` VALUES (2, 'Petugas Penjahit', 'potong kain', 'dc033e0bf80b720f16fc341fa458e606.png', '2021-12-11 01:00:29', '2021-12-11 01:00:29', NULL, 1, 1, NULL);
INSERT INTO `employees` VALUES (3, 'Petugas QC', 'potong kain', '3423701a5e6518ee84db8695cf53c6a8.png', '2021-12-11 01:00:39', '2021-12-11 01:00:39', NULL, 1, 1, NULL);
INSERT INTO `employees` VALUES (4, 'Petugas Aksesoris', 'aksesoris', '088d2723dcb0d6a13524ab7b2b4b2a3e.png', '2021-12-11 01:00:48', '2021-12-11 01:00:48', NULL, 1, 1, NULL);

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
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of hpps
-- ----------------------------
INSERT INTO `hpps` VALUES (1, 'HPP 1', 10000.0000, 1, 1, '2021-12-11 01:04:33', '2021-12-11 01:04:33', NULL, 1, 1, NULL);
INSERT INTO `hpps` VALUES (2, 'HPP 2', 20000.0000, 2, 2, '2021-12-11 01:04:43', '2021-12-11 01:04:43', NULL, 1, 1, NULL);
INSERT INTO `hpps` VALUES (3, 'HPP 3', 30000.0000, 3, 1, '2021-12-11 01:04:52', '2021-12-11 01:04:52', NULL, 1, 1, NULL);

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
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of merks
-- ----------------------------
INSERT INTO `merks` VALUES (1, 'Merk A', 1, 1, NULL, '2021-12-11 01:04:07', '2021-12-11 01:04:07', NULL);
INSERT INTO `merks` VALUES (2, 'Merk B', 1, 1, NULL, '2021-12-11 01:04:10', '2021-12-11 01:04:10', NULL);
INSERT INTO `merks` VALUES (3, 'Merk C', 1, 1, NULL, '2021-12-11 01:04:13', '2021-12-11 01:04:13', NULL);

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
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of order_payments
-- ----------------------------
INSERT INTO `order_payments` VALUES (1, 1, 1001, '252588b622d012fca6f2f533e94bf1da.jpeg', 'valid', NULL, 'dp', '2021-12-11 01:28:45', '2021-12-11 01:29:09', NULL, 1001, 1, NULL);

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
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of order_requests
-- ----------------------------
INSERT INTO `order_requests` VALUES (1, 1, 1, 10000.0000, '2021-12-11 01:25:57', '2021-12-11 01:26:04', NULL, 1, 1, NULL);

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
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of orders
-- ----------------------------
INSERT INTO `orders` VALUES (1, 1, 'PKG.11.12.21001', '3', '2021-12-11 04:25:32', '2022-01-10', 'wa', 1, 100000.0000, 1, 1, 0.0000, 'standard', 0.0000, 'test catatan', 1001, '082114578976', '', '', '', 'naik produksi', 'partial', 'antrian', 110000.0000, 1, 110001.00000, '50', 55000.5000, 55000.5000, 55000.5000, NULL, NULL, NULL, NULL, 1, 1, NULL, 1, 'no', 'no', 'no', 'active', '2021-12-11 01:25:32', '2021-12-11 01:29:09', NULL, 1, 1, NULL);
INSERT INTO `orders` VALUES (5, 0, 'PKG.16.12.21003', '', '0000-00-00 00:00:00', NULL, '', 0, NULL, 0, 0, NULL, '', NULL, NULL, 0, '', NULL, NULL, NULL, '', '', 'antrian', 0.0000, 3, 0.00000, '', 0.0000, 0.0000, 0.0000, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 'no', 'no', 'no', 'temp', '2021-12-16 02:03:33', '2021-12-16 02:03:33', NULL, 1, 1, NULL);

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
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of pembelian
-- ----------------------------

-- ----------------------------
-- Table structure for pengurangan
-- ----------------------------
DROP TABLE IF EXISTS `pengurangan`;
CREATE TABLE `pengurangan`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tanggal` date NULL DEFAULT NULL,
  `untuk` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `keterangan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `kategori_id` int(11) NULL DEFAULT NULL,
  `barang_id` int(11) NULL DEFAULT NULL,
  `sub_barang_id` int(11) NULL DEFAULT NULL,
  `qty` int(11) NULL DEFAULT NULL,
  `created_by` int(10) UNSIGNED NULL DEFAULT NULL,
  `updated_by` int(10) UNSIGNED NULL DEFAULT NULL,
  `deleted_by` int(10) UNSIGNED NULL DEFAULT NULL,
  `created_at` datetime NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  `deleted_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of pengurangan
-- ----------------------------

-- ----------------------------
-- Table structure for permintaan
-- ----------------------------
DROP TABLE IF EXISTS `permintaan`;
CREATE TABLE `permintaan`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tanggal` date NULL DEFAULT NULL,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `request_item` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `untuk` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `barang_id` int(10) UNSIGNED NULL DEFAULT NULL,
  `sub_barang_id` int(10) UNSIGNED NULL DEFAULT NULL,
  `qty` int(10) UNSIGNED NULL DEFAULT NULL,
  `status_permintaan` enum('pending','order','selesai') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created_by` int(10) UNSIGNED NULL DEFAULT NULL,
  `updated_by` int(10) UNSIGNED NULL DEFAULT NULL,
  `deleted_by` int(10) UNSIGNED NULL DEFAULT NULL,
  `created_at` datetime NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  `deleted_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of permintaan
-- ----------------------------

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
) ENGINE = InnoDB AUTO_INCREMENT = 26 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of product_color_params
-- ----------------------------
INSERT INTO `product_color_params` VALUES (21, 1, 1, '2021-12-11 01:13:57', '2021-12-11 01:13:57', NULL, 1, 1, NULL);
INSERT INTO `product_color_params` VALUES (22, 1, 2, '2021-12-11 01:13:57', '2021-12-11 01:13:57', NULL, 1, 1, NULL);
INSERT INTO `product_color_params` VALUES (23, 1, 3, '2021-12-11 01:13:57', '2021-12-11 01:13:57', NULL, 1, 1, NULL);
INSERT INTO `product_color_params` VALUES (24, 1, 4, '2021-12-11 01:13:57', '2021-12-11 01:13:57', NULL, 1, 1, NULL);
INSERT INTO `product_color_params` VALUES (25, 1, 5, '2021-12-11 01:13:57', '2021-12-11 01:13:57', NULL, 1, 1, NULL);

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
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of product_hpp_params
-- ----------------------------
INSERT INTO `product_hpp_params` VALUES (1, 1, 1, 1.0000, 10000.0000, 10000.0000, '2021-12-11 01:05:52', '2021-12-11 01:13:57', NULL, 1, 1, NULL);
INSERT INTO `product_hpp_params` VALUES (2, 1, 2, 1.0000, 20000.0000, 20000.0000, '2021-12-11 01:05:57', '2021-12-11 01:13:57', NULL, 1, 1, NULL);
INSERT INTO `product_hpp_params` VALUES (3, 1, 3, 1.0000, 30000.0000, 30000.0000, '2021-12-11 01:06:01', '2021-12-11 01:13:57', NULL, 1, 1, NULL);

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
) ENGINE = InnoDB AUTO_INCREMENT = 16 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of product_request_params
-- ----------------------------
INSERT INTO `product_request_params` VALUES (13, 1, 1, '2021-12-11 01:13:57', '2021-12-11 01:13:57', NULL, 1, 1, NULL);
INSERT INTO `product_request_params` VALUES (14, 1, 2, '2021-12-11 01:13:57', '2021-12-11 01:13:57', NULL, 1, 1, NULL);
INSERT INTO `product_request_params` VALUES (15, 1, 3, '2021-12-11 01:13:57', '2021-12-11 01:13:57', NULL, 1, 1, NULL);

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
) ENGINE = InnoDB AUTO_INCREMENT = 31 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of product_size_params
-- ----------------------------
INSERT INTO `product_size_params` VALUES (25, 1, 1, '2021-12-11 01:13:57', '2021-12-11 01:13:57', NULL, 1, 1, NULL);
INSERT INTO `product_size_params` VALUES (26, 1, 2, '2021-12-11 01:13:57', '2021-12-11 01:13:57', NULL, 1, 1, NULL);
INSERT INTO `product_size_params` VALUES (27, 1, 3, '2021-12-11 01:13:57', '2021-12-11 01:13:57', NULL, 1, 1, NULL);
INSERT INTO `product_size_params` VALUES (28, 1, 4, '2021-12-11 01:13:57', '2021-12-11 01:13:57', NULL, 1, 1, NULL);
INSERT INTO `product_size_params` VALUES (29, 1, 5, '2021-12-11 01:13:57', '2021-12-11 01:13:57', NULL, 1, 1, NULL);
INSERT INTO `product_size_params` VALUES (30, 1, 6, '2021-12-11 01:13:57', '2021-12-11 01:13:57', NULL, 1, 1, NULL);

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
  `standard` tinyint(1) NULL DEFAULT 1,
  `express` tinyint(1) NULL DEFAULT NULL,
  `urgent` tinyint(1) NULL DEFAULT NULL,
  `super_urgent` tinyint(1) NULL DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  `deleted_at` datetime NULL DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `updated_by` int(10) UNSIGNED NULL DEFAULT NULL,
  `deleted_by` int(10) UNSIGNED NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of products
-- ----------------------------
INSERT INTO `products` VALUES (1, 'P.11.12.21001', 'Produk A', 100000.0000, '0db0bf94129c2bfeb7b73cf173ae6d8d.jpg', '5a2139abd52a711f9bc8949d507bc199.jpeg', NULL, 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Debitis placeat magnam, provident eligendi id illum soluta dolor vero dolorum minus, ipsum laudantium amet libero aperiam laborum officia ea voluptate dicta.', 'active', 1, 1, 1, 1, 1, '2021-12-11 01:05:04', '2021-12-11 01:26:04', NULL, 1, NULL, NULL);
INSERT INTO `products` VALUES (3, 'P.16.12.21002', '', 0.0000, NULL, NULL, NULL, NULL, 'temp', 0, 1, NULL, NULL, NULL, '2021-12-16 02:05:53', '2021-12-16 02:05:53', NULL, 1, 1, NULL);

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
INSERT INTO `requests` VALUES (1, 'Request 1', 10000.0000, '2021-12-11 01:03:31', '2021-12-11 01:03:31', NULL, 1, 1, NULL);
INSERT INTO `requests` VALUES (2, 'Request 2', 20000.0000, '2021-12-11 01:03:38', '2021-12-11 01:03:38', NULL, 1, 1, NULL);
INSERT INTO `requests` VALUES (3, 'Request 3', 30000.0000, '2021-12-11 01:03:44', '2021-12-11 01:03:44', NULL, 1, 1, NULL);

-- ----------------------------
-- Table structure for sequence_orders
-- ----------------------------
DROP TABLE IF EXISTS `sequence_orders`;
CREATE TABLE `sequence_orders`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `sequence` int(10) UNSIGNED NOT NULL,
  `created_at` date NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of sequence_orders
-- ----------------------------
INSERT INTO `sequence_orders` VALUES (1, 2, '2021-12-11');
INSERT INTO `sequence_orders` VALUES (2, 3, '2021-12-16');

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
INSERT INTO `sequence_products` VALUES (1, 1, '2021-12-11');
INSERT INTO `sequence_products` VALUES (2, 2, '2021-12-16');

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
INSERT INTO `sizes` VALUES (1, 'XS', 0.0000, '2021-12-11 01:02:42', '2021-12-11 01:02:42', NULL, 1, 1, NULL);
INSERT INTO `sizes` VALUES (2, 'S', 0.0000, '2021-12-11 01:02:49', '2021-12-11 01:02:49', NULL, 1, 1, NULL);
INSERT INTO `sizes` VALUES (3, 'M', 0.0000, '2021-12-11 01:02:52', '2021-12-11 01:02:52', NULL, 1, 1, NULL);
INSERT INTO `sizes` VALUES (4, 'L', 0.0000, '2021-12-11 01:02:57', '2021-12-11 01:02:57', NULL, 1, 1, NULL);
INSERT INTO `sizes` VALUES (5, 'XL', 50000.0000, '2021-12-11 01:03:02', '2021-12-11 01:03:02', NULL, 1, 1, NULL);
INSERT INTO `sizes` VALUES (6, 'XXL', 100000.0000, '2021-12-11 01:03:08', '2021-12-11 01:03:08', NULL, 1, 1, NULL);

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
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of sub_barangs
-- ----------------------------

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
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of sub_pembelian
-- ----------------------------

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
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of supplier
-- ----------------------------
INSERT INTO `supplier` VALUES (1, 'Supplier A', 'Jl. A', 1, 1, NULL, '2021-12-11 01:01:36', '2021-12-11 01:01:36', NULL);
INSERT INTO `supplier` VALUES (2, 'Supplier B', 'Jl. B', 1, 1, NULL, '2021-12-11 01:01:43', '2021-12-11 01:01:43', NULL);

-- ----------------------------
-- Table structure for test
-- ----------------------------
DROP TABLE IF EXISTS `test`;
CREATE TABLE `test`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 464 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of test
-- ----------------------------
INSERT INTO `test` VALUES (1, 'test2021-11-20 22:19:48');
INSERT INTO `test` VALUES (2, 'test2021-11-28 23:06:02');
INSERT INTO `test` VALUES (3, 'test2021-11-28 23:12:03');
INSERT INTO `test` VALUES (4, 'test2021-11-28 23:18:03');
INSERT INTO `test` VALUES (5, 'test2021-11-28 23:24:03');
INSERT INTO `test` VALUES (6, 'test2021-11-28 23:30:05');
INSERT INTO `test` VALUES (7, 'test2021-11-28 23:36:03');
INSERT INTO `test` VALUES (8, 'test2021-11-28 23:42:03');
INSERT INTO `test` VALUES (9, 'test2021-11-28 23:48:02');
INSERT INTO `test` VALUES (10, 'test2021-11-28 23:54:03');
INSERT INTO `test` VALUES (11, 'test2021-11-29 00:00:12');
INSERT INTO `test` VALUES (12, 'test2021-11-29 00:06:02');
INSERT INTO `test` VALUES (13, 'test2021-11-29 00:12:02');
INSERT INTO `test` VALUES (14, 'test2021-11-29 00:18:03');
INSERT INTO `test` VALUES (15, 'test2021-11-29 00:24:03');
INSERT INTO `test` VALUES (16, 'test2021-11-29 00:30:04');
INSERT INTO `test` VALUES (17, 'test2021-11-29 00:36:03');
INSERT INTO `test` VALUES (18, 'test2021-11-29 00:42:02');
INSERT INTO `test` VALUES (19, 'test2021-11-29 00:48:03');
INSERT INTO `test` VALUES (20, 'test2021-11-29 00:54:03');
INSERT INTO `test` VALUES (21, 'test2021-11-29 01:00:06');
INSERT INTO `test` VALUES (22, 'test2021-11-29 01:06:02');
INSERT INTO `test` VALUES (23, 'test2021-11-29 01:12:02');
INSERT INTO `test` VALUES (24, 'test2021-11-29 01:18:02');
INSERT INTO `test` VALUES (25, 'test2021-11-29 01:24:03');
INSERT INTO `test` VALUES (26, 'test2021-11-29 01:30:04');
INSERT INTO `test` VALUES (27, 'test2021-11-29 01:36:02');
INSERT INTO `test` VALUES (28, 'test2021-11-29 01:42:03');
INSERT INTO `test` VALUES (29, 'test2021-11-29 01:48:02');
INSERT INTO `test` VALUES (30, 'test2021-11-29 01:54:03');
INSERT INTO `test` VALUES (31, 'test2021-11-29 02:00:06');
INSERT INTO `test` VALUES (32, 'test2021-11-29 02:06:02');
INSERT INTO `test` VALUES (33, 'test2021-11-29 02:12:01');
INSERT INTO `test` VALUES (34, 'test2021-11-29 02:18:03');
INSERT INTO `test` VALUES (35, 'test2021-11-29 02:24:02');
INSERT INTO `test` VALUES (36, 'test2021-11-29 02:30:03');
INSERT INTO `test` VALUES (37, 'test2021-11-29 02:36:03');
INSERT INTO `test` VALUES (38, 'test2021-11-29 02:42:03');
INSERT INTO `test` VALUES (39, 'test2021-11-29 02:48:03');
INSERT INTO `test` VALUES (40, 'test2021-11-29 02:54:03');
INSERT INTO `test` VALUES (41, 'test2021-11-29 03:00:06');
INSERT INTO `test` VALUES (42, 'test2021-11-29 03:06:02');
INSERT INTO `test` VALUES (43, 'test2021-11-29 03:12:02');
INSERT INTO `test` VALUES (44, 'test2021-11-29 03:18:03');
INSERT INTO `test` VALUES (45, 'test2021-11-29 03:24:03');
INSERT INTO `test` VALUES (46, 'test2021-11-29 03:30:04');
INSERT INTO `test` VALUES (47, 'test2021-11-29 03:36:02');
INSERT INTO `test` VALUES (48, 'test2021-11-29 03:42:03');
INSERT INTO `test` VALUES (49, 'test2021-11-29 03:48:02');
INSERT INTO `test` VALUES (50, 'test2021-11-29 03:54:03');
INSERT INTO `test` VALUES (51, 'test2021-11-29 04:00:06');
INSERT INTO `test` VALUES (52, 'test2021-11-29 04:06:01');
INSERT INTO `test` VALUES (53, 'test2021-11-29 04:12:02');
INSERT INTO `test` VALUES (54, 'test2021-11-29 04:18:03');
INSERT INTO `test` VALUES (55, 'test2021-11-29 04:24:03');
INSERT INTO `test` VALUES (56, 'test2021-11-29 04:30:03');
INSERT INTO `test` VALUES (57, 'test2021-11-29 04:36:03');
INSERT INTO `test` VALUES (58, 'test2021-11-29 04:42:02');
INSERT INTO `test` VALUES (59, 'test2021-11-29 04:48:02');
INSERT INTO `test` VALUES (60, 'test2021-11-29 04:54:03');
INSERT INTO `test` VALUES (61, 'test2021-11-29 05:00:06');
INSERT INTO `test` VALUES (62, 'test2021-11-29 05:06:02');
INSERT INTO `test` VALUES (63, 'test2021-11-29 05:12:02');
INSERT INTO `test` VALUES (64, 'test2021-11-29 05:18:01');
INSERT INTO `test` VALUES (65, 'test2021-11-29 05:24:03');
INSERT INTO `test` VALUES (66, 'test2021-11-29 05:30:05');
INSERT INTO `test` VALUES (67, 'test2021-11-29 05:36:03');
INSERT INTO `test` VALUES (68, 'test2021-11-29 05:42:02');
INSERT INTO `test` VALUES (69, 'test2021-11-29 05:48:03');
INSERT INTO `test` VALUES (70, 'test2021-11-29 05:54:03');
INSERT INTO `test` VALUES (71, 'test2021-11-29 06:00:06');
INSERT INTO `test` VALUES (72, 'test2021-11-29 06:06:02');
INSERT INTO `test` VALUES (73, 'test2021-11-29 06:12:02');
INSERT INTO `test` VALUES (74, 'test2021-11-29 06:18:03');
INSERT INTO `test` VALUES (75, 'test2021-11-29 06:24:02');
INSERT INTO `test` VALUES (76, 'test2021-11-29 06:30:04');
INSERT INTO `test` VALUES (77, 'test2021-11-29 06:36:03');
INSERT INTO `test` VALUES (78, 'test2021-11-29 06:42:02');
INSERT INTO `test` VALUES (79, 'test2021-11-29 06:48:03');
INSERT INTO `test` VALUES (80, 'test2021-11-29 06:54:03');
INSERT INTO `test` VALUES (81, 'test2021-11-29 07:00:06');
INSERT INTO `test` VALUES (82, 'test2021-11-29 07:06:02');
INSERT INTO `test` VALUES (83, 'test2021-11-29 07:12:01');
INSERT INTO `test` VALUES (84, 'test2021-11-29 07:18:03');
INSERT INTO `test` VALUES (85, 'test2021-11-29 07:24:03');
INSERT INTO `test` VALUES (86, 'test2021-11-29 07:30:04');
INSERT INTO `test` VALUES (87, 'test2021-11-29 07:36:03');
INSERT INTO `test` VALUES (88, 'test2021-11-29 07:42:03');
INSERT INTO `test` VALUES (89, 'test2021-11-29 07:48:03');
INSERT INTO `test` VALUES (90, 'test2021-11-29 07:54:03');
INSERT INTO `test` VALUES (91, 'test2021-11-29 08:00:07');
INSERT INTO `test` VALUES (92, 'test2021-11-29 08:06:02');
INSERT INTO `test` VALUES (93, 'test2021-11-29 08:12:03');
INSERT INTO `test` VALUES (94, 'test2021-11-29 08:18:03');
INSERT INTO `test` VALUES (95, 'test2021-11-29 08:24:04');
INSERT INTO `test` VALUES (96, 'test2021-11-29 08:30:05');
INSERT INTO `test` VALUES (97, 'test2021-11-29 08:36:03');
INSERT INTO `test` VALUES (98, 'test2021-11-29 08:42:02');
INSERT INTO `test` VALUES (99, 'test2021-11-29 08:48:04');
INSERT INTO `test` VALUES (100, 'test2021-11-29 08:54:04');
INSERT INTO `test` VALUES (101, 'test2021-11-29 09:00:10');
INSERT INTO `test` VALUES (102, 'test2021-11-29 09:06:03');
INSERT INTO `test` VALUES (103, 'test2021-11-29 09:12:02');
INSERT INTO `test` VALUES (104, 'test2021-11-29 09:18:03');
INSERT INTO `test` VALUES (105, 'test2021-11-29 09:24:04');
INSERT INTO `test` VALUES (106, 'test2021-11-29 09:30:05');
INSERT INTO `test` VALUES (107, 'test2021-11-29 09:36:03');
INSERT INTO `test` VALUES (108, 'test2021-11-29 09:42:04');
INSERT INTO `test` VALUES (109, 'test2021-11-29 09:48:03');
INSERT INTO `test` VALUES (110, 'test2021-11-29 09:54:03');
INSERT INTO `test` VALUES (111, 'test2021-11-29 10:00:07');
INSERT INTO `test` VALUES (112, 'test2021-11-29 10:06:02');
INSERT INTO `test` VALUES (113, 'test2021-11-29 10:12:03');
INSERT INTO `test` VALUES (114, 'test2021-11-29 10:18:03');
INSERT INTO `test` VALUES (115, 'test2021-11-29 10:24:03');
INSERT INTO `test` VALUES (116, 'test2021-11-29 10:30:05');
INSERT INTO `test` VALUES (117, 'test2021-11-29 10:36:04');
INSERT INTO `test` VALUES (118, 'test2021-11-29 10:42:04');
INSERT INTO `test` VALUES (119, 'test2021-11-29 10:48:05');
INSERT INTO `test` VALUES (120, 'test2021-11-29 10:54:03');
INSERT INTO `test` VALUES (121, 'test2021-11-29 11:00:07');
INSERT INTO `test` VALUES (122, 'test2021-11-29 11:06:02');
INSERT INTO `test` VALUES (123, 'test2021-11-29 11:12:02');
INSERT INTO `test` VALUES (124, 'test2021-11-29 11:18:04');
INSERT INTO `test` VALUES (125, 'test2021-11-29 11:24:03');
INSERT INTO `test` VALUES (126, 'test2021-11-29 11:30:04');
INSERT INTO `test` VALUES (127, 'test2021-11-29 11:36:03');
INSERT INTO `test` VALUES (128, 'test2021-11-29 11:42:03');
INSERT INTO `test` VALUES (129, 'test2021-11-29 11:48:03');
INSERT INTO `test` VALUES (130, 'test2021-11-29 11:54:03');
INSERT INTO `test` VALUES (131, 'test2021-11-29 12:00:09');
INSERT INTO `test` VALUES (132, 'test2021-11-29 12:06:02');
INSERT INTO `test` VALUES (133, 'test2021-11-29 12:12:02');
INSERT INTO `test` VALUES (134, 'test2021-11-29 12:18:02');
INSERT INTO `test` VALUES (135, 'test2021-11-29 12:24:03');
INSERT INTO `test` VALUES (136, 'test2021-11-29 12:30:06');
INSERT INTO `test` VALUES (137, 'test2021-11-29 12:36:04');
INSERT INTO `test` VALUES (138, 'test2021-11-29 12:42:03');
INSERT INTO `test` VALUES (139, 'test2021-11-29 12:48:04');
INSERT INTO `test` VALUES (140, 'test2021-11-29 12:54:02');
INSERT INTO `test` VALUES (141, 'test2021-11-29 13:00:08');
INSERT INTO `test` VALUES (142, 'test2021-11-29 13:06:02');
INSERT INTO `test` VALUES (143, 'test2021-11-29 13:12:02');
INSERT INTO `test` VALUES (144, 'test2021-11-29 13:18:03');
INSERT INTO `test` VALUES (145, 'test2021-11-29 13:24:03');
INSERT INTO `test` VALUES (146, 'test2021-11-29 13:30:05');
INSERT INTO `test` VALUES (147, 'test2021-11-29 13:36:04');
INSERT INTO `test` VALUES (148, 'test2021-11-29 13:42:03');
INSERT INTO `test` VALUES (149, 'test2021-11-29 13:48:03');
INSERT INTO `test` VALUES (150, 'test2021-11-29 13:54:04');
INSERT INTO `test` VALUES (151, 'test2021-11-29 14:00:06');
INSERT INTO `test` VALUES (152, 'test2021-11-29 14:06:04');
INSERT INTO `test` VALUES (153, 'test2021-11-29 14:12:03');
INSERT INTO `test` VALUES (154, 'test2021-11-29 14:18:03');
INSERT INTO `test` VALUES (155, 'test2021-11-29 14:24:03');
INSERT INTO `test` VALUES (156, 'test2021-11-29 14:30:07');
INSERT INTO `test` VALUES (157, 'test2021-11-29 14:36:03');
INSERT INTO `test` VALUES (158, 'test2021-11-29 14:42:03');
INSERT INTO `test` VALUES (159, 'test2021-11-29 14:48:03');
INSERT INTO `test` VALUES (160, 'test2021-11-29 14:54:03');
INSERT INTO `test` VALUES (161, 'test2021-11-29 15:00:07');
INSERT INTO `test` VALUES (162, 'test2021-11-29 15:06:02');
INSERT INTO `test` VALUES (163, 'test2021-11-29 15:12:02');
INSERT INTO `test` VALUES (164, 'test2021-11-29 15:18:04');
INSERT INTO `test` VALUES (165, 'test2021-11-29 15:24:04');
INSERT INTO `test` VALUES (166, 'test2021-11-29 15:30:05');
INSERT INTO `test` VALUES (167, 'test2021-11-29 15:36:03');
INSERT INTO `test` VALUES (168, 'test2021-11-29 15:42:03');
INSERT INTO `test` VALUES (169, 'test2021-11-29 15:48:03');
INSERT INTO `test` VALUES (170, 'test2021-11-29 15:54:03');
INSERT INTO `test` VALUES (171, 'test2021-11-29 16:00:06');
INSERT INTO `test` VALUES (172, 'test2021-11-29 16:06:02');
INSERT INTO `test` VALUES (173, 'test2021-11-29 16:12:03');
INSERT INTO `test` VALUES (174, 'test2021-11-29 16:18:03');
INSERT INTO `test` VALUES (175, 'test2021-11-29 16:24:03');
INSERT INTO `test` VALUES (176, 'test2021-11-29 16:30:04');
INSERT INTO `test` VALUES (177, 'test2021-11-29 16:36:03');
INSERT INTO `test` VALUES (178, 'test2021-11-29 16:42:03');
INSERT INTO `test` VALUES (179, 'test2021-11-29 16:48:03');
INSERT INTO `test` VALUES (180, 'test2021-11-29 16:54:03');
INSERT INTO `test` VALUES (181, 'test2021-11-29 17:00:07');
INSERT INTO `test` VALUES (182, 'test2021-11-29 17:06:02');
INSERT INTO `test` VALUES (183, 'test2021-11-29 17:12:02');
INSERT INTO `test` VALUES (184, 'test2021-11-29 17:18:01');
INSERT INTO `test` VALUES (185, 'test2021-11-29 17:24:03');
INSERT INTO `test` VALUES (186, 'test2021-11-29 17:30:04');
INSERT INTO `test` VALUES (187, 'test2021-11-29 17:36:04');
INSERT INTO `test` VALUES (188, 'test2021-11-29 17:42:03');
INSERT INTO `test` VALUES (189, 'test2021-11-29 17:48:02');
INSERT INTO `test` VALUES (190, 'test2021-11-29 17:54:03');
INSERT INTO `test` VALUES (191, 'test2021-11-29 18:00:06');
INSERT INTO `test` VALUES (192, 'test2021-11-29 18:06:02');
INSERT INTO `test` VALUES (193, 'test2021-11-29 18:12:02');
INSERT INTO `test` VALUES (194, 'test2021-11-29 18:18:02');
INSERT INTO `test` VALUES (195, 'test2021-11-29 18:24:04');
INSERT INTO `test` VALUES (196, 'test2021-11-29 18:30:05');
INSERT INTO `test` VALUES (197, 'test2021-11-29 18:36:03');
INSERT INTO `test` VALUES (198, 'test2021-11-29 18:42:02');
INSERT INTO `test` VALUES (199, 'test2021-11-29 18:48:03');
INSERT INTO `test` VALUES (200, 'test2021-11-29 18:54:03');
INSERT INTO `test` VALUES (201, 'test2021-11-29 19:00:07');
INSERT INTO `test` VALUES (202, 'test2021-11-29 19:06:02');
INSERT INTO `test` VALUES (203, 'test2021-11-29 19:12:03');
INSERT INTO `test` VALUES (204, 'test2021-11-29 19:18:04');
INSERT INTO `test` VALUES (205, 'test2021-11-29 19:24:03');
INSERT INTO `test` VALUES (206, 'test2021-11-29 19:30:04');
INSERT INTO `test` VALUES (207, 'test2021-11-29 19:36:03');
INSERT INTO `test` VALUES (208, 'test2021-11-29 19:42:02');
INSERT INTO `test` VALUES (209, 'test2021-11-29 19:48:03');
INSERT INTO `test` VALUES (210, 'test2021-11-29 19:54:03');
INSERT INTO `test` VALUES (211, 'test2021-11-29 20:00:07');
INSERT INTO `test` VALUES (212, 'test2021-11-29 20:06:03');
INSERT INTO `test` VALUES (213, 'test2021-11-29 20:12:02');
INSERT INTO `test` VALUES (214, 'test2021-11-29 20:18:03');
INSERT INTO `test` VALUES (215, 'test2021-11-29 20:24:03');
INSERT INTO `test` VALUES (216, 'test2021-11-29 20:30:04');
INSERT INTO `test` VALUES (217, 'test2021-11-29 20:36:04');
INSERT INTO `test` VALUES (218, 'test2021-11-29 20:42:03');
INSERT INTO `test` VALUES (219, 'test2021-11-29 20:48:02');
INSERT INTO `test` VALUES (220, 'test2021-11-29 20:54:03');
INSERT INTO `test` VALUES (221, 'test2021-11-29 21:00:05');
INSERT INTO `test` VALUES (222, 'test2021-11-29 21:06:03');
INSERT INTO `test` VALUES (223, 'test2021-11-29 21:12:02');
INSERT INTO `test` VALUES (224, 'test2021-11-29 21:18:04');
INSERT INTO `test` VALUES (225, 'test2021-11-29 21:24:03');
INSERT INTO `test` VALUES (226, 'test2021-11-29 21:30:05');
INSERT INTO `test` VALUES (227, 'test2021-11-29 21:36:03');
INSERT INTO `test` VALUES (228, 'test2021-11-29 21:42:04');
INSERT INTO `test` VALUES (229, 'test2021-11-29 21:48:02');
INSERT INTO `test` VALUES (230, 'test2021-11-29 21:54:03');
INSERT INTO `test` VALUES (231, 'test2021-11-29 22:00:07');
INSERT INTO `test` VALUES (232, 'test2021-11-29 22:06:03');
INSERT INTO `test` VALUES (233, 'test2021-11-29 22:12:02');
INSERT INTO `test` VALUES (234, 'test2021-11-29 22:18:04');
INSERT INTO `test` VALUES (235, 'test2021-11-29 22:24:04');
INSERT INTO `test` VALUES (236, 'test2021-11-29 22:30:04');
INSERT INTO `test` VALUES (237, 'test2021-11-29 22:36:03');
INSERT INTO `test` VALUES (238, 'test2021-11-29 22:42:02');
INSERT INTO `test` VALUES (239, 'test2021-11-29 22:48:04');
INSERT INTO `test` VALUES (240, 'test2021-11-29 22:54:03');
INSERT INTO `test` VALUES (241, 'test2021-11-29 23:00:09');
INSERT INTO `test` VALUES (242, 'test2021-11-29 23:06:03');
INSERT INTO `test` VALUES (243, 'test2021-11-29 23:12:02');
INSERT INTO `test` VALUES (244, 'test2021-11-29 23:18:04');
INSERT INTO `test` VALUES (245, 'test2021-11-29 23:24:03');
INSERT INTO `test` VALUES (246, 'test2021-11-29 23:30:06');
INSERT INTO `test` VALUES (247, 'test2021-11-29 23:36:04');
INSERT INTO `test` VALUES (248, 'test2021-11-29 23:42:05');
INSERT INTO `test` VALUES (249, 'test2021-11-29 23:48:04');
INSERT INTO `test` VALUES (250, 'test2021-11-29 23:54:04');
INSERT INTO `test` VALUES (251, 'test2021-11-30 00:00:10');
INSERT INTO `test` VALUES (252, 'test2021-11-30 00:06:03');
INSERT INTO `test` VALUES (253, 'test2021-11-30 00:12:03');
INSERT INTO `test` VALUES (254, 'test2021-11-30 00:18:04');
INSERT INTO `test` VALUES (255, 'test2021-11-30 00:24:03');
INSERT INTO `test` VALUES (256, 'test2021-11-30 00:30:06');
INSERT INTO `test` VALUES (257, 'test2021-11-30 00:36:03');
INSERT INTO `test` VALUES (258, 'test2021-11-30 00:42:04');
INSERT INTO `test` VALUES (259, 'test2021-11-30 00:48:03');
INSERT INTO `test` VALUES (260, 'test2021-11-30 00:54:03');
INSERT INTO `test` VALUES (261, 'test2021-11-30 01:00:07');
INSERT INTO `test` VALUES (262, 'test2021-11-30 01:06:03');
INSERT INTO `test` VALUES (263, 'test2021-11-30 01:12:03');
INSERT INTO `test` VALUES (264, 'test2021-11-30 01:18:04');
INSERT INTO `test` VALUES (265, 'test2021-11-30 01:24:04');
INSERT INTO `test` VALUES (266, 'test2021-11-30 01:30:05');
INSERT INTO `test` VALUES (267, 'test2021-11-30 01:36:03');
INSERT INTO `test` VALUES (268, 'test2021-11-30 01:42:03');
INSERT INTO `test` VALUES (269, 'test2021-11-30 01:48:03');
INSERT INTO `test` VALUES (270, 'test2021-11-30 01:54:03');
INSERT INTO `test` VALUES (271, 'test2021-11-30 02:00:08');
INSERT INTO `test` VALUES (272, 'test2021-11-30 02:06:03');
INSERT INTO `test` VALUES (273, 'test2021-11-30 02:12:02');
INSERT INTO `test` VALUES (274, 'test2021-11-30 02:18:02');
INSERT INTO `test` VALUES (275, 'test2021-11-30 02:24:03');
INSERT INTO `test` VALUES (276, 'test2021-11-30 02:30:06');
INSERT INTO `test` VALUES (277, 'test2021-11-30 02:36:03');
INSERT INTO `test` VALUES (278, 'test2021-11-30 02:42:02');
INSERT INTO `test` VALUES (279, 'test2021-11-30 02:48:03');
INSERT INTO `test` VALUES (280, 'test2021-11-30 02:54:03');
INSERT INTO `test` VALUES (281, 'test2021-11-30 03:00:07');
INSERT INTO `test` VALUES (282, 'test2021-11-30 03:06:02');
INSERT INTO `test` VALUES (283, 'test2021-11-30 03:12:03');
INSERT INTO `test` VALUES (284, 'test2021-11-30 03:18:04');
INSERT INTO `test` VALUES (285, 'test2021-11-30 03:24:03');
INSERT INTO `test` VALUES (286, 'test2021-11-30 03:30:04');
INSERT INTO `test` VALUES (287, 'test2021-11-30 03:36:02');
INSERT INTO `test` VALUES (288, 'test2021-11-30 03:42:04');
INSERT INTO `test` VALUES (289, 'test2021-11-30 03:48:03');
INSERT INTO `test` VALUES (290, 'test2021-11-30 03:54:04');
INSERT INTO `test` VALUES (291, 'test2021-11-30 04:00:07');
INSERT INTO `test` VALUES (292, 'test2021-11-30 04:06:02');
INSERT INTO `test` VALUES (293, 'test2021-11-30 04:12:03');
INSERT INTO `test` VALUES (294, 'test2021-11-30 04:18:03');
INSERT INTO `test` VALUES (295, 'test2021-11-30 04:24:04');
INSERT INTO `test` VALUES (296, 'test2021-11-30 04:30:05');
INSERT INTO `test` VALUES (297, 'test2021-11-30 04:36:03');
INSERT INTO `test` VALUES (298, 'test2021-11-30 04:42:04');
INSERT INTO `test` VALUES (299, 'test2021-11-30 04:48:04');
INSERT INTO `test` VALUES (300, 'test2021-11-30 04:54:02');
INSERT INTO `test` VALUES (301, 'test2021-11-30 05:00:09');
INSERT INTO `test` VALUES (302, 'test2021-11-30 05:06:02');
INSERT INTO `test` VALUES (303, 'test2021-11-30 05:12:02');
INSERT INTO `test` VALUES (304, 'test2021-11-30 05:18:03');
INSERT INTO `test` VALUES (305, 'test2021-11-30 05:24:04');
INSERT INTO `test` VALUES (306, 'test2021-11-30 05:30:05');
INSERT INTO `test` VALUES (307, 'test2021-11-30 05:36:04');
INSERT INTO `test` VALUES (308, 'test2021-11-30 05:42:03');
INSERT INTO `test` VALUES (309, 'test2021-11-30 05:48:03');
INSERT INTO `test` VALUES (310, 'test2021-11-30 05:54:03');
INSERT INTO `test` VALUES (311, 'test2021-11-30 06:00:07');
INSERT INTO `test` VALUES (312, 'test2021-11-30 06:06:02');
INSERT INTO `test` VALUES (313, 'test2021-11-30 06:12:02');
INSERT INTO `test` VALUES (314, 'test2021-11-30 06:18:02');
INSERT INTO `test` VALUES (315, 'test2021-11-30 06:24:03');
INSERT INTO `test` VALUES (316, 'test2021-11-30 06:30:06');
INSERT INTO `test` VALUES (317, 'test2021-11-30 06:36:05');
INSERT INTO `test` VALUES (318, 'test2021-11-30 06:42:04');
INSERT INTO `test` VALUES (319, 'test2021-11-30 06:48:03');
INSERT INTO `test` VALUES (320, 'test2021-11-30 06:54:03');
INSERT INTO `test` VALUES (321, 'test2021-11-30 07:00:07');
INSERT INTO `test` VALUES (322, 'test2021-11-30 07:06:03');
INSERT INTO `test` VALUES (323, 'test2021-11-30 07:12:02');
INSERT INTO `test` VALUES (324, 'test2021-11-30 07:18:03');
INSERT INTO `test` VALUES (325, 'test2021-11-30 07:24:04');
INSERT INTO `test` VALUES (326, 'test2021-11-30 07:30:05');
INSERT INTO `test` VALUES (327, 'test2021-11-30 07:36:03');
INSERT INTO `test` VALUES (328, 'test2021-11-30 07:42:04');
INSERT INTO `test` VALUES (329, 'test2021-11-30 07:48:03');
INSERT INTO `test` VALUES (330, 'test2021-11-30 07:54:04');
INSERT INTO `test` VALUES (331, 'test2021-11-30 08:00:07');
INSERT INTO `test` VALUES (332, 'test2021-11-30 08:06:02');
INSERT INTO `test` VALUES (333, 'test2021-11-30 08:12:02');
INSERT INTO `test` VALUES (334, 'test2021-11-30 08:18:04');
INSERT INTO `test` VALUES (335, 'test2021-11-30 08:24:03');
INSERT INTO `test` VALUES (336, 'test2021-11-30 08:30:06');
INSERT INTO `test` VALUES (337, 'test2021-11-30 08:36:04');
INSERT INTO `test` VALUES (338, 'test2021-11-30 08:42:04');
INSERT INTO `test` VALUES (339, 'test2021-11-30 08:48:04');
INSERT INTO `test` VALUES (340, 'test2021-11-30 08:54:02');
INSERT INTO `test` VALUES (341, 'test2021-11-30 09:00:07');
INSERT INTO `test` VALUES (342, 'test2021-11-30 09:06:04');
INSERT INTO `test` VALUES (343, 'test2021-11-30 09:12:02');
INSERT INTO `test` VALUES (344, 'test2021-11-30 09:18:03');
INSERT INTO `test` VALUES (345, 'test2021-11-30 09:24:04');
INSERT INTO `test` VALUES (346, 'test2021-11-30 09:30:06');
INSERT INTO `test` VALUES (347, 'test2021-11-30 09:36:04');
INSERT INTO `test` VALUES (348, 'test2021-11-30 09:42:04');
INSERT INTO `test` VALUES (349, 'test2021-11-30 09:48:05');
INSERT INTO `test` VALUES (350, 'test2021-11-30 09:54:03');
INSERT INTO `test` VALUES (351, 'test2021-11-30 10:00:08');
INSERT INTO `test` VALUES (352, 'test2021-11-30 10:06:03');
INSERT INTO `test` VALUES (353, 'test2021-11-30 10:12:03');
INSERT INTO `test` VALUES (354, 'test2021-11-30 10:18:03');
INSERT INTO `test` VALUES (355, 'test2021-11-30 10:24:04');
INSERT INTO `test` VALUES (356, 'test2021-11-30 10:30:05');
INSERT INTO `test` VALUES (357, 'test2021-11-30 10:36:03');
INSERT INTO `test` VALUES (358, 'test2021-11-30 10:42:03');
INSERT INTO `test` VALUES (359, 'test2021-11-30 10:48:03');
INSERT INTO `test` VALUES (360, 'test2021-11-30 10:54:04');
INSERT INTO `test` VALUES (361, 'test2021-11-30 11:00:09');
INSERT INTO `test` VALUES (362, 'test2021-11-30 11:06:03');
INSERT INTO `test` VALUES (363, 'test2021-11-30 11:12:02');
INSERT INTO `test` VALUES (364, 'test2021-11-30 11:18:04');
INSERT INTO `test` VALUES (365, 'test2021-11-30 11:24:04');
INSERT INTO `test` VALUES (366, 'test2021-11-30 11:30:04');
INSERT INTO `test` VALUES (367, 'test2021-11-30 11:36:03');
INSERT INTO `test` VALUES (368, 'test2021-11-30 11:42:03');
INSERT INTO `test` VALUES (369, 'test2021-11-30 11:48:03');
INSERT INTO `test` VALUES (370, 'test2021-11-30 11:54:02');
INSERT INTO `test` VALUES (371, 'test2021-11-30 12:00:10');
INSERT INTO `test` VALUES (372, 'test2021-11-30 12:06:02');
INSERT INTO `test` VALUES (373, 'test2021-11-30 12:12:03');
INSERT INTO `test` VALUES (374, 'test2021-11-30 12:18:03');
INSERT INTO `test` VALUES (375, 'test2021-11-30 12:24:03');
INSERT INTO `test` VALUES (376, 'test2021-11-30 12:30:04');
INSERT INTO `test` VALUES (377, 'test2021-11-30 12:36:03');
INSERT INTO `test` VALUES (378, 'test2021-11-30 12:42:04');
INSERT INTO `test` VALUES (379, 'test2021-11-30 12:48:03');
INSERT INTO `test` VALUES (380, 'test2021-11-30 12:54:04');
INSERT INTO `test` VALUES (381, 'test2021-11-30 13:00:08');
INSERT INTO `test` VALUES (382, 'test2021-11-30 13:06:03');
INSERT INTO `test` VALUES (383, 'test2021-11-30 13:12:02');
INSERT INTO `test` VALUES (384, 'test2021-11-30 13:18:03');
INSERT INTO `test` VALUES (385, 'test2021-11-30 13:24:03');
INSERT INTO `test` VALUES (386, 'test2021-11-30 13:30:06');
INSERT INTO `test` VALUES (387, 'test2021-11-30 13:36:05');
INSERT INTO `test` VALUES (388, 'test2021-11-30 13:42:03');
INSERT INTO `test` VALUES (389, 'test2021-11-30 13:48:04');
INSERT INTO `test` VALUES (390, 'test2021-11-30 13:54:04');
INSERT INTO `test` VALUES (391, 'test2021-11-30 14:00:08');
INSERT INTO `test` VALUES (392, 'test2021-11-30 14:06:03');
INSERT INTO `test` VALUES (393, 'test2021-11-30 14:12:03');
INSERT INTO `test` VALUES (394, 'test2021-11-30 14:18:02');
INSERT INTO `test` VALUES (395, 'test2021-11-30 14:24:03');
INSERT INTO `test` VALUES (396, 'test2021-11-30 14:30:05');
INSERT INTO `test` VALUES (397, 'test2021-11-30 14:36:03');
INSERT INTO `test` VALUES (398, 'test2021-11-30 14:42:04');
INSERT INTO `test` VALUES (399, 'test2021-11-30 14:48:03');
INSERT INTO `test` VALUES (400, 'test2021-11-30 14:54:03');
INSERT INTO `test` VALUES (401, 'test2021-11-30 15:00:07');
INSERT INTO `test` VALUES (402, 'test2021-11-30 15:06:02');
INSERT INTO `test` VALUES (403, 'test2021-11-30 15:12:03');
INSERT INTO `test` VALUES (404, 'test2021-11-30 15:18:03');
INSERT INTO `test` VALUES (405, 'test2021-11-30 15:24:02');
INSERT INTO `test` VALUES (406, 'test2021-11-30 15:30:05');
INSERT INTO `test` VALUES (407, 'test2021-11-30 15:36:03');
INSERT INTO `test` VALUES (408, 'test2021-11-30 15:42:03');
INSERT INTO `test` VALUES (409, 'test2021-11-30 15:48:03');
INSERT INTO `test` VALUES (410, 'test2021-11-30 15:54:02');
INSERT INTO `test` VALUES (411, 'test2021-11-30 16:00:09');
INSERT INTO `test` VALUES (412, 'test2021-11-30 16:06:02');
INSERT INTO `test` VALUES (413, 'test2021-11-30 16:12:02');
INSERT INTO `test` VALUES (414, 'test2021-11-30 16:18:03');
INSERT INTO `test` VALUES (415, 'test2021-11-30 16:24:03');
INSERT INTO `test` VALUES (416, 'test2021-11-30 16:30:04');
INSERT INTO `test` VALUES (417, 'test2021-11-30 16:36:03');
INSERT INTO `test` VALUES (418, 'test2021-11-30 16:42:03');
INSERT INTO `test` VALUES (419, 'test2021-11-30 16:48:04');
INSERT INTO `test` VALUES (420, 'test2021-11-30 16:54:03');
INSERT INTO `test` VALUES (421, 'test2021-11-30 17:00:08');
INSERT INTO `test` VALUES (422, 'test2021-11-30 17:06:02');
INSERT INTO `test` VALUES (423, 'test2021-11-30 17:12:02');
INSERT INTO `test` VALUES (424, 'test2021-11-30 17:18:04');
INSERT INTO `test` VALUES (425, 'test2021-11-30 17:24:03');
INSERT INTO `test` VALUES (426, 'test2021-11-30 17:30:04');
INSERT INTO `test` VALUES (427, 'test2021-11-30 17:36:03');
INSERT INTO `test` VALUES (428, 'test2021-11-30 17:42:03');
INSERT INTO `test` VALUES (429, 'test2021-11-30 17:48:03');
INSERT INTO `test` VALUES (430, 'test2021-11-30 17:54:04');
INSERT INTO `test` VALUES (431, 'test2021-11-30 18:00:07');
INSERT INTO `test` VALUES (432, 'test2021-11-30 18:06:02');
INSERT INTO `test` VALUES (433, 'test2021-11-30 18:12:02');
INSERT INTO `test` VALUES (434, 'test2021-11-30 18:18:03');
INSERT INTO `test` VALUES (435, 'test2021-11-30 18:24:02');
INSERT INTO `test` VALUES (436, 'test2021-11-30 18:30:05');
INSERT INTO `test` VALUES (437, 'test2021-11-30 18:36:03');
INSERT INTO `test` VALUES (438, 'test2021-11-30 18:42:03');
INSERT INTO `test` VALUES (439, 'test2021-11-30 18:48:03');
INSERT INTO `test` VALUES (440, 'test2021-11-30 18:54:04');
INSERT INTO `test` VALUES (441, 'test2021-11-30 19:00:07');
INSERT INTO `test` VALUES (442, 'test2021-11-30 19:06:02');
INSERT INTO `test` VALUES (443, 'test2021-11-30 19:12:01');
INSERT INTO `test` VALUES (444, 'test2021-11-30 19:18:04');
INSERT INTO `test` VALUES (445, 'test2021-11-30 19:24:04');
INSERT INTO `test` VALUES (446, 'test2021-11-30 19:30:05');
INSERT INTO `test` VALUES (447, 'test2021-11-30 19:36:04');
INSERT INTO `test` VALUES (448, 'test2021-11-30 19:42:03');
INSERT INTO `test` VALUES (449, 'test2021-11-30 19:48:03');
INSERT INTO `test` VALUES (450, 'test2021-11-30 19:54:03');
INSERT INTO `test` VALUES (451, 'test2021-11-30 20:00:06');
INSERT INTO `test` VALUES (452, 'test2021-11-30 20:06:02');
INSERT INTO `test` VALUES (453, 'test2021-11-30 20:12:03');
INSERT INTO `test` VALUES (454, 'test2021-11-30 20:18:03');
INSERT INTO `test` VALUES (455, 'test2021-11-30 20:24:04');
INSERT INTO `test` VALUES (456, 'test2021-11-30 20:30:05');
INSERT INTO `test` VALUES (457, 'test2021-11-30 20:36:03');
INSERT INTO `test` VALUES (458, 'test2021-11-30 20:42:03');
INSERT INTO `test` VALUES (459, 'test2021-11-30 20:48:04');
INSERT INTO `test` VALUES (460, 'test2021-11-30 20:54:03');
INSERT INTO `test` VALUES (461, 'test2021-11-30 21:00:06');
INSERT INTO `test` VALUES (462, 'test2021-11-30 21:06:02');
INSERT INTO `test` VALUES (463, 'test2021-11-30 21:12:03');

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
INSERT INTO `units` VALUES (1, 'Cm', '2021-12-11 01:01:20', '2021-12-11 01:01:20', NULL, 1, 1, NULL);
INSERT INTO `units` VALUES (2, 'M', '2021-12-11 01:01:23', '2021-12-11 01:01:23', NULL, 1, 1, NULL);
INSERT INTO `units` VALUES (3, 'Pcs', '2021-12-11 01:01:27', '2021-12-11 01:01:27', NULL, 1, 1, NULL);

SET FOREIGN_KEY_CHECKS = 1;
