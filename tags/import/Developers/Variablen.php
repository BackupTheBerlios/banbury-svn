<?php echo '<?xml version="1.0" encoding="utf-8"?>';?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="de">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<title></title>
		<link rel="stylesheet" type="text/css" href="style.css"  />
		<meta http-equiv="Content-Script-Type" content="text/javascript" />
		<meta http-equiv="Content-Style-Type" content="text/css">
		<meta name="keywords" content="" />
		<meta name="description" content="" />
		<meta name="author" content="" />
		<script type="text/javascript">
			  /* <![CDATA[ */


	
		/* ]]> */
	
		</script>
		<style>
			li {line-height:140%;}
			ul {list-style:square;}
		</style>
	</head>
	<body>
	<h1>Variablen in Banbury</h1>

<p>
Die globalen Projektvariablen sind in <a href="#1">/php/Config/Users.php</a> und <a href="#2">/php/Config/Global.php</a> festgeschrieben.
</p>

<hr />
<h2><a name="1"></a>/php/Config/Users.php</h2>
<?php 

highlight_file("../php/Config/Users.php");

?>
<hr />
<h2><a name="2"></a>/php/Config/Global.php</h2>
<?php 

highlight_file("../php/Config/Global.php");

?>
</body>
</html>