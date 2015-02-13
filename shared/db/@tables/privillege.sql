# Host: localhost  (Version: 5.6.20)
# Date: 2015-01-28 15:35:11
# Generator: MySQL-Front 5.3  (Build 4.187)

/*!40101 SET NAMES latin1 */;

#
# Structure for table "privillege"
#

DROP TABLE IF EXISTS `privillege`;
CREATE TABLE `privillege` (
  `id_privillege` int(11) NOT NULL,
  `id_login` int(11) NOT NULL,
  `id_departemen` int(11) NOT NULL,
  `id_modul` int(11) NOT NULL,
  PRIMARY KEY (`id_privillege`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Data for table "privillege"
#

INSERT INTO `privillege` VALUES (1,1,1,1),(2,1,1,2),(3,1,1,3);
