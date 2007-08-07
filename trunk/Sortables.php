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
		<script language="JavaScript" type="text/javascript" src="js/mootools.svn.js"></script>

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
				width: 80px;
				height: 80px;
				background-color: #222;
			}

			ul#sortables li {
				margin: 10px 0;
			}

		</style>


	</head>
	<body>
<h1>Information</h1>
<p>
Diese Datei testet die Slide Funktionalität (Fx.Slide) der mootools (<a href="http://mootools.net">mootools.net</a>) aus. Das ganze hat noch mehr Funktionen, da bitte auf der mootools Seite nachsehen.

Wir sortieren eine Reihe an Informationen per Drag und Drop und speichern das ganze wenn der Submit butten gedrückt wird.
</p>

<table><tr><td>
<ul id="test">
 	<li id="Profil" class="sortme">Profil</li>
	<li id="Galerie" class="sortme">Galerie</li>
	<li id="Freunde" class="sortme">Freunde</li>
	<li id="Reviews" class="sortme">Reviews</li>
	<li id="Hardware" class="sortme">Hardware</li>
	<li id="Software" class="sortme">Software</li>
	<li id="Anzeigen" class="sortme">Anzeigen</li>
</ul>
</td><td>
<div id="log">
	<h3>
		Ajax Response
	</h3>
	<div id="log_res">
		<!-- spanner -->
	</div>
</div>
</td></tr></table>

<script type="text/javascript">
/* <![CDATA[ */

	window.addEvent('domready', function() {


			new Sortables($('test'), {

				initialize: function(){
					var step = 0;
					/* this.elements.each(
						function(element, i){
							var color = [step, 82, 87].hsbToRgb();
							element.setStyle('background-color', color);
							step = step + 35;
							 element.setStyle('height', 40);
						}
					);
					*/
				},
				onComplete:  function(){
					SendSortableList();
				}

			});


			function SendSortableList(){
				o = document.getElementById('test');
				if(o.hasChildNodes){
					Reihenfolge = new Array();
					for(i=0;i<o.childNodes.length;i++){
						if(o.childNodes[i].id)
						Reihenfolge[Reihenfolge.length]= o.childNodes[i].id;
					}
					var url = 'CallFunc.php';
					new Ajax(url, {
						data: "Function=sProfilSpeichern&Sorted=" + Reihenfolge.join(','),
						method: 'post',
						update: $('log')
					}).request();

				}else{
					alert('Wrong Object-Type: No Childnodes found.');
				}

			}

	});

 /* ]]> */
</script>
	</body>
</html>