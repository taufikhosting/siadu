# Host: localhost  (Version: 5.6.20)
# Date: 2015-01-28 16:41:36
# Generator: MySQL-Front 5.3  (Build 4.187)

/*!40101 SET NAMES latin1 */;

#
# Structure for table "sar_dftp"
#

DROP TABLE IF EXISTS `sar_dftp`;
CREATE TABLE `sar_dftp` (
  `replid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `barang` int(10) unsigned NOT NULL,
  `katalog` int(10) unsigned NOT NULL,
  PRIMARY KEY (`replid`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

#
# Data for table "sar_dftp"
#

/*!40000 ALTER TABLE `sar_dftp` DISABLE KEYS */;
/*!40000 ALTER TABLE `sar_dftp` ENABLE KEYS */;
