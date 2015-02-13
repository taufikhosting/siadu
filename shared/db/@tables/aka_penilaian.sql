# Host: localhost  (Version: 5.6.20)
# Date: 2015-01-29 04:51:07
# Generator: MySQL-Front 5.3  (Build 4.187)

/*!40101 SET NAMES utf8 */;

#
# Structure for table "aka_penilaian"
#

DROP TABLE IF EXISTS `aka_penilaian`;
CREATE TABLE `aka_penilaian` (
  `replid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `guru` int(10) unsigned NOT NULL,
  `pelajaran` int(10) unsigned NOT NULL,
  `kelas` int(10) unsigned NOT NULL,
  `nama` varchar(50) NOT NULL,
  `kode` varchar(20) NOT NULL,
  `kkm` float NOT NULL DEFAULT '70',
  `bobot` float NOT NULL DEFAULT '1',
  `keterangan` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`replid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# Data for table "aka_penilaian"
#

