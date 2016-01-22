<?php
/* TODO */
/*
*/
define('_CYOTA', 1); // Protect key
/* Input parameter */
if(isset($_GET['com'])){$PARAM['COM'] = $_GET['com'];}else{$PARAM['COM'] = NULL;} // Param
/* Include */
include("core/init.php"); // Init core
/* Portal */
$AR['LOG']->WR("AUTH: BEGIN");
$AR['DB']->CONNECT(); // Connect to db
// Prepare page
$AR['MENU']->SET($AR['LNG']->STR['m_main'], "/", "L"); // Create menu
switch($PARAM['COM']){
	case "auth": // If auth command
		$AR['USERS']->AUTH(); // login logic
	break;
	case "exit": // Exit
		$AR['USERS']->EXITT();
	break;
	default: // If no post
		$AR['USERS']->SHOWLOGINFORM(); // Prepare login form
	break;
}
// Build page	
$AR['PAGE']->SETMSG($AR['MSG']->Pr()); // Add all msg to page
$AR['PAGE']->SETMENU($AR['MENU']->Pr()); // Set all created menu to page
$AR['PAGE']->SETCONTENT($AR['USERS']->Pr(), NULL); // Print login form as main content
$AR['PAGE']->Pr(); // Print ready Page
$AR['DB']->CLOSE(); // Close connection
$AR['LOG']->WR("AUTH: END");
?>