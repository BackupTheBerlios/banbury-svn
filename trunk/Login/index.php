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

if(isset($_POST['action']) && isset($_POST['openid_url'])) {
	if ($_POST['action'] == "verify" && $_POST['openid_url'] != "") {
		$origip = get_include_path();
		set_include_path('php/openid');
		include("try_auth.php");
		set_include_path($origip);
	}
}
if(isset($_POST['Nickname']) && isset($_POST['Passwort'])){
	if(!UserLogin($_POST['Nickname'],sha1($_POST['Passwort']))){
		include("Content/Error.html");
	}elseif(isset($_SESSION['BringMeBackTo']) && $_SESSION['BringMeBackTo']!==""){
		BringMeBack();
	}else{
		restore_include_path();
		include("Profil/index.php");
	}
}else{
	echo LoadTPL("Login");
}
?>