# Host: localhost  (Version: 5.6.20)
# Date: 2015-01-29 04:48:04
# Generator: MySQL-Front 5.3  (Build 4.187)

/*!40101 SET NAMES latin1 */;

#
# Structure for table "aka_alumni"
#

DROP TABLE IF EXISTS `aka_alumni`;
CREATE TABLE `aka_alumni` (
  `replid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tahunlulus` varchar(4) NOT NULL DEFAULT '0000',
  `siswa` int(10) unsigned NOT NULL,
  `keterangan` varchar(300) NOT NULL,
  PRIMARY KEY (`replid`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

#
# Data for table "aka_alumni"
#

/*!40000 ALTER TABLE `aka_alumni` DISABLE KEYS */;
INSERT INTO `aka_alumni` VALUES (1,'1',1,'');
/*!40000 ALTER TABLE `aka_alumni` ENABLE KEYS */;
