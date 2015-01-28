# Host: localhost  (Version: 5.6.20)
# Date: 2015-01-28 16:43:13
# Generator: MySQL-Front 5.3  (Build 4.187)

/*!40101 SET NAMES latin1 */;

#
# Structure for table "sar_jenis"
#

DROP TABLE IF EXISTS `sar_jenis`;
CREATE TABLE `sar_jenis` (
  `replid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `kode` varchar(3) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `keterangan` varchar(200) NOT NULL,
  PRIMARY KEY (`replid`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

#
# Data for table "sar_jenis"
#

/*!40000 ALTER TABLE `sar_jenis` DISABLE KEYS */;
INSERT INTO `sar_jenis` VALUES (1,'030','Habis pakai',''),(2,'020','Tidak habis pakai','');
/*!40000 ALTER TABLE `sar_jenis` ENABLE KEYS */;
