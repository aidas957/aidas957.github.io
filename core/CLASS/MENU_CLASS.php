<?php
/* TODO */
/*
*/
defined('_CYOTA') or die('DISABLE'); // Disable run
class MENUClass{
	public $AR; 		// SYS
	public $MENUw; 		// Menu
	private $TPLw;		// TPL
	// Constructor
	function MENUClass($ARn){	
		$this->AR = $ARn; // SYS
		$this->TPLw = $this->AR['TPL']->TLOAD('MENU'); // Load menu tpl
	}
	// Set menu
	public function SET($NAMEn, $LINKn, $POSn){
		switch ($POSn){
			case "R": // To right
				$tmpm = str_replace("[_st]", "_r", $this->TPLw);
			break;
			case "L": // To left
				$tmpm = str_replace("[_st]", "", $this->TPLw);
			break;
			default: // Default to left
				$tmpm = str_replace("[_st]", "", $this->TPLw);
			break;
		}
		$tmpm = str_replace("[_link]", $LINKn, $tmpm); // Link
		$tmpm = str_replace("[_name]", $NAMEn, $tmpm); // Name
		$this->MENUw .= $tmpm;
	}
	// Print
	public function Pr(){
		return $this->MENUw;
	}
}
?>