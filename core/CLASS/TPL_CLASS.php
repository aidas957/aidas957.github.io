<?php
/* TODO */
/*
*/
defined('_CYOTA') or die('DISABLE'); // Disable run
class TPLClass{
	public $TPLPTH; // Path of main tpl
	private $TPLFNAME; // Configs of tpl files
	private $CONF;
	private $AR;
	// Constructor
	function TPLClass($CONFn, $ARn){
		$this->CONF = $CONFn;
		$this->AR = $ARn;
		$this->TPLPTH = TPL_FOLDER.$CONFn['TPL_NAME']."/"; // Config path to tpl file
		$this->TPLFNAME = parse_ini_file($this->TPLPTH."tplconf.ini"); // Read template config
		if(!$this->TPLFNAME){
			$this->AR['LOG']->WR("TPLClass: ERROR (no tplconf.ini in template folder)");
		}
	}
	// Tpl loading
	public function TLOAD($TPL){ // Name of template load
		$TPLPATHfile = $this->TPLPTH.$this->TPLFNAME[$TPL]; // Path + name of tplfile from config
		$RES = LoadTpl($TPLPATHfile);
		if(!$RES){
			// Error no tpl file
			$this->AR['LOG']->WR("TPLClass: TLOAD: ERROR (No file: ".$this->TPLFNAME[$TPL].")");
			return false;
		}
		return $RES;
	}
}
?>