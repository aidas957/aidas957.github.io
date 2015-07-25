<?php
/* TODO */
/*
-
*/
defined('_ACE3OTA') or die('ERROR'); // Если константы не существует, значит файл попытались открыть напрямую
// Класc LOGClass 
class LOGClass{
	public $L_FILE;	// Лог файл
	// Конструктор класа
	function LOGClass($CONFn){
		 $this->L_FILE = $CONFn['LOG_NAME']; // Имя лог файла
		 //file_put_contents("".LOG_FOLDER."".$this->L_FILE."", ""); // Чистим файл от прошлых записей	
	}
	// Записать строку в файл
	public function LSET($TEXT){ // WR("Текст")
		file_put_contents("".LOG_FOLDER."".$this->L_FILE."", date("H:i:s").": ", FILE_APPEND);
		file_put_contents("".LOG_FOLDER."".$this->L_FILE."", $TEXT, FILE_APPEND);
		file_put_contents("".LOG_FOLDER."".$this->L_FILE."", "\r\n", FILE_APPEND);		
	}	
}
?>