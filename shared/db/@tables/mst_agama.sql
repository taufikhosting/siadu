# Host: localhost  (Version: 5.6.20)
# Date: 2015-01-28 15:34:46
# Generator: MySQL-Front 5.3  (Build 4.187)

/*!40101 SET NAMES utf8 */;

#
# Structure for table "mst_agama"
#

DROP TABLE IF EXISTS `mst_agama`;
CREATE TABLE `mst_agama` (
  `replid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `agama` varchar(20) NOT NULL,
  `urutan` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`agama`),
  UNIQUE KEY `UX_agama` (`replid`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

#
# Data for table "mst_agama"
#

INSERT INTO `mst_agama` VALUES (1,'Budha',5),(2,'Hindu',4),(3,'Islam',1),(4,'Katolik',2),(5,'Protestan',3);
