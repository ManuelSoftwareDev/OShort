<!DOCTYPE html>

<html lang="de">
    <head>
        <meta charset="utf-8" />
        <link rel="Stylesheet" type="text/css" href="design.css">
	    <link rel="Stylesheet" type="text/css" href="css-box.css">
	    <title>OShort - Statistik</title>
    </head>
	<body>
	    <header class="header">
            <p>OShort</p>
            <nav>               
                <a href="http://s.manuelsoftware.de/">Shortener</a>
                <a href="statistik">Statistik</a>                
            </nav>
        </header>
        <div class="sbox center logins">
            <header>
                <p>Statistik Login</p>
            </header>
		    <p>Bitte ID eingeben</p>
	<form method="GET" action="statistikview.php">
	    <input type="text" name="uidn" class="input" id="UIDN1" placeholder="Bsp: 12345" align="center" required>
		<button class="button" type="button" value="Meine UIDN" onclick="document.location='myuidn';"> Meine UIDN </button>
		<button class="button" type="submit" value="Einloggen"> Einloggen </button>
	</form>
	<? 
	  if (isset($_GET["m"])) {
		 echo "<div class=\"alert error\">";
		echo "<span>Fehler:</span> Auf diese UIDN wurde kein Kurzlink registriert!";
		echo "</div>";
	  }
	?>
	
		 <br>
		 
	 </div>
     <label class="foot">&copy 2013 - <? echo date("Y"); ?> <a href="http://www.manuelsoftware.de">ManuelSoftware.de</a></label>
 </body>
</html>