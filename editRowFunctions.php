<?php

if (isset($_POST['expositionEdit'])) {
	if ($_POST['typ'] != "" and $_POST['umelec'] != "" and $_POST['od'] != "" and $_POST['do'] != "" and dates($_POST['od'], $_POST['do'])) {
		$query = "UPDATE `expozice` SET `typ`='".$_POST['typ']."', `umelec`='".$_POST['umelec']."', `od`='".$_POST['od']."', `do`='".$_POST['do']."' WHERE `id_expozice`=".$_SESSION['editId'].";";
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
		error("expozice", "Edit");
	}
}

if (isset($_POST['roomEdit'])) {
	if ($_POST['typExp'] != "" and $_POST['plocha'] != "" and $_POST['cena'] != "" and $_POST['tvar'] != "" and ctype_digit($_POST['cena'])) {
		$query = "UPDATE `mistnost` SET `typ_exp`='".$_POST['typExp']."', `plocha`='".$_POST['plocha']."', `cena`='".$_POST['cena']."', `tvar`='".$_POST['tvar']."' WHERE `id_mistnost`=".$_SESSION['editId'].";";
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
		error("mistnost", "Edit");
	}
}

if (isset($_POST['orderEdit'])) {
	if ($_POST['odOrd'] != "" and $_POST['doOrd'] != "" and $_POST['poplatek'] != "" and $_POST['idPron'] != "" and $_POST['idExp'] != "" and dates($_POST['odOrd'], $_POST['doOrd']) and ctype_digit($_POST['poplatek']) and idInDb($_POST['idPron'], "pronajimatel", $db) and idInDb($_POST['idExp'], "expozice", $db)) {
		$query = "UPDATE `objednavka` SET `od`='".$_POST['odOrd']."', `do`='".$_POST['doOrd']."', `poplatek`='".$_POST['poplatek']."', `id_pronajimatele`='".$_POST['idPron']."', `id_expozice`='".$_POST['idExp']."' WHERE `id_mistnost`=".$_SESSION['editId'].";";
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
		error("objednavka", "Edit");
	}
}

if (isset($_POST['lessorEdit'])) {
	if ($_POST['nazev'] != "" and $_POST['kontakt'] != "" and $_POST['poplatek'] != "" and ctype_digit($_POST['poplatek'])) {
		$query = "UPDATE `pronajimatel` SET `nazev`='".$_POST['nazev']."', `kontakt`='".$_POST['kontakt']."', `poplatek`='".$_POST['poplatek']."' WHERE `id_mistnost`=".$_SESSION['editId'].";";
		if (mysql_query($query)) {
			echo "<script>alert('Success!');</script>";
			outputValues('pronajimatel', $db);
		}
	}
	else {
		$_SESSION['nazev'] = $_POST['nazev'];
		$_SESSION['kontakt'] = $_POST['kontakt'];
		$_SESSION['poplatek'] = $_POST['poplatek'];
		error("pronajimatel", "Edit");
	}
}

if (isset($_POST['artistEdit'])) {
	if ($_POST['jmeno'] != "" and $_POST['prijmeni'] != "" and $_POST['specializace'] != "") {
		$query = "UPDATE `umelec` SET `jmeno`='".$_POST['jmeno']."', `prijmeni`='".$_POST['prijmeni']."', `specializace`='".$_POST['specializace']."' WHERE `id_mistnost`=".$_SESSION['editId'].";";
		if (mysql_query($query)) {
			echo "<script>alert('Success!');</script>";
			outputValues('umelec', $db);
		}
	}
	else {
		$_SESSION['jmeno'] = $_POST['jmeno'];
		$_SESSION['prijmeni'] = $_POST['prijmeni'];
		$_SESSION['specializace'] = $_POST['specializace'];
		error("umelec", "Edit");
	}
}

if (isset($_POST['employeeEdit'])) {
	if ($_POST['jmeno'] != "" and $_POST['prijmeni'] != "" and $_POST['datumNar'] != "" and $_POST['prava'] != "" and $_POST['rodneC'] != "" and $_POST['plat'] != "" and
		dateCheck($_POST['datumNar']) and ($_POST['prava'] == 0 || $_POST['prava'] == 1) and (($POST['rodneC'] % 11) == 0) and ctype_digit($_POST['plat'])) {
		$query = "UPDATE `zamestnanec` SET `jmeno`='".$_POST['jmeno']."', `prijmeni`='".$_POST['prijmeni']."', `datum_nar`='".$_POST['datumNar']."', `prava`='".$_POST['prava']."', `rod_cislo`='".$_POST['rodneC']."', `plat`='".$_POST['plat']."' WHERE `id_mistnost`=".$_SESSION['editId'].";";
		if (mysql_query($query)) {
			echo "<script>alert('Success!');</script>";
			outputValues('zamestnanec', $db);
		}
	}
	else {
		$_SESSION['jmeno'] = $_POST['jmeno'];
		$_SESSION['prijmeni'] = $_POST['prijmeni'];
		$_SESSION['datumNar'] = $_POST['datumNar'];
		$_SESSION['prava'] = $_POST['prava'];
		$_SESSION['rodneC'] = $_POST['rodneC'];
		$_SESSION['plat'] = $_POST['plat'];
		error("zamestnanec", "Edit");
	}
}

if (isset($_POST['equipmentEdit'])) {
	if ($_POST['typ'] != "" and $_POST['pocet'] != "" and ctype_digit($_POST['pocet'])) {
		$query = "UPDATE `vybaveni_mistnosti` SET `typ`='".$_POST['typ']."', `pocet`='".$_POST['pocet']."' WHERE `id_vybaveni_mistnosti`=".$_SESSION['editId'].";";
		if (mysql_query($query)) {
			echo "<script>alert('Success!');</script>";
			showRoomStuff($db);
		}
	}
	else {
		$_SESSION['typ'] = $_POST['typ'];
		$_SESSION['pocet'] = $_POST['pocet'];
		error("vybaveni_mistnosti", "Edit");
	}
}

?>