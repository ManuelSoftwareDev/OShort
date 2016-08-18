<?php
	require_once "core/config.core.php";
	require_once "func.php";

	$mysqli = new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_DATABASE);
	if (banlist($_SERVER["REMOTE_ADDR"])) {
		echo "<div class=\"alert error\">";
		echo '<span>FEHLER:</span> Du wurdest gebannt, weil du zuviel eingetragen hast.';
		echo "</div>";
	}else {
		$link = $_SESSION["link"];
		$domain = SHORT_DOMAIN;
		if(strpos($link,'r.php?i') || strpos($link,'r?i') || strpos($link,str_replace("https://", "", str_replace("http://","",$domain)))) 
		{
			echo "<div class=\"alert error\">";
			echo '<span>FEHLER:</span> Du kannst keinen Kurzlink k&uuml;rzen!';
			echo "</div>";
			return false;
		}
		if(strpos($link,'porn') || strpos($link,'sex') || strpos($link,'fick') || strpos($link,'fapdu') || strpos($link,'fabdu') || strpos($link,'xxx') || strpos($link,'bumsen') || strpos($link,'voegeln') || strpos($link,'xhamster') || strpos($link,'bitch') || strpos($link,'geilemaedchen') || strpos($link,'penis') || strpos($link,'vagina') || strpos($link,'muschi') || strpos($link,'lexyroxx') || strpos($link,'gay') || strpos($link,'123video') || strpos($link,'onlydudes') || strpos($link,'429tube') || strpos($link,'menhub') || strpos($link,'menhub') || strpos($link,'fotze')) 
		{
			echo "<div class=\"alert error\">";
			echo '<span>FEHLER:</span> Diese Seiten werden nicht gek&uuml;rzt. Bitte beachte das Pornoseiten oder Seiten mit Illegalen Inhalten aus unserer Datenbank sofort entfernt werden!';
			echo "</div>";
			return false;
		}
		if(strpos($link,'bit.ly') || strpos($link,'adf.ly') || strpos($link,'short.tk') || strpos($link,'goo.gl') || strpos($link,'tinyurl.com') || strpos($link,'ow.ly') || strpos($link,'su.pr') || strpos($link,'is.gd') || strpos($link,'short.nr') || strpos($link,'youtu.be') || strpos($link,'para.pt')) 
		{
			echo "<div class=\"alert error\">";
			echo '<span>FEHLER:</span> Du kannst keine Links von anderen URL Shrinkern k&uuml;rzen!';
			echo "</div>";
			return false;
		}
		if(strpos($link,'javascript:') || strpos($link,'whatsapp:')) 
		{
			echo "<div class=\"alert error\">";
			echo '<span>FEHLER:</span> Ung&uuml;ltiges Protokoll vor dem URL!';
			echo "</div>";
			return false;
		}
		if(!isset($link)) 
		{
			echo "<p>Fehler beim K&uuml;rzen. Kein Link angegeben!</p>";
			return false;
		}
		
neu: 	$slink = "";
		$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
		for($i = 1; $i <= 6; $i++)
		{
			$i2 = rand(0,1);
			switch($i2)
			{
				case 0:
					$slink = $slink . rand(0,9);
				break;
				case 1:
					$klink = $slink . $chars[rand(0,52)];
				break;
			}  
		}
		
		$uidn = getUIDN();
		$table = DB_TABLE;
		$rquery = "INSERT INTO `$table` (`ip`, `to`, `link`, `uidn`, `visits`, `create`) VALUES('".$_SERVER["REMOTE_ADDR"]."', '".$mysqli->real_escape_string($link)."', '".$mysqli->real_escape_string($slink)."', '".$mysqli->real_escape_string($uidn)."', '0', '". Date("Y-m-d") . "');";
		$rquery2 = "SELECT  * FROM `$table` WHERE `to` = '" . $mysqli->real_escape_string($link) . "'";
		$result = $mysqli->query($rquery2);
		$rows = $result->num_rows;
		$sab = false;
		if ($rows == 0) 
		{
			$res = $mysqli->query($rquery);
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
			$klink1 = $row["link"];
			echo "<div class=\"alert warning\">";
			echo '<span>INFO:</span> Die URL wurde bereits gek&uuml;rtzt. Deswegen ist die Statistik nicht einsehbar.Der Kurzlink ist: <a id="' . "copy" . '"' . ' href="r?i=' . $klink1. '">r.php?i=' . $klink1 . '</a>' ;
			echo "</div>";
		} 
	}
?>