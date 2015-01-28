# Host: localhost  (Version: 5.6.20)
# Date: 2015-01-28 15:26:25
# Generator: MySQL-Front 5.3  (Build 4.187)

/*!40101 SET NAMES latin1 */;

#
# Structure for table "hrd_pinjaman"
#

DROP TABLE IF EXISTS `hrd_pinjaman`;
CREATE TABLE `hrd_pinjaman` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `tgl` date NOT NULL,
  `pinjaman` varchar(255) NOT NULL,
  `karyawan` int(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

#
# Data for table "hrd_pinjaman"
#

/*!40000 ALTER TABLE `hrd_pinjaman` DISABLE KEYS */;
INSERT INTO `hrd_pinjaman` VALUES (1,'2014-06-02','200000',35),(7,'2014-06-30','100000',35),(12,'2014-07-01','1000000',34),(14,'2014-02-04','500000',36);
/*!40000 ALTER TABLE `hrd_pinjaman` ENABLE KEYS */;
