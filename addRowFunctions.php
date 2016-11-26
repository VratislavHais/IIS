<?php

if (!isset($_SESSION)) {
	session_start();
}

if (isset($_POST['exposition'])) {
	if (isset($_POST['typ']) and isset($_POST['umelec']) and isset($_POST['od']) and isset($_POST['do']) and isset($_POST['idZam'])) {
		$query = "INSERT INTO `xhaisv00`.`expozice` (`id_expozice`, `typ`, `umelec`, `od`, `do`, `id_zamestnance`) VALUES (NULL, '".$_POST['typ']."', '".$_POST['umelec']."', '".$_POST['od']."', '".$_POST['do']."', '".$_POST['idZam']."');";
		if (mysql_query($query)) {
			echo "<script>alert('Success!');</script>";
			outputValues('expozice', $db);
			unset($_POST['typ']);
			unset($_POST['umelec']);
			unset($_POST['od']);
			unset($_POST['do']);
			unset($_POST['idZam']);
		}
	}
	else {
		echo "<script>alert('Please fill every field')</script>";
	}
}

if (isset($_POST['room1'])) {
	if (isset($_POST['typExp']) and isset($_POST['plocha']) and isset($_POST['cena']) and isset($_POST['tvar']) and isset($_POST['idZam'])) {
		$query = "INSERT INTO `xhaisv00`.`mistnost` (`id_mistnost`, `typ_exp`, `plocha`, `cena`, `tvar`, `id_zamestnance`) VALUES (NULL, '".$_POST['typExp']."', '".$_POST['plocha']."', '".$_POST['cena']."', '".$_POST['tvar']."', '".$_POST['idZam']."');";
		if (mysql_query($query)) {
			echo "<script>alert('Success!');</script>";
			outputValues('mistnost', $db);
			unset($_POST['typExp']);
			unset($_POST['plocha']);
			unset($_POST['cena']);
			unset($_POST['tvar']);
			unset($_POST['idZam']);
		}
	}
	else {
		echo "<script>alert('Please fill every field')</script>";
	}
}

if (isset($_POST['order1'])) {
	if (isset($_POST['odOrd']) and isset($_POST['doOrd']) and isset($_POST['poplatek']) and isset($_POST['idPron']) and isset($_POST['idExp']) and isset($_POST['idZam'])) {
		$query = "INSERT INTO `xhaisv00`.`objednavka` (`id_objednavka`, `od`, `do`, `poplatek`, `id_pronajimatele`, `id_expozice`, `id_zamestnance`) VALUES (NULL, '".$_POST['odOrd']."', '".$_POST['doOrd']."', '".$_POST['poplatek']."', '".$_POST['idPron']."', '".$_POST['idExp']."', '".$_POST['idZam']."');";
		if (mysql_query($query)) {
			echo "<script>alert('Success!');</script>";
			outputValues('objednavka', $db);
			unset($_POST['odOrd']);
			unset($_POST['doOrd']);
			unset($_POST['poplatek']);
			unset($_POST['idPron']);
			unset($_POST['idExp']);
			unset($_POST['idZam']);
		}
	}
	else {
		echo "<script>alert('Please fill every field')</script>";
	}
}

if (isset($_POST['lessor1'])) {
	if (isset($_POST['nazev']) and isset($_POST['kontakt']) and isset($_POST['poplatek'])) {
		$query = "INSERT INTO `xhaisv00`.`pronajimatel` (`id_pronajimatel`, `nazev`, `kontakt`, `poplatek`) VALUES (NULL, '".$_POST['nazev']."', '".$_POST['kontakt']."', '".$_POST['poplatek']."');";
		if (mysql_query($query)) {
			echo "<script>alert('Success!');</script>";
			outputValues('pronajimatel', $db);
			unset($_POST['nazev']);
			unset($_POST['kontakt']);
			unset($_POST['poplatek']);
		}
	}
	else {
		echo "<script>alert('Please fill every field')</script>";
	}
}

if (isset($_POST['artist1'])) {
	if (isset($_POST['jmeno']) and isset($_POST['prijmeni']) and isset($_POST['specializace']) and isset($_POST['idZam'])) {
		$query = "INSERT INTO `xhaisv00`.`umelec` (`id_umelec`, `jmeno`, `prijmeni`, `specializace`, `id_zamestnance`) VALUES (NULL, '".$_POST['jmeno']."', '".$_POST['prijmeni']."', '".$_POST['specializace']."', '".$_POST['idZam']."');";
		if (mysql_query($query)) {
			echo "<script>alert('Success!');</script>";
			outputValues('umelec', $db);
			unset($_POST['jmeno']);
			unset($_POST['prijmeni']);
			unset($_POST['specializace']);
			unset($_POST['idZam']);
		}
	}
	else {
		echo "<script>alert('Please fill every field')</script>";
	}
}

if (isset($_POST['employee1'])) {
	if (isset($_POST['jmeno']) and isset($_POST['prijmeni']) and isset($_POST['datumNar']) and isset($_POST['prava']) and isset($_POST['rodneC']) and isset($_POST['plat'])) {
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
			unset($_POST['jmeno']);
			unset($_POST['prijmeni']);
			unset($_POST['datumNar']);
			unset($_POST['prava']);
			unset($_POST['rodneC']);
			unset($_POST['plat']);
		}
		else {
			echo "<script>alert('Please fill every field')</script>";
		}
	}
}

if (isset($_POST['equipment'])) {
	if (isset($_POST['typ']) and isset($_POST['pocet'])) {
		$query = "INSERT INTO `xhaisv00`.`vybaveni_mistnosti` (`id_vybaveni_mistnosti`, `typ`, `pocet`, `id_mistnosti`) VALUES (NULL, '".$_POST['typ']."', '".$_POST['pocet']."', '".$_SESSION['idMistnosti']."');";
		echo "<script>console.log(\"".$query."\");</script>";
		if (mysql_query($query)) {
			echo "<script>alert('Success!');</script>";
			showRoomStuff($db);
			unset($_POST['typ']);
			unset($_POST['pocet']);
		}
	}
	else {
		echo "<script>alert('Please fill every field')</script>";
	}
}

?>