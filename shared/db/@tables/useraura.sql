# Host: localhost  (Version: 5.6.20)
# Date: 2015-01-28 16:49:18
# Generator: MySQL-Front 5.3  (Build 4.187)

/*!40101 SET NAMES latin1 */;

#
# Structure for table "useraura"
#

DROP TABLE IF EXISTS `useraura`;
CREATE TABLE `useraura` (
  `UserId` int(15) NOT NULL AUTO_INCREMENT,
  `user` varchar(250) NOT NULL DEFAULT '',
  `password` text NOT NULL,
  `email` varchar(250) NOT NULL DEFAULT '',
  `avatar` varchar(250) NOT NULL DEFAULT '',
  `level` enum('Administrator') NOT NULL DEFAULT 'Administrator',
  `tipe` varchar(250) NOT NULL DEFAULT '',
  `is_online` int(5) NOT NULL DEFAULT '0',
  `last_ping` text NOT NULL,
  `start` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `exp` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `biodata` text NOT NULL,
  PRIMARY KEY (`UserId`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

#
# Data for table "useraura"
#

/*!40000 ALTER TABLE `useraura` DISABLE KEYS */;
INSERT INTO `useraura` VALUES (1,'admin','21232f297a57a5a743894a0e4a801fc3','reky@teamworks.co.id','af0675a9e843c6c8f78163a9118efc78.jpg','Administrator','aktif',1,'2015-01-28 07:51:01','2010-08-27 00:00:00','2034-08-27 00:00:00','<p><b>none</b></p>'),(25,'123','202cb962ac59075b964b07152d234b70','123@yahoo.com','','Administrator','aktif',0,'','0000-00-00 00:00:00','0000-00-00 00:00:00','');
/*!40000 ALTER TABLE `useraura` ENABLE KEYS */;
