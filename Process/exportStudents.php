<?php
	$sec = $_GET['sec'];
	$year = $_GET['year'];
	$filename = $sec.".csv";
	header('Content-Type:text/csv');
	header("Content-Disposition: attachment; filename=$filename");
	
	$con = mysqli_connect("localhost","root","","onlinegrading");
	if(!$con){
		echo "Failed connecting to the database";
	}
	$data = array();
	$data[] = array("Student Number","Student Name","Grade");
	$sql = mysqli_query($con,"SELECT * FROM `studentlist` where `section` = '$sec' and `schoolYear` = '$year'");
	
	while($row=mysqli_fetch_array($sql))
		{
			$student = $row['studentNumber'];
			$first = $row['first'];
			$middle = $row['middle'];
			$last = $row['last'];
			$name = $first.$middle.$last;
			$data[] = array($student,$name);
		}
	
	$fp = fopen('php://output','w');
	foreach($data as $line){
		fputcsv($fp,$line);
	}
	fclose($fp);
?>