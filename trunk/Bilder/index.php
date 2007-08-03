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

$Pics = addslashes(array_keys($_GET));
if(isset($Pics[1])){
	$Array = DBQ("SELECT * FROM Bilder WHERE ID='".$Pics[1]."'");
	$Array = $Array[0];
	$Bild = "<img src=\"Bilder/Orginale/".$Array['Dateiname']."\" />";
	$Titel = $Array['Titel'];
	include("Content/Bild.php");
}else{

	$Array = DBQ("SELECT ID,Titel,Dateiname FROM Bilder");
	$CL = InitContentList("Bilder");

	foreach($Arraqy as $Bild){
		$Titel = $Bild['Titel'];
		$Link = '?Bilder&'.$Bild['ID'];

		AddToContentList("CL",$Titel,$Inhalt,$Link);

	}
	OutputContentList($CL,"icons");
}
?>