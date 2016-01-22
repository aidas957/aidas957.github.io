<?php
/* TODO */
/*
*/
defined('_CYOTA') or die('DISABLE'); // Disable run
class USERSClass{
	public $AR; 		// SYS
	public $CONF; 		// Config
	public $OUT;
	function USERSClass($CONFn, $ARn){
		$this->AR = $ARn;
		$this->CONF = $CONFn;
	}
	// User info
	public function USERINFO($DATA, $BY){
		switch($BY){
			case "N": // By name
				$INFO = USER_GET_API($DATA, "N", $this->AR); //
			break;
			case "S": // By session
				$INFO = USER_GET_API($DATA, "S", $this->AR); //
			break;
		}
		if($INFO){ // Parse info from db
			$RMEN = $this->AR['DB']->FETCHARRAY($INFO); //
			$USRINFO['NAME'] = $RMEN['cy_users_login'];     // Login
			$USRINFO['PASS'] = $RMEN['cy_users_password'];  // Password
			$USRINFO['RANG'] = $RMEN['cy_users_rang'];      // Rang
			return $USRINFO;
			
		}else{ // No user
			$this->AR['LOG']->WR("USERSClass: USERINFO no user");
			return NULL;
		}		
	}
	// ISADMIN
	public function ISADMIN($DATA, $BY){
		$USERINF = NULL;
		switch($BY){
			case "S": // By sesion
				$this->AR['LOG']->WR("USERSClass: ISADMIN SES IS ".$DATA."");
				$USERINF = $this->USERINFO($DATA, "S"); // Get user info
			break;
		}
		if($USERINF){
			$this->AR['LOG']->WR("USERSClass: ISADMIN RANG IS ".$USERINF['RANG']."");
			if($USERINF['RANG'] == ADMINISTRATOR){
				return true;
			}else{
				$this->AR['LOG']->WR("USERSClass: ISADMIN Not admin");
				return FALSE;
			}
		}else{
			$this->AR['LOG']->WR("USERSClass: ISADMIN No user by session, error chek isadmin");
			return FALSE;
		}		
	}
// Forms	
	// Show login form
	public function SHOWLOGINFORM(){
		$TPLw = $this->AR['TPL']->TLOAD('LOGIN');
		$TPLw = str_replace("[_tpl_path]", "/tpl/".$this->CONF['TPL_NAME']."/", $TPLw);
		$TPLw = str_replace("[_l_login]", $this->AR['LNG']->STR['d_login'], $TPLw);
		$TPLw = str_replace("[_l_password]", $this->AR['LNG']->STR['d_pass'], $TPLw);
		$this->OUT = str_replace("[_l_enter]", $this->AR['LNG']->STR['d_enter'], $TPLw);
	}
	// Show admin form
	public function SHOWADMINFORM(){
		$TPLw = $this->AR['TPL']->TLOAD('ADMIN');
		$TPLw = str_replace("[_tpl_path]", "/tpl/".$this->CONF['TPL_NAME']."/", $TPLw);
		$this->OUT = str_replace("[_l_builds]", $this->AR['LNG']->STR['d_builds'], $TPLw);	
	}
// Functions	
	// Login function
	public function AUTH(){
		if(isset($_POST['login']) AND isset($_POST['password'])){
				$LOGIN = clean($this->AR, $_POST['login'], "S"); // Clean login
				$PASS =  clean($this->AR,$_POST['password'], "S"); // Clean passwords
				$USERINF = $this::USERINFO($LOGIN, "N"); // Get user info
				if($USERINF){ // If have user
					$this->AR['LOG']->WR("USERSClass: User ".$LOGIN." found");
					//$this->AR['LOG']->WR("USERSClass: GenPass test is ".GenPass($PASS, $PASS."ota")." <-");
					if(strcmp($USERINF['PASS'], GenPass($PASS, $PASS."ota")) == 0){
						session_start();
						$_SESSION['USERSES_CODE'] = GenHashe($LOGIN, "ota");
						$this->AR['LOG']->WR("USERSClass: SESION is ".$_SESSION['USERSES_CODE']." for ".$LOGIN."");
						$DATAS['SESSION'] = $_SESSION['USERSES_CODE']; // Sesion
						$DATAS['NAME'] = $LOGIN; // Login name
						$RESHASH = USER_SET_API($DATAS, "S", $this->AR); // Sets session to db
						if($RESHASH == 1){
							$this->AR['LOG']->WR("USERSClass: SESION is ".$_SESSION['USERSES_CODE']." for ".$LOGIN." updated");
							header("location: ".INDEX_FILE."");
							exit;
						}else{
							unset($_SESSION['USERSES_CODE']); // Del session
							session_destroy(); // Destroy
							$this->AR['LOG']->WR("USERSClass: SESION is ".$_SESSION['USERSES_CODE']." for ".$LOGIN." ERROR");
							$this->AR['MENU']->SET($this->AR['LNG']->STR['m_nazad'], "javascript:history.go(-1);", "R"); // Create menu
							$this->AR['MSG']->SHOW($this->AR['LNG']->STR['msg_no_sesionset'], "I");
						}
					}else{
						$this->AR['MENU']->SET($this->AR['LNG']->STR['m_nazad'], "javascript:history.go(-1);", "R"); // Create menu
						$this->AR['MSG']->SHOW($this->AR['LNG']->STR['msg_bed_bass'], "I");
					}
				}else{ // If no user
					$this->AR['LOG']->WR("USERSClass: User ".$LOGIN."  not found");
					$this->AR['MENU']->SET($this->AR['LNG']->STR['m_nazad'], "javascript:history.go(-1);", "R"); // Create menu
					$this->AR['MSG']->SHOW($this->AR['LNG']->STR['msg_no_user'], "I");
				}	
			}else{
				$this->AR['MENU']->SET($this->AR['LNG']->STR['m_nazad'], "javascript:history.go(-1);", "R"); // Create menu
				$this->AR['MSG']->SHOW($this->AR['LNG']->STR['msg_no_data'], "I");
			}
	}
	// Exit
	public function EXITT(){
		if(isset($_GET['ses'])){
			$SES = $_GET['ses'];
		}else{
			$SES = NULL; 
		}
		session_start(); // Старт сесий
		if(strcmp($_SESSION['USERSES_CODE'], $SES) == 0){
			unset($_SESSION['USERSES_CODE']); // 
			session_destroy(); //
			header("location: ".INDEX_FILE."");
			exit;
		}else{
			header("location: ".INDEX_FILE."");
			exit;
		}
	}
	public function Pr(){
		return $this->OUT;
	}
}
?>