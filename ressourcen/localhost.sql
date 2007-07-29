-- phpMyAdmin SQL Dump
-- version 2.7.0-pl2
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Jul 11, 2007 at 05:32 PM
-- Server version: 5.0.19
-- PHP Version: 5.1.6
-- 
-- Database: `MacOnly`
-- 
CREATE DATABASE `MacOnly` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE MacOnly;

-- --------------------------------------------------------

-- 
-- Table structure for table `Bilder`
-- 

CREATE TABLE IF NOT EXISTS `Bilder` (
  `BesitzerID` mediumint(9) NOT NULL,
  `ID` mediumint(9) NOT NULL,
  `Dateiname` mediumtext collate utf8_bin NOT NULL,
  `Titel` mediumtext collate utf8_bin NOT NULL,
  `Thumbnail` mediumtext collate utf8_bin NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- 
-- Dumping data for table `Bilder`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `Profile`
-- 

CREATE TABLE IF NOT EXISTS `Profile` (
  `ID` mediumint(9) NOT NULL,
  `Nickname` text collate utf8_bin NOT NULL,
  `Name` varchar(1) collate utf8_bin NOT NULL default '0',
  `Vorname` varchar(1) collate utf8_bin NOT NULL default '0',
  `PLZ` varchar(1) collate utf8_bin NOT NULL default '0',
  `Wohnort` varchar(1) collate utf8_bin NOT NULL default '0',
  `Profilbild` varchar(1) collate utf8_bin NOT NULL default '0',
  `Kurzprofil` varchar(1) collate utf8_bin NOT NULL default '0',
  `Galerie` text collate utf8_bin NOT NULL,
  `Kontakt` varchar(1) collate utf8_bin NOT NULL default '0',
  `Geburtstag` varchar(1) collate utf8_bin NOT NULL default '0',
  `Mail` varchar(1) collate utf8_bin NOT NULL default '0',
  `Webseite` mediumtext collate utf8_bin NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- 
-- Dumping data for table `Profile`
-- 

INSERT INTO `Profile` VALUES (0, 0x31, 0x30, 0x30, 0x30, 0x30, 0x31, 0x30, 0x30, 0x30, 0x30, 0x30, 0x31);

-- --------------------------------------------------------

-- 
-- Table structure for table `Schluessel`
-- 

CREATE TABLE IF NOT EXISTS `Schluessel` (
  `Nickname` varchar(64) collate utf8_bin NOT NULL,
  `Time` date NOT NULL,
  `Passwort` varchar(40) collate utf8_bin NOT NULL,
  `Mail` varchar(255) collate utf8_bin NOT NULL,
  `Wert` varchar(40) collate utf8_bin NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- 
-- Dumping data for table `Schluessel`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `USERS`
-- 

CREATE TABLE IF NOT EXISTS `USERS` (
  `ID` mediumint(9) NOT NULL,
  `Nickname` varchar(64) collate utf8_bin NOT NULL,
  `Passwort` varchar(64) collate utf8_bin NOT NULL,
  `Mail` varchar(255) collate utf8_bin NOT NULL,
  `Webseite` mediumtext collate utf8_bin NOT NULL,
  `Name` varchar(40) collate utf8_bin NOT NULL,
  `Vorname` varchar(40) collate utf8_bin NOT NULL,
  `Hardware` text collate utf8_bin NOT NULL,
  `Geburtstag` date NOT NULL,
  `Wohnort` varchar(40) collate utf8_bin NOT NULL,
  `PLZ` varchar(9) collate utf8_bin NOT NULL,
  `Kurzprofil` text collate utf8_bin NOT NULL,
  `Kontaktformular` binary(1) NOT NULL,
  `Software` text collate utf8_bin NOT NULL,
  `Reviews` text collate utf8_bin NOT NULL,
  `Anzeigen` text collate utf8_bin NOT NULL,
  `Freunde` text collate utf8_bin NOT NULL,
  `Anmeldung` datetime NOT NULL,
  `Kommentare` text collate utf8_bin NOT NULL,
  `Hardwarewuensche` text collate utf8_bin NOT NULL,
  `Softwarewuensche` text collate utf8_bin NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- 
-- Dumping data for table `USERS`
-- 

INSERT INTO `USERS` VALUES (0, 0x6b61697765676e6572, 0x35633939356262623831623032386238363965653465613763343462623161396561363135326263, 0x7765626d6173746572406b776e65747a77656c742e6465, 0x687474703a2f2f6b776e65747a77656c742e6e6574, 0x5765676e6572, 0x4b6169, '', '1985-01-21', 0x4265726e62757267, 0x3036343036, 0x4963682062696e20646572204b616920756e64207572737420746f6c6c21, 0x20, '', '', '', '', '2007-07-11 12:35:36', '', '', '');
