<html>
	<head>
		<style>
			#grades {
				font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
				border-collapse: collapse;
				width: 100%;
				text-align: center;
			}

			#grades td, #grades th {
				border: 1px solid #ddd;
				padding: 8px;
			}

			td{
				color: white;
			}

			#grades tr{
				background-color: #006400;
			}

			#grades tr:hover {
				background-color: black;
			}

			#grades th {
				padding-top: 12px;
				padding-bottom: 12px;
				background-color: rgba(50, 150, 50, 0.9);
				color: white;
			}
			
			.sn{
				text-align: left;
			}
			
			.edit{
				outline: none;
				background: none;
				border: none;
				color: white;
			}
			
			.edit:hover{
				color:red;
			}
		</style>
	</head>
	<body>
		<div>
			<center>
				<?php
					$con = mysqli_connect("localhost","root","","onlinegrading");
					if(!$con){
						echo "Failed connecting to the database";
					}
					$flag = false;
					$first = false;
					$second = false;
					$third = false;
					$fourth = false;
					$user = $_GET['user'];
					$sy = $_GET['sy'];
					$year = $_GET['yr'];
					$section = $_GET['section'];
					$old = "";
					$new = "";
					
					$sql1 = mysqli_query($con,"SELECT * FROM `grades` where `studentNumber` = '$user' and `schoolYear` = '$sy' and `section` = '$section'");
					
					echo "<table id='grades'><tr>";
					echo "<th>Subject Description</th>";
					echo "<th>First Grading</th>";
					echo "<th>Second Grading</th>";
					echo "<th>Third Grading</th>";
					echo "<th>Fourth Grading</th>";
					echo "<th>Final Grade</th></tr>";
					while($row1=mysqli_fetch_array($sql1))
					{
						$flag = true;
						$code = $row1['subjCode'];
						$new = $code;
						if($old == $new){
							
						}
						else{
							$old = $new;
							$sql2 = mysqli_query($con,"SELECT * from `subjects` where `subjcode` = '$code' ");
							while($row2=mysqli_fetch_array($sql2)){
								$desc = $row2['subjdesc'];
							}
							echo "<tr><td>$desc</td>";
							$sql3 = mysqli_query($con,"SELECT * FROM `grades` where `studentNumber` = '$user' and `schoolYear` = '$sy' and `section` = '$section' and `period` = '1st Grading' and `subjCode` = '$code'");
							while($row3=mysqli_fetch_array($sql3)){
								$fiGrade = $row3['grade'];
								$first = true;
							}
							if($first == true){
								echo "<td>$fiGrade</td>";
							}else{
								echo "<td></td>";
							}
							$sql4 = mysqli_query($con,"SELECT * FROM `grades` where `studentNumber` = '$user' and `schoolYear` = '$sy' and `section` = '$section' and `period` = '2nd Grading' and `subjCode` = '$code'");
							while($row4=mysqli_fetch_array($sql4)){
								$seGrade = $row4['grade'];
								$second = true;
							}
							if($second == true){
								echo "<td>$seGrade</td>";
							}else{
								echo "<td></td>";
							}
							$sql5 = mysqli_query($con,"SELECT * FROM `grades` where `studentNumber` = '$user' and `schoolYear` = '$sy' and `section` = '$section' and `period` = '3rd Grading' and `subjCode` = '$code'");
							while($row5=mysqli_fetch_array($sql5)){
								$thGrade = $row5['grade'];
								$third = true;
							}
							if($third == true){
								echo "<td>$thGrade</td>";
							}else{
								echo "<td></td>";
							}
							$sql6 = mysqli_query($con,"SELECT * FROM `grades` where `studentNumber` = '$user' and `schoolYear` = '$sy' and `section` = '$section' and `period` = '4th Grading' and `subjCode` = '$code'");
							while($row6=mysqli_fetch_array($sql6)){
								$foGrade = $row6['grade'];
								$fourth = true;
							}
							if($fourth == true){
								echo "<td>$foGrade</td>";
							}else{
								echo "<td></td>";
							}
							
							if($second == true and $third == true and $fourth == true){
								$sum = $fiGrade + $seGrade + $thGrade + $foGrade;
								$final = $sum / 4;
								echo "<td>$final</td></tr>";
							}else{
								echo "<td></td></tr>";
							}
							
							$first = false;
							$second = false;
							$third = false;
							$fourth = false;
						}
					}
					
					if($flag == false){
						echo "<h1>Empty Result Found</h1>";
					}
					mysqli_close($con);
					echo"</table>";
				?>
			</center>
		</div>
	</body>
</html>