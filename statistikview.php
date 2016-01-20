<?php
SESSION_START();
require_once "core/config.core.php";
$table = DB_TABLE;
$lnk = SHORT_DOMAIN;
echo "<title>OShort Statistik</title>";

function getDatable() {
	$uidn = $_GET["uidn"];
    if(isset($uidn)) {
	$mysqli = new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_DATABASE);
	$query = "SELECT * FROM `".$table."` WHERE uidn = '". $uidn . "'";
	$result = $mysqli->query($query);
	if ($result->num_rows == 0) {
	require_once "link.php";
	safe_redirect($lnk."/statistik.php?m=w_nssl");
	}else{
	print '<table align="center">';
	print '<colgroup> <col width="350"> <col width="80"> <col width="50"> </colgroup>';
	print '<tr>';
	print '<th>Link</th>';
	print '<th>Besucher</th>';
	print '<th>ID</th>';
	print '<th>Optionen</th>';
	print '</tr>';
    $anz = $result->num_rows - 1; 
	while ($row = $result->fetch_assoc()) {
		$results_array[] = $row;
	}
	foreach ($results_array as &$rows) {
		print '<tr>';
	    print '<td><a href="'.$lnk.'/r?i=' . $rows["link"] . '">' . $rows["to"] . '</td>';
	    print '<td>' . $rows["visits"] . '</td>';
		print '<td>' . $rows["link"] . '</td>';
		require_once "safemode.php";
		print '<td>&nbsp;&nbsp;&nbsp;<a href="sfunc/res.php?uidn='.$uidn.'&link=' . $rows["link"] . '&safe='. genSafe() . '"><img src="images/refresh.png" alt="Statistik zur&uuml;cksetzen" title="Statistik zur&uuml;cksetzen" /></a>&nbsp;<a href="sfunc/del.php?uidn='.$uidn.'&link=' . $rows["link"] . '&safe='. genSafe() . '"><img src="images/delete.png" alt="Kurzlink l&ouml;schen" title="Kurzlink l&ouml;schen"/></a></td>';
		print '</tr>';
	}
	echo '</table>';
	}
}else {
    require_once "link.php";
	safe_redirect("statistik.php");
}
}
?>

<!DOCTYPE html>

<html lang="de">
    <head>
        <meta charset="utf-8" />
        <link rel="Stylesheet" type="text/css" href="design.css">
	    <link rel="Stylesheet" type="text/css" href="css-box.css">
	    <title>OShort - Statistik</title>
        <style> table, td { border: 1pt solid black;} body { text-align:center; } th {border: 1px solid black; background-color: #2c3e50; color: #fff;} </style>
    </head>
	 <body>
		<header class="header">
            <p>OShort</p>
            <nav>               
           <a href="http://s.manuelsoftware.de/">Shortener</a>
                <a href="statistik">Statistik</a>                
            </nav>
        </header>	
	    <div class="sbox center">
		    <header>
                <p>Shortener</p>
            </header>
		     <h2>Der ID zugewiesene Links</h2>
			 <? getDatable() ?>
		</div>
         <label class="foot">&copy; 2013 - <? echo date("Y"); ?> <a href="http://www.manuelsoftware.de">ManuelSoftware.de</a></label>
	 </body>
</html>