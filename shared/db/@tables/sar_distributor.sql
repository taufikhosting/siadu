# Host: localhost  (Version: 5.6.20)
# Date: 2015-01-28 16:42:01
# Generator: MySQL-Front 5.3  (Build 4.187)

/*!40101 SET NAMES latin1 */;

#
# Structure for table "sar_distributor"
#

DROP TABLE IF EXISTS `sar_distributor`;
CREATE TABLE `sar_distributor` (
  `replid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `kode` varchar(3) NOT NULL DEFAULT '',
  `nama` varchar(100) NOT NULL DEFAULT '',
  `alamat` varchar(250) NOT NULL,
  `telpon` varchar(20) NOT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`replid`),
  UNIQUE KEY `REPL_ID` (`kode`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

#
# Data for table "sar_distributor"
#

