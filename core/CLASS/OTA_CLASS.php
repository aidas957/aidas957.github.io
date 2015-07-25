<?php
/* TODO */
/*
- Fix what do if template not found
*/
defined('_ACE3OTA') or die('ERROR'); // Если константы не существует, значит файл попытались открыть напрямую
// Класc OTAClass 
class OTAClass{
	public $AR; 			// Массив классов
	public $TPLNULL; 		// Нет обновлений - шаблон
	public $TPLRELIZE; 		// Есть обновления - шаблон
	private $OTAHTML; 		// ВЫВОД
	function OTAClass($TPLNULLn, $TPLRELIZEn, $ARn){	
		$this->AR = $ARn; // Массив классов
		// Fix what do if template not found
		$this->TPLNULL = LOADTPL($TPLNULLn, $this->AR); 		// Загружаем шаблон
		$this->TPLRELIZE = LOADTPL($TPLRELIZEn, $this->AR); 	// Загружаем шаблон
		$this->AR['LOG']->LSET("OTAClass: Constructor(".$TPLNULLn.", ".$TPLRELIZEn.", ...)");
	}
	// Create OTA list
	public function CREATE($PARAMn){ 
		$this->AR['LOG']->LSET("OTAClass: CREATE()");
		$PARSEARR = json_decode($PARAMn, true); // Decode
		if($PARSEARR == true){ // Если расшифровано
			if(isset($PARSEARR['params']['device']) AND isset($PARSEARR['params']['source_incremental'])){ // Если есть информация об устройстве и текущем билде
				$this->AR['LOG']->LSET("OTAClass: CREATE(): ALL BUILDS");
				$DEVICE = $PARSEARR['params']['device']; // Выделяем имя устройства
				$RAWNEW = API_OTA_GET($DEVICE, 0, $this->AR); // Делаем запрос к базе ( 0 - все билды, 1 - билд по коду)
				if($RAWNEW){ // Если ответ не NULL
					$this->OTAHTML .= $this->composerOTA($RAWNEW); // Составляем ответ со списком билдов
					//$this->AR['STAT']->SETFILD("DEVICE", $DEVICE); // Добавляем в статистику
					//$this->AR['STAT']->SETFILD("BUILD", $PARSEARR['params']['source_incremental']); // Добавляем в статистику
					//$this->AR['STAT']->SETFILD("WORK", "chek"); // Добавляем в статистику
					$this->AR['LOG']->LSET($this->OTAHTML);
				}else{ // Если ответ NULL
					$this->AR['LOG']->LSET("OTAClass: CREATE() NO BUILDS FOR DEVICE ".$DEVICE."");
					$this->OTAHTML .= $this->TPLNULL; // Устанавливаем отсутствие обновлений
				}		
			}
			if(isset($PARSEARR['target_incremental'])){ // Если есть информация об желаемом билде
				$this->AR['LOG']->LSET("OTAClass: CREATE() GET ".$PARSEARR['target_incremental']."");
				$HBUILD = $PARSEARR['target_incremental']; // Выделяем билд
				$RAWB = API_OTA_GET($HBUILD, 1, $this->AR); // Делаем запрос к базе с target_incremental( 0 - все билды, 1 - билд по коду)
				if($RAWB){ // Если ОК
					$this->OTAHTML .= $this->composerOTA($RAWB); // Формируем ответ
					$this->AR['LOG']->LSET($this->OTAHTML);
				}else{
					$this->AR['LOG']->LSET("OTAClass: CREATE() NO BUILD ".$HBUILD."");
					$this->OTAHTML .= $this->TPLNULL;
				}	
			}	
		}else{ // Если неправельный запрос
			$this->AR['LOG']->LSET("OTAClass: CREATE(): DECODE ERROR");
			$this->OTAHTML .= $this->TPLNULL; // Устанавливаем отсутствие обновлений
			return 0;
		}	
	}
	// Составление ответа ОТА сервера
	function composerOTA($RAWNEW){
		$this->AR['LOG']->LSET("OTAClass: composerOTA()");
		$TPLREL = NULL; // Запятая между билдами в списку и список билдов
		// Вырезаем в шаблоне все между	_ifota		
		preg_match("/\[_ifota\](.*?)\[_ifota\]/s", $this->TPLRELIZE, $TPLCUT);
		// Цыкл заполнения вырезаного кода из шаблона
		while($RNEWS = $this->AR['DB']->FETCHARRAY($RAWNEW)){ // Выполняем до тех пор пока есть новости
			if($TPLREL != NULL){
				// Если не NULL значит цикл запущен не первый раз, а значит нужна запятая меду билдами
				$TPLREL .= ",";
			}
			// Выбираем с базы даные для замены		
			$DEV = $RNEWS['builds_device'];
			$TYPES = $RNEWS['builds_type'];
			$INC = $RNEWS['builds_incremental'];
			$API = $RNEWS['builds_api_level'];
			$URL = $RNEWS['builds_url'];
			$TIME = $RNEWS['builds_timestamp'];
			$MD5S = $RNEWS['builds_md5sum'];
			$CHANG = $RNEWS['builds_changes'];
			$CHAN = $RNEWS['builds_channel'];
			$FILNM = $RNEWS['builds_filename'];
			// Заменяем в шалоне			
			$OUT = str_replace("[INC]", $INC, $TPLCUT[1]); 
			$OUT = str_replace("[API]", $API, $OUT); 
			$OUT = str_replace("[URL]", $URL, $OUT); 
			$OUT = str_replace("[TIME]", $TIME, $OUT);
			$OUT = str_replace("[MD5S]", $MD5S, $OUT); 
			$OUT = str_replace("[CHANG]", $CHANG, $OUT); 
			$OUT = str_replace("[CHAN]", $CHAN, $OUT); 
			$OUT = str_replace("[FILNM]", $FILNM, $OUT);
			// Копируем во временную переменную			
			$TPLREL .= $OUT;			
		}
		// После всех повторений цикла заменяем получившееся в шаблоне с которого мы вырезали код
		$OTAr = preg_replace("/\[_ifota\].*?\[_ifota\]/s", $TPLREL, $this->TPLRELIZE);
		// Возвращаем готовый ответ
		return $OTAr;
	}
	// OTA Print
	public function OTAPr(){ 
		$this->AR['LOG']->LSET("OTAClass: OTAPr()");
		return $this->OTAHTML; // Вывод ответа
	}	
}
?>