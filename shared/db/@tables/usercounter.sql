# Host: localhost  (Version: 5.6.20)
# Date: 2015-01-28 16:49:33
# Generator: MySQL-Front 5.3  (Build 4.187)

/*!40101 SET NAMES latin1 */;

#
# Structure for table "usercounter"
#

DROP TABLE IF EXISTS `usercounter`;
CREATE TABLE `usercounter` (
  `id` tinyint(11) NOT NULL AUTO_INCREMENT,
  `ip` text NOT NULL,
  `counter` int(11) NOT NULL DEFAULT '0',
  `hits` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

#
# Data for table "usercounter"
#

/*!40000 ALTER TABLE `usercounter` DISABLE KEYS */;
INSERT INTO `usercounter` VALUES (1,'192.168.10.13-192.168.10.12-192.168.10.254-127.0.0.1-::1-157.56.92.173-',4,1033);
/*!40000 ALTER TABLE `usercounter` ENABLE KEYS */;
