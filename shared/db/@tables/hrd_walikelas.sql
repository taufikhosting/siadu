# Host: localhost  (Version: 5.6.20)
# Date: 2015-01-28 15:28:32
# Generator: MySQL-Front 5.3  (Build 4.187)

/*!40101 SET NAMES latin1 */;

#
# Structure for table "hrd_walikelas"
#

DROP TABLE IF EXISTS `hrd_walikelas`;
CREATE TABLE `hrd_walikelas` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL,
  `persen` varchar(50) NOT NULL DEFAULT '0',
  `nominal` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

#
# Data for table "hrd_walikelas"
#

/*!40000 ALTER TABLE `hrd_walikelas` DISABLE KEYS */;
INSERT INTO `hrd_walikelas` VALUES (1,'Tidak Ada','0','0'),(2,'Wali Kelas','15','0');
/*!40000 ALTER TABLE `hrd_walikelas` ENABLE KEYS */;
