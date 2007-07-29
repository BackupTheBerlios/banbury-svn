<?php

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