<?php
	$sn = $_GET['sn'];
	$subj = $_GET['subj'];
	$g = $_GET['g'];
	$section = $_GET['section'];
	$period = $_GET['period'];
	$sy = $_GET['sy'];
	$flag = false;
	$flags = false;
	
	$con = mysqli_connect("localhost","root","","onlinegrading");
	if(!$con){
		echo "Failed connecting to the database";
	}
	
	$sql = mysqli_query($con,"SELECT * FROM `grades` where `studentNumber` = '$sn' and `subjCode` = '$subj' and `section` = '$section' and `period` = '$period' and `schoolYear` = '$sy'");
	while($row=mysqli_fetch_array($sql)){
		$grades = $row['grade'];
		
		if($grades == ""){
			$flag = false;
		}
		else{
			$flag = true;
		}
	}
	
	if($flag == false){
		if($grades == ""){
			$sql = mysqli_query($con,"DELETE FROM `grades` where `studentNumber` = '$sn' and `subjCode` = '$subj' and `section` = '$section' and `period` = '$period' and `schoolYear` = '$sy'");
		}
		$sql2 = mysqli_query($con,"INSERT INTO `grades`(`studentNumber`, `subjCode`, `grade`, `section`, `period`, `schoolYear`) VALUES ('$sn','$subj','$g','$section','$period','$sy')");
		
		if(!$sql2){
			echo "1";
		}
		else{
			echo "0";
		}	
	}
	else{
		$sql3 = mysqli_query($con,"SELECT * FROM `studentlist` where `studentNumber` = '$sn'");
		while($row3=mysqli_fetch_array($sql3)){
			$first = $row3['first'];
			$middle = $row3['middle'];
			$last = $row3['last'];
			$flags = true;
		}
		
		if($flags == true){
			if($middle == ""){
				echo "$first $last";
			}
			else{
				echo "$first $middle $last";
			}
		}
		else{
			echo "shit";
		}
	}
	

?>