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
	position: inherit;
}

ul#sortables {
	width: 300px;
	margin: 0;
	padding: 0;
}

li.sortme {
	padding: 4px 8px;
	color: #fff;
	cursor: pointer;
	list-style: none;
	width: 300px;
	background-color: #222;
}

ul#sortables li {
	margin: 10px 0;
}



		</style>
		<script type="text/javascript">
				/* <![CDATA[ */
window.addEvent('domready', function() {

new Sortables($('test'), {

	initialize: function(){
		var step = 0;
		this.elements.each(function(element, i){
			var color = [step, 82, 87].hsbToRgb();
			element.setStyle('background-color', color);
			step = step + 35;
			 element.setStyle('height', 40);
		});
	}

});


/* Hiermit speichern wir die Änderungen der Liste */


$('myForm').addEvent('submit', function(e) {
	/**
	 * Prevent the submit event
	 */
	new Event(e).stop();
	SendSortableList(document.getElementById('test'));
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

function SendSortableList(o){

	if(o.hasChildNodes){
	Reihenfolge = new Array();
		for(i=0;i<o.childNodes.length;i++){
			if(o.childNodes[i].id)
			Reihenfolge[Reihenfolge.length]= o.childNodes[i].id;
		}
		document.getElementById('value').value = Reihenfolge.join(',');
	}else{
		alert('Wrong Object-Type: No Childnodes found.');
	}

}

		/* ]]> */

		</script>

	</head>
	<body>
<h1>Information</h1>
<p>
Diese Datei testet die Slide Funktionalität (Fx.Slide) der mootools (<a href="http://mootools.net">mootools.net</a>) aus. Das ganze hat noch mehr Funktionen, da bitte auf der mootools Seite nachsehen.

Wir sortieren eine Reihe an Informationen per Drag und Drop und speichern das ganze wenn der Submit butten gedrückt wird.
</p>


<form id="myForm" action="CallFunc.php" method="post" name="myForm">
<input type="hidden" name="Function" value="sProfilSpeichern" />
	<input type="hidden" id="value" name="Sorted" />
	<input type="submit" name="button" id="submitter" value="Meine Einstellungen speichern" />
</form>

<table><tr><td>
<ul id="test">
 	<li id="Profil" class="sortme">Mein Profil
	</li>
 	<li id="Galerie" class="sortme">Meine Galerie
	</li>
	<li id="Freunde" class="sortme">Meine Freunde
	</li>
	<li id="Reviews" class="sortme">Meine Reviews
	</li>
	<li id="Hardware" class="sortme">Meine Hardware
	</li>
	<li id="Software" class="sortme">Meine Software
	</li>
	<li id="Anzeigen" class="sortme">Meine Anzeigen
	</li>
</ul>
</td><td>
<div id="log">
	<h3>
		Ajax Response
	</h3>
	<div id="log_res">
		<!-- spanner -->
	</div>
</div><span class="clr"><!-- spanner --></span>
</td></tr></table>


	</body>
</html>