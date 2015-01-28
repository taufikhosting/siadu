# Host: localhost  (Version: 5.6.20)
# Date: 2015-01-28 15:07:09
# Generator: MySQL-Front 5.3  (Build 4.187)

/*!40101 SET NAMES latin1 */;

#
# Structure for table "aka_siswa_tes"
#

DROP TABLE IF EXISTS `aka_siswa_tes`;
CREATE TABLE `aka_siswa_tes` (
  `replid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `siswa` int(10) unsigned NOT NULL,
  `tes` int(10) unsigned NOT NULL,
  `nilai` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`replid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

#
# Data for table "aka_siswa_tes"
#

/*!40000 ALTER TABLE `aka_siswa_tes` DISABLE KEYS */;
/*!40000 ALTER TABLE `aka_siswa_tes` ENABLE KEYS */;
