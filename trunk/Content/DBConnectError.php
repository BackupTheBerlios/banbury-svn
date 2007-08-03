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
echo '<?xml version="1.0" encoding="utf-8"?>';


?>
Es tut uns leid, aber es konnte keine Verbindung zu unserem Datenbankserver aufgebaut werden.
Wir bitten um Ihr Verständnis. Bitte versuchen Sie es später noch einmal.

<?php

CryForHelp("Couldn't Connect to Database Server!");

die();
?>