# Host: localhost  (Version: 5.6.20)
# Date: 2015-01-29 04:54:45
# Generator: MySQL-Front 5.3  (Build 4.187)

/*!40101 SET NAMES utf8 */;

#
# Structure for table "aka_tahunajaran"
#

DROP TABLE IF EXISTS `aka_tahunajaran`;
CREATE TABLE `aka_tahunajaran` (
  `replid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tahunajaran` varchar(50) NOT NULL,
  `departemen` int(10) unsigned NOT NULL,
  `tglmulai` date NOT NULL,
  `tglakhir` date NOT NULL,
  `aktif` enum('1','0') NOT NULL DEFAULT '1',
  `keterangan` varchar(255) DEFAULT NULL,
  `ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`replid`),
  KEY `FK_tahunajaran_departemen` (`departemen`),
  KEY `IX_tahunajaran_ts` (`ts`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

#
# Data for table "aka_tahunajaran"
#

INSERT INTO `aka_tahunajaran` VALUES (1,'2014-2015',1,'2014-07-15','2015-06-15','1','','2014-01-23 06:49:44'),(2,'2014-2015',2,'2014-07-15','2015-06-15','1','','2014-03-19 11:36:55'),(3,'2014-2015',3,'2014-07-15','2015-06-15','0','','2014-03-19 11:37:57'),(4,'2013-2014',1,'2013-09-01','2013-12-31','0',NULL,'2014-12-04 15:24:04'),(5,'2015-2016',3,'2015-01-01','2016-02-01','1','tes bro','2015-01-28 15:57:00');
