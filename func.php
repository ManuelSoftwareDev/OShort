<?php
function getUIDN() {
$ipaddr = $_SERVER["REMOTE_ADDR"];
$sspit = split('[.]', $ipaddr);
$uidns = $sspit[0] + $sspit[1] * $sspit[2] - $sspit[3];
return $uidns;
}
function banlist($ip) {
  require_once "core/config.core.php";
  $table = DB_TABLE;
  $lnk = SHORT_DOMAIN;
  $query = 'SELECT * FROM `'.$table.'_ban`';
  $mysqli = new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_DATABASE);
  $result = $mysqli->query($query);
  while ($row = $result->fetch_assoc()) {
	$results_array[] = $row;
  }
  foreach ($results_array as &$rows) {
	  if ($ip == $rows["IP"]) {
		return true;  
	  }
  }
  return false;
}
function ban($ip) {
  require_once "core/config.core.php";
  $mysqli = new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_DATABASE);
$table = DB_TABLE;
$lnk = SHORT_DOMAIN;
  $query = "INSERT INTO `".$table."_ban`(`IP`) VALUES ('".$ip."')";
  $mysqli->query($query);
  return true;
}
function redir($url, $exit=true) {
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