# Host: localhost  (Version: 5.6.20)
# Date: 2015-01-29 04:52:11
# Generator: MySQL-Front 5.3  (Build 4.187)

/*!40101 SET NAMES latin1 */;

#
# Structure for table "aka_siswa_grup"
#

DROP TABLE IF EXISTS `aka_siswa_grup`;
CREATE TABLE `aka_siswa_grup` (
  `replid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `siswa` int(10) unsigned NOT NULL,
  `grup` int(10) unsigned NOT NULL,
  PRIMARY KEY (`replid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

#
# Data for table "aka_siswa_grup"
#

/*!40000 ALTER TABLE `aka_siswa_grup` DISABLE KEYS */;
/*!40000 ALTER TABLE `aka_siswa_grup` ENABLE KEYS */;
