# Host: localhost  (Version: 5.6.20)
# Date: 2015-01-29 04:49:22
# Generator: MySQL-Front 5.3  (Build 4.187)

/*!40101 SET NAMES latin1 */;

#
# Structure for table "aka_jenismutasi"
#

DROP TABLE IF EXISTS `aka_jenismutasi`;
CREATE TABLE `aka_jenismutasi` (
  `replid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL,
  PRIMARY KEY (`replid`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

#
# Data for table "aka_jenismutasi"
#

/*!40000 ALTER TABLE `aka_jenismutasi` DISABLE KEYS */;
INSERT INTO `aka_jenismutasi` VALUES (1,'Pindah sekolah');
/*!40000 ALTER TABLE `aka_jenismutasi` ENABLE KEYS */;
