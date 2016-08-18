<?php
	require_once "func.php";
	if($_GET["installstate"] == "finished") 
	{
		unlink ("install.php");
		redir("index.php");
	}
	if(file_exists("install.php")) 
	{
		redir('install.php');
		return;
	}
?>

<!DOCTYPE html>
<html lang="de">
    <head>
        <meta charset="utf-8" />
        <link rel="Stylesheet" type="text/css" href="style/design.css">
	    <title>ShortMe Shortener</title>
    </head>
	<body>
	    <header class="header">
            <p>ShortMe</p>
            <nav>               
                <a href="#">Shortener</a>
                <a href="statistik.php">Statistik</a>                
            </nav>
        </header>	
	    <div class="sbox center">
		    <header>
                <p>URL Shrinker</p>
            </header>
		    <p>Bitte den zu kürzenden Link eingeben:</p>
            <form method="POST" action="index.php">
				<input type="hidden" value="shrink" name="do">
	            <input type="url" name="url" class="input" id="Link1" placeholder="http://www.myexamplepage.com/" text-align="center" required>
			    <button class="button" type="button" onclick="document.location='statistik.php';" value="Statistik">Statistik</button>
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
		if ($do == "shrink") {
			$_SESSION["link"] = $_POST["url"];
			echo "<br />";
			include_once "short.php";
		}else if ($do == "statistik") {
			redir("statistik?uidn=" . $_POST["uidn"]);
		}else if ($do == "redirect") {
			redir("r.php?k=" . $_POST["k"]);
		}
	}else if(isset($_GET["do"])) {
		$do = $_GET["do"];
		if ($do == "shrink") {
			$_SESSION["link"] = $_GET["url"];
			echo "<br />";
			include_once "short.php";
		}else if ($do == "statistik") {
			redir("statistik.php?uidn=" . $_GET["uidn"]);
		}else if ($do == "redirect") {
			redir("r.php?k=" . $_GET["k"]);
		}
	}?>
	    </div>
		
        <? include_once "content/footer.html"; ?>
    </body>
</html>
