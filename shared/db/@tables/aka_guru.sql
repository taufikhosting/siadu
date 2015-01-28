# Host: localhost  (Version: 5.6.20)
# Date: 2015-01-28 15:00:57
# Generator: MySQL-Front 5.3  (Build 4.187)

/*!40101 SET NAMES utf8 */;

#
# Structure for table "aka_guru"
#

DROP TABLE IF EXISTS `aka_guru`;
CREATE TABLE `aka_guru` (
  `replid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tahunajaran` int(10) unsigned NOT NULL DEFAULT '0',
  `kode` varchar(3) NOT NULL,
  `pegawai` int(10) unsigned NOT NULL DEFAULT '0',
  `pelajaran` int(10) unsigned NOT NULL DEFAULT '0',
  `aktif` enum('1','0') NOT NULL DEFAULT '1',
  `keterangan` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`replid`),
  KEY `FK_guru_pegawai` (`pegawai`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

#
# Data for table "aka_guru"
#

INSERT INTO `aka_guru` VALUES (1,1,'',55,3,'1',''),(2,1,'',145,4,'1',''),(3,1,'',54,1,'1',''),(4,1,'',78,2,'1',''),(5,1,'',18,7,'1',''),(12,2,'',133,9,'1','benny - en'),(13,3,'',158,10,'1','dan - eng'),(14,1,'',124,6,'1',''),(15,3,'',152,10,'1','INGG - ALBERT - 107.');
