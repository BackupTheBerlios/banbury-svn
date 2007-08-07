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

if(isset($_GET['Bild'])){
	$ID = addslashes($_GET['Bild']);
	$Array = DBQ("SELECT * FROM ".DBTabPictures." WHERE ID='".$ID."'");
	$Array = $Array[0];
	// Als erstes Das Bild und sein Titel ...
	echo LoadTPL("Bild",
		array(
		'Bild' => BilderVerzeichnis."/Skaliert/".$Array['Skaliert'],
		'OnClick' => "BWOpen('".BilderVerzeichnis."/Orginale/".$Array['Dateiname']."')",
		'OnMouseover' => "",
		'Titel'  => $Array['Titel']
		)
	);
	// Neuer Kommentar ...
	if(isset($_POST['Kommentar']) && $_POST['Kommentar']!=""){
		$META = array(
			'Titel' => $_POST['Titel'],
			'ZuID' => $ID,
			'ZuType' => 'Bilder'
		);
		if(!CreateContent($_POST['Kommentar'], "Kommentar", time(), $_SESSION['ID'], $META))
			Error("Konnte Kommentar nicht erzeugen!");
	}
	// Kommentare zu diesem Bild ...
	$Kommentare = DBQ("SELECT * FROM ".DBTabComments." WHERE ZuID='".$ID."' AND ZuType='Bilder' ORDER BY Time");
	// Seitenzahl generieren ...
	if(isset($_GET['Page'])){
		$Page = $_GET['Page'];
		$StartWert = ($Page-1) * MAXITEMSINLIST;
	}else{
		$Page = 1;
		$StartWert = 0; // Wenn wir auf Seite 1 sind, beginnen wir mit dem ersten Bild.
	}
	// Inhaltsliste anfangen ...
	if(count($Kommentare) > 0){
		$CL = InitContentList("Kommentare",count($Kommentare),$Page,"Bilder&Bild=".$ID);
		if($CL != 0){
			$x = $StartWert;
			do{
				$Kommentar = $Kommentare[$x];
				$Autor = DBQ("SELECT Nickname FROM ".DBTabUsers." WHERE ID='".$Kommentar['BesitzerID']."'");
				if(isset($Autor[0]) && isset($Autor[0]['Nickname'])){
					$Autor = $Autor[0]['Nickname'];
				}else{
					$Autor = "anonymous"; // <- falls der Benutzer nicht mehr existiert ... könnte ja sein
				}
				$CLValues = array(
					'Titel' => $Kommentar['Titel'],
					'Inhalt' => $Kommentar['Inhalt'],
					'Time' => $Kommentar['Time'],
					'Autor' => $Autor
				);

				$x++;

			}while(AddToContentList("CL",$CLValues)== 1 && $x < count($Kommentare));
			echo OutputContentList("CL","List");
		}
	}
	// Kommentarfunktion ...
	echo LoadTPL("KommentarNeu");

}else{
	$Array = DBQ("SELECT ID,Titel,Skaliert,Thumbnail,Dateiname FROM ".DBTabPictures." ORDER BY Time");
	if(isset($_GET['Page'])){
		$Page = $_GET['Page'];
		$StartWert = ($Page-1) * MAXITEMSINLIST;
	}else{
		$Page = 1;
		$StartWert = 0; // Wenn wir auf Seite 1 sind, beginnen wir mit dem ersten Bild.
	}
	$CL = InitContentList("Bilder",count($Array),$Page,"Bilder");
	if($CL != 0){
		$x = $StartWert;
		do{
			$Bild = $Array[$x];
			$CLValues = array(
				'Titel' => $Bild['Titel'],
				'Link' => '?Bilder&Bild='.$Bild['ID'],
				'Skaliert' => $Bild['Skaliert'],
				'Thumbnail' => $Bild['Thumbnail'],
				'Inhalt' => $Bild['Dateiname']
			);
			$x++;
		}while(AddToContentList("CL",$CLValues)== 1 && $x< count($Array));
		echo OutputContentList("CL","Icons");
	}else{
		Error("Konnte Inhaltsliste nicht erstellen. ");
	}
}
?>