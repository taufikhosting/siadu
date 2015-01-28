# Host: localhost  (Version: 5.6.20)
# Date: 2015-01-28 16:43:57
# Generator: MySQL-Front 5.3  (Build 4.187)

/*!40101 SET NAMES latin1 */;

#
# Structure for table "sar_kondisi"
#

DROP TABLE IF EXISTS `sar_kondisi`;
CREATE TABLE `sar_kondisi` (
  `replid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(30) NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  PRIMARY KEY (`replid`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

#
# Data for table "sar_kondisi"
#

/*!40000 ALTER TABLE `sar_kondisi` DISABLE KEYS */;
INSERT INTO `sar_kondisi` VALUES (1,'Sangat baik','Baru'),(2,'Baik','Layak'),(3,'Buruk','Perlu perbaikan'),(4,'Sangat buruk','Tidak dapat digunakan');
/*!40000 ALTER TABLE `sar_kondisi` ENABLE KEYS */;
