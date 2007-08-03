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
