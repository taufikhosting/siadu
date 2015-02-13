# Host: localhost  (Version: 5.6.20)
# Date: 2015-01-28 15:30:18
# Generator: MySQL-Front 5.3  (Build 4.187)

/*!40101 SET NAMES latin1 */;

#
# Structure for table "keu_modul"
#

DROP TABLE IF EXISTS `keu_modul`;
CREATE TABLE `keu_modul` (
  `replid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `kategori` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `reftipe` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `refid` int(10) unsigned NOT NULL DEFAULT '0',
  `nama` varchar(100) NOT NULL,
  `rek1` int(10) unsigned NOT NULL,
  `rek2` int(10) unsigned NOT NULL,
  `rek3` int(10) unsigned NOT NULL DEFAULT '0',
  `nominal` decimal(10,0) NOT NULL DEFAULT '0',
  `cicilan` decimal(10,0) NOT NULL DEFAULT '0',
  `keterangan` varchar(200) NOT NULL,
  PRIMARY KEY (`replid`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

#
# Data for table "keu_modul"
#

/*!40000 ALTER TABLE `keu_modul` DISABLE KEYS */;
INSERT INTO `keu_modul` VALUES (1,1,1,1,'Uang sekolah tahun ajaran 2014-2015 (Aktif)',0,0,0,0,0,''),(2,3,2,2,'Pendaftaran Tahun Ajaran 2014-2015',14,0,0,0,0,''),(3,3,2,2,'Pendaftaran Tahun Ajaran 2014-2015',6,194,0,0,0,'Kaitlynn Tiffany'),(4,1,3,3,'Uang pangkal angkatan 2013',6,194,29,0,0,'DPP');
/*!40000 ALTER TABLE `keu_modul` ENABLE KEYS */;
