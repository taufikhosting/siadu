-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 24 Jan 2015 pada 19.18
-- Versi Server: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sister_siadu`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `hrd_departemen`
--

CREATE TABLE IF NOT EXISTS `hrd_departemen` (
`id` int(3) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `tunjangan` varchar(255) NOT NULL,
  `masterdepartemen` int(10) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=31 ;

--
-- Dumping data untuk tabel `hrd_departemen`
--

INSERT INTO `hrd_departemen` (`id`, `nama`, `tunjangan`, `masterdepartemen`) VALUES
(9, 'PG KG Suko', '0', 1),
(10, 'PG KG KIT', '0', 3),
(11, 'Primary Suko', '0', 1),
(12, 'Primary Rungkut', '0', 0),
(13, 'Secondary Suko', '0', 0),
(14, 'Secondary Rungkut', '0', 0),
(15, 'High School Suko', '0', 0),
(16, 'High School Rungkut', '0', 0),
(17, 'Keuangan', '0', 0),
(18, 'HRD', '0', 0),
(19, 'Litbang', '0', 0),
(20, 'Operasional', '0', 0),
(21, 'Kerohanian', '0', 0),
(23, 'General Affair', '0', 3),
(24, 'Sarana Prasarana', '0', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `hrd_departemen`
--
ALTER TABLE `hrd_departemen`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `hrd_departemen`
--
ALTER TABLE `hrd_departemen`
MODIFY `id` int(3) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=31;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
