# Host: localhost  (Version: 5.6.20)
# Date: 2015-01-28 16:01:10
# Generator: MySQL-Front 5.3  (Build 4.187)

/*!40101 SET NAMES latin1 */;

#
# Structure for table "rep_grup"
#

DROP TABLE IF EXISTS `rep_grup`;
CREATE TABLE `rep_grup` (
  `replid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uname` varchar(30) NOT NULL,
  `passwd` varchar(30) NOT NULL,
  `level` tinyint(4) NOT NULL DEFAULT '2',
  PRIMARY KEY (`replid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

#
# Data for table "rep_grup"
#

/*!40000 ALTER TABLE `rep_grup` DISABLE KEYS */;
/*!40000 ALTER TABLE `rep_grup` ENABLE KEYS */;
