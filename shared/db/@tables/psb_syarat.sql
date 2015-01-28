# Host: localhost  (Version: 5.6.20)
# Date: 2015-01-29 04:47:01
# Generator: MySQL-Front 5.3  (Build 4.187)

/*!40101 SET NAMES latin1 */;

#
# Structure for table "psb_syarat"
#

DROP TABLE IF EXISTS `psb_syarat`;
CREATE TABLE `psb_syarat` (
  `replid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `syarat` varchar(100) NOT NULL,
  `wajib` enum('1','0') NOT NULL DEFAULT '1',
  `keterangan` varchar(200) NOT NULL,
  PRIMARY KEY (`replid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

#
# Data for table "psb_syarat"
#

/*!40000 ALTER TABLE `psb_syarat` DISABLE KEYS */;
/*!40000 ALTER TABLE `psb_syarat` ENABLE KEYS */;
