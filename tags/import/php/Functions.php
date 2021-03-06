<?php


$QUERIES = "";
$LSRARRAY = array();
$LSRCOUNT = 0;

function Ls($verzeichnis){
	$ARRAY=array();
	if(is_dir($verzeichnis)){
		$x=0;
		$handle=opendir ($verzeichnis);
		while (false !== ($file = readdir ($handle))) {
			if ($file!="." && 	$file!=".."){
				if(is_file($verzeichnis."/".$file) or is_dir($verzeichnis."/".$file)){
					$ARRAY[$x]=$file;
					$x++;
				}

			}
		}
		closedir($handle);
	}
	if(isset($ARRAY) && is_array($ARRAY)){
		sort($ARRAY);
		return $ARRAY;
	}

}

function DirCount($verzeichnis){
	echo $verzeichnis;
	if(is_dir($verzeichnis)){
		$x=0;
		$handle=opendir ($verzeichnis);
		while (false !== ($file = readdir ($handle))) {
			if ($file!="." && 	$file!=".."){
				if(is_file($verzeichnis."/".$file) or is_dir($verzeichnis."/".$file)){
					$x++;
				}

			}
		}
		closedir($handle);
		echo $x;
		return $x;
	}else{
		return false;
	}

}


function Lsrr($verzeichnis,$ZIANO_LSRARRAY,$ZIANO_LSRCOUNT,$Option){
	global $LSRARRAY;
	global $LSRCOUNT;
	if(is_dir($verzeichnis)){
		$x=0;
		$handle=opendir ($verzeichnis);
		while (false !== ($file = readdir ($handle))) {
			if ($file!="." && 	$file!=".."){
				if(is_file("$verzeichnis/$file") && $Option == "f"){
					$LSRARRAY[$LSRCOUNT]="$verzeichnis/$file";
					$LSRCOUNT++;
					#	echo "$verzeichnis/$file";
				}elseif(is_dir("$verzeichnis/$file")){
					if($Option == "d"){
						$LSRARRAY[$LSRCOUNT]="$verzeichnis/$file";
						$LSRCOUNT++;
					}
					Lsrr("$verzeichnis/$file",$LSRARRAY,$LSRCOUNT,$Option);
				}
				$x++;
			}
		}
		closedir($handle);
	}
}


function Lsr($verzeichnis, $Option ="f"){

	global $LSRARRAY;
	if(is_dir($verzeichnis)){
		$LSRARRAY=array();
		if(fnmatch("*/",$verzeichnis))
			$verzeichnis= preg_replace('/\/$/',"",$verzeichnis);
		Lsrr($verzeichnis,$LSRARRAY,0,$Option);
	}else{
		return false;
	}
	if(isset($LSRARRAY) && is_array($LSRARRAY)){
		sort($LSRARRAY);
		return $LSRARRAY;
	}else{
		return false;
	}
}




function ShortenString($String,$Length){
	if(strlen($String) > $Length){
		$String = utf8_decode($String);
		$String = substr($String,0,($Length-5))."...".substr($String,strlen($String)-5,5);
		$String = utf8_encode($String);
	}
	return $String;
}

function Error($Value){
	echo '<div class="Error" id="Error"><img src="IconsPNG/PasswordNotOK.png" align="left" /><h2>Ein Fehler trat auf.</h2> <strong>Kdb meldet:</strong> <br /><em><br />';
	echo $Value;
	echo '</em><div style="position:absolute;bottom:5px;right:5px;"><input type="button" value="Ausblenden" onclick="FadeOutError();" class="MiniButton"/></div></div>';
}

function MKPass(){
	$pass="";
	$chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
	for ($i=0; $i<9; $i++){
		$r = rand(0,strlen($chars));
		$str = substr($chars,$r,1);
		$pass = $pass.$str;
	}
	return $pass;
}

