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
	    <title><? print TITLE; ?> - Statistik</title>
    </head>
	<body>
	    <header class="header">
            <p>ShortMe</p>
            <nav>               
                <a href="index.php">Shortener</a>
                <a href="#">Statistik</a>                
            </nav>
        </header>
        <div class="sbox center logins">
            <header>
                <p>Statistik Login</p>
            </header>
		    <p>Bitte ID eingeben</p>
			<form method="GET" action="statistikview.php">
				<input type="text" name="uidn" class="input" id="UIDN1" placeholder="123456789" align="center" required>
				<button class="button" type="button" value="Meine UIDN" onclick="document.location='myuidn.php';"> Meine UIDN </button>
				<button class="button" type="submit" value="Einloggen"> Einloggen </button>
			</form>
			<? 
				if (isset($_GET["err"])) {
					echo "<div class=\"alert error\">";
					echo "<span>Fehler:</span> Auf diese ID wurde kein Kurzlink registriert!";
					echo "</div>";
				}
			?>
		 <br>
	 </div>
     <? include_once "content/footer.html"; ?>
 </body>
</html>