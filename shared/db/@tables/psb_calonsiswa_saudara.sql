# Host: localhost  (Version: 5.6.20)
# Date: 2015-01-29 04:44:59
# Generator: MySQL-Front 5.3  (Build 4.187)

/*!40101 SET NAMES latin1 */;

#
# Structure for table "psb_calonsiswa_saudara"
#

DROP TABLE IF EXISTS `psb_calonsiswa_saudara`;
CREATE TABLE `psb_calonsiswa_saudara` (
  `replid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `calonsiswa` int(10) unsigned NOT NULL,
  `nama` varchar(100) NOT NULL,
  `tgllahir` date NOT NULL,
  `sekolah` varchar(50) NOT NULL,
  PRIMARY KEY (`replid`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

#
# Data for table "psb_calonsiswa_saudara"
#

/*!40000 ALTER TABLE `psb_calonsiswa_saudara` DISABLE KEYS */;
INSERT INTO `psb_calonsiswa_saudara` VALUES (3,49,'Geoffrey Daniel Ong','2006-05-13','Elyon International Christian School'),(4,41,'Regina Soempiet','2006-06-12','Elyon International Christian School'),(5,44,'Davide William Susanto','2006-12-01','Elyon International Christian School');
/*!40000 ALTER TABLE `psb_calonsiswa_saudara` ENABLE KEYS */;
