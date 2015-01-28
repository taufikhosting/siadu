# Host: localhost  (Version: 5.6.20)
# Date: 2015-01-28 15:29:14
# Generator: MySQL-Front 5.3  (Build 4.187)

/*!40101 SET NAMES latin1 */;

#
# Structure for table "keu_budget"
#

DROP TABLE IF EXISTS `keu_budget`;
CREATE TABLE `keu_budget` (
  `replid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tahunbuku` int(10) unsigned NOT NULL,
  `nama` varchar(100) NOT NULL,
  `nominal` decimal(10,0) NOT NULL DEFAULT '0',
  `keterangan` varchar(200) NOT NULL,
  `id_department` int(11) NOT NULL,
  PRIMARY KEY (`replid`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

#
# Data for table "keu_budget"
#

/*!40000 ALTER TABLE `keu_budget` DISABLE KEYS */;
INSERT INTO `keu_budget` VALUES (1,1,'Alat Penganggaran',10000000,'',1),(2,1,'anggaran',2000000,'',0),(3,1,'Angaran Lagi',100000,'',0);
/*!40000 ALTER TABLE `keu_budget` ENABLE KEYS */;
