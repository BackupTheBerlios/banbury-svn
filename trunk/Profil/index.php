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
set_include_path('Profil/');

if(!UserLoggedIn()){
	include("Content/Error.html");
}else{
	if(isset($_POST['Values']) && isset($_GET['Edit'])){ // Speichern des geänderten Profils

		$Array = DBQ("SELECT * FROM USERS WHERE ID='".$_SESSION['ID']."'");
		$Array = $Array[0];
		$Show = DBQ("SELECT * FROM Profile WHERE ID='".$_SESSION['ID']."'");


		$Values = $_POST['Values'];
		$Update = aArrayIntoString($Values);
		DBU("USERS","ID='".$_SESSION['ID']."'",$Update); // Werte speichern
		if(is_array($Show)){
			$Show = $Show[0];

			reset($Show);
			unset($Show['ID']);
			unset($Show['Nickname']);
			while($key = key($Show)){ // Anzeigestatus auf 0
				if(isset($_POST['Show'][$key]) && $_POST['Show'][$key] != 0){
					$Show[$key] = 1;
				}else{
					$Show[$key] = 0;
				}
				next($Show);
			}
		}
		$Show['Nickname'] = 1; // Nickname muss angezeigt werden
		$Update = aArrayIntoString($Show); // Array zu String
		DBU("Profile","ID='".$_SESSION['ID']."'",$Update); // Anzeigestatus speichern

		if($_FILES['Profilbild']['size'] > 0 ){ // Profilbild speichern
			CreateThumbnail(120,$_FILES['Profilbild'],AvatarVerzeichnis."/".$_SESSION['Nickname'].".jpg");
		}

	}
	if(isset($_GET['Edit'])){ // Anzeigen des Profil-Änderungs-Bereiches

		$Array = DBQ("SELECT * FROM USERS WHERE ID='".$_SESSION['ID']."'");
		$Array = $Array[0];
		$Show = DBQ("SELECT * FROM Profile WHERE ID='".$_SESSION['ID']."'");
		if(is_array($Show))
		$Show = $Show[0];

		if(is_array($Show)){
			reset($Show);
			while($key = key($Show)){
				$current = current($Show);
				if($current == 1){
					$current = 'checked="checked"';
				}else{
					$current = '';
				}
				$Show[$key] = $current;
				next($Show);
			}
		}
		extract($Array,EXTR_OVERWRITE);
		include("Content/Edit.php");

	}elseif(isset($_GET['EditMyGalerie']) && isset($_FILES['Bild']) && $_FILES['Bild']['size'] > 0){
		$MyPics = DBQ("SELECT ID FROM Bilder WHERE BesitzerID = '".$_SESSION['ID']."'");
		if(isset($MyPics) && count($MyPics) > MAXPICSCOUNT){
			include("Content/TooManyPicsInGal.html");
		}else{
		/*	$AllPics = DBQ("SELECT * FROM Bilder");
			$AllPics = count($AllPics);

			$ThumbCount = DirCount(BilderVerzeichnis."/Thumbnails/");
			$PicCount = DirCount(BilderVerzeichnis."/Orginale/");

			$ThumbName = $ThumbCount."-".$_FILES['Bild']['name'].".jpg";
			$PicName = $PicCount."-".$_FILES['Bild']['name'];

			DBIN("Bilder","BesitzerID,ID,Dateiname,Thumbnail,Titel","'".$_SESSION['ID']."','".$AllPics."','".$PicName."','".$ThumbName."','".$_POST['Titel']."'"); // Eintrag in die Datenbank
			CreateThumbnail(120,$_FILES['Bild'],BilderVerzeichnis."/Thumbnails/".$ThumbName); // Thumbnail erstellen
			copy($_FILES['Bild']['tmp_name'],BilderVerzeichnis."/Orginale/".$PicName); // Datei kopieren
			*/
			if(CreateContent($_POST['Titel'], "Bild", time(), $_SESSION['ID'], $_FILES)){
				include("Content/NeuesBildErfolg.html");
			}else{
				Error("Bild konnte nicht eingefügt werden");
			}
		}
	}elseif(isset($_GET['EditMyGalerie'])){
		if(isset($_GET['Remove']) && isset($_GET['ID'])){ // Ein Bild Löschen
			$Bild = DBQ("SELECT * FROM Bilder WHERE ID='".$_GET['ID']."'");
			$Bild = $Bild[0];
			if($Bild['BesitzerID'] == $_SESSION['ID']){
				/// KOMMENTARE LÖSCHEN HIER EINFUEGEN WENN BEREIT!!!
				unlink(BilderVerzeichnis."/Thumbnails/".$Bild['Thumbnail']);
				unlink(BilderVerzeichnis."/Orginale/".$Bild['Dateiname']);
				DBD("Bilder","ID=".$_GET['ID']);
			}else{
				restore_include_path();
				include("Content/NotAllowed.html");
			}
		}
		include("Content/NewImage.php");
		$Bilder = DBQ("SELECT * FROM Bilder WHERE BesitzerID='".$_SESSION['ID']."' ORDER BY ID");
		include("Content/ImageList.php");

	}else{ // Profil anzeigen


		$Array = DBQ("SELECT * FROM USERS WHERE ID='".$_SESSION['ID']."'");
		$Array = $Array[0];
		$Show = DBQ("SELECT * FROM Profile WHERE ID='".$_SESSION['ID']."'");
		$Show = $Show[0];

		$Bilder = DBQ("SELECT * FROM Bilder WHERE BesitzerID='".$_SESSION['ID']."' ORDER BY ID");
		reset($Show);
		while($key = key($Show)){
			$current = current($Show);
			if($current != 1){
				$Array[$key] = "";
			}
			next($Show);
		}
		extract($Array,EXTR_OVERWRITE);
		include("Content/Praesentation.php");
	}
}
?>