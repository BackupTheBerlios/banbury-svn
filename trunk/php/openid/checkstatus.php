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

// NOTE: Debugcode entfernen
echo "<pre>";
print_r ($_SESSION);
print_r ($_GET);
print_r ($erg);
echo "</pre>";

function auswahlNickname($vorgabe, $status) {
	echo "<h1>Bitte wählen Sie einen Spitznamen</h1>\n";
	echo "<p>Der Name »" . $vorgabe . "« ist ";
	if ($status) {
		echo "noch möglich.";
	} else {
		echo "leider belegt.";
	}
	echo "</p>\n<div>
	<form action=\"?openid\" method=\"GET\">
	<div>
	<input type=\"text\" name=\"nickname\" value=\"".
	htmlspecialchars($vorgabe) .
	"\"/>
	<input type=\"submit\" value=\"Prüfen und übernehmen\" />
	</div>
	</form>
	</div>\n";
}

function testNickname($nickname) {
	$_SESSION['lastnicknamechecked'] = $nickname;
	return (getIDforNickname($nickname) == -1);
}

$vorgabe = "";

if (isset($_GET['nickname']) && $_SESSION['lastnicknamechecked'] == $_GET['nickname'] && testNickname($_GET['nickname'])) {
	//Nickname benutzen
	Error("Nickname " . $_GET['nickname'] . " wird benutzt");
	$result = true;
	$werte = array(
		'openid' => $_SESSION['openid'],
		'Nickname' => $_GET['nickname'],
		'status' => 'N'
	);
	$result = $result && DBINAA(DBTabopenid, $werte);
	$werte=array(
		'nickname' => $_GET['nickname'],
		'passwort' => "openid",
		'Mail' => $_SESSION['openidsreg']['email'],
		'anmeldung' => date("Y-m-d H:i:s"),
		'Sorted' => "Profil,Galerie,Freunde,Hardware,Software,Anzeigen,Reviews");
	$result = $result && DBINAA(DBTabUsers, $werte);
	$uid = getIDforNickname($_GET['nickname']);
	$werte = array(
		'ID' => $uid,
		'Nickname' => 1);
	$result = $result && DBINAA(DBTabProfiles, $werte);
	
} else {
	//
	if (isset($_GET['nickname'])) $vorgabe = $_GET['nickname'];
	if (isset($_SESSION['lastnicknamechecked']) && $vorgabe == "") $vorgabe = $_SESSION['lastnicknamechecked'];
	if (isset($_SESSION['openidsreg']['nickname']) && $vorgabe == "") $vorgabe = $_SESSION['openidsreg']['nickname'];
	auswahlNickname($vorgabe, testNickname($vorgabe));
}

exit();

// Haben wir schon einen Eintrag für die OpenID?
$erg = DBQ2(DBTabopenid, "*", "openid='" . addslashes($_SESSION["openid"])."'");
if ($erg[0]["status"] == USProfilOkay || $erg[0]["status"] == USEmailOkay || $erg[0]["status"] == USNicknameOkay) {
	if(isset($_SESSION['BringMeBackTo']) && $_SESSION['BringMeBackTo']!==""){
		BringMeBack();
	}else{
		restore_include_path();
		include("../../Profil/index.php");
	}
} else {
	//Es gibt noch was zu tun...
	$newnickname = addslashes($_GET['newnickname']);
	if ($newnickname != "") {
		$erg = DBQ2(DBTabUsers, "Nickname", "Nickname like '$newnickname'");
		if ($erg[0]['Nickname'] != "") {
			echo "Gibt es schon, bitte einen neuen auswählen";
			auswahlNickname($erg[0]['Nickname'], "Überprüfen");
		} else {
			if ($_GET['s'] == "Übernehmen!") {
				$aArray = array(
					'openid' => addslashes($_SESSION["openid"]),
					'Nickname' => $newnickname,
					'status' => USNicknameOkay
					);
				DBINAA(DBTabopenid, $aArray);
				
				//Erzeuge Benutzer und Passworteintrag
				$werte=array(
					'nickname' => $newnickname,
					'passwort' => "openiduser ohne passwort",
					'Mail' => addslashes($_SESSION["openidsreg"]["email"]),
					'anmeldung' => date("Y-m-d H:i:s"),
					'Sorted' => "Profil,Galerie,Freunde,Hardware,Software,Anzeigen,Reviews");
				$result = DBINAA(DBTabUsers, $werte);
				//in Tabelle DBTabRoles eintragen
				
				$benid = getIDforNickname($newnickname);
				if ($benid > 0) { //
					$werte = array(
						'BenutzerID' => $benid,
						'Rolle' => ROLEUser
					);
					DBINAA(DBTabRoles, $werte);
					$werte = array(
						'ID' => $benid,
						'Nickname' => 1);
					DBINAA(DBTabProfiles, $werte);
				}
				if(isset($_SESSION['BringMeBackTo']) && $_SESSION['BringMeBackTo']!==""){
					BringMeBack();
				}else{
					restore_include_path();
					include("../../Profil/index.php");
				}
			} else {
				echo "Name ist noch frei.";
				auswahlNickname($newnickname, "Übernehmen!");
			}
		}
	} else {
		auswahlNickname($_SESSION['openidsreg']['nickname'], "Überprüfen");
	}
}

?>
