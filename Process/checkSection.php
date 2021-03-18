<?php
	$user = $_GET['user'];
	$con = mysqli_connect("localhost","root","","onlinegrading");
	if(!$con){
		echo "Failed connecting to the database";
	}
	
	$sql1 = mysqli_query($con,"SELECT * FROM `studentlist` where `studentNumber` = '$user'");
	
	while($row=mysqli_fetch_array($sql1)){
		$section = $row['section'];
	}
	
	echo $section;
?>