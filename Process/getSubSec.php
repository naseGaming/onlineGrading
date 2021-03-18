<?php
	session_start();

	$sub = $_GET['sub'];
	$sec = $_GET['sec'];
	
	$_SESSION["sub"] = $sub;
	$_SESSION["sec"] = $sec;
?>