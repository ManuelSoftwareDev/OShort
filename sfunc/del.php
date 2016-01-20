<?php
require_once "func.php";
require_once "safemode.php";
require_once "core/config.core.php";
$table = DB_TABLE;
$lnk = SHORT_DOMAIN;

$mysqli = new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_DATABASE);
if (!isset($_GET["safe"]) || !isset($_GET["uidn"]) || !isset($_GET["link"])) {
	redir($lnk.'/?say=error&span=Fehler&message=Nicht+alle+Eingabenotwendigen+Daten+wurden+gesetzt!');
	return false;
}

$safe = $_GET["safe"];
$uidn = $_GET["uidn"];
$link = $_GET["link"];
error_reporting(0);
ini_set('display_errors','Off');
	ini_set("short_open_tag","1");
if (checkSafeFromSession($safe)) {
	$mysqli = new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_DATABASE);
    $query = "DELETE FROM `$table` WHERE `uidn` = '" . $uidn . "' AND `link` = '" . $link . "'";
	$mysqli->query($query);
	redir($lnk.'/statistikview?uidn=' . $uidn);
}else {
	redir($lnk.'/?say=error&span=Fehler&message=Falscher+Safecode!');
}
?>