/*
Navicat MySQL Data Transfer

Source Server         : lumba2
Source Server Version : 50616
Source Host           : 127.0.0.1:3306
Source Database       : josh

Target Server Type    : MYSQL
Target Server Version : 50616
File Encoding         : 65001

Date: 2014-11-14 23:09:22
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
) ENGINE=MyISAM AUTO_INCREMENT=62 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of sar_barang
-- ----------------------------
INSERT INTO `sar_barang` VALUES ('1', '1', '1', '3', '020.010.112.00101', '00101', '101', '1', '0', '80000', '3', 'Baik');
INSERT INTO `sar_barang` VALUES ('2', '1', '1', '3', '020.010.112.00102', '00102', '102', '0', '0', '100000', '2', 'asd');
INSERT INTO `sar_barang` VALUES ('3', '1', '1', '3', '020.010.112.00103', '00103', '103', '0', '0', '120000', '2', '');
INSERT INTO `sar_barang` VALUES ('5', '1', '1', '1', '020.010.011.00104', '00105', '105', '1', '1', '250000', '2', '');
INSERT INTO `sar_barang` VALUES ('6', '1', '1', '2', '020.010.123.00104', '00106', '106', '1', '0', '125000', '2', '');
INSERT INTO `sar_barang` VALUES ('7', '1', '3', '5', '020.020.001.00107', '00107', '107', '1', '0', '200000000', '2', '');
INSERT INTO `sar_barang` VALUES ('8', '1', '3', '6', '020.020.002.00108', '00108', '108', '1', '0', '16000000', '1', '');
INSERT INTO `sar_barang` VALUES ('9', '1', '1', '3', '020.010.112.00109', '00109', '109', '1', '0', '120000', '2', '');
INSERT INTO `sar_barang` VALUES ('10', '1', '1', '3', '020.010.112.00110', '00110', '110', '1', '0', '140000', '1', '');
INSERT INTO `sar_barang` VALUES ('11', '1', '1', '3', '020.010.112.00111', '00111', '111', '0', '0', '140000', '1', '');
INSERT INTO `sar_barang` VALUES ('12', '1', '1', '3', '020.010.112.00112', '00112', '112', '1', '0', '120000', '2', '');
INSERT INTO `sar_barang` VALUES ('16', '1', '1', '1', '020.010.011.00113', '00113', '113', '1', '0', '100000', '1', '');
INSERT INTO `sar_barang` VALUES ('17', '1', '1', '1', '020.010.011.00114', '00114', '114', '1', '0', '100000', '1', '');
INSERT INTO `sar_barang` VALUES ('18', '1', '1', '2', '020.010.123.00115', '00115', '115', '1', '0', '125000', '1', '');
INSERT INTO `sar_barang` VALUES ('19', '1', '1', '2', '020.010.123.00116', '00116', '116', '1', '0', '125000', '1', '');
INSERT INTO `sar_barang` VALUES ('20', '1', '1', '1', '020.010.011.00117', '00117', '117', '1', '0', '120000', '1', '');
INSERT INTO `sar_barang` VALUES ('21', '1', '4', '7', '020.030.010.00118', '00118', '118', '1', '0', '1000000', '3', '');
INSERT INTO `sar_barang` VALUES ('22', '1', '4', '7', '020.030.010.00119', '00119', '119', '1', '0', '1000000', '1', '');
INSERT INTO `sar_barang` VALUES ('23', '1', '4', '7', '020.030.010.00120', '00120', '120', '1', '0', '1000000', '1', '');
INSERT INTO `sar_barang` VALUES ('24', '1', '1', '1', '020/010/011/00121', '00121', '121', '1', '0', '20000', '1', '');
INSERT INTO `sar_barang` VALUES ('25', '1', '1', '1', '010/011/00122', '00122', '122', '1', '0', '10000', '1', '');
INSERT INTO `sar_barang` VALUES ('27', '1', '1', '1', '010/011/00123', '00123', '123', '1', '0', '5000', '1', '');
INSERT INTO `sar_barang` VALUES ('28', '1', '1', '1', '010/011/00124', '00124', '124', '1', '0', '5000', '1', '');
INSERT INTO `sar_barang` VALUES ('29', '1', '1', '1', '010/011/00125', '00125', '125', '1', '0', '0', '1', '');
INSERT INTO `sar_barang` VALUES ('30', '1', '1', '1', '010/011/00126', '00126', '126', '1', '0', '0', '1', '');
INSERT INTO `sar_barang` VALUES ('31', '1', '1', '1', '020.010.011.00127', '00127', '127', '1', '0', '99999', '1', 'okok');
INSERT INTO `sar_barang` VALUES ('32', '1', '1', '1', '020/010/011/00128', '00128', '128', '1', '1', '8000', '2', 'ok');
INSERT INTO `sar_barang` VALUES ('33', '1', '1', '1', '020/010/011/00129', '00129', '129', '1', '1', '8000', '2', 'ok');
INSERT INTO `sar_barang` VALUES ('34', '1', '1', '1', '020/010/011/00130', '00130', '130', '1', '2', '5555', '3', 'hus');
INSERT INTO `sar_barang` VALUES ('35', '1', '1', '1', '020/010/011/00131', '00131', '131', '1', '2', '5555', '4', 'hus');
INSERT INTO `sar_barang` VALUES ('53', '1', '1', '1', '020.010.011.00141', '00141', '141', '1', '0', '0', '1', '');
INSERT INTO `sar_barang` VALUES ('52', '1', '1', '1', '020.010.011.00140', '00140', '140', '1', '0', '0', '1', '');
INSERT INTO `sar_barang` VALUES ('43', '1', '1', '1', '020/010/011/00138', '00138', '138', '1', '0', '0', '1', '');
INSERT INTO `sar_barang` VALUES ('56', '1', '1', '1', '020/010/011/00143', '00143', '143', '1', '0', '0', '1', '');
INSERT INTO `sar_barang` VALUES ('59', '1', '1', '1', '020/010/011/00144', '00144', '144', '1', '0', '0', '1', '');
INSERT INTO `sar_barang` VALUES ('60', '1', '1', '1', '020/010/011/00145', '00145', '145', '1', '0', '0', '1', '');
INSERT INTO `sar_barang` VALUES ('61', '1', '1', '1', '020/010/011/00146', '00146', '146', '1', '0', '0', '1', '');
