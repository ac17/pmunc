<?php
// converts a MySQL table to a CSV
function encodeCSV($tableName, $orderBy) {
	$mysqli = new mysqli("localhost", "modelun", "flp5WxQGTJgk", "modelun_pmunc2014");
	$query = "SELECT * FROM " . $tableName . " ORDER BY " . $orderBy . ";";
	$result = $mysqli->query($query);
	$csvOutput;
	if ($result) {
		/* print header */
		$numFields = mysqli_field_count($mysqli);
		for($x = 0; $x < $numFields; $x++) {
			$fInfo = mysqli_fetch_field($result);
			$fName = $fInfo -> name;
			$csvOutput = $csvOutput . $fName;
			if ($x < $numFields - 1)
				$csvOutput = $csvOutput . ",";
			else
				$csvOutput = $csvOutput . "\n";
		}
		/* print data */
		for ($x = 0; $x < mysqli_num_rows($result); $x++) {
			$row = mysqli_fetch_row($result);
			for ($y = 0; $y < count($row); $y++) {
				$newEntry = $row[$y];
				if (strpos($newEntry, ',')) $newEntry = '"' . $newEntry . '"';
				$csvOutput = $csvOutput . $newEntry;
				if ($y < count($row) - 1) $csvOutput = $csvOutput . ",";
				else $csvOutput = $csvOutput . "\n";
			}
		}
		return $csvOutput;
	}
	else return NULL;
}
?>