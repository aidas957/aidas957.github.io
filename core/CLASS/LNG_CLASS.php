<?php
/* TODO */
/*
*/
defined('_CYOTA') or die('DISABLE'); // Disable run
class LNGClass{
	public $STR; 			// Language string array
	private $LNG_PATH_FILE; // 
	function LNGClass($CONFn, $ARn){
		$this->LNG_PATH_FILE .= $CONFn['LNG_NAME']; //
		$this->LNG_PATH_FILE .= ".ini";
		$this->STR = parse_ini_file(LNG_FOLDER.$this->LNG_PATH_FILE);
	}	
}
?>