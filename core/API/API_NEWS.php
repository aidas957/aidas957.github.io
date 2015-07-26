<?php
/* TODO */
/*
-
*/
defined('_ACE3OTA') or die('ERROR'); // Если константы не существует, значит файл попытались открыть напрямую
// Получение всех новостей с базы
function API_NEWS_GET($FULL, $AR){
	$AR['LOG']->LSET("API_NEWS_GET(".$FULL.", ...)");
	if($FULL){
		$news = $AR['DB']->QUERY("SELECT * FROM news WHERE news_id = '$FULL'"); // Получаем полную новость по ID
	}else{
		$news = $AR['DB']->QUERY("SELECT * FROM news WHERE news_fav = '1' ORDER BY news_id DESC"); // Получаем все новости отмеченые для показа на главной
	}
	if($AR['DB']->NUMROW($news) == 0){ // если было затронуто при запросе 0 строк
		return NULL; // Возвращаем NULL - Новостей нет
	}else{
		return $news; // Если не 0 - то значит есть новости, возвращаем новости
	}
}
?>