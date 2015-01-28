# Host: localhost  (Version: 5.6.20)
# Date: 2015-01-28 15:37:41
# Generator: MySQL-Front 5.3  (Build 4.187)

/*!40101 SET NAMES latin1 */;

#
# Structure for table "psb_golongan"
#

DROP TABLE IF EXISTS `psb_golongan`;
CREATE TABLE `psb_golongan` (
  `replid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `golongan` varchar(150) DEFAULT NULL,
  `keterangan` varchar(250) DEFAULT NULL,
  `urut` int(10) unsigned DEFAULT '1',
  UNIQUE KEY `replid` (`replid`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

#
# Data for table "psb_golongan"
#

/*!40000 ALTER TABLE `psb_golongan` DISABLE KEYS */;
INSERT INTO `psb_golongan` VALUES (1,'Anak Guru & Staf','Anak guru, staf, karyawan aktif Elyon dengan masa kerja lebih dari 2 tahun',1),(2,'Umum','Masyarakat umum',1),(3,'Jemaat Elyon','Anggota jemaat GKA Elyon',1),(4,'Anak Hamba Tuhan','Anak hamba Tuhan, Pendeta aktif dari gereja lain.',1),(5,'Anak Pengurus PPKE','Anak Pengurus aktif dari Perhimpunan Pendidikan Kristen Elyon',1),(6,'Jalur Prestasi','Akademik, sports, musik',1),(7,'Anak Guru & Staf','Anak guru, staf, karyawan aktif Elyon dengan masa kerja kurang dan sama dengan 2 tahun',1);
/*!40000 ALTER TABLE `psb_golongan` ENABLE KEYS */;
