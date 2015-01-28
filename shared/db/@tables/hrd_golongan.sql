# Host: localhost  (Version: 5.6.20)
# Date: 2015-01-28 15:22:25
# Generator: MySQL-Front 5.3  (Build 4.187)

/*!40101 SET NAMES latin1 */;

#
# Structure for table "hrd_golongan"
#

DROP TABLE IF EXISTS `hrd_golongan`;
CREATE TABLE `hrd_golongan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `gajipokok` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

#
# Data for table "hrd_golongan"
#

/*!40000 ALTER TABLE `hrd_golongan` DISABLE KEYS */;
INSERT INTO `hrd_golongan` VALUES (2,'2A0','1115370'),(3,'2B0','1239300'),(4,'2C0','1377000'),(5,'2D0','1530000'),(6,'3A0','1700000'),(7,'3B0','1870000'),(8,'3C0','2057000'),(9,'3D0','2262700'),(10,'4A0','2488970'),(11,'4B0','2737867'),(12,'4C0','3011654'),(13,'4D0','3312819'),(14,'11','1054025'),(15,'2A1','1171139'),(16,'2B1','1301265'),(17,'2C1','1445850'),(18,'2D1','1606500'),(19,'3A1','1785000'),(20,'3B1','1963500'),(21,'3C1','2159850'),(22,'3D1','2375835'),(23,'4A1','2613419'),(24,'4B1','2874760'),(25,'4C1','3162236'),(26,'4D1','3478460');
/*!40000 ALTER TABLE `hrd_golongan` ENABLE KEYS */;
