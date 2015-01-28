# Host: localhost  (Version: 5.6.20)
# Date: 2015-01-29 04:46:30
# Generator: MySQL-Front 5.3  (Build 4.187)

/*!40101 SET NAMES utf8 */;

#
# Structure for table "psb_proses"
#

DROP TABLE IF EXISTS `psb_proses`;
CREATE TABLE `psb_proses` (
  `replid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `proses` varchar(100) NOT NULL,
  `kodeawalan` varchar(10) NOT NULL,
  `angkatan` int(10) unsigned NOT NULL DEFAULT '0',
  `tglmulai` date NOT NULL DEFAULT '0000-00-00',
  `tglselesai` date NOT NULL DEFAULT '0000-00-00',
  `kapasitas` int(11) NOT NULL DEFAULT '0',
  `departemen` int(10) unsigned NOT NULL,
  `aktif` enum('1','0') NOT NULL DEFAULT '1',
  `keterangan` varchar(255) DEFAULT NULL,
  `ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tahunajaran` int(11) DEFAULT NULL,
  PRIMARY KEY (`replid`),
  KEY `FK_prosespenerimaansiswa_departemen` (`departemen`),
  KEY `IX_prosespenerimaansiswa_ts` (`ts`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

#
# Data for table "psb_proses"
#

INSERT INTO `psb_proses` VALUES (2,'Tahun Ajaran 2014-2015','PMB2014',2,'0000-00-00','0000-00-00',150,1,'1','','2014-03-19 10:56:34',1),(3,'Tahun Ajaran 2014-2015','PMB2014',0,'0000-00-00','0000-00-00',60,2,'1','','2014-03-19 12:47:48',1),(4,'Tahun Ajaran 2014-2015','PMB2014',5,'0000-00-00','0000-00-00',60,3,'1','','2014-03-19 12:48:23',1),(6,'Tahun Ajaran 2015-2016','PMB2015',7,'0000-00-00','0000-00-00',100,1,'1','','2014-12-09 10:09:22',NULL),(7,'2015-2016','PMB2016',4,'0000-00-00','0000-00-00',500,2,'1','','2015-01-26 09:35:28',NULL),(8,'Tahun Ajaran 2015-2016','PMB2015',6,'0000-00-00','0000-00-00',20,3,'1','','2015-01-26 09:43:28',NULL);
