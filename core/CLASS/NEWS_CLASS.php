<?php
/* TODO */
/*
-
*/
defined('_ACE3OTA') or die('ERROR'); // Если константы не существует, значит файл попытались открыть напрямую
// Класc NEWSClass
class NEWSClass{
	public $AR; 			// Массив классов
	private $TPLw; 			// Массив шаблонов
	public $MENUw; 		    // Массив новостей
	public $ONEWS;
	function NEWSClass($TPLn ,$ARn){
		$this->AR = $ARn; // Массив классов
		$this->TPLw = LOADTPL($TPLn, $this->AR); 	// Загружаем шаблон
		$this->AR['LOG']->LSET("NEWSClass: Constructor(".$TPLn.")");
	}
	public function CREATE($FULL){
		$this->AR['LOG']->LSET("NEWSClass: CREATE(".$FULL.")");
		$FULL = CLEAN($FULL, $this->AR, "I"); // Cleaning
		// Получаем все новости
		$NWSRAW = API_NEWS_GET($FULL, $this->AR);
		if($NWSRAW){ // Если есть хотябы 1 новость
			while($R_NEWS = $this->AR['DB']->FETCHARRAY($NWSRAW)){
				$this->ONEWS .= $this->composen($FULL, $R_NEWS);
			}
		}else{
			$this->AR['MSG']->SET($this->AR['LNG']->LP['w_nonews'], "W"); // Создать сообщение из строки языкового пакета
		}
	}
	public function composen($FULL, $REWS){ //Вывод страницы
		$this->AR['LOG']->LSET("NEWSClass: compose(...)");
		if($FULL){ // Если новость полная
			preg_match("/\[_iffull\](.*?)\[_iffull\]/s", $this->TPLw, $CUT); // Вырезаем все между [_iffull] и помещаем в CUT[1]
		}else{
			preg_match("/\[_ifmini\](.*?)\[_ifmini\]/s", $this->TPLw, $CUT); // Вырезаем все между [_ifmini] и помещаем в CUT[1]
		}
		$HTPl = $this->TPLw; // Копируем шаблон
		
		$HTPl = preg_replace("/\[_while\].*?\[_while\]/s", $CUT[1], $HTPl); // Заменяем вырезаное в шаблоне
		
		$ID_NEWS 	= $REWS['news_id']; 		// ID новости
		$FAV_NEWS 	= $REWS['news_fav']; 		// Идентефикатор новости на главной
		$CAT_NEWS 	= $REWS['news_cat']; 		// категория новости ID
		$TITLE_NEWS = $REWS['news_title']; 	    // Заголовок
		$TEXT_NEWS	= $REWS['news_text']; 	    // Текст
		$AUTOR_NEWS = $REWS['news_author']; 	// Автор ID
		$DATE_NEWS 	= $REWS['news_date_a']; 	// Дата	
		
		// Готовим текст новости
		if($FULL){ // Если новость полная
			$TEXT = str_replace("[end]","",$TEXT_NEWS); // Заменяем разделитель короткой новости
			$NEWS_OUT = str_replace("[_text]", $TEXT, $HTPl); // Заменяем в шаблоне	
		}else{
		    $TEXT = explode("[end]", $TEXT_NEWS); // Делим текс на 2 части до [end] и после (text[0] - до [end])
		    $NEWS_OUT = str_replace("[_text]", $TEXT[0], $HTPl); // Заменяем часть до [end] в шаблоне
		}
		
		$NEWS_OUT = str_replace("[_title]", $TITLE_NEWS, $NEWS_OUT);
		$NEWS_OUT = str_replace("[_author]", $AUTOR_NEWS, $NEWS_OUT);
		$NEWS_OUT = str_replace("[_date_b]", $DATE_NEWS, $NEWS_OUT);
		$NEWS_OUT = str_replace("[_id]", $ID_NEWS, $NEWS_OUT);
		// Добавляем полученый результат в переменную
		return $NEWS_OUT;
		
	}
	public function Pr(){ //Вывод страницы
		$this->AR['LOG']->LSET("NEWSClass: Pr()");
		return $this->ONEWS;
	}
}
?>