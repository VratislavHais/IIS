<?php

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

if (isset($_POST['room'])) {
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

if (isset($_POST['order'])) {
	if (isset($_POST['odOrd']) and isset($_POST['doOrd']) and isset($_POST['poplatek']) and isset($_POST['idPron']) and isset($_POST['idExp']) and isset($_POST['idZam'])) {
		$query = "INSERT INTO `xhaisv00`.`objednavka` (`id_objednavka`, `od`, `do`, `poplatek`, `id_pronajimatele`, `id_expozice`, `id_zamestnance`) VALUES (NULL, '".$_POST['odOrd']."', '".$_POST['doOrd']."', '".$_POST['poplatek']."', '".$_POST['idPron']."', '".$_POST['idExp']."', '"$_POST['idZam']."');";
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

if (isset($_POST['lessor'])) {
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

if (isset($_POST['artist'])) {
	if (isset($_POST['jmeno']) and isset($_POST['prijmeni']) and isset($_POST['specializace']) and isset($_POST['idZam'])) {
		$query = "INSERT INTO `xhaisv00`.`umelec` (`id_umelec`, `jmeno`, `prijmeni`, `specializace`, `id_zamestnance`) VALUES (NULL, '".$_POST['jmeno']."', '".$_POST['prijmeni']."', '".$_POST['specializace']."', '"$_POST['idZam']."');";
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

?>