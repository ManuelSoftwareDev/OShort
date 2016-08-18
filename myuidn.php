<html>
	<title> Deine UIDN - ShortMe </title>
	<link rel="Stylesheet" type="text/css" href="style/design.css">
	<body>
		<div class="sbox center uidn">
		
			<h3>Deine UIDN bei ShortMe ist: 
			<a href="statistikview.php?uidn=<? require_once "func.php"; echo getUIDN(); ?>">
			<font color="orange"><? require_once "func.php"; echo getUIDN(); ?></font>
			</a>
			</h3>
			
			<strong>Deine UIDN funktioniert nur, wenn du einen oder mehrere Kurzlink(s) angelegt hast.</strong>
			<? include_once "content/footer.html"; ?>
		</div>
	</body>
</html>
