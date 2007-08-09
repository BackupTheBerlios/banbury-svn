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
	restore_include_path();
	echo LoadTPL("Hinweis",array('Message' => 'Bitte logge dich zuvor ein!'));	// Hinweis
	echo LoadTPL("Login");	// Login
}else{

		include("Content/Options.php");

	if(isset($_GET['Edit'])){ // Anzeigen des Profil-Änderungs-Bereiches

			if(isset($_POST['Values'])){ // Speichern des geänderten Profils

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
				DBU(DBTabProfiles,"ID='".$_SESSION['ID']."'",$Update); // Anzeigestatus speichern

				if($_FILES['Profilbild']['size'] > 0 ){ // Profilbild speichern
					CreateThumbnail(120,$_FILES['Profilbild'],AvatarVerzeichnis."/".$_SESSION['Nickname'].".jpg");
				}

			}
		// Anzeigen des eigenen Profils im Editiermodus ...

		$Array = DBQ("SELECT * FROM ".DBTabUsers." WHERE ID='".$_SESSION['ID']."'");
		$Array = $Array[0];
		$Show = DBQ("SELECT * FROM ".DBTabProfiles." WHERE ID='".$_SESSION['ID']."'");
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

	}elseif(isset($_GET['EditMyGalerie'])){

		// Neues Bild einfügen ...

		if(isset($_FILES['Bild']) && $_FILES['Bild']['size'] > 0){
			$MyPics = DBQ("SELECT ID FROM ".DBTabPictures." WHERE BesitzerID = '".$_SESSION['ID']."'");
			if(isset($MyPics) && count($MyPics) > MAXPICSCOUNT){
				include("Content/TooManyPicsInGal.html");
			}else{
				if(CreateContent($_POST['Titel'], "Bild", time(), $_SESSION['ID'], $_FILES)){
					include("Content/NeuesBildErfolg.html");
				}else{
					Error("Bild konnte nicht eingefügt werden");
				}
			}
		}
		// Bild löschen

		if(isset($_GET['Remove']) && isset($_GET['ID'])){ // Ein Bild Löschen
			ZapContent($_GET['ID'],"Bild");
		}

		// Eigene Galerie im Editiermodus anzeigen

		include("Content/NewImage.php");
		$Bilder = DBQ("SELECT * FROM ".DBTabPictures." WHERE BesitzerID='".$_SESSION['ID']."' ORDER BY ID");
		include("Content/ImageList.php");

	}elseif(isset($_GET['EditMyHardware'])){

		// Eigene Hardware im Editiermodus anzeigen
		if(!isset($_SESSION['Hardware']) or !is_array($_SESSION['Hardware'] ))
			$_SESSION['Hardware'] = array();

		include("Content/AddHardware.php");
		$MyHardwareEdit = true;
		include("Content/MyHardware.php");

	}else{

		// Profil anzeigen
		include("Content/Praesentation.php");
	}
}
?>