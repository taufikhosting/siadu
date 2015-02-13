# Host: localhost  (Version: 5.6.20)
# Date: 2015-01-29 04:48:53
# Generator: MySQL-Front 5.3  (Build 4.187)

/*!40101 SET NAMES latin1 */;

#
# Structure for table "aka_grup"
#

DROP TABLE IF EXISTS `aka_grup`;
CREATE TABLE `aka_grup` (
  `replid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tahunajaran` int(10) unsigned NOT NULL,
  `nama` varchar(50) NOT NULL,
  `keterangan` varchar(250) NOT NULL,
  `urut` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`replid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

#
# Data for table "aka_grup"
#

/*!40000 ALTER TABLE `aka_grup` DISABLE KEYS */;
/*!40000 ALTER TABLE `aka_grup` ENABLE KEYS */;
