# Host: localhost  (Version: 5.6.20)
# Date: 2015-01-28 15:27:59
# Generator: MySQL-Front 5.3  (Build 4.187)

/*!40101 SET NAMES latin1 */;

#
# Structure for table "hrd_training"
#

DROP TABLE IF EXISTS `hrd_training`;
CREATE TABLE `hrd_training` (
  `replid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `jenistraining` tinyint(4) NOT NULL DEFAULT '0',
  `penyelenggara` varchar(100) NOT NULL,
  `judul` varchar(250) NOT NULL,
  `pembicara` varchar(100) NOT NULL,
  `tempat` varchar(100) NOT NULL,
  `tgl1` date NOT NULL DEFAULT '0000-00-00',
  `tgl2` date NOT NULL DEFAULT '0000-00-00',
  `peserta` text NOT NULL,
  PRIMARY KEY (`replid`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

#
# Data for table "hrd_training"
#

/*!40000 ALTER TABLE `hrd_training` DISABLE KEYS */;
INSERT INTO `hrd_training` VALUES (1,2,'asd','asd','Jhonny','123','2014-02-01','2014-02-16','Pegawai IT');
/*!40000 ALTER TABLE `hrd_training` ENABLE KEYS */;
