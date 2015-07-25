<?php
/* TODO */
/*
- Fix it: need cms
- Fix it: Need rebuild statistic system 
- Fix it: Need clean tpl css, and html 
*/
define('_ACE3OTA', 1);  // Установка константы для предотвращения прямого доступа к подключаемым файлам
/* Обработка входящих параметров */
$RAWPOST = file_get_contents("php://input"); // RAW POST
if($RAWPOST != ""){$PARAM['RAW'] = $RAWPOST;}else{$PARAM['RAW'] = NULL;} 	// Проверяем есть ли RAW POST
/* Сесии */
/* Подключение файлов */
include("core/def.php"); 	// Подключаем файл констант
include("core/static.php"); // Подключаем файл с описанием функций и классов
/* Инициализация классов */
$AR['LOG'] = new LOGClass($CONF);     								// Класс работы с логом
$AR['DB']  = new DBClass($CONF, $AR);  								// Класс работы с базой данных
$AR['MSG'] = new MSGClass();										// Класс работы с сообщениями системы
$AR['STAT'] = new STATClass($AR); 									// Класс работы с статистикой обновлений
$AR['LNG'] = new LNGClass($CONF ,$AR); 								// Класс работы с языковым пакетом
$AR['OTA'] = new OTAClass(OTANULL_TPL, OTARELIZE_TPL, $AR); 		// Класс работы с OTA
$AR['PG']  = new PAGEClass($AR); 									// Класс работы с страницей
$AR['MENU'] = new MENUClass(MENU_TPL, $AR); 						// Класс работы с меню
$AR['NEWS'] = new NEWSClass(NEWS_TPL, $AR); 						// Класс работы с новостями
/* Подготовка страници */
$AR['LOG']->LSET("INDEX: BEGIN");
$AR['DB']->CONNECT(); // Подключаемся к базе данных для выполнения запросов
/* Формировка страници */
if($PARAM['RAW'] != NULL){ // Обработка ОТА
	$AR['OTA']->CREATE($PARAM['RAW']); // Создаем ОТА обработчик, из полученых парамеров RAW 
	$AR['PG']->SETCONTENT($AR['OTA']->OTAPr(), OTAINDEX_TPL); // Устанавливаем контент как вывод ОТА обработчика, с шаблоном вывода ОТА для главной страницы
	// Fix it: Need rebuild statistic system 
	//$AR['STAT']->Pr(); // Записать статистику
	$AR['PG']->Pr(); // Вывод контента	
}else{ 						// Обработка сайт
	// Fix it: need cms 
	$AR['MENU']->GET(); // Формируем меню с базы
	$AR['NEWS']->CREATE(); // Формируем новости с базы
	$AR['PG']->SETCONTENT($AR['NEWS']->Pr(), INDEX_TPL); // Устанавливаем контент, с шаблоном для главной страницы для пользователей
	$AR['PG']->SETMENU("".$AR['MENU']->Pr().""); // Устанавливаем меню
	$AR['PG']->Pr(); // Вывод контента
}
/* Вывод страницы */
$AR['DB']->CLOSE();   // Закрываем соединение с базой даных
$AR['LOG']->LSET("INDEX: END");
?>