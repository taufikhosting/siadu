# Host: localhost  (Version: 5.6.20)
# Date: 2015-01-28 15:11:52
# Generator: MySQL-Front 5.3  (Build 4.187)

/*!40101 SET NAMES latin1 */;

#
# Structure for table "hrd_departemen"
#

DROP TABLE IF EXISTS `hrd_departemen`;
CREATE TABLE `hrd_departemen` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `tunjangan` varchar(255) NOT NULL,
  `masterdepartemen` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

#
# Data for table "hrd_departemen"
#

INSERT INTO `hrd_departemen` VALUES (9,'PG KG Suko','0',1),(10,'PG KG KIT','0',3),(11,'Primary Suko','0',1),(12,'Primary Rungkut','0',2),(13,'Secondary Suko','0',1),(14,'Secondary Rungkut','0',2),(15,'High School Suko','0',1),(16,'High School Rungkut','0',2),(17,'Keuangan','0',1),(18,'HRD','0',1),(19,'Litbang','0',1),(20,'Operasional','0',1),(21,'Kerohanian','0',1),(23,'General Affair','0',1),(24,'Sarana Prasarana','0',1),(31,'PPKE','0',1),(32,'Elyon Rungkut','0',2),(33,'Marketing','0',1);
