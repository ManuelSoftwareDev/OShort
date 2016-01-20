<?php
require_once "core/config.core.php";
require_once "func.php";
if (banlist($_SERVER["REMOTE_ADDR"])) {
    echo "<div class=\"alert error\">";
	echo '<span>FEHLER:</span> Du wurdest gebannt, weil du zuviel M&uuml;ll eingetragen hast.';
	echo "</div>";
}else {
$link = $_SESSION["link"];
$lnk = SHORT_DOMAIN;
if(strpos($link,'link?k') || strpos($link,'r?i') || strpos($link,$lnk)) {
	echo "<div class=\"alert error\">";
	echo '<span>FEHLER:</span> Du kannst keinen Kurzlink k&uuml;rzen!';
	echo "</div>";
	return false;
}
if (!(isset($link))) {
    echo "<p>Fehler beim K&uuml;rzen. Kein Link angegeben!</p>";
	return false;
}
$klink = rand(10000,99999);
$uidn = getUIDN();
$table = DB_TABLE;
$query = "INSERT INTO `$table` (`ip`, `to`, `link`, `uidn`, `visits`, `create`) VALUES('".$_SERVER["REMOTE_ADDR"]."', '".$link."', '".$klink."', '".$uidn."', '0', '". Date("Y-m-d") . "');";
$mysqli = new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_DATABASE);
$quer1 = "SELECT  * FROM `$table` WHERE `to` = '" . $link . "'";
$resu = $mysqli->query($quer1);
$rsa = $resu->num_rows;
$bas = false;
if ($rsa == 0) {
if ($bas == false){
$res = $mysqli->query($query);
if ($res == 1) {
echo "<div class=\"alert success\">";
echo '<span>INFO:</span> URL erfolgreich gek&uuml;rtzt. Deine UIDN zum einsehen der Statistik: <a href="'.$lnk.'/statistikview?uidn=' . $uidn . '">' . $uidn . "</a> und der Kurzlink: <a id=" . '"' . "copy" . '"' . ' href="r?i=' . $klink. '">'.$lnk.'/r?i=' . $klink . '</a>' ;
echo "</div>";
}else{
echo "<div class=\"alert error\">";
echo "<span>Fehler:</span> Fehler beim k&uuml;rzen des URLs, Kontaktiere den Support.";
echo "</div>";
}
}
}else {
    $row = $resu->fetch_assoc();
	$uidn = $row["uidn"];
	$klink1 = $row["link"];
	echo "<div class=\"alert warning\">";
	echo '<span>INFO:</span> Die URL wurde bereits gek&uuml;rtzt. Deswegen ist die Statistik nicht einsehbar.Der Kurzlink ist: <a id="' . "copy" . '"' . ' href="r?i=' . $klink1. '">http://s.manuelsoftware.de/r?i=' . $klink1 . '</a>' ;
	echo "</div>";
} 
}
?>