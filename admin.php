<?php
/* TODO */
/*
*/
define('_CYOTA', 1); // Protect key
/* Input parameter */
if(isset($_GET['com'])){$PARAM['COM'] = $_GET['com'];}else{$PARAM['COM'] = NULL;} // Param
if(isset($_GET['do'])){$PARAM['DO'] = $_GET['do'];}else{$PARAM['DO'] = NULL;} // Param
/* Include */
include("core/init.php"); // Init core
/* Portal */
$AR['LOG']->WR("ADMIN: BEGIN");
session_start(); // Sesion begin
if(isset($_SESSION['USERSES_CODE'])){$SES = $_SESSION['USERSES_CODE'];}else{$SES = NULL;} // get sesion
// Prepare page
$AR['DB']->CONNECT(); // Connect to db
$AR['MENU']->SET($AR['LNG']->STR['m_main'], "/", "L"); // Create menu
if($SES AND $AR['USERS']->ISADMIN($SES, "S")){
	switch($PARAM['COM']){
		
// ---------------------->Builds		
		case "builds": 
			if(strcmp($PARAM['DO'], "showall") == 0){ // Show all builds
				$AR['MENU']->SET($AR['LNG']->STR['l_upload_build'], ADMIN_FILE."?com=builds&do=upload", "L"); // Upload new build link
				$AR['MENU']->SET($AR['LNG']->STR['m_exit'], AUTH_FILE."?com=exit&ses=$SES", "R");
				$AR['MENU']->SET($AR['LNG']->STR['m_admin'], "/admin.php", "R");
				$AR['NEWS']->GETFULL();
				$AR['PAGE']->SETCONTENT($AR['NEWS']->Pr("NEWS"), NULL);
			}
			if(strcmp($PARAM['DO'], "upload") == 0){ // Upload builds
				$AR['MENU']->SET($AR['LNG']->STR['m_exit'], AUTH_FILE."?com=exit&ses=$SES", "R");
				$AR['MENU']->SET($AR['LNG']->STR['m_admin'], "/admin.php", "R");
			}
		break;
// ---------------------->Builds
		
		default: // If no post (default page)
			$AR['MENU']->SET($AR['LNG']->STR['m_exit'], AUTH_FILE."?com=exit&ses=$SES", "R");
			$AR['USERS']->SHOWADMINFORM(); // Prepare admin form
			$AR['PAGE']->SETCONTENT($AR['USERS']->Pr(), NULL); // Print admin form as main content
		break;
	}
}else{
	header("location: ".AUTH_FILE."");
	exit;
}
// Build page
$AR['PAGE']->SETMSG($AR['MSG']->Pr()); // Add all msg to page
$AR['PAGE']->SETMENU($AR['MENU']->Pr()); // Set all created menu to page
$AR['PAGE']->Pr(); // Print ready Page
$AR['DB']->CLOSE(); // Close connection
$AR['LOG']->WR("ADMIN: END");
?>