<?php
set_include_path('php');

require('Includes.php');
require('Functions.php');

	$db = mysql_connect(DBHost.":".DBPort,DBUser,DBPass) or require("Content/DBConnectError.php");
	$db_selected = mysql_select_db(DBName,$db) or die("Auswahl der Datenbank fehlgeschlagen");

## Startet eine Session
session_start();

echo '<?xml version="1.0" encoding="utf-8"?>';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="de">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" href="css/main.css" />
		<title>mac-only.de</title>
	</head>
	<body>

<?php

$Target = explode("&",$_SERVER['QUERY_STRING']);
$Target = $Target[0];
if(is_dir($Target) && !strstr($Target,"..") && !fnmatch("/*",$Target)){
	include($Target.'/index.php');

}else{
	include('Content/Willkommen.html');
}

?>
<hr />
<button onclick="document.getElementById('DEBUGINFO').style.display = 'block';return false;">Debug Info</button>
<div id="DEBUGINFO" class="DEBUGVARS">
<strong>Session</strong><pre>
<?php print_r($_SESSION);?></pre>
<hr />
<strong>Get</strong><pre>
<?php print_r($_GET);?></pre>
<hr />
<strong>Post</strong><pre>
<?php print_r($_POST);?></pre>
<hr />
<strong>QUERIES</strong><pre>
<?php print_r($QUERIES);?></pre>
<hr />
<strong>Files</strong><pre>
<?php print_r($_FILES);?></pre>
<hr />
</div>

	</body>
</html>

<?php



	mysql_close($db);
?>