# Host: localhost  (Version: 5.6.20)
# Date: 2015-01-28 15:24:42
# Generator: MySQL-Front 5.3  (Build 4.187)

/*!40101 SET NAMES latin1 */;

#
# Structure for table "hrd_m_marital"
#

DROP TABLE IF EXISTS `hrd_m_marital`;
CREATE TABLE `hrd_m_marital` (
  `replid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `marital` varchar(50) NOT NULL,
  `urut` tinyint(4) NOT NULL DEFAULT '0',
  `keterangan` varchar(200) NOT NULL,
  PRIMARY KEY (`replid`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

#
# Data for table "hrd_m_marital"
#

/*!40000 ALTER TABLE `hrd_m_marital` DISABLE KEYS */;
INSERT INTO `hrd_m_marital` VALUES (1,'Belum menikah',0,''),(2,'Menikah',0,''),(3,'Duda / Janda',0,'');
/*!40000 ALTER TABLE `hrd_m_marital` ENABLE KEYS */;
