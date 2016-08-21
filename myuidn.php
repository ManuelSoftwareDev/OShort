<?php
require_once "functions/functions.php";
require_once "core/config.core.php";

$uidn = getUIDN();
?>

<html>
	<head>
		<!-- Activate Meta Charset UTF-8 -->
		<meta charset="utf-8" />
		<!-- Stylesheet and FavIcon Implementation -->
        <link rel="stylesheet" type="text/css" href="style/design.css">
		<link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">
	    <!-- Title -->
		<title> <? print TITLE; ?> - Deine UIDN </title>
	</head>
	<body>
		<div class="sbox center uidn">
			<h3>Deine UIDN bei ShortMe ist: 
				<a href="statistikview.php?uidn=<? echo $uidn; ?>">
					<font color="orange"><? echo $uidn; ?></font>
				</a>
			</h3>
			
			<strong>Deine UIDN funktioniert nur, wenn du einen oder mehrere Kurzlink(s) angelegt hast.</strong>
			
			<? include_once "content/footer.html"; ?>
		</div>
	</body>
</html>
