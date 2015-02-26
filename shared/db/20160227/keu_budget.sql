/*
Navicat MySQL Data Transfer

Source Server         : lumba2
Source Server Version : 50616
Source Host           : 127.0.0.1:3306
Source Database       : sister_siadu

Target Server Type    : MYSQL
Target Server Version : 50616
File Encoding         : 65001

Date: 2015-02-27 02:03:22
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for keu_budget
-- ----------------------------
DROP TABLE IF EXISTS `keu_budget`;
CREATE TABLE `keu_budget` (
  `replid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tahunbuku` int(10) unsigned NOT NULL,
  `nama` varchar(100) NOT NULL,
  `nominal` decimal(10,0) NOT NULL DEFAULT '0',
  `keterangan` varchar(200) NOT NULL,
  `departemen` int(11) NOT NULL,
  PRIMARY KEY (`replid`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of keu_budget
-- ----------------------------
INSERT INTO `keu_budget` VALUES ('2', '1', 'dana lingkungan sekolah', '3000000', 'untuk perawatan lingkungan sekolah', '1');
INSERT INTO `keu_budget` VALUES ('1', '1', 'dana buku ', '3000000', 'untuk pengadaan buku', '1');
