# Host: localhost  (Version: 5.6.20)
# Date: 2015-01-28 15:23:04
# Generator: MySQL-Front 5.3  (Build 4.187)

/*!40101 SET NAMES latin1 */;

#
# Structure for table "hrd_jabatan"
#

DROP TABLE IF EXISTS `hrd_jabatan`;
CREATE TABLE `hrd_jabatan` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `tunjangan` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

#
# Data for table "hrd_jabatan"
#

INSERT INTO `hrd_jabatan` VALUES (11,'Guru','0'),(13,'Kepala Sekolah','0'),(14,'Wakil Kepala Sekolah','0'),(15,'Koordinator HOD','0'),(16,'Kepala Litbang','0'),(17,'Manajer Operasional','0'),(18,'Humas','0'),(19,'Tata Usaha','0'),(20,'Chaplain','0'),(21,'Sekretaris Perhimpunan','0'),(23,'Supir','0'),(24,'Pustakawan','0'),(25,'Staf Keuangan','0'),(26,'Staf HRD','0'),(27,'Nanny','0'),(28,'Suster','0'),(29,'Staf GA','0'),(30,'Staf Gudang','0'),(31,'Staf Purchasing & Student Service','0'),(32,'Staf Marketing','0'),(33,'Resepsionis','0'),(34,'Staf','0'),(35,'Staf Foto Copy','0'),(36,'Koordinator GAC (DOS)','0'),(37,'Koordinator GA','0'),(38,'Koordinator Sarpras','0'),(39,'Spv. Accounting ','0'),(40,'Koordinator Training','0'),(41,'Staf Maintenance','0'),(42,'Spv. Marketing','0');
