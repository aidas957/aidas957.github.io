<?php
/* TODO */
/*
-
*/
defined('_ACE3OTA') or die('ERROR'); // Если константы не существует, значит файл попытались открыть напрямую
// Очистка потока
function CLEAN($DATA, $AR, $MODE){
	$AR['LOG']->LSET("CLEAN(".$DATA.", ..., ".$MODE.")");
	switch($MODE){
		case "I": // Обрабатываем цифры 
			$DATA = (int)$DATA; // Конвертируем все в цифры
		break;
		case "S": // Обрабатываем текст	
		default:  // По умолчанию обрабатываем текст
			$DATA = trim(strip_tags(htmlspecialchars($DATA, ENT_QUOTES, "cp1251")));
		break;
	}
	return $DATA;
}
?>