# Host: localhost  (Version: 5.6.20)
# Date: 2015-01-28 15:25:14
# Generator: MySQL-Front 5.3  (Build 4.187)

/*!40101 SET NAMES latin1 */;

#
# Structure for table "hrd_m_tingkat"
#

DROP TABLE IF EXISTS `hrd_m_tingkat`;
CREATE TABLE `hrd_m_tingkat` (
  `replid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tingkat` varchar(50) NOT NULL,
  `urut` tinyint(4) NOT NULL DEFAULT '0',
  `keterangan` varchar(200) NOT NULL,
  PRIMARY KEY (`replid`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

#
# Data for table "hrd_m_tingkat"
#

/*!40000 ALTER TABLE `hrd_m_tingkat` DISABLE KEYS */;
INSERT INTO `hrd_m_tingkat` VALUES (1,'General staff',0,''),(2,'Manager',0,''),(3,'Staff',0,'');
/*!40000 ALTER TABLE `hrd_m_tingkat` ENABLE KEYS */;
