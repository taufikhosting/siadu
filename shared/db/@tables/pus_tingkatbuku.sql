# Host: localhost  (Version: 5.6.20)
# Date: 2015-01-28 16:00:37
# Generator: MySQL-Front 5.3  (Build 4.187)

/*!40101 SET NAMES latin1 */;

#
# Structure for table "pus_tingkatbuku"
#

DROP TABLE IF EXISTS `pus_tingkatbuku`;
CREATE TABLE `pus_tingkatbuku` (
  `replid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `kode` varchar(10) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `keterangan` varchar(200) NOT NULL,
  PRIMARY KEY (`replid`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

#
# Data for table "pus_tingkatbuku"
#

/*!40000 ALTER TABLE `pus_tingkatbuku` DISABLE KEYS */;
INSERT INTO `pus_tingkatbuku` VALUES (1,'001','PG/KG Suko',''),(2,'002','Primary Suko',''),(3,'003','Secondary Suko',''),(4,'004','Kertajaya',''),(5,'005','Rungkut',''),(7,'006','Resource Suko',''),(9,'007','Resource Kertajaya',''),(10,'008','Resource Rungkut',''),(11,'009','R & D','');
/*!40000 ALTER TABLE `pus_tingkatbuku` ENABLE KEYS */;
