<?php
	$user = $_GET['user'];
	$flag = false;
	
	$con = mysqli_connect("localhost","root","","onlinegrading");
	if(!$con){
		echo "Failed connecting to the database";
	}
	
	$sql4 = mysqli_query($con,"SELECT * FROM accounts where `username` = '$user'");
	
	while($row=mysqli_fetch_array($sql4)){
		$role = $row['accountType'];
		$flag = true;
	}
	
	if($flag == true){
		echo $role;
	}
	else{
		echo "Fatal Error";
	}
	
?>