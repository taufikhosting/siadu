# Host: localhost  (Version: 5.6.20)
# Date: 2015-01-28 16:00:49
# Generator: MySQL-Front 5.3  (Build 4.187)

/*!40101 SET NAMES latin1 */;

#
# Structure for table "pus_tpjm"
#

DROP TABLE IF EXISTS `pus_tpjm`;
CREATE TABLE `pus_tpjm` (
  `replid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ssid` varchar(100) NOT NULL,
  `buku` int(10) unsigned NOT NULL DEFAULT '0',
  `peminjaman` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`replid`)
) ENGINE=MyISAM AUTO_INCREMENT=52 DEFAULT CHARSET=latin1;

#
# Data for table "pus_tpjm"
#

/*!40000 ALTER TABLE `pus_tpjm` DISABLE KEYS */;
INSERT INTO `pus_tpjm` VALUES (50,'f4403g30d112g6ahutqbq8uba1',34,0);
/*!40000 ALTER TABLE `pus_tpjm` ENABLE KEYS */;
