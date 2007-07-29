<?php
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