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

if(isset($_GET['Edit'])){

	// Eigene Hardware im Editiermodus anzeigen
	if(!isset($_SESSION['Hardware']) or !is_array($_SESSION['Hardware'] ))
		$_SESSION['Hardware'] = array();

	include("Content/AddHardware.php");
	$MyHardwareEdit = true;
	include("Content/MyHardware.php");
}



?>
