<?php
/* TODO */
/*
-
*/
defined('_CYOTA') or die('DISABLE'); // Disable run
// Tpl load
function LoadTpl($TPLn){
	$HTMLTPL = ""; 
	$HTMLTPL = file($TPLn); 
		if($HTMLTPL == FALSE){ 
			return FALSE; // If no file
		}else{ 		
			$HTMLTPL = implode("", $HTMLTPL);
		}
	return $HTMLTPL;
}
?>