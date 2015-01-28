# Host: localhost  (Version: 5.6.20)
# Date: 2015-01-28 16:44:59
# Generator: MySQL-Front 5.3  (Build 4.187)

/*!40101 SET NAMES latin1 */;

#
# Structure for table "sar_peminjaman"
#

DROP TABLE IF EXISTS `sar_peminjaman`;
CREATE TABLE `sar_peminjaman` (
  `replid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `lokasi` int(10) unsigned NOT NULL,
  `peminjam` varchar(100) NOT NULL,
  `barang` int(10) unsigned NOT NULL,
  `tanggal1` date NOT NULL DEFAULT '0000-00-00',
  `tanggal2` date NOT NULL DEFAULT '0000-00-00',
  `lokasi_pinjam` int(10) unsigned NOT NULL,
  `lokasi_lain` varchar(250) NOT NULL,
  `tempat` varchar(200) NOT NULL,
  `kondisi` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `keterangan` varchar(250) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`replid`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

#
# Data for table "sar_peminjaman"
#

/*!40000 ALTER TABLE `sar_peminjaman` DISABLE KEYS */;
INSERT INTO `sar_peminjaman` VALUES (1,1,'Kurniawan',5,'2013-09-06','2013-09-07',0,'','',1,'',1),(2,1,'Joko',1,'2013-09-17','2013-09-18',0,'','',1,'',0),(3,1,'Joko',3,'2013-09-17','2013-09-18',0,'','',1,'',1),(4,1,'Hadi',5,'2013-09-17','2013-09-18',0,'','Gudang A',1,'',0),(5,1,'Hadi',16,'2013-09-17','2013-09-18',0,'','Gudang A',1,'',0),(6,1,'Adi',1,'2013-09-17','2013-09-18',0,'','Gudang B',1,'',1),(7,1,'Adi',2,'2013-09-17','2013-09-18',0,'','Gudang B',1,'',1),(8,1,'Sule',11,'2013-09-17','2013-09-18',0,'','Gudang C',1,'Rekomendasi Mr. Parto',1),(9,1,'a',1,'2013-10-22','2013-10-23',0,'','b',1,'',1),(10,1,'a',2,'2013-10-22','2013-10-23',0,'','b',1,'',1),(11,1,'suryo',1,'2014-03-25','2014-03-26',0,'','gedung A',1,'',1);
/*!40000 ALTER TABLE `sar_peminjaman` ENABLE KEYS */;
