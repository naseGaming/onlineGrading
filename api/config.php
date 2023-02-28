<?php
$actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
require_once("sql/DB.php");
require_once("Constant.php");
require_once("output.php");
require_once("sql/statements.php");

session_start();