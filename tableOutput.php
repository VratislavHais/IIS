<?php

include 'dbInit.php';

function outputValues($table, $db) {
	$query = "SELECT * FROM " . $table;
	$result = mysql_query($query, $db);
	$html = "<center><table class=bordered>";
	while ($data = mysql_fetch_array($result, MYSQL_NUM)) {
		$html .= "<tr class=bordered>";
		foreach ($data as $key => $value) {
			if (($table == "zamestnanec") && ($_SESSION['permission'] == 0) && ($key == 4 || $key == 7 || $key == 8)) {
				continue;
			}
			$html .= "<th class=bordered>" . $value . "</th>";
		}
		if ($table == "mistnost") {
			$html .= "<th class=bordered><button type='button' onclick='showRoomStuff(".$data[0].")'>Equipment</button></th>";
		}
		if (($table == "zamestnanec") && $_SESSION['permission'] == 0) {
			continue;
		}
		$html .= "<th class=bordered><button type='button' onclick='editRowForms(\"".$table.":".$data[0]."\")'>Edit</button></th>";
		if ((($table == "objednavka") || ($table == "pronajimatel") || ($table == "umelec")) && $_SESSION['permission'] == 0) {
			continue;
		}
		$html .= "<th class=bordered><button type='button' onclick='deleteRow(\"".$table.":".$data[0]."\")'>Delete</button></tr>";
	}
	$html .= "</table>";
	if ((($table == "objednavka") || ($table == "pronajimatel") || ($table == "umelec")) && $_SESSION['permission'] == 0) {
		echo "<script>var div = document.getElementById('result'); div.innerHTML = \"" . $html . "\";</script>";
		return;
	}
	$html .= "<button type='button' onclick='addRow(\"".$table."\")'>Add</button></center>";
	return $html;
}

function addRowExp() {
	return '<div class="addForm">
			<form method="POST">
				<input type="hidden" name="exposition" value="submit" />
				<br>
				<label class="formLabel">Type: </label>
				<center><input class="formInput" type="text" name="typ"></center>
				<br>
				<label class="formLabel">Artist: </label>
				<center><input class="formInput" type="text" name="umelec"></center>
				<br>
				<label class="formLabel">Reservation date (yyyy-mm-dd): </label>
				<center><input class="formInput" type="text" name="od"></center>
				<br>
				<label class="formLabel">Expiration date (yyyy-mm-dd): </label>
				<center><input class="formInput" type="text" name="do"></center>
				<br>
				<label class="formLabel">Employee id: </label>
				<center><input class="formInput" type="text" name="idZam"></center>
				<br>
				<input type="submit" class="formButton" value="Add" />
				<button class="backFormButton" type="button" onclick="refresh(\'expozice\')">Back</button>
			</form>
		</div>';
}

function addRowRoom() {
	return '<div class="addForm">
			<form method="POST">
				<input type="hidden" name="room1" value="submit" />
				<br>
				<label class="formLabel">Exposition type: </label>
				<center><input class="formInput" type="text" name="typExp"></center>
				<br>
				<label class="formLabel">Area: </label>
				<center><input class="formInput" type="text" name="plocha"></center>
				<br>
				<label class="formLabel">Prize: </label>
				<center><input class="formInput" type="text" name="cena"></center>
				<br>
				<label class="formLabel">Shape: </label>
				<center><input class="formInput" type="text" name="tvar"></center>
				<br>
				<label class="formLabel">Employee id: </label>
				<center><input class="formInput" type="text" name="idZam"></center>
				<br>
				<input type="submit" class="formButton" value="Add" />
				<button class="backFormButton" type="button" onclick="refresh(\'mistnost\')">Back</button>
			</form>
		</div>';
}

function addRowOrder() {
	return '<div class="addForm">
			<form method="POST">
				<input type="hidden" name="order1" value="submit" />
				<br>
				<label class="formLabel">From (yyyy-mm-dd): </label>
				<center><input class="formInput" type="text" name="odOrd"></center>
				<br>
				<label class="formLabel">To (yyyy-mm-dd): </label>
				<center><input class="formInput" type="text" name="doOrd"></center>
				<br>
				<label class="formLabel">Fee: </label>
				<center><input class="formInput" type="text" name="poplatek"></center>
				<br>
				<label class="formLabel">Lessor id: </label>
				<center><input class="formInput" type="text" name="idPron"></center>
				<br>
				<label class="formLabel">Exposition id: </label>
				<center><input class="formInput" type="text" name="idExp"></center>
				<br>
				<label class="formLabel">Employee id: </label>
				<center><input class="formInput" type="text" name="idZam"></center>
				<br>
				<input type="submit" class="formButton" value="Add" />
				<button class="backFormButton" type="button" onclick="refresh(\'objednavka\')">Back</button>
			</form>
		</div>';
}

