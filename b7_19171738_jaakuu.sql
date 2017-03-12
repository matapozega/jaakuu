-- phpMyAdmin SQL Dump
-- version 3.5.8.2
-- http://www.phpmyadmin.net
--
-- Host: sql304.byetcluster.com
-- Generation Time: Mar 12, 2017 at 04:56 PM
-- Server version: 5.6.35-80.0
-- PHP Version: 5.3.3

drop database if exists jaakuu;
create database jaakuu character set utf8 collate utf8_general_ci;
use jaakuu;

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `b7_19171738_jaakuu`
--

-- --------------------------------------------------------

--
-- Table structure for table `korisnik`
--

CREATE TABLE IF NOT EXISTS `korisnik` (
  `sifra` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lozinka` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `ime` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `prezime` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `oib` char(11) COLLATE utf8_unicode_ci NOT NULL,
  `datrodenja` date NOT NULL,
  `ulica` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `mjesto` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `drzava` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `postanskibr` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `uloga` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `aktivan` tinyint(1) NOT NULL,
  PRIMARY KEY (`sifra`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `korisnik`
--

INSERT INTO `korisnik` (`sifra`, `email`, `lozinka`, `ime`, `prezime`, `oib`, `datrodenja`, `ulica`, `mjesto`, `drzava`, `postanskibr`, `uloga`, `aktivan`) VALUES
(1, 'matejdurokovic@gmail.com', '8aa87050051efe26091a13dbfdf901c6', 'Matej', 'Đuroković', '48806658426', '1995-01-24', 'Sveti Vid 19', 'Požega', 'Hrvatska', '34000', 'admin', 1);

-- --------------------------------------------------------

--
-- Table structure for table `listic`
--

CREATE TABLE IF NOT EXISTS `listic` (
  `sifra` int(11) NOT NULL AUTO_INCREMENT,
  `status` tinyint(1) NOT NULL,
  `korisnik` int(11) NOT NULL,
  `uplata` decimal(5,2) NOT NULL,
  `ukupnikoeficijent` decimal(5,2) NOT NULL,
  `evdobitak` decimal(9,2) NOT NULL,
  PRIMARY KEY (`sifra`),
  KEY `korisnik` (`korisnik`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `listic`
--

INSERT INTO `listic` (`sifra`, `status`, `korisnik`, `uplata`, `ukupnikoeficijent`, `evdobitak`) VALUES
(1, 0, 1, '0.00', '1.80', '0.00');

-- --------------------------------------------------------

--
-- Table structure for table `listic_ponuda`
--

CREATE TABLE IF NOT EXISTS `listic_ponuda` (
  `listic` int(11) NOT NULL,
  `ponuda` int(11) NOT NULL,
  `koeficijent` decimal(5,2) DEFAULT NULL,
  KEY `listic` (`listic`),
  KEY `ponuda` (`ponuda`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `listic_ponuda`
--

INSERT INTO `listic_ponuda` (`listic`, `ponuda`, `koeficijent`) VALUES
(1, 1, '1.80');

-- --------------------------------------------------------

--
-- Table structure for table `novcanik`
--

CREATE TABLE IF NOT EXISTS `novcanik` (
  `sifra` int(11) NOT NULL AUTO_INCREMENT,
  `korisnik` int(11) NOT NULL,
  `stanje` decimal(8,2) NOT NULL,
  `valuta` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`sifra`),
  KEY `korisnik` (`korisnik`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `novcanik`
--

INSERT INTO `novcanik` (`sifra`, `korisnik`, `stanje`, `valuta`) VALUES
(1, 1, '100.00', 'Jaakuu');

-- --------------------------------------------------------

--
-- Table structure for table `ponuda`
--

CREATE TABLE IF NOT EXISTS `ponuda` (
  `sifra` int(11) NOT NULL AUTO_INCREMENT,
  `naziv` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `video` int(11) NOT NULL,
  `tipponude` int(11) NOT NULL,
  `trajeod` datetime NOT NULL,
  `trajedo` datetime NOT NULL,
  `koeficijent` decimal(5,2) NOT NULL,
  `kolicina` int(11) NOT NULL,
  PRIMARY KEY (`sifra`),
  KEY `tipponude` (`tipponude`),
  KEY `video` (`video`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=21 ;

--
-- Dumping data for table `ponuda`
--

INSERT INTO `ponuda` (`sifra`, `naziv`, `video`, `tipponude`, `trajeod`, `trajedo`, `koeficijent`, `kolicina`) VALUES
(1, 'Više', 1, 1, '2017-03-12 00:00:00', '2017-03-15 00:00:00', '1.80', 422492250),
(2, 'Manje', 1, 1, '2017-03-12 00:00:00', '2017-03-15 00:00:00', '1.80', 422492250),
(5, 'Više', 1, 2, '2017-03-12 00:00:00', '2017-03-15 00:00:00', '1.20', 2190000),
(6, 'Manje', 1, 2, '2017-03-12 00:00:00', '2017-03-15 00:00:00', '3.60', 2190000),
(7, 'Više', 1, 4, '2017-03-12 00:00:00', '2017-03-13 00:00:00', '1.80', 5),
(8, 'Manje', 1, 4, '2017-03-12 00:00:00', '2017-03-13 00:00:00', '1.80', 5),
(9, 'Više', 2, 1, '2017-03-12 00:00:00', '2017-03-15 00:00:00', '1.65', 3905000),
(10, 'Manje', 2, 1, '2017-03-12 00:00:00', '2017-03-15 00:00:00', '2.00', 3905000),
(11, 'Više', 2, 2, '2017-03-12 00:00:00', '2017-03-15 00:00:00', '6.30', 12800),
(12, 'Manje', 2, 2, '2017-03-12 00:00:00', '2017-03-15 00:00:00', '1.50', 12800),
(13, 'Više', 6, 4, '2017-03-12 00:00:00', '2017-03-13 00:00:00', '1.80', 5),
(14, 'Manje', 6, 4, '2017-03-12 00:00:00', '2017-03-13 00:00:00', '1.80', 5),
(15, 'Više', 5, 1, '2017-03-12 00:00:00', '2017-03-13 00:00:00', '4.20', 115854882),
(16, 'Manje', 5, 1, '2017-03-12 00:00:00', '2017-03-13 00:00:00', '1.75', 115854882),
(17, 'Više', 4, 2, '2017-03-12 00:00:00', '2017-03-13 00:00:00', '1.55', 323150),
(18, 'Manje', 4, 2, '2017-03-12 00:00:00', '2017-03-13 00:00:00', '5.50', 323150),
(19, 'Više', 3, 3, '2017-03-12 00:00:00', '2017-03-15 00:00:00', '1.30', 422),
(20, 'Manje', 3, 3, '2017-03-12 00:00:00', '2017-03-15 00:00:00', '8.40', 422);

-- --------------------------------------------------------

--
-- Table structure for table `tipponude`
--

CREATE TABLE IF NOT EXISTS `tipponude` (
  `sifra` int(11) NOT NULL AUTO_INCREMENT,
  `naziv` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `opis` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`sifra`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Dumping data for table `tipponude`
--

INSERT INTO `tipponude` (`sifra`, `naziv`, `opis`) VALUES
(1, 'pogleda', 'Hoće li do određeng datuma biti više ili manje pogleda od zadanog'),
(2, 'like-ova', 'Hoće li do određenog datuma biti više ili manje like-ova od zadanog'),
(3, 'dislike-ova', 'Hoće li do određenog datuma biti više ili manje dislike-ova od zadanog'),
(4, 'zadnja znamenka pogleda', 'Hoće li do određenog datuma zadnja znamenka pogleda biti viša ili manja od zadane'),
(6, 'zadnja znamenka like-ova', 'hoće li do određenog datuma zadnja znamenka like-ova biti veća ili manja od zadane'),
(7, 'zadnja znamenka dislike-ova', 'hoće li do određenog datuma zadnja znamenka dislike-ova biti veća ili manja od zadaned');

-- --------------------------------------------------------

--
-- Table structure for table `video`
--

CREATE TABLE IF NOT EXISTS `video` (
  `sifra` int(11) NOT NULL AUTO_INCREMENT,
  `videoid` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `naziv` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `pregleda` int(50) NOT NULL,
  `likes` int(11) NOT NULL,
  `dislikes` int(11) NOT NULL,
  `datum` datetime DEFAULT NULL,
  PRIMARY KEY (`sifra`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Dumping data for table `video`
--

INSERT INTO `video` (`sifra`, `videoid`, `naziv`, `pregleda`, `likes`, `dislikes`, `datum`) VALUES
(1, 'bpOSxM0rNPM', 'Arctic Monkeys - Do I Wanna Know? (Official Video)', 422482250, 2189621, 56956, '2013-06-18 00:00:00'),
(2, '0D5JJZl6MB0', 'The Beatles - Let it be Lyrics', 3900029, 12599, 445, '2011-10-05 00:00:00'),
(3, '7S94ohyErSw', 'The Rolling Stones - You Can''t Always Get What You Want [Official]', 2337064, 10349, 421, '2012-10-30 00:00:00'),
(4, 'O4irXQhgMqg', 'The Rolling Stones - Paint It, Black (Official Lyric Video)', 40936775, 323071, 6414, '2015-11-19 00:00:00'),
(5, '0sB3Fjw3Uvc', 'The Animals - The House of the Rising Sun Mafia III Trailer 3 Casino !!!', 115852882, 579745, 15095, '2010-09-03 00:00:00'),
(6, 'YR5ApYxkU-U', 'Pink Floyd - Another Brick In The Wall (HQ)', 225784538, 959068, 30693, '2010-07-05 00:00:00');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
