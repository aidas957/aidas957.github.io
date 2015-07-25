<?php
/* TODO */
/*
-
*/
defined('_ACE3OTA') or die('ERROR'); // Если константы не существует, значит файл попытались открыть напрямую
// Логи
$CONF['LOG_NAME'] = "main.log"; 	// Лог файл
// Настройки базы даных
$CONF['DB_SERVER'] = "localhost"; 	// Сервер
$CONF['DB_USER'] = "root"; 	// Имя пользователя
$CONF['DB_PASS'] = "";		// Пароль
$CONF['DB_DBS'] = "ota"; 	// Имя базы даных
$CONF['DB_CONNTYPE'] = "mysqli"; 	// Тип соединения с базой даных (mysql, mysqli)
// Настройки языка
$CONF['LP_LNG'] = "RU"; 			// Языковой пакет
?>