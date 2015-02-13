# Host: localhost  (Version: 5.6.20)
# Date: 2015-01-28 16:00:59
# Generator: MySQL-Front 5.3  (Build 4.187)

/*!40101 SET NAMES latin1 */;

#
# Structure for table "rep_file"
#

DROP TABLE IF EXISTS `rep_file`;
CREATE TABLE `rep_file` (
  `replid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `admin` int(10) unsigned NOT NULL DEFAULT '0',
  `nama` varchar(128) NOT NULL,
  `keterangan` varchar(500) NOT NULL,
  `ufile` varchar(20) NOT NULL,
  `fname` varchar(128) NOT NULL,
  `tipe` varchar(5) NOT NULL,
  `waktu` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`replid`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

#
# Data for table "rep_file"
#

/*!40000 ALTER TABLE `rep_file` DISABLE KEYS */;
INSERT INTO `rep_file` VALUES (13,1,'Logo SIADU','Logo warna','20130917074235.jpg','logo2.jpg','jpg','2013-09-17 07:42:36'),(14,1,'Lesson Plan','Rencana Pembelajaran','20140120180004.pdf','Lesson Plan.pdf','pdf','2014-01-20 18:00:18');
/*!40000 ALTER TABLE `rep_file` ENABLE KEYS */;
