<?php

include 'dbInit.php';

function outputValues($table, $db) {
	$query = "SELECT * FROM " . $table;
	$result = mysql_query($query, $db);
	$html = "";
	while ($data = mysql_fetch_array($result, MYSQL_NUM)) {
		$html .= "<table class=bordered><tr class=bordered>";
		foreach ($data as $value) {
			$html .= "<th class=bordered>" . $value . "</th>";
		}
		$html .= "<th class=bordered><button type='button' onclick='deleteRow(\\\"".$table.":".$data[0]."\\\")'>Delete</button></tr></table>";
	}
	return $html;
}

if (isset($_POST['refresh'])) {
	echo outputValues($_POST['refresh'], $db);
}

?>