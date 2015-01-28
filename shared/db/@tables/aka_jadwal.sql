# Host: localhost  (Version: 5.6.20)
# Date: 2015-01-28 15:01:15
# Generator: MySQL-Front 5.3  (Build 4.187)

/*!40101 SET NAMES latin1 */;

#
# Structure for table "aka_jadwal"
#

DROP TABLE IF EXISTS `aka_jadwal`;
CREATE TABLE `aka_jadwal` (
  `replid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tahunajaran` int(10) unsigned NOT NULL,
  `semester` int(10) unsigned NOT NULL DEFAULT '0',
  `kelas` int(10) unsigned NOT NULL,
  `hari` smallint(5) unsigned NOT NULL,
  `jam` mediumint(8) unsigned NOT NULL,
  `sks` int(10) unsigned NOT NULL,
  `ruang` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`replid`)
) ENGINE=MyISAM AUTO_INCREMENT=41 DEFAULT CHARSET=latin1;

#
# Data for table "aka_jadwal"
#

/*!40000 ALTER TABLE `aka_jadwal` DISABLE KEYS */;
INSERT INTO `aka_jadwal` VALUES (2,1,0,1,1,1,1,0),(3,1,0,1,1,2,2,0),(4,1,0,1,1,3,13,0),(5,1,0,1,1,4,14,0),(6,1,0,1,2,1,3,0),(7,1,0,1,1,5,25,0),(8,1,0,1,1,6,24,0),(10,1,0,1,2,2,36,0),(11,1,0,1,2,3,38,0),(14,1,0,2,1,2,28,0),(15,1,0,2,2,1,29,0),(16,1,0,2,1,3,39,0),(17,1,0,2,1,4,41,0),(19,1,0,1,1,7,37,0),(20,1,0,1,2,4,26,0),(21,1,0,2,2,4,40,0),(22,1,0,2,2,2,16,0),(23,1,0,2,2,3,15,0),(25,1,0,2,1,6,5,0),(26,1,0,2,1,7,4,0),(27,1,0,3,1,4,7,0),(28,1,0,2,2,5,6,0),(29,1,0,3,1,5,8,0),(30,1,0,3,1,1,44,0),(31,1,0,3,1,2,43,0),(32,1,0,2,1,1,27,0),(34,1,0,5,1,2,176,0),(36,1,0,5,1,5,178,0),(37,1,0,5,1,6,177,0),(39,1,0,5,1,1,179,0),(40,1,0,6,1,7,180,0);
/*!40000 ALTER TABLE `aka_jadwal` ENABLE KEYS */;
