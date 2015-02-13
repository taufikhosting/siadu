# Host: localhost  (Version: 5.6.20)
# Date: 2015-01-28 16:00:27
# Generator: MySQL-Front 5.3  (Build 4.187)

/*!40101 SET NAMES latin1 */;

#
# Structure for table "pus_stockhist"
#

DROP TABLE IF EXISTS `pus_stockhist`;
CREATE TABLE `pus_stockhist` (
  `replid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL,
  `tanggal1` date NOT NULL DEFAULT '0000-00-00',
  `tanggal2` date NOT NULL DEFAULT '0000-00-00',
  `keterangan` varchar(200) NOT NULL,
  `tabel` varchar(20) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `nitem` int(10) unsigned NOT NULL DEFAULT '0',
  `nceky` int(10) unsigned NOT NULL DEFAULT '0',
  `nnote` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`replid`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

#
# Data for table "pus_stockhist"
#

/*!40000 ALTER TABLE `pus_stockhist` DISABLE KEYS */;
INSERT INTO `pus_stockhist` VALUES (1,'Test','2014-01-16','2014-01-16','','so_1',5,15,3,0),(2,'27 Maret 2014','2014-03-27','2014-03-27','oleh : Melfa SInaga','so_2',5,53,0,0),(3,'11062014','2014-06-11','2014-09-26','stock opname','so_3',5,0,0,0);
/*!40000 ALTER TABLE `pus_stockhist` ENABLE KEYS */;