function SendMail($von,$vonname,$an,$betreff,$inhalt){
	global $GlobalMailEncoding;
	global $GlobalMailHeader;
	global $GlobalMailFooter;

	$header="From:$vonname<$von>\n";
	global $REMOTE_ADDR;
	$header .= "Reply-To: $von\n";
	$header .= "X-Mailer: PHP" . phpversion(). "\n";
	$header .= "X-Sender-IP: $REMOTE_ADDR\n";
	$header .= "Content-Type: ".$GlobalMailEncoding;
	$inhalt = $GlobalMailHeader.$inhalt.$GlobalMailFooter;
	mail($an, $betreff, $inhalt, $header);
}

function aArrayIntoString($Array){
	reset($Array);
	$Vars = "";
	while($key = key($Array)){
		$Vars .="$key = '".current($Array)."', ";
		next($Array);
	}
	$Vars = substr($Vars,0,strlen($Vars)-2);
	return $Vars;
}
function UserLogin($Nickname ='',$Passwort =''){
	$Array = DBQ("SELECT Nickname,Passwort,ID from USERS WHERE Nickname = '".$Nickname."' AND Passwort = '".$Passwort."'");
	if(isset($Array[0])){
		session_register('Nickname');
		$_SESSION['Nickname'] = $Array[0]['Nickname'];
		session_register('Passwort');
		$_SESSION['Passwort'] = $Array[0]['Passwort'];
		session_register('ID');
		$_SESSION['ID'] = $Array[0]['ID'];
		return true;
	}else{
		return false;
	}
}

## Fragt, ob ein Benutzer eingeloggt ist
##
## [bool] UserLoggedIn( [void] )
##
## Diese Funktion testet ob die in der Session gespeicherten Variablen Nickname und Passwort
## in der Datenbank gespeichert sind. Bei Erfolg gibt die Funktion true zurück, sonst false.

function UserLoggedIn(){
	global $_SESSION;

	if(session_is_registered('Nickname') && session_is_registered('Passwort')){
		$Array = DBQ("SELECT ID,Nickname from USERS WHERE Nickname = '".$_SESSION['Nickname']."' AND Passwort = '".$_SESSION['Passwort']."'");
		if(isset($Array[0]) && $Array[0]['ID'] == $_SESSION['ID']){
			return true;
		}else{
			session_destroy();
			return false;
		}
	}else{
		### ändern, wenn Anmeldung programmiert
		return false;
	}
}


## Fragt, ob ein Benutzer existiert
##
## [bool] UserExists( $Name )
##
## [string] $Name - Benutzername (Nickname)
##
## Die Funktion gibt true zurück, wenn ein Benutzer in der Datenbank eingetragen ist, sonst false.

function UserExists($Name){
	$Array = DBQ("SELECT Nickname FROM USERS WHERE Nickname='".$Name."'");
	if(is_array($Array) && count($Array) > 0){
		return true;
	}else{
		return false;
	}
}

## Alias von UserExists
##
## [bool] IsUser( $Name )
##
## [string] $Name - Benutzername (Nickname)
##
## Die Funktion gibt true zurück, wenn ein Benutzer in der Datenbank eingetragen ist, sonst false.

function IsUser($Name){
	return UserExists($Name);
}

## Generiert ein zufälliges Passwort mit $Length-Zeichen länge.
##
## [string] GeneratePasswort( $Length )
##
## [int] $Length - Länge des Passworts
##
## Das generierte Passwort enthält zufällige Buchstaben, Zahlen und/oder :-,+
function GeneratePasswort($Length){
	$Passwort = "";
	$array = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789:-,+";
	$StrLength = strlen($array);
	for($x=0;$x<$Length;$x++){
		$Rand = rand(0,$StrLength);
		$Passwort .= substr($array,$Rand,1);
	}
	return $Passwort;
}

## Startet eine Datenbankabfrage, ob die angegebene $Mail auch zum $Name (Nickname) gehört
##
## [bool] UserHasMail ( $Name, $Mail)
##
## [string] $Name - Eingetragener Nickname eines Benutzers
## [string] $Mail - (nach Möglichkeit) Eingetragene Mailadresse eines Benutzers
##
## Die Funktion fragt die Datenbank, ob Nickname und Mailadresse dem gleichen User gehören.
## Bei Erfolg wird true zurückgegeben, sonst false.

