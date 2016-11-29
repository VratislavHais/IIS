<?php

function error($table, $process) {
	echo "<script>alert('Invalid input');
	$.ajax({
		type: \"POST\",
		url: \"./restartForms.php\",
		data: {errorForm: '".$table.":".$process."'}
	})
	.done(function (data) {
		document.getElementById('result').innerHTML = data;
	});</script>";
}

function dateCheck($date) {
	$array = explode("-", $date);
	if (count($array) < 3) {
		return false;
	}
	if (!ctype_digit($array[0]) || !ctype_digit($array[1]) || !ctype_digit($array[2])) {
		return false;
	}
	return checkdate($array[1], $array[2], $array[0]);
}

function dates($from, $to) {
	if (!dateCheck($from) || !dateCheck($to)) {
		return false;
	}
	$from = str_replace("-", "", $from);
	$to = str_replace("-", "", $to);
	if ($from > $to) {
		return false;
	}
	return true;
}

function idInDb($id, $table, $db) {
	$query = "SELECT * FROM ".$table." WHERE id_".$table."=".$id;
	if (mysql_query($query)) {
		return true;
	}
	else {
		return false;
	}
}

if (!isset($_SESSION)) {
	session_start();
}

if (isset($_POST['exposition'])) {
	if ($_POST['typ'] != "" and $_POST['umelec'] != "" and $_POST['od'] != "" and $_POST['do'] != "" and dates($_POST['od'], $_POST['do'])) {
		$query = "INSERT INTO `xhaisv00`.`expozice` (`id_expozice`, `typ`, `umelec`, `od`, `do`, `id_zamestnance`) VALUES (NULL, '".$_POST['typ']."', '".$_POST['umelec']."', '".$_POST['od']."', '".$_POST['do']."', '".$_SESSION['id']."');";
		if (mysql_query($query)) {
			echo "<script>alert('Success!');</script>";
			outputValues('expozice', $db);
		}
	}
	else {
		$_SESSION['typ'] = $_POST['typ'];
		$_SESSION['umelec'] = $_POST['umelec'];
		$_SESSION['od'] = $_POST['od'];
		$_SESSION['do'] = $_POST['do'];
		error("expozice", "Add");
	}
}

if (isset($_POST['room1'])) {
	if ($_POST['typExp'] != "" and $_POST['plocha'] != "" and $_POST['cena'] != "" and $_POST['tvar'] != "" and ctype_digit($_POST['cena'])) {
		$query = "INSERT INTO `xhaisv00`.`mistnost` (`id_mistnost`, `typ_exp`, `plocha`, `cena`, `tvar`, `id_zamestnance`) VALUES (NULL, '".$_POST['typExp']."', '".$_POST['plocha']."', '".$_POST['cena']."', '".$_POST['tvar']."', '".$_SESSION['id']."');";
		if (mysql_query($query)) {
			echo "<script>alert('Success!');</script>";
			outputValues('mistnost', $db);
		}
	}
	else {
		$_SESSION['typExp'] = $_POST['typExp'];
		$_SESSION['plocha'] = $_POST['plocha'];
		$_SESSION['cena'] = $_POST['cena'];
		$_SESSION['tvar'] = $_POST['tvar'];
		error("mistnost", "Add");
	}
}

if (isset($_POST['order1'])) {
	if ($_POST['odOrd'] != "" and $_POST['doOrd'] != "" and $_POST['poplatek'] != "" and $_POST['idPron'] != "" and $_POST['idExp'] != "" and dates($_POST['odOrd'], $_POST['doOrd']) and ctype_digit($_POST['poplatek']) and idInDb($_POST['idPron'], "pronajimatel", $db) and idInDb($_POST['idExp'], "expozice", $db)) {
		$query = "INSERT INTO `xhaisv00`.`objednavka` (`id_objednavka`, `od`, `do`, `poplatek`, `id_pronajimatele`, `id_expozice`, `id_zamestnance`) VALUES (NULL, '".$_POST['odOrd']."', '".$_POST['doOrd']."', '".$_POST['poplatek']."', '".$_POST['idPron']."', '".$_POST['idExp']."', '".$_SESSION['id']."');";
		if (mysql_query($query)) {
			echo "<script>alert('Success!');</script>";
			outputValues('objednavka', $db);
		}
	}
	else {
		$_SESSION['odOrd'] = $_POST['odOrd'];
		$_SESSION['doOrd'] = $_POST['doOrd'];
		$_SESSION['poplatek'] = $_POST['poplatek'];
		$_SESSION['idPron'] = $_POST['idPron'];
		$_SESSION['idExp'] = $_POST['idExp'];
		error("objednavka", "Add");
	}
}

