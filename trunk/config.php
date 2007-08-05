<?php
/*
This file is part of Banbury.

Banbury is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 3 of the License.

Banbury is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/




$config = 1; // Auf 1 setzen, um Config zu aktivieren





?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="de">
<head>
  <title>Konfiguration</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <link rel="stylesheet" type="text/css" href="css/config.css" />
</head>
<body>
<?php


if($config ==0) die("Config nicht zugelassen");

$aktionen = array(
	erzeugeTabellen => "Tabellen neu erstellen",
	erzeugeTabellen2 => "Wirklich Tabellen neu erstellen?",
	aktualisiereTabellen => "Tabellen aktualisieren",
	aktualisiereTabellen2 => "Tabellen aktualisieren",
	cfgTest => "Konfiguration überprüfen",
	resetAdmin => "Administrator einrichten"
);

$aktion = $_GET['aktion'];

if ($aktionen[$aktion] != "") {
	call_user_func($aktion);
} else {
	cfgTest();
}

function erzeugeTabellen() {
	echo "<p>";
	echo actionLink("erzeugeTabellen2");
	echo "<br />oder zurück zu<br />";
	echo actionLink("cfgTest");
	echo "</p>\n";
}

function erzeugeTabellen2() {
	initDBConnection();
	global $db;
	mysql_query("DROP TABLE IF EXISTS " . DBTabPictures, $db);
	ergebnis(mysql_query("CREATE TABLE IF NOT EXISTS `" . DBTabPictures . 
		"` (
			`BesitzerID` mediumint(9) NOT NULL, 
			`ID` mediumint(9) NOT NULL, 
			`Dateiname` mediumtext collate utf8_bin NOT NULL, 
			`Titel` mediumtext collate utf8_bin NOT NULL, 
			`Thumbnail` mediumtext collate utf8_bin NOT NULL
		) DEFAULT CHARSET=utf8 COLLATE=utf8_bin", $db), "Tabelle für Bilder", "angelegt", "Fehler beim Anlegen: " . mysql_error($db));

	mysql_query("DROP TABLE IF EXISTS " . DBTabProfiles, $db);
	ergebnis(mysql_query("CREATE TABLE IF NOT EXISTS `". DBTabProfiles. 
		"` (
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
		) DEFAULT CHARSET=utf8 COLLATE=utf8_bin", $db),
		"Tabelle für Profile",
		"angelegt",
		"Fehler beim Anlegen: " . mysql_error($db));

	mysql_query("DROP TABLE IF EXISTS " . DBTabKeys, $db);
	ergebnis(mysql_query("CREATE TABLE IF NOT EXISTS `". DBTabKeys. 
		"` (`Nickname` varchar(64) collate utf8_bin NOT NULL, `Time` date NOT NULL, `Passwort` varchar(40) collate utf8_bin NOT NULL, `Mail` varchar(255) collate utf8_bin NOT NULL, `Wert` varchar(40) collate utf8_bin NOT NULL) DEFAULT CHARSET=utf8 COLLATE=utf8_bin", $db), 
		"Tabelle für Schlüssel",
		"angelegt",
		"Fehler beim Anlegen: " . mysql_error($db));

	mysql_query("DROP TABLE IF EXISTS " . DBTabUsers, $db);
	ergebnis(mysql_query("CREATE TABLE IF NOT EXISTS `". DBTabUsers . 
		"` (
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
		) DEFAULT CHARSET=utf8 COLLATE=utf8_bin;", $db),
		"Tabelle für Benutzer",
		"angelegt",
		"Fehler beim Anlegen: " . mysql_error($db));

	mysql_query("DROP TABLE IF EXISTS " . DBTabProperties, $db);
	ergebnis(mysql_query("CREATE TABLE IF NOT EXISTS `". DBTabProperties .
		"` (
			`PropName` varchar(50) NOT NULL UNIQUE,
			`PropValue` varchar(200)
		) DEFAULT CHARSET=utf8 COLLATE=utf8_bin;", $db),
		"Tabelle für Systemdaten",
		"angelegt",
		"Fehler beim Anlegen: " . mysql_error($db));
	ergebnis(DBSetProperty(DBPTabVersion, "1"),
		"Tabellenversion",
		"gespeichert",
		"nicht gespeichert: " . mysql_error($db));
	
	echo actionLink("cfgTest");
}

function initDBConnection() {
	set_include_path('php');
	require_once('Includes.php');
	require_once('Functions.php');
	global $db;
	$db = mysql_connect(DBHost.":".DBPort,DBUser,DBPass);
	$db_selected = mysql_select_db(DBName,$db);
}

function actionLink($aktion) {
	global $aktionen;
	return "<a href=\"config.php?aktion=$aktion\">$aktionen[$aktion]</a>";
}



function ergebnis($ok, $text, $textok, $textfail) {
	$cssclass = ($ok ? "testok" : "testfail");
	echo "<p>$text</p>\n";
	echo "<p class=\"$cssclass\">" . ($ok ? $textok : $textfail) . "</p>\n";
}

function cfgTestDBConfigExists() {
	$result = file_exists("php/Config/DB.php");
	ergebnis($result, "Existiert die Datei DB.php im Ordner php/Config?", "Ja", "Kopieren Sie die Datei »php/Config/DB.php.vorlage« nach »php/Config/DB.php« und passen Sie sie an.");
	return $result;
}

function cfgTestDBAccess() {
	set_include_path('php');
	require_once('Includes.php');
	require_once('Functions.php');
	$result = false;
	$result = $db = @mysql_connect(DBHost.":".DBPort,DBUser,DBPass);
	ergebnis($result, "Verbindung zum Datenbankserver", "Geöffnet", "Die Anmeldung am Datenbankserver schlug fehl. Prüfen Sie den Servernamen, Benutzernamen und Passwort.");
	if ($result) {
		$result = $dbcheck = @mysql_select_db(DBName,$db);
		ergebnis($result, "Öffnen der Datenbank", "Erfolgreich", "Die Datenbank konnte nicht geöffnet werden.");
	}
	return $result;
}

function cfgTestDBTablePropertiesExist() {
	global $db;
	$result = false;
	$dbr = mysql_list_tables(DBName, $db);
	$anzahl = mysql_num_rows($dbr);
  	for($x=0;$x<$anzahl;$x++) if (mysql_tablename($dbr,$x) == DBTabProperties) $result = true;
	ergebnis($result, "Systemtabelle", "Vorhanden", "Nicht vorhanden: ". actionLink("erzeugeTabellen"));
	return $result;
}

function cfgTestDBTablesVersionMatch() {
	$tabversion = DBGetProperty(DBPTabVersion);
	$result = $tabversion == "1";
	ergebnis($result, "Tabellenaktualisierung erforderlich", "nein", "ja: " . actionLink("aktualisiereTabellen") . " oder " . actionLink("erzeugeTabellen"));
	return $result;
}

function cfgTestDB() {
	echo "<h2>Datenbank</h2>\n";
	if ($result = cfgTestDBConfigExists()) {
		if($result = cfgTestDBAccess()) {
			initDBConnection();
			if ($result = cfgTestDBTablePropertiesExist()) {
				if($result = cfgTestDBTablesVersionMatch()) {
				}
			}
		}
	}
	return $result;
}

function cfgAdmin() {
	echo "<h2>Administrator</h2>";
	echo "<form action=\"config.php?aktion=resetAdmin\" method=\"POST\" accept-charset=\"UTF-8\">
	<div>
		<label for=\"username\">Benutzername</label>:
			<input id=\"username\" name=\"username\" type=\"text\" /><br />
		<label for=\"kennwort1\">Kennwort</label>:
			<input id=\"kennwort1\" name=\"kennwort1\" type=\"password\" /><br />
		<label for=\"kennwordt\">Kennwort wiederholen</label>
			<input id=\"kennwort2\" name=\"kennwort2\" type=\"password\" /><br />
		<input type=\"submit\" value=\"Administrator einrichten\" />
	</div>
       </form>";
}

function cfgWarnung() {
	echo "<p class=\"warnung\">Achtung: Konfiguration ist zugelassen! Bitte schalten Sie dies nach dem erfolgreichen Durchlaufen dieser Seite ab, indem Sie in der Datei »config.php« den Wert für \$config auf 0 setzen!</p>";
}

function resetAdmin() {
	global $_POST;
	$username = $_POST["username"];
	$kennwort1 = $_POST["kennwort1"];
	$kennwort2 = $_POST["kennwort2"];
	$result = false;
	if (strlen($kennwort1)>7) {
		if ($kennwort1 == $kennwort2) {
			//Erzeuge Benutzer und Passworteintrag
			$result = true;
		} else {$fehler = "Passwörter weichen ab";}
	} else {$fehler = "Passwort zu kurz (mindestens 8 Stellen erforderlich)";}
	if ($fehler != "") {
		$fehler = "Fehlgeschlagen: " . $fehler . "<br /><a href=\"config.php\" onClick=\"javascript:history.back();return false;\">zurück</a>";
	}
	ergebnis($result, "Administrator anlegen", "Erfolgreich",  $fehler);
	cfgWarnung();
}

function cfgTest() {
	cfgWarnung();
	echo "<h1>Konfiguration</h1>\n";
	if (cfgTestDB()) {
		cfgAdmin();
	}
	cfgWarnung();
}

?>
</body>
</html>