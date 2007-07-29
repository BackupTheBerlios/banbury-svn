<a href="?Profil/&Edit">Bearbeiten</a><br />
<img src="<?php echo AvatarVerzeichnis."/".$_SESSION['Nickname'].".jpg";?>" alt="Profilbild" align="left" />
<?php echo $Nickname; ?><br />
<?php echo $Vorname; ?> <?php echo $Name; ?><br />
<?php echo $PLZ; ?> <?php echo $Wohnort; ?><br />
<?php echo $Geburtstag;?><?php echo $Webseite;?><br clear="all" />
<hr />
<?php echo $Kurzprofil;?>
<hr />
<strong>Meine Galerie</strong> <a href="?Profil/&EditMyGalerie">Bearbeiten</a>
<?php
foreach($Bilder as $Bild){
	echo '<br />';
	echo '<img src="'.BilderVerzeichnis."/Thumbnails/".$Bild['Thumbnail'].'" alt="'.$Bild['Titel'].'" title="'.$Bild['Titel'].'" />';
	echo '<a href="?Bilder/&'.$Bild['ID'].'">'.$Bild['Titel'].'</a>';
	echo '<br />';
}

?>
<hr />
<strong>Freunde</strong>