if (isset($_POST['lessor1'])) {
	if ($_POST['nazev'] != "" and $_POST['kontakt'] != "" and $_POST['poplatek'] != "" and ctype_digit($_POST['poplatek'])) {
		$query = "INSERT INTO `xhaisv00`.`pronajimatel` (`id_pronajimatel`, `nazev`, `kontakt`, `poplatek`) VALUES (NULL, '".$_POST['nazev']."', '".$_POST['kontakt']."', '".$_POST['poplatek']."');";
		if (mysql_query($query)) {
			echo "<script>alert('Success!');</script>";
			outputValues('pronajimatel', $db);
		}
	}
	else {
		$_SESSION['nazev'] = $_POST['nazev'];
		$_SESSION['kontakt'] = $_POST['kontakt'];
		$_SESSION['poplatek'] = $_POST['poplatek'];
		error("pronajimatel", "Add");
	}
}

if (isset($_POST['artist1'])) {
	if ($_POST['jmeno'] != "" and $_POST['prijmeni'] != "" and $_POST['specializace'] != "") {
		$query = "INSERT INTO `xhaisv00`.`umelec` (`id_umelec`, `jmeno`, `prijmeni`, `specializace`, `id_zamestnance`) VALUES (NULL, '".$_POST['jmeno']."', '".$_POST['prijmeni']."', '".$_POST['specializace']."', '".$_SESSION['id']."');";
		if (mysql_query($query)) {
			echo "<script>alert('Success!');</script>";
			outputValues('umelec', $db);
		}
	}
	else {
		$_SESSION['jmeno'] = $_POST['jmeno'];
		$_SESSION['prijmeni'] = $_POST['prijmeni'];
		$_SESSION['specializace'] = $_POST['specializace'];
		error("umelec", "Add");
	}
}

if (isset($_POST['employee1'])) {
	if ($_POST['jmeno'] != "" and $_POST['prijmeni'] != "" and $_POST['datumNar'] != "" and $_POST['prava'] != "" and $_POST['rodneC'] != "" and $_POST['plat'] != "" and
		dateCheck($_POST['datumNar']) and ($_POST['prava'] == 0 || $_POST['prava'] == 1) and (($POST['rodneC'] % 11) == 0) and ctype_digit($_POST['plat'])) {
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
			$_SESSION['jmeno'] = $_POST['jmeno'];
			$_SESSION['prijmeni'] = $_POST['prijmeni'];
			$_SESSION['datumNar'] = $_POST['datumNar'];
			$_SESSION['prava'] = $_POST['prava'];
			$_SESSION['rodneC'] = $_POST['rodneC'];
			$_SESSION['plat'] = $_POST['plat'];
			error("zamestnanec", "Add");
		}
	}
}

if (isset($_POST['equipment'])) {
	if ($_POST['typ'] != "" and $_POST['pocet'] != "" and ctype_digit($_POST['pocet'])) {
		$query = "INSERT INTO `xhaisv00`.`vybaveni_mistnosti` (`id_vybaveni_mistnosti`, `typ`, `pocet`, `id_mistnosti`) VALUES (NULL, '".$_POST['typ']."', '".$_POST['pocet']."', '".$_SESSION['idMistnosti']."');";
		if (mysql_query($query)) {
			echo "<script>alert('Success!');</script>";
			showRoomStuff($db);
		}
	}
	else {
		$_SESSION['typ'] = $_POST['typ'];
		$_SESSION['pocet'] = $_POST['pocet'];
		error("vybaveni_mistnosti", "Add");
	}
}

?>