# Host: localhost  (Version: 5.6.20)
# Date: 2015-01-28 15:03:06
# Generator: MySQL-Front 5.3  (Build 4.187)

/*!40101 SET NAMES latin1 */;

#
# Structure for table "aka_komennilai"
#

DROP TABLE IF EXISTS `aka_komennilai`;
CREATE TABLE `aka_komennilai` (
  `replid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `siswa` int(10) unsigned NOT NULL,
  `pelajaran` int(10) unsigned NOT NULL,
  `komen` varchar(300) NOT NULL,
  PRIMARY KEY (`replid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

#
# Data for table "aka_komennilai"
#

/*!40000 ALTER TABLE `aka_komennilai` DISABLE KEYS */;
/*!40000 ALTER TABLE `aka_komennilai` ENABLE KEYS */;
