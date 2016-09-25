<?php
	require_once "functions/functions.php";
	require_once "core/config.core.php";
	
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
		<!-- Activate Meta Charset UTF-8 -->
		<meta charset="utf-8" />
		
		<!-- Stylesheet -->
        <link rel="stylesheet" type="text/css" href="http://public.sln-tools.net/provide.php?file=design">
		
		<!-- Alternative -->
		<!-- <link rel="stylesheet" type="text/css" href="PATH_TO_STYLESHEET.CSS"> -->
		
		<!-- Favicon -->
		<link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">
	    
		<!-- Title -->
		<title><? print TITLE; ?> - Shortener</title>
	</head>
	<body>
	    <header class="header">
            <p>ShortMe Open Alpha</p>
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
	            <input type="url" name="url" class="input" id="url" placeholder="http://www.example.com/john-doe" text-align="center" required>
			    <button class="button" type="button" onclick="document.location='statistik.php';" value="Statistik">Statistik</button>
		        <button class="button" type="submit" value="Erstellen"> Erstellen </button>
		    </form>
			<?php
				include_once "functions/antispam.php";	

				if (isset($_GET["say"])) 
				{
					$sSay = htmlentities($_GET["say"], ENT_QUOTES);
					$sMessage = htmlentities($_GET["message"], ENT_QUOTES);
					$sSpan = htmlentities($_GET["span"], ENT_QUOTES);
					echo "<div class=\"alert ". $sSay ."\">";
					echo "<span>". $sSpan .":</span>  ". $sMessage;
					echo "</div>";
				}		
				
				if (isset($_POST["do"]) || isset($_GET["do"]) 
				{
					$do = $_POST["do"];
					$k = $_POST["k"];
					$uidn = $_POST["uidn"];
					if(!isset($do))
					{
						$do = $_GET["do"];
						$k = $_GET["k"];
						$uidn = $_GET["uidn"];
					}
					if ($do == "shrink") {
						$_SESSION["link"] = $_POST["url"];
						echo "<br />";
						include_once "functions/short.php";
					}else if ($do == "statistik") {
						redir("statistik.php?uidn=" . $uidn);
					}else if ($do == "redirect") {
						redir("r.php?k=" . $k);
					}
				}	
	        ?>
	    </div>
		
        <? include_once "content/footer.html"; ?>
    </body>
</html>
