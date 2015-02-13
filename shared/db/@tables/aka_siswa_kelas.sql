# Host: localhost  (Version: 5.6.20)
# Date: 2015-01-29 04:53:17
# Generator: MySQL-Front 5.3  (Build 4.187)

/*!40101 SET NAMES latin1 */;

#
# Structure for table "aka_siswa_kelas"
#

DROP TABLE IF EXISTS `aka_siswa_kelas`;
CREATE TABLE `aka_siswa_kelas` (
  `replid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `siswa` int(10) unsigned NOT NULL,
  `kelas` int(10) unsigned NOT NULL,
  PRIMARY KEY (`replid`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

#
# Data for table "aka_siswa_kelas"
#

/*!40000 ALTER TABLE `aka_siswa_kelas` DISABLE KEYS */;
INSERT INTO `aka_siswa_kelas` VALUES (1,1,1),(2,2,1),(3,4,1),(4,5,2),(5,7,2),(6,1,41),(8,4,41),(10,5,41),(11,7,41),(12,2,101),(15,2,13),(16,2,13),(18,2,41);
/*!40000 ALTER TABLE `aka_siswa_kelas` ENABLE KEYS */;
