# Host: localhost  (Version: 5.6.20)
# Date: 2015-01-29 04:46:22
# Generator: MySQL-Front 5.3  (Build 4.187)

/*!40101 SET NAMES latin1 */;

#
# Structure for table "psb_photo"
#

DROP TABLE IF EXISTS `psb_photo`;
CREATE TABLE `psb_photo` (
  `dcid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `calonsiswa` int(10) unsigned NOT NULL,
  `photo` mediumblob NOT NULL,
  PRIMARY KEY (`dcid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

#
# Data for table "psb_photo"
#

/*!40000 ALTER TABLE `psb_photo` DISABLE KEYS */;
/*!40000 ALTER TABLE `psb_photo` ENABLE KEYS */;
