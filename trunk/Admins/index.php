<?php
/*
 * Created on Jul 27, 2007
 *
 * Diese Datei sorgt dafür, dass die Admins bestimmte Aufgaben erledigen können.
 */

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