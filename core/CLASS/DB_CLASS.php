<?php
/* TODO */
/*
*/
defined('_CYOTA') or die('DISABLE'); // Disable run
// Класc DBClass 
class DBClass{
	public $SERVER; 		// Server
	public $DBS; 			// Database
	public $USER; 			// User
	public $PASS; 			// Password
	public $CONNECTTYPE; 	// Type of connection
	private $MYSQLCONN;		// Connection ID
	public $AR; 			// SYS
	// Constructor
	function DBClass($CONFn, $SYSn){
		$this->SERVER 	    = $CONFn['DB_SERVER']; 	      
		$this->DBS 		    = $CONFn['DB_DBS']; 		  
		$this->USER 	    = $CONFn['DB_USER']; 		  
		$this->PASS 	    = $CONFn['DB_PASS']; 		  
		$this->CONNECTTYPE	= $CONFn['DB_CONNTYPE'];     
		$this->AR		    = $ARn; 					  
	}
	// Connect to DBClass
	public function CONNECT(){
		switch($this->CONNECTTYPE){
			case "mysql":
				$this->MYSQLCONN = mysql_connect($this->SERVER, $this->USER, $this->PASS); // Connect
				if(!$this->MYSQLCONN){ // No connection
					$this->AR['LOG']->WR("DBClass: CONNECT(mysql):NULL");
					return NULL;
				}
				$this->SELDB = mysql_select_db($this->DBS, $this->MYSQLCONN); // Select DB
				if(!$this->SELDB){ 	// If no DB
					$this->AR['LOG']->WR("DBClass: CONNECT(mysql):NO DB");
					$this->CLOSE();	// Close connection
					return NULL;
				}
				$this->QUERY("set character_set_client	= 'utf8'"); 			
				$this->QUERY("set character_set_results	= 'utf8'"); 			 
				$this->QUERY("set collation_connection	= 'utf8_general_ci'");
			break;
			case "mysqli":
				$this->MYSQLCONN = mysqli_connect($this->SERVER, $this->USER, $this->PASS, $this->DBS); // Connect
				if(!$this->MYSQLCONN){ // No connection
					$this->AR['LOG']->WR("DBClass: CONNECT(mysqli):NULL");
					return NULL;
				}
				$this->QUERY("set character_set_client	= 'utf8'"); 			 
				$this->QUERY("set character_set_results	= 'utf8'"); 			
				$this->QUERY("set collation_connection	= 'utf8_general_ci'"); 
			break;	
		}
	}
	// QUERY
	public function QUERY($SQLQUER){
		switch($this->CONNECTTYPE){
			case "mysql":
				return mysql_query($SQLQUER); 
			break;
			case "mysqli":
				return mysqli_query($this->MYSQLCONN, $SQLQUER);
			break;
		}	
	}
	// Close connection
	public function CLOSE(){
		switch($this->CONNECTTYPE){
			case "mysql":
				mysql_close($this->MYSQLCONN);
			break;
			case "mysqli":
				mysqli_close($this->MYSQLCONN);
			break;
		}	
	}
}
?>