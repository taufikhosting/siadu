# Host: localhost  (Version: 5.6.20)
# Date: 2015-01-28 15:40:45
# Generator: MySQL-Front 5.3  (Build 4.187)

/*!40101 SET NAMES latin1 */;

#
# Structure for table "pus_extra"
#

DROP TABLE IF EXISTS `pus_extra`;
CREATE TABLE `pus_extra` (
  `replid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `kode` varchar(10) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `keterangan` varchar(200) NOT NULL,
  PRIMARY KEY (`replid`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

#
# Data for table "pus_extra"
#

/*!40000 ALTER TABLE `pus_extra` DISABLE KEYS */;
INSERT INTO `pus_extra` VALUES (1,'001','Extra 1','');
/*!40000 ALTER TABLE `pus_extra` ENABLE KEYS */;
