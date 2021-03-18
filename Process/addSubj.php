<?php
	$sc = $_GET['sc'];
	$sd = $_GET['sd'];
	$s = $_GET['s'];
	$y = $_GET['y'];
	
	$con = mysqli_connect("localhost","root","","onlinegrading");
	if(!$con){
		echo "Failed connecting to the database";
	}
	
	$sql = mysqli_query($con,"INSERT INTO `subjects`(`subjcode`, `subjdesc`,  `year`, `section`) VALUES ('$sc','$sd','$y','$s')");
	
	if(!$sql){
		echo "Failed Inserting Subject";
	}
	else{
		echo "Succesful";
	}
	
?>