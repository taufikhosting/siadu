# Host: localhost  (Version: 5.6.20)
# Date: 2015-01-28 15:23:36
# Generator: MySQL-Front 5.3  (Build 4.187)

/*!40101 SET NAMES latin1 */;

#
# Structure for table "hrd_m_agama"
#

DROP TABLE IF EXISTS `hrd_m_agama`;
CREATE TABLE `hrd_m_agama` (
  `replid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `agama` varchar(50) NOT NULL,
  `urut` tinyint(4) NOT NULL DEFAULT '0',
  `keterangan` varchar(200) NOT NULL,
  PRIMARY KEY (`replid`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

#
# Data for table "hrd_m_agama"
#

/*!40000 ALTER TABLE `hrd_m_agama` DISABLE KEYS */;
INSERT INTO `hrd_m_agama` VALUES (1,'Islam',0,''),(2,'Kristen',0,''),(3,'Nasrani',0,''),(4,'Hindu',0,''),(5,'Budha',0,'');
/*!40000 ALTER TABLE `hrd_m_agama` ENABLE KEYS */;
