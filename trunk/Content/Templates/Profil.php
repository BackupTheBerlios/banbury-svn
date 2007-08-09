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

$Array = DBQ("SELECT * FROM ".DBTabUsers." WHERE ID='".$_SESSION['ID']."'");
$Array = $Array[0];

$Show = DBQ("SELECT * FROM ".DBTabProfiles." WHERE ID='".$_SESSION['ID']."'");
$Show = $Show[0];

reset($Show);
while($key = key($Show)){
	$current = current($Show);
	if($current != 1){
		$Array[$key] = "";
	}
	next($Show);
}
extract($Array,EXTR_OVERWRITE);

$Profil = '
	<a href="?Profil/&Edit">Bearbeiten</a><br />
	<img src="'.AvatarVerzeichnis."/".$_SESSION['Nickname'].'.jpg" alt="Profilbild" align="left" />
	'.$Nickname.'<br />
	'.$Vorname.' '.$Name.'<br />
	'.$PLZ.' '.$Wohnort.'<br />
	'.$Geburtstag.' '.$Webseite.'<br clear="all" />
			'.$Kurzprofil.'';

$Galerie = '<strong>Meine Galerie</strong> <a href="?Profil/&EditMyGalerie">Bearbeiten</a>';

ob_start();
require("MyImageList.php");
$Galerie .= ob_get_contents();
ob_end_clean();

$Freunde = '<strong>Freunde</strong>';
$Reviews = '<strong>Reviews</strong>';
$Hardware = '<strong>Hardware</strong>';
$Software = '<strong>Software</strong>';
$Anzeigen = '<strong>Anzeigen</strong>';

$Reihenfolge = DBQ("SELECT Sorted FROM USERS WHERE ID=".$_SESSION['ID']);

$Reihenfolge = explode(",",$Reihenfolge[0]['Sorted']);

// Ausgabe der definierten Reihenfolge ...

foreach($Reihenfolge as $Object){

	echo "<div id=\"".$Object."\">\n";
	echo $$Object;
	echo "\n</div>\n\n";

}


?>
