/*
Navicat MySQL Data Transfer

Source Server         : lumba2
Source Server Version : 50616
Source Host           : 127.0.0.1:3306
Source Database       : sister_siadu

Target Server Type    : MYSQL
Target Server Version : 50616
File Encoding         : 65001

Date: 2014-12-01 05:57:28
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for sar_barang
-- ----------------------------
DROP TABLE IF EXISTS `sar_barang`;
CREATE TABLE `sar_barang` (
  `replid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `lokasi` int(10) unsigned NOT NULL,
  `grup` int(10) unsigned NOT NULL,
  `tempat` int(10) NOT NULL,
  `katalog` int(10) unsigned NOT NULL,
  `kode` varchar(100) NOT NULL,
  `barkode` varchar(50) NOT NULL,
  `urut` int(10) unsigned NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1:ada 0:dipinjam',
  `sumber` tinyint(4) NOT NULL,
  `harga` decimal(10,0) NOT NULL,
  `kondisi` int(10) unsigned NOT NULL,
  `keterangan` varchar(250) NOT NULL,
  PRIMARY KEY (`replid`)
) ENGINE=MyISAM AUTO_INCREMENT=74 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of sar_barang
-- ----------------------------
INSERT INTO `sar_barang` VALUES ('1', '1', '1', '0', '3', '020.010.112.00101', '00101', '101', '1', '0', '80000', '3', 'Baik');
INSERT INTO `sar_barang` VALUES ('2', '1', '1', '0', '3', '020.010.112.00102', '00102', '102', '0', '0', '100000', '2', 'asd');
INSERT INTO `sar_barang` VALUES ('3', '1', '1', '0', '3', '020.010.112.00103', '00103', '103', '0', '0', '120000', '2', '');
INSERT INTO `sar_barang` VALUES ('5', '1', '1', '0', '1', '020.010.011.00104', '00105', '105', '1', '1', '250000', '2', '');
INSERT INTO `sar_barang` VALUES ('6', '1', '1', '0', '2', '020.010.123.00104', '00106', '106', '1', '0', '125000', '2', '');
INSERT INTO `sar_barang` VALUES ('7', '1', '3', '0', '5', '020.020.001.00107', '00107', '107', '1', '0', '200000000', '2', '');
INSERT INTO `sar_barang` VALUES ('8', '1', '3', '0', '6', '020.020.002.00108', '00108', '108', '1', '0', '16000000', '1', '');
INSERT INTO `sar_barang` VALUES ('9', '1', '1', '0', '3', '020.010.112.00109', '00109', '109', '1', '0', '120000', '2', '');
INSERT INTO `sar_barang` VALUES ('10', '1', '1', '0', '3', '020.010.112.00110', '00110', '110', '1', '0', '140000', '1', '');
INSERT INTO `sar_barang` VALUES ('11', '1', '1', '0', '3', '020.010.112.00111', '00111', '111', '0', '0', '140000', '1', '');
INSERT INTO `sar_barang` VALUES ('12', '1', '1', '0', '3', '020.010.112.00112', '00112', '112', '1', '0', '120000', '2', '');
INSERT INTO `sar_barang` VALUES ('16', '1', '1', '0', '1', '020.010.011.00113', '00113', '113', '1', '0', '100000', '1', '');
INSERT INTO `sar_barang` VALUES ('17', '1', '1', '0', '1', '020.010.011.00114', '00114', '114', '1', '0', '100000', '1', '');
INSERT INTO `sar_barang` VALUES ('18', '1', '1', '0', '2', '020.010.123.00115', '00115', '115', '1', '0', '125000', '1', '');
INSERT INTO `sar_barang` VALUES ('19', '1', '1', '0', '2', '020.010.123.00116', '00116', '116', '1', '0', '125000', '1', '');
INSERT INTO `sar_barang` VALUES ('20', '1', '1', '0', '1', '020.010.011.00117', '00117', '117', '1', '0', '120000', '1', '');
INSERT INTO `sar_barang` VALUES ('21', '1', '4', '0', '7', '020.030.010.00118', '00118', '118', '1', '0', '1000000', '3', '');
INSERT INTO `sar_barang` VALUES ('22', '1', '4', '0', '7', '020.030.010.00119', '00119', '119', '1', '0', '1000000', '1', '');
INSERT INTO `sar_barang` VALUES ('23', '1', '4', '0', '7', '020.030.010.00120', '00120', '120', '1', '0', '1000000', '1', '');
INSERT INTO `sar_barang` VALUES ('49', '1', '1', '0', '10', '020/LT3_SEC3B/LE/00141', '00141', '141', '1', '0', '0', '1', '');
INSERT INTO `sar_barang` VALUES ('50', '1', '1', '0', '10', '020/LT3_SEC3B/LE/00142', '00142', '142', '1', '0', '0', '1', '');
INSERT INTO `sar_barang` VALUES ('51', '1', '1', '0', '10', '020/LT3_SEC3B/LE/00143', '00143', '143', '1', '0', '0', '1', '');
INSERT INTO `sar_barang` VALUES ('52', '1', '1', '0', '10', '020/LT3_SEC3B/LE/00144', '00144', '144', '1', '0', '0', '1', '');
INSERT INTO `sar_barang` VALUES ('53', '1', '1', '0', '10', '020.LT3_SEC3B.LE.00145', '00145', '145', '1', '0', '0', '1', '');
INSERT INTO `sar_barang` VALUES ('54', '1', '1', '0', '10', '020.LT3_SEC3B.LE.00145', '00145', '145', '1', '0', '0', '1', '');
INSERT INTO `sar_barang` VALUES ('55', '1', '1', '0', '11', '020/LT3_SEC3B/LO/00146', '00146', '146', '1', '0', '0', '1', '');
INSERT INTO `sar_barang` VALUES ('56', '1', '1', '0', '11', '020/LT3_SEC3B/LO/00147', '00147', '147', '1', '0', '0', '1', '');
INSERT INTO `sar_barang` VALUES ('57', '1', '1', '0', '11', '020/LT3_SEC3B/LO/00148', '00148', '148', '1', '0', '0', '1', '');
INSERT INTO `sar_barang` VALUES ('58', '1', '1', '0', '11', '020/LT3_SEC3B/LO/00149', '00149', '149', '1', '0', '0', '1', '');
INSERT INTO `sar_barang` VALUES ('60', '1', '3', '0', '12', '020.020.002.00150', '00150', '150', '1', '0', '130000000', '1', '');
INSERT INTO `sar_barang` VALUES ('62', '1', '3', '0', '13', '020.020.003.00151', '00151', '151', '1', '0', '120000000', '1', '');
INSERT INTO `sar_barang` VALUES ('64', '1', '3', '0', '14', '020.020.004.00152', '00152', '152', '1', '0', '16000000', '2', 'pembelian tahun 2011');
INSERT INTO `sar_barang` VALUES ('65', '1', '3', '0', '15', '020.020.005.00153', '00153', '153', '1', '0', '17000000', '2', '');
INSERT INTO `sar_barang` VALUES ('67', '1', '6', '0', '9', '020/BSE_HRD/SKE/00154', '00154', '154', '1', '0', '0', '1', '');
INSERT INTO `sar_barang` VALUES ('68', '1', '6', '0', '9', '020/BSE_HRD/SKE/00155', '00155', '155', '1', '0', '0', '1', '');
INSERT INTO `sar_barang` VALUES ('71', '1', '6', '0', '9', '020/BSE_HRD/SKE/00156', '00156', '156', '1', '0', '0', '1', '');
INSERT INTO `sar_barang` VALUES ('72', '1', '6', '0', '9', '020/BSE_HRD/SKE/00157', '00157', '157', '1', '0', '0', '1', '');
