<?php
	$subj = $_GET['subj'];
	$prof = $_GET['prof'];
	
	$con = mysqli_connect("localhost","root","","onlinegrading");
	if(!$con){
		echo "Failed connecting to the database";
	}
	
	$sql = mysqli_query($con,"UPDATE `subjects` SET `teacher` = '$prof' where `subjID` = '$subj'");
	
	if(!$sql){
		echo "Failed to add this subject to the designated teacher";
	}
	else{
		echo "Successful";
	}
?>