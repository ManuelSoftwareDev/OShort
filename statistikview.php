<?php
SESSION_START();

require_once "core/config.core.php";
require_once "functions/safe.php";
require_once "functions/functions.php";

#Global Definitions
$table = DB_TABLE;
$lnk = SHORT_DOMAIN;

function printLinks() 
{
	$uidn = $_GET["uidn"];
    if(isset($uidn)) {
		$mysqli = new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_DATABASE);
		$query = "SELECT * FROM `".$table."` WHERE uidn = '". $mysqli->real_escape_string($uidn) . "'";
		$result = $mysqli->query($query);
		if ($result->num_rows == 0)
		{
			redir("statistik.php?err=w_nssl");
		}
		else
		{
			print '<table align="center">';
			print '<colgroup> <col width="350"> <col width="80"> <col width="50"> </colgroup>';
			print '<tr>';
			print '<th>Link</th>';
			print '<th>Besucher</th>';
			print '<th>ID</th>';
			print '<th>Optionen</th>';
			print '</tr>';
			$anz = $result->num_rows - 1; 
			while ($row = $result->fetch_assoc())
			{
				$results_array[] = $row;
			}
			foreach ($results_array as &$rows) {
				print '<tr>';
				print '<td><a target="_blank" href="/r.php?i=' . $rows["link"] . '">' . $rows["to"] . '</td>';
				print '<td>' . $rows["visits"] . '</td>';
				print '<td>' . $rows["link"] . '</td>';
				print '<td>&nbsp;&nbsp;&nbsp;<a href="functions/res.php?uidn='.$uidn.'&link=' . $rows["link"] . '&safe='. genSafe() . '"><img src="images/refresh.png" alt="Statistik zur&uuml;cksetzen" title="Statistik zur&uuml;cksetzen" /></a>&nbsp;<a href="functions/del.php?uidn='.$uidn.'&link=' . $rows["link"] . '&safe='. genSafe() . '"><img src="images/delete.png" alt="Kurzlink l&ouml;schen" title="Kurzlink l&ouml;schen"/></a></td>';
				print '</tr>';
			}
			echo '</table>';
		}
	}
	else
	{
		redir("statistik.php");
	}
}
?>

<!DOCTYPE html>

<html lang="de">
    <head>
       <!-- Activate Meta Charset UTF-8 -->
		<meta charset="utf-8" />
		
		<!-- Stylesheets -->
        <link rel="stylesheet" type="text/css" href="http://public.sln-tools.net/provide.php?file=design">
        <link rel="stylesheet" type="text/css" href="http://public.sln-tools.net/provide.php?file=table">
		
		<!-- Alternative -->
		<!-- <link rel="stylesheet" type="text/css" href="PATH_TO_STYLESHEET.CSS"> -->
		
		<!-- Favicon -->
		<link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">
		
	    <!-- Title -->
		<title><? print TITLE; ?> - Statistik</title>
	</head>
	<body>
		<header class="header">
            <p>ShortMe</p>
            <nav>               
				<a href="index.php">Shortener</a>
				<a href="statistik.php">Statistik</a>                
            </nav>
        </header>	
	    <div class="sbox center">
		    <header>
                <p>Shortener</p>
            </header>
		    <h2>Der ID zugewiesene Links</h2>
			<? printLinks() ?>
		</div>
		<br>
        <? include_once "content/footer.html"; ?>
	 </body>
</html>