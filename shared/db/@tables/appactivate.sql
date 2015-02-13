# Host: localhost  (Version: 5.6.20)
# Date: 2015-01-28 15:09:15
# Generator: MySQL-Front 5.3  (Build 4.187)

/*!40101 SET NAMES latin1 */;

#
# Structure for table "appactivate"
#

DROP TABLE IF EXISTS `appactivate`;
CREATE TABLE `appactivate` (
  `replid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `app` varchar(10) NOT NULL,
  `user` varchar(20) NOT NULL,
  `kunci` varchar(20) NOT NULL,
  `aktif` enum('1','0') NOT NULL DEFAULT '0',
  PRIMARY KEY (`replid`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

#
# Data for table "appactivate"
#

/*!40000 ALTER TABLE `appactivate` DISABLE KEYS */;
INSERT INTO `appactivate` VALUES (1,'rep','sdvision','W49K71','1');
/*!40000 ALTER TABLE `appactivate` ENABLE KEYS */;
