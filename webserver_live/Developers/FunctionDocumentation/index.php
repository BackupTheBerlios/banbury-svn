<?php echo '<?xml version="1.0" encoding="utf-8"?>';

include_once("../PrintCode.php");


$Functions = "../../php/Functions.php";
$Klammernebene = 0;
$Comment ="";
$File = file($Functions);
$FuncList1 = array();
$FuncList2 = array();
$FuncContent = array();
$LineNr = 0;

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="de">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<title></title>
		<link rel="stylesheet" type="text/css" href="style.css"  />
		<meta http-equiv="Content-Script-Type" content="text/javascript" />
		<meta name="keywords" content="" />
		<meta name="description" content="" />
		<meta name="author" content="" />
		<script type="text/javascript">
				/* <![CDATA[ */



		/* ]]> */

		</script>
	</head>
	<body>

	<?php
echo "<h1>Funktionsdeklarationen in ".$Functions."</h1>\n";
?>

Gelistet sind die Hauptfunktionen von Mac-Only.de.
Diese sollten weitestgehend Einsatz finden und das implementieren von Features vereinfachen.
Ebenfalls sind dokumentierende Kommentare gelistet, welche die Verwendung noch weiter
vereinfachen sollen.
<br />
Die aktuelle Ansicht wird aus der vorhandenen Datei (siehe oben) generiert. Die Zeilennummern stimmen mit dem Orginal überein, jedoch sind die Funktionen hier nach Alphabet sortiert.

<?php

foreach($File as $Line){
	$LineNr++;
	$BckpLine = $Line;
	if(strstr($Line,"/*")){
		$Line = explode("/*",$Line);
		$Line = $Line[0];
	}
	if(strstr($Line,"*/")){
		$Line = explode("*/",$Line);
		$Line = $Line[count($Line)-1];
	}
	if(strstr($Line,"#")){
		$Line = substr(0,strpos($Line,"#"));
	}
	if(fnmatch("function *",$Line)){
		$StartLineNr = $LineNr;

		$Klammernebene++;
		// Es ist eine Funktionsdeklaration
		$Line = substr($Line,9,strrpos($Line,")")-8);
		$Line = str_replace("("," ( ",$Line);
		$Line = str_replace(")"," ) ",$Line);
		$Line = str_replace(",",", ",$Line);
		$Line = str_replace("  "," ",$Line);
		$FuncList1[count($FuncList1)] = substr($Line,0,strpos($Line,"(")-1);
		$FuncList2[count($FuncList2)]= '<div class="Top"><a href="#">^</a></div>';
		$FuncList2[count($FuncList2)-1].='<div class="Name"><a class="toggler atStart" name="'.$FuncList1[count($FuncList1)-1].'">';
		$FuncList2[count($FuncList2)-1].=$StartLineNr.". ".$FuncList1[count($FuncList1)-1];
		$FuncList2[count($FuncList2)-1].="</a></div>\n";
		$FuncList2[count($FuncList2)-1].='<div class="Klammer">(</div><div class="Vars">';
		$FuncList2[count($FuncList2)-1].=substr($Line,strpos($Line,"(")+1,strrpos($Line,")")-strpos($Line,"(")-1);
		$FuncList2[count($FuncList2)-1].='</div><div class="Klammer">)</div>';

		$FuncList2[count($FuncList2)-1].= '<div class="Comment">'.$Comment."</div>\n";
		$Comment = '';

	}
	if(strstr($Line,"{")){
		$Klammernebene++;
	}
	if(strstr($Line,"}")){
		$Klammernebene--;
	}

	 // Kommentare ...
	 // Es werden alle Kommentare, die mit ## beginnen gesammelt, die sie zwischen den Funktionen stehen.  
	 $Line = $BckpLine;
	 if(fnmatch("##*",$Line)){	 
	 	$Comment .= substr($Line,2)."<br />";
	 }elseif($Klammernebene>0 && strlen(trim($Line)) > 0){

	 	$FuncContent[count($FuncContent)]= $Line;
	 }
	 if($Klammernebene == 0 && isset($FuncList2[count($FuncList2)-1]) && count($FuncContent) > 0){
		$FuncContent[count($FuncContent)] = "}";
		$FuncContent = printCode($FuncContent,1,1,$StartLineNr);
		$FuncList2[count($FuncList2)-1].= '<div id="'.$StartLineNr.'" class="element atStart">'.$FuncContent."</div>\n";

		$FuncContent =array();

	}
}


?>
<hr />


<table cellpadding="5" cellspacing="5"><tr><td valign="top" class="FuncListLeft">

<h2>Inhalt</h2>
<?php
	natcasesort($FuncList1);
	foreach($FuncList1 as $Func){
		echo '<a href="#'.$Func.'">'.$Func."</a><br />\n";
	}

?>
</td><td valign="top">
<h2>Funktionen</h2>
<div class="accordion">
	<?php
	natcasesort($FuncList2);
	foreach($FuncList2 as $Func){
		echo '<div class="FuncDec">'.$Func.'</div>';
	}

?>
</div>
</td></tr></table>
	</body>
</html>