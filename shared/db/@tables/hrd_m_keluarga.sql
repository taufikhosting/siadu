# Host: localhost  (Version: 5.6.20)
# Date: 2015-01-28 15:24:32
# Generator: MySQL-Front 5.3  (Build 4.187)

/*!40101 SET NAMES latin1 */;

#
# Structure for table "hrd_m_keluarga"
#

DROP TABLE IF EXISTS `hrd_m_keluarga`;
CREATE TABLE `hrd_m_keluarga` (
  `replid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `keluarga` varchar(50) NOT NULL,
  `urut` tinyint(4) NOT NULL DEFAULT '0',
  `keterangan` varchar(200) NOT NULL,
  PRIMARY KEY (`replid`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

#
# Data for table "hrd_m_keluarga"
#

/*!40000 ALTER TABLE `hrd_m_keluarga` DISABLE KEYS */;
INSERT INTO `hrd_m_keluarga` VALUES (1,'Ayah',0,''),(2,'Ibu',0,''),(3,'Suami',0,''),(4,'Istri',0,''),(5,'Anak',0,'');
/*!40000 ALTER TABLE `hrd_m_keluarga` ENABLE KEYS */;
