<?php
    /*
	Settings
	*/
	
	/*Region Database Login Data*/
	define("DB_HOST", "HOST");
	define("DB_USER", "USERNAME");
	define("DB_PASSWORD", "PASSWORD");
	define("DB_DATABASE", "DATABASE");
	/* /Region Database */
	
	# Shortener's Name
	define("TITLE", "ShortMe");
	
	# Table Name
	define("DB_TABLE", "TABELLE");
	
	# Shortener Domain. Please without / at the end. (www.mydomain.net)
	define("SHORT_DOMAIN", "shortener.mydomain.net");
	
	# Max Shrink URLs per Day ()
	define("MAX_LINKS_PER_DAY", 10);
	
	# Bans the User when he tries to create more ShortLinks than Maximum. (Disabled because no avaible in this Version)
	//define("BAN_WHEN_TOO_MUCH_LINKS", false);
?>