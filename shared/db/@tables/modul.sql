# Host: localhost  (Version: 5.6.20)
# Date: 2015-01-28 15:34:21
# Generator: MySQL-Front 5.3  (Build 4.187)

/*!40101 SET NAMES latin1 */;

#
# Structure for table "modul"
#

DROP TABLE IF EXISTS `modul`;
CREATE TABLE `modul` (
  `id_modul` int(11) NOT NULL AUTO_INCREMENT,
  `kode` varchar(10) NOT NULL,
  `modul` varchar(255) NOT NULL,
  `keterangan` text NOT NULL,
  PRIMARY KEY (`id_modul`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

#
# Data for table "modul"
#

INSERT INTO `modul` VALUES (1,'aka','akademik',''),(2,'psb','penerimaan siswa baru',''),(3,'perpus','perpustakaan',''),(4,'sarpras','sarana dan prasarana',''),(5,'hrd','kepegawaian',''),(6,'keu','keuangan',''),(7,'repo','repository',''),(8,'man','manajemen','');
