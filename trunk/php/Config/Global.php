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

## Fest. Bitte nicht ändern

define ('SERVER',$_SERVER['SERVER_NAME']);
define ('SCRIPT',$_SERVER['PHP_SELF']);
define ('MAINTEMPLATES','Content/Templates/'); // Unbedingt mit Slash (/) enden !

## Einschränkungen und Optionen

define ('AVATARMAXSIZE',120); // Maximale Avatargröße
define ('THUMBMAXSIZE',120); // Maximale Größe erstellter Thumbnails
define ('SCALEDMAXSIZE',400); // Maximale Größe von skalierten Bildern
define ('PICMAXSIZE',1200); // Maximale Größe von Bildern
define ('MAXPICSCOUNT',3); // Maximale Anzahl an Bildern, die ein Benutzer haben darf
define ('MAXITEMSINLIST',12); // Maximale Anzahl an Bildern, Reviews etc. in einer Liste.
define ('MAXLENGTHKOMMENTAR',250);


## Konfiguration

define ('PROJECTNAME','Banbury'); // Der Name des Projekts
define ('ADMINMAIL','webmaster@kwnetzwelt.de');
define ('VON','register@'.PROJECTNAME.'.de');
define ('VONNAME','Rezeption');
define ('REGISTERNEUBETREFF','Willkommen bei '.PROJECTNAME.'. Jetzt freischalten!');
define ('PASSWORTNEUBETREFF','Ihr Passwort bei '.PROJECTNAME.' wurde zurückgesetzt!');

## Rollennamen...

define ('ROLEDebug', 'Debugger');
define ('ROLEAdmin', 'Admin');

?>