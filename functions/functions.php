<?php
function getUIDN() 
{
$ipaddress = $_SERVER["REMOTE_ADDR"];
$splited = split('[.]', $ipaddress);
$uidn = $splited[0] * $splited[1] * $splited[2] - $splited[3];
return $uidn;
}
function disableErrors()
{
	error_reporting(0);
	ini_set('display_errors','Off');
	ini_set("short_open_tag","1");
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

/*
function ban($ip) {
  require_once "core/config.core.php";
  $mysqli = new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_DATABASE);
$table = DB_TABLE;
$lnk = SHORT_DOMAIN;
  $query = "INSERT INTO `".$table."_ban`(`IP`) VALUES ('".$ip."')";
  $mysqli->query($query);
  return true;
}
*/

function redir($url) {
    if (!headers_sent()){
        header('HTTP/1.1 301 Moved Permanently');
        header('Location: ' . $url);
        header("Connection: close");
    }
    print '<html>';
    print '<head><title>ShortMe Weiterleitung...</title>';
    print '<meta http-equiv="Refresh" content="0;url='.$url.'" />';
    print '</head>';
    print '<body onload="location.replace(\''.$url.'\')">';
    print 'Solltest du nicht weitergeleitet werden,<br>';
    print "<a href=".$url.">Klicke Hier</a><br /><br />";
    print '</body>';
    print '</html>';
}

function redirect($url)
{redir($url);}

function escape_string($mysqli,$unesc)
{
	return $mysqli->real_escape_string($unesc);
}
?>