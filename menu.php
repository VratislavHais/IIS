<head>
  <meta charset="UTF-8">
  <title>Warcraft gallery</title>
  <link rel="shortcut icon" href="./images/world-of-warcraft-logo.jpg" />
  <link rel="stylesheet" href="style.css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
</head>
<body background="./images/header-illidan.jpg">
	<div id="menu">
		<form method="POST" style="position:absolute;top:0px;right:0px;">		<!-- little cheat, so I dont need to use AJAX :) -->
			<input class="formButton" type="submit" name="logout" value="logout" />
		</form>
		<center><form method="POST" id="menu">
			<input type="hidden" name="action" value="submit" />
			<table>
				<tr>
					<th>
						<input class="menuButton" type="submit" name="exp" value="expositions" />
					</th>
					<th>
						<input class="menuButton" type="submit" name="room" value="rooms" />
					</th>
					<th>
						<input class="menuButton" type="submit" name="emp" value="employees" />
					</th>
				</tr>
				<tr>
					<th>
						<input class="menuButton" type="submit" name="order" value="orders" />
					</th>
					<th>
						<input class="menuButton" type="submit" name="lessor" value="lessors" />
					</th>
					<th>
						<input class="menuButton" type="submit" name="artist" value="artists" />
					</th>
				</tr>
			</table>
		</form>
	</div>
	<div id="result">

	</div></center>

</body>
<?php

function outputValues($table, $db) {
	$query = "SELECT * FROM " . $table;
	$result = mysql_query($query, $db);
	$html = "<center><table class=bordered>";
	while ($data = mysql_fetch_array($result, MYSQL_NUM)) {
		$html .= "<tr class=bordered>";
		foreach ($data as $key => $value) {
			if (($table == "zamestnanec") && ($_SESSION['permission'] == 0) && ($key == 4 || $key == 7 || $key == 8)) {
				$html .= "<th class=bordered>********</th>";
				continue;
			}
			$html .= "<th class=bordered>" . $value . "</th>";
		}
		if ($table == "mistnost") {
			$html .= "<th class=bordered><button type='button' onclick='showRoomStuff(".$data[0].")'>equipment</button></th>";
		}
		if ((($table == "expozice") || ($table == "mistnost") || ($table == "zamestnanec")) && $_SESSION['permission'] == 0) {
			continue;
		}
		$html .= "<th class=bordered><button type='button' onclick='deleteRow(\\\"".$table.":".$data[0]."\\\")'>Delete</button></th>";
	}
	$html .= "</table>";
	if ((($table == "expozice") || ($table == "mistnost") || ($table == "zamestnanec")) && $_SESSION['permission'] == 0) {
		echo "<script>var div = document.getElementById('result'); div.innerHTML = \"" . $html . "\";</script>";
		return;
	}
	$html .= "<button type='button' onclick='addRow(\\\"".$table."\\\")'>Add</button></center>";
	echo "<script>var div = document.getElementById('result'); div.innerHTML = \"" . $html . "\";</script>";
}

function showRoomStuff($db) {
	$query = "SELECT * FROM  `vybaveni_mistnosti` WHERE id_mistnosti=" . $_SESSION['idMistnosti'];
	$result = mysql_query($query);
	$html = "<center><table class=bordered>";
	while ($data = mysql_fetch_array($result, MYSQL_NUM)) {
		$html .= "<tr class=bordered>";
		foreach ($data as $value) {
			$html .= "<th class=bordered>" . $value . "</th>";
		}
		$html .= "<th class=bordered><button type='button' onclick='deleteRow(\\\"vybaveni_mistnosti:".$data[0].":".$_SESSION['idMistnosti']."\\\")'>Delete</button></tr>";
	}
	$html .= "</table>";
	$html .= "<button type='button' onclick='refresh(\\\"mistnost\\\")'>Back</button>";
	$html .= "<button type='button' onclick='addRow(\\\"vybaveni_mistnosti\\\")'>Add</button></center>";
	echo "<script>var div = document.getElementById('result'); div.innerHTML = \"" . $html . "\";</script>";
} 

if (!isset($_SESSION)) {
	session_start();
	if (!isset($_SESSION['lastActivity'])) {
		header("Location: ./index.php");
	}
}

include 'dbInit.php';


if (isset($_POST['action'])) {
	if (isset($_POST['exp'])) {
		outputValues('expozice', $db);
	}
	elseif (isset($_POST['room'])) {
		outputValues('mistnost', $db);
	}
	elseif (isset($_POST['emp'])) {
		outputValues('zamestnanec', $db);
	}
	elseif (isset($_POST['order'])) {
		outputValues('objednavka', $db);
	}
	elseif (isset($_POST['lessor'])) {
		outputValues('pronajimatel', $db);
	}
	elseif (isset($_POST['artist'])) {
		outputValues('umelec', $db);
	}
}

if (isset($_POST['deleteRow'])) {
	$array = explode(":", $_POST['deleteRow']);
	$query = "DELETE FROM " . $array[0] . " WHERE id_" . $array[0] . "=" . $array[1];
	mysql_query($query, $db);
}

if (isset($_POST['logout'])) {
	session_unset();
    session_destroy();
    header("Location: ./index.php");
}

include 'addRowFunctions.php';

?>

<script>
function deleteRow(tableId) {
	var rly = confirm("Do you really want to delete record?");
	if (rly) {
		var array = tableId.split(":");
		$.ajax({
			type: "POST",
			data: {deleteRow: tableId}
		})
		.done(function () {
			alert("Success!");
			if (array[0] == "vybaveni_mistnosti") {
				showRoomStuff(array[2]);
			}
			else {
				refresh(array[0]);
			}
		});
	}
}

function addRow(table) {
	$.ajax({
		type: "POST",
		url: "./tableOutput.php",
		data: {addRow: table}
	})
	.done(function (data) {
		document.getElementById('result').innerHTML = data;
	})
}

function showRoomStuff(roomId) {
	$.ajax({
		type: "POST",
		url: "./roomEquipment.php",
		data: {showRoomStuff: roomId}
	})
	.done(function (data) {
		document.getElementById('result').innerHTML = data;
	})
}

function refresh(table) {
	$.ajax({
		type: "POST",
		url: "./tableOutput.php",
		data: {refresh: table}
	}).done(function (data) {
		document.getElementById('result').innerHTML = data;
	})
}
</script>	