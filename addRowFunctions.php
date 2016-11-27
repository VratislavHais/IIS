<?php

function error($table) {
	echo "<script>alert('Please fill every field');
	$.ajax({
		type: \"POST\",
		url: \"./tableOutput.php\",
		data: {addRow: '".$table."'}
	})
	.done(function (data) {
		document.getElementById('result').innerHTML = data;
	});</script>";
}


if (!isset($_SESSION)) {
	session_start();
}

if (isset($_POST['exposition'])) {
	if ($_POST['typ'] != "" and $_POST['umelec'] != "" and $_POST['od'] != "" and $_POST['do'] != "" and $_POST['idZam'] != "") {
		$query = "INSERT INTO `xhaisv00`.`expozice` (`id_expozice`, `typ`, `umelec`, `od`, `do`, `id_zamestnance`) VALUES (NULL, '".$_POST['typ']."', '".$_POST['umelec']."', '".$_POST['od']."', '".$_POST['do']."', '".$_POST['idZam']."');";
		if (mysql_query($query)) {
			echo "<script>alert('Success!');</script>";
			outputValues('expozice', $db);
		}
	}
	else {
		error("expozice");
	}
}

if (isset($_POST['room1'])) {
	if ($_POST['typExp'] != "" and $_POST['plocha'] != "" and $_POST['cena'] != "" and $_POST['tvar'] != "" and $_POST['idZam'] != "") {
		$query = "INSERT INTO `xhaisv00`.`mistnost` (`id_mistnost`, `typ_exp`, `plocha`, `cena`, `tvar`, `id_zamestnance`) VALUES (NULL, '".$_POST['typExp']."', '".$_POST['plocha']."', '".$_POST['cena']."', '".$_POST['tvar']."', '".$_POST['idZam']."');";
		if (mysql_query($query)) {
			echo "<script>alert('Success!');</script>";
			outputValues('mistnost', $db);
		}
	}
	else {
		error("mistnost");
	}
}

if (isset($_POST['order1'])) {
	if ($_POST['odOrd'] != "" and $_POST['doOrd'] != "" and $_POST['poplatek'] != "" and $_POST['idPron'] != "" and $_POST['idExp'] != "" and $_POST['idZam'] != "") {
		$query = "INSERT INTO `xhaisv00`.`objednavka` (`id_objednavka`, `od`, `do`, `poplatek`, `id_pronajimatele`, `id_expozice`, `id_zamestnance`) VALUES (NULL, '".$_POST['odOrd']."', '".$_POST['doOrd']."', '".$_POST['poplatek']."', '".$_POST['idPron']."', '".$_POST['idExp']."', '".$_POST['idZam']."');";
		if (mysql_query($query)) {
			echo "<script>alert('Success!');</script>";
			outputValues('objednavka', $db);
		}
	}
	else {
		error("objednavka");
	}
}

if (isset($_POST['lessor1'])) {
	if ($_POST['nazev'] != "" and $_POST['kontakt'] != "" and $_POST['poplatek'] != "") {
		$query = "INSERT INTO `xhaisv00`.`pronajimatel` (`id_pronajimatel`, `nazev`, `kontakt`, `poplatek`) VALUES (NULL, '".$_POST['nazev']."', '".$_POST['kontakt']."', '".$_POST['poplatek']."');";
		if (mysql_query($query)) {
			echo "<script>alert('Success!');</script>";
			outputValues('pronajimatel', $db);
		}
	}
	else {
		error("pronajimatel");
	}
}

if (isset($_POST['artist1'])) {
	if ($_POST['jmeno'] != "" and $_POST['prijmeni'] != "" and $_POST['specializace'] != "" and $_POST['idZam'] != "") {
		$query = "INSERT INTO `xhaisv00`.`umelec` (`id_umelec`, `jmeno`, `prijmeni`, `specializace`, `id_zamestnance`) VALUES (NULL, '".$_POST['jmeno']."', '".$_POST['prijmeni']."', '".$_POST['specializace']."', '".$_POST['idZam']."');";
		if (mysql_query($query)) {
			echo "<script>alert('Success!');</script>";
			outputValues('umelec', $db);
		}
	}
	else {
		error("umelec");
	}
}

if (isset($_POST['employee1'])) {
	if ($_POST['jmeno'] != "" and $_POST['prijmeni'] != "" and $_POST['datumNar'] != "" and $_POST['prava'] != "" and $_POST['rodneC'] != "" and $_POST['plat'] != "") {
		$length = strlen($_POST['prijmeni']);
		$login = "x";
		if ($length >= 5) {
			$login .= substr($_POST['prijmeni'], 0, 5);
		}
		else {
			$login .= $_POST['prijmeni'] . substr($_POST['jmeno'], 0, 5-$length);
		}
		$number = mysql_query("SELECT MAX(  `id_zamestnanec` ) FROM zamestnanec");
		$number = mysql_fetch_array($number);
		$number = $number[0] + 1;
		echo "<script>console.log(".$number.")</script>";
		if ($number < 10) {
			$number = "0" . $number;
		}
		$login .= $number;
		$login = strtolower($login);
		//random password generator
		$characters = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
		$numberOfChars = strlen($characters);
		$password = "";
		for ($i = 0; $i < 8; $i++) {
			$password .= $characters[rand(0, $numberOfChars - 1)];
		}
		$query = "INSERT INTO `xhaisv00`.`zamestnanec` (`id_zamestnanec`, `jmeno`, `prijmeni`, `login`, `heslo`, `datum_nar`, `prava`, `rod_cislo`, `plat`) VALUES (NULL, '".$_POST['jmeno']."', '".$_POST['prijmeni']."', '".$login."', '".$password."', '".$_POST['datumNar']."', '".$_POST['prava']."', '".$_POST['rodneC']."', '".$_POST['plat']."');";
		if (mysql_query($query)) {
			echo "<script>alert('Success!');</script>";
			outputValues('zamestnanec', $db);
		}
		else {
			error("zamestnanec");
		}
	}
}

if (isset($_POST['equipment'])) {
	if ($_POST['typ'] != "" and $_POST['pocet'] != "") {
		$query = "INSERT INTO `xhaisv00`.`vybaveni_mistnosti` (`id_vybaveni_mistnosti`, `typ`, `pocet`, `id_mistnosti`) VALUES (NULL, '".$_POST['typ']."', '".$_POST['pocet']."', '".$_SESSION['idMistnosti']."');";
		echo "<script>console.log(\"".$query."\");</script>";
		if (mysql_query($query)) {
			echo "<script>alert('Success!');</script>";
			showRoomStuff($db);
		}
	}
	else {
		echo "<script>alert('Please fill every field');
		$.ajax({
		type: \"POST\",
		url: \"./roomEquipment.php\",
		data: {showRoomStuff: '".$_SESSION['idMistnosti']."'}
		})
		.done(function (data) {
			document.getElementById('result').innerHTML = data;
		})</script>";
	}
}

?>