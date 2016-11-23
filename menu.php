<head>
  <meta charset="UTF-8">
  <title>Warcraft gallery</title>
  <link rel="shortcut icon" href="./images/world-of-warcraft-logo.jpg" />
  <link rel="stylesheet" href="style.css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
</head>
<body>
	<div id="menu">
		<form method="POST" id="menu">
			<input type="hidden" name="action" value="submit" />
			<table>
				<tr>
					<th>
						<input class="menuButton" type="submit" name="exp" value="exposition edit" />
					</th>
					<th>
						<input class="menuButton" type="submit" name="room" value="room edit" />
					</th>
					<th>
						<input class="menuButton" type="submit" name="emp" value="employee edit" />
					</th>
				</tr>
				<tr>
					<th>
						<input class="menuButton" type="submit" name="order" value="order edit" />
					</th>
					<th>
						<input class="menuButton" type="submit" name="lessor" value="lessor edit" />
					</th>
					<th>
						<input class="menuButton" type="submit" name="artist" value="artist edit" />
					</th>
				</tr>
			</table>
		</form>
	</div>

</body>
<?php

function outputValues($table, $db) {
	$query = "SELECT * FROM " . $table;
	$result = mysql_query($query, $db);
	while ($data = mysql_fetch_array($result, MYSQL_NUM)) {
		echo "<table class=bordered><tr class=bordered>";
		foreach ($data as $value) {
			echo "<th class=bordered>" . $value . "</th>";
		}
		echo "<th class=bordered><button type='button' onclick='deleteRow(\"".$table.":".$data[0]."\")'>Delete</button></tr></table>";
	}
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
	echo "<script>alert('Success!')</script>";
	outputValues($array[0], $db);
}

?>

<script>
function deleteRow(tableId) {
	var rly = confirm("Do you really want to delete record?");
	if (rly) {
		$.ajax({
			type: "POST",
			data: {deleteRow: tableId}
		})
	}
}
</script>	