# Host: localhost  (Version: 5.6.20)
# Date: 2015-01-28 16:48:35
# Generator: MySQL-Front 5.3  (Build 4.187)

/*!40101 SET NAMES latin1 */;

#
# Structure for table "situs"
#

DROP TABLE IF EXISTS `situs`;
CREATE TABLE `situs` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `email_master` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `judul_situs` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `url_situs` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `slogan` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `description` text COLLATE latin1_general_ci NOT NULL,
  `keywords` text COLLATE latin1_general_ci NOT NULL,
  `maxkonten` int(2) NOT NULL DEFAULT '5',
  `maxadmindata` int(2) NOT NULL DEFAULT '5',
  `maxdata` int(2) NOT NULL DEFAULT '5',
  `maxgalleri` int(2) NOT NULL DEFAULT '4',
  `widgetshare` int(2) NOT NULL DEFAULT '0',
  `theme` varchar(50) COLLATE latin1_general_ci NOT NULL DEFAULT 'tcms',
  `author` text COLLATE latin1_general_ci NOT NULL,
  `alamatkantor` text COLLATE latin1_general_ci NOT NULL,
  `publishwebsite` int(1) NOT NULL DEFAULT '1',
  `publishnews` int(2) NOT NULL,
  `maxgalleridata` int(11) NOT NULL,
  `widgetkomentar` int(2) NOT NULL DEFAULT '1',
  `widgetpenulis` int(2) NOT NULL DEFAULT '2',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

#
# Data for table "situs"
#

/*!40000 ALTER TABLE `situs` DISABLE KEYS */;
INSERT INTO `situs` VALUES (1,'rekysda@gmail.com','Sisfo HRD dan Penggajian','http://192.168.10.166/siadu/sisfohrd','Sisfo HRD dan Penggajian','WebDesign dengan sistem Responsive','sisfohrd,surabaya,indonesia',5,50,5,4,3,'sisfohrd','SMK BHAKTI SAMUDERA','Surabaya',1,1,12,1,2);
/*!40000 ALTER TABLE `situs` ENABLE KEYS */;
