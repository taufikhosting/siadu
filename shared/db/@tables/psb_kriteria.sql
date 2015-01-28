# Host: localhost  (Version: 5.6.20)
# Date: 2015-01-29 04:46:10
# Generator: MySQL-Front 5.3  (Build 4.187)

/*!40101 SET NAMES latin1 */;

#
# Structure for table "psb_kriteria"
#

DROP TABLE IF EXISTS `psb_kriteria`;
CREATE TABLE `psb_kriteria` (
  `replid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `kriteria` varchar(150) DEFAULT NULL,
  `keterangan` varchar(250) DEFAULT NULL,
  `urut` int(10) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`replid`),
  UNIQUE KEY `replid` (`replid`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

#
# Data for table "psb_kriteria"
#

/*!40000 ALTER TABLE `psb_kriteria` DISABLE KEYS */;
INSERT INTO `psb_kriteria` VALUES (1,'Toddler - PG B','Usia 1 tahun - 3 tahun',1),(4,'Kindergarten A - B','Usia 4 tahun - 5 tahun',1),(5,'Primary 1','Usia 6 tahun - 7 tahun',1),(6,'Secondary 1 - 3','Usia 12 tahun - 14 tahun',1),(7,'High School','Usia 16 tahun - 17 tahun',1),(8,'Playgroup A - B','Usia 2 tahun - 3 tahun',1),(9,'Playgroup B','Usia 3 tahun',1),(10,'Kindergarten B','Usia 5 tahun',1),(12,'Primary 2','Usia 7 tahun',1),(13,'Primary 3','Usia 8 tahun',1),(14,'Primary 4','Usia 9 tahun',1),(15,'Primary 5','Usia 10 tahun',1),(16,'Primary 6','Usia 11 tahun',1),(17,'Secondary 2','Usia 13 tahun',1),(18,'Secondary 3','Usia 14 tahun',1),(19,'Secondary 4','Usia 15 tahun',1);
/*!40000 ALTER TABLE `psb_kriteria` ENABLE KEYS */;
