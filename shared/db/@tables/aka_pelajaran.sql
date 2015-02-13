# Host: localhost  (Version: 5.6.20)
# Date: 2015-01-29 04:51:00
# Generator: MySQL-Front 5.3  (Build 4.187)

/*!40101 SET NAMES utf8 */;

#
# Structure for table "aka_pelajaran"
#

DROP TABLE IF EXISTS `aka_pelajaran`;
CREATE TABLE `aka_pelajaran` (
  `replid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tahunajaran` int(10) unsigned NOT NULL,
  `kode` varchar(20) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `skm` float NOT NULL DEFAULT '0',
  `keterangan` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`replid`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

#
# Data for table "aka_pelajaran"
#

INSERT INTO `aka_pelajaran` VALUES (1,1,'FIS','Fisika',70,''),(2,1,'MAT','Matematika',70,''),(3,1,'BIO','Biologi',70,''),(4,1,'EKO','Ekonomi',65,''),(5,1,'AGA','Agama',70,''),(6,1,'KIM','Kimia',70,''),(7,1,'ENG','English',70,''),(8,2,'AGA','Agama',70,''),(9,2,'ENG','English',70,''),(10,3,'ING','Inggris',0,'');
