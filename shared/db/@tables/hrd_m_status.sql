# Host: localhost  (Version: 5.6.20)
# Date: 2015-01-28 15:25:04
# Generator: MySQL-Front 5.3  (Build 4.187)

/*!40101 SET NAMES latin1 */;

#
# Structure for table "hrd_m_status"
#

DROP TABLE IF EXISTS `hrd_m_status`;
CREATE TABLE `hrd_m_status` (
  `replid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `status` varchar(50) NOT NULL,
  `urut` tinyint(4) NOT NULL DEFAULT '0',
  `reminder` int(11) NOT NULL DEFAULT '30',
  `keterangan` varchar(200) NOT NULL,
  PRIMARY KEY (`replid`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

#
# Data for table "hrd_m_status"
#

/*!40000 ALTER TABLE `hrd_m_status` DISABLE KEYS */;
INSERT INTO `hrd_m_status` VALUES (1,'Tetap',0,30,''),(2,'Kontrak',0,30,'');
/*!40000 ALTER TABLE `hrd_m_status` ENABLE KEYS */;
