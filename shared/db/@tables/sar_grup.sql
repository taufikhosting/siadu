/*
Navicat MySQL Data Transfer

Source Server         : lumba2
Source Server Version : 50616
Source Host           : 127.0.0.1:3306
Source Database       : sister_siadu

Target Server Type    : MYSQL
Target Server Version : 50616
File Encoding         : 65001

Date: 2014-11-14 23:09:42
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for sar_grup
-- ----------------------------
DROP TABLE IF EXISTS `sar_grup`;
CREATE TABLE `sar_grup` (
  `replid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `kode` varchar(100) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `lokasi` int(10) unsigned NOT NULL,
  `keterangan` varchar(250) NOT NULL,
  `ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`replid`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of sar_grup
-- ----------------------------
INSERT INTO `sar_grup` VALUES ('1', '010', 'Furniture', '1', 'Perabotan, meja, kursi, dll', '2013-09-01 09:30:25');
INSERT INTO `sar_grup` VALUES ('2', '020', 'Elektronik', '2', '', '2013-09-02 09:48:49');
INSERT INTO `sar_grup` VALUES ('3', '020', 'Kendaraan', '1', '', '2013-09-04 19:29:15');
INSERT INTO `sar_grup` VALUES ('4', '030', 'Elektronik', '1', '', '2013-10-22 10:19:34');
