<?php
require_once "core/config.core.php";
require_once "func.php";
$mysqli = new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_DATABASE);
if (banlist($_SERVER["REMOTE_ADDR"])) {
    echo "<div class=\"alert error\">";
	echo '<span>FEHLER:</span> Du wurdest gebannt, weil du zuviel M&uuml;ll eingetragen hast.';
	echo "</div>";
}else {
$link = $_SESSION["link"];
$lnk = SHORT_DOMAIN;
if(strpos($link,'link?k') || strpos($link,'r?i') || strpos($link,str_replace("https://", "", str_replace("http://","",$lnk)))) {
	echo "<div class=\"alert error\">";
	echo '<span>FEHLER:</span> Du kannst keinen Kurzlink k&uuml;rzen!';
	echo "</div>";
	return false;
}
if(strpos($link,'porn') || strpos($link,'sex') || strpos($link,'fick') || strpos($link,'fapdu') || strpos($link,'fabdu') || strpos($link,'xxx') || strpos($link,'bumsen') || strpos($link,'voegeln') || strpos($link,'xhamster') || strpos($link,'bitch') || strpos($link,'geilemaedchen') || strpos($link,'penis') || strpos($link,'vagina') || strpos($link,'muschi') || strpos($link,'lexyroxx') || strpos($link,'gay') || strpos($link,'123video') || strpos($link,'onlydudes') || strpos($link,'429tube') || strpos($link,'menhub') || strpos($link,'menhub') || strpos($link,'fotze')) {
	echo "<div class=\"alert error\">";
	echo '<span>FEHLER:</span> Diese Seiten werden nicht gek&uuml;rzt. Bitte beachte das Pornoseiten oder Seiten mit Illegalen Inhalten aus unserer Datenbank sofort entfernt werden!';
	echo "</div>";
	return false;
}
if(strpos($link,'bit.ly') || strpos($link,'adf.ly') || strpos($link,'short.tk') || strpos($link,'goo.gl') || strpos($link,'tinyurl.com') || strpos($link,'ow.ly') || strpos($link,'su.pr') || strpos($link,'is.gd') || strpos($link,'short.nr') || strpos($link,'youtu.be') || strpos($link,'para.pt')) {
	echo "<div class=\"alert error\">";
	echo '<span>FEHLER:</span> Du kannst keine Links von anderen URL Shrinkern k&uuml;rzen!';
	echo "</div>";
	return false;
}
if(strpos($link,'javascript:') || strpos($link,'whatsapp:')) {
		echo "<div class=\"alert error\">";
	echo '<span>FEHLER:</span> Ung&uuml;ltiges Protokoll vor dem URL!';
	echo "</div>";
	return false;
}
if (!(isset($link))) {
    echo "<p>Fehler beim K&uuml;rzen. Kein Link angegeben!</p>";
	return false;
}
neu: $klink = "";
$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
for($i = 1; $i <= 6; $i++)
{
  $i2 = rand(0,1);
  switch($i2)
  {
	  case 0:
	   $klink = $klink . rand(0,9);
	  break;
	  case 1:
	   $klink = $klink . $chars[rand(0,52)];
	  break;
  }  
}
$uidn = getUIDN();
$table = DB_TABLE;
$query = "INSERT INTO `$table` (`ip`, `to`, `link`, `uidn`, `visits`, `create`) VALUES('".$_SERVER["REMOTE_ADDR"]."', '".$mysqli->real_escape_string($link)."', '".$mysqli->real_escape_string($klink)."', '".$mysqli->real_escape_string($uidn)."', '0', '". Date("Y-m-d") . "');";
$quer1 = "SELECT  * FROM `$table` WHERE `to` = '" . $mysqli->real_escape_string($link) . "'";
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