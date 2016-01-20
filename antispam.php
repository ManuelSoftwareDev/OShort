<?
require_once "func.php";
require_once "core/config.core.php";
$mysqli = new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_DATABASE);
$table = DB_TABLE;
$query = "SELECT  * FROM `" . $table . "` WHERE `ip` = '" . $_SERVER["REMOTE_ADDR"] . "' AND `create` = '" . Date("Y-m-d") . "'";
$res = $mysqli->query($query);
$anz = $res->num_rows;
if($anz >= 11){
	//BANNEN WENN ZUVIEL EINTRÄGE
  	//ban($_SERVER["REMOTE_ADDR"]);
	$query = "DELETE FROM `".$table."` WHERE `ip` = '" . $_SERVER["REMOTE_ADDR"]. "' AND `date` = '" . Date("Y-m-d") ."'";
	$res = $mysqli->query($query);
}else if ($anz == 10) {
	echo "<div class=\"alert warning\">";
echo "<span>WARNUNG:</span> Du hast das Limit f&uuml;r heute erreicht. Wenn du noch einen Eintrag machst werden alle deine heutigen Eintr&auml;ge entfernt.";
echo "</div>";
}
$dday = Date("d") - 10;
$query = "DELETE FROM `".$table."` WHERE `visits` < 5 AND `create` < '" . Date("Y") . "-" . Date("m") .  "-" . $dday . "'";
$result = $mysqli->query($query);
$dday = Date("m") - 1;
$query = "DELETE FROM `".$table."` WHERE `visits` < 15 AND `create` < '" . Date("Y") . "-" . Date("m") .  "-" . $dday . "'";
?>