<?php
/*
 * Created on Jul 27, 2007
 *
 * Diese Datei sorgt dafür, dass die Admins bestimmte Aufgaben erledigen können.
 */

# set_include_path('../php'); // Das machen wir erst wenn wir fertig sind ...

require('../php/Includes.php');
require('../php/Functions.php');

	$db = mysql_connect(DBHost.":".DBPort,DBUser,DBPass) or require("../Content/DBConnectError.php");
	$db_selected = mysql_select_db(DBName,$db) or die("Auswahl der Datenbank fehlgeschlagen");

## Startet eine Session
session_start();




$PendingUsers = DBQ("SELECT Nickname,Mail,Time FROM Schluessel");
$PendingUsersTable = QueryToTable($PendingUsers);
$RegisteredUsers = DBQ("SELECT ID,Nickname,Anmeldung,Mail FROM Users");

$RegisteredUsersTable = QueryToTable($RegisteredUsers);
echo "Pending Users (".count($RegisteredUsers).")";

echo $PendingUsersTable;
echo "Registered Users";
echo "(".count($RegisteredUsers).")";
echo $RegisteredUsersTable;
?>