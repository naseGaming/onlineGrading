<?php
	$con = mysqli_connect("localhost","root","","onlinegrading");
	if(!$con){
		echo "Failed connecting to the database";
	}
	
	$sql1 = mysqli_query($con,"SELECT * FROM `studentlist` order by `schoolYear` asc");
	
	while($row=mysqli_fetch_array($sql1)){
		$year = $row['schoolYear'];
	}
	
	echo $year;
?>