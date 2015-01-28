# Host: localhost  (Version: 5.6.20)
# Date: 2015-01-28 15:08:42
# Generator: MySQL-Front 5.3  (Build 4.187)

/*!40101 SET NAMES latin1 */;

#
# Structure for table "aka_tmp_saudara"
#

DROP TABLE IF EXISTS `aka_tmp_saudara`;
CREATE TABLE `aka_tmp_saudara` (
  `replid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `sesid` varchar(40) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `tgllahir` date NOT NULL DEFAULT '0000-00-00',
  `sekolah` varchar(100) NOT NULL,
  PRIMARY KEY (`replid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

#
# Data for table "aka_tmp_saudara"
#

/*!40000 ALTER TABLE `aka_tmp_saudara` DISABLE KEYS */;
/*!40000 ALTER TABLE `aka_tmp_saudara` ENABLE KEYS */;
