# Host: localhost  (Version: 5.6.20)
# Date: 2015-01-28 15:12:22
# Generator: MySQL-Front 5.3  (Build 4.187)

/*!40101 SET NAMES latin1 */;

#
# Structure for table "hrd_fungsional"
#

DROP TABLE IF EXISTS `hrd_fungsional`;
CREATE TABLE `hrd_fungsional` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL,
  `persen` varchar(50) NOT NULL DEFAULT '0',
  `nominal` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

#
# Data for table "hrd_fungsional"
#

/*!40000 ALTER TABLE `hrd_fungsional` DISABLE KEYS */;
INSERT INTO `hrd_fungsional` VALUES (1,'Tidak Ada','0','0'),(2,'3A','20','0'),(3,'3B','25','0'),(4,'3C','30','0');
/*!40000 ALTER TABLE `hrd_fungsional` ENABLE KEYS */;
