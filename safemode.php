<?php

   function genSafe() {
	   DEFINE(safecode, rand(10000, 99999));
	   $_SESSION["sfccode"] = safecode;
	   return safecode;
   }
   function checkSafe($safe) {
	   if($safe == safecode) {
		   return true;
	   }
	   return false;
   }

   function checkSafeFromSession($safe) {
	      SESSION_START();
if($safe == $_SESSION["sfccode"]) {
		   return true;
	   }
	   return false;
   }
?>