# Host: localhost  (Version: 5.6.20)
# Date: 2015-01-28 15:11:39
# Generator: MySQL-Front 5.3  (Build 4.187)

/*!40101 SET NAMES latin1 */;

#
# Structure for table "hrd_cuti"
#

DROP TABLE IF EXISTS `hrd_cuti`;
CREATE TABLE `hrd_cuti` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `karyawan` int(4) NOT NULL,
  `tahun` varchar(4) NOT NULL,
  `tgl` date NOT NULL,
  `cuti` varchar(512) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

#
# Data for table "hrd_cuti"
#

INSERT INTO `hrd_cuti` VALUES (1,36,'2014','2014-06-26','asdsad'),(3,36,'2014','2014-07-01','Ke Luar Negeri');
