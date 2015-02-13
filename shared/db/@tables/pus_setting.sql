# Host: localhost  (Version: 5.6.20)
# Date: 2015-01-28 16:00:18
# Generator: MySQL-Front 5.3  (Build 4.187)

/*!40101 SET NAMES latin1 */;

#
# Structure for table "pus_setting"
#

DROP TABLE IF EXISTS `pus_setting`;
CREATE TABLE `pus_setting` (
  `replid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `kunci` char(6) NOT NULL,
  `nilai` varchar(200) NOT NULL,
  PRIMARY KEY (`replid`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

#
# Data for table "pus_setting"
#

/*!40000 ALTER TABLE `pus_setting` DISABLE KEYS */;
INSERT INTO `pus_setting` VALUES (1,'idfmt','[nomorauto.3]/[sumber]/SIADU/[tahun]'),(2,'labelt','ELYON SCHOOL LIBRARY'),(3,'labeld','Jl. Sulawesi 189-191 Sby (031-59622690)'),(4,'bkfmt','[kodelokasi][kodetingkat][tahun][nomorauto.5]');
/*!40000 ALTER TABLE `pus_setting` ENABLE KEYS */;
