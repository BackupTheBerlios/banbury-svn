
CREATE DATABASE IF NOT EXISTS `MacOnly` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE MacOnly;

DROP TABLE IF EXISTS `Properties`;
CREATE TABLE IF NOT EXISTS `Properties` (
  `Name` varchar(50) NOT NULL,
  `Value` varchar(200)
);

DROP TABLE IF EXISTS `Bilder`;
CREATE TABLE IF NOT EXISTS `Bilder` (
  `BesitzerID` mediumint(9) NOT NULL,
  `ID` mediumint(9) NOT NULL,
  `Dateiname` mediumtext collate utf8_bin NOT NULL,
  `Titel` mediumtext collate utf8_bin NOT NULL,
  `Thumbnail` mediumtext collate utf8_bin NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

DROP TABLE IF EXISTS `Profile`;
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

DROP TABLE IF EXISTS `Schluessel`;
CREATE TABLE IF NOT EXISTS `Schluessel` (
  `Nickname` varchar(64) collate utf8_bin NOT NULL,
  `Time` date NOT NULL,
  `Passwort` varchar(40) collate utf8_bin NOT NULL,
  `Mail` varchar(255) collate utf8_bin NOT NULL,
  `Wert` varchar(40) collate utf8_bin NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

DROP TABLE IF EXISTS `USERS`;
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

CREATE USER '@DBBENUTZER@' IDENTIFIED BY '@DBPASSWORT@';
GRANT DELETE, INSERT, UPDATE, SELECT ON MacOnly.* TO '@DBBENUTZER@'@'localhost';
