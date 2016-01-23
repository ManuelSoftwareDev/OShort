<?php
require_once "config/config.core.php";
$mysqli = new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_DATABASE);
$table = DB_TABLE;
$query = "CREATE TABLE `shorten` (`ip` text, `to` text, `link` text, `uidn` int ( 11 ), `visits` int ( 11 ), `create` date)";
$mysqli->query($query);
require_once "r.php";
//Datei löschen nach Installation
safe_redirect('index.php?ins=yes');
?>