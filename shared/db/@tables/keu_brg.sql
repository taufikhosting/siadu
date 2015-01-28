# Host: localhost  (Version: 5.6.20)
# Date: 2015-01-28 15:28:53
# Generator: MySQL-Front 5.3  (Build 4.187)

/*!40101 SET NAMES latin1 */;

#
# Structure for table "keu_brg"
#

DROP TABLE IF EXISTS `keu_brg`;
CREATE TABLE `keu_brg` (
  `replid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `kelompokbrg` int(10) unsigned NOT NULL,
  `kode` varchar(20) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `unit` mediumint(8) unsigned NOT NULL DEFAULT '1',
  `satuan` varchar(10) NOT NULL,
  `tanggal` date NOT NULL DEFAULT '0000-00-00',
  `keterangan` varchar(250) NOT NULL,
  PRIMARY KEY (`replid`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

#
# Data for table "keu_brg"
#

/*!40000 ALTER TABLE `keu_brg` DISABLE KEYS */;
INSERT INTO `keu_brg` VALUES (1,1,'ELKO001','Macbook pro 15 inch',14,'unit','2014-01-11',''),(2,4,'KEMTR0001','Supra X 125',3,'','2014-01-11','');
/*!40000 ALTER TABLE `keu_brg` ENABLE KEYS */;
