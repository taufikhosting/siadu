# Host: localhost  (Version: 5.6.20)
# Date: 2015-01-28 16:42:29
# Generator: MySQL-Front 5.3  (Build 4.187)

/*!40101 SET NAMES latin1 */;

#
# Structure for table "sar_dpeminjaman"
#

DROP TABLE IF EXISTS `sar_dpeminjaman`;
CREATE TABLE `sar_dpeminjaman` (
  `replid` int(11) NOT NULL AUTO_INCREMENT,
  `peminjaman` int(11) NOT NULL,
  `barang` int(11) NOT NULL,
  `tgl_kembali` date NOT NULL,
  `status` int(2) NOT NULL,
  PRIMARY KEY (`replid`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=latin1;

#
# Data for table "sar_dpeminjaman"
#

INSERT INTO `sar_dpeminjaman` VALUES (23,14,11,'2014-12-17',0),(24,14,74,'2014-12-17',0),(25,15,11,'2014-12-17',0),(26,16,394,'2014-12-17',0),(27,16,427,'2014-12-17',0),(28,16,251,'2014-12-17',0),(29,17,65,'2014-12-17',0),(30,17,415,'2014-12-17',0),(31,17,10,'2014-12-17',0),(32,18,65,'2014-12-17',0),(33,18,11,'2014-12-17',0),(34,19,65,'2014-12-22',0),(35,19,67,'2014-12-23',0),(36,20,65,'0000-00-00',0),(37,20,75,'0000-00-00',0),(38,20,245,'2014-12-27',0);
