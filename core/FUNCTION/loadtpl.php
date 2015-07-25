<?php
/* TODO */
/*
-
*/
defined('_ACE3OTA') or die('ERROR'); // Если константы не существует, значит файл попытались открыть напрямую
// Загрузка шаблона
function LOADTPL($TPLn, $AR){
	$AR['LOG']->LSET("TPLREAD(".$TPLn.")");
	$HTMLTPL = ""; // Обнуляем переменную шаблона
	$HTMLTPL = file("".TPL_FOLDER."".$TPLn.""); // Читаем файл
		if($HTMLTPL == FALSE){ // Если файл НЕ прочитан
			return FALSE; // Нет файла
		}else{ 			  // Если успешно прочитан
			$HTMLTPL = implode("", $HTMLTPL); // Склеиваем в одну переменную
		}
	return $HTMLTPL; // Если возвращаем NULL шаблон не найден в папке
}
?>