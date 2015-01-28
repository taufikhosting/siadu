# Host: localhost  (Version: 5.6.20)
# Date: 2015-01-28 15:08:32
# Generator: MySQL-Front 5.3  (Build 4.187)

/*!40101 SET NAMES utf8 */;

#
# Structure for table "aka_tingkat"
#

DROP TABLE IF EXISTS `aka_tingkat`;
CREATE TABLE `aka_tingkat` (
  `replid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tingkat` varchar(10) NOT NULL DEFAULT '',
  `tahunajaran` int(10) unsigned NOT NULL DEFAULT '0',
  `keterangan` varchar(255) NOT NULL,
  `urutan` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`replid`),
  KEY `IX_tingkat_ts` (`ts`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

#
# Data for table "aka_tingkat"
#

INSERT INTO `aka_tingkat` VALUES (4,'PG',1,'Playgroup',0,'2014-03-19 11:45:41'),(5,'KG',1,'Kindergarten (TK)',0,'2014-03-19 11:48:34'),(6,'Primary',1,'SD',0,'2014-03-19 11:48:55'),(7,'Secondary',1,'SMP',0,'2014-03-19 11:49:14'),(8,'HS',1,'High School (SMA)',0,'2014-03-19 11:49:27'),(9,'P',2,'Primary',0,'2014-03-19 11:57:13'),(10,'Sec',2,'Secondary',0,'2014-03-19 11:57:25'),(11,'PG',3,'Playgroup',0,'2014-03-19 11:57:42'),(12,'KG',3,'Kindergarten',0,'2014-03-19 11:57:58'),(13,'HS',2,'High School',0,'2014-03-19 12:15:25'),(14,'Toddler',1,'',0,'2014-03-20 11:53:35'),(15,'Toddler',3,'',0,'2014-03-20 11:54:12');
