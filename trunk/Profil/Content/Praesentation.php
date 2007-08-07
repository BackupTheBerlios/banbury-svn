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

$Profil = '
	<a href="?Profil/&Edit">Bearbeiten</a><br />
	<img src="'.AvatarVerzeichnis."/".$_SESSION['Nickname'].'.jpg" alt="Profilbild" align="left" />
	'.$Nickname.'<br />
	'.$Vorname.' '.$Name.'<br />
	'.$PLZ.' '.$Wohnort.'<br />
	'.$Geburtstag.' '.$Webseite.'<br clear="all" />
			'.$Kurzprofil.'';

$Galerie = '<strong>Meine Galerie</strong> <a href="?Profil/&EditMyGalerie">Bearbeiten</a>';

ob_start();
require("Content/ImageList.php");
$Galerie .= ob_get_contents();
ob_end_clean();

$Freunde = '<strong>Freunde</strong>';
$Reviews = '<strong>Reviews</strong>';
$Hardware = '<strong>Hardware</strong>';
$Software = '<strong>Software</strong>';
$Anzeigen = '<strong>Anzeigen</strong>';

$Reihenfolge = DBQ("SELECT Sorted FROM USERS WHERE ID=".$_SESSION['ID']);

$Reihenfolge = explode(",",$Reihenfolge[0]['Sorted']);
echo "\n\n<ul id=\"ProfilSortable\">\n";
foreach($Reihenfolge as $Object){

	echo "<li id=\"".$Object."\" class=\"sortme\">\n";
	echo $$Object;
	echo "\n</li>\n\n";

}
echo "</ul>\n";

?>

<div id="log">Log

<div id="log_res">
		<!-- spanner -->
	</div>
</div>




<script type="text/javascript">
/* <![CDATA[ */

	window.addEvent('domready', function() {


			new Sortables($('ProfilSortable'), {
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
				o = document.getElementById('ProfilSortable');
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