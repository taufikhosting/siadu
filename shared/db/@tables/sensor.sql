# Host: localhost  (Version: 5.6.20)
# Date: 2015-01-28 16:47:17
# Generator: MySQL-Front 5.3  (Build 4.187)

/*!40101 SET NAMES latin1 */;

#
# Structure for table "sensor"
#

DROP TABLE IF EXISTS `sensor`;
CREATE TABLE `sensor` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `word` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

#
# Data for table "sensor"
#

/*!40000 ALTER TABLE `sensor` DISABLE KEYS */;
INSERT INTO `sensor` VALUES (1,'Kontol'),(2,'Anjing'),(3,'Anjeng'),(4,'anjrit'),(5,'memek'),(6,'tempek'),(7,'Bangsat'),(8,'fuck'),(9,'eSDeCe');
/*!40000 ALTER TABLE `sensor` ENABLE KEYS */;
