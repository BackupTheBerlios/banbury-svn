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

<div align="center">
<?php
 	if($TPL_Forth != "" && $TPL_Back != ""){ // Wenn Zurück und Weiter sichtbar sind 
 	?> 
 Seite <?php echo $TPL_Page;?>/<?php echo $TPL_Pages;?> - 

 <?php } ?>
	Gesamt: <?php echo $TPL_Items;?> <?php echo $TPL_Type;?> </div>
<div align="center">
	<?php
	if($TPL_Back != ""){ // Zurück ist sichtbar
	?>
 		<a href="<?php echo $TPL_Back;?>" title="Eine Seite zurück">Zurück</a> 
 	<?php 
 	} 
 	?>
 	<?php 
 	if($TPL_Forth != "" && $TPL_Back != ""){ // Wenn Zurück und Weiter sichtbar sind 
 	?> 
 		|
 	<?php 
 	} 
 	?>

 	<?php 
 		if($TPL_Forth != ""){ // Weiter ist sichtbar 
 	?>
		<a href="<?php echo $TPL_Forth;?>" title="Eine Seite weiter">Weiter</a>
 	<?php 
 		} 
 	?>

	</div>