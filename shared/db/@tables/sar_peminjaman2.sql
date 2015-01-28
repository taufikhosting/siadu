# Host: localhost  (Version: 5.6.20)
# Date: 2015-01-28 16:45:20
# Generator: MySQL-Front 5.3  (Build 4.187)

/*!40101 SET NAMES latin1 */;

#
# Structure for table "sar_peminjaman2"
#

DROP TABLE IF EXISTS `sar_peminjaman2`;
CREATE TABLE `sar_peminjaman2` (
  `replid` int(11) NOT NULL AUTO_INCREMENT,
  `lokasi` int(11) NOT NULL,
  `peminjam` varchar(100) NOT NULL,
  `tgl_pinjam` date NOT NULL,
  `tgl_kembali` date NOT NULL,
  `keterangan` text NOT NULL,
  PRIMARY KEY (`replid`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

#
# Data for table "sar_peminjaman2"
#

INSERT INTO `sar_peminjaman2` VALUES (14,1,'sari puspa','2014-12-05','2014-12-12',''),(15,1,'H. subur','2014-12-11','2014-12-18','untuk mengecat kelas'),(16,1,'p. sumarno','2014-12-11','2014-12-16','acara workshop IT'),(17,1,'paijo','2014-12-18','2014-12-19',''),(18,1,'marijan','2014-12-11','2014-12-19',''),(19,1,'sofi','2014-12-19','2014-12-25','oke bos'),(20,1,'ok','0000-00-00','0000-00-00','');
