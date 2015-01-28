# Host: localhost  (Version: 5.6.20)
# Date: 2015-01-28 15:28:09
# Generator: MySQL-Front 5.3  (Build 4.187)

/*!40101 SET NAMES latin1 */;

#
# Structure for table "hrd_uangmakan"
#

DROP TABLE IF EXISTS `hrd_uangmakan`;
CREATE TABLE `hrd_uangmakan` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL,
  `persen` varchar(50) NOT NULL DEFAULT '0',
  `nominal` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

#
# Data for table "hrd_uangmakan"
#

/*!40000 ALTER TABLE `hrd_uangmakan` DISABLE KEYS */;
INSERT INTO `hrd_uangmakan` VALUES (1,'Tidak Ada','5','0');
/*!40000 ALTER TABLE `hrd_uangmakan` ENABLE KEYS */;
