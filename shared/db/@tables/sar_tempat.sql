# Host: localhost  (Version: 5.6.20)
# Date: 2015-01-28 16:46:43
# Generator: MySQL-Front 5.3  (Build 4.187)

/*!40101 SET NAMES latin1 */;

#
# Structure for table "sar_tempat"
#

DROP TABLE IF EXISTS `sar_tempat`;
CREATE TABLE `sar_tempat` (
  `replid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `kode` varchar(20) NOT NULL DEFAULT '',
  `lokasi` int(10) unsigned NOT NULL,
  `nama` varchar(100) NOT NULL,
  `keterangan` varchar(250) NOT NULL,
  PRIMARY KEY (`replid`)
) ENGINE=MyISAM AUTO_INCREMENT=178 DEFAULT CHARSET=latin1;

#
# Data for table "sar_tempat"
#

/*!40000 ALTER TABLE `sar_tempat` DISABLE KEYS */;
INSERT INTO `sar_tempat` VALUES (1,'RG',2,'Ruang Guru',''),(2,'LT.3_LK',1,'Lt.3 Lab Komputer ',''),(3,'Loutse_31',1,'Lt.3 Mandarin Loutse 31',''),(4,'Loutse_32',1,'Lt.3 Mandarin Loutse 32',''),(5,'HO_Loutse ',1,'Lt.3 Mandarin Ho Loutse',''),(6,'TU2\r\n',1,'Lantai 3 TU2',''),(7,'Litbang\r\n',1,'Lantai 3 Litbang\r\n',''),(8,'KSSMP\r\n',1,'Lantai 3 KSSMP\r\n',''),(9,'RGS1\r\n',1,'Lantai 3 RGS1\r\n',''),(10,'RGS2\r\n',1,'Lantai 3 RGS2\r\n',''),(11,'Server\r\n',1,'Lantai 3 Server\r\n',''),(12,'LT.2_IT',1,'Lt2 Ruang IT',''),(13,'LT.2_LK',1,'Lt.2 Lab Komputer ',''),(14,'LT.2_LBR',1,'Lt.2 Library',''),(15,'LT.2_RGK',1,'Lt.2 Ruang Guru Kecil',''),(16,'LT.2_TUPRI',1,'Lt.2 Ruang Admin\r\n',''),(17,'\r\nLT.2_FC',1,'Lt.2 Ruang Foto Copy\r\n',''),(18,'LT.2_Upper_Primart',1,'Lt.2 Ruang Guru Besar\r\n',''),(19,'LT.1_LAB_BHS',1,'Lt.1 Lab Bahasa\r\n',''),(20,'LT.1_GAC',1,'Lt.1 GAC\r\n',''),(21,'LT.1_SMA',1,'Lt.1 Guru SMA\r\n',''),(22,'LT.1_LIB',1,'Lt1. Library\r\n',''),(23,'LT.1_KEPSEK_PG_KG',1,'Lt.1 Kepsek Playgroup K.G\r\n',''),(24,'LT.1_TU_PG_KG\r\n',1,'Lt.1 TU PG\r\n',''),(25,'LT.1_STD_SER',1,'Lt.1 Student Service\r\n',''),(26,'LT.1_KAS',1,'Lt.1 Kasir\r\n',''),(27,'LT.1_PGKG',1,'Lt.1 PGKG\r\n',''),(28,'BSE_HRD',1,'Basement HRD (Miss Puji)\r\n',''),(29,'BSE_HRD',1,'Basement HRD (Miss Cristin)\r\n',''),(31,'BSE_HRD',1,'Basement HRD (Miss Neria)\r\n',''),(32,'Gudang\r\n',1,'Gudang\r\n',''),(33,'KANTIN',1,'KANTIN',''),(34,'BSE\r\n',1,'Basement\r\n',''),(93,'LK',2,'Lt.3 Lab Komputer',''),(94,'LT.2_Aula',2,'Lt.2 Aula',''),(95,'LT.1_T.U',2,'Lt.1 T.U',''),(96,'LT.1_Humas',2,'Lt.1 Humas',''),(97,'R.GR_SEC',1,'Ruang Guru Secondary',''),(98,'LT.3_KOR',1,'KORIDOR LT 3/A',''),(99,'LT.3_LAB_SC',1,'LAB SCIENCE LAT 3',''),(100,'LT.3_BIO',1,'LAB BIOLOGI LAT 3',''),(101,'SEC_11',1,'SECONDARY 11',''),(102,'LT.2_PRIM2A',1,'PRIMARY LT II/A',''),(103,'LT.3_MPR',1,'MPR LT III',''),(104,'R.PRIN_PRIM',1,'R. PRINCIPAL PRIMARY',''),(105,'R.PRIN_PGKG',1,'R. PRINCIPAL PG / KG',''),(106,'R.PRIN_SEC',1,'R. PRINCIPAL SECONDARY',''),(107,'R.DIREKTUR',1,'Ruang Direktur',''),(108,'PARKIR',1,'PARKIR',''),(109,'LT.1_PANTRY',1,'PANTRY LT 1/B',''),(110,'LT.3_HALL',1,'HALL LT 3',''),(111,'PG_A1',1,'PG A1',''),(112,'PG_B1',1,'PG B1',''),(113,'PG_B2',1,'PG B2',''),(114,'KG_A1',1,'KG A1',''),(115,'KG_A2',1,'KG A2',''),(116,'KG_A3',1,'KG A3',''),(117,'KG_B1',1,'KG B1',''),(118,'KG_B2',1,'KG B2',''),(119,'KG_B3',1,'KG B3',''),(120,'HALL_PG_KG',1,'HALL PG KG',''),(121,'LT.1_R.MUSIK',1,'R.MUSIK LT.1',''),(122,'MONTESSORI',1,'MONTESSORI',''),(123,'AREA_LUAR_MAINTENANC',1,'AREA LUAR MAINTENANCE',''),(124,'SERVER',1,'SERVER ROOM',''),(125,'OFFICE_IBU_DEWI',1,'OFFICE IBU DEWI K.',''),(126,'SEC_ADM_OFFICE',1,'SEC.ADMIN OFFICE',''),(127,'LT.3_MUSIK',1,'R.MUSIK LT.3',''),(128,'LT.3_LAB_FISIKA',1,'LABORATORIUM FISIKA LT.3',''),(129,'LT.3_DPN_GDG_IT',1,'DEPAN GUDANG IT LT.3',''),(130,'KONSELING',1,'R.KONSELING',''),(132,'SEC_TEACHER_OFFICE',1,'SECONDARY TEACHER OFFICE',''),(133,'SEC_9A',1,'SECONDARY 9A',''),(134,'PPKE',1,'R.PPKE',''),(135,'ADMIN_PRIM',1,'ADMIN PRIMARY',''),(136,'VICE_PRINC_SEC',1,'SEC.VICE PRINCIPAL OFFICE',''),(137,'ADMIN_PGKG',1,'ADMIN PGKG',''),(138,'PRIM_PRIN_OFFICE',1,'PRIMARY PRINCIPAL OFFICE',''),(139,'SEC_PRINCIPAL_OFFICE',1,'SEC.PRINCIPAL OFFICE',''),(140,'RES_ DEV',1,'RESEARCH &amp; DEVELOPMENT ',''),(141,'HIGH_TEACHER_ROOM',1,'HIGHSCHOOL TEACHER ROOM',''),(142,'HRD',1,'HRD',''),(143,'HIGH_SCH_ADMIN',1,'HIGH SCHOOL ADMIN',''),(144,'MDR_TEACHER_OFFICE',1,'MANDARIN\'S TEACHER OFFICE',''),(145,'IT_OFFICE',1,'IT OFFICE',''),(146,'DIR_OFFICE',1,'DIRECTOR OFFICE',''),(147,'PRIM_IA',1,'PRIMARY IA',''),(148,'PRIM_IB',1,'PRIMARY IB',''),(149,'PRIM_IC',1,'PRIMARY IC',''),(150,'PRIM_IIA',1,'PRIMARY IIA',''),(151,'PRIM_IIB',1,'PRIMARY IIB',''),(152,'PRIM_IIC',1,'PRIMARY IIC',''),(153,'PRIM_IIIA',1,'PRIMARY III A',''),(154,'PRIM_IIIB',1,'PRIMARY III B',''),(155,'PRIM_IIIC',1,'PRIMARY III C',''),(156,'PRIM_IVA',1,'PRIMARY IVA',''),(157,'PRIM_IVB',1,'PRIMARY IVB',''),(158,'PRIM_IVC',1,'PRIMARY IVC',''),(159,'PRIM_VA',1,'PRIMARY VA',''),(160,'PRIM_VB',1,'PRIMARY VB',''),(161,'PRIM_VIA',1,'PRIMARY VIA',''),(162,'PRIM_VIB',1,'PRIMARY VIB',''),(163,'SEC_7A',1,'SECONDARY 7A',''),(164,'SEC_7B',1,'SECONDARY 7B',''),(165,'SEC_8A',1,'SECONDARY 8A',''),(166,'SEC_8B',1,'SECONDARY 8B',''),(167,'SEC_9B',1,'SECONDARY 9B',''),(168,'HIGH_SCH_11 ',1,'HIGH SCHOOL 11 ',''),(169,'SEC_10',1,'SECONDARY 10',''),(170,'SEC_10B',1,'SECONDARY 10B',''),(171,'SEC_11B',1,'SECONDARY 11B',''),(172,'LOBI',1,'LOBI',''),(173,'LT.2_MEET_ROOM',1,'MEETING ROOM LT.2',''),(174,'AREA_ADMIN',1,'AREA ADMIN',''),(175,'HIGH SCH_11B',1,'HIGH SCHOOL 11B',''),(176,'HIGH_SCH_12',1,'HIGH SCHOOL 12','');
/*!40000 ALTER TABLE `sar_tempat` ENABLE KEYS */;
