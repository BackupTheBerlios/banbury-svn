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

## Mail Stuff

$MailEncoding = "text/html charset=utf-8";

$GlobalMailHeader = "

	Sehr geehrte(r) <ANREDE>,

	Diese E-Mail sendet Ihnen unser Server, weil für Sie relevante Informationen bereitliegen.

	";

$GlobalMailFooter = "

	freundliche Grüß von Ihrem 1RAUM Team

	Für weitere Informationen zu unserem Service-Angebot,
	besuchen Sie doch unsere Webseiten auf:
	http://www.1raum.de

";
define ('ADMINMAIL','webmaster@kwnetzwelt.de');
define ('VON','register@mac-only.de');
define ('VONNAME','Rezeption');
define ('REGISTERNEUBETREFF','Willkommen bei mac-only.de. Jetzt freischalten!');
define ('PASSWORTNEUBETREFF','Ihr Passwort bei mac-only.de wurde zurückgesetzt!');
define ('SERVER',$_SERVER['SERVER_NAME']);
define ('SCRIPT',$_SERVER['PHP_SELF']);
define ('AVATARMAXSIZE',120);
define ('MAXPICSCOUNT',6); // Maximale Anzahl an Bildern, die ein Benutzer haben darf
?>