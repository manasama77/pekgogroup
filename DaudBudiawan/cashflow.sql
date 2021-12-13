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

 Date: 14/12/2021 04:06:11
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

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
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

SET FOREIGN_KEY_CHECKS = 1;
