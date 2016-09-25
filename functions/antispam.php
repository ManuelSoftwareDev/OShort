<?
// require_once "func.php";
// require_once "core/config.core.php";


// $mysqlProvider = new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_DATABASE);
// $tableName = DB_TABLE;
// $rquery = "SELECT  * FROM `" . escape_string($mysqlProvider,$tableName) . "` WHERE `ip` = '" . escape_string($mysqlProvider,$_SERVER["REMOTE_ADDR"]) . "' AND `create` = '" . Date("Y-m-d") . "'";
// $result = $mysqlProvider->query($rquery);
// $count = $result->num_rows;

// if($count >= MAX_LINKS_PER_DAY + 1)
// {
	// $rquery = "DELETE FROM `". escape_string($mysqlProvider,$tableName) ."` WHERE `ip` = '" . escape_string($mysqlProvider,$_SERVER["REMOTE_ADDR"]) . "' AND `date` = '" . Date("Y-m-d") ."'";
	// $result = $mysqlProvider->query($rquery);
// }
// else if ($count == MAX_LINKS_PER_DAY)
// {
	// echo "<div class=\"alert warning\">";
	// echo "<span>WARNUNG:</span> Du hast das Limit f&uuml;r heute erreicht. Wenn du noch einen Eintrag machst werden alle deine heutigen Eintr&auml;ge entfernt.";
	// echo "</div>";
// }

// $tenDaysBefore = Date("d") - 10;
// $rquery = "DELETE FROM `".$tableName."` WHERE `visits` < 5 AND `create` < '" . Date("Y") . "-" . Date("m") .  "-" . $tenDaysBefore . "'";

// $result = $mysqlProvider->query($rquery);

// $oneMonthBefore = Date("m") - 1;
// $rquery = "DELETE FROM `".$tableName."` WHERE `visits` < 15 AND `create` < '" . Date("Y") . "-" . Date("m") .  "-" . $oneMonthBefore . "'";
?>