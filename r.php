<?php
	require_once "core/config.core.php";
	require_once "functions/functions.php";
	
	$table = DB_TABLE;
	$lnk = SHORT_DOMAIN;
	$linkid = $_GET["i"];
	
	if (isset($linkid)) {
		$mysqlProvider = new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_DATABASE);
		$query = "SELECT * FROM `" . escape_string($mysqlProvider,$table) . "` WHERE link = '" . escape_string($mysqlProvider,$linkid) . "'";
		$result = $mysqlProvider->query($query);
		$num = $result->num_rows;
		if ($num == 0) {
			echo "Der Kurzlink existiert nicht.";	
		}else {
			$row =	$result->fetch_assoc();
			$visits = $row["visits"];
			$visits = $visits + 1;
			$query = "UPDATE `" . escape_string($mysqlProvider,$table) . "` SET visits = '" . escape_string($mysqlProvider,$visits) . "' WHERE link = '" . escape_string($mysqlProvider,$linkid) . "'";
			$mysqlProvider->query($query);
			redir($row["to"]);
		}
	}else {
		echo "Der Kurzlink existiert nicht.";	
	}
	
?>