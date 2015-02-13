# Host: localhost  (Version: 5.6.20)
# Date: 2015-01-28 16:49:59
# Generator: MySQL-Front 5.3  (Build 4.187)

/*!40101 SET NAMES latin1 */;

#
# Structure for table "useronlineday"
#

DROP TABLE IF EXISTS `useronlineday`;
CREATE TABLE `useronlineday` (
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
) ENGINE=MyISAM AUTO_INCREMENT=5628 DEFAULT CHARSET=latin1;

#
# Data for table "useronlineday"
#

/*!40000 ALTER TABLE `useronlineday` DISABLE KEYS */;
INSERT INTO `useronlineday` VALUES (5628,'192.168.10.12','HRD-PC','192.168.10.12','',1422406254);
/*!40000 ALTER TABLE `useronlineday` ENABLE KEYS */;
