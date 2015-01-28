# Host: localhost  (Version: 5.6.20)
# Date: 2015-01-28 15:04:55
# Generator: MySQL-Front 5.3  (Build 4.187)

/*!40101 SET NAMES latin1 */;

#
# Structure for table "aka_setting"
#

DROP TABLE IF EXISTS `aka_setting`;
CREATE TABLE `aka_setting` (
  `replid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `kunci` char(6) NOT NULL,
  `nilai` varchar(200) NOT NULL,
  PRIMARY KEY (`replid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

#
# Data for table "aka_setting"
#

/*!40000 ALTER TABLE `aka_setting` DISABLE KEYS */;
/*!40000 ALTER TABLE `aka_setting` ENABLE KEYS */;
