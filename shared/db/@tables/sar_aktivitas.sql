# Host: localhost  (Version: 5.6.20)
# Date: 2015-01-28 16:40:46
# Generator: MySQL-Front 5.3  (Build 4.187)

/*!40101 SET NAMES latin1 */;

#
# Structure for table "sar_aktivitas"
#

DROP TABLE IF EXISTS `sar_aktivitas`;
CREATE TABLE `sar_aktivitas` (
  `replid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tanggal1` date NOT NULL DEFAULT '0000-00-00',
  `tanggal2` date NOT NULL DEFAULT '0000-00-00',
  `aktivitas` text,
  `lokasi` int(10) unsigned NOT NULL,
  `keterangan` varchar(250) NOT NULL,
  `ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`replid`),
  KEY `IX_aktivitas_ts` (`ts`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

#
# Data for table "sar_aktivitas"
#

INSERT INTO `sar_aktivitas` VALUES (8,'2013-08-31','2013-09-02','Pengecekan kondisi barang berkala',2,'','2013-08-31 16:48:51'),(10,'2014-10-03','2014-10-31','Pencucian AC seluruh ruangan dan Mess Guru',1,'','2014-10-22 10:40:14');
