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
		$flag = true;
		$hash = $row['password'];
		$role = $row['accountType'];
	}
	
	if($flag == true){
		if (password_verify($pass, $hash)){
			echo $user;
		}
		else{
			echo "2";
		}
	}
	else{
		echo "1";
	}
?>