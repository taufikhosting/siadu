# Host: localhost  (Version: 5.6.20)
# Date: 2015-01-28 15:59:22
# Generator: MySQL-Front 5.3  (Build 4.187)

/*!40101 SET NAMES latin1 */;

#
# Structure for table "pus_member"
#

DROP TABLE IF EXISTS `pus_member`;
CREATE TABLE `pus_member` (
  `replid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nid` varchar(20) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `kontak` varchar(100) NOT NULL,
  `alamat` varchar(200) NOT NULL,
  PRIMARY KEY (`replid`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

#
# Data for table "pus_member"
#

/*!40000 ALTER TABLE `pus_member` DISABLE KEYS */;
INSERT INTO `pus_member` VALUES (1,'00001','Joko Santoso','08123456789','Jalan Majalengka 42'),(2,'00002','Rudi Hartono','08123456781','Jalan Wijaya 11');
/*!40000 ALTER TABLE `pus_member` ENABLE KEYS */;
