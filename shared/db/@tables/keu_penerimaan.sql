# Host: localhost  (Version: 5.6.20)
# Date: 2015-01-28 15:32:12
# Generator: MySQL-Front 5.3  (Build 4.187)

/*!40101 SET NAMES latin1 */;

#
# Structure for table "keu_penerimaan"
#

DROP TABLE IF EXISTS `keu_penerimaan`;
CREATE TABLE `keu_penerimaan` (
  `replid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `reftipe` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `refid` int(10) unsigned NOT NULL DEFAULT '0',
  `nominal` decimal(10,0) NOT NULL DEFAULT '0',
  PRIMARY KEY (`replid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

#
# Data for table "keu_penerimaan"
#

/*!40000 ALTER TABLE `keu_penerimaan` DISABLE KEYS */;
/*!40000 ALTER TABLE `keu_penerimaan` ENABLE KEYS */;
