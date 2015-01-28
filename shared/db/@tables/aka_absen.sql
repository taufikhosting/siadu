# Host: localhost  (Version: 5.6.20)
# Date: 2015-01-28 14:59:06
# Generator: MySQL-Front 5.3  (Build 4.187)

/*!40101 SET NAMES latin1 */;

#
# Structure for table "aka_absen"
#

DROP TABLE IF EXISTS `aka_absen`;
CREATE TABLE `aka_absen` (
  `replid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `siswa` int(10) unsigned NOT NULL,
  `absen` varchar(3) NOT NULL DEFAULT '0',
  `tanggal` date NOT NULL DEFAULT '0000-00-00',
  `keterangan` varchar(100) NOT NULL,
  PRIMARY KEY (`replid`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

#
# Data for table "aka_absen"
#

/*!40000 ALTER TABLE `aka_absen` DISABLE KEYS */;
INSERT INTO `aka_absen` VALUES (1,1,'H','2014-01-23',''),(2,2,'H','2014-01-23',''),(3,4,'H','2014-01-23',''),(4,1,'H','2014-01-22',''),(5,2,'H','2014-01-22',''),(6,4,'S','2014-01-22',''),(7,7,'H','2015-01-01',''),(8,5,'H','2015-01-01',''),(9,4,'H','2015-01-01',''),(10,2,'H','2015-01-01','');
/*!40000 ALTER TABLE `aka_absen` ENABLE KEYS */;
