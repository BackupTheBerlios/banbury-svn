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
<p>
Füge ein Kriterium nach dem Anderen hinzu. <?php echo PROJECTNAME;?> hilft dir dabei ;-)
</p>
<form name="HardwareForm1" id="HardwareForm1" action="CallFunc.php" method="post">
<input type="hidden" name="Function" value="AddKrit" />
<input type="hidden" name="Array" value="Hardware" />
<table class="HardwareSumme" id="Summe">

	</table>
<div id="log_res">
	<!-- spanner -->
</div>
<table>
	<tr>
		<td>
			Kriterium :
		</td>
		<td>
			Wert :
		</td>
		<td>
			Tags :
		</td>
	</tr>
	<tr>
		<td class="Search">
			<input type="text" name="Krit" id="Kriterium" value="Bildschirm" size="40" maxlength="40" />
		</td>
		<td class="Search">
			<input type="text" name="Wert" id="Wert" value="20 Zoll" size="40" maxlength="40" />
		</td>
		<td class="Search">
			<input type="text" name="Tags" value="" size="40" maxlength="40"/>
		</td>
	</tr>
	<tr>
		<td class="Search">
			<div id="KritTipp" class="SearchTipp">1</div>
		</td>
		<td class="Search">
			<div id="WertTipp" class="SearchTipp">2</div>
		</td>
	</tr>
</table>

	<input type="submit" name="button" value="Hinzufügen" />


</form>
<script type="text/javascript">
/* <![CDATA[ */

	function Choose(ObjectID,Value){
		document.getElementById(ObjectID).value = Value;
	}
	var Summe = document.getElementById('Summe');
	var url = "CallFunc.php";

	var MyAjax = new Ajax(url, {
		data: "Function=PrintKrits&Array=Hardware",
		method: 'post',
		update: Summe
	}).request();


	function RemoveKritFromHW(Nr){
			var MyAjax = new Ajax(url, {
				data: "Function=RemoveKrit&Array=Hardware&Nr=" + Nr,
				method: 'post',
				update: Summe
			}).request();

	}
	window.addEvent('domready', function() {


		$('Wert').addEvent('keyup', function(){
			if($('Wert') && $('Wert').value.length > 1){
				url = "CallFunc.php";
				var MyAjax = new Ajax(url, {
					data: "Function=HWSearch&Array=Hardware&key=Wert&query=" + $('Wert').value,
					method: 'post',
					update: $('WertTipp')
				}).request();
			}
		});

	$('Kriterium').addEvent('keyup', function(){
			if($('Kriterium') && $('Kriterium').value.length > 1){
				url = "CallFunc.php";
				var MyAjax = new Ajax(url, {
					data: "Function=HWSearch&Array=Hardware&key=Kriterium&query=" + $('Kriterium').value,
					method: 'post',
					update: $('KritTipp')
				}).request();
			}
		});

		$('HardwareForm1').addEvent('submit', function(e) {
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
				update: $('Summe'),
				onComplete: function() {
					$('Summe').removeClass('ajax-loading');
				}
			});
		});



	});

 /* ]]> */
</script>