# Host: localhost  (Version: 5.6.20)
# Date: 2015-01-29 04:53:36
# Generator: MySQL-Front 5.3  (Build 4.187)

/*!40101 SET NAMES latin1 */;

#
# Structure for table "aka_siswa_kontakdarurat"
#

DROP TABLE IF EXISTS `aka_siswa_kontakdarurat`;
CREATE TABLE `aka_siswa_kontakdarurat` (
  `replid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `siswa` int(10) unsigned NOT NULL,
  `nama` varchar(100) NOT NULL,
  `hubungan` varchar(30) NOT NULL,
  `telpon` varchar(50) NOT NULL,
  PRIMARY KEY (`replid`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

#
# Data for table "aka_siswa_kontakdarurat"
#

/*!40000 ALTER TABLE `aka_siswa_kontakdarurat` DISABLE KEYS */;
INSERT INTO `aka_siswa_kontakdarurat` VALUES (1,1,'','',''),(2,2,'','',''),(4,4,'','',''),(5,5,'','',''),(7,7,'','',''),(11,10,'','',''),(14,13,'','',''),(15,14,'','',''),(16,15,'','',''),(17,16,'','',''),(18,17,'','',''),(19,18,'','',''),(20,19,'','',''),(21,20,'','',''),(22,21,'','',''),(23,22,'','',''),(24,23,'','',''),(25,24,'','',''),(26,25,'','',''),(27,26,'','',''),(28,27,'','',''),(29,28,'','',''),(30,29,'','',''),(31,30,'','',''),(32,31,'','',''),(33,32,'','',''),(34,33,'','',''),(35,34,'','',''),(36,35,'','',''),(37,36,'','',''),(38,37,'','',''),(39,38,'','',''),(40,39,'','',''),(41,40,'','',''),(42,41,'','',''),(43,42,'','',''),(44,43,'','',''),(45,44,'','',''),(46,45,'Yuniati','Nenek','0811331409');
/*!40000 ALTER TABLE `aka_siswa_kontakdarurat` ENABLE KEYS */;
