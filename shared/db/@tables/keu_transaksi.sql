# Host: localhost  (Version: 5.6.20)
# Date: 2015-01-28 15:33:12
# Generator: MySQL-Front 5.3  (Build 4.187)

/*!40101 SET NAMES latin1 */;

#
# Structure for table "keu_transaksi"
#

DROP TABLE IF EXISTS `keu_transaksi`;
CREATE TABLE `keu_transaksi` (
  `replid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tahunbuku` int(10) unsigned NOT NULL DEFAULT '0',
  `nomer` varchar(50) NOT NULL,
  `nobukti` varchar(50) NOT NULL,
  `tanggal` date NOT NULL DEFAULT '0000-00-00',
  `rekkas` int(10) unsigned NOT NULL DEFAULT '0',
  `rekitem` int(10) unsigned NOT NULL DEFAULT '0',
  `nominal` decimal(10,0) NOT NULL DEFAULT '0',
  `uraian` varchar(250) NOT NULL,
  `modul` int(10) unsigned NOT NULL DEFAULT '0',
  `kategori` int(10) unsigned NOT NULL DEFAULT '0',
  `pembayaran` int(10) unsigned NOT NULL DEFAULT '0',
  `penerimaanbrg` int(10) unsigned NOT NULL DEFAULT '0',
  `jenis` tinyint(4) NOT NULL DEFAULT '0',
  `budget` int(10) unsigned NOT NULL DEFAULT '0',
  `ct` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`replid`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

#
# Data for table "keu_transaksi"
#

/*!40000 ALTER TABLE `keu_transaksi` DISABLE KEYS */;
INSERT INTO `keu_transaksi` VALUES (2,1,'BKM-0001/03/2014','BKM-0001/3/14','2014-03-06',1,193,300000,'Penerimaan dari donatur',0,0,0,0,3,0,1),(3,1,'MMJ-0002/04/2014','','2014-04-07',0,0,0,'Target pendapatan sekolah tahun ajaran 2014-2015.',0,0,0,0,0,0,2),(4,2,'BKK-0003/07/2013','050713','2013-07-05',4,263,100000,'PDAM Juni',0,0,0,0,4,0,3),(5,1,'BKK-0004/04/2014','','2014-04-08',4,263,100000,'PDAM',0,0,0,0,4,0,4),(6,1,'BBM-0005/04/2014','','2014-04-08',14,194,300000,'Pembayaran Pendaftaran Tahun Ajaran 2014-2015.\nCalon siswa: Kaitlynn Tiffany L.. No. pendaftaran: PMB2014140001.',0,3,1,0,2,0,5),(7,1,'BBM-0006/04/2014','','2014-04-08',6,194,300000,'Pembayaran Pendaftaran Tahun Ajaran 2014-2015.\nCalon siswa: Trevor Yongnardi. No. pendaftaran: PMB2014140007.',0,3,2,0,2,0,6),(8,1,'BKK-0007/04/2014','','2014-04-08',4,35,4500000,'komputer',0,0,0,0,4,0,7),(9,1,'MMJ-0008/04/2014','','2014-04-08',0,0,0,'Target pendapatan uang pangkal angkatan 2013.',0,0,0,0,0,0,8);
/*!40000 ALTER TABLE `keu_transaksi` ENABLE KEYS */;
