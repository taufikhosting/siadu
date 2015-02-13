# Host: localhost  (Version: 5.6.20)
# Date: 2015-01-29 04:55:28
# Generator: MySQL-Front 5.3  (Build 4.187)

/*!40101 SET NAMES latin1 */;

#
# Structure for table "aka_tesakademis"
#

DROP TABLE IF EXISTS `aka_tesakademis`;
CREATE TABLE `aka_tesakademis` (
  `replid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tahunajaran` int(10) unsigned NOT NULL,
  `nama` varchar(50) NOT NULL,
  PRIMARY KEY (`replid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

#
# Data for table "aka_tesakademis"
#

/*!40000 ALTER TABLE `aka_tesakademis` DISABLE KEYS */;
/*!40000 ALTER TABLE `aka_tesakademis` ENABLE KEYS */;
