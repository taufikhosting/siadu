# Host: localhost  (Version: 5.6.20)
# Date: 2015-01-28 15:11:16
# Generator: MySQL-Front 5.3  (Build 4.187)

/*!40101 SET NAMES latin1 */;

#
# Structure for table "hrd_berkas"
#

DROP TABLE IF EXISTS `hrd_berkas`;
CREATE TABLE `hrd_berkas` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `gambar` varchar(200) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `karyawan` int(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

#
# Data for table "hrd_berkas"
#

/*!40000 ALTER TABLE `hrd_berkas` DISABLE KEYS */;
/*!40000 ALTER TABLE `hrd_berkas` ENABLE KEYS */;
