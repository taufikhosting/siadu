# Host: localhost  (Version: 5.6.20)
# Date: 2015-01-29 04:47:28
# Generator: MySQL-Front 5.3  (Build 4.187)

/*!40101 SET NAMES latin1 */;

#
# Structure for table "pus_bahasa"
#

DROP TABLE IF EXISTS `pus_bahasa`;
CREATE TABLE `pus_bahasa` (
  `replid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `kode` varchar(10) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `keterangan` varchar(200) NOT NULL,
  PRIMARY KEY (`replid`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

#
# Data for table "pus_bahasa"
#

/*!40000 ALTER TABLE `pus_bahasa` DISABLE KEYS */;
INSERT INTO `pus_bahasa` VALUES (1,'IND','Indonesia',''),(2,'ENG','English',''),(3,'CHI','Chinese',''),(4,'BI-ENG','Dwibahasa BI-English','BILINGUAL'),(5,'ENG-BI','Bilingual English BI','BILINGUAL'),(6,'M-BI-ENG','Mandarin -BI- English',''),(7,'M-BI','Bilingual Mandaring -BI',''),(8,'ME','Bilingual Mandarin English','');
/*!40000 ALTER TABLE `pus_bahasa` ENABLE KEYS */;
