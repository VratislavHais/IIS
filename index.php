<?php

include "dbInit.php";
include "login.html";

if (!isset($_SESSION)) { 
	session_start();
}

if (isset($_POST['login']) and isset($_POST['passwd']) and $_POST != "") {
	$query = "SELECT * FROM zamestnanec WHERE login='" . $_POST['login'] . "'";
	$result = mysql_query($query, $db);
	$data = mysql_fetch_array($result, MYSQL_ASSOC);
	if (!strcmp($data['heslo'], $_POST['passwd'])) {
		$_SESSION['permission'] = $data['prava'];	// 2 - jedna se o pronajimatele, 1 - jedna se o admina, 0 - jedna se o zamestnance
		$_SESSION['lastActivity'] = time();
		header("Location: ./menu.php");
	}
	else {
		echo "<script>alert('Wrong password!');</script>";
	}
}

if(isset($_POST['action'])) {
	echo $_POST['submit'];
}
?>