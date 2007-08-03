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