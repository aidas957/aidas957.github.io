<?php
/* TODO */
/*
*/
define('_CYOTA', 1); // Protect key
/* Input parameter */

/* Include */
include("core/init.php"); // Init core

$AR['LOG']->WR("AUTH: BEGIN");
$AR['DB']->CONNECT(); // Connect to db
$AR['DB']->CLOSE(); // Close connection
$AR['LOG']->WR("AUTH: END");
?>