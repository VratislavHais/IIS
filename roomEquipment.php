<?php

include 'dbInit.php';

if (!isset($_SESSION)) {
	session_start();
}

if (isset($_POST['showRoomStuff'])) {
	$_SESSION['idMistnosti'] = $_POST['showRoomStuff'];
	$query = "SELECT * FROM  `vybaveni_mistnosti` WHERE id_mistnosti=" . $_POST['showRoomStuff'];
	$result = mysql_query($query);
	$html = "<center><table class=bordered>";
	while ($data = mysql_fetch_array($result, MYSQL_NUM)) {
		$html .= "<tr class=bordered>";
		foreach ($data as $value) {
			$html .= "<th class=bordered>" . $value . "</th>";
		}
		$html .= "<th class=bordered><button type='button' onclick='editRow(\"vybaveni_mistnosti:".$data[0].":".$_SESSION['idMistnosti']."\")'>Edit</button></th>";
		$html .= "<th class=bordered><button type='button' onclick='deleteRow(\"vybaveni_mistnosti:".$data[0].":".$_SESSION['idMistnosti']."\")'>Delete</button></tr>";
	}
	$html .= "</table>";
	$html .= "<button type='button' onclick='refresh(\"mistnost\")'>Back</button>";
	$html .= "<button type='button' onclick='addRow(\"vybaveni_mistnosti\")'>Add</button></center>";
	echo $html;
}

?>