function UserHasMail($Name,$Mail){
	$Array = DBQ("SELECT Nickname,Mail FROM USERS WHERE Nickname='".$Name."'");
	if($Array[0]['Nickname'] == $Name && $Array[0]['Mail'] == $Mail){
		return true;
	}else{
		return false;
	}
}

## Startet eine neue Anfrage an MySQL und gibt die Antwort als Array aus
##
## [array] DBQ( $Query )
##
## [string] $Query - Datenbankabfrage
## Gibt ein assoziatives Array zurück. Jede Antwort/Zeile, die auf die $Query passt
## ist ein Unterarray. Tabellenspalten sind die Schlüssel der Unterarrays und die
## Einträge die Werte

function DBQ($query){
	global $db;
	global $QUERIES; // DEBUG
	$Debug = array();
	$Debug['Query'] = $query; // DEBUG
	$Debug['Time'] = date("d.m.Y h:i:s",time()); // DEBUG
	$Debug['uTime'] = time(); // DEBUG
	$out = array();
	$i = 0;
	$result = mysql_query($query,$db) or die("Anfrage fehlgeschlagen: " . mysql_error());
	if(fnmatch("SELECT *",$query)){
		while ($row = mysql_fetch_assoc($result)) {
			while($key = key($row)){
				$out[$i][$key] = current($row);
				next($row);
			}
			$i++;
		}
	}
	$Debug['ReturnValues'] = $out; // Debug
	$QUERIES[count($QUERIES)] = $Debug; // Debug

	return $out;
}


## Update für Werte in einer vorhandenen Tabellenzeile
##
## [void] DBU( $Table, $ID, $Var )
##
## [string] $Table - Gibt den Namen der Tabelle an, in die Eingefügt wird
## [string] $ID - Gibt einen Identifier an, wo eingefügt wird. z.B. 'ID=5' oder 'Nickname=Goofy'
## [string] $Var - Eine Deklaration mit neuem Wert. z.B. "Nickname=Goofy"
##                 Kann auch mehrere mit Komma getrennt enhalten

function DBU($Table,$ID,$Var){
	DBQ("UPDATE $Table SET $Var WHERE $ID");
}

## Fügt Werte in eine Vorhandene Tabellenzeile ein
##
## [void] DBI( $Table, $ID, $Vars, Values )
##
## [string] $Table - Gibt den Namen der Tabelle an, in die Eingefügt wird
## [string] $ID - Gibt einen Identifier an, wo eingefügt wird. z.B. 'ID=5' oder 'Nickname=Goofy'
## [string] $Vars - Mit Komma getrennte Variablenname
## [string] $Values - Mit Komma getrennte Werte
## Um $Vars und $Values zu erstellen am besten die Funktion aArrayIntoString verwenden

function DBI($Table,$ID,$Vars,$Values){
	DBQ("INSERT INTO $Table($Vars) VALUES($Values) WHERE $ID");
}

## Fügt Werte in eine neue Tabellenzeile ein
##
## [void] DBIN( $Table, $Vars, Values )
##
## [string] $Table - Gibt den Namen der Tabelle an, in die Eingefügt wird
## [string] $Vars - Mit Komma getrennte Variablenname
## [string] $Values - Mit Komma getrennte Werte
## Um $Vars und $Values zu erstellen am besten die Funktion aArrayIntoString verwenden

function DBIN($Table,$Vars,$Values){
	DBQ("INSERT INTO $Table($Vars) VALUES($Values)");
}

## Löscht eine Tabellenzeile
##
## [void] DBD( $Table, $Var )
##
## [string] $Table - Gibt den Namen der Tabelle an, in die Eingefügt wird
## [string] $ID - Gibt einen Identifier an, wo eingefügt wird. z.B. 'ID=5' oder 'Nickname=Goofy'

function DBD($Table,$ID){
	DBQ("DELETE FROM $Table WHERE $ID ");
}

