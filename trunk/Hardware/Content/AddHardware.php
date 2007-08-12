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

<?php

// Es folgt die zukünftige Template-Datei

?>
<div id="POD">

	<div id="Display">
		<div id="PODDisplay">

			<table id="PODTable" cellpadding="0" cellspacing="0"></table>
		</div>
	<script type="text/javascript">
	/* <![CDATA[ */

	var url = "CallFunc.php";
	var target = document.getElementById('PODDisplay');
	var targetTable = document.getElementById('PODTable');
	var myEffects = target.effects({duration: 1000, transition:Fx.Transitions.Sine.easeInOut});

	function SlideF(){
		myEffects.start({'left':[300,0],duration: 1000}).chain(function(){
			target.style.overflow = 'auto';
		});
	}
	function SlideB(){
		myEffects.start({'left':[-300,0],duration: 1000}).chain(function(){
			target.style.overflow = 'auto';
		});
	}
	function genPODDisplay(Menu){
		target.style.overflow = 'hidden';
		var MyAjax = myEffects.start({'left':[0,-300],duration: 300}).chain(function(){

			new Ajax(url, {
				method: 'post',
				data: "Function=PODDisplay&Menu=" + Menu,
				update: targetTable,
				onComplete: SlideF,

			}).request();
		})
	}
	function genPODDisplayBack(Menu){
		target.style.overflow = 'hidden';
		var MyAjax = myEffects.start({'left':[0,300],duration: 300}).chain(function(){

			new Ajax(url, {
				method: 'post',
				data: "Function=PODDisplay&Menu=" + Menu,
				update: targetTable,
				onComplete: SlideB,

			}).request();
		})
	}

	function NewPODDisplay(Menu){
		var MyAjax = myEffects.start({'left':[0,-300],duration: 300}).chain(
			function(){
				new Ajax(url, {
				method: 'post',
				data: "Function=NewPODDisplay&Menu=" + Menu,
				update: targetTable,
				onComplete: SlideF,

				}).request();
			}
		);

	}
	function AddPOD(){
		Name = document.getElementById('NewPODName').value;
		Menu = document.getElementById('NewPODMenu').value;

		new Ajax(url, {
			method: 'post',
			data: "Function=AddToPODDisplay&Name=" + Name + "&" + "Menu=" + Menu,
			update: targetTable,
			onComplete: genPODDisplayBack(Menu),

		}).request();


	}
	genPODDisplay('');

	/* ]]> */
	</script>
</div>

		<div id="hwui">&nbsp;</div>
		<script src="js/Pod.js" type="text/javascript"></script>


</div>
		<p>
			<a href="javascript:hwsysc.stop();">aus</a>
			<a href="javascript:hwsysc.pl();">dreh+</a>
			<a href="javascript:hwsysc.mn();">dreh-</a>
			<a href="javascript:hwsysc.del();">löschen</a>
		</p>
		<p id="debug"> </p>