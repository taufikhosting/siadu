# Host: localhost  (Version: 5.6.20)
# Date: 2015-01-28 15:02:39
# Generator: MySQL-Front 5.3  (Build 4.187)

/*!40101 SET NAMES latin1 */;

#
# Structure for table "aka_kegiatan"
#

DROP TABLE IF EXISTS `aka_kegiatan`;
CREATE TABLE `aka_kegiatan` (
  `replid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tahunajaran` int(10) unsigned NOT NULL,
  `tanggal1` date NOT NULL DEFAULT '0000-00-00',
  `tanggal2` date NOT NULL DEFAULT '0000-00-00',
  `efektif` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `keterangan` text NOT NULL,
  PRIMARY KEY (`replid`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

#
# Data for table "aka_kegiatan"
#

/*!40000 ALTER TABLE `aka_kegiatan` DISABLE KEYS */;
INSERT INTO `aka_kegiatan` VALUES (1,1,'2014-07-15','0000-00-00',1,'Hari pertama masuk tahun ajaran 2014-2015'),(3,1,'2014-12-25','0000-00-00',1,'Merry Christmas');
/*!40000 ALTER TABLE `aka_kegiatan` ENABLE KEYS */;
