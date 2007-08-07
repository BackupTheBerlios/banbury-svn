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

// Dies sind Funktionen, die ausschließlich in CallFunc.php includiert werden
// und daher nur für den externen Zugriff geeignet sind.
// Das wäre dann die ominöse API ^^

function AjaxTrue($Message){

	set_include_path("Content/Templates/");
	include("AjaxTrue.php");

}

function AjaxError($Message){

	set_include_path("Content/Templates/");
	include("AjaxError.php");

}

function sProfilSpeichern($Sorted){
	include("Config/Messages.php");
	global $_SESSION;
	if($Error = @DBU(DBTabUsers,"ID=".$_SESSION['ID'],"Sorted='".$Sorted."'")){
		AjaxTrue($MESSAGES['Erfolg']['Profil']['Sortiert']);
	}else{
		AjaxError($MESSAGES['Fehler']['Profil']['Sortiert']);
	}

}
?>
