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
set_include_path('Register/');
## Abfrage ob angemeldet
if(UserLoggedIn() != 0){
	include("Content/LoggedIn.html");
}elseif(isset($_GET['UserKey']) ){
	## Benutzer erstellen Schritt 2
	$Array = DBQ("SELECT Wert,Nickname,Mail,Passwort FROM Schluessel WHERE Wert='".$_GET['UserKey']."'");
	print_r($Array);
	if(is_array($Array) && count($Array) > 0){
		## Benutzerfreischalten und Zeile erstellen ...
		$NewID = count(DBQ("SELECT ID FROM USERS"))+1;
		$Values  = "'".$NewID."'";
		$Values .= ",'".$Array[0]['Passwort']."'";
		$Values .= ",'".$Array[0]['Nickname']."'";
		$Values .= ",'".date("Y-m-d H:i:s",time())."'";
		$Values .= ",'".$Array[0]['Mail']."'";
		DBIN("USERS","ID,Passwort,Nickname,Anmeldung,Mail",$Values);
		DBIN("USERS","ID,Passwort,Nickname,Anmeldung,Mail",$Values);
		DBIN("Profile","ID,Nickname,Name,Vorname,PLZ,Wohnort,Profilbild,Kurzprofil,Kontakt,Galerie,Geburtstag",$NewID.',1,0,0,0,0,0,0,0,0,0');
		DBD("Schluessel","Wert='".$_GET['UserKey']."'");
		include("Content/Willkommen1.html");
	}else{
		include("Content/InternerFehler.html");
	}

}else{
	## Benutzer erstellen Schritt 1
	if(isset($_POST['Nickname']) && isset($_POST['Passwort1']) && isset($_POST['Passwort2']) && isset($_POST['Mail'])){
		$Array = DBQ("SELECT 'Nickname' FROM USERS WHERE Nickname='".$_POST['Nickname']."'");
		$Array2 = DBQ("SELECT 'Nickname' FROM Schluessel WHERE Nickname='".$_POST['Nickname']."'");
		$Array = array_merge($Array,$Array2);
		if(is_array($Array) && count($Array) > 0){ ## Wenn der Nickname schon vergeben ist ...
			include("Content/UserExists.html");
		}else{
			if(sha1($_POST['Passwort1']) != sha1($_POST['Passwort2'])){ ## Passwort Schreibfehler überprüfen
				include("Content/PasswortFehler.html");
			}elseif(!eregi("^[a-z0-9]+([-_\.]?[a-z0-9])+@[a-z0-9]+([-_\.]?[a-z0-9])+\.[a-z]{2,4}$", $_POST['Mail'])){ ## Falsche EMail-Adressen filtern
				include("Content/EMailFehler.html");
			}else{
				$Key = sha1($_POST['Mail'].time().$_POST['Nickname']); ## Freischaltschlüssel erstellen
				$Values  = "'".$_POST['Nickname']."'";
				$Values .=", '".date("Y-m-d",time())."'";
				$Values .=", '".sha1($_POST['Passwort1'])."'";
				$Values .=", '".$_POST['Mail']."'";
				$Values .=", '".$Key."'";
				DBIN("Schluessel","Nickname, Time, Passwort, Mail, Wert",$Values); ## Schlüssel und Werte in Datenbank einfügen
				$Inhalt = '
				Sie haben sich erfolgreich angemeldet.
				Klicken Sie den folgenden Link um ihren Account zu aktivieren:
				<a href="http://'.SERVER.SCRIPT.'?Register&UserKey='.$Key.'">Aktiviere deinen Account!</a>
				';
				SendMail(VON,VONNAME,$_POST['Mail'],REGISTERNEUBETREFF,$Inhalt); ## Freischalt Mail verschicken.
				include("Content/Schritt1Erfolg.html"); ## Erfolg melden.
			}
		}
	}else{
		include("Content/CreateUser.html");
	}
}
?>


