<?php 

function printCode($code, $high_light = 0, $lines_number = 0,$line_number_start = 0){
	if (!is_array($code))
		$code = explode("\n", $code);
	$count_lines = count($code);
	$r = "";
	$line = $line_number_start;

	foreach ($code as $code_line){

		if ($lines_number) $r1 = "<span class=\"lines_number\">".$line.". </span>";

		if ($high_light) {
			if (ereg("<\?(php)?[^[:graph:]]", $code_line)){
				$r2 = highlight_string($code_line, 1);
			}else{
				$r2 = ereg_replace("(&lt;\?php&nbsp;)+", "", highlight_string("<?php ".$code_line, 1));
			}
		}else{
			$r2 = (!$line) ? "<pre>" : "";
			$r2 .= htmlentities($code_line);
			$r2 .= ($line == ($count_lines - 1)) ? "<br /></pre>" : "";
		}
		$r .= $r1.$r2;
		$line++;
	}

	return "<div class=\"code\">".$r."</div>";
} 
?>