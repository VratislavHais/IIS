<?php

include 'dbInit.php';

if (!isset($_SESSION)) {
	session_start();
}

function editRowExp($id) {
	$query = "SELECT * FROM `expozice` WHERE id_expozice=" . $id;
	$result = mysql_query($query);
	$data = mysql_fetch_array($result, MYSQL_NUM);
	$html = '<div class="addForm">
			<form method="POST">
				<input type="hidden" name="expositionEdit" value="submit" />
				<br>
				<label class="formLabel">Type: </label>
				<center><input class="formInput" type="text" name="typ" value="'.$data[1].'"</center>
				<br>
				<label class="formLabel">Artist: </label>
				<center><input class="formInput" type="text" name="umelec" value="'.$data[2].'"</center>
				<br>
				<label class="formLabel">Reservation date (yyyy-mm-dd): </label>
				<center><input class="formInput" type="text" name="od" value="'.$data[3].'"></center>
				<br>
				<label class="formLabel">Expiration date (yyyy-mm-dd): </label>
				<center><input class="formInput" type="text" name="do" value="'.$data[4].'"></center>
				<br>
				<label class="formLabel">Employee id: </label>
				<center><input class="formInput" type="text" name="idZam" value="'.$data[5].'"></center>
				<br>
				<input type="submit" class="formButton" value="Edit" />
				<button class="backFormButton" type="button" onclick="refresh(\'expozice\')">Back</button>
			</form>
		</div>';
	return $html;
}

function editRowRoom($id) {
	$query = "SELECT * FROM `mistnost` WHERE id_mistnost=" . $id;
	$result = mysql_query($query);
	$data = mysql_fetch_array($result, MYSQL_NUM);
	$html = '<div class="addForm">
			<form method="POST">
				<input type="hidden" name="roomEdit" value="submit" />
				<br>
				<label class="formLabel">Exposition type: </label>
				<center><input class="formInput" type="text" name="typExp" value="'.$data[1].'"></center>
				<br>
				<label class="formLabel">Area: </label>
				<center><input class="formInput" type="text" name="plocha" value="'.$data[2].'"></center>
				<br>
				<label class="formLabel">Prize: </label>
				<center><input class="formInput" type="text" name="cena" value="'.$data[3].'"></center>
				<br>
				<label class="formLabel">Shape: </label>
				<center><input class="formInput" type="text" name="tvar" value="'.$data[4].'"></center>
				<br>
				<label class="formLabel">Employee id: </label>
				<center><input class="formInput" type="text" name="idZam" value="'.$data[5].'"></center>
				<br>
				<input type="submit" class="formButton" value="Edit" />
				<button class="backFormButton" type="button" onclick="refresh(\'mistnost\')">Back</button>
			</form>
		</div>';
	return $html;
}

function editRowOrder($id) {
	$query = "SELECT * FROM `objednavka` WHERE id_objednavka=" . $id;
	$result = mysql_query($query);
	$data = mysql_fetch_array($result, MYSQL_NUM);
	if ($data[3] == "yes") {
		$fee = '<input type="radio" name="poplatek" value="yes" checked>yes
						<input type="radio" name="poplatek" value="no">no</center>';
	}
	else {
		$fee = '<input type="radio" name="poplatek" value="yes">yes
						<input type="radio" name="poplatek" value="no" checked>no</center>';
	}
	$html = '<div class="addForm">
			<form method="POST" style="font-size: 20px;">
				<input type="hidden" name="orderEdit" value="submit" />
				<br>
				<label class="formLabel">From (yyyy-mm-dd): </label>
				<center><input class="formInput" type="text" name="odOrd" value="'.$data[1].'"></center>
				<br>
				<label class="formLabel">To (yyyy-mm-dd): </label>
				<center><input class="formInput" type="text" name="doOrd" value="'.$data[2].'"></center>
				<br>
				<label class="formLabel">Fee: </label>
				<center>'.$fee.'
				<br>
				<label class="formLabel">Lessor id: </label>
				<center><input class="formInput" type="text" name="idPron" value="'.$data[4].'"></center>
				<br>
				<label class="formLabel">Exposition id: </label>
				<center><input class="formInput" type="text" name="idExp" value="'.$data[5].'"></center>
				<br>
				<label class="formLabel">Employee id: </label>
				<center><input class="formInput" type="text" name="idZam" value="'.$data[6].'"></center>
				<br>
				<input type="submit" class="formButton" value="Edit" />
				<button class="backFormButton" type="button" onclick="refresh(\'objednavka\')">Back</button>
			</form>
		</div>';
	return $html;
}

function editRowLessor($id) {
	$query = "SELECT * FROM `pronajimatel` WHERE id_pronajimatel=" . $id;
	$result = mysql_query($query);
	$data = mysql_fetch_array($result, MYSQL_NUM);
	if ($data[3] == "yes") {
		$fee = '<input type="radio" name="poplatek" value="yes" checked>yes
						<input type="radio" name="poplatek" value="no">no</center>';
	}
	else {
		$fee = '<input type="radio" name="poplatek" value="yes">yes
						<input type="radio" name="poplatek" value="no" checked>no</center>';
	}
	$html = '<div class="addForm">
			<form method="POST" style="font-size: 20px;">
				<input type="hidden" name="lessorEdit" value="submit" />
				<br>
				<label class="formLabel">Name: </label>
				<center><input class="formInput" type="text" name="nazev" value="'.$data[1].'"></center>
				<br>
				<label class="formLabel">Contact: </label>
				<center><input class="formInput" type="text" name="kontakt" value="'.$data[2].'"></center>
				<br>
				<label class="formLabel">Fee: </label>
				<center>'.$fee.'
				<br>
				<input type="submit" class="formButton" value="Edit" />
				<button class="backFormButton" type="button" onclick="refresh(\'pronajimatel\')">Back</button>
			</form>
		</div>';
	return $html;
}

