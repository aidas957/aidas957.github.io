<?php
/* TODO */
/*
*/
defined('_CYOTA') or die('DISABLE'); // Disable run
// Folders
define ("ROOT_FOLDER", $_SERVER['DOCUMENT_ROOT']);        // Root dir of all scripts
define ("CORE_FOLDER", ROOT_FOLDER."/core/");             // Core folder
define ("LOG_FOLDER", ROOT_FOLDER."/log/");               // Log folder
define ("TPL_FOLDER", ROOT_FOLDER."/tpl/");               // Tpl folder
define ("CLASS_FOLDER", "".CORE_FOLDER."CLASS/");         // Class folder
define ("FUNCTIONS_FOLDER", "".CORE_FOLDER."FUNCTIONS/"); // Functions folder
// Files
define ("CONFIG_FILE", ROOT_FOLDER."/config.php"); // Configuration file
// Class
define ("LOG_CLASS", "LOG_CLASS.php");    // Log algoritm class
define ("DB_CLASS", "DB_CLASS.php");      // SQL db class
define ("TPL_CLASS", "TPL_CLASS.php");    // Template system class
define ("PAGE_CLASS", "PAGE_CLASS.php");  // Main page class
define ("MENU_CLASS", "MENU_CLASS.php");  // Menu class
// Function
define ("TPL_FUNCTION", "TPL_FUNCTION.php"); // Function for tpl
?>