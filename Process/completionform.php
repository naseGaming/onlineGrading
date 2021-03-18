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
			Subject Code:  <input type = "text" id = "selectedSubjectCom" class = "inp" readonly />
			<br>
			<br>
			School Year:  <input type = "text" id = "currentYearCom" class = "inp" readonly />
			<br>
			<br>
			Section:  <input type = "text" id = "selectedSectionCom" class = "inp" readonly />
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
				$period = $_GET["period"];

				$sql = mysqli_query($con,"SELECT * FROM `subjects` where `subjcode` = '$sub'");

				while($row=mysqli_fetch_array($sql)){
					$year = $row['year'];
					$flag = true;
				}
				

				if($year == 'Grade 11' or $year == 'Grade 12'){
					echo "<select id = 'PeriodCom' class = 'inp' onChange = 'changeSem();' />
							<option>1st Sem</option>
							<option>2nd Sem</option>
						</select>";
				}
				else{
					echo "<select id = 'PeriodCom' class = 'inp' onChange = 'changeSem();' />
							<option>1st Grading</option>
							<option>2nd Grading</option>
							<option>3rd Grading</option>
							<option>4th Grading</option>
						</select>";
				}
			?>
			<br>
			<br>
			<input type = "hidden" id = "cYearMan" />
			<br>
			<br>
			<?php
				echo "<table id='grades'><tr>";
				echo "<th>Student Number</th>";
				echo "<th>Student Name</th>";
				echo "<th>Year</th>";
				echo "<th>Grade</th></tr>";
				
				$a = 0;
				
				$sql2 = mysqli_query($con,"SELECT * FROM `grades` where `subjCode` = '$sub' and `period` = '$period' and `grade` = '' and `section` = '$sec' and `schoolYear` = '$cyear'");
				
				while($row2=mysqli_fetch_array($sql2)){
					$sn = $row2['studentNumber'];
					$sql3 = mysqli_query($con,"SELECT * FROM `studentlist` where `studentNumber` = '$sn' and `schoolYear` = '$cyear'");
					while($row3=mysqli_fetch_array($sql3)){
						$first = $row3['first'];
						$middle = $row3['middle'];
						$last = $row3['last'];
						$year = $row3['year'];
					}
					echo "<tr><td>$sn</td>";
					echo "<td class = 'sn'>$last, $first $middle</td>";
					echo "<td>$year</td>";
					echo "<td><input type = 'text' class = 'finp' value = '' id='".$a."C' /></td></tr>";
					echo "<input type='hidden' id='".$a."snC' value='$sn'/> ";
					$a++;
				}
				echo "</table>";
			?>
			<button id='saveGrade' onClick="complete(this);" value='<?php echo $a;?>'>Submit Grade</button>
			<br>
			<br>
		</center>
	</body>
</html>