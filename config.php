<?php
/* TODO */
/*
*/
defined('_CYOTA') or die('DISABLE'); // Disable run
// Title
$CONF['P_TITLE'] = "Cyanogenmod update system";
// Logs
$CONF['LOG_ACTIVE'] = true;        // Activation|Deactivation logs (true or false)
$CONF['LOG_MAIN']   = "main.log";  // Main log name
// DB
$CONF['DB_SERVER']   = "localhost"; 	// Server
$CONF['DB_USER']     = "root"; 			// User
$CONF['DB_PASS']     = "";				// Password
$CONF['DB_DBS']      = "cyota"; 	    // DB
$CONF['DB_CONNTYPE'] = "mysqli"; 	    // Connection type (mysql, mysqli)
// Template
$CONF['TPL_NAME']   = "standart";       // Template name
?>