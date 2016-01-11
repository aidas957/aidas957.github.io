<?php
/* TODO */
/*
*/
defined('_CYOTA') or die('DISABLE'); // Disable run
include("core/defs.php");            // Include defines file
include(CONFIG_FILE);                // Add config
// Functions
include("".FUNCTIONS_FOLDER."".TPL_FUNCTION.""); // Load tpl function
// Class
include("".CLASS_FOLDER."".LOG_CLASS."");  // Add log class
include("".CLASS_FOLDER."".DB_CLASS."");   // Add db class
include("".CLASS_FOLDER."".TPL_CLASS."");  // Template class
include("".CLASS_FOLDER."".PAGE_CLASS.""); // Page class
include("".CLASS_FOLDER."".MENU_CLASS.""); // Menu class
// API
// Initialization
$AR['LOG'] = new LOGClass($CONF);         // Log 
$AR['DB']  = new DBClass($CONF, $AR);     // DB
$AR['TPL'] = new TPLClass($CONF, $AR);    // Tpl
$AR['INDEX'] = new PAGEClass($CONF, $AR); // Page
$AR['MENU'] = new MENUClass($AR);         // Menu
?>