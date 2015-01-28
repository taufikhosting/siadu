# Host: localhost  (Version: 5.6.20)
# Date: 2015-01-29 04:49:14
# Generator: MySQL-Front 5.3  (Build 4.187)

/*!40101 SET NAMES latin1 */;

#
# Structure for table "aka_jadwal_set"
#

DROP TABLE IF EXISTS `aka_jadwal_set`;
CREATE TABLE `aka_jadwal_set` (
  `replid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tahunajaran` int(10) unsigned NOT NULL,
  `hari` int(10) unsigned NOT NULL,
  `jam` int(10) unsigned NOT NULL DEFAULT '0',
  `aktif` smallint(6) NOT NULL DEFAULT '1',
  PRIMARY KEY (`replid`)
) ENGINE=MyISAM AUTO_INCREMENT=71 DEFAULT CHARSET=latin1;

#
# Data for table "aka_jadwal_set"
#

/*!40000 ALTER TABLE `aka_jadwal_set` DISABLE KEYS */;
INSERT INTO `aka_jadwal_set` VALUES (1,1,1,1,1),(2,1,1,2,1),(3,1,1,3,1),(4,1,1,4,1),(5,1,1,5,1),(6,1,1,6,1),(7,1,1,7,1),(8,1,2,1,1),(9,1,2,2,1),(10,1,2,3,1),(11,1,2,4,1),(12,1,2,5,1),(13,1,2,6,1),(14,1,2,7,1),(15,1,3,1,1),(16,1,3,2,1),(17,1,3,3,1),(18,1,3,4,1),(19,1,3,5,1),(20,1,3,6,1),(21,1,3,7,1),(22,1,4,1,1),(23,1,4,2,1),(24,1,4,3,1),(25,1,4,4,1),(26,1,4,5,1),(27,1,4,6,1),(28,1,4,7,1),(29,1,5,1,1),(30,1,5,2,1),(31,1,5,3,1),(32,1,5,4,1),(33,1,5,5,1),(34,1,5,6,1),(35,1,5,7,1),(36,3,1,1,1),(37,3,1,2,1),(38,3,1,3,1),(39,3,1,4,1),(40,3,1,5,1),(41,3,1,6,1),(42,3,1,7,1),(43,3,2,1,1),(44,3,2,2,1),(45,3,2,3,1),(46,3,2,4,1),(47,3,2,5,1),(48,3,2,6,1),(49,3,2,7,1),(50,3,3,1,1),(51,3,3,2,1),(52,3,3,3,1),(53,3,3,4,1),(54,3,3,5,1),(55,3,3,6,1),(56,3,3,7,1),(57,3,4,1,1),(58,3,4,2,1),(59,3,4,3,1),(60,3,4,4,1),(61,3,4,5,1),(62,3,4,6,1),(63,3,4,7,1),(64,3,5,1,1),(65,3,5,2,1),(66,3,5,3,1),(67,3,5,4,1),(68,3,5,5,1),(69,3,5,6,1),(70,3,5,7,1);
/*!40000 ALTER TABLE `aka_jadwal_set` ENABLE KEYS */;
