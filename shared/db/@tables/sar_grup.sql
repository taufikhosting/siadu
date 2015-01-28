# Host: localhost  (Version: 5.6.20)
# Date: 2015-01-28 16:42:48
# Generator: MySQL-Front 5.3  (Build 4.187)

/*!40101 SET NAMES latin1 */;

#
# Structure for table "sar_grup"
#

DROP TABLE IF EXISTS `sar_grup`;
CREATE TABLE `sar_grup` (
  `replid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `kode` varchar(100) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `lokasi` int(10) unsigned NOT NULL,
  `keterangan` varchar(250) NOT NULL,
  `ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`replid`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

#
# Data for table "sar_grup"
#

/*!40000 ALTER TABLE `sar_grup` DISABLE KEYS */;
INSERT INTO `sar_grup` VALUES (1,'010','Furniture',1,'Perabotan, meja, kursi, dll','2013-09-01 09:30:25'),(2,'020','Elektronik',2,'','2013-09-02 09:48:49'),(3,'020','Kendaraan',1,'','2013-09-04 19:29:15'),(4,'030','Elektronik',1,'','2013-10-22 10:19:34'),(6,'IT','IT',1,'SKE','2014-10-17 11:23:33'),(7,'040','PERALATAN MUSIK',1,'','2014-12-22 07:12:26');
/*!40000 ALTER TABLE `sar_grup` ENABLE KEYS */;
