# Host: localhost  (Version: 5.6.20)
# Date: 2015-01-28 15:27:26
# Generator: MySQL-Front 5.3  (Build 4.187)

/*!40101 SET NAMES latin1 */;

#
# Structure for table "hrd_tipe"
#

DROP TABLE IF EXISTS `hrd_tipe`;
CREATE TABLE `hrd_tipe` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `tipe` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

#
# Data for table "hrd_tipe"
#

INSERT INTO `hrd_tipe` VALUES (1,'Aktif'),(2,'Resign'),(3,'Calon');
