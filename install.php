<?php
	require_once "core/config.core.php";
	require_once "functions/functions.php";

	$dbconnect = new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_DATABASE);
	$table = DB_TABLE;
	$query = "CREATE TABLE `$table` (`ip` text, `to` text, `link` text, `uidn` int ( 11 ), `visits` int ( 11 ), `create` date)";
	
	try
	{
		$dbconnect->query($query);
		redir('index.php?installstate=finished');
	} catch(Exception $ex) {
		echo "<font color=\"red\">Fehler: Einstellungen in der config/config.core.php ändern</font>";
		break;
	}
?>
