# Host: localhost  (Version: 5.6.20)
# Date: 2015-01-28 15:10:38
# Generator: MySQL-Front 5.3  (Build 4.187)

/*!40101 SET NAMES latin1 */;

#
# Structure for table "hrd_agama"
#

DROP TABLE IF EXISTS `hrd_agama`;
CREATE TABLE `hrd_agama` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `tunjangan` varchar(255) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

#
# Data for table "hrd_agama"
#

/*!40000 ALTER TABLE `hrd_agama` DISABLE KEYS */;
INSERT INTO `hrd_agama` VALUES (1,'Islam','0'),(2,'Kristen','0'),(3,'Katolik','0');
/*!40000 ALTER TABLE `hrd_agama` ENABLE KEYS */;