## Erstellt eine Bildvorschau einer Datei
##
## [bool] CreateThumbnail ( $MaxSize = AVATARMAXSIZE,$File,$SaveName)
##
## [string] $MaxSize - gibt die maximale Größe der längsten Seite des Thumbnails an. Default: AVATARMAXSIZE
## [array] $File - Entspricht einem Array eines neu hochgeladenen Bildes (entspringt aus $_FILES)
## [string] $SaveName - gibt einen Dateinamen an, unter dem der Thumbnail gespeichert wird
function CreateThumbnail($MaxSize = AVATARMAXSIZE,$File,$SaveName){
	global $_SESSION;

	if($File['type'] == "image/png" or
		$File['type'] == "image/jpeg" or
		$File['type'] == "image/gif" or
		$File['type'] == "image/jpg"
		){
			$FType = $File['type'];
			$FTemp = $File['tmp_name'];

			if(fnmatch("*jpg",$FType) or fnmatch("*jpeg",$FType)){
				$image = imagecreatefromjpeg($FTemp);
			}elseif(fnmatch("*png",$FType)){
				$image = imagecreatefrompng($FTemp);
			}elseif(fnmatch("*gif",$FType)){
				$image = imagecreatefromgif($FTemp);
			}
			$thumb_x = imagesx($image);
			$thumb_y = imagesy($image);
			if($thumb_x > AVATARMAXSIZE or $thumb_y > AVATARMAXSIZE){ // Herunterskalieren von großen Bildern
				$Verhaeltnis = $thumb_y / $thumb_x;
				if($thumb_x > $thumb_y){ // Querformat
					$thumb_x = AVATARMAXSIZE;
					$thumb_y = AVATARMAXSIZE * $Verhaeltnis;
				}else{ // Hochformat
					$thumb_y = AVATARMAXSIZE;
					$thumb_x = AVATARMAXSIZE * $Verhaeltnis;
				}
			}

			$thumb = imagecreatetruecolor($thumb_x, $thumb_y);
			imagecopyresized($thumb, $image, 0, 0, 0, 0, $thumb_x, $thumb_y, imagesx($image), imagesy($image));
			imagejpeg($thumb,$SaveName);
			return true;
		}else{
			return false;
		}
}

## Sendet eine Mail an einen Admin, wenn ein Fehler auftritt.
##
## [void] CryForHelp( $String )
##
## [string]$String - Meldung. Gibt einen Hinweis an welcher Stelle der Fehler auftrat.
##
## Diese Funktion sammelt alle wichtigen Array-Zustände und sendet diese in einer
## Mail an einen Admin.

function CryForHelp($String){
	$Time = date("d.m.Y. h:i:s",time());
	$Output = "Am ".$Time." Uhr trat ein Fehler auf! Das System meldet: ".$String."\n";
	$Output .="Es folgt Debug-Code:\n";
	ob_start();
	echo "SERVER:\n";
	print_r($_SERVER);
	echo "_________\n";
	if(isset($QUERIES)){
		echo "QUERIES:\n";
		print_r($QUERIES);
		echo "_________\n";
	}
	echo "POST:\n";
	print_r($_POST);
	echo "_________\n";
	echo "GET:\n";
	print_r($_GET);
	echo "_________\n";
	echo "FILES:\n";
	print_r($_FILES);
	$Output .= ob_get_contents();
	ob_end_clean();
	SendMail(VON,VONNAME,ADMINMAIL,"Cry for Help!",$Output);
}

## Erstellt eine Tabelle aus einem Assoziativen Array
##
## [string] QueryToTable( $QueryArray )
##
## Diese Funktion erstellt aus einer Query, die zuvor per DBQ erstellt wurde
## eine ansehnliche Tabelle.

function QueryToTable($QueryArray){
	$Keys = array();
	$Vout = "";
	for($x = 0;$x<count($QueryArray);$x++){

		$Values = $QueryArray[$x];

		while(key($Values)){
			if(!in_array(key($Values),$Keys)){
				$Keys[count($Keys)] = key($Values);
			}
			$Vout .= "<td>".current($Values)."</td>";
			next($Values);
		}
		$Vout .="</tr>\n";
	}
	$out = "<table><tr>";
	foreach($Keys as $Head){
		$out .="<th>".$Head."</th>";
	}
	$out .="</tr>\n";
 	$out .= $Vout;
	$out .="</table>\n\n";
	return $out;
}
?>