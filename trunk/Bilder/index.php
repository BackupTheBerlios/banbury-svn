<?php
$Pics = addslashes(array_keys($_GET));
if(isset($Pics[1])){
	$Array = DBQ("SELECT * FROM Bilder WHERE ID='".$Pics[1]."'");
	$Array = $Array[0];
	$Bild = "<img src=\"Bilder/Orginale/".$Array['Dateiname']."\" />";
	$Titel = $Array['Titel'];
	include("Content/Bild.php");
}else{

	$Array = DBQ("SELECT ID,Titel,Dateiname FROM Bilder");
	$CL = InitContentList("Bilder");

	foreach($Arraqy as $Bild){
		$Titel = $Bild['Titel'];
		$Link = '?Bilder&'.$Bild['ID'];

		AddToContentList("CL",$Titel,$Inhalt,$Link);

	}
	OutputContentList($CL,"icons");
}
?>