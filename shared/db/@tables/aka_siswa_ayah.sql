# Host: localhost  (Version: 5.6.20)
# Date: 2015-01-29 04:51:54
# Generator: MySQL-Front 5.3  (Build 4.187)

/*!40101 SET NAMES latin1 */;

#
# Structure for table "aka_siswa_ayah"
#

DROP TABLE IF EXISTS `aka_siswa_ayah`;
CREATE TABLE `aka_siswa_ayah` (
  `replid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `siswa` int(10) unsigned NOT NULL,
  `nama` varchar(100) NOT NULL,
  `tmplahir` varchar(50) NOT NULL,
  `tgllahir` date NOT NULL,
  `agama` int(10) unsigned NOT NULL DEFAULT '0',
  `warga` varchar(50) NOT NULL,
  `pendidikan` varchar(50) NOT NULL,
  `pekerjaan` varchar(50) NOT NULL,
  `penghasilan` decimal(10,0) NOT NULL DEFAULT '0',
  `telpon` varchar(20) NOT NULL,
  `pinbb` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  PRIMARY KEY (`replid`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

#
# Data for table "aka_siswa_ayah"
#

/*!40000 ALTER TABLE `aka_siswa_ayah` DISABLE KEYS */;
INSERT INTO `aka_siswa_ayah` VALUES (1,1,'','','0000-00-00',0,'','','',0,'','',''),(2,2,'','','0000-00-00',0,'','','',0,'','',''),(4,4,'','','0000-00-00',0,'','','',0,'','',''),(5,5,'','','0000-00-00',0,'','','',0,'','',''),(7,7,'','','0000-00-00',0,'','','',0,'','',''),(11,10,'','','0000-00-00',0,'','','',0,'','',''),(14,13,'','','0000-00-00',0,'','','',0,'','',''),(15,14,'Denny Osmond Nugroho','','0000-00-00',0,'Indonesia','','',0,'085746047047','',''),(16,15,'Lie Teng','','0000-00-00',0,'Indonesia','','',0,'083856083916','',''),(17,16,'Denny Tanujaya','','0000-00-00',0,'Indonesia','','',0,'03170109151','',''),(18,17,'Luvit Njoto Kusuma Prawirodiarjo','','0000-00-00',0,'Indonesia','','',0,'08123572896','',''),(19,18,'Richard Sebastian Ho','','0000-00-00',0,'Indonesia','','',0,'0818398989','',''),(20,19,'Tony Yongnardi','','0000-00-00',0,'','','',0,'081357676734','',''),(21,20,'Kurniawan','','0000-00-00',0,'','','',0,'08123181606','',''),(22,21,'Richard Sebastian Ho','Surabaya','1972-06-30',0,'Indonesia','','Karyawan Swasta',0,'0818398989','',''),(23,22,'Budijanto Hertanto','','0000-00-00',0,'','','',0,'0811322223','',''),(24,23,'Iwan Aditiarsa','','0000-00-00',0,'','','',0,'081553515758','',''),(25,24,'Yudi Satrio','','0000-00-00',0,'','','Karyawan',0,'0818399688','',''),(26,25,'Hendrik Sia','','0000-00-00',0,'','','',0,'081524101200','',''),(27,26,'Budiyono Hutomo','','0000-00-00',0,'','','',0,'081259335967','',''),(28,27,'Yusak Wijaya','','0000-00-00',0,'','','',0,'085282369888','',''),(29,28,'Johny K. Muniaga','','0000-00-00',0,'','','',0,'081330404983','',''),(30,29,'Stefanus Devi Gunawan','','0000-00-00',0,'','','',0,'0811315757','',''),(31,30,'Jhonny','','0000-00-00',0,'','','',0,'081357545517','',''),(32,31,'David Martosentono','','0000-00-00',0,'','','',0,'087775746250','',''),(33,32,'Fianto Anthonius','','0000-00-00',0,'','','',0,'0811373629','',''),(34,33,'Jonatan Halim Tjandra','','0000-00-00',0,'','','',0,'08113417708','',''),(35,34,'Wijaya','','0000-00-00',0,'','','',0,'08165446888','',''),(36,35,'Haryanto','','0000-00-00',0,'','','',0,'0816531435','',''),(37,36,'Levi Lee Ie Thien','','0000-00-00',0,'','','',0,'08123536170','',''),(38,37,'Tjondrosusilo','','0000-00-00',0,'','','',0,'08123599672','',''),(39,38,'Puguh Kris Hermawan','','0000-00-00',0,'','','',0,'088217131582','',''),(40,39,'Ervan Wiryawan Chan','','0000-00-00',0,'','','',0,'08179387001','',''),(41,40,'Hudiono Gunawan','','0000-00-00',0,'','','',0,'08123002833','',''),(42,41,'Christian Adiwinata','','0000-00-00',0,'','','',0,'081330502080','',''),(43,42,'Willy Tejokusumo','','0000-00-00',0,'','','',0,'081282029666','',''),(44,43,'Lo Senjaya Dwi Wicaksono','','0000-00-00',0,'','','',0,'','',''),(45,44,'Tony Yongnardi','Surabaya','1975-12-26',0,'Indonesian','','Merchant',0,'081357676734','',''),(46,45,'Aric','','0000-00-00',0,'Indonesia','','',0,'081230234566','','');
/*!40000 ALTER TABLE `aka_siswa_ayah` ENABLE KEYS */;
