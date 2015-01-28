# Host: localhost  (Version: 5.6.20)
# Date: 2015-01-28 15:59:41
# Generator: MySQL-Front 5.3  (Build 4.187)

/*!40101 SET NAMES latin1 */;

#
# Structure for table "pus_penerbit"
#

DROP TABLE IF EXISTS `pus_penerbit`;
CREATE TABLE `pus_penerbit` (
  `replid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  PRIMARY KEY (`replid`)
) ENGINE=MyISAM AUTO_INCREMENT=86 DEFAULT CHARSET=latin1;

#
# Data for table "pus_penerbit"
#

/*!40000 ALTER TABLE `pus_penerbit` DISABLE KEYS */;
INSERT INTO `pus_penerbit` VALUES (1,'Grolier International',''),(2,'Peter Haddock Publ.',''),(3,'Time Life',''),(4,'Gramedia Pustaka Utama',''),(5,'Wordsworth Classics',''),(6,'Elex Media Komputindo',''),(7,'Kanisius',''),(8,'Erlangga',''),(9,'Scholastic',''),(10,'Harcourt',''),(11,'Award Publ.',''),(12,'Paradise Press, Inc.',''),(14,'Grasindo',''),(15,'Amber Books',''),(16,'Little, Brown & Co.',''),(17,'Gunung Mulia',''),(18,'Harrison House',''),(19,'Bukune',''),(20,'Ladybird Books',''),(21,'Little Tiger Press',''),(22,'Walker Books',''),(23,'Pelangi',''),(24,'Tessloff Sterling',''),(25,'Raintree',''),(26,'Red Kite Books',''),(27,'Random House',''),(28,'Cambridge University',''),(29,'Child\'s play',''),(30,'Award publications limited',''),(31,'Picture me book',''),(32,'North parade publishing',''),(33,'Tommy Nelson',''),(34,'Puffin Books',''),(35,'Zonder Kidz',''),(36,'Chancellor Press',''),(38,'Murdoch Books',''),(39,'Gaya Favorit Press',''),(40,'Bug\'s Eye View Books',''),(41,'Bendon',''),(42,'Golden Press',''),(43,'WJ Fantasy',''),(44,'Wortel Book',''),(45,'Bumblebee Books',''),(47,'Erlangga for Kids',''),(48,'Libri',''),(49,'Cocky\'s Circle Little Book',''),(50,'Topthat',''),(51,'Hinkler',''),(52,'Little Cherry',''),(53,'Early childhood',''),(54,'Dioma',''),(55,'Little Simon',''),(56,'Little Serambi',''),(57,'Interaksara',''),(58,'My first reader',''),(59,'SNP Publishing',''),(60,'Lumina',''),(61,'Immanuel kids',''),(62,'Pan Pacific',''),(63,'Brindal Books',''),(64,'Fisher Price',''),(65,'Meta Kids',''),(66,'Golden Book',''),(67,'Grolier Enterprises Inc.',''),(68,'Little Shared Book',''),(69,'Phidal Publishing Inc.',''),(70,'Treehouse Children\'s Books Ltd',''),(71,'Playmore Inc and Waldman Publishing Corp',''),(72,'Grosset & Dunlap',''),(73,'Sterling Publishing Private Limited',''),(74,'Grandream Limited',''),(75,'Broadman&Holman Publishers',''),(76,'Zikrul Hakim',''),(77,'Macmillan Children Book\'s',''),(78,'The Book Company Publishing',''),(79,'Barefoot Books',''),(80,'Kohwai & Young',''),(81,'The five mile press',''),(82,'Read With Me',''),(83,'Tira Pustaka',''),(84,'Discovery Toys',''),(85,'HarperCollins Children Books','');
/*!40000 ALTER TABLE `pus_penerbit` ENABLE KEYS */;
