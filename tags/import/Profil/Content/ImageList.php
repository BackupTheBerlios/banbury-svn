<?php
foreach($Bilder as $Bild){
	echo '<br />';
	echo '<img src="'.BilderVerzeichnis."/Thumbnails/".$Bild['Thumbnail'].'" alt="'.$Bild['Titel'].'" title="'.$Bild['Titel'].'" />';
	echo '<a href="?Bilder/&'.$Bild['ID'].'">'.$Bild['Titel'].'</a> ';
	echo '<a href="?Profil/&EditMyGalerie&Remove&ID='.$Bild['ID'].'">Löschen</a>';
	echo '<br />';
}

?>