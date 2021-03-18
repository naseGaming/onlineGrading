<?php
	$user = $_GET['user'];
	
	$con = mysqli_connect("localhost","root","","onlinegrading");
	if(!$con){
		echo "Failed connecting to the database";
	}
	
	$sql2 = mysqli_query($con,"SELECT * FROM accounts where `username` = '$user'");
	while($row=mysqli_fetch_array($sql2)){
		$first = $row['first'];
		$middle = $row['middle'];
		$last = $row['last'];
	}
	
	if($middle == ""){
		echo "$first $last";
	}
	else{
		echo "$first $middle $last";
	}
	
?>