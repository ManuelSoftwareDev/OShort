<?php
require_once "functions/functions.php";
require_once "functions/safe.php";
require_once "core/config.core.php";

$table = DB_TABLE;
$lnk = SHORT_DOMAIN;

$mysqli = new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_DATABASE);
if (!isset($_GET["safe"]) || !isset($_GET["uidn"]) || !isset($_GET["link"])) {
	redir('../index.php?say=error&span=Fehler&message=Nicht+alle+Eingabenotwendigen+Daten+wurden+gesetzt!');
	return false;
}

$safe = $_GET["safe"];
$uidn = $_GET["uidn"];
$link = $_GET["link"];

disableErrors();

if (checkSafeFromSession($safe)) 
{
	$query = "UPDATE `$table` " . " SET `visits` = 0" . " WHERE `uidn` = '" . $mysqli->real_escape_string($uidn) . "' AND `link` = '" . $mysqli->real_escape_string($link) . "'";
	$mysqli->query($query);
	redir('../statistikview.php?uidn=' . $uidn);
}
else
{
	redir('../?say=error&span=Fehler&message=Falscher+Sicherheitscode.+Versuche+es+erneut.');
}
?>