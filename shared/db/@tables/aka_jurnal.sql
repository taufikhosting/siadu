# Host: localhost  (Version: 5.6.20)
# Date: 2015-01-29 04:49:35
# Generator: MySQL-Front 5.3  (Build 4.187)

/*!40101 SET NAMES latin1 */;

#
# Structure for table "aka_jurnal"
#

DROP TABLE IF EXISTS `aka_jurnal`;
CREATE TABLE `aka_jurnal` (
  `replid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `guru` int(10) unsigned NOT NULL,
  `pelajaran` int(10) unsigned NOT NULL,
  `kelas` int(10) unsigned NOT NULL,
  `tanggal` date NOT NULL DEFAULT '0000-00-00',
  `keterangan` text NOT NULL,
  PRIMARY KEY (`replid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

#
# Data for table "aka_jurnal"
#

/*!40000 ALTER TABLE `aka_jurnal` DISABLE KEYS */;
/*!40000 ALTER TABLE `aka_jurnal` ENABLE KEYS */;
