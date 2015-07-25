<?php
/* TODO */
/*
-
*/
defined('_ACE3OTA') or die('ERROR'); // Если константы не существует, значит файл попытались открыть напрямую
// Класc MENUClass 
class MENUClass{
	public $AR; 			// Массив классов
	private $TPLw; 			// Массив шаблонов
	public $MENUw; 		// Массив меню
	function MENUClass($TPLn ,$ARn){	
		$this->AR = $ARn; // Массив классов
		$this->TPLw = LOADTPL($TPLn, $this->AR); 	// Загружаем шаблон
		$this->AR['LOG']->LSET("MENUClass: Constructor(".$TPLn.")");
	}
	public function SET(){ // Добавляем статическое меню
		$this->AR['LOG']->LSET("MENUClass: SET()");
	}
	public function GET(){
		$this->AR['LOG']->LSET("MENUClass: GET()");
		$menu = API_MENU_GET($this->AR); // Получаем все меню
		if($menu){		// Если меню нет, выводим сообщение и пустой контент
			while($RMEN = $this->AR['DB']->FETCHARRAY($menu)){ // Выполняем до тех пор пока есть меню
			    $tPL = $this->TPLw;
			
				$name = $RMEN['name'];
				$types = $RMEN['types'];
				$vars = $RMEN['vars'];
				
				$tmpm = str_replace("[_link]", $vars, $tPL);
				$tmpm = str_replace("[_name]", $name, $tmpm);
				$tmpm = str_replace("[_st]", "", $tmpm);
				
				$this->MENUw .= $tmpm;
			}
		}else{
			$this->AR['MSG']->SET($this->AR['LNG']->LP['w_nomenu'], "W"); // Создать сообщение из строки языкового пакета
			$this->MENUw .= "";
		}	
	}
	public function Pr(){ //Вывод страницы
		$this->AR['LOG']->LSET("MENUClass: Pr()");
		// Вывод страницы
		return $this->MENUw;	
	}
}
?>