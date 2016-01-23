<?php
/* TODO */
/*
*/
defined('_CYOTA') or die('DISABLE'); // Disable run
class LNGClass{
	public $STR; 			// Language string array
	private $LNG_PATH_FILE; // 
	function LNGClass($CONFn, $ARn){
		$list = strtolower($_SERVER['HTTP_ACCEPT_LANGUAGE']);
		preg_match_all('/([a-z]{1,8}(?:-[a-z]{1,8})?)(?:;q=([0-9.]+))?/', $list, $list);
		$LANGUAGE = implode("", $list[1]);
		$LLNG = strtok($LANGUAGE, '-');
		$ARn['LOG']->WR("LNGClass: Browser lng is ".$LLNG."");
		$LLNG .= ".ini";
		$ARn['LOG']->WR("LNGClass: load ".LNG_FOLDER.$LLNG."");
		if(file_exists(LNG_FOLDER.$LLNG)){
			$this->STR = parse_ini_file(LNG_FOLDER.$LLNG);
			$ARn['LOG']->WR("LNGClass: ".LNG_FOLDER.$LLNG." loaded");
		}else{
			$this->LNG_PATH_FILE .= $CONFn['LNG_NAME']; //
			$this->LNG_PATH_FILE .= ".ini";
			$this->STR = parse_ini_file(LNG_FOLDER.$this->LNG_PATH_FILE);
			$ARn['LOG']->WR("LNGClass: ".LNG_FOLDER.$this->LNG_PATH_FILE." use default");
		}
	}	
}
?>