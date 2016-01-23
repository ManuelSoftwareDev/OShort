<?php
require_once "core/config.core.php";
$table = DB_TABLE;
$lnk = SHORT_DOMAIN;
$k = $_GET["i"];
if (isset($k)) {
$mysqli = new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_DATABASE);
$query = "SELECT * FROM `".$table."` WHERE link = '".$mysqli->real_escape_string($k) . "'";
$result = $mysqli->query($query);
$num = $result->num_rows;
if ($num == 0) {
	 echo "Der Kurzlink existiert nicht.";	
}else {
$row =	$result->fetch_assoc();
$visits = $row["visits"];
$visits = $visits + 1;
$query = "UPDATE `".$table."` SET visits = '" .$mysqli->real_escape_string($visits) . "' WHERE link = '" . $mysqli->real_escape_string($k) . "'";
$mysqli->query($query);
safe_redirect($row["to"]);
}
}else {
 echo "Der Kurzlink existiert nicht.";	
}

function safe_redirect($url, $exit=true) {
    if (!headers_sent()){
        header('HTTP/1.1 301 Moved Permanently');
        header('Location: ' . $url);
        header("Connection: close");
    }
    print '<html>';
    print '<head><title>ManuelSoftware Link Shortener weiterleitung...</title>';
    print '<meta http-equiv="Refresh" content="0;url='.$url.'" />';
    print '</head>';
    print '<body onload="location.replace(\''.$url.'\')">';
    print 'Solltest du nicht weitergeleitet werden, Klick:';
    print "<a href=".$url.">hier</a><br /><br />";
    print '</body>';
    print '</html>';
    if ($exit) exit;
}
?>