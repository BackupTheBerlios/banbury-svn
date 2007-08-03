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
echo '<?xml version="1.0" encoding="utf-8"?>'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="de">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<title></title>
		<link rel="stylesheet" type="text/css" href="style.css"  />
		<meta http-equiv="Content-Script-Type" content="text/javascript" />
		<meta name="keywords" content="" />
		<meta name="description" content="" />
		<meta name="author" content="" />
		<script type="text/javascript">
			  /* <![CDATA[ */



		/* ]]> */

		</script>

	</head>
	<body>

	<?php
		if(isset($_SERVER['QUERY_STRING']) && is_file("../".$_SERVER['QUERY_STRING']) && !fnmatch("..",$_SERVER['QUERY_STRING'])){
			echo "<h1>Display of Content</h1>";
			echo "<p class=\"small\"><strong>File:</strong> ".$_SERVER['QUERY_STRING']."</p>";
			$File = file("../".$_SERVER['QUERY_STRING']);
			include_once("PrintCode.php");

			echo printCode($File,1,1,0);
		}
	?>

	</body>
</html>