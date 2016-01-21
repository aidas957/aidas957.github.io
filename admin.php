<?php
/* TODO */
/*
*/
define('_CYOTA', 1); // Protect key
/* Input parameter */
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
	$AR['MENU']->SET($AR['LNG']->STR['m_exit'], AUTH_FILE."?com=exit&ses=$SES", "R");
	$AR['USERS']->SHOWADMINFORM(); // Prepare admin form
}else{
	header("location: ".AUTH_FILE."");
	exit;
}
// Build page
$AR['PAGE']->SETMSG($AR['MSG']->Pr()); // Add all msg to page
$AR['PAGE']->SETMENU($AR['MENU']->Pr()); // Set all created menu to page
$AR['PAGE']->SETCONTENT($AR['USERS']->Pr(), NULL); // Print admin form as main content
$AR['PAGE']->Pr(); // Print ready Page
$AR['DB']->CLOSE(); // Close connection
$AR['LOG']->WR("ADMIN: END");
?>