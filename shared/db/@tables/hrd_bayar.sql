# Host: localhost  (Version: 5.6.20)
# Date: 2015-01-28 15:10:52
# Generator: MySQL-Front 5.3  (Build 4.187)

/*!40101 SET NAMES latin1 */;

#
# Structure for table "hrd_bayar"
#

DROP TABLE IF EXISTS `hrd_bayar`;
CREATE TABLE `hrd_bayar` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `tgl` date NOT NULL,
  `bayar` varchar(255) NOT NULL,
  `karyawan` int(4) NOT NULL DEFAULT '0',
  `pid` int(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

#
# Data for table "hrd_bayar"
#

/*!40000 ALTER TABLE `hrd_bayar` DISABLE KEYS */;
INSERT INTO `hrd_bayar` VALUES (1,'2014-06-30','120000',35,1),(3,'2014-06-30','80000',35,1),(5,'2014-06-30','100000',35,7),(6,'2014-07-02','250000',34,12),(14,'2014-07-15','250000',36,14),(15,'2014-11-07','750000',34,12);
/*!40000 ALTER TABLE `hrd_bayar` ENABLE KEYS */;
