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
?>
<?php echo '<?xml version="1.0" encoding="utf-8"?>';?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="de">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<title></title>
		<link rel="stylesheet" type="text/css" href="style.css"  />
		<meta http-equiv="Content-Script-Type" content="text/javascript" />
		<script language="JavaScript" type="text/javascript" src="mootools.svn.js"></script>

		<meta name="keywords" content="" />
		<meta name="description" content="" />
		<meta name="author" content="" />

		<style type="text/css">




#test {
	background: #222;
	color: #fff;
	padding: 10px;
	margin: 20px;
	border: 10px solid pink;
}

#test2 {
	background: #222;
	color: #fff;
	padding: 10px;
	margin: 20px;
	border: 10px solid pink;
}



</style>

<script type="text/javascript">
				/* <![CDATA[ */



window.addEvent('domready', function() {


var mySlide = new Fx.Slide('test');

$('slidein').addEvent('click', function(e){
	e = new Event(e);
	mySlide.slideIn();
	e.stop();
});

$('slideout').addEvent('click', function(e){
	e = new Event(e);
	mySlide.slideOut();
	e.stop();
});

$('toggle').addEvent('click', function(e){
	e = new Event(e);
	mySlide.toggle();
	e.stop();
});

$('hide').addEvent('click', function(e){
	e = new Event(e);
	mySlide.hide();
	e.stop();
});


});


		/* ]]> */

		</script>

	</head>
	<body>
<h1>Information</h1>
<p>
Diese Datei testet die Slide Funktionalität (Fx.Slide) der mootools (<a href="http://mootools.net">mootools.net</a>) aus. Das ganze hat noch mehr Funktionen, da bitte auf der mootools Seite nachsehen.
</p>

<a id="slideout" href="#" name="slideout">slideout</a> | <a id="slidein" href="#" name=
"slidein">slidein</a> | <a id="toggle" href="#" name="toggle">toggle</a> | <a id="hide" href="#" name=
"hide">hide</a>
<div id="test">
	Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore
	et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
	aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
	cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa
	qui officia deserunt mollit anim id est laborum.
</div>
	</body>
</html>