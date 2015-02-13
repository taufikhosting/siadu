# Host: localhost  (Version: 5.6.20)
# Date: 2015-01-28 15:34:57
# Generator: MySQL-Front 5.3  (Build 4.187)

/*!40101 SET NAMES utf8 */;

#
# Structure for table "mst_suku"
#

DROP TABLE IF EXISTS `mst_suku`;
CREATE TABLE `mst_suku` (
  `replid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `suku` varchar(20) NOT NULL,
  `urutan` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`suku`),
  UNIQUE KEY `UX_suku` (`replid`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

#
# Data for table "mst_suku"
#

INSERT INTO `mst_suku` VALUES (1,'Jawa',0),(2,'Padang',0),(3,'Sunda',0);
