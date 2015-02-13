# Host: localhost  (Version: 5.6.20)
# Date: 2015-01-28 15:11:03
# Generator: MySQL-Front 5.3  (Build 4.187)

/*!40101 SET NAMES latin1 */;

#
# Structure for table "hrd_bebantugas"
#

DROP TABLE IF EXISTS `hrd_bebantugas`;
CREATE TABLE `hrd_bebantugas` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL,
  `persen` varchar(50) NOT NULL DEFAULT '0',
  `nominal` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

#
# Data for table "hrd_bebantugas"
#

/*!40000 ALTER TABLE `hrd_bebantugas` DISABLE KEYS */;
INSERT INTO `hrd_bebantugas` VALUES (1,'Tidak Ada','0','0'),(2,'SD_1,2,3','10','0'),(3,'SD_4-6','15','0'),(4,'G-7','25','0');
/*!40000 ALTER TABLE `hrd_bebantugas` ENABLE KEYS */;
