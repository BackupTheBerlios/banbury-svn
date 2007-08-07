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



#idList {
	margin: 0;
	padding: 0;
	display:inline;
}

#idList li {
	position:relative;
	display:inline;
	margin: 0;
	width: 120px;
	color: #888;
	font-family:sans-serif;
	font-size:10px;
	padding:5;
}



		</style>
		<script type="text/javascript">
				/* <![CDATA[ */
window.addEvent('domready', function() {

var list = $$('#idList li');
list.each(function(element) {

	var fx = new Fx.Styles(element, {duration:200, wait:false});

	element.addEvent('mouseenter', function(){
		fx.start({
			'top': 5,
			'background-color': '#666',
			'font-size': '16',
			color: '#ff8'
		});
	});

	element.addEvent('mouseleave', function(){
		fx.start({
			'top': 0,
			'background-color': '#333',
			'font-size': '11',
			'color': '#888'
		});
	});

});



});



		/* ]]> */

		</script>

	</head>
	<body>
<h1>Information</h1>
<p>
Diese Datei testet die Navigations-Style Funktionalität (Fx.Styles) der mootools (<a href="http://mootools.net">mootools.net</a>) aus.
Probieren wir das ganze mal horizontal. Man kann so ziemlich alle CSS-Werte transformieren.
</p>


<ul id="idList">
<li>Hardware</li>
<li>Software</li>
<li>Reviews</li>
<li>Bilder</li>
</ul>

	</body>
</html>