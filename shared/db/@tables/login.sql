# Host: localhost  (Version: 5.6.20)
# Date: 2015-01-28 15:33:42
# Generator: MySQL-Front 5.3  (Build 4.187)

/*!40101 SET NAMES latin1 */;

#
# Structure for table "login"
#

DROP TABLE IF EXISTS `login`;
CREATE TABLE `login` (
  `id_login` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(128) NOT NULL,
  `id_level` int(11) NOT NULL,
  `pegawai` int(10) unsigned NOT NULL DEFAULT '0',
  `aktif` enum('1','0') NOT NULL DEFAULT '1',
  `bahasa` varchar(2) NOT NULL DEFAULT '',
  `tlogin` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id_login`),
  UNIQUE KEY `username` (`username`),
  KEY `id_level` (`id_level`),
  CONSTRAINT `login_ibfk_1` FOREIGN KEY (`id_level`) REFERENCES `level` (`id_level`) ON DELETE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

#
# Data for table "login"
#

INSERT INTO `login` VALUES (1,'EPI','admin','MjEyMzJmMjk3YTU3YTVhNzQzODk0YTBlNGE4MDFmYzM=',2,0,'1','id','0000-00-00 00:00:00'),(2,'operator','operator','operator',3,0,'1','','0000-00-00 00:00:00');
