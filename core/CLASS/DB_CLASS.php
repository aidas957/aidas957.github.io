<?php
/* TODO */
/*
-
*/
defined('_ACE3OTA') or die('ERROR'); // Если константы не существует, значит файл попытались открыть напрямую
// Класc DBClass 
class DBClass{
	public $SERVER; 		// Адрес сервера
	public $DBS; 			// База даных
	public $USER; 			// Имя пользователя
	public $PASS; 			// Пароль
	public $CONNECTTYPE; 	// Тип соединения
	public $AR; 			// Массив классов
	private $MYSQLCONN;		// Идентефикатор текущего соединения
	private $SELDB;			// Текущая база даных
	// Конструктор класа
	function DBClass($CONFn, $ARn){
		$this->SERVER 	= $CONFn['DB_SERVER']; 	  	 // Адрес сервера
		$this->DBS 		= $CONFn['DB_DBS']; 		 // База даных
		$this->USER 	= $CONFn['DB_USER']; 		 // Имя пользователя
		$this->PASS 	= $CONFn['DB_PASS']; 		 // Пароль
		$this->CONNECTTYPE	= $CONFn['DB_CONNTYPE']; // Тип соединения
		$this->AR		= $ARn; 					 // Массив классов
		$this->AR['LOG']->LSET("DBClass: Constructor(".$this->SERVER.", ".$this->DBS.", ".$this->USER.", ".$this->PASS.", ".$this->CONNECTTYPE.")");
	}
	// Подключение к базе
	public function CONNECT(){
		$this->AR['LOG']->LSET("DBClass: CONNECT()");
		switch($this->CONNECTTYPE){
			case "mysql":
				$this->AR['LOG']->LSET("DBClass: CONNECT(mysql)");
				$this->MYSQLCONN = mysql_connect($this->SERVER, $this->USER, $this->PASS); // Создаем соединение
				if(!$this->MYSQLCONN){ // Если соединение отсутствует
					$this->AR['LOG']->LSET("DBClass: CONNECT(mysql):NULL");
					return NULL;
				}
				$this->SELDB = mysql_select_db($this->DBS, $this->MYSQLCONN); // Выбираем базу даных
				if(!$this->SELDB){ 	// Если такой базы даных нет
					$this->AR['LOG']->LSET("DBClass: CONNECT(mysql):NO DB");
					$this->CLOSE();	// Закрываем соединение
					return NULL;
				}
				$this->QUERY("set character_set_client	= 'cp1251'"); 			 // Установка кодировок
				$this->QUERY("set character_set_results	= 'cp1251'"); 			 // Установка кодировок
				$this->QUERY("set collation_connection	= 'cp1251_general_ci'"); // Установка кодировок
			break;
			case "mysqli":
				$this->AR['LOG']->LSET("DBClass: CONNECT(mysqli)");
				$this->MYSQLCONN = mysqli_connect($this->SERVER, $this->USER, $this->PASS, $this->DBS); // Создаем соединение
				if(!$this->MYSQLCONN){ // Если соединение отсутствует
					$this->AR['LOG']->LSET("DBClass: CONNECT(mysqli):NULL");
					return NULL;
				}
				$this->QUERY("set character_set_client	= 'cp1251'"); 			 // Установка кодировок
				$this->QUERY("set character_set_results	= 'cp1251'"); 			 // Установка кодировок
				$this->QUERY("set collation_connection	= 'cp1251_general_ci'"); // Установка кодировок
			break;	
		}
	}
	// Выполнить запрос
	public function QUERY($SQLQUER){
		$this->AR['LOG']->LSET("DBClass: QUERY(".$SQLQUER.")");
		switch($this->CONNECTTYPE){
			case "mysql":
				return mysql_query($SQLQUER); // Делаем запрос
			break;
			case "mysqli":
				return mysqli_query($this->MYSQLCONN, $SQLQUER); // Делаем запрос
			break;
		}	
	}
	// Функция NUM_ROW
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
	// Функция AFF_ROW
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
	// Функция FETCH_ARRAY
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
	// Закрыть соединение с базой
	public function CLOSE(){ //  CLOSE()
		$this->AR['LOG']->LSET("DBClass: CLOSE()");
		switch($this->CONNECTTYPE){
			case "mysql":
				mysql_close($this->MYSQLCONN); // Закрываем соденинение идентефикатор в переменной
			break;
			case "mysqli":
				mysqli_close($this->MYSQLCONN);
			break;
		}	
	}
}
?>