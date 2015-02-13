# Host: localhost  (Version: 5.6.20)
# Date: 2015-01-28 16:44:28
# Generator: MySQL-Front 5.3  (Build 4.187)

/*!40101 SET NAMES latin1 */;

#
# Structure for table "sar_lokasi"
#

DROP TABLE IF EXISTS `sar_lokasi`;
CREATE TABLE `sar_lokasi` (
  `replid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `kode` varchar(3) NOT NULL DEFAULT '',
  `nama` varchar(100) NOT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `telpon` varchar(100) DEFAULT NULL,
  `kontak` varchar(100) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`replid`),
  UNIQUE KEY `REPL_ID` (`kode`),
  KEY `IX_penerbit_ts` (`ts`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

#
# Data for table "sar_lokasi"
#

INSERT INTO `sar_lokasi` VALUES (1,'020','Suko','Jl. Raya Sukomanunggal Jaya No. 33 A Surabaya',NULL,'031-7325999','Ferry \nNo Hp : 081232696977','2013-09-01 08:19:30'),(2,'030','Kertajaya','Jl. Kertajaya Indah Timur VII no 41 Surabaya',NULL,'031-5944944','Yosi','2013-09-02 09:47:42'),(3,'040','Rungkut','Blok A 25-30 (Gedung Lama)',NULL,'Sahat','No Hp : 085232548949','2014-03-25 08:45:57'),(4,'050','Rungkut','Blok N No 36-37 Surabaya (Gedung Baru)',NULL,'','Sahat\nHP :','2014-03-25 08:51:31');
