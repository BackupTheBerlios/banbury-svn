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
	#demo-bar {
	margin: 5px auto;
	padding: 5px 0;
	width: 600px;
	border-bottom: 1px solid #B3D4EF;
	background: #EFF8FF;
	text-align: center;
}

#demo-wrapper {
	margin: 5px auto;
	overflow: hidden;
	height: 400px;
	width: 600px;
	border: 1px solid #ddd;
	position: relative;
}

#demo-inner {
	width: 2270px;
	height: 1704px;
/*	background-image: url(mountains.jpg);*/
	background-color:blue;
	position: relative;
}

.scrolling-content {
/*	background: transparent url(bubble.png) top left no-repeat;*/
	background-color:green;
	width: 139px;
	height: 73px;
	text-align: center;
	position: absolute;
}

.scrolling-content h1 {
	color: black;
	padding: 25px 0;
	font-size: 12px;
}

#content1 {
	left: 250px;
	top: 100px;
}

#content2 {
	left: 800px;
	top: 1350px;
}

#content3 {
	left: 1200px;
	top: 550px;
}

#content4 {
	left: 1700px;
	top: 1300px;
}
</style>

<script type="text/javascript">
				/* <![CDATA[ */



window.addEvent('domready', function() {
	var scroll = new Fx.Scroll('demo-wrapper', {
		wait: false,
		duration: 2500,
		offset: {'x': -200, 'y': -50},
		transition: Fx.Transitions.Quad.easeInOut
	});

	$('link1').addEvent('click', function(event) {
		event = new Event(event).stop();
		scroll.toElement('content1');
	});

	$('link2').addEvent('click', function(event) {
		event = new Event(event).stop();
		scroll.toElement('content2');
	});

	$('link3').addEvent('click', function(event) {
		event = new Event(event).stop();
		scroll.toElement('content3');
	});

	$('link4').addEvent('click', function(event) {
		event = new Event(event).stop();
		scroll.toElement('content4');
	});
});


		/* ]]> */

		</script>

	</head>
	<body>
<h1>Information</h1>
<p>
Diese Datei testet die Scrolling Funktionalität (Fx.Scroll) der mootools (<a href="http://mootools.net">mootools.net</a>) aus.
</p>

<div id="demo-bar">
	<a id="link1" href="#" name="link1">The Blue Sky</a> | <a id="link2" href="#" name="link2">Last
	Grass</a> | <a id="link3" href="#" name="link3">The Naked Tree</a> | <a id="link4" href="#" name=
	"link4">The Lonesome Tree</a>
</div>
<div id="demo-wrapper">
	<div id="demo-inner">
		<div id="content1" class="scrolling-content">
			<h1>
				The Blue Sky
			</h1>
		</div>
		<div id="content2" class="scrolling-content">
			<h1>
				Last Grass
			</h1>
		</div>
		<div id="content3" class="scrolling-content">
			<h1>
				The Naked Tree
			</h1>
		</div>
		<div id="content4" class="scrolling-content">
			<h1>
				The Lonesome Tree
			</h1>
		</div>
	</div>
</div>


	</body>
</html>