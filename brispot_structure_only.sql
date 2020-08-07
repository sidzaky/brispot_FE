/*
 Navicat Premium Data Transfer

 Source Server         : banana local
 Source Server Type    : MariaDB
 Source Server Version : 100126
 Source Host           : localhost:3306
 Source Schema         : brispot

 Target Server Type    : MariaDB
 Target Server Version : 100126
 File Encoding         : 65001

 Date: 06/08/2020 22:46:56
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for branch
-- ----------------------------
DROP TABLE IF EXISTS `branch`;
CREATE TABLE `branch`  (
  `SRCSYS_ID` varchar(255) CHARACTER SET armscii8 COLLATE armscii8_general_ci NULL DEFAULT NULL,
  `BRUNIT` varchar(255) CHARACTER SET armscii8 COLLATE armscii8_general_ci NULL DEFAULT NULL,
  `REGION` varchar(255) CHARACTER SET armscii8 COLLATE armscii8_general_ci NULL DEFAULT NULL,
  `RGDESC` varchar(255) CHARACTER SET armscii8 COLLATE armscii8_general_ci NULL DEFAULT NULL,
  `RGNAME` varchar(255) CHARACTER SET armscii8 COLLATE armscii8_general_ci NULL DEFAULT NULL,
  `MAINBR` varchar(255) CHARACTER SET armscii8 COLLATE armscii8_general_ci NULL DEFAULT NULL,
  `MBDESC` varchar(255) CHARACTER SET armscii8 COLLATE armscii8_general_ci NULL DEFAULT NULL,
  `MBNAME` varchar(255) CHARACTER SET armscii8 COLLATE armscii8_general_ci NULL DEFAULT NULL,
  `SUBBR` varchar(255) CHARACTER SET armscii8 COLLATE armscii8_general_ci NULL DEFAULT NULL,
  `SBDESC` varchar(255) CHARACTER SET armscii8 COLLATE armscii8_general_ci NULL DEFAULT NULL,
  `SBNAME` varchar(255) CHARACTER SET armscii8 COLLATE armscii8_general_ci NULL DEFAULT NULL,
  `BRANCH` varchar(255) CHARACTER SET armscii8 COLLATE armscii8_general_ci NULL DEFAULT NULL,
  `BRDESC` varchar(255) CHARACTER SET armscii8 COLLATE armscii8_general_ci NULL DEFAULT NULL,
  `BRNAME` varchar(255) CHARACTER SET armscii8 COLLATE armscii8_general_ci NULL DEFAULT NULL,
  `BIBR` varchar(255) CHARACTER SET armscii8 COLLATE armscii8_general_ci NULL DEFAULT NULL
) ENGINE = InnoDB CHARACTER SET = armscii8 COLLATE = armscii8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for cluster
-- ----------------------------
DROP TABLE IF EXISTS `cluster`;
CREATE TABLE `cluster`  (
  `id` varchar(100) CHARACTER SET armscii8 COLLATE armscii8_general_ci NOT NULL,
  `timestamp` int(100) NULL DEFAULT NULL,
  `kanwil` varchar(255) CHARACTER SET armscii8 COLLATE armscii8_general_ci NULL DEFAULT NULL,
  `kode_kanwil` varchar(255) CHARACTER SET armscii8 COLLATE armscii8_general_ci NULL DEFAULT NULL,
  `kanca` varchar(255) CHARACTER SET armscii8 COLLATE armscii8_general_ci NULL DEFAULT NULL,
  `kode_kanca` varchar(255) CHARACTER SET armscii8 COLLATE armscii8_general_ci NULL DEFAULT NULL,
  `uker` varchar(255) CHARACTER SET armscii8 COLLATE armscii8_general_ci NULL DEFAULT NULL,
  `kode_uker` varchar(255) CHARACTER SET armscii8 COLLATE armscii8_general_ci NULL DEFAULT NULL,
  `kaunit_nama` varchar(255) CHARACTER SET armscii8 COLLATE armscii8_general_ci NULL DEFAULT NULL,
  `kaunit_pn` varchar(255) CHARACTER SET armscii8 COLLATE armscii8_general_ci NULL DEFAULT NULL,
  `kaunit_handphone` varchar(255) CHARACTER SET armscii8 COLLATE armscii8_general_ci NULL DEFAULT NULL,
  `nama_pekerja` varchar(255) CHARACTER SET armscii8 COLLATE armscii8_general_ci NULL DEFAULT NULL,
  `personal_number` varchar(100) CHARACTER SET armscii8 COLLATE armscii8_general_ci NULL DEFAULT NULL,
  `handphone_pekerja` varchar(255) CHARACTER SET armscii8 COLLATE armscii8_general_ci NULL DEFAULT NULL,
  `kelompok_usaha` text CHARACTER SET armscii8 COLLATE armscii8_general_ci NULL,
  `id_cluster_sektor_usaha` varchar(255) CHARACTER SET armscii8 COLLATE armscii8_general_ci NULL DEFAULT NULL,
  `id_cluster_jenis_usaha_map` varchar(255) CHARACTER SET armscii8 COLLATE armscii8_general_ci NULL DEFAULT NULL,
  `id_cluster_jenis_usaha` text CHARACTER SET armscii8 COLLATE armscii8_general_ci NULL,
  `hasil_produk` varchar(255) CHARACTER SET armscii8 COLLATE armscii8_general_ci NULL DEFAULT NULL,
  `pasar_ekspor` varchar(255) CHARACTER SET armscii8 COLLATE armscii8_general_ci NULL DEFAULT NULL,
  `pasar_ekspor_tahun` varchar(255) CHARACTER SET armscii8 COLLATE armscii8_general_ci NULL DEFAULT NULL,
  `pasar_ekspor_nilai` int(255) NULL DEFAULT NULL,
  `kelompok_anggota_pinjaman` text CHARACTER SET armscii8 COLLATE armscii8_general_ci NULL,
  `kelompok_pihak_pembeli` text CHARACTER SET armscii8 COLLATE armscii8_general_ci NULL,
  `kelompok_pihak_pembeli_handphone` varchar(255) CHARACTER SET armscii8 COLLATE armscii8_general_ci NULL DEFAULT NULL,
  `kelompok_suplier_produk` text CHARACTER SET armscii8 COLLATE armscii8_general_ci NULL,
  `kelompok_suplier_handphone` varchar(255) CHARACTER SET armscii8 COLLATE armscii8_general_ci NULL DEFAULT NULL,
  `kelompok_luas_usaha` int(10) NULL DEFAULT NULL,
  `kelompok_omset` int(100) NULL DEFAULT NULL,
  `kelompok_jumlah_anggota` varchar(255) CHARACTER SET armscii8 COLLATE armscii8_general_ci NULL DEFAULT NULL,
  `kelompok_perwakilan` varchar(255) CHARACTER SET armscii8 COLLATE armscii8_general_ci NULL DEFAULT NULL,
  `kelompok_jenis_kelamin` varchar(10) CHARACTER SET armscii8 COLLATE armscii8_general_ci NULL DEFAULT NULL,
  `kelompok_cerita_usaha` text CHARACTER SET armscii8 COLLATE armscii8_general_ci NULL,
  `lokasi_usaha` text CHARACTER SET armscii8 COLLATE armscii8_general_ci NULL,
  `kode_pos` int(100) NULL DEFAULT NULL,
  `provinsi` varchar(255) CHARACTER SET armscii8 COLLATE armscii8_general_ci NULL DEFAULT NULL,
  `kabupaten` varchar(255) CHARACTER SET armscii8 COLLATE armscii8_general_ci NULL DEFAULT NULL,
  `kecamatan` varchar(255) CHARACTER SET armscii8 COLLATE armscii8_general_ci NULL DEFAULT NULL,
  `kelurahan` varchar(255) CHARACTER SET armscii8 COLLATE armscii8_general_ci NULL DEFAULT NULL,
  `kelompok_NIK` varchar(255) CHARACTER SET armscii8 COLLATE armscii8_general_ci NULL DEFAULT NULL,
  `kelompok_perwakilan_tgl_lahir` varchar(255) CHARACTER SET armscii8 COLLATE armscii8_general_ci NULL DEFAULT NULL,
  `kelompok_perwakilan_tempat_lahir` text CHARACTER SET armscii8 COLLATE armscii8_general_ci NULL,
  `kelompok_perwakilan_jabatan` varchar(255) CHARACTER SET armscii8 COLLATE armscii8_general_ci NULL DEFAULT NULL,
  `kelompok_handphone` varchar(255) CHARACTER SET armscii8 COLLATE armscii8_general_ci NULL DEFAULT NULL,
  `pinjaman` varchar(255) CHARACTER SET armscii8 COLLATE armscii8_general_ci NULL DEFAULT NULL,
  `norek_pinjaman_bri` varchar(255) CHARACTER SET armscii8 COLLATE armscii8_general_ci NULL DEFAULT NULL,
  `nominal_pinjaman` int(100) NULL DEFAULT NULL,
  `kebutuhan_sarana_milik` text CHARACTER SET armscii8 COLLATE armscii8_general_ci NULL,
  `kebutuhan_sarana` text CHARACTER SET armscii8 COLLATE armscii8_general_ci NULL,
  `kebutuhan_sarana_lainnya` text CHARACTER SET armscii8 COLLATE armscii8_general_ci NULL,
  `kebutuhan_pendidikan` text CHARACTER SET armscii8 COLLATE armscii8_general_ci NULL,
  `kebutuhan_skema_kredit` varchar(255) CHARACTER SET armscii8 COLLATE armscii8_general_ci NULL DEFAULT NULL,
  `agen_brilink` varchar(100) CHARACTER SET armscii8 COLLATE armscii8_general_ci NULL DEFAULT NULL,
  `simpanan_bank` varchar(255) CHARACTER SET armscii8 COLLATE armscii8_general_ci NULL DEFAULT NULL,
  `jenis_usaha_old` varchar(255) CHARACTER SET armscii8 COLLATE armscii8_general_ci NULL DEFAULT NULL,
  `userlatestupdate` varchar(20) CHARACTER SET armscii8 COLLATE armscii8_general_ci NULL DEFAULT NULL,
  `checker_status` int(10) NULL DEFAULT NULL,
  `checker_user_update` varchar(255) CHARACTER SET armscii8 COLLATE armscii8_general_ci NULL DEFAULT NULL,
  `signer_status` int(10) NULL DEFAULT NULL,
  `signer_user_update` varchar(255) CHARACTER SET armscii8 COLLATE armscii8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `id`(`id`, `kode_uker`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = armscii8 COLLATE = armscii8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for cluster_anggota
-- ----------------------------
DROP TABLE IF EXISTS `cluster_anggota`;
CREATE TABLE `cluster_anggota`  (
  `id_ca` int(255) NOT NULL AUTO_INCREMENT,
  `id_cluster` varchar(255) CHARACTER SET armscii8 COLLATE armscii8_general_ci NULL DEFAULT NULL,
  `ca_nama` varchar(255) CHARACTER SET armscii8 COLLATE armscii8_general_ci NULL DEFAULT NULL,
  `ca_nik` varchar(255) CHARACTER SET armscii8 COLLATE armscii8_general_ci NULL DEFAULT NULL,
  `ca_jk` varchar(255) CHARACTER SET armscii8 COLLATE armscii8_general_ci NULL DEFAULT NULL,
  `ca_kodepos` varchar(255) CHARACTER SET armscii8 COLLATE armscii8_general_ci NULL DEFAULT NULL,
  `ca_handphone` varchar(255) CHARACTER SET armscii8 COLLATE armscii8_general_ci NULL DEFAULT NULL,
  `ca_alamat` varchar(255) CHARACTER SET armscii8 COLLATE armscii8_general_ci NULL DEFAULT NULL,
  `ca_tanggal_lahir` varchar(255) CHARACTER SET armscii8 COLLATE armscii8_general_ci NULL DEFAULT NULL,
  `ca_pinjaman` varchar(255) CHARACTER SET armscii8 COLLATE armscii8_general_ci NULL DEFAULT NULL,
  `ca_simpanan` varchar(255) CHARACTER SET armscii8 COLLATE armscii8_general_ci NULL DEFAULT NULL,
  `timeinput` varchar(100) CHARACTER SET armscii8 COLLATE armscii8_general_ci NULL DEFAULT NULL,
  `userlastupdate` varchar(100) CHARACTER SET armscii8 COLLATE armscii8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_ca`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 19662 CHARACTER SET = armscii8 COLLATE = armscii8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for cluster_doc_ekspor
-- ----------------------------
DROP TABLE IF EXISTS `cluster_doc_ekspor`;
CREATE TABLE `cluster_doc_ekspor`  (
  `id_doc_ekspor` varchar(255) CHARACTER SET armscii8 COLLATE armscii8_general_ci NULL DEFAULT NULL,
  `id_cluster` varchar(255) CHARACTER SET armscii8 COLLATE armscii8_general_ci NULL DEFAULT NULL,
  `timestampt` int(100) NULL DEFAULT NULL,
  `location` tinytext CHARACTER SET armscii8 COLLATE armscii8_general_ci NULL
) ENGINE = InnoDB CHARACTER SET = armscii8 COLLATE = armscii8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for cluster_foto_usaha
-- ----------------------------
DROP TABLE IF EXISTS `cluster_foto_usaha`;
CREATE TABLE `cluster_foto_usaha`  (
  `id_foto_usaha` varchar(255) CHARACTER SET armscii8 COLLATE armscii8_general_ci NULL DEFAULT NULL,
  `id_cluster` varchar(255) CHARACTER SET armscii8 COLLATE armscii8_general_ci NULL DEFAULT NULL,
  `timestampt` int(100) NULL DEFAULT NULL,
  `location` tinytext CHARACTER SET armscii8 COLLATE armscii8_general_ci NULL
) ENGINE = InnoDB CHARACTER SET = armscii8 COLLATE = armscii8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for cluster_jenis_usaha
-- ----------------------------
DROP TABLE IF EXISTS `cluster_jenis_usaha`;
CREATE TABLE `cluster_jenis_usaha`  (
  `id_cluster_jenis_usaha` varchar(255) CHARACTER SET armscii8 COLLATE armscii8_general_ci NULL DEFAULT NULL,
  `id_cluster_jenis_usaha_map` varchar(255) CHARACTER SET armscii8 COLLATE armscii8_general_ci NULL DEFAULT NULL,
  `nama_cluster_jenis_usaha` tinytext CHARACTER SET armscii8 COLLATE armscii8_general_ci NULL,
  `status` int(255) NULL DEFAULT NULL
) ENGINE = InnoDB CHARACTER SET = armscii8 COLLATE = armscii8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for cluster_jenis_usaha_map
-- ----------------------------
DROP TABLE IF EXISTS `cluster_jenis_usaha_map`;
CREATE TABLE `cluster_jenis_usaha_map`  (
  `id_cluster_jenis_usaha_map` varchar(255) CHARACTER SET armscii8 COLLATE armscii8_general_ci NULL DEFAULT NULL,
  `id_cluster_sektor_usaha` varchar(255) CHARACTER SET armscii8 COLLATE armscii8_general_ci NULL DEFAULT NULL,
  `nama_cluster_jenis_usaha_map` tinytext CHARACTER SET armscii8 COLLATE armscii8_general_ci NULL,
  `status` int(255) NULL DEFAULT NULL
) ENGINE = InnoDB CHARACTER SET = armscii8 COLLATE = armscii8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for cluster_sektor_usaha
-- ----------------------------
DROP TABLE IF EXISTS `cluster_sektor_usaha`;
CREATE TABLE `cluster_sektor_usaha`  (
  `id_cluster_sektor_usaha` varchar(255) CHARACTER SET armscii8 COLLATE armscii8_general_ci NULL DEFAULT NULL,
  `keterangan_cluster_sektor_usaha` tinytext CHARACTER SET armscii8 COLLATE armscii8_general_ci NULL,
  `status` int(255) NULL DEFAULT NULL
) ENGINE = InnoDB CHARACTER SET = armscii8 COLLATE = armscii8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for cluster_story
-- ----------------------------
DROP TABLE IF EXISTS `cluster_story`;
CREATE TABLE `cluster_story`  (
  `id_story_cluster` varchar(255) CHARACTER SET armscii8 COLLATE armscii8_general_ci NULL DEFAULT NULL,
  `id_cluster` varchar(255) CHARACTER SET armscii8 COLLATE armscii8_general_ci NULL DEFAULT NULL,
  `timestampt` int(100) NULL DEFAULT NULL,
  `location` text CHARACTER SET armscii8 COLLATE armscii8_general_ci NULL
) ENGINE = InnoDB CHARACTER SET = armscii8 COLLATE = armscii8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for kabupaten_kota
-- ----------------------------
DROP TABLE IF EXISTS `kabupaten_kota`;
CREATE TABLE `kabupaten_kota`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `provinsi_id` int(10) UNSIGNED NOT NULL,
  `nama` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `created_by` int(10) UNSIGNED NULL DEFAULT NULL,
  `updated_by` int(10) UNSIGNED NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `kabupaten_kota_provinsi_id_foreign`(`provinsi_id`) USING BTREE,
  CONSTRAINT `kabupaten_kota_provinsi_id_foreign` FOREIGN KEY (`provinsi_id`) REFERENCES `provinsi` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 515 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for kecamatan
-- ----------------------------
DROP TABLE IF EXISTS `kecamatan`;
CREATE TABLE `kecamatan`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `kabupaten_kota_id` int(10) UNSIGNED NOT NULL,
  `nama` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `created_by` int(10) UNSIGNED NULL DEFAULT NULL,
  `updated_by` int(10) UNSIGNED NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `kecamatan_kabupaten_kota_id_foreign`(`kabupaten_kota_id`) USING BTREE,
  CONSTRAINT `kecamatan_kabupaten_kota_id_foreign` FOREIGN KEY (`kabupaten_kota_id`) REFERENCES `kabupaten_kota` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 7098 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for kelurahan
-- ----------------------------
DROP TABLE IF EXISTS `kelurahan`;
CREATE TABLE `kelurahan`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `kecamatan_id` int(10) UNSIGNED NOT NULL,
  `nama` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `kode_pos` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `created_by` int(10) UNSIGNED NULL DEFAULT NULL,
  `updated_by` int(10) UNSIGNED NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `kelurahan_kecamatan_id_foreign`(`kecamatan_id`) USING BTREE,
  CONSTRAINT `kelurahan_kecamatan_id_foreign` FOREIGN KEY (`kecamatan_id`) REFERENCES `kecamatan` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 82504 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for provinsi
-- ----------------------------
DROP TABLE IF EXISTS `provinsi`;
CREATE TABLE `provinsi`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `created_by` int(10) UNSIGNED NULL DEFAULT NULL,
  `updated_by` int(10) UNSIGNED NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 35 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for tbl_kodepos
-- ----------------------------
DROP TABLE IF EXISTS `tbl_kodepos`;
CREATE TABLE `tbl_kodepos`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kelurahan` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `kecamatan` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `kabupaten` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `provinsi` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `kodepos` varchar(5) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `ixkodepos`(`kodepos`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 81249 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET armscii8 COLLATE armscii8_general_ci NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET armscii8 COLLATE armscii8_general_ci NULL DEFAULT NULL,
  `uppwd` int(2) NULL DEFAULT NULL,
  `permission` int(2) NULL DEFAULT NULL,
  `notif` int(1) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7284 CHARACTER SET = armscii8 COLLATE = armscii8_general_ci ROW_FORMAT = Compact;

SET FOREIGN_KEY_CHECKS = 1;
