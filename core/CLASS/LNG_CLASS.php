<?php
/* TODO */
/*
-
*/
defined('_ACE3OTA') or die('ERROR'); // Если константы не существует, значит файл попытались открыть напрямую
// Класc LNGClass 
class LNGClass{
	public $LP; 			// Массив строк языка
	private $LNG_PATH_FILE; // Переменная файла языка
	function LNGClass($CONFn, $ARn){
		$this->LNG_PATH_FILE .= $CONFn['LP_LNG']; // Язык
		$this->LNG_PATH_FILE .= ".ini";
		$this->LP = parse_ini_file(LNG_FOLDER.$this->LNG_PATH_FILE);
		$ARn['LOG']->LSET("LNGClass: Constructor(".$this->LNG_PATH_FILE.", ...)");
	}	
}
?>