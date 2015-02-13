# Host: localhost  (Version: 5.6.20)
# Date: 2015-01-28 15:25:25
# Generator: MySQL-Front 5.3  (Build 4.187)

/*!40101 SET NAMES latin1 */;

#
# Structure for table "hrd_menikah"
#

DROP TABLE IF EXISTS `hrd_menikah`;
CREATE TABLE `hrd_menikah` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `tunjangan` varchar(255) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

#
# Data for table "hrd_menikah"
#

INSERT INTO `hrd_menikah` VALUES (1,'Menikah','0'),(2,'Belum Menikah','0');
