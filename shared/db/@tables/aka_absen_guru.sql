# Host: localhost  (Version: 5.6.20)
# Date: 2015-01-29 04:47:53
# Generator: MySQL-Front 5.3  (Build 4.187)

/*!40101 SET NAMES latin1 */;

#
# Structure for table "aka_absen_guru"
#

DROP TABLE IF EXISTS `aka_absen_guru`;
CREATE TABLE `aka_absen_guru` (
  `replid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `guru` int(10) unsigned NOT NULL,
  `absen` varchar(3) NOT NULL DEFAULT '0',
  `tanggal` date NOT NULL DEFAULT '0000-00-00',
  `keterangan` varchar(100) NOT NULL,
  PRIMARY KEY (`replid`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

#
# Data for table "aka_absen_guru"
#

/*!40000 ALTER TABLE `aka_absen_guru` DISABLE KEYS */;
INSERT INTO `aka_absen_guru` VALUES (1,2,'H','2014-01-23',''),(2,3,'H','2014-01-23',''),(3,1,'H','2014-01-23',''),(4,4,'H','2014-01-23','');
/*!40000 ALTER TABLE `aka_absen_guru` ENABLE KEYS */;
