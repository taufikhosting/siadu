# Host: localhost  (Version: 5.6.20)
# Date: 2015-01-28 14:58:53
# Generator: MySQL-Front 5.3  (Build 4.187)

/*!40101 SET NAMES latin1 */;

#
# Structure for table "admin_hrd"
#

DROP TABLE IF EXISTS `admin_hrd`;
CREATE TABLE `admin_hrd` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu` varchar(30) NOT NULL DEFAULT '',
  `url` varchar(60) NOT NULL DEFAULT '',
  `mod` int(1) NOT NULL DEFAULT '0',
  `ordering` int(2) NOT NULL,
  `parent` int(2) NOT NULL DEFAULT '0',
  `icon` varchar(200) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=89 DEFAULT CHARSET=latin1;

#
# Data for table "admin_hrd"
#

/*!40000 ALTER TABLE `admin_hrd` DISABLE KEYS */;
INSERT INTO `admin_hrd` VALUES (2,'Settings','#',0,2,0,'settings.png'),(3,'Penggajian','#',0,5,0,'tools.png'),(4,'Master','#',0,3,0,'apperance.png'),(8,'Departemen','departemen',1,1,4,''),(10,'Setting WebSite','settingwebsite',1,6,2,''),(14,'User Login','user',1,1,2,''),(73,'Karyawan','#',0,4,0,'karyawan.png'),(75,'Jabatan','jabatan',1,2,4,''),(76,'Pendidikan','pendidikan',1,3,4,''),(77,'Status Karyawan','statuskaryawan',1,4,4,''),(79,'Daftar Karyawan','karyawan',1,1,73,''),(80,'History Karyawan','historykaryawan',1,2,73,''),(81,'Kelengkapan Berkas','kelengkapanberkas',1,3,73,''),(82,'Absensi Karyawan','absensi',1,4,73,''),(83,'Penggajian Karyawan','penggajian',1,1,3,''),(87,'Agama','agama',1,5,4,''),(88,'Cuti Karyawan','cuti',1,6,73,'');
/*!40000 ALTER TABLE `admin_hrd` ENABLE KEYS */;
