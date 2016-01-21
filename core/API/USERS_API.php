<?php
/* TODO */
/*
*/
defined('_CYOTA') or die('DISABLE'); // Disable run
// Get user
function USER_GET_API($DATAS, $PR, $AR){
	switch($PR){
		case "N": // By name
			$usr= $AR['DB']->QUERY("SELECT * FROM cy_users WHERE cy_users_login = '$DATAS' LIMIT 1");
		break;
		case "S": // By sesion
			$usr= $AR['DB']->QUERY("SELECT * FROM cy_users WHERE cy_users_sescode = '$DATAS' LIMIT 1");
			$AR['LOG']->WR("USER_GET_API: S: SELECT * FROM cy_users WHERE cy_users_sescode = '$DATAS' LIMIT 1");
		break;
	}	
	if($AR['DB']->NUMROW($usr) == 0){
		return NULL;
	}else{
		return $usr;
	}
}
// Set user
function USER_SET_API($DATAS, $PR, $AR){
	switch($PR){
		case "S": // Set Session
			$SES = $DATAS['SESSION']; // Sesion
			$LOGIN = $DATAS['NAME']; // Login name
			$usr= $AR['DB']->QUERY("UPDATE cy_users SET cy_users_sescode = '".$SES."' WHERE cy_users_login = '$LOGIN'");
		break;
	}	
	if($AR['DB']->AFFROW() != 0){
		return TRUE;	// If update more then 0 string
	}else{
		return NULL; // Error
	}
}
?>