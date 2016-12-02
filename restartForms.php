<?php

if (!isset($_SESSION)) {
	session_start();
}

function formRowExp($button, $name) {
	return '<div class="addForm">
			<form method="POST">
				<input type="hidden" name="exposition'.$name.'" value="submit" />
				<br>
				<label class="formLabel">Type: </label>
				<center><input class="formInput" type="text" name="typ" value="'.$_SESSION['typ'].'"></center>
				<br>
				<label class="formLabel">Artist: </label>
				<center><input class="formInput" type="text" name="umelec" value="'.$_SESSION['umelec'].'"></center>
				<br>
				<label class="formLabel">Reservation date (yyyy-mm-dd): </label>
				<center><input class="formInput" type="text" name="od" value="'.$_SESSION['od'].'"></center>
				<br>
				<label class="formLabel">Expiration date (yyyy-mm-dd): </label>
				<center><input class="formInput" type="text" name="do" value="'.$_SESSION['do'].'"></center>
				<br>
				<input type="submit" class="formButton" value="'.$button.'" />
				<button class="backFormButton" type="button" onclick="refresh(\'expozice\')">Back</button>
			</form>
		</div>';
}

function formRowRoom($button, $name) {
	return '<div class="addForm">
			<form method="POST">
				<input type="hidden" name="room'.$name.'" value="submit" />
				<br>
				<label class="formLabel">Exposition type: </label>
				<center><input class="formInput" type="text" name="typExp" value="'.$_SESSION['typExp'].'"></center>
				<br>
				<label class="formLabel">Area: </label>
				<center><input class="formInput" type="text" name="plocha" value="'.$_SESSION['plocha'].'"></center>
				<br>
				<label class="formLabel">Prize: </label>
				<center><input class="formInput" type="text" name="cena" value="'.$_SESSION['cena'].'"></center>
				<br>
				<label class="formLabel">Shape: </label>
				<center><input class="formInput" type="text" name="tvar" value="'.$_SESSION['tvar'].'"></center>
				<br>
				<input type="submit" class="formButton" value="'.$button.'" />
				<button class="backFormButton" type="button" onclick="refresh(\'mistnost\')">Back</button>
			</form>
		</div>';
}

function formRowOrder($button, $name) {
	return '<div class="addForm">
			<form method="POST">
				<input type="hidden" name="order'.$name.'" value="submit" />
				<br>
				<label class="formLabel">From (yyyy-mm-dd): </label>
				<center><input class="formInput" type="text" name="odOrd" value="'.$_SESSION['odOrd'].'"></center>
				<br>
				<label class="formLabel">To (yyyy-mm-dd): </label>
				<center><input class="formInput" type="text" name="doOrd" value="'.$_SESSION['doOrd'].'"></center>
				<br>
				<label class="formLabel">Fee: </label>
				<center><input class="formInput" type="text" name="poplatek" value="'.$_SESSION['poplatek'].'"></center>
				<br>
				<label class="formLabel">Lessor id: </label>
				<center><input class="formInput" type="text" name="idPron" value="'.$_SESSION['idPron'].'"></center>
				<br>
				<label class="formLabel">Exposition id: </label>
				<center><input class="formInput" type="text" name="idExp" value="'.$_SESSION['idExp'].'"></center>
				<br>
				<input type="submit" class="formButton" value="'.$button.'" />
				<button class="backFormButton" type="button" onclick="refresh(\'objednavka\')">Back</button>
			</form>
		</div>';
}

function formRowLessor($button, $name) {
	return '<div class="addForm">
			<form method="POST">
				<input type="hidden" name="lessor'.$name.'" value="submit" />
				<br>
				<label class="formLabel">Name: </label>
				<center><input class="formInput" type="text" name="nazev" value="'.$_SESSION['nazev'].'"></center>
				<br>
				<label class="formLabel">Contact: </label>
				<center><input class="formInput" type="text" name="kontakt" value="'.$_SESSION['kontakt'].'"></center>
				<br>
				<label class="formLabel">Fee: </label>
				<center><input class="formInput" type="text" name="poplatek" value="'.$_SESSION['poplatek'].'"></center>
				<br>
				<input type="submit" class="formButton" value="'.$button.'" />
				<button class="backFormButton" type="button" onclick="refresh(\'pronajimatel\')">Back</button>
			</form>
		</div>';
}

