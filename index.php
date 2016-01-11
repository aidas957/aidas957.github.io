<?php
/* TODO */
/*
*/
define('_CYOTA', 1); // Protect key
/* Input parameter */
$RAWPOST = file_get_contents("php://input"); // Get RAW POST for OTA parsing
/* Include */
include("core/init.php"); // Init core

$AR['LOG']->WR("INDEX: BEGIN");
$AR['DB']->CONNECT(); // Connect to db
// Menu
$AR['MENU']->SET("Main", "/", "L"); // Create menu
$AR['MENU']->SET("Login", "/auth.php", "R"); // Create menu
$AR['INDEX']->SETMENU($AR['MENU']->Pr()); // Set all created menu to page
$AR['INDEX']->Pr(); // Print Page

$AR['DB']->CLOSE(); // Close connection
$AR['LOG']->WR("INDEX: END");
?>