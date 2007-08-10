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

$Bilder = DBQ("SELECT * FROM ".DBTabPictures." WHERE BesitzerID='".$_SESSION['ID']."' ORDER BY ID");
if(is_array($Bilder) && count($Bilder) > 0){
	foreach($Bilder as $Bild){
		echo '<br />';
		echo '<a href="'.BilderVerzeichnis."/Skaliert/".$Bild['Skaliert'].'" rel="lightbox"><img src="'.BilderVerzeichnis."/Thumbnails/".$Bild['Thumbnail'].'" alt="'.$Bild['Titel'].'" title="'.$Bild['Titel'].'" /></a>';
		echo '<a href="?Bilder/&Bild='.$Bild['ID'].'">'.$Bild['Titel'].'</a> ';
		if(isset($_GET['Edit']))
			echo '<a href="?Bilder/&Edit&Remove&ID='.$Bild['ID'].'">Löschen</a>';
		echo '<br />';
	}
}
?>