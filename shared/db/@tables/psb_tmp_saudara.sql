# Host: localhost  (Version: 5.6.20)
# Date: 2015-01-29 04:47:20
# Generator: MySQL-Front 5.3  (Build 4.187)

/*!40101 SET NAMES latin1 */;

#
# Structure for table "psb_tmp_saudara"
#

DROP TABLE IF EXISTS `psb_tmp_saudara`;
CREATE TABLE `psb_tmp_saudara` (
  `replid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `sesid` varchar(40) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `tgllahir` date NOT NULL DEFAULT '0000-00-00',
  `sekolah` varchar(100) NOT NULL,
  PRIMARY KEY (`replid`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

#
# Data for table "psb_tmp_saudara"
#

/*!40000 ALTER TABLE `psb_tmp_saudara` DISABLE KEYS */;
INSERT INTO `psb_tmp_saudara` VALUES (7,'8stsvc8fgc2d77gch0jgm8ona2','Raden Aditya Putra','0000-00-00','Elyon Sukomanunggal'),(8,'8stsvc8fgc2d77gch0jgm8ona2','Firman Agung Satria','0000-00-00','Elyon Sukomanunggal');
/*!40000 ALTER TABLE `psb_tmp_saudara` ENABLE KEYS */;
