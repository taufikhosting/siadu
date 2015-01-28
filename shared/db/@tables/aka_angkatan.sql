# Host: localhost  (Version: 5.6.20)
# Date: 2015-01-29 04:48:15
# Generator: MySQL-Front 5.3  (Build 4.187)

/*!40101 SET NAMES utf8 */;

#
# Structure for table "aka_angkatan"
#

DROP TABLE IF EXISTS `aka_angkatan`;
CREATE TABLE `aka_angkatan` (
  `replid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `angkatan` varchar(10) NOT NULL,
  `departemen` int(10) unsigned NOT NULL,
  `aktif` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `keterangan` varchar(255) DEFAULT NULL,
  `ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`replid`),
  KEY `FK_angkatan_departemen` (`departemen`),
  KEY `IX_angkatan_ts` (`ts`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

#
# Data for table "aka_angkatan"
#

INSERT INTO `aka_angkatan` VALUES (1,'2013',1,1,'Tahun Ajaran 2013-2014','2014-01-23 06:49:16'),(2,'2014',1,1,'Tahun Ajaran 2014-2015','2014-03-19 11:34:07'),(3,'2013',2,1,'Tahun Ajaran 2013-2014','2014-03-19 11:34:45'),(4,'2014',2,1,'Tahun Ajaran 2014-2015','2014-03-19 11:35:00'),(5,'2013',3,1,'Tahun Ajaran 2013-2014','2014-03-19 11:35:20'),(6,'2014',3,1,'Tahun Ajaran 2014-2015','2014-03-19 11:35:34'),(7,'2015',1,1,'Tahun Ajaran 2015-2016','2014-11-29 06:55:59'),(8,'2016',1,1,'Tahun Ajaran 2016-2017','2015-01-28 15:53:00');
