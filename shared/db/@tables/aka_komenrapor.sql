# Host: localhost  (Version: 5.6.20)
# Date: 2015-01-28 15:03:18
# Generator: MySQL-Front 5.3  (Build 4.187)

/*!40101 SET NAMES latin1 */;

#
# Structure for table "aka_komenrapor"
#

DROP TABLE IF EXISTS `aka_komenrapor`;
CREATE TABLE `aka_komenrapor` (
  `replid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tahunajaran` int(10) unsigned NOT NULL,
  `siswa` int(10) unsigned NOT NULL,
  `komen` varchar(300) NOT NULL,
  PRIMARY KEY (`replid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

#
# Data for table "aka_komenrapor"
#

/*!40000 ALTER TABLE `aka_komenrapor` DISABLE KEYS */;
/*!40000 ALTER TABLE `aka_komenrapor` ENABLE KEYS */;
