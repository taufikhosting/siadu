# Host: localhost  (Version: 5.6.20)
# Date: 2015-01-28 15:23:58
# Generator: MySQL-Front 5.3  (Build 4.187)

/*!40101 SET NAMES latin1 */;

#
# Structure for table "hrd_m_dokumen"
#

DROP TABLE IF EXISTS `hrd_m_dokumen`;
CREATE TABLE `hrd_m_dokumen` (
  `replid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `dokumen` varchar(50) NOT NULL,
  `urut` tinyint(4) NOT NULL DEFAULT '0',
  `reminder` int(11) NOT NULL DEFAULT '30',
  `keterangan` varchar(200) NOT NULL,
  PRIMARY KEY (`replid`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

#
# Data for table "hrd_m_dokumen"
#

/*!40000 ALTER TABLE `hrd_m_dokumen` DISABLE KEYS */;
INSERT INTO `hrd_m_dokumen` VALUES (1,'VISA',0,30,'');
/*!40000 ALTER TABLE `hrd_m_dokumen` ENABLE KEYS */;
