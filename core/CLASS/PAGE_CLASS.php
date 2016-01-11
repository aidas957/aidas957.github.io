<?php
/* TODO */
/*
*/
defined('_CYOTA') or die('DISABLE'); // Disable run
class PAGEClass{
	public $AR; 			// System
	private $CONF;			// Config
	private $TPLw;	        // Template
	private $PMENU;			// Menu
	private $PCONT;			// Content
	private $PMSG;			// Msg
	private $PPAG;			// Pagination
	// Constructor
	function PAGEClass($CONFn, $ARn){
		$this->CONF = $CONFn;     // Config
		$this->AR = $ARn;         // Sys	
		$this->TPLw = $this->AR['TPL']->TLOAD('INDEX'); // Load index tpl
	}
	// Add menu
	public function SETMENU($MENUs){
		$this->PMENU = $MENUs;
	}
	// Print page
	public function Pr(){
		$HTMLm = str_replace("[_tpl_path]", "/tpl/".$this->CONF['TPL_NAME']."/", $this->TPLw);
		$HTMLm = str_replace("[_title]", $this->CONF['P_TITLE'], $HTMLm); // 
		$HTMLm = str_replace("[_menu]", $this->PMENU, $HTMLm); // Menu
		$HTMLm = str_replace("[_msg]", $this->PMSG, $HTMLm); // Message
		$HTMLm = str_replace("[_content]",$this->PCONT, $HTMLm); // Content
		$HTMLm = str_replace("[_paginat]", $this->PPAG, $HTMLm); // Pagination
		echo $HTMLm;
	}
}	
?>