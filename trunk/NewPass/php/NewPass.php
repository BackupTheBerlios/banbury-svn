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
if(UserHasMail($_POST['UserName'],$_POST['Mail'])){
	$NeuPasswort = GeneratePasswort(8);
	DBU("USERS","NickName='".$_POST['UserName']."'","Passwort='".sha1($NeuPasswort)."'");
	$Inhalt = '
				Ihr Passwort wurde zurückgesetzt.
				Ihr aktuelles Passwort:'.$NeuPasswort.'
				';
	SendMail(VON,VONNAME,$_POST['Mail'],PASSWORTNEUBETREFF,$Inhalt);
}else{
	die();
}

?>