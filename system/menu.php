<?php
ob_start();
session_start();
include 'config.php';
include 'function.php';
$userrole = $_SESSION ['userrole'];

$menu = "users/$userrole.php";

include $menu;

?>