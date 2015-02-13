# Host: localhost  (Version: 5.6.20)
# Date: 2015-01-29 04:43:56
# Generator: MySQL-Front 5.3  (Build 4.187)

/*!40101 SET NAMES latin1 */;

#
# Structure for table "psb_angsuran"
#

DROP TABLE IF EXISTS `psb_angsuran`;
CREATE TABLE `psb_angsuran` (
  `replid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cicilan` int(11) NOT NULL,
  `keterangan` varchar(200) NOT NULL,
  PRIMARY KEY (`replid`,`cicilan`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

#
# Data for table "psb_angsuran"
#

/*!40000 ALTER TABLE `psb_angsuran` DISABLE KEYS */;
INSERT INTO `psb_angsuran` VALUES (1,1,'in house pertama'),(2,2,'in house kedua'),(3,3,'in house ketiga'),(4,4,''),(5,5,''),(6,6,''),(7,7,''),(8,8,''),(9,9,''),(10,10,''),(11,11,''),(12,12,'');
/*!40000 ALTER TABLE `psb_angsuran` ENABLE KEYS */;
