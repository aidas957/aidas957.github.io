<?php
/* TODO */
/*
-
*/
defined('_ACE3OTA') or die('ERROR'); // Если константы не существует, значит файл попытались открыть напрямую
// Класc STATClass 
class STATClass{
	public $AR; 			// Массив классов
	public $IPA; 			// IP
	public $DTIME; 			// Timestamp
	public $SQLARRq; 		// Массив статистики
	function STATClass($ARn){
		$this->AR = $ARn; // Массив классов	
		$this->IPA = $_SERVER['REMOTE_ADDR'];
		$this->DTIME = time(); // Получаем метку времени
		$this->SQLARRq['stats_time'] = $this->DTIME;
		$this->SQLARRq['stats_ip'] = $this->IPA;
		$this->AR['LOG']->LSET("STATClass: Constructor(): DATA(".$this->DTIME."), IP(".$this->IPA.")");
	}
	// Добавляем данные в статистику
	function SETFILD($FILD, $DATA){
		$this->AR['LOG']->LSET("STATClass: SETFILD(".$FILD.", ".$DATA.")");
		switch($FILD){
			case 'DEVICE':
				$this->AR['LOG']->LSET("STATClass: SETFILD(CASE ".$FILD.")");
				$this->SQLARRq['stats_device'] =  $DATA;
			break;
			case 'BUILD':
				$this->AR['LOG']->LSET("STATClass: SETFILD(CASE ".$FILD.")");
				$this->SQLARRq['stats_build'] =  $DATA;
			break;
			case 'WORK':
				$this->AR['LOG']->LSET("STATClass: SETFILD(CASE ".$FILD.")");
				$this->SQLARRq['stats_work'] =  $DATA;
			break;
			default:
				$this->AR['LOG']->LSET("STATClass: SETFILD(CASE DEFAULT)");
			break;
		}
	}
	function Pr(){
		$RES = API_STAT_WRITE($this->SQLARRq, $this->AR);
		if($RES){
			$this->AR['LOG']->LSET("STATClass: Pr(OK)");
		}else{
			$this->AR['LOG']->LSET("STATClass: Pr(ERROR)");
		}
	}
}
?>