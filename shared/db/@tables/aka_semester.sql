# Host: localhost  (Version: 5.6.20)
# Date: 2015-01-29 04:51:26
# Generator: MySQL-Front 5.3  (Build 4.187)

/*!40101 SET NAMES utf8 */;

#
# Structure for table "aka_semester"
#

DROP TABLE IF EXISTS `aka_semester`;
CREATE TABLE `aka_semester` (
  `replid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL,
  `tahunajaran` int(10) unsigned NOT NULL,
  `aktif` enum('1','0') NOT NULL DEFAULT '1',
  `keterangan` varchar(255) DEFAULT NULL,
  `urut` int(11) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`replid`),
  KEY `FK_semester_departemen` (`tahunajaran`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

#
# Data for table "aka_semester"
#

INSERT INTO `aka_semester` VALUES (1,'Ganjil',1,'0','Juli-Desember',1),(2,'Genap',1,'1','Januari-Juni',2),(3,'Ganjil',2,'0','Juli-Desember',3),(4,'Genap',2,'1','Januari-Juni',4),(5,'Ganjil',3,'0','Juli-Desember',5),(6,'Genap',3,'1','Januari-Juni',6);
