<?php

   function genSafe() 
   {
	   DEFINE(safecode, rand(10000, 99999));
	   $_SESSION["snumber"] = safecode;
	   return safecode;
   }
   
   function checkSafe($safe) 
   {
	   if($safe == safecode) {
		   return true;
	   }
	   return false;
   }

   function checkSafeFromSession($safe) 
   {
	    SESSION_START();
		if($safe == $_SESSION["snumber"]) 
		{
		   return true;
		}
		return false;
   }
   
?>