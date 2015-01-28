# Host: localhost  (Version: 5.6.20)
# Date: 2015-01-28 15:32:56
# Generator: MySQL-Front 5.3  (Build 4.187)

/*!40101 SET NAMES latin1 */;

#
# Structure for table "keu_tahunbuku"
#

DROP TABLE IF EXISTS `keu_tahunbuku`;
CREATE TABLE `keu_tahunbuku` (
  `replid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `tanggal1` date NOT NULL DEFAULT '0000-00-00',
  `tanggal2` date NOT NULL DEFAULT '0000-00-00',
  `kode` varchar(20) NOT NULL,
  `saldoawal` decimal(10,0) NOT NULL DEFAULT '0',
  `aktif` enum('1','0') NOT NULL DEFAULT '1',
  `keterangan` varchar(200) NOT NULL,
  PRIMARY KEY (`replid`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

#
# Data for table "keu_tahunbuku"
#

/*!40000 ALTER TABLE `keu_tahunbuku` DISABLE KEYS */;
INSERT INTO `keu_tahunbuku` VALUES (1,'2014','2014-01-01','0000-00-00','',5000000,'1','Kas Kecil Rungkut');
/*!40000 ALTER TABLE `keu_tahunbuku` ENABLE KEYS */;
