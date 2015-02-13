# Host: localhost  (Version: 5.6.20)
# Date: 2015-01-28 15:09:33
# Generator: MySQL-Front 5.3  (Build 4.187)

/*!40101 SET NAMES utf8 */;

#
# Structure for table "departemen"
#

DROP TABLE IF EXISTS `departemen`;
CREATE TABLE `departemen` (
  `replid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL,
  `kepsek` int(10) unsigned NOT NULL DEFAULT '0',
  `urut` int(10) unsigned NOT NULL DEFAULT '1',
  `keterangan` varchar(255) NOT NULL,
  `alamat` varchar(300) NOT NULL,
  `telepon` varchar(30) NOT NULL,
  `photo` blob NOT NULL,
  `ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`replid`),
  UNIQUE KEY `UX_departemen_replid` (`replid`),
  UNIQUE KEY `departemen` (`nama`),
  KEY `FK_departemen_pegawai` (`kepsek`),
  KEY `IX_departemen_ts` (`ts`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

#
# Data for table "departemen"
#

INSERT INTO `departemen` VALUES (1,'Elyon Sukomanunggal',0,1,'','Jl. Raya Sukomanunggal Jaya 33A','(031)732-5999',X'','2014-01-22 06:50:40'),(2,'Elyon Rungkut',0,2,'','Ruko Rungkut Megah Raya A-25, Jl. Raya Kali Rungkut No. 5','(031)879-8896',X'','2014-01-24 09:14:27'),(3,'Elyon Kertajaya',0,3,'','Jl. Kertajaya Indah Timur VII/41','(031)599-4994',X'','2014-01-24 09:14:34');
