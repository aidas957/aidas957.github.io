<?php
/* TODO */
/*
-
*/
defined('_ACE3OTA') or die('ERROR'); // Если константы не существует, значит файл попытались открыть напрямую
// Folders
define ("BUILDS_FOLDER", "builds/"); // Builds
define ("CORE_FOLDER", "core/"); // Core
define ("LOG_FOLDER", "log/"); // Log
define ("TPL_FOLDER", "tpl/"); // Tpl
define ("LNG_FOLDER", "".$_SERVER['DOCUMENT_ROOT']."/lng/"); // Lng
// Class
define ("CLASS_PATH", "".CORE_FOLDER."CLASS/"); // Folder CLASS
define ("FUNCTION_PATH", "".CORE_FOLDER."FUNCTION/"); // Folder FUNCTION
define ("API_PATH", "".CORE_FOLDER."API/"); // Folder API
// Files
define ("CONFIG_FILE", "config.php"); // Config file
// Class
define ("LOG_CLASS", "LOG_CLASS.php"); // Log class file
define ("DB_CLASS", "DB_CLASS.php"); // DB class file
define ("OTA_CLASS", "OTA_CLASS.php"); // OTA class file
define ("STAT_CLASS", "STAT_CLASS.php"); // Statistic class file
define ("MSG_CLASS", "MSG_CLASS.php"); // Message class file
define ("LNG_CLASS", "LNG_CLASS.php"); // Language class file
define ("PAGE_CLASS", "PAGE_CLASS.php"); // PAGE class file
define ("MENU_CLASS", "MENU_CLASS.php"); // MENU class file
define ("NEWS_CLASS", "NEWS_CLASS.php"); // NEWS class file
// Function
define ("LOADTPL_FUNCTION", "loadtpl.php"); // LOADTPL function
// API
define ("API_OTA", "API_OTA.php"); // Ota API
define ("API_STAT", "API_STAT.php"); // Statistic API
define ("API_MENU", "API_MENU.php"); // Menu API
define ("API_NEWS", "API_NEWS.php"); // News API
// Template
define ("OTAINDEX_TPL", "otaindex.tpl"); // Ota index file tpl
define ("OTANULL_TPL", "otanull.tpl"); // Ota no update file tpl
define ("OTARELIZE_TPL", "otarelize.tpl"); // Ota update file tpl
define ("INDEX_TPL", "index.tpl"); // Index file tpl
define ("MENU_TPL", "menu.tpl"); // Menu file tpl
define ("NEWS_TPL", "news.tpl"); // News file tpl
?>