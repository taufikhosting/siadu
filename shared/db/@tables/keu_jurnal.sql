# Host: localhost  (Version: 5.6.20)
# Date: 2015-01-28 15:29:38
# Generator: MySQL-Front 5.3  (Build 4.187)

/*!40101 SET NAMES latin1 */;

#
# Structure for table "keu_jurnal"
#

DROP TABLE IF EXISTS `keu_jurnal`;
CREATE TABLE `keu_jurnal` (
  `replid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `transaksi` int(10) unsigned NOT NULL,
  `rek` int(10) unsigned NOT NULL,
  `debet` decimal(10,0) NOT NULL DEFAULT '0',
  `kredit` decimal(10,0) NOT NULL DEFAULT '0',
  `ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`replid`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

#
# Data for table "keu_jurnal"
#

/*!40000 ALTER TABLE `keu_jurnal` DISABLE KEYS */;
INSERT INTO `keu_jurnal` VALUES (3,2,1,300000,0,'2014-03-06 05:12:30'),(4,2,193,0,300000,'2014-03-06 05:12:30'),(5,3,0,0,0,'2014-04-07 12:52:06'),(6,3,0,0,0,'2014-04-07 12:52:06'),(7,4,263,100000,0,'2014-04-08 08:55:08'),(8,4,4,0,100000,'2014-04-08 08:55:08'),(9,5,263,100000,0,'2014-04-08 09:31:04'),(10,5,4,0,100000,'2014-04-08 09:31:04'),(11,6,14,300000,0,'2014-04-08 09:48:06'),(12,6,194,0,300000,'2014-04-08 09:48:06'),(13,7,6,300000,0,'2014-04-08 09:53:56'),(14,7,194,0,300000,'2014-04-08 09:53:56'),(15,8,35,4500000,0,'2014-04-08 10:13:10'),(16,8,4,0,4500000,'2014-04-08 10:13:10'),(17,9,29,0,0,'2014-04-08 10:24:11'),(18,9,194,0,0,'2014-04-08 10:24:11');
/*!40000 ALTER TABLE `keu_jurnal` ENABLE KEYS */;
