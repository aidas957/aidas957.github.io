<?php
/* TODO */
/*
-
*/
defined('_CYOTA') or die('DISABLE'); // Disable run
// Clean
function clean($AR, $text, $sett){
	switch($sett){
		case "I":
			return intval($text);
		break;
		case "S":
			return trim(strip_tags(htmlspecialchars($text, ENT_QUOTES, "utf8")));
		break;
		default:
			return trim(strip_tags(htmlspecialchars($text, ENT_QUOTES, "utf8")));
		break;
	}
}
?>