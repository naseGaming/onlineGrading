<?php
	$con = mysqli_connect("localhost","root","","onlinegrading");
	if(!$con){
		echo "Failed connecting to the database";
	}
	
	$sql1 = mysqli_query($con,"SELECT * FROM `studentlist` order by `schoolYear` asc");
	
	while($row=mysqli_fetch_array($sql1)){
		$year = $row['schoolYear'];
	}
	
	$years = $year+1;
	
	$filename = "SchoolYear".$year."-".$years.".csv";
	header('Content-Type:text/csv');
	header("Content-Disposition: attachment; filename=$filename");
	$data = array();
	$data[] = array("Student Number","First Name","Middle Name","Last Name","Year","Section");
	
	$fp = fopen('php://output','w');
	foreach($data as $line){
		fputcsv($fp,$line);
	}
	fclose($fp);
?>