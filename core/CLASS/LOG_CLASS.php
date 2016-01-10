<?php
/* TODO */
/*
*/
defined('_CYOTA') or die('DISABLE'); // Disable run
class LOGClass{
	public $LOG_ACTIVATATION;	// Disable or enable
	public $FILE_MAIN_LOG;	    // MAIN Log 
	// Constructor
	function LOGClass($CONFn){
		$this->LOG_ACTIVATATION = $CONFn['LOG_ACTIVE']; // Enable or disable log
		$this->FILE_MAIN_LOG = $CONFn['LOG_MAIN']; // Main log name
	}
	// Write log to file
	public function WR($TEXT){
		if($this->LOG_ACTIVATATION){ // If log active
			file_put_contents("".LOG_FOLDER."".$this->FILE_MAIN_LOG."", date("H:i:s")."| ", FILE_APPEND);
		    file_put_contents("".LOG_FOLDER."".$this->FILE_MAIN_LOG."", $TEXT, FILE_APPEND);
		    file_put_contents("".LOG_FOLDER."".$this->FILE_MAIN_LOG."", "\r\n", FILE_APPEND);
		}else{ // If log not active
			file_put_contents("".LOG_FOLDER."".$this->FILE_MAIN_LOG."", ""); // Clean
			file_put_contents("".LOG_FOLDER."".$this->FILE_MAIN_LOG."", "LOG DISABLED", FILE_APPEND);
		}		
	}	
}
?>