<?php
    /*
	Defined Vars
	*/
	
	/*Region Database Login Data*/
	define("DB_HOST","HOST");
	define("DB_USER","BENUTZERNAME");
	define("DB_PASSWORD","PASSWORT");
	define("DB_DATABASE","DATENBANK");
	/* /Region Database */
	
	# Table Name
	define("DB_TABLE", "TABELLE");
	# Shortener Domain. Please without / at the end. (www.mydomain.net)
	define("SHORT_DOMAIN", "shortener.mydomain.net");
	# Max Shrink URLs per Day ()
	define("MAX_LINKS_PER_DAY", 10);
	# Bans the User when he tries to create more ShortLinks than Maximum. (Disabled because no avaible in this Version)
	//define("BAN_WHEN_TOO_MUCH_LINKS", false);
?>