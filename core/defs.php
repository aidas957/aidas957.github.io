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
define ("LNG_FOLDER", ROOT_FOLDER."/lng/");               // Lng folder
define ("TMP_FOLDER", ROOT_FOLDER."/tmp/");               // TMP folder
define ("CLASS_FOLDER", "".CORE_FOLDER."CLASS/");         // Class folder
define ("FUNCTIONS_FOLDER", "".CORE_FOLDER."FUNCTIONS/"); // Functions folder
define ("API_FOLDER", "".CORE_FOLDER."API/");             // API folder
// Files
define ("CONFIG_FILE", ROOT_FOLDER."/config.php"); // Configuration file
define ("AUTH_FILE", "auth.php"); // Authorization
define ("ADMIN_FILE", "admin.php"); // Administrator portal
define ("INDEX_FILE", "index.php"); // Main page
// Class
define ("LOG_CLASS", "LOG_CLASS.php");    // Log algoritm class
define ("DB_CLASS", "DB_CLASS.php");      // SQL db class
define ("TPL_CLASS", "TPL_CLASS.php");    // Template system class
define ("LNG_CLASS", "LNG_CLASS.php");    // Language algoritm class
define ("MSG_CLASS", "MSG_CLASS.php");    // Class for message print
define ("PAGE_CLASS", "PAGE_CLASS.php");  // Main page class
define ("OTA_CLASS", "OTA_CLASS.php");    // Ota class
define ("MENU_CLASS", "MENU_CLASS.php");  // Menu class
define ("NEWS_CLASS", "NEWS_CLASS.php");  // News class
define ("USERS_CLASS", "USERS_CLASS.php"); // Users class
// Function
define ("MAIN_FUNCTION", "MAIN_FUNCTION.php"); // Main
define ("TPL_FUNCTION", "TPL_FUNCTION.php");   // Function for tpl
// API
define ("OTA_API", "OTA_API.php"); // SQL for OTA
define ("USERS_API", "USERS_API.php"); // Users for OTA
// Rang
define ("ADMINISTRATOR", 9); // Admin rang
?>