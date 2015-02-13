# Host: localhost  (Version: 5.6.20)
# Date: 2015-01-28 15:25:51
# Generator: MySQL-Front 5.3  (Build 4.187)

/*!40101 SET NAMES latin1 */;

#
# Structure for table "hrd_pendidikan"
#

DROP TABLE IF EXISTS `hrd_pendidikan`;
CREATE TABLE `hrd_pendidikan` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `tunjangan` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

#
# Data for table "hrd_pendidikan"
#

INSERT INTO `hrd_pendidikan` VALUES (3,'SMA','0'),(4,'S1','0'),(5,'S2','0'),(6,'S3','0'),(7,'D1','0'),(8,'D2','0'),(9,'D3','0'),(10,'D4','0');
