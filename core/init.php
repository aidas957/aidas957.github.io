<?php
/* TODO */
/*
*/
defined('_CYOTA') or die('DISABLE'); // Disable run
include("core/defs.php"); // Include defines file
include(CONFIG_FILE); // Add config
// Functions
// Class
include("".CLASS_FOLDER."".LOG_CLASS.""); // Add log class
include("".CLASS_FOLDER."".DB_CLASS.""); // Add db class
// API
// Initialization
$SYS['LOG'] = new LOGClass($CONF);      // Log 
$SYS['DB']  = new DBClass($CONF, $SYS); // DB
?>