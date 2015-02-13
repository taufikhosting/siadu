# Host: localhost  (Version: 5.6.20)
# Date: 2015-01-29 04:51:19
# Generator: MySQL-Front 5.3  (Build 4.187)

/*!40101 SET NAMES latin1 */;

#
# Structure for table "aka_ruang"
#

DROP TABLE IF EXISTS `aka_ruang`;
CREATE TABLE `aka_ruang` (
  `replid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `departemen` int(10) unsigned NOT NULL,
  `kode` varchar(20) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `keterangan` varchar(200) NOT NULL,
  PRIMARY KEY (`replid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

#
# Data for table "aka_ruang"
#

/*!40000 ALTER TABLE `aka_ruang` DISABLE KEYS */;
/*!40000 ALTER TABLE `aka_ruang` ENABLE KEYS */;
