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
<h1>Ein Neues Bild hinzufügen</h1>
<form action="?Bilder&Edit" method="post" enctype="multipart/form-data">
<input type="file" name="Bild" /><br />
<input type="text" value="" name="Titel" id="Titel" /><label for="Titel">Titel</label>
<br />
<input type="submit" id="Submit" />
</form>