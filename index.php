<?php
/* TODO */
/*
*/
define('_CYOTA', 1); // Protect key
/* Input parameter */
$RAWPOST = file_get_contents("php://input"); // Get RAW POST for OTA parsing
/* Input parameter */
include("core/init.php"); // Init core
//phpinfo();
$SYS['LOG']->WR("INDEX: BEGIN");
$SYS['DB']->CONNECT();
$SYS['DB']->CLOSE();
$SYS['LOG']->WR("INDEX: END");
?>