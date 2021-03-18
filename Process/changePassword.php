<?php
	$user = $_GET['user'];
	$pass = $_GET['newp'];
	$hashed_password = password_hash($pass, PASSWORD_DEFAULT);
	
	$con = mysqli_connect("localhost","root","","onlinegrading");
	if(!$con){
		echo "Failed connecting to the database";
	}
	
	$sql = mysqli_query($con,"UPDATE `accounts` SET `password` = '$hashed_password' where `username` = '$user'");
	
	if(!$sql){
		echo "Failed changing password";
	}
	else{
		echo "Succesful";
	}
?>