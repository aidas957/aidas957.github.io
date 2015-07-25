<?php
/* TODO */
/*
-
*/
defined('_ACE3OTA') or die('ERROR'); // ≈сли константы не существует, значит файл попытались открыть напр€мую
function API_MENU_GET($AR){
	$menu = $AR['DB']->QUERY("SELECT * FROM menu");
	$AR['LOG']->LSET("API_MENU_GET(...)");
	if($AR['DB']->NUMROW($menu) == 0){
		$AR['LOG']->LSET("API_MENU_GET(...) NULL");
		return NULL;
	}else{
		$AR['LOG']->LSET("API_MENU_GET(...) OK");
		return $menu;
	}	
}
?>