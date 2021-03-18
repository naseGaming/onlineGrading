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
			
			.finp{
				background-color: rgba(0,0,0,0);
				border: none;
				border-bottom: 1px solid black;
				outline: none;
			}
			
			.finps{
				background-color: rgba(0,0,0,0);
				border: none;
				border-bottom: 1px solid black;
				outline: none;
				margin-left: 20px;
			}
			
			#saveGrade{
				background-color: rgba(3,3,3,0);
				outline: none;
				padding: 5px, 5px;
				width: 200px;
				height: 30px;
				float:right;
			}
		</style>
	</head>
	<body>
		<center>
			Subject Code:  <input type = "text" id = "selectedSubjectMan" class = "inp" readonly />
			<br>
			<br>
			School Year:  <input type = "text" id = "currentYearMan" class = "inp" readonly />
			<br>
			<br>
			Section:  <input type = "text" id = "selectedSectionMan" class = "inp" readonly />
			<br>
			<br>
			<?php
				$con = mysqli_connect("localhost","root","","onlinegrading");
				if(!$con){
					echo "Failed connecting to the database";
				}
				$flag = false;
				$bool = false;
				
				$sub = $_GET["sub"];
				$sec = $_GET["sec"];
				$cyear = $_GET["cyear"];

				$sql = mysqli_query($con,"SELECT * FROM `subjects` where `subjcode` = '$sub'");

				while($row=mysqli_fetch_array($sql)){
					$year = $row['year'];
					$flag = true;
				}
				

				if($year == 'Grade 11' or $year == 'Grade 12'){
					$sqls = mysqli_query($con,"SELECT * FROM `grades` where `subjCode` = '$sub' and `section` = '$sec' order by `period`");
					while($row=mysqli_fetch_array($sqls)){
						$period = $row['period'];
						$bool = true;
					}
					if($bool == true){
						if($period = "1st Sem"){
							echo "Grading Period:  <input type = 'text' id = 'PeriodMan' value = '2nd Sem' class = 'inp' readonly />";
						}
					}
					else{
						echo "Grading Period:  <input type = 'text' id = 'PeriodMan' value = '1st Sem' class = 'inp' readonly />";
					}
				}
				else{
					$sqls = mysqli_query($con,"SELECT * FROM `grades` where `subjCode` = '$sub' and `section` = '$sec' order by `period`");
					while($row=mysqli_fetch_array($sqls)){
						$period = $row['period'];
						$bool = true;
					}
					if($bool == true){
						if($period == "1st Grading"){
							echo "Grading Period:  <input type = 'text' id = 'PeriodMan' value = '2nd Grading' class = 'inp' readonly />";
						}
						else if($period == "2nd Grading"){
							echo "Grading Period:  <input type = 'text' id = 'PeriodMan' value = '3rd Grading' class = 'inp' readonly />";
						}
						else if($period == "3rd Grading"){
							echo "Grading Period:  <input type = 'text' id = 'PeriodMan' value = '4th Grading' class = 'inp' readonly />";
						}
						else{}
					}
					else{
						echo "Grading Period:  <input type = 'text' id = 'PeriodMan' value = '1st Grading' class = 'inp' readonly />";
					}
				}
			?>
			<br>
			<br>
			<input type = "hidden" id = "cYearMan" />
			<button onClick = "unlockme();">Completion</button>
			<button onClick = "importdata();">Import</button>
			<br>
			<br>
			<?php
				echo "<table id='grades'><tr>";
				echo "<th>Student Number</th>";
				echo "<th>Student Name</th>";
				echo "<th>Year</th>";
				echo "<th>Grade</th></tr>";
				
				$a = 0;
				
				$sql2 = mysqli_query($con,"SELECT * FROM `studentlist` where `section` = '$sec' and `schoolYear` = '$cyear'");
				
				while($row2=mysqli_fetch_array($sql2)){
					$sn = $row2['studentNumber'];
					$first = $row2['first'];
					$middle = $row2['middle'];
					$last = $row2['last'];
					$year = $row2['year'];
					echo "<tr><td>$sn</td>";
					echo "<td class = 'sn'>$last, $first $middle</td>";
					echo "<td id = 'manualYear'>$year</td>";
					echo "<td><input type = 'text' class = 'finp' value = '' id='$a' /></td></tr>";
					echo "<input type='hidden' id='".$a."sn' value='$sn'/> ";
					$a++;
				}
				echo "</table>";
			?>
			<button id='saveGrade' onClick="saveGrade(this);" value='<?php echo $a;?>'>Submit Grade</button>
			<br>
			<br>
		</center>
	</body>
</html>