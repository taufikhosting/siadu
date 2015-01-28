# Host: localhost  (Version: 5.6.20)
# Date: 2015-01-29 04:45:50
# Generator: MySQL-Front 5.3  (Build 4.187)

/*!40101 SET NAMES utf8 */;

#
# Structure for table "psb_kelompok"
#

DROP TABLE IF EXISTS `psb_kelompok`;
CREATE TABLE `psb_kelompok` (
  `replid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `kelompok` varchar(100) NOT NULL,
  `proses` int(10) unsigned NOT NULL,
  `tglmulai` date NOT NULL DEFAULT '0000-00-00',
  `tglselesai` date NOT NULL DEFAULT '0000-00-00',
  `biaya` decimal(10,0) NOT NULL DEFAULT '0',
  `keterangan` varchar(255) DEFAULT NULL,
  `ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`replid`),
  KEY `FK_kelompokcalonsiswa_prosespenerimaansiswa` (`proses`),
  KEY `IX_kelompokcalonsiswa_ts` (`ts`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

#
# Data for table "psb_kelompok"
#

INSERT INTO `psb_kelompok` VALUES (2,'First Intake (Toodler - PG - KG)',2,'2013-10-01','2013-12-31',300000,'Uang Formulir / Registration Form Fee','2014-03-19 12:50:05'),(3,'Second Intake  (Toodler - PG - KG)',2,'2014-01-01','2014-06-30',300000,'Uang Formulir/Registration Form Fee','2014-03-19 12:50:47'),(4,'Second Intake (Primary Level)',2,'2014-01-01','2014-06-30',400000,'Uang Formulir/Registration Form Fee','2014-03-19 12:51:16'),(5,'First Intake',3,'2013-09-01','0000-00-00',350000,'','2014-03-19 12:51:43'),(6,'Second Intake',3,'2013-11-01','0000-00-00',350000,'','2014-03-19 12:52:06'),(7,'Third Intake',3,'2014-01-01','0000-00-00',350000,'','2014-03-19 12:52:32'),(8,'First Intake',4,'2013-09-01','0000-00-00',350000,'','2014-03-19 12:55:46'),(9,'First Intake (Primary Level)',2,'2013-10-01','2013-12-31',400000,'Uang Formulir/Registration Form Fee','2014-03-24 09:24:39'),(10,'First Intake (High School)',2,'2013-10-01','2013-12-01',500000,'Uang Formulir/Registration Form Fee','2014-03-24 09:26:33'),(11,'Second Intake ( High School)',2,'2014-01-01','2014-06-30',500000,'Uang Formulir/Registration Form Fee','2014-03-24 09:34:59'),(12,'First Intake (Secondary level)',2,'2013-10-01','2014-12-31',400000,'Uang Formulir/ Registration Form Fee','2014-04-15 13:40:49'),(13,'Second Intake ( Secondary Level)',2,'2014-01-01','2014-06-30',400000,'Uang Formulir/Registration Form Fee','2014-04-15 13:44:31'),(14,'First Intake (High School)',6,'2014-10-01','2014-12-01',500000,'','2014-12-09 10:11:37'),(15,'First Intake (Primary Level)',6,'2014-10-01','2014-12-31',400000,'','2014-12-09 10:14:14'),(16,'First Intake (Secondary level)',6,'2014-10-01','2014-12-31',400000,'','2014-12-09 10:14:15'),(17,'First Intake (Toodler - PG - KG)',6,'2014-10-01','2014-12-31',300000,'','2014-12-09 10:15:23'),(18,'Second Intake (Toodler - PG - KG)',6,'2015-01-01','2015-06-30',300000,'','2014-12-09 10:15:24'),(19,'Second Intake ( High School)',6,'2015-01-01','2015-06-30',500000,'','2014-12-09 10:16:22'),(20,'Second Intake ( Secondary Level)',6,'2015-01-01','2015-06-30',400000,'','2014-12-09 10:17:59'),(21,'Second Intake (Primary Level)',6,'2015-01-01','2015-06-30',400000,'','2014-12-09 10:19:01'),(23,'gelombang 1',4,'2014-09-01','2014-12-31',350000,'Promo DPP disc 15% dan potongan joining fee 250.000','2015-01-26 09:41:30'),(24,'Gelombang 1',8,'2014-09-01','2015-12-31',350000,'promo DPP disc 15% dan potongan Joining Fee 250.000','2015-01-26 09:47:07'),(25,'Playgroup A1',2,'2013-10-01','2014-06-30',0,'','2015-01-26 11:43:33'),(26,'Playgroup A2',2,'2013-10-01','2014-06-30',0,'','2015-01-26 12:10:08'),(27,'Playgroup A3',2,'2013-09-01','2014-06-30',0,'','2015-01-26 12:45:55'),(28,'Playgroup B1',2,'2013-09-01','2014-06-30',0,'','2015-01-26 13:02:00');
