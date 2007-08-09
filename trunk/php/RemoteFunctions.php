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
	include("Profil.php");
}


function HWSearch($Array,$key,$query){
	header('Content-Type: text/xml');
		$Ergebnisse = DBQ("SELECT Kriterium,Wert FROM ".constant("DBTab".$Array)." WHERE ".$key." LIKE '".$query."%'" );
		$o = "";
		if($Ergebnisse != 1){
			$x = 0;
			foreach($Ergebnisse as $Ergebnis){
				if($key == 'Kriterium')
					$Wert = $Ergebnis['Kriterium'];
				else
					$Wert = $Ergebnis['Wert'];

				$o .= '<div onclick="Choose(\''.$key.'\',\''.$Wert.'\')" class="Line'.$x.'" >'.$Wert.'</div>'."\n";

				if($x == 0)
					$x = 1;
				else
					$x = 0;
			}
		}else{
			return false;
		}
	return $o;
}

function PrintKrits($Array){
	$y = 0;
	$o = "";
	if(!is_array($Array))
		if(is_array($_SESSION[$Array]))
			$Array = $_SESSION[$Array];
	if(is_array($Array)){
		foreach($Array as $object){
			$o .= "<tr><td>".$object['kriterium']."</td><td>".$object['wert']."</td><td onclick=\"RemoveKritFromHW(".$y.")\">Löschen</td></tr>";
			$y++;
		}
	}
	return $o;
}

function AddKrit($Array,$kriterium,$wert,$Tags){
	$Table = constant("DBTab".$Array);

	if(!isset($_SESSION[$Array]) or !is_array($_SESSION[$Array]))
		$_SESSION[$Array]= array();

	$Vorhanden = DBQ("SELECT * FROM ".$Table." WHERE Kriterium='".$kriterium."' AND Wert='".$wert."' AND Tags='".$Tags."'");

	if(count($Vorhanden) == 1){ // Wenn kein Fehler in der Query und kein Ergebniswert zurückgegeben wurde ...
		$ID = generateContentID($Table);
		if(strlen($Tags)){
			$Tags = explode(",",$Tags);
			$InsertTagsID = array();
			$InsertTags = array();
			foreach($Tags as $Tag){
				$InsertTagsID[count($InsertTagsID)] = GenerateContentID(DBTabTags);
				$InsertTags[count($InsertTags)] = $Tag;
			}


		}
		DBIN($Table,"ID,Kriterium,Wert,Tags","'".$ID."','".$kriterium."','".$wert."','".$Tags."'");
	}

	$x = count($_SESSION[$Array]);
	$_SESSION[$Array][$x]['kriterium'] = $kriterium;
	$_SESSION[$Array][$x]['wert'] = $wert;
	$o = PrintKrits($_SESSION[$Array]);
	return $o;

}

function RemoveKrit($Array,$Nr){
	unset($_SESSION[$Array][$Nr]);
	$o = PrintKrits($_SESSION[$Array]);

	return $o;
}


?>
