<?php
	$role = "1";
	$first = $_GET['f'];
	$mid = $_GET['m'];
	$last = $_GET['l'];
	$user = $first.$last;
	$pass = $last.$first;
	$hashed_password = password_hash($pass, PASSWORD_DEFAULT);
	
	$con = mysqli_connect("localhost","root","","onlinegrading");
	if(!$con){
		echo "Failed connecting to the database";
	}
	
	$sql2 = mysqli_query($con,"INSERT INTO `accounts`(`accountType`, `username`, `password`, `first`, `middle`, `last`) VALUES ('$role','$user','$hashed_password','$first','$mid','$last')");

	if(!$sql2){
		echo "Failed to connect to database";
	}
	else{
		echo "Successful";
	}
?>