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
global $QUERIES;

?>

<button onclick="document.getElementById('DEBUGINFO').style.display = 'block';return false;">Debug Info</button>
<div id="DEBUGINFO" class="DEBUGVARS">

<strong>Session</strong><pre>
<?php print_r($_SESSION);?></pre>
<hr />
<strong>Get</strong><pre>
<?php print_r($_GET);?></pre>
<hr />
<strong>Post</strong><pre>
<?php print_r($_POST);?></pre>
<hr />
<strong>QUERIES</strong><pre>
<?php print_r($QUERIES);?></pre>
<hr />
<strong>_Files</strong><pre>
<?php print_r($_FILES);?></pre>
<hr />
	<table>
		<tr>
			<th>Loaded Templates:</th><th>Unique Templates:</th>
		</tr>
		<tr>
			<td valign="top"><pre><?php print_r($TEMPLATES);?></pre></td><td valign="top"><pre><?php print_r(array_unique($TEMPLATES));?></pre></td>
		</tr>

	</table>
<hr />
	<table>
		<tr>
			<th>Konstanten:</th><th>Required/Included:</th>
		</tr>
		<tr>
			<td valign="top"><pre><?php

$Constants = get_defined_constants(true);
print_r($Constants['user']);?></pre></td><td valign="top"><pre><?php print_r(get_required_files());?></pre></td>
		</tr>

	</table>

 </div>