function formRowArtist($button, $name) {
	return '<div class="addForm">
			<form method="POST">
				<input type="hidden" name="artist'.$name.'" value="submit" />
				<br>
				<label class="formLabel">Name: </label>
				<center><input class="formInput" type="text" name="jmeno" value="'.$_SESSION['jmeno'].'"></center>
				<br>
				<label class="formLabel">Surname: </label>
				<center><input class="formInput" type="text" name="prijmeni" value="'.$_SESSION['prijmeni'].'"></center>
				<br>
				<label class="formLabel">Specialization: </label>
				<center><input class="formInput" type="text" name="specializace" value="'.$_SESSION['specializace'].'"></center>
				<br>
				<input type="submit" class="formButton" value="'.$button.'" />
				<button class="backFormButton" type="button" onclick="refresh(\'umelec\')">Back</button>
			</form>
		</div>';
}

function formRowEmployee($button, $name) {
	return '<div class="addForm">
			<form method="POST" style="font-size: 20px;">
				<input type="hidden" name="employee'.$name.'" value="submit" />
				<br>
				<label class="formLabel">Name: </label>
				<center><input class="formInput" type="text" name="jmeno" value="'.$_SESSION['jmeno'].'"></center>
				<br>
				<label class="formLabel">Surname: </label>
				<center><input class="formInput" type="text" name="prijmeni" value="'.$_SESSION['prijmeni'].'"></center>
				<br>
				<label class="formLabel">Date of birth (yyyy-mm-dd): </label>
				<center><input class="formInput" type="text" name="datumNar" value="'.$_SESSION['datumNar'].'"></center>
				<br>
				<label class="formLabel">Permissions: </label>
				<center><input type="radio" name="prava" value="1">Admin
						<input type="radio" name="prava" value="0">Employee</center>
				<br>
				<label class="formLabel">Birth number: </label>
				<center><input class="formInput" type="text" name="rodneC" value="'.$_SESSION['rodneC'].'"></center>
				<br>
				<label class="formLabel">Salary: </label>
				<center><input class="formInput" type="text" name="plat" value="'.$_SESSION['plat'].'"></center>
				<br>
				<input type="submit" class="formButton" value="'.$button.'" />
				<button class="backFormButton" type="button" onclick="refresh(\'zamestnanec\')">Back</button>
			</form>
		</div>';
}

function addRowEquipment($button, $name) {
	return '<div class="addForm">
			<form method="POST">
				<input type="hidden" name="equipment'.$name.'" value="submit" />
				<br>
				<label class="formLabel">Type: </label>
				<center><input class="formInput" type="text" name="typ" value="'.$_SESSION['typ'].'"></center>
				<br>
				<label class="formLabel">Count: </label>
				<center><input class="formInput" type="text" name="pocet" value="'.$_SESSION['pocet'].'"></center>
				<br>
				<input type="submit" class="formButton" value="'.$button.'" />
				<button class="backFormButton" type="button" onclick="showRoomStuff(\''.$_SESSION['idMistnosti'].'\')">Back</button>
			</form>
		</div>';
}


if (isset($_POST['errorForm'])) {
	$array = explode(":", $_POST['errorForm']);
	if ($array[1] == "Edit") {
		$name = "Edit";
	}
	else {
		$name = 1;
	}
	$button = $array[1];
	switch ($array[0]) {
		case "expozice":
			if ($name == 1) {
				$name = "";
			}
			echo formRowExp($button, $name);
			break;
		case "mistnost":
			echo formRowRoom($button, $name);
			break;
		case "objednavka":
			echo formRowOrder($button, $name);
			break;
		case "pronajimatel":
			echo formRowLessor($button, $name);
			break;
		case "umelec":
			echo formRowArtist($button, $name);
			break;
		case "zamestnanec":
			echo formRowEmployee($button, $name);
			break;
		case "vybaveni_mistnosti":
			if ($name == 1) {
				$name = "";
			}
			echo formRowEquipment($button, $name);
			break;
	}
}

?>