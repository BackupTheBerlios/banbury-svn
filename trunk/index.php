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
		<title><?php echo PROJECTNAME;?></title>
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
<strong>_Files</strong><pre>
<?php print_r($_FILES);?></pre>
<hr />
	<table>
		<tr>
			<th>Loaded Templates:</th><th>Unique Templates:</th>
		</tr>
		<tr>
			<td valign="top"><pre><?php print_r($TEMPLATES);?></pre></td><td valign="top"><pre><?php print_r(array_unique($TEMPLATES));?></pre></td>
		</tr>

	</table>
<hr />
	<table>
		<tr>
			<th>Konstanten:</th><th>Required/Included:</th>
		</tr>
		<tr>
			<td valign="top"><pre><?php

$Constants = get_defined_constants(true);
print_r($Constants['user']);?></pre></td><td valign="top"><pre><?php print_r(get_required_files());?></pre></td>
		</tr>

	</table>

 </div>

	</body>
</html>

<?php



	mysql_close($db);
?>