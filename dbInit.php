<?

$dbHost = "localhost:/var/run/mysql/mysql.sock";
$dbUsername = "xhaisv00";	// name of database is equal to username
$dbPassword = "bepono4o";

$db = mysql_connect($dbHost, $dbUsername, $dbPassword);

if (!mysql_select_db($dbUsername, $db)) {
	echo "Unable to connect to database\n";
	exit();
}

?>