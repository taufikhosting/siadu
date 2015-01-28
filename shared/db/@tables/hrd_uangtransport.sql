# Host: localhost  (Version: 5.6.20)
# Date: 2015-01-28 15:28:21
# Generator: MySQL-Front 5.3  (Build 4.187)

/*!40101 SET NAMES latin1 */;

#
# Structure for table "hrd_uangtransport"
#

DROP TABLE IF EXISTS `hrd_uangtransport`;
CREATE TABLE `hrd_uangtransport` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL,
  `persen` varchar(50) NOT NULL DEFAULT '0',
  `nominal` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

#
# Data for table "hrd_uangtransport"
#

/*!40000 ALTER TABLE `hrd_uangtransport` DISABLE KEYS */;
INSERT INTO `hrd_uangtransport` VALUES (1,'Uang Transport','5','0');
/*!40000 ALTER TABLE `hrd_uangtransport` ENABLE KEYS */;
