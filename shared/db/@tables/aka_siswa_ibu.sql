# Host: localhost  (Version: 5.6.20)
# Date: 2015-01-28 15:05:51
# Generator: MySQL-Front 5.3  (Build 4.187)

/*!40101 SET NAMES latin1 */;

#
# Structure for table "aka_siswa_ibu"
#

DROP TABLE IF EXISTS `aka_siswa_ibu`;
CREATE TABLE `aka_siswa_ibu` (
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
# Data for table "aka_siswa_ibu"
#

/*!40000 ALTER TABLE `aka_siswa_ibu` DISABLE KEYS */;
INSERT INTO `aka_siswa_ibu` VALUES (1,1,'','','0000-00-00',0,'','','',0,'','',''),(2,2,'','','0000-00-00',0,'','','',0,'','',''),(4,4,'','','0000-00-00',0,'','','',0,'','',''),(5,5,'','','0000-00-00',0,'','','',0,'','',''),(7,7,'','','0000-00-00',0,'','','',0,'','',''),(11,10,'','','0000-00-00',0,'','','',0,'','',''),(14,13,'','','0000-00-00',0,'','','',0,'','',''),(15,14,'Astried Aprilia','','0000-00-00',0,'Indonesia','','',0,'085645437208','',''),(16,15,'Anita Alamsjah','','0000-00-00',0,'Indonesia','','',0,'083856083916','',''),(17,16,'Moona Wintoro','','0000-00-00',0,'Indonesia','','',0,'08563478824','',''),(18,17,'Chynthia','','0000-00-00',0,'Indonesia','','',0,'03170704437','',''),(19,18,'Susana','','0000-00-00',0,'Indonesia','','',0,'085706331688','',''),(20,19,'Elshin Imelda','','0000-00-00',0,'','','',0,'085731316399','',''),(21,20,'Yuliana Dermawan Kang','','0000-00-00',0,'','','',0,'08123567125','',''),(22,21,'Susana','Kediri','1981-03-28',0,'Indonesia','','Apoteker',0,'085706331688','',''),(23,22,'Santi Rahayu','','0000-00-00',0,'','','',0,'','',''),(24,23,'Silviana Alim','','0000-00-00',0,'','','',0,'','',''),(25,24,'Shanty Kurniawaty','','0000-00-00',0,'','','',0,'','',''),(26,25,'Annie Susatya','','0000-00-00',0,'','','',0,'0816511200','',''),(27,26,'Sylvi','','0000-00-00',0,'','','',0,'','',''),(28,27,'Jois Esther','','0000-00-00',0,'','','',0,'','',''),(29,28,'Leli Yuliani','','0000-00-00',0,'','','',0,'081330682001','',''),(30,29,'Christina','','0000-00-00',0,'','','',0,'081222665757','',''),(31,30,'Aily','','0000-00-00',0,'','','',0,'08973813132','',''),(32,31,'Veronica L','','0000-00-00',0,'','','',0,'','',''),(33,32,'Yeny Kosalea','','0000-00-00',0,'','','',0,'08883200715','',''),(34,33,'Nova Renita E','','0000-00-00',0,'','','',0,'','',''),(35,34,'Ria Paulin','','0000-00-00',0,'','','',0,'081553305585','',''),(36,35,'Yunita Kwee','','0000-00-00',0,'','','',0,'','',''),(37,36,'Linawati Tanoyo','','0000-00-00',0,'','','',0,'','',''),(38,37,'Yenni Kurniawan H','','0000-00-00',0,'','','',0,'','',''),(39,38,'Yossy Ana S','','0000-00-00',0,'','','',0,'08783003919','',''),(40,39,'Djawi Cecilia','','0000-00-00',0,'','','',0,'08561198898','',''),(41,40,'Caecilia Anastasia','','0000-00-00',0,'','','',0,'','',''),(42,41,'Desy Susanti','','0000-00-00',0,'','','',0,'0818515305','',''),(43,42,'Ellywati Tanjung','','0000-00-00',0,'','','',0,'08123021424','',''),(44,43,'Anneke F. Ramlan Wilianto','','0000-00-00',0,'','','',0,'08563350089','',''),(45,44,'Elshin Imelda','Surabaya','1979-11-23',0,'Indonesian','','House Wife',0,'085731316399','','');
/*!40000 ALTER TABLE `aka_siswa_ibu` ENABLE KEYS */;
