# Host: localhost  (Version: 5.6.20)
# Date: 2015-01-28 15:29:24
# Generator: MySQL-Front 5.3  (Build 4.187)

/*!40101 SET NAMES latin1 */;

#
# Structure for table "keu_grupbrg"
#

DROP TABLE IF EXISTS `keu_grupbrg`;
CREATE TABLE `keu_grupbrg` (
  `replid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  PRIMARY KEY (`replid`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

#
# Data for table "keu_grupbrg"
#

/*!40000 ALTER TABLE `keu_grupbrg` DISABLE KEYS */;
INSERT INTO `keu_grupbrg` VALUES (1,'Elektronika',''),(2,'Kendaraan',''),(3,'Alat Tulis','');
/*!40000 ALTER TABLE `keu_grupbrg` ENABLE KEYS */;
