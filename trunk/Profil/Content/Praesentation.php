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

$Reihenfolge = DBQ("SELECT Sorted FROM ".DBTabUsers." WHERE ID=".$_SESSION['ID']);

$Reihenfolge = explode(",",$Reihenfolge[0]['Sorted']);

// Sortables an dieser Stelle
?>

<table>
<tr>
	<td>
		<div id="ProfilAnzeige">
			<?php
			// Objekte selbst ...
			set_include_path("Content/Templates/");
			include("Profil.php");

			?>
		</div>
	</td>
	<td>
		<ul id="ProfilSortable">
			<?php
			foreach($Reihenfolge as $Object){

				echo "<li id=\"".$Object."\" class=\"sortme\">\n";
				echo $Object;
				echo "\n</li>\n\n";

			}
			?>
		</ul>
	</td>
</tr>
</table>



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
						update: $('ProfilAnzeige')
					}).request();

				}else{
					alert('Wrong Object-Type: No Childnodes found.');
				}

			}

	});

 /* ]]> */
</script>