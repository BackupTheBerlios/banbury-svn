<?php 
$Pics = array_keys($_GET);
if(isset($Pics[1])){
	$Array = DBQ("SELECT * FROM Bilder WHERE ID='".$Pics[1]."'");
	$Array = $Array[0];
	$Bild = "<img src=\"Bilder/Orginale/".$Array['Dateiname']."\" />";
	$Titel = $Array['Titel'];	
	include("Content/Bild.php");
}
?>