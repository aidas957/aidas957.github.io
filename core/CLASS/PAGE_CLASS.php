<?php
/* TODO */
/*
- Fix what do if template not found
*/
defined('_ACE3OTA') or die('ERROR'); // Если константы не существует, значит файл попытались открыть напрямую
// Класc PAGEClass 
class PAGEClass{
	public $AR; 			// Массив классов
	private $TPLw; 			// Массив шаблонов
	private $TITLE; 		// Заголовок страници
	private $MENUi; 		    // Меню страници
	private $CONTENT; 		// Переменная контента
	private $PAGIN; 		// Переменная постраничного вывода
	function PAGEClass($ARn){	
		$this->AR = $ARn; // Массив классов
		$this->AR['LOG']->LSET("PAGEClass: Constructor(...)");
	}
	// Динамический контент
	public function SETCONTENT($CONТn, $TPLn){
		$this->AR['LOG']->LSET("PAGEClass: SETCONTENT(..., ".$TPLn.")");
		// Fix what do if template not found
		$this->TPLw = LOADTPL($TPLn, $this->AR); // Загружаем шаблон
		$this->CONTENT .= $CONТn; // Добавляем в переменную контент
	}
	// Меню сайта
	public function SETMENU($MEn){
		$this->AR['LOG']->LSET("PAGEClass: SETMENU(...)");
		// Fix what do if template not found
		$this->MENUi .= $MEn; // Добавляем в переменную меню
	}
	// Функция создания заголовка страници
	public function SETTITLE($TTL){
		$this->AR['LOG']->WR("PAGEClass: SETTITLE(".$TTL.")");
		$this->TITLE .= $TTL; // Добавляем в переменную
	}
	public function Pr(){ //Вывод страницы
		$this->AR['LOG']->LSET("PAGEClass: Pr()");
		$HTMLm = str_replace("[_tpl_path]", TPL_FOLDER, $this->TPLw); // Заменяем в шаблоне в пути к скриптам папку с назавнием шаблона
		$HTMLm = str_replace("[_title]", $this->TITLE, $HTMLm); // Заполняем заголовок страницы
		$HTMLm = str_replace("[_menu]", $this->MENUi, $HTMLm); // Заполняем меню страницы
		$HTMLm = str_replace("[_msg]", $this->AR['MSG']->Pr(), $HTMLm); // Заполняем сообщения
		$HTMLm = str_replace("[_content]", $this->CONTENT, $HTMLm); // Заполняем контент в шаблоне для вывода ответа ОТА
		$HTMLm = str_replace("[_paginat]", $this->PAGIN, $HTMLm); // Заполняем постраничный вывод страницы
		// Вывод страницы
		echo $HTMLm;	
	}
}
?>