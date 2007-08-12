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


echo "<tr><th colspan=\"2\">";
	if($Menu == ""){
		echo "<div onclick=\"genPODDisplayBack('')\">&lt; Zurück zum Hauptmenü</div>";
	}else{
		echo "<div onclick=\"genPODDisplayBack('".$Menu."')\">&lt; Zurück zu ".$Menu."</div>";
	}
	echo "</th></tr>";

?>
<tr id="NewPod">
	<td>
		<form name="AddToPodForm" id="AddToPodForm" action="CallFunc.php" method="post">
			<div>
				<input type="hidden" name="Function" value="" />
				<h3>Eintrag in <?php
				if($Menu == ""){
					echo "Hauptmenü";
				}else{
					echo $Menu;
				}
				?> einfügen.</h3><p>
				Um einen neuen Eintrag einzufügen, gib einfach den Namen hier ein und drücke ok.
				</p>
				<input type="hidden" id="NewPODMenu" name="Menu" value="<?php echo $Menu;?>" />
				<input type="text" id="NewPODName" name="Name" value="" />
				<input type="button" onclick="AddPOD();" name="ok" value="ok" />
			</div>
		</form>
	</td>
</tr>


