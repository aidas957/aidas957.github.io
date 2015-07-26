<?php
/* TODO */
/*
-
*/
defined('_ACE3OTA') or die('ERROR'); // Если константы не существует, значит файл попытались открыть напрямую
include("".CORE_FOLDER."".CONFIG_FILE.""); 			// Подключаем файл настроек
include("".FUNCTION_PATH."".LOADTPL_FUNCTION."");	// Подключаем файл функции LOADTPL
include("".FUNCTION_PATH."".CLEAN_FUNCTION."");	// Подключаем файл функции CLEAN
include("".CLASS_PATH."".LOG_CLASS."");		// Подключаем файл обработки логов
include("".CLASS_PATH."".DB_CLASS."");		// Подключаем файл обработки запросов к БД
include("".CLASS_PATH."".OTA_CLASS."");		// Подключаем файл обработки OTA
include("".CLASS_PATH."".STAT_CLASS."");	// Подключаем файл обработки статистики
include("".CLASS_PATH."".MSG_CLASS."");	    // Подключаем файл обработки сообщений и ошибок
include("".CLASS_PATH."".LNG_CLASS."");	    // Подключаем файл обработки языка
include("".CLASS_PATH."".PAGE_CLASS."");	// Подключаем файл обработки страницы
include("".CLASS_PATH."".MENU_CLASS."");	// Подключаем файл обработки меню
include("".CLASS_PATH."".NEWS_CLASS."");	// Подключаем файл обработки новостей
include("".API_PATH."".API_OTA."");			// Подключаем файл API OTA
include("".API_PATH."".API_STAT."");		// Подключаем файл API статистики
include("".API_PATH."".API_MENU."");		// Подключаем файл API работы с меню
include("".API_PATH."".API_NEWS."");		// Подключаем файл API работы с новостями
?>