function editRowArtist($id) {
	$query = "SELECT * FROM `umelec` WHERE id_umelec=" . $id;
	$result = mysql_query($query);
	$data = mysql_fetch_array($result, MYSQL_NUM);
	$html = '<div class="addForm">
			<form method="POST">
				<input type="hidden" name="artistEdit" value="submit" />
				<br>
				<label class="formLabel">Name: </label>
				<center><input class="formInput" type="text" name="jmeno" value="'.$data[1].'"></center>
				<br>
				<label class="formLabel">Surname: </label>
				<center><input class="formInput" type="text" name="prijmeni" value="'.$data[2].'"></center>
				<br>
				<label class="formLabel">Specialization: </label>
				<center><input class="formInput" type="text" name="specializace" value="'.$data[3].'"></center>
				<br>
				<label class="formLabel">Employee id: </label>
				<center><input class="formInput" type="text" name="idZam" value="'.$data[4].'"></center>
				<br>
				<input type="submit" class="formButton" value="Edit" />
				<button class="backFormButton" type="button" onclick="refresh(\'umelec\')">Back</button>
			</form>
		</div>';
	return $html;
}

function editRowEmployee($id) {
	$query = "SELECT * FROM `zamestnanec` WHERE id_zamestnanec=" . $id;
	$result = mysql_query($query);
	$data = mysql_fetch_array($result, MYSQL_NUM);
	if ($data[6] == 1) {
		$admin = '<input type="radio" name="prava" value="1" checked>Admin
						<input type="radio" name="prava" value="0">Employee</center>';
	}
	else {
		$admin = '<input type="radio" name="prava" value="1">Admin
						<input type="radio" name="prava" value="0" checked>Employee</center>';
	}
	$html = '<div class="addForm">
			<form method="POST" style="font-size: 20px;">
				<input type="hidden" name="employeeEdit" value="submit" />
				<br>
				<label class="formLabel">Name: </label>
				<center><input class="formInput" type="text" name="jmeno" value="'.$data[1].'"></center>
				<br>
				<label class="formLabel">Surname: </label>
				<center><input class="formInput" type="text" name="prijmeni" value="'.$data[2].'"></center>
				<br>
				<label class="formLabel">Date of birth (yyyy-mm-dd): </label>
				<center><input class="formInput" type="text" name="datumNar" value="'.$data[5].'"></center>
				<br>
				<label class="formLabel">Permissions: </label>
				<center>' . $admin . '
				<br>
				<label class="formLabel">Birth number: </label>
				<center><input class="formInput" type="text" name="rodneC" value="'.$data[7].'"></center>
				<br>
				<label class="formLabel">Salary: </label>
				<center><input class="formInput" type="text" name="plat" value="'.$data[8].'"></center>
				<br>
				<input type="submit" class="formButton" value="Edit" />
				<button class="backFormButton" type="button" onclick="refresh(\'zamestnanec\')">Back</button>
			</form>
		</div>';
	return $html;
}

function editRowEquipment($id) {
	$query = "SELECT * FROM `vybaveni_mistnosti` WHERE id_vybaveni_mistnosti=" . $id;
	$result = mysql_query($query);
	$data = mysql_fetch_array($result, MYSQL_NUM);
	$html = '<div class="addForm">
			<form method="POST">
				<input type="hidden" name="equipmentEdit" value="submit" />
				<br>
				<label class="formLabel">Type: </label>
				<center><input class="formInput" type="text" name="typ" value="'.$data[1].'"></center>
				<br>
				<label class="formLabel">Count: </label>
				<center><input class="formInput" type="text" name="pocet" value="'.$data[2].'"></center>
				<br>
				<input type="submit" class="formButton" value="Edit" />
				<button class="backFormButton" type="button" onclick="showRoomStuff(\''.$_SESSION['idMistnosti'].'\')">Back</button>
			</form>
		</div>';
	return $html;
}

if (!isset($_SESSION)) {
	session_start();
}

if (isset($_POST['editRow'])) {
	$array = explode(":", $_POST['editRow']);
	switch ($array[0]) {
		case "expozice":
			echo editRowExp($array[1]);
			$_SESSION['editId'] = $array[1];
			break;
		case "mistnost":
			echo editRowRoom($array[1]);
			$_SESSION['editId'] = $array[1];
			break;
		case "objednavka":
			echo editRowOrder($array[1]);
			$_SESSION['editId'] = $array[1];
			break;
		case "pronajimatel":
			echo editRowLessor($array[1]);
			$_SESSION['editId'] = $array[1];
			break;
		case "umelec":
			echo editRowArtist($array[1]);
			$_SESSION['editId'] = $array[1];
			break;
		case "zamestnanec":
			echo editRowEmployee($array[1]);
			$_SESSION['editId'] = $array[1];
			break;
		case "vybaveni_mistnosti":
			echo editRowEquipment($array[1]);
			$_SESSION['editId'] = $array[1];
			break;
	}
}

?>