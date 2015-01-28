# Host: localhost  (Version: 5.6.20)
# Date: 2015-01-28 15:00:17
# Generator: MySQL-Front 5.3  (Build 4.187)

/*!40101 SET NAMES latin1 */;

#
# Structure for table "aka_daftarnilai"
#

DROP TABLE IF EXISTS `aka_daftarnilai`;
CREATE TABLE `aka_daftarnilai` (
  `replid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `penilaian` int(10) unsigned NOT NULL,
  `siswa` int(10) unsigned NOT NULL,
  `nilai` float NOT NULL DEFAULT '0',
  `keterangan` varchar(100) NOT NULL,
  PRIMARY KEY (`replid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

#
# Data for table "aka_daftarnilai"
#

/*!40000 ALTER TABLE `aka_daftarnilai` DISABLE KEYS */;
/*!40000 ALTER TABLE `aka_daftarnilai` ENABLE KEYS */;
