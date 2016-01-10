<?php
/* TODO */
/*
*/
defined('_CYOTA') or die('DISABLE'); // Disable run
// Folders
define ("ROOT_FOLDER", $_SERVER['DOCUMENT_ROOT']); // Root dir of all scripts
define ("CORE_FOLDER", ROOT_FOLDER."/core/");      // Core folder
define ("LOG_FOLDER", ROOT_FOLDER."/log/");        // Log folder
define ("CLASS_FOLDER", "".CORE_FOLDER."class/");  // Class folder
// Files
define ("CONFIG_FILE", ROOT_FOLDER."/config.php"); // Configuration file
// Class
define ("LOG_CLASS", "LOG_CLASS.php"); // Log algoritm class
?>