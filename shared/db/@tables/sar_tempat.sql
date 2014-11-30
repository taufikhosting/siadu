/*
Navicat MySQL Data Transfer

Source Server         : lumba2
Source Server Version : 50616
Source Host           : 127.0.0.1:3306
Source Database       : sister_siadu

Target Server Type    : MYSQL
Target Server Version : 50616
File Encoding         : 65001

Date: 2014-12-01 05:56:53
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for sar_tempat
-- ----------------------------
DROP TABLE IF EXISTS `sar_tempat`;
CREATE TABLE `sar_tempat` (
  `replid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `kode` varchar(10) NOT NULL,
  `lokasi` int(10) unsigned NOT NULL,
  `nama` varchar(100) NOT NULL,
  `keterangan` varchar(250) NOT NULL,
  PRIMARY KEY (`replid`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of sar_tempat
-- ----------------------------
INSERT INTO `sar_tempat` VALUES ('1', '', '2', 'Ruang Guru', '');
INSERT INTO `sar_tempat` VALUES ('2', '', '1', 'Ruang IT lt 2', '');
