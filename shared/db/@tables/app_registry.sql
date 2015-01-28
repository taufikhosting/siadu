# Host: localhost  (Version: 5.6.20)
# Date: 2015-01-28 15:09:02
# Generator: MySQL-Front 5.3  (Build 4.187)

/*!40101 SET NAMES latin1 */;

#
# Structure for table "app_registry"
#

DROP TABLE IF EXISTS `app_registry`;
CREATE TABLE `app_registry` (
  `replid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `kunci` char(6) NOT NULL,
  `nilai` varchar(200) NOT NULL,
  PRIMARY KEY (`replid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

#
# Data for table "app_registry"
#

/*!40000 ALTER TABLE `app_registry` DISABLE KEYS */;
/*!40000 ALTER TABLE `app_registry` ENABLE KEYS */;
