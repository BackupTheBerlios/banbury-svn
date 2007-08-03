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

if(isset($_POST['Nickname']) && isset($_POST['Passwort'])){
	if(!UserLogin($_POST['Nickname'],sha1($_POST['Passwort']))){
		include("Content/Error.html");
	}else{
		restore_include_path();
		include("Profil/index.php");
	}
}
?>