function addRowLessor() {
	return '<div class="addForm">
			<form method="POST">
				<input type="hidden" name="lessor1" value="submit" />
				<br>
				<label class="formLabel">Name: </label>
				<center><input class="formInput" type="text" name="nazev"></center>
				<br>
				<label class="formLabel">Contact: </label>
				<center><input class="formInput" type="text" name="kontakt"></center>
				<br>
				<label class="formLabel">Fee: </label>
				<center><input class="formInput" type="text" name="poplatek"></center>
				<br>
				<input type="submit" class="formButton" value="Add" />
				<button class="backFormButton" type="button" onclick="refresh(\'pronajimatel\')">Back</button>
			</form>
		</div>';
}

function addRowArtist() {
	return '<div class="addForm">
			<form method="POST">
				<input type="hidden" name="artist1" value="submit" />
				<br>
				<label class="formLabel">Name: </label>
				<center><input class="formInput" type="text" name="jmeno"></center>
				<br>
				<label class="formLabel">Surname: </label>
				<center><input class="formInput" type="text" name="prijmeni"></center>
				<br>
				<label class="formLabel">Specialization: </label>
				<center><input class="formInput" type="text" name="specializace"></center>
				<br>
				<label class="formLabel">Employee id: </label>
				<center><input class="formInput" type="text" name="idZam"></center>
				<br>
				<input type="submit" class="formButton" value="Add" />
				<button class="backFormButton" type="button" onclick="refresh(\'umelec\')">Back</button>
			</form>
		</div>';
}

function addRowEmployee() {
	return '<div class="addForm">
			<form method="POST">
				<input type="hidden" name="employee1" value="submit" />
				<br>
				<label class="formLabel">Name: </label>
				<center><input class="formInput" type="text" name="jmeno"></center>
				<br>
				<label class="formLabel">Surname: </label>
				<center><input class="formInput" type="text" name="prijmeni"></center>
				<br>
				<label class="formLabel">Date of birth (yyyy-mm-dd): </label>
				<center><input class="formInput" type="text" name="datumNar"></center>
				<br>
				<label class="formLabel">Permissions (1 = admin, 0 = employee): </label>
				<center><input class="formInput" type="text" name="prava"></center>
				<br>
				<label class="formLabel">Birth number: </label>
				<center><input class="formInput" type="text" name="rodneC"></center>
				<br>
				<label class="formLabel">Salary: </label>
				<center><input class="formInput" type="text" name="plat"></center>
				<br>
				<input type="submit" class="formButton" value="Add" />
				<button class="backFormButton" type="button" onclick="refresh(\'zamestnanec\')">Back</button>
			</form>
		</div>';
}

function addRowEquipment() {
	return '<div class="addForm">
			<form method="POST">
				<input type="hidden" name="equipment" value="submit" />
				<br>
				<label class="formLabel">Type: </label>
				<center><input class="formInput" type="text" name="typ"></center>
				<br>
				<label class="formLabel">Count: </label>
				<center><input class="formInput" type="text" name="pocet"></center>
				<br>
				<input type="submit" class="formButton" value="Add" />
				<button class="backFormButton" type="button" onclick="showRoomStuff(\''.$_SESSION['idMistnosti'].'\')">Back</button>
			</form>
		</div>';
}

if (!isset($_SESSION)) {
	session_start();
}

if (isset($_POST['refresh'])) {
	echo outputValues($_POST['refresh'], $db);
}
if (isset($_POST['addRow'])) {
	switch ($_POST['addRow']) {
		case "expozice":
			echo addRowExp();
			break;
		case "mistnost":
			echo addRowRoom();
			break;
		case "objednavka":
			echo addRowOrder();
			break;
		case "pronajimatel":
			echo addRowLessor();
			break;
		case "umelec":
			echo addRowArtist();
			break;
		case "zamestnanec":
			echo addRowEmployee();
			break;
		case "vybaveni_mistnosti":
			echo addRowEquipment();
			break;
	}
}

?>