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

// Diese Datei kann extern aufgerufen werden.
// Z.B. durch Scripte von Banbury (Ajax) oder andere Software um bestimmte Aufgaben zu erledigen.


ob_start(); // Put all that in Buffer

set_include_path('php');

require('Includes.php');
## Eventuell sollte das (29) in Zeile 45 um Fremdaufrufe zu verhindern?
## Dann müssten aber initDBConnection und UserLoggedIn ausgelagert werden
require('Functions.php');
require('RemoteFunctions.php');

initDBConnection();

## Startet eine Session
session_start();

if(!UserLoggedIn()){
	Error("Du bist nicht angemeldet.");
	die();
}

if(function_exists($_POST['Function'])){
	$Values = $_POST;
	unset($Values['Function']);

	echo call_user_func_array($_POST['Function'], $Values);
}



mysql_close($db);

$Return = ob_get_contents();
ob_end_clean();
echo $Return;

?>
