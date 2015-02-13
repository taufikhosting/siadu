# Host: localhost  (Version: 5.6.20)
# Date: 2015-01-28 16:50:10
# Generator: MySQL-Front 5.3  (Build 4.187)

/*!40101 SET NAMES latin1 */;

#
# Structure for table "useronlinemonth"
#

DROP TABLE IF EXISTS `useronlinemonth`;
CREATE TABLE `useronlinemonth` (
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
) ENGINE=MyISAM AUTO_INCREMENT=3878 DEFAULT CHARSET=latin1;

#
# Data for table "useronlinemonth"
#

/*!40000 ALTER TABLE `useronlinemonth` DISABLE KEYS */;
INSERT INTO `useronlinemonth` VALUES (3874,'::1','EICS-PC','::1','',1422087975),(3875,'192.168.10.254','192.168.10.254','192.168.20.114','1.1 ::ffff:192.168.10.254 (Mikrotik HttpProxy)',1422094515),(3876,'192.168.10.12','HRD-PC','192.168.10.12','',1422406254),(3877,'192.168.10.13','HRD','192.168.10.13','',1421822635);
/*!40000 ALTER TABLE `useronlinemonth` ENABLE KEYS */;
