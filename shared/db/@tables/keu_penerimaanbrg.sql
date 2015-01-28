# Host: localhost  (Version: 5.6.20)
# Date: 2015-01-28 15:32:25
# Generator: MySQL-Front 5.3  (Build 4.187)

/*!40101 SET NAMES latin1 */;

#
# Structure for table "keu_penerimaanbrg"
#

DROP TABLE IF EXISTS `keu_penerimaanbrg`;
CREATE TABLE `keu_penerimaanbrg` (
  `replid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nomerbukti` varchar(100) NOT NULL,
  `kodebrg` varchar(50) NOT NULL,
  `namabrg` varchar(100) NOT NULL,
  `unit` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `satuan` varchar(10) NOT NULL,
  `nominal` decimal(10,0) NOT NULL DEFAULT '0',
  PRIMARY KEY (`replid`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

#
# Data for table "keu_penerimaanbrg"
#

/*!40000 ALTER TABLE `keu_penerimaanbrg` DISABLE KEYS */;
INSERT INTO `keu_penerimaanbrg` VALUES (1,'AAA','ELKO001','',2,'unit',0),(2,'BBB','101','',1,'unit',20000),(3,'AA001','ELKO001','Macbook pro 15 inch',2,'unit',12000000),(4,'BB101','KEMTR0001','Supra X 125',1,'unit',15000000),(5,'AS989','ELKO001','Macbook pro 15 inch',1,'unit',12000000),(6,'ASD123','KEMTR0001','Supra X 125',1,'unit',18000000),(7,'ASDW123','ELKO001','Macbook pro 15 inch',1,'unit',12000000);
/*!40000 ALTER TABLE `keu_penerimaanbrg` ENABLE KEYS */;
