# Host: localhost  (Version: 5.6.20)
# Date: 2015-01-28 15:37:19
# Generator: MySQL-Front 5.3  (Build 4.187)

/*!40101 SET NAMES latin1 */;

#
# Structure for table "psb_calonsiswa_syarat"
#

DROP TABLE IF EXISTS `psb_calonsiswa_syarat`;
CREATE TABLE `psb_calonsiswa_syarat` (
  `replid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `calonsiswa` int(10) unsigned NOT NULL,
  `syarat` int(10) unsigned NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`replid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

#
# Data for table "psb_calonsiswa_syarat"
#

/*!40000 ALTER TABLE `psb_calonsiswa_syarat` DISABLE KEYS */;
/*!40000 ALTER TABLE `psb_calonsiswa_syarat` ENABLE KEYS */;
