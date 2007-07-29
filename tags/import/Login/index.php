<?php

if(isset($_POST['Nickname']) && isset($_POST['Passwort'])){
	if(!UserLogin($_POST['Nickname'],sha1($_POST['Passwort']))){
		include("Content/Error.html");
	}else{
		restore_include_path();
		include("Profil/index.php");
	}
}
?>