# Host: localhost  (Version: 5.6.20)
# Date: 2015-01-29 04:54:52
# Generator: MySQL-Front 5.3  (Build 4.187)

/*!40101 SET NAMES latin1 */;

#
# Structure for table "aka_tahunlulus"
#

DROP TABLE IF EXISTS `aka_tahunlulus`;
CREATE TABLE `aka_tahunlulus` (
  `replid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `departemen` int(10) unsigned NOT NULL,
  `nama` varchar(10) NOT NULL,
  PRIMARY KEY (`replid`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

#
# Data for table "aka_tahunlulus"
#

/*!40000 ALTER TABLE `aka_tahunlulus` DISABLE KEYS */;
INSERT INTO `aka_tahunlulus` VALUES (1,1,'2014');
/*!40000 ALTER TABLE `aka_tahunlulus` ENABLE KEYS */;
