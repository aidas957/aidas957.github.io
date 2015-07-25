<?php
/* TODO */
/*
-
*/
defined('_ACE3OTA') or die('ERROR'); // Если константы не существует, значит файл попытались открыть напрямую
// Записать статистику
function API_STAT_WRITE($DATADB, $AR){
	$AR['LOG']->LSET("API_STAT_WRITE(..., ...)");
	
	$stat_time = $DATADB['stats_time'];
	$stat_ip = $DATADB['stats_ip'];
	$stat_dev = $DATADB['stats_device'];
	$stat_build = $DATADB['stats_build'];
	$stat_work = $DATADB['stats_work'];
	
	$news = $AR['DB']->QUERY("INSERT INTO stats (stats_time, stats_ip, stats_device, stats_build, stats_work) 
		VALUES ('$stat_time','$stat_ip','$stat_dev','$stat_build','$stat_work')"); // Добавляем
	
	if($AR['DB']->AFFROW()){ // если было затронуто при запросе 0 строк
		return NULL; // Возвращаем NULL - ошибка
	}else{
		return TRUE; // Если не 0 - то значит записано успешно
	}
}
?>