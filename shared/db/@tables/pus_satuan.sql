# Host: localhost  (Version: 5.6.20)
# Date: 2015-01-28 16:00:11
# Generator: MySQL-Front 5.3  (Build 4.187)

/*!40101 SET NAMES latin1 */;

#
# Structure for table "pus_satuan"
#

DROP TABLE IF EXISTS `pus_satuan`;
CREATE TABLE `pus_satuan` (
  `replid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `kode` varchar(10) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `keterangan` varchar(200) NOT NULL,
  PRIMARY KEY (`replid`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

#
# Data for table "pus_satuan"
#

/*!40000 ALTER TABLE `pus_satuan` DISABLE KEYS */;
INSERT INTO `pus_satuan` VALUES (1,'IDR','Rupiah Indonesia',''),(2,'USD','US Dollar',''),(3,'SGD','Singapore Dollar','');
/*!40000 ALTER TABLE `pus_satuan` ENABLE KEYS */;
