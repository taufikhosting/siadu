# Host: localhost  (Version: 5.6.20)
# Date: 2015-01-28 15:30:01
# Generator: MySQL-Front 5.3  (Build 4.187)

/*!40101 SET NAMES latin1 */;

#
# Structure for table "keu_kelompokbrg"
#

DROP TABLE IF EXISTS `keu_kelompokbrg`;
CREATE TABLE `keu_kelompokbrg` (
  `replid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `grupbrg` int(10) unsigned NOT NULL,
  `nama` varchar(50) NOT NULL,
  PRIMARY KEY (`replid`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

#
# Data for table "keu_kelompokbrg"
#

/*!40000 ALTER TABLE `keu_kelompokbrg` DISABLE KEYS */;
INSERT INTO `keu_kelompokbrg` VALUES (1,1,'Komputer'),(2,1,'Proyektor'),(3,2,'Mobil'),(4,2,'Motor'),(5,2,'Sepeda'),(6,3,'bulpoin');
/*!40000 ALTER TABLE `keu_kelompokbrg` ENABLE KEYS */;
