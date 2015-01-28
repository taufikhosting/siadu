# Host: localhost  (Version: 5.6.20)
# Date: 2015-01-28 15:23:46
# Generator: MySQL-Front 5.3  (Build 4.187)

/*!40101 SET NAMES latin1 */;

#
# Structure for table "hrd_m_bagian"
#

DROP TABLE IF EXISTS `hrd_m_bagian`;
CREATE TABLE `hrd_m_bagian` (
  `replid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `bagian` varchar(50) NOT NULL,
  `urut` tinyint(4) NOT NULL DEFAULT '0',
  `keterangan` varchar(200) NOT NULL,
  PRIMARY KEY (`replid`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

#
# Data for table "hrd_m_bagian"
#

/*!40000 ALTER TABLE `hrd_m_bagian` DISABLE KEYS */;
INSERT INTO `hrd_m_bagian` VALUES (1,'Akademik',0,'Guru, mentor, dan staff pegajar'),(2,'Non Akademik',0,'Staff umum, dan bagian lain');
/*!40000 ALTER TABLE `hrd_m_bagian` ENABLE KEYS */;
