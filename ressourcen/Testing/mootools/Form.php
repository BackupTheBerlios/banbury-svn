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


		</style>
		<script type="text/javascript">
				/* <![CDATA[ */
window.addEvent('domready', function() {

$('myForm').addEvent('submit', function(e) {
	/**
	 * Prevent the submit event
	 */
	new Event(e).stop();

	/**
	 * This empties the log and shows the spinning indicator
	 */
	var log = $('log_res').empty().addClass('ajax-loading');

	/**
	 * send takes care of encoding and returns the Ajax instance.
	 * onComplete removes the spinner from the log.
	 */
	this.send({
		update: log,
		onComplete: function() {
			log.removeClass('ajax-loading');
		}
	});
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

<form id="myForm" action="Form_Response.php" method="get" name="myForm">
		<input type="text" name="first_name" value="John" />
		<input type="text" name="last_name" value="Q" />
		<input type="text" name="e_mail" value="john.q@mootools.net" />
		<input type="checkbox" name="mootooler" value="yes" checked="checked" />
		<select name="new">
				<option value="yes" selected="selected">
					yes
				</option>
				<option value="no">
					no
				</option>
			</select>
		<div class="hr">
			<!-- spanner -->
		</div><input type="submit" name="button" id="submitter" /> <span class="clr">
		<!-- spanner --></span>

</form>
<div id="log">
	<h3>
		Ajax Response
	</h3>
	<div id="log_res">
		<!-- spanner -->
	</div>
</div><span class="clr"><!-- spanner --></span>


	</body>
</html>