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
// if(!isset($_SESSION['BringMeBackTo']) or $_SESSION['BringMeBackTo']=="") // Das soll den Benutzer nach dem Login wieder zur Ausgangsposition zurückbringen.
	$_SESSION['BringMeBackTo'] = $_SERVER['QUERY_STRING'];
?>
<div class="banburylogin">
Anmeldung bei Banbury
<form action="?Login" method="post">
<div>
Nickname <input type="text" name="Nickname" value="Nickname" /><br />
Passwort <input type="password" name="Passwort" value="Passwort" /><br />
<input type="submit" id="Submit" value="Anmelden" />
</div>
</form>
<a href="?Register">Register</a>
<a href="?NewPass">Passwort vergessen</a>
</div>
<div class="openidlogin">
<form method="post" action="?Login">
Identity&nbsp;URL:
<input type="hidden" name="action" value="verify" />
<input type="text" name="openid_url" value=""/>
<input type="submit" value="Anmelden (OpenID)" />
</form>
</div>