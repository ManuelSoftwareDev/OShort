<!DOCTYPE html>

<html lang="de">
    <head>
        <meta charset="utf-8" />
        <link rel="Stylesheet" type="text/css" href="design.css">
	    <link rel="Stylesheet" type="text/css" href="css-box.css">
	    <title>OShort - Shortener</title>
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
		    <p>Bitte gewünschte URL eingeben:</p>
            <form method="POST" action="index.php">
				<input type="hidden" value="short" name="do">
	            <input type="url" name="url" class="input" id="Link1" placeholder="http://www.example.com" text-align="center" required>
			    <button class="button" type="button" onclick="document.location='statistik';" value="Statistik">Statistik</button>
		        <button class="button" type="submit"  value="Erstellen"> Erstellen </button>
		    </form>
           		<?php
	include_once "antispam.php";
	if (isset($_GET["say"])) {
		$sss = $_GET["say"];
		$text = $_GET["message"];
		$kuz = $_GET["span"];
		echo "<div class=\"alert ". $sss ."\">";
        echo "<span>". $kuz .":</span>  ". $text;
        echo "</div>";
	}
if (isset($_POST["do"])) {
 $do = $_POST["do"];
	if ($do == "short") {
		$_SESSION["link"] = $_POST["url"];
		echo "<br />";
		include_once "short.php";
	}else if ($do == "statistik") {
		require_once "link.php";
		safe_redirect("statistik?uidn=" . $_POST["uidn"]);
	}else if ($do == "redirect") {
		require_once "link.php";
		safe_redirect("link?k=" . $_POST["k"]);
	}
}else if(isset($_GET["do"])) {
	 $do = $_GET["do"];
	if ($do == "short") {
		$_SESSION["link"] = $_GET["url"];
		echo "<br />";
		include_once "short.php";
	}else if ($do == "statistik") {
		require_once "link.php";
		safe_redirect("statistik?uidn=" . $_GET["uidn"]);
	}else if ($do == "redirect") {
		require_once "link.php";
		safe_redirect("link?k=" . $_GET["k"]);
	}
}
?>
	    </div>
        <label class="foot">&copy; 2013 - <? echo date("Y"); ?> <a href="http://www.manuelsoftware.de">ManuelSoftware.de</a></label>
    </body>
</html>
