# Host: localhost  (Version: 5.6.20)
# Date: 2015-01-28 15:40:08
# Generator: MySQL-Front 5.3  (Build 4.187)

/*!40101 SET NAMES latin1 */;

#
# Structure for table "psb_tmp"
#

DROP TABLE IF EXISTS `psb_tmp`;
CREATE TABLE `psb_tmp` (
  `dcid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `photo` mediumblob NOT NULL,
  PRIMARY KEY (`dcid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

#
# Data for table "psb_tmp"
#

/*!40000 ALTER TABLE `psb_tmp` DISABLE KEYS */;
/*!40000 ALTER TABLE `psb_tmp` ENABLE KEYS */;
