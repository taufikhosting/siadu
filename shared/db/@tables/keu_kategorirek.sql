# Host: localhost  (Version: 5.6.20)
# Date: 2015-01-28 15:29:46
# Generator: MySQL-Front 5.3  (Build 4.187)

/*!40101 SET NAMES latin1 */;

#
# Structure for table "keu_kategorirek"
#

DROP TABLE IF EXISTS `keu_kategorirek`;
CREATE TABLE `keu_kategorirek` (
  `replid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `kode` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `nama` varchar(20) NOT NULL,
  PRIMARY KEY (`replid`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

#
# Data for table "keu_kategorirek"
#

/*!40000 ALTER TABLE `keu_kategorirek` DISABLE KEYS */;
INSERT INTO `keu_kategorirek` VALUES (1,1,'KAS'),(2,1,'BANK'),(3,1,'AKTIVA'),(4,2,'KEWAJIBAN'),(5,3,'MODAL'),(6,4,'PENDAPATAN'),(7,5,'BIAYA');
/*!40000 ALTER TABLE `keu_kategorirek` ENABLE KEYS */;
