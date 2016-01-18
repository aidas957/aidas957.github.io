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
			return trim(strip_tags(htmlspecialchars($text, ENT_QUOTES, "utf-8")));
		break;
		default:
			return trim(strip_tags(htmlspecialchars($text, ENT_QUOTES, "utf-8")));
		break;
	}
}
// Hashe gen
function GenHashe($DATA, $Key){
	$randcode = md5(rand(0,999999));
	$code = md5(md5($DATA).md5($randcode).md5($Key));
	return $code;
}
?>