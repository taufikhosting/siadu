# Host: localhost  (Version: 5.6.20)
# Date: 2015-01-28 15:59:12
# Generator: MySQL-Front 5.3  (Build 4.187)

/*!40101 SET NAMES latin1 */;

#
# Structure for table "pus_lokasi"
#

DROP TABLE IF EXISTS `pus_lokasi`;
CREATE TABLE `pus_lokasi` (
  `replid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `kode` varchar(10) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` varchar(250) NOT NULL,
  `keterangan` varchar(250) NOT NULL,
  `utama` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`replid`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

#
# Data for table "pus_lokasi"
#

/*!40000 ALTER TABLE `pus_lokasi` DISABLE KEYS */;
INSERT INTO `pus_lokasi` VALUES (3,'001','Library Suko','','','0'),(4,'002','Library Kertajaya','','','0'),(5,'003','Library Rungkut','','','0');
/*!40000 ALTER TABLE `pus_lokasi` ENABLE KEYS */;
