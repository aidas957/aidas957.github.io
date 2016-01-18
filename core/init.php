<?php
/* TODO */
/*
*/
defined('_CYOTA') or die('DISABLE'); // Disable run
include("core/defs.php");            // Include defines file
include(CONFIG_FILE);                // Add config
//PHP settings
ini_set('error_reporting', E_ALL);
ini_set('log_errors', 1);
ini_set('error_log', TMP_FOLDER."php_error.log");
// Functions
include("".FUNCTIONS_FOLDER."".MAIN_FUNCTION.""); // Main function
include("".FUNCTIONS_FOLDER."".TPL_FUNCTION.""); // Load tpl function
// Class
include("".CLASS_FOLDER."".LOG_CLASS."");  // Add log class
include("".CLASS_FOLDER."".DB_CLASS."");   // Add db class
include("".CLASS_FOLDER."".TPL_CLASS."");  // Template class
include("".CLASS_FOLDER."".LNG_CLASS."");  // Language class
include("".CLASS_FOLDER."".MSG_CLASS."");  // Message class
include("".CLASS_FOLDER."".PAGE_CLASS.""); // Page class
include("".CLASS_FOLDER."".OTA_CLASS."");  // Ota class
include("".CLASS_FOLDER."".MENU_CLASS.""); // Menu class
include("".CLASS_FOLDER."".NEWS_CLASS.""); // News class
include("".CLASS_FOLDER."".USERS_CLASS.""); // Users class
// API
include("".API_FOLDER."".OTA_API."");      // Ota api
include("".API_FOLDER."".USERS_API."");    // Users api
// Initialization
$AR['LOG'] = new LOGClass($CONF);         // Log 
$AR['DB']  = new DBClass($CONF, $AR);     // DB
$AR['TPL'] = new TPLClass($CONF, $AR);    // Tpl
$AR['LNG'] = new LNGClass($CONF, $AR);    // Lng
$AR['MSG'] = new MSGClass();              // Msg
$AR['PAGE'] = new PAGEClass($CONF, $AR); // Page
$AR['MENU'] = new MENUClass($AR);         // Menu
$AR['OTA'] = new OTAClass($AR);           // OTA
$AR['NEWS'] = new NEWSClass($CONF, $AR);  // News
$AR['USERS'] = new USERSClass($CONF, $AR);  // News
?>