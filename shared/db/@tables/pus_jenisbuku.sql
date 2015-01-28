# Host: localhost  (Version: 5.6.20)
# Date: 2015-01-28 15:40:53
# Generator: MySQL-Front 5.3  (Build 4.187)

/*!40101 SET NAMES latin1 */;

#
# Structure for table "pus_jenisbuku"
#

DROP TABLE IF EXISTS `pus_jenisbuku`;
CREATE TABLE `pus_jenisbuku` (
  `replid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `kode` varchar(10) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `keterangan` varchar(200) NOT NULL,
  PRIMARY KEY (`replid`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

#
# Data for table "pus_jenisbuku"
#

/*!40000 ALTER TABLE `pus_jenisbuku` DISABLE KEYS */;
INSERT INTO `pus_jenisbuku` VALUES (1,'HC','Hard cover',''),(2,'CD ROM','AV Collection',''),(3,'PB','Paperback',''),(4,'DVD','DVD','');
/*!40000 ALTER TABLE `pus_jenisbuku` ENABLE KEYS */;
