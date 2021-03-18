<?php
	$user = $_GET['user'];
	$pass = $_GET['pass'];
	$flag = false;
	
	$con = mysqli_connect("localhost","root","","onlinegrading");
	if(!$con){
		echo "Failed connecting to the database";
	}
	
	$sql = mysqli_query($con,"SELECT * FROM accounts where `username` = '$user'");
	
	while($row=mysqli_fetch_array($sql)){
		$hash = $row['password'];
	}
	
	if (password_verify($pass, $hash)){
		echo "1";
	}
	else{
		echo "0";
	}
?>