# Host: localhost  (Version: 5.6.20)
# Date: 2015-01-28 16:49:47
# Generator: MySQL-Front 5.3  (Build 4.187)

/*!40101 SET NAMES latin1 */;

#
# Structure for table "useronline"
#

DROP TABLE IF EXISTS `useronline`;
CREATE TABLE `useronline` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ipproxy` varchar(100) DEFAULT NULL,
  `host` varchar(100) DEFAULT NULL,
  `ipanda` varchar(100) DEFAULT NULL,
  `proxyserver` varchar(100) DEFAULT NULL,
  `timevisit` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `ipanda` (`ipanda`),
  KEY `timevisit` (`timevisit`),
  KEY `ipproxy` (`ipproxy`)
) ENGINE=MyISAM AUTO_INCREMENT=96 DEFAULT CHARSET=latin1;

#
# Data for table "useronline"
#

/*!40000 ALTER TABLE `useronline` DISABLE KEYS */;
INSERT INTO `useronline` VALUES (95,'127.0.0.1','localhost','127.0.0.1','',1321091831);
/*!40000 ALTER TABLE `useronline` ENABLE KEYS */;
