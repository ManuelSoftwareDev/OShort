<?php
	require_once "core/config.core.php";
	require_once "functions/functions.php";
	$mysqli = new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_DATABASE);
	if(!isset($link)) 
	{
		echo "<p>Fehler beim K&uuml;rzen. Kein Link angegeben!</p>";
		return false;
	}
	
	#Global Definitions
    $link = $_SESSION["link"];
	$domain = SHORT_DOMAIN;
	$table = DB_TABLE;
	$uidn = getUIDN();
		
		
	#Add or Remove Sites, Words or Protocoll. ('one', 'two', 'tree')
	$ownShortLink = array('r.php?i', 'r?i', str_replace("https://", "", str_replace("http://","",$domain)));
	$shortLinkProviders = array('bit.ly', 'adf.ly', 'short.tk', 'goo.gl', 'youtu.be', 'tinyurl.com', 'ow.ly', 't2d', 'su.pr', 'is.gd', 'short.nr', 'para.pt', 's.sln-tools.net', 'c.sh');
    $forbittenWordsOrSites = array('porn', 'sex', 'fick', 'fuck', 'fabdu', 'xxx', 'bumsen', 'voegeln', 'milf', 'gilf', 'xhamster', 'bitch', 'geilemaedchen', 'penis', 'vagina', 'muschi', 'lexyroxx', 'gay', '123video', 'onlydudes', '429tube', 'menhub', 'fotze');
	$forbittenProtocols = array('javascript:', 'whatsapp:', 'mailto:', 'skype:', 'world:', 'download:');
		
	#Checking wether the forbitten Sites, Words or Protocols contains in the Link.
	for(int $i = 0; $i <= count($shortLinkProviders); $i++)
	{
		$val = $shortLinkProviders[$i];
		if(strpos($link, $val))
		{
			echo "<div class=\"alert error\">";
			echo '<span>FEHLER:</span> Du kannst keine Links von anderen URL Shrinkern k&uuml;rzen!';
			echo "</div>";
			return false;
		}
	}
	for(int $i = 0; $i <= count($ownShortLink); $i++)
	{
		$val = $ownShortLink[$i];
		if(strpos($link, $val))
		{
			echo "<div class=\"alert error\">";
			echo '<span>FEHLER:</span> Du kannst keinen Kurzlink k&uuml;rzen!';
			echo "</div>";
			return false;
		}
	}	
	for(int $i = 0; $i <= count($forbittenWordsOrSites); $i++)
	{
		$val = $forbittenWordsOrSites[$i];
		if(strpos($link, $val))
		{
			echo "<div class=\"alert error\">";
			echo '<span>FEHLER:</span> Diese Seiten werden nicht gek&uuml;rzt. Bitte beachte das Pornoseiten oder Seiten mit Illegalen Inhalten aus unserer Datenbank sofort entfernt werden!';
			echo "</div>";
			return false;
		}
	}
	
	for(int $i = 0; $i <= count($forbittenProtocols); $i++)
	{
		$val = $forbittenProtocols[$i];
		if(substr($link, 0, strlen($val)) === $val)
		{
			echo "<div class=\"alert error\">";
			echo '<span>FEHLER:</span> Ung&uuml;ltiges Protokoll vor dem URL.';
			echo "</div>";
			return false;
		}
			
	}
		
	#Generate Link ID
genNew: $sLink = generateKey(6);
		
	//MySQL Queries
	$lQuery = "SELECT * FROM `$table` WHERE `link` = '" . $mysqli->real_escape_string($sLink) . "'";
	$cQuery = "INSERT INTO `$table` (`ip`, `to`, `link`, `uidn`, `visits`, `create`) VALUES('".$_SERVER["REMOTE_ADDR"]."', '".$mysqli->real_escape_string($link)."', '".$mysqli->real_escape_string($sLink)."', '".$mysqli->real_escape_string($uidn)."', '0', '". Date("Y-m-d") . "');";
	$gQuery = "SELECT  * FROM `$table` WHERE `to` = '" . $mysqli->real_escape_string($link) . "'";
	
	#Check Link ID in Database existing
	$result = $mysqli->query($lQuery);
	//When the Link ID already is in Database goto GenerateNew
	if($result->num_rows > 0)
	{goto genNew;}
	
	
	$result = $mysqli->query($gQuery);
	$rows = $result->num_rows;
	
	if ($rows == 0) 
	{
		$res = $mysqli->query($cQuery);
		if ($res == 1) 
		{
			echo "<div class=\"alert success\">";
			echo '<span>INFO:</span> URL erfolgreich gek&uuml;rtzt. Deine UIDN zum einsehen der Statistik: <a target="_blank" href="statistikview.php?uidn=' . $uidn . '">' . $uidn . "</a> und der Kurzlink: <a target=\"_blank\" id=" . '"' . "copy" . '"' . ' href="r.php?i=' . $slink. '">'.$domain.'/r?i=' . $slink . '</a>' ;
			echo "</div>";
		}
		else
		{
			echo "<div class=\"alert error\">";
			echo "<span>Fehler:</span> Fehler beim k&uuml;rzen des URLs.";
			echo "</div>";
		}
	}
	else
	{
		$row = $result->fetch_assoc();
		$uidn = $row["uidn"];
		$sLink2 = $row["link"];
		echo "<div class=\"alert warning\">";
		echo '<span>INFO:</span> Die URL wurde bereits gek&uuml;rtzt. Deswegen ist die Statistik nicht einsehbar. Der Kurzlink ist: <a target="_blank" id="' . "copy" . '"' . ' href="r.php?i=' . $sLink2. '">r.php?i=' . $sLink2 . '</a>' ;
		echo "</div>";
	}
		
	#Generate a Key
	function generateKey(int keyLength)
	{
		$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890_";
		$key = "";
		for($i = 1; $i <= keyLength; $i++)
		{
			$key = $key . $chars[rand(0,strlen($chars)];
		}     			
	}
}
?>