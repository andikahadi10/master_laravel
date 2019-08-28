/*
 Navicat Premium Data Transfer

 Source Server         : local
 Source Server Type    : MySQL
 Source Server Version : 100315
 Source Host           : localhost:32774
 Source Schema         : sim_parfurm

 Target Server Type    : MySQL
 Target Server Version : 100315
 File Encoding         : 65001

 Date: 28/08/2019 13:13:28
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (1, '2014_10_12_000000_create_users_table', 1);
INSERT INTO `migrations` VALUES (2, '2014_10_12_100000_create_password_resets_table', 1);

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets`  (
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  INDEX `password_resets_email_index`(`email`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for tbl_akun
-- ----------------------------
DROP TABLE IF EXISTS `tbl_akun`;
CREATE TABLE `tbl_akun`  (
  `akun_id` int(11) NOT NULL AUTO_INCREMENT,
  `akun_id_parent` int(11) NULL DEFAULT NULL,
  `akun_kode` char(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `akun_nama` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `akun_saldo_normal` enum('D','K') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NOT NULL DEFAULT current_timestamp(0) ON UPDATE CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NOT NULL DEFAULT current_timestamp(0),
  PRIMARY KEY (`akun_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_akun
-- ----------------------------
INSERT INTO `tbl_akun` VALUES (1, 0, '1000', 'Aktiva Lancar', 'D', '2019-08-15 08:57:52', '2019-08-15 08:57:52');
INSERT INTO `tbl_akun` VALUES (8, 0, '1010', 'Kas', 'D', '2019-08-15 09:50:27', '2019-08-15 09:50:27');
INSERT INTO `tbl_akun` VALUES (9, 0, '1020', 'Bank Syariah Mandiri', 'D', '2019-08-15 10:07:03', '2019-08-15 10:07:03');

-- ----------------------------
-- Table structure for tbl_barang
-- ----------------------------
DROP TABLE IF EXISTS `tbl_barang`;
CREATE TABLE `tbl_barang`  (
  `barang_id` int(11) NOT NULL AUTO_INCREMENT,
  `satuan_id` int(11) NULL DEFAULT NULL,
  `barang_kode` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `barang_nama` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `barang_id_parent` int(11) NULL DEFAULT NULL,
  `barang_status_bahan` enum('1','2') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NOT NULL DEFAULT current_timestamp(0) ON UPDATE CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NOT NULL DEFAULT current_timestamp(0),
  PRIMARY KEY (`barang_id`) USING BTREE,
  INDEX `satuan_relation`(`satuan_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_barang
-- ----------------------------
INSERT INTO `tbl_barang` VALUES (1, 2, 'AB01', 'Antonio Banderas - Golden Secret', 0, '1', '2019-08-08 10:13:17', '0000-00-00 00:00:00');
INSERT INTO `tbl_barang` VALUES (2, 6, 'pb-30', 'Dus Botol 30 ml kotak', 0, '2', '2019-08-08 10:13:22', '0000-00-00 00:00:00');
INSERT INTO `tbl_barang` VALUES (3, 2, 'DBTL-30a', 'Hitam', 2, '2', '2019-08-08 10:13:26', '2019-08-08 09:40:31');
INSERT INTO `tbl_barang` VALUES (4, 2, 'AB03', 'Antonio Banderas - Woman', 0, '1', '2019-08-08 10:31:49', '2019-08-08 10:31:49');

-- ----------------------------
-- Table structure for tbl_detail_harga_barang
-- ----------------------------
DROP TABLE IF EXISTS `tbl_detail_harga_barang`;
CREATE TABLE `tbl_detail_harga_barang`  (
  `detail_harga_barang_id` int(11) NOT NULL AUTO_INCREMENT,
  `barang_id` int(11) NULL DEFAULT NULL,
  `detail_harga_barang_tanggal` date NULL DEFAULT NULL,
  `detail_harga_barang_harga_jual` int(11) NULL DEFAULT NULL,
  `created_at` timestamp(0) NOT NULL DEFAULT current_timestamp(0) ON UPDATE CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NOT NULL DEFAULT current_timestamp(0),
  PRIMARY KEY (`detail_harga_barang_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_detail_harga_barang
-- ----------------------------
INSERT INTO `tbl_detail_harga_barang` VALUES (1, 1, '2019-08-14', 150000, '2019-08-14 08:43:42', '2019-08-14 08:43:42');
INSERT INTO `tbl_detail_harga_barang` VALUES (2, 4, '2019-08-14', 30000, '2019-08-14 09:50:42', '2019-08-14 09:50:42');
INSERT INTO `tbl_detail_harga_barang` VALUES (3, 4, '2019-08-15', 32000, '2019-08-14 09:50:59', '2019-08-14 09:50:59');

-- ----------------------------
-- Table structure for tbl_group
-- ----------------------------
DROP TABLE IF EXISTS `tbl_group`;
CREATE TABLE `tbl_group`  (
  `group_id` int(11) NOT NULL AUTO_INCREMENT,
  `group_nama` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NOT NULL DEFAULT current_timestamp(0) ON UPDATE CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NOT NULL,
  PRIMARY KEY (`group_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_group
-- ----------------------------
INSERT INTO `tbl_group` VALUES (1, 'Administrator', '2019-08-08 11:26:39', '0000-00-00 00:00:00');
INSERT INTO `tbl_group` VALUES (3, 'Pengguna', '2019-08-08 12:26:15', '2019-08-08 12:26:15');
INSERT INTO `tbl_group` VALUES (4, 'Operator', '2019-08-12 13:31:24', '2019-08-12 13:31:24');

-- ----------------------------
-- Table structure for tbl_log_stok
-- ----------------------------
DROP TABLE IF EXISTS `tbl_log_stok`;
CREATE TABLE `tbl_log_stok`  (
  `log_stok_id` int(11) NOT NULL AUTO_INCREMENT,
  `stok_id` int(11) NULL DEFAULT NULL,
  `log_stok_tanggal` date NULL DEFAULT NULL,
  `log_stok_unit_masuk` int(11) NOT NULL,
  `log_stok_harga_masuk` int(11) NOT NULL,
  `log_stok_total_masuk` int(11) NOT NULL,
  `log_stok_unit_keluar` int(11) NOT NULL,
  `log_stok_harga_keluar` int(11) NOT NULL,
  `log_stok_total_keluar` int(11) NOT NULL,
  `log_stok_saldo_unit` int(11) NOT NULL,
  `log_stok_saldo_harga` int(11) NOT NULL,
  `log_stok_saldo_total` int(11) NOT NULL,
  `log_stok_status` enum('1','2') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NOT NULL DEFAULT current_timestamp(0) ON UPDATE CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NOT NULL DEFAULT current_timestamp(0),
  PRIMARY KEY (`log_stok_id`) USING BTREE,
  INDEX `tbl_stok_relation`(`stok_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_log_stok
-- ----------------------------
INSERT INTO `tbl_log_stok` VALUES (1, 1, '2019-08-14', 3, 12000, 36000, 0, 0, 0, 3, 12000, 36000, '1', '2019-08-14 11:02:35', '2019-08-14 11:02:35');

-- ----------------------------
-- Table structure for tbl_menu
-- ----------------------------
DROP TABLE IF EXISTS `tbl_menu`;
CREATE TABLE `tbl_menu`  (
  `menu_id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_nama` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `menu_link` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `menu_id_parent` int(11) NULL DEFAULT NULL,
  `created_at` timestamp(0) NOT NULL DEFAULT current_timestamp(0) ON UPDATE CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NOT NULL,
  PRIMARY KEY (`menu_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 23 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_menu
-- ----------------------------
INSERT INTO `tbl_menu` VALUES (8, 'Master', 'master', 0, '2019-08-12 14:28:51', '2019-08-12 14:28:51');
INSERT INTO `tbl_menu` VALUES (9, 'Satuan', 'satuan', 8, '2019-08-12 14:31:01', '2019-08-12 14:31:01');
INSERT INTO `tbl_menu` VALUES (10, 'Barang', 'barang', 8, '2019-08-12 14:32:11', '2019-08-12 14:32:11');
INSERT INTO `tbl_menu` VALUES (11, 'Manajemen User', 'manajemen_user', 0, '2019-08-13 09:08:33', '2019-08-13 09:08:33');
INSERT INTO `tbl_menu` VALUES (12, 'Group', 'group', 11, '2019-08-13 09:08:56', '2019-08-13 09:08:56');
INSERT INTO `tbl_menu` VALUES (13, 'Users', 'master_user', 11, '2019-08-13 09:09:19', '2019-08-13 09:09:19');
INSERT INTO `tbl_menu` VALUES (14, 'Menu', 'menu', 11, '2019-08-13 09:09:36', '2019-08-13 09:09:36');
INSERT INTO `tbl_menu` VALUES (15, 'Inventori', 'inventori', 0, '2019-08-13 10:22:34', '2019-08-13 10:22:34');
INSERT INTO `tbl_menu` VALUES (16, 'Stok Opname', 'stok', 15, '2019-08-13 16:09:42', '2019-08-13 16:09:42');
INSERT INTO `tbl_menu` VALUES (18, 'Supplier', 'supplier', 8, '2019-08-13 12:21:49', '2019-08-13 12:21:49');
INSERT INTO `tbl_menu` VALUES (19, 'Pembelian Barang', 'pembelian', 20, '2019-08-13 16:15:33', '2019-08-13 16:15:33');
INSERT INTO `tbl_menu` VALUES (20, 'Pembelian', '-', 0, '2019-08-13 16:15:13', '2019-08-13 16:15:13');
INSERT INTO `tbl_menu` VALUES (21, 'Keuangan', '-', 0, '2019-08-15 09:00:19', '2019-08-15 09:00:19');
INSERT INTO `tbl_menu` VALUES (22, 'Akun Perkiraan', 'akun', 8, '2019-08-28 05:15:56', '2019-08-28 12:15:56');

-- ----------------------------
-- Table structure for tbl_pembelian
-- ----------------------------
DROP TABLE IF EXISTS `tbl_pembelian`;
CREATE TABLE `tbl_pembelian`  (
  `pembelian_id` int(11) NOT NULL AUTO_INCREMENT,
  `supplier_id` int(11) NULL DEFAULT NULL,
  `pembelian_no_faktur` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `pembelian_tanggal` date NULL DEFAULT NULL,
  `pembelian_ppn_status` enum('ya','tidak') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `pembelian_cara_bayar` enum('kredit','tunai') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `pembelian_uang_muka` int(11) NULL DEFAULT NULL,
  `pembelian_jumlah` int(11) NULL DEFAULT NULL,
  `pembelian_ppn_jumlah` int(11) NULL DEFAULT NULL,
  `pembelian_ongkir` int(11) NULL DEFAULT NULL,
  `pembelian_total` int(11) NULL DEFAULT NULL,
  `created_at` timestamp(0) NOT NULL DEFAULT current_timestamp(0) ON UPDATE CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NOT NULL,
  PRIMARY KEY (`pembelian_id`) USING BTREE,
  INDEX `pembelian_to_suplier_relation`(`supplier_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for tbl_pembelian_detail
-- ----------------------------
DROP TABLE IF EXISTS `tbl_pembelian_detail`;
CREATE TABLE `tbl_pembelian_detail`  (
  `pembelian_detail_id` int(11) NOT NULL AUTO_INCREMENT,
  `pembelian_id` int(11) NULL DEFAULT NULL,
  `barang_id` int(11) NULL DEFAULT NULL,
  `pembelian_detail_qty` int(11) NULL DEFAULT NULL,
  `pembelian_detail_harga` int(11) NULL DEFAULT NULL,
  `pembelian_detail_diskon` int(11) NULL DEFAULT NULL,
  `pembelian_detail_jumlah` int(11) NULL DEFAULT NULL,
  `cretaed_at` timestamp(0) NOT NULL DEFAULT current_timestamp(0) ON UPDATE CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NOT NULL DEFAULT current_timestamp(0),
  PRIMARY KEY (`pembelian_detail_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for tbl_satuan
-- ----------------------------
DROP TABLE IF EXISTS `tbl_satuan`;
CREATE TABLE `tbl_satuan`  (
  `satuan_id` int(11) NOT NULL AUTO_INCREMENT,
  `satuan_nama` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `satuan_satuan` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NOT NULL DEFAULT current_timestamp(0) ON UPDATE CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NOT NULL,
  PRIMARY KEY (`satuan_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_satuan
-- ----------------------------
INSERT INTO `tbl_satuan` VALUES (1, 'Liter', 'ltr', '2019-08-08 09:17:52', '0000-00-00 00:00:00');
INSERT INTO `tbl_satuan` VALUES (2, 'Botol', 'btl', '2019-08-08 09:46:40', '2019-08-08 09:46:40');
INSERT INTO `tbl_satuan` VALUES (6, 'Dos', 'ds', '2019-08-08 10:12:55', '2019-08-08 10:12:55');

-- ----------------------------
-- Table structure for tbl_stok
-- ----------------------------
DROP TABLE IF EXISTS `tbl_stok`;
CREATE TABLE `tbl_stok`  (
  `stok_id` int(11) NOT NULL AUTO_INCREMENT,
  `barang_id` int(11) NULL DEFAULT NULL,
  `stok_jumlah` int(11) NULL DEFAULT NULL,
  `stok_fisik` int(11) NULL DEFAULT NULL,
  `created_at` timestamp(0) NOT NULL DEFAULT current_timestamp(0) ON UPDATE CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NOT NULL DEFAULT current_timestamp(0),
  PRIMARY KEY (`stok_id`) USING BTREE,
  INDEX `tbl_barang_relation`(`barang_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_stok
-- ----------------------------
INSERT INTO `tbl_stok` VALUES (1, 1, 30, 33, '2019-08-14 10:32:18', '2019-08-14 10:32:18');
INSERT INTO `tbl_stok` VALUES (3, 4, 20, 20, '2019-08-14 10:56:27', '2019-08-14 10:56:27');

-- ----------------------------
-- Table structure for tbl_supplier
-- ----------------------------
DROP TABLE IF EXISTS `tbl_supplier`;
CREATE TABLE `tbl_supplier`  (
  `supplier_id` int(11) NOT NULL AUTO_INCREMENT,
  `supplier_nama` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `supplier_alamat` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `supplier_telp` char(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NOT NULL DEFAULT current_timestamp(0) ON UPDATE CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NOT NULL,
  PRIMARY KEY (`supplier_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_supplier
-- ----------------------------
INSERT INTO `tbl_supplier` VALUES (1, 'TP. Surya GG', 'Jl. Semampir', '111222333444', '2019-08-13 12:44:21', '0000-00-00 00:00:00');
INSERT INTO `tbl_supplier` VALUES (2, 'PT. AGSatu', 'Jl. Jamsaren', '086787111666', '2019-08-13 13:02:24', '2019-08-13 13:02:24');

-- ----------------------------
-- Table structure for tbl_t_user
-- ----------------------------
DROP TABLE IF EXISTS `tbl_t_user`;
CREATE TABLE `tbl_t_user`  (
  `t_user_id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(11) NULL DEFAULT NULL,
  `menu_id` int(11) NULL DEFAULT NULL,
  `created_at` timestamp(0) NOT NULL DEFAULT current_timestamp(0) ON UPDATE CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NOT NULL,
  PRIMARY KEY (`t_user_id`) USING BTREE,
  INDEX `t_user__group_relation`(`group_id`) USING BTREE,
  INDEX `t_user__menu_relation`(`menu_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 140 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_t_user
-- ----------------------------
INSERT INTO `tbl_t_user` VALUES (1, 4, 8, '2019-08-13 08:48:15', '0000-00-00 00:00:00');
INSERT INTO `tbl_t_user` VALUES (2, 4, 9, '2019-08-13 08:48:15', '0000-00-00 00:00:00');
INSERT INTO `tbl_t_user` VALUES (112, 3, 15, '2019-08-13 12:39:40', '0000-00-00 00:00:00');
INSERT INTO `tbl_t_user` VALUES (113, 3, 19, '2019-08-13 12:39:40', '0000-00-00 00:00:00');
INSERT INTO `tbl_t_user` VALUES (126, 1, 8, '2019-08-15 09:01:07', '0000-00-00 00:00:00');
INSERT INTO `tbl_t_user` VALUES (127, 1, 21, '2019-08-15 09:01:08', '0000-00-00 00:00:00');
INSERT INTO `tbl_t_user` VALUES (128, 1, 20, '2019-08-15 09:01:08', '0000-00-00 00:00:00');
INSERT INTO `tbl_t_user` VALUES (129, 1, 15, '2019-08-15 09:01:08', '0000-00-00 00:00:00');
INSERT INTO `tbl_t_user` VALUES (130, 1, 11, '2019-08-15 09:01:08', '0000-00-00 00:00:00');
INSERT INTO `tbl_t_user` VALUES (131, 1, 18, '2019-08-15 09:01:08', '0000-00-00 00:00:00');
INSERT INTO `tbl_t_user` VALUES (132, 1, 9, '2019-08-15 09:01:08', '0000-00-00 00:00:00');
INSERT INTO `tbl_t_user` VALUES (133, 1, 10, '2019-08-15 09:01:08', '0000-00-00 00:00:00');
INSERT INTO `tbl_t_user` VALUES (134, 1, 12, '2019-08-15 09:01:08', '0000-00-00 00:00:00');
INSERT INTO `tbl_t_user` VALUES (135, 1, 14, '2019-08-15 09:01:08', '0000-00-00 00:00:00');
INSERT INTO `tbl_t_user` VALUES (136, 1, 13, '2019-08-15 09:01:08', '0000-00-00 00:00:00');
INSERT INTO `tbl_t_user` VALUES (137, 1, 16, '2019-08-15 09:01:08', '0000-00-00 00:00:00');
INSERT INTO `tbl_t_user` VALUES (138, 1, 19, '2019-08-15 09:01:08', '0000-00-00 00:00:00');
INSERT INTO `tbl_t_user` VALUES (139, 1, 22, '2019-08-15 09:01:08', '0000-00-00 00:00:00');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `group_id` int(11) NULL DEFAULT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `users_email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `users_email_unique`(`email`) USING BTREE,
  INDEX `group_relation`(`group_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (2, 1, 'harif', 'harif', '$2y$10$XO4hqeS1TU1R.y0BYmLAgOqd.L1OgtGMU9HQZDSt9yMlGYpOEykYG', 'harif@gmail.com', 'fA6IZdpBsIKkrEAlfxahAGtHWzXmfeefSUsAC9MIKN38jSq1rxIxHPFgvjKi', NULL, '2019-08-14 14:32:42');
INSERT INTO `users` VALUES (3, 3, 'setyo', 'setyo', '$2y$10$rz3K/oAH/4ZQYDezGv0RP.WQeTSqAjkNLkNIL7CZptujpPEz0EhIm', 'setyon@gmail.com', 'mBvRgHfwHWgqmzDgkRfheibGSGspTPtgW2iaYDmom6u3Mi78xAVikLjvMF8s', '2019-08-08 14:16:08', '2019-08-08 14:42:05');
INSERT INTO `users` VALUES (4, 1, 'admin', 'admin', '$2y$10$pu0nUMWtypLv5wDr0LLuceT8NPAbiEW0A4DrBCTReaLPyYWWKJ6T.', 'admin@admin.com', 'DoUUrUZ2irbAwMxuwl959wxbMCbVZ3QfxXIHSkyUmofqTh4m7pq9MTEHGEuw', '2019-08-27 15:14:01', '2019-08-27 15:14:01');

SET FOREIGN_KEY_CHECKS = 1;
