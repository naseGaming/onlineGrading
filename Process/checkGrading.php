<?php
	$sub = $_GET['sub'];
	$sy = $_GET['sy'];
	$section = $_GET['section'];
	$flag = false;

	$con = mysqli_connect("localhost","root","","onlinegrading");
	if(!$con){
		echo "Failed connecting to the database";
	}
	
	$sql1 = mysqli_query($con,"SELECT * FROM `grades` where `subjCode` = '$sub' and `section` = '$section' and `schoolYear` = '$sy' ");
	
	while($row=mysqli_fetch_array($sql1)){
		$flag = true;
		$per = $row['period'];
	}
	
	$sql2 = mysqli_query($con,"SELECT * FROM `subjects` where `subjcode` = '$sub' and `section` = '$section'");
	
	while($row2=mysqli_fetch_array($sql2)){
		$year = $row2['year'];
	}
	
	if($year == 'Grade 11' or $year == 'Grade 12'){
		if($flag == false){
			echo "1st Sem";
		}
		else{
			if($per == "1st Sem"){
				echo "2nd Grading";
			}
			else{
				echo "Error";
			}
		}
	}
	else{
		if($flag == false){
			echo "1st Grading";
		}
		else{
			if($per == "1st Grading"){
				echo "2nd Grading";
			}
			else if($per == "2nd Grading"){
				echo "3rd Grading";
			}
			else if($per == "3rd Grading"){
				echo "4th Grading";
			}
			else{
				echo "Something went wrong!";
			}
		}
	}
?>