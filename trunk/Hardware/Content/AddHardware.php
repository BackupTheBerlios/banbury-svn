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
<div id="POD">
	<div id="Display" style="height:200px;border:1px solid black;background-color:#eee;">

	<table width="100%">
		<tr>
			<td>Computer</td><td align="right">&gt;</td>
		</tr>
		<tr>
			<td>Audio&Video</td><td align="right">&gt;</td>
		</tr>
		<tr>
			<td>Peripherie</td><td align="right">&gt;</td>
		</tr>
	</table>



	</div>
	<div style="position:relative;">
		<div id="hwui">&nbsp;</div>
	</div>
</div>
		<p>
			<a href="javascript:hwsysc.stop();">aus</a>
			<a href="javascript:hwsysc.pl();">dreh+</a>
			<a href="javascript:hwsysc.mn();">dreh-</a>
			<a href="javascript:hwsysc.del();">löschen</a>
		</p>
		<p id="debug"> </p>