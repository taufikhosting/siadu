# Host: localhost  (Version: 5.6.20)
# Date: 2015-01-28 15:24:54
# Generator: MySQL-Front 5.3  (Build 4.187)

/*!40101 SET NAMES latin1 */;

#
# Structure for table "hrd_m_posisi"
#

DROP TABLE IF EXISTS `hrd_m_posisi`;
CREATE TABLE `hrd_m_posisi` (
  `replid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `posisi` varchar(50) NOT NULL,
  `urut` tinyint(4) NOT NULL DEFAULT '0',
  `keterangan` varchar(200) NOT NULL,
  PRIMARY KEY (`replid`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

#
# Data for table "hrd_m_posisi"
#

/*!40000 ALTER TABLE `hrd_m_posisi` DISABLE KEYS */;
INSERT INTO `hrd_m_posisi` VALUES (1,'HRD',0,''),(2,'General Staff',0,''),(3,'Humas',0,'');
/*!40000 ALTER TABLE `hrd_m_posisi` ENABLE KEYS */;
