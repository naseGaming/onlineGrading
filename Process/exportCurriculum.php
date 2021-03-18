<?php
	$year = $_GET['year'];
	
	$filename = $year."-Curriculum.csv";
	header('Content-Type:text/csv');
	header("Content-Disposition: attachment; filename=$filename");
	$data = array();
	$data[] = array("Subject Code","Subject Description");
	
	$fp = fopen('php://output','w');
	foreach($data as $line){
		fputcsv($fp,$line);
	}
	fclose($fp);
?>