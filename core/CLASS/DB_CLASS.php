<?php
/* TODO */
/*
-
*/
defined('_ACE3OTA') or die('ERROR'); // ���� ��������� �� ����������, ������ ���� ���������� ������� ��������
// ����c DBClass 
class DBClass{
	public $SERVER; 		// ����� �������
	public $DBS; 			// ���� �����
	public $USER; 			// ��� ������������
	public $PASS; 			// ������
	public $CONNECTTYPE; 	// ��� ����������
	public $AR; 			// ������ �������
	private $MYSQLCONN;		// ������������� �������� ����������
	private $SELDB;			// ������� ���� �����
	// ����������� �����
	function DBClass($CONFn, $ARn){
		$this->SERVER 	= $CONFn['DB_SERVER']; 	  	 // ����� �������
		$this->DBS 		= $CONFn['DB_DBS']; 		 // ���� �����
		$this->USER 	= $CONFn['DB_USER']; 		 // ��� ������������
		$this->PASS 	= $CONFn['DB_PASS']; 		 // ������
		$this->CONNECTTYPE	= $CONFn['DB_CONNTYPE']; // ��� ����������
		$this->AR		= $ARn; 					 // ������ �������
		$this->AR['LOG']->LSET("DBClass: Constructor(".$this->SERVER.", ".$this->DBS.", ".$this->USER.", ".$this->PASS.", ".$this->CONNECTTYPE.")");
	}
	// ����������� � ����
	public function CONNECT(){
		$this->AR['LOG']->LSET("DBClass: CONNECT()");
		switch($this->CONNECTTYPE){
			case "mysql":
				$this->AR['LOG']->LSET("DBClass: CONNECT(mysql)");
				$this->MYSQLCONN = mysql_connect($this->SERVER, $this->USER, $this->PASS); // ������� ����������
				if(!$this->MYSQLCONN){ // ���� ���������� �����������
					$this->AR['LOG']->LSET("DBClass: CONNECT(mysql):NULL");
					return NULL;
				}
				$this->SELDB = mysql_select_db($this->DBS, $this->MYSQLCONN); // �������� ���� �����
				if(!$this->SELDB){ 	// ���� ����� ���� ����� ���
					$this->AR['LOG']->LSET("DBClass: CONNECT(mysql):NO DB");
					$this->CLOSE();	// ��������� ����������
					return NULL;
				}
				$this->QUERY("set character_set_client	= 'cp1251'"); 			 // ��������� ���������
				$this->QUERY("set character_set_results	= 'cp1251'"); 			 // ��������� ���������
				$this->QUERY("set collation_connection	= 'cp1251_general_ci'"); // ��������� ���������
			break;
			case "mysqli":
				$this->AR['LOG']->LSET("DBClass: CONNECT(mysqli)");
				$this->MYSQLCONN = mysqli_connect($this->SERVER, $this->USER, $this->PASS, $this->DBS); // ������� ����������
				if(!$this->MYSQLCONN){ // ���� ���������� �����������
					$this->AR['LOG']->LSET("DBClass: CONNECT(mysqli):NULL");
					return NULL;
				}
				$this->QUERY("set character_set_client	= 'cp1251'"); 			 // ��������� ���������
				$this->QUERY("set character_set_results	= 'cp1251'"); 			 // ��������� ���������
				$this->QUERY("set collation_connection	= 'cp1251_general_ci'"); // ��������� ���������
			break;	
		}
	}
	// ��������� ������
	public function QUERY($SQLQUER){
		$this->AR['LOG']->LSET("DBClass: QUERY(".$SQLQUER.")");
		switch($this->CONNECTTYPE){
			case "mysql":
				return mysql_query($SQLQUER); // ������ ������
			break;
			case "mysqli":
				return mysqli_query($this->MYSQLCONN, $SQLQUER); // ������ ������
			break;
		}	
	}
	// ������� NUM_ROW
	function NUMROW($ROW){
		$this->AR['LOG']->LSET("DBClass: NUMROW(...)");
		switch($this->CONNECTTYPE){
			case "mysql":
				return mysql_num_rows($ROW);
			break;
			case "mysqli":
				return mysqli_num_rows($ROW);
			break;
		}
	}
	// ������� AFF_ROW
	function AFFROW(){
		$this->AR['LOG']->LSET("DBClass: AFFROW()");
		switch($this->CONNECTTYPE){
			case "mysql":
				return mysql_affected_rows($this->MYSQLCONN);
			break;
			case "mysqli":
				return mysqli_affected_rows($this->MYSQLCONN);
			break;
		}
	}
	// ������� FETCH_ARRAY
	function FETCHARRAY($ARR){
		$this->AR['LOG']->LSET("DBClass: FETCHARRAY(...)");
		switch($this->CONNECTTYPE){
			case "mysql":
				return mysql_fetch_array($ARR);
			break;
			case "mysqli":
				return mysqli_fetch_array($ARR);
			break;
		}
	}
	// ������� ���������� � �����
	public function CLOSE(){ //  CLOSE()
		$this->AR['LOG']->LSET("DBClass: CLOSE()");
		switch($this->CONNECTTYPE){
			case "mysql":
				mysql_close($this->MYSQLCONN); // ��������� ����������� ������������� � ����������
			break;
			case "mysqli":
				mysqli_close($this->MYSQLCONN);
			break;
		}	
	}
}
?>