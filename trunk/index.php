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


set_include_path('php');

require('Includes.php');
require('Functions.php');

ob_start(PROJECTNAME."MainOB");

initDBConnection();

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
		<link rel="stylesheet" href="css/slimbox.css" media="screen" />

		<title><?php echo PROJECTNAME;?></title>

		<script src="js/Banbury.js" type="text/javascript"></script>
		<script src="js/mootools.svn.js" type="text/javascript"></script>
		<script type="text/javascript" src="js/slimbox.js"></script>

	</head>
	<body>
	<div><img src="Content/images/banburylogo.png" width="136" height="32" alt="Logo" /></div>
<?php

// Hier die Navigation ...

include('Content/Navigation.php');

// Es folgt der Seiten-Inhalt

$Target = explode("&",$_SERVER['QUERY_STRING']);
$Target = $Target[0];
if ($Target == "finish_auth") {
	$origip = get_include_path();
	set_include_path('php/openid');
	include("finish_auth.php");
	set_include_path($origip);
}
if ($Target == "Logout") include('Logout/index.php');
if (session_is_registered('openid')) {
	if (!isOpenidUserOK($_SESSION['openid'])) {
		include("openid/checkstatus.php");
		exit(0);
	}
}
if(is_dir($Target) && !strstr($Target,"..") && !fnmatch("/*",$Target)){
	include($Target.'/index.php');
}else{
	include('Content/Willkommen.html');
}

?>
<hr />

<?php

Debug();

?>

	</body>
</html>

<?php


	mysql_close($db);

	$Return = ob_get_contents();
	while (@ob_end_flush());
	echo $Return;

?>