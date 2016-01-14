<?php
/* TODO */
/*
*/
defined('_CYOTA') or die('DISABLE'); // Disable run
class MSGClass{
	private $OUT;	// 
	function MSGClass(){
	}	
	// 
	public function SHOW($MSGIn, $LVL){
		switch($LVL){
			// 
			case "I": // 
				$this->OUT .= "<div class='notice'><font color='green'>".$MSGIn."</font></div>"; // 
			break;
			case "W": // 
				$this->OUT .= "<div class='notice'><font color='blue'>".$MSGIn."</font></div>";	// 
			break;
			case "C": // 
				$this->OUT .= "<div class='error'><font color='red'>".$MSGIn."</font></div>"; // 
			break;
		}
	}
	//
	public function Pr(){ 
		return $this->OUT; // 
	}
}	
?>