# Host: localhost  (Version: 5.6.20)
# Date: 2015-01-28 15:26:55
# Generator: MySQL-Front 5.3  (Build 4.187)

/*!40101 SET NAMES latin1 */;

#
# Structure for table "hrd_statuskaryawan"
#

DROP TABLE IF EXISTS `hrd_statuskaryawan`;
CREATE TABLE `hrd_statuskaryawan` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `tunjangan` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

#
# Data for table "hrd_statuskaryawan"
#

INSERT INTO `hrd_statuskaryawan` VALUES (3,'Tetap','0'),(8,'Part Time','0'),(9,'Kontrak','0');
