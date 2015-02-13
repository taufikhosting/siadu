# Host: localhost  (Version: 5.6.20)
# Date: 2015-01-28 16:46:07
# Generator: MySQL-Front 5.3  (Build 4.187)

/*!40101 SET NAMES latin1 */;

#
# Structure for table "sar_pengembalian"
#

DROP TABLE IF EXISTS `sar_pengembalian`;
CREATE TABLE `sar_pengembalian` (
  `replid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `peminjaman` int(10) unsigned NOT NULL,
  `tanggal` date NOT NULL,
  `keterangan` varchar(250) NOT NULL,
  PRIMARY KEY (`replid`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

#
# Data for table "sar_pengembalian"
#

/*!40000 ALTER TABLE `sar_pengembalian` DISABLE KEYS */;
INSERT INTO `sar_pengembalian` VALUES (1,5,'2013-09-17',''),(2,4,'2013-09-17','barang OK'),(3,2,'2014-03-25','');
/*!40000 ALTER TABLE `sar_pengembalian` ENABLE KEYS */;
