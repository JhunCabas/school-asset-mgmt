/*
MySQL Data Transfer
Source Host: localhost
Source Database: sekolah
Target Host: localhost
Target Database: sekolah
Date: 29.02.2012 21:15:41
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for counter_barcode
-- ----------------------------
DROP TABLE IF EXISTS `counter_barcode`;
CREATE TABLE `counter_barcode` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `year` int(4) NOT NULL,
  `counter` int(4) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `index_year` (`year`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for hartamodal
-- ----------------------------
DROP TABLE IF EXISTS `hartamodal`;
CREATE TABLE `hartamodal` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `kaedah_peroleh` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `gambar` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `no_siri_daftar` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `kementerian` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `bahagian` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `kod_nasional` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `kategori_id` int(10) DEFAULT NULL,
  `sub_kategori_id` int(10) DEFAULT NULL,
  `jenis_id` int(10) DEFAULT NULL,
  `buatan` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `jenis_no_enjin` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `no_casis` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `no_pendaftaran` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `harga_perolehan_asal` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `tarikh_terima` date DEFAULT NULL,
  `no_pesanan` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `tempoh_jaminan` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `pembekal_id` int(10) DEFAULT NULL,
  `komponen` mediumtext CHARACTER SET latin1,
  `pengguna_id` int(10) DEFAULT NULL,
  `tarikh_daftar` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `kategori_id` (`kategori_id`),
  KEY `sub_kategori_id` (`sub_kategori_id`),
  KEY `pembekal_id` (`pembekal_id`),
  KEY `pengguna_id` (`pengguna_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Table structure for inventori
-- ----------------------------
DROP TABLE IF EXISTS `inventori`;
CREATE TABLE `inventori` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `kaedah_peroleh` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `gambar` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `no_siri_daftar` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `kementerian` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `bahagian` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `kod_nasional` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `kategori_id` int(10) DEFAULT NULL,
  `sub_kategori_id` int(10) DEFAULT NULL,
  `jenis_id` int(10) DEFAULT NULL,
  `kuantiti` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `unit_ukur` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `tempoh_jaminan` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `harga_perolehan_asal` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `tarikh_terima` date DEFAULT NULL,
  `no_pesanan` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `pembekal_id` int(10) DEFAULT NULL,
  `pengguna_id` int(10) DEFAULT NULL,
  `tarikh_daftar` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `kategori_id` (`kategori_id`),
  KEY `sub_kategori_id` (`sub_kategori_id`),
  KEY `pembekal_id` (`pembekal_id`),
  KEY `pengguna_id` (`pengguna_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Table structure for kategori
-- ----------------------------
DROP TABLE IF EXISTS `kategori`;
CREATE TABLE `kategori` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `kod` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `tarikh_daftar` datetime DEFAULT NULL,
  `parent_id` int(10) DEFAULT NULL,
  `level` int(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `parent_id` (`parent_id`)
) ENGINE=InnoDB AUTO_INCREMENT=74 DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='cuma ada 2 level sahaja';

-- ----------------------------
-- Table structure for pelupusan
-- ----------------------------
DROP TABLE IF EXISTS `pelupusan`;
CREATE TABLE `pelupusan` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `rujukan` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `tarikh` date DEFAULT NULL,
  `kaedah` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `nama_pelupus` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `kuantiti` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `lokasi` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `tarikh_daftar` datetime DEFAULT NULL,
  `pengguna_id` int(10) DEFAULT NULL,
  `harta_modal_id` int(10) DEFAULT NULL,
  `inventori_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pengguna_id` (`pengguna_id`),
  KEY `harta_modal_id` (`harta_modal_id`),
  KEY `inventori_id` (`inventori_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Table structure for pembekal
-- ----------------------------
DROP TABLE IF EXISTS `pembekal`;
CREATE TABLE `pembekal` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `no_daftar` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `no_daftar_kementerian` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `jenis` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `alamat` mediumtext CHARACTER SET latin1,
  `tel_no` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `fax_no` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `tarikh_daftar` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Table structure for pemeriksaan
-- ----------------------------
DROP TABLE IF EXISTS `pemeriksaan`;
CREATE TABLE `pemeriksaan` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `tarikh` date DEFAULT NULL,
  `status_aset` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `nama_pemeriksa` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `tarikh_daftar` datetime DEFAULT NULL,
  `pengguna_id` int(10) DEFAULT NULL,
  `harta_modal_id` int(10) DEFAULT NULL,
  `inventori_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pengguna_id` (`pengguna_id`),
  KEY `harta_modal_id` (`harta_modal_id`),
  KEY `inventori_id` (`inventori_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Table structure for penempatan
-- ----------------------------
DROP TABLE IF EXISTS `penempatan`;
CREATE TABLE `penempatan` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `lokasi` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `tarikh` date DEFAULT NULL,
  `nama_pegawai` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `kuantiti` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `no_siri_daftar` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `tarikh_daftar` datetime DEFAULT NULL,
  `harta_modal_id` int(10) DEFAULT NULL,
  `inventori_id` int(10) DEFAULT NULL,
  `pengguna_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `harta_modal_id` (`harta_modal_id`),
  KEY `inventori_id` (`inventori_id`),
  KEY `pengguna_id` (`pengguna_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Table structure for penerimaan
-- ----------------------------
DROP TABLE IF EXISTS `penerimaan`;
CREATE TABLE `penerimaan` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `no_terima` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `tarikh_terima` date DEFAULT NULL,
  `nama_aset` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `qty_pesan` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `qty_terima` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `qty_selisih` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `perihal_rosak` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `catatan` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `tarikh_daftar` datetime DEFAULT NULL,
  `pengguna_id` int(10) DEFAULT NULL,
  `pembekal_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pengguna_id` (`pengguna_id`),
  KEY `pembekal_id` (`pembekal_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Table structure for pengguna
-- ----------------------------
DROP TABLE IF EXISTS `pengguna`;
CREATE TABLE `pengguna` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `no_ic` varchar(255) CHARACTER SET latin1 NOT NULL DEFAULT 'NULL',
  `password` varchar(255) CHARACTER SET latin1 NOT NULL DEFAULT 'NULL',
  `nama` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `jawatan` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `no_staff` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `emel` varchar(255) CHARACTER SET latin1 NOT NULL DEFAULT 'NULL',
  `tarikh_daftar` datetime DEFAULT NULL,
  `peranan_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`,`no_ic`,`emel`),
  KEY `peranan_id` (`peranan_id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Table structure for peranan
-- ----------------------------
DROP TABLE IF EXISTS `peranan`;
CREATE TABLE `peranan` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records 
-- ----------------------------
INSERT INTO `counter_barcode` VALUES ('3', '2012', '25');
INSERT INTO `hartamodal` VALUES ('1', 'HD', null, 'KK/BKP10/H/12/0022/302103101/HD', 'KEMENTERIAN KEWANGAN', 'BAHAGIAN PENTADBIRAN', 'K0011', '60', '67', '69', 'TEMPATAN1', 'LAMPU NEON1', 'F558745411', 'TIADA1', '151', '2012-01-10', 'F5858581', 'SETAHUN1', '4', 'TIADA1', '16', '2012-01-14 22:50:18');
INSERT INTO `inventori` VALUES ('1', 'HD', null, 'KK/BKP10/I/12/0024/302103100/HD', 'KEMENTERIAN KEWANGAN', 'BAHAGIAN PENTADBIRAN', 'K05643', '60', '67', '71', '1', 'UNIT', 'SETAHUN 2 BULAN', '154', '2012-01-25', 'G4545', '4', '16', '2012-01-15 22:43:44');
INSERT INTO `inventori` VALUES ('2', 'SB', null, 'KK/BKP10/I/12/0025/302103101/SB', 'KEMENTERIAN KEWANGAN', 'BAHAGIAN PENTADBIRAN', 'K05643', '60', '67', '69', '12', 'UNIT', 'SETAHUN 2 BULAN', '154', '2012-01-03', 'R5454', '4', '16', '2012-01-15 22:45:10');
INSERT INTO `kategori` VALUES ('59', 'PERALATAN KELENGKAPAN PEJABAT DAN PERABOT', '301', '2012-01-13 23:19:35', null, '0');
INSERT INTO `kategori` VALUES ('60', 'PERALATAN KELENGKAPAN PEJABAT', '302', '2012-01-13 23:39:34', null, '0');
INSERT INTO `kategori` VALUES ('65', 'AIR FRESHENER', '101', '2012-01-13 23:49:28', '60', '1');
INSERT INTO `kategori` VALUES ('66', 'ALAT KELENGKAPAN KATIL', '102', '2012-01-13 23:49:36', '60', '1');
INSERT INTO `kategori` VALUES ('67', 'ALATAN ELEKTRIK', '103', '2012-01-13 23:49:45', '60', '1');
INSERT INTO `kategori` VALUES ('69', 'KIPAS ANGIN', '101', '2012-01-14 00:59:10', '67', '2');
INSERT INTO `kategori` VALUES ('71', 'LAMPU', '100', '2012-01-14 01:46:21', '67', '2');
INSERT INTO `kategori` VALUES ('72', 'KAIN BATIK', '99', '2012-01-31 11:35:18', null, '0');
INSERT INTO `kategori` VALUES ('73', 'MEJA SOLEK', '103', '2012-01-31 11:37:03', '66', '2');
INSERT INTO `pelupusan` VALUES ('2', 'RUJ/3/KP/02', '2012-01-18', 'TANAM', null, null, null, '2012-01-15 19:27:01', '16', '1', null);
INSERT INTO `pelupusan` VALUES ('4', 'RUJ/3/KP/01', '2012-01-17', 'TANAM', null, '43', 'BELAKANG DEWAN', '2012-01-16 21:26:51', '16', null, '2');
INSERT INTO `pembekal` VALUES ('2', 'Kasi Mudah Senang Enterprise', 'E5568970', 'F555', 'Perkhidmatan', 'Shah Alam, Selangor', '0365897413', '0365287412', '2012-01-08 12:06:33');
INSERT INTO `pembekal` VALUES ('4', 'Maju Bernas Sdn Bhd', 'A5456123', 'FD5455555', 'Perkhidmatan', 'Kuala lumpur', '0136548945', '0221565468', '2012-01-10 01:38:44');
INSERT INTO `pembekal` VALUES ('5', 'drasa Ent', 'G 3343434', 'D 2323434', 'Peralatan', 'ojnmdoxnmdwxmn2wdmnxlkw f sdf sdfsdf sf', '8999', '8888888', '2012-01-31 11:31:24');
INSERT INTO `pemeriksaan` VALUES ('3', '2012-01-17', 'BAIK', null, '2012-01-15 04:29:49', '16', '1', null);
INSERT INTO `pemeriksaan` VALUES ('5', '2012-01-24', 'MAKIN OK', null, '2012-01-16 21:38:26', '16', null, '2');
INSERT INTO `pemeriksaan` VALUES ('7', '2012-01-29', 'BAIK', null, '2012-01-16 21:57:26', '16', '1', null);
INSERT INTO `penempatan` VALUES ('2', 'SURAU', '2012-01-11', null, null, null, '2012-01-15 04:09:23', '1', null, '16');
INSERT INTO `penempatan` VALUES ('3', 'PEJABAT GURU', '2012-01-25', null, null, null, '2012-01-15 04:10:17', '1', null, '16');
INSERT INTO `penempatan` VALUES ('6', 'DEWAN', '2012-01-02', null, '11', null, '2012-01-16 21:55:29', null, '2', '16');
INSERT INTO `penerimaan` VALUES ('2', '125954', '2012-09-01', 'kerusi', '12', '10', '0', 'tiada', 'OK mantap', '2012-01-09 08:47:03', '16', '2');
INSERT INTO `penerimaan` VALUES ('3', '123', '2012-01-02', '12312312', '12', '12', '', 'ok', 'ok', '2012-01-10 02:04:45', '16', '2');
INSERT INTO `penerimaan` VALUES ('4', '123', '2012-01-10', '12312312', '1', '1', '', '', '', '2012-01-10 02:05:42', '16', '2');
INSERT INTO `penerimaan` VALUES ('5', 'g1546s', '2012-01-19', 'Meja dan kerusi', '100', '100', '0', 'tiada', 'terbaik', '2012-01-10 23:19:49', '16', '4');
INSERT INTO `pengguna` VALUES ('8', 'admin', '*4ACFE3202A5FF5CF467898FC58AAB1D615029441', 'Admin', 'Admin', '0000000000001', 'admin@admin.com', '2012-01-07 01:45:57', '1');
INSERT INTO `pengguna` VALUES ('9', '780606023261', '*6B994FFE3E5A4E77DFF4E85A8B092A23B53EAF45', 'jamaludin', 'Guru', 'A00213546', 'jamal@emel.com', '2012-01-07 10:35:38', '2');
INSERT INTO `pengguna` VALUES ('16', '111111111111', '*6BB4837EB74329105EE4568DDA7DC67ED2CA2AD9', 'AHMAD TAJUDDIN BIN SAAD', 'GURU', 'A00123', 'ahmad@bagus.com', '2012-01-09 08:30:43', '2');
INSERT INTO `pengguna` VALUES ('30', '123456789101', '*6BB4837EB74329105EE4568DDA7DC67ED2CA2AD9', 'MAHAINI', 'KERANI ASET', '78888', 'kerani@yah.com', '2012-01-31 11:25:00', '2');
INSERT INTO `peranan` VALUES ('1', 'admin');
INSERT INTO `peranan` VALUES ('2', 'pegawai');
