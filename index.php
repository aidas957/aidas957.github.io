<?php
/* TODO */
/*
*/
define('_CYOTA', 1); // Protect key
/* Input parameter */
$RAWPOST = file_get_contents("php://input"); // Get RAW POST for OTA parsing
if($RAWPOST != ""){$PARAM['RAW'] = $RAWPOST;}else{$PARAM['RAW'] = NULL;} // If RAW present and not null
if(isset($_GET['page'])){$PARAM['PAGE'] = $_GET['page'];}else{$PARAM['PAGE'] = 1;} // Param of page
/* Include */
include("core/init.php"); // Init core
/* Portal */
$AR['LOG']->WR("INDEX: BEGIN");
$AR['DB']->CONNECT(); // Connect to db
if($PARAM['RAW'] != NULL){ // If its OTA update
	$AR['LOG']->WR("INDEX: OTA UPDATE BEGIN");
	$AR['OTA']->GET($PARAM['RAW']); // Use parametr for OTA !!!!Fixit Need give $PARAM array
	$AR['INDEX']->SETCONTENT($AR['OTA']->Pr(), "OTA_INDEX"); // Set content to main page, use castom OTA main template
	$AR['INDEX']->Pr(); // Print Page
}else{ // If portal
	$AR['LOG']->WR("INDEX: NEWS BEGIN");
	$AR['MENU']->SET($AR['LNG']->STR['m_main'], "/", "L"); // Create menu
	//$AR['MENU']->SET($AR['LNG']->STR['m_admin'], "/admin.php", "R"); // Create menu
	$AR['INDEX']->SETMENU($AR['MENU']->Pr()); // Set all created menu to page
	$AR['NEWS']->GET($PARAM);                 // Get news with parametr from db
	$AR['INDEX']->SETMSG($AR['MSG']->Pr());   // Add all msg to page
	$AR['INDEX']->SETCONTENT($AR['NEWS']->Pr("NEWS"), NULL);          // Add all news to content page
	$AR['INDEX']->SETPAGINATION($AR['NEWS']->Pr("PAGINATION"), NULL); // Add pagination on page
	$AR['INDEX']->Pr(); // Print ready Page
}
$AR['DB']->CLOSE(); // Close connection
$AR['LOG']->WR("INDEX: END");
?>